<section class="">
	<div class="container">
		<header class="text-center margin-bottom-50 tiny-line">
			<h2 class="font-proxima uppercase">Global Business <span>News</span></h2>
		</header>
		<p class="horizontal-center text-center  block max-width-700">
			Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
			Aenean commodo ligula eget dolor. Aenean massa.
			Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
		</p>

		<?php $args = array(

		);
		$global_news = get_posts([
			'posts_per_page'   => 10,
			'category_name'    => 'News',
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'post',
			'post_status'      => 'publish',
			'suppress_filters' => true
		]);
		?>
		<!--
		controlls-over		= navigation buttons over the image
		buttons-autohide 	= navigation buttons visible on mouse hover only

		data-plugin-options:
		"singleItem": true
		"autoPlay": true (or ms. eg: 4000)
		"navigation": true
		"pagination": true
		"items": "4"

		owl-carousel item paddings
		.owl-padding-0
		.owl-padding-3
		.owl-padding-6
		.owl-padding-10
		.owl-padding-15
		.owl-padding-20
	-->
	<?php if(count($global_news)): ?>
		<div class="owl-carousel owl-padding-10 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"3", "autoPlay": 4000, "navigation": true, "pagination": false}' id="global-news-post-slider">
			<?php foreach($global_news as $post): ?>
				<div class="img-hover">
					<a href="<?=get_the_permalink()?>">
						<?=get_the_post_thumbnail($post->ID,'mid-image',[
							'class' => 'liner img-responsive'
							])?>
						</a>

						<h4 class="text-left margin-top-20 height-50 post-title"><a href="<?=get_the_permalink()?>"><?=xyr_smarty_limit_chars(get_the_title(),80)?></a></h4>
						<div class="text-left margin-bottom-10 height-100 post-excerpt"><?=xyr_smarty_limit_chars(strip_tags(html_entity_decode(get_the_excerpt())),200)?></div>
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
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
