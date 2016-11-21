<?
wp_enqueue_script( 'xyr_contact-script', get_template_directory_uri() . '/assets/js/contact.js', array( 'jquery' ), null, true );
get_header();

?>
<!-- -->
<section>
	<div class="container">
		<header class="text-center margin-bottom-30">
			<h2 class="section-title">Contact Us</h2>
		</header>

		<div id="map3" class="height-300 margin-bottom-60"></div>

		<div class="row">

			<!-- FORM -->
			<div class="col-md-9 col-sm-9">

				<h3>Drop us a line or just say <strong><em>Hello!</em></strong></h3>


				<!--
				MESSAGES

				How it works?
				The form data is posted to php/contact.php where the fields are verified!
				php.contact.php will redirect back here and will add a hash to the end of the URL:
				#alert_success 		= email sent
				#alert_failed		= email not sent - internal server error (404 error or SMTP problem)
				#alert_mandatory	= email not sent - required fields empty
				Hashes are handled by assets/js/contact.js

				Form data: required to be an array. Example:
				contact[email][required]  WHERE: [email] = field name, [required] = only if this field is required (PHP will check this)
				Also, add `required` to input fields if is a mandatory field.
				Example: <input required type="email" value="" class="form-control" name="contact[email][required]">

				PLEASE NOTE: IF YOU WANT TO ADD OR REMOVE FIELDS (EXCEPT CAPTCHA), JUST EDIT THE HTML CODE, NO NEED TO EDIT php/contact.php or javascript
				ALL FIELDS ARE DETECTED DINAMICALY BY THE PHP

				WARNING! Do not change the `email` and `name`!
				contact[name][required] 	- should stay as it is because PHP is using it for AddReplyTo (phpmailer)
				contact[email][required] 	- should stay as it is because PHP is using it for AddReplyTo (phpmailer)
			-->

			<!-- Alert Success -->
			<div id="alert_success" class="alert alert-success margin-bottom-30">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Thank You!</strong> Your message successfully sent!
			</div><!-- /Alert Success -->


			<!-- Alert Failed -->
			<div id="alert_failed" class="alert alert-danger margin-bottom-30">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>[SMTP] Error!</strong> Internal server error!
			</div><!-- /Alert Failed -->


			<!-- Alert Mandatory -->
			<div id="alert_mandatory" class="alert alert-danger margin-bottom-30">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Sorry!</strong> You need to complete all mandatory (*) fields!
			</div><!-- /Alert Mandatory -->


			<form action="<?=get_template_directory_uri();?>/php/contact.php" method="post" enctype="multipart/form-data">
				<fieldset>
					<input type="hidden" name="action" value="contact_send" />

					<div class="row">
						<div class="form-group">
							<div class="col-md-4">
								<label for="contact:name">Full Name *</label>
								<input required type="text" value="" class="form-control" name="contact[name][required]" id="contact:name">
							</div>
							<div class="col-md-4">
								<label for="contact:email">E-mail Address *</label>
								<input required type="email" value="" class="form-control" name="contact[email][required]" id="contact:email">
							</div>
							<div class="col-md-4">
								<label for="contact:phone">Phone</label>
								<input type="text" value="" class="form-control" name="contact[phone]" id="contact:phone">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-8">
								<label for="contact:subject">Topic *</label>
								<!-- <input required type="text" value="" class="form-control" name="contact[subject][required]" id="contact:subject"> -->
								<select class="form-control pointer" name="contact[subject][required]" id="contact:subject" required>
									<option value="">--- Select ---</option>
									<option value="Retirement">Retirement</option>
									<option value="School Fees Planning">School Fees Planning</option>
									<option value="Future Property Purchase">Future Property Purchase</option>
									<option value="Risk Management">Risk Management</option>
									<option value="Choosing Short, Medium and Long Term Investments">Choosing Short, Medium and Long Term Investments</option>
									<option value="Choosing a Fund">Choosing a Fund</option>
									<option value="Buying Stocks">Buying Stocks</option>
									<option value="How to Diversify a Portfolio">How to Diversify a Portfolio</option>
									<option value="Choosing Low, Medium and High Risk Investments">Choosing Low, Medium and High Risk Investments</option>
									<option value="Tax and Succession Building">Tax and Succession Building</option>
									<option value="Any Other Topics">Any Other Topics</option>
								</select>
							</div>
							<!-- <div class="col-md-4">
								<label for="contact_department">Department</label>
								<select class="form-control pointer" name="contact[department]">
									<option value="">--- Select ---</option>
									<option value="Retirement ">Retirement </option>
									<option value="Webdesign">Webdesign</option>
									<option value="Architecture">Architecture</option>
								</select>
							</div> -->
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<label for="contact:message">Message *</label>
								<textarea required maxlength="10000" rows="8" class="form-control" name="contact[message]" id="contact:message"></textarea>
							</div>
						</div>
					</div>

				</fieldset>

				<div class="row">
					<div class="col-md-12">
						<button type="submit" class="btn btn-success noradius"> SEND MESSAGE</button>
					</div>
				</div>
			</form>

		</div>
		<!-- /FORM -->


		<!-- INFO -->
		<div class="col-md-3 col-sm-3">

			<h2>Visit Us</h2>

			<!-- <p>
				<span class="block"><strong><i class="fa fa-map-marker"></i> Address:</strong> 2698 General J. Cailles St., Makati, 1233 Philippines</span>
				<span class="block"><strong><i class="fa fa-envelope"></i> Email:</strong> <a href="mailto:helpme@divestmedia.com">helpme@divestmedia.com</a></span>
			</p>
			<h4 class="font300">Hongkong Office</h4>
			<p>
				<span class="block">
					<strong><i class="fa fa-envelope"></i> Address:</strong>
					Suite 908 The Hong Kong Club Building, Charter Road Central Hong Kong
				</span>
				<span class="block">
					<strong><i class="fa fa-phone"></i> Phone:</strong>
					<a href="tel:+852 8192 6788">+852 8192 6788</a>
				</span>
			</p> -->
			<h4 class="font300">Manila Office</h4>
			<p>
				<span class="block">
					<strong><i class="fa fa-envelope"></i> Address:</strong>
					Fort Legend Tower, 3rd Ave and 31st Street, Bonifacio Global City, Taguig, Philippines
				</span>
				<!-- <span class="block">
					<strong><i class="fa fa-phone"></i> Phone:</strong>
					<a href="tel:+63 917 887 8376">+63 917 887 8376</a>
				</span> -->
				<span class="block"><strong><i class="fa fa-envelope"></i> Email:</strong> <a href="mailto:support@divestmedia.com">support@divestmedia.com</a></span>
			</p>
			<hr />

			<h4 class="font300">Business Hours</h4>
			<p>
				<span class="block"><strong>Monday - Friday:</strong> 10am to 6pm</span>
				<span class="block"><strong>Saturday:</strong> 10am to 2pm</span>
				<span class="block"><strong>Sunday:</strong> Closed</span>
			</p>

		</div>
		<!-- /INFO -->

	</div>
	<?php
	// Start the Loop.
	while ( have_posts() ) : the_post();
	?>
	<article id="post-<?php the_ID(); ?>">


		<div class="text-black size-18 entry-content post-<?=get_post_format();?>">

			<!-- article content -->
			<? the_content();?>
			<!-- /article content -->


			<?
			wp_link_pages( array(
				'before' => '<div class="divider"></div><ul class="pagination pagination-md"><h4>Pages</h4>',
				'after' => '</ul>',
				//'pagelink' => '%'
			) );

			?>
		</div><!-- .entry-content -->
	</article><!-- #post-## -->
