<?php
global $post;
get_header();
get_template_part("partials/single", locate_template('partials/single-'.get_post_type().'.php')!='' ? get_post_type() : '' );
get_footer();
