<?php

$page_owner = elgg_get_page_owner_entity();

$body = '<div class="elgg-divide-bottom pbs">';
$body .= '<label class="prs">' . elgg_echo('Mijn werkgebied') . ':</label>';
$body .= elgg_get_excerpt($page_owner->haarlem_werkgebied, 70);
$body .= '</div>';
$body .= '<div class="pts">';
$body .= '<label class="prs">' . elgg_echo('Vraag mij over') . ':</label>';
$body .= elgg_get_excerpt($page_owner->haarlem_vraag_mij, 70);
$body .= '</div>';

echo elgg_view_module('aside', '', $body);