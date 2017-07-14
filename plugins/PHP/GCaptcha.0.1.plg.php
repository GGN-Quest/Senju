<?php

global $_Gougnon;
// session_start();




if(!class_exists('GGNSession')){

	\Gougnon::loadPlugins('PHP/ggn.session.0.1');

}



if(!class_exists('GCaptcha')){

class GCaptcha{

	
	const NAME = 'Gougnon.Secure.Captcha.Image';

	const VERSION = '0.1.160615.0009';


	private $code=false;

	private $fname='Gougnon.Secure.Captcha.';

	private $UPLetter='I O 0 L 1';

	private $length=7;

	private $textures=[];


	var $name=false;

	var $args=[];

	var $session=false;

	var $duration=10;

	var $fontName = 'astonished.ttf';
	


	
	public function __construct(){

		$this->args = func_get_args(); 

		$this->name = (isset($this->args[0]))?(($this->args[0]!=false)?$this->args[0]:false):false;

			$this->name = (is_string($this->name))?$this->fname.$this->name: $this->fname.'Auto.'.date('Y.m.d');

		$this->textColor = (isset($this->args[1]))?(($this->args[1]!=false)?$this->args[1]:'#777'):'#777';

		$this->bgColor = (isset($this->args[2]))?(($this->args[2]!=false)?$this->args[2]:'#090909'):'#090909';

		$this->ease = (isset($this->args[3]) && ($this->args[3] == true))? true: false;


		$this->width = 256;

		$this->height = 64;

		$this->txc = Gougnon::HEXtoRGB($this->textColor);

		$this->bgc = Gougnon::HEXtoRGB($this->bgColor);

	}




	public function generateCode(){

		$this->code = _GGNCrypt::RKCRandm(str_replace(explode(' ',(($this->UPLetter) . ' ' . strtolower($this->UPLetter))), 'A', _GGNCrypt::PALETTE_ALPHA . ' ' . _GGNCrypt::PALETTE_NUMERIC),$this->length);

		// $this->code = _GGNCrypt::RKCRandm(str_replace(explode(' ',(strtoupper($this->UPLetter) . ' ' . strtolower($this->UPLetter))),'A',_GGNCrypt::PALETTE_ALPHA . ' ' . _GGNCrypt::PALETTE_NUMERIC),$this->length) . (isset($_SESSION['Captcha'])?$_SESSION['Captcha']:'_');
		
	}




	protected function initTexture(){
		$m = $this->textures;
		$k = mt_rand(0,count($m)-1);
		$i = (isset($m[$k]))?$m[$k]:false;

		$this->texture = ($i!==false)?imagecreatefrompng(__CAPTCHA__.$i.'.png'): imagecreatetruecolor($this->width, $this->height);
	}

	public function addTexture($img){
		array_push($this->textures,$img);
	}




	public function engine(){
		
		$this->addTexture('captcha_0');
		$this->addTexture('captcha_1');
		$this->addTexture('captcha_2');
		$this->addTexture('captcha_3');
		
		$this->generateCode();

		$this->session = new GGNSession($this->name,GGNSession::ONLINE, 'Gougnon.Secure.Captcha.Image');
		$sess_exists = $this->session->exists();

		$this->session->set($this->code,$this->duration);
		$this->image();
	}




	public function image(){
		$this->initTexture();

		$txt = $this->code;
		$lim = strlen($txt);
		$this->space = 20;
		$this->textWidth = ($lim*$this->space);
		$this->fontSize = 15;
		$this->x = ($this->width-$this->textWidth)/2;
		$this->y = ($this->height-$this->fontSize)-10;
		
		$img = imagecreatetruecolor($this->width, $this->height);
		$sup = $this->texture;

		imagealphablending($sup, false);
		imagesavealpha($sup, true);

		$tc = imagecolorallocate($img, $this->txc[0], $this->txc[1], $this->txc[2]);
		$bg = imagecolorallocate($img, $this->bgc[0], $this->bgc[1], $this->bgc[2]);

		imagefilledrectangle($img, 0, 0, $this->width, $this->height, $bg);


		/* Code */
		$text = $txt;

		$font = __TTF_FONTS__ . $this->fontName;


			$x = $this->x;
			for($i=0; $i<$lim; $i++){
				$letter = substr($this->code,$i,1);
				imagettftext($img, 30, 5, $x, $this->y, $tc, $font, $letter);
				$x += $this->space;
			}


		/* Fusion */
		imagecopyresampled($img,$sup, 0, 0, 0, 0,$this->width,$this->height,$this->width,$this->height);


		/* Génération */
		imagepng($img);

		imagedestroy($img);


	}



	public function Validate($code, $ease = null){

		$this->ease = ( is_bool($ease) || $ease == true ) ? $ease : $this->ease;

		$session = new GGNSession($this->name, GGNSession::ONLINE, 'Gougnon.Secure.Captcha.Image');

		$exists = $session->exists();


		if(!is_array($exists)){

			return false;

		}

		$trueCode = $exists[0]['value'];

		if(($code == $trueCode && $this->ease === true) || (strtoupper($code) == strtoupper($trueCode)) ){

			return true;

		}

		return false;

	}



}



}





?>