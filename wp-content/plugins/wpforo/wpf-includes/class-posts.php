<?php
	// Exit if accessed directly
	if( !defined( 'ABSPATH' ) ) exit;

class wpForoPost{
	public $default;
	public $options;

	public static $cache = array( 'posts' => array(), 'post' => array(), 'item' => array(), 'topic_slug' => array(), 'forum_slug' => array(), 'post_url' => array() );
	
	function __construct(){
		$this->init_defaults();
		$this->init_options();
	}

	private function init_defaults(){
	    $this->default = new stdClass;

        $upload_max_filesize = @ini_get('upload_max_filesize');
        $upload_max_filesize = wpforo_human_size_to_bytes($upload_max_filesize);
        if( !$upload_max_filesize || $upload_max_filesize > 10485760 ) $upload_max_filesize = 10485760;

        $this->default->options = array(
            'layout_extended_intro_posts_toggle' => 1,
            'layout_extended_intro_posts_count' => 4,
            'layout_extended_intro_posts_length' => 50,
			'recent_posts_type' => 'topics',
            'topics_per_page' => 10,
            'eot_durr' => 300,
            'dot_durr' => 300,
            'posts_per_page' => 15,
            'eor_durr' => 300,
            'dor_durr' => 300,
            'max_upload_size' => $upload_max_filesize,
            'attach_cant_view_msg' => __("You are not permitted to view this attachment", 'wpforo')
        );
    }

    private function init_options(){
        $this->options = get_wpf_option('wpforo_post_options', $this->default->options);
    }
	
	public function get_cache( $var ){
		if( isset(self::$cache[$var]) ) return self::$cache[$var];
	}
	
	public function add( $args = array() ){
		
		//This variable will be based on according CAN of guest usergroup once Guest Posing is ready
		$guestposting = false;
		
		if( empty($args) && empty($_REQUEST['post']) ){ WPF()->notice->add('Reply request error', 'error'); return FALSE; }
		if( empty($args) && !empty($_REQUEST['post']) ){ $args = $_REQUEST['post']; $args['body'] = $_REQUEST['postbody']; }
		if( !isset($args['body']) || !$args['body'] ){ WPF()->notice->add('Post is empty', 'error'); return FALSE; }
		$args['name'] = (isset($args['name']) ? strip_tags($args['name']) : '' );
		$args['email'] = (isset($args['email']) ? sanitize_email($args['email']) : '' );
		if( isset($args['userid']) && $args['userid'] == 0 && $args['name'] && $args['email'] ) $guestposting = true;
		
		extract($args);
		
		if( !isset($topicid) || !$topicid ){ WPF()->notice->add('Error: No topic selected', 'error'); return FALSE; }
		if( !$topic = WPF()->topic->get_topic(intval($topicid)) ){ WPF()->notice->add('Error: Topic is not found', 'error'); return FALSE; }
		if( !$forum = WPF()->forum->get_forum(intval($topic['forumid'])) ){ WPF()->notice->add('Error: Forum is not found', 'error'); return FALSE; }
		
		if( $topic['closed'] ){
			WPF()->notice->add('Can\'t write a post: This topic is closed', 'error');
			return FALSE;
		}
		
		if( !$guestposting && !WPF()->perm->forum_can('cr', $topic['forumid']) ){
			WPF()->notice->add('You don\'t have permission to create post in this forum', 'error');
			return FALSE;
		}
		
		if( !is_user_logged_in() ){
			if( !$args['name'] || !$args['email'] ){
				WPF()->notice->add('Please insert required fields!', 'error');
				return FALSE;
			}
			else{
				WPF()->member->set_guest_cookies( $args );
			}
		}
		
		do_action( 'wpforo_start_add_post', $args );
		
		$post = $args;
		$post['forumid'] = $forumid = (isset($topic['forumid']) ? intval($topic['forumid']) : 0);
		$post['parentid'] = $parentid = (isset($parentid) ? intval($parentid) : 0);
		$post['title'] = $title = (isset($title) ? wpforo_text( trim($title), 250, false ) : '');
		$post['body'] = $body = ( isset($body) ? preg_replace('#</pre>[\r\n\t\s\0]*<pre>#isu', "\r\n", $body) : '' );
		$post['created'] = $created = ( isset($created) ? $created : current_time( 'mysql', 1 ) );
		$post['userid'] = $userid = ( isset($userid) ? intval($userid) : WPF()->current_userid );
		
		$post = apply_filters('wpforo_add_post_data_filter', $post);
		
		if(empty($post)) return FALSE;
		
		extract($post, EXTR_OVERWRITE);
		
		if(isset($forumid)) $forumid = intval($forumid);
		if(isset($topicid)) $topicid = intval($topicid);
		if(isset($parentid)) $parentid = intval($parentid);
		if(isset($title)) $title = sanitize_text_field(trim($title));
		if(isset($created)) $created = sanitize_text_field($created);
		if(isset($userid)) $userid = intval($userid);
		if(isset($body)) $body = wpforo_kses(trim($body), 'post');
        $status = ( isset($status) && $status ? 1 : 0 );
        $private = ( isset($topic['private']) && $topic['private'] ? 1 : 0 );
        if(isset($name)) $name = strip_tags(trim($name));
        if(isset($email)) $email = strip_tags(trim($email));

        do_action( 'wpforo_before_add_post', $post );
		
		if(
			WPF()->db->insert(
				WPF()->db->prefix . 'wpforo_posts',
				array( 
					'forumid'	=> $forumid, 
					'topicid'	=> $topicid, 
					'parentid'	=> $parentid,
					'userid' 	=> $userid,
					'title'     => stripslashes($title), 
					'body'      => stripslashes($body), 
					'created'	=> $created,
					'modified'	=> $created,
					'status'	=> $status,
					'private'	=> $private,
					'name' 		=> $name, 
					'email' 	=> $email
				), 
				array('%d','%d','%d','%d','%s','%s','%s','%s','%d','%d','%s','%s')
			)
		){
			$postid = WPF()->db->insert_id;
			
			$answ_incr = '';
			$comm_incr = '';
			if( isset($forum['cat_layout']) && $forum['cat_layout'] == 3 ){
				if($parentid){
					$comm_incr = ', `comments` = `comments` + 1 ';
				}else{
					$answ_incr = ', `answers` = `answers` + 1 ';
				}
			}
			
			WPF()->db->query( "UPDATE `"  . WPF()->db->prefix . "wpforo_profiles` SET `posts` = `posts` + 1 $answ_incr $comm_incr WHERE `userid` = " . intval($userid)  );
				
			$post['postid'] = $postid;
			$post['status'] = $status;
			$post['private'] = $private;
			$post['posturl'] = $this->get_post_url($postid);
			
			if( !$status ) $this->last_post($post);
			
			do_action( 'wpforo_after_add_post', $post, $topic );
			
			wpforo_clean_cache('post', $postid, $post);
			WPF()->member->reset($userid);
			WPF()->notice->add('You successfully replied', 'success');
			return $postid;
		}
		
		WPF()->notice->add('Reply request error', 'error');
		return FALSE;
	}
	
