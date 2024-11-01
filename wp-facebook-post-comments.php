<?php
/*
Plugin Name: WordPress Facebook Post Comments
Plugin URI: http://www.pcpro.co.uk
Description: Adds Facebook Comments to every post in the site
Version: 0.11
Author: Kevin Partner
Author URI: http://www.fixedpricewebsite.co.uk

LICENCE

Copyright 2011  Kevin Partner (email : kevin.partner@scribbleit.co.uk)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/


if (!defined('WP_CONTENT_URL'))
      define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
if (!defined('WP_CONTENT_DIR'))
      define('WP_CONTENT_DIR', ABSPATH.'wp-content');
if (!defined('WP_PLUGIN_URL'))
      define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
if (!defined('WP_PLUGIN_DIR'))
      define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');
      

function activate_wpfacebookpostcomments() {
  add_option('box_width', '600');
  add_option('number_of_comments','4');
}

function deactive_wpfacebookpostcomments() {
  delete_option('box_width');
  delete_option('number_of_comments');
}

function admin_init_wpfacebookpostcomments() {
  register_setting('wpfacebookpostcomments', 'box_width');
  register_setting('wpfacebookpostcomments','number_of_comments');
}

function admin_menu_wpfacebookpostcomments() {
  add_options_page('Facebook Post Comments', 'Facebook Post Comments', 8, 'wp-facebook-post-comments', 'options_page_wpfacebookpostcomments');
}

function options_page_wpfacebookpostcomments() {
  include(WP_PLUGIN_DIR.'/wordpress-facebook-post-comments/options.php');  
}

function addComments_wpfacebookpostcomments($content) {
   if(!is_home()){
        $thisPostURL=site_url().$_SERVER['REQUEST_URI'];
        $boxWidth=get_option('box_width');
        $numberOfComments=get_option('number_of_comments');
        $html=<<<HTML
        <h3>Use Facebook to Comment on this Post</h3>
        <div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:comments href="{$thisPostURL}" num_posts="{$numberOfComments}" width="{$boxWidth}"></fb:comments>
HTML;
        $content.=$html;
    }
   return $content;
}

register_activation_hook(__FILE__, 'activate_wpfacebookpostcomments');
register_deactivation_hook(__FILE__, 'deactive_wpfacebookpostcomments');

if (is_admin()) {
  add_action('admin_init', 'admin_init_wpfacebookpostcomments');
  add_action('admin_menu', 'admin_menu_wpfacebookpostcomments');
}


if (!is_admin()) {
    add_filter('the_content','addComments_wpfacebookpostcomments');
}

?>
