<?php
get_header();
$queried = get_queried_object();
if(is_category('news')){
	include 'partials/category-news.php';
}elseif(in_array($queried->slug,['news-at-a-glance','business-news','world-news-news-at-a-glance'])){
	include 'partials/category-news-at-a-glance.php';
}elseif(is_category('press-release') || (is_category() && get_category(get_query_var('cat'))->parent != 0 && get_category(get_category(get_query_var('cat'))->parent)->slug=='press-release')){
	include 'partials/category-press-release.php';
}elseif(is_category('articles') || (is_category() && get_category(get_query_var('cat'))->parent != 0 && get_category(get_category(get_query_var('cat'))->parent)->slug=='articles')){
	include 'partials/category-article.php';
}elseif(is_category('brokerage-firms')){
	include 'partials/category-brokerage-firms.php';
}elseif(is_tag()){
	include 'partials/tag-news.php';
}elseif(is_archive('iod_video')){
	include 'partials/archive-iod_video.php';
}else{

	?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

				/*
				* Include the Post-Format-specific template for the content.
				* If you want to override this in a child theme, then include a file
				* called content-___.php (where ___ is the Post Format name) and that will be used instead.
				*/
				get_template_part( 'content', get_post_format() );

				// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
				'next_text'          => __( 'Next page', 'twentyfifteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
				) );

				// If no content, include the "No posts found" template.
				else :
					get_template_part( 'partials/content', 'none' );

				endif;
				?>

			</main><!-- .site-main -->
		</section><!-- .content-area -->

		<?php 	}
		get_footer();

		?>
