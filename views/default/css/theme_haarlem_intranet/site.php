<?php
/**
 * CSS theme
 */
?>
/* <style> /**/

/* ***************************************
	MISC
*****************************************/
#dashboard-info {
	border: 1px solid #DCDCDC;
	margin: 0 10px 15px;
}
.elgg-sidebar input[type=text],
.elgg-sidebar input[type=password] {
	box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.1);
}
.elgg-module .elgg-list-river {
	border-top: none;
}
.elgg-module .elgg-list {
	margin-top: 0;
}
/* ***************************************
	TOPBAR MENU DROPDOWN
*****************************************/
.elgg-topbar-dropdown {
	padding-bottom: 8px; /* forces button to reach bottom of topbar */
}
.elgg-menu-topbar > li > .elgg-topbar-dropdown:hover {
	color: #EEE;
	cursor: default;
}
.elgg-menu-topbar-alt ul {
	position: absolute;
	display: none;
	background-color: #FFF;
	border: 1px solid #DEDEDE;
	text-align: left;
	top: 33px;
	margin-left: -100px;
	width: 180px;

	border-radius: 0 0 3px 3px;
	box-shadow: 1px 3px 5px rgba(0, 0, 0, 0.25);
}
.elgg-menu-topbar-alt li ul > li > a {
	text-decoration: none;
	padding: 10px 20px;
	background-color: #FFF;
	color: #444;
}
.elgg-menu-topbar-alt li ul > li > a:hover {
	background-color: #F0F0F0;
	color: #444;
}
.elgg-menu-topbar-alt > li:hover > ul {
	display: block;
}
.elgg-menu-item-account > a:after {
	content: "\bb";
	margin-left: 6px;
}

.elgg-search-header {
	top: 10px;
	left: 322px;
	position: absolute;
}

#theme-haarlem-intranet-header-help {
	position: absolute;
	right: 0;
	top: 10px;
}

.elgg-avatar > a > img {
	border-radius: 500px;
}

:focus > .fa,
.fa:hover,
.fa-hover {
	color: #<?php echo THEME_BLUE;?>;
}

.theme-haarlem-intranet-counter {
	color: white;
	background-color: red;
	
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	
	-webkit-box-shadow: -2px 2px 4px rgba(0, 0, 0, 0.50);
	-moz-box-shadow: -2px 2px 4px rgba(0, 0, 0, 0.50);
	box-shadow: -2px 2px 4px rgba(0, 0, 0, 0.50);
	
	position: absolute;
	text-align: center;
	top: 0px;
	left: 26px;
	min-width: 16px;
	height: 16px;
	font-size: 10px;
	font-weight: bold;
}

.theme-haarlem-intranet-topbar-dropdown {
	display: none;
	position: absolute;
	background: #FFF;
	padding: 0 20px 10px;
	right: 0px;
	width: 250px;
	text-align: left;
	border-top: 0px solid #FFF;
	border-left: 1px solid #<?php echo THEME_COLOR_GRAY; ?>;
	border-right: 1px solid #<?php echo THEME_COLOR_GRAY; ?>;
	border-bottom: 1px solid #<?php echo THEME_COLOR_GRAY; ?>;
	
	font-size: 12px;
	line-height: 14px;
	
	box-shadow: 0 3px 3px rgba(0, 0, 0, 0.1);
}

.elgg-menu-site-personal > li.elgg-state-active .theme-haarlem-intranet-topbar-dropdown,
.elgg-menu-site-personal > li:hover .theme-haarlem-intranet-topbar-dropdown {
	display: block;
}