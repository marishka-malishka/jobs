<?php
	add_shortcode('user_secure','wp_secure_func');
	
	function wp_secure_func($attr){
		$url = $attr['url']?$attr['url']:'my-account';
		$unregurl = $attr['unregurl']?$attr['unregurl']:'signup';
		$custom_url = $attr['custom']?$attr['custom']:'';
		$user = new WP_User(get_current_user_id());

		if($attr['role'] == 'unreg'){
			if(get_current_user_id()){
				if( in_array( 'administrator', $user->roles )) return false;
				wp_secure_redirect($url,$custom_url);
			} 
		}else{
			if(!get_current_user_id()) wp_secure_redirect($unregurl,$custom_url);
			
			if(!$attr['role']) return false;
			if( in_array( 'administrator', $user->roles )) return false;
			if ( !in_array( $attr['role'], $user->roles )) wp_secure_redirect($url,$custom_url);
		}
	}
	function wp_secure_redirect($url,$custom){
		$user = new WP_User(get_current_user_id());
		wp_redirect( site_url($url) . $custom);
        exit;
	}

	add_shortcode('user_name','wp_get_user_name');

	function wp_get_user_name(){
		global $current_user;
		get_currentuserinfo();
		return $current_user->user_login;
	}

?>