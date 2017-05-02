<?php
get_template_part( 'partials/content', 'contactus' );
get_template_part( 'partials/content', 'vipsubscribers' );
?>
<!-- FOOTER -->
<footer id="footer">
	<div class="container padding-20 margin-bottom-10">
		<div class="text-center">
			<a href="<?=site_url()?>" class="text-white underline">
				<img src="<?=get_stylesheet_directory_uri();?>/assets/img/mmc-logo-light.png" class="width-150">
			</a>
			<!-- Social Icons -->
			<div class="text-center margin-top-0">
				<a href="https://www.facebook.com/marketmasterclasscom-1657855544470731/" target="_blank" class="social-icon social-icon-round social-icon-border social-facebook noborder" data-toggle="tooltip" data-placement="top" title="Facebook">

					<i class="icon-facebook"></i>
					<i class="icon-facebook"></i>
				</a>

				<a href="https://twitter.com/MyMarketMaster" target="_blank" class="social-icon social-icon-round social-icon-border social-twitter noborder" data-toggle="tooltip" data-placement="top" title="Twitter">
					<i class="icon-twitter"></i>
					<i class="icon-twitter"></i>
				</a>

				<a href="https://pinterest.com/MyMarketMaster" class="social-icon social-icon-round social-icon-border social-gplus noborder" data-toggle="tooltip" data-placement="top" title="Pinterest">
					<i class="fa fa-pinterest "></i>
					<i class="fa fa-pinterest "></i>
				</a>

				<a href="https://instagram.com/MyMarketMaster" class="social-icon social-icon-round social-icon-border social-instagram noborder" data-toggle="tooltip" data-placement="top" title="Instagram">
					<i class="icon-instagram"></i>
					<i class="icon-instagram"></i>
				</a>

				<a href="https://www.youtube.com/channel/UCI4UNi7DBZMHRYoaszF_CdA" target="_blank" class="social-icon social-icon-round social-icon-border social-youtube noborder" data-toggle="tooltip" data-placement="top" title="Youtube">
					<i class="icon-youtube"></i>
					<i class="icon-youtube"></i>
				</a>
				<!--


				<a href="#" class="social-icon social-icon-round social-icon-border social-rss noborder" data-toggle="tooltip" data-placement="top" title="Rss">
				<i class="icon-rss"></i>
				<i class="icon-rss"></i>
			</a> -->

		</div>
		<!-- /Social Icons -->

		<p>
			Market MasterClass is part of the <a href="http://www.divestmedia.com" style="color: #0072bc;font-weight: bold;">Divest Media Network</a>
		</p>
	</div>

	<hr/>
	<div class="row ">
		<div class="col-sm-6">
			&copy; <?=date("Y")?> Market MasterClass. All rights reserved
		</div>
		<div class="col-sm-6 text-right">
			<?php
			if(!empty(wp_get_nav_menu_items('Footer Navigation'))){
				$footer_menu = [];
				foreach (wp_get_nav_menu_items('Footer Navigation') as $f) {
					array_push($footer_menu , '<a href="'.$f->url.'">'.$f->title.'</a>');
				}

				print_r(implode(' | ', $footer_menu));
			}
			?>
		</div>


	</div>

</div>
<div class="copyright">
	<div class="container size-12 text-center">
		Market MasterClass is a financial publisher that does not offer any personal financial advice, or advocate the
		purchase or sale of any security or investment for any specific individual. Members should be aware that investment
		markets have inherent risks, and past performance does not assure future results.
		In accordance with FTC guidelines, Market MasterClass has financial relationships with some of the products and
		services mentioned on this web site, and Market MasterClass may be compensated if consumers choose to click these
		links in our content and ultimately sign up for them. For more information please visit our disclaimer web page.

	</div>
</div>

</footer>
<!-- /FOOTER -->



</div>
<!-- /wrapper -->


<!-- SCROLL TO TOP -->
<a href="#" id="toTop"></a>


<!-- PRELOADER -->
<div id="preloaderx">
	<div class="inner">
		<span class="loader"></span>
	</div>
</div><!-- /PRELOADER -->

<?php
global $restrict;

