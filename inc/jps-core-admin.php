<?php

//Add Settings Link To Plugins Page
function jpps_plugin_meta($links, $file) {
	$plugin = plugin_basename(__FILE__);
	// create link
	if ($file == $plugin) {
		return array_merge(
			$links,
			array( sprintf( '<a href="options-general.php?page=jpsoptions">Settings</a>', $plugin, __('Settings') ) )
		);
	}
	return $links;
}


function jpps_add_options() {
	global $jps_title;
	add_options_page('Paged Slider Settings', $jps_title, 'manage_options', 'jpsoptions', 'jpps_options_page');
}

function jpps_options_page() {
	
	global $jps_title, $jps_premium_link, $jps_premium;
	$opt_name = array(
					'nav_implementation' => 'jpps_nav_implementation',
					'nav_position' =>'jpps_nav_position',
					'nav_style' => 'jpps_nav_style',
					'count_position' => 'jpps_count_position',
					'style_sheet' => 'jpps_style_sheet',
					'show_all_link' => 'jpps_show_all_link',
					'loop_slides' => 'jpps_loop_slides',
					'scroll_up' => 'jpps_scroll_up',
					'next_text' => 'jps_next_text',
					'prev_text' => 'jps_prev_text');
		
	$hidden_field_name = 'jpps_submit_hidden';
	

	// Read in existing option value from database
	$opt_val = array(
				'nav_implementation' => get_option( $opt_name['nav_implementation'] ),
				'nav_position' => get_option( $opt_name['nav_position'] ),
				'nav_style' => get_option( $opt_name['nav_style'] ),
				'count_position' => get_option( $opt_name['count_position'] ),
				'style_sheet' => get_option( $opt_name['style_sheet'] ),
				'show_all_link' => get_option( $opt_name['show_all_link'] ),
				'loop_slides' => get_option( $opt_name['loop_slides'] ),
				'scroll_up' => get_option( $opt_name['scroll_up'] ),
				'next_text' => get_option( $opt_name['next_text'] ),
				'prev_text' => get_option( $opt_name['prev_text'] ));

	//pre($opt_val);
	
	// See if the user has posted us some information
	// If they did, this hidden field will be set to 'Y'
	if(isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
		// Read their posted value
		$opt_val = array(
					'nav_implementation' => $_POST[ $opt_name['nav_implementation'] ],
					'nav_position' => $_POST[ $opt_name['nav_position'] ],
					'nav_style' => $_POST[ $opt_name['nav_style'] ],
					'count_position' => $_POST[ $opt_name['count_position'] ],
					'style_sheet' => $_POST[ $opt_name['style_sheet'] ],
					'show_all_link' => $_POST[ $opt_name['show_all_link'] ],
					'loop_slides' => $_POST[ $opt_name['loop_slides'] ],
					'scroll_up' => $_POST[ $opt_name['scroll_up'] ],
					'next_text' => $_POST[ $opt_name['next_text'] ],
					'prev_text' => $_POST[ $opt_name['prev_text'] ]);

		// Save the posted value in the database
		update_option( $opt_name['nav_implementation'], $opt_val['nav_implementation'] );
		
		update_option( $opt_name['nav_position'], $opt_val['nav_position'] );
		update_option( $opt_name['nav_style'], $opt_val['nav_style'] );
		update_option( $opt_name['count_position'], $opt_val['count_position'] );
		update_option( $opt_name['style_sheet'], $opt_val['style_sheet'] );
		update_option( $opt_name['show_all_link'], $opt_val['show_all_link'] );
		update_option( $opt_name['loop_slides'], $opt_val['loop_slides'] );
		update_option( $opt_name['scroll_up'], $opt_val['scroll_up'] );
		update_option( $opt_name['next_text'], $opt_val['next_text'] );
		update_option( $opt_name['prev_text'], $opt_val['prev_text'] );

		// Put an options updated message on the screen
		?>
		<div id="message" class="updated fade">
			<p><strong>
				<?php _e('Options saved.', 'jpps_trans_domain' ); ?>
			</strong></p>
		</div>
	<?php
		}

	//Options Form
	?>
	<div class="wrap">
		<h2><?php _e( $jps_title.' Options', 'jpps_trans_domain' ); ?></h2>

		<form name="jpps_img_options" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
			<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

			<table class="form-table">
				<tbody>
                
              	  <tr valign="top">
						<th scope="row">
							<label for="<?php echo $opt_name['nav_implementation']; ?>">Implementation:</label>
						</th>
						<td>
							<select name="<?php echo $opt_name['nav_implementation']; ?>">
                            <option value="jQuery" <?php echo ($opt_val['nav_implementation'] == "jQuery") ? 'selected="selected"' : ''; ?> >jQuery</option>
                            
                            <option <?php echo $jps_premium?'':'disabled="disabled"'; ?> value="Ajax" <?php echo ($opt_val['nav_implementation'] == "Ajax") ? 'selected="selected"' : ''; ?> >Ajax<?php echo $jps_premium?'':' (Premium)'; ?></option>
                            <option <?php echo $jps_premium?'':'disabled="disabled"'; ?> value="Page Refresh" <?php echo ($opt_val['nav_implementation'] == "Page Refresh") ? 'selected="selected"' : ''; ?> >Page Refresh<?php echo $jps_premium?'':' (Premium)'; ?></option>
							</select>
                            
                           <?php if(!$jps_premium): ?>
                           <a href="<?php echo $jps_premium_link; ?>" target="_blank" class="jps_premium_link">Go Premium</a>
                           <?php endif; ?>
						</td>
					</tr>

					<tr valign="top">
						<th scope="row">
							<label for="<?php echo $opt_name['nav_position']; ?>">Slider Navigation Position:</label>
						</th>
						<td>
							<select name="<?php echo $opt_name['nav_position']; ?>">
								<option value="top" <?php echo ($opt_val['nav_position'] == "top") ? 'selected="selected"' : ''; ?> >Top</option>
								<option value="bottom" <?php echo ($opt_val['nav_position'] == "bottom") ? 'selected="selected"' : ''; ?> >Bottom</option>
								<option value="both" <?php echo ($opt_val['nav_position'] == "both") ? 'selected="selected"' : ''; ?> >Both</option>
							</select>
						</td>
					</tr>
                    
<?php if($jps_premium): ?>                    
<?php jps_nav_styles($opt_name, $opt_val); ?>
<?php endif; ?>                                        

					<tr valign="top">
						<th scope="row">
							<label for="<?php echo $opt_name['count_position']?>">Slider Count (e.g. "2 of 4") Position:</label>
						</th>
						<td>
							<select name="<?php echo $opt_name['count_position']; ?>">
								<option value="top" <?php echo ($opt_val['count_position'] == "top") ? 'selected="selected"' : ''; ?> >Top</option>
								<option value="bottom" <?php echo ($opt_val['count_position'] == "bottom") ? 'selected="selected"' : ''; ?> >Bottom</option>
								<option value="both" <?php echo ($opt_val['count_position'] == "both") ? 'selected="selected"' : ''; ?> >Both</option>
								<option value="none" <?php echo ($opt_val['count_position'] == "none") ? 'selected="selected"' : ''; ?> >Do Not Display</option>
							</select>
						</td>
					</tr>

					<tr valign="top">
						<th scope="row">
							<label for="<?php echo $opt_name['style_sheet']?>">Use Style Sheet?</label>
						</th>
						<td>
								<input name="<?php echo $opt_name['style_sheet']; ?>" type="checkbox" value="1" <?php checked( '1', $opt_val['style_sheet'] ); ?> /> If unchecked, no styles will be added.
						</td>
					</tr>

					<tr valign="top">
						<th scope="row">
							<label for="<?php echo $opt_name['show_all_link']?>">Display link to <em>View Full Post</em>?</label>
						</th>
						<td>
								<input name="<?php echo $opt_name['show_all_link']; ?>" type="checkbox" value="1" <?php checked( '1', $opt_val['show_all_link'] ); ?> /> If unchecked, the <em>View Full Post</em> link will not be displayed.
						</td>
					</tr>

					<tr valign="top">
						<th scope="row">
							<label for="<?php echo $opt_name['loop_slides']?>">Loop slides?</label>
						</th>
						<td>
								<input name="<?php echo $opt_name['loop_slides']; ?>" type="checkbox" value="1" <?php checked( '1', $opt_val['loop_slides'] ); ?> /> Creates an infinite loop of the slides.
						</td>
					</tr>

					<tr valign="top">
						<th scope="row">
							<label for="<?php echo $opt_name['scroll_up']?>">Scroll to top of page after slide load? (Ajax)</label>
						</th>
						<td>
								<input name="<?php echo $opt_name['scroll_up']; ?>" type="checkbox" value="1" <?php checked( '1', $opt_val['scroll_up'] ); ?> /> Scrolls up to the top of the page after each slide loads.
						</td>
					</tr>

				</tbody>
			</table>

			<p>
				<input type="submit" class="button button-primary" value="Save Settings">
			</p>

		</form>


<?php }


function paged_post_tinymce($mce_buttons) {
	$pos = array_search('wp_more', $mce_buttons, true);
	if ($pos !== false) {
		$buttons = array_slice($mce_buttons, 0, $pos + 1);

		$buttons[] = 'wp_page';

		$mce_buttons = array_merge($buttons, array_slice($mce_buttons, $pos + 1));
	}
	return $mce_buttons;
}

function jps_plugin_links($links) { 
		global $jps_premium_link, $jps_premium;
		
		$settings_link = '<a href="options-general.php?page=jpsoptions">Settings</a>';
		
		if($jps_premium){
			array_unshift($links, $settings_link); 
		}else{
			$jps_premium_link = '<a href="'.$jps_premium_link.'" title="Go Premium" target=_blank>Go Premium</a>'; 
			array_unshift($links, $settings_link, $jps_premium_link); 
		
		}
		
		
		return $links; 
}

function jps_admin_scripts(){
	wp_enqueue_style('paged-post-style',plugins_url( 'css/jps-admin.css' , dirname(__FILE__)));
}