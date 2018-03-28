<?php
$enlighten_testimonial_title = get_theme_mod('enlighten_testimonial_title');
$enlighten_faq_title = get_theme_mod('enlighten_faq_title');
$enlighten_testimonial_cat = get_theme_mod('enlighten_testimonial_cat');
$enlighten_faq_cat = get_theme_mod('enlighten_faq_cat');
if($enlighten_faq_cat || $enlighten_testimonial_cat){
    $enlighten_test_args = array(
                                    'post_type' => 'post',
                                    'cat' => $enlighten_testimonial_cat,
                                    'order' => 'DESC',
                                );
                                $enlighten_test_query = new WP_Query($enlighten_test_args);
?>
<div class="ak-container">
    <div class="effect_title">
        <div class="section_title">
                <?php if($enlighten_testimonial_title){ ?>
                <span class="title_two wow fadeInUp"><?php echo esc_html($enlighten_testimonial_title); ?>
                </span>
                <?php } ?>
        </div>
    </div>

    <div class="portfolio_slider_wrap"> 
        <?php
            while($enlighten_test_query->have_posts()):
                $enlighten_test_query->the_post();
                $enlighten_image_port = wp_get_attachment_image_src(get_post_thumbnail_id(),'enlighten-portfolio-image');
                $enlighten_image_url = $enlighten_image_port['0'];
                $enlighten_title = get_the_title();
                $enlighten_content = get_the_content();
                ?>
                    <div class="portfolio_slide_loop portfolio_slide_loop_custome wow fadeInUp">
                        <div class="title_content_wrap title_content_wrap_custome">
                            <?php if($enlighten_content){ 
                                $sss = substr( $enlighten_content, 0, strpos( $enlighten_content, ']' ) );
                                $sss = str_replace('[', '', $sss);
                                $sss = str_replace(']', '', $sss);
                                $arrsss = explode('|', $sss);
                            ?>

                            <div class="port_content_wrap wow fadeInUp" style="text-align: justify;">
                                <?php 
                                    echo wp_kses_post(
                                        wp_trim_words( 
                                            substr( $enlighten_content, strpos( $enlighten_content, ']' ) + 1, strlen($enlighten_content)), '90', '...'
                                        )
                                    ); 
                                ?>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="guess-info clearfix" style="padding: 20px;">
                            <div class="ava-guess">
                                <img class="ava-guess-img" src="<?php echo esc_url($enlighten_image_url); ?>"     
                                />
                            </div>
                            <?php 
                                $arrClass = array("guess-name", "guess-job", "guess-info");
                                foreach($arrsss as $key => $data) {
                            ?>
                                <span class="<?php echo $arrClass[$key]?>">
                                    <?php echo $data; ?>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                <?php
            endwhile;
            wp_reset_postdata();
        ?> 
    </div>
    
<?php } ?>