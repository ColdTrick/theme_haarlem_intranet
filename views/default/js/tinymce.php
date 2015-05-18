<?php

$plugins = elgg_get_plugin_setting("plugins", "tinymce_extended");
if(empty($plugins)){
	$plugins = elgg_echo("tinymce_extended:defaults:plugins");
}

$menu1 = elgg_get_plugin_setting("menu1", "tinymce_extended");
if(empty($menu1)){
	$menu1 = elgg_echo("tinymce_extended:defaults:menu1");
}

$menu2 = elgg_get_plugin_setting("menu2", "tinymce_extended");
$menu3 = elgg_get_plugin_setting("menu3", "tinymce_extended");

$valid_elements = elgg_get_plugin_setting("valid_elements", "tinymce_extended");
if(empty($valid_elements)){
	$valid_elements = elgg_echo("tinymce_extended:defaults:valid_elements");
}

// fa css
$externals = elgg_get_config('externals_map');
$fa = $externals['css']['fontawesome'];

$fa_url = elgg_normalize_url($fa->url);

?>
//<script>
elgg.provide('elgg.tinymce');

/**
 * Toggles the tinymce editor
 *
 * @param {Object} event
 * @return void
 */
elgg.tinymce.toggleEditor = function(event) {
	event.preventDefault();

	var target = $(this).attr('href');
	var id = $(target).attr('id');
	if (tinyMCE.get(id).isHidden()) {
		tinyMCE.editors[id].show();
		$(this).html(elgg.echo('tinymce:remove'));
	} else {
		tinyMCE.editors[id].hide();
		$(this).html(elgg.echo('tinymce:add'));
	}
}

/**
 * TinyMCE initialization script
 *
 * You can find configuration information here:
 * http://tinymce.moxiecode.com/wiki.php/Configuration
 */
elgg.tinymce.init = function() {

	$('.tinymce-toggle-editor').live('click', elgg.tinymce.toggleEditor);

	$('.elgg-input-longtext').parents('form').submit(function() {
		tinyMCE.triggerSave();
	});

	tinyMCE.init({
		mode : "specific_textareas",
		editor_selector : "elgg-input-longtext",
		theme : "modern",
		plugins : "lists,<?php echo $plugins;?>,bfa_plugin,noneditable,wordcount",
		relative_urls : false,
		remove_script_host : false,
		document_base_url : elgg.config.wwwroot,
		menu: {},
		toolbar1 : "<?php echo $menu1;?>",
		toolbar2 : "<?php echo $menu2;?>,bfaSelect",
		toolbar3 : "<?php echo $menu3;?>,removeformat",
		media_strict: false,
		image_advtab: true,
		width : "100%",
		extended_valid_elements : "<?php echo $valid_elements;?>",
		content_css: [
			elgg.config.wwwroot + 'mod/tinymce/css/elgg_tinymce.css',
			'<?php echo $fa_url; ?>'
		],
// 		style_formats_merge: true,
		style_formats: [
			{
				title: 'Accordion header', 
				block: 'h3', 
				classes: 'theme-haarlem-intranet-accordion-header', 
				selector: 'p'
			},
			{
				title: 'Accordion content', 
				block: 'div', 
				classes: 'theme-haarlem-intranet-accordion-content',
				wrapper: true
			},
			{
				title: 'Normal', 
				format: 'p',
				classes: '',
			},
		]
	});

	// work around for IE/TinyMCE bug where TinyMCE loses insert carot
	if ($.browser.msie) {
		$(".embed-control").live('hover', function() {
			var classes = $(this).attr('class');
			var embedClass = classes.split(/[, ]+/).pop();
			var textAreaId = embedClass.substr(embedClass.indexOf('embed-control-') + "embed-control-".length);

			if (window.tinyMCE) {
				var editor = window.tinyMCE.get(textAreaId);
				if (elgg.tinymce.bookmark == null) {
					elgg.tinymce.bookmark = editor.selection.getBookmark(2);
				}
			}
		});
	}
}

elgg.register_hook_handler('init', 'system', elgg.tinymce.init);