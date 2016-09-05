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
			<h3 class="font-proxima uppercase"><?=($featureTitle ?: 'Most Popular <span>Videos</span>')?></h3>
		</header>

		<div class="row">
			<!-- Col 1 -->
			<div class="col-md-6">
				<?php if(isset($post[0])): $video = $post[0]; ?>
					<div class="item-box item-box-big noshadow margin-bottom-10">
						<figure>
							<span class="item-hover">
								<span class="overlay dark-5"></span>
							</span>
							<span class="item-description">
								<span class="overlay primary-bg"></span>
								<span class="inner margin-top-30">
									<h3><em><a href="<?=($video['titlelink'])?>" class="text-white"><?=$video['title']?></a></em><?=$video['description']?></h3>
									<span class="block size-11 text-center color-theme uppercase">
										<?=date('F j, Y',strtotime($video['date']))?>
									</span>
									<a class="pos-bottom block btn-sm btn secondary-bg text-center noradius weight-700 lightbox" href="<?=$video['link']?>"  data-plugin-options="{&quot;type&quot;:&quot;iframe&quot;}"><?=($featureButton ?: 'PLAY NOW')?></a>


								</span>
							</span>

							<img class="img-responsive" src="<?=$video['thumbnail']?>" alt="">
						</figure>
					</div>
				<?php endif; ?>
			</div>
			<!-- End Col 1 -->

			<!-- Col 2 -->
			<div class="col-md-3 col-sm-6 col-xs-6 col-2xs-12">
				<div class="item-box noshadow hover-box">
					<?php if(isset($post[1])): $video = $post[1]; ?>
						<figure>
							<span class="item-hover">
								<span class="overlay dark-5"></span>
							</span>
							<span class="item-description">
								<span class="overlay primary-bg "></span>
								<span class="inner padding-top-0">
									<h3><em><a href="<?=($video['titlelink'])?>" style="color:#fff"><?=$video['title']?></a></em><?=$video['description']?></h3>
									<span class="block size-11 text-center color-theme uppercase">
										<a class=" btn-sm btn primary-bg text-center noradius weight-700 lightbox" href="<?=$video['link']?>"   data-plugin-options="{&quot;type&quot;:&quot;iframe&quot;}"><?=($featureButton ?: 'PLAY NOW')?></a>
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
									<h3><em><a href="<?=($video['titlelink'])?>" style="color:#fff"><?=$video['title']?></a></em><?=$video['description']?></h3>
									<span class="block size-11 text-center color-theme uppercase">
										<a class=" btn-sm btn primary-bg text-center noradius weight-700 lightbox" href="<?=$video['link']?>"   data-plugin-options="{&quot;type&quot;:&quot;iframe&quot;}"><?=($featureButton ?: 'PLAY NOW')?></a>
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
			<div class="col-md-3 col-sm-6 col-xs-6 col-2xs-12">
				<div class="item-box noshadow hover-box">
					<?php if(isset($post[3])): $video = $post[3]; ?>
						<figure>
							<span class="item-hover">
								<span class="overlay dark-5"></span>
							</span>
							<span class="item-description">
								<span class="overlay primary-bg "></span>
								<span class="inner padding-top-0">
									<h3><em><a href="<?=($video['titlelink'])?>" style="color:#fff"><?=$video['title']?></a></em><?=$video['description']?></h3>
									<span class="block size-11 text-center color-theme uppercase">
										<a class=" btn-sm btn primary-bg text-center noradius weight-700 lightbox" href="<?=$video['link']?>"   data-plugin-options="{&quot;type&quot;:&quot;iframe&quot;}"><?=($featureButton ?: 'PLAY NOW')?></a>
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
									<h3><em><a href="<?=($video['titlelink'])?>" style="color:#fff"><?=$video['title']?></a></em><?=$video['description']?></h3>
									<span class="block size-11 text-center color-theme uppercase">
										<a class=" btn-sm btn primary-bg text-center noradius weight-700 lightbox" href="<?=$video['link']?>"   data-plugin-options="{&quot;type&quot;:&quot;iframe&quot;}"><?=($featureButton ?: 'PLAY NOW')?></a>
									</span>

								</span>
							</span>

							<img class="img-responsive" src="<?=$video['thumbnail']?>" alt="">
						</figure>
					<?php endif; ?>
				</div>

			</div>
		</div>
		<?php if(!$featureNoMore): ?>
			<div class="heading-title heading-dotted text-right margin-top-20 ">
				<a href="<?php site_url('videos');?>"><h4>Watch more<span> Videos</span></h4></a>
			</div>
		<?php endif; ?>
	</div>
</section>


<?php

$post = $mainpost;

