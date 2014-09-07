// Tape JavaScript

var ETTape = {

activityPage: 1,

init: function() {

	// Initialize the activity section.
	this.initActivity();

},

initActivity: function() {

	// Add a click handler to the "view more" button.
	$("#viewMoreActivity").click(function(e) {
		e.preventDefault();
		$.ETAjax({
			url: "tape/index.view/"+(ETTape.activityPage+1),
			success: function(data) {
				$("#viewMoreActivity").remove();
				$("#body-content").append(data);
				++ETTape.activityPage;
				ETTape.initActivity();
			},
			beforeSend: function() {
				createLoadingOverlay("membersActivity", "membersActivity");
			},
			complete: function() {
				hideLoadingOverlay("membersActivity", false);
			}
		});
	});


},


};

$(function() {
	ETTape.init();
});