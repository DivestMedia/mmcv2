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
<div class="side-nav-head">
    <h4>RECENT TWEETS</h4>
</div>
<ul class="widget-twitter" data-php="<?=get_template_directory_uri();?>/php/twitter/tweet.php" data-username="MyMarketMaster" data-limit="3">
    <li></li>
</ul>
<hr>
<iframe class="hidden-xs noborder" height="258px" src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FMarket-MasterClass-1657855544470731&width=263&height=258&colorscheme=light&show_faces=true&header=false&stream=false&show_border=false" style="width:263px; height:258px;">
</iframe>
