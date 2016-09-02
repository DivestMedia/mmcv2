<?php
get_template_part( 'partials/content', 'indexwatch' );
?>


<section class="upcoming-ipos">
    <div class="container">

        <div class="row">
            <div class="col-md-9 col-sm-9">
                <header class="text-left margin-bottom-10">
                    <h3 class="font-proxima uppercase">Upcoming <span>IPO's</span></h3>
                    <p>
                        If you want to stay ahead of the game, you need to know what will happen before it happens. So, here at Market Masterclass, we’re committed to providing you with a list of the most important IPO’s for the month ahead.
                    </p>
                </header>
                <div class="row">

                    <?php
                    $thisMonthsIPO =  get_posts([
                        'posts_per_page'   => -1,
                        'category_name'    => 'IPO August 2016',
                        'orderby'          => 'date',
                        'order'            => 'DESC',
                        'post_type'        => 'post',
                        'post_status'      => 'publish',
                        'suppress_filters' => true,
                    ]);

                    if(count($thisMonthsIPO)):
                        foreach ($thisMonthsIPO as $ipo):
                            ?>
                            <div class="col-md-4 margin-bottom-20">
                                <div class="box-flip box-icon box-icon-center box-icon-round box-icon-large text-center">
                                    <div class="front">
                                        <div class="box1">
                                            <div class="box-icon-title">
                                                <?=get_the_post_thumbnail($ipo->ID,'ratio-image',[
        											'class' => 'img-responsive'
        											])?>
                                                <h2><?=($ipo->post_title)?></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="back">
                                        <div class="box2">
                                            <?=($ipo->post_content)?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 text-left">
                <!-- CATEGORIES -->
                <div class="side-nav margin-bottom-60">

                    <div class="side-nav-head">
                        <button class="fa fa-bars"></button>
                        <h4>CATEGORIES</h4>
                    </div>
                    <?php if(in_category(['news'])):?>
                        <ul class="list-group list-group-bordered list-group-noicon uppercase">
                            <?php
                            $category_tags = get_category_tags(get_category_by_slug('news')->term_id);
                            ?>
                            <?php foreach ($category_tags as $key => $tag):?>
                                <li class="list-group-item">
                                    <a href="<?=($tag->link)?>" class="tag-<?=($tag->ID)?>" data-id="<?=($tag->ID)?>">
                                        <span class="size-11 text-muted pull-right">(<?=(int)($tag->count)?>)</span>
                                        <?=strtoupper($tag->name)?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <ul class="list-group list-group-bordered list-group-noicon uppercase">

                            <li class="list-group-item active">
                                <a class="dropdown-toggle" href="#">GLOBAL</a>
                                <ul>
                                    <li><a href="#"><span class="size-11 text-muted pull-right">(123)</span> Shoes & Boots</a></li>
                                    <li class="active"><a href="#"><span class="size-11 text-muted pull-right">(331)</span> Top & Blouses</a></li>
                                    <li><a href="#"><span class="size-11 text-muted pull-right">(234)</span> Dresses & Skirts</a></li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <a class="dropdown-toggle" href="#">SPORTS</a>
                                <ul>
                                    <li><a href="#"><span class="size-11 text-muted pull-right">(88)</span> Accessories</a></li>
                                    <li><a href="#"><span class="size-11 text-muted pull-right">(67)</span> Shoes & Boots</a></li>
                                    <li><a href="#"><span class="size-11 text-muted pull-right">(32)</span> Dresses & Skirts</a></li>
                                    <li class="active"><a href="#"><span class="size-11 text-muted pull-right">(78)</span> Top & Blouses</a></li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <a class="dropdown-toggle" href="#">DUMMIES GUIDE</a>
                            </li>
                            <li class="list-group-item">
                                <a class="dropdown-toggle" href="#">BUSINESS</a>
                                <ul>
                                    <li><a href="#"><span class="size-11 text-muted pull-right">(88)</span> Shoes & Boots</a></li>
                                    <li><a href="#"><span class="size-11 text-muted pull-right">(22)</span> Dresses & Skirts</a></li>
                                    <li><a href="#"><span class="size-11 text-muted pull-right">(31)</span> Accessories</a></li>
                                    <li class="active"><a href="#"><span class="size-11 text-muted pull-right">(18)</span> Top & Blouses</a></li>
                                </ul>
                            </li>
                            <li class="list-group-item"><a href="#"><span class="size-11 text-muted pull-right">(189)</span> NEWS</a></li>
                            <li class="list-group-item"><a href="#"><span class="size-11 text-muted pull-right">(61)</span> VIDEOS</a></li>

                        </ul>
                    <?php endif; ?>
                </div>
                <!-- /CATEGORIES -->

                <?php
                if(is_active_sidebar('sidebar-single'))
                dynamic_sidebar('sidebar-single');
                ?>
            </div>
        </div>
    </div>
</section>
