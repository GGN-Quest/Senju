<?php
/*
	Copyright 2013 GOBOU Y. Yannick
======================================================
	NAME 'Gougnon Native Cores'
	CLASS '_GGN'
	PAGE 'cores/native.cores.php'
======================================================

*/

	
	
class _GGN
{
	
	const NAME = 'Gougnon Native';
	const VERSION = '0.1';
	const FAMILY_VERSION = '0.1.170624.1030';
	

	const SYSTEM_NAME = 'Gougnon Core';
	const SYSTEM_VERSION = 'nightly 0.1';
	const SYSTEM_UPADTE_VERSION = '0.1.160206.0830';
	
	
	
	const DEFAULT_LANG = 'FR-fr';
	const HTML_CHARSET = 'UTF-8';
	
	
	
	
	const PATTERN_USERNAME = '/^[a-zA-Z0-9.-]*$/';
	const PATTERN_NAME = '/^[a-zA-Z ]*$/';
	const PATTERN_EMAIL = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
	const PATTERN_URL = '/\b(?:(?:(.*)?|ftp):\/\/|www\.)([-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|])/i';
	


	/* Date Time */
	const DATE_NUM = 'Y-m-d';
	const TIME_NUM = 'H:i:s';
	const DATETIME_NUM = 'Y-m-d H:i:s';
	const DATETIMEM_NUM = 'Y-m-d H:i:s.u';



	/* Apache Header */
	const HTTP_HEADER_200 = 'HTTP/1.0 200 Ok';
	const HTTP_HEADER_301 = 'HTTP/1.0 301 Moved Permanently';
	const HTTP_HEADER_302 = 'HTTP/1.0 302 Moved Temporarily';
	const HTTP_HEADER_403 = 'HTTP/1.0 403 Forbidden';
	const HTTP_HEADER_404 = 'HTTP/1.0 404 Not Found';
	const HTTP_HEADER_500 = 'HTTP/1.0 500 Internal Server Error';
	const HTTP_HEADER_502 = 'HTTP/1.0 502 Bad Getway';

	
	
	
	/* Noyaux */
	static public function PHPCore($CN)
	{
		global $GLANG;
		$core = FALSE;
		$LOAD = __CORES_NATIVE_PHP__ . $CN . '/.load.php';
		$GET = file_exists($LOAD);
		if($GET==TRUE){include $LOAD;}
		if($GET!=TRUE){self::wCnsl(_GGN::inivar('CORENAME', $CN,$GLANG['CORE']['NOT_FOUND']));}
		if($core===FALSE){self::wCnsl(_GGN::inivar('CORENAME', $CN,$GLANG['CORE']['LOAD_FAILED']));}
		return $core;
		}
	
	
	static public function JSCore($CN)
	{
		global $GLANG;
		$core = FALSE;
		$LOAD = __CORES_NATIVE_JS__ . $CN . '/.load.php';
		$GET = file_exists($LOAD);
		if($GET==TRUE){include $LOAD;}
		if($GET!=TRUE){self::wCnsl(_GGN::inivar('CORENAME', $CN,$GLANG['CORE']['NOT_FOUND']));}
		if($core===FALSE){self::wCnsl(_GGN::inivar('CORENAME', $CN,$GLANG['CORE']['LOAD_FAILED']));}
		return $core;
		}
	
	
	static public function CSSCore($CN)
	{
		global $GLANG;
		$core = FALSE;
		$LOAD = __CORES_NATIVE_CSS__ . $CN . '/.load.php';
		$GET = file_exists($LOAD);
		if($GET==TRUE){include $LOAD;}
		if($GET!=TRUE){self::wCnsl(_GGN::inivar('CORENAME', $CN,$GLANG['CORE']['NOT_FOUND']));}
		if($core===FALSE){self::wCnsl(_GGN::inivar('CORENAME', $CN,$GLANG['CORE']['LOAD_FAILED']));}
		return $core;
		}
	
	
	
	
	
	
	
	


	/* Langue */
	static public function loadLang($l){
		$ini = self::ReadINI(__LANGS__ . $l);
		if($ini===false){self::wCnsl('Langue introuvable: < ' . $l . ' >');}

		return $ini;
		}
		
	static public function lang(){$lang = self::DEFAULT_LANG;
		if(isset($_COOKIE['ggn.default.lang'])){$lang=$_COOKIE['ggn.default.lang'];}
		else{self::setLang($lang);}
		return $lang;
	}
	
