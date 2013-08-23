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
	
	BBCode.doFillLanguages();
	
	$(".code-lng").live("mouseenter", function(e) {
		BBCode.doFillLanguages(this);
	});
	
	$('body').on('click', 'ul.code-lng-list li', function(e) {
		e.preventDefault();
		BBCode.fixedLangSel(this);
	});
	
	$("#reply ul.code-lng-list li").on("click", function(e) {
		e.preventDefault();
		BBCode.fixedLangSel(this);
	});
	
	$(document).ready(function() {
		BBCode.doHighlightAll();
	});
	
	$(document).ajaxSuccess(function() {
		BBCode.doHighlightAll();
	});
	
},

doHighlightAll: function() {
	$('pre._nhl').each(function(i, e) {
		BBCode.doHighlight(e);
	});
},

doHighlight: function(e) {
	$(e).removeClass("_nhl");
	hljs.highlightBlock(e, '    ');
	var em = $(e);
	var langId = $.trim(em.prop('class'));
	if (langId != 'no-highlight') em.prop('title', langId);
},

doFillLanguages: function(e, updateExist) {
	var languages = new Array();
	for (var key in hljs.LANGUAGES) {
		languages.push(key);
	}
	languages.sort();
	languages.unshift('&lt;auto&gt;');
	
	if (e) {
		var lng_list = $(e).children("ul.code-lng-list");
	} else {
		var lng_list = $("ul.code-lng-list");
	}
	
	lng_list.each(function(i, e) {
		var e = $(e);
		var lng_list_child = e.children('li');
		if (lng_list_child.length == 0 || updateExist) {
			lng_list_child.remove();
			for (var key in languages) {
				e.append('<li><a href=\'#\'>'+languages[key]+'</a></li>');
			}
		}
	});
},

fixedLangSel: function(e) {
	var e = $(e);
	var id = e.parent().data('id');
	var lang = '='+$.trim(e.children('a:first').text());
	if (lang == '=<auto>') lang = '=_auto_';
	ETConversation.wrapText($("#"+id+" textarea"), "[code"+lang+"]", "[/code]");
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