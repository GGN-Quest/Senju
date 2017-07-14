<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS Gougnon
	PAGE cores/_GGNs/PHP/ggn.core/.class.php
======================================================

*/

global $_Gougnon;

/* Verification */
if(!class_exists('_GGN')){exit('Class Native introuvable');}
if(!class_exists('Gougnon')){_GGN::wCnsl('Class Gougnon introuvable');}

if(!isset($_Gougnon)){
	_GGN::wCnsl('Erreur Données Manquantes: Variable Gougnon ');
}


$USERS_NATIVE_VARS = 'USERS_SECURE_PASSWORD_LEVEL USERS_SESSION_MANAGER_PLUGIN_PLG USERS_SESSION_LOCATION USERS_SESSION_MANAGER_PLUGIN_NAME';

_GGN::keyExists(explode(' ',$USERS_NATIVE_VARS));


if(!class_exists(_GGN::varn('USERS_SESSION_MANAGER_PLUGIN_NAME'))){
	Gougnon::loadPlugins(_GGN::varn('USERS_SESSION_MANAGER_PLUGIN_PLG') );
}




/* CONSTANTE ID MODULES */
define('GUSERS_MOD_UPLOAD_PHOTO_PROFILE', 'MOD::UPLOAD.PHOTO.PROFILE:' . _GGNCrypt::RKCRandm(_GGNCrypt::PALETTE_NUMERIC, 4));






