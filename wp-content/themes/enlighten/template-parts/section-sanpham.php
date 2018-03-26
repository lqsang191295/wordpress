<?php
$enlighten_sanpham_title = get_theme_mod('enlighten_sanpham_title');
$enlighten_sanpham_category = get_theme_mod('enlighten_sanpham_category');
if($enlighten_sanpham_category){
	$enlighten_sanpham_args = array(
                'post_type' =>'post',
                'cat' => $enlighten_sanpham_category,
                'order' => 'DESC',
                'posts_per_page' => -1
            );
	$enlighten_port_query = new WP_Query($enlighten_sanpham_args);
}
?>

<div class="cb50 cb50v0" data-trackas="cb50">

	<div class="cb50w1 cwidth" data-lbl="hp:more-about-oracle">

		<h2><?php echo $enlighten_sanpham_title ?></h2>

		<ul class="portfolio_slider_wrap">
			<?php 
			if($enlighten_port_query && $enlighten_port_query->have_posts()){
				while($enlighten_port_query->have_posts()){
					$enlighten_port_query->the_post();
                    $enlighten_image_port = wp_get_attachment_image_src(get_post_thumbnail_id(),'enlighten-portfolio-image');
                    $enlighten_image_url = $enlighten_image_port['0'];
                    $enlighten_title = get_the_title();
                    $enlighten_content = get_the_content();
			?>
			<li class="cb50c1">
				<a href="<?php the_permalink(); ?>">
					<img src="<?php echo esc_url($enlighten_image_url); ?>">
					<div class="cb50w2 icn-arrowthn" style="height: 57px;">
					<h3><?php echo $enlighten_title ?></h3>
					</div>
				</a>
				<p>
					<?php echo wp_kses_post(wp_trim_words($enlighten_content,'10','...')); ?>
				</p>
			</li>
			<?php 
				}
			}
			?>
		</ul>
  </div>

</div>