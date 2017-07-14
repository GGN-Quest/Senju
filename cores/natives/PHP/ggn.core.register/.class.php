<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS Register
	CLASS Render
	PAGE cores/_GGNs/PHP/Register.core.g/.class.php
======================================================

*/

if(!class_exists('_GGN')){exit('Class native introuvable');}

if(!class_exists('Gougnon')){exit('Gougnon PHP Framework introuvable');}


class Register extends _GGN

{

	/* INFOS */
	CONST NAME = 'Gougnon Core Register';
	
	CONST VERSION = '0.0.2';
	
	CONST REEL_VERSION = '161208.0824';
	
	CONST TYPE = 'PHP.CORE';
	
	
	/* Request du runtime */
	CONST REQUEST_RUNTIME = '___auto_open_file___';
	
	
	/* Active. Register. Core. */
	CONST MODE_EXT_STATIC = 'EXT.FILES.STATIC:MODE';
	
	CONST MODE_EXT_DYNAMIC = 'EXT.FILES.DYNAMIC:MODE';
	
	CONST ARC_TYPE_EXT = 'arc/ext';

	CONST ARC_EXT = 'ARC_EXT_FILES/';
	
	CONST ARC_EXT_RENDERING = 'ARC_EXT_ENGINE_RENDERING/';
	
	CONST ARC_EXT_RENDERING_EXT = '.arc-render.php';
	
	CONST ARC_EXT_RENDERING_CLASS_EXT = '.arc-class.php';


	CONST MODE_SLASH_PATH = 'SLASH.PATH:MODE';
	
	CONST ARC_TYPE_SLASH = 'arc/slash';

	CONST ARC_SLASH_PATH = 'ARC_SLASH_PATH/';
	
	CONST ARC_SLASH_PATH_RENDERING = 'ARC_SLASH_PATH_ENGINE_RENDERING/';
	
	CONST ARC_SLASH_PATH_RENDERING_EXT = '.arc-render.php';
	
	CONST ARC_SLASH_PATH_RENDERING_CLASS_EXT = '.arc-class.php';


	/* Evenements du registre */
	CONST ARC_EVENTS_DIR = 'ARC_EVENTS/';



	/* Registre libre */
	CONST MODE_FREE_REGISTER = 'ARC.FREE.REGISTER:MODE';
	
	CONST ARC_FREE_REGISTER_DIR = 'ARC_FREE_REGISTER/';



	/* Registre libre */
	CONST MODE_USERS_BLOGGING = 'ARC.USERS.BLOGGING:MODE';
	
	CONST ARC_USERS_BLOGGING_DIR = 'ARC_USERS_BLOGGING/';



	/* Petite Securité Registre */
	CONST SECURE_TOKEN_PATH = 'SECURE_AUTH_TOKEN/';



	/* Cible Meta */
	// CONST META_EXT = '.meta';






	
	var $mode = '-release';


	var $UseCaches = false;
	
	var $UseDynamicCaches = true;

	var $UseUpdateCaches = null;

	var $UseTypeCaches = '-text';

	var $UseCompactMode = true;

	var $__FilesToCaches = [];


	var $AcceptToken = null;

	var $Blog = false;
	
	var $controlAccessError = false;

	var $getUserAccessRightError = false;



	/* Accessessibilité */
	var $controlAccessMode;

	var $controlAccessActived = false;



	/* Espace Disk et Memoire */
	var $MemoryUsage;

	var $DiskFreeSpace;

	var $DiskSpace;



	
	public function __construct(){

		$this->natives = func_get_args();



	}
	


	
	public function SysRsrc(){

		$this->SysMemoryUsage = memory_get_usage(true);

		$this->SysMemoryMax = memory_get_peak_usage(true);

		$this->SysMemoryLimit = (integer) ini_get('memory_limit') * 1024 * 1024;

		$this->DiskFreeSpace = disk_free_space(__MAIN__);

		$this->DiskSpace = disk_total_space(__MAIN__);

	}
	
	
	public function Invoke(){
		$this->invokers = func_get_args();
	}
	
	


	
	public function AddToCaches($File = false){

		if(is_string($File)){

			$this->__FilesToCaches[] = $File;
			
		}

	}
	
	
	
	
	public function eventOn($on){

		$evt = REGISTER_PATH . '/' . self::ARC_EVENTS_DIR . $on . '/default.event.php';
		
		$exists = is_file($evt);
		
		$args = func_get_args();

		if($exists===true){include $evt;}
		
		else{return false;}
	
	}
	
	
	public static function getDataPath($mode){

		switch ($mode) {
			case GGN_REGISTER_MODE_FREE:
				return GSTORAGE_REGISTER_FREE_MODE;
			break;
			
			default:
				return GSTORAGE_REGISTER;
			break;

		}
	}
	
	
	public static function getDataColumns($mode){

		switch ($mode) {
			case GGN_REGISTER_MODE_FREE:
				return ['NAME', 'TYPE', 'DATA', 'LABEL', 'COMMENTS'];
			break;
			
			default:
				return false;
			break;

		}
	}
	
	
	
	
	public static function getHTTPErrorMessages($_TYPE){
		switch($_TYPE){

			case HTTP_ERROR_301:
				@header(_GGN::HTTP_HEADER_301);
				$t = 'Donnée déplacée';
				$c = 301;
				$a = 'Donnée déplacée de façon permanente';
			break;

			case HTTP_ERROR_302:
				@header(_GGN::HTTP_HEADER_302);
				$t = 'Rédirection invalide';
				$c = 302;
				$a = 'Trouvé est une façon courante d\'effectuer la redirection d\'URL';
			break;

			case HTTP_ERROR_403:
				@header(_GGN::HTTP_HEADER_403);
				$t = 'Accès réfusé';
				$c = 403;
				$a = 'Droit d\'accès insuffisant';
			break;

			case HTTP_ERROR_500:
				@header(_GGN::HTTP_HEADER_500);
				$t = 'Erreur';
				$c = 500;
				$a = 'Erreur interne du serveur';
			break;

			case HTTP_ERROR_502:
				@header(_GGN::HTTP_HEADER_502);
				$t = 'Erreur';
				$c = 502;
				$a = 'Passerelle incorrecte';
			break;

			default:
				@header(_GGN::HTTP_HEADER_404);
				$t = 'Erreur';
				$c = 404;
				$a = 'Page non-trouvée';
			break;

		}

		return ['title'=>$t, 'code'=>$c, 'about'=>$a];
		
	}
	
	
	
