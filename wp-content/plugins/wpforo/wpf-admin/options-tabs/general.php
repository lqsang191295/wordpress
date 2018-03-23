<?php
	// Exit if accessed directly
	if( !defined( 'ABSPATH' ) ) exit;
	if( !current_user_can('administrator') ) exit;
?>

	<?php if( !isset( $_GET['action'] ) ): ?>
    	
    	<form action="" method="POST" class="validate">
        	<?php wp_nonce_field( 'wpforo-settings-general' ); ?>
			<table class="wpforo_settings_table">
				<tbody>
                	<tr>
						<th>
                        	<label for="wpforourl"><?php _e('Forum Base URL', 'wpforo'); ?></label>
						</th>
						<td align="left">
                            <?php if(!WPF()->use_home_url): ?>
                            	<span style="font-size:14px;"><?php echo esc_url( home_url('/') ) ?></span>
                                <input required id="wpforourl" type="text" name="wpforo_url" value="<?php echo esc_attr( urldecode( WPF()->permastruct ) ) ?>" style="width:47%;"/>/<br>
                            <?php endif; ?>
                            <label for="wpforo_use_home_url">
							<input id="wpforo_use_home_url" type="checkbox" name="wpforo_use_home_url" value="1" <?php echo (WPF()->use_home_url ? 'checked' : '') ?>/>
							<?php _e('Turn WordPress to wpForo', 'wpforo') ?>
                            	<p class="wpf-info"><?php _e('This option will disable WordPress on front-end. Only forum pages and excluded post/pages will be available. wpForo will look like as a stand-alone forum.', 'wpforo') ?></p>
                            </label>
                            <?php if(WPF()->use_home_url): ?>
                            	<label for="wpforo_excld_urls"><b style="font-weight: bold;">* <?php _e('Exclude page URLs', 'wpforo') ?></b>  <span class="wpf-info">(<?php _e('one URL per line', 'wpforo') ?>)</span></label><br/>
                                <textarea id="wpforo_excld_urls" 
                                	style="font-size: 11px;" 
                                	rows="4" 
                                	cols="30" 
                                	name="wpforo_excld_urls" 
                                	placeholder="<?php echo esc_url( home_url('/') ) ?>sample-page/&#10;<?php echo esc_url( home_url('/') ) ?>hello-world/&#10; ..."
                                ><?php echo esc_textarea( WPF()->excld_urls ) ?></textarea>
                                <br/>
                            <?php endif; ?>
                            <a href="<?php echo wpforo_home_url() ?>" target="_blank"><?php _e('Visit Forum', 'wpforo') ?></a> | 
                            <?php $page_id = WPF()->db->get_var("SELECT `ID` FROM `".WPF()->db->prefix."posts` WHERE `ID` = ".intval(WPF()->pageid)." AND `post_content` LIKE '%[wpforo%' AND `post_status` LIKE 'publish' AND `post_type` IN('post', 'page')"); ?>
							<?php if( !WPF()->pageid || !$page_id ): ?>
                            	<?php echo '<span style="color:#DD0000">' . __('wpForo PageID doesn\'t exist. Forums will not be loaded, please read this') . ' <a href="http://wpforo.com/community/faq/how-to-add-forum-pageid/">' . __('support topic', 'wpforo') . '&raquo;</a>' . '</span>'; ?>
							<?php else: ?>
                            	<?php _e('Forum Page ID', 'wpforo'); ?>: <?php echo WPF()->pageid; ?>
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<th><label for="forum_title"><?php _e('Forum Title', 'wpforo'); ?></label></th>
						<td><input id="forum_title" type="text" name="wpforo_general_options[title]" value="<?php if(isset(WPF()->general_options['title'])) wpfo( WPF()->general_options['title'] ); ?>" required></td>
					</tr>
                    <tr>
						<th><label for="forum_description"><?php _e('Forum Description', 'wpforo'); ?></label></th>
						<td><input id="forum_description" type="text" name="wpforo_general_options[description]" value="<?php if(isset(WPF()->general_options['description'])) wpfo( WPF()->general_options['description'] ); ?>" required></td>
					</tr>
                    <tr>
						<th>
                        	<label><?php _e('Dashboard Menu Position', 'wpforo'); ?></label>
                        	<p class="wpf-info"><?php _e('The position in the menu order wpForo should appear.', 'wpforo'); ?></p>
                        	<p class="wpf-info" style="font-size:11px; line-height:14px;"><?php _e('Use greater than 5 - below Posts, 10 - below Media, 15 - below Links, 20 - below Pages, 25 - below comments, 60 - below first separator, 65 - below Plugins, 70 - below Users, 75 - below Tools, 80 - below Settings, 100 - below second separator', 'wpforo'); ?></p>
                        </th>
						<td>
                        	<input type="number" name="wpforo_general_options[menu_position]" value="<?php if(!isset(WPF()->general_options['menu_position'])) WPF()->general_options['menu_position'] = 23; wpfo(WPF()->general_options['menu_position']); ?>"/>&nbsp;
                        	<a href="https://developer.wordpress.org/reference/functions/add_menu_page/" target="_blank" style="text-decoration:none;"><?php _e('More info', 'wpforo') ?> &raquo;</a>
                        </td>
					</tr>
					<tr>
						<th>
                        	<label for="langid"><?php _e('Forum Language', 'wpforo'); ?></label>
                        	<p class="wpf-info"><?php _e('This option is only related to XML language files. You should upload a translation XML file to have a new language option in this drop-down. If you are using PO/MO translation files you should change WordPress Language in Dashboard > Settings admin page to load according translation for wpForo.', 'wpforo'); ?></p>
                        </th>
						<td>
                        	<select id="langid" name="wpforo_general_options[lang]" style="float:left;">
                        		<?php  WPF()->phrase->show_lang_list() ?>
							</select>
							<h2 style="margin: 0;padding: 0;float: left;"><a href="<?php echo admin_url( 'admin.php?page=wpforo-settings&tab=general&action=newlang' ) ?>" class="add-new-h2"><?php _e('Add New', 'wpforo'); ?></a></h2>
						</td>
					</tr>
                    <?php do_action( 'wpforo_settings_general'); ?>
				</tbody>
			</table>
            <div class="wpforo_settings_foot">
                <input type="submit" class="button button-primary" value="<?php _e('Update Options', 'wpforo'); ?>" />
            </div>
		</form>
	<?php endif ?>
	
	<?php if(isset( $_GET['action'] ) && $_GET['action'] == 'newlang' ): ?>
		<form action="" method="POST" name="add_lang" class="validate" enctype="multipart/form-data" >
        	<?php wp_nonce_field( 'wpforo-settings-language' ); ?>
			<table class="wpforo_settings_table">
				<tbody>
					<tr class="form-field form-required">
						<td>
							<b><label><?php _e('Language XML file', 'wpforo') ?>: </label></b>
						</td>
						<td>
							<input type="file" name="add_lang[xml]" accept="text/xml" />
						</td>
					</tr>
				</tbody>
			</table>
            <div class="wpforo_settings_foot">
                <input type="submit" class="button button-primary" value="<?php _e('Add New Language', 'wpforo'); ?>">
            </div>
		</form>
	<?php endif ?>