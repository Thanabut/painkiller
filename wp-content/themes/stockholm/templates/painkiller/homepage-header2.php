<?php
	$image_header =  get_theme_mod( 'front-page-cover', get_template_directory_uri().'/img/21.jpg');
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
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/header-front-page-2.css?v=1.1">

<div class="page-header">
	<!-- <div class="img-wrapper">
		<img style="opacity: 0;" src="<?php echo get_theme_mod( 'img_1', get_template_directory_uri().'/img/21.jpg' );?>">
	</div> -->
	<div class="container">
		<div class="container_inner default_template_holder painkiller">
			<a href="<?php echo get_site_url(); ?>/latest-painkiller">
				<div class="img-wrapper">
					<!-- <img src="<?php echo $image_header ?>" class="img-responsive"> -->
				</div>
			</a>
		</div>
	</div>
</div>
<script src="<?php echo get_template_directory_uri();?>/js/parallax.js-1.4.2/parallax.min.js"></script>
<script type="text/javascript">

	(function($) {
		
		
		$(document).ready(function(){
				
			
		});
		
	})( jQuery );
</script>