	public function edit( $args = array() ){
		
		//This variable will be based on according CAN of guest usergroup once Guest Posing is ready
		$guestposting = false;
		
		if( empty($args) && (!isset($_REQUEST['post']) || empty($_REQUEST['post'])) ) return FALSE;
		if( empty($args) && !empty($_REQUEST['post']) ){ $args = $_REQUEST['post']; $args['body'] = $_REQUEST['postbody']; }
		if( isset($args['name']) ){ $args['name'] = strip_tags($args['name']); }
		if( isset($args['email']) ){ $args['email'] = sanitize_email($args['email']); }
		
		do_action( 'wpforo_start_edit_post', $args );
		
		if( !isset($args['postid']) || !$args['postid'] || !is_numeric($args['postid']) ){
			WPF()->notice->add('Cannot update post data', 'error');
			return FALSE;
		}
		$args['postid'] = intval($args['postid']);
		if( !$post = $this->get_post($args['postid']) ){ WPF()->notice->add('No Posts found for update', 'error'); return FALSE; }
		
		if( !is_user_logged_in() ){
			if( !isset($post['email']) || !$post['email'] ){
				WPF()->notice->add('Permission denied', 'error');
				return FALSE;
			}
			elseif( !wpforo_current_guest( $post['email'] ) ){
				WPF()->notice->add('You are not allowed to edit this post', 'error');
				return FALSE;
			}
			if( !$args['name'] || !$args['email'] ){
				WPF()->notice->add('Please insert required fields!', 'error');
				return FALSE;
			}
			else{
				WPF()->member->set_guest_cookies( $args );
			}
		}
		
		$args['userid'] = $post['userid'];
		$args['status'] = $post['status'];
	
		if( isset($args['userid']) && $args['userid'] == 0 && isset($args['name']) && isset($args['email']) ) $guestposting = true;
		
		$args = apply_filters('wpforo_edit_post_data_filter', $args);
		if(empty($args)) return FALSE;
		
		extract($args, EXTR_OVERWRITE);
		
		if( !$guestposting ){
			$diff = current_time( 'timestamp', 1 ) - strtotime($post['created']);
			if( !(WPF()->perm->forum_can('er', $post['forumid']) ||
					(WPF()->current_userid == $post['userid'] && WPF()->perm->forum_can('eor', $post['forumid']) &&
						$diff < WPF()->post->options['eor_durr'])) ){
				WPF()->notice->add('You don\'t have permission to edit post from this forum', 'error');
				return FALSE;
			}
		}
		
		$title = (isset($title) ? wpforo_text( trim($title), 250, false ) : '');
		$body = ( isset($body) ? preg_replace('#</pre>[\r\n\t\s\0]*<pre>#isu', "\r\n", $body) : '' );
		
		if(isset($forumid)) $forumid = intval($forumid);
		if(isset($topicid)) $topicid = intval($topicid);
		if(isset($parentid)) $parentid = intval($parentid);
		if(isset($title)) $title = sanitize_text_field(trim($title));
		if(isset($slug)) $slug = sanitize_title($slug);
		if(isset($created)) $created = sanitize_text_field($created);
		if(isset($userid)) $userid = intval($userid);
		if(isset($body)) $body = wpforo_kses(trim($body), 'post');
		if(isset($status)) $status = intval($status);
		if(isset($private)) $private = intval($private);
		if(isset($name)) $name = strip_tags(trim($name));
		if(isset($email)) $email = strip_tags(trim($email));
		
		$title  = ( isset($title) ? stripslashes($title) : stripslashes($post['title']) );
		$body = ( (isset($body) && $body) ? stripslashes($body) : stripslashes($post['body']) );
		$status = ( isset($status) ? $status : intval($post['status']) );
		$name = ( isset($name) ? stripslashes($name) : stripslashes($post['name']) );
		$email = ( isset($email) ? stripslashes($email) : stripslashes($post['email']) );
		
		if( FALSE !== WPF()->db->update(
				WPF()->db->prefix."wpforo_posts",
				array( 
					'title'     => $title,
					'body'      => $body,
					'modified'	=> current_time( 'mysql', 1 ),
					'status'  => $status,
					'name' => $name,
					'email' => $email,
				), 
				array('postid' => $postid),
				array('%s','%s','%s','%d','%s','%s'), 
				array('%d') 
			)
		){
			do_action( 'wpforo_after_edit_post', array( 'postid' => $postid, 'topicid' => $topicid, 'title' => $title, 'body' => $body, 'status' => $status, 'private' => $private, 'name' => $name, 'email' => $email) );
			
			wpforo_clean_cache('post', $postid, $post);
			WPF()->notice->add('This post successfully edited', 'success');
			return $postid;
		}
		
		WPF()->notice->add('Reply request error', 'error');
		return FALSE;
	}
	
