
            <?php
if ($user_id) {
echo'</div>';

} 
?>    




<script type="text/javascript">
$('#s').click(function() {  
$('#ss').toggle('fast','linear');  
}); 
$('#sss').click(function() {  
$('#ssss').toggle('fast','linear');  
});
$('#mo').click(function (){
$('#mo1').toggle('fast','linear');
}); 
</script>
<style>
a:hover 
{text-decoration:none;
color:#D570EE;
text-decoration:none;
font-weight:bold;
background-image:url("//4rumvn.net/icon/timbay.gif");
}

.node--newIndicator {
    font-size: 11px;
    color: #fefefe;
    background: #ff7f50;
    border-radius: 4px;
    padding-top: 3px;
    padding-right: 6px;
    padding-bottom: 3px;
    padding-left: 6px;
    text-transform: uppercase;
}
</style>
<?php
defined('_IN_JOHNCMS') or die('Error: restricted access');
if (isset($_COOKIE['the']))
{
$the = $_COOKIE['the'];
}
elseif (!$is_mobile)
{
$the = 'web';
} else {
$the = 'wap';
}
////////CODE WEB Ở ĐÂY
if ($the == 'web')
{
echo'</div>';
echo'</div>';
if (!empty($cms_ads[0]))
echo '<div class="func"><b>' . $cms_ads[0] . '</b></div>';
echo'
<div class="clearfix"></div></div><br></div></div><br></div>';
echo'<div class="left_b_bottom"><div class="right_b_bottom"><div class="footer"><div class="left_bottom"></div><div class="right_bottom"></div></div></div></div><div class="copyright">';
echo'<div class="on">';
echo'</div>';
echo'<b><font color="#FF0000">Copyright @2019 By ID Thiên Ân - Edit Chibikun-Admin Army2 Lậu Server HTT</font></br>
<font color="0000FF">Chính Thức Close Beta: 17/12/2019</font></b>';
// NÚT  TOP-UP

//thanh trượt#E4DDDF
echo '<style type="text/css">
::-webkit-scrollbar {
width:11px;height:11px;
}
::-webkit-scrollbar-thumb {
background:#8DA59E;
border-radius:10px;
}
</style>';
//di chuyễn vào link - trái tim
echo '<style type="text/css">
a:hover 
{text-decoration:none;
color:#D570EE;
text-decoration:none;
font-weight:bold;
background-image:url("/icon/timbay.gif");
}
</script>';
}
////////CODE WAP Ở ĐÂY
if ($the == 'wap')
{
echo'</div>';
echo'</div>';
if (!empty($cms_ads[0]))
echo '<div class="func"><b>' . $cms_ads[0] . '</b></div>';
echo'
<div class="clearfix"></div></div><br></div></div><br></div>';
echo'<div class="left_b_bottom"><div class="right_b_bottom"><div class="footer"><div class="left_bottom"></div><div class="right_bottom"></div></div></div></div><div class="copyright">';
echo'<div class="on">';
echo'</div>';
echo'<b><font color="#FF0000">Copyright @2019 By ID Thiên Ân - Edit Chibikun-Admin Army2 Lậu Server HTT</font></br>
<font color="0000FF">Chính Thức Close Beta: 17/12/2019</font></b>';
}
?> 

                 
                 
                 
                 
   
























