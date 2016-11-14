
<?php
global $current_user, $wp_roles, $wpdb; wp_get_current_user();
$assessment_prefix_1 = 'wp_6_';
$assessment_prefix_2 = 'wp_9_';
define('TBL_ASSESSMENT_RESULTS',  $assessment_prefix_1.'assessment_results');
define('TBL_OBJECTIVE_RESULTS',  $assessment_prefix_2.'assessment_results');

if(empty($current_user->ID))
wp_redirect(home_url());
/* Load the registration file. */
//require_once( ABSPATH . WPINC . '/registration.php' ); //deprecated since 3.1
$error = array();
/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update' ) {

	/* Update user password. */
	if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
		if ( $_POST['pass1'] == $_POST['pass2'] )
		wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
		else
		$error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
	}

	/* Update user information. */
	if ( !empty( $_POST['url'] ) )
	wp_update_user( array( 'ID' => $current_user->ID, 'user_url' => esc_url( $_POST['url'] ) ) );
	if ( !empty( $_POST['email'] ) ){
		if (!is_email(esc_attr( $_POST['email'] )))
		$error[] = __('The Email you entered is not valid.  please try again.', 'profile');
		elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id )
		$error[] = __('This email is already used by another user.  try a different one.', 'profile');
		else{
			wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
		}
	}

	if(!empty($_FILES['photo'])){

		$filename = basename($_FILES["photo"]["name"]);
		$upload_dir = wp_upload_dir();

		if(wp_mkdir_p($upload_dir['path']))     $target_path = $upload_dir['path'];
		else                                    $target_path = $upload_dir['basedir'];

		$target_file = $target_path . '/' . $filename;
		$target_file_url = $upload_dir['baseurl'] . '/' . $filename;

		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			$uploadOk = 0;
		}

		// Check file size
		if ($_FILES["photo"]["size"] > 500000) {
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			// if everything is ok, try to upload file
		} else {

			if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
				$image = wp_get_image_editor($target_file);
				if ( ! is_wp_error( $image ) ) {


					$file = $target_file;

					// copy($imageUrl, $file);

					// Create attachment
					$wp_filetype = wp_check_filetype(basename($file), null);
					$attachment = array(
						'guid' => $upload_dir['url'] .
						DIRECTORY_SEPARATOR . basename($file),
						'post_mime_type' => $wp_filetype['type'],
						'post_title' => preg_replace('/\.[^.]+$/', '', basename($file)),
						'post_content' => '',
						'post_status' => 'inherit'
					);
					$attach_id = wp_insert_attachment($attachment, $file);
					$attach_data = wp_generate_attachment_metadata($attach_id, $file);
					wp_update_attachment_metadata($attach_id, $attach_data);

					// Attach avatar to user
					delete_metadata('post', null, '_wp_attachment_wp_user_avatar',
					$current_user->ID, true);
					update_user_meta($current_user->ID, '_wp_attachment_wp_user_avatar', $attach_id);
					update_user_meta($current_user->ID,
					$wpdb->get_blog_prefix(get_current_blog_id()) . 'user_avatar', $attach_id);

				}

			}
		}
	}

	if ( !empty( $_POST['first-name'] ) )
	update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
	if ( !empty( $_POST['last-name'] ) )
	update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
	if ( !empty( $_POST['description'] ) )
	update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );

	/* Redirect so the page will show updated info.*/
	/*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
	// if ( count($error) == 0 ) {
	// 	//action hook for plugins and extra fields saving
	// 	do_action('edit_user_profile_update', $current_user->ID);
	// 	wp_redirect( site_url('accounts'));
	// 	exit;
	// }
}

if(!empty($_GET['status'])){
	if($_GET['status']=='payment_success'){
		global $current_user,$wp_roles;

		$issubscriber = null;
		if(!empty($current_user->roles)){
			$issubscriber = array_intersect($current_user->roles, [
				'free-account',
				'premium-account',
				'premium-unpaid-account',
				'regular-account',
				'regular-unpaid-account',
			]);

			if(count($issubscriber)){
				$issubscriber = array_values($issubscriber)[0];
			}
		}
		if($issubscriber && in_array($issubscriber,[
			'premium-unpaid-account',
			])):
			$current_user->remove_role('premium-unpaid-account');
			$current_user->add_role('premium-account');
			?>
			<script>window.location.assign('<?=site_url('accounts')?>')</script>
			<?php
		endif;


		if($issubscriber && in_array($issubscriber,[
			'regular-unpaid-account',
			])):
			$current_user->remove_role('regular-unpaid-account');
			$current_user->add_role('regular-account');
			?>
			<script>window.location.assign('<?=site_url('accounts')?>')</script>
			<?php
		endif;
	}
}

get_header();

?>
<section>
	<div class="container">

		<!-- RIGHT -->
		<div class="col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4 margin-bottom-80">
			<?php

			$issubscriber = null;
			if(!empty($current_user->roles)){
				$issubscriber = array_intersect($current_user->roles, [
					'free-account',
					'premium-account',
					'premium-unpaid-account',
					'regular-account',
					'regular-unpaid-account',
				]);

				if(count($issubscriber)){
					$issubscriber = array_values($issubscriber)[0];
				}
			}

			if($issubscriber && in_array($issubscriber,[
				'premium-unpaid-account',
				'regular-unpaid-account'
				])): ?>
				<div class="callout alert alert-border margin-top-0 margin-bottom-10">
					<div class="row">
						<div class="col-md-8 col-sm-8"><!-- left text -->
							<h4>Welcome to Market MasterClass</h4>
							<p class="font-lato size-17">
								You are currently subscribed to <strong><?=$wp_roles->roles[$issubscriber]['name']?></strong><br>
								<small>We need to settle your account to complete the registration</small>
							</p>
						</div><!-- /left text -->
						<div class="col-md-4 col-sm-4 text-right"><!-- right btn -->
							<a class="btn btn-block btn-social btn-vimeo" href="<?=site_url('accounts/payment')?>">
								<i class="fa fa-paypal"></i> Complete Payment
							</a>
						</div><!-- /right btn -->
					</div>

				</div>
			<?php endif; ?>

			<ul class="nav nav-tabs nav-top-border">
				<li class="active"><a href="#questionaire" data-toggle="tab">Welcome</a></li>
				<li><a href="#info" data-toggle="tab">Account Preferences</a></li>
				<li><a href="#fave" data-toggle="tab">Favorites</a></li>
			</ul>

			<div class="tab-content margin-top-20">
				<div class="tab-pane fade in active" id="questionaire">
					<div class="row">

						<div class="col-xs-12">
						<style>
						div.video-js{
							margin: 0 auto;
							display: block;
						}
						</style>
						<?php
						$autoplay = get_user_meta( get_current_user_id() , 'play_intro',true);
						if(empty($autoplay) && $autoplay!=0){
							update_user_meta(get_current_user_id(), 'play_intro', 0);
							$autoplay = 1;
						}else{
							$autoplay = 0;
						}
						?>
						<div class="embed-responsive embed-responsive-16by9">
							<iframe class="embed-responsive-item" width="100%" height="100%" src="//www.youtube.com/v/FYHfl0iFWXg?autoplay=<?=($autoplay ? '1' : '0')?>&amp;controls=1&amp;modestbranding=1&amp;rel=0&amp;vq=hd720" frameborder="0" allowfullscreen=""></iframe>
						</div>
						<!--
						<link href="http://vjs.zencdn.net/5.11.6/video-js.css" rel="stylesheet">
						<script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>

						<video id="my-video" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" width="689" height="388" data-setup='{ "controls": true, "autoplay": <?=($autoplay ? 'true' : 'false')?>, "preload": "auto" }'>
						<source src="http://www.marketmasterclass.com/cdn/mmc-welcome-member.mp4" type='video/mp4'>
						<p class="vjs-no-js">
						To view this video please enable JavaScript, and consider upgrading to a web browser that
						<a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
					</p>
				</video>
				<script src="http://vjs.zencdn.net/5.11.6/video.js"></script> -->
				<hr />
			</div>
		</div>

		<div class="row">

			<div class="col-md-4 col-sm-4">

				<div class="price-clean">
					<h5 style="color:#1d1d1d;">INVESTOR<br>ASSESSMENT<br>QUESTIONNAIRE</h5>
					<hr />
					<?php
					$_found = $wpdb->get_results('SELECT * FROM '.TBL_ASSESSMENT_RESULTS.' WHERE email = "'.$current_user->user_email.'" ORDER BY date_added DESC LIMIT 1');

					?>
					<p><?php if(!empty($_found)):
						$_found = $_found[0];
						if($_found && $_found->curset>3):
							$s = $_found->scores;
							switch ($s) {
								case $s<=60:
								echo 'You are a <b>very-conservative</b> risk taker. <small>Based on your results last '.date('D M j , g:i a',strtotime($_found->date_added)).'</small>';
								break;
								case $s<=80:
								echo 'You are a <b>cautiously-moderate</b> risk taker. <small>Based on your results last '.date('D M j , g:i a',strtotime($_found->date_added)).'</small>';
								break;
								case $s<=100:
								echo 'You are a <b>reserved risk taker</b>. <small>Based on your results last '.date('D M j , g:i a',strtotime($_found->date_added)).'</small>';
								break;
								case $s<=120:
								echo 'You are a <b>passive-aggressive</b> risk taker. <small>Based on your results last '.date('D M j , g:i a',strtotime($_found->date_added)).'</small>';
								break;
								case $s<=140:
								echo 'You are a <b>moderately-aggressive</b> risk taker. <small>Based on your results last '.date('D M j , g:i a',strtotime($_found->date_added)).'</small>';
								break;
								case $s<=160:
								default:
								echo 'You are a <b>highly-aggressive</b> risk taker. <small>Based on your results last '.date('D M j , g:i a',strtotime($_found->date_added)).'</small>';
								break;
							}
						endif;
					else: ?> Discover what kind of investor you are by taking our <strong>Investor Assessment Questionnaire</strong>.<?php endif; ?></p>
					<hr />
					<?php if($_found && $_found->curset>3): ?>
						<a href="http://assessment.marketmasterclass.com/"  target="_blank" class="btn btn-3d btn-primary">Take the test again</a>
					<?php else: ?>
						<a href="http://assessment.marketmasterclass.com/"  target="_blank" class="btn btn-3d btn-primary">Take the test now</a>
					<?php endif;?>
				</div>

			</div>

			<div class="col-md-4 col-sm-4">
				<div class="price-clean price-clean-popular">
					<h5 style="color:#1d1d1d;">INVESTMENT<br>OBJECTIVE<br>QUESTIONNAIRE</h5>
					<hr />
					<?php
					$_found = $wpdb->get_results('SELECT * FROM '.TBL_OBJECTIVE_RESULTS.' WHERE email = "'.$current_user->user_email.'" ORDER BY date_added DESC LIMIT 1');

					?>
					<p><?php if(!empty($_found)):
						$_found = $_found[0];
						if($_found && $_found->curset>3):
							$s = $_found->scores;
							switch ($s) {
								case $s<=35:
								echo 'You are an investor with <b>Short Term</b> horizons. <small>Based on your results last '.date('D M j , g:i a',strtotime($_found->date_added)).'</small>';
								break;
								case $s<=54:
								echo 'You are an investor with <b>Short Term</b> horizons. <small>Based on your results last '.date('D M j , g:i a',strtotime($_found->date_added)).'</small>';
								break;
								case $s<=70:
								default:
								echo 'You are an investor with <b>Short Term</b> horizons. <small>Based on your results last '.date('D M j , g:i a',strtotime($_found->date_added)).'</small>';
								break;
							}
						endif;
					else: ?> Discover what kind of investor you are by taking our <strong>Investment Objective Questionnaire</strong>.<?php endif; ?></p>
					<hr />
					<a href="http://objective.marketmasterclass.com/"  target="_blank" class="btn btn-3d btn-teal">Take the test now</a>
				</div>

			</div>

			<div class="col-md-4 col-sm-4">

				<div class="price-clean">
					<div class="ribbon">
						<div class="ribbon-inner" style="font-size: 8px;">COMING SOON</div>
					</div>
					<h5 style="color:#1d1d1d;">DEMO<br>TRADING<br>ACCOUNT</h5>
					<hr />
					<p>For individuals looking for something simple to get started.</p>
					<hr />
					<a href="#" class="btn btn-3d btn-teal disabled">Coming Soon</a>
				</div>

			</div>

		</div>

	</div>
	<!-- PERSONAL INFO TAB -->
	<div class="tab-pane fade" id="info">

		<form role="form" name="profile" action="" method="post" enctype="multipart/form-data">
			<?php wp_nonce_field('update-profile_' . $current_user->data->ID) ?>
			<input type="hidden" name="from" value="profile" />
			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="checkuser_id" value="<?=$current_user->data->ID?>" />
			<input type="hidden" name="dashboard_url" value="<?php echo get_option("dashboard_url"); ?>" />
			<input type="hidden" name="user_id" id="user_id" value="<?=$current_user->data->ID?>" />
			<div class="row">
				<div class="form-group">
					<div class="col-md-12">
						<label>
							Profile Photo
							<small class="text-muted"></small>
						</label>

						<div class="fancy-file-upload">
							<i class="fa fa-upload"></i>
							<input type="file" class="form-control" name="photo" onchange="jQuery(this).next('input').val(this.value);" />
							<input type="text" class="form-control" placeholder="Max file size: 2Mb (jpg/png)" readonly="" />
							<span class="button">Select an image</span>
						</div>

					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label">First Name</label>
				<input type="text" id="first_name" name="first_name" class="form-control" value="<?=$current_user->first_name?>">
			</div>
			<div class="form-group">
				<label class="control-label">Last Name</label>
				<input type="text" id="last_name" name="last_name" class="form-control" value="<?=$current_user->last_name?>">
			</div>
			<div class="form-group">
				<label class="control-label">Email Address</label>
				<input type="email" id="email_address" name="email_address" class="form-control disabled" readonly value="<?=$current_user->user_email?>">
			</div>

			<div class="margiv-top10">
				<button class="btn btn-primary" type="submit">Save Changes </button>
				<a href="#" class="btn btn-default">Cancel </a>
			</div>

		</form>
	</div>

	<div id="fave" class="tab-pane fade">
		<div class="heading-title heading-dotted text-left margin-top-20 ">
			<h4>Followed<span> News</span></h4>
		</div>
		<?php

		$pref = get_user_meta(get_current_user_id(),'preferred_news',true) ?: [];
		$category_tags = [ [ 'id' => 7, 'link' => '/tag/asia/', 'name' => 'Asia', 'slug' => 'asia', 'stock' => true, ], [ 'id' => 21, 'link' => '/tag/banking-finance/', 'name' => 'Banking/Finance', 'slug' => 'banking-finance', ], [ 'id' => 19, 'link' => '/tag/bonds/', 'name' => 'Bonds', 'slug' => 'bonds', 'stock' => true, ], [ 'id' => 16, 'link' => '/tag/commodities/', 'name' => 'Commodities', 'slug' => 'commodities', 'stock' => true, ], [ 'id' => 14, 'link' => '/tag/construction/', 'name' => 'Construction', 'slug' => 'construction', ], [ 'id' => 22, 'link' => '/tag/consumer-goods/', 'name' => 'Consumer Goods', 'slug' => 'consumer-goods', ], [ 'id' => 8, 'link' => '/tag/currencies/', 'name' => 'Currencies', 'slug' => 'currencies', 'stock' => true, ], [ 'id' => 15, 'link' => '/tag/energy/', 'name' => 'Energy', 'slug' => 'energy', ], [ 'id' => 25, 'link' => '/tag/etfs/', 'name' => 'ETF&apos;s', 'slug' => 'etfs', 'stock' => true, ], [ 'id' => 3, 'link' => '/tag/europe/', 'name' => 'Europe', 'slug' => 'europe', 'stock' => true, ], [ 'id' => 13, 'link' => '/tag/funds/', 'name' => 'Funds', 'slug' => 'funds', ], [ 'id' => 26, 'link' => '/tag/industrial-goods/', 'name' => 'Industrial Goods', 'slug' => 'industrial-goods', ], [ 'id' => 17, 'link' => '/tag/manufacturing/', 'name' => 'Manufacturing', 'slug' => 'manufacturing', ], [ 'id' => 24, 'link' => '/tag/media/', 'name' => 'Media', 'slug' => 'media', ], [ 'id' => 12, 'link' => '/tag/mining/', 'name' => 'Mining', 'slug' => 'mining', ], [ 'id' => 18, 'link' => '/tag/pharmaceuticals/', 'name' => 'Pharmaceuticals', 'slug' => 'pharmaceuticals', ], [ 'id' => 4, 'link' => '/tag/pre-markets/', 'name' => 'Pre-Markets', 'slug' => 'pre-markets', 'stock' => true, ], [ 'id' => 10, 'link' => '/tag/real-estate/', 'name' => 'Real Estate', 'slug' => 'real-estate', ], [ 'id' => 23, 'link' => '/tag/retail/', 'name' => 'Retail', 'slug' => 'retail', ], [ 'id' => 5, 'link' => '/tag/stocks/', 'name' => 'Stocks', 'slug' => 'stocks', 'stock' => true, ], [ 'id' => 20, 'link' => '/tag/technology/', 'name' => 'Technology', 'slug' => 'technology', ], [ 'id' => 11, 'link' => '/tag/travel/', 'name' => 'Travel', 'slug' => 'travel', ], [ 'id' => 6, 'link' => '/tag/usa/', 'name' => 'USA', 'slug' => 'usa', 'stock' => true, ], ];
		?>
		<h5 class="margin-bottom-10">Preferred Categories: <small class="text-muted"> Click on the categories you like then click save. </small></h5>
		<div class="text-left news-category-labels margin-top-10 margin-bottom-10">
			<?php
			foreach ($category_tags as $cat) {
				?>
				<a href="<?=(NEWSBASEURL . ltrim($cat['link'],'/'))?>" data-tag="<?=$cat['id']?>" class="news-category-link <?=(in_array($cat['id'],$pref) ? 'active' : '')?>"><span class="badge badge-green"><?=($cat['name'])?></span></a>
				<?php
			}
			?>
		</div>

		<p class="block">
			<button class="btn btn-primary btn-xs pull-right btn-save-preferences">Save Preferences</button>
		</p>
		<div class="clearfix"></div>
		<div class="row">


			<?php
			// if(!empty($pref)){
			if(empty($pref)){
				$pref = [];
			}else{
				$pref = implode(',',$pref);
			}

			$mainpost = $post;
			$per_page = 6;
			$tags =['dm-visit-news'];
			$categories = 2;
			$page = 1;

			$posts = json_decode(file_get_contents_curl(add_query_arg([
				'page' => $page,
				'categories' => $categories,
				'per_page' => $per_page,
				'tags' => $pref,
				'include' => implode(',',array_unique(array_column($visitnews,'i'))),
			], NEWSBASEURL . 'wp-json/wp/v2/posts')));

			if(count($posts)):
				?>
				<?php
				foreach($posts as $post):
					?>
					<div class="col-sm-4">
						<a href="<?=$post->link?>">
							<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=$post->post_thumbnail->{'mid-image'}[0]?>');background-size: cover;background-repeat: no-repeat;height: 150px;"></figure>
						</a>
						<h4 class="margin-top-20 size-14 weight-700 uppercase height-50" style="overflow:hidden;"><a href="<?=$post->link?>"><?=xyr_smarty_limit_chars($post->title->rendered,80)?></a></h4>
						<p class="text-justify height-100" style="overflow:hidden;"><?=trim_text($post->content->rendered,180)?></p>
						<ul class="text-left size-12 list-inline list-separator">
							<li>
								<i class="fa fa-calendar"></i>
								<?=date('F j, Y',strtotime($post->date))?>&nbsp;<small><?=date('h:i a',strtotime($post->date))?></small>
							</li>
						</ul>
					</div>
					<?php
				endforeach;
			endif;
			$post = $mainpost;
			wp_reset_postdata();
			// }
			?>
		</div>
		<div class="row">
			<?php
			if(!empty($_COOKIE['dm-visit-news'])){
				$visitnews = json_decode(stripslashes($_COOKIE['dm-visit-news']),true);
				$visitnews = array_reverse($visitnews);
				$mainpost = $post;
				$per_page = 12;
				$tags =null;
				$categories = 2;
				$page = 1;

				$posts = json_decode(file_get_contents_curl(add_query_arg([
					'page' => $page,
					'categories' => $categories,
					'per_page' => $per_page,
					'include' => implode(',',array_unique(array_column($visitnews,'i')))
				], NEWSBASEURL . 'wp-json/wp/v2/posts')));

				if(count($posts)):
					?>
					<div class="heading-title heading-dotted text-left margin-top-20 ">
						<h4>Recently Viewed<span> News</span></h4>
					</div>
					<?php
					foreach($posts as $post):
						?>
						<div class="col-sm-4">
							<a href="<?=$post->link?>">
								<figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=$post->post_thumbnail->{'mid-image'}[0]?>');background-size: cover;background-repeat: no-repeat;height: 150px;"></figure>
							</a>
							<h4 class="margin-top-20 size-14 weight-700 uppercase height-50" style="overflow:hidden;"><a href="<?=$post->link?>"><?=xyr_smarty_limit_chars($post->title->rendered,80)?></a></h4>
							<p class="text-justify height-100" style="overflow:hidden;"><?=trim_text($post->content->rendered,180)?></p>
							<ul class="text-left size-12 list-inline list-separator">
								<li>
									<i class="fa fa-calendar"></i>
									<?=date('F j, Y',strtotime($post->date))?>&nbsp;<small><?=date('h:i a',strtotime($post->date))?></small>
								</li>
							</ul>
						</div>
						<?php
					endforeach;
				endif;
				$post = $mainpost;
				wp_reset_postdata();
			}
			?>
		</div>
	</div>
	<!-- /PERSONAL INFO TAB -->

	<!-- AVATAR TAB -->

	<!-- /AVATAR TAB -->

	<!-- PASSWORD TAB -->
	<div class="tab-pane fade" id="password">

		<form action="#" method="post">

			<div class="form-group">
				<label class="control-label">Current Password</label>
				<input type="password" class="form-control">
			</div>
			<div class="form-group">
				<label class="control-label">New Password</label>
				<input type="password" class="form-control">
			</div>
			<div class="form-group">
				<label class="control-label">Re-type New Password</label>
				<input type="password" class="form-control">
			</div>

			<div class="margiv-top10">
				<a href="#" class="btn btn-primary"><i class="fa fa-check"></i> Change Password</a>
				<a href="#" class="btn btn-default">Cancel </a>
			</div>

		</form>

	</div>
	<!-- /PASSWORD TAB -->

</div>
</div>

<!-- LEFT -->
<div class="col-lg-3 col-md-3 col-sm-4 col-lg-pull-9 col-md-pull-9 col-sm-pull-8">
	<div class="thumbnail text-center">
		<?php

		$profileid = get_user_meta($current_user->ID,'_wp_attachment_wp_user_avatar',true);
		if(!empty($profileid)){
			$imgsrc = wp_get_attachment_image_src((int)$profileid,'ratio-image-crop');
			if(!empty($imgsrc[0])):
				?>
				<img src="<?=$imgsrc[0]?>" width="245" height="245" alt="" class="avatar avatar-245 wp-user-avatar wp-user-avatar-245 photo avatar-default">
				<?php
			else:
				echo get_avatar( $current_user->data->ID, 245 );
			endif;
		}else{
			echo get_avatar( $current_user->data->ID, 245 );
		}
		?>
		<h2 class="size-18 margin-top-10 margin-bottom-0"><?=$current_user->data->display_name?></h2>
		<h3 class="size-11 margin-top-0 margin-bottom-10 text-muted"><?=strtoupper($current_user->roles[0])?></h3>
		<?php

		if(!empty($current_user->roles)){
			$issubscriber = array_intersect($current_user->roles, [
				'free-account',
				'premium-account',
				'premium-unpaid-account',
				'regular-account',
				'regular-unpaid-account',
			]);

			if(count($issubscriber)){
				$issubscriber = array_values($issubscriber)[0];
				echo '<h3 class="size-11 margin-top-0 margin-bottom-10 text-muted">' . $wp_roles->roles[$issubscriber]['name'] . '</h3>';
			}
		}

		?>

	</div>
</div>

</div>
</section>
<script>
jQuery(function($){
	$('.news-category-link').click(function(e){
		e.preventDefault();
		$(this).toggleClass('active');
	});
	$('.btn-save-preferences').click(function(e){
		e.preventDefault();
		var tags = [];
		$('.news-category-labels').find('.active').each(function(){
			tags.push($(this).data('tag'));
		});
		$(this).text('Saving...');
		$(this).addClass('disabled');
		$.post('<?=admin_url("admin-ajax.php")?>',{
			action : "save_user_preferences",
			tags : tags,
		},function(data){
			window.location.reload();
		});
	});

	// Variable to store your files
	var files;

	// Add events
	$('input[type=file]').on('change', prepareUpload);

	// Grab the files and set them to our variable
	function prepareUpload(event)
	{
		files = event.target.files;
	}


});
</script>
<?

get_footer();
