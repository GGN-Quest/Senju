<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS Gougnon
	PAGE cores/_GGNs/CSS/ggn.core/.class.php
======================================================

*/


// if(!class_exists('CSS3')){Gougnon::loadPlugins('PHP/CSS.3');} //removed
	
	
	
	
class GougnonCSS
{

	/* INFOS */
	
	CONST NAME = 'Gougnon CSS Framework';
	
	CONST VERSION = '0.1';
	
	CONST REEL_VERSION = '0.1.160316.1025';
	
	CONST TYPE = 'CSS.CORE';
	
	
	
	
	
	
	
	
	/* RESSOURCES */
	
	CONST CPREF = 'function';
	
	CONST FUNCTIONS_STORE = 'functions/';
	
	CONST CSUF = 'CSSCore.php';



	CONST CPREP = 'api';

	CONST PACKAGES_STORE = 'APIs/';

	CONST CSUP = 'CSSCore.pkg.php';



	CONST CPRES = 'style';

	CONST STYLES_STORE = 'styles';

	CONST CSUS = 'CSSCore.stl.php';




	CONST CPRET = 'tone';

	CONST TONES_STORE = 'tones';

	CONST CSUT = 'CSSCore.tn.php';

	

	CONST DEFEULT_FRAMEWORK = 'nightly.0.1';

	CONST FPREP = 'framework';

	CONST FRAMEWORK_STORE = 'frameworks/';

	CONST FSUP = 'php';


	
	/* PREDEFINIE */

		/* Styles et Tons */
		CONST STYLE = 'ggn';

		CONST TONE = 'dark';

		CONST COLOR_PATTERN = 'primary,secondary,tertiary,quaternary';

		CONST COLOR_PATTERN_AUTO_VARIATION = 30;

	





	/* Media Queries : Largeur d'Ecran, update(160219.0933) */
	
	CONST SCREEN_Mi_MIN = '320px';

	CONST SCREEN_Mi_MAX = '480px';



	CONST SCREEN_Li_MIN = '481px';

	CONST SCREEN_Li_MAX = '767px';



	CONST SCREEN_S_MIN = '768px';

	CONST SCREEN_S_MAX = '979px';



	CONST SCREEN_M_MIN = '980px';

	CONST SCREEN_M_MAX = '1279px';



	CONST SCREEN_L_MIN = '1280px';

	CONST SCREEN_L_MAX = '1919px';



	CONST SCREEN_F_MIN = '1920px';

	CONST SCREEN_F_MAX = '2049px';



	CONST SCREEN_2k_MIN = '2050px';

	CONST SCREEN_2k_MAX = '4095px';



	CONST SCREEN_4k_MIN = '4096px';

	CONST SCREEN_4k_MAX = '7679px';



	CONST SCREEN_8k_MIN = '7680px';

	// CONST SCREEN_8k_MAX = 'px';

	
	
	



	
	




	/* Utils */
		var $_OnEvents = ['Name'=>[], 'Exec'=>[]];
	
	




	/* PREDEFINIE */
	
		/* Selecteurs CSS */
		var $___CodesToGenerate = [];



		/* Styles et Tons */
		var $styleProperties = [];








	
	
	/* CONSTRUCTEUR */
	
	public function __construct(){
	
		$this->PARAM = func_get_args();
	
	}
		
	
	
	/* FUNCTIONS */
	
	public static function getCoreFolder(){
	
		return dirname(__FILE__) . '/';	
	
	}
	
	public static function commonFile($file){
	
		$f = self::getCoreFolder() . 'common/' . $file . '.php';
	
		if(is_file($f)){return $f;}
	
		return false;
	
	}
		
		
		
	public static function __callStatic($F,$A){
	
		return self::loadNewFunction($F,$A, '-s');	
	
	}
		
		
		
