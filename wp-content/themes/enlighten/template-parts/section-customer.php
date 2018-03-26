<?php
$enlighten_enable_customer = get_theme_mod('enlighten_enable_customer');
$enlighten_customer_title = get_theme_mod('enlighten_customer_title');
$enlighten_customer_cat = get_theme_mod('enlighten_customer_cat');
if($enlighten_enable_customer){
if($enlighten_customer_title || $enlighten_customer_cat){
    ?>
        <div class="ak-container">
            <div class="client_wrap">
                <?php
                if($enlighten_customer_title){
                    ?>
                    <div class="effect_title">
                        <div class="section_title">
                              <!--<?php if($enlighten_section_title){ ?>
                                <span class="title_one wow fadeInUp"><?php echo esc_html($enlighten_section_title); ?></span>
                                <?php } ?>-->
                                <?php if($enlighten_customer_title){ ?>
                                <span class="title_two wow fadeInUp"><?php echo esc_html($enlighten_customer_title); ?></span>
                                <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if($enlighten_customer_cat){ ?>
                    <div class="client_cat_loop wow fadeInUp">
                        <?php
                            $enlighten_client_args = array(
                                'post_type' => 'post',
                                'cat' => $enlighten_customer_cat,
                                'order' => 'DESC',
                                'posts_per_page' => -1,
                            );
                            $enlighten_client_query = new WP_Query($enlighten_client_args);
                            if($enlighten_client_query->have_posts()):
                                while($enlighten_client_query->have_posts()):
                                $enlighten_client_query->the_post();
                                $enlighten_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'enlighten-client-section');
                                $enlighten_image_url = $enlighten_image['0'];
                                if($enlighten_image_url){
                                    ?>
                                        <div class="client_image">
                                            <img src="<?php echo esc_url($enlighten_image_url); ?>" alt="<?php the_title(); ?>" />
                                        </div>
                                    <?php
                                    }
                                endwhile;
                                wp_reset_postdata();
                            endif;
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php
}
}