	static public function setLang($l){@setcookie('ggn.default.lang',$l);}
	


	
	


	
	
	
	/* Util */
	static public function inivar($d,$v,$in){return str_replace('{%'.$d.'%}', $v,$in);}

	static public function setvar($d = false){

		global $_Gougnon;

		if(is_string($d)){

			$args = func_get_args();
			$output=$d;

			foreach ($_Gougnon as $name => $value) {
				$output=self::inivar($name,$value,$output);
			}

			preg_match_all("/{%(.*)%}/U", $output, $out, PREG_PATTERN_ORDER);

			$r0 = count($out);
			$r = $r0/2;

			if($r0>0){
				for($x=0; $x<$r; $x++) {
					if(!isset($out[1])){continue;}
					if(!isset($out[1][$x])){continue;}

					$vara = ($out[1][$x])?$out[1][$x]:false;
					// $varb = ($out[0][$x])?$out[0][$x]: false;
					$output=self::inivar($vara, self::varn($vara), $output);
				}

			}

			return $output;

		}

		else{

			return false;

		}

	}
		
		
	static public function readByLine($uri){
		$r = array();
		$h = @fopen($uri, "rb");
		if(!$h){}
		if($h){while(!feof($h)){array_push($r, fgets($h,8192));} return $r;}
		return false;
		}
		
		
	static public function write($data){echo $data;}
		
		
	static public function varn($name){
		$a = func_get_args();
		$d = GVariables::invoke((isset($a[0]))?$a[0]:false, GSTORAGE_VARIABLE_INVOKE_NATIVES);
		
		return (is_array($d['data']))

			? ((count($d['data'])>=1) 

				? ( (isset($d['data'][0][0]))

					? $d['data'][0][0] 

					: $d['data'][0] 

				)

				: $d['data'])

			: false

		;
	}
	
	
	static public function isUsable($data){return (isset($data))?((strlen(trim($data))===0)?false:true): false;}
	// static public function isUsable($array, $k){return (is_array($array))?((isset($array[$k]))?((strlen(trim($array[$k]))===0)?false:true): false): false;}
		
	
	/* Update : 160923.0820 */
	static public function aliasOf($name){ return function(){ call_user_func_array($name, func_get_args());}; }
		
		
		
		
	
	
	/* Fichier INI */
	// static public function ini($uri){ $lines = self::readByLine($uri); if($lines===false){return false;} $Cheader = 'DEFAULT'; $ini = array(); $ini[$Cheader] = array(); for($x=0; $x<count($lines); $x++){$sq = substr(trim($lines[$x]), 0,1); $eq = substr(trim($lines[$x]), -1); $co = substr(rtrim(ltrim(trim($lines[$x]))), 0,1); if($co==';'){ continue; } else {if($sq=='[' && $eq==']'){$Cheader = substr(ltrim(trim($lines[$x])), 1, -1); if(!isset($ini[$Cheader])){ $ini[$Cheader] = array(); } } if($sq!='[' && $eq!=']' && $co!=';'){$ge = explode("=", $lines[$x]); if(trim($ge[0]) != ''){$tge0=($ge[0]); $ini[$Cheader][trim($tge0)] = (isset($ge[1])) ?ltrim(rtrim( substr(implode('=',$ge), strlen($tge0)+1) )): ''; } } } } return $ini; }


	static public function ReadINI($path){

		if(is_file($path)){

			$data = file_get_contents($path);

			return parse_ini_string($data, TRUE);

		}

		else{

			return false;

		}

	}
	
	static public function WriteINI($file, $array = [], $get = false){

		$OutPut = [];

		foreach ($array as $key => $value) {

			if(is_array($value)){

				$OutPut[] = '[' . $key . ']' . "";

				foreach ($value as $k => $val) {

					if(is_string($val)){

						$OutPut[] = $k . ' = ' . $val . "";

					}
					
					if(is_array($val)){

						foreach ($val as $y => $v) {

							$OutPut[] = $k . '[' . (is_numeric($y) ? '' : $y) . '] = ' . $v . "";
							
						}


					}
					

				}

			}
			
		}

		return ($get === false) ? \Gougnon::createFile($file, implode("\n", $OutPut) ) : $OutPut;

	}
	
		
		
		
		
		
	/* HTML */
	static public function wCnsl($c){	
		$a=func_get_args();

		// @header((isset($a[1]))?(($a[1]!=false)?$a[1]:self::HTTP_HEADER_404):self::HTTP_HEADER_404);

		$html='';
		$html.='<div style="position:absolute;top:0px;left:0px;width:100%;height:100%;">';
		$html.='<table cellpadding="0" cellspacing="0" style="border:0px solid;width:100%;height:100%;">';
		$html.='<tr>';
		$html.='<td>';
		$html.='<center>';
		$html.=$c;
		$html.='</center>';
		$html.='</td>';
		$html.='</tr>';
		$html.='</table>';
		$html.='</div>';

		echo self::npg('Terminal',$html);
		self::closeDataBase();
		exit(0);
	}
	

