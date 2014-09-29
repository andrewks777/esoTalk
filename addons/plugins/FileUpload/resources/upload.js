$(function() {

	function createUUID() {
		// http://www.ietf.org/rfc/rfc4122.txt
		var s = new Array(36);
		var hexDigits = "0123456789abcdef";
		for (var i = 0; i < 36; i++) {
			s[i] = hexDigits.substr(Math.floor(Math.random() * 0x10), 1);
		}
		s[14] = "4";  // bits 12-15 of the time_hi_and_version field to 0010
		s[19] = hexDigits.substr((s[19] & 0x3) | 0x8, 1);  // bits 6-7 of the clock_seq_hi_and_reserved to 01
		s[8] = s[13] = s[18] = s[23] = "-";

		var uuid = s.join("");
		return uuid;
	}
	
	function extractError(uploadType, fileTypes, file, errorText) {
		var errDesc = T("plugin.FileUpload.message.uploadError." + uploadType);
		var name = file.name;
		if (typeof(file.origName) != 'undefined') name = file.origName;
		errDesc = errDesc.replace('%1', name).replace('%2', file.error).replace('%3', fileTypes);
		return (errorText != '' ? '<br>' : '') + errorText + errDesc + '';
	}
	
	function showError(errorText) {
		if (errorText != '') {
			ETMessages.showMessage(errorText, {className: "warning dismissable", id: "fileUploadFail-" + createUUID()});
		}
	}
	
	function onFileUploadClick(e, el) {
		var elem = $(el);
		var uploadType = $(el).attr('data-uploadtype');
		var fileTypes = undefined;
		if (typeof(ET.fileUploadPluginAllowedTypes[uploadType]) != 'undefined') fileTypes = ET.fileUploadPluginAllowedTypes[uploadType];
		var fileTypesPattern = undefined;
		var fileTypesStr = undefined;
		if (fileTypes) {
			if (typeof(fileTypes['pattern']) != 'undefined') fileTypesPattern = fileTypes['pattern'];
			if (fileTypes) if (typeof(fileTypes['types']) != 'undefined') fileTypesStr = fileTypes['types'];
		}
		var fileTypesRegexp = undefined;
		if (fileTypesPattern) fileTypesRegexp = new RegExp(fileTypesPattern, 'i');
		
		try {
			var conversationId = ETConversation.id;
		} catch(e) {
			var conversationId = 0;
		}
		elem.fileupload({
			global: false,
			timeout: 0,
			url: ET.webPath + '/fileupload/upload/' + uploadType + '/' + conversationId,
			dataType: 'json',
			//acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
			acceptFileTypes: fileTypesRegexp,
			maxFileSize: ET.fileUploadPluginMaxFileSize,
			messages: {
				uploadedBytes: T("plugin.FileUpload.message.vendor.uploadedBytes"),
				maxNumberOfFiles: T("plugin.FileUpload.message.vendor.maxNumberOfFiles"),
				acceptFileTypes: T("plugin.FileUpload.message.vendor.acceptFileTypes"),
				maxFileSize: T("plugin.FileUpload.message.vendor.maxFileSize"),
				minFileSize: T("plugin.FileUpload.message.vendor.minFileSize"),
			},
			start: function (e, data) {
				for (var msg in ETMessages.messages) {
					if (msg.indexOf('fileUploadFail-') == 0) ETMessages.hideMessage(msg);
				}
				$('.fileupload-process').addClass('fileupload-process-active');
			},
			stop: function (e, data) {
				var elem = $(this);
				$('.fileupload-process').removeClass('fileupload-process-active');
				elem.prop('title', elem.attr('data-title'));
			},
			done: function (e, data) {
				var elem = $(this);
				var uploadType = elem.attr('data-uploadtype');
				var insertText = '';
				var errorText = '';

				$.each(data.result.files, function (index, file) {
					if (typeof(file.error) != 'undefined') {
						errorText = extractError(uploadType, fileTypesStr, file, errorText);
					} else if (typeof(file.url) != 'undefined') {
						var title = '';
						if (typeof(file.origName) != 'undefined') title = file.origName;
						
						if (uploadType == 'image') {
							if (title) title = '=' + title;
							insertText = insertText + '[img' + title + ']' + file.url + '[/img]\n'
						} else
						if (uploadType == 'archive' || uploadType == 'file') {
							insertText = insertText + '[url=' + file.url + ']' + title + '[/url]\n'
						}
					}
				});
				
				var textarea = $(this).parents('.postContent').children('.postBody').find('textarea');
				if (insertText != '') {
					ETConversation.replaceText(textarea, insertText);
					textarea.trigger('input');
				}
				showError(errorText);
			},
			fail: function (e, data) {
				ETMessages.showMessage(T("plugin.FileUpload.message.serverDisconnected." + $(this).attr('data-uploadtype')), {className: "warning dismissable", id: "fileUploadFail"});
			},
			progressall: function (e, data) {
				//var progress = parseInt(data.loaded / data.total * 100, 10);
			},
			processfail: function (e, data) {
				var errorText = '';

				$.each(data.files, function (index, file) {
					if (typeof(file.error) != 'undefined') {
						errorText = extractError(uploadType, fileTypesStr, file, errorText);
					}
				});
				
				showError(errorText);
			}

		});
	}
	
	$(".upload input").tooltip({alignment: "center"});
	
	$('#conversationPosts, #reply .postHeader').on("touchstart", '.upload > .fileupload', function(e) {
		
		var list = $(this).siblings('.upload-list');
		if (list.length) {
			if (list.data("vis")) {
				list.data("vis", false);
				list.hide("fast");
			} else {
				list.data("vis", true);
				list.show("fast");
			}
		}
	});

	
	$('#conversationPosts, #reply .postHeader').on('click', '.fileupload', function(e) {
		
		onFileUploadClick(e, this);
		
		var list = $(this).parents('.upload-list');
		if (list.length && list.data("vis")) {
			list.data("vis", false);
			list.hide("fast");
		}
	});
	
});
