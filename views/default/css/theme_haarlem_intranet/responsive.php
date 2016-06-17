<?php
?>
/* <style> /**/

/* ***************************************
	RESPONSIVE
*****************************************/
html {
	font-size: 100%;
	-webkit-text-size-adjust: 100%;
	-ms-text-size-adjust: 100%;
}
.elgg-button-nav {
	display: none;
	font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
	color: #FFF;
	float: left;
	padding: 14px 18px;
}
.elgg-button-nav:hover {
	color: #FFF;
	text-decoration: none;
	background-color: #60B8F7;
}
.elgg-button-nav .icon-bar {
	background-color: #F5F5F5;
	border-radius: 1px 1px 1px 1px;
	box-shadow: 0 1px 0 rgba(0, 0, 0, 0.25);
	display: block;
	height: 2px;
	width: 22px;
}
.elgg-button-nav .icon-bar + .icon-bar {
	margin-top: 3px;
}
@media all and (device-width: 768px) and (device-height: 1024px) and (orientation:portrait),
(max-width: 1030px) {
	.elgg-menu-topbar-default > li:first-child a {
		margin-left: 0;
	}
	.elgg-menu-topbar-alt > li > a.elgg-topbar-dropdown {
		margin-right: 0;
	}
	.elgg-page-footer {
		padding: 0 20px;
	}
}
@media all and (device-width: 768px) and (device-height: 1024px) and (orientation:portrait),
(max-width: 880px) {
	#profile-owner-block {
		width: 150px;
	}
}
@media all and (device-width: 768px) and (device-height: 1024px) and (orientation:portrait),
(max-width: 820px) {
	.elgg-page-default {
		min-width: 0;
	}
	.elgg-page-body {
		padding: 0;
	}
	.elgg-main {
        padding: 12px 20px 10px;
		
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
    }
    .elgg-layout {
    	display: table;
    }
    .elgg-layout-one-sidebar .elgg-main,
	.elgg-layout-two-sidebar .elgg-main {
        width: 100%;
    }
	.elgg-sidebar {
		border-left: none;
		border-top: 1px solid #DCDCDC;
		border-bottom: 1px solid #DCDCDC;
		background-color: #FAFAFA;
		width: 100%;
		float: none;
		padding: 27px 20px 20px;
		box-shadow: 0 3px 6px rgba(0, 0, 0, 0.05) inset;

		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		
		display: table-footer-group !important;
	}
	.elgg-sidebar-alt {
		width: 100%;
		float: none;
	}
	.elgg-page-default .elgg-page-footer > .elgg-inner {
		border-top: none;
	}
	.elgg-menu-footer {
		float: none;
		text-align: center;
	}
	.elgg-menu-page,
	.elgg-sidebar .elgg-menu-owner-block,
	.elgg-menu-groups-my-status {
		border-bottom: 1px solid #DCDCDC;
	}
	
	.elgg-river-item input[type=text] {
		width: 100%;
	}
	.elgg-river-item input[type=submit] {
		margin: 5px 0 0 0;
	}
	/***** CUSTOM INDEX ******/
	/*.elgg-col-1of2 {
		float: none;
		width: 100%;
	}*/
	.prl {
		padding-right: 0;
	}
	/***** WIDGETS ******/
	.elgg-col-1of3,
	.elgg-col-2of3,
	#elgg-widget-col-1,
	#elgg-widget-col-2,
	#elgg-widget-col-3 {
		float: none;
		min-height: 0 !important;
		width: 100% !important;
	}
	.elgg-module-widget {
		margin: 0 0 15px;
	}
	.custom-index-col1 > .elgg-inner,
	.custom-index-col2 > .elgg-inner {
		padding: 0;
	}
	#dashboard-info {
		margin: 0 0 15px;
	}
	.theme-haarlem-intranet-sidebar-toggle {
		display: none;
	}
}
@media (min-width: 767px) {
	.elgg-nav-collapse {
		display: block !important;
	}
}
@media all and (device-width: 768px) and (device-height: 1024px) and (orientation:portrait) {
	.elgg-nav-collapse {
		display: none !important;
	}
}
@media all and (device-width: 768px) and (device-height: 1024px) and (orientation:portrait),
(max-width: 766px) {

	.elgg-page-header,
	.elgg-page-default .elgg-page-header > .elgg-inner {
		height: auto;
	}
	
	.elgg-search-header table {
		width: auto;
	}
	
	.elgg-page-header > .elgg-inner h1 {
		padding-top: 10px;
	}
	.elgg-heading-site, .elgg-heading-site:hover {
		font-size: 1.6em;
	}
	.elgg-search-header {
		position: relative;
		left: 0;
		top: 0;
		margin-bottom: 5px;
		
	}
	.elgg-page-header-wrapper {
		position: relative;
	}
	.elgg-page-default .elgg-page-content-header {
		padding: 0;
	}
	.elgg-page-navbar {
		height: auto;
	}
	.elgg-button-nav {
		cursor: pointer;
		display: block;
	}
	.elgg-nav-collapse {
		clear: both;
		display: none;
		width: 100%;
	}
	
	.elgg-menu-site .elgg-menu-item-home {
		display: none;
	}
	
	
	.theme-haarlem-intranet-topbar-dropdown,
	.elgg-menu-site .elgg-child-menu {
		position: relative !important;
		left: 0 !important;
		top: 0 !important;
		border-radius: 0px !important;
		border: none !important;
		box-shadow: none !important;
		width: auto !important;
		display: block !important;
		background: #4a4a4b !important;
	}
	.theme-haarlem-intranet-topbar-dropdown .elgg-menu-quicklinks,
	.elgg-menu-site .elgg-child-menu {
		list-style: inside;
	}
	
	.elgg-menu-site .elgg-child-menu li {
		display: none;
	}

	.elgg-menu-personal .elgg-menu-item-groups > ul {
		padding-left: 0px;
		list-style: none;
	}
	
	.elgg-menu-site .elgg-child-menu > li:last-child > a {
		border-radius: 0px;
	}
	.elgg-menu-site.elgg-menu-personal .elgg-child-menu {
		right: auto;
	}
	
	#login-dropdown a {
		padding: 10px 18px;
	}
	.elgg-menu-site {
		float: none;
	}
	.elgg-menu-site ul,
	.elgg-menu-site li,
	.elgg-menu-site a {
		border: none !important;
		background: #4a4a4b !important;
		color: white !important;
	}
	.elgg-menu-site a {
		display: inline-block !important;
	}
	.elgg-menu-site > li > ul {
		position: static;
		display: block;
		left: 0;
		margin-left: 0;
		border: none;
		box-shadow: none;
		background: none;
	}

	.elgg-menu-site > li > ul {
		width: auto;
	}
	.elgg-menu-site ul li {
		float: none;
		margin: 0;
		padding-left: 24px;
	}
	.elgg-menu-site > li {
		border-top: 1px solid #294E6B;
		clear: both;
		float: none;
		margin: 0;
	}
	.elgg-menu-site > li:first-child {
		border-top: none;
	}
	.elgg-menu-site > li > a {
		padding: 10px 18px;
	}
	
	.elgg-menu-personal,
	.theme-haarlem-logout-info,
	.elgg-menu-item-menu-builder-edit-mode {
		display: none !important;
	}
	
	.elgg-menu-site .elgg-menu-site-toggle {
		display: inline-block;
		position: absolute;
		right: 10px;
		font-weight: bold;
	}
}

@media (max-width: 600px) {
	.groups-profile-fields {
		float: left;
		padding-left: 0;
	}
	#profile-owner-block {
		border-right: none;
		width: auto;
	}
	#profile-details {
		display: block;
		float: left;
	}
	#groups-tools > li {
		width: 100%;
		margin-bottom: 20px;
	}
	#groups-tools > li:nth-child(odd) {
		margin-right: 0;
	}
	#groups-tools > li:last-child {
		margin-bottom: 0;
	}
	.elgg-menu-entity, .elgg-menu-annotation {
		margin-left: 0;
	}
	.elgg-menu-entity > li, .elgg-menu-annotation > li {
		margin-left: 0;
		margin-right: 15px;
	}
	.elgg-subtext {
		float: left;
		margin-right: 15px;
	}
}

