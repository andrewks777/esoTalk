var Emoticons = {

init: function() {

	
},

smile: function(id, smileText) {ETConversation.wrapText($("#"+id+" textarea"), " " + smileText + " ", "", false);}

};

$(function() {
	Emoticons.init();
});