	public function Rendering(){

			global $GLANG, $Gougnon, $database;
			
			

		
			$this->_CORE = $Gougnon;
		
	
		if($this->verifAllVars()===TRUE){
				
			if($this->primaryVars()===TRUE){
				
					$this->mode = $this->RegMode()->getARC()->toString;
				
					// $this->USER = false;

					$this->USER = GSystem::requires('users.login/secures');




					/* Rafraichissement de la session */
					if(is_array($this->USER)){

						$this->USER_SESSION = GSystem::requires('users.login.refresh/sessions');

					}

					



					/* Mode : GRAND - SLASH */
					if($this->arcExists==false){

						$slashPath = $this->getSlashPath();

						if($this->ARCINIExists!==true){


							/* Mode : BLOG */
							if(self::varn('SYSTEM_ACTIVATION_BLOGGING_USERS')=='1'){

								/* Recherche de l\'utlisateur */
								if(is_object($this->getBloggingUserName())){
									
									$this->getBloggingHandler();
									
								}

								/* Mode : Registre libre */
								else{$this->getFreeReg();}
							}


							/* Mode : Registre libre */
							else{$this->getFreeReg();}


						}


						/* Mode : SLASH.PATH */
						else{

							$this->ARC = self::ReadINI($this->ARCINI);

							$this->PopStatePath = implode('/', \Gougnon::arrayValues(explode('/', $this->gFile), 1));


							/* Sécurité de jeton sur les fichiers JSON */
							if(isset($this->ARC['CONFIG']['HEADER']) && strtolower(ltrim(rtrim($this->ARC['CONFIG']['HEADER']))) == 'content-type:application/json'){

								if(!isset($_POST['ggn-registry-token']) && (!isset($_POST['ggn-registry-token-exception']) || !isset($_POST['ggn-registry-token-exception-key'])) ){

									$this->eventOn('ERROR.403', 'reg-token-forbidden');

									$this->close();

								}

								else{

									$this->AcceptToken = \RegisterSecure::AcceptTokenException(); 

									if($this->AcceptToken == false){

										$this->AcceptToken = \RegisterSecure::AcceptToken();

									}
									
								}


							}

			
		
							/* Petite Sécurité */
							$this->LittleSecure();
							
						

						/* Rendu */
						$this->getSlashPathRenderingEngine();
					
						if($this->RenderingEngineExists!==TRUE){
					
							$this->eventOn('ERROR.RENDERING.ENGINE.NOT.FOUND');
					
							$this->close();
					
						}


						$this->fileSourceExists = is_file($this->RenderingEngine);


						if(is_file($this->RenderingEngine) || ($this->fileSourceExists)){

							$this->eventOn('SUCCESS.REQUEST.OK', self::MODE_SLASH_PATH, @$this->ARC['CONFIG']['HEADER'], $this->fileType);



							/* Entete de la page "Content-Type" */

							if(isset($this->ARC['CONFIG']['HEADER'])){

								if(!Gougnon::isEmpty($this->ARC['CONFIG']['HEADER'])){

									header(''.$this->ARC['CONFIG']['HEADER'].';charset='.$GLANG['INFO']['CHARSET'].'');

								}

							}

							include $this->RenderingEngine;	

							$this->close();							

						}




					}

				}




				/* Mode : EXTENSION */
				if($this->arcExists==true){

					$this->getARCVars();

					if($this->ARCINIExists===TRUE){

						$this->ARC = self::ReadINI($this->ARCINI);

						$this->ARC_ROOT = Render::serverRootVars($this->ARC['CONFIG']['ROOT_SRC']);



						/* Sécurité de jeton sur les fichiers JSON */
						if(isset($this->ARC['CONFIG']['HEADER']) && strtolower(ltrim(rtrim($this->ARC['CONFIG']['HEADER']))) == 'content-type:application/json'){

							if(!isset($_POST['ggn-registry-token']) && (!isset($_POST['ggn-registry-token-exception']) || !isset($_POST['ggn-registry-token-exception-key'])) ){

								$this->eventOn('ERROR.403', 'reg-token-forbidden');

								$this->close();

							}

							else{

								$this->AcceptToken = \RegisterSecure::AcceptTokenException();

								if($this->AcceptToken == false){

									$this->AcceptToken = \RegisterSecure::AcceptToken();

								}
								
							}


						}


						/* Petite Sécurité */
						$this->LittleSecure();
								
						/* Rendu */
						$this->getRenderingEngine();
						if($this->RenderingEngineExists!==TRUE){
							$this->eventOn('ERROR.RENDERING.ENGINE.NOT.FOUND');
							$this->close();
						}



						/* Existence du fichier */
						$fileExtence =  (isset($this->ARC['ON']['FILE_EXISTENCE']))?$this->ARC['ON']['FILE_EXISTENCE']: 'true';
						$this->file = $this->ARC_ROOT . $this->file . $this->ARC['CONFIG']['EXT'];
						$this->fileSourceExists = ($fileExtence=='true')?file_exists($this->file):true;

						

						/* Ouverture du moteur de rendu */
						if($this->file=='**'){
							$this->eventOn('SUCCESS.REQUEST.OK', self::MODE_EXT_STATIC, @$this->ARC['CONFIG']['HEADER'], $this->fileType);

							/* Entete de la page "Content-Type" */
							if(isset($this->ARC['CONFIG']['HEADER'])){
								if(!Gougnon::isEmpty($this->ARC['CONFIG']['HEADER'])){
									header(''.$this->ARC['CONFIG']['HEADER'].';charset='.$GLANG['INFO']['CHARSET'].'');
								}
							}
			
							include $this->RenderingEngine;

							$this->close();

						}
							
						if($this->file!='**'){
							if($this->fileSourceExists!==TRUE){
								$this->eventOn('ERROR.FILESOURCE.NOT.FOUND');
								$this->close();
							}
							if($this->fileSourceExists===TRUE && $this->RenderingEngineExists===TRUE){
								$this->eventOn('SUCCESS.REQUEST.OK', self::MODE_EXT_DYNAMIC, (isset($this->ARC['CONFIG']['HEADER']) ? $this->ARC['CONFIG']['HEADER']:false), $this->fileType);
								
								/* Entete de la page "Content-Type" */
								if(isset($this->ARC['CONFIG']['HEADER'])){
									if(!Gougnon::isEmpty($this->ARC['CONFIG']['HEADER'])){
										header(''.$this->ARC['CONFIG']['HEADER'].';charset='.$GLANG['INFO']['CHARSET'].'');
									}
								}
				
								include $this->RenderingEngine;

								$this->close();

							}

						}
		
						
					}

					if($this->ARCINIExists!==TRUE){
				
						$this->eventOn('ERROR.ARCINI.NOT.FOUND');
				
						$this->close();
				
					}
					
				}

			}

		}
				
		$this->close();

		return $this;

	}
	
	public function close($r = false){

		if($r==false){

			$this->eventOn('SUCCESS.REQUEST.OK.AFTER', self::MODE_EXT_STATIC, @$this->ARC['CONFIG']['HEADER'], $this->fileType);

		}

		$this->nclose();exit;

	}
	
	public function nclose(){
	
		_GGN::closeDataBase();
	
		return $this;
	
	}
		
		
		
		
		
		
	
	/* Droit d'ouverture */
	/* Update : 161003.1219 */
	public function LittleSecure(){

		/* Droit d'access domaine */
		$Deny = $this->getDomaineAccessRight(true);

		$Access = isset($this->ARC['CONFIG']['ACCESS_OR_RIGHT']) ? ($this->ARC['CONFIG']['ACCESS_OR_RIGHT'] * 1) : 0;

		$Right = isset($this->ARC['CONFIG']['OPENED_RIGHT']) ? ($this->ARC['CONFIG']['OPENED_RIGHT'] * 1) : 0;

		$UserRight = ( isset($this->USER) && is_array($this->USER) && isset($this->USER['ACCOUNT_TYPE']) ) ? ($this->USER['ACCOUNT_TYPE'] * 1) : 0;


		if($Deny === true){

			if($Access == 1 && $UserRight >= $Right ){

				/* Accepté */

			}

			else{

				/* Réfusé */

				$this->eventOn('ERROR.USER.ACCESS.RIGHT.NOT.ENOUGH');

				$this->close();

			}

		}

		else{

			if($Access == 0 && $Right > $UserRight){

				/* Réfusé */

				$this->eventOn('ERROR.USER.ACCESS.RIGHT.NOT.ENOUGH');

				$this->close();

			}

			else{

				/* Accepté */

			}

		}

		
		return $this;

	}
		
		
		
		
	
	/* Mode Blogging */
	/* Update : 160912.1103 */
	private function getBloggingUserName(){

		global $database;

		$ret = false;

		if($database->connected === true){

			$Q = $database->SelectFromTable('NATIVE_USERS', "WHERE USERNAME='".$this->concatenate[0]."'")->results();

			if($Q->row > 0){

				$ret = $Q; 

				$this->bloggingUSER = $Q->data;

			}

		}

		return $ret;

	}
	
	/* Update : 160912.1103 */
	private function getBloggingHandler(){

		$f = $this->PATH . self::ARC_USERS_BLOGGING_DIR . 'default.php';
		if(is_file($f)){
			include $f;
		}
		else{$this->eventOn('ERROR.BLOGGING.MASTER.NOT.FOUND');}

	}
	
		
		
		
	
