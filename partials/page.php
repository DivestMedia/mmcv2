<section>
	<div class="container cont-<?=basename(get_permalink())?>">
		<div class="col-md-12">
			<header class="margin-bottom-30">
				<h2 class="section-title"><?=the_title()?></h2>
			</header>
			<?php  
			while ( have_posts() ) : the_post();
			?>
				<article id="post-<?=$post->ID?>">
					<div class="text-black size-14 entry-content post-<?=get_post_format($post->ID);?>">
						<?=get_the_content($post->ID);?>
					</div>
				</article>
			<?php endwhile;?>
		</div>
	</div>
</section>