<?php
global $post;
get_header();

if(!strcasecmp(get_the_title($post->ID),'infomercials')||!strcasecmp(get_the_title($post->ID),'Webinars')){
	get_template_part("partials/page", strtolower(get_the_title($post->ID)) );
}elseif(!strcasecmp(preg_replace("/[^a-zA-Z0-9 ]+/", "", html_entity_decode(get_the_title($post->post_parent))),"Dummies Guide")&&get_the_title($post->ID)!=get_the_title($post->post_parent)){
	get_template_part("partials/page", 'dummiesguide-child' );
}elseif(!strcasecmp(get_the_title($post->post_parent),'Telling Tales')&&get_the_title()!=get_the_title($post->post_parent)){
	get_template_part("partials/page", 'tellingtales-child' );
}elseif((!strcasecmp(get_the_title($post->post_parent),'Celebrity Investments')||!strcasecmp(get_the_title($post->post_parent),'Entrepreneurial Exploits'))&&get_the_title()!=get_the_title($post->post_parent)){
	get_template_part("partials/page", 'tellingtales-child-haschild' );
}elseif(!strcasecmp(get_the_title($post->post_parent),'Advisors')&&get_the_title()!=get_the_title($post->post_parent)){
	get_template_part("partials/page", 'advisors-child' );
}else{
	get_template_part("partials/page", locate_template('partials/page-'.basename(get_permalink()).'.php')!='' ? basename(get_permalink()) : '' );
}
get_footer();
