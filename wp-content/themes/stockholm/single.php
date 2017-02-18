<?php


$id = get_the_ID();


$chosen_sidebar = get_post_meta(get_the_ID(), "qode_show-sidebar", true);
$default_array = array('default', '');

if(!in_array($chosen_sidebar, $default_array)){
	$sidebar = get_post_meta(get_the_ID(), "qode_show-sidebar", true);
}else{
	$sidebar = $qode_options['blog_single_sidebar'];
} 

$blog_single_hide_comments = "";
if (isset($qode_options['blog_single_hide_comments']))
	$blog_single_hide_comments = $qode_options['blog_single_hide_comments'];

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
?>
<?php get_header();  ?>

<?php
$portfolio_categories = get_the_category(get_the_ID());
foreach ($portfolio_categories as $portfolio_category) {
	if($portfolio_category->name === 'Painkillกer44444' || $portfolio_category->name === 'Mister Painkiกller5555'){
		$image_header =  get_the_post_thumbnail_url($id);
		if(!empty($image_header)){ ?>
			<style type="text/css">
					.header-painkiller-content{
						position: relative;
					    background-color: rgba(0, 0, 0, 0);
					    background-repeat: no-repeat;
					    background-image: url(<?php echo $image_header ?>);
					    background-size: cover;
					    background-position: center center;
					}
					.page-header .img-wrapper{
						position: relative;
					    background-color: rgba(0, 0, 0, 0);
					    background-repeat: no-repeat;
					    background-image: url(<?php echo $image_header ?>);
					    background-size: cover;
					    background-position: top center;
					}
				</style>
			<?php
		}
		 ?>

		
		<div class="menu-mobile-painkiller"> 
					<?php  if($portfolio_category->name === 'Painkiller'){
						$post_title = 'S/S16 LAND BEFORE TIME';
						$cat_id = '11';
						$args = array( 'category' => $cat_id );
						$recent_posts = wp_get_recent_posts($args);
						$post_title = $recent_posts[0]['post_title'];
					 ?>
					 <ul>
						<li>
							<a href="<?php echo get_site_url().'/latest-painkiller' ?>"> <p> <?php echo $post_title; ?> &nbsp; </p> </a>
						</li>
						<li>
							<a href="<?php echo get_site_url().'/archive-painkiller' ?>"> <p> | &nbsp; Archive &nbsp; </p></a>
						</li>
						<li>
							<a href="<?php echo get_site_url().'/view-by-print' ?>"> <p> | &nbsp; Print </p> </a>
						</li>
					</ul>
					<?php }else{ 
						$cat_id = '4';
						$args = array( 'category' => $cat_id );
						$recent_posts = wp_get_recent_posts($args);
						$post_title = $recent_posts[0]['post_title'];
						?>
						<ul>
						<li>
							<a href="<?php echo get_site_url().'/latest-mister-painkiller' ?>"> <p> <?php echo $post_title; ?> &nbsp; </p> </a>
						</li>
						<li>
							<a href="<?php echo get_site_url().'/archive-mister-painkiller' ?>"> <p> | &nbsp;  Archive </p> </a>
						</li>
					</ul>
						
					<?php } ?>
			    </div>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/painkiller-header.css">
		<div class="page-header">
			<div class="container">
				<div class="container_inner default_template_holder painkiller">
					<div class="img-wrapper">
						<!-- <img src="<?php echo $image_header ?>" class="img-responsive"> -->
					</div>
				</div>
			</div>
			<div class="menu-tab">
				<?php  if($portfolio_category->name === 'Painkiller'){
					$post_title = 'S/S16 LAND BEFORE TIME';
					$cat_id = '11';
					$args = array( 'category' => $cat_id );
					$recent_posts = wp_get_recent_posts($args);
					$post_title = $recent_posts[0]['post_title'];
				 ?>
				<div class="pk-header-menu">
					<a href="<?php echo get_site_url().'/latest-painkiller' ?>"> <p> <?php echo $post_title; ?></p> </a>
				</div>
				<div class="pk-header-menu">
					<a href="<?php echo get_site_url().'/archive-painkiller' ?>"> <p> Archive </p> </a>
				</div>
				<div class="pk-header-menu">
					<a href="<?php echo get_site_url().'/view-by-print' ?>"> <p> View collection by print </p> </a>
				</div>
				<?php }else{ 
					$cat_id = '4';
					$args = array( 'category' => $cat_id );
					$recent_posts = wp_get_recent_posts($args);
					$post_title = $recent_posts[0]['post_title'];
					?>
					<div class="pk-header-menu">
						<a href="<?php echo get_site_url().'/latest-mister-painkiller' ?>"> <p> <?php echo $post_title; ?></p> </a>
					</div>
					<div class="pk-header-menu">
						<a href="<?php echo get_site_url().'/archive-mister-painkiller' ?>"> <p> Archive </p> </a>
					</div>
				<?php } ?>
		    </div>
		</div>
		<!-- <div class="header-painkiller">
			<div class="header-painkiller-content"> 
				
			    
			</div>
		</div> -->
	<?php }
}
?>
<div class="menu-mobile-painkiller"> 
	<h3 class="info_section_title"><?php echo the_title(); ?></h3>
</div>
<?php

if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
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
				<div class="container"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
					<div class="container_inner default_template_holder" <?php if($content_style != "") { echo wp_kses($content_style, array('style')); } ?>>
				
					<?php if(($sidebar == "default")||($sidebar == "")) : ?>
						<div class="blog_holder blog_single">
						<?php 
							get_template_part('templates/blog/blog_single', 'loop');
						?>
						<?php
							if($blog_single_hide_comments != "yes"){
								comments_template('', true); 
							}else{
								echo "<br/><br/>";
							}
						?> 
						
					<?php elseif($sidebar == "1" || $sidebar == "2"): ?>
						<?php if($sidebar == "1") : ?>	
							<div class="two_columns_66_33 background_color_sidebar grid2 clearfix">
							<div class="column1">
						<?php elseif($sidebar == "2") : ?>	
							<div class="two_columns_75_25 background_color_sidebar grid2 clearfix">
								<div class="column1">
						<?php endif; ?>
					
									<div class="column_inner">
										<div class="blog_holder blog_single">	
											<?php 
												get_template_part('templates/blog/blog_single', 'loop');
											?>
										</div>
										
										<?php
											if($blog_single_hide_comments != "yes"){
												comments_template('', true); 
											}else{
												echo "<br/><br/>";
											}
										?> 
									</div>
								</div>	
								<div class="column2"> 
									<?php get_sidebar(); ?>
								</div>
							</div>
						<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
							<?php if($sidebar == "3") : ?>	
								<div class="two_columns_33_66 background_color_sidebar grid2 clearfix">
								<div class="column1"> 
									<?php get_sidebar(); ?>
								</div>
								<div class="column2">
							<?php elseif($sidebar == "4") : ?>	
								<div class="two_columns_25_75 background_color_sidebar grid2 clearfix">
									<div class="column1"> 
										<?php get_sidebar(); ?>
									</div>
									<div class="column2">
							<?php endif; ?>
							
										<div class="column_inner">
											<div class="blog_holder blog_single">	
												<?php 
													get_template_part('templates/blog/blog_single', 'loop');
												?>
											</div>
											<?php
												if($blog_single_hide_comments != "yes"){
													comments_template('', true); 
												}else{
													echo "<br/><br/>";
												}
											?> 
										</div>
									</div>	
									
								</div>
						<?php endif; ?>
					</div>
				</div>
			</div>						
<?php endwhile; ?>
<?php endif; ?>	


<?php get_footer(); ?>	