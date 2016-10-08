<?php
/*
Template Name: Blog Pinterest Full Width
*/
?>
<?php get_header(); ?>
<?php
global $wp_query;
global $qode_template_name;
global $qode_page_id;
$qode_page_id = $wp_query->get_queried_object_id();
$id = $wp_query->get_queried_object_id();
$qode_template_name = get_page_template_slug($id);
$category = get_post_meta($id, "qode_choose-blog-category", true);
$post_number = get_post_meta($id, "qode_show-posts-per-page", true);
if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }
$page_object = get_post( $id );
$q_content = $page_object->post_content;
$page_archieve = '';
$collection_page = '';

$q_content = apply_filters( 'the_content', $q_content );
$sidebar = get_post_meta($id, "qode_show-sidebar", true);

if(get_post_meta($id, "qode_page_background_color", true) != ""){
	$background_color = get_post_meta($id, "qode_page_background_color", true);
}else{
	$background_color = "";
}

$content_style = "";
if(get_post_meta($id, "qode_content-top-padding", true) != ""){
	if(get_post_meta($id, "qode_content-top-padding-mobile", true) == "yes"){
		$content_style = "style='padding-top:".get_post_meta($id, "qode_content-top-padding", true)."px !important'";
	}else{
		$content_style = "style='padding-top:".get_post_meta($id, "qode_content-top-padding", true)."px'";
	}
}

if($qode_options['number_of_chars_masonry'] != "") {
	qode_set_blog_word_count($qode_options['number_of_chars_masonry']);
}

$category_filter = "no";
if(isset($qode_options['blog_masonry_filter'])){
	$category_filter = $qode_options['blog_masonry_filter'];
}
//$category_filter = "yes";

$container_inner_class = "";
if($category_filter == "yes"){
	$container_inner_class = " full_page_container_inner";
}
?>

	<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
		<script>
		var page_scroll_amount_for_sticky = <?php echo get_post_meta($id, "qode_page_scroll_amount_for_sticky", true); ?>;
		</script>
	<?php } ?>
		<?php get_template_part( 'title' ); ?>

	<?php
		$page = split('/',$_SERVER["REQUEST_URI"])[2];
		$css_class = '';
		if($page === 'archieve-mister-painkiller' || $page === 'archieve-painkiller'){
			$css_class = 'no-padding-top';
		}
		if($page !== 'archieve-mister-painkiller' && $page !== 'archieve-painkiller'){
			get_template_part('templates/painkiller/homepage-header');
		}

		$revslider = get_post_meta($id, "qode_revolution-slider", true);
		if (!empty($revslider)){ ?>
			<div class="q_slider"><div class="q_slider_inner">
			<?php //echo do_shortcode($revslider); ?>
			</div></div>
		<?php
		}
		?>
	<?php
		query_posts('post_type=post&paged='. $paged . '&cat=' . $category .'&posts_per_page=' . $post_number );
		if(isset($qode_options['blog_page_range']) && $qode_options['blog_page_range'] != ""){
			$blog_page_range = $qode_options['blog_page_range'];
		} else{
			$blog_page_range = $wp_query->max_num_pages;
		}
	?>
	
	<div class="full_width"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
		<div class="full_width_inner<?php echo esc_attr($container_inner_class); ?>" <?php if($content_style != "") { echo wp_kses($content_style, array('style')); } ?>>
			<?php
				print $q_content;
				if($page === 'archieve-mister-painkiller' || $page === 'archieve-painkiller'){

					if($page === 'archieve-painkiller'){
						$page_archieve = '/archieve-painkiller';
						$collection_page = '/latest-painkiller';
					}else{
						$page_archieve = '/archieve-mister-painkiller';
						$collection_page = '/latest-mister-painkiller';
					}
					?>
					<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/paint-page.css">

					<style type="text/css">
						header{
							position: fixed;
						}
						
					</style>

					<div class="paint">
						<div class="paint-page"> 
							<div class="paint-menu-wrapper"> 
								<div class="paint-menu">
								<ul>
									<li>
										<a href="<?php echo get_site_url().$collection_page ?>"> <p> S/S16 LAND BEFORE TIME </p> </a>
									</li>
									<li>
										<a href="<?php echo get_site_url().$page_archieve ?>"> <p> Archive </p> </a>
									</li>
									<?php if($page === 'archieve-painkiller'){?>
									<li>
										<a href="<?php echo get_site_url().'/view-by-print' ?>"> <p> View collection by print </p> </a>
									</li>
									<?php } ?>
								</ul>
								</div>
						    </div>
						    <div class='paint-content col-masonry'>

					 <?php get_template_part('templates/blog/blog', 'structure'); ?>

						    </div>
						</div>
					</div>
				<?php } else { 

				get_template_part('templates/blog/blog', 'structure'); 
			} ?>
		</div>
	</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>