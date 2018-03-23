<?php
/*
Plugin Name: Testimonial
Plugin URI: http://pickplugins.com
Description: Awesome Product Slider for query post from any post type and display on grid.
Version: 2.0.2
Author: pickplugins
Author URI: http://pickplugins.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class Testimonial{
	
	
	public function __construct(){
		
		define('testimonial_plugin_url', plugins_url('/', __FILE__) );
		define('testimonial_plugin_dir', plugin_dir_path(__FILE__) );
		define('testimonial_wp_url', 'https://wordpress.org/plugins/testimonial/' );
		define('testimonial_wp_reviews', 'http://wordpress.org/support/view/plugin-reviews/testimonial' );
		define('testimonial_pro_url','http://www.pickplugins.com/item/testimonial-responsive-testimonial-slider-grid-for-wordpress/' );
		define('testimonial_demo_url', 'http://pickplugins.com/demo/testimonial/' );
		define('testimonial_conatct_url', 'http://pickplugins.com/contact/' );
		define('testimonial_qa_url', 'http://pickplugins.com/questions/' );
		define('testimonial_plugin_name', 'Testimonial' );
		define('testimonial_version', '2.0.2' );
		define('testimonial_customer_type', 'free' );		
		define('testimonial_share_url', 'https://wordpress.org/plugins/testimonial/' );
		define('testimonial_tutorial_video_url', '//www.youtube.com/embed/IMhh4p_nhhg2tu60' );
		define('testimonial_textdomain', 'testimonial' );		


		include( 'includes/class-functions.php' );
		include( 'includes/class-shortcodes.php' );
		include( 'includes/class-settings.php' );		
		include( 'includes/meta.php' );		
		include( 'includes/functions.php' );

		add_action( 'wp_enqueue_scripts', array( $this, 'testimonial_scripts_front' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'testimonial_scripts_admin' ) );
		add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' ); 
		
		add_action( 'plugins_loaded', array( $this, 'testimonial_load_textdomain' ));
		
		register_activation_hook( __FILE__, array( $this, 'testimonial_install' ) );
		register_deactivation_hook( __FILE__, array( $this, 'testimonial_deactivation' ) );
		//register_uninstall_hook( __FILE__, array( $this, 'testimonial_uninstall' ) );
		
		}
		
	public function testimonial_load_textdomain() {
	  load_plugin_textdomain( 'testimonial', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' ); 
	}
		
	public function testimonial_install(){
		
		
		
		$class_testimonial_functions = new class_testimonial_functions();
		
		$testimonial_layout_content = get_option('testimonial_layout_content');
		if(empty($testimonial_layout_content)){
			$layout_content_list = $class_testimonial_functions->layout_content_list();
			update_option('testimonial_layout_content', $layout_content_list);
			}
		
		
		
		//$layout_hover_list = $class_testimonial_functions->layout_hover_list();		
		//update_option('testimonial_layout_hover', $layout_hover_list);
		
		do_action( 'testimonial_action_install' );
		
		}		
		
	public function testimonial_uninstall(){
		
		do_action( 'testimonial_action_uninstall' );
		}		
		
	public function testimonial_deactivation(){
		
		do_action( 'testimonial_action_deactivation' );
		}
		
	
		
	public function testimonial_scripts_front(){
		wp_enqueue_script('jquery');

		wp_enqueue_style('testimonial_style', testimonial_plugin_url.'/assets/frontend/css/style.css');
		wp_enqueue_script('testimonial_scripts', plugins_url( '/assets/frontend/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script('testimonial_scripts', 'testimonial_ajax', array( 'testimonial_ajaxurl' => admin_url( 'admin-ajax.php')));

		wp_enqueue_script('owl.carousel.min', plugins_url( '/assets/frontend/js/owl.carousel.min.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_style('owl.carousel', testimonial_plugin_url.'assets/frontend/css/owl.carousel.css');
		//wp_enqueue_style('owl.theme', testimonial_plugin_url.'assets/frontend/css/owl.theme.css');
		wp_enqueue_style('font-awesome', testimonial_plugin_url.'assets/frontend/css/font-awesome.css');		
		wp_enqueue_style('style-woocommerce', testimonial_plugin_url.'assets/frontend/css/style-woocommerce.css');
		//wp_enqueue_style('animate', testimonial_plugin_url.'assets/frontend/css/animate.css');

		
		wp_enqueue_style('style.skins', testimonial_plugin_url.'assets/global/css/style.skins.css');
		wp_enqueue_style('style.layout', testimonial_plugin_url.'assets/global/css/style.layout.css');
		
		}
		
		
	public function testimonial_scripts_admin(){
			
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-droppable');
		
		wp_enqueue_script('testimonial_admin_js', plugins_url( 'assets/admin/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script( 'testimonial_admin_js', 'testimonial_ajax', array( 'testimonial_ajaxurl' => admin_url( 'admin-ajax.php')));

		wp_enqueue_style('testimonial_admin_style', testimonial_plugin_url.'assets/admin/css/style.css');

		//ParaAdmin
		wp_enqueue_style('ParaAdmin', testimonial_plugin_url.'assets/admin/ParaAdmin/css/ParaAdmin.css');		
		wp_enqueue_script('ParaAdmin', plugins_url( 'assets/admin/ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_style('font-awesome', testimonial_plugin_url.'assets/frontend/css/font-awesome.css');	

		wp_enqueue_script('codemirror', plugins_url( 'assets/admin/js/codemirror.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_script('simplescrollbars', plugins_url( 'assets/admin/js/simplescrollbars.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_script('css', plugins_url( 'assets/admin/js/css.js' , __FILE__ ) , array( 'jquery' ));	
		wp_enqueue_script('javascript', plugins_url( 'assets/admin/js/javascript.js' , __FILE__ ) , array( 'jquery' ));				
		wp_enqueue_style('codemirror', testimonial_plugin_url.'assets/admin/css/codemirror.css');
		wp_enqueue_style('simplescrollbars', testimonial_plugin_url.'assets/admin/css/simplescrollbars.css');		
			
		wp_enqueue_script('layout-editor', plugins_url( 'assets/admin/js/layout-editor.js' , __FILE__ ) , array( 'jquery' ));	
		
		wp_enqueue_style('style.skins', testimonial_plugin_url.'assets/global/css/style.skins.css');
		wp_enqueue_style('style.layout', testimonial_plugin_url.'assets/global/css/style.layout.css');		
		
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'testimonial_color_picker', plugins_url('/assets/admin/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
		
		
		}
		
		
	
	}

new Testimonial();

