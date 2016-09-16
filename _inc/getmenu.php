<?php

	class GetMenu 
	{
		
		public function __construct(){
			self::custom_template_init();
		}

		public function custom_template_init(){
			add_filter( 'rewrite_rules_array',[$this,'rewriteRules'] );
			add_filter( 'template_include', [ $this, 'template_include' ],1,1 );
			add_filter( 'query_vars', [ $this, 'prefix_register_query_var' ] );
		}

		public function prefix_register_query_var($vars){
			$vars[] = 'func';
			$vars[] = 'mtp';
			return $vars;
		}

		public function rewriteRules($rules){
			$newrules = self::rewrite();
			return $newrules + $rules;
		}

		public function rewrite(){
			$newrules = array();
			$newrules['getmenu/(.*)'] = 'index.php?func=getmenu&mtp=$matches[1]';
			$newrules['getmenu'] = 'index.php?func=getmenu';

			return $newrules;
		}

		public function removeRules($rules){
			$newrules = self::rewrite();
			foreach ($newrules as $rule => $rewrite) {
				unset($rules[$rule]);
			}
			return $rules;
		}

		public function template_include($template){
			$_func = sanitize_text_field(get_query_var( 'func' ));
			$_mtp = sanitize_text_field(get_query_var( 'mtp' ));
			if(!empty($_func)){
				if(!strcasecmp($_SERVER['REQUEST_METHOD'],'post')){
					if(!empty($_mtp)&&!strcasecmp($_mtp, 'footer'))
						echo self::generate_footer_menu();
					else
						echo self::generate_menu();
				}else{
					echo 'Access denied!';
				}
			}else{
				return $template;
			}
			die();
		}

		public function generate_menu(){
			$_menu = wp_nav_menu(array(
				'menu' => 'Main menu',
				'walker' => new custom_xyren_smarty_walker_nav_menu(),
				'menu_id'=>'topMain',
				'container' =>'ul',
				'menu_class' =>'nav nav-pills nav-main has-topBar',
				'echo' => false
			));
			
			return $_menu;
		}
		public function generate_footer_menu(){
			if(!empty(wp_get_nav_menu_items('Footer Navigation'))){
				$footer_menu = [];
				foreach (wp_get_nav_menu_items('Footer Navigation') as $f) {
					array_push($footer_menu , '<a href="'.$f->url.'">'.$f->title.'</a>');
				}
			}
			return implode(' | ', $footer_menu);
		}

	}