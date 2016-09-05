<?php
get_template_part( 'partials/content', 'indexwatch' );
global $wpdb,$post;
$video_cats = get_categories([
	'parent'                   => get_cat_ID('Press Release'),
	// 'orderby'                  => 'name',
	// 'order'                    => 'ASC',
	'hide_empty'               => 0,
	// 'hierarchical'             => 1,
	// 'exclude'                  => '1',
	// 'include'                  => '',
	// 'number'                   => '',
	// 'pad_counts'               => false
]);

$featuredVidsCategories = [];
$featuredVidsCategories[] = [
	'id' => 0,
	'name' => 'All Press Releases',
	'active' => get_query_var('category_name')=='press-release',
	'link' => '/category/press-release/'
];
foreach ($video_cats as $key => $cat) {

	if(in_array($cat->slug,[
		// 'investment',
		])) continue;

		$featuredVidsCategories[] = [
			'id' => $cat->term_id,
			'name' => $cat->name,
			'link' => get_term_link($cat->term_id),
			'active' => get_query_var('category_name')==$cat->slug
		];

	}
	$featuredVidsNews =  get_posts([
		'posts_per_page' => 9,
		'posts_per_archive_page' => 9,
		'paged' => get_query_var('paged') ?: 1,
		'orderby' => 'date',
		'order' => 'DESC',
		'post_status'      => 'publish',
		'category' => get_query_var('cat')
	]);

	$featuredVids = [
		'categories' => $featuredVidsCategories,
		'posts' => $featuredVidsNews
	];
	$GLOBALS['featuredVids'] = $featuredVids;
	$GLOBALS['featuredTitle'] = get_cat_ID('Press Release')==get_query_var('cat') ? 'All Press Releases' : 'All '.get_category(get_query_var('cat'))->name;

	get_template_part( 'partials/content', 'featuredpostspress' );
	get_template_part( 'partials/content', 'investordivest' );
	?>
