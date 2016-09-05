<?php

/**
* Topics Loop - Single
*
* @package bbPress
* @subpackage Theme
*/

?>

<tr id="bbp-topic-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>
	<td>
		<h4 class="nomargin size-16">

			<?php if ( bbp_is_user_home() ) : ?>

				<?php if ( bbp_is_favorites() ) : ?>

					<span class="bbp-row-actions">

						<?php do_action( 'bbp_theme_before_topic_favorites_action' ); ?>

						<?php bbp_topic_favorite_link( array( 'before' => '', 'favorite' => '+', 'favorited' => '&times;' ) ); ?>

						<?php do_action( 'bbp_theme_after_topic_favorites_action' ); ?>

					</span>

				<?php elseif ( bbp_is_subscriptions() ) : ?>

					<span class="bbp-row-actions">

						<?php do_action( 'bbp_theme_before_topic_subscription_action' ); ?>

						<?php bbp_topic_subscription_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>

						<?php do_action( 'bbp_theme_after_topic_subscription_action' ); ?>

					</span>

				<?php endif; ?>

			<?php endif; ?>

			<?php do_action( 'bbp_theme_before_topic_title' ); ?>

			<a href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a>

			<?php do_action( 'bbp_theme_after_topic_title' ); ?>

			<?php bbp_topic_pagination(); ?>

			<?php do_action( 'bbp_theme_before_topic_meta' ); ?>

			<div class="bbp-topic-meta">

				<?php do_action( 'bbp_theme_before_topic_started_by' ); ?>
				<ul class="list-inline categories nomargin text-muted size-11 hidden-xs">
					<li><?php printf( __( 'Started by: %1$s', 'bbpress' ), bbp_get_topic_author_link( array( 'size' => '14' ) ) ); ?></li>

					<?php do_action( 'bbp_theme_after_topic_started_by' ); ?>

					<?php if ( !bbp_is_single_forum() || ( bbp_get_topic_forum_id() !== bbp_get_forum_id() ) ) : ?>

						<?php do_action( 'bbp_theme_before_topic_started_in' ); ?>

						<li><?php printf( __( 'in: <a href="%1$s">%2$s</a>', 'bbpress' ), bbp_get_forum_permalink( bbp_get_topic_forum_id() ), bbp_get_forum_title( bbp_get_topic_forum_id() ) ); ?></li>

						<?php do_action( 'bbp_theme_after_topic_started_in' ); ?>

					<?php endif; ?>
				</ul>
			</div>

			<?php do_action( 'bbp_theme_after_topic_meta' ); ?>

			<?php bbp_topic_row_actions(); ?>
		</h4>

	</td>
	<td class="text-center hidden-xs">
		<a href="#"><?php bbp_topic_voice_count(); ?></a>
	</td>
	<td class="text-center hidden-xs">
		<a href="#"><?php bbp_show_lead_topic() ? bbp_topic_reply_count() : bbp_topic_post_count(); ?></a>
	</td>
	<td class="hidden-xs text-center">
		<?php do_action( 'bbp_theme_before_topic_freshness_author' ); ?>

		<small class="block size-11 text-muted"><?php bbp_author_link( array( 'post_id' => bbp_get_topic_last_active_id(), 'size' => 14 ) ); ?></small>

		<?php do_action( 'bbp_theme_after_topic_freshness_author' ); ?>

		<div class="size-13">
			<?php do_action( 'bbp_theme_before_topic_freshness_link' ); ?>

			<?php bbp_topic_freshness_link(); ?>

			<?php do_action( 'bbp_theme_after_topic_freshness_link' ); ?>
		</div>

	</td>
</tr>
<!-- #bbp-topic-<?php bbp_topic_id(); ?> -->