	/* Registre libre */
	private function getFreeReg(){
		global $GLANG;
		if($this->freeReg()===true){}
		else{$this->eventOn('ERROR.ARC.NOT.FOUND');}
	}
	private function freeReg(){
		global $GLANG;
		
		$_RETURN = false;
		$f = $this->PATH . self::ARC_FREE_REGISTER_DIR . 'default.php';
		if(is_file($f)){include $f;}
		return $_RETURN;

	}
		
		
		
		
		
		
	
	/* Fonctions Privées */
	private function verifAllVars(){
		global $GLANG;
			if(!isset($this->natives)){$this->eventOn('ERROR.NATIVE.VAR.NOT.FOUND');}
			if(!isset($this->invokers)){$this->eventOn('ERROR.INVOKE.VAR.NOT.FOUND');}
			$this->lang = $GLANG;
		return true;}
		
		
	

	public function getDomaineAccessRight($return = false){

		$ret = false;

		if(isset($this->ARC['CONFIG']['CONTROL-ACCESS'])){

			$this->setControlAccessFromARC(
	
				$this->ARC['CONFIG']['CONTROL-ACCESS']
	
				, ((isset($this->ARC['CONFIG']['CONTROL-ACCESS-EXCLUDES']))?$this->ARC['CONFIG']['CONTROL-ACCESS-EXCLUDES']: FALSE) 

				, $return
				
			);

			$ret = $this->controlAccessActived;
		
		}

		return $ret;
	}
		
		
		
	private function primaryVars(){

		global $GLANG;
	
			$this->ROOT = (isset($this->natives[0]))?$this->natives[0]:__MAIN__;
	
			$this->CAP = (isset($this->natives[1]))?$this->natives[1]: $_GET;
	

			$this->PATH = __CORES_REGISTER__; 
			// $this->PATH = dirname(__FILE__);

			$this->PATH .= (substr($this->PATH,-1)=='/')?'':'/'; 
			
	
			$this->mCAP = (isset($this->invokers[0]))?$this->invokers[0]: 'GET';
	
			$this->naCAP = (isset($this->invokers[1]))?$this->invokers[1]: FALSE;
	
				if($this->naCAP==FALSE){$this->eventOn('ERROR.NACAP.IS.FALSE');}
	
			$this->gFile = (isset($this->CAP[$this->naCAP]))?$this->CAP[$this->naCAP]:FALSE;
	
				if($this->gFile==FALSE){$this->eventOn('ERROR.FILE.SOURCE.FAILED');}
	
			$this->file = $this->gFile;


			define('REGISTER_PATH', $this->PATH);
	
		return true;
	
	}
		
		
	private function getgFileSourceExploded(){
		$this->gFileSourceExploded = explode('.', $this->gFile);
		$this->gFileSourceExplodedReverse = array_reverse($this->gFileSourceExploded);
		return array($this->gFileSourceExploded, $this->gFileSourceExplodedReverse);}
		
		
	private function RegMode(){
		global $Gougnon;
			$this->getgFileSourceExploded();		
			$this->fileType = ((count($this->gFileSourceExploded)<=1)?'':'.') . strtoupper($this->gFileSourceExplodedReverse[0]);
			$this->file = substr($this->file, 0, -1*strlen($this->fileType));
			$this->toString = strtoupper((count($this->gFileSourceExploded)<=1)?'nerc': 'erc');
		return $this;}
		

	/* Update : 160912.1103 */
	private function createARCEXT($ext){

		global $Gougnon;

		return $Gougnon::createFolders($this->arcPath . $ext);

	}
		
	/* Update : 160912.1103 */
	private function getARC(){
	
		$this->arcPath = $this->PATH . self::ARC_EXT;
	
		$this->arcFile = $this->arcPath . $this->fileType;
	
		$this->arcExists = is_dir($this->arcFile);
	
		return $this;
	
	}
		
		
	static public function isARC($fn){
		
		$path = dirname(__FILE__) . '/';

		// $fn = ;

		if(
			
			is_file($path . self::ARC_EXT . $fn . '/default.manifest')

			|| 

			is_file($path . self::ARC_SLASH_PATH . $fn . '/default.manifest')

		){

			return true;

		}

		else{

			$ex = explode('.', $fn);

			$rex = array_reverse($ex);

			if(isset($rex[0])){

				if(is_file($path . self::ARC_EXT . '.' . $rex[0] . '/default.manifest')){

					return true;
				}

			}

		}

		return false;

	}
		
		
	private function getARCVars(){
		$this->ARCINI = $this->arcFile . '/default.manifest';
		$this->ARCINIExists = is_file($this->ARCINI);
		return $this;}
		
	private function getRenderingEngine(){
		$this->RenderingEngine = $this->PATH . self::ARC_EXT_RENDERING . $this->fileType . '/' . $this->ARC['CONFIG']['RENDERING_ENGINE'] . self::ARC_EXT_RENDERING_EXT;
		$this->RenderingEngineExists = is_file($this->RenderingEngine);
		return $this;
	}
	
	private function getSlashPathRenderingEngine(){
		$this->RenderingEngine = $this->PATH . self::ARC_SLASH_PATH_RENDERING . $this->pathType . '/' . $this->ARC['CONFIG']['RENDERING_ENGINE'] . self::ARC_SLASH_PATH_RENDERING_EXT;
		$this->RenderingEngineExists = is_file($this->RenderingEngine);
		return $this;
	}
	
		
		
		
	/* Control de l'accès à partir du ARC */
	private function controlAccessAllow($access, $excludes, $return = false){
		$this_ = $this;

		$this->controlAccessError = true;

		Gougnon::clientsRefererControlAccess('-allow', explode(',', $access), explode(',', $excludes), function($code) use ($this_, $return){

			$this_->controlAccessActived = true;

			if($return===false){

				$this_->eventOn('ERROR.403', $code);

				$this_->close();

			}

		});

	}
		
	private function controlAccessDeny($access, $excludes, $return = false){
		$this_ = $this;

		$this->controlAccessError = true;

		Gougnon::clientsRefererControlAccess('-deny', explode(',', $access), explode(',', $excludes), function($code) use ($this_, $return){

			$this_->controlAccessActived = true;

			if($return===false){

				$this_->eventOn('ERROR.403', $code);

				$this_->close();

			}

		});

	}
		
	private function getControlAccessFromARCMode($ctrl){
	
		$scrt = explode(' from ', $ctrl);
	
		$accessMode = (isset($scrt[0]))?trim(strtolower($scrt[0])):FALSE;

		$this->controlAccessMode = $accessMode;

		return [$accessMode, (isset($scrt[1]))?strtolower($scrt[1]):FALSE ];
		
	}
		
	private function setControlAccessFromARC($ctrl, $excludes = [], $return = false){
	
		$strctrl = $this->getControlAccessFromARCMode($ctrl);
	
		$accessMode = $strctrl[0];
	
		$access = $strctrl[1];
		
		if($accessMode=='allow'){$this->controlAccessAllow($access, $excludes, $return);}

		if($accessMode=='deny'){$this->controlAccessDeny($access, $excludes, $return);}
			
		return $this;

	}
	
		
		
	protected function requireARCRender($arc){
		$arcRender = $this->PATH . self::ARC_EXT_RENDERING . $arc . self::ARC_EXT_RENDERING_EXT;
		$arcRenderExists = is_file($arcRender);
			if($arcRenderExists==FALSE){$this->eventOn('ERROR.REQUIRE.RENDERING.ENGINE.NOT.FOUND');}
			else{require $arcRender;}
	}
	

	public function requireARCRenderClass($class){
		$arcClass = $this->PATH . self::ARC_EXT_RENDERING . $class . self::ARC_EXT_RENDERING_CLASS_EXT;
		$arcClassExists = is_file($arcClass);
			if($arcClassExists==FALSE){$this->eventOn('ERROR.REQUIRE.RENDERING.ENGINE.CLASS.NOT.FOUND');}
			else{require $arcClass; }
	}
	

