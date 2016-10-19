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
<!-- <div class="side-nav-head">
    <h4>RECENT TWEETS</h4>
</div>
<ul class="widget-twitter" data-php="<?=get_template_directory_uri();?>/php/twitter/tweet.php" data-username="MyMarketMaster" data-limit="3">
    <li></li>
</ul> -->
<a class="twitter-timeline" data-height="400" data-dnt="true" data-link-color="#1ab05d" href="https://twitter.com/MyMarketMaster">Tweets by MyMarketMaster</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<hr>
<iframe class="hidden-xs hidden-sm noborder" src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fmarketmasterclasscom-1657855544470731%2F&tabs=timeline&width=263&height=400&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" height="400" style="width:100%; height:400px;border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
