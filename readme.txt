=== jQuery Post Splitter ===
Contributors: fahadmahmood
Tags: post splitter, slider, paged posts, pagination, ajax, carousel, multi-page, nextpage
Requires at least: 4.0
Tested up to: 4.1
Stable tag: 1.1
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

This plugin will split your post into multipages with a tag. A button to split the pages and posts is vailable in text editor icons.

== Description ==

jQuery Post Splitter is compatible with almost all famous themes and it can be implemented in 3 different ways from which you might will require one. For user friendliness, this plugin come up with a button "Split Page" and easy usage within the text editor. It is light weight and comparatively optimized. 

Wordpress has an excellent, but little known, [feature](http://codex.wordpress.org/Styling_Page-Links) for splitting up long posts into multiple pages. However, a growing trend among major news and blog sites is instead to split up posts into dynamically loading sliders. While there are many slider plugins available for Wordpress, none of them quite tackles this functionality. That's where the jQuery Post Splitter comes in: it takes normal multi-page posts from Wordpress and replaces them with an all-ajax slider that requires almost no setup.

### What the slider does:

*   Replaces Wordpress' built-in post pagination funtionality with an ajax-based carousel.
*   Uses hash based URLs for easy direct linking to specific slides. This also preserves the functionality of the browser's Back button.
*   Automatically adds slide navigation and a slide counter (e.g. '1 of 5') to sliders according to the preferences you set.
*   Adds the 'Insert Page Break' button to the TinyMCE post editor so that you can easily split your content into multiple pages/slides.
*   Provides an optional stylesheet for (very) basic styling of the slider navigation.
*	Optionally allows infinite looping of slides.
*	Optionally provides a link to view all slides on a single page.
*	Optionally allows for scrolling back to top when each slide loads.
*   Degrades gracefully. If the plugin is missing or uninstalled, posts will behave exactly like normal multi-page posts.


== Installation ==

1. Upload the 'paged-post-slider' directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Customize your display options on the PPS Settings page
1. Make paginated posts using the newly visible 'Insert Page Break' button in the post editor
1. Watch the magic happen!

== Frequently Asked Questions ==

= How do I split up my posts into different slides? =

Just treat it like a normal Wordpress multi-page post. To make this extra-easy, the plugin activates the 'Insert Page Break' button in the post editor. Just insert your cursor wherever you want to break between slides and click the button - Bravo! You have a new slide!

For more information about Wordpress' built-in multi-page post funtionality, visit [this page](http://codex.wordpress.org/Styling_Page-Links).

= Why am I seeing an extra Next/Previous navigation element in my theme? =

Your theme contains its own `wp_link_pages()` tag to accomodate Wordpress' built-in post pagination feature. To ensure that this does not interfere with the plugin, please remove any reference to the  `wp_link_pages()` tag from your `single.php` file. Note that it is possible that the tag is inluded in a template part, rather than directly in the `single.php` file itself.

= How can I change the way the slider looks? =

The jQuery Post Splitter is designed to be syled by the user using standard CSS. On the plugin's Settings page, you can choose to use the included styles, but even these are meant only as a basic starting point.

== Screenshots ==

1. Settings Page (Premium Version)
2. Demonstration#1
3. Demonstration#2
4. Navigation Caption is Editable
5. Slider count for both top and bottom
6. Settings overview

== Changelog ==


= 1.0 =
* Intial commit.

== Upgrade Notice ==

