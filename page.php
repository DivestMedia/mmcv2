<?php
global $post;
get_header();
get_template_part("partials/page", locate_template('partials/page-'.basename(get_permalink()).'.php')!='' ? basename(get_permalink()) : '' );
get_footer();
