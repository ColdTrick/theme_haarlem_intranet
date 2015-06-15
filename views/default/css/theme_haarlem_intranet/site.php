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

.elgg-search-content-header {
	top: 24px;
	right: 0;
	position: absolute;
	margin: 0;
}
.elgg-search-content-header table {
	width: 291px;
}
form.elgg-search {
	height: 32px;
	border: 2px solid #414042;
	background: #414042;
}
.elgg-search-content-header .elgg-icon-search,
.elgg-search-header .elgg-icon-search {
	color: white;
	background: #414042;
	font-size: 22px !important;
	padding: 4px;
	cursor: pointer;
}
.elgg-search-content-header .elgg-icon-search:hover,
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
	white-space: nowrap;
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
.theme-haarlem-intranet-profile-group-membership .elgg-image img,
.elgg-avatar > a > img {
	border-radius: 500px;
}

#profile-owner-block .elgg-avatar > a > img {
	background-size: cover !important;
}

:focus > .fa,
.fa:hover,
.fa-hover {
	color: #<?php echo THEME_BLUE;?>;
}
.elgg-output .fa {
	color: #ccc;
}
.elgg-output a .fa:hover {
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
	max-height: 250px;
	overflow: auto;
	
}
.theme-haarlem-intranet-topbar-dropdown .elgg-menu-quicklinks li {
	border: none;
	min-height: 20px;
	padding: 0;
}
.theme-haarlem-intranet-topbar-dropdown .elgg-menu-quicklinks li .elgg-icon {
	color: #bcbec0;
}
.theme-haarlem-intranet-topbar-dropdown .elgg-menu-quicklinks li > a {
	color: #414042;
	word-wrap: break-word;
    padding: 3px 13px 0;
}
.theme-haarlem-intranet-topbar-dropdown .alliander-theme-quicklinks-item {
	padding: 10px;
	color: #414042;
}
.elgg-menu-personal .elgg-menu-item-groups .elgg-child-menu {
	max-height: 250px;
	overflow-y: auto;
	overflow-x: hidden;
}
#widget_manager_widgets_select .widget_manager_widgets_lightbox_wrapper {
	margin-bottom: 10px;
}

.mce-i-fa {
	font-family: 'FontAwesome' !important;
}

.elgg-menu-page-static {
	background: white;
	border-top: 4px solid #<?php echo THEME_TEAL; ?>;
	border-bottom: 4px solid #<?php echo THEME_TEAL; ?>;
}

.elgg-widget-content .elgg-menu-page-static {
	border: none;
}

.elgg-menu-page-static li > a,
.elgg-menu-page-static li.elgg-state-selected > a,
.elgg-menu-page-static a:hover {
	background: none;
}
.elgg-menu-page-static li.elgg-state-selected > a,
.elgg-menu-page-static a:hover {
	color: #<?php echo THEME_TEAL; ?>;
}

.elgg-menu-page-static .elgg-menu-closed:before {
	content: "\f0da";
	font-family: "FontAwesome";
	color: #808285;
}
.elgg-menu-page-static .elgg-menu-opened:before {
	content: "\f0d7";
	font-family: "FontAwesome";
	color: #414042;
}

.elgg-menu-page-static a {
	color: #414042;
	font-size: 16px;
}
.elgg-menu-page-static .elgg-child-menu a {
	font-size: 15px;
}

.elgg-menu-page-static > li > ul a {
	padding: 6px;
}
.elgg-menu-page-static > li > ul {
	padding-top: 4px;
	padding-bottom: 4px;
}

.elgg-menu-page-static > li > a {
	border-bottom: 1px solid #808285;
}


#file_tools_list_tree_container {
	background: none;
}
#file_tools_list_tree_container > .elgg-body {
	padding: 0px;
}

