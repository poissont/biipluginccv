<?php

function bii_listeClass() {
	$list = [
		"rpdo",
		"global_class",
		"posts",
		"terms",
		"postmeta",
		"users",
		"usermeta",
	];
	return $list;
}

function bii_includeClass() {
	$liste = bii_listeClass();
	$pdpf = plugin_dir_path(__FILE__);
	foreach ($liste as $item) {
		require_once($pdpf . "/class/$item.class.php");
	}
}

bii_includeClass();

function bii_menu() {

	add_menu_page(__(global_class::wp_slug_menu()), __(global_class::wp_titre_menu()), global_class::wp_min_role(), global_class::wp_nom_menu(), global_class::wp_dashboard_page(), global_class::wp_dashicon_menu());
}

add_action('admin_menu', 'bii_menu');

function bii_dashboard() {
	wp_enqueue_script('admin-init', plugins_url('/admin/js/dashboard.js', __FILE__), array('jquery'), null, true);
	wp_enqueue_style('bii-admin-css', plugins_url('/admin/css/admin.css', __FILE__));
	include('admin/dashboard.php');
}

function bii_dashboard_title($param, $param2) {
	return "<h1 class='faa-parent animated-hover'><span class='fa fa-rocket faa-passing'></span> Plugin Bii_Plugin version " . Bii_plugin_version . " </h1>";
}

add_filter('bii_dashboard_title', 'bii_dashboard_title', 1, 2);

function bii_action_links($links) {
	$links[] = '<a href="' . esc_url(get_admin_url(null, 'admin.php?page=bii_plugin')) . '">Paramètres</a>';
	return $links;
}

add_filter('plugin_action_links_' . plugin_basename(Bii_file), 'bii_action_links');
//ADD YOUR FILTERS AND ACTIONS

