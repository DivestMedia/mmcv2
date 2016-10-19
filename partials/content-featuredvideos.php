<?php

global $post,$featureTitle,$featureButton,$featureNoMore;


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
$excludevideoid = [];

$featuredvids = get_posts([
    'post_type'   => 'iod_video',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'posts_per_archive_page' => 5,
    'orderby' => 'date',
    'order' => 'DESC',
    'category__not_in' => [ 42 ],
    // 'meta_key'   => '_is_featured',
    // 'meta_value' => 1,
    // 'post__not_in' => $excludevideoid,
    'taxonomy'=>'iod_category',
    'tax_query' => [
        [
            'taxonomy'  => 'iod_category',
            'field'     => 'slug',
            'terms'     => 'andy-penders', // exclude items media items in the news-cat custom taxonomy
            'operator'  => 'NOT IN'
        ]
    ],
    // 'term'=> $catobj->slug
]);


foreach ($featuredvids as $videohere) {

    $iod_video = '';
    $iod_video_thumbnail = '';
    if($videohere){
        // $videohere = $videohere[0];
        $excludevideoid[] = $videohere->ID;
        $iod_video = json_decode(get_post_meta( $videohere->ID, '_iod_video',true))->embed->url;
        $ytpattern = '/^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/';
        if(preg_match($ytpattern,$iod_video,$vid_id)){
            $iod_video_thumbnail = 'http://img.youtube.com/vi/'.end($vid_id).'/mqdefault.jpg';
        }else{
            $iod_video_thumbnail = 'http://www.askgamblers.com/uploads/original/isoftbet-2-5474883270a0f81c4b8b456b.png';
        };

        $video_cats = wp_get_post_terms($videohere->ID,'iod_category');

        $hascat = false;
        $videocat = '';
        $videocatlink = '';
        if($video_cats){
            $hascat = true;
            if(count($video_cats)){
                $videocat = $video_cats[0]->name;
                $videocatlink = get_term_link($video_cats[0]->term_id,'iod_category');
            }
            foreach ($video_cats as $vidcat) {
                $vcats[] = '<a href="'.get_term_link($vidcat->term_id,'iod_category').'">'.$vidcat->name.'</a>';
            }
        }

        $featuredvideos[] = [
            'title' => $videocat ,
            'titlelink' => $videocatlink,
            // 'category' =>
            'description' => trim_text($videohere->post_title,40),
            'date' => $videohere->post_date,
            'thumbnail' => $iod_video_thumbnail,
            'link' => $iod_video ?: get_the_permalink($videohere->ID)
        ];
    }
}

$post = $featuredvideos;


// $videos = [
// 	[
// 		'title' => 'KENYON MARTIN'
// 		'description' => 'HOW TO BE DUMBASS',
// 		'date' => 'August 31, 2016',
// 		'thumbnail' = 'http://marketmasterclass.btcglobaltrader.dev/wp-content/themes/mmcv2/img-temp/photo-1420655710207-b092e1b8abe3.jpg',
// 		'link' => '#'
// 	]
// ];

?>

