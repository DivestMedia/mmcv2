<?php
global $wp_query;

query_posts([
	'posts_per_page' => 12,
	'posts_per_archive_page' => 12,
	'paged' => get_query_var('paged') ?: 1,
	'post_type'        => 'download',
	'post_status'      => 'publish',
	'taxonomy'=>'download_category',
	'term'=> get_term_by( 'slug', $wp_query->query_vars['download_category'], 'download_category' )->slug
]);
get_header();
?>


<?php if ( have_posts() ) : ?>
	<section id="game-grid">
		<div class="container">
			<header class="text-center margin-bottom-10 tiny-line">
				<h2 class="font-proxima uppercase">E-Book Downloads</h2>
			</header>
			<!-- Portfolio Items -->
			<div id="blog" class="clearfix">
				<?php while ( have_posts() ) : the_post();
				?>

				<div class="col-sm-3 margin-bottom-10">
					<a href="http://beta.marketmasterclass.com/news/the-fed-feds-bullard-says-facebook-co-founder-behind-activists/">
						<figure class="margin-bottom-20 text-center" style="height:255px;">
							<?=(the_post_thumbnail( 'mid-image', [ 'class' => 'img-responsive' , 'alt' => $post->post_name, 'style' => 'height:100%;width:300px;' ] ))?>
						</figure>
					</a>
					<h4 class="margin-top-20 size-14 weight-700 uppercase height-50" style="overflow:hidden;"><a href="<?=the_permalink()?>"><?=$post->post_title?></a></h4>
					<p class="text-justify height-100" style="overflow:hidden;"><?=wp_trim_words( $post->post_content , "20", ".." )?></p>
					<a href="<?=the_permalink()?>" class="btn btn-sm btn-primary noradius">
						<span>Read More</span>
					</a>
				</div>
			<?php endwhile; ?>
		</div>

		<?=posts_pagination()?>

	</div>
</section>
<?php
// If no content, include the "No posts found" template.
else :
	get_template_part( 'partials/content', 'none' );

endif;
?>


<?php get_footer(); ?>
