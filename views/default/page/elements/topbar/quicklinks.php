<?php

$user = elgg_get_logged_in_user_entity();

echo elgg_view("output/url", array(
	"title" => elgg_echo("quicklinks"),
	"href" => false,
	"text" => elgg_view_icon("star")
));

echo "<div class='theme-haarlem-intranet-topbar-dropdown'>";
elgg_push_context("topbar");
echo elgg_view("quicklinks/list", array("limit" => false));
elgg_pop_context();
echo "</div>";