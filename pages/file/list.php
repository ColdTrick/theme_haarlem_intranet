<?php

$page_owner 		= elgg_get_page_owner_entity();
$folder_guid 		= (int) get_input("folder_guid", 0);
$draw_page 			= get_input("draw_page", true);

$sort_by 			= get_input("sort_by");
$direction 			= get_input("direction");
$limit				= file_tools_get_list_length();
$offset				= (int) get_input("offset", 0);

if(empty($page_owner) || (!elgg_instanceof($page_owner, "user") && !elgg_instanceof($page_owner, "group"))) {
	forward(REFERER);
}

group_gatekeeper();

if(empty($sort_by)){
	$sort_value = "e.time_created";
	if(elgg_instanceof($page_owner, "group") && !empty($page_owner->file_tools_sort)){
		$sort_value = $page_owner->file_tools_sort;
	} elseif($site_sort_default = elgg_get_plugin_setting("sort", "file_tools")){
		$sort_value = $site_sort_default;
	}

	$sort_by = $sort_value;
}

if(empty($direction)){
	$sort_direction_value = "asc";
	if(elgg_instanceof($page_owner, "group") && !empty($page_owner->file_tools_sort_direction)){
		$sort_direction_value = $page_owner->file_tools_sort_direction;
	} elseif($site_sort_direction_default = elgg_get_plugin_setting("sort_direction", "file_tools")){
		$sort_direction_value = $site_sort_direction_default;
	}

	$direction = $sort_direction_value;
}

$wheres = array();
$wheres[] = "NOT EXISTS (
			SELECT 1 FROM " . elgg_get_config("dbprefix") . "entity_relationships r
			WHERE r.guid_two = e.guid AND
			r.relationship = '" . FILE_TOOLS_RELATIONSHIP . "')";

$files_options = array(
	"type" => "object",
	"subtype" => "file",
	"limit" => $limit,
	"offset" => $offset,
	"container_guid" => $page_owner->getGUID()
);

$files_options["joins"][] = "JOIN " . elgg_get_config("dbprefix") . "objects_entity oe ON oe.guid = e.guid";

if($sort_by == "simpletype") {
	$files_options["order_by_metadata"] = array("name" => "mimetype", "direction" => $direction);
} else {
	$files_options["order_by"] = $sort_by . " " . $direction;
}

$folder = false;
if($folder_guid !== false) {
	if($folder_guid && ($folder = get_entity($folder_guid)) && elgg_instanceof($folder, "object", FILE_TOOLS_SUBTYPE) && ($folder->getContainerGUID() == $page_owner->getGUID())){
		$files_options["relationship"] = FILE_TOOLS_RELATIONSHIP;
		$files_options["relationship_guid"] = $folder_guid;
		$files_options["inverse_relationship"] = false;
	} else {
		$folder = false; // just to be save
		$files_options["wheres"] = $wheres;
	}
}

// get the files
$files = elgg_get_entities_from_relationship($files_options);

// get count
$files_options["count"] = true;
$files_count = elgg_get_entities_from_relationship($files_options);

// do we need a more button
$show_more = false;
if ($limit) {
	$show_more = $files_count > ($offset + $limit);
}

if(!$draw_page) {
	echo elgg_view("file_tools/list/files", array(
		"folder" => $folder,
		"files" => $files,
		"sort_by" => $sort_by,
		"direction" => $direction,
		"show_more" => $show_more,
		"limit" => $limit,
		"offset" => $offset
	));
} else {
	// build breadcrumb
	elgg_push_breadcrumb(elgg_echo("file"), "file/all");
	elgg_push_breadcrumb($page_owner->name);
	
	// register title button to add a new file
	if (elgg_is_logged_in()) {
		$owner = elgg_get_page_owner_entity();
		if ($owner && $owner->canWriteToContainer()) {
			$guid = $owner->getGUID();

			elgg_register_menu_item('title', array(
				'name' => 'file_tools:upload:file',
				'text' => elgg_echo("file:upload"),
				'id' => 'file_tools_list_upload_file_toggle',
				'link_class' => 'elgg-button elgg-button-action'
			));

			elgg_register_menu_item('title', array(
				'name' => 'file_tools:new:title',
				'text' => elgg_echo("file_tools:new:title"),
				'id' => 'file_tools_list_new_folder_toggle',
				'link_class' => 'elgg-button elgg-button-action'
			));
		}
	}
	
	// get data for tree
	$folders = file_tools_get_folders($page_owner->getGUID());

	// build page elements
	$title_text = elgg_echo("file:user", array($page_owner->name));
	
	$body = "<div id='file_tools_list_files_container' class='elgg-content'>" . elgg_view("graphics/ajax_loader", array("hidden" => false)) . "</div>";
	
	// make sidebar
	$sidebar = elgg_view("file_tools/list/tree", array("folder" => $folder, "folders" => $folders));
	$sidebar .= elgg_view("file_tools/sidebar/sort_options");
	
	// filter/tabs
	$filter = "";
	if(elgg_instanceof($page_owner, "user")){
		if($page_owner->getGUID() == elgg_get_logged_in_user_guid()){
			$filter = elgg_view('page/layouts/content/filter', array(
				'filter_context' => "mine"
			));
		} else {
			$filter = elgg_view('page/layouts/content/filter', array(
				'filter_context' => $page_owner->username
			));
		}
	}
	
	// build page params
	$params = array(
		"title" => $title_text,
		"content" => $filter . $body,
		"sidebar_alt" => $sidebar
	);
	
	echo elgg_view_page($title_text, elgg_view_layout("two_sidebar", $params));
}