#file-tools-folder-tree {
	background: white;
	border-top: 4px solid #<?php echo THEME_TEAL; ?>;
	border-bottom: 4px solid #<?php echo THEME_TEAL; ?>;
	font-family: 'Source Sans Pro', sans-serif;
	font-size: 15px;
	color: #414042;
}
#file-tools-folder-tree ul {
	margin: 0;
}
#file-tools-folder-tree li {
	width: 100%;
}

#file-tools-folder-tree a {
	padding: 6px;
	color: #414042;
}
#file-tools-folder-tree > ul > li {
	padding-left: 0;
}
#file-tools-folder-tree > ul > li > a {
	padding: 11px;
	border-bottom: 1px solid #414042;
	width: 100%;
	font-size: 17px;
	background: #<?php echo THEME_TEAL; ?> !important;
	color: white !important;
}
.tree-classic li,
.tree-classic ul {
	background: none !important;
}
.tree-classic li.open a.elgg-menu-parent:before {
	content: "\f0d7";
	font-family: "FontAwesome";
	color: #414042;
	padding-right: 5px;
}
#file-tools-folder-tree.tree-classic li.elgg-menu-item-root > a.elgg-menu-parent:before {
	content: "";
}
.tree-classic li.closed a.elgg-menu-parent:before {
	content: "\f0da";
	font-family: "FontAwesome";
	color: #808285;
	padding-right: 5px;
}

.tree-classic li a.clicked,
.tree-classic li a.clicked:hover,
.tree-classic li span.clicked {
	background: none !important;
	color: #<?php echo THEME_TEAL; ?> !important;
	border: inherit !important;
}
#file_tools_breadcrumbs {
	display: none;
}
.file-tools-folder,
.file-tools-file {
	padding: 8px 0 2px 0;
}

.file-tools-folder .elgg-menu-item-access,
.file-tools-file .elgg-menu-item-access,
.file-tools-folder .elgg-menu-item-edit,
.file-tools-file .elgg-menu-item-edit,
.file-tools-folder .elgg-menu-item-delete,
.file-tools-file .elgg-menu-item-delete {
	display: none;
}
.file-tools-folder:hover .elgg-menu-item-access,
.file-tools-file:hover .elgg-menu-item-access,
.file-tools-folder:hover .elgg-menu-item-edit,
.file-tools-file:hover .elgg-menu-item-edit,
.file-tools-folder:hover .elgg-menu-item-delete,
.file-tools-file:hover .elgg-menu-item-delete {
	display: inline-block;
}

.file-tools-folder:hover,
.file-tools-file:hover,
#file_tools_list_files .file-tools-file:hover,
.file-tools-folder:hover .elgg-menu-entity,
.file-tools-file:hover .elgg-menu-entity,
#file_tools_list_files .file-tools-file:hover .elgg-menu-entity {
	background: #e2e3e4;
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

.elgg-owner-block-user .elgg-head,
.elgg-owner-block-group .elgg-head {
	background: white;
	margin-bottom: 20px;
}
.elgg-owner-block-user .elgg-head > .elgg-image-block,
.elgg-owner-block-group .elgg-head > .elgg-image-block {
	background: #<?php echo THEME_BLUE; ?>;
	padding: 0px;
	height: 40px;
	overflow: hidden;
}
.elgg-owner-block-user .elgg-head > .elgg-image-block {
	background: #<?php echo THEME_GREEN; ?>;
}
.elgg-owner-block-user .elgg-head > .elgg-image-block .elgg-image,
.elgg-owner-block-group .elgg-head > .elgg-image-block .elgg-image {
	margin: 8px;
}
.elgg-owner-block-user .elgg-head > .elgg-image-block .elgg-body a,
.elgg-owner-block-group .elgg-head > .elgg-image-block .elgg-body a {
	color: white;
	font-size: 17px;
	font-family: "Source Sans Pro",sans-serif;
	line-height: 40px;
}

