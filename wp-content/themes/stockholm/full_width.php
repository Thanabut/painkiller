<?php 
/*
Template Name: Full Width
*/ 
?>
<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();
$sidebar = get_post_meta($id, "qode_show-sidebar", true);  

$enable_page_comments = false;
if(get_post_meta($id, "qode_enable-page-comments", true) == 'yes') {
	$enable_page_comments = true;
}

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

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

?>
	<?php get_header(); ?>
		<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
			<script>
			var page_scroll_amount_for_sticky = <?php echo get_post_meta($id, "qode_page_scroll_amount_for_sticky", true); ?>;
			</script>
		<?php } ?>
			<?php get_template_part( 'title' ); ?>
		<?php
		$revslider = get_post_meta($id, "qode_revolution-slider", true);
		if (!empty($revslider)){ ?>
			<div class="q_slider"><div class="q_slider_inner">
			<?php echo do_shortcode($revslider); ?>
			</div></div>
		<?php
		}
		?>
	<div class="full_width <?php if($pagename === 'view-by-print') echo "view-by-print"; ?>"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
	<div class="full_width_inner" <?php if($content_style != "") { echo wp_kses($content_style, array('style')); } ?>>
		<?php if(($sidebar == "default")||($sidebar == "")) : ?>
			<?php if($pagename === 'view-by-print'): 
				$cat_id = '11';
				$args = array( 'category' => $cat_id );
				$recent_posts = wp_get_recent_posts($args);
				$post_title = $recent_posts[0]['post_title'];
				
				?>
				<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/paint-page.css">

				<style type="text/css">
					header{
						position: fixed;
					}

					footer .footer_top .container{
						background-color: #ffffff;
					}
					
				</style>

				<div class="paint">
					<div class="paint-page"> 
						<div class="paint-menu-wrapper"> 
							<div class="view-by-print-menu">
								<div class='submenu-desktop'> 
									<ul>
										<li>
											<a href="<?php echo get_site_url().'/latest-painkiller' ?>"> <p> <?php echo $post_title; ?></p> </a>
										</li>
										<li>
											<a href="<?php echo get_site_url().'/archive-painkiller' ?>"> <p> Archive </p> </a>
										</li>
										<li>
											<a href="<?php echo get_site_url().'/view-by-print' ?>"> <p> View collection by print </p> </a>
										</li>
									</ul>
								</div>
								<div class='submenu-mobile'> 
									<ul>
										<li>
											<a href="<?php echo get_site_url().'/latest-painkiller' ?>"> <p> <?php echo $post_title; ?></p> </a> 
										</li>
										<li>
											<a href="<?php echo get_site_url().'/archive-painkiller' ?>"> <p> | &nbsp; Archive  </p> </a>
										</li>
										<li>
											<a href="<?php echo get_site_url().'/view-by-print' ?>"> <p> | &nbsp; Print </p> </a>
										</li>
									</ul>
								</div>
							</div>
					    </div>
					    <div class='paint-content'>
			<?php endif; ?>
			<?php if (have_posts()) : 
					while (have_posts()) : the_post(); ?>


					
					<?php the_content(); ?>
					<?php 
 $args_pages = array(
  'before'           => '<p class="single_links_pages">',
  'after'            => '</p>',
  'pagelink'         => '<span>%</span>'
 );

 wp_link_pages($args_pages); ?>
					<?php
					if($enable_page_comments){
					?>
					<div class="container">
						<div class="container_inner">
					<?php
						comments_template('', true); 
					?>
						</div>
					</div>	
					<?php
					}
					?> 
					<?php endwhile; ?>
				<?php endif; ?>
				<?php if($pagename === 'view-by-print'): ?>
						</div>
					</div>
				<?php endif; ?>
		<?php elseif($sidebar == "1" || $sidebar == "2"): ?>		
			
			<?php if($sidebar == "1") : ?>	
				<div class="two_columns_66_33 clearfix grid2">
					<div class="column1">
			<?php elseif($sidebar == "2") : ?>	
				<div class="two_columns_75_25 clearfix grid2">
					<div class="column1">
			<?php endif; ?>
					<?php if (have_posts()) : 
						while (have_posts()) : the_post(); ?>
						<div class="column_inner">
						
						<?php the_content(); ?>	
						<?php 
 $args_pages = array(
  'before'           => '<p class="single_links_pages">',
  'after'            => '</p>',
  'pagelink'         => '<span>%</span>'
 );

 wp_link_pages($args_pages); ?>
							<?php
							if($enable_page_comments){
							?>
							<div class="container">
								<div class="container_inner">
							<?php
								comments_template('', true); 
							?>
								</div>
							</div>	
							<?php
							}
							?> 
						</div>
				<?php endwhile; ?>
				<?php endif; ?>
			
							
					</div>
					<div class="column2"><?php get_sidebar();?></div>
				</div>
			<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
				<?php if($sidebar == "3") : ?>	
					<div class="two_columns_33_66 clearfix grid2">
						<div class="column1"><?php get_sidebar();?></div>
						<div class="column2">
				<?php elseif($sidebar == "4") : ?>	
					<div class="two_columns_25_75 clearfix grid2">
						<div class="column1"><?php get_sidebar();?></div>
						<div class="column2">
				<?php endif; ?>
						<?php if (have_posts()) : 
							while (have_posts()) : the_post(); ?>
							<div class="column_inner">
							<?php the_content(); ?>		
							<?php 
 $args_pages = array(
  'before'           => '<p class="single_links_pages">',
  'after'            => '</p>',
  'pagelink'         => '<span>%</span>'
 );

 wp_link_pages($args_pages); ?>
							<?php
							if($enable_page_comments){
							?>
							<div class="container">
								<div class="container_inner">
							<?php
								comments_template('', true); 
							?>
								</div>
							</div>	
							<?php
							}
							?> 
							</div>
					<?php endwhile; ?>
					<?php endif; ?>
				
								
						</div>
						
					</div>
			<?php endif; ?>
	</div>
	</div>	
	<?php get_footer(); ?>
