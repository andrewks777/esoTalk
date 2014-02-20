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
	
	function onFileUploadClick(e, el) {
		var elem = $(el);
		try {
			var conversationId = ETConversation.id;
		} catch(e) {
			var conversationId = 0;
		}
		elem.fileupload({
			global: false,
			timeout: 0,
			url: ET.webPath + '/fileupload/upload/' + $(el).attr('data-uploadtype') + '/' + conversationId,
			dataType: 'json',
			//acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
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
						var errDesc = T("plugin.FileUpload.message.uploadError." + elem.attr('data-uploadtype'));
						var name = file.name;
						if (typeof(file.origName) != 'undefined') name = file.origName;
						errDesc = errDesc.replace('%1', name).replace('%2', file.error);
						errorText = (errorText != '' ? '<br>' : '') + errorText + errDesc + '';
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
				if (errorText != '') {
					ETMessages.showMessage(errorText, {className: "warning dismissable", id: "fileUploadFail-" + createUUID()});
				}
			},
			fail: function (e, data) {
				ETMessages.showMessage(T("plugin.FileUpload.message.serverDisconnected." + $(this).attr('data-uploadtype')), {className: "warning dismissable", id: "fileUploadFail"});
			},
			progressall: function (e, data) {
				//var progress = parseInt(data.loaded / data.total * 100, 10);
			}

		});
	}
	
	$(".upload input").tooltip({alignment: "center"});
	
	$('#conversationPosts, #reply .postHeader').on('click', '.fileupload', function(e) {
		onFileUploadClick(e, this);
	});
	
});