.elgg-owner-block-user .profile-action-menu .elgg-button-action {
	background: #<?php echo THEME_GREEN; ?>;
}
.elgg-owner-block-user .profile-action-menu .elgg-button-action:hover {
	text-decoration: underline;
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
.elgg-owner-block-group .theme-haarlem-intranet-status .elgg-icon-lock-closed{
	color: #<?php echo THEME_RED; ?>;
}

.elgg-main .theme-haarlem-intranet-owner-block-section > .elgg-head h3 {
	color: white;
}
.elgg-main .theme-haarlem-intranet-owner-block-section > .elgg-body {
	background: white;
	padding: 10px;
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

.elgg-owner-block-group .elgg-menu-title > li > a {
	background: #<?php echo THEME_BLUE; ?>;
}
.theme-intranet-afdeling .elgg-owner-block-group .elgg-menu-title > li > a {
	background: #<?php echo THEME_PURPLE; ?>;
}
.elgg-owner-block-group .elgg-menu-title > li > a:hover {
	text-decoration: underline;
}

.elgg-page-content-header > .elgg-inner > h1 {
	font-size: 24px;
	font-family: "Source Sans Pro",sans-serif;
	color: white;
	position: absolute;
	top: 26px;
	line-height: 32px;
}
.elgg-page-content-header > .elgg-inner > h1 a.theme-link {
	color: white;
	text-decoration: none;
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

.elgg-page-content-header .profile-action-menu {
	position: absolute;
	right: 0;
	bottom: 0;
}


.theme-haarlem-intranet-accordion-header {
	font-weight: bold;
	border-top: 1px solid #BDBEC1;
	border-bottom: 1px solid #BDBEC1;
	padding: 10px 2px;
	font-family: Arial;
	font-size: 12px;
	cursor: pointer;
}

.theme-haarlem-intranet-accordion-header:hover {
	background: #EEE;
}

.theme-haarlem-intranet-accordion-header .ui-icon {
	font-size: 16px;
}
.theme-haarlem-intranet-accordion-header.ui-state-active,
.theme-haarlem-intranet-accordion-header.ui-state-active .ui-icon,
.theme-haarlem-intranet-accordion-header:hover .ui-icon,
.theme-haarlem-intranet-accordion-header:hover {
	color: #<?php echo THEME_TEAL; ?>;
}
.elgg-output .ui-accordion-content {
	padding: 10px;
	margin: 0;
}

.elgg-output ul ul,
.elgg-output ul ol,
.elgg-output ol ul,
.elgg-output ol ol {
	margin-bottom: 0px;
}

.elgg-menu-widget .elgg-menu-item-settings,
.elgg-menu-widget .elgg-menu-item-delete {
	display: none;
}

.elgg-module-widget:hover .elgg-menu-widget .elgg-menu-item-settings,
.elgg-module-widget:hover .elgg-menu-widget .elgg-menu-item-delete {
	display: inline-block;
}

.elgg-module-widget.widget-green > .elgg-head {
	background: #<?php echo THEME_GREEN; ?>;
}
.elgg-module-widget.widget-blue > .elgg-head {
	background: #<?php echo THEME_BLUE; ?>;
}
.elgg-module-widget.widget-red > .elgg-head {
	background: #<?php echo THEME_RED; ?>;
}
.elgg-module-widget.widget-teal > .elgg-head {
	background: #<?php echo THEME_TEAL; ?>;
}
.elgg-module-widget.widget-purple > .elgg-head {
	background: #<?php echo THEME_PURPLE; ?>;
}

.elgg-module-widget.widget-green > .elgg-body {
	border-bottom: 4px solid #<?php echo THEME_GREEN; ?>;
}
.elgg-module-widget.widget-blue > .elgg-body {
	border-bottom: 4px solid #<?php echo THEME_BLUE; ?>;
}
.elgg-module-widget.widget-red > .elgg-body {
	border-bottom: 4px solid #<?php echo THEME_RED; ?>;
}
.elgg-module-widget.widget-teal > .elgg-body {
	border-bottom: 4px solid #<?php echo THEME_TEAL; ?>;
}
.elgg-module-widget.widget-purple > .elgg-body {
	border-bottom: 4px solid #<?php echo THEME_PURPLE; ?>;
}

.elgg-widget-instance-thewire > .elgg-head,
.elgg-widget-instance-index_thewire > .elgg-head,
.elgg-widget-instance-thewire_groups > .elgg-head,
.elgg-widget-instance-thewire_post > .elgg-head,
.elgg-widget-instance-group_river_widget > .elgg-head,
.elgg-widget-instance-river_widget > .elgg-head,
.elgg-widget-instance-index_activity > .elgg-head {
	background: #<?php echo THEME_BLUE; ?>;
}
.elgg-widget-instance-thewire > .elgg-body,
.elgg-widget-instance-index_thewire > .elgg-body,
.elgg-widget-instance-thewire_groups > .elgg-body,
.elgg-widget-instance-thewire_post > .elgg-body,
.elgg-widget-instance-group_river_widget > .elgg-body,
.elgg-widget-instance-river_widget > .elgg-body,
.elgg-widget-instance-index_activity > .elgg-body {
	border-bottom: 4px solid #<?php echo THEME_BLUE; ?>;
}

.theme-intranet-afdeling .elgg-widget-instance-thewire > .elgg-head,
.theme-intranet-afdeling .elgg-widget-instance-index_thewire > .elgg-head,
.theme-intranet-afdeling .elgg-widget-instance-thewire_groups > .elgg-head,
.theme-intranet-afdeling .elgg-widget-instance-thewire_post > .elgg-head,
.theme-intranet-afdeling .elgg-widget-instance-group_river_widget > .elgg-head,
.theme-intranet-afdeling .elgg-widget-instance-river_widget > .elgg-head,
.theme-intranet-afdeling .elgg-widget-instance-index_activity > .elgg-head {
	background: #<?php echo THEME_PURPLE; ?>;
}

.theme-intranet-afdeling .elgg-widget-instance-thewire > .elgg-body,
.theme-intranet-afdeling .elgg-widget-instance-index_thewire > .elgg-body,
.theme-intranet-afdeling .elgg-widget-instance-thewire_groups > .elgg-body,
.theme-intranet-afdeling .elgg-widget-instance-thewire_post > .elgg-body,
.theme-intranet-afdeling .elgg-widget-instance-group_river_widget > .elgg-body,
.theme-intranet-afdeling .elgg-widget-instance-river_widget > .elgg-body,
.theme-intranet-afdeling .elgg-widget-instance-index_activity > .elgg-body {
	border-bottom: 4px solid #<?php echo THEME_PURPLE; ?>;
}

.theme-intranet-afdeling .elgg-owner-block-group .elgg-head > .elgg-image-block,
.theme-intranet-afdeling .theme-haarlem-intranet-owner-block-section > .elgg-head,
.theme-intranet-afdeling .theme-haarlem-intranet-owner-block-section > .elgg-head a,
.theme-intranet-afdeling .elgg-owner-block-group .elgg-button-action {
	background: #<?php echo THEME_PURPLE; ?>;
}

.theme-intranet-kennisbank .elgg-owner-block-group .elgg-head > .elgg-image-block,
.theme-intranet-kennisbank .theme-haarlem-intranet-owner-block-section > .elgg-head,
.theme-intranet-kennisbank .theme-haarlem-intranet-owner-block-section > .elgg-head a,
.theme-intranet-kennisbank .elgg-owner-block-group .elgg-button-action {
	background: #<?php echo THEME_TEAL; ?>;
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

.elgg-page-body .elgg-inner .profile-manager-profile-completeness {
	margin: 0 0 20px;
}
#widget_profile_completeness_container {
	background: white;
	border: none;
	margin-bottom: 5px;
}
#widget_profile_completeness_progress {
	line-height: 40px;
}
#widget_profile_completeness_progress_bar {
	background: #<?php echo THEME_GREEN; ?>;
	height: 40px;
}

.event_manager_event_list_icon_day {
	border-bottom: 1px solid #414042;
    border-left: 1px solid #414042;
    border-right: 1px solid #414042;
}

.event_manager_event_list_icon_month {
	background: none repeat scroll 0 0 #414042;
    border: 1px solid #414042;
}

.promo-widget-green,
.promo-widget-green a {
    background-color: #<?php echo THEME_GREEN; ?>;
    color: white;
}
.promo-widget-teal,
.promo-widget-teal a {
    background-color: #<?php echo THEME_TEAL; ?>;
    color: white;
}
.promo-widget-blue,
.promo-widget-blue a {
    background-color: #<?php echo THEME_BLUE; ?>;
    color: white;
}
.promo-widget-purple,
.promo-widget-purple a {
    background-color: #<?php echo THEME_PURPLE; ?>;
    color: white;
}
.promo-widget-red,
.promo-widget-red a {
    background-color: #<?php echo THEME_RED; ?>;
    color: white;
}

.elgg-menu-entity.theme-haarlem-intranet-entity-menu-bottom {
	float: none;
	margin: 5px 0 0;
	position: relative;
}
.theme-haarlem-intranet-entity-menu-bottom > li {
	margin-left: 0;
	margin-right: 10px;
}
.elgg-form-thewire-add #thewire-characters-remaining {
	float: left;
}