if(!class_exists('GUSERS')){

	class GUSERS
	{

		/* INFOS */
		CONST NAME = 'Gougnon Users Core';
		
		CONST VERSION = '0.1';
		
		CONST REEL_VERSION = '0.1.170628.1228';
		
		CONST TYPE = 'PHP.CORE';
		
		
		
		
		
		
		
		
		/* RESSOURCES */
		CONST CPREF = 'function';
		
		CONST FUNCTIONS_STORE = 'functions/';
		
		CONST CSUF = 'PHPCore.php';



		CONST TBL_USERS = 'NATIVE_USERS';

		CONST TBL_BLOGS = 'NATIVE_USERS_BLOGS';
		
		CONST TBL_IDENTIY = 'NATIVE_USERS_IDENTITY';
		
		CONST TBL_IDENTIY_ACTIVE = 'NATIVE_USERS_IDENTITY_ACTIVE';


		CONST CRYKLEN = 256;

		CONST PWCRYDT = 3;

		CONST PWCRYKEY = 3;





		var $arguments=false;
		
		var $username=false;
		
		var $password=false;
		
		var $__autoMode=false;
		
		var $__mode=false;
		
		var $getter=false;
		

		
		var $__password=false;
		
		
		
		
		
		
		/* CONSTRUCTEUR */
		public function __construct(){
			global $_Gougnon;

			$this->arguments = func_get_args(); 
			$this->username = (isset($this->arguments[0]))?(($this->arguments[0]!=false)?$this->arguments[0]:false):false;
			$this->password = (isset($this->arguments[1]))?(($this->arguments[1]!=false)?$this->arguments[1]:false):false;
			$this->__mode = (isset($this->arguments[2]))?(($this->arguments[2]!=false)?$this->arguments[2]:false):false;


			if($this->username!=false){
				$this->username=ltrim(rtrim($this->username));
				$this->__autoMode=(preg_match(_GGN::PATTERN_EMAIL, $this->username))?'-email':'-username';


				$this->sessionClass = _GGN::varn('USERS_SESSION_MANAGER_PLUGIN_NAME');

				$CLASS=$this->sessionClass;
				$this->sessionLocation=strtolower(_GGN::varn('USERS_SESSION_LOCATION'));
				$this->sessionLocation=($this->sessionLocation=='-offline.session')?$CLASS::OFFLINE:$CLASS::ONLINE;
			}
		}

		
		
		/* FUNCTIONS */
		static public function getCoreFolder(){
			return dirname(__FILE__) . '/';	
		}
			
			
			
		public static function __callStatic($F,$A){
			return self::loadNewFunction($F,$A, '-s');	
		}
			
			
			
		public function __call($F,$A){
			$this->loadNewFunction($F,$A, '-d');	
		}
			
			
		protected static function loadNewFunction($func,$args,$calledMode){
			global $Gougnon, $GLANG;
			
			$funcCompo = self::getCoreFolder() . '/' . self::FUNCTIONS_STORE . self::CPREF . '.' . $func . '.' . self::CSUF;
			if(file_exists($funcCompo)){
				if($calledMode == '-s'){ return include $funcCompo; }
				if($calledMode == '-d'){ include $funcCompo; }
				 }
				
			if(!file_exists($funcCompo)){ _GGN::wCnsl("Erreur: <b>" . ($func) . "</b> n'existe pas"); }
			
		}



		/* Utils =========== */
		static public function get($query, $method = false, $tbl = false){

			global $database;

			$tbl = is_string($tbl) ? $tbl : self::TBL_USERS;

			$getter = $database->SelectFromTable($tbl, $query);

			if($getter==false){return '-query.failed';}

			$getter=$getter->results($method);

			if($getter->row>=1){return $getter;}
			
			return FALSE;
		}

		static public function byUserName($username, $method = false){

			return self::get("WHERE USERNAME='".$username."' ", $method);

		}

		static public function byEmail($email, $method = false){

			return self::get("WHERE EMAIL='".$email."' ", $method);

		}

		static public function byUkey($ukey, $method = false){

			return self::get("WHERE UKEY='".$ukey."' ", $method);

		}

		static public function GetBlogByID($bid, $method = false){

			return self::get("WHERE BID='".$bid."' ", $method, self::TBL_BLOGS);

		}




		public function userNameExists(){
		
			global $database;
		
			$this->_mode();

			$query="WHERE ";

			$query.=$this->_uquery;


			$query.=" ORDER BY VERS DESC";


			$getter = $database->SelectFromTable(self::TBL_USERS, $query);

			if($getter==false){return '-query.failed';}

			$getter=$getter->results();

			if($getter->row>1){return 'conflit.multiple';}

			if($getter->row==1){return $getter;}
			
			return FALSE;
		}




		public function exists($gm = false){
			global $database;

			self::deactivateExpiredUsers();

			$this->_mode();

			$getPassword = $this->_password();


			if($getPassword===false){
				return '-user.not.found';
			}

			if($getPassword=='-user.not.activated'){
				return $getPassword;
			}


			$this->query="WHERE ";
			$this->query.=$this->_uquery;
			$this->query.=" AND ";
			$this->query.=$this->_pwquery;
			$this->query.=" ORDER BY VERS DESC";

			$this->getter = $database->SelectFromTable(self::TBL_USERS, $this->query);




			if($this->getter==false){return '-query.failed';}

			$this->getter=$this->getter->results($gm);


			if($this->getter->row===1){return TRUE;}
			if($this->getter->row>1){return '-conflit.multi.users';}
			
			return FALSE;
		}
		
		public function data(){
			global $database;
			$a = func_get_args();
			$key = (isset($a[0]))?((is_string($a[0]))?$a[0]:'false'):'false';

			if($this->exists()!==FALSE){
				return (!isset($this->getter))?false:((isset($this->getter->data[$key]))?$this->getter->data[$key][0]:$this->getter->data);
			}
			return FALSE;
		}
		






		static public function getAccess($idaccess, $gm = false){
			global $database;

			$query="WHERE ";
			$query.=" IDACCESS='".$idaccess."'";
			$query.=" AND ";
			$query.=" ACCEPT='1' ORDER BY VERS DESC LIMIT 0,1";

			$getter = $database->SelectFromTable(self::TBL_USERS, $query);

			if($getter==false){return false;}
			$getter=$getter->results($gm);

			if($getter->row===1){return $getter;}
			return FALSE;
			
		}
		






		public function update($field, $_value, $ukey = false){

			global $database;

			$field = strtolower($field);

			$value = $_value;

			$q = "SET ";

			// if($this->getter===false){return false;}

			if($field != 'vers' && $field != 'ukey' && $field != 'password' && $field != 'decrypkey' && $field != 'datetime'){

				$q .= strtoupper($field);

				$q .= "='";

				$q .= addslashes($value);

				$q .= "' ";

				$q .= "WHERE ";

				$q .= (is_string($ukey)) ? " UKEY='" . $ukey . "' " :   " VERS='" .$this->getter->data[0]['VERS'] . "' ";

				$q .= " ";

				$up = $database->UpdateTable(self::TBL_USERS, $q);

				if($up!==false){

					return TRUE;

				}

			}

			return FALSE;
		}








		private function _mode(){
			global $_Gougnon;


			$this->mode=($this->__mode!=false)?$this->__mode:$this->__autoMode;


			if($this->mode=='-email'){

				$this->_uquery = "EMAIL='" . $this->username . "' ";

			}
			
			else{
				if($this->mode=='-all'){

					$this->_uquery = "USERNAME='" . ($this->username) 

						. "' || EMAIL='" . (isset($this->email) ? $this->email : $this->username) . "' " 

						// . ((isset($this->phone) ?  "' || PHONE LIKE '%" . $this->phone . "%' " : "")

					;

				}

				else{

					$this->mode = $this->__autoMode;

					$this->_uquery = "USERNAME='" . $this->username . "' ";

				}

			}

			$this->_uquery = "(" . $this->_uquery . ")";

			return $this;
		}





		private function _password(){
			$pw = $this->engine_passwordCrypt();

			if($pw!==false){
				$this->__password=$pw;
				$this->_pwquery=" PASSWORD='";
				$this->_pwquery.=$pw;
				$this->_pwquery.="' ";
			}

			return $pw;
		}





		protected function engine_passwordCrypt(){ /* Require : $this->_mode(); */
			global $database;

			$pw=false;

			$r_query = "WHERE ";
			$r_query .= $this->_uquery;
			$r_query .= " ORDER BY VERS DESC";

			$reserves = $database->SelectFromTable(self::TBL_USERS, $r_query);

			

			if($reserves!=false){
				$reserves=$reserves->results();

				if($reserves->row>0){
					if($reserves->data['ACCEPT'][0]=='0'){return '-user.not.activated';}
					else{
						$decrypKey = $reserves->data['DECRYPKEY'][0];
						$pw = _GGNCrypt::RKCDrash(hash('sha256',$this->password),$decrypKey,self::PWCRYDT, self::PWCRYKEY);
						// exit('<textarea style="width:100%;height:100px;">' . $pw . '</textarea>');
					}
				}

			}


			return $pw;
		}


 


		static protected function engine_decrypKey($length){
			global $_Gougnon;

			$palette="";


			if(strtolower(_GGN::varn('USERS_SECURE_PASSWORD_LEVEL')) == '-normal'){
				$palette = _GGNCrypt::PALETTE_NORMAL;
			}
			else{
				if(strtolower(_GGN::varn('USERS_SECURE_PASSWORD_LEVEL')) == '-low'){
					$palette = _GGNCrypt::PALETTE_LOW;
				}

				else{
					$palette = _GGNCrypt::PALETTE_HIGH;
				}

			}


			return _GGNCrypt::RKCRand($palette,$length);

		}




		public function updatePassword(){
			global $database;

			$this->exists();

			$pw=$this->_password();
			$decrypKey = $this->engine_decrypKey(self::CRYKLEN);
			$password = self::passwordMaker($this->password, $decrypKey);
			$result = 0;
			$Q=$this->_uquery;

			if($database->UpdateTable(self::TBL_USERS, " SET DECRYPKEY='".$decrypKey."' WHERE $Q ")){
				$result++;
				if($database->UpdateTable(self::TBL_USERS, " SET PASSWORD='".$password."' WHERE $Q ")){
					$result++;
				}
			}

			return $result;
		}




		static protected function passwordMaker($password, $decrypKey){

			return _GGNCrypt::RKCDrash(hash('sha256',$password), $decrypKey, self::PWCRYDT, self::PWCRYKEY);
			
		}




		static public function iUpdatePassword($ukey, $pwd){

			global $database;

			$decrypKey = self::engine_decrypKey(self::CRYKLEN);
			
			$password = self::passwordMaker($pwd, $decrypKey);
			
			$result = 0;

			$userq = $database->SelectFromTable(self::TBL_USERS, " WHERE UKEY='$ukey' ");

			$Q = "UKEY='".$ukey."' ORDER BY VERS DESC";
			
			if($database->UpdateTable(self::TBL_USERS, " SET DECRYPKEY='".$decrypKey."' WHERE $Q ")){
			
				$result++;
			
				if($database->UpdateTable(self::TBL_USERS, " SET PASSWORD='".$password."' WHERE $Q ")){
			
					$result++;
			
				}
			
			}

			return ($result>=2)?true:false;

		}
















		/* IDENTITÉ : Recherche */
		static public function identity($ukey, $type = true){

			global $database, $_Gougnon;

			$get = $database->SelectFromTable(self::TBL_IDENTIY, " WHERE UKEY='$ukey' ");

			if(is_object($get)){

				$get->results($type);

				return $get;

			}

			return false;

		}




		/* IDENTITÉ : Création / Mise à jour */
		static public function updateIdentity($ukey, $firstname, $lastname, $nickname, $sexe, $birth){

			global $database, $_Gougnon;


			$get = $database->SelectFromTable(self::TBL_IDENTIY, " WHERE UKEY='$ukey' ");

			if(is_object($get)){

				$get->results();


				if($get->row <= 0){
					

					if($database->InsertIntoTable(self::TBL_IDENTIY, " VALUES(NULL, '$ukey', '$firstname', '$lastname', '$nickname', '$sexe', '$birth', '" . time() . "', '1') ")){

						return true;

					}

				}

				else{

					$database->UpdateTable(self::TBL_IDENTIY, " SET FIRSTNAME='$firstname' WHERE UKEY = '$ukey' ");

					$database->UpdateTable(self::TBL_IDENTIY, " SET LASTNAME='$lastname' WHERE UKEY = '$ukey' ");

					$database->UpdateTable(self::TBL_IDENTIY, " SET NICKNAME='$nickname' WHERE UKEY = '$ukey' ");

					$database->UpdateTable(self::TBL_IDENTIY, " SET SEXE='$sexe' WHERE UKEY = '$ukey' ");

					$database->UpdateTable(self::TBL_IDENTIY, " SET BIRTH='$birth' WHERE UKEY = '$ukey' ");

					return true;

				}


			}


			return false;

		}




		/* IDENTITÉ : creation */
		// static public function createIdentity($data){

		// 	global $database, $_Gougnon;

		// 	$data['UKEY'] = (isset($data['UKEY']))?$data['UKEY']:false;

		// 	if($data['UKEY']===false){return false;}

		// 	$data['FIRSTNAME'] = (isset($data['FIRSTNAME']))?$data['FIRSTNAME']:'';

		// 	$data['LASTNAME'] = (isset($data['LASTNAME']))?$data['LASTNAME']:'';

		// 	$data['NICKNAME'] = (isset($data['NICKNAME']))?$data['NICKNAME']:'';

		// 	$data['SEXE'] = (isset($data['SEXE']))?$data['SEXE']:'';

		// 	$data['NAISSANCE'] = (isset($data['NAISSANCE']))?$data['NAISSANCE']:'';

		// 	$q = "VALUES(";
		// 	$q .= "NULL";
		// 	$q .= ", '".$data['UKEY']."' ";
		// 	$q .= ", '".addslashes(_GGN::encodeChar($data['FIRSTNAME']))."' ";
		// 	$q .= ", '".addslashes(_GGN::encodeChar($data['LASTNAME']))."' ";
		// 	$q .= ", '".addslashes(_GGN::encodeChar($data['NICKNAME']))."' ";
		// 	$q .= ", '".$data['SEXE']."' ";
		// 	$q .= ", '".addslashes(_GGN::encodeChar($data['NAISSANCE']))."' ";
		// 	$q .= ", '".gmdate(_GGN::DATETIME_NUM)."' ";
		// 	$q .= ", '0' ";
		// 	$q .= ")";

		// 	if($database->insertIntoTable(self::TBL_IDENTIY, $q)){
		// 		return true;
		// 	}

		// 	return false;
		// }


		static protected function deactivateIdentity($ukey){

			global $database, $_Gougnon;

			if($database->UpdateTable(self::TBL_IDENTIY, "SET AVAILABLE='0' WHERE UKEY='".$ukey."'  ")){

				return true;

			}

			return false;
		}


		static protected function activateIdentity($ukey){

			global $database, $_Gougnon;

			if($database->UpdateTable(self::TBL_IDENTIY, "SET AVAILABLE='1' WHERE UKEY='".$ukey."'  ")){

				return true;

			}

			return false;
		}


		static protected function deleteIdentity($ukey){

			global $database, $_Gougnon;

			if($database->DeleteFromTable(self::TBL_IDENTIY, " WHERE UKEY='".$ukey."' ")){

				return true;

			}
			
			return false;
		}












		/* ACTIVATION IDENTITÉ */
		static protected function identityToActivate($data){
			global $database, $_Gougnon;

			$data['UKEY'] = (isset($data['UKEY']))?$data['UKEY']:false;

			if($data['UKEY']===false){return false;}

			$akey = hash('sha256',$data['UKEY']);
			$q = "VALUES(";
			$q .= "NULL";
			$q .= ", '".($data['UKEY'])."' ";
			$q .= ", '".($akey)."' ";
			$q .= ", '".(time()+((24*3)*60))."' ";
			$q .= ", '1' ";
			$q .= ")";

			if($database->insertIntoTable(self::TBL_IDENTIY_ACTIVE, $q)){
				return true;
			}

			return false;
		}


		static protected function clearActivateIdentity(){
			global $database, $_Gougnon;

			$q = " WHERE EXPIRE < '".time()."' ";
			$re = $database->SelectFromTable(self::TBL_IDENTIY_ACTIVE, $q);

			if(is_object($re)){
				$getter = $re->results();
				if(is_object($getter)){
					if($getter->row>0){
						for($x=0; $x<$getter->row;$x++){
							$ukey = $getter->data['UKEY'][$x];
							$akey = hash('sha256',$ukey);
							if($akey==$getter->data['AKEY'][$x]){
								self::deleteUser($ukey);
								self::deleteIdentity($ukey);
							}
						}
					}
				}
			}

			if($database->DeleteFromTable(self::TBL_IDENTIY_ACTIVE, " WHERE EXPIRE < '".time()."' ")){}

			return false;
		}



		static protected function getIdentityToActivate($akey){
			global $database, $_Gougnon;
			self::clearActivateIdentity();

			$q = "WHERE AKEY='".$akey."' AND AVAILABLE='1' ";
			$re = $database->SelectFromTable(self::TBL_IDENTIY_ACTIVE, $q);

			if(is_object($re)){
				$getter = $re->results();
				if(is_object($getter)){
					return ($getter->row>=1)?$getter:false;
				}
			}

			return false;
		}


		static public function identityActivation($akey){
			global $database, $_Gougnon;

			$uk = self::getIdentityToActivate($akey);


			if(is_object($uk)){
				$expire = $uk->data['EXPIRE'][0];
				$ctime = time();
				$del = $database->DeleteFromTable(self::TBL_IDENTIY_ACTIVE, " WHERE AKEY='".$akey."' ");

				if($ctime>$expire){
					return '-time.over';
				}
				else{
					if($del){
						if(self::activatePUD($uk->data['UKEY'][0])){
							return '-activate.success';
						}

						/* Envoyer un message d'erreur (-PUD.failed) à l'administrateur */
						return '-activate.pud.failed';
					}
					return '-activate.failed';
				}
			}

			else{
				return '-code.inavailable';
			}

		}











		/* UTILISATEURS */
		
		static public function NewIDAccess(){ 

			return str_replace(['=','+'],'',_GGNCrypt::RKCRandm(_GGNCrypt::PALETTE_iALPHA . ' ' . _GGNCrypt::PALETTE_NUMERIC, 114) . (gmdate('YmdHis')) );

		}


		public function create($data){ 

			global $database;

			$d = [];

			$d['UKEY'] = str_replace(['=','+'],'',_GGNCrypt::RKCRandm(_GGNCrypt::PALETTE_iALPHA . ' ' . _GGNCrypt::PALETTE_NUMERIC, 34) . (gmdate('YmdHis')) );

			$d['IDACCESS'] = self::NewIDAccess();

			$d['USERNAME'] = $this->username;

			$d['DECRYPKEY'] = $this->engine_decrypKey(self::CRYKLEN);

			$d['PASSWORD'] = self::passwordMaker($this->password, $d['DECRYPKEY']);

			$d['DATETIME'] = time();

			// $daten = str_replace(array(':','-',' ','/'),'',$d['DATETIME']);

			$data['UKEY'] = $d['UKEY'];

			
			
			$q = "VALUES(";
			
			$q .= "NULL";
			
			$q .= ", '".$d['UKEY']."' ";
			
			$q .= ", '" . (isset($data['ACCOUNT_TYPE']) ? $data['ACCOUNT_TYPE'] : '2') . "' ";
			
			$q .= ", '".addslashes(($d['USERNAME']))."' ";
			
			$q .= ", '".addslashes(isset($data['EMAIL']) ? $data['EMAIL'] : '' )."' ";

			$q .= ", '".addslashes(isset($data['PHONE']) ? $data['PHONE'] : '' )."' ";
			
			$q .= ", '".addslashes(($d['PASSWORD']))."' ";
			
			$q .= ", NULL ";
			
			$q .= ", '".addslashes(($d['DECRYPKEY']))."' ";
			
			$q .= ", '" . $d['IDACCESS'] . "' ";
			
			$q .= ", '".((_GGN::varn('USER_ACCOUNT_DURATION')=='0')?0:time()+(_GGN::varn('USER_ACCOUNT_DURATION')*60))."' ";
			
			$q .= ", '" . (isset($data['ACTIVE_ACCEPTED']) ? $data['ACTIVE_ACCEPTED'] : '0') . "' ";
			
			$q .= ", '".$d['DATETIME']."' ";
			
			$q .= ")";


			if($database->insertIntoTable(self::TBL_USERS, $q)){

				if(
					
					isset($d['FIRSTNAME'])

					&& isset($d['LASTNAME'])

					&& isset($d['SEXE'])

					&& isset($d['BIRTH'])

				){

					if(self::updateIdentity($d['UKEY'], $data['FIRSTNAME'], $data['LASTNAME'], '', $data['SEXE'], $data['BIRTH'] )){

						$this->sendSubscribeActivateMail([
						
							'USERNAME'=>$d['USERNAME']
						
							,'EMAIL'=>$data['EMAIL']
						
							,'UKEY'=>$d['UKEY']
						
						]);


						/* Dossier de l'utilisateur */
						Gougnon::createFolders(self::pathData($d['USERNAME']));


						/* Si le ssytème require une confirmation par mail */
						if(_GGN::varn('SUBSCRIBE_CONFIRM')=='0'){

							self::activatePUD($data['UKEY']);

						}

						return true;

					}

				}

				else{

					return true;

				}


			}
			
			return false;
		}


			/* PUD : Personal User Data (données personnelles de l'utilisateur) */
		static public function activatePUD($ukey){
			global $database, $_Gougnon;

			if(self::activateUser($ukey)){
				if(self::activateIdentity($ukey)){
					return true; 
				}
			}
				
			return false;
		}


		static public function pathData($username){
			$path=__USERS__ . '$' . $username . '/';
			if(!is_dir($path)){Gougnon::createFolders($path);}
			return $path;
		}


		public function getPathData(){
			return self::pathData($this->username);
		}


		static protected function deactivateUser($ukey){
			global $database, $_Gougnon;
			if($database->UpdateTable(self::TBL_USERS, "SET ACCEPT='0' WHERE UKEY='".$ukey."'  ")){
				return true;
			}
			return false;
		}


		static protected function activateUser($ukey){
			global $database, $_Gougnon;
			if($database->UpdateTable(self::TBL_USERS, "SET ACCEPT='1' WHERE UKEY='".$ukey."'  ")){
				return true;
			}
			return false;
		}



		static public function deleteUser($ukey){
			global $database, $_Gougnon;
			if($database->DeleteFromTable(self::TBL_USERS, " WHERE UKEY='".$ukey."' ")){
				return true;
			}
			return false;
		}


		static public function deactivateExpiredUsers(){
			global $database,$_Gougnon;

			$q = "WHERE EXPIRE > '0' AND EXPIRE < '".time()."' ";
			$re = $database->SelectFromTable(self::TBL_USERS, $q);
			$error=[];
			

			if($database->UpdateTable(self::TBL_USERS, "SET ACCEPT='0' " . $q . "")){}

			if(is_object($re)){
				$getter = $re->results();
				if(is_object($getter)){
					if($getter->row>0){
						for($x=0; $x<$getter->row; $x++){
							$ukey = $getter->data['UKEY'][$x];
							if(!self::deactivateIdentity($ukey)){array_push($error, $ukey);}
						}
							
					}
				}
			}

			return $error;
		}













		/* Mail Option */
		static public function mailTemplate($title,$about,$message,$buttons = false){

			global $_Gougnon;


			/* DPO */

			new \GGN\DPO\Using('DPO\Page');

			new \GGN\DPO\Using('DPO\Theme');


			$tpl = new GGN\DPO\Theme\Preset(\_GGN::varn('SUBSCRIBEPAGE_THEME'));

			$tpl->component('mail.subscribe', [

				'title'=>$title

				,'about'=>$about

				,'message'=>$message

				,'buttons'=>$buttons

			]);

			$page = new GGN\DPO\Page\Init($tpl);

			$page->engine()->schema( (new GGN\DPO\Page\RenderingScheme())->html5 )->start(true); 

			return $page->code;

		}


		public function sendSubscribeActivateMail($data = []){

			global $_Gougnon;


			if(_GGN::varn('SUBSCRIBE_CONFIRM')=='0'){
				return true;
			}

			$username = (isset($data['USERNAME']))?$data['USERNAME']:false;
			$to = (isset($data['EMAIL']))?$data['EMAIL']:false;

			if(!is_string($username) || !is_string($to)){
				return false;
			}

			if(!self::identityToActivate($data)){
				return false;
			}

			$lnk = HTTP_HOST . 'subscribe?direct=action.core.g&key='.(md5('His')).'&drive='.md5(md5(_GGN::DATETIME_NUM)).'&mkz=' . (hash('sha256', $data['UKEY'])) . '&qx=' . md5(_GGN::DATETIME_NUM);



			
			$title = 'Activez votre compte';
			$about = 'Finaliser votre inscription maintenant';
			$message = 'Salut '.ucwords($username).',<p>Pour finaliser votre inscription, veuillez cliquer sur ce lien : ';
				$message .= '';
				$message .= '';
			$buttons = array(
				'active.now' => array(
					'title' => 'Finaliser votre inscription Maintenant'
					,'link' => $lnk
					,'focus' => true
					)
				);

			$c = '';
			$c = self::mailTemplate($title,$about,$message,$buttons);
			
			$s = _GGN::varn('SITENAME') . ' - ' . $title;

			$h  = 'MIME-Version: 1.0' . "\r\n";
			$h .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$h .= 'From: ' . _GGN::varn('SITENAME') . ' <subscribe.robot@' . $_SERVER['HTTP_HOST'] . '>' . "\r\n";


			if(@mail($to, $s, $c, $h)){

				return true;

			}

			return false;
		}



		
	}
		
}
 
 
 
?>