	static public function npg($t,$c)
	{
		global $database;
		
		@header('Content-Type: text/html');
		$html='';
		$html.='<!DOCTYPE html>';
		$html.='<html>';
		$html.='<head>';
		$html.='<!-- Gougnon Native -->';
			if(defined('HTTP_HOST')){$html.='<link rel="icon" type="image/png" href="'.HTTP_HOST.'favicon.png" >';}
		$html.='<meta charset="'.self::HTML_CHARSET.'">';
		$html.='<meta name="viewport" content="width=device-width,initial-scale=1" >';
		$html.='<title>'.$t.'  -  Gougnon</title>';
			$html.='<style type="text/css">';
				$html.='<!--';
				$html.='body{background:#050505;color:#555;font-size:14px;font-family:"segoe ui",verdana,"trebuchet MS",arial,tahoma;}';
				$html.='b{color:#fff;}';
				$html.='video:focus{outline-width:0;}';
				$html.='h1,h2,h3,h4,h5{margin:0px;}';
				$html.='b,h1,h2,h3,h4,h5{font-weight:normal;}';
				$html.='i,b{color:#999;}';
				// $html.='b{font-weight:bold;}';
				$html.='-->';
			$html.='</style>';
		$html.='</head>';
		$html.='<body>';
		$html.=$c;
		$html.='</body>';
		$html.='</html>';
		
		return $html;
	}
	
	
	
	
	
	
	
	
	
	/* Clients : Provenace */
	static public function clientRefererControlAccessFailed(){
		$a = func_get_args();
		_GGN::wCnsl('<h1>Accès réfusé</h1>' . ((isset($a[0]))?'Code: <i>'.$a[0].'</i>, n': 'N') . 'oyau: <i>' . self::SYSTEM_NAME . '</i>, version: <i>' . self::SYSTEM_VERSION.'</i>, version de la mise à jour: <i>' . self::SYSTEM_UPADTE_VERSION . '</i>', (isset($a[1]))?$a[1]:false );
		}
	
	
	
	
	
	
	
	
	/* Classes et Objets */
	static public function importClassVars($class, $copied){
		foreach($copied as $property => $value){$class->$property = $value;}
		return $class;}
	
	
	static public function cloneObject($class){
		$new = clone $class;
		return $new;}

	
	
	
	
	
	
	
	/* Version */
	static public function versionValidate($current, $new){ // Si $current > $new = true
		$e = str_replace('.', '', $new);
		$s = substr(str_replace('.', '', $current),0,strlen($e));
		return (is_numeric($s) && is_numeric($e))?$s>$e:null;
	}
	
	



	/* Temps */
	static public function addTime($time,$min){
		$t=explode(':',$time);
		$ni = ($t[1]+($min));$H = $t[0]; 
		if($ni>=60){ $ni=($ni-60); $H=($H+1); } 
		if($H>=24){ $H=($H-24); } 
		return $H.':'.$ni.':'.$t[2]; 
	}
		
	



	// static public function datetimeTimestamp($datetime){
	// 	$dt=explode(' ', $datetime);
	// 	$d='0000-00-00';$t='00:00:00';
	// 	if(isset($dt[0])){$d=explode('-', $dt[0]);}
	// 	if(isset($dt[1])){$t=explode(':', $dt[1]);}

	// 	$ts = mktime($t[0], $t[1], $t[2], $d[2], $d[1], $d[0]);
	// 	return $ts; 
	// }
		



	static public function keyExists($array){
		if(is_array($array)){
			// $

			for($x=0;$x<count($array);$x++){
				if(!self::varn($array[$x])){
					self::wCnsl('Erreur Données Manquantes: Gougnon Native "'.$array[$x].'" ');
					break;
				}
			}

			return true;
		}
		else{
			return false;
		}

	}








