<?php

wp_enqueue_script( 'mmc-smarty-pagination-js', get_stylesheet_directory_uri() . '/assets/js/jquery.bootpag.min.js',['jquery'],null,true);

get_template_part( 'partials/content', 'indexwatch' );
global $wpdb,$post;

$mainpost = $post;
$taghere = strtolower(get_query_var('tag'));
$tagData = get_term_by( 'slug',$taghere,'post_tag' );

$latestnews = [];
// Get 5 Latest News for each category
// WP_Query arguments

$mainpost = $post;
$hascharts = false;
$stockwatch_child = [
	'pre-markets',
	'usa',
	'asia',
	'europe',
	'stocks',
	'commodities',
	'currencies',
	'bonds',
	'funds',
	'etfs'
];

if(!in_array(strtolower($tagData->slug),$stockwatch_child)){
	$post = get_posts([
		'post_type'   => 'post',
		'post_status' => 'publish',
		'posts_per_page' => 5,
		'posts_per_archive_page' => 5,
		'orderby' => 'date',
		'category_name'    => 'News',
		'order' => 'DESC',
		'tag_slug__in' => $taghere
	]);

	foreach ($post as $key => $news) {
		$tags_array = [$tagData];
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
			'description' => xyr_smarty_limit_chars($news->post_title,40),
			'date' => $news->post_date,
			'thumbnail' => $image[0],
			'link' => get_the_permalink($news->ID)
		];
	}
	if(count($latestnews)>4):
		$post = $latestnews;
		$GLOBALS['featureTitle'] = 'Latest <span>'.$tagData->name .' News</span>';
		$GLOBALS['featureButton'] = 'READ MORE';
		get_template_part( 'partials/content', 'featuredgrid' );
	endif;
}else{
	$hascharts = true;
	echo '<script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>';
	get_template_part( 'partials/chart', $tagData->slug );
}
$post = $mainpost;


$category_tags = get_category_tags(get_category_by_slug('news')->term_id);

$featuredPostCategories = [];
$featuredPostCategories[] = [
	'id' => 0,
	'name' => 'All News',
	'link' => '/category/news'
];

foreach ($category_tags as $key => $cat) {
	if(in_array($cat->slug,[
		'pre-markets',
		'usa',
		'asia',
		'europe',
		'stocks',
		'commodities',
		'currencies',
		'bonds',
		'funds',
		'etfs'
		])) continue;

		$featuredPostCategories[] = [
			'id' => $cat->ID,
			'name' => $cat->name,
			'link' => $cat->link,
			'active' => ($taghere==$cat->slug)
		];
	}

	$featuredPostNews =  get_posts([
		'posts_per_page'   => 9,
		'category_name'    => 'News',
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'post',
		'post_status'      => 'publish',
		'paged' => get_query_var('paged') ?: 1,
		'offset' => 5,
		'suppress_filters' => true,
		'tag_slug__in' => $taghere,
	]);




	foreach ($featuredPostNews as $key => $postNews) {
		$featuredPostNews[$key] = $postNews->ID;
	}

	$featuredPost = [
		'categories' => $featuredPostCategories,
		'posts' => $featuredPostNews
	];

	$GLOBALS['featuredPost'] = $featuredPost;
	if($hascharts==false)
	$GLOBALS['featuredTitle'] = $tagData->name . ' News';
	else
	$GLOBALS['featuredTitle'] = 'Related News';

	echo '<div class="news-feature-grid" data-limit="12" data-tag="'.$taghere.'" data-cat="2" data-page="'.(get_query_var('paged') ?: 1).'">';
	?>
	<?php
	get_template_part( 'partials/content', 'featuredposts' );
	echo '</div>';
	// get_template_part( 'partials/content', 'investordivest' );
	?>