	public function __call($F,$A){
	
		$this->loadNewFunction($F,$A, '-d');	
	
	}
		
		
	protected static function loadNewFunction($func,$args,$calledMode){
	
		global $Gougnon, $GLANG;
	

	
		$funcCompo = dirname(__FILE__) . '/' . self::FUNCTIONS_STORE . self::CPREF . '.' . $func . '.' . self::CSUF;
	
		if(file_exists($funcCompo)){
	
			if($calledMode == '-s'){ return include $funcCompo; }
	
			if($calledMode == '-d'){ include $funcCompo; }
	
		 }
	
		if(!file_exists($funcCompo)){ _GGN::wCnsl("Erreur: <b>" . ($func) . "</b> n'existe pas"); }
	
	}
		
		
		
	/*
		Chemin du Dossier contenant la classe, update(160203.1135)
	*/
	public function Dir($path = false){ return dirname(__FILE__) . (is_string($path) ? '/' . $path: '' ) . '/' ; }
		
		
			
		
		
	/*
		Declaration des evenements, update(160203.1135)
	*/
	public function ExecuteOn($name = false, $args = false){

		$name = strtoupper($name);




		if(is_array($this->_OnEvents) 

			&& isset($this->_OnEvents['Name']) && is_array($this->_OnEvents['Name'])

			&& isset($this->_OnEvents['Exec']) && is_array($this->_OnEvents['Exec'])

		){

			$Names = $this->_OnEvents['Name'];

			$Exectors = $this->_OnEvents['Exec'];


			foreach ($Names as $k => $n) {

				if(strtoupper($name) == $n && is_callable($Exectors[$k])){

					$Exectors[$k]($this, $args);

				}
				
			}

		}

	}
		
		
			
		
		
	/*
		Declaration des evenements, update(160203.1135)
	*/
	public function On($name = false, $exec = false){

		if(is_string($name) && is_callable($exec)

			&& isset($this->_OnEvents['Name']) && is_array($this->_OnEvents['Name'])

			&& isset($this->_OnEvents['Exec']) && is_array($this->_OnEvents['Exec'])

		){

			array_push($this->_OnEvents['Name'], strtoupper($name));

			array_push($this->_OnEvents['Exec'], $exec);

		}

	}
		
		

		
	/*
		Ajout de couleur pour definir une palette (exemple : $patt = "couleur-1,couleur-2,couleur-3,couleur-4")
	*/
	public function ToPalette($patt = false){


		if(is_string($patt) && !Gougnon::isEmpty($patt)){


			/* 
				Nouvelle palette de couleur
			*/

			$pattern = [];
			
			$clientPattern = explode(',', $patt);

			$firstPatternColor = $clientPattern[0];

			$patternColorIntensity = self::GetColorIntensity($firstPatternColor);


			/* 
				Assignation des couleur dans la nouvelle palette de couleur
			*/
			foreach (explode(',', self::COLOR_PATTERN) as $k => $index) {

				/* 
					Si aucune couleur n'est assigné 
				*/
					$i = 'palette-' . trim(rtrim(ltrim($index))) . '-color';



				/* 
					Si on assigne une valeur à ce index
				*/
					if(isset($clientPattern[$k])){

						$pa = '#' . $clientPattern[$k];

					}


				/* 
					Si aucune couleur n'est assigné à ce index
				*/
					else{

						$coef = ($patternColorIntensity->is==true) ? 1 : -1;

						$pa = self::LDColor($firstPatternColor, $coef * ( $k * self::COLOR_PATTERN_AUTO_VARIATION ) );

					}

				/* 
					Assignation 
				*/
					$pattern[$i] = $pa;

			}



			/* 
				Fusionner aux propriete du style au moment de la construction du "Style"
			*/

				$this->On('BuildStyles', function($instance) use ($pattern){

					// var_dump($pattern); exit;

					$instance->ToStyles($pattern);

				});


		}
	

	}
		
		
		

		
	/*
		Ajouter des propriétés à ceux du style, update(160203.1202)
	*/
	public function ToStyles($array = false){ if(is_array($array)){foreach ($array as $k => $data) {$this->styleProperties[$k] = $data; }} return $this->styleProperties; }
		
		
		
