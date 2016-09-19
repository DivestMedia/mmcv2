<?php
define('NEWSBASEURL','http://news.marketmasterclass.com/');


include_once( get_stylesheet_directory() .'/_inc/stocks.class.php');
include_once( get_stylesheet_directory() .'/_inc/getmenu.php');
$GetMenu = New GetMenu();
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
    get_template_part( 'partials/content', 'sidebar-widget' );
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

add_action( 'json_api', function( $controller, $method )
{
    # DEBUG
// wp_die( "To target only this method use <pre><code>add_action('$controller-$method', function(){ /*YOUR-STUFF*/ });</code></pre>" );

header( "Access-Control-Allow-Origin: *" );
}, 10, 2 );


function file_get_contents_curl($url){

    $ch = curl_init();

    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Linux; Android 6.0.1; MotoG3 Build/MPI24.107-55) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.81 Mobile Safari/537.36");
    // Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL,$url);
    // Execute
    $result=curl_exec($ch);
    // Closing
    curl_close($ch);

    return $result;
}


// WP API

add_action( 'rest_api_init', 'slug_register_post_thumbnail' );
function slug_register_post_thumbnail() {
    register_rest_field( 'post',
    'post_thumbnail',
    array(
        'get_callback'    => 'slug_get_post_thumbnail',
        'update_callback' => null,
        'schema'          => null,
    )
);
register_rest_field( 'post',
'post_tags',
array(
    'get_callback'    => 'slug_get_post_tags',
    'update_callback' => null,
    'schema'          => null,
)
);
}

/**
* Get the value of the "starship" field
*
* @param array $object Details of current post.
* @param string $field_name Name of field.
* @param WP_REST_Request $request Current request
*
* @return mixed
*/

