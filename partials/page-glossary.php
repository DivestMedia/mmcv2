<section>
	<div class="container">
		<div id="container-glossary" class="col-md-12">
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
		</div>
	</div>
</section>