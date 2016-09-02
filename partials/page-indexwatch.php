<?php
get_template_part( 'partials/content', 'indexwatch' );
?>


<section>
    <div class="container">

        <div class="row">
            <div class="col-md-9 col-sm-9">
                <header class="text-left margin-bottom-10">
                    <h3 class="font-proxima uppercase">Index <span>Watch</span></h3>
                    <p>
                        When people talk about the “market” it can get confusing since there is not one unified market, but rather a few different indexes showing the different segments of the market. While your investments will not always correspond with market movements, knowing what the market your potential stock belongs to is doing can maybe help you determine whether you should invest or not. If the stock you’re considering buying into is part of the FTSE Index and the Index as a whole is moving up, then that stock has a better chance of showing positive returns. By watching indexes and keeping track of their movements, you can get a good idea of investors’ views towards different companies of different sizes and in different industries.<br><br>

                        We offer you here, at a quick glance, all the major markets from around the world.
                    </p>
                </header>
                <div class="row">

                    <div class="col-sm-12 margin-bottom-20">
                        <h4>NEW YORK STOCK EXCHANGE</h4>
                        <div class="col-sm-4">
                            <?php
                            echo wp_get_attachment_image(348889,'mid-image',false,[
                                'class' => 'img-responsive'
                            ]);
                            ?>
                            <p>This index measures the performance of all the stocks listed on the New York Stock Exchange, including more than 1900 stocks, of which around 1500 are US companies. It’s calculated on the basis of price return and total return (including dividends) and it’s a much better indicator of market performance than narrow indexes that have fewer components.</p>
                        </div>
                        <div class="col-sm-8">
                            <!-- TradingView Widget BEGIN -->
                            <div id="tv-medium-widget-1" class="margin-bottom-20"></div>
                            <script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
                            <script type="text/javascript">
                            new TradingView.MediumWidget({
                                "container_id": "tv-medium-widget-1",
                                "symbols": [
                                    [
                                        "NYSE",
                                        "INDEX:NYA|1y"
                                    ]
                                ],
                                "gridLineColor": "rgba(233, 233, 234, 1)",
                                "fontColor": "#83888D",
                                "underLineColor": "rgba(217, 234, 211, 1)",
                                "trendLineColor": "rgba(70, 148, 36, 1)",
                                "width": "100%",
                                "height": "300px",
                                "tradeItWidget": false,
                                "locale": "en"
                            });
                            </script>
                            <!-- TradingView Widget END -->
                        </div>
                    </div>
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
