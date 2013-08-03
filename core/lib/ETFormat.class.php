<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * The ETFormat class provides various formatting methods which can be performed on a string. It also includes
 * a way for plugins to hook in and add their own formatting methods.
 *
 * @package esoTalk
 */
class ETFormat extends ETPluggable {


/**
 * The content string to perform all formatting operations on.
 * @var string
 */
public $content = "";


/**
 * Whether or not to do "basic", inline-only formatting, i.e. don't embed YouTube videos, images, etc.
 * @var bool
 */
public $basic = false;

public $conversationId = 0;
public $relativePostId = 0;

/**
 * Initialize the formatter with a content string on which all subsequent operations will be performed.
 *
 * @param string $content The content string.
 * @param bool $sanitize Whether or not to sanitize HTML in the content.
 * @return ETFormat
 */

public function init($content, $sanitize = true, $conversationId = 0, $relativePostId = 0)
{
	// Clean up newline characters - make sure the only ones we are using are \n!
	$content = strtr($content, array("\r\n" => "\n", "\r" => "\n")) . "\n";

	// Set the content, and sanitize if necessary.
	$this->content = $sanitize ? sanitizeHTML($content) : $content;

	$this->conversationId = $conversationId;
	$this->relativePostId = $relativePostId;
	
	return $this;
}


/**
 * Turn "basic", inline-only formatting on or off.
 *
 * @param bool $basic Whether or not basic formatting should be on.
 * @return ETFormat
 */
public function basic($basic)
{
	$this->basic = $basic;
	return $this;
}


/**
 * Format the content string using a standard procedure and plugin hooks.
 *
 * @return ETFormat
 */
public function format()
{
	// Trigger the "before format" event, which can be used to strip out code blocks.
	$this->trigger("beforeFormat");

	// Format links, mentions, and quotes.
	if (C("esoTalk.format.mentions")) $this->mentions();
	$this->quotes();
	$this->links();

	// Format bullet and numbered lists.
	$this->lists();

	// Trigger the "format" event, where all regular formatting can be applied (bold, italic, etc.)
	$this->trigger("format");

	// Format whitespace, adding in <br/> and <p> tags.
	$this->whitespace();

	// Trigger the "after format" event, where code blocks can be put back in.
	$this->trigger("afterFormat");

	return $this;
}


/**
 * Get the content string in its current state.
 *
 * @return string
 */
public function get()
{
	return trim($this->content);
}


/**
 * Clip the content string to a certain number of characters, appending "..." if necessary.
 *
 * @param int $characters The number of characters to clip to.
 * @return ETFormat
 */
public function clip($characters)
{
	// If the content string is already shorter than this, do nothing.
	if (strlen($this->content) <= $characters) return $this;

	// Cut the content down to the last full word that fits in this number of characters.
	$this->content = substr($this->content, 0, $characters);
	$this->content = substr($this->content, 0, strrpos($this->content, " "));

	// Append "...", and close all opened HTML tags.
	$this->closeTags();
	$this->content .= " ...";

	return $this;
}


/**
 * Close all unclosed HTML tags in the content string.
 *
 * @return ETFormat
 */
public function closeTags()
{
	// Remove any half-opened HTML tags at the end.
	$this->content = preg_replace('#<[^>]*$#i', "", $this->content);
	
	// Put all opened tags into an array.
    preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $this->content, $result);
	$openedTags = $result[1];

	// Put all closed tags into an array.
    preg_match_all('#</([a-z]+)>#iU', $this->content, $result);
	$closedTags = $result[1];

	$numOpened = count($openedTags);

	// Go through the opened tags backwards, and close them one-by-one until we have no unclosed tags left.
	$openedTags = array_reverse($openedTags);
	for ($i = 0; $i < $numOpened; $i++) {

		// If there's no closing tag for this opening tag, append it.
		if (!in_array($openedTags[$i], $closedTags))
			$this->content .= "</".$openedTags[$i].">";

		// Otherwise, remove it from the closed tags array.
		else
			unset($closedTags[array_search($openedTags[$i], $closedTags)]);
	}

