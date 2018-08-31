<?php
 /*
    Plugin Name: Wedding List
    Plugin URI: http://www.inventiveinfosys.com/
    Description: Plugin for displaying wedding list.
    Author: InventiveInfosys
    Version: 4.0
    Author URI: http://www.inventiveinfosys.com/
    */	
// function to create the DB / Options / Defaults					
function ss_options_install() {

    global $wpdb;

    $table_name = $wpdb->prefix . "wedding_list";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
            `id` int  NOT NULL AUTO_INCREMENT,
            `wedding_name` varchar(255) CHARACTER SET utf8 NOT NULL,
			`groom_name` varchar(255) CHARACTER SET utf8 NOT NULL,
			`bride_name` varchar(255) CHARACTER SET utf8 NOT NULL,
			`marriage_date` varchar(255) CHARACTER SET utf8 NOT NULL,
			`restaurant_Place` varchar(255) CHARACTER SET utf8 NOT NULL,
			`username` varchar(255) CHARACTER SET utf8 NOT NULL,
			`pass` varchar(255) CHARACTER SET utf8 NOT NULL,
			`email` varchar(255) CHARACTER SET utf8 NOT NULL,
			`post_date` varchar(255) CHARACTER SET utf8 NOT NULL,
			`lastupdate_date` varchar(255) CHARACTER SET utf8 NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";
		  
	

	$table_name2 = $wpdb->prefix . "gift_list";
    $charset_collate = $wpdb->get_charset_collate();
    $sql2 = "CREATE TABLE $table_name2 (
            `id` int  NOT NULL AUTO_INCREMENT,
            `wedding_id` varchar(255) CHARACTER SET utf8 NOT NULL,
			`gift` varchar(255) CHARACTER SET utf8 NOT NULL,
			`description` varchar(3000) CHARACTER SET utf8 NOT NULL,
			`price` varchar(255) CHARACTER SET utf8 NOT NULL,
			`post_date` varchar(255) CHARACTER SET utf8 NOT NULL,
			`lastupdate_date` varchar(255) CHARACTER SET utf8 NOT NULL,
			`status` varchar(255) CHARACTER SET utf8 NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
	dbDelta($sql2);
	
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'ss_options_install');

//menu items
add_action('admin_menu','sinetiks_schools_modifymenu');
function sinetiks_schools_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('Wedding list', //page title
	'Wedding List', //menu title
	'manage_options', //capabilities
	'wedding_list', //menu slug
	'sinetiks_weddings_list', //function
	'dashicons-heart'
	);
	
	//this is a submenu
	add_submenu_page('wedding_list', //parent slug
	'Add New Wedding', //page title
	'Add Wedding', //menu title
	'manage_options', //capability
	'add_wedding', //menu slug
	'add_wedding'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update Wedding', //page title
	'Update', //menu title
	'manage_options', //capability
	'menu_wedding_update', //menu slug
	'menu_wedding_update'); //function
	
	
	//this is a submenu
	add_submenu_page('wedding_list', //parent slug
	'Gifts List', //page title
	'Gifts List', //menu title
	'manage_options', //capability
	'gifts_list', //menu slug
	'gifts_list'); //function
	
	//this is a submenu
	add_submenu_page('wedding_list', //parent slug
	'Add Gifts', //page title
	'Add Gifts', //menu title
	'manage_options', //capability
	'add_gifts', //menu slug
	'add_gifts'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update Gift', //page title
	'Update', //menu title
	'manage_options', //capability
	'menu_gift_update', //menu slug
	'menu_gift_update'); //function
		
	
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'wedding-list.php');
require_once(ROOTDIR . 'wedding-create.php');
require_once(ROOTDIR . 'wedding-update.php');
require_once(ROOTDIR . 'gift-list.php');
require_once(ROOTDIR . 'gifts-create.php');
require_once(ROOTDIR . 'gift-update.php');
require_once(ROOTDIR . 'login.php');

