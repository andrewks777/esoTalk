<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["BBCode"] = array(
	"name" => "BBCode",
	"description" => "Formats BBCode within posts, allowing users to style their text.",
	"version" => ESOTALK_VERSION,
	"author" => "esoTalk Team",
	"authorEmail" => "support@esotalk.org",
	"authorURL" => "http://esotalk.org",
	"license" => "GPLv2"
);


/**
 * BBCode Formatter Plugin
 *
 * Interprets BBCode in posts and converts it to HTML formatting when rendered. Also adds BBCode formatting
 * buttons to the post editing/reply area.
 */
class ETPlugin_BBCode extends ETPlugin {


protected function addResources($sender)
{
	$groupKey = 'bbcode';
	$sender->addJSFile($this->getResource("bbcode.js"), false, $groupKey);
	$sender->addCSSFile($this->getResource("bbcode.css"), false, $groupKey);
	
	// Syntax highlighting
	$sender->addJSFile($this->getResource("highlight.pack.js"), false, $groupKey);
	$sender->addCSSFile($this->getResource("hl-styles/github.css"), false, $groupKey);
	$sender->addCSSFile($this->getResource("hl-styles/_1c.css"), false, $groupKey);
}


/**
 * Add an event handler to the initialization of the conversation controller to add BBCode CSS and JavaScript
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
 * Add an event handler to the "getEditControls" method of the conversation controller to add BBCode
 * formatting buttons to the edit controls.
 *
 * @return void
 */
public function handler_conversationController_getEditControls($sender, &$controls, $id)
{
	addToArrayString($controls, "spoiler", "<a href='javascript:BBCode.spoiler(\"$id\");void(0)' title='".T("Spoiler")."' class='bbcode-spoiler'><span>".T("Spoiler")."</span></a>", 0);
	addToArrayString($controls, "fixed", "<span class='code-lng'><ul class='code-lng-list' data-id='$id'></ul><a href='javascript:BBCode.fixed(\"$id\");void(0)' title='".T("Code")."' class='bbcode-fixed'><span>".T("Code")."</span></a></span>", 0);
	addToArrayString($controls, "image", "<a href='javascript:BBCode.image(\"$id\");void(0)' title='".T("Image")."' class='bbcode-img'><span>".T("Image")."</span></a>", 0);
	addToArrayString($controls, "link", "<a href='javascript:BBCode.link(\"$id\");void(0)' title='".T("Link")."' class='bbcode-link'><span>".T("Link")."</span></a>", 0);
	addToArrayString($controls, "header", "<a href='javascript:BBCode.header(\"$id\");void(0)' title='".T("Header")."' class='bbcode-h'><span>".T("Header")."</span></a>", 0);
	addToArrayString($controls, "strike", "<a href='javascript:BBCode.strikethrough(\"$id\");void(0)' title='".T("Strike")."' class='bbcode-s'><span>".T("Strike")."</span></a>", 0);
	addToArrayString($controls, "italic", "<a href='javascript:BBCode.italic(\"$id\");void(0)' title='".T("Italic")."' class='bbcode-i'><span>".T("Italic")."</span></a>", 0);
	addToArrayString($controls, "bold", "<a href='javascript:BBCode.bold(\"$id\");void(0)' title='".T("Bold")."' class='bbcode-b'><span>".T("Bold")."</span></a>", 0);
}


/**
 * Add an event handler to the formatter to take out and store code blocks before formatting takes place.
 *
 * @return void
 */
public function handler_format_beforeFormat($sender)
{
	// Block-level [fixed] tags will become <pre>.
	$this->blockFixedContents = array();
	$hideFixed = create_function('&$blockFixedContents, $contents, $langId', '
		$blockFixedContents[] = array(
			\'content\' => $contents,
			\'langId\' => $langId
		);
		return "</p><pre></pre><p>";');
	$regexp = "/(.*)^ *\[code(?:=(\w+(?:-\w+)*))?\]\n?(.*?)\n?\[\/code] *$/imseu";
	while (preg_match($regexp, $sender->content)) $sender->content = preg_replace($regexp, "'$1' . \$hideFixed(\$this->blockFixedContents, '$3', '$2')", $sender->content);

	// Inline-level [fixed] tags will become <code>.
	$this->inlineFixedContents = array();
	$hideFixed = create_function('&$inlineFixedContents, $contents', '
		$inlineFixedContents[] = $contents;
		return "<code></code>";');
	$sender->content = preg_replace("/\[code\]\n?(.*?)\n?\[\/code]/ise", "\$hideFixed(\$this->inlineFixedContents, '$1')", $sender->content);
	
	// Spoiler: [b]spoiler[/b]
	// insert spaces for prevention of loss of formatting
	$sender->content = preg_replace("|\[spoiler\](.*?)\[/spoiler\]|si", "[spoiler] $1 [/spoiler]", $sender->content);
}


/**
 * Add an event handler to the formatter to parse BBCode and format it into HTML.
 *
 * @return void
 */
public function handler_format_format($sender)
{
	// TODO: Rewrite BBCode parser to use the method found here:
	// http://stackoverflow.com/questions/1799454/is-there-a-solid-bb-code-parser-for-php-that-doesnt-have-any-dependancies/1799788#1799788
	// Remove control characters from the post.
	//$sender->content = preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', $sender->content);
	// \[ (i|b|color|url|somethingelse) \=? ([^]]+)? \] (?: ([^]]*) \[\/\1\] )

	// Images: [img=description]url[/img]
	$onerror = "javascript:ETConversation.onErrorLoadingImage(this);";
	if (!$sender->basic) $sender->content = preg_replace_callback("/\[img(?:=(.*))?\](.*?)\[\/img\]/i", array($this, "imgCallback"), $sender->content);

	// Links with display text: [url=http://url]text[/url]
	$sender->content = preg_replace_callback("/\[url=(\w{2,6}:\/\/)?([^\]]*?)\](.*?)\[\/url\]/i", array($this, "linksCallback"), $sender->content);

	// Bold: [b]bold text[/b]
	$sender->content = preg_replace("|\[b\](.*?)\[/b\]|si", "<b>$1</b>", $sender->content);

	// Italics: [i]italic text[/i]
	$sender->content = preg_replace("/\[i\](.*?)\[\/i\]/si", "<i>$1</i>", $sender->content);

	// Strikethrough: [s]strikethrough[/s]
	$sender->content = preg_replace("/\[s\](.*?)\[\/s\]/si", "<del>$1</del>", $sender->content);

	// Headers: [h]header[/h]
	$sender->content = preg_replace("/\[h\](.*?)\[\/h\]/", "</p><h4>$1</h4><p>", $sender->content);
	
	// Spoiler: [b]spoiler[/b]
	$sender->content = preg_replace("|\[spoiler\] (.*?\n.*?) \[/spoiler\]|si", "<div class='spoiler-link'><a href='javascript:void(0)'>".T("Hidden text")." ".((ET::$session->user) ? "<i class='icon-double-angle-right'></i></a></div><div class='spoiler-block' style='display:none'>$1</div>" : "</a></div>"), $sender->content);
	$sender->content = preg_replace("|\[spoiler\] (.*?) \[/spoiler\]|si", "<div class='spoiler-link spoiler-link-line'><a href='javascript:void(0)'>".T("Hidden text")." ".((ET::$session->user) ? "<i class='icon-double-angle-right'></i></a></div><div class='spoiler-block spoiler-line' style='display:none'>$1</div>" : "</a></div>"), $sender->content);
}


/**
 * The callback function used to replace IMG BBCode with HTML anchor tags.
 *
 * @param array $matches An array of matches from the regular expression.
 * @return string The replacement HTML anchor tag.
 */
public function imgCallback($matches)
{
	$onerror = "javascript:ETConversation.onErrorLoadingImage(this);";
	$desc = $matches[1] ? $matches[1] : "-image-";
	$title = $matches[1];
	$url = $matches[2];
	return "<img onerror='$onerror' src='$url' alt='$desc' title='$title'/>";
}


/**
 * The callback function used to replace URL BBCode with HTML anchor tags.
 *
 * @param array $matches An array of matches from the regular expression.
 * @return string The replacement HTML anchor tag.
 */
public function linksCallback($matches)
{
	// If this is an internal link...
	$url = ($matches[1] ? $matches[1] : "http://").$matches[2];
	$baseURL = C("esoTalk.baseURL");
	if (substr($url, 0, strlen($baseURL)) == $baseURL) {
		return "<a href='".$url."' target='_blank' class='link-internal'>".$matches[3]."</a>";
	}

	// Otherwise, return an external HTML anchor tag.
	return "<a href='".$url."' rel='nofollow external' target='_blank' class='link-external'>".$matches[3]." <i class='icon-external-link'></i></a>";
}


/**
 * Add an event handler to the formatter to put code blocks back in after formatting has taken place.
 *
 * @return void
 */
public function handler_format_afterFormat($sender)
{
	// Retrieve the contents of the inline <code> tags from the array in which they are stored.
	$sender->content = preg_replace("/<code><\/code>/ie", "'<code>' . array_shift(\$this->inlineFixedContents) . '</code>'", $sender->content);

	// Retrieve the contents of the block <pre> tags from the array in which they are stored.
	$sender->content = preg_replace_callback("/<pre><\/pre>/i", array($this, "blockFixedCallback"), $sender->content);
}


public function blockFixedCallback($matches)
{
	$block = array_pop($this->blockFixedContents);
	$blockContent = $block['content'];
	$blockLangId = mb_strtolower($block['langId'], "utf8");
	if (!$blockLangId) $blockLangId = "no-highlight";
	else if ($blockLangId == "_auto_") $blockLangId = "";
	$blockLangId = preg_replace("/_?1[cс](.*)/iu", "_1c$1", $blockLangId); // normalize, cyrillic 'c' -> latin 'c'
	if ($blockLangId == "_1c") $blockLangId = "_1c8"; // by default
	return "<pre class='_nhl $blockLangId'>".$blockContent."</pre>";
}

}