	/*
		Chemin du Dossier contenant la classe, update(160203.1135)
	*/
	public function Tone( $t = false){
	
		$tone = array();
	
		$args = func_get_args();
	
		$tn = (is_string($t))? $t : self::TONE;
	
	
		$toneFile =  self::Dir(self::TONES_STORE) . self::CPRET . '.' . $tn . '.' . self::CSUT;
	
		$defaultTone = self::Dir(self::TONES_STORE) . self::CPRET . '.' . self::TONE . '.' . self::CSUT;
	

	
		if(is_file($toneFile)){ include $toneFile; }
	
		if(!is_file($toneFile)){ 
	
			if(is_file($defaultTone)){include $defaultTone;}
	
		}
	

	
		/* Ajout aux propriété du style */

		$this->ToStyles($tone);

		return $tone;
		
	}
		
		
		
		
	public function Style(){
	
		$style = array();
	
		$args = func_get_args();
	
		$dfStyle = (isset($args[0]))?$args[0]: self::STYLE;

		$toneName = self::TONE;

		$StyleName = $dfStyle;
		
		$Expl = explode(':', $dfStyle);

		$hasTone = count($Expl) == 2;



		/* Application "TON" s'il exist */
		if($hasTone===TRUE){

			$StyleName = ( !\Gougnon::isEmpty($Expl[1]) ) ? $Expl[1] : false;

			$toneName = $Expl[0];

			$this->Tone($toneName);

		}


		// var_dump($toneName); 

		// var_dump($StyleName); 
		
		// var_dump($hasTone); 

		// exit;


	
		$stylCompo = self::Dir(self::STYLES_STORE) . self::CPRES . '.' . $StyleName . '.' . self::CSUS;
	
		$dStylCompo = self::Dir(self::STYLES_STORE) . self::CPRES . '.' . self::STYLE . '.' . self::CSUS;
	



		if(is_file($stylCompo)){ include $stylCompo; }
	
		if(!is_file($stylCompo)){ 
	
			if(is_file($dStylCompo)){include $dStylCompo;}
	
		}




		/* Ajout aux propriété du style */

		$this->ToStyles($style);


		$this->ExecuteOn('BuildStyles', [$StyleName, $toneName] );



		if(is_array($this->styleProperties)){

			foreach ($this->styleProperties as $key => $value) {

				$k = explode(':', $key);

				$n = (isset($k[0])) ? $k[0]: '';

				$ne = explode('-',$n);

				$lk = count($ne);

				$nm = (isset($ne[$lk-1])) ? $ne[$lk-1]: '';



				if($nm == 'color' && is_string($value)){

					$nks = [];

					for ($i=1;$i<count($k); $i++) {$nks[$i] = $k[$i]; }

					$nk = $n . '-rgb' . ( (!empty($nks)) ? ':' . ( implode(':', $nks) ) : '');

					$this->styleProperties[$nk] = self::toRGB($value);

				}

			}


		}
		
		return $this->styleProperties;
		
	}
		
		
		
	public function ColorsToParam(){

		$C = [];

		foreach ($this->styleProperties as $key => $value) {

			$k = explode(':', $key);

			$n = (isset($k[0])) ? $k[0]: '';

			$ne = explode('-',$n);

			$lk = count($ne);

			$nm = (isset($ne[$lk-1])) ? $ne[$lk-1]: '';


			if($nm == 'color' && is_string($value)){

				$C[$n] = $this->RGBToParam( $this->styleProperty($n . '-rgb') );

			}	
			
		}


		$this->Colorize = $C;
		
		return $this;
		
	}
		
		
		
	public function styleProperty($property){
	
		return (!is_array($this->styleProperties))?'': ((isset($this->styleProperties[$property]))? $this->styleProperties[$property]:'');
	
	}
		
		
		
	public function getStylePath($StyleName){
		
		if(!Gougnon::isEmpty($StyleName)){

			return self::Dir(self::STYLES_STORE) . self::CPRES . '.' . $StyleName . '.' . self::CSUS;
		}

		return false;
	
	}	
	
		
		
	public function getTonPath($tn){
		
		if(!Gougnon::isEmpty($tn)){

			return self::Dir(self::TONES_STORE) . self::CPRET . '.' . $tn . '.' . self::CSUT;
		}

		return false;
	
	}	
		
		
		
