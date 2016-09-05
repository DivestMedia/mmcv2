	<!-- Promo Section -->
			
	<div class="promo-section master-slider ms-slide-auto-height ms-promo-1 noborder" id="masterslider-promo">
	<?php
		$_banners = json_decode(do_shortcode( '[SM_GET_BANNER]' ));
		if(!empty($_banners)){
			foreach ($_banners as $_banner) {
				$_banner_url = wp_get_attachment_url($_banner->banner_id);
				
				$thumb_url_c = wp_get_attachment_image_src( $_banner->banner_id, 'mid-image' );
				if ( !empty( $thumb_url_c[0] ) ) {
					/* printf( '<a href="%1$s" alt="%2$s">%3$s</a>',
						esc_url( $thumb_url[0] ),
						esc_attr( get_the_title_attribute( 'echo=0' ) ),
						get_the_post_thumbnail()
					); */
					$thumb_url = $thumb_url_c[0];
				}else{
					$thumb_url = wp_get_attachment_url($_banner->banner_id);
				}
	
	?>
		<!-- Slide 1 -->
		<div class="ms-slide">
			<img src="blank.gif" data-src="<?=$_banner_url?>" alt="<?=$_banner->title?>">
			<div class="ms-layer btn btn-lg btn-third noradius hidden-xs" style="left: 15px; top: 182px; opacity: 1;" data-type="text" data-delay="10" data-effect="skewleft(50,340)" data-ease="easeOutExpo" data-duration="2200">
				<?=ucwords($_banner->category)?>
			</div>
			<h2 class="ms-layer font-proxima ms-promo-travel-place hidden-3xs" style="left: 11px; top: 210px;" data-type="text" data-delay="10" data-effect="skewright(50,340)" data-ease="easeOutExpo" data-duration="2200">
				<?=mb_strimwidth(strip_tags(html_entity_decode($_banner->title)), 0, 25, "&hellip;")?>
			</h2>
			<div class="ms-layer ms-promo-travel-description" style="left: 15px; top: 310px;" data-type="text" data-delay="30" data-effect="rotate3dbottom(100,0,0,70)" data-ease="easeOutExpo" data-duration="2300">
				<p class="g-mb-20 hidden-sm hidden-xs"><?=mb_strimwidth(strip_tags(html_entity_decode($_banner->description)), 0, 150, "&hellip;")?></p>
				<p><a href="<?=$_banner->link?>" class="btn btn-lg btn-primary noradius">Read <span class="visible-3xs">More</span></a></p>
			</div>
			<img class="ms-thumb" src="<?=$thumb_url?>" alt="<?=$_banner->title?>">
		</div>
		<!-- End Slide 1 -->
	<?php
			}
		}
	?>
		

	</div>
	<!-- End Promo Section -->