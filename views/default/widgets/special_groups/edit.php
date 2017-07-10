<?php
$widget = $vars['entity'];

echo "<div>";
echo elgg_echo("groups") . "<br />";
echo elgg_view("input/hidden", array("name" => "params[group_guids]", "value" => 0));
echo elgg_view("input/grouppicker", array("name" => "params[group_guids]", "values" => $widget->group_guids));
echo "</div>";
