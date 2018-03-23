<?php
	// Exit if accessed directly
	if( !defined( 'ABSPATH' ) ) exit;
?>


<?php do_action( 'wpforo_footer_hook' ) ?>

<!-- forum statistic -->
	<div class="wpf-clear"></div>
   
	<div id="wpforo-footer">
    	<?php do_action( 'wpforo_stat_bar_start', WPF() ); ?>
     	<?php if( wpforo_feature('footer-stat') ): ?>
            <div id="wpforo-stat-header">
                <i class="far fa-chart-bar"></i>&nbsp; <span><?php wpforo_phrase('Forum Statistics') ?></span>
            </div>
            <div id="wpforo-stat-body">
                <?php $stat = WPF()->statistic();  ?>
                <div class="wpforo-stat-table">
                    <div class="wpf-row wpf-stat-data">
                        <div class="wpf-stat-item">
                            <i class="fas fa-comments"></i>
                            <span class="wpf-stat-value"><?php echo wpforo_print_number($stat['forums']) ?></span>
                            <span class="wpf-stat-label"><?php wpforo_phrase('Forums') ?></span>
                        </div>
                        <div class="wpf-stat-item">
                            <i class="fas fa-file-alt"></i>
                            <span class="wpf-stat-value"><?php echo wpforo_print_number($stat['topics']) ?></span>
                            <span class="wpf-stat-label"><?php wpforo_phrase('Topics') ?></span>
                        </div>
                        <div class="wpf-stat-item"> 
                            <i class="fas fa-reply fa-rotate-180"></i>
                            <span class="wpf-stat-value"><?php echo wpforo_print_number($stat['posts']) ?></span>
                            <span class="wpf-stat-label"><?php wpforo_phrase('Posts') ?></span>
                        </div>
                        <div class="wpf-stat-item">
                            <i class="far fa-lightbulb"></i>
                            <span class="wpf-stat-value"><?php echo wpforo_print_number($stat['online_members_count']) ?></span>
                            <span class="wpf-stat-label"><?php wpforo_phrase('Online') ?></span>
                        </div>
                        <div class="wpf-stat-item">
                            <i class="fas fa-user"></i>
                            <span class="wpf-stat-value"><?php echo wpforo_print_number($stat['members']) ?></span>
                            <span class="wpf-stat-label"><?php wpforo_phrase('Members') ?></span>
                        </div>
                    </div>
                    <div class="wpf-row wpf-last-info">
                    	<?php if(isset($stat['last_post_title']) && $stat['last_post_title']): ?>
                        <p class="wpf-stat-other">
                            <?php if( isset($stat['posts']) && $stat['posts'] ): ?><span ><i class="fas fa-pencil-alt"></i> <?php wpforo_phrase('Latest Post') ?>: <a href="<?php echo esc_url($stat['last_post_url']) ?>"><?php echo esc_html($stat['last_post_title']) ?></a></span><?php endif; ?>
                            <span><i class="fas fa-user-plus"></i> <?php wpforo_phrase('Our newest member') ?>: <a href="<?php echo esc_url($stat['newest_member_profile_url']) ?>"><?php echo esc_html($stat['newest_member_dname']) ?></a></span>
                        	<?php if( isset($stat['posts']) && $stat['posts'] ): ?><span class="wpf-stat-recent-posts"><i class="fas fa-list-ul"></i> <a href="<?php echo esc_url(wpforo_home_url('recent')) ?>"><?php wpforo_phrase('Recent Posts') ?></a></span><?php endif; ?>
                        </p>
                        <?php endif; ?>
                        <p class="wpf-topic-icons">
                        	<span class="wpf-stat-label"><?php wpforo_phrase('Topic Icons') ?>:</span>
                            <span><i class="far fa-file wpfcl-2"></i> <?php wpforo_phrase('New') ?></span>
                            <span><i class="far fa-file-alt wpfcl-2"></i> <?php wpforo_phrase('Replied') ?></span>
                            <span><i class="fas fa-file-alt wpfcl-2"></i> <?php wpforo_phrase('Active') ?></span>
                            <span><i class="fas fa-file-alt wpfcl-5"></i> <?php wpforo_phrase('Hot') ?></span>
                            <span><i class="fas fa-thumbtack wpfcl-5"></i> <?php wpforo_phrase('Sticky') ?></span>
                            <span><i class="fas fa-exclamation-circle wpfcl-5"></i> <?php wpforo_phrase('Unapproved') ?></span>
                            <span><i class="fas fa-check-circle wpfcl-8"></i> <?php wpforo_phrase('Solved') ?></span>
                            <span><i class="fas fa-eye-slash wpfcl-1"></i> <?php wpforo_phrase('Private') ?></span>
                            <span><i class="fas fa-lock wpfcl-1"></i> <?php wpforo_phrase('Closed') ?></span>
                        </p>
                    </div>
                </div>
            </div>
		<?php endif; ?>
        <?php WPF()->tpl->copyright() ?>
        <?php do_action( 'wpforo_stat_bar_end'); ?>
  	</div>	<!-- wpforo-footer -->
  	
  	<?php do_action( 'wpforo_bottom_hook' ) ?>
    <?php wpforo_debug(); ?>
    
</div><!-- wpforo-wrap -->

<div id="wpforo-load" class="wpforo-load">
	<i class="fas fa-3x fa-spinner fa-spin"></i>&nbsp;&nbsp;<br/>
	<span class="loadtext"><?php wpforo_phrase('Working') ?></span>
</div>

<div id="wpf-msg-box">
	<p><?php echo sprintf( wpforo_phrase('Please %s or %s', FALSE), '<a href="' . wpforo_login_url() . '">'.wpforo_phrase('Login', FALSE).'</a>', '<a href="' . wpforo_register_url() . '">'.wpforo_phrase('Register', FALSE).'</a>' ) ?></p>
</div>