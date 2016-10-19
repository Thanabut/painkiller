<?php


?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/css/header-front-page.css?v=1.1">

<div class="page-header">
	<div class="header-wrapper">
		<div class="img-1">
			<div class="side-text" style="opacity: 0;">
				Painkiller recent collection
			</div>
			<img style="opacity: 0;" src="<?php echo get_template_directory_uri();?>/img/21.jpg">
			<p>Painkiller</p>
		</div>
		<div class="img-2">
			<div class="side-text" style="opacity: 0;">
				Archive collection
			</div>
			<img style="opacity: 0;" src="<?php echo get_template_directory_uri();?>/img/11.jpg">
			<p>Archive</p>
		</div>
		<div class="img-3">
			<div class="side-text" style="opacity: 0;">
				Mister painkiller
			</div>
			<img style="opacity: 0;" src="<?php echo get_template_directory_uri();?>/img/MRPK01-09.jpg" alt="">
			<p>Mister Painkiller</p>
		</div>
		<div class="header-logo">
			<img style="opacity: 0;" src="<?php echo get_template_directory_uri();?>/img/logo-pk-main.png" alt="">
		</div>
		<div class="header-main-title" style="display:none">
			<h1>Painkiller from Bangkok<br/> -</h1>

			<p>Minimal romantic finery for artsy gentleman.</p>
		</div>
	</div>
</div>

<script type="text/javascript">
	(function($) {
		$(document).ready(function(){
			// console.log($("body").prop("clientWidth"));
			// if($("body").prop("clientWidth") > 767){
				var divHeader = $(".header-wrapper");
				divHeader.find('.header-logo > img').animate({ "opacity": "1" }, 500,function(){
					var img_sDown = divHeader.find(".img-1, .img-3");
					var img_sUp = divHeader.find(".img-2");

					img_sDown.animate({ "top": "+=30px" }, 1000);
					img_sDown.find('img').animate({ "opacity": "1" }, 1300);
					img_sUp.find('img').animate({ "opacity": "1" }, 1300);
					img_sUp.animate({ "bottom": "+=30px" }, 1000, function(){
						divHeader.find(".img-1 > .side-text").animate({"opacity": "1" , "right": "+=10px"}, 500)
						divHeader.find(".img-2 > .side-text").animate({"opacity": "1" , "right": "+=10px"}, 500)
						divHeader.find(".img-3 > .side-text ").animate({"opacity": "1" , "bottom": "+=10px"}, 500,function(){
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
			
		});
		
	})( jQuery );
</script>