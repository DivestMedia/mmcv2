<?php
global $post;
get_header();
get_template_part( 'partials/content', 'slider' );
get_template_part( 'partials/content', 'indexwatch' );

$mainpost = $post;
$featuredcats = [
    [
        'category' => 'Board of Advisors',
        'title' => 'Kenyon Martin',
        'description' => 'How to be Dumbass',
        'link' => '/video/kenyon-martin/#all-videos',
    ],
    [
        'category' => 'Daily Stock Picks',
        'title' => 'Kenyon Martin',
        'description' => 'Daily Stock Picks',
        'link' => '/video/kenyon-martin/#all-videos',
    ],
    [
        'category' => 'Investment Tips',
        'title' => 'Bruce Curran',
        'description' => 'Investment Tips',
        'link' => '/video/kenyon-martin/#all-videos',
    ],
    [
        'category' => 'World News',
        'title' => 'Bruce Curran',
        'description' => 'World News',
        'link' => '/video/world-news/#all-videos',
    ],
    [
        'category' => 'Andy Penders',
        'title' => 'Headlines',
        'description' => 'Global Business News',
        'link' => '/video/andy-penders/#all-videos',
    ]
];
$featuredvideos = [];
foreach ($featuredcats as $cat) {

    $catobj = get_term_by('slug', sanitize_title($cat['category']) , 'iod_category' );

    $videohere = get_posts([
        'post_type'   => 'iod_video',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'posts_per_archive_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
        // 'meta_key'   => '_is_featured',
        // 'meta_value' => 1,
        'taxonomy'=>'iod_category',
        'term'=> $catobj->slug
    ]);

    $iod_video = '';
    $iod_video_thumbnail = '';
    if($videohere){
        $videohere = $videohere[0];
        $iod_video = json_decode(get_post_meta( $videohere->ID, '_iod_video',true))->embed->url;
        $ytpattern = '/^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/';
        if(preg_match($ytpattern,$iod_video,$vid_id)){
            $iod_video_thumbnail = 'http://img.youtube.com/vi/'.end($vid_id).'/mqdefault.jpg';
        }else{
            $iod_video_thumbnail = 'http://www.askgamblers.com/uploads/original/isoftbet-2-5474883270a0f81c4b8b456b.png';
        };
    }
    $featuredvideos[] = [
        'title' => $cat['title'] ,
        'titlelink' => $cat['link'],
        'description' => $cat['description'] ,
        'date' => $videohere->post_date,
        'thumbnail' => $iod_video_thumbnail,
        'link' => $iod_video ?: $cat['link']
    ];

}

$post = $featuredvideos;
get_template_part( 'partials/content', 'featuredvideos' );

$post = $mainpost;

get_template_part( 'partials/content', 'featuredarticles' );
get_template_part( 'partials/content', 'juicyextras' );
get_template_part( 'partials/content', 'globalnews' );
get_template_part( 'partials/content', 'investordivest' );
get_template_part( 'partials/content', 'subscription' );
get_template_part( 'partials/content', 'contactus' );
get_template_part( 'partials/content', 'vipsubscribers' );
get_footer();
