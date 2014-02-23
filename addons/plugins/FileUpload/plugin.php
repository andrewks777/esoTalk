<?php
// Copyright 2013 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.
// Uses: jQuery File Upload https://github.com/blueimp/jQuery-File-Upload
// Depends: Apache2 module 'mod_xsendfile.so'

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

// default values
if (!(C("plugin.FileUpload.usrFolderName"))) ET::$config["plugin.FileUpload.usrFolderName"] = 'usr';

/**
 * FileUpload Plugin
 *
 * Uploading files on the server. Also adds buttons to the post editing/reply area.
 */
class ETPlugin_FileUpload extends ETPlugin {

	// Setup: create the tables in the database and set up the filesystem for uploads storage.
	public function setup($oldVersion = "")
	{
		$model = ET::getInstance("FileUploadModel");
		$usrPath = $model->usr_path();
		$htmlPath = $usrPath . "/index.html";
		
		$structure = ET::$database->structure();
		$structure->table("uploaded_files")
			->column("id", "varchar(13)", false)
			->column("memberId", "int(15) unsigned")
			->column("conversationId", "int(15) unsigned")
			->column("time", "int(11) unsigned", false)
			->column("memberIP", "int(11)", 0)
			->column("filename", "varchar(255)", false)
			->column("origFilename", "varchar(255)", false)
			->key("id", "primary")
			->key("memberId")
			->exec(false);
			
		$structure->table("downloaded_files")
			->column("downloadId", "int(15) unsigned", false)
			->column("id", "varchar(13)", false)
			->column("memberId", "int(15) unsigned")
			->column("time", "int(11) unsigned", false)
			->column("memberIP", "int(11)", 0)
			->key("downloadId", "primary")
			->key("id")
			->key("memberId")
			->exec(false);

		// Make the uploads folder, and put in an index.html to prevent directory listing
		if ((!file_exists($usrPath) and !@mkdir($usrPath))
			or (!is_writable($usrPath) and !@chmod($usrPath, 0777)))
			return "The uploads directory does not exist or is not writeable.";

		if (!file_exists($htmlPath)) file_put_contents($htmlPath, "");

		return true;
	}


	// Register model/controller.
	public function __construct($rootDirectory)
	{
		parent::__construct($rootDirectory);
		ETFactory::register("FileUploadModel", "FileUploadModel", dirname(__FILE__)."/FileUploadModel.class.php");
		ETFactory::registerController("fileupload", "FileUploadController", dirname(__FILE__)."/FileUploadController.class.php");
	}


