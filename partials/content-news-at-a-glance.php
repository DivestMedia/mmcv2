<?php
$postnotin = [];
$category_tags = [
];
?>

<section class="alternate" id="news-at-a-glance">
	<div class="container">
		<div class="row">

			<header class="text-center margin-bottom-50 tiny-line">
				<h2 class="font-proxima uppercase">News <span>at a Glance</span></h2>
			</header>
			<?php
			wp_reset_postdata();

			?>
			<div class="col-sm-12">
				<?php
				$global_news =  get_posts([
					'posts_per_page'   => 9,
					'category_name'    => 'news-at-a-glance',
					'orderby'          => 'date',
					'order'            => 'DESC',
					'paged' => 1,
					'post_type'        => 'post',
					'post_status'      => 'publish',
					'posts_per_page' => 10,
					'suppress_filters' => true,
					'fields' => 'ID'
				]);

				if(count($global_news)):

					$category = get_category_by_slug( 'news-at-a-glance' );
					$category_tags = [];
					$category_tags = get_categories([
						'type'                     => 'post',
						'child_of'                 => $category->term_id,
						'orderby'                  => 'name',
						'order'                    => 'ASC',
						'hide_empty'               => FALSE,
						'hierarchical'             => 1,
						'taxonomy'                 => 'category',
					]);
					$featuredPostCategories[] = [
						'id' => $category->term_id,
						'name' => 'All',
						'slug' => 'news-at-a-glance',
						'link' => '#all-news-at-a-glance',
						'active' => true
					];
					foreach ($category_tags as $key => $cat) {
						$featuredPostCategories[] = [
							'id' => $cat->term_id,
							'name' => $cat->name,
							'slug' => $cat->slug,
							'link' => '#all-'.$cat->slug,
							'active' => false
						];
					}

					?>
					<div class="text-center news-category-labels margin-top-20 margin-bottom-30">
						<?php foreach ($featuredPostCategories as $key => $featCat): ?>
							<a href="<?=($featCat['link'] ?: '#')?>" class="news-category-link <?=((!empty($featCat['active']) && $featCat['active']==true) ? 'active' : '')?>" data-toggle="tab"><span class="badge badge-green"><?=$featCat['name']?></span></a>
						<?php endforeach; ?>
					</div>


					<div class="tab-content">
						<?php foreach ($featuredPostCategories as $key => $featCat): ?>
						<div class="tab-pane fade <?=((!empty($featCat['active']) && $featCat['active']==true) ? 'in active' : '')?>" id="all-<?=$featCat['slug']?>">
							<?php
							$global_news =  get_posts([
								'posts_per_page'   => 9,
								'category_name'    => $featCat['slug'],
								'orderby'          => 'date',
								'order'            => 'DESC',
								'paged' => 1,
								'post_type'        => 'post',
								'post_status'      => 'publish',
								'posts_per_page' => 10,
								'suppress_filters' => true,
								'fields' => 'ID'
							]);
							?>
							<div class="owl-carousel owl-padding-10 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"4", "autoPlay": 4000, "navigation": true, "pagination": false, "stopOnHover": true }' id="global-news-post-slider">
								<?php foreach($global_news as $post):

									$post = get_post($post);
									setup_postdata($post);

									?>
									<div class="img-hover">
										<a href="<?=get_the_permalink($post->ID)?>">
											<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=the_post_thumbnail_url()?>');background-size: cover;background-repeat: no-repeat;height: 200px;" class="lazyOwl" data-src="<?=the_post_thumbnail_url()?>"></figure>
										</a>

										<h4 class="text-left margin-top-20 height-50 post-title"><a href="<?=get_the_permalink($post->ID)?>"><?=xyr_smarty_limit_chars(get_the_title($post->ID),80)?></a></h4>
										<div class="text-left margin-bottom-10 height-100 post-excerpt"><?=trim_text($post->post_content,200)?></div>
										<ul class="text-left size-12 list-inline list-separator">
											<li class="block">
												<i class="fa fa-calendar"></i>
												<?=get_the_date('D M j, Y')?>&nbsp;<small class="pull-right"><?=human_time_diff( strtotime(get_the_date('Y-m-d h:i a')), current_time('timestamp') ) . " ago"?></small>
											</li>
										</ul>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<?php endforeach; ?>
					</div>

					<?php
				else:
					var_dump($data);
				endif;
				?>
			</div>
		</div>
	</div>
</section>
