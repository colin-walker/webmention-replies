<?php

  if(!defined('ABSPATH')) exit; //Don't run if accessed directly


/**
 *  Webmention Replies
 *
 *  @package Webmention Replies
 *
 *  Plugin Name: Webmention Replies
 *
 *
 *  Description: Re-add the webmention comment type to webmention replies for easier filtering
 *
 *  Requires: Semantic Linkbacks
 *
 *  Version: 1.0
 *
 *  Author: Colin Walker
 *
*/

function wm_comment_type( $comment_ID ) {

  $wmreply = get_comment_meta( $comment_ID, 'semantic_linkbacks_type', true );
  global $wpdb;

  if ( $wmreply == 'reply' ) {  

    $result = $wpdb->update(
      $wpdb->comments,
 
      array(
        'comment_type' => 'webmention' 
      ),
 
      array(
        'comment_ID' => $comment_ID
      ),

      array( 
		    '%s'
      ) 
    );

  }
}

add_action( 'comment_post', 'wm_comment_type', 100, 1 );

?>