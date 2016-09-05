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
				<!-- <strong class="uppercase">Telling Tales</strong> -->
				<ul class="list-group list-unstyled nav nav-tabs nav-stacked nav-alternate uppercase">
					<?php
					$_currentid = $post->ID;

					$args = array(
					    'post_type'      => 'page',
					    'posts_per_page' => -1,
					    'post_parent'    => wp_get_post_parent_id($post->post_parent),
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
											<li class="list-group-item <?=$_currentid==$_child->ID?'active':''?>">
												<a href="<?=($_child->guid ?: '#')?>"><?=($_child->post_title ?: 'Uncategorized')?></a>
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
					<?php while ( have_posts() ) : the_post();?>
						<article id="post-<?php the_ID(); ?>">
							<div class="text-black size-14 entry-content post-<?=get_post_format();?>">
								<? the_content();?>
							</div>
						</article>
					<?php endwhile;?>
					<div class="investment-assets">
						<?php

						$_categoryname = basename(get_permalink());
						if(!strcasecmp(get_the_title($post->post_parent),'Entrepreneurial Exploits')&&(!strcasecmp(basename(get_permalink()),'success-stories')||!strcasecmp(basename(get_permalink()),'tragic-tales'))){
							$_categoryname = basename(get_permalink()).'-2';
						}

						$args = array(
						    'post_type'      => 'post',
						    'posts_per_page' => -1,
						    'category_name'    => $_categoryname,
						    'order'          => 'ASC',
						    'orderby'        => 'menu_order'
						 );


						$parent = new WP_Query( $args );

						if ( $parent->have_posts() ) : ?>
							<div class="row margin-bottom-30">
						    <?php
						    	$ctr = 0;
						    	while ( $parent->have_posts() ) : $parent->the_post();

						    	?>

										<div class="col-md-6">
											<div class="box-flip box-icon box-icon-round box-icon-large">
												<div class="front">
													<div class="box1" style="padding: 0;">
														<figure style="background-image: url('<?=the_post_thumbnail_url()?>');background-size: cover;background-repeat: no-repeat;height: 250px;">
														</figure>
														<div class="section-content">
															<div class="text-left">
																<h4 class="title"><strong><?=the_title()?></strong></h4>
																<label><?=mb_strimwidth(strip_tags(html_entity_decode(get_the_content())), 0, 167, "&hellip;");?></label>
															</div>
														</div>
													</div>
												</div>
												<div class="back">
													<div class="box2">
														<a href="<?=get_the_permalink()?>"><h4><?=the_title()?></h4></a>
														<hr />
														<p><?=mb_strimwidth(strip_tags(html_entity_decode(get_the_content())), 0, 500, "&hellip;");?></p>
														<a href="<?=get_the_permalink()?>" class="link-read-more">Read more</a>
													</div>
												</div>
											</div>
										</div>
						    <?php
						    if($ctr++==1){
						    		echo '</div>
							<div class="row margin-bottom-30">';
									$ctr = 0;
						    	}
						    endwhile; ?>
						    </div>
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
