<?php
global $qode_options;
global $more;
global $qode_template_name;
$more = 0;

$blog_hide_comments = "";
if (isset($qode_options['blog_hide_comments'])) {
	$blog_hide_comments = $qode_options['blog_hide_comments'];
}
$blog_hide_author = "";
if (isset($qode_options['blog_hide_author'])) {
	$blog_hide_author = $qode_options['blog_hide_author'];
}

$post = get_post(get_the_ID());
$date = $post->post_date;
$originalDate = split(' ', $date)[0];
$newDate = date("d F Y", strtotime($originalDate));

$timestamp = str_replace(" ","T",$date);
$day = '';

$today = new DateTime(); // This object represents current date/time
$today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

$match_date = DateTime::createFromFormat( "Y-m-d\\TH:i:s", $timestamp );
$match_date->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

$diff = $today->diff( $match_date );
$diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval

switch( $diffDays ) {
    case 0:
        $day = 'Today';
        break;
    case -1:
        $day = 'Yesterday';
        break;
    case +1:
         $day = "Tomorrow";
        break;
    default:
        echo "";
}
$portfolio_m_images = get_post_meta(get_the_ID(), "qode_portfolio-image-gallery", true);

$portfolio_image_gallery_array=explode(',',$portfolio_m_images);
$image_src = wp_get_attachment_image_src( $portfolio_image_gallery_array[0], 'blog_image_in_grid' );



