<?php

/**
* Topics Loop
*
* @package bbPress
* @subpackage Theme
*/

?>

<?php do_action( 'bbp_template_before_topics_loop' ); ?>

<table id="bbp-forum-<?php bbp_forum_id(); ?>" class="table table-vertical-middle margin-bottom-60 bbp-topics">
	<thead>
		<tr class="size-15 text-uppercase">
			<th class="weight-400"><?php _e( 'Topic', 'bbpress' ); ?></th>
			<th class="text-center hidden-xs width-100 weight-300"><?php _e( 'Voices', 'bbpress' ); ?></th>
			<th class="text-center hidden-xs width-100 weight-300"><?php bbp_show_lead_topic() ? _e( 'Replies', 'bbpress' ) : _e( 'Posts', 'bbpress' ); ?></th>
			<th class="text-center hidden-xs width-200 weight-300"><?php _e( 'Freshness', 'bbpress' ); ?></th>
		</tr>
	</thead>
	<tbody class="bbp-body">

		<?php while ( bbp_topics() ) : bbp_the_topic(); ?>

			<?php bbp_get_template_part( 'loop', 'single-topic' ); ?>

		<?php endwhile; ?>

	</tbody>
</table>
<!-- #bbp-forum-<?php bbp_forum_id(); ?> -->

<?php do_action( 'bbp_template_after_topics_loop' ); ?>

<div class="clearfix margin-bottom-60">
	<span class="pull-right size-11 hidden-xs">
		Viewing 5 topics - 1 through 5 (of 5 total)
	</span>
	<a href="#" class="btn btn-default">CREATE NEW TOPIC</a>
</div>