	#################################################################################
	/**
	 * Delete post from DB
	 * 
	 * Returns true if successfully deleted or false.
	 *
	 * @since 1.0.0
	 *
	 * @return	bool
	 */
	 
	function delete($postid, $delete_cache = true){
		$postid = intval($postid);
		
		if( !$post = $this->get_post($postid) ) return true;

		do_action('wpforo_before_delete_post', $post);

		$diff = current_time( 'timestamp', 1 ) - strtotime($post['created']);
		if( !(WPF()->perm->forum_can('dr', $post['forumid']) || (WPF()->current_userid == $post['userid'] && WPF()->perm->forum_can('dor', $post['forumid']) && $diff < WPF()->post->options['dor_durr'])) ){
			WPF()->notice->add('You don\'t have permission to delete post from this forum', 'error');
			return FALSE;
		}
		
		//Find and delete default atatchments before deleting post
		$this->delete_attachments( $postid );
		
		//Delete post
		if( WPF()->db->delete(WPF()->db->prefix . 'wpforo_posts',  array( 'postid' => intval($postid) ), array( '%d' )) ){
			$last_post = $this->get_posts( array('topicid' => intval($post['topicid']), 'orderby' => '`created` DESC, `postid` DESC', 'row_count' => 1, 'status' => 0, 'private' => 0) );
			if(is_array($last_post) && !empty($last_post)){
				$last_post = $last_post[0];
			}else{
				$last_post = array( 'created' => '0000-00-00 00:00:00', 'userid' => 0, 'postid' => 0 );
			}
			
			WPF()->db->delete(
				WPF()->db->prefix.'wpforo_likes', array( 'postid' => $postid ), array( '%d' )
			);
			WPF()->db->delete(
				WPF()->db->prefix.'wpforo_votes', array( 'postid' => $postid ), array( '%d' )
			);
			
			$answ_incr = '';
			$comm_incr = '';
			$forum = WPF()->forum->get_forum($post['forumid']);
			if( isset($forum['cat_layout']) && $forum['cat_layout'] == 3 ){
				if($post['parentid']){
					$comm_incr = ', `comments` = IF( (`comments` - 1) < 0, 0, `comments` - 1 ) ';
				}else{
					$answ_incr = ', `answers` = IF( (`answers` - 1) < 0, 0, `answers` - 1 ) ';
				}
			}
			
			if(WPF()->db->query( "UPDATE IGNORE " . WPF()->db->prefix . "wpforo_topics SET `modified` = '" . esc_sql($last_post['modified']) . "', `last_post` = " . intval($last_post['postid']) . ", `posts` = IF( (`posts` - 1) < 0, 0, `posts` - 1 ) $answ_incr WHERE `topicid` = " . intval( $post['topicid'] ))){
				if( WPF()->db->query( "UPDATE IGNORE `" . WPF()->db->prefix . "wpforo_forums` SET `last_post_date` = '" . esc_sql($last_post['created']) . "', `last_userid` = " . intval($last_post['userid']) . ", `last_postid` = " . intval($last_post['postid']) . ", `posts` = IF( (`posts` - 1) < 0, 0, `posts` - 1 ) WHERE `forumid` = " . intval( $post['forumid'] ))){
					if( WPF()->db->query( "UPDATE IGNORE `"  . WPF()->db->prefix . "wpforo_profiles` SET `posts` = IF( (`posts` - 1) < 0, 0, `posts` - 1 ) $answ_incr $comm_incr WHERE `userid` = " . intval($post['userid']) ) ){
						WPF()->member->reset($post['userid']);
						WPF()->notice->add('This post successfully deleted', 'success');
					}
				}
			}
			
			do_action('wpforo_after_delete_post', $post);
			
			if( $post['is_first_post'] ) return WPF()->topic->delete($post['topicid']);
			if( $delete_cache ) wpforo_clean_cache('post', $postid, $post);
			return TRUE;
		}
		
		WPF()->notice->add('Post delete error', 'error');
		return FALSE;
	}
	
