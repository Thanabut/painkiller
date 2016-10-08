<?php 
/*
Template Name: Latest Mister Painkiller Template
*/ 
$cat_id = '4';
$args = array( 'category' => $cat_id );
$recent_posts = wp_get_recent_posts($args);
$id = $recent_posts[0]['ID'];

$url = get_permalink($id);
if ( wp_redirect( $url ) ) {
    exit;
}
?>