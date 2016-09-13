<?php
get_template_part( 'partials/content', 'indexwatch' );
$is_brokeragefirms = false;
if(!strcasecmp(get_the_category($post->ID)[0]->name,'Brokerage Firms')){
	$is_brokeragefirms = true;
}
$_parentcat = get_the_category()[0]->category_parent;
?>
<section>
	<div class="container">
		<a href="#" class="text-gray bold size-10 uppercase letter-spacing-10"><?=!empty(get_the_category($post->ID)[0]->name)?get_the_category($post->ID)[0]->name:''?></a>
		<header class="text-left margin-bottom-50 tiny-line">
			<h2 class="font-proxima"><a href="<?=get_the_permalink()?>"><?=the_title()?></a></h2>
			<!-- <a href="#" class="size-12 text-black uppercase bold">BY: John Doe</a>  &nbsp; -->
			<?php if($is_brokeragefirms===false){?><a href="#" class="size-12 text-gray"><?=get_the_date()?></a><?php }?>
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
					<?php
					if(!strcasecmp(get_cat_name($_parentcat),'Articles')){
						$prev_articles_url = get_category_link(get_the_category()[0]);
						?>
						<div class="cont-previous-article pull-right">
							<a href="<?=$prev_articles_url?>">View previous articles</a>
						</div>

						<div class="clearfix"></div>
						<?php
					}
					if($is_brokeragefirms){
						$_phone = get_post_meta($post->ID,'bf_phone')[0];
						$_address = get_post_meta($post->ID,'bf_address')[0];
						$_website = get_post_meta($post->ID,'bf_website')[0];
						$_facebook = get_post_meta($post->ID,'bf_facebook')[0];
						$_twitter = get_post_meta($post->ID,'bf_twitter')[0];
						$_linkedin = get_post_meta($post->ID,'bf_linkedin')[0];
						?>
						<div class="brokerage-cont-other-details row margin-top-10">
							<?=!empty($_phone)?'<div class="col-md-12"><i class="fa fa-fw fa-phone-square"></i>'.$_phone.'</div>':''?>
							<?=!empty($_address)?'<div class="col-md-12"><i class="fa fa-fw fa-globe"></i>'.$_address.'</div>':''?>
							<?=!empty($_website)?'<div class="col-md-6"><i class="fa fa-fw fa-link"></i><a href="'.$_website.'">'.$_website.'</a></div>':''?>
							<?=!empty($_linkedin)?'<div class="col-md-6"><i class="fa fa-fw fa-linkedin-square"></i><a href="'.$_linkedin.'">'.$_linkedin.'</a></div>':''?>
							<?=!empty($_facebook)?'<div class="col-md-6"><i class="fa fa-fw fa-facebook-square"></i><a href="'.$_facebook.'">'.$_facebook.'</a></div>':''?>
							<?=!empty($_twitter)?'<div class="col-md-6"><i class="fa fa-fw fa-twitter-square"></i><a href="'.$_twitter.'">'.$_twitter.'</a></div>':''?>
						</div>
						<?php
					}
					?>

					<?php if(in_category(['news'])):?>
						<?php if($origpostlink = get_post_meta($post->ID,'dm_rss_feed_item_link',true)): ?>
							<div class="divider divider-dotted"><!-- divider --></div>
							<p class="text-left">
								Read original article on <a href="<?=$origpostlink?>" target="_blank"><?=(get_post_meta($post->ID,'site-name',true) ?: $origpostlink)?></a>
							</p>
						<?php elseif($origpostlink = get_post_meta($post->ID,'wprss_item_permalink',true)): ?>
							<div class="divider divider-dotted"><!-- divider --></div>
							<p class="text-left">
								Read original article on <a href="<?=$origpostlink?>" target="_blank"><?=( ( strtolower(parse_url($origpostlink, PHP_URL_HOST)) ) ?: $origpostlink)?></a>
							</p>
						<?php endif;?>
					<?php endif;?>

					<?php if(in_category(['news','article']) || in_array(get_cat_name($_parentcat),['Articles'])):?>
						<div class="clearfix margin-top-30">

							<span class="pull-left margin-top-6 bold hidden-xs">
								Share Post:
							</span>
							<?php

							$img = esc_attr(get_the_post_thumbnail_url($post->ID,'mid-image'));
							$url = esc_sql(get_permalink());
							$twittertext = $text = esc_attr(get_the_title());
							?>
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?=$url?>&p[title]=<?=$text?>" class="social-icon social-icon-sm social-icon-transparent social-facebook pull-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook">
								<i class="icon-facebook"></i>
								<i class="icon-facebook"></i>
							</a>

							<a href="http://twitter.com/share?text=<?=$twittertext?>&url=<?=$url?>" class="social-icon social-icon-sm social-icon-transparent social-twitter pull-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter">
								<i class="icon-twitter"></i>
								<i class="icon-twitter"></i>
							</a>

							<a href="#" class="social-icon social-icon-sm social-icon-transparent social-gplus pull-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="Google plus">
								<i class="icon-gplus"></i>
								<i class="icon-gplus"></i>
							</a>

							<a href="#" class="social-icon social-icon-sm social-icon-transparent social-linkedin pull-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="Linkedin">
								<i class="icon-linkedin"></i>
								<i class="icon-linkedin"></i>
							</a>

							<a href="http://pinterest.com/pin/create/button/?url=<?=$url?>&description=<?=$text?>&media=<?=$img?>" class="social-icon social-icon-sm social-icon-transparent social-pinterest pull-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pinterest">
								<i class="icon-pinterest"></i>
								<i class="icon-pinterest"></i>
							</a>

							<a href="#" class="social-icon social-icon-sm social-icon-transparent social-call pull-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="Email">
								<i class="icon-email3"></i>
								<i class="icon-email3"></i>
							</a>

						</div>

						<?php comments_template(); ?>
					<?php endif;?>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 text-left">
					<!-- CATEGORIES -->
					<div class="side-nav margin-bottom-10">

						<div class="side-nav-head">
							<button class="fa fa-bars"></button>
							<h4>CATEGORIES</h4>
						</div>
						<?php

						$_category = get_categories( array( 'child_of' => $_parentcat ));
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
					<?php elseif(!empty($_category)&&!strcasecmp(get_cat_name($_parentcat),'Articles')): ?>
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
						<?php
						if(!strcasecmp(get_the_category($post->ID)[0]->slug, 'ROGUE-TRADER')){
							?>
							<div class="side-nav-head">
								<h4>ABOUT THE AUTHOR</h4>
							</div>
							<div class="row margin-bottom-20">
								<div class="col-sm-12 col-md-12">
									<div class="thumbnail margin-bottom-10">
										<img class="img-responsive" src="http://beta.marketmasterclass.com/wp-content/uploads/sites/8/2016/09/bruce-curren-profile.png" alt="" />
									</div>
									<div><strong>BRUCE CURRAN</strong></div>
									<div class="margin-bottom-10"><small>Independent Investment Expert</small></div>
									<label>Bruce Curran has been advising companies and individuals in Asia about international fundinvestment for over 30 years. He was a Director of the Swire Group in Hong Kong and has written numerous financial articles for Merrill Lynch, The Security Bank, and The Billionaire Magazine, and he was also a regular columnist for the Business World newspaper as well as Time magazine. Now an Independent Financial Adviser, he is here to share his views, suggestions and recommendations with those curious about investment in this vast jungle of opportunities.</label>
								</div>
							</div>
							<?php }elseif(!strcasecmp(get_the_category($post->ID)[0]->slug, 'our-offshore-experts')){?>
								<div class="side-nav-head">
									<h4>ABOUT THE AUTHOR</h4>
								</div>
								<div class="row margin-bottom-20">
									<div class="col-sm-12 col-md-12">
										<div class="thumbnail margin-bottom-10">
											<img class="img-responsive" src="http://beta.marketmasterclass.com/wp-content/uploads/sites/8/2016/09/austenmorrisassociates-1.jpg" alt="" />
										</div>
										<div><strong>BMARTYN DAVIES AND MATTHEW ARNOLD</strong></div>
										<div class="margin-bottom-10"><small>Austen Morris Associates</small></div>
										<label>Martyn Davies and Matthew Arnold are two extremely successful offshore financial advisers with a wealth of knowledge acquitted over the last two decades in the industry, with Martyn having worked for a number of years in South Africa and Dubai, while Matthew was based in China. They are both currently located in Manila and they now operate out of Austen Morris Associates, providing bespoke financial solutions to expatriate clients across the Asia region and beyond.
											If you would like to contact Martyn and Matthew form further investment advice, please contact them at: martyn.d@austenmorris.com</label>
										</div>
									</div>
									<?php }?>
								<?php else: ?>
									<div>No categories available</div>
								<?php endif;
								render_side_bar_widget();
								?>

							</div>
							<!-- /CATEGORIES -->


						</div>
					</div>
				</div>
			</section>
