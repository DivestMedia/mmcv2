<?php
$postnotin = [];
$category_tags = [
	[
		'id' => 7,
		'link' => '/tag/asia/',
		'name' => 'Asia',
		'slug' => 'asia',
		'stock' => true,
	],
	[
		'id' => 21,
		'link' => '/tag/banking-finance/',
		'name' => 'Banking/Finance',
		'slug' => 'banking-finance',
	],
	[
		'id' => 19,
		'link' => '/tag/bonds/',
		'name' => 'Bonds',
		'slug' => 'bonds',
		'stock' => true,
	],
	[
		'id' => 16,
		'link' => '/tag/commodities/',
		'name' => 'Commodities',
		'slug' => 'commodities',
		'stock' => true,
	],
	[
		'id' => 14,
		'link' => '/tag/construction/',
		'name' => 'Construction',
		'slug' => 'construction',
	],
	[
		'id' => 22,
		'link' => '/tag/consumer-goods/',
		'name' => 'Consumer Goods',
		'slug' => 'consumer-goods',
	],
	[
		'id' => 8,
		'link' => '/tag/currencies/',
		'name' => 'Currencies',
		'slug' => 'currencies',
		'stock' => true,
	],
	[
		'id' => 15,
		'link' => '/tag/energy/',
		'name' => 'Energy',
		'slug' => 'energy',
	],
	[
		'id' => 25,
		'link' => '/tag/etfs/',
		'name' => 'ETF&apos;s',
		'slug' => 'etfs',
		'stock' => true,
	],
	[
		'id' => 3,
		'link' => '/tag/europe/',
		'name' => 'Europe',
		'slug' => 'europe',
		'stock' => true,
	],
	[
		'id' => 13,
		'link' => '/tag/funds/',
		'name' => 'Funds',
		'slug' => 'funds',
	],
	// [
	// 	'id' => 9,
	// 	'link' => '/tag/industrial/',
	// 	'name' => 'Industrial',
	// 	'slug' => 'industrial',
	// ],
	[
		'id' => 26,
		'link' => '/tag/industrial-goods/',
		'name' => 'Industrial Goods',
		'slug' => 'industrial-goods',
	],
	[
		'id' => 17,
		'link' => '/tag/manufacturing/',
		'name' => 'Manufacturing',
		'slug' => 'manufacturing',
	],
	[
		'id' => 24,
		'link' => '/tag/media/',
		'name' => 'Media',
		'slug' => 'media',
	],
	[
		'id' => 12,
		'link' => '/tag/mining/',
		'name' => 'Mining',
		'slug' => 'mining',
	],
	[
		'id' => 18,
		'link' => '/tag/pharmaceuticals/',
		'name' => 'Pharmaceuticals',
		'slug' => 'pharmaceuticals',
	],
	[
		'id' => 4,
		'link' => '/tag/pre-markets/',
		'name' => 'Pre-Markets',
		'slug' => 'pre-markets',
		'stock' => true,
	],
	[
		'id' => 10,
		'link' => '/tag/real-estate/',
		'name' => 'Real Estate',
		'slug' => 'real-estate',
	],
	[
		'id' => 23,
		'link' => '/tag/retail/',
		'name' => 'Retail',
		'slug' => 'retail',
	],
	[
		'id' => 5,
		'link' => '/tag/stocks/',
		'name' => 'Stocks',
		'slug' => 'stocks',
		'stock' => true,
	],
	[
		'id' => 20,
		'link' => '/tag/technology/',
		'name' => 'Technology',
		'slug' => 'technology',
	],
	[
		'id' => 11,
		'link' => '/tag/travel/',
		'name' => 'Travel',
		'slug' => 'travel',
	],
	[
		'id' => 6,
		'link' => '/tag/usa/',
		'name' => 'USA',
		'slug' => 'usa',
		'stock' => true,
	],
];
?>

