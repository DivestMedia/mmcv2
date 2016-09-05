<?php
get_template_part( 'partials/content', 'indexwatch' );
?>
<section>
	<div class="container">
		<a href="#" class="text-gray bold size-10 uppercase letter-spacing-10"><?=!empty(get_the_category($post->ID)[0]->name)?get_the_category($post->ID)[0]->name:''?></a>
		<header class="text-left margin-bottom-50 tiny-line">
			<h2 class="font-proxima"><a href="<?=get_the_permalink()?>"><?=the_title()?></a></h2>
			<!-- <a href="#" class="size-12 text-black uppercase bold">BY: John Doe</a>  &nbsp; -->
			<a href="#" class="size-12 text-gray"><?=get_the_date()?></a>
			<br/>
		</header>

		<div class="row">
			<div class="col-md-6 col-sm-9 text-justify">
				<figure>
					<?php the_post_thumbnail('mid-image',[
						'class' => 'img-responsive margin-bottom-30'
					])?>
				</figure>
				<div class="post-content">
					<?=$post->post_content?>
				</div>

			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 text-left">
				<!-- CATEGORIES -->
				<div class="side-nav margin-bottom-60">

					<div class="side-nav-head">
						<button class="fa fa-bars"></button>
						<h4>CATEGORIES</h4>
					</div>
					<?php 
					$_category = get_categories( array( 'child_of' => get_the_category()[0]->category_parent ));
					if(in_category(['news'])):?>
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
					<?php elseif(!empty($_category)): ?>
						<ul class="list-group list-group-bordered list-group-noicon uppercase">
						<?php
							foreach ($_category as $key => $_cat) {
						?>
								<li class="list-group-item">
									<a href="<?=(get_category_link($_cat->cat_ID))?>" class="tag-<?=($_cat->ID)?>" data-id="<?=($_cat->ID)?>">
										<span class="size-11 text-muted pull-right">(<?=(int)($_cat->count)?>)</span>
										<?=strtoupper($_cat->name)?>
									</a>
								</li>
						<?php
							}
						?>
						</ul>
					<?php else: ?>
						<div>No categories available</div>
					<?php endif; ?>
				</div>
				<!-- /CATEGORIES -->

				<?php
					if(is_active_sidebar('sidebar-single'))
						dynamic_sidebar('sidebar-single');
				?>
			</div>
		</div>
	</div>
</section>