	public function getPackagePath($pkg){
		
		if(!Gougnon::isEmpty($pkg)){

			return dirname(__FILE__) . '/' . self::PACKAGES_STORE . self::CPREP . '.' . $pkg . '.' . self::CSUP;
		}

		return false;
	
	}	
		
		
		
	public function loadPackages($pkg, $option){
	
		global $Gougnon, $GLANG;
		
		if(!Gougnon::isEmpty($pkg)){

			$pkgCompo = self::getPackagePath($pkg);
	
			if(file_exists($pkgCompo)){$Core = $this; include $pkgCompo;}
	
			if(!file_exists($pkgCompo)){$this->Code("/* API introuvable : " . $pkg . " */"); }
	
		}
	
	}	
			
		
	public static function libraries($apin){
	
		global $Gougnon, $GLANG;
	
		$dir = dirname(__FILE__) . '/' . self::PACKAGES_STORE;
	
		$get = Gougnon::iScanFolder($dir);
	
		$args = func_get_args();
	
		$option = (isset($args[1]))?$args[1]:[];


		foreach ($get as $apib) {
		
			if(is_file($apib)){
		
				$path = dirname(substr($apib,strlen($dir)));
		
				$apia = basename($apib);
		
				$apid = self::CPREP . '.' . $apin;



				if(substr($apia, 0, strlen($apid))==$apid){

					$api = substr($apia, strlen(self::CPREP.'.'), -1*strlen('.'.self::CSUP));

					$path = ($path=='.')?'':$path.'/';



					if(strtolower($api)==strtolower($apin)){

					}

					else{

						$this->loadPackages($path.$api, $option);

					}

				}

			}

		}
		
	}	
	
		
		
	public function getFrameworkPath($version){
		
		if(!Gougnon::isEmpty($version)){

			return dirname(__FILE__) . '/' . self::FRAMEWORK_STORE . self::FPREP . '.' . $version . '.'  . self::FSUP;
		}

		return false;
	
	}	

			
	public function framework($version){
	
		global $Gougnon, $GLANG;
		
	
		if(!Gougnon::isEmpty($version)){
	
			$frwk = dirname(__FILE__) . '/' . self::FRAMEWORK_STORE . self::FPREP . '.' . $version . '.'  . self::FSUP;

			if(file_exists($frwk)){$Core = new self(); include $frwk;}

			if(!file_exists($frwk)){ return false; }

		}
			
	}	

		

	public static function loadDefaultFramework(){
	
		self::framework(self::DEFEULT_FRAMEWORK);
	
	}

	

	/* Outil de Couleur */
	static public function HEXtoRGB($code){return Gougnon::HEXtoRGB($code);}

	static public function toRGB($code){return implode(',',Gougnon::HEXtoRGB($code));}

	static public function RGBtoHEX($r,$g,$b){return Gougnon::RGBtoHEX($r,$g,$b);}
	
	static public function RGBToParam($rgb){return implode('|',explode(',',$rgb));}

	static public function toHEX($rgb){
	
		$c=explode(',',$rgb); 
	
			$r=isset($c[0])?$c[0]:''; 
	
			$g=isset($c[1])?$c[1]:''; 
	
			$b=isset($c[2])?$c[2]:''; 
	
		return implode(',',  Gougnon::RGBtoHEX($r,$g,$b));
	
	}
	





	/* Correction du code Hexa de la couleur, update(160204.1439) */
	static public function CorrectHexColor($hex){


		$shex = substr($hex, 0,1);
		
		$ihex = $shex=='#' ? substr($hex, 1) : $hex;
		
		$lenhex = strlen($ihex);

		return (
			($lenhex===3) ? '#' . $ihex . $ihex: 
				(($lenhex===2) ? '#' . $ihex . $ihex . $ihex : 
					($lenhex===1 ? '#' . $ihex . $ihex . $ihex . $ihex . $ihex . $ihex : substr($hex, 0,7) )
				)
		);


	}
	
	





