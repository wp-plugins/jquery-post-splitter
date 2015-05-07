<?php
/*
Plugin Name: jQuery Post Splitter
Plugin URI: http://www.websitedesignwebsitedevelopment.com/wordpress/plugins/jquery-post-splitter
Description: This plugin will split your post into multipages with a tag. A button to split the pages and posts is vailable in text editor icons.
Version: 1.1
Author: Fahad Mahmood
Author URI: http://shop.androidbubbles.com/
License: GPL3
*/
	global $jps_dir, $jps_premium_link, $jps_premium, $jps_title;
	
	
	$jps_dir = plugin_dir_path( __FILE__ );
	$jps_premium_scripts = $jps_dir.'pro/jps-core-premium.php';
	$jps_premium = file_exists($jps_premium_scripts);
	if($jps_premium){
		include($jps_premium_scripts);
	}
	$jps_title = ('jQuery Post Splitter'.($jps_premium?' Pro':''));
		
	if(!function_exists('pre')){
	function pre($data){
			echo '<pre>';
			print_r($data);
			echo '</pre>';	
		}	 
	}	
	
	if(is_admin()){	
	
		
		$jps_premium_link = 'http://shop.androidbubbles.com/product/jquery-post-splitter-premium';
		
		include($jps_dir.'inc/split-buttons.php');
		include($jps_dir.'inc/jps-core-admin.php');
		
		add_filter('mce_buttons', 'paged_post_tinymce');
		add_action('admin_menu', 'jpps_add_options');
		add_filter( 'plugin_row_meta', 'jpps_plugin_meta', 10, 2 );
		
		add_action('admin_enqueue_scripts', 'jps_admin_scripts');
		
		$plugin = plugin_basename(__FILE__); 
		add_filter("plugin_action_links_$plugin", 'jps_plugin_links' );	
		
		
		
	}else{
		
		include($jps_dir.'inc/jps-core-front.php');
		
		add_filter('wp_link_pages_args','paged_post_link_pages');
		add_filter( 'the_content', 'paged_post_the_content_filter' );
		add_action( 'wp_enqueue_scripts', 'paged_post_scripts' );
		
	}
	
	
?>