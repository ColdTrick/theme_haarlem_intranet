<?php
/**
 * Layout for main column with one sidebar
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['title']   Optional title for main content area
 * @uses $vars['content'] Content HTML for the main column
 * @uses $vars['sidebar'] Optional content that is added to the sidebar
 * @uses $vars['nav']     Optional override of the page nav (default: breadcrumbs)
 * @uses $vars['header']  Optional override for the header
 * @uses $vars['footer']  Optional footer
 * @uses $vars['class']   Additional class to apply to layout
 */

$class = 'elgg-layout elgg-layout-one-sidebar clearfix';
if (isset($vars['class'])) {
	$class = "$class {$vars['class']}";
}

$sidebar = elgg_view('page/elements/sidebar', $vars);
$sidebar_toggle = '';
$sidebar_class = '';

if (!empty($sidebar)) {
	$sidebar_toggle = elgg_view('page/elements/sidebar_toggle', $vars);
	if (theme_haarlem_intranet_sidebar_collapsed()) {
		$sidebar_class = ' collapsed';
	}
}
?>

<div class="<?php echo $class; ?>">
	<?php echo $sidebar_toggle; ?>
	<div class="elgg-sidebar<?php echo $sidebar_class; ?>">
		<?php
			// With the mobile experience in mind, the content order is changed in this theme,
			// by moving sidebar below main content.
			// On smaller screens, blocks are stacked in left to right order: content, sidebar.
			echo $sidebar;
		?>
	</div>
	<div class="elgg-main elgg-body">
		<?php
			echo elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));
			
			$layout = elgg_extract('layout', $vars);
			if ($layout !== 'content') {
				echo elgg_view('page/layouts/content/header', $vars);
			}
			
			// @todo deprecated so remove in Elgg 2.0
			if (isset($vars['area1'])) {
				echo $vars['area1'];
			}
			if (isset($vars['content'])) {
				echo $vars['content'];
			}
			
			echo elgg_view('page/layouts/elements/footer', $vars);
		?>
	</div>
	
</div>
