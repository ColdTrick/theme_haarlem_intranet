<?php
$group = elgg_get_page_owner_entity();

echo '<h1>' . elgg_view_entity_icon($group, 'small', array('class' => 'mrm')) . $group->name . "</h1>";