<?php
global $post;
setup_postdata($post);
if(!strcasecmp(get_post_type(), 'newsletter')){
	$_fa_image = get_post_meta($post->ID,'_nltg_fa_image')[0];
	$_fa_title = get_post_meta($post->ID,'_nltg_fa_title')[0];
	$_fa_content = get_post_meta($post->ID,'_nltg_fa_content')[0];
	$_fa_link = get_post_meta($post->ID,'_nltg_fa_link')[0];

	$_fa_sec_title = get_post_meta($post->ID,'_nltg_fa_sec_title')[0];

	$end = 1;
	$ctr = 0;
	$_fv = [];
	while($end){
		$_image = get_post_meta($post->ID,'_nltg_fv_image_'.$ctr);
		$_title= get_post_meta($post->ID,'_nltg_fv_title_'.$ctr);
		$_content = get_post_meta($post->ID,'_nltg_fv_content_'.$ctr);
		$_link = get_post_meta($post->ID,'_nltg_fv_link_'.$ctr);
		if(!empty($_image)){
			$_temp = ['_nltg_fv_image'=>$_image[0],'_nltg_fv_title'=>$_title[0],'_nltg_fv_content'=>$_content[0],'_nltg_fv_link'=>$_link[0]];
			if(!empty($_title[0]))
				array_push($_fv,$_temp);
		}else{
			$end = 0;
		}
		$ctr++;
	}

	$_fv_sec_title = get_post_meta($post->ID,'_nltg_fv_sec_title')[0];

	$end = 1;
	$ctr = 0;
	$_fn = [];
	while($end){
		$_image = get_post_meta($post->ID,'_nltg_fn_image_'.$ctr);
		$_title= get_post_meta($post->ID,'_nltg_fn_title_'.$ctr);
		$_content = get_post_meta($post->ID,'_nltg_fn_content_'.$ctr);
		$_link = get_post_meta($post->ID,'_nltg_fn_link_'.$ctr);
		if(!empty($_image)){
			$_temp = ['_nltg_fn_image'=>$_image[0],'_nltg_fn_title'=>$_title[0],'_nltg_fn_content'=>$_content[0],'_nltg_fn_link'=>$_link[0]];
			if(!empty($_title[0]))
				array_push($_fn,$_temp);
		}else{
			$end = 0;
		}
		$ctr++;
	}

	$_fn_sec_title = get_post_meta($post->ID,'_nltg_fn_sec_title')[0];

	$_ab_smimage = get_post_meta($post->ID,'_nltg_ab_smimage')[0];
	$_ab_smurl = get_post_meta($post->ID,'_nltg_ab_smurl')[0];

	$_ab_lgimage = get_post_meta($post->ID,'_nltg_ab_lgimage')[0];
	$_ab_lgurl = get_post_meta($post->ID,'_nltg_ab_lgurl')[0];
	$_custom_text =$post->post_content;
	$_post_link = get_the_permalink($post->ID);
	$_site_link = site_url();
	$_site_logo = 'http://www.marketmasterclass.com/wp-content/themes/mmcv2/assets/img/mmc-logo-light.png';
	$_site_logo_black = 'http://mmc.divestmedialocal.com/wp-content/themes/mmcv2/assets/img/mmc-logo.png';
	$_icons_link = get_stylesheet_directory_uri().'/assets/img/icons/';
	$_subscribe_link = 'http://www.marketmasterclass.com/subscribe/';
	$_about_link = 'http://www.marketmasterclass.com/about/';
	// $_icons_link = NLTG_PLUGIN_URL.'assets/icons/';
	include(NLTG_PLUGIN_DIR.'templates/news_letter_template.php');
}else{
	get_header();
	get_template_part("partials/single", locate_template('partials/single-'.get_post_type().'.php')!='' ? get_post_type() : '' );
	get_footer();
}