	/* Update : 160912.1103 */
	/* Page des ARC avec du contenu HTML. Cette option permet de racoursis l'acces au fichier dédié au ARC */
	public function ARCPage($Name){

		return __ARC_PAGES__ . $Name .'/index.php';
		
	}
			
	
		
		
	
	public function getSlashPath(){
		$path = $this->gFile;
		$slash = explode('/', $path);
		$this->ARCINI = $this->PATH . self::ARC_SLASH_PATH . strtoupper($slash[0]) . '/default.manifest';
		$this->ARCINIExists = (is_file($this->ARCINI))?true: false;
		$this->concatenate = $slash;
		$this->pathType = strtoupper($this->concatenate[0]);
		return (!$this->ARCINIExists)?false:$this->ARCINI;
	}
		
		
	protected function requireSlashPathARCRender($arc){
		$arcRender = $this->PATH . self::ARC_SLASH_PATH_RENDERING . $arc . self::ARC_EXT_RENDERING_EXT;
		$arcRenderExists = is_file($arcRender);
			if($arcRenderExists==FALSE){$this->eventOn('ERROR.REQUIRE.RENDERING.ENGINE.NOT.FOUND');}
			else{require $arcRender;}
	}
	
	public function requireSlashPathARCRenderClass($class){
		$arcClass = $this->PATH . self::ARC_SLASH_PATH_RENDERING . $class . self::ARC_EXT_RENDERING_CLASS_EXT;
		$arcClassExists = is_file($arcClass);
			if($arcClassExists==FALSE){$this->eventOn('ERROR.REQUIRE.RENDERING.ENGINE.CLASS.NOT.FOUND');}
			else{require $arcClass; }
	}
			
	
		
		
		
	
		
		
	static public function GLOBALS($var, $alt = false){return (isset($GLOBALS[$var]))?$GLOBALS[$var]:$alt;}
	
	static public function _SERVER($var, $alt = false){return (isset($_SERVER[$var]))?$_SERVER[$var]:$alt;}
	
	static public function _GET($var, $alt = false){return (isset($_GET[$var]))?$_GET[$var]:$alt;}
	
	static public function _POST($var, $alt = false){return (isset($_POST[$var]))?$_POST[$var]:$alt;}
	
	static public function _FILES($var, $alt = false){return (isset($_FILES[$var]))?$_FILES[$var]:$alt;}
	
	static public function _REQUEST($var, $alt = false){return (isset($_REQUEST[$var]))?$_REQUEST[$var]:$alt;}
	
	static public function _SESSION($var, $alt = false){return (isset($_SESSION[$var]))?$_SESSION[$var]:$alt;}
	
	static public function _ENV($var, $alt = false){return (isset($_ENV[$var]))?$_ENV[$var]:$alt;}
	
	static public function _COOKIE($var, $alt = false){return (isset($_COOKIE[$var]))?$_COOKIE[$var]:$alt;}
	



	/* utils */
	public function getCFileName(){

		$is = isset($this->concatenate);

		if($is){

			$row = count($this->concatenate);
			if($row==1){
				$file = false;
			}
			else{
				$f=[];
				for($x=1; $x<$row; $x++) {
					array_push($f, $this->concatenate[$x]);
				}
				$file = implode('/', $f);
			}

			return (is_bool($file))?false:$file;

		}

		else{
			return false; 
		}

	}



	
	/* Gestion d'erreur */
	public function SetMode($mode){
		
		switch($mode){
		
			case '-debug':
		
				$this->mode = '-debug';
		
				error_reporting(E_ALL);
		
				break;

		
			case '-release':
		
				$this->mode = '-release';
		
				error_reporting(0);
		
				break;

			}
			
		}
		

		

}
	





	
	
	
	
	
	
	
	
/*

	RegisterARC // DEBUT ///////////////////////////// 

*/

class RegisterARCData extends Register{
	



	static public function ExtManifest(){

		return ';Gougnon ' . self::NAME . ' ' . self::VERSION . ', ' . self::REEL_VERSION . '

[INFO]
NAME = 
AUTHOR = 
AUTHOR_WEBSITE = 
AUTHOR_EMAIL = 

[CONFIG]
;Entete
HEADER = content-type:text/html

;Securité
CONTROL-ACCESS = allow from all
CONTROL-ACCESS-EXCLUDES = 
OPENED_RIGHT = 0
ACCESS_OR_RIGHT = 0

;Dossiers et moteur de rendu
ROOT_SRC = *
RENDERING_ENGINE = default
ENGINE_TYPE = inc/file
EXT = *
';

	}




	static public function SlashManifest(){

		return ';Gougnon ' . self::NAME . ' ' . self::VERSION . ', ' . self::REEL_VERSION . '

[INFO]
NAME = 
AUTHOR = 
AUTHOR_WEBSITE = 
AUTHOR_EMAIL = 

[CONFIG]
;Entete
HEADER = content-type:text/html

;Securité
CONTROL-ACCESS = allow from all
CONTROL-ACCESS-EXCLUDES = 
OPENED_RIGHT = 0
ACCESS_OR_RIGHT = 0

;Moteur de rendu
RENDERING_ENGINE = default
';

	}




	static public function DPORendering($NAME){

		return '<?php

namespace GGN\DPO;


/* Jonction du ARC / DEBUT */

$_ARC_PAGE = $this->ARCPage("' . strtoupper($NAME) . '");


if(is_file($_ARC_PAGE)){


	/* DPO */

	global $_DPO_DEVICE;

	new Using("DPO\Page");

	new Using("DPO\Procedure");

	new Using("DPO\Theme");

	$_UsesAjax = UsesAjax();





	/* Initialisation de l\'ARC / DEBUT */

		$_ARC = new \RegisterARC("' . strtoupper($NAME) . '");

	/* Initialisation de l\'ARC / FIN */








	/* Initialisation du Template */

	$tpl = new Theme\Preset(\_GGN::varn("HOMEPAGE_THEME"));

	$tpl->Register = $this;



	/* Inclusion de la jonction du ARC */

	include $_ARC_PAGE;



	/* Moteur de rendu */

		if(!$_UsesAjax){

			$page = new Page\Init($tpl);

			$page->engine()->schema( (new Page\RenderingScheme())->html5 )->start();

		}

		if($_UsesAjax){

			$page = new Page\Init($tpl);

			$page->engine()->start(false, "body");

		}


}

else{

	$this->eventOn("ERROR.ARC", "' . strtoupper($NAME) . '");

}

/* Jonction du ARC / FIN */


?>
';

	}


}
	





	
	
	
	
	
	
	
	
/* RegisterLog // DEBUT ///////////////////////////// */

class RegisterLog extends Register{


	CONST Ext = '.ggn-log';


	static public function GetTypePath($Type = '', $Dir = false){

		global $GRegister;

		$Path = __CORES_SYSTEM__ . 'register/LOG/';

		if(is_string($Type)){

			if($Type == '-user' && is_array($GRegister->USER) && is_string($GRegister->USER['USERNAME']) ){ 

				$Path .= 'USERS/' . ((is_string($Dir)) ? $Dir : $GRegister->USER['UKEY']) . '/';

			}

			if($Type == '-arc' ){$Path .= 'ARC/'; }

			if($Type == '-history' ){$Path .= 'HISTORY/'; }

			if($Type == '-guest' ){$Path .= 'GUEST/' . ((is_string($Dir)) ? $Dir : __IP_UNIQUE__) . '/'; }

		}

		return $Path;

	}



	static public function Read($Type = false, $Name = '.index', $Dir = false){

		if(is_string($Name)){

			$Path = self::GetTypePath($Type, $Dir);

			$Path .= $Name . self::Ext;

			return (is_file($Path)) ? \GGN\File\Content::JSON($Path, \GStorages::JSON_OPT()) : [];

		}

		return false;

	}



