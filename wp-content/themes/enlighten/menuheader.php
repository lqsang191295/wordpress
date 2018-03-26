<nav class="u02nav">
<div class="u02 u02dtop" id="u02">

	<div id="u02skip2content" data-skiptxtprepend="Skip" data-skiptxtappend="">
		<ul>
			<li><a href="/">Home</a></li>
			<li><a id="u02skip2c" href="#maincontent">Skip to Content</a></li>
			<li><a id="u02skip2s" href="#skip_to_search_form">Skip to Search</a></li>
		</ul>
	</div>

	<div class="u02w1">

		<!-- logo -->
		<a href="<?php echo get_home_url(); ?>">
			<div class="u02logo" data-trackas="header">
				<div class="u02logow1"></div>
			</div>
		</a>
		<a id="mobisearch" href="#search" class=""><span>Skip to Search</span><i class="u02i1"></i><i class="u02i2"></i></a>
		<!-- menu -->
		<div class="u02menu" data-trackas="menu">
			<div id="u02main" class="u02mlink u02haml">
				<div class="u02mlinkw1">
					<a href="javascript:void(0)" id="u02menulink" data-lbl="menu"><div class="u02hamenu"><span class="m1"></span><span class="m2"></span><span class="m3"></span><span class="m4"></span></div>
						<div class="u02mlinkw2">Menu</div>
					</a>
				</div>
				<!-- LVL 1 -->
		<div class="u02mainmenu u02mheight" id="u02mmenu">
			<div class="u02menu-l1 u02menuwrap u02mheight">
				<div class="u02menu-l1z1">
				<i></i>
			</div>

			<ul style="height: 450px;">
				<!-- ############## DOWNLOADS ##############-->
			<?php 
				$menu_name = 'primary';

				if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) )
				{
					$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

					$menu_items = wp_get_nav_menu_items($menu->term_id);

					$post_id        = $menu->parent;

					$parent_item = wp_filter_object_list( $menu_items, array( 'menu_item_parent' => $post_id ));
					$child_items = wp_filter_object_list( $menu_items, array( 'menu_item_parent' => $post_id ), 'not');
					if(!empty($parent_item) && isset($parent_item)){
						foreach ( (array) $parent_item as $key => $menu_item ) {
							$title = $menu_item->title;
						    $url = $menu_item->url;
						    $parent_id = $menu_item->ID;
						    $child_item_data =  $child_items = wp_filter_object_list( $menu_items, array( 'menu_item_parent' => $parent_id ));
			?>	
				<li class="u02menu-hasm u02menu-li-first">
					<a class="u02tlink test_thu_xem_sao" href="<?php echo($url); ?>" >
						<?php echo($title); ?>
					</a>
					<div class="u02menu-hasm-div test_thu_xem_sao_1">
						<a class="u02tlink" href="<?php echo($url); ?>" >
							<?php echo($title); ?>
						</a>
						<?php 
							if(!empty($child_item_data) && isset($child_item_data)){
						?>
							<span class="u02menu-span">></span>
						<?php
							}
						?>
					</div>
					<!-- LVL 2 -->
					<?php 
					if(!empty($child_item_data) && isset($child_item_data)){
					?> 
					<div class="u02menu-l2 u02menuwrap u02mheight" style="height: 450px;">
						<ul style="height: 450px;">
							<li class="u02menuback u02nosub">
								<a class="u02blink" href="javascript:void(0)" style="color: #14354b;">
									<?php echo($title)?>
								</a>
							</li>
						<?php 
					    	foreach ( (array) $child_item_data as $key => $child_it ) {
						    	$title_it = $child_it->title;
						    	$url_it = $child_it->url;
						    	$id_it = $child_it->ID;
						    	$c_child_item_data = wp_filter_object_list( $menu_items, array( 'menu_item_parent' => $id_it ));
						?>
							<li class="u02menu-hasm">
								<a class="u02xlink test_thu_xem_sao" href="<?php echo($url_it); ?>" >
									<?php echo($title_it); ?>
								</a>
								<div class="u02menu-hasm-div test_thu_xem_sao_1">
									<a href="<?php echo($url_it) ?>" class="u02xlink">
										<?php echo($title_it) ?>
									</a>
									<?php 
									if(!empty($c_child_item_data) && isset($c_child_item_data))
										{
									?>
									<span class="u03menu-span">></span>
									<?php 
										}
									?>
								</div>
								<!-- LVL 3 -->
								<?php 
									if(!empty($c_child_item_data) && isset($c_child_item_data))
									{
								?>
								<div class="u02menu-l3 u02menuwrap u02mheight" style="height: 450px;">
									<ul style="height: 450px;">
										<li class="u02menuback u02nosub">
											<a class="u02blink" href="javascript:void(0)">
												<?php echo($title_it) ?>
											</a>
										</li>
										<?php 
									    	foreach ( (array) $c_child_item_data as $key => $c_child_it ) 
									    	{
										    	$c_title_it = $c_child_it->title;
										    	$c_url_it = $c_child_it->url;
										?>
										<li class="u02nosub">
											<a href="<?php echo($c_url_it) ?>" class="u02xlink">
												<?php 
													echo($c_title_it);
												?>
											</a>
										</li>
										<?php
											}
										?>
									</ul>
									<div class="u02z86d" style="display: none;"></div>
								</div>
								<?php 
									} 
								?>
								<!-- / LVL 3 -->
							</li>
							<?php 
							}
						?>
						</ul>
					</div>
					<?php } ?>
					<!-- / LVL 2 -->
				</li>
			<?php
						}
					}
				}
			?>
				<!-- ############## EVENTS ##############-->
			</ul>
			<div class="u02z86d" style="display: none;"></div></div>
		</div>
		</div>
		</div>

		<!-- search -->
		<div id="u02search" class="u02search" data-trackas="header">
			<?php 
				echo(get_search_form_custome(true));
			?>
		</div>


		<div class="u02tools u02li1" data-trackas="header" id="heardermenumobi">
			<ul>
				<!-- user tools -->
				<li class="u02mtool u02toolsloggedout">
					<a href="<?php echo get_home_url() . "/community" ?>" class="u02ticon u02question u02user">
						<span class="u02signin">Q & A</span>
					</a>
					
					<!--<div class="u02user u02toolpop u02init" data-lbl="profile"><i></i>
						<div class="u02userin"><h5 class="u02pttl u02userloggedin">Account</h5>
							
							<div class="u02userinw1 u02userloggedout" data-lbl="oracle-account">
								<h5>SureHCS</h5>
								<p>Manage your account and access personalized content.</p>
								<a href="<?php echo get_home_url() . "/login" ?>" id="u02pfile-regs"  class="u02bttn">Sign In</a>
								<ul id="u02usertools">
									<li>
										<a href="<?php echo get_home_url() . "/register" ?>">
											Create an account
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div> -->

				</li>

				<li class="u02mtool u02mtoolflag" id="u02cmenuflag">
					<a class="u02mflag" href="javascript:void(0)">
						<img src="<?php echo get_home_url() . "/wp-content/uploads/2018/03/vietnam.png" ?> "/>
					</a>
				</li>
				<li class="u02mtool u02mtoolflag" id="u02cmenuflag">
					<a class="u02mflag" href="javascript:void(0)">
						<img src="<?php echo get_home_url() . "/wp-content/uploads/2018/03/united-states.png" ?> "/>
					</a>
				</li>
				<li class="u02mtool u02mtoolflag" id="u02cmenuflag">
					<a class="u02mflag" href="javascript:void(0)">
						<img src="<?php echo get_home_url() . "/wp-content/uploads/2018/03/south-korea.png" ?> "/>
					</a>
				</li>
				<li class="u02mtool u02mtoolflag" id="u02cmenuflag">
					<a class="u02mflag" href="javascript:void(0)">
						<img src="<?php echo get_home_url() . "/wp-content/uploads/2018/03/japan.png" ?> "/>
					</a>
				</li>
				<li class="u02mtool u02mtoolflag" id="u02cmenuflag">
					<a class="u02mflag" href="javascript:void(0)">
						<img src="<?php echo get_home_url() . "/wp-content/uploads/2018/03/china.png" ?> "/>
					</a>
				</li>
				<li class="u02mtool u02mtoolglobal" id="u02cmenuglobal">
					<a class="u02mflag u02mflagglobal" href="javascript:void(0)">
						<!--<img src="<?php echo get_home_url() . "/wp-content/uploads/2018/03/world.png" ?> "/>-->
					</a>
					<div class="u02user u02toolpop u02init" data-lbl="profile"><i></i>
						<span>
							<a class="u02mflag" href="javascript:void(0)">
								<img src="<?php echo get_home_url() . "/wp-content/uploads/2018/03/vietnam.png" ?> "/>
							</a>
						</span>
						<span>
							<a class="u02mflag" href="javascript:void(0)">
								<img src="<?php echo get_home_url() . "/wp-content/uploads/2018/03/united-states.png" ?> "/>
							</a>
						</span>
						<span>
							<a class="u02mflag" href="javascript:void(0)">
								<img src="<?php echo get_home_url() . "/wp-content/uploads/2018/03/south-korea.png" ?> "/>
							</a>
						</span>
						<span>
							<a class="u02mflag" href="javascript:void(0)">
								<img src="<?php echo get_home_url() . "/wp-content/uploads/2018/03/japan.png" ?> "/>
							</a>
						</span>
						<span>
							<a class="u02mflag" href="javascript:void(0)">
								<img src="<?php echo get_home_url() . "/wp-content/uploads/2018/03/china.png" ?> "/>
							</a>
						</span>
					</div>
				</li>
				<!-- country select -->
				<!--<li class="u02mtool" id="u02cmenu">
					<a href="#u02countrymenu" class="u02ticon u02regn"><span>Country/Region</span></a>
					<div class="u02cmenupop u02toolpop"><i></i>
					</div>
				</li> -->
				<!-- call -->
				<li class="u02mbttn" id="u02call">
					<a data-lbl="call" href="javascript:void(0)" class="u02ticon u02call o-call"><span>Call</span></a>
				</li>
				<!-- chat -->
				<!--<li class="u02mbttn" id="u02chat">
					<a data-lbl="chat" href="#chat" class="u02ticon u02chat"><span>Chat</span></a>
				</li>-->
			</ul>
		</div>
	</div>
	<a id="maincontent">&nbsp;</a>
