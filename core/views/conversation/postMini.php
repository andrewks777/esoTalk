<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays a single post.
 *
 * @package esoTalk
 */

$post = $data["post"];
?>

<div class='post hasControls <?php echo implode(" ", (array)$post["class"]); ?>' id='postToolTip' style='position:fixed; top:37px; left:50%; width:80%; margin-left:-40%; height:auto; max-height:75%; overflow:auto; z-index:350; padding:5px; background:none repeat scroll 0% 0% rgba(50, 50, 50, 0.5); border:1px solid rgba(50, 50, 50, 0.75); border-radius:5px 5px 5px 5px;'<?php
if (!empty($post["data"])):
foreach ((array)$post["data"] as $dk => $dv)
	echo " data-$dk='$dv'";
endif; ?>>

<?php if (!empty($post["avatar"])): ?>
<div class='avatar'><?php echo $post["avatar"]; ?></div>
<?php endif; ?>

<div class='postContent thing'>

<div class='postHeader'>
<div class='info'>
<h3><?php echo $post["title"]; ?></h3>
<?php if (!empty($post["info"])) foreach ((array)$post["info"] as $info) echo $info, "\n"; ?>
</div>
<div class='controls'>
<?php
echo "<a href='' class='control-closeToolTip' title='".T("message.close")."'><i class='icon-remove'></i> </a>"
?>
</div>
</div>

<?php if (!empty($post["body"])): ?>
<div class='postBody'>
<?php
echo $post["body"];
?>
</div>

<?php endif; ?>

</div>

</div>
