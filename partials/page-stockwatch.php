<?php
get_template_part( 'partials/content', 'indexwatch' );
?>


<section>
    <div class="container">
        <header class="text-left margin-bottom-10">
            <h3 class="font-proxima uppercase">Stock <span>Watch</span></h3>
            <p>
                Charts, graphs, tables, data, and statistics from all the markets from around the world… it’s all here to keep you up to date and allow you to monitor your investments.
            </p>
        </header>

        <div class="row">

            <div class="col-sm-3">
                <!-- TradingView Widget BEGIN -->
                <div id="tv-miniwidget-c0307" class="margin-bottom-20"></div>
                <script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
                <script type="text/javascript">
                new TradingView.MiniWidget({
                    "container_id": "tv-miniwidget-c0307",
                    "tabs": [
                        "Markets"
                    ],
                    "symbols": {
                        "Markets": [
                            "INDEX:INX|1y",
                            "INDEX:VIX|1y",
                            "INDEX:DJY0|1y"
                        ]
                    },
                    "gridLineColor": "rgba(233, 233, 234, 1)",
                    "fontColor": "#83888D",
                    "underLineColor": "rgba(217, 234, 211, 1)",
                    "trendLineColor": "rgba(70, 148, 36, 1)",
                    "activeTickerBackgroundColor": "#EDF0F3",
                    "large_chart_url": "https://www.tradingview.com/chart/",
                    "noGraph": false,
                    "width": "100%",
                    "height": "300px",
                    "locale": "en"
                });
                </script>
                <!-- TradingView Widget END -->
            </div>

            <div class="col-sm-3">
                <!-- TradingView Widget BEGIN -->
                <div id="tv-miniwidget-bfa8c" class="margin-bottom-20"></div>
                <script type="text/javascript">
                new TradingView.MiniWidget({
                    "container_id": "tv-miniwidget-bfa8c",
                    "tabs": [
                        "Stock Indexes"
                    ],
                    "symbols": {
                        "Stock Indexes": [
                            "INDEX:FTSE|1y",
                            "INDEX:NKY|1y",
                            "INDEX:HSI|1y"
                        ]
                    },
                    "gridLineColor": "rgba(233, 233, 234, 1)",
                    "fontColor": "#83888D",
                    "underLineColor": "rgba(217, 234, 211, 1)",
                    "trendLineColor": "rgba(70, 148, 36, 1)",
                    "activeTickerBackgroundColor": "#EDF0F3",
                    "large_chart_url": "https://www.tradingview.com/chart/",
                    "noGraph": false,
                    "width": "100%",
                    "height": "300px",
                    "locale": "en"
                });
                </script>
                <!-- TradingView Widget END -->

            </div>

            <div class="col-sm-3">
                <!-- TradingView Widget BEGIN -->
                <div id="tv-miniwidget-a9eb9" class="margin-bottom-20"></div>
                <script type="text/javascript">
                new TradingView.MiniWidget({
                    "container_id": "tv-miniwidget-a9eb9",
                    "tabs": [
                        "Commodities"
                    ],
                    "symbols": {
                        "Commodities": [
                            "CBOT:QBC1!|1y",
                            "FX:USOIL|1y",
                            "COMEX:GC1!|1y"
                        ]
                    },
                    "gridLineColor": "rgba(233, 233, 234, 1)",
                    "fontColor": "#83888D",
                    "underLineColor": "rgba(217, 234, 211, 1)",
                    "trendLineColor": "rgba(70, 148, 36, 1)",
                    "activeTickerBackgroundColor": "#EDF0F3",
                    "large_chart_url": "https://www.tradingview.com/chart/",
                    "noGraph": false,
                    "width": "100%",
                    "height": "300px",
                    "locale": "en"
                });
                </script>
                <!-- TradingView Widget END -->


            </div>

            <div class="col-sm-3">
                <!-- TradingView Widget BEGIN -->
                <div id="tv-miniwidget-bbb32" class="margin-bottom-20"></div>
                <script type="text/javascript">
                new TradingView.MiniWidget({
                    "container_id": "tv-miniwidget-bbb32",
                    "tabs": [
                        "Currencies"
                    ],
                    "symbols": {
                        "Currencies": [
                            "FX_IDC:USDCAD|1y",
                            "FX_IDC:EURUSD|1y",
                            "FX_IDC:USDJPY|1y"
                        ]
                    },
                    "gridLineColor": "rgba(233, 233, 234, 1)",
                    "fontColor": "#83888D",
                    "underLineColor": "rgba(217, 234, 211, 1)",
                    "trendLineColor": "rgba(70, 148, 36, 1)",
                    "activeTickerBackgroundColor": "#EDF0F3",
                    "large_chart_url": "https://www.tradingview.com/chart/",
                    "noGraph": false,
                    "width": "100%",
                    "height": "300px",
                    "locale": "en"
                });
                </script>
                <!-- TradingView Widget END -->

            </div>
        </div>

    </div>
</section>
<?php

$category_tags = get_category_tags(get_category_by_slug('news')->term_id);

$featuredPostCategories = [];
$featuredPostCategories[] = [
    'id' => 0,
    'name' => 'All News',
    'link' => '/news',
    'active' => true
];

