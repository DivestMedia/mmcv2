<?php

global $post;
get_header();
get_template_part( 'partials/content', 'slider' );
get_template_part( 'partials/content', 'indexwatch' );

get_template_part( 'partials/content', 'featuredvideos' );

// get_template_part( 'partials/content', 'juicyextras' );
 get_template_part( 'partials/content', 'ads_undervideo' );
get_template_part( 'partials/content', 'news-at-a-glance' );
get_template_part( 'partials/content', 'globalnews' );
get_template_part( 'partials/content', 'ads' );
get_template_part( 'partials/content', 'featuredarticles' );

get_template_part( 'partials/content', 'ads-2' );

get_template_part( 'partials/content', 'investordivest' );
get_template_part( 'partials/content', 'subscription-mini' );
get_template_part( 'partials/content', 'network_logos' );

get_footer();
