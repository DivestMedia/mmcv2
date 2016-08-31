<?php
get_header();

global $post;
$post_slug=$post->post_name;
get_template_part("partials/page", locate_template('partials/page-'.$post_slug.'.php')!='' ?$post_slug : '' );
get_footer();			

