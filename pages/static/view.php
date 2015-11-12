<?php

$guid = (int) get_input("guid");

$ia = elgg_set_ignore_access(true);
$entity = get_entity($guid);
elgg_set_ignore_access($ia);

if (empty($entity) || !elgg_instanceof($entity, "object", "static")) {
	forward(REFERER);
}

$can_write_to_container = can_write_to_container(0, $entity->getOwnerGUID(), 'object', 'static');

if (!has_access_to_entity($entity) && !$entity->canEdit() && !$can_write_to_container) {
	register_error(elgg_echo("noaccess"));
	forward(REFERER);
}

$ia = elgg_set_ignore_access($can_write_to_container);
if ($entity->canEdit()) {
	elgg_register_menu_item("title", array(
		"name" => "edit",
		"href" => "static/edit/" . $entity->getGUID(),
		"text" => elgg_echo("edit"),
		"link_class" => "elgg-button elgg-button-action",
	));
		
	elgg_register_menu_item("title", array(
		"name" => "create_subpage",
		"href" => "static/add/" . $entity->getOwnerGUID() . "?parent_guid=" . $entity->getGUID(),
		"text" => elgg_echo("static:add:subpage"),
		"link_class" => "elgg-button elgg-button-action",
	));
}
elgg_set_ignore_access($ia);

// page owner (for groups)
$owner = $entity->getOwnerEntity();
if (elgg_instanceof($owner, "group")) {
	elgg_set_page_owner_guid($owner->getGUID());
}

// show breadcrumb
$ia = elgg_set_ignore_access(true);

$container_entity = $entity->getContainerEntity();
if (elgg_instanceof($container_entity, "object", "static")) {
	while(elgg_instanceof($container_entity, "object", "static")) {
		elgg_push_breadcrumb($container_entity->title, $container_entity->getURL());
		$container_entity = $container_entity->getContainerEntity();
	}
	
	elgg_set_config("breadcrumbs", array_reverse(elgg_get_config("breadcrumbs")));
	
	elgg_push_breadcrumb($entity->title);
}
elgg_set_ignore_access($ia);

// build content
$title = $entity->title;

$body = elgg_view_entity($entity, array("full_view" => true));

if ($entity->canComment()) {
	$body .= elgg_view_comments($entity, true, array("id" => "static-comments-" . $entity->getGUID()));
}

static_setup_page_menu($entity);

elgg_push_context('theme_haarlem_intranet_static_sidebar');
$nav = elgg_view_menu('page', array('sort_by' => 'name'));
elgg_pop_context();

$page = elgg_view_layout("two_sidebar", array(
	"filter" => "",
	"content" => $body,
	"title" => $title,
	"sidebar_alt" => $nav
));

echo elgg_view_page($title, $page);