	return $this;
}


/**
 * Convert whitespace into appropriate HTML tags (<br/> and <p>).
 *
 * @return ETFormat
 */
public function whitespace()
{
	// Trim the edges of whitespace.
	$this->content = trim($this->content);

	// Add paragraphs and breakspaces.
	$this->content = "<p>".str_replace(array("\n\n", "\n"), array("</p><p>", "<br/>"), $this->content)."</p>";

	// Strip empty paragraphs.
	$this->content = preg_replace(array("/<p>\s*<\/p>/i", "/(?<=<p>)\s*(?:<br\/>)*/i", "/\s*(?:<br\/>)*\s*(?=<\/p>)/i"), "", $this->content);
	$this->content = str_replace("<p></p>", "", $this->content);

	return $this;
}


/**
 * Convert inline URLs and email addresses into HTML anchor tags.
 *
 * @return ETFormat
 */
public function links()
{
	// Convert normal links - http://www.example.com, www.example.com - using a callback function.

	$use_unicode = C("esoTalk.format.PCRE.UseUnicode");

	// http://jmrware.com/articles/2009/uri_regexp/URI_regex.html
	// http://stackoverflow.com/questions/161738/what-is-the-best-regular-expression-to-check-if-a-string-is-a-valid-url
	
	$ipv4Pattern = "(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)";
	$domainPattern = "(?:AC|AD|AE|AERO|AF|AG|AI|AL|AM|AN|AO|AQ|AR|ARPA|AS|ASIA|AT|AU|AW|AX|AZ|BA|BB|BD|BE|BF|BG|BH|BI|BIZ|BJ|BM|BN|BO|BR|BS|BT|BV|BW|BY|BZ|CA|CAT|CC|CD|CF|CG|CH|CI|CK|CL|CM|CN|CO|COM|COOP|CR|CU|CV|CW|CX|CY|CZ|DE|DJ|DK|DM|DO|DZ|EC|EDU|EE|EG|ER|ES|ET|EU|FI|FJ|FK|FM|FO|FR|GA|GB|GD|GE|GF|GG|GH|GI|GL|GM|GN|GOV|GP|GQ|GR|GS|GT|GU|GW|GY|HK|HM|HN|HR|HT|HU|ID|IE|IL|IM|IN|INFO|INT|IO|IQ|IR|IS|IT|JE|JM|JO|JOBS|JP|KE|KG|KH|KI|KM|KN|KP|KR|KW|KY|KZ|LA|LB|LC|LI|LK|LR|LS|LT|LU|LV|LY|MA|MC|MD|ME|MG|MH|MIL|MK|ML|MM|MN|MO|MOBI|MP|MQ|MR|MS|MT|MU|MUSEUM|MV|MW|MX|MY|MZ|NA|NAME|NC|NE|NET|NF|NG|NI|NL|NO|NP|NR|NU|NZ|OM|ORG|PA|PE|PF|PG|PH|PK|PL|PM|PN|POST|PR|PRO|PS|PT|PW|PY|QA|RE|RO|RS|RU|RW|SA|SB|SC|SD|SE|SG|SH|SI|SJ|SK|SL|SM|SN|SO|SR|ST|SU|SV|SX|SY|SZ|TC|TD|TEL|TF|TG|TH|TJ|TK|TL|TM|TN|TO|TP|TR|TRAVEL|TT|TV|TW|TZ|UA|UG|UK|US|UY|UZ|VA|VC|VE|VG|VI|VN|VU|WF|WS|XXX|YE|YT|ZA|ZM|ZW|РФ)";
	$hostNamePattern = $use_unicode
		? "(?:[\pL\d]\.|[\pL\d][\pL\d\-]*[\pL\d]\.)+".$domainPattern
		: "(?:[a-z0-9]\.|[a-z0-9][a-z0-9\-]*[a-z0-9]\.)+".$domainPattern;
	$portPattern = "(?::\d+)?";
	$this->content = preg_replace_callback(
		//"/(?<=\s|^|>|\()((?:http|https|ftp|ftps):\/\/)?((?:".$ipv4Pattern."|".$hostNamePattern.")".$portPattern."(?:[\/#][^\s<]*?)?)(?=[\s\.,?!>\)]*(?:\s|>|\)|$))/i".($use_unicode ? "u" : "" ),
		"/(?<=\s|^|>|\()((?:http|https|ftp|ftps):\/\/)?((?:".$ipv4Pattern."|".$hostNamePattern.")".$portPattern."(?:[\/#][^\s<]*?)?)(?=[\s\.,?!>]*(?:\s|>|$))/i".($use_unicode ? "u" : "" ),
		array($this, "linksCallback"), $this->content);

	// Convert email links.
	$this->content = preg_replace("/[\w-\.]+@([\w-]+\.)+[\w-]{2,4}/i", "<a href='mailto:$0' class='link-email'>$0</a>", $this->content);
	
	// Convert mini-quotes
	$this->content = preg_replace_callback(
		"/\((0|[1-9]{1,1}\d*)\)/",
		array($this, "linksCallback2"), $this->content);

	return $this;
}