	#################################################################################
	/**
	 * array get_post(id(num)) 
	 * 
	 * Returns array from defined and default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return	array	
	 */
	function get_post($postid){
		
		$post = array();
		$cache = WPF()->cache->on('memory_cashe');
		
		if( $cache && isset(self::$cache['post'][$postid]) ){
			return self::$cache['post'][$postid];
		}
		
		$sql = "SELECT * FROM `".WPF()->db->prefix."wpforo_posts` WHERE `postid` = " . intval($postid);
		$post = WPF()->db->get_row($sql, ARRAY_A);
		if(!empty($post)) $post['userid'] = intval($post['userid']);
		
		if( isset($post['forumid']) && $post['forumid'] && !WPF()->perm->forum_can('vf', $post['forumid']) ){
			return array();
		}
		
		if( isset($post['status']) && $post['status'] && !wpforo_is_owner($post['userid'], $post['email'])){
			if( isset($post['forumid']) && $post['forumid'] && !WPF()->perm->forum_can('au', $post['forumid']) ){
				return array();
			}
		}
		
		if($cache && isset($postid)){
			self::$cache['post'][$postid] = $post;
		}
		
		$post = apply_filters('wpforo_get_post', $post);
		return $post;
	}
	
	/**
	 * Returns merged arguments array from defined and default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @param	array		
	 *
	 * @return 	array
	 */
	function get_posts($args = array(), &$items_count = 0){
		
		$cache = WPF()->cache->on('object_cashe');
		
		$default = array( 
		  'include' => array(), 		// array( 2, 10, 25 )
		  'exclude' => array(),  		// array( 2, 10, 25 )
		  
		  'topicid'		=> NULL,		// topic id in DB
		  'forumid'		=> NULL,		// forum id in DB
		  'parentid'	=> -1,			// parent post id
		  'userid'		=> NULL,		// user id in DB
		  'orderby'		=> '`is_first_post` DESC, `created` ASC, `postid` ASC', 	// forumid, order, parentid
		  'order'		=> '', 		// ASC DESC
		  'offset' 		=> NULL,		// this use when you give row_count
		  'row_count'	=> NULL, 		// 4 or 1 ...
		  'status'		=> NULL, 		// 0 or 1 ...
		  'private'		=> NULL, 		// 0 or 1 ...
		  'email'		=> NULL, 		// example@example.com ...  
		  'check_private' => TRUE,
		  'where'		=> NULL, 
		  'owner'		=> NULL,
		);

		if( empty($args['orderby']) ) $args['order'] = '';

		$args = wpforo_parse_args( $args, $default );
		
		if(is_array($args) && !empty($args)){
			
			extract($args, EXTR_OVERWRITE);
			
			if( $row_count === 0 ) return array();
			
			$include = wpforo_parse_args( $include );
			$exclude = wpforo_parse_args( $exclude );
			
			$guest = array();
			$wheres = array();
			$table_as_prefix = '`'.WPF()->db->prefix.'wpforo_posts`.';
			if(!is_user_logged_in()) $guest = WPF()->member->get_guest_cookies();
			
			if(!empty($include)) $wheres[] = $table_as_prefix . "`postid` IN(" . implode(', ', array_map('intval', $include)) . ")";
			if(!empty($exclude)) $wheres[] = $table_as_prefix . "`postid` NOT IN(" . implode(', ', array_map('intval', $exclude)) . ")";
			
			
			if(!is_null($topicid)) $wheres[] = $table_as_prefix . "`topicid` = " . intval($topicid);
			if($parentid != -1) $wheres[]  = $table_as_prefix . "`parentid` = " . intval($parentid);
			if(!is_null($userid)) $wheres[]  = $table_as_prefix . "`userid` = " . intval($userid);
			if(!is_null($status)) $wheres[]  = $table_as_prefix . "`status` = " . intval($status);
			if(!is_null($private)) $wheres[]  = $table_as_prefix . "`private` = " . intval($private);
			if(!is_null($email)) $wheres[]  = $table_as_prefix . "`email` = '" . esc_sql($email) . "' ";
			if(!is_null($where)) $wheres[] = $table_as_prefix . $where;
			
			if( isset($forumid) && $forumid ){
				if( WPF()->perm->forum_can('au', $forumid) ){
					if(!is_null($status)) $wheres[] = $table_as_prefix . " `status` = " . intval($status);
				}
				elseif( isset(WPF()->current_userid) && WPF()->current_userid ){
					$wheres[] = " ( " . $table_as_prefix .  "`status` = 0 OR (" . $table_as_prefix .  "`status` = 1 AND " . $table_as_prefix .  "`userid` = " .intval(WPF()->current_userid). ") )";
				}
				elseif( isset($guest['email']) ){
					$wheres[] = " ( " . $table_as_prefix .  "`status` = 0 OR (" . $table_as_prefix .  "`status` = 1 AND " . $table_as_prefix .  "`email` = '" . sanitize_email($guest['email']) . "') )";
				}
				else{
					$wheres[] = " " . $table_as_prefix .  "`status` = 0";
				}
			}
			
			$sql = "SELECT * FROM `".WPF()->db->prefix."wpforo_posts`";
			if(!empty($wheres)){
				$sql .= " WHERE " . implode(" AND ", $wheres);
			}
			$sql .= " ORDER BY $orderby " . $order;
			$item_count_sql = preg_replace('#SELECT.+?FROM#isu', 'SELECT count(*) FROM', $sql);
			
			if( $item_count_sql ) $items_count = WPF()->db->get_var($item_count_sql);
			
			if($row_count != NULL){
				if($offset != NULL){
					$sql .= esc_sql(" LIMIT $offset,$row_count");
				}else{
					$sql .= esc_sql(" LIMIT $row_count");
				}
			}
			
			if( $cache ){ $object_key = md5( $sql . WPF()->current_user_groupid ); $object_cache = WPF()->cache->get($object_key); if(!empty($object_cache)){ $items_count = $object_cache['items_count']; return $object_cache['items']; }}
			
			$posts = WPF()->db->get_results($sql, ARRAY_A);
			$posts = apply_filters('wpforo_get_posts', $posts);
			
			if( $check_private ){
				foreach($posts as $key => $post){
					if( isset($post['forumid']) && !WPF()->perm->forum_can('vf', $post['forumid']) ){
						unset($posts[$key]);
					}
					if( isset($post['forumid']) && isset($post['private']) && $post['private'] && !$owner ){
						if(!WPF()->perm->forum_can('vp', $post['forumid'])){ 
							if(is_null($owner)){
								$topic_userid = wpforo_topic($post['topicid'], 'userid');
								if(!wpforo_is_owner($topic_userid) && !wpforo_is_owner($post['userid'])){
									unset($posts[$key]);
								}
							}else{
								unset($posts[$key]);
							}
						}
					}
					if( isset($post['forumid']) && isset($post['status']) && $post['status'] && !wpforo_is_owner($post['userid'], $post['email']) ){
						if( !WPF()->perm->forum_can('au', $post['forumid']) ){
							unset($posts[$key]);
						}
					}
				}
			}
			
			if($cache && isset($object_key) && !empty($posts)){ 
				self::$cache['posts'][$object_key]['items'] = $posts; 
				self::$cache['posts'][$object_key]['items_count'] = $items_count;
			}
			return $posts;
		}
	}
	
