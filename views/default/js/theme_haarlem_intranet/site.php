<?php
?>
//<script>
elgg.provide("elgg.theme_haarlem_intranet");

elgg.theme_haarlem_intranet.init = function() {
	$(".elgg-owner-block > .elgg-body > h2").click(function() {
		$(this).find(".elgg-icon").toggle();
		$(this).next().slideToggle();
	});
}

elgg.register_hook_handler('init', 'system', elgg.theme_haarlem_intranet.init);