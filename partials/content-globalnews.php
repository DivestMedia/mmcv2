<section class="alternate" id="global_news">
	<div class="container">
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
				'posts_per_page' => 10,
				'category_name' => 'News',
				'orderby' => 'date',
				'order' => 'DESC',
				'post_type' => 'post',
				'post_status' => 'publish',
				'suppress_filters' => true,
				'tag_slug__in' => $tags,
			]);
			?>
			<!--
			controlls-over		= navigation buttons over the image
			buttons-autohide 	= navigation buttons visible on mouse hover only

			data-plugin-options:
			"singleItem": true
			"autoPlay": true (or ms. eg: 4000)
			"navigation": true
			"pagination": true
			"items": "4"

			owl-carousel item paddings
			.owl-padding-0
			.owl-padding-3
			.owl-padding-6
			.owl-padding-10
			.owl-padding-15
			.owl-padding-20
		-->

		<div class="col-sm-3">
			<div class="side-nav margin-top-20">
				<div class="side-nav-head">
					<button class="fa fa-bars"></button>
					<h4>NEWS HEADLINES</h4>
				</div>

				<?php
				$newsHeadlines =  get_posts([
					'posts_per_page'   => 15,
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
				<div class="heading-title heading-dotted text-right margin-top-20 link-viewmore-news">
					<a href="/category/news/"><h4>View more<span> News</span></h4></a>
				</div>
				<div class="owl-carousel owl-padding-10 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"3", "autoPlay": 4000, "navigation": true, "pagination": false }' id="global-news-post-slider">
					<?php foreach($global_news as $post): ?>
						<div class="img-hover">
							<a href="<?=get_the_permalink()?>">
								<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=the_post_thumbnail_url()?>');background-size: cover;background-repeat: no-repeat;height: 200px;" class="lazyOwl" data-src="<?=the_post_thumbnail_url()?>"></figure>
							</a>

							<h4 class="text-left margin-top-20 height-50 post-title"><a href="<?=get_the_permalink()?>"><?=xyr_smarty_limit_chars(get_the_title(),80)?></a></h4>
							<div class="text-left margin-bottom-10 height-100 post-excerpt"><?=xyr_smarty_limit_chars(strip_tags(html_entity_decode(get_the_excerpt())),200)?></div>
							<ul class="text-left size-12 list-inline list-separator">
								<li>
									<i class="fa fa-calendar"></i>
									<?=get_the_date('M j')?>&nbsp;<small><?=get_the_date('g:i a')?></small>
								</li>

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
										<li>
											<a href="<?=$ftag->link?>"><i class="fa fa-fw fa-tag"></i><?=$posttags[$ftag]->name?></a>
										</li>
										<?php
									}else{
										?>
										<li>
											<a href="/category/news"><i class="fa fa-fw fa-tag"></i>News</a>
										</li>
										<?php
									}

									?>
								</ul>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div class="text-right news-category-labels margin-top-50 margin-bottom-50">
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
				</div>
			</div>
		</section>