	function get_posts_filtered( $args = array() ){
		$posts = array();
		$posts = $this->get_posts( $args );
		if( !empty($posts) ){
			foreach($posts as $key => $post){
				if( isset($post['forumid']) && !WPF()->perm->forum_can('vf', $post['forumid']) ){
					unset($posts[$key]);
				}
				if( isset($posts[$key]) && isset($post['forumid']) && isset($post['private']) && $post['private'] && !wpforo_is_owner($post['userid'], $post['email']) ){
					if( !WPF()->perm->forum_can('vp', $post['forumid']) ){
						unset($posts[$key]);
					}
				}
				if( isset($posts[$key]) && isset($post['forumid']) && isset($post['status']) && $post['status'] && !wpforo_is_owner($post['userid'], $post['email']) ){
					if( !WPF()->perm->forum_can('au', $post['forumid']) ){
						unset($posts[$key]);
					}
				}
			}
		}
		return $posts;
	}
	
	
	function search( $args = array(), &$items_count = 0 ){
		if(!is_array($args)) $args = array('needle' => $args);
		
		$default = array( 
		  'needle'		=> '', 		 		// search needle
		  'forumids' 	=> array(), 		// array( 2, 10, 25 )
		  'date_period'	=> 0,				// topic id in DB
		  'type'		=> 'entire-posts',	// search type ( entire-posts | titles-only | user-posts | user-topics )
		  'orderby'		=> 'relevancy', 	// Sort Search Results by ( relevancy | date | user | forum )
		  'order'		=> 'DESC', 			// Sort Search Results ( ASC | DESC )
		  'offset' 		=> NULL,			// this use when you give row_count
		  'row_count'	=> NULL 			// 4 or 1 ...
		);
		
		$args = wpforo_parse_args( $args, $default );
		
		if( !empty($args) ){
			extract($args, EXTR_OVERWRITE);
			
			$date_period = intval($date_period);
			
			$selects = array('p.`postid`', 't.`topicid`', 't.`private`', 't.`status`', 't.`forumid`', 'p.`userid`', 't.`title`', 'p.`created`', 'p.`body`' );
			$innerjoins = array('INNER JOIN `'.WPF()->db->prefix.'wpforo_topics` t ON t.`topicid` = p.`topicid`');
			$wheres = array();
			$orders = array();
			
			if(!empty($forumids)) $wheres[] = "t.`forumid` IN(" . implode(', ', array_map('intval', $forumids)) . ")";
			if( $date_period != 0 ){
				$date = date( 'Y-m-d H:i:s', current_time( 'timestamp', 1 ) - ($date_period * 24 * 60 * 60) );
				if($date) $wheres[] = "p.`created` > '".esc_sql($date)."'";
			}
			
			if($needle){
				
				$needle = trim( trim( str_replace(' ', '* ', $needle) ), '*' ) . "*";
				$needle = esc_sql(substr(sanitize_text_field($needle), 0, 60));
				
				if($type == 'entire-posts'){
					$selects[] = "MATCH(t.`title`) AGAINST('$needle' IN BOOLEAN MODE) + MATCH(p.`title`) AGAINST('$needle' IN BOOLEAN MODE) + MATCH(p.`body`) AGAINST('$needle' IN BOOLEAN MODE) AS matches";
					$wheres[] = "( MATCH(t.`title`) AGAINST('$needle' IN BOOLEAN MODE) OR MATCH(p.`title`, p.`body`) AGAINST('$needle' IN BOOLEAN MODE) )";
					$orders[] = "MATCH(t.`title`) AGAINST('$needle') + MATCH(p.`title`) AGAINST('$needle') + MATCH(p.`body`) AGAINST('$needle')";
					$orders[] = "MATCH(t.`title`) AGAINST('$needle' IN BOOLEAN MODE) + MATCH(p.`title`) AGAINST('$needle' IN BOOLEAN MODE) + MATCH(p.`body`) AGAINST('$needle' IN BOOLEAN MODE)";
				}elseif($type == 'titles-only'){
					$selects[] = "MATCH(t.`title`) AGAINST('$needle' IN BOOLEAN MODE) + MATCH(p.`title`) AGAINST('$needle' IN BOOLEAN MODE) AS matches";
					$wheres[] = "( MATCH(t.`title`) AGAINST('$needle' IN BOOLEAN MODE) OR MATCH(p.`title`) AGAINST('$needle' IN BOOLEAN MODE) )";
					$orders[] = "MATCH(t.`title`) AGAINST('$needle') + MATCH(p.`title`) AGAINST('$needle')";
					$orders[] = "MATCH(t.`title`) AGAINST('$needle' IN BOOLEAN MODE) + MATCH(p.`title`) AGAINST('$needle' IN BOOLEAN MODE)";
				}elseif($type == 'user-posts' || $type == 'user-topics'){
					$innerjoins[] = "INNER JOIN `".WPF()->db->base_prefix."users` u ON u.`ID` = p.`userid`";
					$wheres[] = "( u.`user_login` LIKE '$needle' OR u.`user_email` LIKE '$needle' OR u.`display_name` LIKE '$needle' )";
					if($type == 'user-topics') $wheres[] = "`is_first_post` = 1";
				}
			}
			
			if($orderby == 'date'){
				$orders = array('p.`created`');
			}elseif($orderby == 'user'){
				$orders = array('p.`userid`');
			}elseif($orderby == 'forum'){
				$orders = array('t.`forumid`');
			}
			
			$sql = "SELECT COUNT(p.`postid`) FROM `".WPF()->db->prefix."wpforo_posts` p ".implode(' ', $innerjoins);
			if(!empty($wheres)) $sql .= " WHERE " . implode( " AND ", $wheres );
			$items_count = WPF()->db->get_var($sql);
			
			$sql = "SELECT ".implode(', ', $selects)." FROM `".WPF()->db->prefix."wpforo_posts` p ".implode(' ', $innerjoins);
			if(!empty($wheres)) $sql .= " WHERE " . implode( " AND ", $wheres );
			if(!empty($orders)) $sql .= " ORDER BY ".implode(' '.strtoupper($order).', ', $orders)." ".strtoupper($order);
			
			if($row_count != NULL){
				if($offset != NULL){
					$sql .= esc_sql(" LIMIT $offset,$row_count");
				}else{
					$sql .= esc_sql(" LIMIT $row_count");
				}
			}

			$posts = WPF()->db->get_results($sql, ARRAY_A);
			foreach($posts as $key => $post){
				if( !WPF()->perm->forum_can( 'vf', $post['forumid'] ) ) unset($posts[$key]);
				if( $post['private'] && !WPF()->perm->forum_can( 'vp', $post['forumid'] ) ) unset($posts[$key]);
				if( $post['status'] && !WPF()->perm->forum_can( 'au', $post['forumid'] ) ) unset($posts[$key]);
			}
			return $posts;
		}else{
			return array();
		}
	}
	
