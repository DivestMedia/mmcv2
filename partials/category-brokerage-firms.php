<?php
get_template_part( 'partials/content', 'indexwatch' );
global $wpdb,$post;
query_posts([
    'posts_per_page' => 12,
    'posts_per_archive_page' => 12,
    'category_name' => 'Brokerage Firms',
    'paged' => get_query_var('paged') ?: 1,
]);
get_template_part( 'partials/content', 'featuredpostsbrokers' );
get_template_part( 'partials/content', 'investordivest' );
?>
