



<h4 class="page-header size-20 margin-bottom-20 margin-top-20">
    <?php
    global $post;
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
        ?>
        <p class="no-comments"><?php _e( 'Comments are closed', XYR_SMARTY ); ?></p>
    <?php endif; ?>

    <?php if ('open' == $post->comment_status) : ?>

        <?php comment_form_title( 'Don&apos;t Agree? <strong><i>Leave your comment</i></strong>', 'LEAVE REPLY TO <span>%s</span>' ); ?>
    <?php else: ?>
        <?php // _e( 'Comments are closed', XYR_SMARTY ); ?>
    <?php endif; ?>
</h4>


<?php if ('open' == $post->comment_status) : ?>

    <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <p>You must be <a href="<?php echo site_url(); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>

    <?php else : ?>

        <!-- Form -->
        <form action="/wp-comments-post.php" method="post" id="commentform">

            <div class="row">


                <div class="form-group">

                    <?php if ( $user_ID ) : ?>
                        <div class="col-md-12">
                            <label>LOGGED AS </label>
                            <h3 class="nomargin"><span><?php echo $user_identity; ?></span></h3>
                            <a href="<?php echo wp_logout_url(get_permalink()); ?>" class="btn btn-sm btn-reveal btn-blue" title="Log out of this account">
                                <i class="fa fa-sign-out"></i>
                                <span>LOGOUT ACCOUNT</span>
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="col-md-6">
                            <label>NAME</label>
                            <input required="required" type="text" value="<?php echo $comment_author; ?>" maxlength="100" class="form-control input-lg" name="author" id="author">
                        </div>
                        <div class="col-md-6">
                            <label>EMAIL (will not be published) </label>
                            <input required="required" type="email" value="<?php echo $comment_author_email; ?>" maxlength="100" class="form-control input-lg" name="email" id="contact_email">
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php comment_id_fields(); ?>

            <?php do_action('comment_form', $post->ID); ?>

            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label>COMMENT</label>
                        <textarea required="required" maxlength="5000" rows="5" class="form-control" name="comment" id="comment"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="g-recaptcha" data-sitekey="6LfC6REUAAAAACFIBeOOTMKuqM5k_RiZxIfq7zRg" data-callback="checkCaptcha"></div>
                    <script>
                    var checkCaptcha = function(response){
                        console.log(response);
                        var submitbtn = document.getElementById('comment-submit-btn');
                        submitbtn.disabled = false;
                    }
                    </script>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <button id="comment-submit-btn" class="btn btn-3d btn-lg btn-reveal btn-black" type="submit" disabled>
                        <i class="fa fa-check"></i>
                        <span>SUBMIT MESSAGE</span>
                    </button>

                </div>
            </div>

        </form>
        <!-- /Form -->

        <?php cancel_comment_reply_link(); ?>


    <?php endif; // If registration required and not logged in ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
<?php endif; // if you delete this the sky will fall on your head ?>