if( (!is_user_logged_in() && ($restrict && $restrict->restrict_page())) || is_home() ){
	?>
	<div id="modal-restrict" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" <?php if(!is_home()): ?>data-backdrop="static"<?php endif;?> data-show="true" <?php if(!is_home()): ?>data-autoload="true"<?php endif;?> data-autoload-delay="200">
		<div class="modal-dialog modal-lg" style="max-width: 770px;">
			<div class="modal-content">
				<!-- body modal -->
				<div class="modal-body" style="padding: 0 15px;">
					<div class="row">
						<div class="col-md-3 padding-0" style="background-color: #d1d1d1;height: 100%;position: relative;">

							<figure style="background-image: url('<?=get_stylesheet_directory_uri();?>/assets/img/restrict.png');background-size: cover;background-repeat: no-repeat;height: 405px;background-position: center;"></figure>
							<div class="text-center" style="position: absolute;bottom: 10px;width: 100%;">
								<div style="background-color: rgba(0,0,0,.6);color:#fff;padding:15px 0;">
									<label class="margin-bottom-0">JOIN NOW!</label>
									<label class="size-70 margin-bottom-0 weight-700">FREE</label>
									<label class="margin-bottom-0">PRIVACY PROTECTION</label>
								</div>
								<div style="color: #000;border-bottom: 1px solid #000;border-top: 1px solid #000;margin-top: 14px;width: 75%;margin: 17px auto 0;">LIMITED TIME OFFER</div>
							</div>

						</div>
						<div class="col-md-9 padding-15">
							<div class="text-center">
								<h2 class="letter-spacing-2 margin-top-20 margin-bottom-0" style="color:#ee3f3f;">CONTENT RESTRICTED</h2>
								<p class="margin-bottom-40">CONTENT ONLY AVAILABLE TO OUR MEMBERS</p>
								<div style="width: 300px;margin:0 auto">
									<a href="<?=site_url('subscriptions')?>" class="btn btn-success btn-lg btn-block">SIGN UP NOW</a>
								</div>
								<div style="padding-top: 5px;width: 300px;margin:0 auto">
									<a href="<?=site_url('accounts/login')?>" class="btn btn-info btn-lg btn-block">ALREADY A MEMBER</a>
								</div>
								<div class="margin-top-20">
									<a href="<?=site_url()?>" class="btn btn-link">NO THANKS</a>
								</div>
							</div>
							<!-- <div class="margin-top-20" style="padding: 0 20px;">
							<small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer orci nunc, auctor sed eros eget, efficitur rhoncus nibh. Suspendisse congue mauris nec dolor consectetur, venenatis fermentum erat semper.</small>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php

}
?>


<!-- JAVASCRIPT FILES -->
<?php
wp_footer();
global $_footers;

echo $_footers;

if(!is_user_logged_in()):
	?>
	<script>
	jQuery(function($){
		$('a[href="http://assessment.marketmasterclass.com/"]').attr('href','<?=site_url('subscriptions')?>');
		$('a[href="http://objective.marketmasterclass.com/"]').attr('href','<?=site_url('subscriptions')?>');
	});
	</script>
	<script>
	jQuery(function($){

		$( '.video-grid' ).find('.video-grid-column-wrapper .video-grid-play').each(function(e){
			$(this).unbind('click');
			$(this).removeClass('video-grid-play');
			$(this).attr('href','#');
			$(this).bind('click',function(e){
				e.preventDefault();
				$('#modal-restrict').modal('show');
				return false;
			});
		});
	});
	</script>
	<?php
endif;
if(is_home()){
	?>

	<script src="<?=get_stylesheet_directory_uri();?>/assets/js/master-slider/masterslider/masterslider.js"></script>
	<script src="<?=get_stylesheet_directory_uri();?>/assets/js/slider.js"></script>

	<?php
}
?>