.elgg-form-thewire-add #thewire-submit-button {
	float: right;
}
.elgg-widget-content .elgg-form-thewire-add .thewire-tools-widget-access {
	display: none;
}

.elgg-form-thewire-add {
	border-bottom: 1px solid #bcbec0;
	padding-bottom: 5px;
	margin-bottom: 20px;
	position: relative;
}

/* Triagles */

.widget-purple > .elgg-body > .elgg-widget-content,
.widget-teal > .elgg-body > .elgg-widget-content,
.widget-red > .elgg-body > .elgg-widget-content,
.widget-blue > .elgg-body > .elgg-widget-content,
.widget-green > .elgg-body > .elgg-widget-content {
	position: relative;
	padding-top: 20px;
}

.widget-purple > .elgg-body > .elgg-widget-content:after,
.widget-teal > .elgg-body > .elgg-widget-content:after,
.widget-red > .elgg-body > .elgg-widget-content:after,
.widget-blue > .elgg-body > .elgg-widget-content:after,
.widget-green > .elgg-body > .elgg-widget-content:after {
	border-top:15px solid #<?php echo THEME_GREEN; ?>;
    border-left:15px solid transparent;
    border-right:15px solid transparent;
    top:0px;
    left: 40px;
    content: '';
    position: absolute;
}

