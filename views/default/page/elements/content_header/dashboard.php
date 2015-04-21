<?php

$user = elgg_get_logged_in_user_entity();

echo '<h1>' . elgg_view_entity_icon($user, 'small', array('use_hover' => false, 'class' => 'float')) . $user->name . "</h1>";