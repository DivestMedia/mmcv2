
<?php
global $current_user, $wp_roles; get_currentuserinfo();
if(empty($current_user->ID))
	wp_redirect(home_url());
/* Load the registration file. */
//require_once( ABSPATH . WPINC . '/registration.php' ); //deprecated since 3.1
$error = array();    
/* If profile was saved, update profile. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

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

    if ( !empty( $_POST['first-name'] ) )
        update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
    if ( !empty( $_POST['last-name'] ) )
        update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
    if ( !empty( $_POST['description'] ) )
        update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );

    /* Redirect so the page will show updated info.*/
  /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
    if ( count($error) == 0 ) {
        //action hook for plugins and extra fields saving
        do_action('edit_user_profile_update', $current_user->ID);
        wp_redirect( get_permalink() );
        exit;
    }
}

get_header();


?>
<section>
				<div class="container">

					<!-- RIGHT -->
					<div class="col-lg-9 col-md-9 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-4 margin-bottom-80">

						<ul class="nav nav-tabs nav-top-border">
							<li class="active"><a href="#info" data-toggle="tab">Personal Info</a></li>
							<li><a href="#avatar" data-toggle="tab">Avatar</a></li>
						</ul>

						<div class="tab-content margin-top-20">

							<!-- PERSONAL INFO TAB -->
							<div class="tab-pane fade in active" id="info">
								<form role="form" name="profile" action="" method="post">
									<?php wp_nonce_field('update-profile_' . $current_user->data->ID) ?>
									<input type="hidden" name="from" value="profile" />
									<input type="hidden" name="action" value="update" />
									<input type="hidden" name="checkuser_id" value="<?=$current_user->data->ID?>" />
									<input type="hidden" name="dashboard_url" value="<?php echo get_option("dashboard_url"); ?>" />
									<input type="hidden" name="user_id" id="user_id" value="<?=$current_user->data->ID?>" />
									<div class="form-group">
										<label class="control-label">First Name</label>
										<input type="text" id="first_name" name="first_name" class="form-control" value="<?=$current_user->first_name?>">
									</div>
									<div class="form-group">
										<label class="control-label">Last Name</label>
										<input type="text" id="last_name" name="last_name" class="form-control" value="<?=$current_user->last_name?>">
									</div>
									<div class="form-group">
										<label class="control-label">Mobile Number</label>
										<input type="text" id="mobile_number" name="mobile_number" class="form-control" value="<?=$current_user->mobile_number?>">
									</div>
									<!-- <div class="form-group">
										<label class="control-label">About</label>
										<textarea class="form-control" rows="3" placeholder="About Me..."></textarea>
									</div> -->
									<!-- <div class="form-group">
										<label class="control-label">Website Url</label>
										<input type="text" placeholder="http://www.yourwebsite.com" class="form-control">
									</div> -->
									<div class="margiv-top10">
										<button href="#" class="btn btn-custom yellow"><i class="fa fa-check"></i> Save Changes </button>
										<a href="#" class="btn btn-default">Cancel </a>
									</div>
								</form>
							</div>
							<!-- /PERSONAL INFO TAB -->

							<!-- AVATAR TAB -->
							<div class="tab-pane fade" id="avatar">

								<form class="clearfix" action="#" method="post" enctype="multipart/form-data">
									<div class="form-group">

										<div class="row">

											<div class="col-md-3 col-sm-4">

												<div class="thumbnail">
													<?=get_avatar( $current_user->data->ID, 245 ); ?>
												</div>

											</div>

											<div class="col-md-9 col-sm-8">

												<div class="sky-form nomargin">
													<label class="label">Select File</label>
													<label for="file" class="input input-file">
														<div class="button">
															<input type="file" id="file" onchange="this.parentNode.nextSibling.value = this.value">Browse
														</div><input type="text" readonly="">
													</label>
												</div>

												<a href="#" class="btn btn-danger btn-xs noradius"><i class="fa fa-times"></i> Remove Avatar</a>

												<div class="clearfix margin-top-20">
													<span class="label label-warning">NOTE! </span>
													<p>
														Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt laoreet!
													</p>
												</div>

											</div>

										</div>

									</div>

									<div class="margiv-top10">
										<a href="#" class="btn btn-primary">Save Changes </a>
										<a href="#" class="btn btn-default">Cancel </a>
									</div>

								</form>

							</div>
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

							<!-- PRIVACY TAB -->
							<div class="tab-pane fade" id="privacy">

								<form action="#" method="post">
									<div class="sky-form">

										<table class="table table-bordered table-striped">
											<tbody>
												<tr>
													<td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</td>
													<td>
														<div class="inline-group">
															<label class="radio nomargin-top nomargin-bottom">
																<input type="radio" name="radioOption" checked=""><i></i> Yes
															</label>

															<label class="radio nomargin-top nomargin-bottom">
																<input type="radio" name="radioOption" checked=""><i></i> No
															</label>
														</div>
													</td>
												</tr>
												<tr>
													<td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</td>
													<td>
														<label class="checkbox nomargin">
															<input type="checkbox" name="checkbox" checked=""><i></i> Yes
														</label>
													</td>
												</tr>
												<tr>
													<td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</td>
													<td>
														<label class="checkbox nomargin">
															<input type="checkbox" name="checkbox" checked=""><i></i> Yes
														</label>
													</td>
												</tr>
												<tr>
													<td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</td>
													<td>
														<label class="checkbox nomargin">
															<input type="checkbox" name="checkbox" checked=""><i></i> Yes
														</label>
													</td>
												</tr>
											</tbody>
										</table>

									</div>

									<div class="margin-top-10">
										<a href="#" class="btn btn-primary"><i class="fa fa-check"></i> Save Changes </a>
										<a href="#" class="btn btn-default">Cancel </a>
									</div>
								</form>
							</div>
							<!-- /PRIVACY TAB -->
						</div>
					</div>
					
					<!-- LEFT -->
					<div class="col-lg-3 col-md-3 col-sm-4 col-lg-pull-9 col-md-pull-9 col-sm-pull-8">
						<div class="thumbnail text-center">
							<?=get_avatar( $current_user->data->ID, 245 ); ?>
							<h2 class="size-18 margin-top-10 margin-bottom-0"><?=$current_user->data->display_name?></h2>
							<h3 class="size-11 margin-top-0 margin-bottom-10 text-muted"><?=strtoupper($current_user->roles[0])?></h3>
						</div>
					</div>
					
				</div>
			</section>

			<?

get_footer();