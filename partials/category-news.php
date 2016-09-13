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
	'offset' => 5,
	'category_name'    => 'News',
]);

foreach ($post as $key => $news) {
	$tags_array = get_the_tags( $news->ID );

	$tags_array = [$tags_array[array_rand($tags_array)]];
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

$post = $latestnews;
$GLOBALS['featureTitle'] = 'Latest <span>News</span>';
$GLOBALS['featureButton'] = 'READ MORE';
get_template_part( 'partials/content', 'featuredgrid' );
$post = $mainpost;


$category_tags = get_category_tags(get_category_by_slug('news')->term_id);

$featuredPostCategories = [];
$featuredPostCategories[] = [
	'id' => 0,
	'name' => 'All News',
	'active' => true
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
			'link' => $cat->link
		];
	}

	$featuredPostNews =  get_posts([
		'posts_per_page'   => 9,
		'category_name'    => 'News',
		'orderby'          => 'date',
		'order'            => 'DESC',
		'paged' => get_query_var('paged') ?: 1,
		'post_type'        => 'post',
		'post_status'      => 'publish',
		'suppress_filters' => true,
		'fields' => 'ID'
	]);

	foreach ($featuredPostNews as $key => $postNews) {
		$featuredPostNews[$key] = $postNews->ID;
	}

	$featuredPost = [
		'categories' => $featuredPostCategories,
		'posts' => $featuredPostNews
	];
	$GLOBALS['featuredPost'] = $featuredPost;
	$GLOBALS['featuredTitle'] = 'All News';

	echo '<div class="news-feature-grid">';
	get_template_part( 'partials/content', 'featuredposts' );
	echo '</div>';
	// get_template_part( 'partials/content', 'investordivest' );
	// get_template_part( 'partials/content', 'vipsubscribers' );
	?>
