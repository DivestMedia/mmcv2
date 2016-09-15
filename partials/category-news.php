<?php
wp_enqueue_script( 'mmc-smarty-pagination-js', get_stylesheet_directory_uri() . '/assets/js/jquery.bootpag.min.js',['jquery'],null,true);
get_template_part( 'partials/content', 'indexwatch' );
global $wpdb,$post;

$mainpost = $post;


$latestnews = [];
// Get 5 Latest News for each category
// WP_Query arguments

$mainpost = $post;
$per_page = 5;
$tags =null;
$categories = 2;
$page = 1;


$post = json_decode(file_get_contents_curl(add_query_arg([
	'page' => $page,
	'tags' => $tags,
	'categories' => $categories,
	'per_page' => $per_page
],'http://wordpress-16884-37649-153865.cloudwaysapps.com/wp-json/wp/v2/posts')));

foreach ($post as $key => $news) {

	$image ='';
	if(!empty($news->featured_media)){
		$imagedata = json_decode(file_get_contents_curl('http://wordpress-16884-37649-153865.cloudwaysapps.com/wp-json/wp/v2/media/'.$news->featured_media));
		if($imagedata->data->status!==404){
			var_dump($imagedata);
			$image = $imagedata->media_details->sizes->medium->source_url;
		}

	}

	$latestnews[] = [
		'title' => '<a href="'.site_url('/category/news').'">News</a>',
		'description' => xyr_smarty_limit_chars($news->title->rendered,40),
		'date' => $news->date,
		'thumbnail' => $image,
		'link' => $news->link
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
	'link' => '/category/news',
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

	echo '<div class="news-feature-grid" data-limit="12" data-tag="null" data-cat="2" data-page="'.(get_query_var('paged') ?: 1).'">';
	?>

	<?php
	get_template_part( 'partials/content', 'featuredposts' );
	echo '</div>';
	
	?>
