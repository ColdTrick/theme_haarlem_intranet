<?php

if (empty($vars['value'])) {
	return;
}

$vars['value'] = str_replace('[accordeontitle]', '<h3 class="theme-haarlem-intranet-accordion-header">', $vars['value']);
$vars['value'] = str_replace('[/accordeontitle]', '</h3>', $vars['value']);
$vars['value'] = str_replace('[accordeoncontent]', '<div class="theme-haarlem-intranet-accordion-content">', $vars['value']);
$vars['value'] = str_replace('[/accordeoncontent]', '</div>', $vars['value']);