	static public function Add($Type = false, $Name = '.index', $Comments = ''){

		if(is_string($Name)){


			/* TYPE / DEBUT */

				$Path = self::GetTypePath($Type);

				$Path .= $Name . self::Ext;

			/* TYPE / FIN */


			/* Contenu / DEBUT */

				$Data = (is_file($Path)) ? \GGN\File\Content::JSON($Path, \GStorages::JSON_OPT()) : []; 

				$Data[] = [

					"time" => time()

					, "content" => $Comments

					, "url" => \Gougnon::currentURL()

				];

			/* Contenu / FIN */

			if(!is_dir(dirname($Path))){\Gougnon::createFolders(dirname($Path));}

			if(\Gougnon::createFile($Path, json_encode($Data, \GStorages::JSON_OPT() ))){return true; }

		}

		return false;

	}

}
	
/* RegisterLog // FIN ///////////////////////////// */





	
	
	
	
	
	
	
	
/*

	RegisterARC // DEBUT ///////////////////////////// 

*/

class RegisterARC extends Register{
	

	public $Name = null;

	public $Type = null;


	public function __construct($Name = null, $Type = null){

		$this->args = func_get_args();


		$this->Name = $Name;

		$this->Type = $Type;


		$this->PATH = REGISTER_PATH;

		$this->EXT_NARC = $this->PATH . self::ARC_EXT;

		$this->EXT_RARC = $this->PATH . self::ARC_EXT_RENDERING;

		$this->SLASH_NARC = $this->PATH . self::ARC_SLASH_PATH;

		$this->SLASH_RARC = $this->PATH . self::ARC_SLASH_PATH_RENDERING;

	}






	/* Initialisation / DEBUT */

	public function Init($name = false, $type = false){

		$R = [];

		if(is_string($name) && is_string($type)){

			$Path = $this->PATH;

			$name = strtoupper($name);


			/* ARC:Ext / DEBUT */

				if($type == self::ARC_TYPE_EXT){

					$NARC = $this->EXT_NARC . ($name);

					$RARC = $this->EXT_RARC . ($name);


					/* Création des dossier / DEBUT */

						if(\Gougnon::createFolders($NARC)){

							$R[] = true;

							if(\Gougnon::createFile($NARC . '/default.manifest', RegisterARCData::ExtManifest() )){

								$R[] = true;

							}

						}

						if(\Gougnon::createFolders($RARC)){

							$R[] = true;

							if(\Gougnon::createFile($RARC . '/default' . self::ARC_EXT_RENDERING_EXT, RegisterARCData::DPORendering($name) )){

								$R[] = true;

							}

						}


					/* Création des dossier / FIN */

				}

			/* ARC:Ext / FIN */



			/* ARC:Slash / DEBUT */

				if($type == self::ARC_TYPE_SLASH){

					$NARC = $this->SLASH_NARC . ($name);

					$RARC = $this->SLASH_RARC . ($name);


					/* Création des dossier / DEBUT */

						if(\Gougnon::createFolders($NARC)){

							$R[] = true;

							if(\Gougnon::createFile($NARC . '/default.manifest', RegisterARCData::SlashManifest() )){

								$R[] = true;

							}

						}

						if(\Gougnon::createFolders($RARC)){

							$R[] = true;

							if(\Gougnon::createFile($RARC . '/default' . self::ARC_SLASH_PATH_RENDERING_EXT, RegisterARCData::DPORendering($name) )){

								$R[] = true;

							}

						}


					/* Création des dossier / FIN */

				}

			/* ARC:Slash / FIN */



		}

		return $R;

	}

	/* Initialisation / FIN */









	/* Modification / DEBUT */

	public function Set($Section, $VarName, $Value = ''){


		$Name = (isset($this->args[0])) ? strtoupper($this->args[0]) : false ;

		$Type = (isset($this->args[1])) ? $this->args[1] : false ;


		if( is_string($Name) && is_string($Type) ){

			$File = false;


			$Section = strtoupper($Section);

			$VarName = strtoupper($VarName);


			if($Type == self::ARC_TYPE_EXT){ 

				$File = $this->EXT_NARC . $Name . '/default.manifest';

			}

			if($Type == self::ARC_TYPE_SLASH){ 

				$File = $this->SLASH_NARC . $Name . '/default.manifest';

			}


			if(!is_file($File)){return false; }


			$C = file_get_contents($File);

			$M = parse_ini_string($C, TRUE);


			if(!isset($M[$Section]) || !is_array($M[$Section])){ $M[$Section] = []; }


			$M[$Section][$VarName] = $Value;

			return \_GGN::WriteINI($File, $M);


		}

		return false;

	}

	/* Modification / FIN */










	/* Suppression / DEBUT */

	public function Delete(){


		$Name = (isset($this->args[0])) ? strtoupper($this->args[0]) : false ;

		$Type = (isset($this->args[1])) ? $this->args[1] : false ;


		if( is_string($Name) && is_string($Type) ){

			$Manifest = false;

			$Engine = false;


			if($Type == self::ARC_TYPE_EXT){ 

				$Manifest = $this->EXT_NARC . $Name;

				$Engine = $this->EXT_RARC . $Name;

			}

			if($Type == self::ARC_TYPE_SLASH){ 

				$Manifest = $this->SLASH_NARC . $Name;

				$Engine = $this->SLASH_RARC . $Name;

			}



			if(is_dir($Engine)){

				$Scan = \Gougnon::iScanFolder($Engine);

				foreach ($Scan as $File) {\GGN\File\Remove($File);}

				rmdir(($Engine));

			}


			if(is_dir($Manifest)){

				$Scan = \Gougnon::iScanFolder($Manifest);

				foreach ($Scan as $File) {\GGN\File\Remove($File);}

				rmdir(($Manifest));

			}


			return true;

		}

		return false;

	}

	/* Suppression / FIN */









	/* Details / DEBUT */

	public function Detail(){

		$Return = [];

		$Name = (isset($this->args[0])) ? strtoupper($this->args[0]) : false ;

		$Type = (isset($this->args[1])) ? $this->args[1] : false ;


		if( is_string($Name) && is_string($Type) ){

			$Path = false;

			$Ext = false;


			if($Type == self::ARC_TYPE_EXT){ 

				$Path = $this->EXT_NARC . $Name . '/'; 

				$Ext = self::ARC_EXT_RENDERING_EXT;

			}

			if($Type == self::ARC_TYPE_SLASH){ 

				$Path = $this->SLASH_NARC . $Name . '/'; 

				$Ext = self::ARC_SLASH_PATH_RENDERING_EXT;

			}


			$Return['manifest'] = false;

			$Return['engine'] = false;
			

			if(is_string($Path)){

				$DM = $Path . "default.manifest";

				if(is_file($DM)){

					$C = file_get_contents($DM);

					$M = parse_ini_string($C, TRUE);

					$DE = ('default' . $Ext);

					$Return['engine'] = $DE;


					if(is_array($M)){

						$Engine = (isset($M['CONFIG']['RENDERING_ENGINE'])) ? $M['CONFIG']['RENDERING_ENGINE'] : $DE;

						$Return['engine'] = (is_file($Path . $Engine)) ? $Engine : $DE;

						$Return['manifest'] = $M;

					}


				}

			}

		}
		
		return $Return;

	}

	/* Details / FIN */










	/* Liste en fonction du type / DEBUT */

	public function GetList($type = false){

		$Out = [];

		$Path = false;


		if($type == self::ARC_TYPE_EXT){ $Path = $this->EXT_NARC; }

		if($type == self::ARC_TYPE_SLASH){ $Path = $this->SLASH_NARC; }



		if(is_string($Path)){

			$Scan = \Gougnon::iScanFolder($Path);

			foreach ($Scan as $M) {

				$B = basename($M);

				$D = dirname(dirname($M));

				$P = (substr($Path, -1) == '/') ? substr($Path, 0, -1) : $Path;

				if(basename($M) == 'default.manifest' && $P == $D){

					array_push($Out, basename(dirname($M)) );

				}
				
			}
			
		}

		return $Out;

	}

	/* Liste en fonction du type / FIN */










	/* PopState / DEBUT */

