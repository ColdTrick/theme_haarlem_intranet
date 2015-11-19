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
$haarlem_organisatie_eenheid = (array) $user->haarlem_organisatie_eenheid;
$haarlem_werktijden = $user->haarlem_werktijden;
$haarlem_email = elgg_view("output/email", array("value" => $user->haarlem_email));
$haarlem_tel_werk = $user->haarlem_tel_werk;
$haarlem_mob_werk = $user->haarlem_mob_werk;
$haarlem_grip = $user->haarlem_grip;
$haarlem_tel_alt = $user->haarlem_tel_alt;
$haarlem_twitter = $user->haarlem_twitter;
$haarlem_linkedin = $user->haarlem_linkedin;
$haarlem_facebook = $user->haarlem_facebook;

$social_links = array();
if (!empty($haarlem_twitter)) {
	$social_links['twitter'] =  '<td class="icon-cell"><span class="elgg-icon fa fa-twitter"></span></td><td class="pls">' . elgg_view('output/url', array('text' => 'Twitter', 'href' => $haarlem_twitter, 'target' => '_blank')) . '</td>';
}
if (!empty($haarlem_linkedin)) {
	$social_links['linkedin'] = '<td class="icon-cell"><span class="elgg-icon fa fa-linkedin"></span></td><td class="pls">' . elgg_view('output/url', array('text' => 'LinkedIn', 'href' => $haarlem_linkedin, 'target' => '_blank')) . '</td>';
}
if (!empty($haarlem_facebook)) {
	$social_links['facebook'] = '<td class="icon-cell"><span class="elgg-icon fa fa-facebook"></span></td><td class="pls">' . elgg_view('output/url', array('text' => 'Facebook', 'href' => $haarlem_facebook, 'target' => '_blank')) . '</td>';
}

$social_links_row = '';
if (!empty($social_links)) {
	$social_links_row = '<tr><td colspan="3"><table><tr>' . implode('', $social_links) . '</tr></table></td></tr>';
}

