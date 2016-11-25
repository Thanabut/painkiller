<?php

?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/header-front-page.css?v=1.1">

<div class="page-header">
	<div class="header-wrapper">
		<div class="img-1">
			<a href="<?php echo get_site_url(); ?>/latest-painkiller">
				<div class="side-text" style="opacity: 0;">
					PAINKILLER
				</div>
				<div class="img-wrapper">
					<img style="opacity: 0;" src="<?php echo get_theme_mod( 'img_1', get_template_directory_uri().'/img/21.jpg' );?>">
				</div>
				<p>PAINKILLER</p>
			</a>
		</div>
		<!-- <div class="img-2">
			<a href="<?php echo get_site_url(); ?>/archive-painkiller/">
				<div class="side-text" style="opacity: 0;">
					Archive
				</div>
				<img style="opacity: 0;" src="<?php echo get_theme_mod( 'img_2', get_template_directory_uri().'/img/11.jpg' );?>">
				<p>Archive</p>
			</a>
		</div> -->
		<div class="img-3">
			<a href="<?php echo get_site_url(); ?>/latest-mister-painkiller/">
				<div class="side-text" style="opacity: 0;">
					MISTER PAINKILLER
				</div>
				<div class="img-wrapper">
					<img style="opacity: 0;" src="<?php echo get_theme_mod( 'img_3', get_template_directory_uri().'/img/MRPK01-09.jpg' );?>" alt="">
				</div>
				<p>MISTER PAINKILLER</p>
			</a>
		</div>
		 <div class="header-logo">
			<img style="opacity: 0;" src="<?php echo get_template_directory_uri();?>/img/logo-pk-main.png" alt="">
		</div>
		<!-- <div class="header-main-title" style="display:none">
			<h1>Painkiller from Bangkok<br/> -</h1>

			<p>Minimal romantic finery for artsy gentleman.</p>
		</div> -->
	</div>
</div>
<script src="<?php echo get_template_directory_uri();?>/js/parallax.js-1.4.2/parallax.min.js"></script>
<script type="text/javascript">

	(function($) {
		function resizeImg(){
			var imgLeft = $(".img-1 img");
			var imgRight = $(".img-3 img");

			var theHeight = (imgLeft.height() > imgRight.height())? imgRight.height() : imgLeft.height();

			var cover = $('.page-header');
			
			var img_position = $(".header-wrapper .img-1").css("position");
			if(img_position == "absolute"){
				cover.css({
					"height":theHeight
				});
			}else{
				cover.css({
					"height":400+400+10
				});
			}

			if(imgLeft.height() > imgRight.height()){
				imgLeft.parent().css({
					"max-height": imgRight.height()
				});
			}else{
				imgRight.parent().css({
					"max-height": imgLeft.height()
				});
			}
		}
		
		resizeImg();
		
		$(document).ready(function(){
				var divHeader = $(".header-wrapper");
				divHeader.find('.header-logo > img').animate({ "opacity": "0" }, 0,function(){
					var img_sDown = divHeader.find(".img-1, .img-3");
					// var img_sUp = divHeader.find(".img-2");

					img_sDown.animate({ "top": "+=30px" }, 1000);
					img_sDown.find('img').animate({ "opacity": "1" }, 1300, function(){
					// img_sUp.find('img').animate({ "opacity": "1" }, 1300);
					// img_sUp.animate({ "bottom": "+=30px" }, 1000, function(){
						divHeader.find(".img-1 .side-text").animate({"opacity": "1" , "bottom": "+=5px"}, 500)
						// divHeader.find(".img-2 .side-text").animate({"opacity": "1" , "bottom": "+=10px"}, 500)
						divHeader.find(".img-3 .side-text ").animate({"opacity": "1" , "bottom": "+=5px"}, 500,function(){
							var title = divHeader.find(".header-main-title");
							var height = title.css({
						        display: "block"
						    }).height();
						    
						    title.css({
						        overflow: "hidden",
						        marginTop: height,
						        height: 0
						    }).animate({
						        marginTop: 0,
						        height: height
						    }, 500, function () {
						        $(this).css({
						            display: "",
						            overflow: "",
						            height: "",
						            marginTop: ""
						        });
						    });
						});
					} );	
				});
				//end animate
			// }
			//end if window

			var lastScrollTop = 0;
			var limit_scroll = 0;
			$(window).scroll(function(event){
				var img_position = $(".header-wrapper .img-1").css("position");
				if(img_position == "absolute"){
					var img13 = $(".header-wrapper").find(".img-1, .img-3");
					// var img2 = $(".header-wrapper").find(".img-2");
				   	var st = $(this).scrollTop();
				   	// console.log(st);
				   	if (st > lastScrollTop){
				       	// downscroll code
				       	if(limit_scroll <= 70){
					       	limit_scroll++;
					       	img13.animate({"top": "-=1px"},0);
							// img2.animate({"bottom": "+=1px"},0);
				       	}

					} else {
					    // upscroll code
					    if(limit_scroll >= 0){
						    limit_scroll--;
						    img13.animate({"top": "+=1px"},0);
							// img2.animate({"bottom": "-=1px"},0);
						}
					    // $(".header-wrapper > .img-2 > .side-text").animate({"top": "+=0.5px"},0);

					}
					if(st == 0){
						$(".header-wrapper > .img-2").css({bottom:"10px"});
						$(".header-wrapper > .img-1, .header-wrapper > .img-3").css({top:"0px"});
					}
					lastScrollTop = st;

				}
			});

			$(window).resize(function(event) {
				resizeImg();
				var imgs = $(".img-1 img, .img-2 img");
				var img_position = $(".header-wrapper .img-1").css("position");
				if(img_position == "absolute"){
					$(".header-wrapper > .img-2").css({bottom:"10px", left:"80px"});
					$(".header-wrapper > .img-1, .header-wrapper > .img-3").css({top:"0px"});
				}else{
					$(".header-wrapper > .img-2").css({bottom:"0",left:"0"});
					
					imgs.css({"max-height": "none"});
				}


			});
			
		});
		
	})( jQuery );
</script>