	/**
	 *  return likes count by post id
	 * 
	 * Return likes count 
	 *
	 * @since 1.0.0
	 *
	 * @param	int 
	 *
	 * @return	int
	 */
	function get_post_likes_count($postid){
		return WPF()->db->get_var("SELECT COUNT(l.`likeid`) FROM `".WPF()->db->prefix."wpforo_likes` l, `".WPF()->db->base_prefix."users` u WHERE `l`.`userid` = `u`.ID AND `l`.`postid` = ".intval($postid) );
	}
	
	/**
	 *  return usernames who likes this post
	 * 
	 * Return array with username
	 *
	 * @since 1.0.0
	 *
	 * @param	int
	 *
	 * @return	array
	 */
	function get_likers_usernames($postid){
		return WPF()->db->get_results("SELECT u.ID, u.display_name FROM `".WPF()->db->prefix."wpforo_likes` l, `".WPF()->db->base_prefix."users` u WHERE `l`.`userid` = `u`.ID AND `l`.`postid` = ".intval($postid)." ORDER BY l.`userid` = " . intval(WPF()->current_userid) . " DESC, l.`likeid` DESC LIMIT 3", ARRAY_A);
	}
	
	/**
	 *  return like ID or null
	 * 
	 * @since 1.0.0
	 *
	 * @param	int int
	 *
	 * @return null or like id
	 */
	function is_liked($postid, $userid){
		$returned_value = WPF()->db->get_var("SELECT likeid FROM `".WPF()->db->prefix."wpforo_likes` WHERE `postid` = ".intval($postid)." AND `userid` = ".intval($userid) );
		if(is_null($returned_value)){
			return FALSE;	
		}else{
			return $returned_value;
		}
	}
	