</div>
</nav>

<div class="u02modal u02m-call" id="u02modal"><div class="u02modalw1"><div class="u02modalw2"><a id="u02modfpoint" href="#"></a>
		<div class="u02mod u02callmodal">

			<div class="u02modw1">
				<h4>Contact SureHCS</h4>
				<div class="icn-img icn-circle icn-telephone bgblue">&nbsp;</div>
				<div class="u02modw2" id="o-contact-widget">US Sales: <a href="#" data-lbl="us-sales-18006330738">+1.800.633.0738</a></div>
				<a data-lbl="contact-oracle:general-contact-info" href="/corporate/contact/index.html" class="u02modlink">General Contact Info</a><br>
				<a data-lbl="contact-oracle:global-contacts" href="/corporate/contact/global.html" class="u02modlink">Global Contacts</a>
			</div>

		</div>
	<a id="u02modal-close" href="javascript:void(0)" ><em>Close</em></a></div><div class="u02modalw3" tabindex="0"></div></div>
</div>

<div class="u02modal u02m-call" id="u02modalflag"><div class="u02modalw1"><div class="u02modalw2"><a id="u02modfpoint" href="#"></a>
		<div class="u02mod u02callmodal">
			<span>
				<a class="u02mflag" href="javascript:void(0)">
					<img src="<?php echo get_home_url() . "/wp-content/uploads/2018/03/vietnam.png" ?> "/>
				</a>
			</span>
			<span>
				<a class="u02mflag" href="javascript:void(0)">
					<img src="<?php echo get_home_url() . "/wp-content/uploads/2018/03/united-states.png" ?> "/>
				</a>
			</span>
			<span>
				<a class="u02mflag" href="javascript:void(0)">
					<img src="<?php echo get_home_url() . "/wp-content/uploads/2018/03/south-korea.png" ?> "/>
				</a>
			</span>
			<span>
				<a class="u02mflag" href="javascript:void(0)">
					<img src="<?php echo get_home_url() . "/wp-content/uploads/2018/03/japan.png" ?> "/>
				</a>
			</span>
			<span>
				<a class="u02mflag" href="javascript:void(0)">
					<img src="<?php echo get_home_url() . "/wp-content/uploads/2018/03/china.png" ?> "/>
				</a>
			</span>
		</div>
	<a id="u02modal-close" href="javascript:void(0)" ><em>Close</em></a></div><div class="u02modalw3" tabindex="0"></div></div>
