
<?=get_template_part( 'partials/content', 'indexwatch' );?>
<section>
	<div class="container cont-<?=basename(get_permalink())?>">
		<div class="col-sm-3 hidden-xs hidden-sm">
			<!-- side navigation -->
			<div class="side-nav margin-top-50">

				<div class="side-nav-head">
					<button class="fa fa-bars"></button>
					<h4></h4>
				</div>
				<!-- <strong class="uppercase">Telling Tales</strong> -->
				<ul class="list-group list-unstyled nav nav-tabs nav-stacked nav-alternate uppercase">
					<?php
					$_currentid = $post->ID;
					$args = array(
						'post_type'      => 'page',
						'posts_per_page' => -1,
						'post_parent'    => $post->post_parent,
						'order'          => 'DESC',
						'orderby'        => 'date'
					);


					$parent = new WP_Query( $args );

					if ( $parent->have_posts() ) : ?>

					<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>

						<li class="list-group-item <?=$_currentid==get_the_ID()?'active':''?> open">
							<a href="<?=get_home_url()?>/telling-tales/<?=$post->post_name?>">
								<?=the_title()?>
							</a>
							<?php
							$_children = get_children(array(
								'post_parent' => get_the_ID(),
								'post_type'   => 'page',
								'numberposts' => -1,
								'post_status' => 'publish',
								'order'          => 'DESC',
								'orderby'        => 'date'
							));

							if (!empty($_children)) :
								?>
								<ul class="list-group list-unstyled nav nav-tabs nav-stacked nav-alternate uppercase">
									<?php

									foreach ($_children as $_child){
										?>
										<li class="list-group-item">
											<a href="<?=(get_the_permalink($_child->ID) ?: '#')?>"><?=($_child->post_title ?: 'Uncategorized')?></a>
										</li>
										<?php }?>
									</ul>
									<?php
								endif;
								?>
							</li>
						<?php endwhile; ?>

					<?php endif; wp_reset_query(); ?>
				</ul>
				<?php
				render_side_bar_widget();
				?>
			</div>
			<!-- /side navigation -->
		</div>
		<div class="col-md-9">
			<div class="tab-content">
				<div class="tab-pane fade in active" id="getting-started">

					<header class="text-center margin-top-40 margin-bottom-50 tiny-line">
						<h2 class="font-proxima uppercase"><?=the_title()?></span></h2>
					</header>
					<?php
					if(!strcasecmp(basename(get_permalink()),'quotes-quotes-quotes')){
						global $wpdb;
						$_tablename = $wpdb->prefix.'quotescollection';
						$_quotes = $wpdb->get_results(' SELECT * FROM '.$_tablename);
						if(!empty($_quotes)){
							foreach ($_quotes as $key =>$q) {
								?>
								<blockquote class="quote ">
									<p><?=$q->quote?></p>
									<cite><?=$q->author?></cite>
								</blockquote>
								<?php
							}
						}
						?>

						<?php }?>
						<?php while ( have_posts() ) : the_post();?>
							<article id="post-<?php the_ID(); ?>">
								<div class="text-black size-14 entry-content post-<?=get_post_format();?>">
									<? the_content();?>
								</div>
							</article>
						<?php endwhile;?>
						<div class="row">
							<?php

							if(in_array($post->post_name,['worlds-greatest-inventors','the-world-of-weird-and-wacky-investments'])){
								$args = array(
									'post_type'      =>  'post',
									'posts_per_page' => -1,
									'order'          => 'ASC',
									'orderby'        => 'menu_order',
									'category_name' => $post->post_name
								);
							}else{
								$args = array(
									'post_type'      =>  'page',
									'posts_per_page' => -1,
									'post_parent'    => $post->ID,
									'order'          => 'ASC',
									'orderby'        => 'menu_order'
								);
							}


							$parent = new WP_Query( $args );
							if ( $parent->have_posts() ) : ?>
							<?php while ( $parent->have_posts() ) : $parent->the_post();
							$itemtitle = get_the_title();
							$itemcontent = xyr_smarty_limit_chars(strip_tags(html_entity_decode(get_the_content())), 500);
							$itemexcerpt = xyr_smarty_limit_chars($itemcontent, 150);
							?>
							<div class="col-md-6 margin-bottom-30">
								<div class="<?=( empty($itemexcerpt) ? '' : 'box-flip')?> box-icon box-icon-center box-icon-round box-icon-large text-center nomargin">
									<div class="front">
										<div class="box1" style="padding: 0;">
											<a href="<?=get_the_permalink()?>">
												<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=the_post_thumbnail_url()?>');background-size: cover;background-repeat: no-repeat;height: 250px;"></figure>
											</a>
											<span class="section-content">
												<div class="text-left">
													<h4 class="title"><a href="<?=get_the_permalink()?>" class="text-white"><strong><?=$itemtitle?></strong></a></h4>
													<?php if(!empty($itemexcerpt)): ?>
														<label><?=$itemexcerpt?></label>
													<?php endif; ?>
												</div>
											</span>
										</div>
									</div>
									<?php if(!empty($itemexcerpt)): ?>
										<div class="back">
											<div class="box2">
												<a href="<?=get_the_permalink()?>"><h4><?=$itemtitle?></h4></a>
												<hr />
												<p><?=$itemcontent?></p>
												<a href="<?=get_the_permalink()?>" class="btn btn-black">Read More</a>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endwhile; ?>
					<?php endif; wp_reset_query(); ?>
				</div>
			</div>
			<?php
			$parent = new WP_Query( $args );

			if ( $parent->have_posts() ) : ?>

			<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
				<div class="tab-pane fade in" id="<?=$post->post_name?>">
					<header class="margin-bottom-30">
						<h2 class="section-title"><?=the_title()?></h2>
					</header>
					<article id="post-<?php the_ID(); ?>">
						<div class="text-black size-14 entry-content post-<?=get_post_format();?>">
							<? the_content();?>
						</div>
					</article>
				</div>
			<?php endwhile; ?>

		<?php endif; wp_reset_query(); ?>

	</div>

</div>

</div>
</section>
