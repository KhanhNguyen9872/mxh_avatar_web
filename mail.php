<?php
define('_IN_JOHNCMS',1);
require('incfiles/core.php');
$headmod = 'mail';
require('incfiles/head.php');

echo "<script>
var loadad = '<audio id=audioplayer autoplay=true><source src=ping.mp3 type=audio/mpeg></audio>';
var loadcontent = '<div class=loadcontent_chat><img src=http://i.imgur.com/nYNnvDP.gif></div>';
var loadsubmit = '<img src=http://i.imgur.com/XJICQrg.gif style=margin-bottom:-10px>';
$(document).ready(function(){
$(\"textarea\").on(\"keydown\", function(event) {
    if (event.keyCode == 13)
        if (!event.shiftKey) $(\"#shoutbox\").submit();
});
$(\"#datachat\").html(loadcontent);
$(\"#datachat\").load(\"mail_chat.php?id=$id&page=$page\");
var refreshId = setInterval(function() {
$(\"#datachat\").load('$home/mail_chat.php?id=$id&page=$page');
$(\"#datachat\").slideDown(\"slow\");
}, 5000);
$(\"#shoutbox\").validate({
debug: false,
submitHandler: function(form) {
$('#loader').fadeIn(400).html(loadsubmit);
$('#audio').fadeIn(400).html(loadad);
$.post('$home/mail_chat.php?id=$id&page=$page', $(\"#shoutbox\").serialize(),function(chatoutput) { 
$(\"#datachat\").html(chatoutput);
$('#loader').hide();
});
$(\"#msg\").val(\"\");
}
});

});
</script>";


echo '<div class="phdr"><i class="fa fa-comments-o"></i> Trò chuyện</div><div class="menu">

<div style="padding-bottom:4px;">';


echo '<form name="shoutbox" id="shoutbox" action="" method="post">

<textarea placeholder="Nhấn Gửi hoặc nhấn ENTER để gửi" id="msg" name="msg" style="max-width:98%;padding-top:10px;"></textarea>

<br /><button type="submit" name="submit" class="topic cat_blue" style="margin-top:4px;padding:5px;">Gửi</button><span id="loader"></span>
<button type="type" class="topic cat_green" style="margin-top:4px;padding:5px;">Shift+Enter xuống dòng</button></form></div></div>';

echo '<div id="audio"></div><div id="datachat">
</div>';

//--Kết thúc Phòng Chát//

require('incfiles/end.php');

?>