<?php
include_once ABSPATH . '/wp-includes/category-template.php';

wp_enqueue_script( 'mmc-smarty-pagination-js', get_stylesheet_directory_uri() . '/assets/js/jquery.bootpag.min.js',['jquery'],null,true);
get_template_part( 'partials/content', 'indexwatch' );
global $wpdb,$post;
$queried = get_queried_object();
$category = get_category_by_slug( 'news-at-a-glance' );
$category_tags = [];
$category_tags = get_categories([
	'type'                     => 'post',
	'child_of'                 => $category->term_id,
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => FALSE,
	'hierarchical'             => 1,
	'taxonomy'                 => 'category',
	]);


$featuredPostCategories = [];
$featuredPostCategories[] = [
	'id' => 0,
	'name' => 'News at a Glance',
	'link' => '/category/news-at-a-glance',
	'active' => $queried->slug=='news-at-a-glance'
];
foreach ($category_tags as $key => $cat) {

		$featuredPostCategories[] = [
			'id' => $cat->term_id,
			'name' => $cat->name,
			'link' => get_category_link($cat->term_id),
			'active' => $queried->slug==$cat->slug
		];
	}


	$featuredPostNews =  get_posts([
		'posts_per_page'   => 9,
		'category_name'    => $queried->slug,
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
	$GLOBALS['featuredTitle'] = $queried->name;

	echo '<div class="" data-limit="12" data-tag="null" data-cat="2" data-page="'.(get_query_var('paged') ?: 1).'">';
	get_template_part( 'partials/content', 'featuredposts' );
	echo '</div>';

	?>