public function linksCallback2($matches)
{
	if ((int)$matches[1] < $this->relativePostId) {
		$dataId = postURL($matches[1], $this->conversationId, $matches[1], false);
		$url = URL(postURL($matches[1], $this->conversationId, $matches[1]), true);
		return "<a href='".$url."' rel='post' data-id='$dataId' class='postRef'>$matches[0]</a>";
	} else return $matches[0];
}

public function getMiniQuote($quote, $classname = 'postRef')
{
	$dataId = postURL(0, $quote["conversationId"], $quote["relativePostId"], false);
	$url = URL(postURL(0, $quote["conversationId"], $quote["relativePostId"]), true);
	return "<a href='".$url."' rel='post' data-id='$dataId' class='$classname'>(".$quote["relativePostId"].")</a>";
}

/**
 * The callback function used to replace inline URLs with HTML anchor tags.
 *
 * @param array $matches An array of matches from the regular expression.
 * @return string The replacement HTML anchor tag.
 */
public function linksCallback($matches)
{
	// If we're not doing basic formatting, YouTube embedding is enabled, and this is a YouTube video link,
	// then return an embed tag.

	if (!$this->basic) {
		$onerror = "javascript:ETConversation.onErrorLoadingVideo(this);";
		if (C("esoTalk.format.youtube") and preg_match("/^(?:(?:www\.)?youtube\.com\/watch\?(?:\S*(?:\&|\&amp;)v=|v=)|youtu\.be\/)([^&]+)/i", $matches[2], $youtube)) {
			$id = $youtube[1];
			$width = 425;
			$height = 344;
			return "<div class='video'><object width='$width' height='$height'><param name='movie' value='http://www.youtube.com/v/$id'></param><param name='allowFullScreen' value='true'></param><param name='allowscriptaccess' value='always'></param><embed src='http://www.youtube.com/v/$id' type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' width='$width' height='$height'></embed></object></div>";
		} else
		if (C("esoTalk.format.rutube") and preg_match("/^rutube\.ru\/video\/(?:embed\/)?([\S]+)/i", $matches[2], $rutube)) {
			$id = $rutube[1];
			$width = 425; // rutube value: 720
			$height = 344; // rutube value: 405
			return "<div class='video'><iframe width='$width' height='$height' src='http://rutube.ru/video/embed/$id' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe></div>";
		} else
		if (C("esoTalk.format.smotri") and preg_match("/^smotri\.com\/video\/view\/\?id=(v[0-9a-z]+)/i", $matches[2], $smotri)) {
			$id = $smotri[1];
			$width = 425; // smotri value: 640
			$height = 344; // smotri value: 360
			return "<div class='video'><object id='smotriComVideoPlayer' classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' width='$width' height='$height'><param name='movie' value='http://pics.smotri.com/player.swf?file=$id&autoStart=false&str_lang=rus&xmlsource=http%3A%2F%2Fpics%2Esmotri%2Ecom%2Fcskins%2Fblue%2Fskin%5Fcolor%2Exml&xmldatasource=http%3A%2F%2Fpics.smotri.com%2Fskin_ng.xml' /><param name='allowScriptAccess' value='always' /><param name='allowFullScreen' value='true' /><param name='bgcolor' value='#ffffff' /><embed name='smotriComVideoPlayer' src='http://pics.smotri.com/player.swf?file=$id&autoStart=false&str_lang=rus&xmlsource=http%3A%2F%2Fpics%2Esmotri%2Ecom%2Fcskins%2Fblue%2Fskin%5Fcolor%2Exml&xmldatasource=http%3A%2F%2Fpics.smotri.com%2Fskin_ng.xml' quality='high' allowscriptaccess='always' allowfullscreen='true' wmode='window'  width='$width' height='$height' type='application/x-shockwave-flash'></embed></object></div>";
		} else
		if (C("esoTalk.format.vkvideo") and preg_match("/^vk\.com\/video([0-9]+)_([0-9]+)(?:\?(hash=[\S]*))/i", $matches[2], $vkvideo)) {
			$oid = $vkvideo[1];
			$id = $vkvideo[2];
			$params = (count($vkvideo) >= 4) ? "&".$vkvideo[3] : "";
			$width = 425; // vk.com value: 720
			$height = 344; // vk.com value: 410
			return "<div class='video'><iframe onerror='$onerror' width='$width' height='$height' src='http://vk.com/video_ext.php?oid=$oid&id=$id$params' frameborder='0'></iframe></div>";
		} else
		if (C("esoTalk.format.vkvideo") and preg_match("/^vk\.com\/video_ext\.php\?oid=([0-9]+)&amp;id=([0-9]+)(&amp;hash=[\S]*)/i", $matches[2], $vkvideo)) {
			$oid = $vkvideo[1];
			$id = $vkvideo[2];
			$params = (count($vkvideo) >= 4) ? $vkvideo[3] : "";
			$width = 425; // vk.com value: 720
			$height = 344; // vk.com value: 410
			return "<div class='video'><iframe onerror='$onerror' width='$width' height='$height' src='http://vk.com/video_ext.php?oid=$oid&id=$id$params' frameborder='0'></iframe></div>";
		}
		
	}
	
	$url = ($matches[1] ? $matches[1] : "http://").$matches[2];
	$matches2_decoded = sanitizeHTML(urldecode($matches[2]));
	$url_decoded = ($matches[1] ? $matches[1] : "http://").$matches2_decoded;
	
	if (C("esoTalk.format.wikipedia") and preg_match("/^[a-z]{2,2}\.wikipedia\.org\/wiki\/([\S]+)/iu", $matches2_decoded, $wiki)) {
		$article = $wiki[1];
		return "<a href='".$url."' target='_blank' class='link-external'><span class='linkPrefix'>wiki:</span>".$article."</a>";
	} else
	if (C("esoTalk.format.lurkmore") and preg_match("/^(?:lurkmore\.to|lurkmo\.re)\/([\S]+)/iu", $matches2_decoded, $lurk)) {
		$article = $lurk[1];
		return "<a href='".$url."' target='_blank' class='link-external'><span class='linkPrefix'>lurk:</span>".$article."</a>";
	}

	// If this is an internal link...
	$encoding = "utf8";
	$shortURL = "";
	if (C("esoTalk.hostNamePattern")) {
		if (preg_match("/".C("esoTalk.hostNamePattern")."(.+)/iu", $url, $sub_url_matches)) {
			$sub_url = $sub_url_matches[1];
			$baseURL = C("esoTalk.baseURL");
			if (mb_stripos($sub_url, $baseURL, 0, $encoding) === 0) $shortURL = mb_substr($sub_url, mb_strlen($baseURL, $encoding) - 1, null, $encoding);
		}
	} else {
		$baseURL = C("esoTalk.hostName").C("esoTalk.baseURL");
		if (mb_stripos($url, $baseURL, 0, $encoding) === 0) $shortURL = mb_substr($url, mb_strlen($baseURL, $encoding) - 1, null, $encoding);
	}
	if ($shortURL) {
		$caption = $matches[1].$matches2_decoded;
		$postId = "";
		if (preg_match("/^\/(?:conversation\/post\/(\d+)-)?(\d+)/i", $shortURL, $conv)) {
			if ($conv[1] === "") $conversationId = $conv[2]; else $conversationId = $conv[1];
			$conversation = ET::conversationModel()->getById($conversationId);
			if ($conversation) {
				$caption = $conversation["title"];
				$postId = ($conv[1] === "") ? "0" : $conv[2];
				$postId = $conversationId."-".$postId;
			}
		}
		return "<a href='".$url."' target='_blank' class='link-internal' data-id='$postId'>".$caption."</a>";
	}

	// Otherwise, return an external HTML anchor tag.
	return "<a href='".$url."' rel='nofollow external' target='_blank' class='link-external'>".$matches[1].$matches2_decoded." <i class='icon-external-link'></i></a>";
}


