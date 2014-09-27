<?php
// Copyright 2014 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * The tape controller shows a last activity.
 *
 * @package esoTalk
 */
 

class ETTapeController extends ETController {



/**
 * View a activity pane.
 *
 * @return void
 */
public function action_index($page = "")
{
	
	// Work out the page number we're viewing and fetch the activity.
	$page = max(0, (int)$page - 1);
	$activity = ET::activityModel()->getAllActivity($page * 10, 11);

	// We fetch 11 items so we can tell if there are more items after this page.
	$showViewMoreLink = false;
	if (count($activity) == 11) {
		array_pop($activity);
		$showViewMoreLink = true;
	}
	
	// Pass along necessary data to the view.
	$this->data("activity", $activity);
	$this->data("page", $page);
	$this->data("showViewMoreLink", $showViewMoreLink);

	if ($this->responseType === RESPONSE_TYPE_DEFAULT) {
		
		// Set the title and include relevant JavaScript.
		$this->title = T("Tape");
		$this->addJSFile("core/js/tape.js");
		
		$this->render("tape/activity");
	}
	elseif ($this->responseType === RESPONSE_TYPE_VIEW or $this->responseType === RESPONSE_TYPE_AJAX) {
		$this->render("tape/activity");
	}
		
}


}