	/* Obtenir l'intensité d'une couleur, update(160204.1439) */
	static public function GetColorIntensity($hex){

		/*
			Limit en les 2 seuils majeurs
		*/
		$median = 128; 


		/*
			Correction du code couleur
		*/
		$color = self::CorrectHexColor($hex);


		/*
			Conversion RVB
		*/
		$rgb = self::HEXtoRGB($color);


		/*
			Si la conversion est vérifiée
		*/
		if(is_array($rgb)){

			/*
				Compteurs de hit
			*/
				$dark = 0;

				$light = 0;

				$middle = 0;


			/*
				Comparaison : Verification des couleurs composantes
			*/
				foreach ($rgb as $k => $c) {
					
					if($c < $median){$dark +=$c;}
					
					if($c > $median){$light +=$c;}
					
					if($c == $median){$middle +=$c;}

				}


			$inst = new _GGNCustomObject([

				'dark'=>$dark

				,'light'=>$light

				,'middle'=>$middle

				// ,'is'=> ($dark > $light ? true : false)

				,'is'=> (($dark > $light && $dark > $middle) ? true : (($light > $middle) ? false: null))

			]);

			return $inst;

		}


		/*
			Sinon : echec
		*/
		else{

			return false;

		}
	

	}
	





	/* Obtenir une variante (foncé ou claire) d'une couleur, update(160204.1439) */
	static public function LDColor($hex, $coef = 10){

		/*
			Correction du code couleur
		*/
		$color = self::CorrectHexColor($hex);



		/* 
			Conversion en RVB
		*/
		$rgb = self::HEXtoRGB($color);


		/*
			Si la conversion est vérifiée
		*/
		if(is_array($rgb)){

			/*
				Initialisation de la nouvelle couleur
			*/
			$r = [0,0,0];

			/*
				Détermination de la variante
			*/
			foreach ($rgb as $k => $c) {

				$v = $c + $coef;

				$r[$k] = ($v<0) ? 0 : ( ($v>255) ? 255: $v); /* Regulation et assignation */

			}

			/*
				Re-conversion en Hexa
			*/
			return self::RGBtoHEX($r[0], $r[1], $r[2]);

		}

		/*
			Sinon : echec
		*/
		else{

			return false;

		}
	

	}
	










	/* Pour CSS3, update(160202.0750) */

	static public function _SELECTORS_PATTERN(){
	
		return [
	
			"/^transform/"
	
			, "/^transform-origin/"
	
			, "/^transition/"
	
			, "/^filter/"
	
			, "/^backface-visibility/"
	
			, "/^align-items/"
	
			, "/^justify-content/"
	
			// , "/flex/"
	
			, "/^flex-(.*)/"
	
			, "/^columns/"
	
			, "/^column-(.*)/"
	
			, "/^flex-direction/"
	
			, "/^opacity/"
			
			// , "/^user-select/"
	
			, "/^line-clamp/"
	
			, "/^box-orient/"
	
			, "/(.*)-radius/"
	
			, "/^border-image/"
	
			, "/(.*)-shadow/"
	
			, "/^animation/"
	
			, "/^background-clip/"
	
			, "/^background-origin/"
	
			, "/^background-size/"
	
			, "/(.*)-gradient/"
	
		];
	
	}






	static public function isCSS3Property($prop){
	
		$r = false;
	
		$p = self::_SELECTORS_PATTERN();


		foreach ($p as $key => $patt) {

			preg_match_all($patt, $prop, $out, PREG_PATTERN_ORDER);

			if(!isset($out[0])){continue;}

			if(!isset($out[0][0])){continue;}


			$r = $out[0][0];

			break;

		}

		return $r;

	}






	public function Code($data = ''){

		array_push($this->___CodesToGenerate, $data);

	}





	public function Build($ins = false){

		$r = implode('', $this->___CodesToGenerate);

		if($ins==false){

			echo $r;

		}
		
		if($ins==true){

			return $r;

		}


	}






