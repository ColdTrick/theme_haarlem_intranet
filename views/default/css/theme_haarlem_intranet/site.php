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
	margin: 0;
}
.elgg-search-header table {
	width: 573px;
}
form.elgg-search {
	height: 32px;
	border: 2px solid #414042;
	background: #414042;
}
.elgg-search-header .elgg-icon-search {
	color: white;
	background: #414042;
	font-size: 22px !important;
	padding: 4px;
	cursor: pointer;
}
.elgg-search-header .elgg-icon-search:hover {
	color: #808285;
}
.elgg-search input.search-input[type="text"] {
	height: 32px;
	padding: 4px;
	border: none;
}

.elgg-search input.search-input[type="text"]:focus {
	background: white;
}

.search-advanced-type-selection > li > a {
	background: none;
	height: auto;
	line-height: 32px;
}
.search-advanced-type-selection-dropdown > li {
	padding: 0 4px;
}
.search-advanced-type-selection-dropdown > li > a {
	padding: 4px 0;
}
.search-advanced-type-selection > li > a:after {
	padding: 0 4px;
}
.search-advanced-type-selection-dropdown > li:hover {
	background: #808285;
}
.search-advanced-type-selection-dropdown > li > a:hover {
	background: none;
}
.search-advanced-type-selection-dropdown > li:hover a{
	color: #bcbec0;
}

.search-advanced-type-selection-dropdown {
	line-height: auto;
	border: 2px solid #414042;
	left: -2px;
    text-align: left;
    top: 23px;
    right: auto;
    padding: 0;
}
.search-advanced-type-selection .elgg-icon {
	color: white;
	display: inline;
	
}
.search-advanced-type-selection .elgg-icon:hover {
	color: #808285;
}

#theme-haarlem-intranet-header-help {
	position: absolute;
	right: 0;
	top: 10px;
	background: #414042;
}
#theme-haarlem-intranet-header-help:hover {
	color: #bcbec0;
	background: #414042;
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
	line-height: 15px;
}

.theme-haarlem-intranet-topbar-dropdown {
	display: none;
	position: absolute;
	background: #FFF;
	padding: 0;
	right: 0px;
	top: 40px;
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
.theme-haarlem-intranet-topbar-dropdown .elgg-menu-quicklinks {
	padding: 5px;
	border-bottom: 4px solid #<?php echo THEME_GREEN; ?>;
}
.theme-haarlem-intranet-topbar-dropdown .elgg-menu-quicklinks li {
	border: none;
	padding: 5px;
}
.theme-haarlem-intranet-topbar-dropdown .elgg-menu-quicklinks li .elgg-icon {
	color: #bcbec0;
}
.theme-haarlem-intranet-topbar-dropdown .elgg-menu-quicklinks li a {
	color: #414042;
}
.theme-haarlem-intranet-topbar-dropdown .alliander-theme-quicklinks-item {
	padding: 10px;
	color: #414042;
}
#widget_manager_widgets_select .widget_manager_widgets_lightbox_wrapper {
	margin-bottom: 10px;
}

.mce-i-fa {
	font-family: 'FontAwesome' !important;
}

.elgg-menu-site > li > ul {
	top: 40px;
}

.elgg-menu-site .elgg-child-menu a:hover {
	background: #<?php echo THEME_GREEN; ?>;
	color: white;
}

.elgg-menu-site .menu-builder-edit-menu-item {
	display: none;
}
