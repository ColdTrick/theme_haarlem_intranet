<?php

	$widget = $vars["entity"];
	
	$num_display = (int) $widget->num_display;
	if($num_display < 1){
		$num_display = 5;
	}
	$event_options = array("limit" => $num_display);
	
	$owner = $widget->getOwnerEntity();
	
	switch($owner->getType()){
		case "group":
			$event_options["container_guid"] = $owner->getGUID();
			break;
		case "user":
			switch($widget->type_to_show){
				case "owning":
					$event_options["owning"] = true;
					break;
				case "attending":
					$event_options["meattending"] = true;
					break;
			}
			break;
	}
	
	
	$tag = $widget->tag;
	if (!empty($tag)) {
		$event_options['entities_options']['metadata_name_value_pairs'][] = array('name' => 'tags', 'value' => $tag);
	}
	
	
	
	
	
	$events = theme_intranet_haarlem_search_events($event_options);
	
	$list_type = $widget->list_type;
	if (!in_array($list_type, array('default', 'simple'))) {
		$list_type = 'default';
	}
	
	if ($list_type === 'default') {
		$content = elgg_view_entity_list($events['entities'], array("count" => $events["count"], "offset" => 0, "limit" => $num_display, "pagination" => false, "full_view" => false));
	} else {
		$content = '';
		$entities = $events['entities'];
		foreach ($entities as $event) {
			$content .= "<div>";
			$content .= "<span title='" . strftime("%c", $event->start_day) . "'>" . strftime("%d %b", $event->start_day) . "</span> - ";
			$content .= "<a href='" . $event->getURL() . "'>" . $event->title . "</a>";
			$content .= "</div>";
		}
	}
	
	if(empty($content)){
		$content = elgg_echo("notfound");
	}
	
	if ($list_type == 'default') {
		if($user = elgg_get_logged_in_user_entity()){
			if($owner instanceof ElggGroup){
				$who_create_group_events = elgg_get_plugin_setting('who_create_group_events', 'event_manager'); // group_admin, members
				if((($who_create_group_events == "group_admin") && $owner->canEdit()) || (($who_create_group_events == "members") && $owner->isMember($user))){
					$add_link = "/events/event/new/" . $owner->getGUID();
				}
			} else {
				$who_create_site_events = elgg_get_plugin_setting('who_create_site_events', 'event_manager');
				if($who_create_site_events !== 'admin_only' || elgg_is_admin_logged_in()){
					$add_link = "/events/event/new";
				}
			}
			
			if($add_link){
				$content .= "<div>" . elgg_view("output/url", array("text" => elgg_echo("event_manager:menu:new_event"), "href" => $add_link)) . "</div>";
			}
		}
	}
	
	echo $content;
	