.widget-purple > .elgg-body > .elgg-widget-content:after {
	border-top-color: #<?php echo THEME_PURPLE; ?>;
}
.widget-teal > .elgg-body > .elgg-widget-content:after {
	border-top-color: #<?php echo THEME_TEAL; ?>;
}
.widget-red > .elgg-body > .elgg-widget-content:after {
	border-top-color: #<?php echo THEME_RED; ?>;
}
.widget-blue > .elgg-body > .elgg-widget-content:after {
	border-top-color: #<?php echo THEME_BLUE; ?>;
}

.elgg-form-thewire-add:before,
.elgg-form-thewire-add:after {
	border-left: 14px solid transparent;
    border-right: 14px solid transparent;
    border-top: 14px solid #fff;
    bottom: -14px;
    content: '';
    left: 60px;
    margin-left: -14px;
    position: absolute;
}
.elgg-form-thewire-add:before {
	border-left: 15px solid transparent;
    border-right: 15px solid transparent;
    border-top: 15px solid;
    border-top-color: inherit; /* Can't be included in the shorthand to work */
    bottom: -15px;
    margin-left: -15px;
}

/* Quick nav */
.theme-haarlem-intranet-quick-nav-wrapper {
	width: 500px;
}

.theme-haarlem-intranet-quick-nav-wrapper .elgg-input-text {
	width: 300px;
}
.theme-haarlem-intranet-quick-nav-wrapper .elgg-input-url {
	width: 453px;
}
.theme-haarlem-intranet-quick-nav-wrapper select {
	width: 150px;
}
.theme-haarlem-intranet-quick-nav-wrapper .elgg-icon {
	cursor: pointer;
}
.elgg-widget-instance-quick_nav .elgg-widget-content {
	padding: 0;
}
.elgg-widget-instance-quick_nav .elgg-widget-content .elgg-menu {
	margin: 0;
}

