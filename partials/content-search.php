<?php

$post_types_default = [
    'casino_review',
    'game_review',
    'post',
];

$valid_types = [
    'game' => 'game_review',
    'casino' => 'casino_review',
];

$valid_categories = [
    'news' => 'news'
];

$post_cat_default = [];

$filter = 'Everything';
if(empty($_GET['type']) && empty($_GET['category'])):
    $filter = 'Everything';
    $post_type = $post_types_default;
    $category = [];
endif;
if(!empty($_GET['type']) && $_GET['type']==='game'):
    $filter = 'Games';
    $post_type = ['game_review'];
    $category = [];
endif;
if(!empty($_GET['type']) && $_GET['type']==='casino'):
    $filter = 'Casinos';
    $post_type = ['casino_review'];
    $category = [];
endif;
if(!empty($_GET['category']) && $_GET['category']==='news'):
    $filter = 'News';
    $post_type = ['post'];
    $category = ['news'];
endif;

$searchkey = get_query_var('s');
foreach($category as $k => $c){
    $category[$k] = get_cat_ID($c);
}

query_posts([
    's' => $searchkey,
    'numberposts' => 12,
    'posts_per_page' => 12,
    'posts_per_archive_page' => 12,
    'paged' => get_query_var('paged'),
    'post_type' => $post_type,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
    'category' => $category,
    'suppress_filters' => TRUE,
]);

?>
<section class="page-header dark page-header-xs">
    <div class="container">
        <h1>Search Results</h1>
        <?=custom_breadcrumbs()?>
    </div>
</section>

<section class="padding-xs alternate">
    <div class="container">
        <!-- SEARCH -->
        <form method="get" action="/" class="clearfix well well-sm search-big nomargin">
            <div class="input-group">

                <div class="input-group-btn">
                    <button type="button" class="btn btn-default input-lg dropdown-toggle noborder-right" data-toggle="dropdown">
                        <?=$filter?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li <?php if($filter==='Everything'): ?>class="active"<?php endif; ?>>
                            <a href="/search?s=<?php printf(  '%s', $searchkey  ); ?>">Everything</a>
                        </li>
                        <li class="divider"></li>
                        <li <?php if($filter==='Games'): ?>class="active"<?php endif; ?>>
                            <a href="/search?s=<?php printf(  '%s', $searchkey  ); ?>&type=game">Games</a>
                        </li>
                        <li <?php if($filter==='Casinos'): ?>class="active"<?php endif; ?>>
                            <a href="/search?s=<?php printf(  '%s', $searchkey  ); ?>&type=casino">Casino</a>
                        </li>
                        <li <?php if($filter==='News'): ?>class="active"<?php endif; ?>>
                            <a href="/search?s=<?php printf(  '%s', $searchkey  ); ?>&category=news">News</a>
                        </li>
                    </ul>
                </div>

                <input name="s" class="form-control input-lg" type="text" placeholder="Search..." value="<?php printf(  '%s', $searchkey  ); ?>">
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-default input-lg noborder-left">
                        <i class="fa fa-search fa-lg nopadding"></i>
                    </button>
                </div>
            </div>

        </form>
        <!-- /SEARCH -->

        <h6 class="nomargin text-muted size-11">
            <?php $found = $wp_query->found_posts; ?>
            <?php if($found<1):?>
                Showing 0 Results
            <?php elseif($found>1):?>
                Showing about <?=number_format($found,0)?> results
            <?php else:?>
                Showing only <?=number_format($found,0)?> result
            <?php endif;?>

        </h6>

    </div>
</section>
<section>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php if(have_posts()): ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="clearfix search-result"><!-- item -->
                            <h4 class="margin-bottom-0"><a href="<?=(the_permalink())?>"><?=($post->post_title)?></a></h4>
                            <small class="text-muted"><?php
                            $postType = get_post_type();
                            if(in_array($postType,['game_review','casino_review'])){
                                $postTypeObject = get_post_type_object($postType);
                                ?>
                                <a href="<?=get_post_type_archive_link($postTypeObject->name)?>"><?=$postTypeObject->labels->singular_name?></a>
                                <?php

                            }else{
                                ?>
                                <a href="#">Articles</a>
                                <?php
                            }
                            ?>
                            <?php
                            if(in_array($postType,['game_review'])){
                                $categories = get_the_terms($post->ID,'game_category');
                                if(count($categories)){
                                    echo ' | ';
                                    foreach ($categories as $k => $c) {
                                        ?>
                                        <a href="<?=get_category_link($c->term_id)?>"><?=$c->name?></a>
                                        <?php
                                    }
                                }
                            }
                            else{
                                $categories = get_the_category();
                                if(count($categories)){
                                    echo ' | ';
                                    foreach($categories as $c){
                                        ?>
                                        <a href="<?=get_category_link($c->term_id)?>"><?=$c->name?></a>
                                        <?php
                                    }
                                }
                            }
                            ?></small>
                            <?=(the_post_thumbnail('mini-ratio-image'))?>
                            <p><?=(wp_trim_words( $post->post_content , "40", "... <a href='".get_permalink( $post->ID )."'>Read More</a>" ))?></p>
                        </div>
                    <?php endwhile; wp_reset_query(); ?>
                <?php else:?>
                    <h4>No results found for "<?php printf(  '%s', $searchkey  ); ?>"</h4>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <hr />
                <?=posts_pagination()?>
            </div>
        </div>
    </div>
</section>
