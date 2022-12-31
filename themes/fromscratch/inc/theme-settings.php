<?php
/**
 * Base settings
 */

$languages = [
	[
		'id' => 'en',
		'nameEnglish' => 'English',
		'nameOriginalLanguage' => 'English',
	],

	// Add more languages to support translations
];

$variables = [
	'title' => 'Theme Settings',
	'sections' => [
		[
			'id' => 'footer',
			'title' => 'Footer',
			'variables' => [
				[
					'id' => 'text',
					'title' => 'Text',
					'translate' => false,
					'type' => 'textfield',
					'width' => 400
				],
				// [
				// 	'id' => 'textarea',
				// 	'title' => 'Textarea Example',
				// 	'translate' => false,
				// 	'type' => 'textarea',
				// 	'rows' => 4,
				// 	'width' => 400
				// ]
			],
		],
	]
];

function theme_settings_page()
{
	global $variables;
	global $languages;
?>
	<div class="wrap">
		<h1><?= $variables['title'] ?></h1>
		<form method="post" action="options.php" class="page-settings-form">
			<div style="margin: 24px 0 32px;">
				<?php
				if (sizeof($languages) > 1) {
					foreach ($languages as $language) {
						echo '<div onclick="changeSettingsPageLanguage(\'' . $language['id'] . '\')" class="settings-page-language-button settings-page-language-button-' . $language['id'] . ' button' . ($language['id'] == 'de' ? ' button-primary' : '') . '" style="margin-right: 8px">' . $language['nameEnglish'] . '</div>';
					}
				}
				?>
				<script>
					function changeSettingsPageLanguage(id) {
						jQuery('.settings-page-language-button').removeClass('button-primary');
						jQuery('.settings-page-language-button-' + id).addClass('button-primary');
						jQuery('.page-settings-language-container').parents('tr').css({
							display: 'none'
						});
						jQuery('.page-settings-language-container-' + id).parents('tr').css({
							display: 'table-row'
						});
					}

					jQuery(function() {
						changeSettingsPageLanguage('de');
						jQuery('.page-settings-form').css({
							display: 'block'
						});
					});
				</script>
				<style>
					input.settings-page-textfield,
					textarea.settings-page-textfield {
						border-radius: 2px;
						border-color: #ccc;
						color: #373737;
						padding: 1px 8px;
					}

					textarea.settings-page-textfield {
						resize: vertical;
					}

					.page-settings-form .form-table td {
						padding-top: 8px;
						padding-bottom: 8px;
					}

					.page-settings-form {
						display: none;
					}

					.page-settings-form h2 {
						padding-top: 20px;
						position: relative;
					}

					.page-settings-form h2::after {
						content: '';
						display: block;
						position: absolute;
						height: 2px;
						top: -1px;
						left: 0;
						width: 100%;
						max-width: 620px;
						background: #d0d0d0;
					}

					.page-settings-description {
						color: #aaa;
						font-size: 12px;
						padding: 4px 0 0 4px;
					}
				</style>
			</div>
			<?php
			foreach ($variables['sections'] as $section) {
				settings_fields('section');
				do_settings_sections('theme_variables_' . $section['id']);
			}
			submit_button();
			?>
		</form>
	</div>
<?php
}

function display_custom_info_field($variable, $variableId, $languageId = null)
{
	if ($languageId) {
		echo '<div class="page-settings-language-container page-settings-language-container-' . $languageId . '">';
	}

	switch ($variable['type']) {
		case 'textfield':
			echo '<input class="settings-page-textfield" type="text" name="' . $variableId . '" value="' . get_option($variableId) . '" style="width: ' . $variable['width'] . 'px">';
			break;
		case 'textarea':
			echo '<textarea class="settings-page-textfield" name="' . $variableId . '" rows="' . $variable['rows'] . '" style="width: ' . $variable['width'] . 'px">' . get_option($variableId) . '</textarea>';
			break;
	}

	if (!empty($variable['description'])) {
		echo '<div class="page-settings-description">' . $variable['description'] . '</div>';
	}

	if ($languageId) {
		echo '</div>';
	}
}

function display_custom_info_fields()
{
	global $variables;

	foreach ($variables['sections'] as $section) {
		add_settings_section('section', $section['title'], null, 'theme_variables_' . $section['id']);

		foreach ($section['variables'] as $variable) {
			$variableId = 'theme_variables_' . $section['id'] . '_' . $variable['id'];

			if (!empty($variable['translate'])) {
				global $languages;

				foreach ($languages as $language) {
					$variableIdLang = $variableId . '_' . $language['id'];
					add_settings_field($variableIdLang, $variable['title'], function () use ($variable, $variableIdLang, $language) {
						display_custom_info_field($variable, $variableIdLang, $language['id']);
					}, 'theme_variables_' . $section['id'], 'section');
					register_setting('section', $variableIdLang);
				}
			} else {
				add_settings_field($variableId, $variable['title'], function () use ($variable, $variableId) {
					display_custom_info_field($variable, $variableId);
				}, 'theme_variables_' . $section['id'], 'section');
				register_setting('section', $variableId);
			}
		}
	}
}
add_action('admin_init', 'display_custom_info_fields');

function add_custom_info_menu_item()
{
	global $variables;
	add_options_page($variables['title'], $variables['title'], 'manage_options', 'custom-theme-settings', 'theme_settings_page');
}
add_action('admin_menu', 'add_custom_info_menu_item');

// Translate Strings

// TODO customize

function txt($de, $en, $fr, $it)
{
	$languageId = apply_filters('wpml_current_language', null);

	switch ($languageId) {
		case 'de':
			return $de;
			break;
		case 'en':
			return $en;
			break;
		case 'fr':
			return $fr;
			break;
		case 'it':
			return $it;
			break;
	}
}

function getLoginLink()
{
	$languageId = apply_filters('wpml_current_language', null);
	return get_option('theme_variables_global_link_to_member_area') . '?lang=' . $languageId;
}
