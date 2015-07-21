<?php

function paged_post_the_content_filter( $content ) {



	global $multipage, $numpages, $page, $jps_premium;

	$jpps_nav_implementation = get_option( 'jpps_nav_implementation' );	

	$js = ($jpps_nav_implementation=='jQuery'?true:($jps_premium?false:true));

	$page_refresh = ($jpps_nav_implementation=='Page Refresh');

	

	

	//pre($jpps_nav_implementation);

	

	

	//Show Full Post If Full Post Option

	if($_GET['pps'] == 'full_post'){

		global $post;

		$ppscontent .= wpautop($post->post_content);

		if(get_option( 'jpps_show_all_link')){

			$ppscontent .=  '<p class="jps-fullpost-link"><a href="'.get_permalink().'" title="View as Slideshow">View as Slideshow</a></p>';

		}



	//Else Show Slideshow

	} elseif($js){

			$ppscontent = jps_free_options($ppscontent);

	}else {

		

		if(function_exists('jps_premium_options')){

			$ppscontent = jps_premium_options($content);

		}

		

	}

	// Returns the content.

	return $ppscontent;

}



function paged_post_link_pages($r) {

	global $jps_premium;

	

	$next_text_default = 'Next';

	$prev_text_default = 'Prev';

	

	$nav_style = '';

	if($jps_premium){

		$nav_style = get_option( 'jpps_nav_style' );

		$next_text = get_option( 'jps_next_text' );

		$prev_text = get_option( 'jps_prev_text' );			

	}

	$next_text = $next_text?$next_text:$next_text_default;

	$prev_text = $prev_text?$prev_text:$prev_text_default;

	

	$args = array(

		'before'			=> '',

		'after'				=> '',

		'next_or_number'	=> 'next',

		'nextpagelink'		=> __('<span class="jps-next '.$nav_style.'">'.$next_text.'</span>'),

		'previouspagelink'	=> __('<span class="jps-prev '.$nav_style.'">'.$prev_text.'</span>'),

		'echo' => 0

	  );

	  return wp_parse_args($args, $r);



}



function paged_post_scripts() {

	if(is_single() || is_page() ){

		

		global $jps_premium;

		

		wp_enqueue_script('jquery');

		

		$jpps_nav_implementation = get_option( 'jpps_nav_implementation' );	

		$js = ($jpps_nav_implementation=='jQuery'?true:($jps_premium?false:true));

		$page_refresh = ($jpps_nav_implementation=='Page Refresh');

		$ajax = ($jpps_nav_implementation=='Ajax');

		

		if($js){

			

			wp_enqueue_script('paged-post-jquery',plugins_url( 'js/paged-post-jquery.js', dirname(__FILE__)), 'jquery', '', true);

			wp_enqueue_style('paged-post-jquery',plugins_url( 'css/paged-post-jquery.css', dirname(__FILE__)));

			

		}elseif($jps_premium){

			if(function_exists('jps_premium_scripts')){

				jps_premium_scripts();

			}

		}



		if(get_option( 'jpps_style_sheet')){

				wp_enqueue_style('paged-post-style',plugins_url( 'css/paged-post.css' , dirname(__FILE__)));

		}

		

	}

}



function jps_free_options($ppscontent){

		

		global $multipage, $numpages, $page;

		

		$ppscontent_arr = array();

		if ( (is_single() || is_page()) ){

			

			global $post;

			$post_parts = explode('<!--nextpage-->', $post->post_content);
			//pre($post_parts);
			if(!empty($post_parts) && count($post_parts)>1){

				$page = 0; $numpages = count($post_parts);

				foreach($post_parts as $content){ $page++;

						

			

					$sliderclass = 'pagination-slider';

					$slidecount = ($numpages>1?'<span class="jps-slide-count">'.$page.' of '.$numpages.'</span>':'');

					if($page == $numpages){

						$slideclass = 'jps-last-slide';

					} elseif ($page == 1){

						$slideclass = 'jps-first-slide';

					} else{

						$slideclass = 'jps-middle-slide';

					}

			

					//What to Display For Content

					$ppscontent = '<div id="post-part-'.$page.'" class="jps-wrap-content jps-parent-div"><div class="jps-the-content '.$slideclass.'">';

			

					//Top Slider Navigation

					if((get_option( 'jpps_nav_position' ) == 'top')||(get_option( 'jpps_nav_position' ) == 'both')){

						$ppscontent .= ($numpages>1?'<nav class="jps-slider-nav jps-clearfix">':'');

			

						$ppscontent .= wp_link_pages();

			

						// If Loop Option Selected, Loop back to Beginning

						if(get_option( 'jpps_loop_slides')){

							if($page == $numpages){

								$ppscontent .= '<a><span class="jps-next">Next</span></a>';

							}

						}

			

						// Top Slide Counter

						if((get_option( 'jpps_count_position' ) == 'top')||(get_option( 'jpps_count_position' ) == 'both')){

							$ppscontent .= $slidecount;

						}

			

						$ppscontent .= ($numpages>1?'</nav>':'');

					}

			

					//Top Slide Counter Without Top Nav

					if(((get_option( 'jpps_count_position' ) == 'top')||(get_option( 'jpps_count_position' ) == 'both')) && ((get_option( 'jpps_nav_position' ) != 'top')&&(get_option( 'jpps_nav_position' ) != 'both'))){

							$ppscontent .= $slidecount;

					}

			

					// Slide Content

					$ppscontent .= ($numpages>1?'<div class="jps-content jps-clearfix">'.$content.'</div>':'');

			

					// Bottom Slider Navigation

					if((get_option( 'jpps_nav_position' ) == 'bottom')||(get_option( 'jpps_nav_position' ) == 'both')){

						$ppscontent .= ($numpages>1?'<nav class="jps-slider-nav jps-bottom-nav jps-clearfix">':'');

						$ppscontent .= wp_link_pages();

			

						// If Loop Option Selected, Loop back to Beginning

						if(get_option( 'jpps_loop_slides')){

							if($page == $numpages){

								$ppscontent .= '<a><span class="jps-next">Next</span></a>';

							}

						}

			

						// Bottom Slide Counter

						if((get_option( 'jpps_count_position' ) == 'bottom')||(get_option( 'jpps_count_position' ) == 'both')){

							$ppscontent .= $slidecount;

						}

			

						$ppscontent .= ($numpages>1?'</nav>':'');

					}

			

					// Bottom Slide Counter Without Bottom Nav

					if(((get_option( 'jpps_count_position' ) == 'bottom')||(get_option( 'jpps_count_position' ) == 'both')) && ((get_option( 'jpps_nav_position' ) != 'bottom')&&(get_option( 'jpps_nav_position' ) != 'both'))){

							$ppscontent .= $slidecount;

						}

			

					// End Slider Div

					$ppscontent .= ($numpages>1?'</div></div>':'');

			

					// Show Full Post Link

					if(get_option( 'jpps_show_all_link')){

						$ppscontent .=  '<p class="jps-fullpost-link"><a href="'.add_query_arg( 'pps', 'full_post', get_permalink() ).'" title="View Full Post">View Full Post</a></p>';

					}

			

				// Else It Isn't Pagintated, Don't Show Slider

				

				$ppscontent_arr[] = $ppscontent;

				}

				return implode(' ', $ppscontent_arr);
			}else{
				return $post->post_content;
			}

			//exit;

			

		}		

		

}