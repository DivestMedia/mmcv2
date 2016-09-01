<?php
get_template_part( 'partials/content', 'indexwatch' );
global $wpdb,$post;

$mainpost = $post;


$latestnews = [];
// Get 5 Latest News for each category
// WP_Query arguments

$mainpost = $post;


$post = get_posts([
	'post_type'   => 'post',
	'post_status' => 'publish',
	'posts_per_page' => 5,
	'posts_per_archive_page' => 5,
	'orderby' => 'date',
	'order' => 'DESC',
]);

foreach ($post as $key => $news) {

	$tags_array = get_the_tags( $news->ID );
	$hastag = false;
	if($tags_array){
		$hastag = true;
		$tags = [];
		foreach ($tags_array as $tag) {
			$tags[] = '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>';
		}
	}
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $news->ID ), 'mid-image' );
	$latestnews[] = [
		'title' => $hastag ? implode(',',$tags) : 'News',
		'description' => $news->post_title,
		'date' => $videohere->post_date,
		'thumbnail' => $image[0],
		'link' => get_the_permalink($news->ID);
	];
}

$post = $latestnews;
get_template_part( 'partials/content', 'featuredvideos' );
$post = $mainpost;

	?>
	<section class="" >
		<div class="container">
			<header class="text-left margin-bottom-10">
				<h3 class="font-proxima uppercase">Latest <span>News</span></h3>
			</header>

			<div class="row">
				<!-- Col 1 -->
				<div class="col-md-6">
					<div class="item-box noshadow">
						<figure>
							<span class="item-hover">
								<span class="overlay dark-5"></span>
							</span>
							<span class="item-description">
								<span class="overlay primary-bg"></span>
								<span class="inner margin-top-30p">
									<h3><em>CATEGORY</em>Beer Goggles</h3>
									<span class="block size-11 text-center color-theme uppercase">
										Lorem Ipsum sit<br>
										dolor amet
									</span>
									<a class="pos-bottom block btn-sm btn secondary-bg text-center noradius weight-700" href="single.php">READ MORE</a>
								</span>
							</span>

							<img class="img-responsive" src="<?=get_stylesheet_directory_uri();?>/img-temp/photo-1420655710207-b092e1b8abe3.jpg" alt="">
						</figure>
					</div>


				</div>
				<!-- End Col 1 -->

				<!-- Col 2 -->
				<div class="col-md-3 col-sm-6 col-xs-6 col-2xs-12">
					<div class="item-box noshadow hover-box">
						<figure>
							<span class="item-hover">
								<span class="overlay dark-5"></span>
							</span>
							<span class="item-description">
								<span class="overlay primary-bg "></span>
								<span class="inner padding-top-30">
									<h3><em>CATEGORY</em>Daily Stock Picks</h3>
									<span class="block size-11 text-center color-theme uppercase">
										<a class=" btn-sm btn primary-bg text-center noradius weight-700" href="single.php">READ MORE</a>
									</span>

								</span>
							</span>

							<img class="img-responsive" src="<?=get_stylesheet_directory_uri();?>/img-temp/picjumbo.com_HNCK8248.jpg" alt="">
						</figure>
					</div>
					<div class="item-box noshadow hover-box margin-top-30">
						<figure>
							<span class="item-hover">
								<span class="overlay dark-5"></span>
							</span>
							<span class="item-description">
								<span class="overlay primary-bg "></span>
								<span class="inner padding-top-30">
									<h3><em>CATEGORY</em>World News</h3>
									<span class="block size-11 text-center color-theme uppercase">
										<a class=" btn-sm btn primary-bg text-center noradius weight-700" href="single.php">READ MORE</a>
									</span>

								</span>
							</span>

							<img class="img-responsive" src="<?=get_stylesheet_directory_uri();?>/img-temp/picjumbo.com_HNCK8182.jpg" alt="">
						</figure>
					</div>
				</div>
				<!-- End Col 2 -->

				<!-- Col 3 -->
				<div class="col-md-3 col-sm-6 col-xs-6 col-2xs-12">
					<div class="item-box noshadow hover-box">
						<figure>
							<span class="item-hover">
								<span class="overlay dark-5"></span>
							</span>
							<span class="item-description">
								<span class="overlay primary-bg "></span>
								<span class="inner padding-top-30">
									<h3><em>CATEGORY</em>Investment Tips</h3>
									<span class="block size-11 text-center color-theme uppercase">
										<a class=" btn-sm btn primary-bg text-center noradius weight-700" href="single.php">READ MORE</a>
									</span>

								</span>
							</span>

							<img class="img-responsive" src="<?=get_stylesheet_directory_uri();?>/img-temp/photo-1431274172761-fca41d930114.jpg" alt="">
						</figure>
					</div>
					<div class="item-box noshadow hover-box margin-top-30">
						<figure>
							<span class="item-hover">
								<span class="overlay dark-5"></span>
							</span>
							<span class="item-description">
								<span class="overlay primary-bg "></span>
								<span class="inner padding-top-30">
									<h3><em>CATEGORY</em>Global Business News</h3>
									<span class="block size-11 text-center color-theme uppercase">
										<a class=" btn-sm btn primary-bg text-center noradius weight-700" href="single.php">READ MORE</a>
									</span>

								</span>
							</span>

							<img class="img-responsive" src="<?=get_stylesheet_directory_uri();?>/img-temp/greece-2.jpg" alt="">
						</figure>
					</div>

				</div>
				<!-- End Col 3 -->
			</div>

		</div>
	</section>
	<?php
	get_template_part( 'partials/content', 'featuredarticles' );
	get_template_part( 'partials/content', 'investordivest' );
	get_template_part( 'partials/content', 'vipsubscribers' );
	?>
