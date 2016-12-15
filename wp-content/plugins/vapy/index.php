<?php
/*
Plugin Name: vapy
Plugin URI: 
Description: gallery plugin
Version: 1
Author: Vadim Pyshenko
Author URI: https://vk.com/id98895834
*/

function plugin_set_options(){
	global $wpdb;
	$wpdb->query("CREATE TABLE ".$wpdb->prefix."galleryhome (id int(10) AUTO_INCREMENT,
									type varchar(20),
									image varchar(255) NOT NULL,
									content text NOT NULL,
									PRIMARY KEY (id))");
	if(!$wpdb->get_results("SELECT * FROM ".$wpdb->prefix."galleryhome WHERE id=0"))
		$wpdb->query("INSERT INTO ".$wpdb->prefix."galleryhome (id) VALUES(0)");
}

function plugin_unset_options(){
	global $wpdb;

}

function plugin_admin_menu(){
	add_menu_page( 'Vapy', 'Gallery', 'manage_options' ,'vapy', 'plugin_option_menu');
}

function plugin_option_menu(){
	global $wpdb;	
	wp_enqueue_style( 'style', plugins_url( '/css/style.css', __FILE__ ));
	echo '<link rel="stylesheet" href="'.WP_PLUGIN_URL.'/vapy/css/comment.css">';
	echo '<script type="text/javascript" src="'.WP_PLUGIN_URL.'/vapy/js/jquery.js"></script>';
	echo '<script type="text/javascript" src="'.WP_PLUGIN_URL.'/vapy/js/script.js"></script>';

	if($_GET['page']=='vapy'){
		include_once('v-comments.php');		
	}
}


register_activation_hook(__FILE__, 'plugin_set_options');		//активируем плагин
register_deactivation_hook(__FILE__, 'plugin_unset_options');	//деактивируем плагин
add_action( 'admin_menu', 'plugin_admin_menu' );

function _en($str) {
	$rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э','є', 'ю', 'я',' ');
	$lat = array('a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e','e', 'yu', 'ya','');
	return str_replace($rus, $lat, $str);
}

?>