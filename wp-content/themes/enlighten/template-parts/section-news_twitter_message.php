


<?php
$enlighten_news_title = get_theme_mod('enlighten_news_title');
$enlighten_news_cat = get_theme_mod('enlighten_news_post_cat');
$enlighten_message_author = get_theme_mod('enlighten_message_aurhot');
$enlighten_message_author_designation = get_theme_mod('enlighten_message_aurhot_designation');
?>
<div class="ak-container">
    <div class="section_title">
                              <!---->
        <a href="#" class="title_two wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
            <?php echo $enlighten_news_title; ?>
        </a>
    </div>
    <?php 
    echo do_shortcode("[recent_post_slider category=\"39, 61\" design=\"design-2\" 
        content_words_limit=\"100\" ]");
    ?>
    <div>
        <span>Thành tựu</span>
        <?php 
            echo do_shortcode('[th-slider design="design-2" dots="false"]');
        ?>
    </div>
</div>

