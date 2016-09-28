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


<section id="all-videos" class="alternate">
	<div class="container">
		<header class="text-center margin-bottom-10 tiny-line">
			<h2 class="font-proxima uppercase"><?=($featuredTitle)?></h2>
		</header>

		<!-- Tab v3 -->
		<div class="row tab-v3">
			<div class="col-sm-3 hidden-xs hidden-sm">

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
									<a href="<?=($featCat['link'] ?: '#')?>#all-videos"><?=($featCat['name'] ?: 'Uncategorized')?></a>
									<?php if(count($featCat['child'])): ?>
										<ul class="list-group list-unstyled nav nav-tabs nav-stacked nav-alternate uppercase">
											<?php foreach ($featCat['child'] as $featCatChild): ?>
												<li class="list-group-item <?=((!empty($featCatChild['active']) && $featCatChild['active']==true) ? 'active' : '')?>">
													<a href="<?=($featCatChild['link'] ?: '#')?>#all-videos"><?=($featCatChild['name'] ?: 'Uncategorized')?></a>
												</li>
											<?php endforeach;?>
										</ul>
									<?php endif;?>
								</li>
							<?php endforeach;?>
						</ul>
					<?php endif; ?>
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
									<div class="item-box noshadow hover-box margin-top-10">
										<figure>
											<span class="item-hover">
												<span class="overlay dark-5"></span>
											</span>
											<span class="item-description">
												<span class="overlay primary-bg "></span>
												<span class="inner padding-top-0">
													<h3>
														<em>
															<a href="#" style="color:#fff"></a>
														</em>
														<?=xyr_smarty_limit_chars(get_the_title($post->ID),40)?>
				                                        <small class="block text-white margin-top-10"><?=date('F j, Y',strtotime($post->post_date))?></small>
													</h3>
													<span class="block size-11 text-center color-theme uppercase">
														<a class=" btn-sm btn primary-bg text-center noradius weight-700 video-grid-play" href="<?=($iod_video)?>" data-plugin-options="{&quot;type&quot;:&quot;iframe&quot;}">PLAY NOW</a>
													</span>

												</span>
											</span>

											<img class="img-responsive" src="<?=($iod_video_thumbnail)?>" alt="">
										</figure>
									</div>

								</div>

								<?php
							endforeach;

						endif;
						$post = $mainpost;
						?>
						
					</div>
					<div class="pagination"><?=posts_pagination(12)?></div>
				</div>
			</div>
		</div>
	</div>
	<!-- Tab v3 -->

</div>
</section>
