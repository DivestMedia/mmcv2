<?php

global $post;
get_header();
get_template_part( 'partials/content', 'slider' );
get_template_part( 'partials/content', 'indexwatch' );

get_template_part( 'partials/content', 'featuredvideos' );

get_template_part( 'partials/content', 'featuredarticles' );
get_template_part( 'partials/content', 'juicyextras' );
get_template_part( 'partials/content', 'globalnews' );
get_template_part( 'partials/content', 'investordivest' );
get_template_part( 'partials/content', 'subscription' );

get_footer();
