<?php
// Copyright 2013 Toby Zerner, Simon Zerner
// Copyright 2014 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

$form = $data["wordFilterSettingsForm"];
?>
<?php echo $form->open(); ?>

<div class='section'>

<ul class='form'>

<li>
<label><?php echo  T("plugin.WordFilter.wordFilters.label"); ?></label>
<?php echo $form->input("filters", "textarea", array("style" => "height:200px; width:350px")); ?>
<small><?php echo  T("plugin.WordFilter.wordFilters.desc"); ?></small>
</li>

</ul>

</div>

<div class='buttons'>
<?php echo $form->saveButton("wordFilterSave"); ?>
</div>

<?php echo $form->close(); ?>
