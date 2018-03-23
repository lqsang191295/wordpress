<?php
  /*
    Plugin Name: Website Popups
    Plugin URI:  https://wordpress.org/plugins/website-popups/
    Description: Create amazing Popups from your wordpress site and host them anywhere. Run A/B tests, monitor analytics, improve conversion rates and much more.
    Version:     2.1
    Author:      Wishpond
    Author URI:  https://www.wishpond.com/website-popups/
    License:     GPL2
    License URI: https://www.gnu.org/licenses/gpl-2.0.html
    Text Domain: website-popups
    Domain Path: /lang

    Website Popups is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 2 of the License, or
    any later version.

    Website Popups is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Website Popups. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
  */

  load_plugin_textdomain('website-popups', false, dirname(plugin_basename(__FILE__)) . '/lang/');

  $WP_PLUGIN_FILES = array(
    'constants.php',
    'class-wishpond-campaign.php',
    'class-wishpond-plugin.php',
    'class-wishpond-shortcode.php',
    'class-wishpond-utilities.php'
  );

  foreach($WP_PLUGIN_FILES as $file) {
    include_once(plugin_dir_path(__FILE__) . $file);
  }

  new WishpondPlugin(
    array(
      'version' => '2.1',
      'name' => 'website_popups',
      'slug' => 'website-popups',
      'menu' => array(
        'main'      => __('Popups', 'website-popups'),
        'dashboard' => __('Dashboard', 'website-popups'),
        'editor'    => __('New Popup', 'website-popups'),
        'settings'  => __('Settings', 'website-popups')
      )
    )
  );
?>
