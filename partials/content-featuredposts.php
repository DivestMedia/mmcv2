<?php
global $featuredPost,$featuredTitle;
// $featuredPost = [
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
					<?php if(count($featuredPost['categories'])): ?>
						<ul class="list-group list-unstyled nav nav-tabs nav-stacked nav-alternate uppercase">
							<?php foreach ($featuredPost['categories'] as $featCat): ?>
								<li class="list-group-item <?=((!empty($featCat['active']) && $featCat['active']==true) ? 'active' : '')?>">
									<a href="<?=($featCat['link'] ?: '#')?>"><?=($featCat['name'] ?: 'Uncategorized')?></a>
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
						if(count($featuredPost['posts'])):
							foreach($featuredPost['posts'] as $post):

								$post = get_post($post);
								?>
								<div class="col-sm-4">
									<a href="<?=get_the_permalink()?>">
										<?=get_the_post_thumbnail($post->ID,'mid-image',[
											'class' => 'liner img-responsive g-mb-20'
											])?>
										</a>
										<h4 class="margin-top-20 size-14 weight-700 uppercase height-50" style="overflow:hidden;"><a href="<?=get_the_permalink($post->ID)?>"><?=xyr_smarty_limit_chars(get_the_title($post->ID),80)?></a></h4>
										<p class="text-justify height-100" style="overflow:hidden;"><?=xyr_smarty_limit_chars(strip_tags(html_entity_decode($post->post_content)),200);?></p>
										<ul class="text-left size-12 list-inline list-separator">
											<li>
												<i class="fa fa-calendar"></i>
												<?=get_the_date()?>
											</li>
											<li>
												<a href="<?=get_comments_link()?>">
													<i class="fa fa-comments"></i>
													<?=(comments_number( 'No Comments yet', 'One Comment', '% Comments' ))?>
												</a>
											</li>
										</ul>
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
