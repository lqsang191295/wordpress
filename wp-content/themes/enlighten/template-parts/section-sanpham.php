<?php 
	$enlighten_enable_sanpham = get_theme_mod('enlighten_enable_sanpham');
	if($enlighten_enable_sanpham){
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
            if($enlighten_port_query->have_posts()){
?>
<div class="hp11w2 hp11default previouspanel">
	<div class="hp11w3">
		<div class="hp11w4">
			<div class="section_title">
                <span class="title_two wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">	<?php echo $enlighten_sanpham_title ?>
                </span>
            </div>
			<ul class="portfolio_slider_wrap">
				<?php 
					while($enlighten_port_query->have_posts()):
						$enlighten_port_query->the_post();
                        $enlighten_image_port = wp_get_attachment_image_src(get_post_thumbnail_id(), 'the_post_thumbnail(\'full\');');
                        $enlighten_image_url = $enlighten_image_port['0'];
                        $enlighten_title = get_the_title();
                        $enlighten_content = get_the_content();
				?>
				<li>
					<a href="#" class="icn-cvthn-right beforewhite"> 
					<div class="hp11w5 o-bgimg" style="background-image: url(&quot;<?php echo $enlighten_image_url;?>&quot;);">&nbsp;</div>
						<div class="hp11w6">
						</div>
						<div class="hp11w7">
							<h4><?php echo $enlighten_title ?></h4>
							<h3>
								<?php echo wp_kses_post(wp_trim_words($enlighten_content,'13','...')); ?>
							</h3>
							<div class="hp11Video"></div>
							<div class="hp11w8">
							<hr>
							<span>Leverages Oracle Mobile Cloud Service to serve millions of customers. </span>
							<p></p><div class="hp11GoBtn">Watch the video</div><p></p>
							</div>
						</div>
					</a>
				</li>
				<?php 
					endwhile;
                    wp_reset_postdata();
				?>
			</ul>
		</div>
	</div>
</div>

<?php 
		}
	}
}
?>