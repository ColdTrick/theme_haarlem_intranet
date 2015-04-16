<?php
/**
 * Elgg Profile CSS
 *
 * @package Profile
 */
?>
/* <style> /**/
/* ***************************************
	Profile
*************************************** */
.profile {
	float: left;
	margin-bottom: 15px;
}
.profile .elgg-inner {
	border: 1px solid #DCDCDC;
	border-radius: 3px;
}
#profile-details {
	padding-left: 15px;
}

/*** ownerblock ***/
#profile-owner-block {
	width: 200px;
	padding-top: 65px;
}
.profile-action-menu,
#profile-owner-block .large {
	margin-bottom: 10px;
}
.profile-action-menu a.elgg-button,
#profile-owner-block a.elgg-button {
	margin-bottom: 2px;
	text-align: center;
}
.profile-admin-menu {
	display: none;
}
.profile-admin-menu-wrapper a {
	display: block;
	margin: 3px 0 5px 0;
	padding: 2px 4px 2px 16px;
}
.profile-admin-menu-wrapper:before {
	content: "\00BB";
	float: left;
	padding-top: 1px;
}
.profile-admin-menu-wrapper li a {
	color: #FF0000;
	margin-bottom: 0;
}
.profile-admin-menu-wrapper a:hover {
	color: #000;
}
/*** profile details ***/
#profile-details .profile-details-header {
	background: #<?php echo THEME_BLUE; ?>;
	margin-bottom: 20px;
	padding: 10px;
}
#profile-details .profile-details-header h2 {
	color: white;
}

#profile-details > table {
	width: 100%;
	margin-bottom: 10px;
}
#profile-details > table ul {
	wdith: 50%;
}
#profile-details > table ul:first-child {
	padding-right: 10px;
}
#profile-details > table li {
	background: white;
	padding: 10px;
	margin-bottom: 5px;
}

#profile-details > table label {
	color: #<?php echo THEME_BLUE; ?>;
	display: inline-block;
    width: 150px;
}
#profile-details .elgg-module-info {
	background: white;
	padding: 10px;
}
#profile-details .elgg-module-info .elgg-head {
	background: white;
	padding: 0;
}
#profile-details .elgg-module-info .elgg-head h3 {
	color: #<?php echo THEME_BLUE; ?>;
}

.profile-banned-user {
	margin: 10px 0;
	padding: 20px;
	color: #B94A48;
	background-color: #F8E8E8;
	border: 1px solid #E5B7B5;
	border-radius: 5px;
}
.profile-banned-user h4 {
	color: #B94A48;
}