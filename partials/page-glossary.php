<section>
	<div class="container">
		<div id="container-glossary" class="col-md-9">
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
		<div class="col-md-3">
			<?php
                if(is_active_sidebar('sidebar-single'))
                dynamic_sidebar('sidebar-single');
                ?>
		</div>
	</div>
</section>