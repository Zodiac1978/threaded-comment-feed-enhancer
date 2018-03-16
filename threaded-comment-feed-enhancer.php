<?php
/**
 * Plugin Name: Threaded Comment Feed Enhancer
 * Description: Enhances the threaded comments feed
 * Version:     1.3.0
 * Author:      Torsten Landsiedel
 * Author URI:  http://torstenlandsiedel.de
 * Plugin URI:  http://torstenlandsiedel.de
 * Text Domain: threaded-comment-feed-enhancer
 * License:     GPLv3
 * License URI: http://www.gnu.org/licenses/gpl-3.0
 */

/* Thanks to Dominik Schilling (@ocean90) and Thomas Scholz (@toscho) for many hints */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Load Translation
function threaded_comment_feed_enhancer_init() {
  load_plugin_textdomain( 'threaded-comment-feed-enhancer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
// add_action('plugins_loaded', 'threaded_comment_feed_enhancer_init');
add_action( 'init', 'threaded_comment_feed_enhancer_init' );


// Add info text in comment body if there is a threaded comment 
function threaded_comment_feed_body_enhancer( $comment_text ) {
  
  if ( !is_comment_feed() )
    return $comment_text;

  $comment_id = get_comment_ID();
  $comment_object = get_comment( $comment_id );

  if ( ! $comment_object->comment_parent )
    return $comment_text; 
  
  $parent_comment_object = get_comment( $comment_object->comment_parent );
  $parent_comment_link = esc_url( get_comment_link ( $parent_comment_object->comment_ID ) );
  $parent_comment_author = esc_html( $parent_comment_object->comment_author );
  $parent_comment_content = $comment_object->comment_content;
  
  $message  = sprintf( __( 'In reply to %s.', 'threaded-comment-feed-enhancer' ), '<a href="' . $parent_comment_link . '">' . $parent_comment_author . '</a>' );
  $message .= '<br><br>';
  $message .= '<blockquote>' . $parent_comment_object->comment_content . '</blockquote>';
  $message .= '<br><br>';
  $message .= $comment_text;

  return $message;
}

if ( !is_admin() && get_option( 'thread_comments' ) ) {
  add_filter ('comment_text', 'threaded_comment_feed_body_enhancer');
  add_filter ('comment_text_rss', 'threaded_comment_feed_body_enhancer');
}
