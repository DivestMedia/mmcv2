<?=get_template_part( 'partials/content', 'indexwatch' );?>
<section>
	<div class="container cont-<?=basename(get_permalink())?>">
		<div class="col-sm-3">
			<!-- side navigation -->
			<div class="side-nav margin-top-50">

				<div class="side-nav-head">
					<button class="fa fa-bars"></button>
					<h4></h4>
				</div>

				<ul class="list-group list-unstyled nav nav-tabs nav-stacked nav-alternate uppercase">
					<li class="list-group-item active">
						<a href="#getting-started" data-toggle="tab">
							Getting Started
						</a>
					</li>
					<?php
					$args = array(
						'post_type'      => 'page',
						'posts_per_page' => -1,
						'post_parent'    => $post->ID,
						'order'          => 'ASC',
						'orderby'        => 'menu_order'
					);


					$parent = new WP_Query( $args );

					if ( $parent->have_posts() ) : ?>

					<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>

						<li class="list-group-item">
							<a href="<?=get_home_url()?>/dummies-guide/<?=$post->post_name?>">
								<?=the_title()?>
							</a>
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
				<header class="text-center margin-bottom-50 tiny-line">
					<h2 class="font-proxima uppercase"><?=the_title()?></h2>
				</header>
				<?php while ( have_posts() ) : the_post();?>
					<article id="post-<?php the_ID(); ?>">
						<div class="text-black size-14 entry-content post-<?=get_post_format();?>">
							<? the_content();?>
						</div>
					</article>
				<?php endwhile;?>

				<div class="row">
					<?php
					$args = array(
						'post_type'      => 'page',
						'posts_per_page' => -1,
						'post_parent'    => $post->ID,
						'order'          => 'ASC',
						'orderby'        => 'menu_order'
					);
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