$wp_read_more = "off";
if (isset($qode_options['wp_read_more'])) {
	$wp_read_more = $qode_options['wp_read_more'];
}
$_post_format = get_post_format();
?>
<?php
switch ($_post_format) {
	case "video":
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_image">
				<?php $_video_type = get_post_meta(get_the_ID(), "video_format_choose", true);?>
				<?php if($_video_type == "youtube") { ?>
					<iframe src="//www.youtube.com/embed/<?php echo get_post_meta(get_the_ID(), "video_format_link", true);  ?>?wmode=transparent" wmode="Opaque" frameborder="0" allowfullscreen></iframe>
				<?php } elseif ($_video_type == "vimeo"){ ?>
					<iframe src="//player.vimeo.com/video/<?php echo get_post_meta(get_the_ID(), "video_format_link", true);  ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				<?php } elseif ($_video_type == "self"){ ?>
					<div class="video">
						<div class="mobile-video-image" style="background-image: url(<?php echo get_post_meta(get_the_ID(), "video_format_image", true);  ?>);"></div>
						<div class="video-wrap"  >
							<video class="video" poster="<?php echo get_post_meta(get_the_ID(), "video_format_image", true);  ?>" preload="auto">
								<?php if(get_post_meta(get_the_ID(), "video_format_webm", true) != "") { ?> <source type="video/webm" src="<?php echo get_post_meta(get_the_ID(), "video_format_webm", true);  ?>"> <?php } ?>
								<?php if(get_post_meta(get_the_ID(), "video_format_mp4", true) != "") { ?> <source type="video/mp4" src="<?php echo get_post_meta(get_the_ID(), "video_format_mp4", true);  ?>"> <?php } ?>
								<?php if(get_post_meta(get_the_ID(), "video_format_ogv", true) != "") { ?> <source type="video/ogg" src="<?php echo get_post_meta(get_the_ID(), "video_format_ogv", true);  ?>"> <?php } ?>
								<object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo get_template_directory_uri(); ?>/js/flashmediaelement.swf">
									<param name="movie" value="<?php echo get_template_directory_uri(); ?>/js/flashmediaelement.swf" />
									<param name="flashvars" value="controls=true&file=<?php echo get_post_meta(get_the_ID(), "video_format_mp4", true);  ?>" />
									<img src="<?php echo get_post_meta(get_the_ID(), "video_format_image", true);  ?>" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" />
								</object>
							</video>
						</div></div>
				<?php } ?>
			</div>
			<div class="post_text">
				<div class="post_text_inner">
					<h4><a href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>"><?php echo the_title()?></a></h4>
					<div class="post_info">
						<span class="post_category">
							<span><?php _e('In', 'qode'); ?></span>
							<span><?php the_category(', '); ?></span>
						</span>
					</div>
					<?php
					if($wp_read_more == "off"){
						qode_excerpt();
					} else {
						the_content('<span>Read More</span>');
					}
					?>
					<?php if($blog_hide_author == "no" || $blog_hide_comments != "yes") { ?>
						<div class="post_author_holder">
							<?php if($blog_hide_author == "no") { ?>
								<div class="post_author">
									<span><?php echo 'SHARE'; ?></span> 
								</div>
								<!-- Trigger/Open The Modal -->
									<button id="myBtn">Open Modal</button>

									

							<?php } ?>
							<?php if($blog_hide_comments != "yes"){ ?>
								<div class="post_comments">
									<div class="post_comments">
										<span><?php echo (!empty($day))? $day : $newDate;  ?></span>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</article>

		<?php
		break;
	case "audio":
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_image">
				<?php if (has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('full'); ?>
						<span class="post_overlay">
						</span>
					</a>
				<?php } ?>
				<audio class="blog_audio" src="<?php echo get_post_meta(get_the_ID(), "audio_link", true) ?>" controls="controls">
					<?php _e("Your browser don't support audio player","qode"); ?>
				</audio>
			</div>
			<div class="post_text">
				<div class="post_text_inner">
					<h4><a href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
					<div class="post_info">
						<span class="post_category">
							<span><?php _e('In', 'qode'); ?></span>
							<span><?php the_category(', '); ?></span>
						</span>
					</div>
					<?php
					if($wp_read_more == "off"){
						qode_excerpt();
					} else {
						the_content('<span>Read More</span>');
					}
					?>
					<?php if($blog_hide_author == "no" || $blog_hide_comments != "yes") { ?>
						<div class="post_author_holder">
							<?php if($blog_hide_author == "no") { ?>
								<div class="post_author">
									<span><?php echo 'SHARE'; ?></span>
								</div>
							<?php } ?>
							<?php if($blog_hide_comments != "yes"){ ?>
								<div class="post_comments">
									<div class="post_comments" >
										<span><?php echo (!empty($day))? $day : $newDate; ?></span>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</article>
		<?php
		break;
	case "link":
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if (has_post_thumbnail()) { ?>
				<div class="post_image">
					<a href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('full'); ?>
						<span class="post_overlay">
						</span>
					</a>
				</div>
			<?php } ?>
			<div class="post_content_holder">
				<div class="post_text">
					<div class="post_text_inner">
						<i class="link_mark fa fa-link pull-left"></i>
						<div class="post_title">
							<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
						</div>
						<?php if($blog_hide_author == "no" || $blog_hide_comments != "yes") { ?>
							<div class="post_author_holder">
								<?php if($blog_hide_author == "no") { ?>
									<div class="post_author">
										<span><?php echo 'SHARE'; ?></span> 
									</div>
								<?php } ?>
								<?php if($blog_hide_comments != "yes"){ ?>
									<div class="post_comments">
										<div class="post_comments" href="">
											<span><?php echo (!empty($day))? $day : $newDate;  ?></span>
										</div>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</article>
		<?php
		break;
	case "gallery":
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_image">
				<div class="flexslider">
					<ul class="slides">
						<?php
						$post_content = get_the_content();
						preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);

						if (array_key_exists(1, $ids)) {
							$array_id = explode(",", $ids[1]);

							foreach($array_id as $img_id){ ?>
								<li><a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image( $img_id, 'full' ); ?></a></li>
							<?php } } ?>
					</ul>
				</div>
			</div>
			<div class="post_text">
				<div class="post_text_inner">
					<h4><a href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
					<div class="post_info">
						<span class="post_category">
							<span><?php _e('In', 'qode'); ?></span>
							<span><?php the_category(', '); ?></span>
						</span>
					</div>
					<?php
					if($wp_read_more == "off"){
						qode_excerpt();
					} else {
						$post_content = get_the_content();

						$content =  str_replace($ids[0], "", $post_content);
						$filtered_content = apply_filters( 'the_content', $content);

						echo do_shortcode($filtered_content);
					}
					?>
					<?php if($blog_hide_author == "no" || $blog_hide_comments != "yes") { ?>
						<div class="post_author_holder">
							<?php if($blog_hide_author == "no") { ?>
								<div class="post_author">
									<span><?php echo 'SHARE'; ?></span> 
								</div>
							<?php } ?>
							<?php if($blog_hide_comments != "yes"){ ?>
								<div class="post_comments">
									<div class="post_comments" href="" >
										<span><?php echo (!empty($day))? $day : $newDate;  ?></span>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</article>
		<?php
		break;
	case "quote":
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if (has_post_thumbnail()) { ?>
				<div class="post_image">
					<a href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('full'); ?>
						<span class="post_overlay">
						</span>
					</a>
				</div>
			<?php } ?>
			<div class="post_content_holder">
				<div class="post_text">
					<div class="post_text_inner">
						<i class="qoute_mark icon_quotations pull-left"></i>
						<div class="post_title">
							<h3>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_post_meta(get_the_ID(), "quote_format", true); ?></a>
							</h3>
							<span class="quote_author">&mdash; <?php the_title(); ?></span>
						</div>
						<?php if($blog_hide_author == "no" || $blog_hide_comments != "yes") { ?>
							<div class="post_author_holder">
								<?php if($blog_hide_author == "no") { ?>
									<div class="post_author">
										<span><?php echo 'SHARE'; ?></span> 
									</div>
								<?php } ?>
								<?php if($blog_hide_comments != "yes"){ ?>
									<div class="post_comments">
										<div class="post_comments">
											<span><?php echo (!empty($day))? $day : $newDate;  ?></span>
										</div>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</article>
		<?php
		break;
	default:
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( !empty($image_src[0]) ) { ?>
				<div class="post_image">
					<a href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>">
						<img width="1100" height="734" sizes="(max-width: 1100px) 100vw, 1100px" src="<?php echo esc_url($image_src[0]); ?>"  />	
						<span class="post_overlay">
						</span>
					</a>
				</div>
			<?php } else if ( has_post_thumbnail() ) { ?>
				<div class="post_image">
					<a href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('full'); ?>
						<span class="post_overlay">
						</span>
					</a>
				</div>
			<?php } ?>
			<div class="post_text">
				<div class="post_text_inner">
					<div class="painkiler-content">
					<h4><a href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
					<div class="post_info">
						<span class="post_category">
							<span><?php _e('In', 'qode'); ?></span>
							<span><?php the_category(', '); ?></span>
						</span>
					</div>
					<?php
					if($wp_read_more == "off"){
						qode_excerpt();
					} else {
						the_content('<span>Read More</span>');
					}
					?>
					</div>
					<?php if($blog_hide_author == "no" || $blog_hide_comments != "yes") { ?>
						<div class="post_author_holder">
							<?php if($blog_hide_comments != "yes"){ ?>
								<div class="post_comments">
									<div class="post_comments" >
										<span><?php echo (!empty($day))? $day : $newDate; ?></span>
										<!--<span><?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?></span>-->
									</div>
								</div>
							<?php } ?>
							<?php if($blog_hide_author == "no") { ?>
								<div class="post_author">
								   <a href="#" class="share" id="share_<?php echo get_the_ID(); ?>" data-id='<?php echo get_the_ID(); ?>' ><?php echo 'SHARE'; ?></a> 
								   <!--<a class="post_author_link" href=" <?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><span><?php the_author_meta('display_name'); ?></span></a> -->
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</article>
		<?php
}
?>

