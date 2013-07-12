<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Shows a page to edit a single post.
 *
 * @package esoTalk
 */

$form = $data["form"];
$post = $data["post"];
?>
<div class='standalone'>
<?php echo $form->open(); ?>

<?php

// Using the provided form object, construct a textarea and buttons.
/* - andrewks {
$body = $form->input("content", "textarea", array("cols" => "200", "rows" => "20"))."
	<div id='p".$post["postId"]."-preview' class='preview'></div>
	<div class='editButtons'>".
	$form->saveButton()." ".
	$form->cancelButton()."</div>";
- andrewks } */
// + andrewks {
$relativePostIdShortURL = postURL($post["postId"], $post["conversationId"], $post["relativePostId"], false);
$body = $form->input("content", "textarea", array("cols" => "200", "rows" => "20"))."
	<div id='p".$relativePostIdShortURL."-preview' class='preview'></div>
	<div class='editButtons'>".
	$form->saveButton()." ".
	$form->cancelButton()."</div>";
// + andrewks }

// Construct an array for use in the conversation/post view.
$formatted = array(
/* - andrewks {
	"id" => "p".$post["postId"],
- andrewks } */
// + andrewks {
	"id" => "p".$relativePostIdShortURL,
// + andrewks }
	"title" => name($post["username"]),
	"controls" => $data["controls"],
	"class" => "edit",
	"body" => $body,
	"avatar" => avatar($post)
);

$this->trigger("renderEditBox", array(&$formatted, $post));

$this->renderView("conversation/post", array("post" => $formatted));

?>

<?php echo $form->close(); ?>
</div>