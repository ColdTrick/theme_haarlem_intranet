<?php

$fontawesome_path = elgg_get_plugins_path() . "fontawesome/vendors/font-awesome-4.1.0/css/font-awesome.css";
$contents = file_get_contents($fontawesome_path);

$icons = array();
$hex_codes = array();

/**
 * Get all CSS selectors that have a "content:" pseudo-element rule,
 * as well as all associated hex codes.
*/
preg_match_all( '/\.(icon-|fa-)([^,}]*)\s*:before\s*{\s*(content:)\s*"(\\\\[^"]+)"/s', $contents, $matches);
$icons = $matches[2];
$hex_codes = $matches[4];

// Add hex codes as icon array index.
$icons = array_combine( $hex_codes, $icons );

// Alphabetize the icons array by icon name.
asort( $icons );
?>
//<script>
var fa_icons = '<?php echo implode(',', $icons); ?>'
