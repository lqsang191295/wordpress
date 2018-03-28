<?php
$enlighten_video_title = get_theme_mod('enlighten_enable_action');
$enlighten_video_title_sub = get_theme_mod('enlighten_client_title_action');

$enlighten_image_1 = get_theme_mod('enlighten_action_image_one');
$enlighten_image_1_1 = get_theme_mod('enlighten_action_image_one_1');
$enlighten_achieve_title_1 = get_theme_mod('enlighten_action_title_one');

$enlighten_image_2 = get_theme_mod('enlighten_action_image_two');
$enlighten_image_2_1 = get_theme_mod('enlighten_action_image_two_1');
$enlighten_achieve_title_2 = get_theme_mod('enlighten_action_title_two');

$enlighten_image_3 = get_theme_mod('enlighten_action_image_three');
$enlighten_image_3_1 = get_theme_mod('enlighten_action_image_three_1');
$enlighten_achieve_title_3 = get_theme_mod('enlighten_action_title_three');

$enlighten_image_4 = get_theme_mod('enlighten_action_image_four');
$enlighten_image_4_1 = get_theme_mod('enlighten_action_image_four_1');
$enlighten_achieve_title_4 = get_theme_mod('enlighten_action_title_four');

$enlighten_image_5 = get_theme_mod('enlighten_action_image_five');
$enlighten_image_5_1 = get_theme_mod('enlighten_action_image_five_1');
$enlighten_achieve_title_5 = get_theme_mod('enlighten_action_title_five');
?>

<div class="fadeInUp animated top-action-main" style="margin-bottom: 5px;">
    <?php
    if($enlighten_video_title || $enlighten_video_title_sub){ ?>
        <!-- <div class="ak-container"> -->
            <div class="effect_title">
            <?php
                if($enlighten_video_title || $enlighten_video_title_sub){
             ?>
                <div class="cn24 cn24v0" data-trackas="cn24">
					<div class="cn24w1 cwidth" style="">
						<div class="cn24w2"><h3><?php echo $enlighten_video_title_sub;?></h3></div>
						<div class="cn24w3" data-lbl="hp:top-actions">
							<ul>
								<li style="width: 20%;" class="top-actions-one">
									<a href="<?php echo(get_site_url() . "/register"); ?>" >
										<div class="icn-img icn-circle bgblue beforewhite cn24hoverinvert">
											<div class="top-actions-img-one">
												
											</div>
										</div>
										<div>
											<span><?php echo($enlighten_achieve_title_1); ?></span>
										</div>
									</a>
								</li>

								<li style="width: 20%;" class="top-actions-two">
									<a href="javascript:void(0)" >
										<div class="icn-img icn-circle bggreen beforewhite cn24hoverinvert">
											<div class="top-actions-img-two">
												
											</div>
										</div>
										<div>
											<span><?php echo($enlighten_achieve_title_2); ?></span>
										</div>
									</a>
								</li>

								<li style="width: 20%;" class="top-actions-three">
									<a href="#" >
										<div class="icn-img icn-circle bgslate beforewhite cn24hoverinvert">
											<div class="top-actions-img-three">
												
											</div>
										</div>
										<div>
											<span><?php echo($enlighten_achieve_title_3); ?></span>
										</div>
									</a>
								</li>

								<li style="width: 20%;" class="top-actions-four">
									<a href="#" >
										<div class="icn-img icn-circle bgburgundy beforewhite cn24hoverinvert">
											<div class="top-actions-img-four">
												
											</div>
										</div>
										<div>
											<span><?php echo($enlighten_achieve_title_4); ?></span>
										</div>
									</a>
								</li>

								<li style="width: 20%;" class="top-actions-five">
									<a href="<?php echo(get_site_url() . "/community"); ?>" >
										<div class="icn-img icn-circle bgorange beforewhite cn24hoverinvert">
											<div class="top-actions-img-five">
												
											</div>
										</div>
										<div>
											<span><?php echo($enlighten_achieve_title_5); ?></span>
										</div>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			<?php } ?>
          </div>
        <!-- </div> -->
    <?php } ?>
</div>

<div class="u02modal u02m-call" id="u02modaltrain"><div class="u02modalw1">
	<div class="u02modalw2"><a id="u02modfpoint" href="#"></a>
		<div class="u02mod u02callmodal">
			<?php 
				echo do_shortcode('[wpforms id="1677"]');
			?>
		</div>
	<a id="u02modal-close" class="u02modaltrain-close" href="javascript:void(0)" ><em>Close</em></a></div>
	<div class="u02modalw3 u02modalw3train" tabindex="0"></div>
	</div>
</div>

