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
			</div>
		<!-- /side navigation -->
		</div>
		<div class="col-md-9">
			<div class="tab-content">
				<div class="tab-pane fade in active" id="getting-started">
					<header class="margin-bottom-30">
						<h2 class="section-title"><?=the_title()?></h2>
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
								<div class="col-md-6 margin-bottom-30">
									<div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center">
										<div class="front">
											<div class="box1" style="padding: 0;">
												<a href="<?=get_the_permalink()?>">
													<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=the_post_thumbnail_url()?>');background-size: cover;background-repeat: no-repeat;height: 250px;"></figure>
												</a>
												<span class="section-content">
													<div class="text-left">
														<h4 class="title"><strong><?=the_title()?></strong></h4>
														<label><?=mb_strimwidth(strip_tags(html_entity_decode(get_the_content())), 0, 167, "&hellip;");?></label>
													</div>
												</span>
											</div>
										</div>
										<div class="back">
											<div class="box2">
												<a href="<?=get_the_permalink()?>"><h4><?=the_title()?></h4></a>
												<hr />
												<p>The world of investing is complex and multi-faceted, with a myriad of different choices and decisions you can make and a wealth of investment opportunities which will crop up. As an inexperienced novice investor, it can often seem perplexing, especially when trying to take that nerve-racking initial cold plunge. The problem is that it’s easy to get tripped up by bad advice and lies, silly speculation, lack of information...</p>
											</div>
										</div>
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
<?=get_template_part( 'partials/content', 'vipsubscribers' );?>