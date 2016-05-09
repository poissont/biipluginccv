<?php
/*
  Plugin Name: Bii restricted content
  Description: Permet de restreindre l'affichage d'une page à une certaine liste d'utilisateurs
  Version: 0.1
  Author: Biilink Agency
  Author URI: http://biilink.com/
  License: GPL2
 */
define('bii_restricted_content_version', '0.1');

add_action('admin_enqueue_scripts', function () {
	if (isset($_GET["page"]) && (strpos($_GET["page"], "bii") !== false) || (strpos($_GET["page"], "_list") !== false) || (strpos($_GET["page"], "_edit") !== false)) {

		if (get_option("bii_usebootstrap_admin_js")) {
			wp_enqueue_script('bootstrap-multiselect', bii_css_url . 'js/bootstrap-multiselect.js', array('bootstrapjs'), false, true);
		}

//	wp_enqueue_style('bootstrap-theme', plugins_url('css/bootstrap-theme.css', __FILE__));
	}
});

function bii_MB_restrict_user($post) {
	if (get_option("bii_userestrict_content")) {
		$userc = get_post_meta($post->ID, 'bii_userestrict_content', true);
		$user_allowed = unserialize(get_post_meta($post->ID, 'bii_users_allowed', true));
		if (!$userc) {
			$userc = 0;
		}
		if (!$user_allowed) {
			$user_allowed = [];
		}
		$checked = "";
		$hidden = "hidden";
		if ($userc == 1) {
			$checked = "checked='checked'";
			$hidden = "";
		}
		?>

		<label class="bii_label" for="bii_userestrict_content-cbx">Utiliser la restriction de contenu</label>
		<input type='hidden'  id='bii_userestrict_content' name='bii_userestrict_content' value='<?= $userc; ?>' />
		<input type='checkbox'  id='bii_userestrict_content-cbx' name='bii_userestrict_content-cbx' class='cbx-data-change form-control' data-change='bii_userestrict_content' <?= $checked ?> />
		<div class="bii_preloader <?= $hidden; ?>">
			<select multiple="multiple" name="bii_preloadertimeout[]" id="bii_preloadertimeout" class="bootstrap-multiselect">
				<?= users::genOptionForm("", $user_allowed); ?>


			</select>
		</div>
		<style>
			.bii_label{
				display: inline-block;
				width: 17%;
			}
		</style>
		<script>
			jQuery(".cbx-data-change").on("click", function () {
				jQuery(".bii_preloader").removeClass("hidden");
				var id = jQuery(this).attr("data-change");

				console.log(id);
				var checked = jQuery(this).is(":checked");
				var value = 0;
				if (checked == true) {
					value = 1;
		<?php if (get_option("bii_usebootstrap_admin_js")) { ?>

						jQuery('.bootstrap-multiselect').multiselect({
							selectAllText: ' Sélectionner tout',
							nonSelectedText: 'Aucune sélection',
							nSelectedText: 'sélectionné',
							allSelectedText: 'Tous'
						});
						jQuery('.bootstrap-multiselect').hide();

		<?php } ?>
				}
				jQuery("#" + id).val(value);
				console.log(jQuery("#" + id));
			});


		</script>
		<?php
	}
}

add_action("bii_informations", function() {
	?>
	<tr><td>La fonctionnalité de restriction de contenu est </td><td><?= bii_makebutton("bii_userestrict_content", 0, 1); ?></td></tr>
	<?php
});
