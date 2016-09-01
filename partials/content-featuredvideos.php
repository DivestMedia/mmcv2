<?php
global $post,$featureTitle,$featureButton;
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

<section class="" >
	<div class="container">
		<header class="text-left margin-bottom-10">
			<h3 class="font-proxima uppercase"><?=($featureTitle ?: 'Most Popular <span>Videos</span>')?></h3>
		</header>

		<div class="row">
			<!-- Col 1 -->
			<div class="col-md-6">
				<?php if(isset($post[0])): $video = $post[0]; ?>
					<div class="item-box noshadow">
						<figure>
							<span class="item-hover">
								<span class="overlay dark-5"></span>
							</span>
							<span class="item-description">
								<span class="overlay primary-bg"></span>
								<span class="inner margin-top-30">
									<h3><em><?=$video['title']?></em><?=$video['description']?></h3>
									<span class="block size-11 text-center color-theme uppercase">
										<?=date('F j, Y',strtotime($video['date']))?>
									</span>
									<a class="pos-bottom block btn-sm btn secondary-bg text-center noradius weight-700" href="<?=$video['link']?>"><?=($featureButton ?: 'PLAY NOW')?></a>
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
									<h3><em><?=$video['title']?></em><?=$video['description']?></h3>
									<span class="block size-11 text-center color-theme uppercase">
										<a class=" btn-sm btn primary-bg text-center noradius weight-700" href="<?=$video['link']?>"><?=($featureButton ?: 'PLAY NOW')?></a>
									</span>

								</span>
							</span>

							<img class="img-responsive" src="<?=$video['thumbnail']?>" alt="">
						</figure>
					<?php endif; ?>
				</div>
				<div class="item-box noshadow hover-box margin-top-20">
					<?php if(isset($post[2])): $video = $post[2]; ?>
						<figure>
							<span class="item-hover">
								<span class="overlay dark-5"></span>
							</span>
							<span class="item-description">
								<span class="overlay primary-bg "></span>
								<span class="inner padding-top-0">
									<h3><em><?=$video['title']?></em><?=$video['description']?></h3>
									<span class="block size-11 text-center color-theme uppercase">
										<a class=" btn-sm btn primary-bg text-center noradius weight-700" href="<?=$video['link']?>"><?=($featureButton ?: 'PLAY NOW')?></a>
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
									<h3><em><?=$video['title']?></em><?=$video['description']?></h3>
									<span class="block size-11 text-center color-theme uppercase">
										<a class=" btn-sm btn primary-bg text-center noradius weight-700" href="<?=$video['link']?>"><?=($featureButton ?: 'PLAY NOW')?></a>
									</span>

								</span>
							</span>

							<img class="img-responsive" src="<?=$video['thumbnail']?>" alt="">
						</figure>
					<?php endif; ?>
				</div>
				<div class="item-box noshadow hover-box margin-top-20">
					<?php if(isset($post[4])): $video = $post[4]; ?>
						<figure>
							<span class="item-hover">
								<span class="overlay dark-5"></span>
							</span>
							<span class="item-description">
								<span class="overlay primary-bg "></span>
								<span class="inner padding-top-0">
									<h3><em><?=$video['title']?></em><?=$video['description']?></h3>
									<span class="block size-11 text-center color-theme uppercase">
										<a class=" btn-sm btn primary-bg text-center noradius weight-700" href="<?=$video['link']?>"><?=($featureButton ?: 'PLAY NOW')?></a>
									</span>

								</span>
							</span>

							<img class="img-responsive" src="<?=$video['thumbnail']?>" alt="">
						</figure>
					<?php endif; ?>
				</div>

			</div>
			<!-- End Col 3 -->
		</div>

	</div>
</section>
