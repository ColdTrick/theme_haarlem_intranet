<?php
/**
 * Page icon
 *
 * Uses a separate icon view due to dependency on annotation
 *
 * @package ElggPages
 *
 * @uses $vars['entity']
 * @uses $vars['annotation']
 */

$annotation = $vars['annotation'];
$entity = get_entity($annotation->entity_guid);

// Get size
// if (!in_array($vars['size'], array('small', 'medium', 'large', 'tiny', 'master', 'topbar'))) {
// 	$vars['size'] = "medium";
// }


?>

<a href="<?php echo $annotation->getURL(); ?>" title="<?php echo $entity->title; ?>">
<?php 
echo elgg_view_icon('file-text-o');
?>
</a>
