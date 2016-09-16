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
], NEWSBASEURL . 'wp-json/wp/v2/posts')));

foreach ($post as $key => $news) {

	$image ='';
	// if(!empty($news->featured_media)){
	// 	$imagedata = json_decode(file_get_contents_curl('http://wordpress-16884-37649-153865.cloudwaysapps.com/wp-json/wp/v2/media/'.$news->featured_media));
	// 	if($imagedata->data->status!==404){
	// 		var_dump($imagedata);
	// 		$image = $imagedata->media_details->sizes->medium->source_url;
	// 	}
	//
	// }


	if(!empty($news->post_thumbnail->{"mid-image"})){
		$image = $news->post_thumbnail->{"mid-image"}["0"];
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


// $category_tags = get_category_tags(get_category_by_slug('news')->term_id);


$category_tags = [
	[
		'id' => 7,
		'link' => '/tag/asia/',
		'name' => 'Asia',
		'slug' => 'asia',
		'stock' => true,
	],
	[
		'id' => 21,
		'link' => '/tag/banking-finance/',
		'name' => 'Banking/Finance',
		'slug' => 'banking-finance',
	],
	[
		'id' => 19,
		'link' => '/tag/bonds/',
		'name' => 'Bonds',
		'slug' => 'bonds',
		'stock' => true,
	],
	[
		'id' => 16,
		'link' => '/tag/commodities/',
		'name' => 'Commodities',
		'slug' => 'commodities',
		'stock' => true,
	],
	[
		'id' => 14,
		'link' => '/tag/construction/',
		'name' => 'Construction',
		'slug' => 'construction',
	],
	[
		'id' => 22,
		'link' => '/tag/consumer-goods/',
		'name' => 'Consumer Goods',
		'slug' => 'consumer-goods',
	],
	[
		'id' => 8,
		'link' => '/tag/currencies/',
		'name' => 'Currencies',
		'slug' => 'currencies',
		'stock' => true,
	],
	[
		'id' => 15,
		'link' => '/tag/energy/',
		'name' => 'Energy',
		'slug' => 'energy',
	],
	[
		'id' => 25,
		'link' => '/tag/etfs/',
		'name' => 'ETF&apos;s',
		'slug' => 'etfs',
		'stock' => true,
	],
	[
		'id' => 3,
		'link' => '/tag/europe/',
		'name' => 'Europe',
		'slug' => 'europe',
		'stock' => true,
	],
	[
		'id' => 13,
		'link' => '/tag/funds/',
		'name' => 'Funds',
		'slug' => 'funds',
	],
	// [
	// 	'id' => 9,
	// 	'link' => '/tag/industrial/',
	// 	'name' => 'Industrial',
	// 	'slug' => 'industrial',
	// ],
	[
		'id' => 26,
		'link' => '/tag/industrial-goods/',
		'name' => 'Industrial Goods',
		'slug' => 'industrial-goods',
	],
	[
		'id' => 17,
		'link' => '/tag/manufacturing/',
		'name' => 'Manufacturing',
		'slug' => 'manufacturing',
	],
	[
		'id' => 24,
		'link' => '/tag/media/',
		'name' => 'Media',
		'slug' => 'media',
	],
	[
		'id' => 12,
		'link' => '/tag/mining/',
		'name' => 'Mining',
		'slug' => 'mining',
	],
	[
		'id' => 18,
		'link' => '/tag/pharmaceuticals/',
		'name' => 'Pharmaceuticals',
		'slug' => 'pharmaceuticals',
	],
	[
		'id' => 4,
		'link' => '/tag/pre-markets/',
		'name' => 'Pre-Markets',
		'slug' => 'pre-markets',
		'stock' => true,
	],
	[
		'id' => 10,
		'link' => '/tag/real-estate/',
		'name' => 'Real Estate',
		'slug' => 'real-estate',
	],
	[
		'id' => 23,
		'link' => '/tag/retail/',
		'name' => 'Retail',
		'slug' => 'retail',
	],
	[
		'id' => 5,
		'link' => '/tag/stocks/',
		'name' => 'Stocks',
		'slug' => 'stocks',
		'stock' => true,
	],
	[
		'id' => 20,
		'link' => '/tag/technology/',
		'name' => 'Technology',
		'slug' => 'technology',
	],
	[
		'id' => 11,
		'link' => '/tag/travel/',
		'name' => 'Travel',
		'slug' => 'travel',
	],
	[
		'id' => 6,
		'link' => '/tag/usa/',
		'name' => 'USA',
		'slug' => 'usa',
		'stock' => true,
	],
];

$featuredPostCategories = [];
$featuredPostCategories[] = [
	'id' => 0,
	'name' => 'All News',
	'link' => '/category/news',
	'active' => true
];
foreach ($category_tags as $key => $cat) {

	if(in_array($cat['slug'],[
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
			'id' => $cat['id'],
			'name' => $cat['name'],
			'link' => $cat['link']
		];
	}

	$featuredPostNews = [];
	//
	// $featuredPostNews =  get_posts([
	// 	'posts_per_page'   => 9,
	// 	'category_name'    => 'News',
	// 	'orderby'          => 'date',
	// 	'order'            => 'DESC',
	// 	'paged' => get_query_var('paged') ?: 1,
	// 	'post_type'        => 'post',
	// 	'post_status'      => 'publish',
	// 	'suppress_filters' => true,
	// 	'fields' => 'ID'
	// ]);
	//
	// foreach ($featuredPostNews as $key => $postNews) {
	// 	$featuredPostNews[$key] = $postNews->ID;
	// }

	$featuredPost = [
		'categories' => $featuredPostCategories,
		'posts' => $featuredPostNews
	];

	$GLOBALS['featuredPost'] = $featuredPost;
	$GLOBALS['featuredTitle'] = 'All News';

	echo '<div class="news-feature-grid" data-limit="12" data-tag="null" data-cat="2" data-page="'.(get_query_var('paged') ?: 1).'">';
	get_template_part( 'partials/content', 'featuredposts' );
	echo '</div>';

	?>
