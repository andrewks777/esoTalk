var Emoticons = {

init: function() {

	$('body').on('click', '.edit:not(#reply) ul.smiles-list .emoticon', function(e) {
		e.preventDefault();
		Emoticons.addSmile(this);
	});
	
	$("#reply ul.smiles-list .emoticon").on("click", function(e) {
		e.preventDefault();
		Emoticons.addSmile(this);
	});
	
	$('body').on('touchstart', '.edit:not(#reply) .emoticons-smile', function(e) {
		Emoticons.showList(this);
	});
	
	$("#reply .emoticons-smile").on("touchstart", function(e) {
		Emoticons.showList(this);
	});
	
},

showList: function(elem) {
	var list = $(elem).siblings('.smiles-list');
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
	var list = $("#"+id+" .smiles-list");
	if (list.length && list.data("vis")) {
		list.data("vis", false);
		list.hide("fast");
	}
},

addSmile: function(e) {
	var e = $(e);
	var id = e.parent().parent().data('id');
	var smileText = $.trim(e.text());
	Emoticons.smile(id, smileText);
},

smile: function(id, smileText) {
	ETConversation.wrapText($("#"+id+" textarea"), " " + smileText, "", false);
	
	Emoticons.hideList(id);
}

};

$(function() {
	Emoticons.init();
});