</div>

<?php 
	if(is_home() || is_front_page()){
		echo do_shortcode('[smartslider3 slider=4]');
	}
?>


<?php 
	//echo do_shortcode("[mi-testimonial id =97396453]");
?>

<script type="text/javascript">
	(function($) {
		$(document).ready(function(){
			var $window = $(window),
		        $html = $('html');
		    var isClick = true;
		    
		    

		    $window.resize(function resize(){
		        var width = $(window).width();
				if(width < 770){
					if(!$("#u02").hasClass("u02mobi")){
		    			$("#u02").addClass("u02mobi");
		    		}
		    		if($("#u02").hasClass("u02dtop")){
		    			$("#u02").removeClass("u02dtop");
		    		}
				} else {
					if($("#u02").hasClass("u02mobi")){
		    			$("#u02").removeClass("u02mobi");
		    		}
		    		if(!$("#u02").hasClass("u02dtop")){
		    			$("#u02").addClass("u02dtop");
		    		}
		    		if(width > 1100){
			    		setTimeout(function(){
							var height = $(window).height();
					   		$(".n2-grab").height(height - 115 - 80 - 2);
					    }, 500);
			    	}
				}
		    }).trigger('resize');
			
			//// Hover menu
			
		    $("div.u02menu").mouseover(function(){
		    	width = $(window).width();
		    	if(width > 770){
			    	if(!$("#u02main").hasClass("u02opened")){
				      	$("#u02main").addClass("u02opened");
				    }
				}
		    })
		    .mouseout(function(){
		    	if(!$($(this)[0]).is(":hover")){
			    	if($("#u02main").hasClass("u02opened")){
				      	$("#u02main").removeClass("u02opened");
				    }
				}
		    });
			
		    //// 
		    
		    $("#mobisearch").click(function(){
		    	width = $(window).width();
		    	if(width <= 600){
		    		if($("#mobisearch").hasClass("u02searchpop")){
		    			$("#mobisearch").removeClass("u02searchpop");
		    			$("#u02search").removeClass("u02searchpop");
		    		}else{
		    			$("#mobisearch").addClass("u02searchpop");
		    			$("#u02search").addClass("u02searchpop");
		    		}
		    	}
		    });

		    ////

		    $("#u02menulink").click(function(){
		    	width = $(window).width();
		    	var height = $(window).height();
		    	if(width <= 770){
		    		if($("#heardermenumobi").hasClass("u02mobiotools")){
		    			$("#heardermenumobi").removeClass("u02mobiotools");
		    		}else{
		    			$("#heardermenumobi").addClass("u02mobiotools");
		    			$($("#heardermenumobi ul")[0]).css({
		    				"margin-left": 0
		    			})
		    			$($("#u02mmenu ul")[0]).css({
		    				"margin-left": 0
		    			})
		    		}

		    		if($("#u02main").hasClass("u02mobio")){
		    			$("#u02main").removeClass("u02mobio");
		    		}else{
		    			$("#u02main").addClass("u02mobio");
		    		}

		    		if($("#u02main").hasClass("u02opened")){
		    			$("#u02main").removeClass("u02opened");
		    		}else{
		    			//$("#u02main").addClass("u02opened");
		    		}

		    		$("#u02mmenu").css({
		    			"height": height
		    		})

		    		// Bỏ class khi click vào item li level 1 -> level 2 
		    		// để chuyển lại thành menu level 1
		    		if($("#u02mmenu").hasClass("u02l2open")){
						$("#u02mmenu").removeClass("u02l2open");
					}
					if($("#u02mmenu").hasClass("u02l3open")){
						$("#u02mmenu").removeClass("u02l3open");
					}
					
					$n = $("#u02mmenu ul li").length;
					if($n > 0){
						for($i = 0; $i < $n; $i++){
							if($($("#u02mmenu ul li")[$i]).hasClass("u02menu-hasopen")){
								$($("#u02mmenu ul li")[$i]).removeClass("u02menu-hasopen");
							}
						}
					}
		    	}
		    });

		    ////
		    $(".u02menu-l1 ul li span.u02menu-span").click(function(e) 
		    { 
				if(!$("#u02mmenu").hasClass("u02l2open")){
					$("#u02mmenu").addClass("u02l2open");
				}

				var li_parent, div_parent;

				div_parent = $(this).parent();

				if(div_parent){
					li_parent = $(div_parent).parent();
				}

				$n = $("#u02mmenu ul li").length;
				if($n > 0){
					for($i = 0; $i < $n; $i++){
						if($($("#u02mmenu ul li")[$i]).hasClass("u02menu-hasopen")){
							$($("#u02mmenu ul li")[$i]).removeClass("u02menu-hasopen");
						}
					}
				}
				if(li_parent && !$(li_parent).hasClass("u02menu-hasopen")){
					$(li_parent).addClass("u02menu-hasopen");
				}
		    });

		    $(".u02menu-l2 ul li span").click(function(e) 
		    { 
				if(!$("#u02mmenu").hasClass("u02l3open")){
					$("#u02mmenu").addClass("u02l3open");
				}

				var li_parent, div_parent;

				div_parent = $(this).parent();

				if(div_parent){
					li_parent = $(div_parent).parent();
				}

				if(li_parent && !$(li_parent).hasClass("u02menu-hasopen")){
					$(li_parent).addClass("u02menu-hasopen");
				}
		    });

		    ////
		    $(".u02menu-l2 .u02menuback").click(function(){
				if($("#u02mmenu").hasClass("u02l3open")){
					$("#u02mmenu").removeClass("u02l3open");
				} else {
					if($("#u02mmenu").hasClass("u02l2open")){
						$("#u02mmenu").removeClass("u02l2open");
					}
				}
		    })

		    ////
		    $("#u02call a.u02call").click(function(){
		    	if(!$("#u02modal").hasClass("u02m-show")){
		    		$("#u02modal").addClass("u02m-show");
		    	}
		    })
		    $("#u02modal-close").click(function(){
				if($("#u02modal").hasClass("u02m-show")){
		    		$("#u02modal").removeClass("u02m-show");
		    	}
		    })

		    window.onclick = function(event) {
		    	var modal = document.getElementsByClassName('u02modalw3');
		    	var modal1 = document.getElementById('u02modal');
			    if(event.target == modal[0]){
			    	modal1.classList.remove("u02m-show");
			    }
			}
			/*$(".u02toolsloggedout").mouseover(function(){
		    	if(!$(".u02toolsloggedout").hasClass("u02toolopen")){
			      	$(".u02toolsloggedout").addClass("u02toolopen")
			    }
		    })
		    .mouseout(function(){
		    	if($(".u02toolsloggedout").hasClass("u02toolopen")){
			      	$(".u02toolsloggedout").removeClass("u02toolopen")
			    }
		    });*/

		    ///
		    /*$("#u02cmenuglobal").click(function(){
		    	if(!$("#u02modalflag").hasClass("u02m-show")){
		    		$("#u02modalflag").addClass("u02m-show");
		    	}
		    })
		    $("#u02modal-close").click(function(){
				if($("#u02modalflag").hasClass("u02m-show")){
		    		$("#u02modalflag").removeClass("u02m-show");
		    	}
		    })*/
		    $("#u02cmenuglobal").mouseover(function(){
		    	width = $(window).width();
		    	if(width > 770){
			    	if(!$(".u02mtoolglobal").hasClass("u02toolopen")){
				      	$(".u02mtoolglobal").addClass("u02toolopen")
				    }
				}
		    })
		    .mouseout(function(){
		    	width = $(window).width();
		    	if(width > 770){
			    	if($(".u02mtoolglobal").hasClass("u02toolopen")){
				      	$(".u02mtoolglobal").removeClass("u02toolopen")
				    }
				}
		    });
		    $("#u02cmenuglobal").click(function(){
		    	width = $(window).width();
		    	if(width <= 770){
			    	if(!$(".u02mtoolglobal").hasClass("u02toolopen")){
				      	$(".u02mtoolglobal").addClass("u02toolopen")
				    }else {
				    	$(".u02mtoolglobal").removeClass("u02toolopen")
				    }
				}
		    })
		});
	}(jQuery));
</script>
