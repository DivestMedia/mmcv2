<?php

function backstage_smarty_setup() {
    add_image_size( 'main-image', 600, 400, true ); // Hard Crop Mode
    add_image_size( 'mid-image', 450, 300, true ); // Hard Crop Mode
    add_image_size( 'thumb-image', 150, 99, true ); // Hard Crop Mode
    add_image_size( 'horizontal-image',500,200, true ); // Hard Crop Mode
    add_image_size( 'ratio-image',400,400, false ); // Hard Crop False
    add_image_size( 'tiny-image',50,50, true ); // Hard Crop False
    add_image_size( 'mid-ratio-image',400,800, false ); // Hard Crop False - poster
    add_image_size( 'mini-ratio-image',100,100, true ); // Hard Crop False
    add_theme_support('post-thumbnails');
}
add_action( 'after_setup_theme', 'backstage_smarty_setup' );

function backstage_smarty_scripts() {

    // THEME MAIN CSS;
    wp_enqueue_script( 'mmc-smarty-main-js', get_stylesheet_directory_uri() . '/assets/mmc.js',['jquery'],null,true);
    wp_enqueue_script( 'mmc-smarty-main-js-mobile', get_stylesheet_directory_uri() . '/assets/jquery.browser.mobile.js',['jquery'],null,true);
    wp_enqueue_style( 'mmc-smarty-main-css', get_stylesheet_directory_uri() . '/assets/mmc.css');
    //

}
add_action( 'wp_enqueue_scripts', 'backstage_smarty_scripts' );

function xyrthumb_columns_css(){
    echo '
    <style>
    .column-featured_image{width:150px;}
    </style>
    ';

}
add_action( 'admin_head' , 'xyrthumb_columns_css' );

function xyrthumb_columns( $columns ) {

    $new_columns = array('cb' => '<input type="checkbox" />', 'featured_image' => 'Image');
    return array_merge($new_columns, $columns);
}
add_filter('manage_posts_columns' , 'xyrthumb_columns');

function xyrthumb_columns_data( $column, $post_id ) {
    switch ( $column ) {
        case 'featured_image':
        echo the_post_thumbnail( 'thumb-image' );
        break;
    }
}
add_action( 'manage_posts_custom_column' , 'xyrthumb_columns_data', 10, 2 );

function get_category_tags($id) {
    global $wpdb;
    $tags = $wpdb->get_results
    ("
    SELECT DISTINCT
    terms2.term_id as ID,
    terms2.name as name,
    t2.count as count
    FROM
    $wpdb->posts as p1
    LEFT JOIN $wpdb->term_relationships as r1 ON p1.ID = r1.object_ID
    LEFT JOIN $wpdb->term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
    LEFT JOIN $wpdb->terms as terms1 ON t1.term_id = terms1.term_id,

    $wpdb->posts as p2
    LEFT JOIN $wpdb->term_relationships as r2 ON p2.ID = r2.object_ID
    LEFT JOIN $wpdb->term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
    LEFT JOIN $wpdb->terms as terms2 ON t2.term_id = terms2.term_id
    WHERE (
    t1.taxonomy = 'category' AND
    p1.post_status = 'publish' AND
    terms1.term_id = '$id' AND
    t2.taxonomy = 'post_tag' AND
    p2.post_status = 'publish' AND
    p1.ID = p2.ID
    )
    ORDER BY name ASC
    ");
    $count = 0;
    foreach ($tags as $k => $tag) {
        $tags[$k]->link = get_tag_link($tag->ID);
    }
    return $tags;
}

add_action( 'widgets_init', 'backstage_smarty_widgets_init' );

function backstage_smarty_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Main Sidebar', XYR_SMARTY),
        'id' => 'sidebar-single',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', XYR_SMARTY ),
        'before_widget' => '<div id="%1$s" class="row widget %2$s"><div class="col-sm-12 col-md-12 col-lg-12">',
        'after_widget'  => '</div></div>',
        'before_title'  => '',
        'after_title'   => '',
    ));
}
