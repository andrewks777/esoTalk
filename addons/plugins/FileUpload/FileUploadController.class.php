<?php
// Copyright 2013 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

class FileUploadController extends ETController {

	
	protected function usr_url()
	{
		return URL(C("plugin.FileUpload.usrFolderName"));
	}
	
	protected function usr_url_img()
	{
		$userId = ET::$session->userId;
		return $this->usr_url() . "/img/$userId/";
	}
	
	protected function usr_url_hotpic()
	{
		$userId = ET::$session->userId;
		return $this->usr_url() . "/hotpic/$userId/";
	}

	protected function usr_url_files()
	{
		return URL("fileupload") . "/download/";
	}
	
	protected function usr_url_files_real($userId = false)
	{
		if ($userId === false) $userId = ET::$session->userId;
		return $this->usr_url() . "/files/$userId/";
	}

	protected function usr_url_files_relative($userId = false)
	{
		if ($userId === false) $userId = ET::$session->userId;
		return "files/$userId/";
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
	
	
	// Upload a file.
	public function upload($type = '', $conversationId = 0)
	{
		if (!ET::$session->user) return;
		
		require_once 'UploadHandler.php';
		
		if (!$type) $type = 'image';
		$model = ET::getInstance("FileUploadModel");
		
		if ($type == 'image') {
			$path = $model->usr_path_img();
			$url = $this->usr_url_img();
			$allowedFileTypes = C("plugin.FileUpload.allowedImageTypes");
			$addId = false;
		} else
		if ($type == 'archive') {
			$path = $model->usr_path_files();
			$url = $this->usr_url_files();
			$allowedFileTypes = C("plugin.FileUpload.allowedArchiveTypes");
			$addId = true;
		} else
		if ($type == 'file') {
			$path = $model->usr_path_files();
			$url = $this->usr_url_files();
			$allowedFileTypes = C("plugin.FileUpload.allowedFileTypes");
			$addId = true;
		} else {
			$this->render404(T("plugin.FileUpload.message.invalidUploadType"), true);
			return false;
		}
		
		if ($allowedFileTypes == ".") {
			$this->render404(T("plugin.FileUpload.message.invalidUploadType"), true);
			return false;
		}
		
		if (!isset($allowedFileTypes)) $allowedFileTypes = array();
		$maxFileSize = C("plugin.FileUpload.maxFileSize");
		$ftypes = '/.+$/i'; // all
		if ($allowedFileTypes) {
			if (count($allowedFileTypes)) $ftypes = '/\.('.implode('|', $allowedFileTypes).')$/i';
		}
		
		$options = array(
			'upload_dir' => $path,
			'upload_url' => $url,
			'transliterate_names' => true,
			'add_id_to_path' => $addId,
			'accept_file_types' => $ftypes,
			'accept_file_types_str' => implode(" ", (array)$allowedFileTypes),
			'max_file_size' => $maxFileSize ? $maxFileSize : null,
			/*'image_versions' => array(
			   '' => array(
                    'auto_orient' => true
                ),
			)*/
		);
		
		$upload_handler = new UploadHandler($options, false);
		set_time_limit(60);
		$upload_handler->post();
		if ($addId) $model->insertUploads($upload_handler->uploaded_files, (int)$conversationId);
		
	}

	// Download a file.
	public function download($id = '')
	{

		if (!ET::$session->user) {
			$this->renderMessage(T("Error"), sprintf(T("plugin.FileUpload.message.logInToDownload"), URL("user/login"), URL("user/join")));
			return false;
		}
		
		$success = false;
		if ($id) {
			$model = ET::getInstance("FileUploadModel");
			$upload = $model->findUpload($id);
			if ($upload) {
				// upload is exists
				$path = $model->usr_path_files($upload['memberId']);
				$file_name = $upload['filename'];
				$file_name_orig = $upload['origFilename'];
				$file_path = $path . $file_name;
				if (is_file($file_path) && $file_name[0] !== '.') {
					// file is exists
					$success = true;
					$url = $this->usr_url_files_relative($upload['memberId']) . $file_name;
					$url = $file_path; // absolute path
					header('X-SendFile: ' . $url);
					header("Content-Type: application/octet-stream");
					header("Content-Disposition: attachment; filename=\"$file_name_orig\"");
					
					$model->insertDownload($id);
				}
			}
		}
		
		if (!$success) {
			$this->renderMessage(T("Error"), T("plugin.FileUpload.message.fileNotFound"));
			return false;
		}
		
	}

}