if (count($haarlem_organisatie_eenheid) > 1) {
	
	$haarlem_functie_parts = explode(',', $haarlem_functie);
	$haarlem_werktijden_parts = explode(',', $haarlem_werktijden);
	
	echo "<table class='haarlem-profile-details'><tr>";
	foreach ($haarlem_organisatie_eenheid as $index => $oe) {
		$oe_parts = explode('|', $oe);
		$oe_haarlem_functie = elgg_extract($index, $haarlem_functie_parts);
		$oe_hoofdafdeling = elgg_extract(0, $oe_parts);
		$oe_afdeling = elgg_extract(1, $oe_parts);
		$oe_team = elgg_extract(2, $oe_parts);
		$oe_haarlem_werktijden = elgg_extract($index, $haarlem_werktijden_parts);
		$class = '';
		if ($index == 0) {
			$class = ' class="prm"';
		}
		echo <<<__TD

		<td{$class}>
			<table>
				<tr>
					<td class='label-cell'><label>Functie:</label></td>
					<td>{$oe_haarlem_functie}</td>
				</tr>
				<tr>
					<td class='label-cell'><label>Hoofdafdeling:</label></td>
					<td>{$oe_hoofdafdeling}</td>
				</tr>
				<tr>
					<td class='label-cell'><label>Afdeling:</label></td>
					<td>{$oe_afdeling}</td>
				</tr>
				<tr>
					<td class='label-cell'><label>Bureau/team:</label></td>
					<td>{$oe_team}</td>
				</tr>
				<tr>
					<td class='label-cell'><label>Werktijden:</label></td>
					<td>{$oe_haarlem_werktijden}</td>
				</tr>
			</table>
		</td>
__TD;
	}
	echo "</tr></table>";
	
	if (!empty($haarlem_twitter)) {
		$haarlem_twitter = elgg_view('output/url', array('text' => 'Twitter', 'href' => $haarlem_twitter, 'target' => '_blank'));
	}
	if (!empty($haarlem_linkedin)) {
		$haarlem_linkedin = elgg_view('output/url', array('text' => 'LinkedIn', 'href' => $haarlem_linkedin, 'target' => '_blank'));
	}
	if (!empty($haarlem_facebook)) {
		$haarlem_facebook = elgg_view('output/url', array('text' => 'Facebook', 'href' => $haarlem_facebook, 'target' => '_blank'));
	}
	
	echo <<<__TABLE
<table class='haarlem-profile-details'>
	<tr>
		<td class="prm">
			<table>
				<tr>
					<td class='icon-cell'><span class='elgg-icon fa fa-at'></span></td>
					<td class='label-cell'><label>Emailadres:</label></td>
					<td>{$haarlem_email}</td>
				</tr>
				<tr>
					<td class='icon-cell'><span class='elgg-icon fa fa-phone'></span></td>
					<td class='label-cell'><label>Telefoonnummer werk:</label></td>
					<td>{$haarlem_tel_werk}</td>
				</tr>
				<tr>
					<td class='icon-cell'><span class='elgg-icon fa fa-phone'></span></td>
					<td class='label-cell'><label>Mobiel nummer werk:</label></td>
					<td>{$haarlem_mob_werk}</td>
				</tr>
				<tr>
					<td class='icon-cell'><span class='elgg-icon fa fa-phone'></span></td>
					<td class='label-cell'><label>Grip:</label></td>
					<td>{$haarlem_grip}</td>
				</tr>
				<tr>
					<td class='icon-cell'><span class='elgg-icon fa fa-phone'></span></td>
					<td class='label-cell'><label>Ander telefoonnummer:</label></td>
					<td>{$haarlem_tel_alt}</td>
				</tr>
			</table>
		</td>
		<td>
			<table>
				<tr>
					<td class='label-cell'><label>Werklocatie:</label></td>
					<td>{$haarlem_werklocatie}</td>
				</tr>
				<tr>
					<td class="icon-cell"><span class="elgg-icon fa fa-twitter"></span></td>
					<td>{$haarlem_twitter}</td>
				</tr>
				<tr>
					<td class="icon-cell"><span class="elgg-icon fa fa-linkedin"></span></td>
					<td>{$haarlem_linkedin}</td>
				</tr>
				<tr>
					<td class="icon-cell"><span class="elgg-icon fa fa-facebook"></span></td>
					<td>{$haarlem_facebook}</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
__TABLE;
} else {
	echo <<<__TABLE
<table class='haarlem-profile-details'>
	<tr>
		<td class="prm">
			<table>
				<tr>
					<td class='label-cell'><label>Functie:</label></td>
					<td>{$haarlem_functie}</td>
				</tr>
				<tr>
					<td class='label-cell'><label>Werklocatie:</label></td>
					<td>{$haarlem_werklocatie}</td>
				</tr>
				<tr>
					<td class='label-cell'><label>Hoofdafdeling:</label></td>
					<td>{$haarlem_hoofdafdeling}</td>
				</tr>
				<tr>
					<td class='label-cell'><label>Afdeling:</label></td>
					<td>{$haarlem_afdeling}</td>
				</tr>
				<tr>
					<td class='label-cell'><label>Bureau/team:</label></td>
					<td>{$haarlem_team}</td>
				</tr>
				<tr>
					<td class='label-cell'><label>Werktijden:</label></td>
					<td>{$haarlem_werktijden}</td>
				</tr>
			</table>
		</td>
		<td>
			<table>
				<tr>
					<td class='icon-cell'><span class='elgg-icon fa fa-at'></span></td>
					<td class='label-cell'><label>Emailadres:</label></td>
					<td>{$haarlem_email}</td>
				</tr>
				<tr>
					<td class='icon-cell'><span class='elgg-icon fa fa-phone'></span></td>
					<td class='label-cell'><label>Telefoonnummer werk:</label></td>
					<td>{$haarlem_tel_werk}</td>
				</tr>
				<tr>
					<td class='icon-cell'><span class='elgg-icon fa fa-phone'></span></td>
					<td class='label-cell'><label>Mobiel nummer werk:</label></td>
					<td>{$haarlem_mob_werk}</td>
				</tr>
				<tr>
					<td class='icon-cell'><span class='elgg-icon fa fa-phone'></span></td>
					<td class='label-cell'><label>Grip:</label></td>
					<td>{$haarlem_grip}</td>
				</tr>
				<tr>
					<td class='icon-cell'><span class='elgg-icon fa fa-phone'></span></td>
					<td class='label-cell'><label>Ander telefoonnummer:</label></td>
					<td>{$haarlem_tel_alt}</td>
				</tr>
				{$social_links_row}
			</table>
		</td>
	</tr>
</table>
__TABLE;
}

echo elgg_view_module('info', 'Werkgebied', $user->haarlem_werkgebied);
echo elgg_view_module('info', 'Vraag mij over', $user->haarlem_vraag_mij);
echo elgg_view_module('info', 'Wie ben ik', $user->haarlem_wie_ben_ik);

// Organisatienevenfuncties
$functions = (array) $user->haarlem_organisatienevenfuncties;
if (!(empty($functions))) {
	echo elgg_view_module('info', 'Organisatienevenfuncties', implode(', ', $functions));
}

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