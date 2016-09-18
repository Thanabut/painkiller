<?php 
global $qode_options;
$blog_author_info="no";
//init variables

get_template_part('templates/portfolio/portfolio-small-images');
$portfolio_images = get_post_meta(get_the_ID(), "qode_portfolio-image-gallery", true);

if (isset($qode_options['blog_author_info'])) {
	$blog_author_info = $qode_options['blog_author_info'];
}
$blog_hide_author = "";
if (isset($qode_options['blog_hide_author'])) {
    $blog_hide_author = $qode_options['blog_hide_author'];
}
$blog_single_hide_date = false;
if (isset($qode_options['blog_single_hide_date']) && $qode_options['blog_single_hide_date'] == "yes") {
    $blog_single_hide_date = true;
}
$blog_single_hide_category = false;
if (isset($qode_options['blog_single_hide_category']) && $qode_options['blog_single_hide_category'] == "yes") {
    $blog_single_hide_category = true;
}



?>
