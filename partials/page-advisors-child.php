<?php
get_template_part( 'partials/content', 'indexwatch' );
setup_postdata($post);
?>
<!-- -->
<section class="nopadding board-advisor parallax parallax-3" style="background-image: url(<?=get_stylesheet_directory_uri();?>/assets/img/all.jpg)">
<div class="overlay dark-1"><!-- dark overlay [1 to 9 opacity] --></div>
	<div class="container padding-top-100">

		<div class="row">

			<div class="col-lg-3 col-md-3 col-sm-3">

				<img class="img-responsive" src="<?=the_post_thumbnail_url()?>" alt="">

			</div>

			<div class="col-lg-9 col-md-7 col-sm-9  padding-top-100">


				<blockquote>
				<h2 class="size-25" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.8);"><span><?=the_title()?></span><div class="size-17"><i><?=get_post_meta($post->ID,'advisor_position')[0]?></i></div class="size-17"></h2>

				<p style="text-shadow: 1px 1px 3px rgba(0,0,0,0.8);">"<?=get_post_meta($post->ID,'advisor_quote')[0]?>"</p>
			</blockquote>

			</div>

		</div>

	</div>
</section>
<!-- / -->
<!-- -->
<section class="alternate">
	<div class="container padding-top-10">

		<div class="row">

			<div class="col-lg-2 col-md-2 col-sm-2">

			</div>

			<div class="col-lg-9 col-md-7 col-sm-9">
				<h2 class="size-25"><span><?=the_title()?></span>
					<a href="<?=site_url('contact-us')?>" class="btn btn-md btn-theme-hover noradius italic">Ask <?=(current(explode(' ',the_title())))?></a>
					<a href="<?=site_url('/video/bruce-curran/#all-videos')?>" class="btn btn-md btn-theme-hover noradius">View webcast</a>
				</h2>
				<?=the_content()?>
				<blockquote class="quote">
					<?php echo do_shortcode('[quotcoll limit="1" orderby="random"]')?>
				</blockquote>
				<?=get_post_meta($post->ID,'advisor_description2')[0]?>
			</div>
		</div>
	</div>
</section>
<!-- / -->




<!-- BUTTON CALLOUT -->
<a href="#contact-us" rel="nofollow" target="_blank" class="btn btn-xlg btn-theme size-20 fullwidth nomargin noradius padding-40">
	<span class="font-lato size-30">
		Seek investment advice from our Board of Advisors?
		<strong>Click here &raquo;</strong>
	</span>
</a>
<!-- /BUTTON CALLOUT -->
