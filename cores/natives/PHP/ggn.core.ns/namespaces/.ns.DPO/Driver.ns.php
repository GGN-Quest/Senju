<?php

	/**
	 * GGN DPO Driver
	 *
	 * @version 2.2
	 * @update 150910.0900
	 * @Require Gougnon Framework
	*/




/*
	Nom de l'espace
*/
namespace GGN\DPO;
	


	if(!class_exists('\GGN\DPO\Driver')){
			
		Class Driver extends Invoke{

			const NAME = 'Gougnon DPO Driver';
			
			const VERSION = '2.2';
			
			const UPDATE = '170213.0833';


			const __MANIFEST = '.manifest';
			
			const __Ext = '.php';
			
			const _Ext = '.dpo';
			
			
			var $menu=array();
			
			var $title = false;
			var $__shortcut = array();
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
			var $packagePalette = false;

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
				$this->CSSCore = \_GGN::CSSCore('ggn.core');
				
				$this->__javascript['call'] = array();
				$this->__javascript['code'] = array();
				
				$this->__css['call'] = array();
				$this->__css['code'] = array();


				}
			
			public function devices(){return new Device();}
			// public function getJoinsEngine($path){return new DPOJoinsEngine($path);}
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
					if(!is_file($this->_manifest)){\_GGN::wCnsl('<h1>DPO</h1>Erreur : Le manifest du thème spécifié est introuvable');}
						$this->manifest = array();
							include $this->_manifest;
				return $this->manifest;
			}
				
			public function load(){/* +1 Overload */
				$this->param['theme'] = func_get_args();
				$this->_theme = (isset($this->param['theme'][0]))? $this->param['theme'][0]:false;
				
					if($this->_theme===false){\_GGN::wCnsl('<h1>DPO</h1>Erreur : Thème non definie');}
				
				$this->themeFolder = $this->_themeFolder . $this->_theme;
					if(!is_dir($this->themeFolder)){ \_GGN::wCnsl('<h1>DPO</h1>Erreur : Le thème spécifié est introuvable');}
				$this->themeFolder .= ((substr($this->themeFolder, -1)=='/')?'': '/');
				$this->loadManifest();
				
				return $this;
			}
			
			
			
			
			/* Briques du thème */
			public function brique($part){/* 2 Overload */
				$this->arguments[$part] = $arguments = func_get_args(); 
				$de = ($this->device->current=='-c')?'computer':'mobile';
				$de = ((!isset($this->manifest[$de][$part]))?'computer':$de);
					if(!isset($this->manifest[$de][$part])){ \_GGN::wCnsl('<h1>DPO</h1>Erreur : La partie du thème spécifiée est introuvable "' . $part . '"');}
				$f = $this->themeFolder . $this->manifest[$de]['prefixe'].$this->manifest[$de][$part].self::_Ext.self::__Ext;
					if(!isset($this->manifest[$de])){\_GGN::wCnsl('<h1>DPO</h1>Erreur : Le mode la partie du thème spécifiée est introuvable ' . $this->manifest[$de]);}
					if(!is_file($f)){\_GGN::wCnsl('<h1>DPO</h1>Erreur : La partie du thème spécifiée est introuvable "' . $part . '"');}
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
			// 	if(!is_file($f)){\_GGN::wCnsl('<h1>DPO</h1>L\'application du thème spécifié est introuvable');}
					
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
			
			public function write($string){\_GGN::write($string);}
			
			// public function html($string){array_push($this->_html, $string);return $this;}
			public function html($name, $string = ''){

				if(is_string($name)){$this->_html[$name] = $string; }

				else if(is_array($name)){
					foreach ($name as $key => $value) {

						if(is_string($value)){$this->_html[$key] = $value;}

					}
				}

				return $this;
			}
			
			public function htmlAttribute($string){return $this->html($string);}
			
			public function body($string, $return = false){array_push($this->_body, $string);return ($return===true) ? $string : $this;}
			public function bodyAttrib($name, $string){$this->_bodyAttrib[$name] = $string;return $this;}
			
			public function head($string){array_push($this->_head, $string);return $this;}
			public function headAttrib($name, $string){$this->_headAttrib[$name] = $string;return $this;}

			
			
			
			/* title de la page */
			public function _title(){/* +1 Overload */
				$a=func_get_args();
				if(isset($this->title)){$this->head(($this->title!==false)?'<title>'.$this->title.((isset($a[0]))?$a[0]:'').'</title>':'');}
				}
			
			
			
			
			/* Génération de la page */
			public function generate($return = false){
				if($return==true){
					return $this->returnCodeGenerated();
				}
				else{
					self::write($this->returnCodeGenerated());
				}
			}
			
			
			/* Génération du code final de la page */
			public function returnCodeGenerated(){
				$code = '';
				$htmlattrib = '';
				$battrib = '';
				$hattrib = '';
				
				$code .= ('<!-- Native de '.self::NAME.' '.self::VERSION.' (update:'.self::UPDATE.') -->');
				foreach($this->_doctype as $doctype){$code .= ('<!DOCTYPE ' . $doctype . '>');}
				foreach($this->_bodyAttrib as $attrib => $value){$battrib .= ' ' . $attrib . '="' . \Render::toJSDocWrite($value) . '" '; }
				foreach($this->_headAttrib as $attrib => $value){$hattrib .= ' ' . $attrib . '="' . \Render::toJSDocWrite($value) . '" '; }
				foreach($this->_html as $attrib => $value){$htmlattrib .= ' ' . $attrib . '="' . \Render::toJSDocWrite($value) . '" '; }
				
				$code .= ('<html' . $htmlattrib . '>');
				$code .= ('<head' . $hattrib . '>' . implode('', $this->_head) . '</head>');
				$code .= ('<body' . $battrib . '>' . implode('', $this->_body) . '</body>');
				$code .= ('</html>');
				$code .= ('<!-- '.\Gougnon::NAME.'/'.\Gougnon::VERSION.' (rv:'.\Gougnon::REEL_VERSION.') -->');

				return $code;
			}
			
			
			/* Génération de la page dans le corps */
			public function generateInnerBody($return = false){

				$code = '';
				$code .= ('<!-- Native de '.self::NAME.' '.self::VERSION.' (update:'.self::UPDATE.') -->');
				$code .= (implode('', $this->_body));
				$code .= ('<!-- '.\Gougnon::NAME.'/'.\Gougnon::VERSION.' (rv:'.\Gougnon::REEL_VERSION.') -->');

				if($return==true){ return $code;}
				else{ self::write($code);}
			}
			
			
			/* Génération de la page dans l'entête */
			public function generateInnerHead($return = false){

				$code = '';
				$code .= ('<!-- Native de '.self::NAME.' '.self::VERSION.' (update:'.self::UPDATE.') -->');
				$code .= (implode('', $this->_head));
				$code .= ('<!-- '.\Gougnon::NAME.'/'.\Gougnon::VERSION.' (rv:'.\Gougnon::REEL_VERSION.') -->');

				if($return==true){ return $code;}
				else{ self::write($code);}
			}
			
			
			
			
			/* Meta */
			public function meta(){/* +4 Overloads */
				$a=func_get_args(); $a=(is_array($a[0]))?$a[0]:$a;

				$this->__meta[strtoupper($a[0])][strtoupper($a[1])] = (isset($a[2]))?$a[2]:''; 
				$this->__metaAttrib[strtoupper($a[0].'_'.$a[1])]=(isset($a[3]))?$a[3]:''; 
			}
				
			public function _meta(){$r=''; 
				foreach($this->__meta as $type => $m){ $t=$m;foreach($t as $n => $v){ $attr = $this->__metaAttrib[strtoupper($type.'_'.$n)]; $r .= $this->metatag(strtolower($type).'="'.strtolower($n).'" '.((!\Gougnon::isEmpty($v))? 'content="'.($v).'" ':'').''.$attr);}} $this->head($r); 
				}
				
				
				
			/* Icon Shortcut */
			public function shortcut($href, $rel = false, $type = false){/* +3 Overloads */
				$a=func_get_args();
				$ext = explode('.', $href);

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
				
				$this->__shortcut[$shortcut[1]] = $this->linktag('rel="'.$shortcut[0].'" sizes="192x192" type="'.$shortcut[1].'" href="'.$href.'" '.((isset($a[3]))?$a[3]:'').'');
				}
				
			public function _shortcut(){
				if(isset($this->__shortcut)){
					foreach($this->__shortcut as $link){
						$this->head(($link!==false)?$link:'');
						}
					}
				}
			
			
			
			
			
			
			
			
			
			
			
			/* JavaScript */
			public function callJSTheme($file = false){if(is_string($file)){array_push($this->__javascript['call'], $this->_url . $file);}return $this;}

			public function callJS($file = false){array_push($this->__javascript['call'], $file);return $this;}
			
			public function js($code = false){
				if(is_array($code)){foreach ($code as $value) {array_push($this->__javascript['code'], $value); } }
				if(is_string($code)){array_push($this->__javascript['code'], $code); }
				return $this;
			}
			
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
				if(!is_array($js)){\_GGN::wCnsl('<h1>DPO</h1>DPO Générateur JavaScript: la donnée proposée doit être un tableau');}
				$mode = strtolower($mode);
				$body = '';
				for($x=0; $x<count($js); $x++){
					if($mode=='-src'){
						if(is_array($js[$x])){
							$string = '';
							foreach ($js[$x] as $key => $value) {if(is_string($value)){$string .= ' ' . $key . '="' . $value . '"';} }

							$body .= $this->scripttag(false, $string);
						}
						else{
							if(is_string($js[$x])){
								$body .= $this->scripttag(false,'type="text/javascript" src="'.$js[$x].'"');
							}
						}
					}
					if($mode=='-inner'){$body .= $js[$x];}
					}
				$body = ($mode=='-inner')? $this->scripttag($body,'type="text/javascript"'):$body;
				$this->body($body);
				return $this;
			}

			public function resetJS(){
				$this->__javascript['code'] = null;$this->__javascript['code'] = array(); 
				$this->__javascript['call'] = null;$this->__javascript['call'] = array(); 
				return $this;
			}
			
			
			
			
			
			
			
			
			
			
			/* Style CSS */
			public function callCSSTheme($file = false){if(is_string($file)){array_push($this->__css['call'], $this->_url . $file);}return $this;}

			public function callCSS($file = false){array_push($this->__css['call'], $file);return $this;}
				
			public function style($code = false){array_push($this->__css['code'], $code);return $this;}
				
			public function _css(){/* +1 Overload */
				$a=func_get_args();
				$mode = strtolower((isset($a[0]))?$a[0]:'-all');
				$this->__css['call'] = (isset($this->__css['call']))?$this->__css['call']:array();
				$this->__css['code'] = (isset($this->__css['code']))?$this->__css['code']:array();
				if($mode=='-call' || $mode=='-all'){$this->cssGenerate('-src',(isset($this->__css['call']))?$this->__css['call']:array());}
				if($mode=='-code' || $mode=='-all'){$this->cssGenerate('-inner', (isset($this->__css['code']))?$this->__css['code']:array());}
				return $this;}
			
			public function cssGenerate($mode, $css){
				if(!is_array($css)){\_GGN::wCnsl('<h1>DPO</h1>DPO Générateur Style CSS: la donnée proposée doit être un array');}
				$mode = strtolower($mode);
				$head = '';
				for($x=0; $x<count($css); $x++){
					if($mode=='-src'){
						if(is_array($css[$x])){
							$string = '';
							foreach ($css[$x] as $key => $value) {if(is_string($value)){$string .= ' ' . $key . '="' . $value . '"';} }
							$head .= $this->linktag($string);
						}
						else{
							if(is_string($css[$x])){
								$head .= $this->linktag('rel="StyleSheet" type="text/css" href="'.$css[$x].'"');
							}
						}
					}

					if($mode=='-inner'){
						if(is_array($css[$x])){
							foreach ($css[$x] as $n => $c) {
								$head .= (new \GougnonCSS())->selector($n, $c, true);
							}
						}
						else{
							if(is_string($css[$x])){
								$head .= $css[$x];
							}
						}
					}
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

				$this->__jsPackages = \Gougnon::arrayPurges($this->__jsPackages, true);

				$count=count($this->__jsPackages);
				$pkgs = ((isset($a[0]))?$a[0]:HTTP_HOST)
					. '' . $this->JSFramework . '?version=' . $this->JSFrameworkVersion . '&api=' . (($count>0)?',':'') . implode(',', $this->__jsPackages) 
					. '&style=' . $this->packageStyle. '' . (is_string($this->packagePalette) ? '&palette=' . ($this->packagePalette) : '' ) . '&responsivity=' . (($this->responsivity===true)?'1':'0'). '';
				$this->body($this->scripttag(false, 'type="text/javascript" src="'.$pkgs.'" id="ggn-js-framework-packages" '));
				return $this;}
			
			
			
			
			
			
			
			/* Package CSS de Gougnon */
			public function cssPackage($pkg){array_push($this->__cssPackages, $pkg); return $this;}
			
			public function cssPackages(){ /* +00 Overloads */
				$a = func_get_args();for($x=0; $x<count($a); $x++){$this->cssPackage($a[$x]);} return $this;}
				
			public function _cssPackages(){/* +1 Overload */
				$a = func_get_args();

				$this->__cssPackages = \Gougnon::arrayPurges($this->__cssPackages, true);

				$count=count($this->__cssPackages);

				$pkgs = ((isset($a[0]))?$a[0]:HTTP_HOST) 
					. '' . $this->CSSFramework . '?version=' . $this->CSSFrameworkVersion . '&api=' . (($count>0)?',':'') . implode(',', $this->__cssPackages) 
					. '&style=' . $this->packageStyle. '' . (is_string($this->packagePalette) ? '&palette=' . ($this->packagePalette) : '' ) .  '&responsivity=' . (($this->responsivity===true)?'1':'0'). '';
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
			






			





		}


	}







	if(!class_exists('\GGN\DPO\Util')){
			
		Class Util extends Driver{


			/* Attributs de balise HTML */
			static public function setAttributes($object = false){

				$attrib = false;

				$style = [];

				if(is_object($object) || is_array($object)){

					$attrib = '';

					foreach ($object as $n => $v) {

						/* Attribts simple */
						if(is_string($v)){

							// $hasAdmin = ();

							$attrib .= $n . '="' . $v . '" '; 

						}

						/* Attribts particulier */
						else{


							/* Attribts "SIZE" */
							if(strtolower($n)=='size' && (is_array($v) || is_object($v)) ){
								
								/* Largeur */
								if(isset($v[0]) && is_string($v[0])){

									$style['width'] = 'width:' . $v[0] . '; ';

								}
								
								/* Hauteur */
								if(isset($v[1]) && is_string($v[1])){

									$style['height'] = 'height:' . $v[1] . '; ';
									
								}
								
							}
							/* Attribts "SIZE" - FIN */


							/* Attribts "STYLE" */
							if(strtolower($n)=='style' && (is_array($v) || is_object($v)) ){
								
								array_push($style, (new \GougnonCSS())->selector(false, $v, '-Value.Only'));
								
							}
							/* Attribts "STYLE" - FIN */



						}

					}

				}


				/* Génération du style */
				if(count($style)>0){
					
					$attrib .= 'style="' . implode('', $style) . '"';

				}

				return rtrim($attrib);

			}


		}

	}


?>