<script src="<?=get_stylesheet_directory_uri();?>/assets/js/jquery.matchHeight-min.js"></script>
<script>
$(function() {

	$('.box').matchHeight(true);

	/** Sparkline Graph

	USAGE

	<div class="sparkline" data-plugin-options='{"type":"bar","barColor":"#2E363F","height":"26px","barWidth":"5","barSpacing":"2"}'>
	9,6,5,6,6,7,7,6,7,8,9,7
	</div>

	PLugin options
	http://omnipotent.net/jquery.sparkline/#s-docs
	**************************************************************** **/
	if(jQuery(".sparkline").length > 0) {

		loadScript(plugin_path + 'chart.sparkline/jquery.sparkline.min.js', function() {

			if(jQuery().sparkline) {
				jQuery('.sparkline').each(function() {
					jQuery(this).sparkline('html', jQuery(this).data("plugin-options"));
				});
			}
			var sparkcount = 0;
			var sparkactive = 0;
			var sparkInterval = setInterval(function(){
				sparkcount = jQuery('.sparkline').length;
				sparkactive = jQuery('.sparkline canvas').length;
				jQuery('.sparkline').each(function() {
					if($(this).find('canvas').length==0){
						jQuery(this).sparkline('html', jQuery(this).data("plugin-options"));
					}
				});
				if(sparkcount==sparkactive){
					clearInterval(sparkInterval);
				}
			},1000);
		});
	}



	if(typeof xyrLoadImg == 'function'){
		xyrLoadImg();
	}


});
</script>


<?php


$post_slug = basename(get_permalink());
if(!empty($post_slug)):
	if(in_array($post_slug,[
		'subscriptions',
		'webinars',
		'stockfocus',
		'stockwatch',
		'dummies-guide',
		'find-a-broker',
		'celebrity-watch',
		])){
			if(empty($_COOKIE['dm-intro-vid-'.$post_slug])){

				$intros = [
					'subscriptions' => 'https://www.youtube.com/watch?v=_fqUtePTPj8',
					'webinars' => 'https://www.youtube.com/watch?v=Bw2PD_9BF9Y',
					'stockfocus' => 'https://www.youtube.com/watch?v=54cQar5LDrU',
					'stockwatch' => 'https://www.youtube.com/watch?v=637TJ_9XMak',
					'dummies-guide' => 'https://www.youtube.com/watch?v=y3_21xTqOhg',
					'find-a-broker' => 'https://www.youtube.com/watch?v=0IOrhWs9SKg',
					'celebrity-watch' => 'https://www.youtube.com/watch?v=VxrZ2w4Ad0I',
				];

				if(!empty($intros[$post_slug])){

					?>
					<!-- ANDY PENDER VIDEOS -->
					<script>
					function setCookie(c_name, value, exdays) {
						var exdate = new Date();
						exdate.setDate(exdate.getDate() + exdays);
						var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
						document.cookie = c_name + "=" + c_value;
					}

					loadScript(plugin_path + 'magnific-popup/jquery.magnific-popup.min.js', function() {

						if(typeof(jQuery.magnificPopup) == "undefined") {
							return false;
						}
						jQuery.magnificPopup.open({
							"preloader" : true,
							"type":"iframe",
							"closeOnBgClick":false,
							"autoload":true,
							"autoload-delay":2000,
							"items": {
								src: "<?=($intros[$post_slug])?>"
							},
							callbacks : {
								afterClose: function() {
									setCookie('<?=('dm-intro-vid-'.$post_slug)?>','true',7);
								}
							}
						});

					});

					</script>


					<?php
				}
			}
		}
	endif;



	?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.min.js"></script>
	<script>
	jQuery(function($){

		loadScript(plugin_path + 'typeahead.bundle.js', function() {
			var stockTickers = new Bloodhound({
				datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				prefetch: '<?=admin_url("admin-ajax.php")?>?action=stock_ticker_search&s=aa',
				remote: {
					url: '<?=admin_url("admin-ajax.php")?>?action=stock_ticker_search&s=%QUERY',
					wildcard: '%QUERY'
				}
			});

			$('.stocksearch-typehead').typeahead(null, {
				display: 'ticker',
				minLength: 2,
				source: stockTickers,
				displayKey : 'name',
				displayValue : 'ticker',
				name : 'tvwidgetsymbol',
				templates: {
					empty: [
						'<div class="empty-message">',
						'No results',
						'</div>'
					].join('\n'),
					suggestion: Handlebars.compile('<div><strong>{{ticker}}</strong> – {{name}}</div>')
				}
			});
		});
	});
	</script>
	<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod? n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n; n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0; t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '135800130229559');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=135800130229559&ev=PageView&noscript=1"
		/></noscript>
		<!-- DO NOT MODIFY -->
		<!-- End Facebook Pixel Code -->


	</body>

	</html>