	public function selector($selector, $value, $ins = false){

		$se=[];

		$CodeKey = ':::code';


		$IsNum = is_numeric($selector);



		if($IsNum){

			$_value = $value;

			foreach ($_value as $key => $val) {

				$selector = $key;

				$value = $val;
				
			}

		}


		$IsCode = (substr($selector, 0, strlen($CodeKey)) == $CodeKey);


		if($IsCode){

			array_push($se, $value);

		}


		if(!$IsCode){

			if(is_string($value)){
		
				array_push($se, $value . ';');
		
			}
			
		
			if(is_array($value)){
		
				foreach ($value as $k => $v) {
		
					$seli = str_replace(' ', '', $k);
		
					$c = explode('&&',  $seli);


					foreach ($c as $mv) {

						$gp = self::isCSS3Property($mv);

						if(is_string($gp)){

							if(is_array($v) && !empty($v)){

								foreach ($v as $vvl) {

									array_push($se, self::browserKey($gp, $vvl));

								}

							}

							else{

								if(is_string($v)){

									array_push($se, self::browserKey($gp, $v));

								}

							}


						}

						else{

							if(is_array($v) && !empty($v)){

								foreach ($v as $vvl) {

									array_push($se, $mv . ':' . $vvl . ';');

								}

							}

							else{

								if(is_string($v)){

									array_push($se, $mv . ':' . $v . ';');

								}

							}
							
						}

					}

				}

			}

		}


		/* Retour ou affichage */
		if(is_array($se)){

			$ret = ($IsCode) ? $value : (((is_string($selector)) ? $selector: '') . '{'.(implode('', $se)).'}');

			if($ins===true){

				return $ret;

			}

			else if($ins=='-Value.Only'){

				return implode('', $se);

			}
			
			else{

				$this->Code($ret);

			}

		}

		return $this;

	}

	
	public function viewport($properties){ 

		global $_DPO_DEVICE;
		
		$this->Code($this->selector('@viewport',$properties,true));

	}


	


	
	public function openMedia($properties, $return = false){ 

		$Code = '@media ' . $properties . ' {';
		
		if($return == false){

			$this->Code($Code);

		}

		else{

			return $Code;

		}

	}


	public function closeMedia($return = false){ 

		$Code = '}';
		
		if($return == false){

			$this->Code($Code);

		}

		else{

			return $Code;

		}


	}




	
	static public function iBrowserKey($property, $value){ 

		global $_DPO_DEVICE;

		$CSS = "";

		$gp = self::isCSS3Property($property);

		if(is_string($gp)){

			$CSS = self::browserKey($property, $value);

		}

		else{

			$CSS = $property.":".$value."; ";

		}

		return $CSS; 
	}
	



	
	static public function browserKey($property, $value){ 
	
		global $_DPO_DEVICE;

		$CSS = "";
	
		$dvc = $_DPO_DEVICE;
	
		$b=rtrim(ltrim(trim(CLIENT_BROWSER)));

	
	
		if($dvc->isGecko()||$dvc->isLikeGecko()){
	
			$CSS .= "-moz-".$property.":".$value."; "; 
	
		}
	
		if($b=='msie' || $dvc->isIE() || $dvc->get('edge') ){
	
			$CSS .= "-ms-".$property.":".$value."; "; 
	
		}
		if($dvc->isKhtml()){
	
			// $CSS .= "-khtml-".$property.":".$value."; "; 
	
		}

		if($b=='opera'){

			$CSS .= "-o-".$property.":".$value."; "; 

		}

		// if($dvc->isWebkit()||$dvc->isAppleWebkit()){

			$CSS .= "-webkit-".$property.":".$value."; "; 

		// }

		$CSS .= $property.":".$value."; ";

		return $CSS; 
	}
	





	public function keyframes($selector, $func){

		global $_DPO_DEVICE;

		$args = func_get_args();

		$CSS = "";

		$dvc = $_DPO_DEVICE;

		$b=rtrim(ltrim(trim(CLIENT_BROWSER)));

		$return = (isset($args[2]))?$args[2]:false;


		$CSS .= "@keyframes ".$selector . $func." "; 

		if($CSS){
			if($dvc->isWebkit()||$dvc->isAppleWebkit()){
				$CSS .= "@-webkit-keyframes ".$selector . $func." "; 
			}

			elseif($b=='opera'){
				// $CSS .= "@-o-keyframes ".$selector . $func." "; 
			}
			elseif($b=='msie'||$dvc->isIE()){
				$CSS .= "@-ms-keyframes ".$selector . $func." "; 
			}
			elseif($dvc->isGecko()||$dvc->isLikeGecko()){
				// $CSS .= "@-moz-keyframes ".$selector . $func." "; 
			}
			elseif($dvc->isKhtml()){
				// $CSS .= "@-khtml-keyframes ".$selector . $func." "; 
			}

		}

		
		if($return==true){$this->Code($CSS . "");}
		
		if($return==false){return $CSS;}

		return $CSS; 

	}
	