<script type="text/javascript">
	(function($) {
		$(document).ready(function(){
			$(".top-actions-two").click(function(){
		    	if(!$("#u02modaltrain").hasClass("u02m-show")){
		    		$("#u02modaltrain").addClass("u02m-show");
		    	}
		    });
		    $(".top-actions-three").click(function(){
		    	if(!$("#u02modaltrain").hasClass("u02m-show")){
		    		$("#u02modaltrain").addClass("u02m-show");
		    	}
		    });
		    $(".top-actions-four").click(function(){
		    	if(!$("#u02modaltrain").hasClass("u02m-show")){
		    		$("#u02modaltrain").addClass("u02m-show");
		    	}
		    });
		    $(".top-actions-five").click(function(){
		    	if(!$("#u02modaltrain").hasClass("u02m-show")){
		    		$("#u02modaltrain").addClass("u02m-show");
		    	}
		    });
		    $(".u02modaltrain-close").click(function(){
		    	if($("#u02modaltrain").hasClass("u02m-show")){
		    		$("#u02modaltrain").removeClass("u02m-show");
		    	}
		    })
			$(".u02modalw3train").click(function(){
				$("#u02modaltrain").removeClass("u02m-show");
			})
		});
	}(jQuery));
</script>

<?php if( function_exists( "get_testimonial_slider_recent" ) ){ get_testimonial_slider_recent( $set="1") ;}?>

<?php
	if(is_single()){
		echo ('<script type="text/javascript">
			jQuery(".top-action-main").css({
				"position": "fixed",
				"width": "100%",
				"z-index": "99999",
				"bottom": "0",
				"margin": "0"
			});
			var u02nav = $(".u02nav").height();
		    jQuery("#primary").css({
				"padding-top": u02nav + "px"
			});
			jQuery("#u02mmenu ul").css({
				"height": "377px"
			})		
		</script>');
	} 
	if($enlighten_image_1){
		echo ('<script type="text/javascript">
			jQuery(".top-actions-img-one").css({
				"content": "url('. $enlighten_image_1 .')"
			});	
			
		</script>');
	}
	if($enlighten_image_1_1){
		echo('<script type="text/javascript">
			jQuery(".top-actions-one").hover(function(){
				jQuery(".top-actions-img-one").css({
					"content": "url('. $enlighten_image_1_1 .')"
				});
			}, function() {
			    jQuery(".top-actions-img-one").css({
					"content": "url('. $enlighten_image_1 .')"
				});	
			});	
		</script>');
	}
	if($enlighten_image_2){
		echo ('<script type="text/javascript">
			jQuery(".top-actions-img-two").css({
				"content": "url('. $enlighten_image_2 .')"
			});	
			
		</script>');
	}
	if($enlighten_image_2_1){
		echo('<script type="text/javascript">
			jQuery(".top-actions-two").hover(function(){
				jQuery(".top-actions-img-two").css({
					"content": "url('. $enlighten_image_2_1 .')"
				});
			}, function() {
			    jQuery(".top-actions-img-two").css({
					"content": "url('. $enlighten_image_2 .')"
				});	
			});	
		</script>');
	}
	if($enlighten_image_3){
		echo ('<script type="text/javascript">
			jQuery(".top-actions-img-three").css({
				"content": "url('. $enlighten_image_3 .')"
			});	
			
		</script>');
	}
	if($enlighten_image_3_1){
		echo('<script type="text/javascript">
			jQuery(".top-actions-three").hover(function(){
				jQuery(".top-actions-img-three").css({
					"content": "url('. $enlighten_image_3_1 .')"
				});
			}, function() {
			    jQuery(".top-actions-img-three").css({
					"content": "url('. $enlighten_image_3 .')"
				});	
			});	
		</script>');
	}
	if($enlighten_image_4){
		echo ('<script type="text/javascript">
			jQuery(".top-actions-img-four").css({
				"content": "url('. $enlighten_image_4 .')"
			});	
			
		</script>');
	}
	if($enlighten_image_4_1){
		echo('<script type="text/javascript">
			jQuery(".top-actions-four").hover(function(){
				jQuery(".top-actions-img-four").css({
					"content": "url('. $enlighten_image_4_1 .')"
				});
			}, function() {
			    jQuery(".top-actions-img-four").css({
					"content": "url('. $enlighten_image_4 .')"
				});	
			});	
		</script>');
	}
	if($enlighten_image_5){
		echo ('<script type="text/javascript">
			jQuery(".top-actions-img-five").css({
				"content": "url('. $enlighten_image_5 .')"
			});	
			
		</script>');
	}
	if($enlighten_image_5_1){
		echo('<script type="text/javascript">
			jQuery(".top-actions-five").hover(function(){
				jQuery(".top-actions-img-five").css({
					"content": "url('. $enlighten_image_5_1 .')"
				});
			}, function() {
			    jQuery(".top-actions-img-five").css({
					"content": "url('. $enlighten_image_5 .')"
				});	
			});	
		</script>');
	}
?>