	/**
	 *  return votes sum by post id
	 * 
	 * Return votes count 
	 *
	 * @since 1.0.0
	 *
	 * @param	int 
	 *
	 * @return	int
	 */
	function get_post_votes_sum($postid){
		$sum = WPF()->db->get_var("SELECT sum(`reaction`) FROM `".WPF()->db->prefix."wpforo_votes` WHERE `postid` = ".intval($postid) );
		if($sum == null){
			$sum = 0;
		}
		return $sum;
	}
	
	
	/**
	 *  return forum slug
	 * 
	 * string (slug)
	 *
	 * @since 1.0.0
	 *
	 * @param	int
	 *
	 * @return	string or false
	 */
	 
	function get_forumslug_byid($postid){
		
		$cache = WPF()->cache->on('memory_cashe');
		
		if( $cache && isset(self::$cache['forum_slug'][$postid]) ){
			return self::$cache['forum_slug'][$postid];
		}
		
		$slug = WPF()->db->get_var("SELECT `slug` FROM ".WPF()->db->prefix."wpforo_forums WHERE `forumid` =(SELECT forumid FROM `".WPF()->db->prefix."wpforo_topics` WHERE `topicid` =(SELECT `topicid` FROM `".WPF()->db->prefix."wpforo_posts` WHERE postid = ".intval($postid)."))");
		
		if($cache && isset($postid)){
			self::$cache['forum_slug'][$postid] = $slug;
		}
		
		if($slug){
			return $slug;
		}else{
			return FALSE;
		}
	}
	
	
	/**
	 *  return topic slug
	 * 
	 * string (slug)
	 *
	 * @since 1.0.0
	 *
	 * @param	int
	 *
	 * @return	string or false
	 */
	 
	function get_topicslug_byid( $postid ){
		
		$cache = WPF()->cache->on('memory_cashe');
		
		if( $cache && isset(self::$cache['topic_slug'][$postid]) ){
			return self::$cache['topic_slug'][$postid];
		}
		
		$slug = WPF()->db->get_var("SELECT `slug` FROM ".WPF()->db->prefix."wpforo_topics WHERE `topicid` =(SELECT `topicid` FROM `".WPF()->db->prefix."wpforo_posts` WHERE postid = ".intval($postid).")");
		
		if($cache && isset($postid)){
			self::$cache['topic_slug'][$postid] = $slug;
		}
		
		if($slug){
			return $slug;
		}else{
			return FALSE;
		}
	}
	
	/**
	* return post full url by id
	* 
	* @since 1.0.0
	* 
	* @param int $postid
	* 
	* @return string $url
	*/
	function get_post_url( $arg, $absolute = true ){
		
		$position = array();
		
		if( isset($arg) && !is_array($arg) ){
			$postid = wpforo_bigintval($arg);
			$post = $this->get_post($postid);
		}
		elseif( !empty($arg) && isset($arg['postid']) ){
			$post = $arg;
			$postid = $post['postid'];
		}
		
		if( is_array($post) && !empty($post) && $postid ){
			$url = $this->get_forumslug_byid($postid) . '/' . $this->get_topicslug_byid($postid);
			if( $post['topicid'] ){
				if( !$position ) $position = WPF()->db->get_var("SELECT COUNT(`postid`) FROM `".WPF()->db->prefix."wpforo_posts` WHERE `topicid` = ".wpforo_bigintval($post['topicid'])." AND `postid` <= " . ( $post['parentid'] && WPF()->forum->get_layout($post['forumid']) == 3 ? wpforo_bigintval($post['parentid']) : wpforo_bigintval($postid) ) );
				if( $position <= WPF()->post->options['posts_per_page'] ) return wpforo_home_url($url, false, $absolute ) . "#post-" . wpforo_bigintval($postid);
				if( $position && WPF()->post->options['posts_per_page'] ) {
                    $paged = ceil($position / WPF()->post->options['posts_per_page']);
                }
                else{
                    $paged = 1;
                }
				return wpforo_home_url( $url . "/paged/" . $paged, false, $absolute ) ."#post-" . wpforo_bigintval($postid);
			}
		}
		
		return wpforo_home_url();
	}
	
	
	/**
	* return 0 or 1 
	* 
	* @since 1.0.0
	* 
	* @param int $postid
	*/
	function is_answered( $postid ){
		$is_answered =  WPF()->db->get_var( WPF()->db->prepare(
			" SELECT is_answer 
				FROM `".WPF()->db->prefix."wpforo_posts`
				WHERE postid = %d
			", 
			intval($postid)
		) );
		return $is_answered;
	}

