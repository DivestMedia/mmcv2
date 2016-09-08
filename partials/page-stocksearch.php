<?php
get_template_part( 'partials/content', 'indexwatch' );
?>


<section>
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <header class="text-left margin-bottom-10">
                    <h3 class="font-proxima uppercase">Stock <span>Search</span></h3>
                    <p>
                        We pick some stocks which may be worth having a look at, and we track their progress. It’s that simple. The rest is up to you…
                    </p>
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
                        "hideideas": true,
                        "tradeItWidget": true
                    });
                })(jQuery);
                </script>
                <!-- TradingView Widget END -->
            </div>
        </div>
    </div>
</section>
