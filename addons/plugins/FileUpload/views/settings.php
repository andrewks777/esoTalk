<?php
// Copyright 2013 Toby Zerner, Simon Zerner
// Copyright 2013 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays the settings form for the FileUpload plugin.
 *
 * @package esoTalk
 */

$form = $data["fileUploadSettingsForm"];
?>
<?php echo $form->open(); ?>

<div class='section'>

<ul class='form'>

<li>
<label><?php echo T("plugin.FileUpload.allowedTypesLabel"); ?></label>
<?php echo $form->input("allowedFileTypes", "text"); ?>
<small><?php echo T("plugin.FileUpload.allowedTypesDesc"); ?></small>
</li>

<li>
<label><?php echo T("plugin.FileUpload.maxFileSizeLabel"); ?></label>
<?php echo $form->input("maxFileSize", "text"); ?>
<small><?php echo T("plugin.FileUpload.maxFileSizeDesc"); ?></small>
</li>

</ul>

</div>

<div class='buttons'>
<?php echo $form->saveButton("fileUploadSave"); ?>
</div>

<?php echo $form->close(); ?>