<?php endwhile; // end of the loop. ?>



</div>
</section>
<!-- / -->



<?

global $_footers;

$_footers ='

<script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyCqCn84CgZN6o1Xc3P4dM657HIxkX3jzPY"></script>
<script type="text/javascript" src="'. get_template_directory_uri() .'/assets/plugins/gmaps.js"></script>
<script type="text/javascript">

jQuery(document).ready(function(){

	/**
	@MULTIPLE MARKERS GOOGLE MAP
	**/
	map3 = new GMaps({
		div: \'#map3\',
		lat: 14.5540263,
		lng: 121.0468529,
	});

	// Marker 1
	/* map3.addMarker({
		lat: -12.043333,
		lng: -77.03,
		title: \'Lima\',
		details: {
			database_id: 42,
			author: \'HPNeo\'
		},
		click: function(e){
			if(console.log) {
				console.log(e);
			}
			alert(\'You clicked in this marker\');
		}
	}); */

	// Marker 2
	map3.addMarker({
		lat: 14.5540263,
		lng: 121.0468529,
		title: \'Divest Media\',
		infoWindow: {
			content: \'<p><b>Manila Office:</b><br/>Fort Legend Tower, 3rd Ave and 31st Street, <br/>Bonifacio Global City, Taguig, Philippines <br/><b>Phone: </b>+63 917 887 8376</p>\'
		}
	});


});

</script>
';


get_footer();