foreach ($category_tags as $key => $cat) {
    if(!in_array($cat->slug,[
        'pre-markets',
        'usa',
        'asia',
        'europe',
        'stocks',
        'commodities',
        'currencies',
        'bonds',
        'funds',
        'etfs'
        ])) continue;
        $featuredPostCategories[] = [
            'id' => $cat->ID,
            'name' => $cat->name,
            'link' => $cat->link,
        ];
    }

    $featuredPostNews =  get_posts([
        'posts_per_page'   => 9,
        'category_name'    => 'News',
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'offset' => 5,
        'suppress_filters' => true,
        'tag_slug__in' => $taghere
    ]);

    foreach ($featuredPostNews as $key => $postNews) {
        $featuredPostNews[$key] = $postNews->ID;
    }

    $featuredPost = [
        'categories' => $featuredPostCategories,
        'posts' => $featuredPostNews
    ];

    $GLOBALS['featuredPost'] = $featuredPost;
    $GLOBALS['featuredTitle'] = 'Related News';

    get_template_part( 'partials/content', 'featuredposts' );

    ?>

    <section>

        <div class="container">



            <div class="row">
                <script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
                <div class="col-sm-4">
                    <!-- TradingView Widget BEGIN -->
                    <div id="tv-miniwidget-e29d6" class="margin-bottom-20"></div>
                    <script type="text/javascript">
                    new TradingView.MiniWidget({
                        "container_id": "tv-miniwidget-e29d6",
                        "tabs": [
                            "AMERICAS MARKETS"
                        ],
                        "symbols": {
                            "AMERICAS MARKETS": [
                                "INDEX:DJY0|1y",
                                // "INDEX:INX|1y",
                                "INDEX:VIX|1y",
                                "INDEX:MXX|1y",
                                "INDEX:BVSP|1y",
                                "INDEX:MERV|1y",
                                // "INDEX:TXSX|1y",
                                // "INDEX:IUX|1y"
                            ]
                        },
                        "gridLineColor": "rgba(233, 233, 234, 1)",
                        "fontColor": "#83888D",
                        "underLineColor": "rgba(217, 234, 211, 1)",
                        "trendLineColor": "rgba(70, 148, 36, 1)",
                        "activeTickerBackgroundColor": "#EDF0F3",
                        "large_chart_url": "https://www.tradingview.com/chart/",
                        "noGraph": false,
                        "width": "100%",
                        "height": "400px",
                        "locale": "en"
                    });
                    </script>
                    <!-- TradingView Widget END -->
                </div>
                <div class="col-sm-4">
                    <!-- TradingView Widget BEGIN -->
                    <div id="tv-miniwidget-748fe" class="margin-bottom-20"></div>
                    <script type="text/javascript">
                    new TradingView.MiniWidget({
                        "container_id": "tv-miniwidget-748fe",
                        "tabs": [
                            "ASIA-PACIFIC MARKETS"
                        ],
                        "symbols": {
                            "ASIA-PACIFIC MARKETS": [
                                "INDEX:NKY|1y",
                                "INDEX:HSI|1y",
                                // "INDEX:AXJO|1y",
                                "INDEX:KSI|1y",
                                "INDEX:STI|1y",
                                "INDEX:XHY0|1y"
                            ]
                        },
                        "gridLineColor": "rgba(233, 233, 234, 1)",
                        "fontColor": "#83888D",
                        "underLineColor": "rgba(217, 234, 211, 1)",
                        "trendLineColor": "rgba(70, 148, 36, 1)",
                        "activeTickerBackgroundColor": "#EDF0F3",
                        "large_chart_url": "https://www.tradingview.com/chart/",
                        "noGraph": false,
                        "width": "100%",
                        "height": "400px",
                        "locale": "en"
                    });
                    </script>
                    <!-- TradingView Widget END -->
                </div>
                <div class="col-sm-4">
                    <!-- TradingView Widget BEGIN -->
                    <div id="tv-miniwidget-51c9b" class="margin-bottom-20"></div>
                    <script type="text/javascript">
                    new TradingView.MiniWidget({
                        "container_id": "tv-miniwidget-51c9b",
                        "tabs": [
                            "EUROPE MARKETS"
                        ],
                        "symbols": {
                            "EUROPE MARKETS": [
                                "INDEX:DAX|1y",
                                "INDEX:FTSE|1y",
                                "INDEX:CAC|1y",
                                "FX:ITA40|1y",
                                "INDEX:OBX|1y"
                            ]
                        },
                        "gridLineColor": "rgba(233, 233, 234, 1)",
                        "fontColor": "#83888D",
                        "underLineColor": "rgba(217, 234, 211, 1)",
                        "trendLineColor": "rgba(70, 148, 36, 1)",
                        "activeTickerBackgroundColor": "#EDF0F3",
                        "large_chart_url": "https://www.tradingview.com/chart/",
                        "noGraph": false,
                        "width": "100%",
                        "height": "400px",
                        "locale": "en"
                    });
                    </script>
                    <!-- TradingView Widget END -->
                </div>
            </div>
        </div>
    </section>
