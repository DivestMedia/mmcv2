

<?php
get_template_part( 'partials/content', 'indexwatch' );
setup_postdata($post);
?>
<!-- -->
<section class="nopadding board-advisor parallax parallax-3" style="background-image: url(<?=get_stylesheet_directory_uri();?>/assets/img/all.jpg)">
	<div class="overlay dark-1"><!-- dark overlay [1 to 9 opacity] --></div>
	<div class="container padding-top-100">

		<div class="row">

			<div class="col-lg-3 col-md-3 col-sm-3">

				<img class="img-responsive" src="<?=the_post_thumbnail_url()?>" alt="">

			</div>

			<div class="col-lg-9 col-md-7 col-sm-9  padding-top-100">


				<blockquote>
					<h2 class="size-25" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.8);"><span><?=the_title()?></span><div class="size-17"><i><?=get_post_meta($post->ID,'advisor_position')[0]?></i></div class="size-17"></h2>

						<p style="text-shadow: 1px 1px 3px rgba(0,0,0,0.8);">"<?=get_post_meta($post->ID,'advisor_quote')[0]?>"</p>
					</blockquote>

				</div>

			</div>

		</div>
	</section>
	<!-- / -->
	<!-- -->
	<section class="alternate">
		<div class="container padding-top-10">

			<div class="row">

				<div class="col-lg-2 col-md-2 col-sm-2">

				</div>

				<div class="col-lg-9 col-md-7 col-sm-9">
					<h2 class="size-25"><span><?=the_title()?></span>
						<a href="#" class="btn btn-md btn-theme-hover noradius italic" data-toggle="modal" data-target="#ask-advisor-modal">Ask <?=(current(explode(' ',the_title())))?></a>
						<?php if($post->post_name=='ron-faulkner'):?>
							<a href="<?=site_url('/video/ron-faulkner/#all-videos')?>" class="btn btn-md btn-theme-hover noradius">View webcast</a>
						<?php else: ?>
							<a href="<?=site_url('/video/bruce-curran/#all-videos')?>" class="btn btn-md btn-theme-hover noradius">View webcast</a>
						<?php endif;?>
					</h2>
					<?=get_the_content($post->ID)?>
					<blockquote class="quote">
						<?php echo do_shortcode('[quotcoll limit="1" orderby="random"]')?>
					</blockquote>
					<?=get_post_meta($post->ID,'advisor_description2')[0]?>
				</div>
			</div>
		</div>
	</section>
	<!-- / -->

	<div id="ask-advisor-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<!-- header modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myLargeModalLabel">Ask <?=(current(explode(' ',the_title())))?></h4>
				</div>

				<!-- body modal -->
				<div class="modal-body">

					<form class="validate" action="<?=admin_url("admin-ajax.php")?>" method="post" data-success="Thank you for your message!" data-toastr-position="top-center">

						<h4>Please leave your email and questions below and I will respond to it as soon as I can.</h4>
						<input type="hidden" name="action" value="save_advisor_message" />
						<input type="hidden" name="contact[advisor]" value="<?=(current(explode(' ',the_title())))?>" />
						<div class="fancy-form">
							<i class="fa fa-envelope"></i>
							<input type="email" class="form-control" name="contact[email]" placeholder="Your Email Address" required>
						</div>

						<div class="fancy-form">
							<textarea rows="5" name="contact[message]" class="form-control word-count" data-maxlength="200" data-info="textarea-words-info" placeholder="Leave a message" required></textarea>

							<i class="fa fa-comments"><!-- icon --></i>

							<span class="fancy-hint size-11 text-muted">
								<strong>Hint:</strong> 200 words allowed!
								<span class="pull-right">
									<span id="textarea-words-info">0/200</span> Words
								</span>
							</span>

						</div>
						<div class="row">
							<div class="col-md-12">
								<button type="submit" id="submit-advisor-modal" class="btn btn-3d btn-teal pull-right margin-top-30">
									Send Now
								</button>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>



	<!-- BUTTON CALLOUT -->
	<a href="#contact-us" rel="nofollow" target="_blank" class="btn btn-xlg btn-theme size-20 fullwidth nomargin noradius padding-40">
		<span class="font-lato size-30">
			Seek investment advice from our Board of Advisors?
			<strong>Click here &raquo;</strong>
		</span>
	</a>
	<!-- /BUTTON CALLOUT -->

	<?php
	function advisor_child_script() {
		?>
		<script type="text/javascript">
		jQuery(window).load(function() {
			$('#submit-advisor-modal').click(function(){
				$('#ask-advisor-modal').modal('hide');
			});

			if(window.location.hash) {
				var hash = window.location.hash;
				if($(hash).length>0 && hash == '#ask-advisor-modal'){
					$(hash).modal('show');
				}
			}
		});
		</script>
		<?php
	}
	add_action( 'wp_footer', 'advisor_child_script' ,100);

	?>
