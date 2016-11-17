<?php

$profile_fields = elgg_get_config("profile_fields");
$profile_field_values = elgg_get_plugin_setting("user_profile_fields_search_form", "search_advanced");
$profile_field_autocomplete_values = elgg_get_plugin_setting("user_profile_fields_search_form_autocomplete", "search_advanced");
if (!empty($profile_field_autocomplete_values)) {
	$profile_field_autocomplete_values = json_decode($profile_field_autocomplete_values, true);
} else {
	$profile_field_autocomplete_values = array();
}

if (empty($profile_field_values) || empty($profile_fields)) {
	return;
}

$submit_values = (array) get_input("search_advanced_profile_fields");
$profile_field_values = json_decode($profile_field_values, true);
$profile_field_soundex_submit_values = (array) get_input("search_advanced_profile_fields_soundex");
$output = array();

foreach ($profile_field_values as $profile_field) {
	if (!isset($profile_fields[$profile_field])) {
		continue;
	}

	$lan_key = "profile:" . $profile_field;
	$name = $profile_field;
	if (elgg_echo($lan_key) !== $lan_key) {
		$name = elgg_echo($lan_key);
	}
	
	$input_options = array(
		"name" => "search_advanced_profile_fields[" . $profile_field . "]",
		"value" => elgg_extract($profile_field, $submit_values),
	);
	
	$is_autocomplete = (bool) array_search($profile_field, $profile_field_autocomplete_values);
	
	$row = new stdClass();
	$row->label = $name;
	
	if ($is_autocomplete) {
		$input_options['class'] = 'elgg-input-text';
		$input_options['rel'] = $profile_field;
		$input_options['options'] = array('');
		
		$name_id = add_metastring($profile_field);
		$dbprefix = elgg_get_config('dbprefix');
		$query = "SELECT msv.string
		FROM {$dbprefix}metadata md
		JOIN {$dbprefix}metastrings msv ON md.value_id = msv.id
		JOIN {$dbprefix}entities e ON md.entity_guid = e.guid
		WHERE md.name_id = {$name_id}
		AND e.type = 'user'
		GROUP BY msv.string
		ORDER BY msv.string ASC";
				
		$metadata = get_data($query);
		
		if ($metadata) {
			foreach ($metadata as $md) {
				$input_options['options'][] = html_entity_decode($md->string);
			}
		}
		
		$row->input = elgg_view("input/dropdown", $input_options);
	} else {
		$row->input = elgg_view("input/text", $input_options);
	}
	$output[] = $row;
}

if (!empty($output)) {
	echo "<table class='search-advanced-user-profile-table mtm'>";
	foreach ($output as $row) {
		echo "<tr>";
		echo "<td><label>" . $row->label . "</label></td>";
		if (elgg_in_context("widgets")) {
			echo "<td>" . $row->input;
			
			echo "</td>";
		} else {
			echo "<td>" . $row->input . "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
	echo elgg_view("input/submit", array("value" => elgg_echo("search")));
}