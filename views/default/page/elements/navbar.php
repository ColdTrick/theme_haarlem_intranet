<?php
/**
 * theme navbar
 *
 */

// drop-down login
echo elgg_view('core/account/login_dropdown');

?>

<a class="elgg-button-nav" rel="toggle" data-toggle-selector=".elgg-nav-collapse" href="#elgg-nav-collapse">
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
	<span class="icon-bar"></span>
</a>

<div class="elgg-nav-collapse" id="elgg-nav-collapse">
	<?php
		echo elgg_view_menu('site', array(
			'sort_by' => 'priority'
		));
		echo elgg_view_menu('personal', array(
			'sort_by' => 'priority',
			'class' => 'elgg-menu-site'
		));
	?>
</div>
