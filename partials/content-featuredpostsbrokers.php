<?php
global $brokerage,$featuredTitle,$post;
?>


<section id="all-press-releases" class="alternate">
	<div class="container">

		<div class="row tab-v3">
			<div class="col-sm-9">
				<header class="text-center margin-bottom-10 tiny-line">
					<h2 class="font-proxima uppercase">Brokerage Firms</h2>
				</header>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="planning">
						<div class="row">
							<?php
							if(have_posts()):
								while(have_posts()): the_post();
								?>
								<div class="col-sm-3 margin-bottom-20">
									<h4 class="margin-top-20 size-14 weight-700 uppercase height-20" style="overflow:hidden;"><a href="<?=get_the_permalink($post->ID)?>"><?=xyr_smarty_limit_chars(get_the_title($post->ID),80)?></a></h4>
									<p class="text-left" style="overflow:hidden;"><?=xyr_smarty_limit_chars(strip_tags(html_entity_decode(strip_shortcodes($post->post_excerpt))),100);?></p>
									<ul class="text-left size-12 list-inline list-separator">
										<li>
											<i class="fa fa-calendar"></i>
											<?=get_the_date('D M j, Y')?>
										</li>
									</ul>
								</div>
								<?php
							endwhile;
						endif;
						?>

					</div>
					<div class="row">
						<div class="pagination"><?=posts_pagination()?></div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3 text-left">
			<!-- CATEGORIES -->
			<div class="side-nav margin-bottom-60">

				<div class="side-nav-head">
					<button class="fa fa-bars"></button>
					<h4>CATEGORIES</h4>
				</div>
				<?php if(in_category(['news'])):?>
					<ul class="list-group list-group-bordered list-group-noicon uppercase">
						<?php
						$category_tags = get_category_tags(get_category_by_slug('news')->term_id);
						?>
						<?php foreach ($category_tags as $key => $tag):?>
							<li class="list-group-item">
								<a href="<?=($tag->link)?>" class="tag-<?=($tag->ID)?>" data-id="<?=($tag->ID)?>">
									<span class="size-11 text-muted pull-right">(<?=(int)($tag->count)?>)</span>
									<?=strtoupper($tag->name)?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php else: ?>
					<ul class="list-group list-group-bordered list-group-noicon uppercase">

						<li class="list-group-item active">
							<a class="dropdown-toggle" href="#">GLOBAL</a>
							<ul>
								<li><a href="#"><span class="size-11 text-muted pull-right">(123)</span> Shoes & Boots</a></li>
								<li class="active"><a href="#"><span class="size-11 text-muted pull-right">(331)</span> Top & Blouses</a></li>
								<li><a href="#"><span class="size-11 text-muted pull-right">(234)</span> Dresses & Skirts</a></li>
							</ul>
						</li>
						<li class="list-group-item">
							<a class="dropdown-toggle" href="#">SPORTS</a>
							<ul>
								<li><a href="#"><span class="size-11 text-muted pull-right">(88)</span> Accessories</a></li>
								<li><a href="#"><span class="size-11 text-muted pull-right">(67)</span> Shoes & Boots</a></li>
								<li><a href="#"><span class="size-11 text-muted pull-right">(32)</span> Dresses & Skirts</a></li>
								<li class="active"><a href="#"><span class="size-11 text-muted pull-right">(78)</span> Top & Blouses</a></li>
							</ul>
						</li>
						<li class="list-group-item">
							<a class="dropdown-toggle" href="#">DUMMIES GUIDE</a>
						</li>
						<li class="list-group-item">
							<a class="dropdown-toggle" href="#">BUSINESS</a>
							<ul>
								<li><a href="#"><span class="size-11 text-muted pull-right">(88)</span> Shoes & Boots</a></li>
								<li><a href="#"><span class="size-11 text-muted pull-right">(22)</span> Dresses & Skirts</a></li>
								<li><a href="#"><span class="size-11 text-muted pull-right">(31)</span> Accessories</a></li>
								<li class="active"><a href="#"><span class="size-11 text-muted pull-right">(18)</span> Top & Blouses</a></li>
							</ul>
						</li>
						<li class="list-group-item"><a href="#"><span class="size-11 text-muted pull-right">(189)</span> NEWS</a></li>
						<li class="list-group-item"><a href="#"><span class="size-11 text-muted pull-right">(61)</span> VIDEOS</a></li>

					</ul>
				<?php endif; ?>
			</div>
			<!-- /CATEGORIES -->

			<?php
			if(is_active_sidebar('sidebar-single'))
			dynamic_sidebar('sidebar-single');
			?>
		</div>

	</div>
	<!-- Tab v3 -->

</div>
</section>
