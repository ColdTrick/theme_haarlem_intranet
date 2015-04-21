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

.elgg-owner-block-group .elgg-head > .elgg-image-block .elgg-image img,
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

.theme-haarlem-intranet-topbar-dropdown {
	border-bottom: 1px solid #999999;
    border-left: 1px solid #999999;
    border-radius: 0 0 4px 4px;
    border-right: 1px solid #999999;
    box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.25);
    right: -1px;
}
.theme-haarlem-intranet-topbar-dropdown .elgg-menu-quicklinks {
	padding: 0;
	border-bottom: 4px solid #<?php echo THEME_GREEN; ?>;
	
}
.theme-haarlem-intranet-topbar-dropdown .elgg-menu-quicklinks li {
	border: none;
	height: 20px;
	padding: 0;
}
.theme-haarlem-intranet-topbar-dropdown .elgg-menu-quicklinks li .elgg-icon {
	color: #bcbec0;
}
.theme-haarlem-intranet-topbar-dropdown .elgg-menu-quicklinks li > a {
	color: #414042;
	height: 20px;
    padding: 3px 13px 0;
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
	width: auto;
}

.elgg-menu-site .elgg-child-menu a {
	font-weight: normal;
}

.elgg-menu-site .elgg-child-menu a:hover {
	background: #<?php echo THEME_GREEN; ?>;
	color: white;
}

.elgg-menu-site .menu-builder-edit-menu-item {
	display: none;
}

.theme-haarlem-intranet-owner-block-section .elgg-head a > .elgg-icon-chevron-circle-down,
.theme-haarlem-intranet-owner-block-section .elgg-head a.elgg-state-active > .elgg-icon-chevron-circle-right {
	display: none;
}

.theme-haarlem-intranet-owner-block-section .elgg-head a.elgg-state-active > .elgg-icon-chevron-circle-down {
	display: inline;
}

.elgg-menu-site.elgg-menu-personal .elgg-child-menu {
	left: auto;
	right: -1px;
}

.elgg-owner-block-group .elgg-head {
	background: white;
	margin-bottom: 20px;
}
.elgg-owner-block-group .elgg-head > .elgg-image-block {
	background: #<?php echo THEME_BLUE; ?>;
	padding: 2px;
	height: 40px;
	overflow: hidden;
}
.elgg-owner-block-group .elgg-head > .elgg-image-block .elgg-body a {
	color: white;
	font-size: 17px;
	font-family: "Source Sans Pro",sans-serif;
	line-height: 40px;
}

.elgg-owner-block-group .theme-haarlem-intranet-briefdescription {
	padding: 10px 20px 5px;
}
.elgg-owner-block-group .theme-haarlem-intranet-status {
	padding: 5px 20px 10px 30px;
	font-weight: bold;
}
.elgg-owner-block-group .theme-haarlem-intranet-status .elgg-icon-unlock-alt{
	color: #<?php echo THEME_GREEN; ?>;
}

.theme-haarlem-intranet-owner-block-section,
.theme-haarlem-intranet-owner-block-section > .elgg-head {
	margin: 0;
}
.theme-haarlem-intranet-owner-block-section > .elgg-head {
	background: #<?php echo THEME_BLUE; ?>;
	box-shadow: none;
	margin-top: 2px;
}
.theme-haarlem-intranet-owner-block-section > .elgg-head a {
	background: #<?php echo THEME_BLUE; ?>;
	color: white;
	font-size: 17px;
	font-family: "Source Sans Pro",sans-serif;
}
.theme-haarlem-intranet-owner-block-section > .elgg-head .elgg-icon {
	color: white;
}
.theme-haarlem-intranet-owner-block-section > .elgg-body > div {
	padding: 10px;
}

.elgg-owner-block-group .elgg-menu-title {
	float: none;
	margin: 0;
}
.elgg-owner-block-group .elgg-menu-title > li {
	margin: 2px 0 0;
	display: block;
}
.elgg-owner-block-group .elgg-menu-title > li > a {
	border-radius: 0;
	border: none;
	font-size: 17px;
	font-family: "Source Sans Pro",sans-serif;
	padding: 9px 10px;
}

.elgg-page-content-header > .elgg-inner > h1 {
	font-size: 24px;
	font-family: "Source Sans Pro",sans-serif;
	color: white;
	position: absolute;
	top: 26px;
	line-height: 32px;
}

.elgg-page-content-header > .elgg-inner > h1 > .elgg-icon {
	background: white;
	border-radius: 500px;
    height: 32px;
    line-height: 30px;
    text-align: center;
    width: 32px;
    float: left;
}

.elgg-page-content-header > .elgg-inner > h1 img {
	float: left;
	border-radius: 500px;
	width: 32px;
	height: 32px;
	margin-right: 10px;
}











.elgg-page-content-header.theme-intranet-afdeling {
	background: #<?php echo THEME_PURPLE; ?>;
}
.elgg-page-content-header.theme-intranet-groep {
	background: #<?php echo THEME_BLUE; ?>;
}
.elgg-page-content-header.theme-intranet-dashboard {
	background: #<?php echo THEME_GREEN; ?>;
}

.elgg-page-content-header.theme-intranet-kennisbank {
	background: #<?php echo THEME_TEAL; ?>;
}
.elgg-page-content-header.theme-intranet-kennisbank > .elgg-inner > h1 > .elgg-icon {
	color: #<?php echo THEME_TEAL; ?>;
}