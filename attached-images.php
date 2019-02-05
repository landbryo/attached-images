<?php
/*
 * Plugin Name: Attached Images Meta Box
 * Description: Adds a meta box to posts showing all attached images.
 * Author: Landon Otis
 * Author URI: https://scree.it
 * Version: 02052019
 */

// Add meta box to posts showing all attached images
function sc_attached_mb() {
    add_meta_box( 'meta-box-sc-attached', 'Attached Photos', 'sc_attached_cb', 'post' );
}
add_action( 'add_meta_boxes', 'sc_attached_mb' );
 
// Callback function returning list of images to the meta box
function sc_attached_cb( $post ) {
    $attachments = get_posts( array(
        'post_type'   => 'attachment',
        'numberposts' => -1,
        'post_status' => null,
        'post_parent' => $post->ID
    ));

    echo '<ul id="attached-list">';
    foreach( $attachments as $attachment) {
        echo '<li><a href="' . wp_get_attachment_url($attachment->ID) . '" target="_blank">' . wp_get_attachment_image($attachment->ID, 'thumbnail', false , array( id => 'attached-' . $attachment->ID ,"class" => "img-responsive attached-image" )) . '</a></li>';
    }
    echo '</ul>';
}