	static public function backgroundGradientValue($color){ 

		global $_DPO_DEVICE;

		$dvc = $_DPO_DEVICE;

		$css = []; 

		$b=rtrim(ltrim(trim(CLIENT_BROWSER)));

		if($dvc->isWebkit()||$dvc->isAppleWebkit()){
	
			array_push($css, " -webkit-linear-gradient(".$color.")");
	
		}

		elseif($b=='opera'){
	
			array_push($css, " -o-linear-gradient(".$color.")");
	
		}
	
		elseif($b=='msie'||$dvc->isIE()){
	
			array_push($css, " -o-linear-gradient(".$color.")");
	
		}
	
		elseif($dvc->isGecko()||$dvc->isLikeGecko()){
	
			array_push($css, " -ms-linear-gradient(".$color.")");
	
		}
	
		elseif($dvc->isKhtml()){
	
			array_push($css, " -khtml-linear-gradient(".$color.")"); 
	
		}


		array_push($css, " linear-gradient(".$color.")"); 


		return $css; 
	
	}



	static public function backgroundGradient($color){ $CSS = ""; 

		$CSS .= "background: -webkit-linear-gradient(".$color."); "; 

		$CSS .= "background: -moz-linear-gradient(".$color."); "; 

		$CSS .= "background: -o-linear-gradient(".$color."); "; 

		$CSS .= "background: -ms-linear-gradient(".$color."); "; 

		$CSS .= "background: -khtml-linear-gradient(".$color."); "; 

		return $CSS; 
	
	}



	static public function backgroundGradientRadial($color){ $CSS = ""; 
	
		$CSS .= "background: -webkit-radial-gradient(".$color."); "; 
	
		$CSS .= "background: -moz-radial-gradient(".$color."); "; 
	
		$CSS .= "background: -o-radial-gradient(".$color."); "; 
	
		$CSS .= "background: -ms-radial-gradient(".$color."); "; 
	
		$CSS .= "background: -khtml-radial-gradient(".$color."); "; 
	
		return $CSS; 

	}
	

	static public function cHorizontal($property, $value){ $CSS = ""; 
	
		$CSS .= $property."-left:".$value."; "; 
	
		$CSS .= $property."-right:".$value."; "; 
	
		return $CSS; 

	}
	

	static public function cVertical($property, $value){ $CSS = ""; 
	
		$CSS .= $property."-top:".$value."; "; 
	
		$CSS .= $property."-bottom:".$value."; "; 
	
		return $CSS; 

	}

	
	
