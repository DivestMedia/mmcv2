<?php
global $brokerage,$featuredTitle,$post;
?>

<section id="all-press-releases" class="alternate">
	<div class="container">
		<div class="row tab-v3">
			<div class="col-sm-3">
				<!-- side navigation -->
				<div class="side-nav margin-top-50">
					<div class="side-nav-head">
						<button class="fa fa-bars"></button>
						<h4></h4>
					</div>

					<ul class="list-group list-unstyled nav nav-tabs nav-stacked nav-alternate uppercase">
						<li class="list-group-item"><a href="/find-a-broker" >Find a Broker</a></li>
						<li class="list-group-item"><a href="/find-a-broker/#what-to-look-for-in-a-broker" >What to look for in a broker</a></li>
						<li class="list-group-item active"><a href="/category/brokerage-firms" >List of Brokerage Firms</a></li>
						<li class="list-group-item"><a href="/find-a-broker/brokerage-showcase" >Brokerage Showcase</a></li>
					</ul>
				</div>
				<!-- /side navigation -->
			</div>

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
									<figure>
										<?php the_post_thumbnail('mid-image',[
											'class' => 'img-responsive'
										]); ?>
									</figure>
									<h4 class="margin-top-20 size-14 weight-700 uppercase height-20" style="overflow:hidden;"><a href="<?=get_the_permalink($post->ID)?>"><?=xyr_smarty_limit_chars(get_the_title($post->ID),80)?></a></h4>
									<p class="text-left height-100" style="overflow:hidden;"><?=xyr_smarty_limit_chars(strip_tags(html_entity_decode(strip_shortcodes($post->post_excerpt))),100);?></p>
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

	</div>
	<!-- Tab v3 -->

</div>
</section>
