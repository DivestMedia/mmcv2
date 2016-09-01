<?php
get_template_part( 'partials/content', 'indexwatch' );
?>
<section>
	<div class="container">
		<a href="#" class="text-gray bold size-10 uppercase letter-spacing-10"><?=!empty(get_the_category($post->ID)[0]->name)?get_the_category($post->ID)[0]->name:''?></a>
		<header class="text-left margin-bottom-50 tiny-line">
			<h2 class="font-proxima"><a href="<?=get_the_permalink()?>"><?=the_title()?></a></h2>
			<!-- <a href="#" class="size-12 text-black uppercase bold">BY: John Doe</a>  &nbsp; -->
			<a href="#" class="size-12 text-gray"><?=get_the_date()?></a>
			<br/>
		</header>

		<div class="row">
			<div class="col-md-6 col-sm-9 text-justify">
				<figure>
					<?php the_post_thumbnail( 'thumbnail', ['class' => 'alignleft'] ); ?>
				</figure>
				<div class="post-content">
					<?=$post->post_content?>
				</div>

			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 text-left">
				<!-- CATEGORIES -->
				<div class="side-nav margin-bottom-60">

					<div class="side-nav-head">
						<button class="fa fa-bars"></button>
						<h4>CATEGORIES</h4>
					</div>
					
					<ul class="list-group list-group-bordered list-group-noicon uppercase">


						<li class="list-group-item active">
							<a class="dropdown-toggle" href="#">GLOBAL</a>
							<ul>
								<li><a href="#"><span class="size-11 text-muted pull-right">(123)</span> Shoes & Boots</a></li>
								<li class="active"><a href="#"><span class="size-11 text-muted pull-right">(331)</span> Top & Blouses</a></li>
								<li><a href="#"><span class="size-11 text-muted pull-right">(234)</span> Dresses & Skirts</a></li>
							</ul>
						</li>
						<li class="list-group-item">
							<a class="dropdown-toggle" href="#">SPORTS</a>
							<ul>
								<li><a href="#"><span class="size-11 text-muted pull-right">(88)</span> Accessories</a></li>
								<li><a href="#"><span class="size-11 text-muted pull-right">(67)</span> Shoes & Boots</a></li>
								<li><a href="#"><span class="size-11 text-muted pull-right">(32)</span> Dresses & Skirts</a></li>
								<li class="active"><a href="#"><span class="size-11 text-muted pull-right">(78)</span> Top & Blouses</a></li>
							</ul>
						</li>
						<li class="list-group-item">
							<a class="dropdown-toggle" href="#">DUMMIES GUIDE</a>
						</li>
						<li class="list-group-item">
							<a class="dropdown-toggle" href="#">BUSINESS</a>
							<ul>
								<li><a href="#"><span class="size-11 text-muted pull-right">(88)</span> Shoes & Boots</a></li>
								<li><a href="#"><span class="size-11 text-muted pull-right">(22)</span> Dresses & Skirts</a></li>
								<li><a href="#"><span class="size-11 text-muted pull-right">(31)</span> Accessories</a></li>
								<li class="active"><a href="#"><span class="size-11 text-muted pull-right">(18)</span> Top & Blouses</a></li>
							</ul>
						</li>
						<li class="list-group-item"><a href="#"><span class="size-11 text-muted pull-right">(189)</span> NEWS</a></li>
						<li class="list-group-item"><a href="#"><span class="size-11 text-muted pull-right">(61)</span> VIDEOS</a></li>

					</ul>

				</div>
				<!-- /CATEGORIES -->

				<?php 
					if(is_active_sidebar('sidebar-single'))
						dynamic_sidebar('sidebar-single');
				?>
			</div>
		</div>
	</div>
</section>
<!-- / -->
<?php
get_template_part( 'partials/content', 'vipsubscribers' );
?>
