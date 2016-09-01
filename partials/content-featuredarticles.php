
<section class="alternate">
		<div class="container">
			<header class="text-center margin-bottom-10 tiny-line">
				<h2 class="font-proxima uppercase">Featured Articles</h2>
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

							<ul class="list-group list-unstyled nav nav-tabs nav-stacked nav-alternate uppercase">
								<li class="list-group-item active">
									<a href="#planning" data-toggle="tab">
										All Articles
									</a>
								</li>
								<li class="list-group-item">
									<a href="#documentation" data-toggle="tab">
										Rogue Trader
									</a>
								</li>
								<li class="list-group-item">
									<a href="#materials" data-toggle="tab">
										Our Offshore Experts
									</a>
								</li>
								<li class="list-group-item">
									<a href="#exterior-d" data-toggle="tab">
										Starting Out
									</a>
								</li>
							</ul>
				
				
						</div>
					<!-- /side navigation -->
					</div>
					<div class="col-sm-9">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="planning">
								<div class="row">
									<?php
										$args = array(

										);
										$catIDs = get_cat_ID( 'Rogue Trader' );
										$catIDs .= ',' . get_cat_ID( 'Our Offshore Experts' );
										$catIDs .= ',' . get_cat_ID( 'Starting Out' );
										$starting_out = get_posts([
											'posts_per_page'   => 3,
											'category'    => $catIDs ,
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
											<?=get_the_post_thumbnail($post->ID,'mid-image',[
												'class' => 'liner img-responsive g-mb-20'
												])?>
											</a>
											<h4 class="margin-top-20 size-14 weight-700 uppercase"><a href="<?=get_the_permalink()?>"><?=the_title()?></a></h4>
											<p class="text-justify"><?=mb_strimwidth(strip_tags(html_entity_decode(get_the_excerpt())), 0, 150, "&hellip;");?></p>
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
									?>
								</div>
							</div>
							<div class="tab-pane fade in" id="documentation">
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
											<?=get_the_post_thumbnail($post->ID,'mid-image',[
												'class' => 'liner img-responsive g-mb-20'
												])?>
											</a>
											<h4 class="margin-top-20 size-14 weight-700 uppercase"><a href="<?=get_the_permalink()?>"><?=the_title()?></a></h4>
											<p class="text-justify"><?=mb_strimwidth(strip_tags(html_entity_decode(get_the_excerpt())), 0, 150, '...');?></p>
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
									?>
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
											<?=get_the_post_thumbnail($post->ID,'mid-image',[
												'class' => 'liner img-responsive g-mb-20'
												])?>
											</a>
											<h4 class="margin-top-20 size-14 weight-700 uppercase"><a href="<?=get_the_permalink()?>"><?=the_title()?></a></h4>
											<p class="text-justify"><?=mb_strimwidth(strip_tags(html_entity_decode(get_the_excerpt())), 0, 150, '...');?></p>
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
									?>
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
											<?=get_the_post_thumbnail($post->ID,'mid-image',[
												'class' => 'liner img-responsive g-mb-20'
												])?>
											</a>
											<h4 class="margin-top-20 size-14 weight-700 uppercase"><a href="<?=get_the_permalink()?>"><?=the_title()?></a></h4>
											<p class="text-justify"><?=mb_strimwidth(strip_tags(html_entity_decode(get_the_excerpt())), 0, 150, '...');?></p>
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
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Tab v3 -->

		</div>
	</section>