		public function PopState($PathName = false, $Default = 'index', $Prefix = '', $Ext = '.php', $Stripper = '/'){


			if(is_string($this->Name) ){

				$Name = $this->Name;

				$Path = __ARC_PAGES__ . strtoupper($Name) . '/';

				$Ex = explode($Stripper, $PathName);

				$ExLn = count($Ex);

				if($ExLn > 0 && !\Gougnon::isEmpty($PathName)){

					$Page = $Ex[$ExLn-1];

					$Inc = $Path . implode($Stripper, \Gougnon::arrayValues($Ex, 0, $ExLn));

					return $Prefix . $Inc . $Ext;

				}

				else{

					return $Path . $Prefix . $Default . $Ext;

				}


			}

			return false;

		}

	/* PopState / FIN */









}
	
/*

	RegisterARC // FIN ///////////////////////////// 

*/
	





	
	
	
	
	
	
	
	
/*

	Système de cache avec compilation // DEBUT ///////////////////////////// 

*/

class RegisterCaches extends Register{


	const _PATH_HTML = 'ggn.register.html';

	const _PATH_CSS = 'ggn.register.css';

	const _PATH_JS = 'ggn.register.js';




	/* Mémoire / DEBUT */

		static public function Memorize($Path, $Dynamic = true, $Update = false, $Type = '-text', $AddFile = false){

			new \GGN\Using('Caches');


			$Cache = new \GGN\Caches\Passive([
		
				'dir'=>$Path
			
				,'type'=>$Type
			
				,'name'=>Gougnon::pageUrlSelf()
			
				, 'update'=>$Update

				, 'dynamic'=>$Dynamic
			
			]);




			/* Ajout de nouveau Hash / DEBUT */

				if(is_array($AddFile)){

					foreach ($AddFile as $key => $File) {

						$Cache->addHash($File);
						
					}

				}

			/* Ajout de nouveau Hash / FIN */




			/* Chargement du cache / DEBUT */

				$Memorize = $Cache->Memorize();

				if(is_string($Memorize)){

					return $Memorize;

				}

			/* Chargement du cache / FIN */


			return false;

		}

	/* Mémoire / FIN */






	/* Déclaration / DEBUT */

		static public function State($Path, $Buffer, $Dynamic = true, $Update = false, $Type = '-text', $AddFile = false){

			new \GGN\Using('Caches');

			$Included = get_included_files();

			$Cache = new \GGN\Caches\Passive([
		
				'dir'=>$Path
			
				,'type'=>$Type
			
				,'name'=>Gougnon::pageUrlSelf()
			
				, 'update'=>$Update

				, 'dynamic'=>$Dynamic
			
			]);



			/* Enregisregemtn des Hash / DEBUT */

				if(is_array($AddFile)){

					$Included = \Gougnon::mergeArray($Included, $AddFile);

				}
			
				foreach ($Included as $File) {

					$Cache->addHash($File);
					
				}

			/* Enregisregemtn des Hash / FIN */




			/* Montage && verification du 'HASH' */

				$Cache->Hash();



			/* Chargement du cache / DEBUT */

				if($Cache->HashChanged==true){

					$Cache->Create($Buffer);

					return ($Buffer);

				}

			/* Chargement du cache / FIN */


		}

	/* Déclaration / FIN */





	/* Caches des fichiers HTML / DEBUT */

		static public function HTML($Buffer, $Dynamic = true, $Update = false, $Type = '-text', $Compact = true, $AddFile = false){

			return self::State(self::_PATH_HTML,  RegisterCompilator::HTML($Buffer, $Compact), $Dynamic, $Update, $Type, $AddFile);

		}

	/* Caches des fichiers HTML / FIN */





	/* Caches des fichiers CSS / DEBUT */

		static public function CSS($Buffer, $Dynamic = true, $Update = false, $Type = '-text', $Compact = true, $AddFile = false){

			return self::State(self::_PATH_CSS,  RegisterCompilator::CSS($Buffer, $Compact), $Dynamic, $Update, $Type, $AddFile);

		}

	/* Caches des fichiers CSS / FIN */






	/* Caches des fichiers JS / DEBUT */

		static public function JS($Buffer, $Dynamic = true, $Update = false, $Type = '-text', $Compact = true, $AddFile = false){

			return self::State(self::_PATH_JS, RegisterCompilator::JS($Buffer, $Compact), $Dynamic, $Update, $Type, $AddFile);

		}

	/* Caches des fichiers JS / FIN */




	
}
	
/*

	Système de cache avec compilation // FIN ///////////////////////////// 

*/




	
	
	
	
	
	
	
	
/*

	Compilation // DEBUT ///////////////////////////// 

*/

class RegisterCompilator extends Register{




	/* HTML / DEBUT */

		static public function HTML($Buffer, $Compact = true){

			// if($Compact == true){

			// 	$OutPut = '';


			// 	$Lines = explode("\n", $Buffer);


			// 	foreach ($Lines as $key => $Line) {

			// 		$tLine = ltrim(rtrim($Line));

			// 		$tLine = str_replace("\t", "", $tLine);

			// 		$OutPut .= $tLine;

			// 	}


			// 	return $OutPut;

			// }

			// else{

				return $Buffer;

			// }

		}

	/* HTML / FIN */





	/* CSS / DEBUT */

		static public function CSS($Buffer, $Compact = true){

			// if($Compact == true){

			// 	$OutPut = '';


			// 	$Lines = explode("\n", $Buffer);


			// 	foreach ($Lines as $key => $Line) {

			// 		$tLine = ltrim(rtrim($Line));

			// 		$tLine = str_replace("\t", "", $tLine);

			// 		$OutPut .= $tLine;

			// 	}


			// 	return $OutPut;

			// }

			// else{

				return $Buffer;

			// }

		}

	/* CSS / FIN */





	/* JS / DEBUT */

		static public function JS($Buffer, $Compact = true){

			if($Compact == true){

				$OutPut = '';

				$Buffers = $Buffer;


				// $Buffers = preg_replace('/\/\/[^\n]?/', "", $Buffers);

				$Buffers = preg_replace('/\/\*(.*)\*\//', "", $Buffers);

				$Buffers = preg_replace('!/\*.?\*/!s', "", $Buffers);

				$Buffers = preg_replace('/\n\s*\n/', "\n", $Buffers);


				$Lines = explode("\n", $Buffers);


				foreach ($Lines as $key => $Line) {

					$tLine = ltrim(rtrim($Line));

					$tLine = str_replace("\t", "", $tLine);

					if(substr($tLine, 0, 2) == '//'){continue;}

					$OutPut .= $tLine . "\n";

				}
				

				return $OutPut;

			}

			else{

				return $Buffer;

			}

		}

	/* JS / FIN */


	
}
	
/*

	Compilation // FIN ///////////////////////////// 

*/




	
	
	
	
	
	
	
	
/*

	Little Secure // DEBUT ///////////////////////////// 

*/

class RegisterSecure extends Register{


	/* System de Jeton : Token / DEBUT */

		const SID = 'GGN_Tk_SESSION';


		const EXT = '.reg-token';

		const EXTex = '.reg-token-ex';

		// const TkDIR = 'SECURE_AUTH_TOKEN/';

		// const TkExDIR = 'SECURE_AUTH_TOKEN_EXCEPTION/';


		const DURATION = 900;

		const DELIMITER = '::';



		static public function xSID(){

			return \_GGNCrypt::_sha256(self::SID . HTTP_HOST);

		}


		static public function Token(){

			self::DestroyToken();

			return self::CreateToken();

		}


		protected static function TokenFKey($new = false){

			if($new === true){

				return 'rls.tkn.' . _GGNCrypt::_sha256(__IP_UNIQUE__ . _GGNCrypt::RKCRandm( _GGNCrypt::PALETTE_iALPHA . ' ' . _GGNCrypt::PALETTE_NUMERIC ), 1);
				
			}

			else{

				if(isset($_SESSION[self::xSID()])){return $_SESSION[self::xSID()];}

				else{return 'rls.tkn.' . _GGNCrypt::_sha256(__IP_UNIQUE__ . _GGNCrypt::RKCRandm( _GGNCrypt::PALETTE_iALPHA . ' ' . _GGNCrypt::PALETTE_NUMERIC ), 1);}

			}

		}


