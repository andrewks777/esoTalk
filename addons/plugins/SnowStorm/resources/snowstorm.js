$(function() {

	// apply settings
	snowStorm.snowColor = ET.snowStorm_snowColor;
	snowStorm.flakesMaxActive = ET.snowStorm_flakesMaxActive;
	snowStorm.useTwinkleEffect = ET.snowStorm_useTwinkleEffect;
	
	// add 'stop snowing' button
	stopSnowingHTML = "<div id='stopSnowingButton' title='" + T('plugin.SnowStorm.message.stopSnowing') + "'></div>";
	$('body').append(stopSnowingHTML);
	
	if (ET.snowStorm_enableSnowman) {
		snowmanHTML = "<div id='snowmanImg'></div>";
		$('body').append(snowmanHTML);
	}
	
	$('body').on('click', '#stopSnowingButton', function(e) {
		snowStorm.stop();
		$('#stopSnowingButton').remove();
		$('#snowmanImg').remove();
	});
});
