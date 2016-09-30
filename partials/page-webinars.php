<?php
get_template_part( 'partials/content', 'indexwatch' );

$featuredvideos = [];
$excludevideoid = [];
$_iod_vid = get_posts([
    'post_type'   => 'iod_video',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'posts_per_archive_page' => 5,
    'orderby' => 'date',
    'order' => 'DESC',
    'category__not_in' => [ 42 ],
    'taxonomy'=>'iod_category',
    'tax_query' => [
        [
            'taxonomy'  => 'iod_category',
            'field'     => 'slug',
            'terms'     => array('dummies-guide'), 
        ]
    ],
]);
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

	$vid_id = explode('/',$dg_c_vid['link']);
	if(!empty($vid_id)){
		$vid_id = $vid_id[count($vid_id)-1];
	}
$vid_link = '//www.youtube.com/v/'.$vid_id;
?>
<section>
	<div class="container">
		<header class="text-center margin-bottom-50 tiny-line">
			<h2 class="font-proxima uppercase">WEBINARS</h2>
		</header>

		<div class="embed-responsive embed-responsive-16by9" style="border: 5px solid #27ae60;">
		  <iframe class="embed-responsive-item" width="100%" height="100%" src="<?=$vid_link?>?autoplay=1&controls=1&modestbranding=1&rel=0" frameborder="0" allowfullscreen></iframe>
		</div>

		<header class="text-center margin-top-20 margin-bottom-50">
			<h1 class="letter-spacing-3">
				 
				<!-- 
				word rotator - default delay: 2000. 
				Change rotating delay: data-delay="5000" 
				-->
				<span class="word-rotator custom-word-rotator" data-delay="2000">
					<span class="items text-center">
						<span>MORE WEBINARS</span>
						<span>COMING SOON</span>
					</span>
				</span><!-- /word rotator -->
			</h1>
		</header>

	</div>	
</section>