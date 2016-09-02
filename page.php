<?php
global $post;
get_header();
if(basename(get_permalink())=='investment-style'||basename(get_permalink())=='investment-assets'||basename(get_permalink())=='essential-guidelines-before-you-start'||basename(get_permalink())=='investment-vehicles'||basename(get_permalink())=='investment-strategies'||basename(get_permalink())=='online-fraud'){
	get_template_part("partials/page", 'dummiesguide-child' );
}else{
	get_template_part("partials/page", locate_template('partials/page-'.basename(get_permalink()).'.php')!='' ? basename(get_permalink()) : '' );
}
get_footer();
