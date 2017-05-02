<?php
$featuredvideos = [];
$excludevideoid = [];

$_iod_vid = [];
$_iod_vid_id = get_posts([
    'post_type'   => 'iod_video',
    'post_status' => 'publish',
    'posts_per_page' => 1,
    'posts_per_archive_page' => 1,
    'orderby' => 'date',
    'order' => 'DESC',
    'category__not_in' => [ 42 ],
    'taxonomy'=>'iod_category',
    'tax_query' => [
        [
            'taxonomy'  => 'iod_category',
            'field'     => 'slug',
            'terms'     => 'invest-or-divest',
        ]
    ],
]);
$_iod_vid_dg = get_posts([
    'post_type'   => 'iod_video',
    'post_status' => 'publish',
    'posts_per_page' => 1,
    'posts_per_archive_page' => 1,
    'orderby' => 'date',
    'order' => 'DESC',
    'category__not_in' => [ 42 ],
    'taxonomy'=>'iod_category',
    'tax_query' => [
        [
            'taxonomy'  => 'post_tag',
            'field'     => 'slug',
            'terms'     => 'introduction',
        ]
    ],
]);
array_push($_iod_vid,$_iod_vid_dg[0]);
array_push($_iod_vid,$_iod_vid_id[0]);
foreach ($_iod_vid as $videohere) {

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
        $img = wp_get_attachment_image_src( get_post_thumbnail_id($videohere->ID), 'mid-image', false );
        $featuredvideos[] = [
            'title' => $videohere->post_title ,
            'titlelink' => $videocatlink,
            // 'category' =>
            'description' => trim_text($videohere->post_title,40),
            'date' => $videohere->post_date,
            'thumbnail' => !empty($img[0])?$img[0]:$iod_video_thumbnail,
            'link' => $iod_video ?: get_the_permalink($videohere->ID)
        ];
    }
}
	if(!empty($featuredvideos[0])){
		$dg_c_vid = $featuredvideos[0];
	}
	if(!empty($featuredvideos[1])){
		$iod_c_vid = $featuredvideos[1];
	}

?>
<section class="dark alternate" id="container-coming-soon">
		<div class="container">



			<div class="row">
				<!-- Col 1 -->
				<div class="col-sm-6 col-md-6 margin-bottom-20">
					<header class="text-center margin-bottom-50 tiny-line">
						<h2 class="font-proxima uppercase">Invest or <span>Divest</span></h2>
						<p class="text-uppercase">User-based Video Reviews</p>
					</header>
					<div class="item-box noshadow cont-c-vid">
						<figure class="embed-responsive embed-responsive-16by9">
							<span class="item-hover">
								<span class="overlay dark-5"></span>
							</span>
							<span class="item-description">
								<span class="overlay primary-bg height-100"></span>
								<span class="inner margin-top-30p height-100 padding-top-20">
									<!-- <h3 class="margin-top-10 margin-bottom-10">User-based Video Reviews</h3> -->
									<span class="block size-11 text-center color-theme uppercase">
										<?=$iod_c_vid['title']?>
									</span>
									<a class="pos-bottom block btn-sm btn secondary-bg text-center noradius weight-700 coming-soon-play" href="<?=$iod_c_vid['link']?>"  data-plugin-options="{&quot;type&quot;:&quot;iframe&quot;}">PLAY NOW</a>
								</span>
							</span>

							<img class="img-responsive liner" src="<?=$iod_c_vid['thumbnail']?>" alt="">
						</figure>
					</div>


				</div>
				<!-- End Col 1 -->

				<!-- Col 2 -->
				<div class="col-sm-6 col-md-6 margin-bottom-20">
					<header class="text-center margin-bottom-50 tiny-line">
						<h2 class="font-proxima uppercase"><a href="<?=site_url('dummies-guide')?>">Dummies&apos; <span>Guide</span></a></h2>
						<p class="text-uppercase">Beginner's Manual</p>
					</header>
					<div class="item-box noshadow cont-c-vid">
						<figure class="embed-responsive embed-responsive-16by9">
							<span class="item-hover">
								<span class="overlay dark-5"></span>
							</span>
							<span class="item-description">
								<span class="overlay primary-bg height-100"></span>
								<span class="inner margin-top-30p height-100 padding-top-20">
									<!-- <h3 class="margin-top-10 margin-bottom-10">Beginner's Manual</h3> -->
									<span class="block size-11 text-center color-theme uppercase">
										<?=$dg_c_vid['title']?>
									</span>
									<a class="pos-bottom block btn-sm btn secondary-bg text-center noradius weight-700 coming-soon-play" href="<?=$dg_c_vid['link']?>"  data-plugin-options="{&quot;type&quot;:&quot;iframe&quot;}">PLAY NOW</a>
								</span>
							</span>

							<img class="img-responsive liner" src="<?=$dg_c_vid['thumbnail']?>" alt="">
						</figure>
					</div>


				</div>
				<!-- End Col 2 -->

			</div>

		</div>
	</section>

		<script>
			$(function() {
                if(typeof xyrLoadImg == 'function'){
            		xyrLoadImg();
            	}
			});
		</script>