	protected function getFileTypesJS($fileTypesName)
	{
		$allowedFileTypes = C($fileTypesName);
		if (!isset($allowedFileTypes)) $allowedFileTypes = array();
		$pattern = '.+$'; // all
		$types = '';
		if ($allowedFileTypes) {
			if (count($allowedFileTypes)) {
				$pattern = '\\.('.implode('|', $allowedFileTypes).')$';
				$types = implode(' ', $allowedFileTypes);
			}
		}
		
		return array('types' => $types, 'pattern' => $pattern);
	}
	
	
	protected function addResources($sender)
	{
		$groupKey = 'FileUpload';
		$sender->addJSVar("fileUploadPluginMaxFileSize", C("plugin.FileUpload.maxFileSize"));
		$fileTypes = array(
			'image' => $this->getFileTypesJS("plugin.FileUpload.allowedImageTypes"),
			'archive' => $this->getFileTypesJS("plugin.FileUpload.allowedArchiveTypes"),
			'file' => $this->getFileTypesJS("plugin.FileUpload.allowedFileTypes")
		);
		$sender->addJSVar("fileUploadPluginAllowedTypes", $fileTypes);
		$sender->addJSFile($this->getResource("vendor/jquery.ui.widget.js"), false, $groupKey);
		$sender->addJSFile($this->getResource("vendor/jquery.iframe-transport.js"), false, $groupKey);
		$sender->addJSFile($this->getResource("vendor/jquery.fileupload.js"), false, $groupKey);
		$sender->addJSFile($this->getResource("vendor/jquery.fileupload-process.js"), false, $groupKey);
		$sender->addJSFile($this->getResource("vendor/jquery.fileupload-validate.js"), false, $groupKey);
		$sender->addJSFile($this->getResource("upload.js"), false, $groupKey);
		$sender->addCSSFile($this->getResource("upload.css"), false, $groupKey);
		$sender->addJSLanguage(
			"plugin.FileUpload.message.serverDisconnected.file",
			"plugin.FileUpload.message.serverDisconnected.image",
			"plugin.FileUpload.message.serverDisconnected.archive",
			"plugin.FileUpload.uploadTitle",
			"plugin.FileUpload.message.uploadError.file",
			"plugin.FileUpload.message.uploadError.image",
			"plugin.FileUpload.message.uploadError.archive",
			"plugin.FileUpload.message.vendor.uploadedBytes",
			"plugin.FileUpload.message.vendor.maxNumberOfFiles",
			"plugin.FileUpload.message.vendor.acceptFileTypes",
			"plugin.FileUpload.message.vendor.maxFileSize",
			"plugin.FileUpload.message.vendor.minFileSize"
		);
		
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
		$inputDefault = "<input class='fileupload' data-uploadtype='image' id='fileupload-$id' type='file' accept='image/*' name='files[]' multiple title='" . T("plugin.FileUpload.uploadImageTitle") . "' data-title='" . T("plugin.FileUpload.uploadImageTitle") . "'>";
		$inputImage = "<input class='fileupload' data-uploadtype='image' id='fileupload-image-$id' type='file' accept='image/*' name='files[]' multiple title='" . T("plugin.FileUpload.uploadImageTitle") . "' data-title='" . T("plugin.FileUpload.uploadImageTitle") . "'>";
		$inputArchive = "<input class='fileupload' data-uploadtype='archive' id='fileupload-archive-$id' type='file' accept='' name='files[]' multiple title='" . T("plugin.FileUpload.uploadArchiveTitle") . "' data-title='" . T("plugin.FileUpload.uploadArchiveTitle") . "'>";
		$inputFile = "<input class='fileupload' data-uploadtype='file' id='fileupload-file-$id' type='file' accept='' name='files[]' multiple title='" . T("plugin.FileUpload.uploadFileTitle") . "' data-title='" . T("plugin.FileUpload.uploadFileTitle") . "'>";
		$uploadList = "<ul class='upload-list'><li><span class='upload-image'>" . $inputImage . T("plugin.FileUpload.uploadImage") . "</span></li><li><span class='upload-archive'>" . $inputArchive . T("plugin.FileUpload.uploadArchive") . "</span></li></ul>";
		addToArrayString($controls, "upload", "<span class='upload'>" . $uploadList . $inputDefault ."<span class='fileupload-process'></span></span>");
	}

	// Construct and process the settings form.
	public function settings($sender)
	{
		// Set up the settings form.
		$form = ETFactory::make("form");
		$form->action = URL("admin/plugins");
		$form->setValue("allowedImageTypes", implode(" ", (array)C("plugin.FileUpload.allowedImageTypes")));
		$form->setValue("allowedArchiveTypes", implode(" ", (array)C("plugin.FileUpload.allowedArchiveTypes")));
		$form->setValue("allowedFileTypes", implode(" ", (array)C("plugin.FileUpload.allowedFileTypes")));
		$form->setValue("maxFileSize", C("plugin.FileUpload.maxFileSize"));

		// If the form was submitted...
		if ($form->validPostBack("fileUploadSave")) {

			// Construct an array of config options to write.
			$config = array();
			$imageTypes = $form->getValue("allowedImageTypes");
			$config["plugin.FileUpload.allowedImageTypes"] = $imageTypes ? explode(" ", $imageTypes) : "";
			$archiveTypes = $form->getValue("allowedArchiveTypes");
			$config["plugin.FileUpload.allowedArchiveTypes"] = $imageTypes ? explode(" ", $archiveTypes) : "";
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