<section class="alternate" id="global_news">
	<div class="container">
		<div class="row">

			<header class="text-center margin-bottom-50 tiny-line">
				<h2 class="font-proxima uppercase">Global Business <span>News</span></h2>
			</header>
			<?php
			// $category_tags = get_category_tags(get_category_by_slug('news')->term_id);

			// $tags = [];
			// foreach ($category_tags as $key => $cat) {
			// 	if(in_array($cat['slug'],[
			// 		'pre-markets',
			// 		'usa',
			// 		'asia',
			// 		'europe',
			// 		'stocks',
			// 		'commodities',
			// 		'currencies',
			// 		'bonds',
			// 		'funds',
			// 		'etfs'
			// 		])) continue;
			//
			// 		$tags[] = $cat['slug'];
			// 	}

			wp_reset_postdata();

			// $global_news = get_posts([
			// 	'posts_per_page' => 5,
			// 	'category_name' => 'News',
			// 	'orderby' => 'date',
			// 	'order' => 'DESC',
			// 	'post_type' => 'post',
			// 	'post_status' => 'publish',
			// 	'suppress_filters' => true,
			// 	'tag_slug__in' => $tags,
			// ]);

			$global_news = json_decode(file_get_contents_curl(add_query_arg([
				'page' => 1,
				'categories' => 2,
				'per_page' => 10
			], NEWSBASEURL . 'wp-json/wp/v2/posts')));

			?>
			<div class="col-sm-3">
				<div class="side-nav margin-top-50">
					<div class="side-nav-head">
						<button class="fa fa-bars"></button>
						<h4>LATEST <span>NEWS HEADLINES</span></h4>
					</div>

					<?php
					// $newsHeadlines =  get_posts([
					// 	'posts_per_page'   => 10,
					// 	'category_name'    => 'Headlines',
					// 	'orderby'          => 'date',
					// 	'order'            => 'DESC',
					// 	'post_type'        => 'post',
					// 	'post_status'      => 'publish',
					// 	'paged' => get_query_var('paged') ?: 1,
					// 	'suppress_filters' => true,
					// ]);

					$newsHeadlines = json_decode(file_get_contents_curl(add_query_arg([
						'page' => 1,
						'categories' => 36,
						'per_page' => 10,
					], NEWSBASEURL . 'wp-json/wp/v2/posts')));

					?>

					<?php if($newsHeadlines): ?>
						<ul class="list-group list-unstyled nav nav-tabs nav-stacked nav-alternate uppercase">
							<?php foreach ($newsHeadlines as $nheadline): ?>
								<li class="list-group-item">
									<a href="<?=$nheadline->link?>" data-toggle="tab"><?=xyr_smarty_limit_chars($nheadline->title->rendered,60)?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-sm-9">
				<?php if(count($global_news)): ?>
					<div class="text-center news-category-labels margin-top-20 margin-bottom-30">
						<a href="<?=site_url('/category/news/')?>" class="news-category-link active"><span class="badge badge-green">Categories</span></a>
						<?php
						// $category_tags = get_category_tags(get_category_by_slug('news')->term_id);
						foreach ($category_tags as $key => $cat) {

							if(in_array($cat['slug'],[
								'pre-markets',
								'usa',
								'asia',
								'europe',
								'stocks',
								'commodities',
								'currencies',
								'bonds',
								'funds',
								'etfs'
								])) continue;

								if($cat['slug']=='banking-finance'){
									$cat['name'] = 'Banking';
								}

								$featuredPostCategories[] = [
									'id' => $cat['id'],
									'name' => $cat['name'],
									'link' => $cat['link']
								];

								echo '<a href="'.$cat['link'].'" class="news-category-link"><span class="badge badge-green">'.$cat['name'].'</span></a>';
							}

							?>
						</div>

						<div class="owl-carousel owl-padding-10 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"3", "autoPlay": 4000, "navigation": true, "pagination": false, "stopOnHover": true }' id="global-news-post-slider">
							<?php foreach($global_news as $post):

								$postnotin[] = $post->ID;

								?>
								<div class="img-hover">
									<a href="<?=$post->link?>">
										<?php

										$posttags = $post->post_tags;

										$posttags = array_filter($posttags,function($t){
											if(!in_array($t->slug,[
												'pre-markets',
												'usa',
												'asia',
												'europe',
												'stocks',
												'commodities',
												'currencies',
												'bonds',
												'funds',
												'etfs'
												])) return true;
												return false;
											});
											if ($posttags) {
												$ftag = array_rand($posttags);
												?>
												<label class="badge badge-green pull-right margin-top-10 margin-right-10">
													<span href="<?=$ftag->link?>" class="text-white"><i class="fa fa-fw fa-tag"></i><?=$posttags[$ftag]->name?></span>
												</label>
												<?php
											}else{
												?>
												<label class="badge badge-green pull-right margin-top-10 margin-right-10">
													<span href="/category/news" class="text-white"><i class="fa fa-fw fa-tag"></i>News</span>
												</label>
												<?php
											}

											?>
											<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=($post->post_thumbnail->{'mid-image'}[0])?>');background-size: cover;background-repeat: no-repeat;height: 200px;" class="lazyOwl" data-src="<?=($post->post_thumbnail->{'mid-image'}[0])?>"></figure>
										</a>

										<h4 class="text-left margin-top-20 height-50 post-title"><a href="<?=$post->link?>"><?=xyr_smarty_limit_chars($post->title->rendered,80)?></a></h4>
										<div class="text-left margin-bottom-10 height-100 post-excerpt"><?=xyr_smarty_limit_chars(strip_tags(html_entity_decode($post->content->rendered)),200)?></div>
										<ul class="text-left size-12 list-inline list-separator">
											<li class="block">
												<i class="fa fa-calendar"></i>
												<?=date('D M j, Y',strtotime($post->date))?>&nbsp;<small class="pull-right"><?=human_time_diff( strtotime($post->date), current_time('timestamp') ) . " ago"?></small>
											</li>
										</ul>
									</div>
								<?php endforeach; ?>

							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="heading-title heading-dotted">
							<h4>US <span>News</span></h4>
						</div>
						<?php
						// $usa_news = get_posts([
						// 	'posts_per_page' => 5,
						// 	'category_name' => 'News',
						// 	'orderby' => 'date',
						// 	'order' => 'DESC',
						// 	'post_type' => 'post',
						// 	'post_status' => 'publish',
						// 	'suppress_filters' => true,
						// 	'meta_key'=>'_thumbnail_id',
						// 	'tag_slug__in' => ['usa'],
						// 	'post__not_in' =>  $postnotin
						// ]);

						$usa_news = json_decode(file_get_contents_curl(add_query_arg([
							'page' => 1,
							'categories' => 2,
							'per_page' => 5,
							'tags' => 6,
							'exclude' => $postnotin
						],'http://wordpress-16884-37649-153865.cloudwaysapps.com/wp-json/wp/v2/posts')));
						?>
						<?php if(count($usa_news)): ?>
							<div class="" id="global-news-post-slider-usa">
								<?php foreach($usa_news as $k=>$post):  $postnotin[] = $post->ID; ?>
									<div class="link-gray"<?php if($k==0):?> style="height: 106px;" <?php endif;?>>
										<?php if($k==0):?>
											<a href="<?=$post->link?>" class="height-100 pull-left width-100 margin-right-10">
												<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=($post->post_thumbnail->{'mid-image'}[0])?>');background-size: cover;background-repeat: no-repeat;background-position:center;" class="lazyOwl height-100" data-src="<?=($post->post_thumbnail->{'mid-image'}[0])?>"></figure>
											</a>
										<?php endif;?>
										<a class="<?php if($k==0):?> size-14 weight-600<?php else:?> size-12 <?php endif;?>" href="<?=$post->link?>"><?php if($k!=0):?> <span class="fa fa-fw fa-angle-right"></span> <?php endif;?><?=xyr_smarty_limit_chars($post->title->rendered,80)?></a>
											<?php if($k==0):?>
												<p style="height: 42px; margin-top:10px;margin-bottom: 3px!important;overflow: hidden;"><?=xyr_smarty_limit_chars(strip_tags(html_entity_decode($post->content->rendered)),200)?></p>
											<?php endif;?>
											<?php if($k==0):?>
												<ul class="text-left size-12 list-inline list-separator">
													<li class="block"><i class="fa fa-calendar"></i><?=date('D M j, Y',strtotime($post->date))?>&nbsp;<small class="pull-right"><?=human_time_diff( strtotime($post->date), current_time('timestamp') ) . " ago"?></small></small></li>


												</ul>
											<?php endif;?>
										</div>
										<?php if($k==0):?>
											<div class="clearfix"></div>
										<?php endif;?>
									<?php endforeach; ?>
								</div>
								<div class="divider margin-bottom-0 margin-top-10"><!-- divider --></div>
								<div class="heading-title text-right margin-top-0 link-viewmore-news">
									<a href="/tag/usa/"><h4 class="size-15">View more<span> News</span></h4></a>
								</div>
							<?php endif; ?>
						</div>

						<div class="col-md-4">
							<div class="heading-title heading-dotted">
								<h4>Asia <span>News</span></h4>
							</div>
							<?php
							// $asia_news = get_posts([
							// 	'posts_per_page' => 5,
							// 	'category_name' => 'News',
							// 	'orderby' => 'date',
							// 	'order' => 'DESC',
							// 	'post_type' => 'post',
							// 	'post_status' => 'publish',
							// 	'suppress_filters' => true,
							// 	'meta_key'=>'_thumbnail_id',
							// 	'tag_slug__in' => ['asia'],
							// 	'post__not_in' =>  $postnotin
							// ]);

							$asia_news = json_decode(file_get_contents_curl(add_query_arg([
								'page' => 1,
								'categories' => 2,
								'per_page' => 5,
								'tags' => 7,
								'exclude' => $postnotin
							],'http://wordpress-16884-37649-153865.cloudwaysapps.com/wp-json/wp/v2/posts')));
							?>
							<?php if(count($asia_news)): ?>
								<div class="" id="global-news-post-slider-asia">
									<?php foreach($asia_news as $k=>$post): $postnotin[] = $post->ID; ?>
										<div class="link-gray"<?php if($k==0):?> style="height: 106px;" <?php endif;?>>
											<?php if($k==0):?>
												<a href="<?=$post->link?>" class="height-100 pull-left width-100 margin-right-10">
													<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=($post->post_thumbnail->{'mid-image'}[0])?>');background-size: cover;background-repeat: no-repeat;background-position:center;" class="lazyOwl height-100" data-src="<?=($post->post_thumbnail->{'mid-image'}[0])?>"></figure>
												</a>
											<?php endif;?>
											<a class="<?php if($k==0):?> size-14 weight-600<?php else:?> size-12 <?php endif;?>" href="<?=$post->link?>"><?php if($k!=0):?> <span class="fa fa-fw fa-angle-right"></span> <?php endif;?><?=xyr_smarty_limit_chars($post->title->rendered,80)?></a>
												<?php if($k==0):?>
													<p style="height: 42px; margin-top:10px;margin-bottom: 3px!important;overflow: hidden;"><?=xyr_smarty_limit_chars(strip_tags(html_entity_decode($post->content->rendered)),200)?></p>
												<?php endif;?>
												<?php if($k==0):?>
													<ul class="text-left size-12 list-inline list-separator">
														<li class="block"><i class="fa fa-calendar"></i><?=date('D M j, Y',strtotime($post->date))?>&nbsp;<small class="pull-right"><?=human_time_diff( strtotime($post->date), current_time('timestamp') ) . " ago"?></small></small></li>


													</ul>
												<?php endif;?>
											</div>
											<?php if($k==0):?>
												<div class="clearfix"></div>
											<?php endif;?>
										<?php endforeach; ?>
									</div>
									<div class="divider margin-bottom-0 margin-top-10"><!-- divider --></div>
									<div class="heading-title text-right margin-top-0 link-viewmore-news">
										<a href="/tag/asia/"><h4 class="size-15">View more<span> News</span></h4></a>
									</div>
								<?php endif; ?>
							</div>

							<div class="col-md-4">
								<div class="heading-title heading-dotted">
									<h4>Stock <span>News</span></h4>
								</div>
								<?php
								// $stocks_news = get_posts([
								// 	'posts_per_page' => 5,
								// 	'category_name' => 'News',
								// 	'orderby' => 'date',
								// 	'order' => 'DESC',
								// 	'post_type' => 'post',
								// 	'post_status' => 'publish',
								// 	'suppress_filters' => true,
								// 	'meta_key'=>'_thumbnail_id',
								// 	'tag_slug__in' => ['stocks'],
								// 	'post__not_in' =>  $postnotin
								// ]);

								$stocks_news = json_decode(file_get_contents_curl(add_query_arg([
									'page' => 1,
									'categories' => 2,
									'per_page' => 5,
									'tags' => 5,
									'exclude' => $postnotin
								],'http://wordpress-16884-37649-153865.cloudwaysapps.com/wp-json/wp/v2/posts')));
								?>
								<?php if(count($stocks_news)): ?>
									<div class="" id="global-news-post-slider-stocks">
										<?php foreach($stocks_news as $k=>$post): $postnotin[] = $post->ID; ?>
											<div class="link-gray"<?php if($k==0):?> style="height: 106px;" <?php endif;?>>
												<?php if($k==0):?>
													<a href="<?=$post->link?>" class="height-100 pull-left width-100 margin-right-10">
														<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=($post->post_thumbnail->{'mid-image'}[0])?>');background-size: cover;background-repeat: no-repeat;background-position:center;" class="lazyOwl height-100" data-src="<?=($post->post_thumbnail->{'mid-image'}[0])?>"></figure>
													</a>
												<?php endif;?>
												<a class="<?php if($k==0):?> size-14 weight-600<?php else:?> size-12 <?php endif;?>" href="<?=$post->link?>"><?php if($k!=0):?> <span class="fa fa-fw fa-angle-right"></span> <?php endif;?><?=xyr_smarty_limit_chars($post->title->rendered,80)?></a>
													<?php if($k==0):?>
														<p style="height: 42px; margin-top:10px;margin-bottom: 3px!important;overflow: hidden;"><?=xyr_smarty_limit_chars(strip_tags(html_entity_decode($post->content->rendered)),200)?></p>
													<?php endif;?>
													<?php if($k==0):?>
														<ul class="text-left size-12 list-inline list-separator">
															<li class="block"><i class="fa fa-calendar"></i><?=date('D M j, Y',strtotime($post->date))?>&nbsp;<small class="pull-right"><?=human_time_diff( strtotime($post->date), current_time('timestamp') ) . " ago"?></small></small></li>
														</ul>
													<?php endif;?>
												</div>
												<?php if($k==0):?>
													<div class="clearfix"></div>
												<?php endif;?>
											<?php endforeach; ?>
										</div>
										<div class="divider margin-bottom-0 margin-top-10"><!-- divider --></div>
										<div class="heading-title text-right margin-top-0 link-viewmore-news">
											<a href="/tag/stocks/"><h4 class="size-15">View more<span> News</span></h4></a>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</section>
