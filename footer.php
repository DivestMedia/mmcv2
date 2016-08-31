<!-- FOOTER -->
			<footer id="footer">
				<div class="container padding-20 margin-bottom-10">
					<div class="text-center">
						<a href="#" class="text-white underline">
						<img src="<?=get_stylesheet_directory_uri();?>/assets/img/mmc-logo-light.png" class="width-150">
						</a>
							<!-- Social Icons -->
						<div class="text-center margin-top-0">
							<a href="https://www.facebook.com/divest.media/" target="_blank" class="social-icon social-icon-round social-icon-border social-facebook noborder" data-toggle="tooltip" data-placement="top" title="Facebook">

								<i class="icon-facebook"></i>
								<i class="icon-facebook"></i>
							</a>

							<a href="https://twitter.com/divestmedia?lang=en" target="_blank" class="social-icon social-icon-round social-icon-border social-twitter noborder" data-toggle="tooltip" data-placement="top" title="Twitter">
								<i class="icon-twitter"></i>
								<i class="icon-twitter"></i>
							</a>

							<a href="#" class="social-icon social-icon-round social-icon-border social-gplus noborder" data-toggle="tooltip" data-placement="top" title="Google plus">
								<i class="icon-gplus"></i>
								<i class="icon-gplus"></i>
							</a>

							<a href="#" class="social-icon social-icon-round social-icon-border social-instagram noborder" data-toggle="tooltip" data-placement="top" title="Instagram">
								<i class="icon-instagram"></i>
								<i class="icon-instagram"></i>
							</a>

							<a href="https://www.youtube.com/channel/UCD9Z6q-j5XiJEx_SIO5FqYA" target="_blank" class="social-icon social-icon-round social-icon-border social-youtube noborder" data-toggle="tooltip" data-placement="top" title="Youtube">
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
					</div>
					
					<hr/>
					<div class="row ">
						<div class="col-sm-6">
							&copy; 2016 Market MasterClass. All rights reserved
						</div>
						<div class="col-sm-6 text-right">


							<a href="http://www.divestmedia.com/privacy-policy">Privacy Policy</a>
							&nbsp;&nbsp;&bullet;&nbsp;&nbsp;
							<a href="http://www.divestmedia.com/terms-and-conditions">Terms and Conditions</a>
							&nbsp;&nbsp;&bullet;&nbsp;&nbsp;
							<a href="http://www.divestmedia.com/sitemap">Sitemap</a>
							
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


		<!-- JAVASCRIPT FILES -->
		<?php
			wp_footer();
		global $_footers;
		echo $_footers;
		?>
		<script src="<?=get_stylesheet_directory_uri();?>/assets/js/master-slider/masterslider/masterslider.js"></script>
		<script src="<?=get_stylesheet_directory_uri();?>/assets/js/slider.js"></script>
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
			
			});

		}
	
	
	
	
	
});</script>
		

	</body>
</html>