<?php
/**
 * Search box
 *
 * @uses $vars['value'] Current search query
 * @uses $vars['class'] Additional class
 */

$placeholder = elgg_extract('placeholder', $vars, elgg_echo('theme_haarlem_intranet:search'));
$container_entity = elgg_extract('container_entity', $vars);

if (array_key_exists('value', $vars)) {
	$value = $vars['value'];
} elseif ($value = get_input('q', get_input('tag', NULL))) {
	$value = $value;
} else {
	$value = $placeholder;
}

$class = "elgg-search";
if (isset($vars['class'])) {
	$class = "$class {$vars['class']}";
}
// @todo - why the strip slashes?
$value = stripslashes($value);

// @todo - create function for sanitization of strings for display in 1.8
// encode <,>,&, quotes and characters above 127
if (function_exists('mb_convert_encoding')) {
	$display_query = mb_convert_encoding($value, 'HTML-ENTITIES', 'UTF-8');
} else {
	// if no mbstring extension, we just strip characters
	$display_query = preg_replace("/[^\x01-\x7F]/", "", $value);
}
$display_query = htmlspecialchars($display_query, ENT_QUOTES, 'UTF-8', false);
$show_type_selection = elgg_extract('show_type_selection', $vars, true);
$type_selection = '';
if ($show_type_selection) {
	$type_selection = '<td>' . elgg_view("search_advanced/search/type_selection") . '</td>';
}

$container = '';
if ($container_entity && $container_entity instanceof ElggGroup) {
	$container = elgg_view('input/hidden', array(
		'name' => 'container_guid',
		'value' => $container_entity->guid
	));
}

$extra_input = elgg_extract('extra_input', $vars, '');

$input_class = 'search-input';
if (elgg_extract('autocomplete', $vars, true) === false) {
	$input_class = 'search-input-no-autocomplete';
}

?>
<form class="<?php echo $class; ?>" action="<?php echo elgg_get_site_url(); ?>search" method="get">
	<fieldset>
		<table>
			<tr>
				<?php echo $type_selection;?>
				<td style="width: 100%">
					<input type="text" class="<?php echo $input_class; ?>" size="21" name="q" value="<?php echo $display_query; ?>" onblur="if (this.value=='') { this.value='<?php echo $placeholder; ?>' }" onfocus="if (this.value=='<?php echo $placeholder; ?>') { this.value='' };" />
				</td>
				<td>
					<?php
					echo elgg_view("output/url", array(
						'href' => false,
						'text' => elgg_view_icon('search'),
						'onclick' => '$(this).parents("form").submit()'
					));
					?>
					<input type="submit" value="<?php echo elgg_echo('search:go'); ?>" class="search-submit-button" />
				</td>
			</tr>
		</table>
	</fieldset>
	<?php
		echo $container;
		echo $extra_input;
	?>
</form>