<section class="featured-grid video-grid" >
    <div class="container">
        <header class="text-left margin-bottom-10">
            <h3 class="font-proxima uppercase"><?=($featureTitle ?: 'Divest Media <span>TV</span>')?></h3>
        </header>

        <div class="row">
            <!-- Col 1 -->
            <div class="col-md-6 video-big-wrapper">
                <?php if(isset($post[0])): $video = $post[0]; ?>
                    <div class="item-box item-box-big noshadow margin-bottom-10">
                        <figure>
                            <span class="item-hover">
                                <span class="overlay dark-5"></span>
                            </span>
                            <span class="item-description">
                                <span class="overlay primary-bg"></span>
                                <span class="inner margin-top-30">
                                    <h3>
                                        <em>
                                            <?php if(is_home()): ?>
                                                <a href="<?=($video['titlelink'])?>" class="text-white" style=" background: rgba(2, 119, 46, 0.92); padding: 3px 6px; margin-bottom: 5px; display: inline-block;"><?=($video['title']=='Daily Stock Picks' ? 'Kenyon Martin' : $video['title'])?></a>
                                            <?php endif; ?>
                                        </em>
                                        <?=$video['description']?>
                                        <small class="block text-white margin-top-10"><?=date('F j, Y',strtotime($video['date']))?></small>
                                    </h3>
                                    <span class="block size-11 text-center color-theme uppercase">
                                        <!-- <?=date('F j, Y',strtotime($video['date']))?> -->
                                    </span>
                                    <a class="pos-bottom block btn-sm btn secondary-bg text-center noradius weight-700 video-grid-play" href="<?=$video['link']?>"  data-plugin-options="{&quot;type&quot;:&quot;iframe&quot;}"><?=($featureButton ?: 'PLAY NOW')?></a>


                                </span>
                            </span>

                            <img class="img-responsive" src="<?=$video['thumbnail']?>" alt="">
                        </figure>
                    </div>
                <?php endif; ?>
            </div>
            <!-- End Col 1 -->

            <!-- Col 2 -->
            <div class="col-md-3 col-sm-6 col-xs-6 col-2xs-12 video-grid-column-wrapper">
                <div class="item-box noshadow hover-box">
                    <?php if(isset($post[1])): $video = $post[1]; ?>
                        <figure>
                            <span class="item-hover">
                                <span class="overlay dark-5"></span>
                            </span>
                            <span class="item-description">
                                <span class="overlay primary-bg "></span>
                                <span class="inner padding-top-0">
                                    <h3>
                                        <em>
                                            <a href="<?=($video['titlelink'])?>" class="text-white" style=" background: rgba(29, 29, 29, 0.92); padding: 3px 6px; margin-bottom: 5px; display: inline-block;"><?=($video['title']=='Daily Stock Picks' ? 'Kenyon Martin' : $video['title'])?></a>
                                        </em>
                                        <?=$video['description']?>
                                        <small class="block text-white margin-top-10"><?=date('F j, Y',strtotime($video['date']))?></small>
                                    </h3>
                                    <span class="block size-11 text-center color-theme uppercase">
                                        <a class=" btn-sm btn primary-bg text-center noradius weight-700 video-grid-play" href="<?=$video['link']?>"   data-plugin-options="{&quot;type&quot;:&quot;iframe&quot;}"><?=($featureButton ?: 'PLAY NOW')?></a>
                                    </span>

                                </span>
                            </span>

                            <img class="img-responsive" src="<?=$video['thumbnail']?>" alt="">
                        </figure>
                    <?php endif; ?>
                </div>
                <div class="item-box noshadow hover-box margin-top-10">
                    <?php if(isset($post[2])): $video = $post[2]; ?>
                        <figure>
                            <span class="item-hover">
                                <span class="overlay dark-5"></span>
                            </span>
                            <span class="item-description">
                                <span class="overlay primary-bg "></span>
                                <span class="inner padding-top-0">
                                    <h3>
                                        <em>
                                            <a href="<?=($video['titlelink'])?>" class="text-white" style=" background: rgba(29, 29, 29, 0.92); padding: 3px 6px; margin-bottom: 5px; display: inline-block;"><?=($video['title']=='Daily Stock Picks' ? 'Kenyon Martin' : $video['title'])?></a>
                                        </em>
                                        <?=$video['description']?>
                                        <small class="block text-white margin-top-10"><?=date('F j, Y',strtotime($video['date']))?></small>
                                    </h3>
                                    <span class="block size-11 text-center color-theme uppercase">
                                        <a class=" btn-sm btn primary-bg text-center noradius weight-700 video-grid-play" href="<?=$video['link']?>"   data-plugin-options="{&quot;type&quot;:&quot;iframe&quot;}"><?=($featureButton ?: 'PLAY NOW')?></a>
                                    </span>

                                </span>
                            </span>

                            <img class="img-responsive" src="<?=$video['thumbnail']?>" alt="">
                        </figure>
                    <?php endif; ?>
                </div>
            </div>
            <!-- End Col 2 -->

            <!-- Col 3 -->
            <div class="col-md-3 col-sm-6 col-xs-6 col-2xs-12 video-grid-column-wrapper">
                <div class="item-box noshadow hover-box">
                    <?php if(isset($post[3])): $video = $post[3]; ?>
                        <figure>
                            <span class="item-hover">
                                <span class="overlay dark-5"></span>
                            </span>
                            <span class="item-description">
                                <span class="overlay primary-bg "></span>
                                <span class="inner padding-top-0">
                                    <h3>
                                        <em>
                                            <a href="<?=($video['titlelink'])?>" class="text-white" style=" background: rgba(29, 29, 29, 0.92); padding: 3px 6px; margin-bottom: 5px; display: inline-block;"><?=($video['title']=='Daily Stock Picks' ? 'Kenyon Martin' : $video['title'])?></a>
                                        </em>
                                        <?=$video['description']?>
                                        <small class="block text-white margin-top-10"><?=date('F j, Y',strtotime($video['date']))?></small>
                                    </h3>
                                    <span class="block size-11 text-center color-theme uppercase">
                                        <a class=" btn-sm btn primary-bg text-center noradius weight-700 video-grid-play" href="<?=$video['link']?>"   data-plugin-options="{&quot;type&quot;:&quot;iframe&quot;}"><?=($featureButton ?: 'PLAY NOW')?></a>
                                    </span>

                                </span>
                            </span>

                            <img class="img-responsive" src="<?=$video['thumbnail']?>" alt="">
                        </figure>
                    <?php endif; ?>
                </div>
                <div class="item-box noshadow hover-box margin-top-10">
                    <?php if(isset($post[4])): $video = $post[4]; ?>
                        <figure>
                            <span class="item-hover">
                                <span class="overlay dark-5"></span>
                            </span>
                            <span class="item-description">
                                <span class="overlay primary-bg "></span>
                                <span class="inner padding-top-0">
                                    <h3>
                                        <em>
                                            <a href="<?=($video['titlelink'])?>" class="text-white" style=" background: rgba(29, 29, 29, 0.92); padding: 3px 6px; margin-bottom: 5px; display: inline-block;"><?=($video['title']=='Daily Stock Picks' ? 'Kenyon Martin' : $video['title'])?></a>
                                        </em>
                                        <?=$video['description']?>
                                        <small class="block text-white margin-top-10"><?=date('F j, Y',strtotime($video['date']))?></small>
                                    </h3>
                                    <span class="block size-11 text-center color-theme uppercase">
                                        <a class=" btn-sm btn primary-bg text-center noradius weight-700 video-grid-play" href="<?=$video['link']?>"   data-plugin-options="{&quot;type&quot;:&quot;iframe&quot;}"><?=($featureButton ?: 'PLAY NOW')?></a>
                                    </span>

                                </span>
                            </span>

                            <img class="img-responsive" src="<?=$video['thumbnail']?>" alt="">
                        </figure>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-9 video-grid-details">

            </div>
        </div>
        <?php if(is_home()): ?>
            <div class="row">
                <?php

                $mainpost = $post;
                $featuredcats = [
                    [
                        'category' => 'Daily Stock Picks',
                        'title' => 'Kenyon Martin',
                        'description' => 'Daily Stock Picks',
                        'link' => '/video/kenyon-martin/#all-videos',
                    ],
                    [
                        'category' => 'Bruce Curran',
                        'title' => 'Bruce Curran',
                        'description' => 'How to be Dumbass',
                        'link' => '/video/kenyon-martin/#all-videos',
                    ],
                    [
                        'category' => 'MMC Headlines',
                        'title' => 'Global Headlines',
                        'description' => 'Investment Tips',
                        'link' => '/video/kenyon-martin/#all-videos',
                    ],
                    [
                        'category' => 'Bruce Curran Interviews',
                        'title' => 'Interviews',
                        'description' => 'World News',
                        'link' => '/video/world-news/#all-videos',
                    ]
                ];
                $featuredvideos = [];
                foreach ($featuredcats as $cat) {

                    $catobj = get_term_by('slug', sanitize_title($cat['category']) , 'iod_category' );
                    $featuredvideos[] = $catobj;
                }
                ?>
                <?php if(count($featuredvideos)):
                    $catThumbs = get_option('taxonomy_image_plugin');
                    if(!empty($catThumbs)){
                        ?>
                        <div class="heading-title heading-dotted text-left margin-top-20 ">
                            <a href="<?=site_url('videos')?>"><h4>Our<span> Channels</span></h4></a>
                        </div>
                        <?php foreach($featuredvideos as $fk=>$fv):

                            $img = wp_get_attachment_image_src( $catThumbs[$fv->term_id], 'mid-image', false );
                            ?>
                            <div class="col-md-3 col-sm-6 col-xs-6 col-2xs-12">
                                <div class="item-box noshadow hover-box margin-bottom-10 channel-item-box">
                                    <div class="img-hover">
                                        <a href="<?=(get_term_link($fv->term_id,'iod_category'))?>#all-videos">
                                            <figure style="border-bottom: 5px solid rgb(30, 205, 110); height: 200px; background-image: url(<?=$img[0]?>); background-size: cover; background-repeat: no-repeat;" class="lazyOwl" data-src=""></figure>
                                        </a>

                                        <h4 class="text-center margin-top-20 height-50 post-title ">
                                            <a href="<?=(get_term_link($fv->term_id,'iod_category'))?>#all-videos">
                                                <?=($featuredcats[$fk]['title'])?>
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                    }?>
                <?php endif; ?>
            </div>
            <?php if(!$featureNoMore): ?>
                <div class="heading-title heading-dotted text-right margin-top-20 ">
                    <a href="<?=site_url('videos')?>"><h4>Watch more<span> Videos</span></h4></a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>


<?php

$post = $mainpost;
