<?php
// Copyright 2014 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays a single activity item in a member's profile.
 *
 * @package esoTalk
 */

$activity = $data["activity"];
?>
<div class='activity hasControls'<?php if (!empty($activity["activityId"])): ?> id='a<?php echo $activity["activityId"]; ?>'<?php endif; ?>>
<div class='controls'>
<span class='time'><?php echo date(T("date.full"), $activity["time"]); ?></span>
</div>
<div class='action'>
<?php echo avatar($activity + array("memberId" => $activity["fromMemberId"]), "thumb"), "\n"; ?>
<?php echo $activity["description"]; ?>
</div>
<?php if (!empty($activity["body"])): ?>
<div class='activityBody postBody thing'>
<?php echo $activity["body"]; ?>
</div>
<?php endif; ?>
</div>