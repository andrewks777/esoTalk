var BBCode = {

init: function() {

	$('body').on('click', '.spoiler-link a', function(e) {
		e.preventDefault();
		
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
		
	});
	
	$('body').on('click', '.link-image', function(e) {
		e.preventDefault();
		$(this).colorbox({rel:'imgview', opacity:0.75, inline:true, href:$(this).children('img')});
	});
	
	BBCode.doFillLanguages();
	
	$('body').on('mouseenter', '.code-lng', function(e) {
		BBCode.doFillLanguages(this);
	});
	
	$('body').on('click', '.edit:not(#reply) ul.code-lng-list li', function(e) {
		e.preventDefault();
		BBCode.fixedLangSel(this);
	});
	
	$("#reply ul.code-lng-list li").on("click", function(e) {
		e.preventDefault();
		BBCode.fixedLangSel(this);
	});
	
	$('body').on('touchstart', '.edit:not(#reply) .bbcode-fixed', function(e) {
		BBCode.doFillLanguages($(this).parents(".code-lng"));
		BBCode.showList(this);
	});
	
	$("#reply .bbcode-fixed").on("touchstart", function(e) {
		BBCode.showList(this);
	});
	
	$(document).ready(function() {
		BBCode.doHighlightAll();
	});
	
	$(document).ajaxSuccess(function() {
		BBCode.doHighlightAll();
	});
	
},

showList: function(elem) {
	var list = $(elem).siblings('.code-lng-list');
	if (list.length) {
		if (list.data("vis")) {
			list.data("vis", false);
			list.hide("fast");
		} else {
			list.data("vis", true);
			list.show("fast");
		}
	}
},

hideList: function(id) {
	var list = $("#"+id+" .code-lng-list");
	if (list.length && list.data("vis")) {
		list.data("vis", false);
		list.hide("fast");
	}
},

doHighlightAll: function() {
	$('pre._nhl').each(function(i, e) {
		BBCode.doHighlight(e);
	});
},

doHighlight: function(e) {
	$(e).removeClass("_nhl");
	var expander = $(e).find(".expand");
	var savedExpander;
	if (expander.length) {
		savedExpander = expander.clone(true);
		expander.remove();
		expander = null;
	}
	
	hljs.highlightBlock(e, '    ');
	var em = $(e);
	var langId = $.trim(em.prop('class').replace(' collapsed', ''));
	if (langId != 'no-highlight') em.prop('title', langId);
	if (savedExpander) em.append(savedExpander);
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
	
	BBCode.hideList(id);
},

bold: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[b]", "[/b]");},
italic: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[i]", "[/i]");},
strikethrough: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[s]", "[/s]");},
header: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[h]", "[/h]");},
link: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[url=http://example.com]", "[/url]", "http://example.com", "link text");},
image: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[img]", "[/img]", "", "http://example.com/image.jpg");},
fixed: function(id) {
	ETConversation.wrapText($("#"+id+" textarea"), "[code]", "[/code]");
	
	BBCode.hideList(id);
},
spoiler: function(id) {ETConversation.wrapText($("#"+id+" textarea"), "[spoiler]", "[/spoiler]");}

};

$(function() {
	BBCode.init();
});