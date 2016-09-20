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


<section id="all-press-releases" class="alternate">
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
									<a href="<?=($featCat['link'] ?: '#')?>#all-press-releases"><?=($featCat['name'] ?: 'Uncategorized')?></a>
									<?php
									if(count($featCat['child'])): ?>
									<ul class="list-group list-unstyled nav nav-tabs nav-stacked nav-alternate uppercase">
										<?php foreach ($featCat['child'] as $featCatChild): ?>
											<li class="list-group-item <?=((!empty($featCatChild['active']) && $featCatChild['active']==true) ? 'active' : '')?>">
												<a href="<?=($featCatChild['link'] ?: '#')?>#all-press-releases"><?=($featCatChild['name'] ?: 'Uncategorized')?></a>
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
							?>
							<div class="col-sm-4 margin-bottom-20">
								<h4 class="margin-top-20 size-14 weight-700 uppercase height-20" style="overflow:hidden;"><a href="<?=get_the_permalink($post->ID)?>"><?=xyr_smarty_limit_chars(get_the_title($post->ID),80)?></a></h4>
								<p class="text-justify" style="overflow:hidden;"><?=xyr_smarty_limit_chars(strip_tags(html_entity_decode($post->post_content)),100);?></p>
								<ul class="text-left size-12 list-inline list-separator">
									<li>
										<i class="fa fa-calendar"></i>
										<?=get_the_date('D M j, Y')?>
									</li>
								</ul>
							</div>
							<?php
						endforeach;

					endif;
					$post = $mainpost;
					?>
					<div class="pagination"><?=posts_pagination()?></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Tab v3 -->

</div>
</section>