function pickdefaultimage($tag){
    switch ($tag) {
        case 'real-estate':
        $newimgsrc = [
            '/wp-content/uploads/2016/09/ei.marketwatch.comMultimedia20160510PhotosZHMW-EM390_roofto_20160510093609_ZH-cf2792d26d887ed37889f6b4e15b816cefb25830.jpg',
            '/wp-content/uploads/2016/09/real-estate-news-1.jpg',
            '/wp-content/uploads/2016/09/real-estate-news-2.jpg',
            '/wp-content/uploads/2016/09/real-estate-news-3.jpg',
            '/wp-content/uploads/2016/09/real-estate-news-4.jpg',
            '/wp-content/uploads/2016/09/real-estate-5.jpg',
            '/wp-content/uploads/2016/09/real-estate-6.jpg',
            '/wp-content/uploads/2016/09/real-estate-7.jpg',
            '/wp-content/uploads/2016/09/real-estate-8.jpg',
            '/wp-content/uploads/2016/09/real-estate-9.jpg',
            '/wp-content/uploads/2016/09/real-estate-10.jpg',
            '/wp-content/uploads/2016/09/real-estate-11.jpg',
            '/wp-content/uploads/2016/09/gen-news-1.jpg',
            '/wp-content/uploads/2016/09/gen-news-2.jpg',
            '/wp-content/uploads/2016/09/gen-news-3.jpg',
            '/wp-content/uploads/2016/09/gen-news-4.jpg',
            '/wp-content/uploads/2016/09/gen-news-5.jpg',
            '/wp-content/uploads/2016/09/gen-news-6.jpg',
            '/wp-content/uploads/2016/09/gen-news-7.jpg',
            '/wp-content/uploads/2016/09/gen-news-8.jpg',
            '/wp-content/uploads/2016/09/gen-news-9.jpg',
            '/wp-content/uploads/2016/09/gen-news-10.jpg',
            '/wp-content/uploads/2016/09/gen-news-11.jpg'
        ];
        break;
        case 'banking-finance':
        case 'stocks':
        $newimgsrc = [
            '/wp-content/uploads/2016/09/glocdn.investing.comtrkd-imagesLYNXNPEC3S1CP_L-1391d561df4fd8ca7c1ac0a9be36cc1690d251db.jpg',
            '/wp-content/uploads/2016/09/Banking-and-Finance-banner.jpg',
            '/wp-content/uploads/2016/09/banking-finance-insurance.jpg',
            '/wp-content/uploads/2016/09/Finance-Bank.jpg',
            '/wp-content/uploads/2016/09/pakistan-s-islamic-banking-push-faces-industry-gaps-1413296787-9951.jpg',
            '/wp-content/uploads/2016/09/bankingfinance_5.jpg',
            '/wp-content/uploads/2016/09/bankingfinance_3.jpg',
            '/wp-content/uploads/2016/09/bankingfinance_2.jpg',
            '/wp-content/uploads/2016/09/bankingfinance_1.jpg',
            '/wp-content/uploads/2016/09/bankingfinance_6.jpg',
            '/wp-content/uploads/2016/09/bankingfinance_7.jpg',
            '/wp-content/uploads/2016/09/bankingfinance_8.jpg',
            '/wp-content/uploads/2016/09/bankingfinance_9.jpg',
            '/wp-content/uploads/2016/09/bankingfinance_10.jpg',
            '/wp-content/uploads/2016/09/bankingfinance_11.jpg',
            '/wp-content/uploads/2016/09/gen-news-8.jpg',
            '/wp-content/uploads/2016/09/gen-news-9.jpg',
            '/wp-content/uploads/2016/09/gen-news-10.jpg',
            '/wp-content/uploads/2016/09/gen-news-11.jpg',
            '/wp-content/uploads/2016/09/gen-news-12.jpg',
            '/wp-content/uploads/2016/09/gen-news-13.jpg',
            '/wp-content/uploads/2016/09/gen-news-14.jpg',
            '/wp-content/uploads/2016/09/gen-news-15.jpg',
            '/wp-content/uploads/2016/09/gen-news-16.jpg'
        ];
        break;
        case 'construction':
        $newimgsrc = [
            '/wp-content/uploads/2016/09/ei.marketwatch.comMultimedia20141230PhotosMGMW-DC458_morton_20141230161657_MG-646c06ceed097bbcea9357e607583e0e9e14dff8.jpg',
            '/wp-content/uploads/2016/09/construction-news-1.jpg',
            '/wp-content/uploads/2016/09/construction-news-2.jpg',
            '/wp-content/uploads/2016/09/construction-news-3.jpg',
            '/wp-content/uploads/2016/09/construction-news-4.jpg',
            '/wp-content/uploads/2016/09/construction_10.jpg',
            '/wp-content/uploads/2016/09/construction_6.jpg',
            '/wp-content/uploads/2016/09/construction_7.jpg',
            '/wp-content/uploads/2016/09/construction_8.jpg',
            '/wp-content/uploads/2016/09/construction_9.jpg',
            '/wp-content/uploads/2016/09/construction_10.jpg',
            '/wp-content/uploads/2016/09/construction_11.jpg',
            '/wp-content/uploads/2016/09/construction_12.jpg',
            '/wp-content/uploads/2016/09/construction_13.jpg',
            '/wp-content/uploads/2016/09/gen-news-8.jpg',
            '/wp-content/uploads/2016/09/gen-news-9.jpg',
            '/wp-content/uploads/2016/09/gen-news-10.jpg',
            '/wp-content/uploads/2016/09/gen-news-11.jpg'

        ];
        break;
        case 'consumer':
        case 'consumer-goods':
        $newimgsrc = [
            '/wp-content/uploads/2016/09/consumer-goods-news-1.jpg',
            '/wp-content/uploads/2016/09/consumer-goods-news-3.jpg',
            '/wp-content/uploads/2016/09/consumer-goods-news-4.jpg',
            '/wp-content/uploads/2016/09/consumer-goods-news-5.jpg',
            '/wp-content/uploads/2016/09/consumer-goods-news-6.jpg',
            '/wp-content/uploads/2016/09/consumer-goods-news-7.jpg',
            '/wp-content/uploads/2016/09/consumer-goods-news-8.jpg',
            '/wp-content/uploads/2016/09/consumer-goods-news-9.jpg',
            '/wp-content/uploads/2016/09/consumer-goods-news-10.jpg',
            '/wp-content/uploads/2016/09/consumer-goods-news-11.jpg',
            '/wp-content/uploads/2016/09/consumer-goods-news-12.jpg',
            '/wp-content/uploads/2016/09/gen-news-1.jpg',
            '/wp-content/uploads/2016/09/gen-news-2.jpg',
            '/wp-content/uploads/2016/09/gen-news-3.jpg',
            '/wp-content/uploads/2016/09/gen-news-4.jpg',
            '/wp-content/uploads/2016/09/gen-news-5.jpg',
            '/wp-content/uploads/2016/09/gen-news-6.jpg',
            '/wp-content/uploads/2016/09/gen-news-7.jpg'
        ];
        break;
        case 'energy':
        $newimgsrc = [
            '/wp-content/uploads/2016/09/energy-news-1.jpg',
            '/wp-content/uploads/2016/09/energy-news-2.jpg',
            '/wp-content/uploads/2016/09/energy_7.jpg',
            '/wp-content/uploads/2016/09/energy_6.jpg',
            '/wp-content/uploads/2016/09/energy-news-3.jpg',
            '/wp-content/uploads/2016/09/energy-news-4.jpg',
            '/wp-content/uploads/2016/09/energy-news-5.jpg',
            '/wp-content/uploads/2016/09/energy-news-8.jpg',
            '/wp-content/uploads/2016/09/energy-news-9.jpg',
            '/wp-content/uploads/2016/09/energy-news-10.jpg',
            '/wp-content/uploads/2016/09/energy-news-11.jpg',
            '/wp-content/uploads/2016/09/energy-news-12.jpg',
            '/wp-content/uploads/2016/09/energy-news-13.jpg',
            '/wp-content/uploads/2016/09/gen-news-12.jpg',
            '/wp-content/uploads/2016/09/gen-news-13.jpg',
            '/wp-content/uploads/2016/09/gen-news-14.jpg',
            '/wp-content/uploads/2016/09/gen-news-15.jpg',
            '/wp-content/uploads/2016/09/gen-news-16.jpg'
        ];
        break;
        case 'industrial':
        case 'industrial-goods':
        $newimgsrc = [
            '/wp-content/uploads/2016/09/industrial-goods-news-1.jpg',
            '/wp-content/uploads/2016/09/industrial-goods-news-2.jpg',
            '/wp-content/uploads/2016/09/industrial-goods-news-3.jpg',
            '/wp-content/uploads/2016/09/industrial-goods-news-4.jpg',
            '/wp-content/uploads/2016/09/industrial-goods-news-5.jpg',
            '/wp-content/uploads/2016/09/industrial-goods-news-6.jpg',
            '/wp-content/uploads/2016/09/industrial-goods-news-7.jpg',
            '/wp-content/uploads/2016/09/industrial-goods-news-8.jpg',
            '/wp-content/uploads/2016/09/industrial-goods-news-9.jpg',
            '/wp-content/uploads/2016/09/industrial-goods-news-10.jpg',
            '/wp-content/uploads/2016/09/industrial-goods-news-11.jpg',
            '/wp-content/uploads/2016/09/industrial-goods-news-12.jpg',
            '/wp-content/uploads/2016/09/industrial-goods-news-13.jpg',
            '/wp-content/uploads/2016/09/gen-news-8.jpg',
            '/wp-content/uploads/2016/09/gen-news-9.jpg',
            '/wp-content/uploads/2016/09/gen-news-10.jpg',
            '/wp-content/uploads/2016/09/gen-news-11.jpg'
        ];
        break;
        case 'manufacturing':
        $newimgsrc = [
            '/wp-content/uploads/2016/09/manufacturing-news-1.jpg',
            '/wp-content/uploads/2016/09/manufacturing-news-2.jpg',
            '/wp-content/uploads/2016/09/manufacturing-news-3.jpg',
            '/wp-content/uploads/2016/09/manufacturing-news-4.jpg',
            '/wp-content/uploads/2016/09/manufacturing-news-5.jpg',
            '/wp-content/uploads/2016/09/manufacturing-news-6.jpg',
            '/wp-content/uploads/2016/09/manufacturing-news-7.jpg',
            '/wp-content/uploads/2016/09/manufacturing-news-8.jpg',
            '/wp-content/uploads/2016/09/manufacturing-news-9.jpg',
            '/wp-content/uploads/2016/09/manufacturing-news-10.jpg',
            '/wp-content/uploads/2016/09/manufacturing-news-11.jpg',
            '/wp-content/uploads/2016/09/manufacturing-news-12.jpg',
            '/wp-content/uploads/2016/09/manufacturing-news-13.jpg',
            '/wp-content/uploads/2016/09/gen-news-12.jpg',
            '/wp-content/uploads/2016/09/gen-news-13.jpg',
            '/wp-content/uploads/2016/09/gen-news-14.jpg',
            '/wp-content/uploads/2016/09/gen-news-15.jpg',
            '/wp-content/uploads/2016/09/gen-news-16.jpg'
        ];
        break;
        case 'media':
        $newimgsrc = [
            '/wp-content/uploads/2016/09/media_4.jpg',
            '/wp-content/uploads/2016/09/media_3.jpg',
            '/wp-content/uploads/2016/09/media_2.jpg',
            '/wp-content/uploads/2016/09/media_3.jpg',
            '/wp-content/uploads/2016/09/media_4.jpg',
            '/wp-content/uploads/2016/09/media_5.jpg',
            '/wp-content/uploads/2016/09/media_6.jpg',
            '/wp-content/uploads/2016/09/gen-news-1.jpg',
            '/wp-content/uploads/2016/09/gen-news-2.jpg',
            '/wp-content/uploads/2016/09/gen-news-3.jpg',
            '/wp-content/uploads/2016/09/gen-news-4.jpg',
            '/wp-content/uploads/2016/09/gen-news-5.jpg',
            '/wp-content/uploads/2016/09/gen-news-6.jpg',
            '/wp-content/uploads/2016/09/gen-news-7.jpg',
            '/wp-content/uploads/2016/09/gen-news-12.jpg',
            '/wp-content/uploads/2016/09/gen-news-13.jpg',
            '/wp-content/uploads/2016/09/gen-news-14.jpg',
            '/wp-content/uploads/2016/09/gen-news-15.jpg',
            '/wp-content/uploads/2016/09/gen-news-16.jpg'
        ]; break;
        case 'mining':
        $newimgsrc = [
            '/wp-content/uploads/2016/09/mining-news-1.jpg',
            '/wp-content/uploads/2016/09/mining-news-2.jpg',
            '/wp-content/uploads/2016/09/mining-news-3.jpg',
            '/wp-content/uploads/2016/09/mining-news-4.jpg',
            '/wp-content/uploads/2016/09/mining_5.jpg',
            '/wp-content/uploads/2016/09/mining_7.jpg',
            '/wp-content/uploads/2016/09/mining-news-6.jpg',
            '/wp-content/uploads/2016/09/mining-news-8.jpg',
            '/wp-content/uploads/2016/09/mining-news-9.jpg',
            '/wp-content/uploads/2016/09/mining-news-10.jpg',
            '/wp-content/uploads/2016/09/mining-news-11.jpg',
            '/wp-content/uploads/2016/09/mining-news-12.jpg',
            '/wp-content/uploads/2016/09/mining-news-13.jpg',
            '/wp-content/uploads/2016/09/gen-news-12.jpg',
            '/wp-content/uploads/2016/09/gen-news-13.jpg',
            '/wp-content/uploads/2016/09/gen-news-14.jpg',
            '/wp-content/uploads/2016/09/gen-news-15.jpg',
            '/wp-content/uploads/2016/09/gen-news-16.jpg'
        ];
        break;
        case 'pharmaceutical':
        case 'pharmaceuticals':
        case 'pharmacueticals':
        case 'pharmacueticals-medical':
        $newimgsrc = [
            '/wp-content/uploads/2016/09/medical-news-1.jpg',
            '/wp-content/uploads/2016/09/medical-news-2.jpg',
            '/wp-content/uploads/2016/09/medical-news-3.jpg',
            '/wp-content/uploads/2016/09/medical-news-4.jpg',
            '/wp-content/uploads/2016/09/medical-news-5.jpg',
            '/wp-content/uploads/2016/09/medical-news-6.jpg',
            '/wp-content/uploads/2016/09/medical-news-7.jpg',
            '/wp-content/uploads/2016/09/medical-news-8.jpg',
            '/wp-content/uploads/2016/09/medical-news-9.jpg',
            '/wp-content/uploads/2016/09/medical-news-10.jpg',
            '/wp-content/uploads/2016/09/medical-news-11.jpg',
            '/wp-content/uploads/2016/09/medical-news-12.jpg',
            '/wp-content/uploads/2016/09/gen-news-12.jpg',
            '/wp-content/uploads/2016/09/gen-news-13.jpg',
            '/wp-content/uploads/2016/09/gen-news-14.jpg',
            '/wp-content/uploads/2016/09/gen-news-15.jpg',
            '/wp-content/uploads/2016/09/gen-news-16.jpg'
        ];
        break;
        case 'retail':
        $newimgsrc = [
            '/wp-content/uploads/2016/09/retail-news-1.jpg',
            '/wp-content/uploads/2016/09/retail-news-2.jpg',
            '/wp-content/uploads/2016/09/retail-news-3.jpg',
            '/wp-content/uploads/2016/09/retail-news-4.jpg',
            '/wp-content/uploads/2016/09/retail-news-5.jpg',
            '/wp-content/uploads/2016/09/retail-news-6.jpg',
            '/wp-content/uploads/2016/09/retail-news-7.jpg',
            '/wp-content/uploads/2016/09/retail-news-8.jpg',
            '/wp-content/uploads/2016/09/retail-news-9.jpg',
            '/wp-content/uploads/2016/09/retail-news-10.jpg',
            '/wp-content/uploads/2016/09/retail-news-11.jpg',
            '/wp-content/uploads/2016/09/retail-news-12.jpg',
            '/wp-content/uploads/2016/09/retail-news-13.jpg',
            '/wp-content/uploads/2016/09/gen-news-12.jpg',
            '/wp-content/uploads/2016/09/gen-news-13.jpg',
            '/wp-content/uploads/2016/09/gen-news-14.jpg',
            '/wp-content/uploads/2016/09/gen-news-15.jpg',
            '/wp-content/uploads/2016/09/gen-news-16.jpg'
        ];
        break;
        case 'technology':
        $newimgsrc = [
            '/wp-content/uploads/2016/09/technology-news-1.jpg',
            '/wp-content/uploads/2016/09/technology-news-2.jpg',
            '/wp-content/uploads/2016/09/technology-news-3.jpg',
            '/wp-content/uploads/2016/09/techonology_4.jpg',
            '/wp-content/uploads/2016/09/techonology_5.jpg',
            '/wp-content/uploads/2016/09/technology-news-6.jpg',
            '/wp-content/uploads/2016/09/technology-news-7.jpg',
            '/wp-content/uploads/2016/09/technology-news-8.jpg',
            '/wp-content/uploads/2016/09/technology-news-9.jpg',
            '/wp-content/uploads/2016/09/technology-news-10.jpg',
            '/wp-content/uploads/2016/09/technology-news-11.jpg',
            '/wp-content/uploads/2016/09/technology-news-12.jpg',
            '/wp-content/uploads/2016/09/technology-news-13.jpg',
            '/wp-content/uploads/2016/09/gen-news-8.jpg',
            '/wp-content/uploads/2016/09/gen-news-9.jpg',
            '/wp-content/uploads/2016/09/gen-news-10.jpg',
            '/wp-content/uploads/2016/09/gen-news-11.jpg'
        ];
        break;
        case 'travel':
        $newimgsrc = [
            '/wp-content/uploads/2016/09/travel-news-1.jpg',
            '/wp-content/uploads/2016/09/travel-news-2.jpg',
            '/wp-content/uploads/2016/09/travel-news-3.jpg',
            '/wp-content/uploads/2016/09/travel-news-4.jpg',
            '/wp-content/uploads/2016/09/travel-news-5.jpg',
            '/wp-content/uploads/2016/09/travel-news-6.jpg',
            '/wp-content/uploads/2016/09/travel-news-7.jpg',
            '/wp-content/uploads/2016/09/travel-news-8.jpg',
            '/wp-content/uploads/2016/09/travel-news-9.jpg',
            '/wp-content/uploads/2016/09/gen-news-1.jpg',
            '/wp-content/uploads/2016/09/gen-news-2.jpg',
            '/wp-content/uploads/2016/09/gen-news-3.jpg',
            '/wp-content/uploads/2016/09/gen-news-4.jpg',
            '/wp-content/uploads/2016/09/gen-news-5.jpg',
            '/wp-content/uploads/2016/09/gen-news-6.jpg',
            '/wp-content/uploads/2016/09/gen-news-7.jpg',
            '/wp-content/uploads/2016/09/gen-news-8.jpg',
            '/wp-content/uploads/2016/09/gen-news-9.jpg',
            '/wp-content/uploads/2016/09/gen-news-10.jpg',
            '/wp-content/uploads/2016/09/gen-news-11.jpg'
        ];
        break;
        default:
        $newimgsrc = [
            '/wp-content/uploads/2016/09/www.newsoracle.comwp-contentuploads201509how-to-buy-stocks-e8ba2c93ea77c74045ee9d6badfe17c688654767.jpg',
            '/wp-content/uploads/2016/09/www.newsoracle.comwp-contentuploads201509Stock-Investment-1-4c260dbd76e9480e0d12c9c11d882f6c3a9f43e0.jpg',
            '/wp-content/uploads/2016/09/glocdn.investing.comnewsWarsWarsaw-Stock-Exchange_800x533_L_1430991033-dae82efb6283addfa779cad83ad60f22338685a5.jpg',
            '/wp-content/uploads/2016/09/stock-market-1.jpg',
            '/wp-content/uploads/2016/09/stock-market-2.jpg',
            '/wp-content/uploads/2016/09/glocdn.investing.comnewsLYNXNPEB7A004_L-55a0d1b38df4279dbc302f3d57dc3ef9c9925239.jpg',
            '/wp-content/uploads/2016/09/WideModern_StockMarketChart_062613-e1462847698711.jpg',
            '/wp-content/uploads/2016/09/glocdn.investing.comnewsBrazil-Stock-Market_1_309X149._800x533_L_1413121146-896630eb895cfa2c8e6ca0df38eeef72301215f9.jpg',
            '/wp-content/uploads/2016/09/gen-news-1.jpg',
            '/wp-content/uploads/2016/09/gen-news-2.jpg',
            '/wp-content/uploads/2016/09/gen-news-3.jpg',
            '/wp-content/uploads/2016/09/gen-news-4.jpg',
            '/wp-content/uploads/2016/09/gen-news-5.jpg',
            '/wp-content/uploads/2016/09/gen-news-6.jpg',
            '/wp-content/uploads/2016/09/gen-news-7.jpg',
            '/wp-content/uploads/2016/09/gen-news-8.jpg',
            '/wp-content/uploads/2016/09/gen-news-9.jpg',
            '/wp-content/uploads/2016/09/gen-news-10.jpg',
            '/wp-content/uploads/2016/09/gen-news-11.jpg',
            '/wp-content/uploads/2016/09/gen-news-12.jpg',
            '/wp-content/uploads/2016/09/gen-news-13.jpg',
            '/wp-content/uploads/2016/09/gen-news-14.jpg',
            '/wp-content/uploads/2016/09/gen-news-15.jpg',
            '/wp-content/uploads/2016/09/gen-news-16.jpg',
            '/wp-content/uploads/2016/09/gen-news-17.jpg',
            '/wp-content/uploads/2016/09/gen-news-18.jpg',
            '/wp-content/uploads/2016/09/gen-news-19.jpg'
        ];
        break;
    }


    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    return $newimgsrc[array_rand($newimgsrc)];
}

