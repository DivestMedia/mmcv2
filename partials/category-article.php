<?php
get_template_part( 'partials/content', 'indexwatch' );
global $wpdb,$post;

$mainpost = $post;
$taghere = strtolower(get_query_var('cat'));
$temptaghere = $taghere;


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
	'category_name' => 'Articles',
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
		'title' => $hastag ? implode(',',$tags) : 'Articles',
		'description' => xyr_smarty_limit_chars($news->post_title,40),
		'date' => $news->post_date,
		'thumbnail' => $image[0],
		'link' => get_the_permalink($news->ID)
	];
}

$post = $latestnews;
$GLOBALS['featureTitle'] = 'Featured <span>Articles</span>';
$GLOBALS['featureButton'] = 'READ MORE';
get_template_part( 'partials/content', 'featuredgrid' );
$post = $mainpost;

$category_tags = get_categories(['parent'=>get_category_by_slug('articles')->term_id]);
if(get_category_by_slug('articles')->term_id==$taghere)
	$taghere = 0;
$featuredPostCategories = [];
if(!empty($taghere)){
	$featuredPostCategories[] = [
		'id' => 0,
		'name' => 'All Articles',
		'link' => '/category/articles'
	];
}else{
	$featuredPostCategories[] = [
		'id' => 0,
		'name' => 'All Articles',
		'link' => '/category/articles',
		'active' => true
	];
}
foreach ($category_tags as $key => $cat) {

	if(in_array($cat->slug,[
		'rogue-trader',
		'our-offshore-experts',
		'starting-out'
	])){
		if(!empty($taghere)){
			$featuredPostCategories[] = [
				'id' => $cat->cat_ID,
				'name' => $cat->name,
				'link' => get_category_link($cat->cat_ID). '#all-posts',
				'active' => $cat->cat_ID==$taghere?true:false
			];
		}else{
			$featuredPostCategories[] = [
				'id' => $cat->cat_ID,
				'name' => $cat->name,
				'link' => get_category_link($cat->cat_ID). '#all-posts'
			];
		}
	}
}
$featuredPostNews =  get_posts([
	'posts_per_page'   => 12,
	'paged' 			=> get_query_var('paged') ?: 1,
	'category_name'    	   => 	get_cat_name(!empty($taghere)?$taghere:$temptaghere),
	'orderby'          => 'date',
	'order'            => 'DESC',
	'post_type'        => 'post',
	'post_status'      => 'publish',
	'suppress_filters' => true,
]);

foreach ($featuredPostNews as $key => $postNews) {
	$featuredPostNews[$key] = $postNews->ID;
}

$featuredPost = [
	'categories' => $featuredPostCategories,
	'posts' => $featuredPostNews
];
$GLOBALS['featuredPost'] = $featuredPost;

$GLOBALS['featuredTitle'] = (!empty($taghere)?get_cat_name($taghere):'All Articles');

$GLOBALS['is_article'] = true;

get_template_part( 'partials/content', 'featuredposts' );
// get_template_part( 'partials/content', 'investordivest' );
// get_template_part( 'partials/content', 'vipsubscribers' );
?>
