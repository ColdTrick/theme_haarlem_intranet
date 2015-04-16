<?php

$user = elgg_get_page_owner_entity();

$profile_fields = elgg_get_config('profile_fields');

echo elgg_view("theme_haarlem_intranet/widgets_fix");

echo '<div id="profile-details">';

echo '<div class="profile-details-header">';
echo "<span class='float-alt'>{$user->birthday} {$user->gender}</span>";
echo "<h2>{$user->name}</h2>";
echo '</div>';

echo <<<__TABLE
<table>
	<tr>
		<td>
			<ul>
				<li>
					<label>Functie:</label>
					{$user->functie}
				</li>
				<li>
					<label>Werklocatie:</label>
					{$user->locatie}
				</li>
				<li>				
					<label>Hoofdafdeling:</label>
					{$user->hoofdafdeling}
				</li>
				<li>
					<label>Afdeling:</label>
					{$user->afdeling}
				</li>
				<li>
					<label>Bureau/team:</label>
					{$user->team}
				</li>
				<li>
					<label>Werktijden:</label>
					{$user->werktijden}
				</li>
			</ul>
		</td>
		<td>
			<ul>
				<li>
					<label>Emailadres:</label>
					{$user->email}
				</li>
				<li>
					<label>Telefoonnummer werk:</label>
					{$user->phone}
				</li>
				<li>
					<label>Mobiel nummer werk:</label>
					{$user->mobile}
				</li>
				<li>
					<label>Grip:</label>
					{$user->grip}
				</li>
				<li>
					<label>Ander telefoonnummer:</label>
					{$user->phone_other}
				</li>
				<li>
					<label>Twitter:</label>
					{$user->twitter}
				</li>
			</ul>
		</td>
	</tr>
</table>

__TABLE;

echo elgg_view_module('info', 'Werkgebied', $user->description);
echo elgg_view_module('info', 'Vraag mij over', $user->description);
echo elgg_view_module('info', 'Wie ben ik', $user->description);

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