/**
 * Convert simple bullet and numbered lists (eg. - list item\n - another list item) into their HTML equivalent.
 *
 * @return ETFormat
 */
public function lists()
{
	// Convert ordered lists - 1. list item\n 2. list item.
	// We do this by matching against 2 or more lines which begin with a number, passing them together to a
	// callback function, and then wrapping each line with <li> tags.
	$orderedList = create_function('$list',
		'$list = preg_replace("/^[0-9]+[.)]\s+([^\n]*)(?:\n|$)/m", "<li>$1</li>", trim($list));
		return $list;');
	$this->content = preg_replace("/(?:^[0-9]+[.)]\s+([^\n]*)(?:\n|$)){2,}/me", "'</p><ol>'.\$orderedList('$0').'</ol><p>'", $this->content);

	// Same goes for unordered lists, but with a - or a * instead of a number.
	$unorderedList = create_function('$list',
		'$list = preg_replace("/^ *[-*]\s*([^\n]*)(?:\n|$)/m", "<li>$1</li>", trim($list));
		return "$list";');
	$this->content = preg_replace("/(?:^ *[-*]\s*([^\n]*)(?:\n|$)){2,}/me", "'</p><ul>'.\$unorderedList('$0').'</ul><p>'", $this->content);

	return $this;
}


/**
 * Convert [quote] tags into their HTML equivalent.
 *
 * @return ETFormat
 */
public function quotes()
{
	// Starting from the innermost quote, work our way to the outermost, replacing them one-by-one using a
	// callback function. This is the only simple way to do nested quotes without a lexer.
	$regexp = "/(.*?)\n?\[quote(?:=(.*?)(]?))?\]\n?(.*?)\n?\[\/quote\]\n{0,2}/ise";
	while (preg_match($regexp, $this->content)) {
		$this->content = preg_replace($regexp, "'$1</p>'.\$this->makeQuote('$4', '$2$3').'<p>'", $this->content);
	}

	return $this;
}


/**
 * The callback function to get quote HTML, given the quote text and its citation.
 *
 * @param string $text The quoted text.
 * @param string $citation The citation text.
 * @return string The quote HTML.
 */
public function makeQuote($text, $citation = "")
{
	// If there is a citation and it has a : in it, split it into a post ID and the rest.
	if ($citation and strpos($citation, ":") !== false)
		list($postId, $citation) = explode(":", $citation, 2);

	// Construct the quote.
	$quote = "<blockquote><p>";

	// If we extracted a post ID from the citation, add a "find this post" link.
	if (!empty($postId)) $quote .= "<a href='".URL(postURL($postId), true)."' rel='post' data-id='$postId' class='control-search postRef'><i class='icon-search'></i></a> ";

	// If there is a citation, add it.
	if (!empty($citation)) $quote .= "<cite>$citation</cite> ";

	// Finish constructing and return the quote.
	$quote .= "$text\n</p></blockquote>";
	return $quote;
}


/**
 * Remove all quotes from the content string. This can be used to prevent nested quotes when quoting a post.
 *
 * @return ETFormat
 */
public function removeQuotes()
{
	while (preg_match("`(.*)\[quote(\=[^\]]+)?\].*?\[/quote\]`si", $this->content))
		$this->content = preg_replace("`(.*)\[quote(\=[^\]]+)?\].*?\[/quote\]`si", "$1", $this->content);

	return $this;
}


/**
 * Convert all @mentions into links to member profiles.
 *
 * @return ETFormat
 */
public function mentions()
{
	$this->content = preg_replace(
		'/(^|[\s,\.:\]])@(?:([\w]{1,1}(?:\w|-|&nbsp;){0,'.(C("esoTalk.maxUserName") - 2).'}[\w]{1,1})(?=$|[^\w])|{([\w]{1,1}(?:\w|-| |&nbsp;){0,'.(C("esoTalk.maxUserName") - 2).'}[\w]{1,1})})/ieu',
		"'$1<a href=\''.URL('member/name/'.urlencode(str_replace('&nbsp;', ' ', '$2$3')), true).'\' class=\'link-member\'>$2$3</a>'",
		$this->content
	);

	return $this;
}


/**
 * Get all of the @mentions present in a content string, and return the member names in an array.
 *
 * @param string $content The content string to get mentions from.
 * @return array
 */
public function getMentions($content)
{
	$content = sanitizeHTML($content);
	preg_match_all('/(^|[\s,\.:\]])@(?:([\w]{1,1}(?:\w|-|&nbsp;){0,'.(C("esoTalk.maxUserName") - 2).'}[\w]{1,1})(?=$|[^\w])|{([\w]{1,1}(?:\w|-| |&nbsp;){0,'.(C("esoTalk.maxUserName") - 2).'}[\w]{1,1})})/iu', $content, $matches, PREG_SET_ORDER);
	$names = array();
	foreach ($matches as $k => $v) $names[] = str_replace("&nbsp;", " ", (string)$v[2].((count($v) >= 4) ? $v[3] : ""));

	return $names;
}

public function getQuotes($conversationId, $relativePostId, $content)
{
	$names = array();
	
	// quotes
	preg_match_all('/(.*?)\n?\[quote(?:=(.*?)(]?))?\]\n?(.*?)\n?\[\/quote\]\n{0,2}/ise', $content, $matches, PREG_SET_ORDER);
	foreach ($matches as $v) {
		list($conversationId2, $relativePostId) = explodeRelativePostId($v[2]);
		$names[] = array("conversationId" => (int)$conversationId2, "relativePostId" => (int)$relativePostId);
	}
	
	// mini-quotes
	preg_match_all('/\((0|[1-9]{1,1}\d*)\)/', $content, $matches, PREG_SET_ORDER);
	foreach ($matches as $v) {
		if ((int)$v[1] < $relativePostId) $names[] = array("conversationId" => (int)$conversationId, "relativePostId" => (int)$v[1]);
	}

	return $names;
}

/**
 * Highlight a list of words in the content string.
 *
 * @return ETFormat
 */
public function highlight($words)
{
	$highlight = array_unique((array)$words);
	if (!empty($highlight)) $this->content = highlight($this->content, $highlight);

	return $this;
}

}
