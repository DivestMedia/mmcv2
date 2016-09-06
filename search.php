<?php 
  get_header();  
  get_template_part( 'partials/content', 'indexwatch' );
  $_tag = $wp_query->query;
  $paged = empty($paged) ? 1 : $paged; 
  $per_page = get_option('posts_per_page',10);
  $args = array(
    'showposts' => $per_page,
    'post_type'  =>  array('iod_video','post'),
    'paged'      =>  $paged,
  );
  $resultCategory = array_merge((array)$args, (array)$_tag);
  
  query_posts( $resultCategory );
?>
<section class="">
  <div class="container">
    <div class="left-content align-left">
      <div class="row">
          <div class="col-md-9 col-sm-9 col-xs-12">
            <h4><?=number_format(count(get_posts($resultCategory)))?> result/s found for: "<?php printf( __( '%s', 'simply-loud' ), get_search_query()  ); ?>"</h4>
        <?php 
        if(have_posts()):
          while ( have_posts() ) : the_post();
            if(!empty($post->ID)){
              if(!strcasecmp(get_post_type($post->ID),'post')){
                ?>
                <div class="margin-bottom-20 col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-3 col-sm-3 col-xs-12" >
                    <a href="<?=get_the_permalink()?>">
                    <figure style="background-image: url('<?=the_post_thumbnail_url()?>');background-size: cover;background-repeat: no-repeat;height: 150px;"></figure>
                    </a>
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12 cont-episode-details">
                    <a href="<?=get_the_permalink()?>" title="<?=$post->post_title; ?>" class="size-17"><strong><?=$post->post_title; ?></strong></a>
                    <p><?=trim_text(strip_tags($post->post_content), 230)?></p>
                  </div>
                </div>
                <?php
              }else{
                $iod_video = json_decode(get_post_meta( $post->ID, '_iod_video',true))->embed->url;
                $ytpattern = '/^.*(?:(?:youtu\.be\/|v\/|vi\/|u\/\w\/|embed\/)|(?:(?:watch)?\?v(?:i)?=|\&v(?:i)?=))([^#\&\?]*).*/';
                if(preg_match($ytpattern,$iod_video,$vid_id)){
                  $iod_video_thumbnail = 'http://img.youtube.com/vi/'.end($vid_id).'/mqdefault.jpg';
                }
                ?>
                <div class="margin-bottom-20 col-md-12 col-sm-12 col-xs-12">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <a href="<?=$post->guid?>">
                      <img class="img-responsive episode-thumbnail" src="<?=$iod_video_thumbnail?>" alt="<?=$post->post_title; ?>" />
                    </a>
                  </div>
                  <div class="col-md-9 col-sm-9 col-xs-12 cont-episode-details">
                    <a href="<?=$post->guid?>" title="<?=$post->post_title; ?>" class="size-17"><strong><?=$post->post_title; ?></strong></a>
                    <label><i class="fa fa-eye fa-fw"></i><?=InvestOrDivestWidget::count_postviews($post->ID,true)?> views</label>
                    <label><i class="fa fa-comments fa-fw"></i><?=$post->comment_count?> comments</label>
                    <p><?=trim_text(strip_tags($post->post_content), 230)?></p>
                  </div>
                </div>
                <?php
              }
            }
          endwhile;
        else:
          ?>
          <div class="col-md-12"><h3>No results found</h3></div>        
        <?php
        endif;
         ?>
          <div class="pagination"><?=posts_pagination()?></div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
          <div class="side-nav margin-top-50">
            <?php
              render_side_bar_widget();
            ?>
          </div>
        </div>
      </div>
    </div>
    <br class="clear"/>
  </div>
</section>


<?php get_footer(); 