		protected static function TokenFile($FKey = false){

			$FKey = (!is_string($FKey)) ? self::TokenFKey() : $FKey ;

			return __CORES_REGISTER_TOKENS__ . $FKey . self::EXT;

		}


		protected static function GetToken($FKey = false){

			$File = self::TokenFile($FKey);

			if(is_file($File)){

				return file_get_contents($File);

			}

			else{

				return false; 
				
			}


		}



		protected static function DestroyToken(){

			// if(isset($_SESSION[self::xSID()])){

			// 	$old = self::TokenFile($_SESSION[self::xSID()]);

			// 	if(is_file($old)){\GGN\File\Remove($old);}

			// 	unset($_SESSION[self::xSID()]);
				
			// }

		}

		protected static function CreateToken(){

			$Duration = _GGN::varn('REGISTER_SECURE_TOKEN_DURATION') * 1;

			$Duration = (is_numeric($Duration) && $Duration > 0) ? $Duration : self::DURATION;


			$Expire = (time() + $Duration);

			$RRef = (is_string(__HTTP_REFERER__)) ? ((substr(__HTTP_REFERER__, 0, strlen(HTTP_HOST)) == HTTP_HOST) ? __HTTP_REFERER__ : '') : '';

			$Key = 

				_GGNCrypt::_sha256( 

					_GGNCrypt::RKCRandm(

						_GGNCrypt::PALETTE_iALPHA . ' ' . _GGNCrypt::PALETTE_NUMERIC

					)

				, 3) 

				. self::DELIMITER 
				
				. $Expire 
				
				. self::DELIMITER 
				
				. \Gougnon::currentURL() 
				
				. self::DELIMITER 
				
				. $RRef

			;


			$FKey = self::TokenFKey(true);

			$File = self::TokenFile($FKey);

			$Dir = dirname($File);


			if(!is_dir($Dir)){\Gougnon::createFolders($Dir);}

			if(\Gougnon::createFile($File, $Key)){

				$_SESSION[self::xSID()] = $FKey;

				return $FKey;

			}

			return null;

		}



		static function TokenException($Name, $To = false){

			if(is_string($Name)){

				$TName = $Name . '-' . __IP_UNIQUE__;

				$Treat = (is_string($To)) ? HTTP_HOST . $To : \Gougnon::currentURL();

				$Key = '.TkEx-' . _GGNCrypt::_sha256(date('YmdHis'), 3);

				$Data = $Key . self::DELIMITER . \Gougnon::currentURL() . self::DELIMITER . $Treat;

				$File = self::TokenExceptionFile($TName);

				$Dir = dirname($File);

				if(!is_dir($Dir)){\Gougnon::createFolders($Dir);}

				$Create = \Gougnon::createFile($File, $Data);

				if($Create){return [$Name,$Key];}

				if(!$Create){return false;}

			}

			else{

				return false;

			}

		}

		static function TokenExceptionFile($Name = false){

			if(is_string($Name)){

				return __CORES_REGISTER_TOKENS_EX__ . $Name . self::EXTex;

			}

			else{

				return false;

			}

		}

		static function AcceptTokenException(){


			$Name = self::_POST('ggn-registry-token-exception', false);

			$Key0 = self::_POST('ggn-registry-token-exception-key', false);

			$Ref0 = __HTTP_REFERER__;


			if(is_string($Name) && is_string($Name) && is_string($Ref0)){

				$TName = $Name . '-' . __IP_UNIQUE__;

				$File = self::TokenExceptionFile($TName);

				// print_r($File);exit;

				if(is_file($File)){

					$Dat = file_get_contents($File);

					$Data = explode(self::DELIMITER, $Dat);

					$Treat0 = \Gougnon::currentURL();


					$Key = $Data[0];

					$Ref = (isset($Data[1])) ? $Data[1] : false;

					$Treat = (isset($Data[2])) ? $Data[2] : false;


					if($Key0 != $Key && is_string($Key)){return false;}

					if($Ref0 != $Ref && is_string($Ref)){return false;}

					if($Treat0 != $Treat && is_string($Treat)){return false;}
					

					return true;

				}

				else{

					return false;

				}

			}

			else{

				return false;

			}

		}



		static function AcceptToken(){

			$Posted = self::_POST('ggn-registry-token', false);

			$Referer = __HTTP_REFERER__;

			$FKey = self::TokenFKey();



			if(is_string($Posted) && ($Posted == $FKey) && is_string($Referer)){

				$N = self::GetToken($Posted);

				$C = self::GetToken();


				if($N == $C){

					$Get = explode(self::DELIMITER, $N);

					if(isset($Get[1]) && isset($Get[2]) && isset($Get[3])){

						$Time = $Get[1];

						$Ref = $Get[2];

						$RRef = (\Gougnon::isEmpty($Get[3])) ? false : $Get[3];

						if($Time > time() && ($Ref==$Referer || $RRef==$Referer) ){

							self::DestroyToken();

							return true;

						}

						else{

							return false;

						}


					}

					else{

						return false;

					}


				}

				else{

					return false;

				}

			}

			else{

				return false;

			}

		}


	/* System de Jeton : Token / FIN */




	/* Restriction du nombre de fois qu'une page est demander / DEBUT */




		public function CountingFailures($try = 5){


			$Cl = (new \_GGNCustomObject());

			$Cl

				->_State('SID', 'rlsct')

				->_State('CfDIR', 'SECURE_AUTH_COUNT_FAIL/')

				->_State('TimeOut', 5*60)

				// ->_State('SIDTm', 'rlscttm')

				->_State('Rest', false)

				->_State('RestTime', false)

				->_State('Limit', $try)


				->_State('StoFile', function($name = '') use($Cl){

					$Dir = dirname(__FILE__) . '/' . $Cl->CfDIR;

					$File = $Dir . $name . '-' .  _GGNCrypt::_sha256(__IP_UNIQUE__);

					if(!is_dir($Dir)){\Gougnon::createFolders($Dir);}

					return $File;

				})

				->_State('CreateStoFile', function($name, $data = "") use($Cl){
					
					$File = $Cl->StoFile($name);

					$data .= "";

					\Gougnon::createFile($File, $data);

					return $File;

				})

				->_State('GetStoFile', function($name) use($Cl){
					
					$File = $Cl->StoFile($name);

					return (is_file($File)) ? file_get_contents($File) : 0;

				})

				->_State('RemoveStoFile', function($name) use($Cl){
					
					$File = $Cl->StoFile($name);

					return (is_file($File)) ? \GGN\File\Remove($File) : false;

				})


				->_State('Accept', function() use($Cl){

					$Count = $Cl->GetCount();

					$Limit = $Cl->Limit;

					$Cl->Rest = $Limit - $Count;

					$TimeOver = $Cl->TimeOver();

						$Cl->Rest = ($Cl->Rest < 0 ) ? 0 : $Cl->Rest;



					if($Count > $Limit){


						if($TimeOver === true){

							$Cl->Destroy();

							return true;

						}

						return false;

					}

					else{

						if($Count == $Limit){

							$Cl->SetTimeOut();

						}

						return true;

					}

					// return [$Limit, $Count, $TimeOver, $Cl->Rest, time(), $Cl->GetTime() ];

				})

				->_State('GetCount', function() use($Cl){

					return  $Cl->GetStoFile('count');

				})

				->_State('Count', function() use($Cl){

					return $Cl->CreateStoFile('count', $Cl->GetCount('count') + 1);

				})

				->_State('TimeOver', function() use($Cl){

					$Time = $Cl->GetTime();

					if(($Time > time()) ){

						return false;

					}

					else{

						return true;

					}

				})

				->_State('SetTimeOut', function() use($Cl){

					$nT = time() + $Cl->TimeOut;

					$Cl->CreateStoFile('time', $nT);

					return $nT;

				})

				->_State('GetTime', function() use($Cl){

					return $Cl->GetStoFile('time');

				})

				->_State('GetRemainingTime', function() use($Cl){

					$Time = $Cl->GetTime() - time();

					return ($Time < 0) ? 0 : $Time;

				})

				->_State('Destroy', function() use($Cl){


					$Cl->RemoveStoFile('count');

					$Cl->RemoveStoFile('time');

				})

			;

			return $Cl;

		}

