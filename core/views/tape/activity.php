<?php
// Copyright 2014 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays the activity pane, which contains a list of activity items and a "view more"
 * link if there are more results.
 *
 * @package esoTalk
 */

$activity = $data["activity"];

// If there is activity, output it in a list.
if (!empty($activity)): ?>
<ol id='membersActivity' class='activityList'>
<?php
$currentConversationId = -1;
foreach ($activity as $k => $item):

if ($item["type"] == 'postAllActivity' && $item["conversationId"] != $currentConversationId) {
	$currentConversationId = $item["conversationId"];
	echo "<li class='sep'></li>";
	echo "<li><div class='action'><a href='".URL(conversationURL($item["conversationId"]))."/last'>".sanitizeHTML($item['title'])."</a></div></li>";
}
			
// Get the relative time of this post.
$thisPostTime = relativeTime($item["time"], false); ?>

<li>
<?php
// If the post before this one has a different relative time to this one, output a time marker.
if (!isset($activity[$k - 1]["time"]) or relativeTime($activity[$k - 1]["time"], false, true) != $thisPostTime): ?>
<div class='timeMarker'><?php echo $thisPostTime; ?></div>
<?php endif; ?>
<?php $this->renderView("tape/activityItem", array("activity" => $item) + $data); ?>
</li>

<?php endforeach; ?>
</ol>

<?php if ($data["showViewMoreLink"]):
echo "<a href='".URL("tape"."/".($data["page"] + 2))."' class='button' id='viewMoreActivity'>".T("View more")."</a>";
endif; ?>

<?php
// Otherwise, output a "no results" message.
else: ?>
<p class='help'><?php printf(T("message.noSearchResults"), ""); ?></p>
<?php endif; ?>