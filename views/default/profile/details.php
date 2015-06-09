<?php

$user = elgg_get_page_owner_entity();

$profile_fields = elgg_get_config('profile_fields');

echo elgg_view("theme_haarlem_intranet/widgets_fix");

echo '<div id="profile-details">';

echo '<div class="profile-details-header">';
echo "<span class='float-alt'>{$user->birthday} {$user->gender}</span>";
echo "<h2>{$user->name}</h2>";
echo '</div>';

$haarlem_functie = $user->haarlem_functie;
$haarlem_werklocatie = $user->haarlem_werklocatie;
$haarlem_hoofdafdeling = implode(",", (array) $user->haarlem_hoofdafdeling);
$haarlem_afdeling = implode(",", (array) $user->haarlem_afdeling);
$haarlem_team = implode(",", (array) $user->haarlem_team);
$haarlem_werktijden = $user->haarlem_werktijden;
$haarlem_email = elgg_view("output/email", array("value" => $user->haarlem_email));
$haarlem_tel_werk = $user->haarlem_tel_werk;
$haarlem_mob_werk = $user->haarlem_mob_werk;
$haarlem_grip = $user->haarlem_grip;
$haarlem_tel_alt = $user->haarlem_tel_alt;
$haarlem_twitter = $user->haarlem_twitter;

echo <<<__TABLE
<table>
	<tr>
		<td>
			<ul class="prm">
				<li>
					<label>Functie:</label>
					{$haarlem_functie}
				</li>
				<li>
					<label>Werklocatie:</label>
					{$haarlem_werklocatie}
				</li>
				<li>				
					<label>Hoofdafdeling:</label>
					{$haarlem_hoofdafdeling}
				</li>
				<li>
					<label>Afdeling:</label>
					{$haarlem_afdeling}
				</li>
				<li>
					<label>Bureau/team:</label>
					{$haarlem_team}
				</li>
				<li>
					<label>Werktijden:</label>
					{$haarlem_werktijden}
				</li>
			</ul>
		</td>
		<td>
			<ul>
				<li>
					<span class='elgg-icon fa fa-at'></span>
					<label>Emailadres:</label>
					{$haarlem_email}
				</li>
				<li>
					<span class='elgg-icon fa fa-phone'></span>
					<label>Telefoonnummer werk:</label>
					{$haarlem_tel_werk}
				</li>
				<li>
					<span class='elgg-icon fa fa-phone'></span>
					<label>Mobiel nummer werk:</label>
					{$haarlem_mob_werk}
				</li>
				<li>
					<span class='elgg-icon fa fa-phone'></span>
					<label>Grip:</label>
					{$haarlem_grip}
				</li>
				<li>
					<span class='elgg-icon fa fa-phone'></span>
					<label>Ander telefoonnummer:</label>
					{$haarlem_tel_alt}
				</li>
				<li>
					<span class='elgg-icon fa fa-twitter'></span>
					<label>Twitter:</label>
					{$haarlem_twitter}
				</li>
			</ul>
		</td>
	</tr>
</table>

__TABLE;

echo elgg_view_module('info', 'Werkgebied', $user->haarlem_werkgebied);
echo elgg_view_module('info', 'Vraag mij over', $user->haarlem_vraag_mij);
echo elgg_view_module('info', 'Wie ben ik', $user->haarlem_wie_ben_ik);

$activity = elgg_list_river(array(
	'subject_guid' => $user->guid,
	'limit' => 10,
	'pagination' => false
));
if (!$activity) {
	$activity = elgg_echo('river:none');
}
echo elgg_view_module('info', 'Recente activiteit', $activity);

echo '</div>';