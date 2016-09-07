<?php
get_template_part( 'partials/content', 'indexwatch' );
?>	
<!-- ABOUT -->
	<section id="about_advisors" class="parallax dark alternate" style="background: #000 url('<?=get_stylesheet_directory_uri();?>/assets/img/faces.jpg') repeat top left!important ;">
		
		<div class="overlay dark-9"><!-- dark overlay [1 to 9 opacity] --></div>
		<div class="container">

			<header class="text-center margin-bottom-60">
				<h3 class="size-26">Board of Advisors</h3>
				<p class="lead font-lato"></p>
				<hr />
				
			</header>

			
			<div class="row margin-bottom-40">
			<?php
				$args = array(
				    'post_type'      => 'page',
				    'posts_per_page' => -1,
				    'post_parent'    => get_page_by_title('Advisors')->ID,
				    'order'          => 'ASC',
				    'orderby'        => 'date'
				 );


				$parent = new WP_Query( $args );

				if ( $parent->have_posts() ) : ?>

				    <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
				    	
				    	<div class="col-sm-6 col-md-3 item">
				    		<a href="<?=the_permalink()?>">
							<div class=" noradius">
								<img class="img-responsive bg-advisor margin-bottom-20" src="<?=the_post_thumbnail_url()?>" alt="" />
								<div class="caption">
									<h4 class="nomargin"><?=the_title()?></h4><hr/>
									<span class="size-16 margin-bottom-20 block"><?=get_post_meta($post->ID,'advisor_position')[0]?></span>
									<p><?=trim_text(get_the_content(),115)?></p>
								</div>
							</div>
							</a>
						</div>
			    	<?php endwhile; ?>
				<?php endif; wp_reset_query(); ?>
			</div>
		</div>
		
	</section>
	<!-- / -->
	
	<!-- BUTTON CALLOUT -->
	<a href="#purchase" rel="nofollow" target="_blank" class="btn btn-xlg btn-theme size-20 fullwidth nomargin noradius padding-40">
		<span class="font-lato size-30">
			Seek investment advice from our Board of Advisors?
			<strong>Click here &raquo;</strong>
		</span>
	</a>
	<!-- /BUTTON CALLOUT -->