<?php
get_template_part( 'partials/content', 'indexwatch' );
global $wpdb,$post;

$mainpost = $post;


$latestnews = [];
// Get 5 Latest News for each category
// WP_Query arguments

$mainpost = $post;

$post = get_posts([
	'posts_per_page' => 5,
	'posts_per_archive_page' => 5,
	'paged' => get_query_var('paged') ?: 1,
	'post_type' => [
		'iod_video'
	],
	'orderby' => 'date',
	'order' => 'DESC',
	'post_status'      => 'publish',
	'taxonomy' => get_query_var('taxonomy'),
	'iod_category' => get_query_var('taxonomy')=='iod_category' ? get_query_var('iod_category') : false
]);

foreach ($post as $key => $video) {
	$vcats = [];
	$video_cats = wp_get_post_terms($video->ID,'iod_category');
	$hascat = false;
	if($video_cats){
		$hascat = true;
		foreach ($video_cats as $vidcat) {
			$vcats[] = '<a href="'.get_term_link($vidcat->term_id,'iod_category').'">'.$vidcat->name.'</a>';
		}
	}

	$iod_video = '';
	$iod_video_thumbnail = '';
	if($video){
		$videohere = $videohere[0];
		$iod_video = json_decode(get_post_meta( $video->ID, '_iod_video',true))->embed->url;
		$ytpattern = '/^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/';
		if(preg_match($ytpattern,$iod_video,$vid_id)){
			$iod_video_thumbnail = 'http://img.youtube.com/vi/'.end($vid_id).'/mqdefault.jpg';
		}else{
			$iod_video_thumbnail = 'http://www.askgamblers.com/uploads/original/isoftbet-2-5474883270a0f81c4b8b456b.png';
		};
	}

	$latestnews[] = [
		'title' => $hascat ? implode(',',$vcats) : 'Video',
		'description' => xyr_smarty_limit_chars($video->post_title,40),
		'date' => $video->post_date,
		'thumbnail' => $iod_video_thumbnail,
		'link' => $iod_video ?: get_the_permalink($video->ID)
	];
}
if(count($latestnews)>=5):
	$post = $latestnews;
	$GLOBALS['featureTitle'] = 'Latest <span>Videos</span>';
	$GLOBALS['featureButton'] = 'PLAY NOW';
	$GLOBALS['featureNoMore'] = true;
	get_template_part( 'partials/content', 'featuredvideos' );
endif;
$post = $mainpost;

$video_cats = get_categories([
	'type'                     => 'iod_video',
	'child_of'                 => 0,
	'parent'                   => 0,
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '1',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'iod_category',
	'pad_counts'               => false
]);


$featuredVidsCategories = [];
$featuredVidsCategories[] = [
	'id' => 0,
	'name' => 'All Videos',
	'active' => get_query_var('taxonomy')!='iod_category',
	'link' => '/videos'
];
foreach ($video_cats as $key => $cat) {

	if(in_array($cat->slug,[
		'investment',
		])) continue;
		$child = [];
		$child_cats = get_categories([
			'type'                     => 'iod_video',
			'parent'                   => $cat->term_id,
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => 1,
			'hierarchical'             => 1,
			'exclude'                  => '1',
			'include'                  => '',
			'number'                   => '',
			'taxonomy'                 => 'iod_category',
			'pad_counts'               => false
		]);


		if(!empty($child_cats)){
			foreach ($child_cats as $kk => $cc) {
				$child_cats[$kk] = [
					'id' => $cc->term_id,
					'name' => $cc->name,
					'link' => get_term_link($cc->term_id,'iod_category'),
					'active' => get_query_var('iod_category')==$cc->slug
				];
			}
			$child = $child_cats;
		}

		$featuredVidsCategories[] = [
			'id' => $cat->term_id,
			'name' => $cat->name,
			'link' => get_term_link($cat->term_id,'iod_category'),
			'child' => $child,
			'active' => get_query_var('iod_category')==$cat->slug
		];

	}
	$featuredVidsNews =  get_posts([
		'posts_per_page' => 9,
		'posts_per_archive_page' => 9,
		'paged' => get_query_var('paged') ?: 1,
		'post_type' => [
			'iod_video'
		],
		'orderby' => 'date',
		'order' => 'DESC',
		'post_status'      => 'publish',
		'taxonomy' => get_query_var('taxonomy'),
		'iod_category' => get_query_var('taxonomy')=='iod_category' ? get_query_var('iod_category') : false
	]);

	$featuredVids = [
		'categories' => $featuredVidsCategories,
		'posts' => $featuredVidsNews
	];
	$GLOBALS['featuredVids'] = $featuredVids;
	$GLOBALS['featuredTitle'] = 'All Videos';

	get_template_part( 'partials/content', 'featuredpostsvids' );
	get_template_part( 'partials/content', 'investordivest' );
	?>
