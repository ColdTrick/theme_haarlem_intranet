<?php
?>
//<script>
elgg.provide("elgg.theme_haarlem_intranet");

elgg.theme_haarlem_intranet.izine_nav = function() {

	var $item = $(this).parent().parent();
	var $container = $item.parent();
	var $new_item = null;
	var right = $(this).hasClass('elgg-icon-chevron-right');
	if (right) {
		$new_item = $item.next('div');

		if (!$new_item.length) {
			$new_item = $container.find('> div:first');
		}
	} else {
		$new_item = $item.prev('div');

		if (!$new_item.length) {
			$new_item = $container.find('> div:last');
		}
	}

	$container.find('> div').hide();
	$new_item.show();

	$list = $container.find('> ul.theme-haarlem-intranet-izine-list');
	if (!$list.length) {
		return;
	}

	var rel = $new_item.attr('rel');
	$list.find('> li').removeClass('elgg-state-selected');
	$list.find('> li[rel="' + rel + '"]').addClass('elgg-state-selected');
};

elgg.theme_haarlem_intranet.toggle_sidebar = function(event) {
	var $sidebar_toggle = $('.theme-haarlem-intranet-sidebar-toggle a');
	elgg.action('theme_haarlem_intranet/toggle_sidebar');

	var text = '<span class="elgg-icon-exchange  elgg-icon fa fa-exchange"></span>';
	if ($('.elgg-sidebar').hasClass('collapsed')) {
		text += elgg.echo('theme_haarlem_intranet:sidebar_toggle:collapse');
	} else {
		text += elgg.echo('theme_haarlem_intranet:sidebar_toggle:toggle');
	}

	$sidebar_toggle.html(text);
	
	$('.elgg-sidebar').toggleClass('collapsed');

	event.preventDefault();
	return false;
};

elgg.theme_haarlem_intranet.init = function() {

	$('.elgg-system-messages li').animate({opacity: 0.9}, 6000);
	$('.elgg-system-messages li.elgg-state-success').fadeOut('slow');

	$(".elgg-owner-block > .elgg-body > h2").click(function() {
		$(this).find(".elgg-icon").toggle();
		$(this).next().slideToggle();
	});

	$('.elgg-widget-instance-izine .theme-haarlem-intranet-izine-image > .elgg-icon').live('click', elgg.theme_haarlem_intranet.izine_nav);

	$('.theme-haarlem-intranet-sidebar-toggle a').click(elgg.theme_haarlem_intranet.toggle_sidebar);

	$('.elgg-menu-site .elgg-menu-site-toggle').click(function(event) {
		event.preventDefault();
		event.stopPropagation();
		$(this).toggleClass('fa-angle-down fa-angle-right');
		$(this).parent().next().find('>li').toggle();
	});

	$('.elgg-menu-site .elgg-menu-parent').click(function(event) {
		if ($(this).find('.elgg-menu-site-toggle').is(':visible')) {
			event.preventDefault();
			event.stopPropagation();
			$(this).find('.elgg-menu-site-toggle').toggleClass('fa-angle-down fa-angle-right');
			$(this).next().find('>li').toggle();
		}
	});
}

elgg.register_hook_handler('init', 'system', elgg.theme_haarlem_intranet.init);