	static public function userAccountNameByType($key){
		global $GLANG;

		$lang = $GLANG;
		$speak = [
			(isset($lang['SPEAK']['VISITOR']))?$lang['SPEAK']['VISITOR']:false
			,(isset($lang['SPEAK']['GUEST']))?$lang['SPEAK']['GUEST']:false
			,(isset($lang['SPEAK']['USER']))?$lang['SPEAK']['USER']:false
			,(isset($lang['SPEAK']['MODERATOR']))?$lang['SPEAK']['MODERATOR']:false
			,(isset($lang['SPEAK']['ADMINISTRATOR']))?$lang['SPEAK']['ADMINISTRATOR']:false
			,(isset($lang['SPEAK']['SUPER_ADMINISTRATOR']))?$lang['SPEAK']['SUPER_ADMINISTRATOR']:false
			,(isset($lang['SPEAK']['SYSTEM']))?$lang['SPEAK']['SYSTEM']:false
		];

		return (isset($speak[$key]))?$speak[$key]:false;
	}






	/* Caractères */
	static public function encodeChar($char){
		return utf8_encode($char);
	}


	static public function decodeChar($char){
		return utf8_decode($char);
	}




	/* Base de donnée */
	static public function closeDataBase(){
		
		global $database;

		if(is_object($database)){ 

			if(method_exists($database, 'Close')){ 

				$database->Close(); 

			} 

		}

	}





}





















/* Caches Natif */
Class _GGNCaches extends _GGN{

	CONST FILE_DIR = '';
	CONST CCHEXT = '.ggncache';
	


	var $FileName = false;
	var $Ext = false;
	var $Path = '';
		var $_Path = false;
	var $_Data = false;


	
	public function __construct(){
		$this->args = func_get_args();
		$this->Mode = strtolower((isset($this->args[0])) ? $this->args[0] : '-none');

		if($this->Mode=='-passive'){
			$this->FileName = (isset($this->args[1])) ? $this->args[1] : false;
			$this->Path = (isset($this->args[2])) ? $this->args[2] : '';
			$this->Ext = (isset($this->args[3])) ? $this->args[3] : self::CCHEXT;
		}

		if($this->Mode=='-active'){
			$this->FileName = (isset($this->args[1])) ? $this->args[1] : false;
			$this->Path = (isset($this->args[2])) ? $this->args[2] : '';
		}

	}




	
	/* DYNAMIQUE DEBUT ========================================= */

	/* Chemin */
	public function Path(){
		$a=func_get_args();

		if($this->Mode=='-passive'){
			if(isset($a[0])){$this->_Path = $a[0];}
			if(is_string($this->FileName) && is_string($this->Path)){$this->_Path = self::getFilePath($this->Path, $this->FileName, $this->Ext);}
			return $this->_Path;
		}

		// if($this->Mode=='-active'){
		// 	if(isset($a[0])){$this->_Path = $a[0];}
		// 	if(is_string($this->FileName) && is_string($this->Path)){$this->_Path = self::getActiveDir($this->Path);}
		// 	return $this->_Path;
		// }

	}


	/* Données */
	public function Data(){

		if($this->Mode=='-passive'){
			if(is_string($this->FileName) && is_string($this->Path)){return self::getFileData($this->Path, $this->FileName, $this->Ext);}
		}

		return false;
	}


	/* Créer */
	public function Create(){
		$a=func_get_args();

		if($this->Mode=='-passive'){
			if(is_string($this->FileName) && is_string($this->Path) && isset($a[0])){return self::setFileData($this->Path, $this->FileName, $a[0], $this->Ext);}
		}

		return false;
	}

	/* DYNAMIQUE FIN ========================================= */






	/* STATIQUE DEBUT ========================================= */

	/* Caches Actifs */
	static public function createActive($file, $content){
		global $_Gougnon;
		$file .= self::CCHEXT;
		$f = __CACHES_ACTIVE__ . $file;
		$dir = dirname($f);

		if(!is_dir($dir)){Gougnon::createFolders($dir);}
		return Gougnon::createFile($f, $content);
	}

	
	static public function getActiveFile($file){
		global $_Gougnon;
		$file .= self::CCHEXT;
		$f = __CACHES_ACTIVE__ . $file;

		if(is_file($f)){return file_get_contents($f);}
		return false;
	}

	
	static public function getActiveDir($dir){
		global $_Gougnon;
		$d = __CACHES_ACTIVE__ . $dir;

		if(is_dir($d)){return Gougnon::iScanFolder($d);}
		return false;
	}

	



	/* Donnée à partir des Fichiers */
	static public function getFilePath($path, $file){
		global $_Gougnon;
		$a=func_get_args();
		$ext=(isset($a[2]))?$a[2]:self::CCHEXT;

		return __CACHES_PASSIVE__ . self::FILE_DIR . $path . '/' . _GGNCrypt::_sha256($file,1) . '.' . $ext;
	}
	
	static public function getFileData($path, $file){
		global $_Gougnon;
		$a=func_get_args();

		$ext=(isset($a[2]))?$a[2]:self::CCHEXT;
		$f = self::getFilePath($path, $file, $ext);

		if(is_file($f)){return file_get_contents($f);}
		return false;
	}
	
	static public function setFileData($path, $file, $data){
		global $_Gougnon;
		$a=func_get_args();

		$ext=(isset($a[3]))?$a[3]:self::CCHEXT;
		$f = self::getFilePath($path, $file, $ext);
		$dir = dirname($f);

		if(!is_dir($dir)){Gougnon::createFolders($dir);}
		return Gougnon::createFile($f, $data);
	}

	/* STATIQUE FIN ========================================= */



}





















