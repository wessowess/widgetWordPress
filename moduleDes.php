<?php
/**
 * @package module_des
 * @version 0.0.1
 */
/*
Plugin Name: Lancer de Dés
Plugin URI: http://wordpress.org/plugins/module-des/
Description: Plugin de lancé de dés. 
Author: Wessowess
Version: 0.0.1
Author URI: http://sb-online.ovh/
*/

// je définie dans une constante le chemin du plugin par rapport à la localisation du fichier actuel
define( 'MODULE_DES__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// j'inclue mes class
require_once( MODULE_DES__PLUGIN_DIR . 'ModuleDesClasse.php' );

// lorsque j'active mon plugin c'est cette methode qui s'active
register_activation_hook( __FILE__, array( 'ModuleDesClasse', 'install' ) );
// lorsque je désactive mon plugin cette méthode est lancée
register_deactivation_hook( __FILE__, array( 'ModuleDesClasse', 'uninstall' ) );

add_action('widgets_init', function(){ if(is_user_logged_in()) { register_widget('ModuleDesClasse');}});

add_action('init', array('ModuleDesClasse', 'ModuleDesClasse::traitement'));
