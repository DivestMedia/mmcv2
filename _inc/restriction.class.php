<?php



class memberRestriction {

	public $restricted_pages = [
		// 'dummies-guide',
		// 'telling-tales',
		// 'find-a-broker',
	];

	public $restricted_archives = [
		// 'iod_video',
	];

	public $restricted_taxonomies = [
		// 'iod_video' => 'iod_category',
	];

	public function __construct(){
		add_action('init',[&$this,'hooks']);
	}

	public function restrict_content($content){
		global $post;

		if($this->ispostrestricted($post)){
			$content = 'Content Restricted';
		}
		return '';
	}

	public function ispostrestricted($post){
		// Restriction Rules
		$restrict = 0;
		// Getting Current posts parent
		$ancestors = get_post_ancestors($post->ID);
		$parent = $post->ID;

		if(count($ancestors)){
			$parent = $ancestors[count($ancestors) - 1];
		}

		// If page child of dummies-guide
		if(
		in_array(get_post($parent)->post_name,$this->restricted_pages)
		){
			$restrict++;
		}

		if(
			is_post_type_archive($this->restricted_archives)
		){
			$restrict++;
		}

		foreach ($this->restricted_taxonomies as $post_type => $taxonomy) {
			if(get_query_var('taxonomy')==$taxonomy){
				$restrict++;
			}
		}

		return $restrict!=0;
	}

	public function restrict_page(){

		if(is_user_logged_in()) return false;

		global $post;

		return $this->ispostrestricted($post);
	}

	public function hooks(){

		add_filter('the_content', [&$this, 'restrict_content']);
		add_shortcode( 'dm_restrict_page' , [&$this,'restrict_page'] );

	}

	public function out(){

	}

}
$restrict = new memberRestriction();
$_GLOBALS['restrict'] = $restrict;