	/* Restriction du nombre de fois qu'une page est demander / FIN */


	
}

/*

	Little Secure // FIN /////////////////////////////

*/



	
	
	
	
	
	
	
	
/*

	Meta // DEBUT /////////////////////////////

*/
class RegisterMeta extends Register{


	const INCVALUE = '<inc.value>';

	const EXT = '.meta';


	const FILEINST = '<file.inst>';

	const DIRINST = '<dir.inst>';




	var $Type = false;

	var $oFile = false;

	var $File = false;

	var $Loaded = false;


	
	public function __construct($path){

		if(is_file($path)){

			$this->Type = self::FILEINST;

			$this->oFile = $path;

			$this->File = $path . self::EXT;

			$this->Load();

		}

		else{

			if(is_dir($path)){

				$this->Type = self::DIRINST;

			}

		}

	}

	
	public function Load(){

		if($this->Type === self::FILEINST){

			if(!is_file($this->File)){

				$d = [];

				$d['name'] = basename($this->oFile);

				$d['size'] = filesize($this->oFile);

				$d['counter'] = 0;

				$d['time.created'] = time();

				if(Gougnon::createFile($this->File, json_encode($d, GStorages::JSON_OPT())) ){

					$l = $d;

				}


			}

			else{

				$d = file_get_contents($this->File);

				$l = json_decode($d, GStorages::JSON_OPT());

			}


			$this->Loaded = $l;

		}

	}

	
	public function Update($key, $value = null, $mode = false){

		$l = $this->Loaded;


		if(is_array($l)){

			$l[$key] = (isset($l[$key])) ? $l[$key] : null;

			$v = $l[$key];


			if($mode == self::INCVALUE){


				$v = is_numeric($v) ? $v : 0;

				$v += $value;

				$l[$key] = $v;

			}

			else{

				$l[$key] = $value;

			}

		}

		$this->Loaded = $l;

	}

	
	public function Save(){

		$l = (is_array($this->Loaded) || is_object($this->Loaded)) ? $this->Loaded : [];

		$l['time.updated'] = time();

		if(Gougnon::createFile($this->File, json_encode($l, GStorages::JSON_OPT())) ){

			return true;

		}

		else{

			return false;

		}

	}


}







	
	
	
	
	
	
	
/*
==========RENDER=================
*/
class Render extends Register{
	
	const T_NORM = '-nomalize';
	const T_NTS = '-native.script';
	const T_NTSC = '-native.script.code';
	const T_NRMSC = '-native.normalize.script.code';
	const T_NDCWR = '-native.doc.write';
	
	
	const attrLib = 'LIB';
	const attrPHP = 'PHP';
	const attrCSS = 'CSS';
	const attrJS = 'JS';
	const attrHTML = 'HTML';
	const attrAUN = 'AUN';
	const attrSYSJS = 'FRAMEWORK-JS';
	const attrSYSCSS = 'FRAMEWORK-CSS';
	
	
	const _JSLib = '-:js.lib';
	const _PHPLib = '-:php.lib';
	const _HTMLLib = '-:html.lib';
	const _CSSLib = '-:css.lib';
	
	
	static public function fileSources($file){
		return (is_file($file))?file_get_contents($file):FALSE;
		}
	
		
		
	static public function serverRootVars($data){
		global $_Gougnon;
		foreach($_Gougnon as $n=>$v){$data = str_replace('{%'.$n.'%}', $v, $data);}
		return $data;}
	
		
		
	static public function loadFile($dom,$file){
		return @$dom->load($file);
		}
	
	
	static public function innerNodeByTagName($node, $name){
		$C14N = $node->C14N();
		$res = substr($C14N, strlen('<'.$name.'>'), -1*(strlen('</'.$name.'>')));
		return $res;}
		
		
	static public function nodeScanner($toScan){
		$data = array();
		$data['NODES'] = array();
		$data['CHILDNODES'] = array();
		$isset = @isset($toScan->childNodes);
			if($isset){
				foreach($toScan->childNodes as $node){
					$data['NODES'][strtoupper($node->nodeName)] = (isset($data['NODES'][strtoupper($node->nodeName)]))?$data['NODES'][strtoupper($node->nodeName)]: array();
					$data['CHILDNODES'][strtoupper($node->nodeName)] = (isset($data['CHILDNODES'][strtoupper($node->nodeName)]))?$data['CHILDNODES'][strtoupper($node->nodeName)]: array();
					array_push($data['NODES'][strtoupper($node->nodeName)], $node);
					array_push($data['CHILDNODES'][strtoupper($node->nodeName)], self::nodeScanner($node));
					}
				}
		return $data;
		}
	
	
	static public function nodeScannerLast($toScan){
		$data = array();
		$data['NODES'] = array();
		$data['CHILDNODES'] = array();
		$isset = @isset($toScan->childNodes);
			if($isset){
				foreach($toScan->childNodes as $node){
					$scnlen = count($scn);
					$data['NODES'][strtoupper($node->nodeName)] = $node;
					$data['CHILDNODES'][strtoupper($node->nodeName)] = self::nodeScannerSchemas($node);
					}
				}
		return $data;
		}
		
		
	static public function getNodeAttributes($node){
		$attrib=array();
		if(isset($node)){
			if(isset($node->attributes)){
				if($node->hasAttributes()){
					foreach($node->attributes as $attr){
						$attrib[strtolower($attr->nodeName)] = $attr->nodeValue;
						}
					}
				}
			}
		return $attrib;}
		
	
	
	static public function sterilizeString($string){
		return addslashes($string);
		}
	
	
	static public function writeQuotes($string){
		$string = self::sterilizeString($string);
		return str_replace('\"', '"', $string);
		}
	
	
	static public function toJSDocWrite($string){
		$string = htmlentities($string, ENT_QUOTES, 'utf-8');
		$string = self::alignHString($string);
		return str_replace('&lt;', '<', str_replace('&gt;', '>', $string ) );
		}
		
		
	static public function alignHString($string){
		$a = explode("	", $string);$b=array();
		for($x=0; $x<count($a); $x++){ array_push($b, rtrim(ltrim($a[$x]))); }
		return implode(" ", $b);
		}
		
	
	
	
	static public function nativeHTML($doctype = 'html', $head = '', $body = ''){
		$html = '';
		$html .= '<!-- Gougnon Native HTML -->';
		$html .= '<!DOCTYPE '.$doctype.'>';
		$html .= '<HTML>';
		$html .= '<HEAD>';
		$html .= $head;
		$html .= '</HEAD>';
		$html .= '<BODY>';
		$html .= $body;
		$html .= '<!-- Copyright '.gmdate('Y').' Gougnon GOBOU Y. Yannick - Code Source du Générateur - Tous droits réservés -->';
		$html .= '</BODY>';
		$html .= '</HTML>';
		return $html;
		}
		
		
		
	static public function nativeHTMLProtected($doctype = 'html', $head = '', $body = ''){
		$html = '';
		$html .= '_GGN::write(\'<!DOCTYPE '.$doctype.'>';
		$html .= '<HTML>';
		$html .= '<HEAD>';
		$html .= '<!-- Gougnon Native HTML -->\');';
		$html .= $head;
		$html .= '_GGN::write(\'</HEAD>';
		$html .= '<BODY>\');';
		$html .= $body;
		$html .= '_GGN::write(\'<!-- Copyright 2013 Gougnon - '.gmdate('Y').' GOBOU Y. Yannick - Code Source du Générateur - Tous droits réservés -->';
		$html .= '</BODY>';
		$html .= '</HTML>\');';
		return $html;
		}
		
		
		
	
		
	}
	
 
 
 
?>