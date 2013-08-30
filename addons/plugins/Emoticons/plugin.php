<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["Emoticons"] = array(
	"name" => "Emoticons",
	"description" => "Converts text emoticons to their graphical equivalent.",
	"version" => ESOTALK_VERSION,
	"author" => "esoTalk Team",
	"authorEmail" => "support@esotalk.org",
	"authorURL" => "http://esotalk.org",
	"license" => "GPLv2"
);

class ETPlugin_Emoticons extends ETPlugin {

protected $styles = array();

protected function wrapSmileText($k)
{
	if ($k == ":)" or $k == ";)" or $k == ":(") return $k;
	else return "[smile=".$k."]";
}

protected function fillStyles()
{
	$this->styles = array();
	$this->styles[$this->wrapSmileText(":)")] = "background-position:0 0";
	$this->styles[$this->wrapSmileText("=)")] = "background-position:0 0";
	$this->styles[$this->wrapSmileText(":D")] = "background-position:0 -20px";
	$this->styles[$this->wrapSmileText("=D")] = "background-position:0 -20px";
	$this->styles[$this->wrapSmileText("^_^")] = "background-position:0 -40px";
	$this->styles[$this->wrapSmileText("^^")] = "background-position:0 -40px";
	$this->styles[$this->wrapSmileText(":(")] = "background-position:0 -60px";
	$this->styles[$this->wrapSmileText("=(")] = "background-position:0 -60px";
	$this->styles[$this->wrapSmileText("-_-")] = "background-position:0 -80px";
	$this->styles[$this->wrapSmileText(";)")] = "background-position:0 -100px";
	$this->styles[$this->wrapSmileText("^_-")] = "background-position:0 -100px";
	$this->styles[$this->wrapSmileText("~_-")] = "background-position:0 -100px";
	$this->styles[$this->wrapSmileText("-_^")] = "background-position:0 -100px";
	$this->styles[$this->wrapSmileText("-_~")] = "background-position:0 -100px";
	$this->styles[$this->wrapSmileText("^_^;")] = "background-position:0 -120px; width:18px";
	$this->styles[$this->wrapSmileText("^^;")] = "background-position:0 -120px; width:18px";
	$this->styles[$this->wrapSmileText(">_<")] = "background-position:0 -140px";
	$this->styles[$this->wrapSmileText(":/")] = "background-position:0 -160px";
	$this->styles[$this->wrapSmileText("=/")] = "background-position:0 -160px";
	$this->styles[$this->wrapSmileText(":\\")] = "background-position:0 -160px";
	$this->styles[$this->wrapSmileText("=\\")] = "background-position:0 -160px";
	$this->styles[$this->wrapSmileText(":x")] = "background-position:0 -180px";
	$this->styles[$this->wrapSmileText("=x")] = "background-position:0 -180px";
	$this->styles[$this->wrapSmileText(":|")] = "background-position:0 -180px";
	$this->styles[$this->wrapSmileText("=|")] = "background-position:0 -180px";
	$this->styles[$this->wrapSmileText("'_'")] = "background-position:0 -180px";
	$this->styles[$this->wrapSmileText("<_<")] = "background-position:0 -200px";
	$this->styles[$this->wrapSmileText(">_>")] = "background-position:0 -220px";
	$this->styles[$this->wrapSmileText("x_x")] = "background-position:0 -240px";
	$this->styles[$this->wrapSmileText("o_O")] = "background-position:0 -260px";
	$this->styles[$this->wrapSmileText("O_o")] = "background-position:0 -260px";
	$this->styles[$this->wrapSmileText("o_0")] = "background-position:0 -260px";
	$this->styles[$this->wrapSmileText("0_o")] = "background-position:0 -260px";
	$this->styles[$this->wrapSmileText(";_;")] = "background-position:0 -280px";
	$this->styles[$this->wrapSmileText(":'(")] = "background-position:0 -280px";
	$this->styles[$this->wrapSmileText(":O")] = "background-position:0 -300px";
	$this->styles[$this->wrapSmileText("=O")] = "background-position:0 -300px";
	$this->styles[$this->wrapSmileText(":o")] = "background-position:0 -300px";
	$this->styles[$this->wrapSmileText("=o")] = "background-position:0 -300px";
	$this->styles[$this->wrapSmileText(":P")] = "background-position:0 -320px";
	$this->styles[$this->wrapSmileText("=P")] = "background-position:0 -320px";
	$this->styles[$this->wrapSmileText(";P")] = "background-position:0 -320px";
	$this->styles[$this->wrapSmileText(":[")] = "background-position:0 -340px";
	$this->styles[$this->wrapSmileText("=[")] = "background-position:0 -340px";
	$this->styles[$this->wrapSmileText(":3")] = "background-position:0 -360px";
	$this->styles[$this->wrapSmileText("=3")] = "background-position:0 -360px";
	$this->styles[$this->wrapSmileText("._.;")] = "background-position:0 -380px; width:18px";
	$this->styles[$this->wrapSmileText("<(^.^)>")] = "background-position:0 -400px; width:19px";
	$this->styles[$this->wrapSmileText("(>'.')>")] = "background-position:0 -400px; width:19px";
	$this->styles[$this->wrapSmileText("(>^.^)>")] = "background-position:0 -400px; width:19px";
	$this->styles[$this->wrapSmileText("-_-;")] = "background-position:0 -420px; width:18px";
	$this->styles[$this->wrapSmileText("(o^_^o)")] = "background-position:0 -440px";
	$this->styles[$this->wrapSmileText("(^_^)/")] = "background-position:0 -460px; width:19px";
	$this->styles[$this->wrapSmileText(">:(")] = "background-position:0 -480px";
	$this->styles[$this->wrapSmileText(">:[")] = "background-position:0 -480px";
	$this->styles[$this->wrapSmileText("._.")] = "background-position:0 -500px";
	$this->styles[$this->wrapSmileText("T_T")] = "background-position:0 -520px";
	$this->styles[$this->wrapSmileText("XD")] = "background-position:0 -540px";
	$this->styles[$this->wrapSmileText("('<")] = "background-position:0 -560px";
	$this->styles[$this->wrapSmileText("B)")] = "background-position:0 -580px";
	$this->styles[$this->wrapSmileText("XP")] = "background-position:0 -600px";
	$this->styles[$this->wrapSmileText(":S")] = "background-position:0 -620px";
	$this->styles[$this->wrapSmileText("=S")] = "background-position:0 -620px";
	$this->styles[$this->wrapSmileText(">:)")] = "background-position:0 -640px";
	$this->styles[$this->wrapSmileText(">:D")] = "background-position:0 -640px";
}

protected function addResources($sender)
{
	$this->fillStyles();
	
	$groupKey = 'bbcode';
	$sender->addJSFile($this->getResource("emoticons.js"), false, $groupKey);
	$sender->addCSSFile($this->getResource("emoticons.css"), false, $groupKey);
}

public function handler_conversationController_renderBefore($sender)
{
	//$sender->addToHead("<style type='text/css'>.emoticon {display:inline-block; text-indent:-9999px; width:16px; height:16px; background:url(".URL($this->getResource("emoticons.png"), false, false)."); background-repeat:no-repeat}</style>");
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
	$this->fillStyles();
	$smilesListHTML = "<ul class='smiles-list' data-id='$id'><li>";
	$prev = "";
	$i = 0;
	foreach ($this->styles as $k => $v) {
		if ($v != $prev) {
			if ($i % 3 == 0 and $i > 0) $smilesListHTML .= "</li><li>";
			$sk = sanitizeHTML($k);
			$smilesListHTML .= "<a href='javascript:Emoticons.smile(\"$id\", \"$sk\");void(0)'>"."<span class='emoticon' style='$v'>$sk</span>"."</a>";
			$prev = $v;
			$i++;
		}
	}
	$smilesListHTML .= "</li></ul>";
	
	addToArrayString($controls, "smile", "<span class='smiles-box'>".$smilesListHTML."<a href='javascript:Emoticons.smile(\"$id\", \":)\");void(0)' title='".T("Smile")."' class='emoticons-smile'><span class='emoticon' style='background-position:0 0; padding-top:2px'>".T("Smile")."</span></a></span>");
}

public function handler_format_format($sender)
{

	$from = $to = array();
	foreach ($this->styles as $k => $v) {
		$quoted = preg_quote(sanitizeHTML($k), "/");
		$from[] = "/(?<=^|[\s.,!<>]){$quoted}(?=[\s.,!<>)]|$)/i";
		$to[] = "<span class='emoticon' style='$v'>$k</span>";
	}
	$sender->content = preg_replace($from, $to, $sender->content);
}

}
