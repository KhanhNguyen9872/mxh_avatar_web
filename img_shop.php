<?php
define('_IN_JOHNCMS', 1);
$rootpath = ''; 
require('incfiles/core.php');
	use PHPImageWorkshop\ImageWorkshop;
	require_once($phpbb_root_path.'PHPImageWorkshop/ImageWorkshop.php');
	class GifCreator
{
    /**
     * @var string The gif string source (old: this->GIF)
     */
    private $gif;
    
    /**
     * @var string Encoder version (old: this->VER)
     */
	private $version;
    
    /**
     * @var boolean Check the image is build or not (old: this->IMG)
     */
    private $imgBuilt;

    /**
     * @var array Frames string sources (old: this->BUF)
     */
	private $frameSources;
    
    /**
     * @var integer Gif loop (old: this->LOP)
     */
	private $loop;
    
    /**
     * @var integer Gif dis (old: this->DIS)
     */
	private $dis;
    
    /**
     * @var integer Gif color (old: this->COL)
     */
	private $colour;
    
    /**
     * @var array (old: this->ERR)
     */
	private $errors;
 
    // Methods
    // ===================================================================================
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reset();
        
        // Static data
        $this->version = 'GifCreator: Under development';
        $this->errors = array(
            'ERR00' => 'Does not supported function for only one image.',
    		'ERR01' => 'Source is not a GIF image.',
    		'ERR02' => 'You have to give resource image variables, image URL or image binary sources in $frames array.',
    		'ERR03' => 'Does not make animation from animated GIF source.',
        );
    }

	/**
     * Create the GIF string (old: GIFEncoder)
     * 
     * @param array $frames An array of frame: can be file paths, resource image variables, binary sources or image URLs
     * @param array $durations An array containing the duration of each frame
     * @param integer $loop Number of GIF loops before stopping animation (Set 0 to get an infinite loop)
     * 
     * @return string The GIF string source
     */
	public function create($frames = array(), $durations = array(), $loop = 0)
    {
		if (!is_array($frames) && !is_array($GIF_tim)) {
            
            throw new \Exception($this->version.': '.$this->errors['ERR00']);
		}
        
		$this->loop = ($loop > -1) ? $loop : 0;
		$this->dis = 2;
        
		for ($i = 0; $i < count($frames); $i++) {
		  
			if (is_resource($frames[$i])) { // Resource var
                
                $resourceImg = $frames[$i];
                
                ob_start();
                imagegif($frames[$i]);
                $this->frameSources[] = ob_get_contents();
                ob_end_clean();
                
            } elseif (is_string($frames[$i])) { // File path or URL or Binary source code
			     
                if (file_exists($frames[$i]) || filter_var($frames[$i], FILTER_VALIDATE_URL)) { // File path
                    
                    $frames[$i] = file_get_contents($frames[$i]);                    
                }
                
                $resourceImg = imagecreatefromstring($frames[$i]);
                
                ob_start();
                imagegif($resourceImg);
                $this->frameSources[] = ob_get_contents();
                ob_end_clean();
                 
			} else { // Fail
                
                throw new \Exception($this->version.': '.$this->errors['ERR02'].' ('.$mode.')');
			}
            
            if ($i == 0) {
                
                $colour = imagecolortransparent($resourceImg);
            }
            
			if (substr($this->frameSources[$i], 0, 6) != 'GIF87a' && substr($this->frameSources[$i], 0, 6) != 'GIF89a') {
			 
                throw new \Exception($this->version.': '.$i.' '.$this->errors['ERR01']);
			}
            
			for ($j = (13 + 3 * (2 << (ord($this->frameSources[$i] { 10 }) & 0x07))), $k = TRUE; $k; $j++) {
			 
				switch ($this->frameSources[$i] { $j }) {
				    
					case '!':
                    
						if ((substr($this->frameSources[$i], ($j + 3), 8)) == 'NETSCAPE') {
                            
                            throw new \Exception($this->version.': '.$this->errors['ERR03'].' ('.($i + 1).' source).');
						}
                        
					break;
                        
					case ';':
                    
						$k = false;
					break;
				}
			}
            
            unset($resourceImg);
		}
		
        if (isset($colour)) {
            
            $this->colour = $colour;
                                    
        } else {
            
            $red = $green = $blue = 0;
            $this->colour = ($red > -1 && $green > -1 && $blue > -1) ? ($red | ($green << 8) | ($blue << 16)) : -1;
        }
        
		$this->gifAddHeader();
        
		for ($i = 0; $i < count($this->frameSources); $i++) {
		  
			$this->addGifFrames($i, $durations[$i]);
		}
        
		$this->gifAddFooter();
        
        return $this->gif;
	}
    
    // Internals
    // ===================================================================================
    
	/**
     * Add the header gif string in its source (old: GIFAddHeader)
     */
	public function gifAddHeader()
    {
		$cmap = 0;

		if (ord($this->frameSources[0] { 10 }) & 0x80) {
		  
			$cmap = 3 * (2 << (ord($this->frameSources[0] { 10 }) & 0x07));

			$this->gif .= substr($this->frameSources[0], 6, 7);
			$this->gif .= substr($this->frameSources[0], 13, $cmap);
			$this->gif .= "!\377\13NETSCAPE2.0\3\1".$this->encodeAsciiToChar($this->loop)."\0";
		}
	}
    
	/**
     * Add the frame sources to the GIF string (old: GIFAddFrames)
     * 
     * @param integer $i
     * @param integer $d
     */
	public function addGifFrames($i, $d)
    {
		$Locals_str = 13 + 3 * (2 << (ord($this->frameSources[ $i ] { 10 }) & 0x07));

		$Locals_end = strlen($this->frameSources[$i]) - $Locals_str - 1;
		$Locals_tmp = substr($this->frameSources[$i], $Locals_str, $Locals_end);

		$Global_len = 2 << (ord($this->frameSources[0 ] { 10 }) & 0x07);
		$Locals_len = 2 << (ord($this->frameSources[$i] { 10 }) & 0x07);

		$Global_rgb = substr($this->frameSources[0], 13, 3 * (2 << (ord($this->frameSources[0] { 10 }) & 0x07)));
		$Locals_rgb = substr($this->frameSources[$i], 13, 3 * (2 << (ord($this->frameSources[$i] { 10 }) & 0x07)));

		$Locals_ext = "!\xF9\x04".chr(($this->dis << 2) | 1 + 0).chr(($d >> 0 ) & 0xFF).chr(($d >> 8) & 0xFF)."\x0\x0";

		if ($this->colour > -1 && ord($this->frameSources[$i] { 10 }) & 0x80) {
		  
			for ($j = 0; $j < (2 << (ord($this->frameSources[$i] { 10 } ) & 0x07)); $j++) {
			 
				if (ord($Locals_rgb { 3 * $j + 0 }) == (($this->colour >> 16) & 0xFF) &&
					ord($Locals_rgb { 3 * $j + 1 }) == (($this->colour >> 8) & 0xFF) &&
					ord($Locals_rgb { 3 * $j + 2 }) == (($this->colour >> 0) & 0xFF)
				) {
					$Locals_ext = "!\xF9\x04".chr(($this->dis << 2) + 1).chr(($d >> 0) & 0xFF).chr(($d >> 8) & 0xFF).chr($j)."\x0";
					break;
				}
			}
		}
        
		switch ($Locals_tmp { 0 }) {
		  
			case '!':
            
				$Locals_img = substr($Locals_tmp, 8, 10);
				$Locals_tmp = substr($Locals_tmp, 18, strlen($Locals_tmp) - 18);
                                
			break;
                
			case ',':
            
				$Locals_img = substr($Locals_tmp, 0, 10);
				$Locals_tmp = substr($Locals_tmp, 10, strlen($Locals_tmp) - 10);
                                
			break;
		}
        
		if (ord($this->frameSources[$i] { 10 }) & 0x80 && $this->imgBuilt) {
		  
			if ($Global_len == $Locals_len) {
			 
				if ($this->gifBlockCompare($Global_rgb, $Locals_rgb, $Global_len)) {
				    
					$this->gif .= $Locals_ext.$Locals_img.$Locals_tmp;
                    
				} else {
				    
					$byte = ord($Locals_img { 9 });
					$byte |= 0x80;
					$byte &= 0xF8;
					$byte |= (ord($this->frameSources[0] { 10 }) & 0x07);
					$Locals_img { 9 } = chr($byte);
					$this->gif .= $Locals_ext.$Locals_img.$Locals_rgb.$Locals_tmp;
				}
                
			} else {
			 
				$byte = ord($Locals_img { 9 });
				$byte |= 0x80;
				$byte &= 0xF8;
				$byte |= (ord($this->frameSources[$i] { 10 }) & 0x07);
				$Locals_img { 9 } = chr($byte);
				$this->gif .= $Locals_ext.$Locals_img.$Locals_rgb.$Locals_tmp;
			}
            
		} else {
		  
			$this->gif .= $Locals_ext.$Locals_img.$Locals_tmp;
		}
        
		$this->imgBuilt = true;
	}
    
	/**
     * Add the gif string footer char (old: GIFAddFooter)
     */
	public function gifAddFooter()
    {
		$this->gif .= ';';
	}
    
	/**
     * Compare two block and return the version (old: GIFBlockCompare)
     * 
     * @param string $globalBlock
     * @param string $localBlock
     * @param integer $length
     * 
     * @return integer
	 */
	public function gifBlockCompare($globalBlock, $localBlock, $length)
    {
		for ($i = 0; $i < $length; $i++) {
		  
			if ($globalBlock { 3 * $i + 0 } != $localBlock { 3 * $i + 0 } ||
				$globalBlock { 3 * $i + 1 } != $localBlock { 3 * $i + 1 } ||
				$globalBlock { 3 * $i + 2 } != $localBlock { 3 * $i + 2 }) {
				
                return 0;
			}
		}

		return 1;
	}
    
	/**
     * Encode an ASCII char into a string char (old: GIFWord)
     * 
     * $param integer $char ASCII char
     * 
     * @return string
	 */
	public function encodeAsciiToChar($char)
    {
		return (chr($char & 0xFF).chr(($char >> 8) & 0xFF));
	}
    
    /**
     * Reset and clean the current object
     */
    public function reset()
    {
        $this->frameSources;
        $this->gif = 'GIF89a'; // the GIF header
        $this->imgBuilt = false;
        $this->loop = 0;
        $this->dis = 2;
        $this->colour = -1;
    }
    
    // Getter / Setter
    // ===================================================================================
    
	/**
     * Get the final GIF image string (old: GetAnimation)
     * 
     * @return string
	 */
	public function getGif()
    {
		return $this->gif;
	}
}
if($_GET['u']){
$user = preg_replace('/[^0-9]/','',$_GET['u']);
$shop = mysql_fetch_array(mysql_query("SELECT * FROM `shopdo` WHERE `id`='$user'"));
if($shop['id_loai']>0) { //Kiem tra thanh vien ton tai
$base = ImageWorkshop::initFromPath($rootpath.'images/blank.png'); //tao anh trong
$base2 = ImageWorkshop::initFromPath($rootpath.'images/blank.png'); //tao anh trong (2)
$loai = $shop['loai'];
$id = $shop['id_loai'];

//--ZIP PRO--//
//Cánh
if ($loai==canh) {
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/'.$id.'.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
if(file_exists($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png')){
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png');
$base2->addLayerOnTop($canh, 0, 0, "LB");
} else $base2->addLayerOnTop($canh, 0, 1, "LT");
}
//hào quang
if ($loai==haoquang) {
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/'.$id.'.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
if(file_exists($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png')){
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png');
$base2->addLayerOnTop($canh, 0, 0, "LB");
} else $base2->addLayerOnTop($canh, 0, 0, "LT");
}
// them quan
if ($loai==quan) {
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/'.$id.'.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
if(file_exists($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png')){
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png');
$base2->addLayerOnTop($canh, 0, 0, "LB");
} else $base2->addLayerOnTop($canh, 0, 0, "LB");
} else {
$canh=ImageWorkshop::initFromPath($rootpath.'images/quan-rip/0.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
$base2->addLayerOnTop($canh, 0, 0, "LB");
}
// them ao
if ($loai==ao) {
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/'.$id.'.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
if(file_exists($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png')){
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png');
$base2->addLayerOnTop($canh, 0, 0, "LB");
} else $base2->addLayerOnTop($canh, 0, 1, "LT");
} else {
$canh=ImageWorkshop::initFromPath($rootpath.'images/ao-rip/0.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
$base2->addLayerOnTop($canh, 0, 1, "LT");
}
// khuôn mặt
if ($loai==khuonmat) {
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/'.$id.'.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
if(file_exists($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png')){
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png');
$base2->addLayerOnTop($canh, 0, 0, "LB");
} else $base2->addLayerOnTop($canh, 0, 1, "LT");
} else {
$canh=ImageWorkshop::initFromPath($rootpath.'images/khuonmat.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
$base2->addLayerOnTop($canh, 0, 1, "LT");
}
//Tóc
if ($loai==toc) {
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/'.$id.'.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
if(file_exists($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png')){
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png');
$base2->addLayerOnTop($canh, 0, 0, "LB");
} else $base2->addLayerOnTop($canh, 0, 1, "LT");
} else {
$canh=ImageWorkshop::initFromPath($rootpath.'images/toc-rip/0.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
$base2->addLayerOnTop($canh, 0, 1, "LT");
}
//Kính
if ($loai==kinh) {
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/'.$id.'.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
if(file_exists($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png')){
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png');
$base2->addLayerOnTop($canh, 0, 0, "LB");
} else $base2->addLayerOnTop($canh, 0, 1, "LT");
}
//Mặt nạ
if ($loai==matna) {
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/'.$id.'.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
if(file_exists($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png')){
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png');
$base2->addLayerOnTop($canh, 0, 1, "LB");
} else $base2->addLayerOnTop($canh, 0, 1, "LT");
}
//Cần câu
if ($loai==cancau) {
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/'.$id.'.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
if(file_exists($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png')){
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png');
$base2->addLayerOnTop($canh, 0, 0, "LB");
} else $base2->addLayerOnTop($canh, 0, 1, "LT");
}
//Nón
if ($loai==non) {
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/'.$id.'.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
if(file_exists($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png')){
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png');
$base2->addLayerOnTop($canh, 0, 0, "LB");
} else $base2->addLayerOnTop($canh, 0, 1, "LT");
}
//đồ cầm tay
if ($loai==docamtay) {
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/'.$id.'.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
if(file_exists($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png')){
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png');
$base2->addLayerOnTop($canh, 0, 0, "LB");
} else $base2->addLayerOnTop($canh, 0, 1, "LT");
}
//Thú cưng
if ($loai==thucung) {
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/'.$id.'.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
if(file_exists($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png')){
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/load/'.$id.'.png');
$base2->addLayerOnTop($canh, 0, 0, "LB");
} else $base2->addLayerOnTop($canh, 0, 1, "LT");
}
// thêm tâm trạng
if ($loai==mat) {
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/'.$id.'.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
if(file_exists($rootpath.'images/'.$loai.'-rip/load/0.png')){
$canh=ImageWorkshop::initFromPath($rootpath.'images/'.$loai.'-rip/load/0.png');
$base2->addLayerOnTop($canh, 0, 0, "LB");
} else $base2->addLayerOnTop($canh, 0, 1, "LT");
} else {
$canh=ImageWorkshop::initFromPath($rootpath.'images/mat-rip/0.png');
$base->addLayerOnTop($canh, 0, 0, "LB");
$base2->addLayerOnTop($canh, 0, 1, "LT");
}
////end
$desiredWidth = 50;
$desiredHeight = 60;
$image = $base->getResult();
$image2 = $base2->getResult();
$frames = array($image,$image2);
$durations = array(45, 45);
$gc = new GifCreator();
$gc->create($frames, $durations, 0);
$gifBinary = $gc->getGif();
header('Content-type: image/gif');
echo $gifBinary;
exit;
}
}
?>
                            
                            
                            
                            
                            
                            
                            