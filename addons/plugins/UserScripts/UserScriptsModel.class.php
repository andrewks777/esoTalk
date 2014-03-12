<?php
// Copyright 2014 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

class UserScriptsModel extends ETModel {

	public function getPathUserJS($id = false)
	{
		if (!$id) $id = ET::$session->userId;
		return PATH_UPLOADS."/js/".$id.".js";
	}
	
	
	public function getPathUserCSS($id = false)
	{
		if (!$id) $id = ET::$session->userId;
		return PATH_UPLOADS."/css/".$id.".css";
	}
	

	public function getUrlUserJS($id = false)
	{
		if (!$id) $id = ET::$session->userId;
		return "uploads/js/$id.js";
	}
	
	
	public function getUrlUserCSS($id = false)
	{
		if (!$id) $id = ET::$session->userId;
		return "uploads/css/$id.css";
	}

	
	public function isResourceExists($restype = false, $id = false)
	{
		if (!$id) $id = ET::$session->userId;
		if ($restype == 'js') $file_name = $this->getPathUserJS();
		elseif ($restype == 'css') $file_name = $this->getPathUserCSS();
		else return false;
		
		$ret = false;
		if (is_file($file_name)) {
			$basename = pathinfo($file_name, PATHINFO_BASENAME);
			$ret = ($basename[0] !== '.');
		}
		return $ret;
	}
	
}