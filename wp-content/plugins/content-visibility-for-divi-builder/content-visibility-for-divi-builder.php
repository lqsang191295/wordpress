<?php

/**
 * @link              http://www.aod-tech.com/wordpress/plugins/content-visibility-for-divi-builder/
 * @since             1.0.0
 * @package           content_visibility_for_divi_builder
 *
 * @wordpress-plugin
 * Plugin Name:       Content Visibility for Divi Builder
 * Plugin URI:        http://www.aod-tech.com/wordpress/plugins/content-visibility-for-divi-builder/
 * Description:       Allows Sections and Modules to be displayed/hidden based on the outcome of a PHP boolean expression.
 * Version:           3.06
 * Author:            AoD Technologies LLC
 * Author URI:        http://www.aod-tech.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       content-visibility-for-divi-builder
 * Domain Path:       /languages
 * 
 * Content Visibility for Divi Builder is free software: you 
 * can redistribute it and/or modify it under the terms of the  GNU 
 * General Public License as published by the Free Software 
 * Foundation, either version 2 of the License, or any later version.
 * 
 * Content Visibility for Divi Builder is distributed in the 
 * hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Content Visibility for Divi Builder. If not, see 
 * http://www.gnu.org/licenses/gpl-2.0.txt.
 * 
 * AS OF VERSION 3.05 AND BEYOND, CONTINUED USE OF THIS PLUGIN IS CONTINGENT UPON THE ACCEPTANCE OF
 * THE FOLLOWING AGREEMENT:
 *
 * This HOLD HARMLESS AGREEMENT (the "Agreement") is made and entered into as of the date of first use of the 
 *         Content Visibility for Divi Builder WordPress plugin v3.05 or higher (the "Plugin") executed between:
 * 
 *                                                                  AoD Technologies LLC
 *                                                                  (the "Indemnitee(s)")
 * 
 *                                                                               and
 * 
 *   Any entity installing the plugin and activating it so that the code therein is executed on one or multiple websites,
 *                                the owner(s) of such website(s), and any affiliates of such website(s)
 *                                                                  (the "Indemnitor(s)")
 *                                                 (each a "Party" and collectively the "Parties")
 * 
 * INDEMNITOR IS RESPONSIBLE FOR CAREFULLY READING THE TERMS OF THIS AGREEMENT BEFORE INSTALLING THE PLUGIN
 * AND ACTIVATING IT SO THAT THE CODE THEREIN IS EXECUTED ON ONE OR MULTIPLE WEBSITES. BY INSTALLING THE PLUGIN
 * AND ACTIVATING IT SO THAT THE CODE THEREIN IS EXECUTED ON ONE OR MULTIPLE WEBSITES, INDEMNITOR CONFIRMS THAT
 * INDEMNITOR HAS READ, ACCEPTS AND AGREES TO THE TERMS OF THIS AGREEMENT. IF THE INDIVIDUAL INSTALLING THE PLUGIN
 * AND ACTIVATING IT SO THAT THE CODE THEREIN IS EXECUTED ON ONE OR MULTIPLE WEBSITES IS DOING SO ON BEHALF OF
 * INDEMNITOR, SUCH INDIVIDUAL REPRESENTS AND WARRANTS TO HAVE THE AUTHORITY TO BIND INDEMNITOR AND ITS AFFILIATES
 * TO THE TERMS OF THIS AGREEMENT.  NOTWITHSTANDING ANY DIFFERENT OR ADDITIONAL TERMS INDEMNITOR MAY REFERENCE
 * OR PROVIDE, INDEMNITEE’S OFFER TO ENTER INTO AN AGREEMENT WITH INDEMNITOR WITH RESPECT TO INSTALLING THE PLUGIN
 * AND ACTIVATING IT, SO THAT THE CODE THEREIN IS EXECUTED ON ONE OR MULTIPLE WEBSITES IS EXPRESSLY LIMITED TO THIS
 * AGREEMENT AND CONDITIONED ON INDEMNITOR’S ASSENT HERETO.
 * 
 *           WHEREAS, Indemnitor wishes to hold harmless, indemnify, and defend Indemnitee from any
 *                        and all Claims, whether alleged or actual, arising from the following activity:
 *          Installing the Plugin and activating it so that the code therein is executed on one or multiple websites.
 *                  FOR VALUABLE CONSIDERATION, the receipt and sufficiency of which is hereby
 *                    acknowledged, Indemnitor(s) and Indemnitee(s) hereby agree as follows:
 * 
 * 1. INDEMNITY AND HOLD HARMLESS. To the extent permitted by law, Indemnitor will
 * indemnify, hold harmless, and defend Indemnitee from any and all claims, actions, losses,
 * damages, suits, fees, and judgments (hereinafter, "Claim"), whether alleged or actual,
 * including all costs and attorney's fees incurred in defending against the same, arising out of
 * the activity described herein.
 * 
 * 2. NOTICE OF CLAIM. In the event that a Party receives notice of a Claim, that Party must
 * notify all other parties within 10 business days.
 * 
 * 3. DEFENSE
 *   a. Control. Upon receipt of notice of a Claim, Indemnitor reserves the right to defend and
 *   control such Claim in any manner it may deem appropriate. In the event that Indemnitor
 *   declines to defend and control the Claim, Indemnitee will have the right to defend and
 *   control such Claim in any manner it may deem appropriate.
 *   The Party controlling and defending such Claim reserves the right to select counsel,
 *   contractors, experts, and any other third party of recognized competence that are deemed
 *   appropriate.
 * 
 *   b. Cooperation. All Parties to this Agreement will cooperate fully with the Party defending
 *   and controlling any Claims.
 * 
 * 4. SETTLEMENT. The Party controlling and defending any Claim will be authorized to
 * accept a settlement subject to the following:
 *   a. Indemnitor Control. In the event Indemnitor is controlling the defense of such Claim,
 *   Indemnitee must give full written consent to any such settlement, such consent not to be
 *   unreasonably withheld.
 * 
 *   b. Indemnitee Control. In the event Indemnitee is controlling the defense of such Claim,
 *   Indemnitor must give full written consent to enter into any such settlement or give
 *   consent to an entry of judgment, such consent not to be unreasonably withheld.
 * 
 * 5. ATTORNEY'S FEES. In the event any action at law or in equity is required to interpret or
 * enforce the terms of this Agreement, the prevailing Party will be entitled to recover
 * reasonable attorney's fees and costs.
 * 
 * 6. AMENDMENT OR MODIFICATION. Any amendment or modification to this
 * Agreement will only be deemed valid if executed in writing and signed by all parties.
 * 
 * 7. ENTIRE AGREEMENT. This Agreement constitutes the entire agreement between the
 * Parties and supersedes any previous understanding, arrangement, warranty, or agreement to
 * the matter set forth in this Agreement.
 * 
 * 8. WAIVER. In no event will any delay, neglect, or forbearance on the part of any Party in
 * enforcing any provisions of this Agreement be deemed a waiver or limitation of that Party's
 * right to subsequently enforce and compel strict compliance with every provision of this
 * Agreement.
 * 
 * 9. ASSIGNMENT. Except where expressly permitted herein, neither this Agreement nor the
 * rights and obligations of any Party may be assigned without the prior written consent of all
 * Parties subject to this Agreement.
 * 
 * 10. SEVERABILITY. In the event that any or part of the provisions of this Agreement are held
 * to be invalid or unenforceable, in whole or in part, by a court of competent jurisdiction, those
 * provisions to the extent enforceable and all other provisions will nevertheless continue to be
 * valid and enforceable.
 * 
 * 11. JOINT AND SEVERAL LIABILITY. Notwithstanding anything to the contrary contained
 * herein, if more than one person or entity is signing this Agreement as Indemnitor, its
 * obligations under this Agreement will be joint and several.
 * 
 * 12. INTERPRETATION. Wherever the context so requires, words used in the singular include
 * the plural, and words used in the plural include the singular.
 * 
 * 13. GOVERNING LAW. This Agreement will be governed by, and construed in accordance
 * with, the laws of the State of Arizona, without regard to its conflict of laws rules.
 * 
 * 14. JURISDICTION. The courts of the State of Arizona will have exclusive jurisdiction to
 * adjudicate any dispute arising under or in connection with this Agreement.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'libs/aod-tech-analytics/class-aod-tech-analytics.php';

function activate_content_visibility_for_divi_builder_single_site( $is_network = FALSE ) {
	$tid = 'UA-75655200-1';
	$cid = get_option( 'content_visibility_for_divi_builder_cid' );
	$opt_in = get_option( 'content-visibility-for-divi-builder_usage-tracking-enabled' ) !== '0';
	if ( $cid === FALSE ) {
		$cid = \AoDTechnologies\Analytics::generate_uuid();
		add_option( 'content_visibility_for_divi_builder_cid', $cid );
		if ( $opt_in ) {
			\AoDTechnologies\Analytics::track( $cid, array(
				'tid' => $tid,
				'ea' => ( $is_network === TRUE ? 'Network ' : '' ) . 'Activate'
			), ( $is_network === TRUE ? network_site_url() : site_url() ) );
		}
	} else {
		if ( $opt_in ) {
			\AoDTechnologies\Analytics::track( $cid, array(
				'tid' => $tid,
				'ea' => ( $is_network === TRUE ? 'Network ' : '' ) . 'Reactivate'
			), ( $is_network === TRUE ? network_site_url() : site_url() ) );
		}
	}
	
	if ( function_exists( 'et_pb_force_regenerate_templates' ) ) {
		et_pb_force_regenerate_templates();
	}
}

function deactivate_content_visibility_for_divi_builder_single_site( $is_network = FALSE ) {
	$tid = 'UA-75655200-1';
	$cid = get_option( 'content_visibility_for_divi_builder_cid' );
	$opt_in = get_option( 'content-visibility-for-divi-builder_usage-tracking-enabled' ) !== '0';
	if ( $opt_in ) {
		\AoDTechnologies\Analytics::track( $cid, array(
			'tid' => $tid,
			'ea' => ( $is_network === TRUE ? 'Network ' : '' ) . 'Deactivate'
		), ( $is_network === TRUE ? network_site_url() : site_url() ) );
	}
	
	if ( function_exists( 'et_pb_force_regenerate_templates' ) ) {
		et_pb_force_regenerate_templates();
	}
}

/**
 * The code that runs during plugin activation.
 */
