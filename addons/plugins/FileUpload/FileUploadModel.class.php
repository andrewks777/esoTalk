<?php
// Copyright 2013 Toby Zerner, Simon Zerner
// Copyright 2013 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

class FileUploadModel extends ETModel {

	public static $mimes = array(

		'hqx'   => 'application/mac-binhex40',
		'cpt'   => 'application/mac-compactpro',
		'csv'   => array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream'),
		'bin'   => 'application/macbinary',
		'dms'   => 'application/octet-stream',
		'lha'   => 'application/octet-stream',
		'lzh'   => 'application/octet-stream',
		'exe'   => array('application/octet-stream', 'application/x-msdownload'),
		'class' => 'application/octet-stream',
		'psd'   => 'application/x-photoshop',
		'so'    => 'application/octet-stream',
		'sea'   => 'application/octet-stream',
		'dll'   => 'application/octet-stream',
		'oda'   => 'application/oda',
		'pdf'   => array('application/pdf', 'application/x-download'),
		'ai'    => 'application/postscript',
		'eps'   => 'application/postscript',
		'ps'    => 'application/postscript',
		'smi'   => 'application/smil',
		'smil'  => 'application/smil',
		'mif'   => 'application/vnd.mif',
		'xls'   => array('application/excel', 'application/vnd.ms-excel', 'application/msexcel'),
		'ppt'   => array('application/powerpoint', 'application/vnd.ms-powerpoint'),
		'wbxml' => 'application/wbxml',
		'wmlc'  => 'application/wmlc',
		'dcr'   => 'application/x-director',
		'dir'   => 'application/x-director',
		'dxr'   => 'application/x-director',
		'dvi'   => 'application/x-dvi',
		'gtar'  => 'application/x-gtar',
		'gz'    => 'application/x-gzip',
		'php'   => array('application/x-httpd-php', 'text/x-php'),
		'php4'  => 'application/x-httpd-php',
		'php3'  => 'application/x-httpd-php',
		'phtml' => 'application/x-httpd-php',
		'phps'  => 'application/x-httpd-php-source',
		'js'    => 'application/x-javascript',
		'swf'   => 'application/x-shockwave-flash',
		'sit'   => 'application/x-stuffit',
		'tar'   => 'application/x-tar',
		'tgz'   => array('application/x-tar', 'application/x-gzip-compressed'),
		'xhtml' => 'application/xhtml+xml',
		'xht'   => 'application/xhtml+xml',
		'zip'   => array('application/x-zip', 'application/zip', 'application/x-zip-compressed'),
		'mid'   => 'audio/midi',
		'midi'  => 'audio/midi',
		'mpga'  => 'audio/mpeg',
		'mp2'   => 'audio/mpeg',
		'mp3'   => array('audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3'),
		'aif'   => 'audio/x-aiff',
		'aiff'  => 'audio/x-aiff',
		'aifc'  => 'audio/x-aiff',
		'ram'   => 'audio/x-pn-realaudio',
		'rm'    => 'audio/x-pn-realaudio',
		'rpm'   => 'audio/x-pn-realaudio-plugin',
		'ra'    => 'audio/x-realaudio',
		'rv'    => 'video/vnd.rn-realvideo',
		'wav'   => 'audio/x-wav',
		'bmp'   => 'image/bmp',
		'gif'   => 'image/gif',
		'jpeg'  => array('image/jpeg', 'image/pjpeg'),
		'jpg'   => array('image/jpeg', 'image/pjpeg'),
		'jpe'   => array('image/jpeg', 'image/pjpeg'),
		'png'   => 'image/png',
		'tiff'  => 'image/tiff',
		'tif'   => 'image/tiff',
		'css'   => 'text/css',
		'html'  => 'text/html',
		'htm'   => 'text/html',
		'shtml' => 'text/html',
		'txt'   => 'text/plain',
		'text'  => 'text/plain',
		'log'   => array('text/plain', 'text/x-log'),
		'rtx'   => 'text/richtext',
		'rtf'   => 'text/rtf',
		'xml'   => 'text/xml',
		'xsl'   => 'text/xml',
		'mpeg'  => 'video/mpeg',
		'mpg'   => 'video/mpeg',
		'mpe'   => 'video/mpeg',
		'qt'    => 'video/quicktime',
		'mov'   => 'video/quicktime',
		'avi'   => 'video/x-msvideo',
		'movie' => 'video/x-sgi-movie',
		'doc'   => 'application/msword',
		'docx'  => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'xlsx'  => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		'word'  => array('application/msword', 'application/octet-stream'),
		'xl'    => 'application/excel',
		'eml'   => 'message/rfc822',
		'json'  => array('application/json', 'text/json'),

	);

	public function __construct()
	{
		parent::__construct("fileUpload");
	}

	public function usr_path()
	{
		return PATH_ROOT . "/" . C("plugin.FileUpload.usrFolderName");
	}
	
	public function usr_path_img($userId = false)
	{
		if ($userId === false) $userId = ET::$session->userId;
		return $this->usr_path() . "/img/$userId/";
	}
	
	public function usr_path_hotpic($userId = false)
	{
		if ($userId === false) $userId = ET::$session->userId;
		return $this->usr_path() . "/hotpic/$userId/";
	}

	public function usr_path_files($userId = false)
	{
		if ($userId === false) $userId = ET::$session->userId;
		return $this->usr_path() . "/files/$userId/";
	}
	
	public function mime($path)
	{
		$extension = pathinfo($path, PATHINFO_EXTENSION);

		if ( ! array_key_exists($extension, static::$mimes)) return "application/octet-stream";

		return (is_array(static::$mimes[$extension])) ? static::$mimes[$extension][0] : static::$mimes[$extension];
	}

	// Find upload and return them.
	public function findUpload($id)
	{
		// Get an entry in the database with this id.
		$result = ET::SQL()
			->select("*")
			->from("uploaded_files")
			->where("id", $id)
			->exec();

		// If a matching record exists...
		if ($row = $result->firstRow() and $row["id"] == $id) {
			return $row;
		} else {
			return null;
		}
	}

	// Insert uploads in the database.
	public function insertUploads($files, $conversationId = 0, $memberId = false, $time = 0, $memberIP = false)
	{
		if (!$time) $time = time();
		foreach ($files as $file) {
			$id = $file->uploadId;
			ET::SQL()->insert("uploaded_files")->set(array(
				"id" => $id,
				"memberId" => ($memberId !== false) ? $memberId : ET::$session->userId,
				"conversationId" => $conversationId,
				"time" => $time,
				"memberIP" => ($memberIP !== false) ? $memberIP : getUserIP(),
				"filename" => $file->name,
				"origFilename" => $file->origName
			))->setOnDuplicateKey("id", $id)->exec();
		}
	}

	// Insert download in the database.
	public function insertDownload($id, $memberId = false, $time = 0, $memberIP = false)
	{
		if (!$time) $time = time();
		ET::SQL()->insert("downloaded_files")->set(array(
			"id" => $id,
			"memberId" => ($memberId !== false) ? $memberId : ET::$session->userId,
			"time" => $time,
			"memberIP" => ($memberIP !== false) ? $memberIP : getUserIP()
		))->exec();
	}
	
}