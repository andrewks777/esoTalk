<?php
// Copyright 2013 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

$member = $data["member"];
$about = $data["about"];
?>
<div id='memberAbout'>

<?php
/* - andrewks {
	echo $about;
- andrewks } */
// + andrewks {
	if (ET::$session->user) {
		echo $about;
	} else echo T("hidden");
// + andrewks }
?>

</div>