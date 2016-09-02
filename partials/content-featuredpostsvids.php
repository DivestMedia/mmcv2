<?php
global $featuredVids,$featuredTitle;
// $featuredVids = [
// 	'categories' => [
// 		[
// 			'name' => 'All Articles',
// 			'link' => '#',
// 			'active' => true
// 		],
// 		[
// 			'name' => 'Some Article',
// 			'link' => '#'
// 		]
// 	],
// 	'posts' => [
// 		295419,
// 		295415,
// 		295412
// 	]
// ];

?>


<section class="alternate">
	<div class="container">
		<header class="text-center margin-bottom-10 tiny-line">
			<h2 class="font-proxima uppercase"><?=($featuredTitle)?></h2>
		</header>

		<!-- Tab v3 -->
		<div class="row tab-v3">
			<div class="col-sm-3">


				<!-- side navigation -->
				<div class="side-nav margin-top-50">

					<div class="side-nav-head">
						<button class="fa fa-bars"></button>
						<h4>CATEGORIES</h4>
					</div>
					<?php if(count($featuredVids['categories'])): ?>
						<ul class="list-group list-unstyled nav nav-tabs nav-stacked nav-alternate uppercase">
							<?php foreach ($featuredVids['categories'] as $featCat): ?>
								<li class="list-group-item <?=((!empty($featCat['active']) && $featCat['active']==true) ? 'active' : '')?> <?=(count($featCat['child'])? 'open' : '')?>">
									<a href="<?=($featCat['link'] ?: '#')?>"><?=($featCat['name'] ?: 'Uncategorized')?></a>
									<?php
									 if(count($featCat['child'])): ?>
										<ul class="list-group list-unstyled nav nav-tabs nav-stacked nav-alternate uppercase">
											<?php foreach ($featCat['child'] as $featCatChild): ?>
												<li class="list-group-item <?=((!empty($featCatChild['active']) && $featCat['active']==true) ? 'active' : '')?>">
													<a href="<?=($featCatChild['link'] ?: '#')?>"><?=($featCatChild['name'] ?: 'Uncategorized')?></a>
												</li>
											<?php endforeach;?>
										</ul>
									<?php endif;?>
								</li>
							<?php endforeach;?>
						</ul>
					<?php endif;?>
				</ul>


			</div>
			<!-- /side navigation -->
		</div>
		<div class="col-sm-9">
			<div class="tab-content">
				<div class="tab-pane fade in active" id="planning">
					<div class="row">
						<?php
						$mainpost = $post;



						if(count($featuredVids['posts'])):
							foreach($featuredVids['posts'] as $post):

								$post = get_post($post);

								$iod_video = '';
								$iod_video_thumbnail = '';
								if($post){
									// $videohere = $videohere[0];
									$iod_video = json_decode(get_post_meta( $post->ID, '_iod_video',true))->embed->url;
									$ytpattern = '/^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/';
									if(preg_match($ytpattern,$iod_video,$vid_id)){
										$iod_video_thumbnail = 'http://img.youtube.com/vi/'.end($vid_id).'/mqdefault.jpg';
									}else{
										$iod_video_thumbnail = 'http://www.askgamblers.com/uploads/original/isoftbet-2-5474883270a0f81c4b8b456b.png';
									};
								}

								?>
								<div class="col-sm-4 margin-bottom-20">
									<a href="<?=get_the_permalink()?>">
										<img class="img-responsive" src="<?=($iod_video_thumbnail)?>" />
									</a>
									<h4 class="margin-top-20 size-14 weight-700 uppercase height-20 text-center"><a href="<?=get_the_permalink($post->ID)?>"><?=xyr_smarty_limit_chars(get_the_title($post->ID),80)?></a></h4>
									<a class="block  btn-sm btn primary-bg text-center noradius weight-700 lightbox lightbox" href="<?=($iod_video)?>" data-plugin-options="{&quot;type&quot;:&quot;iframe&quot;}">PLAY NOW</a>
									<!-- <ul class="text-left size-12 list-inline list-separator">
										<li>
											<i class="fa fa-calendar"></i>
											<?=get_the_date('D M j')?>
										</li>
									</ul> -->
								</div>
								<?php
							endforeach;
						endif;
						$post = $mainpost;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Tab v3 -->

</div>
</section>