    function is_approved( $postid ){
        $post = WPF()->db->get_var( "SELECT `status` FROM " . WPF()->db->prefix."wpforo_posts WHERE `postid` = " . intval($postid) );
        if( $post ) return FALSE;
        return TRUE;
    }

	function get_count( $args = array() ){
		$sql = "SELECT COUNT(`postid`) FROM `".WPF()->db->prefix."wpforo_posts`";
		if($args && is_array($args)){
			$wheres = array();
			foreach ($args as $key => $value)  $wheres[] = "`$key` = '" . esc_sql($value) . "'";
			if($wheres) $sql .= " WHERE " . implode(' AND ', $wheres);
		}
		return WPF()->db->get_var($sql);
	}
	
	function unapproved_count(){
		return WPF()->db->get_var( "SELECT COUNT(*) FROM `".WPF()->db->prefix."wpforo_posts` WHERE `status` = 1" );
	}
	
	function get_attachment_id( $filename ){
		$attach_id =  WPF()->db->get_var( "SELECT `post_id` FROM `".WPF()->db->prefix."postmeta` WHERE `meta_key` = '_wp_attached_file' AND `meta_value` LIKE '%" . esc_sql($filename) . "' LIMIT 1");
		return $attach_id;
	}
	
	function delete_attachments( $postid ){
		$post = $this->get_post($postid);
		if( isset($post['body']) && $post['body'] ){
			if( preg_match_all('|\/wpforo\/default_attachments\/([^\s\"\]]+)|is', $post['body'], $attachments, PREG_SET_ORDER) ){
				$upload_dir = wp_upload_dir();
                $default_attachments_dir = $upload_dir['basedir'] . '/wpforo/default_attachments/';
				foreach( $attachments as $attachment ){
					$filename = trim($attachment[1]);
					$file = $default_attachments_dir . $filename;
					if( file_exists($file) ){
						$posts = WPF()->db->get_var( "SELECT COUNT(*) as posts FROM `".WPF()->db->prefix."wpforo_posts` WHERE `body` LIKE '%" . esc_sql( $attachment[0] ) . "%'" );
						if( is_numeric($posts) && $posts == 1 ){
							$attachmentid = $this->get_attachment_id( '/' . $filename  );
							if ( !wp_delete_attachment( $attachmentid ) ){
								@unlink($file); 
							}
						}
					}
				}
			}
		}
	}

	public function status( $postid, $status ){
        if( !$postid = wpforo_bigintval($postid) ) return false;
        if( !$post = $this->get_post($postid) ) return false;

        if( $post['is_first_post'] ) return WPF()->topic->status($post['topicid'], $status);

        if( false !== WPF()->db->update(
            WPF()->db->prefix."wpforo_posts",
            array( 'status' => intval($status) ),
            array( 'postid' => $postid ),
            array( '%d' ),
            array( '%d' )
        )){
			if($status) {
				$this->last_post($post, 'remove'); 
			} else { 
				$this->last_post($post, 'add');
			}
			WPF()->notice->add('Done!', 'success');
            return true;
        }

        WPF()->notice->add('error: Change Status action', 'error');
        return false;
    }
	
	public function last_post($post, $action = 'add'){
		if( !empty($post) && isset($post['postid']) && isset($post['topicid']) && isset($post['forumid']) && isset($post['userid']) && isset($post['created']) ){
			extract($post, EXTR_OVERWRITE);
			if( $action == 'add' ){
				WPF()->db->query( "UPDATE `"  . WPF()->db->prefix . "wpforo_forums` SET `last_topicid` = ". intval($topicid) .", `last_postid` = ". intval($postid) .", `last_post_date` = '".esc_sql($created)."', `last_userid` =  " . intval($userid) . ", `posts` = `posts` + 1 WHERE `forumid` = " . intval($forumid) );
				WPF()->db->query( "UPDATE `"  . WPF()->db->prefix . "wpforo_topics` SET `modified` = '" . esc_sql($created) . "', `last_post` = ". intval($postid) .", `posts` = `posts` + 1 $answ_incr WHERE `topicid` = " . intval($topicid) );
			}
			elseif($action == 'remove'){
				//rebuild forum and topic last post info, don't include unapproved and private posts.
			}
		}
	}
}