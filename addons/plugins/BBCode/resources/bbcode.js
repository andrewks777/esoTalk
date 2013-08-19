var BBCode = {

init: function() {

	$(".spoiler-link a").live("click", function(e) {
		var e = $(this);
		var icon = e.children('i');
		var hidClassId = "icon-double-angle-right";
		var visClassId = "icon-double-angle-left";
		var hText = e.parent().next(".spoiler-block");
		
		if (icon.hasClass(hidClassId)) {
			icon.removeClass(hidClassId);
			icon.addClass(visClassId);
			hText.show();
		} else {
			icon.removeClass(visClassId);
			icon.addClass(hidClassId);
			hText.hide();
		}
		
		e.preventDefault();
	});
	
	var languages = new Array();
	for (var key in hljs.LANGUAGES) {
		languages.push(key);
	}
	languages.sort();
	languages.unshift('&lt;auto&gt;');
	
	var lng_list = $("ul#code-lng-list");
	for (var key in languages) {
		lng_list.append('<li><a href=\'#\'>'+languages[key]+'</a></li>');
	}
	
	$("ul#code-lng-list li").on("click", function(e) {
		e.preventDefault();
		var id = 'reply';
		var lang = '='+$.trim($(this).children('a:first').text());
		if (lang == '=<auto>') lang = '=_auto_';
		ETConversation.wrapText($("#"+id+" textarea"), "[code"+lang+"]", "[/code]");
	});
	
	$(document).ready(function() {
		$('pre._nhl').each(function(i, e) {
			//var em=$(e).parent().parent().parent().prop('id');
			//alert('ready:'+i+':'+e.tagName+':'+em);
			BBCode.doHighlight(e);
		});
	});
	
	$(document).ajaxSuccess(function() {
		$('pre._nhl').each(function(i, e) {
			//var em=$(e).parent().parent().parent().prop('id');
			//alert('ajaxSuccess:'+i+':'+e.tagName+':'+em);
			BBCode.doHighlight(e);
		});
	});
	
},

doHighlight: function(e) {
	$(e).removeClass("_nhl");
	hljs.highlightBlock(e, '    ');
	var em = $(e);
	var langId = $.trim(em.prop('class'));
	if (langId != 'no-highlight') em.prop('title', langId);
},

bold: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[b]", "[/b]");},
italic: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[i]", "[/i]");},
strikethrough: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[s]", "[/s]");},
header: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[h]", "[/h]");},
link: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[url=http://example.com]", "[/url]", "http://example.com", "link text");},
image: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[img]", "[/img]", "", "http://example.com/image.jpg");},
fixed: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[code]", "[/code]");},
spoiler: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[spoiler]", "[/spoiler]");}

};

$(function() {
	BBCode.init();
});