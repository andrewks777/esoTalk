<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Render functions. Contains functions that generally return common elements to be rendered to the page, such
 * as avatars, member profile links, member names, group names, and stars.
 *
 * All of the functions in this file are wrapped with function_exists checks, so plugins and skins can override
 * them in their plugin.php or skin.php files if needed.
 *
 * @package esoTalk
 */

if (!function_exists("highlight")) {

/**
 * Find a list of words in a block of text and put spans with class='highlight' around them.
 *
 * @param string $text The text to highlight words in.
 * @param array $words The words to highlight.
 * @return string The highlighted text.
 *
 * @package esoTalk
 */
function highlight($text, $words)
{
	if (!is_array($words)) return $text;
	foreach ($words as $word) {
		if (!($word = trim($word))) continue;

		// Make sure we only highlight whole words that would've been matched by a fulltext search.
		$text = preg_replace("/(?<=[\s>]|^)(".preg_quote($word, "/").")(?=[\s<,\.?!:\/-]|$)/iu", "<span class='highlight'>$1</span>", $text);

	}
	return $text;
}

}


if (!function_exists("memberLink")) {

/**
 * Return a member's name wrapped in an anchor tag linking to their profile page.
 *
 * @param int $memberId The ID of the member.
 * @param string $username The username of the member.
 * @return string
 *
 * @package esoTalk
 */
function memberLink($memberId, $username = "")
{
	$displayName = name($username);
	if ($username) return "<a href='".URL(memberURL($memberId, $username))."' title='".sprintf(sanitizeHTML(T("View %s's profile")), $displayName)."'>$displayName</a>";
	else return $displayName;
}

}


if (!function_exists("name")) {

/**
 * Return a member's name to be displayed in an HTML context. If the name is blank, it is assumed the member
 * has been deleted, and "[deleted]" is returned.
 *
 * @param string $username The member's username.
 * @param bool $sanitize Whether or not to sanitize the name for HTML output.
 * @return string
 *
 * @package esoTalk
 */
function name($username, $sanitize = true)
{
	if (!$username) $username = "[".T("deleted")."]";
	return $sanitize ? sanitizeHTML($username) : $username;
}

}


if (!function_exists("avatar")) {

/**
 * Return a HTML element to display a member's avatar.
 *
 * @param array $member An array of the member's details. (memberId and avatarFormat are required in this implementation.)
 * @param string $className CSS class names to apply to the avatar.
 *
 * @package esoTalk
 */
function avatar($member = array(), $className = "")
{
	$url = getResource("core/skin/avatar.png");

	// Construct the avatar path from the provided information.
	if (!empty($member["memberId"]) and !empty($member["avatarFormat"])) {
		$file = "uploads/avatars/{$member["memberId"]}.{$member["avatarFormat"]}";
		$url = getWebPath($file)."?".filemtime($file);
	}

	return "<img src='$url' alt='' class='avatar $className'/>";
}

}


if (!function_exists("memberGroup")) {

/**
 * Return a comma-separated list of groups that a member is in.
 *
 * @param string $account The member's account type.
 * @param array $groups An array of group names that the member is in.
 * @param bool $showMember Whether or not to show "Member" if the member's account is Member and they aren't
 * 		in any groups, or to just show nothing.
 * @return string
 *
 * @package esoTalk
 */
function memberGroup($account, $groups = array(), $showMember = false)
{
	// If the member isn't a Member, groups don't matter - just display their account type.
	if ($account and $account != ACCOUNT_MEMBER) return "<span class='group-$account'>".groupName($account)."</span>";
	else {

		// Otherwise, show a comma-separated list of the groups that they're in.
		$groups = array_filter((array)$groups);
		if (count($groups)) {
			foreach ($groups as $k => $v) $groups[$k] = "<span class='group-$k'>".groupName($v)."</span>";
			return implode(", ", $groups);
		}

		// If they're not in any groups, either show them as a "Member" or just show nothing at all.
		else return $showMember ? groupName(ACCOUNT_MEMBER) : "";

	}
}

}



if (!function_exists("groupName")) {

/**
 * Return a group's name to be displayed in an HTML context.
 *
 * @param string $group The name of the group.
 * @param bool $plural Whether or not a plural version of the name should be used (if such a translation exists.)
 * @return string
 *
 * @package esoTalk
 */
function groupName($group, $plural = false)
{
	return sanitizeHTML(T("group.$group".($plural ? ".plural" : ""), ucfirst($group)));
}

}



if (!function_exists("groupLink")) {

/**
 * Return a group's name wrapped in an anchor linking to a list of members in that group.
 *
 * @param string $group The name of the group.
 * @return string
 *
 * @package esoTalk
 */
function groupLink($group)
{
	return "<a href='".URL("members/?search=".urlencode(groupName($group)))."'>".groupName($group, true)."</a>";
}

}


if (!function_exists("star")) {

/**
 * Return a star for a certain conversation that can be clicked to toggle the starred that of that conversation.
 *
 * @param int $conversationId The ID of the conversation that this star is for.
 * @param bool $starred Whether or not the conversation is currently starred.
 * @return string
 *
 * @package esoTalk
 */
function star($conversationId, $starred)
{
	// If the user is not logged in, don't return anything.
	if (!ET::$session->user) return "";

	// Otherwise, return a clickable star!
	else {
		$conversationId = (int)$conversationId;
		$url = URL("conversation/star/".$conversationId."?token=".ET::$session->token."&return=".urlencode(ET::$controller->selfURL));
		return "<a href='$url' class='starButton' title='".T("Follow to receive notifications")."' data-id='$conversationId'><i class='star icon-star".($starred ? "" : "-empty")."'></i></a>";
	}
}

}


if (!function_exists("starButton")) {

/**
 * Return a star BUTTON for a certain conversation that can be clicked to toggle the starred that of that conversation.
 *
 * @param int $conversationId The ID of the conversation that this star is for.
 * @param bool $starred Whether or not the conversation is currently starred.
 * @return string
 *
 * @package esoTalk
 */
function starButton($conversationId, $starred)
{
	// If the user is not logged in, don't return anything.
	if (!ET::$session->user) return "";

	// Otherwise, return a clickable star!
	else {
		$conversationId = (int)$conversationId;
		$url = URL("conversation/star/".$conversationId."?token=".ET::$session->token."&return=".urlencode(ET::$controller->selfURL));
		return "<a href='$url' class='button big starButton' title='".T("Follow to receive notifications")."' data-id='$conversationId'><i class='star icon-star".($starred ? "" : "-empty")."'></i> <span>".($starred ? T("Following") : T("Follow"))."</span></a>";
	}
}

}


if (!function_exists("label")) {

/**
 * 
 *
 * 
 *
 * @package esoTalk
 */
function label($label, $url = "", $className = "")
{
	// Make sure the ETConversationModel class has been loaded so we can access its static properties.
	ET::conversationModel();

	return ($url ? "<a href='$url'" : "<span")." class='label label-$label $className' title='".T("label.$label")."'>
		<i class='".ETConversationModel::$labels[$label][1]."'></i>
	</".($url ? "a" : "span").">";
}

}
