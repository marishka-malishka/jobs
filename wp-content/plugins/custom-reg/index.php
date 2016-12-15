<?php
/**
 * @package Custom_Reg_4WC
 * @version 1.1.0
 */
/*
Plugin Name: Custom Registration 4 WC
Description: Custom Form Registration for WooCommerce
Author: Oleksii Lomtiev
Version: 1.1.0
*/

include_once('custom-reg.php');
include_once('geoip.php');
include_once('role.php');

function plugin_admin_menu(){
    add_menu_page( 'Custom_Reg', 'Custom_Reg', 'manage_options' ,'vapy', 'plugin_option_menu'); //создание пункта меню
    //add_submenu_page( 'vapy','UH', 'Редактирование', 'manage_options' ,'vapy_edit', 'plugin_option_menu'); //создание подпункта меню

    global $wpdb;
    if(!$wpdb->get_results("SELECT * FROM wp_options WHERE option_name='singup_email_all'")) {
        $wpdb->insert('wp_options', array('option_name' => 'singup_email_all'));
        $wpdb->insert('wp_options', array('option_name' => 'singup_email_employer'));
        $wpdb->insert('wp_options', array('option_name' => 'singup_email_candidate'));
    }
}
function get_options_value($options_keys){
    global $wpdb;
    $sql = 'SELECT option_name,option_value FROM  `wp_options` WHERE  `option_name` IN ("'.implode('","',$options_keys).'")';
    $res = $wpdb->get_results($sql,ARRAY_A);
    $options_value = array();
    foreach($res as $val){
        $options_value[$val['option_name']] = stripslashes($val['option_value']);
    }
    return $options_value;
}
function text_replace($arrayReplace,$text){
    $mixSearch = array();
    $mixReplace = array();
    foreach ($arrayReplace as $key => $value) {
        $mixSearch[] = $key;
        $mixReplace[] = $value;
    }
    return str_replace($mixSearch, $mixReplace, $text);
}
function plugin_option_menu(){
    global $wpdb;

    wp_enqueue_style( 'style', plugins_url( '/css/style.css', __FILE__ ));

    if($_GET['page']=='vapy'){
        include_once('home.php');
    }
}

add_action( 'admin_menu', 'plugin_admin_menu' );
