<?php
get_template_part( 'partials/content', 'indexwatch' );
?>


<section>
    <div class="container">

        <div class="row">
            <div class="col-md-9 col-sm-9">
                <header class="text-left margin-bottom-10">
                    <h3 class="font-proxima uppercase">Stock <span>Focus</span></h3>
                    <p>
                        We pick some stocks which may be worth having a look at, and we track their progress. It’s that simple. The rest is up to you…
                    </p>
                </header>
                <div class="row">

                    <div class="col-sm-12 margin-bottom-20">
                        <!-- TradingView Widget BEGIN -->
                        <div id="tv-medium-widget-3f2f0"></div>
                        <script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
                        <script type="text/javascript">
                        new TradingView.MediumWidget({
                            "container_id": "tv-medium-widget-3f2f0",
                            "symbols": [
                                [
                                  "GoDaddy",
                                  "NYSE:GDDY|1y"
                                ],
                                [
                                  "Philip Morris",
                                  "NYSE:PM|1y"
                                ],
                                [
                                  "Viacom",
                                  "NASDAQ:VIAB|1y"
                                ],
                                [
                                  "General Electric Company ",
                                  "NYSE:GE|1y"
                                ],
                                [
                                  "CBOE Holdings Inc",
                                  "NASDAQ:CBOE|1y"
                                ]
                              ],
                            "gridLineColor": "rgba(233, 233, 234, 1)",
                            "fontColor": "#83888D",
                            "underLineColor": "rgba(217, 234, 211, 1)",
                            "trendLineColor": "rgba(70, 148, 36, 1)",
                            "width": "100%",
                            "height": "500px",
                            "tradeItWidget": true,
                            "locale": "en"
                        });
                        </script>
                        <!-- TradingView Widget END -->
                    </div>
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
