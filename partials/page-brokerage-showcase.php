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
			<div class="col-md-9 col-sm-9 text-justify">

				<p><img class="size-full wp-image-276016 alignleft" src="http://www.marketmasterclass.com/wp-content/uploads/2016/06/ama-1x1logo.jpg" alt="ama-1x1logo" width="161" height="161" srcset="http://www.marketmasterclass.com/wp-content/uploads/2016/06/ama-1x1logo-150x150.jpg 150w, http://www.marketmasterclass.com/wp-content/uploads/2016/06/ama-1x1logo.jpg 161w" sizes="(max-width: 161px) 100vw, 161px">Established over 24 years ago, AMA is by far the leading Wealth Management firm working on a global level today. Martyn Davies, Regional Manager for the Manila office has been working within the financial services sector for 20 years, firstly in Europe managing high level asset-backed financing deals through companies including GE Capital and De Lage Landen, before then moving into personal financial planning in Dubai, South Africa, and the Philippines. Matthew Arnold, Senior Consultant, was based in China with AMA for 10 years before moving to the Philippines two years ago.</p>
				<p>Austen Morris Associates differentiates itself from the competition by focusing on client-servicing through the short, medium and long term stages of financial planning and wealth management. All Austen Morris clients are reviewed with their consultant on at least a quarterly basis, which forms the core KPI of an adviser with the company and is rigorously enforced. Review meetings are important for clients to keep up to date with how their investments are performing, how the financial world is looking, and to be advised of any potential changes to their current portfolios. It is also equally as important for a consultant to keep up to date with what is happening in a client’s life as changes in employment, geography or family set up are all going to have an impact on the clients financial planning over the <span id="more-276859"></span></p>
				<p>short, medium and long term.</p>
				<p>An exclusive offering to AMA clients is our Wealth Management Service (WMS), and all our clients can access this system. It consolidates all of a client’s investments into one area which they can review on a 24/7 basis. The system also includes a quarterly portfolio recommendation which a client can accept or dismiss at the touch of a button.</p>
				<p>Also, of great importance to our clients is the fact that we are fully independent from any bank, insurance company or asset manager, although we do have strategic partnerships with all the major players in these fields so that we can access the full range of financial structures and underlying investment instruments. This ensures that we can tailor solutions in a bespoke manner.</p>
				<p>All the investments that we utilize are based in offshore jurisdictions, principally the tier 1 jurisdictions, namely the Isle of Man, Jersey, Guernsey and Luxembourg. The reason we principally use these jurisdictions is because of the security to client funds that is provided through government-backed protection schemes. Of course we can also access investments in other offshore jurisdictions such as Cayman, Mauritus and Bermuda, to name but a few, but we prefer the added security for our clients that the tier 1 jurisdiction can provide. Of equal interest to most offshore investors are the taxation benefits of investing offshore, although it is important to remember that we operate on a policy of tax efficiency and not tax avoidance!</p>
				<p>As a company we assist clients across the entire financial planning, family protection and wealth management spectrum. From very basic requirements around life insurance and medical coverage, all the way through to very complex management of HNW individual’s investment portfolios.</p>
				<p>One of our newest initiatives is our Portfolio Recovery Service. This is offered to individuals who have set up investment structures with other organizations and are not happy with various aspects around these investments. This could be for a range of reasons, including but not limited to, poor performance of their investments, poor service level from their current provider, investments that may have been suspended, and QROPS structures that are top heavy on charging structures; we can review these portfolios on a free of charge basis and make the necessary recommendations to ensure a recovery plan is implemented in the shortest possible time frame.</p>
				<p>At Austen Morris Associates we are committed to long-term partnerships, integrity and innovation, and we will always strive to protect and develop a successful portfolio for you.</p>


			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 text-left">
				<!-- CATEGORIES -->
				<div class="side-nav margin-bottom-60">

					<div class="side-nav-head">
						<button class="fa fa-bars"></button>
						<h4>CATEGORIES</h4>
					</div>
					<?php if(in_category(['news'])):?>
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
					<?php else: ?>
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
					<?php endif; ?>
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
