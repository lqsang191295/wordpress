<?php
function enlighten_dynamic_styles(){
    $custom_css = '';
    $header_image = get_header_image();;
    if($header_image){
        
        $custom_css .= "
        .header-banner-container{
            background-image: url({$header_image});
            background-repeat: no-repeat;
        }";
    }
    else{
        $header_img = esc_url(get_template_directory_uri(). '/images/banner.JPG');
        $custom_css .= "
        .header-banner-container{
            background-image: url({$header_img});
            background-repeat: no-repeat;
        }";
    }

    $enlighten_service_bg_image = get_theme_mod('enlighten_service_bg_image');
    if($enlighten_service_bg_image){
        $custom_css .= "
        #section_service{
            background-image: url({$enlighten_service_bg_image}); ?>);
            background-repeat: no-repeat;
        }";
    }

    $primary_color = get_theme_mod( 'enlighten_primary_color', '#2D7FC7' );
    $primary_color_dim = enlighten_colourBrightness($primary_color, 0.4);
    $primary_color_less_dim = enlighten_colourBrightness($primary_color, 0.2);
    $primary_rgb = enlighten_lite_hex2rgb($primary_color);

    $secondary_color = get_theme_mod( 'enlighten_secondary_color', '#2D7FC7' );

    /**
     * Primary Color Settings 
     */
        /** Color **/
            $custom_css .= "
                .title_two,
                .portfolio_slider_wrap .anchor_title_wrap a:hover,
                #section_achieve .bg_achieve .wrap_counter .counter_count,
                #section_faq_testimonial .faq_wrap .faq_title,
                #section_faq_testimonial .test_wrap .title_test,
                #section_cta .button_cta a:hover,
                .entry-footer a:hover, .entry-footer a:focus, .entry-footer a:active,
                ul#follow_us_contacts li a:hover i,
                .rn_title a:hover {
                    color: {$primary_color};
                }";

            /** (0.8) Dim Color **/
                $custom_css .= "
                    .widget ul li:hover:after, .widget ul li a:hover,
                    #secondary .footer_RN_wrap .tn_title a:hover,
                    #primary .entry-title a:hover,
                    .contact-info-wrap ul li a:hover{
                        color: rgba({$primary_rgb[0]}, {$primary_rgb[1]}, {$primary_rgb[2]}, 0.8);
                    }";

        /** Background **/
            $custom_css .= "
                .main-navigation,
                .main-navigation.top ul ul,
                #section_service .service_slider.owl-carousel,
                .wrap_video .video_wrap .play-pause-video,
                #section_cta,
                .recent_news .rn_title_content .ln_date,
                #section_news_twitter_message .twitter_wrap,
                .faq_dot:before,
                .main-navigation ul ul.sub-menu > li > a,
                .search-form:before,
                #secondary h2.widget-title:before,
                .nav-links a,
                .contact-form-wrap form input[type=\"submit\"] {
                    background: {$primary_color};
                }";

            /** (0.4) Less Dim Color **/
                $custom_css .= "
                    .service_slider .content_wrap .title_content_service{
                        color: {$primary_color_less_dim};
                    }";

            /** (0.2) Dim Color **/
                $custom_css .= "
                    .service_slider.owl-carousel .owl-controls .owl-nav div{
                        color: {$primary_color_less_dim};
                    }";

            /** (0.2) Dim Background **/
                $custom_css .= "
                    .service_slider .content_wrap:after{
                        background: {$primary_color_dim};
                    }";

            /** (0.2) Dim Border **/
                $custom_css .= "
                    .service_slider.owl-carousel:before,
                    #section_cta .title_section_cta,
                    .twitter_wrap .aptf-single-tweet-wrapper{
                        border-color: {$primary_color_dim};
                    }";

            /** (0.65) Transparent Background **/
                $custom_css .= "
                    #section_news_twitter_message .recent_news .rn_content_loop .rn_image,
                    .contact-form-wrap form input[type=\"submit\"]:hover,
                    #section_news_twitter_message .recent_news .rn_content_loop .rn_image:hover span{
                        background: rgba({$primary_rgb[0]}, {$primary_rgb[1]}, {$primary_rgb[2]}, 0.65);
                    }";

            /** (0.8) Transparent Background **/
                $custom_css .= "
                    .main-navigation ul ul li,
                    .main-navigation ul ul ul li{
                        background: rgba({$primary_rgb[0]}, {$primary_rgb[1]}, {$primary_rgb[2]}, 0.8);
                    }";

        /** Border **/
            $custom_css .= "
                .portfolio_slider_wrap.owl-carousel .owl-controls .owl-dot.active span,
                .portfolio_slider_wrap.owl-carousel .owl-controls .owl-dot span:hover,
                #section_faq_testimonial .faq_cat_wrap .bx-wrapper .bx-pager.bx-default-pager a:hover,
                #section_faq_testimonial .faq_cat_wrap .bx-wrapper .bx-pager.bx-default-pager a.active,
                #secondary .search-form .search-submit,
                #primary .error-404.not-found .search-form .search-submit,
                .not-found .search-form .search-submit,
                .site-footer .widget_search .search-submit,
                ul#follow_us_contacts li a:hover i {
                    border-color: {$primary_color};
                }";

    /**
     * Secondary Color Settings
     */
        /** Background **/
            $custom_css .= "
                #section_news_slide,
                #section_faq_testimonial .test_faq_wrap .faq_question.expanded .plus_minus_wrap,
                #section_faq_testimonial .test_faq_wrap .faq_question.expanded .plus_minus_wrap:before,
                #section_news_twitter_message .recent_news .rn_title,
                #section_news_twitter_message .messag_wrap .rn_title{
                    background: {$secondary_color};
                }";


    wp_add_inline_style( 'enlighten-style', $custom_css );

}
add_action( 'wp_enqueue_scripts', 'enlighten_dynamic_styles' );

function enlighten_lite_hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgb = array($r, $g, $b);
    //return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}

function enlighten_colourBrightness($hex, $percent) {
    // Work out if hash given
    $hash = '';
    if (stristr($hex, '#')) {
        $hex = str_replace('#', '', $hex);
        $hash = '#';
    }
    /// HEX TO RGB
    $rgb = array(hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));
    //// CALCULATE 
    for ($i = 0; $i < 3; $i++) {
        // See if brighter or darker
        if ($percent > 0) {
            // Lighter
            $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
        } else {
            // Darker
            $positivePercent = $percent - ($percent * 2);
            $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
        }
        // In case rounding up causes us to go to 256
        if ($rgb[$i] > 255) {
            $rgb[$i] = 255;
        }
    }
    //// RBG to Hex
    $hex = '';
    for ($i = 0; $i < 3; $i++) {
        // Convert the decimal digit to hex
        $hexDigit = dechex($rgb[$i]);
        // Add a leading zero if necessary
        if (strlen($hexDigit) == 1) {
            $hexDigit = "0" . $hexDigit;
        }
        // Append to the hex string
        $hex .= $hexDigit;
    }
    return $hash . $hex;
}