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
	
},

addSmile: function(e) {
	var e = $(e);
	var id = e.parent().parent().data('id');
	var smileText = $.trim(e.text());
	Emoticons.smile(id, smileText);
},

smile: function(id, smileText) {ETConversation.wrapText($("#"+id+" textarea"), " " + smileText, "", false);}

};

$(function() {
	Emoticons.init();
});