	static public function size($value){ $CSS = ""; 

		$CSS .= "width:".$value."; "; 

		$CSS .= "height:".$value."; "; 

		return $CSS; 

	}




	
	static public function fx($effect){
	
		$args = func_get_args();
	
		$from = "";
	
		$to = "";



		if($effect=='fade'){

			$_from = (isset($args[1]))?((is_numeric($args[1])||$args[1]===false)?$args[1]:0):0;
			$_to = (isset($args[2]))?((is_numeric($args[2])||$args[2]===false)?$args[2]:0):0;

			$from = self::browserKey('opacity',$_from);

			$to = self::browserKey('opacity',$_to);

		}



		if($effect=='rotate'){

			$_from = (isset($args[1]))?((is_numeric($args[1])&&$args[1]!==false)?$args[1]:0):0;

			$_to = (isset($args[2]))?((is_numeric($args[2])&&$args[2]!==false)?$args[2]:0):0;

			$from = self::browserKey('transform','rotate('.$_from.'deg)');

			$to = self::browserKey('transform','rotate('.$_to.'deg)');

		}

		

		if($effect=='zoom'){

			$_from = (isset($args[1]))?((is_numeric($args[1])||$args[1]===false)?$args[1]:0):0;

			$_to = (isset($args[2]))?((is_numeric($args[2])||$args[2]===false)?$args[2]:0):0;

			$from = self::browserKey('transform','scale('.$_from.')');

			$to = self::browserKey('opacity','scale('.$_to.')');

		}





		/* X */

		if($effect=='zoomSlideX'){

			$_from = (isset($args[1]))?((is_numeric($args[1])||$args[1]===false)?$args[1]:0):0;

			$_to = (isset($args[2]))?((is_numeric($args[2])||$args[2]===false)?$args[2]:0):0;

			$from = self::browserKey('transform','scale('.$_from.') translateX(1962%) ');

			$to = self::browserKey('opacity','scale('.$_to.') translateX(0%)');

		}



		if($effect=='zoomSlide-X'){

			$_from = (isset($args[1]))?((is_numeric($args[1])||$args[1]===false)?$args[1]:0):0;

			$_to = (isset($args[2]))?((is_numeric($args[2])||$args[2]===false)?$args[2]:0):0;

			$from = self::browserKey('transform','scale('.$_from.') translateX(-1962%) ');

			$to = self::browserKey('opacity','scale('.$_to.') translateX(0%)');

		}



		if($effect=='zoomInSlideX'){

			$_from = (isset($args[1]))?((is_numeric($args[1])||$args[1]===false)?$args[1]:0):0;

			$_to = (isset($args[2]))?((is_numeric($args[2])||$args[2]===false)?$args[2]:0):0;

			$from = self::browserKey('transform','scale('.$_from.') translateX(1962%) ') . self::browserKey('opacity', '0.0');

			$to = self::browserKey('opacity','scale('.$_to.') translateX(0%)') . self::browserKey('opacity', '1');

		}



		if($effect=='zoomInSlide-X'){

			$_from = (isset($args[1]))?((is_numeric($args[1])||$args[1]===false)?$args[1]:0):0;

			$_to = (isset($args[2]))?((is_numeric($args[2])||$args[2]===false)?$args[2]:0):0;

			$from = self::browserKey('transform','scale('.$_from.') translateX(-1962%) ') . self::browserKey('opacity', '0.0');

			$to = self::browserKey('opacity','scale('.$_to.') translateX(0%)') . self::browserKey('opacity', '1');

		}





		/* Y */

		if($effect=='zoomInSlideY'){

			$_from = (isset($args[1]))?((is_numeric($args[1])||$args[1]===false)?$args[1]:0):0;

			$_to = (isset($args[2]))?((is_numeric($args[2])||$args[2]===false)?$args[2]:0):0;

			$from = self::browserKey('transform','scale('.$_from.') translateY(1962%) ') . self::browserKey('opacity', '0.0');

			$to = self::browserKey('opacity','scale('.$_to.') translateY(0%)') . self::browserKey('opacity', '1');

		}



		if($effect=='zoomInSlide-Y'){

			$_from = (isset($args[1]))?((is_numeric($args[1])||$args[1]===false)?$args[1]:0):0;

			$_to = (isset($args[2]))?((is_numeric($args[2])||$args[2]===false)?$args[2]:0):0;

			$from = self::browserKey('transform','scale('.$_from.') translateY(-1962%) ') . self::browserKey('opacity', '0.0');

			$to = self::browserKey('opacity','scale('.$_to.') translateY(0%)') . self::browserKey('opacity', '1');

		}



		/* Y - Out */

		if($effect=='zoomOutSlideY'){

			$_from = (isset($args[1]))?((is_numeric($args[1])||$args[1]===false)?$args[1]:0):0;

			$_to = (isset($args[2]))?((is_numeric($args[2])||$args[2]===false)?$args[2]:0):0;

			$from = self::browserKey('transform','scale('.$_from.') translateY(0%) ') . self::browserKey('opacity', '1');

			$to = self::browserKey('opacity','scale('.$_to.') translateY(1962%)') . self::browserKey('opacity', '0.0');

		}



		return '{from{' . $from . '} to{' . $to . '} }'; 

	}





}
	
	
 
 
 
?>