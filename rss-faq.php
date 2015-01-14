<?php
/*
	Plugin Name: RSS-FAQ
	Plugin URI: 
	Description: RSS-FAQ parses a Wordpress RSS Feed and builds a simple accordion by the post title and content.
	Version: 1.0.0
	Author: Peter Amende
	Author URI: http://zutrinken.com/
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

add_action( 'wp_enqueue_scripts','add_rss_faq_scripts' );
function add_rss_faq_scripts() {
	wp_enqueue_script( 'rss-faq-script', plugins_url( 'rss-faq.js', __FILE__ ), array(), true, true );
}

add_action( 'wp_print_styles', 'add_rss_faq_styles' );
function add_rss_faq_styles() {
	wp_enqueue_style( 'rss-faq-style', plugins_url( 'rss-faq.css', __FILE__ ), array() );
}

function display_rss_faq_shortcode( $atts ) {
	
	extract( shortcode_atts( array(
		'url'	=> '',
	), $atts));

	if ( $url ) {

	    $feed = simplexml_load_file( $url );
	
		$output	= '';
	
	    foreach ( $feed->channel->item as $item ):
	
	        $title		= $item->title;
	        $content	= $item->children( 'content', true );
			
			$output .= '<li class="rss-faq-item">';
			$output .= '<h4 class="rss-faq-title">' . $title . '</h4>';
			$output .= '<div class="rss-faq-content">';
			$output .= $content;
			$output .= '</div>';
			$output .= '</li>';
			
	    endforeach;
	
		$return = '<ul id="rss-faq" class="rss-faq">' . apply_filters( 'display_rss_faq_shortcode', $output ) . '</ul>';
	
		if ( !empty( $return ) ) return $return;
	
	}
}
add_shortcode( 'faq', 'display_rss_faq_shortcode' );

?>