
<section class="">
		<div class="container">
			<header class="text-center margin-bottom-50 tiny-line">
				<h2 class="font-proxima uppercase">Featured <span>Articles</span></h2>
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

							<ul class="list-group list-unstyled nav nav-tabs nav-stacked nav-alternate uppercase">
								<li class="list-group-item active">
									<a href="#documentation" data-toggle="tab">
										Rogue Trader
									</a>
								</li>
								<li class="list-group-item">
									<a href="#exterior-d" data-toggle="tab">
										Starting Out
									</a>
								</li>
								<li class="list-group-item">
									<a href="#materials" data-toggle="tab">
										Our Offshore Experts
									</a>
								</li>
							</ul>
						</div>
						<blockquote class="quote">
					        <?php echo do_shortcode('[quotcoll limit="1" orderby="random"]')?>
					    </blockquote>
					<!-- /side navigation -->
					</div>
					<div class="col-sm-9">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="documentation">
								<div class="row">
									<?php
										$args = array(

										);
										$starting_out = get_posts([
											'posts_per_page'   => 3,
											'category_name'    => 'rogue-trader',
											'orderby'          => 'date',
											'order'            => 'DESC',
											'post_type'        => 'post',
											'post_status'      => 'publish',
											'suppress_filters' => true
										]);
										if(count($starting_out)):
											foreach($starting_out as $post):
									?>
										<div class="col-sm-4">
											<a href="<?=get_the_permalink()?>">
												<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=the_post_thumbnail_url("mid-image")?>');background-size: cover;background-repeat: no-repeat;height: 180px;"></figure>
											</a>
											<h4 class="margin-top-20 size-14 weight-700 uppercase p-limit-title"><a href="<?=get_the_permalink()?>"><?=the_title()?></a></h4>
											<p class="text-justify p-limit-content"><?=strip_tags(html_entity_decode(get_the_excerpt()));?></p>
											<ul class="text-left size-12 list-inline list-separator">
												<li>
													<i class="fa fa-calendar"></i>
													<?=get_the_date()?>
												</li>
												<?php if(get_comments_number()){?>
												<li>
													<a href="<?=get_comments_link()?>">
														<i class="fa fa-comments"></i>
														<?=(comments_number( 'No Comments yet', 'One Comment', '% Comments' ))?>
													</a>
												</li>
												<?php }?>
											</ul>
										</div>
									<?php
											endforeach;
										endif;
									?>
								</div>
								<div class="heading-title heading-dotted text-right margin-top-20 link-viewmore-article">
									<a href="/category/articles"><h4>View more<span> Articles</span></h4></a>
								</div>
							</div>
							<div class="tab-pane fade in" id="materials">
								<div class="row">
									<?php
										$args = array(

										);
										$starting_out = get_posts([
											'posts_per_page'   => 3,
											'category_name'    => 'our-offshore-experts',
											'orderby'          => 'date',
											'order'            => 'DESC',
											'post_type'        => 'post',
											'post_status'      => 'publish',
											'suppress_filters' => true
										]);
										if(count($starting_out)):
											foreach($starting_out as $post):
									?>
										<div class="col-sm-4">
											<a href="<?=get_the_permalink()?>">
											<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=the_post_thumbnail_url("mid-image")?>');background-size: cover;background-repeat: no-repeat;height: 180px;"></figure>
											</a>
											<h4 class="margin-top-20 size-14 weight-700 uppercase p-limit-title"><a href="<?=get_the_permalink()?>"><?=the_title()?></a></h4>
											<p class="text-justify p-limit-content"><?=strip_tags(html_entity_decode(get_the_excerpt()))?></p>
											<ul class="text-left size-12 list-inline list-separator">
												<li>
													<i class="fa fa-calendar"></i>
													<?=get_the_date()?>
												</li>
												<?php if(get_comments_number()){?>
												<li>
													<a href="<?=get_comments_link()?>">
														<i class="fa fa-comments"></i>
														<?=(comments_number( 'No Comments yet', 'One Comment', '% Comments' ))?>
													</a>
												</li>
												<?php }?>
											</ul>
										</div>
									<?php
											endforeach;
										endif;
									?>
								</div>
								<div class="heading-title heading-dotted text-right margin-top-20 link-viewmore-article">
									<a href="/category/articles"><h4>View more<span> Articles</span></h4></a>
								</div>
							</div>
							<div class="tab-pane fade in" id="exterior-d">
								<div class="row">
									<?php
									$args = array(

									);
									$starting_out = get_posts([
										'posts_per_page'   => 3,
										'category_name'    => 'starting-out',
										'orderby'          => 'date',
										'order'            => 'DESC',
										'post_type'        => 'post',
										'post_status'      => 'publish',
										'suppress_filters' => true
									]);
										if(count($starting_out)):
											foreach($starting_out as $post):
									?>
										<div class="col-sm-4">
											<a href="<?=get_the_permalink()?>">
												<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=the_post_thumbnail_url("mid-image")?>');background-size: cover;background-repeat: no-repeat;height: 180px;"></figure>
											</a>
											<h4 class="margin-top-20 size-14 weight-700 uppercase p-limit-title"><a href="<?=get_the_permalink()?>"><?=the_title()?></a></h4>
											<p class="text-justify p-limit-content"><?=strip_tags(html_entity_decode(get_the_excerpt()))?></p>
											<ul class="text-left size-12 list-inline list-separator">
												<li>
													<i class="fa fa-calendar"></i>
													<?=get_the_date()?>
												</li>
												<?php if(get_comments_number()){?>
												<li>
													<a href="<?=get_comments_link()?>">
														<i class="fa fa-comments"></i>
														<?=(comments_number( 'No Comments yet', 'One Comment', '% Comments' ))?>
													</a>
												</li>
												<?php }?>
											</ul>
										</div>
									<?php
											endforeach;
										endif;
									?>
								</div>
								<div class="heading-title heading-dotted text-right margin-top-20 link-viewmore-article">
									<a href="/category/articles"><h4>View more<span> Articles</span></h4></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Tab v3 -->

		</div>
	</section>
