<?php

/**
* Replies Loop - Single Reply
*
* @package bbPress
* @subpackage Theme
*/

?>

<div id="post-<?php bbp_reply_id(); ?>" class="">

	<div class="bbp-meta">



	</div><!-- .bbp-meta -->

</div><!-- #post-<?php bbp_reply_id(); ?> -->

<div <?php bbp_reply_class(); ?>>

	<div class="comments margin-top-20">
		<div class="comment-item nomargin margin-left-20 ">

			<span class="user-avatar width-100 height-100">

				<?php do_action( 'bbp_theme_before_reply_author_details' ); ?>

				<?php bbp_reply_author_link( array( 'type' => 'avatar', 'size' => 100 ,'show_role' => false , 'class' => 'pull-left media-object') ); ?>

				<?php if ( bbp_is_user_keymaster() ) : ?>

					<?php do_action( 'bbp_theme_before_reply_author_admin_details' ); ?>

					<div class="bbp-reply-ip text-center"><?php bbp_author_ip( bbp_get_reply_id() ); ?></div>

					<?php do_action( 'bbp_theme_after_reply_author_admin_details' ); ?>

				<?php endif; ?>

				<?php do_action( 'bbp_theme_after_reply_author_details' ); ?>

			</span><!-- .bbp-reply-author -->

			<div class="media-body">
				<?php if ( bbp_is_single_user_replies() ) : ?>

					<span class="pull-right">
						<?php _e( 'in reply to: ', 'bbpress' ); ?>
						<a class="bbp-topic-permalink comment-reply" href="<?php bbp_topic_permalink( bbp_get_reply_topic_id() ); ?>"><?php bbp_topic_title( bbp_get_reply_topic_id() ); ?></a>
					</span>

				<?php endif; ?>

				<a href="<?php bbp_reply_url(); ?>" class="bbp-reply-permalink comment-reply">#<?php bbp_reply_id(); ?></a>


				<h4 class="media-heading bold"><?php bbp_reply_author_link( array( 'type' => 'name', 'show_role' => false ) ); ?></h4>
				<small class="block"><?php bbp_reply_post_date(); ?></small>
				<?php do_action( 'bbp_theme_before_reply_content' ); ?>

				<?php bbp_reply_content(); ?>

				<?php do_action( 'bbp_theme_after_reply_content' ); ?>
				<?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>

				<?php bbp_reply_admin_links(); ?>

				<?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>

			</div><!-- .bbp-reply-content -->
		</div>
	</div>

</div><!-- .reply -->
