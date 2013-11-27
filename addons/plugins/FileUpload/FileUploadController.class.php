<?php
// Copyright 2013 Toby Zerner, Simon Zerner
// Copyright 2013 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

class FileUploadController extends ETController {

	public function usr_path()
	{
		return PATH_ROOT."/usr";
	}
	
	public function usr_path_img()
	{
		$userId = ET::$session->userId;
		return $this->usr_path()."/img/$userId/";
	}
	
	public function usr_path_hotpic()
	{
		$userId = ET::$session->userId;
		return $this->usr_path()."/hotpic/$userId/";
	}
	
	public function usr_url()
	{
		return URL("usr");
	}
	
	public function usr_url_img()
	{
		$userId = ET::$session->userId;
		return $this->usr_url()."/img/$userId/";
	}
	
	public function usr_url_hotpic()
	{
		$userId = ET::$session->userId;
		return $this->usr_url()."/hotpic/$userId/";
	}

	// Management of files.
	public function index()
	{
		if (!ET::$session->user) {
			$this->renderMessage(T("Error"), T("message.noPermission"));
			return false;
		}
		
		echo "coming soon";
	}
	
	
	// Upload an file.
	public function upload()
	{
		if (!ET::$session->user) return;
		
		require_once 'UploadHandler.php';
		
		$allowedFileTypes = C("plugin.FileUpload.allowedFileTypes");
		$maxFileSize = C("plugin.FileUpload.maxFileSize");
		$ftypes = '/.+$/i'; // all
		if (isset($allowedFileTypes)) {
			if (count($allowedFileTypes)) $ftypes = '/\.('.implode('|', $allowedFileTypes).')$/i';
		}
		
		$options = array(
			'upload_dir' => $this->usr_path_img(),
			'upload_url' => $this->usr_url_img(),
			'transliterate_names' => true,
			'accept_file_types' => $ftypes,
			'max_file_size' => $maxFileSize ? $maxFileSize : null,
			/*'image_versions' => array(
			   '' => array(
                    'auto_orient' => true
                ),
			)*/
		);
		
		$upload_handler = new UploadHandler($options);
		
		
	}


}