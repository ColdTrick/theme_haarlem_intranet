<?php
?>
<script>
// 	$('.elgg-output').accordion({
// 		autoHeight: false,
// 		icons: {
// 			header: '',
// 			headerSelected: 'fa fa-chevron-circle-down float-alt'
// 		},
// 		header: 'h3.theme-haarlem-intranet-accordion-header',
// 		collapsible: true,
// 		active: false,
// 	});

	var $headers = $('.elgg-output .theme-haarlem-intranet-accordion-header');
	$headers.addClass('ui-accordion-header').prepend('<span class="ui-icon fa fa-chevron-circle-right float-alt"></span>');
	$headers.next('.theme-haarlem-intranet-accordion-content').addClass('hidden');
	$headers.live('click', function() {
		$(this).toggleClass('ui-state-active').next('.theme-haarlem-intranet-accordion-content').toggle();
		$(this).find('.fa').toggleClass('fa-chevron-circle-right fa-chevron-circle-down');
	});
	
</script>