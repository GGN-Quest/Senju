<?php
/*
	Copyright 2013 GOBOU Y. Yannick
======================================================
	FICHIER 'DesignPackageObject.plg' VERSION '2.1'
======================================================

*/


if(!class_exists('dpo')){
		
	class dpo extends GGNCorePHP implements GGNCoreInterface
	{

		/* INFOS */
		CONST NAME = 'Design Package Object Core (DPO.Core)';
		const VERSION = '2.1.1';
		CONST UPDATE_VERSION = '150909.2057';
		
		
		
		
		
		
		
		
		/* RESSOURCES */
		CONST CPREF = 'function';
		CONST FUNCTIONS_STORE = 'functions/';
		CONST CSUF = 'PHPCore.php';

		   
		
		const __MANIFEST = '.manifest';
		const __Ext = '.php';
		const _Ext = '.dpo';



		
		
		var $menu=array();
		
		var $title = false;
		var $__shorcut = array();
		var $__meta = array();
		var $param = array();
		var $_html = array();
		var $_head = array();
		var $_headAttrib = array();
		var $_body = array();
		var $_bodyAttrib = array();
		var $__javascript = array();
		var $__css = array();
		var $_theme = false;
		var $_lang = 'fr';
		var $_doctype = array();
		var $fileHost = false;
		
		
		var $responsivity = false;
		var $device = false;
		var $screen = array();
		
		
		
		
		/* Manifest */
		var $manifest = array();
		
		
		
		
		/* Gougnon Frameworks */
		var $packageStyle = 'light';

		/* JS */
		var $JSFramework = 'JSFramework';
		var $JSFrameworkVersion = 'nightly.0.1';
		var $__jsPackages = array();

		/* CSS */
		var $CSSFramework = 'CSSFramework';
		var $CSSFrameworkVersion = 'nightly.0.1';
		var $__cssPackages = array();

		
		
		
		
		
		
		public function __construct(){
			$this->param['construct'] = func_get_args();
			$this->_themeFolder = __THEMES__;
			
			$this->__meta = array();
			$this->__meta['http-equiv'] = array();
			$this->__meta['name'] = array();
			$this->__metaAttrib = array();
			
			$this->device = $this->devices();
			$this->screens();
			$this->CSSCore = _GGN::CSSCore('ggn.core');
			
			$this->__javascript['call'] = array();
			$this->__javascript['code'] = array();
			
			$this->__css['call'] = array();
			$this->__css['code'] = array();


		}
		
		public function devices(){return new DPODevice();}

		public function screens(){
			$this->screen['widescreen'] = '2560x1600|1920x1200|1680x1050|1440x900|1280x800';
			$this->screen['fullscreen54'] = '1600x1200|1400x1050|1280x960|1024x768';
			$this->screen['fullscreen43'] = '1280x1024';
			$this->screen['HDTV'] = '2560x1440|1920x1080|1600x900|1366x768|1280x720';
			$this->screen['netbook-mobile'] = '1024x1024|640x960|1024x600|800x600|800x480|960x854|640x480|320x248';

			$this->screen['16:10'] = $this->screen['widescreen'];
			$this->screen['4:3'] = $this->screen['fullscreen43'];
			$this->screen['5:4'] = $this->screen['fullscreen54'];
			$this->screen['16:9'] = $this->screen['HDTV'];
			
			$this->screen['0.6'] = '640x960';
			$this->screen['1.1'] = '960x854';
			$this->screen['1.2'] = '320x248|1280x1024';
			$this->screen['1.3'] = '640x480|800x600|' . $this->screen['4:3'];
			$this->screen['1.5'] = '960x640';
			$this->screen['1.6'] = '800x480|' . $this->screen['16:10'];
			$this->screen['1.7'] = '1024x600|' . $this->screen['16:9'];
			$this->screen['1.0'] = '1024x1024';

			return $this->screen;
		}
		
		
		
		
		/* Thème */
		public function loadManifest(){
			$this->_manifest = $this->themeFolder . self::__MANIFEST . self::__Ext;
				if(!is_file($this->_manifest)){_GGN::wCnsl('Erreur : Le manifest du thème spécifié est introuvable');}
					$this->manifest = array();
						include $this->_manifest;
			return $this->manifest;
		}
			
		public function load(){/* +1 Overload */
			$this->param['theme'] = func_get_args();
			$this->_theme = (isset($this->param['theme'][0]))? $this->param['theme'][0]:false;
			
				if($this->_theme===false){_GGN::wCnsl('Erreur : Thème non definie');}
			
			$this->themeFolder = $this->_themeFolder . $this->_theme;
				if(!is_dir($this->themeFolder)){_GGN::wCnsl('Erreur : Le thème spécifié est introuvable');}
			$this->themeFolder .= ((substr($this->themeFolder, -1)=='/')?'': '/');
			$this->loadManifest();
			
			return $this;
		}
		
		
		
		
		/* Briques du thème */
		public function brique($part){/* 2 Overload */
			$this->arguments[$part] = $arguments = func_get_args(); 
			$de = ($this->device->current=='-c')?'computer':'mobile';
			$de = ((!isset($this->manifest[$de][$part]))?'computer':$de);
				if(!isset($this->manifest[$de][$part])){_GGN::wCnsl('Erreur : La partie du thème spécifiée est introuvable "' . $part . '"');}
			$f = $this->themeFolder . $this->manifest[$de]['prefixe'].$this->manifest[$de][$part].self::_Ext.self::__Ext;
				if(!isset($this->manifest[$de])){_GGN::wCnsl('Erreur : Le mode la partie du thème spécifiée est introuvable ' . $this->manifest[$de]);}
				if(!is_file($f)){_GGN::wCnsl('Erreur : La partie du thème spécifiée est introuvable "' . $part . '"');}
				include $f;
			return $this;
		}
		
		
		public function header(){/* +1 Overload */
			$this->arguments['header'] = func_get_args();
			$this->brique('header');
			return $this;
		}
		
		
		public function footer(){/* +1 Overload */
			$this->arguments['footer'] = func_get_args();
			$this->brique('footer');
			return $this;
		}
		
		
		// public function application(){/* +1 Overload */
		// 	$this->param['application'] = func_get_args();
		// 	$p = (isset($this->param['application'][0]))? '_' . $this->param['application'][0]: '';
		// 	$f = $this->themeFolder . $this->manifest['computer']['prefixe'].$this->manifest['computer']['application' . $p].self::_Ext.self::__Ext;
		// 	if(!is_file($f)){_GGN::wCnsl('L\'application du thème spécifié est introuvable');}
				
		// 		include $f;
		// 	return $this;}
		
		
		
		
		
		
		/* Fonctionnement -------------------------- */
		/* Outils de Balisage body Fréquents */
		public function linktag($attrib){return ('<link '.$attrib.'>');}
		
		public function metatag($attrib){return ('<meta '.$attrib.'>');}
		
		public function divtag($content = "", $attrib = false){/* +2 Overloads */  
			return ('<div' . ($attrib==false?'': ' ' . $attrib . ' ') . '>'.$content.'</div>');
		}
		
		public function scripttag(){/* +2 Overloads */ $a=func_get_args(); 
			return ('<script'.((isset($a[1]))?(($a[1]===false)?'':' '.$a[1]):'').'>'.((isset($a[0]))?(($a[0]===false)?'':$a[0]):'').'</script>');}
		
		public function styletag(){/* +2 Overloads */ $a=func_get_args(); 
			return ('<style'.((isset($a[1]))?(($a[1]===false)?'':' '.$a[1]):'').'>'.((isset($a[0]))?(($a[0]===false)?'':$a[0]):'').'</style>');}
		
		
		
		
		/* Contenu */
		public function doctype($string){array_push($this->_doctype, $string);return $this;}
		
		public function write($string){_GGN::write($string);}
		
		// public function html($string){array_push($this->_html, $string);return $this;}
		public function html($name, $string){$this->_html[$name] = $string;return $this;}
		
		public function htmlAttribute($string){return $this->html($string);}
		
		public function body($string){array_push($this->_body, $string);return $this;}
		public function bodyAttrib($name, $string){$this->_bodyAttrib[$name] = $string;return $this;}
		
		public function head($string){array_push($this->_head, $string);return $this;}
		public function headAttrib($name, $string){$this->_headAttrib[$name] = $string;return $this;}

		
		
		
		/* title de la page */
		public function _title(){/* +1 Overload */
			$a=func_get_args();
			if(isset($this->title)){$this->head(($this->title!==false)?'<title>'.$this->title.((isset($a[0]))?$a[0]:'').'</title>':'');}
			}
		
		
		
		
		/* Génération de la page */
		public function generate(){
			self::write($this->returnCodeGenerated());
		}
		
		
		/* Génération du code final de la page */
		public function returnCodeGenerated(){
			$code = '';
			$htmlattrib = '';
			$battrib = '';
			$hattrib = '';
			
			$code .= ('<!-- Native de '.self::NAME.' '.self::VERSION.' (update:'.self::UPDATE_VERSION.') -->');
			foreach($this->_doctype as $doctype){$code .= ('<!DOCTYPE ' . $doctype . '>');}
			foreach($this->_bodyAttrib as $attrib => $value){$battrib .= ' ' . $attrib . '="' . Render::toJSDocWrite($value) . '" '; }
			foreach($this->_headAttrib as $attrib => $value){$hattrib .= ' ' . $attrib . '="' . Render::toJSDocWrite($value) . '" '; }
			foreach($this->_html as $attrib => $value){$htmlattrib .= ' ' . $attrib . '="' . Render::toJSDocWrite($value) . '" '; }
			
			$code .= ('<html' . $htmlattrib . '>');
			$code .= ('<head' . $hattrib . '>' . implode("", $this->_head) . '</head>');
			$code .= ('<body' . $battrib . '>' . implode("", $this->_body) . '</body>');
			$code .= ('</html>');
			$code .= ('<!-- '.Gougnon::NAME.'/'.Gougnon::VERSION.' (update:'.Gougnon::REEL_VERSION.') -->');

			return $code;
		}
		
		
		/* Génération de la page dans le corps */
		public function generateInnerBody(){
			self::write('<!-- Native de '.self::NAME.' '.self::VERSION.' (update:'.self::UPDATE_VERSION.') -->');
			self::write(implode("", $this->_body));
			self::write('<!-- '.Gougnon::NAME.'/'.Gougnon::VERSION.' (update:'.Gougnon::REEL_VERSION.') -->');
		}
		
		
		/* Génération de la page dans l'entête */
		public function generateInnerHead(){
			self::write('<!-- Native de '.self::NAME.' '.self::VERSION.' (update:'.self::UPDATE_VERSION.') -->');
			self::write(implode("", $this->_head));
			self::write('<!-- '.Gougnon::NAME.'/'.Gougnon::VERSION.' (update:'.Gougnon::REEL_VERSION.') -->');
		}
		
		
		
		
		/* Meta */
		public function meta(){/* +4 Overloads */
			$a=func_get_args();
			$this->__meta[strtoupper($a[0])][strtoupper($a[1])] = (isset($a[2]))?$a[2]:''; 
			$this->__metaAttrib[strtoupper($a[0].'_'.$a[1])]=(isset($a[3]))?$a[3]:''; 
			}
			
		public function _meta(){$r=''; 
			foreach($this->__meta as $type => $m){ $t=$m;foreach($t as $n => $v){ $attr = $this->__metaAttrib[strtoupper($type.'_'.$n)]; $r .= $this->metatag(strtolower($type).'="'.strtolower($n).'" '.((!Gougnon::isEmpty($v))? 'content="'.($v).'" ':'').''.$attr);}} $this->head($r); 
			}
			
			
			
		/* Icon Shortcut */
		public function shorcut($href){/* +3 Overloads */
			$a=func_get_args();
			$ext = explode('.', $href);
			$rel = (isset($a[1]))?$a[1]: false;
			$type = (isset($a[2]))?$a[2]: false;
			$shortcut = ['shortcut icon', 'image/ico'];
			
			if(count($ext)>0 && $rel === false && $type === false){
				switch($ext[count($ext)-1]){
					case 'png':
						$shortcut = ['icon', 'image/png'];
						break;
						
					case 'jpg':
						$shortcut = ['icon', 'image/jpg'];
						break;
						
					case 'jpeg':
						$shortcut = ['icon', 'image/jpeg'];
						break;
						
					case 'gif':
						$shortcut = ['icon', 'image/gif'];
						break;
						
					case 'ico':
						$shortcut = ['shortcut icon', 'image/x-icon'];
						break;
					}
				}
				
			$shortcut[0] = ($rel!==false)?$rel: $shortcut[0];
			$shortcut[1] = ($type!==false)?$type: $shortcut[1];
			
			$this->__shorcut[$shortcut[1]] = $this->linktag('rel="'.$shortcut[0].'" type="'.$shortcut[1].'" href="'.$href.'" '.((isset($a[3]))?$a[3]:'').'');
			}
			
		public function _shorcut(){
			if(isset($this->__shorcut)){
				foreach($this->__shorcut as $link){
					$this->head(($link!==false)?$link:'');
					}
				}
			}
		
		
		
		
		
		
		
		
		
		
		
		/* JavaScript */
		public function callJSTheme($file){array_push($this->__javascript['call'], $this->_url . $file);return $this;}

		public function callJS($file){array_push($this->__javascript['call'], $file);return $this;}
		
		public function js($code){array_push($this->__javascript['code'], $code);return $this;}
		
		public function javascript($code){return $this->js($code);}
			
		public function _javascript(){/* +1 Overload */
			$a=func_get_args();
			$mode = strtolower((isset($a[0]))?$a[0]:'-all');
			$this->__javascript['call'] = (isset($this->__javascript['call']))?$this->__javascript['call']:array();
			$this->__javascript['code'] = (isset($this->__javascript['code']))?$this->__javascript['code']:array();
			if($mode=='-call' || $mode=='-all'){$this->javascriptGenerate('-src',(isset($this->__javascript['call']))?$this->__javascript['call']:array());}
			if($mode=='-code' || $mode=='-all'){$this->javascriptGenerate('-inner', (isset($this->__javascript['code']))?$this->__javascript['code']:array());}
			return $this;}
		
		public function javascriptGenerate($mode, $js){
			if(!is_array($js)){_GGN::wCnsl('DPO Générateur JavaScript: la donnée proposée doit être un tableau');}
			$mode = strtolower($mode);
			$body = '';
			for($x=0; $x<count($js); $x++){
				if($mode=='-src'){$body .= $this->scripttag(false,'type="text/javascript" src="'.$js[$x].'"');}
				if($mode=='-inner'){$body .= $js[$x];}
				}
			$body = ($mode=='-inner')? $this->scripttag($body,'type="text/javascript"'):$body;
			$this->body($body);
			return $this;}
		public function resetJS(){
			$this->__javascript['code'] = null;$this->__javascript['code'] = array(); 
			$this->__javascript['call'] = null;$this->__javascript['call'] = array(); 
			return $this;}
		
		
		
		
		
		
		
		
		
		
		/* Style CSS */
		public function callCSSTheme($file){array_push($this->__css['call'], $this->_url . $file);return $this;}

		public function callCSS($file){array_push($this->__css['call'], $file);return $this;}
			
		public function css($code){array_push($this->__css['code'], $code);return $this;}
			
		public function _css(){/* +1 Overload */
			$a=func_get_args();
			$mode = strtolower((isset($a[0]))?$a[0]:'-all');
			$this->__css['call'] = (isset($this->__css['call']))?$this->__css['call']:array();
			$this->__css['code'] = (isset($this->__css['code']))?$this->__css['code']:array();
			if($mode=='-call' || $mode=='-all'){$this->cssGenerate('-src',(isset($this->__css['call']))?$this->__css['call']:array());}
			if($mode=='-code' || $mode=='-all'){$this->cssGenerate('-inner', (isset($this->__css['code']))?$this->__css['code']:array());}
			return $this;}
		
		public function cssGenerate($mode, $css){
			if(!is_array($css)){_GGN::wCnsl('DPO Générateur Style CSS: la donnée proposée doit être un tableau');}
			$mode = strtolower($mode);
			$head = '';
			for($x=0; $x<count($css); $x++){
				if($mode=='-src'){$head .= $this->linktag('rel="StyleSheet" type="text/css" href="'.$css[$x].'"');}
				if($mode=='-inner'){$head .= $css[$x];}
				}
			$head = ($mode=='-inner')? $this->styletag($head,'type="text/css"'):$head;
			$this->head($head);
			return $this;}
		public function resetCSS(){
			$this->__css['code'] = null;$this->__css['code'] = array(); 
			$this->__css['call'] = null;$this->__css['call'] = array(); 
			return $this;}
			
			
			
			
			
			
			
			
			
		/* Package JS de Gougnon */
		public function jsPackage($pkg){array_push($this->__jsPackages, $pkg); return $this;}
		
		public function jsPackages(){ /* +00 Overloads */
			$a = func_get_args();for($x=0; $x<count($a); $x++){$this->jsPackage($a[$x]);} return $this;}
			
		public function _jsPackages(){/* +1 Overload */
			$a = func_get_args();
			$count=count($this->__jsPackages);
			$pkgs = ((isset($a[0]))?$a[0]:HTTP_HOST)
				. '' . $this->JSFramework . '?version=' . $this->JSFrameworkVersion . '&api=' . (($count>0)?',':'') . implode(',', $this->__jsPackages) 
				. '&style=' . $this->packageStyle. '' . '&responsivity=' . (($this->responsivity===true)?'1':'0'). '';
			$this->body($this->scripttag(false, 'type="text/javascript" src="'.$pkgs.'" id="ggn-js-framework-packages" '));
			return $this;}
		
		
		
		
		
		
		
		/* Package CSS de Gougnon */
		public function cssPackage($pkg){array_push($this->__cssPackages, $pkg); return $this;}
		
		public function cssPackages(){ /* +00 Overloads */
			$a = func_get_args();for($x=0; $x<count($a); $x++){$this->cssPackage($a[$x]);} return $this;}
			
		public function _cssPackages(){/* +1 Overload */
			$a = func_get_args();
			$count=count($this->__cssPackages);
			$pkgs = ((isset($a[0]))?$a[0]:HTTP_HOST) 
				. '' . $this->CSSFramework . '?version=' . $this->CSSFrameworkVersion . '&api=' . (($count>0)?',':'') . implode(',', $this->__cssPackages) 
				. '&style=' . $this->packageStyle. '' . '&responsivity=' . (($this->responsivity===true)?'1':'0'). '';
			$this->head($this->linktag('rel="StyleSheet" type="text/css" href="'.$pkgs.'" id="ggn-css-framework-packages"'));
			return $this;}
		
		

		public function mergeMenu($instance){
			
			if(is_object($instance)){

				if(isset($instance->Menus) && isset($instance->Name)){

					if(is_array($instance->Menus)){

						if(isset($instance->Menus[$instance->Name])){
							$this->menu[$instance->Name] = $instance->Menus[$instance->Name];
						}

					}

				}
			}

			return $this;
		}
			




		
		
		/* FUNCTIONS de base */
		public static function getCoreDir(){
			return dirname(__FILE__) . '/';	
		}


		
		public static function functionsDir($function, $mode){
			return self::getCoreDir() . '/' . self::FUNCTIONS_STORE . $mode . '/' . self::CPREF . '.' . $function . '.' . self::CSUF;
		}


		
		public static function isFunction($function, $mode){
			$f = self::functionsDir($function, $mode);
			return (is_file($f)?$f:false);
		}


		
		public static function loadFunction($function, $args, $mode, $context){
			global $Gougnon, $GLANG;

			$is = self::isFunction($function, $mode);
			$return = null;

			if(is_string($is)){include $is; }
			else{_GGN::wCnsl("<h1>" . self::NAME . "</h1> la méthode <b>" . ($function) . "</b> n'existe pas en mode <b>" . $mode . "</b> "); }

			return $return;
		}
			
			
			
		public static function __callStatic($function,$args){
			return self::loadFunction($function, $args, '~statics', false);
		}
			
			
			
		public function __call($function,$args){
			return self::loadFunction($function, $args, '~dynamics', $this);
		}
			


		
	}
		
		
	 
}








