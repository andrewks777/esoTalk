<?php
// Copyright 2013 Toby Zerner, Simon Zerner
// Copyright 2013 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["FileUpload"] = array(
	"name" => "FileUpload",
	"description" => "Uploading files on the server.",
	"version" => ESOTALK_VERSION,
	"author" => "andrewks",
	"authorEmail" => "forum330@gmail.com",
	"authorURL" => "http://forum330.com",
	"license" => "GPLv2"
);


/**
 * FileUpload Plugin
 *
 * Uploading files on the server. Also adds buttons to the post editing/reply area.
 */
class ETPlugin_FileUpload extends ETPlugin {

// Register model/controller.
public function __construct($rootDirectory)
{
	parent::__construct($rootDirectory);
	ETFactory::registerController("fileupload", "FileUploadController", dirname(__FILE__)."/FileUploadController.class.php");
}


protected function addResources($sender)
{
	$groupKey = 'FileUpload';
	$sender->addJSFile($this->getResource("vendor/jquery.ui.widget.js"), false, $groupKey);
	$sender->addJSFile($this->getResource("vendor/jquery.iframe-transport.js"), false, $groupKey);
	$sender->addJSFile($this->getResource("vendor/jquery.fileupload.js"), false, $groupKey);
	$sender->addJSFile($this->getResource("upload.js"), false, $groupKey);
	$sender->addCSSFile($this->getResource("upload.css"), false, $groupKey);
	$sender->addJSLanguage("plugin.FileUpload.message.serverDisconnected", "plugin.FileUpload.uploadTitle", "plugin.FileUpload.message.uploadError");
	
}


/**
 * Add an event handler to the initialization of the conversation controller to add CSS and JavaScript
 * resources.
 *
 * @return void
 */
public function handler_conversationController_renderBefore($sender)
{
	$this->addResources($sender);
}

public function handler_conversationsController_init($sender)
{
	$this->addResources($sender);
}

public function handler_memberController_renderBefore($sender)
{
	$this->handler_conversationController_renderBefore($sender);
}

/**
 * Add an event handler to the "getEditControls" method of the conversation controller to add 
 * buttons to the edit controls.
 *
 * @return void
 */
public function handler_conversationController_getEditControls($sender, &$controls, $id)
{
	addToArrayString($controls, "upload", "<span class='upload'><input class='fileupload' id='fileupload-$id' type='file' name='files[]' multiple title='".T("plugin.FileUpload.uploadTitle")."'><span class='fileupload-process'></span></span>");
}

// Construct and process the settings form.
public function settings($sender)
{
	// Set up the settings form.
	$form = ETFactory::make("form");
	$form->action = URL("admin/plugins");
	$form->setValue("allowedFileTypes", implode(" ", (array)C("plugin.FileUpload.allowedFileTypes")));
	$form->setValue("maxFileSize", C("plugin.FileUpload.maxFileSize"));

	// If the form was submitted...
	if ($form->validPostBack("fileUploadSave")) {

		// Construct an array of config options to write.
		$config = array();
		$fileTypes = $form->getValue("allowedFileTypes");
		$config["plugin.FileUpload.allowedFileTypes"] = $fileTypes ? explode(" ", $fileTypes) : "";
		$config["plugin.FileUpload.maxFileSize"] = $form->getValue("maxFileSize");

		if (!$form->errorCount()) {

			// Write the config file.
			ET::writeConfig($config);

			$sender->message(T("message.changesSaved"), "success");
			$sender->redirect(URL("admin/plugins"));

		}
	}

	$sender->data("fileUploadSettingsForm", $form);
	return $this->getView("settings");
}

}