function activate_content_visibility_for_divi_builder( $network_wide = FALSE ) {
	if ( function_exists( 'is_multisite' ) && is_multisite() && $network_wide === TRUE ) {
		activate_content_visibility_for_divi_builder_single_site( true );
		
		$wp_version = get_bloginfo( 'version' );
		if ( version_compare( $wp_version, '4.6', '<' ) ) {
			foreach ( wp_get_sites() as $site ) {
				switch_to_blog( $site['blog_id'] );
				activate_content_visibility_for_divi_builder_single_site();
				restore_current_blog();
			}
		} else {
			foreach ( get_sites( array(
				'fields' => 'ids'
			) ) as $site_id ) {
				switch_to_blog( $site_id );
				activate_content_visibility_for_divi_builder_single_site();
				restore_current_blog();
			}
		}
	} else {
		activate_content_visibility_for_divi_builder_single_site();
	}
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_content_visibility_for_divi_builder( $network_deactivating = FALSE ) {
	if ( function_exists( 'is_multisite' ) && is_multisite() && $network_deactivating === TRUE ) {
		deactivate_content_visibility_for_divi_builder_single_site( true );
		
		$wp_version = get_bloginfo( 'version' );
		if ( version_compare( $wp_version, '4.6', '<' ) ) {
			foreach ( wp_get_sites() as $site ) {
				switch_to_blog( $site['blog_id'] );
				deactivate_content_visibility_for_divi_builder_single_site();
				restore_current_blog();
			}
		} else {
			foreach ( get_sites( array(
				'fields' => 'ids'
			) ) as $site_id ) {
				switch_to_blog( $site_id );
				deactivate_content_visibility_for_divi_builder_single_site();
				restore_current_blog();
			}
		}
	} else {
		deactivate_content_visibility_for_divi_builder_single_site();
	}
}

register_activation_hook( __FILE__, 'activate_content_visibility_for_divi_builder' );
register_deactivation_hook( __FILE__, 'deactivate_content_visibility_for_divi_builder' );

call_user_func( function() {
	$text_domain = 'content-visibility-for-divi-builder';
	$plugin_key = str_replace( '-', '_', $text_domain );
	
	$wp_version = get_bloginfo( 'version' );
	
	$tid = 'UA-75655200-1';
	$cid = get_option( 'content_visibility_for_divi_builder_cid' );
	if ( $cid === FALSE ) {
		$cid = \AoDTechnologies\Analytics::generate_uuid();
		add_option( 'content_visibility_for_divi_builder_cid', $cid );
	}
	$opt_in = get_option( 'content-visibility-for-divi-builder_usage-tracking-enabled' ) !== '0';
	
	$version = '3.06';
	$stored_version = get_option( 'content_visibility_for_divi_builder_version' );
	
	$is_network = function_exists( 'is_multisite' ) && is_multisite() && network_site_url() === site_url();
	
	// Migration code for already active plugins
	if ($version !== $stored_version) {
		update_option( 'content_visibility_for_divi_builder_version', $version );
		
		add_action( 'init', function() {
			if ( function_exists( 'et_pb_force_regenerate_templates' ) ) {
				et_pb_force_regenerate_templates();
			}
		} );
		
		if ( $opt_in ) {
			\AoDTechnologies\Analytics::track( $cid, array(
				'tid' => $tid,
				'ea' => ( $is_network ? 'Network ' : '' ) . 'Migrate to v' . $version
			), site_url() );
		}
	}
	
	add_action( 'wp_head', function() { ?><script>(function(w,c,g,d,t,m,a,b,z,u,n){function f(){w[d].push(arguments)}function y(){w[d]=[];q=c.getElementsByTagName(g)[0];n=c.createElement(g);n.async=!0;n.src='https://www.googletagmanager.com/gtag/js?id=UA-75655200-4&l='+d;q.parentNode.insertBefore(n,q);f('js',b);f('config','UA-75655200-4',{'custom_map':{'metric1':'cvdbm1'},'transport_type':'beacon','send_page_view':!1,'anonymize_ip':!0,'allow_display_features':!1,'link_attribution':!0});w[a]('unload',function(){f('event','page_view',{'cvdbm1':m(((new t())-b)/1000)})},!1)}u=!1;b=new t();w[a]('load',function(){for(z in w){if(w.hasOwnProperty(z)&&z.indexOf('ga-disable-')===0&&w[z]===!0){u=!0;break}}if(!u)y()},!1)})(window,document,'script','c69d3b65dc6d40db98d2e3ee3cc1fd37',Date,Math.floor,'addEventListener');</script><?php } );
	
	add_action( 'admin_enqueue_scripts', function() use ( $text_domain, $version ) {
		wp_enqueue_script( "{$text_domain}_builder_js_fixes", plugins_url( '/js/builder-fixes.js' , __FILE__ ), array( 'et_pb_admin_js' ), $version, true );
	}, 11 );
	
	add_action( 'plugins_loaded', function() use ( $text_domain, $tid, $cid, $opt_in ) {
		load_plugin_textdomain( $text_domain, false, basename( dirname( __FILE__ ) ) . '/languages/' );
		
		add_filter( 'content_visibility_for_divi_builder_prevent_texturize_shortcodes', function ( $medb_tags ) use ( $text_domain ) {
			foreach( $medb_tags as $tag ) {
				add_action( 'content_visibility_for_divi_builder_setup_' . $tag, function( $et_pb_element ) use ( $text_domain ) {
					if ( !isset( $et_pb_element->whitelisted_fields['cvdb_content_visibility_check'] ) ) {
						$et_pb_element->fields_unprocessed['cvdb_content_visibility_check'] = array(
							'label' => __( 'Content Visibility', $text_domain ),
							'type'  => 'text',
							'option_category' => 'layout',
							'description' => __( 'Enter a boolean expression which evaluates to true when you want to display this element, or leave blank to always display it.', $text_domain ),
							'priority' => 1,
						);
						$et_pb_element->whitelisted_fields['cvdb_content_visibility_check'] = array();
					}
				} );
			
				add_filter( 'content_visibility_for_divi_builder_shortcode_' . $tag, function( $result, $atts, $content, $function_name, $et_pb_element, $et_pb_shortcode_callback ) {
					$visibility = true;

					$admin_check = is_admin() && function_exists( 'get_current_screen' );
					if ( $admin_check ) {
						$current_screen = get_current_screen();
						$admin_check = $current_screen !== null && $current_screen->action === '' && $current_screen->id === $current_screen->post_type;
					}

					if ( !$admin_check && isset( $atts['cvdb_content_visibility_check'] ) && $atts['cvdb_content_visibility_check'] !== '' && ( !function_exists( 'et_fb_is_enabled' ) || !et_fb_is_enabled() ) && ( !isset( $_REQUEST['action'] ) || 'et_fb_retrieve_builder_data' !== $_REQUEST['action'] ) ) {
						eval( '$visibility = ' . str_replace( array( '%22', '%5D' ), array( '"', ']' ), $atts['cvdb_content_visibility_check'] ) . ';' );
					}

					if ( !$visibility ) {
						$result = '';
					}

					return $result;
				}, 1337, 6 );
			}
			return array_diff( $medb_tags, array( 'et_pb_text', 'et_pb_code', 'et_pb_fullwidth_code' ) );
		} );
	} );
	
	add_action( 'init', function() use ( $text_domain, $tid, $cid, $opt_in, $wp_version, $is_network ) {
		if ( is_admin() ) {
			$show_rating_notice_option_key = $text_domain . '_show-rating-notice';
			
			if ( get_user_option( $show_rating_notice_option_key ) === '1' ) {
				add_action( 'admin_notices', function() use ( $text_domain, $wp_version ) {
					$rating_link = '<a href="' . admin_url( 'admin-ajax.php?action=' . $text_domain . '_click-rating-link' ) . '" target="_blank">' . _x( 'rating', 'present participle: I enjoyed rating the awesome WordPress plugin', $text_domain ) . '</a>';
?>
<div id="content-visibility-for-divi-builder_rating-notice" class="notice notice-info is-dismissible" style="position: relative;"><p><?php
					/* translators: 1: The translated text for "rating" in the present participle (e.g. I enjoyed rating the awesome WordPress plugin) 2: A "smiley" emoticon at the end of the translated text */
					printf( __( 'If you like what Content Visibility for Divi Builder helps you to do, please take a moment to consider %1$s it. And don\'t worry, we won\'t keep asking once you dismiss this notice. %2$s', $text_domain ), $rating_link, translate_smiley( array( ':)' ) ) );
?></p><script>
	jQuery(document.body).on("click", "#content-visibility-for-divi-builder_rating-notice .notice-dismiss", function() {
		jQuery.ajax({
			"method" : "POST",
			"url" : "<?php echo admin_url( 'admin-ajax.php' ); ?>",
			"data": {
				"action" : "<?php echo $text_domain; ?>_dismiss-rating-notice"
			},
			"success": function(jqXHR, status, errorThrown) {<?php
					if ( version_compare( $wp_version, '4.2', '<' ) ) {
?>
				jQuery("#content-visibility-for-divi-builder_rating-notice").slideUp();<?php
					}
?>
				console.log("<?php _e( 'Content Visibility for Divi Builder: Rating Notice permanently dismissed.', $text_domain ); ?>");
			}
		});
	});
</script><?php
					if ( version_compare( $wp_version, '4.2', '<' ) ) {?>
<div class="notice-dismiss" style="position: absolute; top: 0; right: 0; padding: 8px; cursor: pointer;"><img src="<?php echo admin_url( 'images/no.png' ); ?>" alt="X"></div>
<?php
					}
?></div>
<?php
				} );
			}
			
			$show_usage_tracking_notice_option_key = $text_domain . '_show-usage-tracking-notice';
			
			if ( get_user_option( $show_usage_tracking_notice_option_key ) !== '0' ) {
				add_action( 'admin_notices', function() use ( $text_domain, $wp_version ) {
?>
<div id="content-visibility-for-divi-builder_usage-tracking-notice" class="notice notice-info is-dismissible" style="position: relative;"><p><?php
					/* translators: 1: A "heart" emoji at the end of the translated text, or smiley for older WordPress versions */
					printf( __( 'Content Visibility for Divi Builder now records some anonymous usage statistics. We hope that you will allow us to collect this information, which will help us to better understand your needs and improve this plugin. However, if you would like to opt-out of sending this information, you may do so on the plugins page by clicking on the "Disable anonymous usage tracking" link under Content Visibility for Divi Builder. %1$s', $text_domain ), ( function_exists( 'wp_staticize_emoji' ) ? wp_staticize_emoji( '❤' ) : translate_smiley( array( ':)' ) ) ) );
?></p><script>
	jQuery(document.body).on("click", "#content-visibility-for-divi-builder_usage-tracking-notice .notice-dismiss", function() {
		jQuery.ajax({
			"method" : "POST",
			"url" : "<?php echo admin_url( 'admin-ajax.php' ); ?>",
			"data": {
				"action" : "<?php echo $text_domain; ?>_dismiss-usage-tracking-notice"
			},
			"success": function(jqXHR, status, errorThrown) {<?php
					if ( version_compare( $wp_version, '4.2', '<' ) ) {
?>
				jQuery("#content-visibility-for-divi-builder_usage-tracking-notice").slideUp();<?php
					}
?>
				console.log("<?php _e( 'Content Visibility for Divi Builder: Usage Tracking Notice permanently dismissed.', $text_domain ); ?>");
			}
		});
	});
</script><?php
					if ( version_compare( $wp_version, '4.2', '<' ) ) {?>
<div class="notice-dismiss" style="position: absolute; top: 0; right: 0; padding: 8px; cursor: pointer;"><img src="<?php echo admin_url( 'images/no.png' ); ?>" alt="X"></div>
<?php
					}
?></div>
<?php
				} );
			}
			
			add_action( 'wp_ajax_' . $text_domain . '_dismiss-rating-notice', function() use ( $show_rating_notice_option_key ) {
				update_user_option( get_current_user_id(), $show_rating_notice_option_key, '0' );
				
				exit;
			} );
			
			add_action( 'wp_ajax_' . $text_domain . '_dismiss-usage-tracking-notice', function() use ( $show_usage_tracking_notice_option_key ) {
				update_user_option( get_current_user_id(), $show_usage_tracking_notice_option_key, '0' );
				
				exit;
			} );
			
			add_action( 'wp_ajax_' . $text_domain . '_click-rating-link', function() use ( $text_domain, $tid, $cid, $opt_in, $is_network ) {
				if ( $opt_in ) {
					// TODO: Use proper link attribution click event instead of a custom event
					\AoDTechnologies\Analytics::track( $cid, array(
						'tid' => $tid,
						'ec' => 'WordPress Plugin UI Event',
						'ea' => 'Click',
						'el' => ( $is_network ? 'Network ' : '' ) . 'Rating Link'
					), site_url() );
				}
				wp_redirect( "https://wordpress.org/support/view/plugin-reviews/$text_domain?rate=5#postform" );
			} );
			
			add_action( 'wp_ajax_' . $text_domain . '_toggle-usage-tracking', function() use ( $text_domain, $tid, $cid, $opt_in, $is_network ) {
				$message = '';
				if ( $opt_in ) {
					update_option( $text_domain . '_usage-tracking-enabled', '0' );
					$message = 'Opted-out of anonymous usage tracking';
				} else {
					update_option( $text_domain . '_usage-tracking-enabled', '1' );
					$message = 'Opted-in to anonymous usage tracking';
				}
				
				\AoDTechnologies\Analytics::track( $cid, array(
					'tid' => $tid,
					'ea' => ( $is_network ? 'Network ' : '' ) . $message
				), site_url() );
				
				wp_redirect( wp_get_referer() !== FALSE ? wp_get_referer() : admin_url( 'plugins.php' ) );
			} );
			
			if ( $GLOBALS['pagenow'] === 'plugins.php' ) { 
				add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), function($links) use ($text_domain) {
					$rate_text = _x( 'Rate', 'verb: They were asked to rate their ability at different driving maneuvers', $text_domain );
					$enable_text = __( 'Enable', $text_domain );
					$disable_text = __( 'Disable', $text_domain );
					
					return array_merge( $links, array(
						/* translators: 1: The translated text for "Rate" as a verb (e.g. They were asked to rate their ability at different driving maneuvers) 2: A "heart" emoji at the end of the translated text, or smiley for older WordPress versions */
						sprintf( '<a href="https://wordpress.org/support/view/plugin-reviews/' . $text_domain . '?rate=5#postform" target="_blank">' . __( '%1$s this plugin %2$s', $text_domain ) . '</a>', $rate_text, ( function_exists( 'wp_staticize_emoji' ) ? wp_staticize_emoji( '❤' ) : translate_smiley( array( ':)' ) ) ) ),
						/* translators: 1: The URL to either enable or disable usage tracking 2: Either the verb Enable or the verb Disable, (e.g. "Enable usage tracking", or "Disable usage tracking" ) */
						sprintf( '<a href="%1$s">' . __( '%2$s anonymous usage tracking', $text_domain ) . '</a>', admin_url( 'admin-ajax.php?action=' . $text_domain . '_toggle-usage-tracking' ), get_option( $text_domain . '_usage-tracking-enabled' ) !== '0' ? $disable_text : $enable_text )
					) );
				}, 1337, 2 );
			} else if ( current_user_can( 'manage_options' ) && get_user_option( $show_rating_notice_option_key ) === FALSE ) {
				// TODO: Find a better way to detect when a user has actually used the features of this plugin
				update_user_option( get_current_user_id(), $show_rating_notice_option_key, '1' );
			}
		}
	} );
	
	// Module Extender for Divi Builder functionality
	$medb_et_pb_children  = array();
	add_action( 'et_builder_ready', function() use ( $text_domain, $plugin_key, &$medb_et_pb_children ) {
		$medb_tags = array();

		foreach( $GLOBALS['shortcode_tags'] as $tag => $func ){
			if ( is_array( $func ) && $func[0] instanceof ET_Builder_Element ) {
				$medb_et_pb_children[$tag] = $func;
				remove_shortcode( $tag, $func );
				$medb_tags[] = $tag;
			}
		}
		
		$medb_tags = apply_filters( $plugin_key . '_prevent_texturize_shortcodes', $medb_tags );

		add_filter( 'no_texturize_shortcodes', function($default_no_texturize_shortcodes) use ($medb_tags) {
			return array_unique( array_merge( $default_no_texturize_shortcodes, $medb_tags ) );
		} );

		// Something temporary until a better solution is found
		if ( function_exists( 'et_pb_is_pagebuilder_used' ) && apply_filters( $plugin_key . '_remove_wptexturize_from_builder_pages', true ) ) {
			add_filter( 'the_content', function($content) {
				if ( et_pb_is_pagebuilder_used( get_the_ID() ) ) {
					remove_filter( 'the_content', 'wptexturize' );
				}
				return $content;
			}, 9 );
		}
		
		do_action( $plugin_key, $medb_et_pb_children );

		foreach( $medb_et_pb_children as $tag => $func ) {
			$et_pb_element = $func[0];
			$et_pb_shortcode_callback = $func[1];
			
			do_action( $plugin_key . '_setup_' . $tag, $et_pb_element );
			
			add_shortcode( $tag, function( $atts, $content, $function_name ) use ( $et_pb_element, $et_pb_shortcode_callback, $tag, $plugin_key ) {
				$result = null;
				
				if ( apply_filters( $plugin_key . '_shortcode_' . $tag, $result, $atts, $content, $function_name, $et_pb_element, $et_pb_shortcode_callback ) === null ) {
					return $et_pb_element->$et_pb_shortcode_callback( $atts, $content, $function_name );
				} else {
					return $result;
				}
			} );
		}
	}, PHP_INT_MAX );
	
	add_action( 'admin_menu', function() use ( $text_domain, &$medb_et_pb_children, $wp_version ) {
		$medb_text_domain = 'module-extender-for-divi-builder';
		add_submenu_page(
			'tools.php',
			__( 'Module Extender for Divi Builder API Reference', $text_domain ),
			__( 'Module Extender API Reference', $text_domain ),
			'manage_options',
			$medb_text_domain . '-api-reference',
			function() use ( $text_domain, $medb_text_domain, &$medb_et_pb_children, $wp_version ) {
				if ( version_compare( $wp_version, '3.8', '<' ) ) {
					screen_icon( 'edit-pages' );
				}
				$tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'general';
?>
<div class="wrap">
	<h1><?php _e( 'Module Extender for Divi Builder API Reference', $text_domain ); ?></h1>
	<h2 class="title"><?php _e( 'The Basics', $text_domain ); ?></h2>
	<p><?php _e( 'Module Extender for Divi Builder provides several WordPress actions and filters to allow customization/extension of installed Divi Builder modules.', $text_domain ); ?></p>
	<p><?php _e( 'The following tabs provide detailed information about these actions and filters, along with a list of module-specific actions and filters for those modules currently installed on the system. Enjoy!', $text_domain ); ?></p>
	<h2 class="nav-tab-wrapper"><?php
				$all_tabs = array(
					'general' => __( 'General Actions and Filters', $text_domain ),
					'specific' => __( 'Module-Specific Actions and Filters', $text_domain ),
					'available' => __( 'Currently Available Module-Specific Actions and Filters', $text_domain ),
				);
				foreach ( $all_tabs as $tab_key => $tab_caption ) {
					$active = $tab == $tab_key ? ' nav-tab-active' : '';
?>
		<a class="nav-tab<?php echo $active; ?>" href="?page=<?php echo $medb_text_domain . '-api-reference' ?>&tab=<?php echo $tab_key; ?>"><?php echo $tab_caption; ?></a><?php
				}
?>
	</h2><?php
				if ( $tab === 'general' ) {
?>
		<h2 class="title"><?php /* translators: 1: the WordPress action string, 2: the WordPress action parameter list */ printf( __( 'Action: %1$s<br>Parameters:<br>%2$s', $text_domain), '<code>content_visibility_for_divi_builder</code>', /* translators: 1: the first parameter's variable name */ sprintf( __( '&nbsp; &nbsp; %1$s: Array of Module shortcode callables; array keys are the callables&#8217; shortcode tags', $text_domain), '<code>$medb_et_pb_children</code>' ) ); ?></h2>
		<p><?php _e( 'Useful for enumerating available Module shortcode tags.', $text_domain ); ?></p>
		<hr>
		<h2 class="title"><?php /* translators: 1: the WordPress filter string, 2: the WordPress filter parameter list */ printf( __( 'Filter: %1$s<br>Parameters:<br>%2$s', $text_domain), '<code>content_visibility_for_divi_builder_prevent_texturize_shortcodes</code>', /* translators: 1: the first parameter's variable name */ sprintf( __( '&nbsp; &nbsp; %1$s: Array of available Module shortcodes', $text_domain ), '<code>$medb_tags</code>' ) ); ?></h2>
		<p><?php _e( 'Will by default pass all Module shortcodes to the "no_texturize_shortcodes" standard WordPress filter. You may use this filter to remove some or all of the Modules from the array merged into "no_texturize_shortcodes".', $text_domain ); ?></p>
		<hr>
		<h2 class="title"><?php /* translators: 1: the WordPress filter string, 2: the WordPress filter parameter list */ printf( __( 'Filter: %1$s<br>Parameters:<br>%2$s', $text_domain), '<code>content_visibility_for_divi_builder_remove_wptexturize_from_builder_pages</code>', /* translators: 1: the first parameter's variable name */ sprintf( __( '&nbsp; &nbsp; %1$s: boolean indicating whether wptexturize should be removed from the "the_content" built-in WordPress filter for any post_type using Divi Builder; defaults to true', $text_domain ), '<code>$remove_wptexturize</code>' ) ); ?></h2>
		<p><?php _e( 'You may return false in this filter to allow wp_texturize on "the_content" filter for Divi Builder post_types.', $text_domain ); ?></p><?php
				} else if ( $tab === 'specific' ) {
?>
		<h2 class="title"><?php /* translators: 1: the WordPress action string pattern, 2: the WordPress action parameter list */ printf( __( 'Action: %1$s<br>Parameters:<br>%2$s', $text_domain), '<code>content_visibility_for_divi_builder_setup_&lt;module_shortcode&gt;</code>', /* translators: 1: the first parameter's variable name */ sprintf( __( '&nbsp; &nbsp; %1$s: The Module&#8217;s class instance', $text_domain ), '<code>$et_pb_element</code>' ) ); ?></h2>
		<p><?php _e( 'Executes for each Module, allowing you to use it as necessary (e.g. modify the class instance&#8217;s public variables)', $text_domain ); ?></p>
		<hr>
		<h2 class="title"><?php /* translators: 1: the WordPress filter string pattern, 2: the WordPress filter parameter list */ printf( __( 'Filter: %1$s<br>Parameters:<br>%2$s', $text_domain), '<code>content_visibility_for_divi_builder_shortcode_&lt;module_shortcode&gt;</code>', /* translators: 1: the first parameter's variable name, 2: the second parameter's variable name, 3: the third parameter's variable name, 4: the fourth parameter's variable name, 5: the fifth parameter's variable name, 6: the sixth parameter's variable name */ sprintf( __( '&nbsp; &nbsp; %1$s: The HTML to output for this Module&#8217;s shortcode, or null to use the Module&#8217;s default shortcode handler; defaults to null<br>&nbsp; &nbsp; %2$s: The attributes of the shortcode (first standard WordPress shortcode callback parameter)<br>&nbsp; &nbsp; %3$s: the content of the shortcode (second standard WordPress shortcode callback parameter)<br>&nbsp; &nbsp; %4$s: the function_name of the shortcode (third standard WordPress shortcode callback parameter)<br>&nbsp; &nbsp; %5$s: The Module&#8217;s class instance<br>&nbsp; &nbsp; %6$s: The function name that is called by default on the Module&#8217;s class instance to handle this shortcode', $text_domain ), '<code>$result</code>', '<code>$atts</code>', '<code>$content</code>', '<code>$function_name</code>', '<code>$et_pb_element</code>', '<code>$et_pb_shortcode_callback</code>' ) ); ?></h2>
		<p><?php _e( 'Executes within each Module&#8217;s shortcode handler, allowing you to either modify the output or prevent previous filters from modifying the output.', $text_domain ); ?></p><?php
				} else if ( $tab === 'available' ) {
					foreach( $medb_et_pb_children as $tag => $func ) {
					$et_pb_element = $func[0];
?>
			<h2 class="title"><?php printf( /* translators: 1: the Module's name */ __( 'Module Name: %1$s', $text_domain ), $et_pb_element->name ); ?></h2>
			<h3>&nbsp; &nbsp; <?php printf( /* translators: 1: the Module-Specific action */ __( 'Action: %1$s', $text_domain ), "<code>content_visibility_for_divi_builder_setup_$tag</code>" ); ?></h3>
			<h3>&nbsp; &nbsp; <?php printf( /* translators: 1: the Module-Specific filter */ __( 'Filter: %1$s', $text_domain ), "<code>content_visibility_for_divi_builder_shortcode_$tag</code>" ); ?></h3>
			<hr><?php
					}
				}
?>
</div><?php
			}
		);
		
		add_action( 'load-tools_page_' . $medb_text_domain . '-api-reference', function() use ( $medb_text_domain ) {
			global $pagenow;
			
			$screen = get_current_screen();
			if ( $pagenow === 'tools.php' && $screen->id === 'tools_page_' . $medb_text_domain . '-api-reference' && !class_exists( 'ET_Builder_Element' ) && function_exists( 'et_builder_should_load_framework' ) && !et_builder_should_load_framework() ) {
				require ET_BUILDER_DIR . 'layouts.php';
				require ET_BUILDER_DIR . 'class-et-builder-element.php';
				require ET_BUILDER_DIR . 'class-et-global-settings.php';
				
				do_action( 'et_builder_framework_loaded' );
				
				et_builder_init_global_settings();
				et_builder_add_main_elements();
			}
		} );
	} );
 } );