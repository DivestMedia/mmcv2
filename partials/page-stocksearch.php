<?php
get_template_part( 'partials/content', 'indexwatch' );
?>


<section>
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <header class="text-left margin-bottom-10">
                    <h3 class="font-proxima uppercase">Stock <span>Search</span></h3>

                </header>
                <!-- TradingView Widget BEGIN -->
                <script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>
                <script type="text/javascript">
                (function($) {
                    jQuery.QueryString = (function(a) {
                        if (a == "") return {};
                        var b = {};
                        for (var i = 0; i < a.length; ++i)
                        {
                            var p=a[i].split('=');
                            if (p.length != 2) continue;
                            b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
                        }
                        return b;
                    })(window.location.search.substr(1).split('&'))


                    new TradingView.widget({
                        "width": "100%",
                        "height": 610,
                        "symbol": jQuery.QueryString["tvwidgetsymbol"] || "INDEX:AAPL",
                        "interval": "D",
                        "timezone": "Etc/UTC",
                        "theme": "White",
                        "style": "3",
                        "locale": "en",
                        "toolbar_bg": "#f1f3f6",
                        "allow_symbol_change": true,
                        "save_image": false,
                        "details": true,
                        "hotlist": true,
                        "news": [
                          "headlines"
                        ],
                        "hideideas": true,
                    });

                })(jQuery);
                </script>
                <!-- TradingView Widget END -->
            </div>
            <div class="col-sm-12">
                <?php

                if(!empty($_GET['tvwidgetsymbol'])){

                    $sym = strtolower(trim($_GET['tvwidgetsymbol']));

                    $url = 'http://finance.yahoo.com/webservice/v1/symbols/'.$sym.'/quote?format=json&view=detail';



                    $ch = curl_init();
                    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Linux; Android 6.0.1; MotoG3 Build/MPI24.107-55) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.81 Mobile Safari/537.36");
                    // Disable SSL verification
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    // Will return the response, if false it print the response
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    // Set the url
                    curl_setopt($ch, CURLOPT_URL,$url);
                    // Execute
                    $data=curl_exec($ch);

                    curl_close($ch);

                    if(!empty($data)){

                        $data = json_decode($data);

                        if(!empty($data) && !empty($data->list) && !empty($data->list->resources) && count($data->list->resources)){
                            $keyword = preg_replace("/[^a-zA-Z0-9\s]+/", "", $data->list->resources[0]->resource->fields->issuer_name);
                            $stock_news = json_decode(file_get_contents_curl(add_query_arg([
                                'page' => 1,
                                'filter[s]' => $keyword,
                                'per_page' => 10
                            ], NEWSBASEURL . 'wp-json/wp/v2/posts')));

                            if(!empty($stock_news)):
                                ?>
                                <div class="heading-title heading-dotted text-left margin-top-20 ">
                                    <h4>Related<span> News</span></h4>
                                </div>
                                <div class="owl-carousel owl-padding-10 buttons-autohide controlls-over" data-plugin-options='{"singleItem": false, "items":"3", "autoPlay": 4000, "navigation": true, "pagination": false, "stopOnHover": true }' id="global-news-post-slider">
                                    <?php foreach($stock_news as $post): ?>
                                        <div class="img-hover">
                                            <a href="<?=$post->link?>">

                                                <figure style="border-bottom: 5px solid #1ecd6e;background-image: url('<?=($post->post_thumbnail->{'mid-image'}[0])?>');background-size: cover;background-repeat: no-repeat;height: 200px;" class="lazyOwl" data-src="<?=($post->post_thumbnail->{'mid-image'}[0])?>"></figure>
                                            </a>

                                            <h4 class="text-left margin-top-20 height-50 post-title"><a href="<?=$post->link?>"><?=xyr_smarty_limit_chars($post->title->rendered,80)?></a></h4>
                                            <div class="text-left margin-bottom-10 height-100 post-excerpt"><?=xyr_smarty_limit_chars(strip_tags(html_entity_decode($post->content->rendered)),200)?></div>
                                            <ul class="text-left size-12 list-inline list-separator">
                                                <li class="block">
                                                    <i class="fa fa-calendar"></i>
                                                    <?=date('D M j, Y',strtotime($post->date))?>&nbsp;<small class="pull-right"><?=human_time_diff( strtotime($post->date), current_time('timestamp') ) . " ago"?></small>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <?php
                        }
                    }

                }

                ?>



            </div>
        </div>
    </div>
</section>