function slug_get_post_thumbnail( $post, $field_name, $request ) {
    $imagesizes = get_intermediate_image_sizes();
    $imagesrc = [];
    foreach ($imagesizes as $size) {
        $imagesrc[$size] = wp_get_attachment_image_src($post['featured_media'],$size);
    }

    if(empty($imagesrc['mid-image']) || checkIfDefaultFileName($imagesrc['mid-image'][0])){
        $tags = get_the_tags($post['id']);
        $tag = 'default';
        if(!empty($tags)){
            $tag = $tags[array_rand($tags)]->slug;
        }

        $imagefile = pickdefaultimage($tag);
        $imagepath = 'http://news.marketmasterclass.com' . $imagefile;
        // $imagepath = ABSPATH . $imagefile;
        $imageurl = site_url($imagefile);
        list($width, $height) = getimagesize($imagepath);
        $imagesrc['mid-image'] = [$imageurl,$width,$height,true];
    }

    return $imagesrc;
}

function slug_get_post_tags( $post, $field_name, $request ) {
    return get_the_tags($post['id']);
}


function in_array_strpos($word, $array){
    foreach($array as $a){
        if (strpos($word,$a) !== false) {
            return true;
        }
    }
    return false;
}

function checkIfDefaultFileName($url){
    $fnd = 0;
    $terms = [
        'comrssmarketwatch',
        'invlogosinv',
        'ft-news',
        'Default_Image',
        'vc_gitem_image',
        'moneycontrol_logo',
        'cms-59',
        'v2imagesreuters',
        'default',
        'bbc_news_logo',
        'cnnmoney_logo',
        'rcom-default',
        'mw_logo_social',
        '6325547',
    ];
    if(in_array_strpos($url,$terms)){
        $fnd++;
    }
    return $fnd;
}
