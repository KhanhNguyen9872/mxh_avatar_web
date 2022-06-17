<form method="post">
<input type="checkbox" name="dattrong[]" value="1"/>
<input type="checkbox" name="dattrong[]" value="2"/>
<input type="checkbox" name="dattrong[]" value="3"/>
<input type="checkbox" name="dattrong[]" value="4"/>
<input type="checkbox" name="dattrong[]" value="5"/>
<input type="checkbox" name="dattrong[]" value="6"/>
<input type="checkbox" name="dattrong[]" value="7"/>
<input type="checkbox" name="dattrong[]" value="8"/>
<input type="checkbox" name="dattrong[]" value="9"/>
<input type="checkbox" name="dattrong[]" value="10"/>

<div class="menu"><input type="submit" name="ok" value="Ok"/></div>
</form>



<?php

if(isset($_POST['ok'])) { 
        $_SESSION['dc'] = $dc;
        $_SESSION['prd'] = htmlspecialchars(getenv("HTTP_REFERER"));
        $dc = $_SESSION['dc'];
        $prd = $_SESSION['prd'];
        foreach ($_POST['dattrong'] as $delid) {
////////////// đoạn xử lý ////
       $xuly = intval($delid);
         }
echo $xuly;
}
?>