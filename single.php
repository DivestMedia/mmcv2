<?php
get_header();
?>
			<!-- -->
			<section class="nopadding  margin-top-40">
				<div class="container">

					<div class="row">

						<!-- LEFT -->
						<div class="col-md-12 col-sm-12">
						
						
							<div class="post-data padding-bottom-40">
							
							<?php
							
								global $wp_query, $query_string;
								//query_posts( $query_string . '&posts_per_page=1');
								// Start the Loop.
								while ( have_posts() ) : the_post();
								
									(int)$_pageView = get_post_meta( $post->ID, '_xyr_pageview', true);
									$_pageView = $_pageView + 1;
									update_post_meta($post->ID, '_xyr_pageview', $_pageView);
								?>

								<article id="post-<?=$post->ID;?>" class="post-article">
									
									
									<?
									$_paged = get_query_var('page',1);
									
									if($_paged <= 1){?>
									<!-- IMAGE -->
										<figure class="margin-bottom-30">
										<? if(has_post_thumbnail()) {
											the_post_thumbnail('main-image', array('class'=>'img-responsive'));
										} ?>
										</figure>
									<!-- /IMAGE -->
									<? } ?>
										
										<script>
$( "img.aligncenter" ).wrap( "<div class='box-shadow-1'></div>" );
</script>
										<header class="entry-header ">
										
											<?php the_title( '<h1 class="size-32 weight-500">', '</h1>' ); ?>

											
											<ul class="blog-post-info list-inline margin-bottom-0" style="">
												
												<li>
													By: <a href="<? echo esc_url( get_author_posts_url(get_the_author_meta('ID')) );?>">
														<span class="font-lato"><? the_author();?></span>
													</a>
												</li>
												
												<li>
													<i class="fa fa-clock-o"></i> 
													<span class="font-lato">
													<time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
													</span>
												</li>
												
												<li class="font-lato">
													<i class="fa fa-folder-open-o"></i>
													<?=get_the_category_list(' ');?>
												</li>
												
												<?php edit_post_link('<i class="fa fa-edit"></i> <span class="font-lato">'. __( 'Edit', XYR_SMARTY ) .'</span>', '<li>', '</li>' ); ?>
											</ul>
											
											
										<div class="" style="border-bottom:1px dotted #eaeaea">
										<?
										//$_socialButtons = social_gmsharee();
										echo $_socialButtons.'';
										
										?>
										</div>
										
										</header><!-- .entry-header -->
										
										
										
										<div class="text-black size-18 padding-top-30 entry-content post-<?=get_post_format();?>">
											
											
											
											
											<!-- article content -->
											<? the_content();?>
											<!-- /article content -->
											
												
											<?
											wp_link_pages( array( 
												'before' => '<div class="divider"></div><ul class="pagination pagination-md noradius"><h4>Article Pages</h4>', 
												'after' => '</ul>',
												//'pagelink' => '%' 
											) );
									
										?>
											<div class="divider divider-dotted"><!-- divider --></div>
										</div><!-- .entry-content -->
										
										
										<?php wp_link_pages(); ?>
										
											
									
										
								</article><!-- #post-## -->
									
									
								<?php endwhile; // end of the loop. ?>
								<?php wp_reset_query(); ?>
								<?/* php comments_template();  */?>
									
								
							</div>
						</div>

						<? //get_sidebar('main');?>
						

					</div>


				</div>
			
			</section>
			
	
	
	
	


<?

get_footer();

			