<?php

/*
  Plugin Name: Bii_plugin
  Description: Bii_plugin : Plugin de développement de biilink. Ce plugin ajoute des fonctions de débug en cours de développement, de gestion de l'interface d'admin, de débug SEO et des fonctionnalités front office
  Version: 1.0.1
  Author: BiilinkAgency
 */

define('Bii_plugin_version', '1.0.1');
define('Bii_path', plugin_dir_path(__FILE__));
define('Bii_file', __FILE__);

define('Bii_plugin_slug', "Biilinkplugin");
define('Bii_menu_title', "Bii Options");
define('Bii_dashicon_menu', get_bloginfo("url") . "/wp-content/plugins/bii_plugin/img/smallbiilink.png");
define('Bii_menu_slug', "bii_plugin");
define('Bii_plugin_name', "bii_plugin");
define('Bii_dashboard_page', "bii_dashboard");
define('Bii_min_role', "publish_pages");

if (!get_option("bii_plugin_installed")) {
	update_option("bii_plugin_installed", 1);
}
//Plugin biidebug, ajout de fonctions
require_once(plugin_dir_path(__FILE__) . "/plugins/biidebug/biidebug.php");
////Plugin biibdd, ajout de fonctions bases de données
require_once(plugin_dir_path(__FILE__) . "/plugins/bii_bdd/bii_bdd.php");
////Plugin biiadvanced admin, ajout de fonctionnalités ajax sur l'interface d'admin
require_once(plugin_dir_path(__FILE__) . "/plugins/biiadvanced-admin/biiadvanced-admin.php");
////Plugin biicss, ajout de bootstrap et font awesome
require_once(plugin_dir_path(__FILE__) . "/plugins/biicss/biicss.php");
////Plugin biicheckseo, ajout de scripts permettant de vérifier la SEO des pages parcourues
require_once(plugin_dir_path(__FILE__) . "/plugins/biicheckseo/biicheckseo.php");
//Plugin bii_advanced_shortcodes, ajout de shortcodes
require_once(plugin_dir_path(__FILE__) . "/plugins/biiadvanced_shortcodes/biiadvanced_shortcodes.php");
//Plugin bii_preloader, ajout d'un preloader
require_once(plugin_dir_path(__FILE__) . "/plugins/bii_preloader/bii_preloader.php");
//Plugin bii_restricted_content
require_once(plugin_dir_path(__FILE__) . "/plugins/bii_restricted_content/bii_restricted_content.php");
//Include du config
require_once(plugin_dir_path(__FILE__) . "config.php");
require_once(plugin_dir_path(__FILE__) . "functions.php");
require_once(plugin_dir_path(__FILE__) . "shortcodes.php");