/* DPO Add On */
if(!class_exists('DPOAddOn')){


	class DPOAddOn {

		var $Menus=array();
		var $MenuName=false;

		var $Sliders=array();
		var $SliderName=false;


		public function __construct(){
			$this->arguments = func_get_args();
		}



		/* Addon Slider */
		public function Slider(){
			if(isset($this->arguments[0])){
				if(is_string($this->arguments[0])){
					$this->Name = $this->arguments[0];
					$this->Sliders[$this->Name] = func_get_args();
				}
			}
			return $this;
		}




		/* Addon Menu */
		public function Menu(){
			if(isset($this->arguments[0])){
				if(is_string($this->arguments[0])){
					$this->Name = $this->arguments[0];
					$this->Menus[$this->Name] = array();
					$this->Menus[$this->Name]['PARENT'] = func_get_args();
					$this->Menus[$this->Name]['CHILDREN'] = array();
				}
			}
			return $this;
		}

		public function addMenuItem(){
			$this->Menus[$this->Name]['CHILDREN'][] = func_get_args();
		}






	}




}












/* DPO Browser Device */
if(!class_exists('DPODevice')){




class DPODevice
{
	
	public $userAgent;
	public $accept;
	public $current;
	public $name;
	
	protected $mobileDevices = [
		"android" => "android.*mobile"
		, "androidtablet" => "android(?!.*mobile)"
		, "blackberry" => "blackberry"
		, "blackberrytablet" => "rim tablet os"
		, "iphone" => "(iphone|ipod)"
		, "ipad" => "(ipad)"
		, "palm" => "(avantgo|blazer|elaine|hiptop|palm|plucker|xiino)"
		, "windows" => "windows ce; (iemobile|ppc|smartphone)"
		, "windowsphone" => "windows phone os"
		, "generic" => "(cldc|docomo|novarra|reqwirelessweb|kindle|mobile|mmp|midp|pocket|psp|symbian|smartphone|treo|up.browser|up.link|vodafone|wap|opera mini)"
		];

	protected $computerDevices = [
		"msie" => "msie|trident"
		, "firefox" => "firefox"
		, "opera" => "opera"
		, "opera" => "opr"
		, "chrome" => "chrome"
		, "safari" => "safari"
		, "flock" => "flock"
		, "netscape" => "netscape"
		];

	
	/* -m: mobile; -c: Ordinateur; -u: indefini */
	public function __construct(){
		$this->userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
		$this->accept = strtolower($_SERVER['HTTP_ACCEPT']);
		$this->current = ($this->isMobileDevice())?'-m':(($this->isComputerDevice())?'-c':'-u');
			
		if (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
			$this->current = '-m';}
			
		elseif(strpos($this->accept, 'text/vnd.wap.wml') > 0 || strpos($this->accept, 'application/vnd.wap.xbody+xml') > 0) {
			$this->current = '-m';
			} 
		else{}
			
		}
		
		
		
	public function get($device){return substr_count($this->userAgent, strtolower($device))>0?true:false;}

	
	/* Mozilla */
	public function isMozilla(){return $this->get('mozilla');}
	public function isGecko(){return $this->get('gecko');}
	public function isLikeGecko(){return $this->get('like gecko');}
	
	
	
	/* AppleWebkit */
	public function isKhtml(){return $this->get('khtml');}
	public function isWebkit(){return $this->get('webkit');}
	public function isAppleWebkit(){return $this->get('applewebkit');}
	
	
	/* Microsoft Internet Explorer */
	public function isIE(){return $this->get('trident/')||$this->get('msie')||$this->get('Microsoft Internet Explorer');}
	public function isIE7(){return $this->get('msie 7');}
	public function isIE8(){return $this->get('msie 8');}
	public function isIE9(){return $this->get('msie 9');}
	public function isIE10(){return $this->get('msie 10');}
	public function isIE11(){return $this->isIE()&&$this->get('rv:11');}
	public function isIEMobile(){return $this->get('iemobile');}
	public function isXbox(){return $this->get('xbox');}
	public function isXboxOne(){return $this->get('xboxOne');}
		
		
		
	/* Detection Navigateur Ordinateur */
	protected function isComputerDevice(){
		$return = false;
		foreach($this->computerDevices as $device => $agent){
			if($this->detectComputerDevice($device)===true){
				$this->name = $device;
				$return = true;
				break;
				}
			}
		return $return;
		}
		
	public function detectComputerDevice($device){
		return (isset($this->computerDevices[$device]))?((preg_match('/'.$this->computerDevices[$device].'/i', $this->userAgent))?true: false):false;
		}
		
		
		
		
	/* Detection Navigateur Mobile */
	protected function isMobileDevice(){
		$return = false;
		foreach($this->mobileDevices as $device => $agent){
			if($this->detectMobileDevice($device)===true){
				$this->name = $device;
				$return = true;
				break;
				}
			}
		return $return;
		}
		
	public function detectMobileDevice($device){
		return (isset($this->mobileDevices[$device]))?((preg_match('/'.$this->mobileDevices[$device].'/i', $this->userAgent))?true: false):false;
		}
		
		
		
		
		
	/* Detection */
	public function __call($name, $args){
		$device = strtolower(substr($name, 2));
		return (isset($this->mobileDevices[$device]))?$this->detectMobileDevice($device): ((isset($this->computerDevices[$device]))?$this->detectComputerDevice($device): 'undefined');
		}
		
		
		
	}
}






 
 
?>