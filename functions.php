<?php



include_once( get_stylesheet_directory() .'/_inc/stocks.class.php');

add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) );



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
add_action( 'wp_enqueue_scripts', 'backstage_smarty_scripts' ,11);

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
    terms2.slug as slug,
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
    register_sidebar( array(
        'name' => __( 'Ads Sidebar', XYR_SMARTY),
        'id' => 'sidebar-ads',
        'description' => __( 'Widgets in this area will be shown on the right most side of single pages.', XYR_SMARTY ),
        'before_widget' => '<div id="%1$s" class="row widget %2$s"><div class="col-sm-12 col-md-12 col-lg-12">',
        'after_widget'  => '</div></div>',
        'before_title'  => '',
        'after_title'   => '',
    ));
}



function posts_pagination() {
    global $wp_query,$query_string;
    $big = 999999999;
    $pages = paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?page=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_next' => false,
        'type' => 'array',
        'prev_next' => TRUE,
        'prev_text' => '&larr; Prev',
        'next_text' => 'Next &rarr;',
    ));


    if (is_array($pages)) {
        $current_page = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        echo '<ul class="pagination">';
        foreach ($pages as $i => $page) {
            if ($current_page == 1 && $i == 0) {
                echo "<li class='active'>$page</li>";
            } else {
                if ($current_page != 1 && $current_page == $i) {
                    echo "<li class='active'>$page</li>";
                } else {
                    echo "<li>$page</li>";
                }
            }
        }
        echo '</ul>';
    }
}


function pre_get_vid_post_type($query) {

    if ( !is_admin() && $query->is_main_query() && is_tax('iod_category')) {
        $query->set('post_type', array( 'iod_video') );
    }
    if ( !is_admin() && $query->is_main_query() && is_post_type_archive('iod_video')) {
        $query->set('post_type', array( 'iod_video') );
    }
}

add_action('pre_get_posts','pre_get_vid_post_type');

class custom_xyren_smarty_walker_nav_menu extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }



    // add main/sub classes to li's and links
    //  function start_el( &$output, $item, $depth, $args ) {
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

        // depth dependent classes
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );




        $active = $item->current ? ' active' : '';

        // passed classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // build html
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . ' '. $active .'">';

        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

        $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
        if( !empty($children )){
            $attributes .= ' class="dropdown-toggle"';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '#';
        }else{
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
        }

        if(!is_array($args)){
            $args = (array)$args;
        }

        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
        $args['before'],
        $attributes,
        $args['link_before'],
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args['link_after'],
        $args['after']
    );

    // build html
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}
}

//filter to add description after forums titles on forum index
function topicindex_singleforum_description() {
    echo '<div class="bbp-forum-content size-13 margin-left-0 margin-top-40 margin-bottom-40">';
    echo bbp_forum_content();
    echo '</div>';
}
add_action( 'bbp_template_before_topics_index' , 'topicindex_singleforum_description');


function render_side_bar_widget(){
    ?>
    <hr>
    <div class="side-nav-head">
        <h4>RANDOM QUOTES</h4>
    </div>
    <blockquote class="quote">
        <?php echo do_shortcode('[quotcoll limit="1" orderby="random"]')?>
    </blockquote>
    <hr>
    <?php
    if(is_active_sidebar('sidebar-single'))
    dynamic_sidebar('sidebar-single');
    ?>
    <div class="side-nav-head">
        <h4>RECENT TWEETS</h4>
    </div>
    <ul class="widget-twitter" data-php="<?=get_template_directory_uri();?>/php/twitter/tweet.php" data-username="MyMarketMaster" data-limit="3">
        <li></li>
    </ul>
    <hr>
    <iframe class="hidden-xs noborder" height="258px;"
    src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FMarket-MasterClass-1657855544470731&width=263&height=258&colorscheme=light&show_faces=true&header=false&stream=false&show_border=false"
    width:263px; height:258px;">
</iframe>
<?php
}


/**
* trims text to a space then adds ellipses if desired
* @param string $input text to trim
* @param int $length in characters to trim to
* @param bool $ellipses if ellipses (...) are to be added
* @param bool $strip_html if html tags are to be stripped
* @return string
*/
function trim_text($input, $length, $ellipses = true, $strip_html = true) {


    //strip tags, if desired
    if ($strip_html) {
        $input = strip_tags($input);
    }

    //trim whitespace
    $input = preg_replace('/\s+/', ' ', $input);

    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }

    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);

    //add ellipses (...)
    if ($ellipses) {
        $trimmed_text .= '...';
    }

    return $trimmed_text;
}