/* Classe Objet Natif */
Class _GGNCustomObject extends _GGN{

    public function __construct(array $arguments = array()) {

        if (!empty($arguments)) {

            foreach ($arguments as $property => $argument) {

                if ($argument instanceOf Closure) {

                    $this->{$property} = $argument;

                } else {

                    $this->{$property} = $argument;

                }

            }

        }

    }



    public function _State($name, $value = false) {

    	$this->{$name} = $value;
       	
    	return $this;

    }



    public function __call($method, $arguments) {

        if (isset($this->{$method}) && is_callable($this->{$method})) {

            return call_user_func_array($this->{$method}, $arguments);

        } else {

            // throw new Exception("Erreur Fatale : Methode indefinie _GGNCustomObject::{$method}()");

            \_GGN::wCnsl("Erreur Fatale : Methode indefinie <b>_GGNCustomObject::{$method}()</b>");

        }

    }


}




















/* Cryptage Natif */
Class _GGNCrypt extends _GGN{
	
	CONST PDSC = 3;
	CONST PSUC = 7;

	CONST PALETTE_64= 'a b c d e f g h i j k l m n o p q r s t u v w x y z A B C D E F G H I J K L M N O P Q R S T U V W X Y Z 0 1 2 3 4 5 6 7 8 9 + =';
	CONST PALETTE_ALPHA= 'a b c d e f g h i j k l m n o p q r s t u v w x y z';
	CONST PALETTE_iALPHA= 'a b c d e f g h i j k l m n o p q r s t u v w x y z A B C D E F G H I J K L M N O P Q R S T U V W X Y Z';
	CONST PALETTE_NUMERIC= '0 1 2 3 4 5 6 7 8 9';

	CONST PALETTE_LOW= 'a b c d e f g h i j k l m n o p q r s t u v w x y z 0 1 2 3 4 5 6 7 8 9';
	CONST PALETTE_NORMAL= 'a b c d e f g h i j k l m n o p q r s t u v w x y z A B C D E F G H I J K L M N O P Q R S T U V W X Y Z 0 1 2 3 4 5 6 7 8 9 ? : . @';
	CONST PALETTE_HIGH= 'a b c d e f g h i j k l m n o p q r s t u v w x y z A B C D E F G H I J K L M N O P Q R S T U V W X Y Z 0 1 2 3 4 5 6 7 8 9 # - * % ! . _ ? $ ; : + / \ @ , < > ~ { }';

	
	/* Encoder */
	static public function encoder($data, $type){
		$new = $data;
		$types = explode(',', $type);
			for($x=0; $x<count($types); $x++){$new = self::encoderSwitch($data, $types[$x]);}
		return $new;
	}
		
		
	static public function encoderSwitch($data, $type){
		$new = $data;
		$exp = explode(':', $type);
		$mode = (isset($exp[0]))?$exp[0]:'';
		$algo = (isset($exp[1]))?$exp[1]:false;
		
		switch(strtoupper($mode)){
			case 'BASE64':$new = self::base64Encode($data, self::PDSC);break;
			case 'MD5':$new = self::_md5($data, self::PSUC);break;
			case 'CRC32':$new = self::_crc32($data, self::PSUC);break;
			case 'SHA1':$new = self::_sha1($data, self::PSUC);break;
			case 'HASH':$new = self::_hash($data, $algo, self::PSUC);break;
		}
		
		return $new;
	}
	
	
	
	
	
	
	
	
	
	/* Decoder */
	static public function decoder($data, $type){
		$new = $data;
		$types = explode(',', $type);
			for($x=0; $x<count($types); $x++){$new = self::decoderSwitch($data, $types[$x]);}	
		return $new;}
		
		
	static public function decoderSwitch($data, $type){
		$new = $data;
		switch(strtoupper($type)){
			case 'BASE64':
				$new = self::base64Decode($data, 3);
				break;
			}
		
		return $new;}
	
	
	
	
	
	
	
	
	
	/* Base64 Encode */
	static public function base64Encode($data){
		$a = func_get_args();
		$proc = (isset($a[1]))?$a[1]:1;
		$new = $data;
		if(is_numeric($proc)){for($x=0; $x<$proc; $x++){$new = base64_encode($new);}}
		return $new;
		}

	/* Base64 Decode */
	static public function base64Decode($data){
		$a = func_get_args();
		$proc = (isset($a[1]))?$a[1]:1;
		$new = $data;
		if(is_numeric($proc)){for($x=0; $x<$proc; $x++){$new = base64_decode($new);}}
		return $new;
		}

	
	
	
	
	/* MD5 Encode */
	static public function _md5($data){
		$a = func_get_args();
		$proc = (isset($a[1]))?$a[1]:1;
		$new = $data;
		if(is_numeric($proc)){for($x=0; $x<$proc; $x++){$new = md5($new);}}
		return ($new);
		}

	
	
	
	
	/* SHA256 Encode */
	static public function _sha256($data){
		$a = func_get_args();
		$proc = (isset($a[1]))?$a[1]:1;
		$new = $data;
		if(is_numeric($proc)){for($x=0; $x<$proc; $x++){$new = hash('sha256',$new);}}
		return ($new);
		}

	
	
	
	
	/* CRC32 Encode */
	static public function _crc32($data){
		$a = func_get_args();
		$proc = (isset($a[1]))?$a[1]:1;
		$new = $data;
		if(is_numeric($proc)){for($x=0; $x<$proc; $x++){$new = crc32($new);}}
		return $new;
		}

	
	
	
	
	/* SHA1 Encode */
	static public function _sha1($data){
		$a = func_get_args();
		$proc = (isset($a[1]))?$a[1]:1;
		$new = $data;
		if(is_numeric($proc)){for($x=0; $x<$proc; $x++){$new = sha1($new);}}
		return $new;
		}

	
	
	
	
	/* HASH Encode */
	static public function _hash($data, $algo){
		$a = func_get_args();
		$proc = (isset($a[1]))?$a[1]:1;
		$new = $data;
		$algo = ($algo===false || strlen(trim($algo))==0)?'sha256': $algo;
		if(is_numeric($proc)){for($x=0; $x<$proc; $x++){$new = hash($algo, $new);}}
		return $new;
		}




	
	

	/* ================== GENERATEURS ========================*/

	/* RKCRand : Génération de code */
	static public function RKCRand($_palette){ /* [Array, +1 numeric] */
		$a = func_get_args();
		$length = (isset($a[1]))?$a[1]:32;
		$new = '';
		$palette=explode(' ',$_palette);
			for($x=0; $x<$length;$x++){
				$y=mt_rand(0, count($palette)-1);
				$new .= $palette[$y];
			}
		return $new . str_replace(['=','+'],'',_GGNCrypt::base64Encode(date(_GGN::DATETIME_NUM),2));
		}

	/* RKCRandm : Génération de code */
	static public function RKCRandm($_palette){ /* [Array, +1 numeric] */
		$a = func_get_args();
		$length = (isset($a[1]))?$a[1]:32;
		$new = '';
		$palette=explode(' ',$_palette);
			for($x=0; $x<$length;$x++){
				$y=mt_rand(0, count($palette)-1);
				$new .= $palette[$y];
			}
		return $new;
		}

	

	/* RKCDrash : Génération de code à partir de clés */
	static public function RKCDrash($data, $key ,$dd ,$kd){
		$a = func_get_args();
		$new = '';
		$d=$data;
		$dlen=ceil(strlen($d)/$dd);
		$dSD=substr($d,-1*$dlen);
		$dED=str_replace($dSD,'',$d);

		$klen=ceil(strlen($key)/$kd);
		$kSD=substr($key,-1*$klen);
		$kED=str_replace($kSD,'',$key);

		$new = (self::_sha256($kSD) . self::_sha256($kSD) . self::_sha256($dED) . self::_sha256($kED));
		return $new;
		}
	

		





	}








?>