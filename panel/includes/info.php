<?

defined('_IN_JOHNADM') or die('Error: restricted access');

// Проверяем права доступа
if ($rights < 9) {
    header('Location: /ERROR/404.htm');
    exit;
}

function formatsize($file_size) {
	if ($file_size >= 1048576000) {
		$file_size = round(($file_size / 1073741824), 2)." Gb";
	} elseif ($file_size >= 1024000) {
		$file_size = round(($file_size / 1048576), 2)." Mb";
	} elseif ($file_size >= 1000) {
		$file_size = round(($file_size / 1024), 2)." Kb";
	} else {
		$file_size = round($file_size)." byte";
	} 
	return $file_size;
}

switch ($mod) {
    case 'optim':
		echo '<div class="phdr"><a href="index.php?act=info"><b>Thông tin</b></a> | Tối ưu hóa bảng MySQl</div>';
		$req = mysql_query("SHOW TABLE STATUS");
		$sbd = 0;
		while (($row = mysql_fetch_array($req)) !== FALSE) {
			$sbd += $row['Data_length'] + $row['Index_length'];
			mysql_query("OPTIMIZE TABLE '".$row['Name']."'");
			echo $i % 2 ? '<div class="list2">' : '<div class="list1">';
			echo '<b>'.$row['Name'].':</b>&#160;'.formatsize($row['Data_length']).' + '.formatsize($row['Index_length']).'&#160;(%&#160;'.formatsize($row['Data_free']).')';
			echo '</div>';
			$i++;
		}
		echo '<div class="bmenu">Tổng số (phân mảnh)&#160;<b>'.formatsize($sbd).'</b></div>'.
			 '<p><a href="index.php">' . $lng['admin_panel'] . '</a></p>';
	break;

    default:
		function opis($m) {return preg_replace("#(.*?)(\n|\r)+#si", '\1<br />', $m);}
		function GDversion(){
			static $gd_v_ = NULL;
			if ($gd_v_ === NULL){
				ob_start();
				phpinfo(8);
				$_info = ob_get_contents();
				ob_end_clean();
				if (preg_match("/\bgd\s+version\b[^\d\n\r]+?([\d\.]+)/i", $_info, $matches)) $GD_v_h = $matches[1];
				else $GD_v_h = 0;

			}
			return $GD_v_h;
		}

		$_mem_limit = ini_get('memory_limit');
		$memory_limit = '<font color="#102030">'.$_mem_limit.'</font>';

		$_ext_time = ini_get('max_execution_time');
		$max_exec_time = '<font color="#102030">'.$_ext_time.'</font>';

		$de_functions = (strlen(ini_get('disable_functions')) > 1) ? ini_get('disable_functions') : '<font color="#990000"><b>Không.</b></font>';
		$de_functions = str_replace (',', ', ', $de_functions);

		$req = mysql_query("SHOW TABLE STATUS");
		$sbd = 0;
		while (($row = mysql_fetch_array($req)) !== FALSE) {
		$sbd += $row['Data_length'] + $row['Index_length'];
		}

		$ext = get_loaded_extensions();
		$cnt = count($ext);
		$extensions = NULL;
		for ($i = 0; $i < $cnt; $i++){
			$extensions .= ' '.$ext[$i].',';
		}
		$extensions = substr($extensions, 0, -1);

		if(function_exists('apache_get_modules')) {
			if (array_search('mod_rewrite', apache_get_modules()))
				$mod_rewrite = '<font color="#009900">ON</font>';
			else $mod_rewrite = '<font color="#990000">OFF</font>';

		} else $mod_rewrite = ' n/a ';
		
	echo '<p><h3><img src="../images/system/9.png" width="16" height="16" class="left" alt="" />&#160;Thông tin</h3>'.
		 '<div class="list1"><small>Server time: '.date('j.m.Y, H:i').'</small></div>'.
		 '<div class="list2"><small>Max execution time: '.$max_exec_time.'</small></div>'.
		 '<div class="list1">PHP VERSION: <b>'.PHP_VERSION.'</b> ('.PHP_OS.') </div>'.
		 '<div class="list2">ZEND ENGINE: <b>'.Zend_Version().'</b> </div>'.
		 '<div class="list1">GD VERSION: <b>'.GDversion().'</b> </div>'.
		 '<div class="list2">MAX upload FileSize: <b>'.formatsize(str_replace(array('M','m'), '', ini_get('upload_max_filesize'))*1024*1024).'</b></div>'.
		 '<div class="list1">HARD free SPACE: <b>'.formatsize(disk_free_space('.')).'</b> </div>'.
		 '<div class="list2"><a href="index.php?act=info&amp;mod=optim">MySQL Size</a>: <b>'.formatsize($sbd).'</b> </div>'.
		 '<div class="list1">Memori Limit: <b>'.$memory_limit.'</b> </div>'.
		 '<div class="list2">Mod ReWrite: <b>'.$mod_rewrite.'</b> </div>'.
		 '<div class="list1">'.opis($extensions).' </div>'.
		 '<div class="list2">Disable Functions:&#160;'.opis($de_functions).' </div><a href="index.php">' . $lng['admin_panel'] . '</a></p>';
}
?>