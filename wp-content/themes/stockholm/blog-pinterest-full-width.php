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
$page_archive = '';
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
		if($page === 'archive-mister-painkiller' || $page === 'archive-painkiller'){
			$css_class = 'archive-padding';
		}
		if($page !== 'archive-mister-painkiller' && $page !== 'archive-painkiller'){
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
	
	<div class="full_width <?php echo $css_class; ?>"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
		<div class="full_width_inner <?php echo esc_attr($container_inner_class); ?> " <?php if($content_style != "") { echo wp_kses($content_style, array('style')); } ?>>
			<?php
				print $q_content;
				if($page === 'archive-mister-painkiller' || $page === 'archive-painkiller'){

					if($page === 'archive-painkiller'){
						$page_archive = '/archive-painkiller';
						$collection_page = '/latest-painkiller';
						$cat_id = '11';
						$args = array( 'category' => $cat_id );
						$recent_posts = wp_get_recent_posts($args);
						$post_title = $recent_posts[0]['post_title'];
					}else{
						$cat_id = '4';
						$args = array( 'category' => $cat_id );
						$recent_posts = wp_get_recent_posts($args);
						$post_title = $recent_posts[0]['post_title'];
						$page_archive = '/archive-mister-painkiller';
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
									<div class='submenu-desktop'> 
										<ul>
											<li>
												<a href="<?php echo get_site_url().$collection_page ?>"> <p> <?php echo $post_title; ?> </p> </a> 
											</li>
											<li>
												<a href="<?php echo get_site_url().$page_archive ?>"> <p> Archive </p> </a>
											</li>
											<?php if($page === 'archive-painkiller'){?>
											<li>
												<a href="<?php echo get_site_url().'/view-by-print' ?>"> <p> View collection by print </p> </a>
											</li>
											<?php } ?>
										</ul>
									</div>
									<div class='submenu-mobile'> 
										<ul>
											<li>
												<a href="<?php echo get_site_url().$collection_page ?>"> <p> <?php echo $post_title; ?> </p> </a> 
											</li>
											<li>
												<a href="<?php echo get_site_url().$page_archive ?>"> <p> | &nbsp; Archive  </p> </a>
											</li>
											<?php if($page === 'archive-painkiller'){?>
											<li>
												<a href="<?php echo get_site_url().'/view-by-print' ?>"> <p> | &nbsp; Print </p> </a>
											</li>
											<?php } ?>
										</ul>
									</div>
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
	<div id="myModal" class="modal">

		  <!-- Modal content -->
		  <div class="modal-content">
		    <div class="modal-header">
		      <span class="close">×</span>
		      <h2>SHARE</h2>
		    </div>
		    <?php $share_id = ''; ?>
		    <input type="hidden" class="share-id" id="share" value=""/>
		    <div class="modal-body">
		    <a id="shareBtn" class="btn btn-success clearfix">Fb Share</a>
		    <a id="twitterBtn" href="#" class="btn btn-success clearfix">Twitter Share</a>
		     
		    </div>
		  </div>

		</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
<!-- The Modal -->
		
<script>
// Get the modal



(function($) {
	
	$(document).ready(function(){
		// $.ajaxSetup({ cache: true });
		//   $.getScript('//connect.facebook.net/en_US/sdk.js', function(){
		//     FB.init({
		//       appId: '342131019456401',
		//       version: 'v2.7' // or v2.1, v2.2, v2.3, ...
		//     });     
		//     // $('#loginbutton,#feedbutton').removeAttr('disabled');
		//     // FB.getLoginStatus(updateStatusCallback);
		//   });

		var modal = document.getElementById('myModal');
		// Get the button that opens the modal
		var btn = document.getElementById("myBtn");

		var btn = $('.share').data('id');
		// console.log(btn);

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];
		// When the user clicks the button, open the modal
		btn.onclick = function() {
		    modal.style.display = "block";
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		    modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		    if (event.target == modal) {
		        modal.style.display = "none";
		    }
		} 

		$('.share').on('click', function(){
			 modal.style.display = "block";
			 // $('.share-id').value($(this).data('id'));
			 var cur_article = $(this).parents("article");
			 console.log(cur_article+"DD");
			 var post_img = cur_article.find(".post_image > a > img").prop("src");
			 var post_title = cur_article.find(".post_text > .post_text_inner > h4 > a").text();
			 var url = cur_article.find(".post_text > .post_text_inner > h4 > a").prop("href");
			 // console.log(url);
			 // url = "http://dev.painkilleratelier.com/painkiller/";
			 
			 // $("#shareBtn").off("click").on("click",function(){
			 // 	FB.ui({
				//     method: 'share',
				//     mobile_iframe: true,
				//     href: url,
				// }, function(response){});
			 // });
			 $("#shareBtn").off("click").on("click",function(e){
			 	e.preventDefault();
			 	window.open('http://www.facebook.com/sharer.php?s=100&p[title]='+encodeURIComponent(post_title)+'&p[url]='+encodeURIComponent(url)+'&p[images][0]='+encodeURIComponent(post_img)+'&p[summary]=', 'sharer', 'toolbar=0,status=0,width=620,height=280');
			 	
			 });

			 var twitterUrl = "https://twitter.com/intent/tweet?url="+encodeURIComponent(url)+"&text="+encodeURIComponent(post_title);

			 $("#twitterBtn").off("click").on("click",function(e){
			 	e.preventDefault();
			 	window.open(twitterUrl, 'sharer', 'toolbar=0,status=0,width=620,height=280');
			 	
			 });
		});

		
	});
	
})( jQuery );

</script>