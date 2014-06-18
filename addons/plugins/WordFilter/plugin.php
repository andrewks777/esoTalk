<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// Copyright 2014 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["WordFilter"] = array(
	"name" => "Word Filter",
	"description" => "Perform find and replace on post content when posts are displayed.",
	"version" => ESOTALK_VERSION,
	"author" => "esoTalk Team",
	"authorEmail" => "support@esotalk.org",
	"authorURL" => "http://esotalk.org",
	"license" => "GPLv2"
);


class ETPlugin_WordFilter extends ETPlugin {


	public function handler_format_format($sender)
	{
		$filters = $this->getFilters();
		if (count($filters)) $sender->content = $this->filterContent($sender->content, $filters);
	}
	
	
	public function handler_conversationController_conversationIndex($sender, &$conversation)
	{
		$filters = $this->getFilters();
		if (count($filters)) {
			if (!$conversation["canModerate"] and ($conversation["startMemberId"] != ET::$session->userId or $conversation["locked"])) $conversation["title"] = $this->filterContent($conversation["title"], $filters);
		}
	}
	
	
	public function handler_searchModel_afterGetResults($sender, &$results)
	{
		$filters = $this->getFilters();
		if (count($filters)) {
			
			foreach ($results as &$result) $result["title"] = $this->filterContent($result["title"], $filters);
		}
	}


	public function getFilters()
	{
		$disallow = ET::$session->preference("disallowWordFilter", false);
		if ($disallow) return array();

		$filters = C("plugin.WordFilter.filters", array());
		
		return $filters;
	}
	
	
	public function filterContent($content, $filters)
	{
		// Pass each instance of any filtered word to our callback.
		$words = array_keys($filters);
		return preg_replace_callback('#\b('.implode('|', $words).')\b#ium', array($this, "filterCallback"), $content);
	}
	
	
	public function filterCallback($matches)
	{
		$filters = C("plugin.WordFilter.filters", array());

		// Construct a mapping of lowercase words to their normal case in the filters array.
		$keys = array_keys($filters);
		$map = array();
		foreach ($keys as $key) {
			$map[strtolower($key)] = $key;
		}

		$match = $matches[1];

		// If there's a replacement for this particular casing of the word, use that.
		if (!empty($filters[$match])) $replacement = $filters[$match];

		// If there's a replacement for a lowercased version of this word, use that.
		elseif (!empty($filters[$map[strtolower($match)]])) $replacement = $filters[$map[strtolower($match)]];

		// Otherwise, use asterisks.
		//else $replacement = str_repeat("*", strlen($match));
		else $replacement = '[...]';

		return $replacement;
	}


	public function handler_settingsController_initGeneral($sender, $form)
	{
		$sections = $form->sections;
		$pos = array_search("multimediaEmbedding", array_keys($sections));
		if ($pos) $pos++;
		
		$form->addSection("wordFilter", T("settings.wordFilter.label"), $pos++);
	
		// Add the "disallow WordFilter" field.
		$form->setValue("disallowWordFilter", ET::$session->preference("disallowWordFilter", false));
		$form->addField("wordFilter", "disallowWordFilter", array(__CLASS__, "fieldDisallowWordFilter"), array($sender, "saveBoolPreference"));
		

	}
	

	/**
	 * Return the HTML to render the "fieldDisallowWordFilter" field in the general
	 * settings form.
	 *
	 * @param ETForm $form The form object.
	 * @return string
	 */
	public function fieldDisallowWordFilter($form)
	{
		return "<label class='checkbox'>".$form->checkbox("disallowWordFilter")." ".T("setting.disallowWordFilter.label")."</label>";
	}

	
	// Construct and process the settings form.
	public function settings($sender)
	{
		// Expand the filters array into a string that will go in the textarea.
		$filters = C("plugin.WordFilter.filters", array());
		$filterText = "";
		foreach ($filters as $word => $replacement) {
			$filterText .= $word.($replacement ? "|$replacement" : "")."\n";
		}
		$filterText = trim($filterText);

		// Set up the settings form.
		$form = ETFactory::make("form");
		$form->action = URL("admin/plugins");
		$form->setValue("filters", $filterText);

		// If the form was submitted...
		if ($form->validPostBack("wordFilterSave")) {

			// Create an array of word filters from the contents of the textarea.
			// Each line is a new element in the array; keys and values are separated by a | character.
			$filters = array();
			$lines = explode("\n", strtr($form->getValue("filters"), array("\r\n" => "\n", "\r" => "\n")));
			foreach ($lines as $line) {
				if (!$line) continue;
				$parts = explode("|", $line, 2);
				if (!$parts[0]) continue;
				$filters[$parts[0]] = @$parts[1];
			}

			// Construct an array of config options to write.
			$config = array();
			$config["plugin.WordFilter.filters"] = $filters;

			if (!$form->errorCount()) {

				// Write the config file.
				ET::writeConfig($config);

				$sender->message(T("message.changesSaved"), "success");
				$sender->redirect(URL("admin/plugins"));

			}
		}

		$sender->data("wordFilterSettingsForm", $form);
		return $this->getView("settings");
	}


}
