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
                        'category_name'    => 'IPO September 2016',
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

                    
                    <?php if(in_category(['news'])):?>
                        <div class="side-nav-head">
                            <button class="fa fa-bars"></button>
                            <h4>CATEGORIES</h4>
                        </div>
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
                        <?php render_side_bar_widget();?>
                    <?php endif; ?>
                </div>
                <!-- /CATEGORIES -->

            </div>
        </div>
    </div>
</section>
