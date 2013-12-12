$(function() {

	// Turn a normal text input into a color picker, and run a callback when the color is changed.
	function colorPicker(id, callback) {

		// Create the color picker container.
		var picker = $("<div id='"+id+"-colorPicker'></div>").appendTo("body").addClass("popup").hide();

		// When the input is focussed upon, show the color picker.
		$("#"+id+" input").focus(function() {
			picker.css({position: "absolute", top: $(this).offset().top - picker.outerHeight(), left: $(this).offset().left}).show();
		})

		// When focus is lost, hide the color picker.
		.blur(function() {
			picker.hide();
		})

		// Add a color swatch before the input.
		.before("<span class='colorSwatch'></span>");

		// Create a handler function for when the color is changed to update the input and swatch, and call
		// the custom callback function.
		var handler = function(color) {
			callback(color, picker);
			$("#"+id+" input").val(color.toUpperCase());
			$("#"+id+" .colorSwatch").css("backgroundColor", color);
			$("#"+id+" .reset").toggle(!!color);
		}

		// Set up a farbtastic instance inside the picker we've created.
		$.farbtastic(picker, function(color) {
			handler(color);
		}).setColor($("#"+id+" input").val());

		// When the "reset" link is clicked, reset the color.
		$("#"+id+" .reset").click(function(e) {
			e.preventDefault();
			handler("");
		}).toggle(!!$("#"+id+" input").val());

	}
	
	// Turn the "snow color" field into a color picker.
	colorPicker("snowColor", function(color, picker) {

		// If no color is selected, use the default one.
		color = color ? color : "#77aaff";

	});


});
