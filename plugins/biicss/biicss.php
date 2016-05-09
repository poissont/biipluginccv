<?php
/*
  Plugin Name: Biicss
  Description: Ajoute bootstrap et font awesome sur le site et son back office
  Version: 1.4
  Author: Biilink Agency
  Author URI: http://biilink.com/
  License: GPL2
 */
define('bii_css_version', '1.4');
define('bii_css_path', plugin_dir_path(__FILE__));
define('bii_css_url', plugin_dir_url(__FILE__));

add_action('admin_enqueue_scripts', function () {
	if (isset($_GET["page"]) && (strpos($_GET["page"], "bii") !== false) || (strpos($_GET["page"], "_list") !== false) || (strpos($_GET["page"], "_edit") !== false) || (strpos($_GET["page"], "_edit") !== false)) {
		if (get_option("bii_usebootstrap_admin")) {
			wp_enqueue_style('bootstrap', plugins_url('css/bootstrap.css', __FILE__));
		}
//		if (get_option("bii_usebootstrap_admin_js")) {
//			wp_enqueue_script('bootstrapjs', plugins_url('js/bootstrap.min.js', __FILE__), array('jquery'), false, true);
//		}
		if (get_option("bii_fa_admin")) {
			wp_enqueue_style('font-awesome', plugins_url('css/font-awesome.min.css', __FILE__));
		}
//	wp_enqueue_style('bootstrap-theme', plugins_url('css/bootstrap-theme.css', __FILE__));
	}
});

add_action('wp_enqueue_scripts', function() {
	if (get_option("bii_useleftmenu")) {
		wp_enqueue_script('jquery-effects-core');
		wp_enqueue_style('leftmenu', plugins_url('css/leftmenu.css', __FILE__));
		wp_enqueue_script('leftmenuscript', plugins_url('js/leftmenu.js', __FILE__), array('jquery', 'jquery-ui-core', 'jquery-effects-core', 'util'), false, true);
	}
	if (get_option("bii_usebootstrap_front")) {
		wp_enqueue_style('bootstrap', plugins_url('css/bootstrap.css', __FILE__));
	}
	if (get_option("bii_fa_front")) {
		wp_enqueue_style('font-awesome', plugins_url('css/font-awesome.min.css', __FILE__));
	}
});

add_action("bii_informations", function() {
	?>

	<tbody id="bii_css">
		<tr><th colspan="2">Bii_CSS</th>
		<tr><td>Le menu à gauche est </td><td><?= bii_makebutton("bii_useleftmenu"); ?></td></tr>
		<tr><td>Bootstrap Admin est  </td><td><?= bii_makebutton("bii_usebootstrap_admin"); ?></td></tr>
		<!--<tr><td>Bootstrap Admin JS est  </td><td><?php // bii_makebutton("bii_usebootstrap_admin_js");   ?></td></tr>-->
		<tr><td>Font Awesome Admin est  </td><td><?= bii_makebutton("bii_fa_admin"); ?></td></tr>
		<tr><td>Bootstrap Front est  </td><td><?= bii_makebutton("bii_usebootstrap_front"); ?></td></tr>
		<tr><td>Font Awesome Front est  </td><td><?= bii_makebutton("bii_fa_front"); ?></td></tr>
	</tbody>
	<?php
});

add_filter("bii_class_menu", function($arg1, $arg2) {
	$class = "";
	if (get_option("bii_useleftmenu")) {
		$class.="bii-left-menu";
	}
	return $class;
}, 10, 2);
add_action("between_header_and_containerwrapper", function() {
	?>
	<div id="bii-overlay"></div>
	<?php
}, 10, 2);
