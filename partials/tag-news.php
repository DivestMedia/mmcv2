<?php
get_template_part( 'partials/content', 'indexwatch' );
global $wpdb,$post;

$mainpost = $post;
$taghere = strtolower(get_query_var('tag'));
$tagData = get_term_by( 'slug',$taghere,'post_tag' );

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
$post = $mainpost;


$category_tags = get_category_tags(get_category_by_slug('news')->term_id);

$featuredPostCategories = [];
$featuredPostCategories[] = [
	'id' => 0,
	'name' => 'All News',
	'link' => '/news'
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
	$GLOBALS['featuredTitle'] = $tagData->name . ' News';

	get_template_part( 'partials/content', 'featuredposts' );
	// get_template_part( 'partials/content', 'investordivest' );
	?>
