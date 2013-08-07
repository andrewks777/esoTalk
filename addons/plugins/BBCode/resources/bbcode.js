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