<?php
/**
 * Page Layout
 *
 * Contains CSS for the page shell and page layout
 *
 * Default layout: 990px wide, centered. Used in default page shell
 *
 * @package Elgg.Core
 * @subpackage UI
 */
?>
/* <style> /**/

/* ***************************************
	PAGE LAYOUT
*************************************** */
/***** DEFAULT LAYOUT ******/
<?php // the width is on the page rather than topbar to handle small viewports ?>
.elgg-page-default {
	min-width: 800px;
	background: #E0E0E0;
}
.elgg-page-default .elgg-page-header > .elgg-inner {
	max-width: 1220px;
	margin: 0 auto;
	height: 40px;
}
.elgg-page-default .elgg-page-navbar > .elgg-inner {
	max-width: 1220px;
	margin: 0 auto;
	height: auto;
}
.elgg-page-default .elgg-page-body > .elgg-inner {
	max-width: 1220px;
	margin: 0 auto;
}
.elgg-page-default .elgg-page-footer > .elgg-inner {
	max-width: 1220px;
	margin: 0 auto;
	padding: 5px 0;
}

/***** TOPBAR ******/
.elgg-page-topbar {
	background: #424242;
	border-top: 1px solid #424242;
	border-bottom: 1px solid #000000;
	padding: 0 20px;
	position: relative;
	height: 32px;
	z-index: 9000;
}

/***** PAGE MESSAGES ******/
.elgg-system-messages {
	position: fixed;
	top: 32px;
	right: 20px;
	max-width: 500px;
	z-index: 2000;
}
.elgg-system-messages li {
	margin-top: 10px;
}
.elgg-system-messages li p {
	margin: 0;
}

/***** PAGE HEADER ******/
.elgg-page-header-wrapper {
	position: fixed;
	width: 100%;
	z-index: 1;
}

.elgg-page-header {
	height: 56px;
	position: relative;
	background: #EBEBEB;
}
.elgg-page-header > .elgg-inner {
	position: relative;
}
.elgg-page-header > .elgg-inner img {
	margin-top: 6px;
}
/***** PAGE NAVBAR ******/
.elgg-page-navbar {
	position: relative;
	background: #4A4A4B;
	height: 40px;
}
.elgg-page-navbar > .elgg-inner {
	position: relative;
}

/***** PAGE BODY LAYOUT ******/
.elgg-page-body {
	padding: 103px 20px 0;
}

.elgg-layout {
	min-height: 360px;
}
.elgg-layout-widgets > .elgg-widgets {
	float: right;
}
.elgg-sidebar {
	position: relative;
	padding: 32px 0 20px 30px;
	float: right;
	width: 295px;
	margin: 0;
}
.elgg-sidebar-alt {
	position: relative;
	padding: 32px 30px 20px 0;
	float: left;
	width: 295px;
	margin: 0 30px 0 0;
}
.elgg-main {
	position: relative;
	min-height: 360px;
	padding: 12px 0 10px 0;
}
.elgg-main > .elgg-head {
	padding-bottom: 5px;
	margin-bottom: 10px;
}
.elgg-layout-one-sidebar .elgg-main {
	float: left;
	width: 72.525252%;
}
.elgg-layout-two-sidebar .elgg-main {
	float: left;
	width: 50.101010%;
}

/***** PAGE FOOTER ******/
.elgg-page-footer {
	color: #999;
	padding: 0 10px;
	position: relative;
	background: #404041;
}

.elgg-page-footer a:hover {
	color: #666;
}
