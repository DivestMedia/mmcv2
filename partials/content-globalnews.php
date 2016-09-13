<?php
$postnotin = [];
?>

<section class="alternate" id="global_news">
	<div class="container">
		<div class="row">

			<header class="text-center margin-bottom-50 tiny-line">
				<h2 class="font-proxima uppercase">Global Business <span>News</span></h2>
			</header>
			<?php
			$category_tags = get_category_tags(get_category_by_slug('news')->term_id);
			$tags = [];
			foreach ($category_tags as $key => $cat) {
				if(in_array($cat->slug,[
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

					$tags[] = $cat->slug;
				}

				wp_reset_postdata();
				$global_news = get_posts([
					'posts_per_page' => 5,
					'category_name' => 'News',
					'orderby' => 'date',
					'order' => 'DESC',
					'post_type' => 'post',
					'post_status' => 'publish',
					'suppress_filters' => true,
					'tag_slug__in' => $tags,
				]);
				?>
				<div class="col-sm-3">
					<div class="side-nav margin-top-50">
						<div class="side-nav-head">
							<button class="fa fa-bars"></button>
							<h4>LATEST <span>NEWS HEADLINES</span></h4>
						</div>

						<?php
						$newsHeadlines =  get_posts([
							'posts_per_page'   => 10,
							'category_name'    => 'Headlines',
							'orderby'          => 'date',
							'order'            => 'DESC',
							'post_type'        => 'post',
							'post_status'      => 'publish',
							'paged' => get_query_var('paged') ?: 1,
							'suppress_filters' => true,
						]);
						?>

						<?php if($newsHeadlines): ?>
							<ul class="list-group list-unstyled nav nav-tabs nav-stacked nav-alternate uppercase">
								<?php foreach ($newsHeadlines as $nheadline): ?>
									<li class="list-group-item">
										<a href="<?=get_the_permalink($nheadline->ID)?>" data-toggle="tab"><?=xyr_smarty_limit_chars($nheadline->post_title,60)?></a>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-sm-9">
					<?php if(count($global_news)): ?>
						<div class="text-center news-category-labels margin-top-20 margin-bottom-30">
							<a href="http://marketmasterclass.btcglobaltrader.dev/news" class="news-category-link active"><span class="badge badge-green">Categories</span></a>
							<?php
							$category_tags = get_category_tags(get_category_by_slug('news')->term_id);
							foreach ($category_tags as $key => $cat) {

								if(in_array($cat->slug,[
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

									if($cat->slug=='banking-finance'){
										$cat->name = 'Banking';
									}

									$featuredPostCategories[] = [
										'id' => $cat->ID,
										'name' => $cat->name,
										'link' => $cat->link
									];

									echo '<a href="'.$cat->link.'" class="news-category-link"><span class="badge badge-green">'.$cat->name.'</span></a>';
								}

								?>
							</div>

							<div class="owl-carousel owl-padding-10 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"3", "autoPlay": 4000, "navigation": true, "pagination": false, "stopOnHover": true }' id="global-news-post-slider">
								<?php foreach($global_news as $post): $postnotin[] = $post->ID?>
									<div class="img-hover">
										<a href="<?=get_the_permalink()?>">
											<?php
											$posttags = get_the_tags();
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
												<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=the_post_thumbnail_url()?>');background-size: cover;background-repeat: no-repeat;height: 200px;" class="lazyOwl" data-src="<?=the_post_thumbnail_url()?>"></figure>
											</a>

											<h4 class="text-left margin-top-20 height-50 post-title"><a href="<?=get_the_permalink()?>"><?=xyr_smarty_limit_chars(get_the_title(),80)?></a></h4>
											<div class="text-left margin-bottom-10 height-100 post-excerpt"><?=xyr_smarty_limit_chars(strip_tags(html_entity_decode(get_the_excerpt())),200)?></div>
											<ul class="text-left size-12 list-inline list-separator">
												<li class="block">
													<i class="fa fa-calendar"></i>
													<?=get_the_date('D M j, Y')?>&nbsp;<small class="pull-right"><?=human_time_diff( get_the_time('U'), current_time('timestamp') ) . " ago"?></small>
												</li>
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
								$usa_news = get_posts([
									'posts_per_page' => 5,
									'category_name' => 'News',
									'orderby' => 'date',
									'order' => 'DESC',
									'post_type' => 'post',
									'post_status' => 'publish',
									'suppress_filters' => true,
									'meta_key'=>'_thumbnail_id',
									'tag_slug__in' => ['usa'],
									'post__not_in' =>  $postnotin
								]);
								?>
								<?php if(count($usa_news)): ?>
									<div class="" id="global-news-post-slider-usa">
										<?php foreach($usa_news as $k=>$post):  $postnotin[] = $post->ID; ?>
											<div class="link-gray"<?php if($k==0):?> style="height: 106px;" <?php endif;?>>
												<?php if($k==0):?>
													<a href="<?=get_the_permalink()?>" class="height-100 pull-left width-100 margin-right-10">
														<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=the_post_thumbnail_url()?>');background-size: cover;background-repeat: no-repeat;background-position:center;" class="lazyOwl height-100" data-src="<?=the_post_thumbnail_url()?>"></figure>
													</a>
												<?php endif;?>
												<a class="<?php if($k==0):?> size-14 weight-600<?php else:?> size-12 <?php endif;?>" href="<?=get_the_permalink()?>"><?php if($k!=0):?> <span class="fa fa-fw fa-angle-right"></span> <?php endif;?><?=xyr_smarty_limit_chars(get_the_title(),80)?></a>
													<?php if($k==0):?>
														<p style="height: 42px; margin-top:10px;margin-bottom: 3px!important;overflow: hidden;"><?=xyr_smarty_limit_chars(strip_tags(html_entity_decode(get_the_excerpt())),200)?></p>
													<?php endif;?>
													<?php if($k==0):?>
														<ul class="text-left size-12 list-inline list-separator">
															<li class="block"><i class="fa fa-calendar"></i><?=get_the_date('D M j, Y')?>&nbsp;<small class="pull-right"><?=human_time_diff( get_the_time('U'), current_time('timestamp') ) . " ago"?></small></li>
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
									$asia_news = get_posts([
										'posts_per_page' => 5,
										'category_name' => 'News',
										'orderby' => 'date',
										'order' => 'DESC',
										'post_type' => 'post',
										'post_status' => 'publish',
										'suppress_filters' => true,
										'meta_key'=>'_thumbnail_id',
										'tag_slug__in' => ['asia'],
										'post__not_in' =>  $postnotin
									]);
									?>
									<?php if(count($asia_news)): ?>
										<div class="" id="global-news-post-slider-asia">
											<?php foreach($asia_news as $k=>$post): $postnotin[] = $post->ID; ?>
												<div class="link-gray"<?php if($k==0):?> style="height: 106px;" <?php endif;?>>
													<?php if($k==0):?>
														<a href="<?=get_the_permalink()?>" class="height-100 pull-left width-100 margin-right-10">
															<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=the_post_thumbnail_url()?>');background-size: cover;background-repeat: no-repeat;background-position:center;" class="lazyOwl height-100" data-src="<?=the_post_thumbnail_url()?>"></figure>
														</a>
													<?php endif;?>
													<a class="<?php if($k==0):?> size-14 weight-600 <?php else:?> size-12 <?php endif;?>" href="<?=get_the_permalink()?>"><?php if($k!=0):?> <span class="fa fa-fw fa-angle-right"></span> <?php endif;?><?=xyr_smarty_limit_chars(get_the_title(),80)?></a>
														<?php if($k==0):?>
															<p style="height: 42px; margin-top:10px;margin-bottom: 3px!important;overflow: hidden;"><?=xyr_smarty_limit_chars(strip_tags(html_entity_decode(get_the_excerpt())),200)?></p>
														<?php endif;?>

														<?php if($k==0):?>
															<ul class="text-left size-12 list-inline list-separator">
																<li class="block"><i class="fa fa-calendar"></i><?=get_the_date('D M j, Y')?>&nbsp;<small class="pull-right"><?=human_time_diff( get_the_time('U'), current_time('timestamp') ) . " ago"?></small></li>
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
										$stocks_news = get_posts([
											'posts_per_page' => 5,
											'category_name' => 'News',
											'orderby' => 'date',
											'order' => 'DESC',
											'post_type' => 'post',
											'post_status' => 'publish',
											'suppress_filters' => true,
											'meta_key'=>'_thumbnail_id',
											'tag_slug__in' => ['stocks'],
											'post__not_in' =>  $postnotin
										]);
										?>
										<?php if(count($stocks_news)): ?>
											<div class="" id="global-news-post-slider-stocks">
												<?php foreach($stocks_news as $k=>$post): $postnotin[] = $post->ID; ?>
													<div class="link-gray" <?php if($k==0):?> style="height: 106px;" <?php endif;?>>
														<?php if($k==0):?>
															<a href="<?=get_the_permalink()?>" class="height-100 pull-left width-100 margin-right-10">
																<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=the_post_thumbnail_url()?>');background-size: cover;background-repeat: no-repeat;background-position:center;" class="lazyOwl height-100" data-src="<?=the_post_thumbnail_url()?>"></figure>
															</a>
														<?php endif;?>
														<a class="<?php if($k==0):?> size-14 weight-600<?php else:?> size-12 <?php endif;?>" href="<?=get_the_permalink()?>"><?php if($k!=0):?> <span class="fa fa-fw fa-angle-right"></span> <?php endif;?><?=xyr_smarty_limit_chars(get_the_title(),80)?></a>
															<?php if($k==0):?>
																<p style="height: 42px; margin-top:10px;margin-bottom: 3px!important;overflow: hidden;"><?=xyr_smarty_limit_chars(strip_tags(html_entity_decode(get_the_excerpt())),200)?></p>
															<?php endif;?>

															<?php if($k==0):?>
																<ul class="text-left size-12 list-inline list-separator">
																	<li class="block"><i class="fa fa-calendar"></i><?=get_the_date('D M j, Y')?>&nbsp;<small class="pull-right"><?=human_time_diff( get_the_time('U'), current_time('timestamp') ) . " ago"?></small></li>
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
