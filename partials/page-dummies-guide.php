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




						<div class="col-md-6">
							<div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center">
								<div class="front">
									<div class="box1" style="padding: 0;">
										<figure>
											<img class="img-responsive" src="http://mmc.divestmedialocal.com/wp-content/uploads/sites/2/2016/09/Investmentplanning.jpg" alt="">
										</figure>
										<span class="section-content">
											<div class="text-left">
												<h4 class="title"><strong>Essential Guidelines Before You Start</strong></h4>
												<label>The world of investing is complex and multi-faceted, with a myriad of different choices and decisions you can make and a wealth of investment opportunities which will crop up.</label>
											</div>
										</span>
									</div>
								</div>
								<div class="back">
									<div class="box2">
										<h4>Essential Guidelines Before You Start</h4>
										<hr />
										<p>The world of investing is complex and multi-faceted, with a myriad of different choices and decisions you can make and a wealth of investment opportunities which will crop up. As an inexperienced novice investor, it can often seem perplexing, especially when trying to take that nerve-racking initial cold plunge. The problem is that it’s easy to get tripped up by bad advice and lies, silly speculation, lack of information...</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center">
								<div class="front">
									<div class="box1" style="padding: 0;">
										<figure>
											<img class="img-responsive" src="http://mmc.divestmedialocal.com/wp-content/uploads/sites/2/2016/09/poundcoins1867-1-1024x576.png" alt="">
										</figure>
										<span class="section-content">
											<div class="text-left">
												<h4 class="title"><strong>Investment Assets</strong></h4>
												<label>An asset is quite simply what you invest in, the actual individual item which you buy in the hope that it will generate income or appreciate in worth over time and can thus be...</label>
											</div>
										</span>
									</div>
								</div>

								<div class="back">
									<div class="box2">
										<h4>Investment Assets</h4>
										<hr />
										<p>An asset is quite simply what you invest in, the actual individual item which you buy in the hope that it will generate income or appreciate in worth over time and can thus be sold for a profit in the future. Wealth management is about building an investment portfolio which is made up of assets. There are three main asset classes, and several others which fall under the category of alternative assets.</p>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="row margin-top-30">
						<div class="col-md-6">
							<div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center">
								<div class="front">
									<div class="box1" style="padding: 0;">
										<figure>
											<img class="img-responsive" src="http://mmc.divestmedialocal.com/wp-content/uploads/sites/2/2016/09/Investment-Vehicles-1-1024x576.png" alt="">
										</figure>
										<span class="section-content">
											<div class="text-left">
												<h4 class="title"><strong>Investment Vehicles</strong></h4>
												<label>Once you work out what asset class you want to invest in, whether you want to invest in stocks or bonds or one of the alternatives, you must then decide how to invest, what...</label>
											</div>
										</span>
									</div>
								</div>
								<div class="back">
									<div class="box2">
										<h4>Investment Vehicles</h4>
										<hr />
										<p>Once you work out what asset class you want to invest in, whether you want to invest in stocks or bonds or one of the alternatives, you must then decide how to invest, what investment vehicle to use in order to put your money into whatever security you decide on. An investment vehicle is simply a means by which to invest in a particular asset.</p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center">
								<div class="front">
									<div class="box1" style="padding: 0;">
										<figure>
											<img class="img-responsive" src="http://mmc.divestmedialocal.com/wp-content/uploads/sites/2/2016/09/istock_000003205786medium-e1462851177681-1024x576.png" alt="">
										</figure>
										<span class="section-content">
											<div class="text-left">
												<h4 class="title"><strong>Investment Style</strong></h4>
												<label>Everyone is different in life and this also applies to investors. Everyone will have their own style when building an investment portfolio and it’s important to work o...</label>
											</div>
										</span>
									</div>
								</div>

								<div class="back">
									<div class="box2">
										<h4>Investment Style</h4>
										<hr />
										<p>Everyone is different in life and this also applies to investors. Everyone will have their own style when building an investment portfolio and it’s important to work out what your own style is since this will have a great influence on what investments you make. What is your overall investment strategy or theory in your asset allocation? Knowing who you are as an investor will help you cla...</p>
									</div>
								</div>
							</div>

						</div>

					</div>
					<div class="row margin-top-30">
						<div class="col-md-6">
							<div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center">
								<div class="front">
									<div class="box1" style="padding: 0;">
										<figure>
											<img class="img-responsive" src="http://mmc.divestmedialocal.com/wp-content/uploads/sites/2/2016/09/g7-1260x710-e1462851420772-1024x577.png" alt="">
										</figure>
										<span class="section-content">
											<div class="text-left">
												<h4 class="title"><strong>Investment Strategies</strong></h4>
												<label>You know what you want to invest in, you know what investment vehicle you want to use, and you know your own individual investment style; now what? Well, you now have to dec...</label>
											</div>
										</span>
									</div>
								</div>
								<div class="back">
									<div class="box2">
										<h4>Investment Strategies</h4>
										<hr />
										<p>You know what you want to invest in, you know what investment vehicle you want to use, and you know your own individual investment style; now what? Well, you now have to decide what investment strategy to use to build your investment portfolio. An investment strategy is the tactics you use when investing, basically, your plan of attack...</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center">
								<div class="front">
									<div class="box1" style="padding: 0;">
										<figure>
											<img class="img-responsive" src="http://mmc.divestmedialocal.com/wp-content/uploads/sites/2/2016/09/151228-online-fraud-hacking-415p_1f4a69829f4841f440828b3b86d4a071.nbcnews-fp-1200-800-e1462851979388-1024x578.png" alt="">
										</figure>
										<span class="section-content">
											<div class="text-left">
												<h4 class="title"><strong>Online Fraud</strong></h4>
												<label>Let’s face it, none of us are too big or too clever to get caught out by online fraud, especially when dealing with today’s more sophisticated fraudsters, who have, over time...</label>
											</div>
										</span>
									</div>
								</div>

								<div class="back">
									<div class="box2">
										<h4>Online Fraud</h4>
										<hr />
										<p>Let’s face it, none of us are too big or too clever to get caught out by online fraud, especially when dealing with today’s more sophisticated fraudsters, who have, over time, refined their techniques and honed them to perfection, and who use the internet to reach a mass audience with minimum effort. While the web is a fantastic tool for investors to conduct research into buying stocks and obtain...</p>
									</div>
								</div>
							</div>

						</div>

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