/* Izine */
.theme-haarlem-intranet-izine-image {
	height: 200px;
	position: relative;
}
.theme-haarlem-intranet-izine-image > .elgg-icon {
	cursor: pointer;
	position: absolute;
	top: 50%;
	font-size: 22px !important;
}
.theme-haarlem-intranet-izine-image > .elgg-icon-chevron-left {
	left: 0;
}
.theme-haarlem-intranet-izine-image > .elgg-icon-chevron-right {
	right: 0;
}
.elgg-module-izine {
	padding: 10px;
	margin: 0;
}
.elgg-module-izine .elgg-head h3 {
	font-weight: bold;
	font-size: 17px;
	padding-bottom: 5px;
}
.elgg-widget-instance-izine .elgg-widget-content {
	padding: 0 !important;
}
.elgg-module-widget.widget_manager_disable_widget_content_style > .elgg-head {
	border: 0;
}

.elgg-widget-instance-haarlem_news table {
	width: 100%;
}

.elgg-widget-instance-haarlem_news table td:first-child {
	width: 1%;
	color: #bcbec0;
	padding-right: 10px;
	white-space: nowrap;
}

.elgg-widget-instance-haarlem_news table .theme-haarlem-news-featured td {
	font-weight: bold;
	padding-bottom: 20px;
	vertical-align: baseline;
}

.elgg-widget-instance-haarlem_news table h3 {
	font-size: 17px;
	font-weight: normal;
}
.elgg-widget-instance-haarlem_news table a,
.elgg-widget-instance-haarlem_news table .elgg-icon {
	color: #414042;
}

.elgg-widget-instance-haarlem_news table a:visited {
	color: #999;
}

.elgg-widget-instance-haarlem_news table .elgg-icon {
	font-size: 19px !important;
}

.elgg-widget-instance-promo_widget .elgg-widget-content > table a {
	height: 170px;
	text-decoration: none;
	font-size: 20px;
}
.elgg-widget-instance-promo_widget .elgg-widget-content .elgg-output .fa {
    color: white;
    font-size: 48px !important;
}

.elgg-widget-instance-promo_widget > .elgg-head {
	display: none;
}
.elgg-state-draggable.elgg-widget-instance-promo_widget:hover > .elgg-head {
	display: block;
	position: absolute;
	width: 100%;
}

.theme-haarlem-intranet-profile-group-membership .elgg-image-block {
	padding: 0;
}
.theme-haarlem-intranet-profile-group-membership .elgg-image-block > .elgg-body,
.theme-haarlem-intranet-profile-group-membership .elgg-image-block.elgg-divide-top > .elgg-image {
	padding-top: 4px;
}

#event_manager_event_edit > fieldset > table td {
	padding: 0 0 20px;
}
#event_manager_event_edit .event_manager_event_edit_label {
	width: 150px;
	padding-right: 10px;
}
#event_manager_event_edit .mce-tinymce {
	width: auto !important;
}

.search-advanced-user-profile-table td {
	padding: 0 0 5px;
	vertical-align: middle;
}
.search-advanced-user-profile-table .elgg-input-text {
	margin-left: 20px;
    min-width: 300px;
}