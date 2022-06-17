var chatbox = 'chat.php';
var loadcontent = 'chatbox 8vui.Top đang loading';
$(document).ready(function() {
    $("#idChat").html(loadcontent);

    $.get(chatbox, function (html) {
        $("#idChat").html(html).hide().slideDown("slow");
    });

	reload_chat = setInterval(function() {
		$.get(chatbox, function (html) {
			$("#idChat").html(html);
		});
	}, 8000);
	var form = $('#form'); // contact form
	var submit = $('#submit');	// submit button
	var alert = $('#alert'); // alert div for show alert message
	var text = $('#postText');

	// form submit event
	form.on('submit', function(e) {
		e.preventDefault(); // prevent default form submit
		// sending ajax request through jQuery
		if (text == '') {
			alert.show();
			alert.text('Bạn chưa nhập nội dung !!!');
			$('#postText').focus();
			return false;
		}
		$.ajax({
			url: 'chat.php', // form action url
			type: 'POST', // form submit method get/post
			timeout: 5000,
			dataType: 'html', // request type html/json/xml
			data: form.serialize(), // serialize form data 
			beforeSend: function() {
				alert.fadeOut();
				submit.html('Đang gửi <img src="/pages/loading.gif" width="20" height="15">'); // change submit button text
			},
			success: function(data) {
				$.get(chatbox, function (html) {
					$("#idChat").html(html).hide().slideDown("slow");
				});
				form.trigger('reset'); // reset form
				$('#postText').focus();
				$('#postText').val('');
				submit.html('<img src="/pages/allow.png" width="15" height="15"> Gửi'); // reset submit button text
			},
			error: function(e) {
				console.log(e)
			}
		});
	});
});