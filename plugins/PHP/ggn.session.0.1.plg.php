<?php

// global $_Gougnon, $database;




if(!class_exists('GGNSession')){


class GGNSession{

	CONST NAME = 'Gougnon Session Manager';
	
	CONST VERSION = '0.1';
	
	CONST REEL_VERSION = '0.1.150814.1447';




	/*
		Table GGN de la session
	*/
	// CONST TBL_SESSION='NATIVE_SESSION';





	/*
		Session en ligne
	*/
	CONST INK='$62$45$96@90';

	CONST OUTK='$8082.76';




	/*
		Session en ligne
	*/
	CONST ONLINE='-online.session';



	/*
		Session local-client
	*/
	CONST OFFLINE='-offline.session';




	/*
		Paramètres depuis le constreur
	*/
	var $arguments=[];



	/*
		Nom de la session
	*/
	var $name=false;



	/*
		Type de session
	*/
	var $type=false;



	/*
		Schemas pour 'GStorage'
	*/
	var $schemas=['key', 'ip', 'path', 'name', 'value', 'time', 'expire'];



	/*
		'Array' Donnée de la session
	*/
	var $data=[];





	
	public function __construct(){

		$this->arguments = func_get_args(); 
		
		$this->name = (isset($this->arguments[0]))?(($this->arguments[0]!=false)?$this->arguments[0]:false):false;
		
		$this->type = (isset($this->arguments[1]))?(($this->arguments[1]!=false)?$this->arguments[1]:false):false;
		
		$this->path = (isset($this->arguments[2]))?(($this->arguments[2]!=false)?$this->arguments[2]:'default.path'):'default.path';
		
		
		$this->path = (is_string($this->path))?$this->path:'default.path';
		
		$this->clientDevice = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
		
		// $this->cdKey = _GGNCrypt::_sha256($this->clientDevice);


		$this->path = GSTORAGE_SESSIONS .'/'. __IP__  .'-' . $_SESSION['GGN_ID_SESSION'] . '/'. \CLIENT_BROWSER . '/' . $this->path;
		// $this->path = GSTORAGE_SESSIONS .'/'. __IP__  .'/'. $this->cdKey . '/' . $this->path;

	}






	public function expired(){

		if($this->type==self::ONLINE && $this->name!==false){

			$load = $this->load();
			
			if(is_array($load)){
			
				$data = $load['data'][0];
			
				$option = $load['option'];


				if($option['row']==1){

					return (time() > $data['expire'])? true : $data;

				}

				else{return true;}

			}

			else{return true;}

		}

		else{

			return (isset($_SESSION[$this->name]))?$_SESSION[$this->name]:true;

		}


	}




	public function load(){

		// global $database;
		
		$args = func_get_args();

		if($this->type==self::ONLINE && $this->name!==false){
			
			// $this->clearCache();
			
			$load = GStorages::load($this->name, $this->path);
			

			if(isset($load['data']) && isset($load['option']) && isset($load['header']) && isset($load['footer']) ){
				return $load;
			}
			else{
				return false;
			}
		}

		else{
			return (isset($_SESSION[$this->name]))?$_SESSION[$this->name]:true;
		}

	}




	public function exists(){

		// global $database;
		
		$args = func_get_args();

		if($this->type==self::ONLINE && $this->name!==false){

			// $this->clearCache();
			
			$load = GStorages::load($this->name, $this->path);
			
			if(isset($load['data']) && isset($load['option']) && isset($load['header']) && isset($load['footer']) ){
			
				return $load['data'];
			
			}
			
			else{
			
				return false;
			
			}
		
		}

		else{
			$expired=$this->expired();
			return ($expired===true)?false:$expired;
		}

	}







	public function clearCache(){

		if($this->type==self::ONLINE&&$this->name!==false){}

	}










	public function destroy(){
		// global $database, $_Gougnon;

		if($this->type==self::ONLINE&&$this->name!==false){
			// $cleaner = _GGN::varn('USERS_SESSION_ONLINE_CLEANER');
			return GStorages::deleteEntity($this->name, $this->path);
		}
		else{
			if(isset($_SESSION[$this->name])){unset($_SESSION[$this->name]);}
		}

	}




	public function destroyPATH(){
		// global $database, $_Gougnon;

		if($this->type==self::ONLINE&&$this->name!==false){
			// $cleaner = _GGN::varn('USERS_SESSION_ONLINE_CLEANER');
			$this->destroy();
			$destroy = GStorages::deletePath($this->name, $this->path);

			return $destroy;

		}
		else{
			if(isset($_SESSION[$this->name])){unset($_SESSION[$this->name]);}
		}

	}






	public function refresh(){/* Minute */
		
		global $_Gougnon;

		$expire = (isset($args[0]))?$args[0]:_GGN::varn('USERS_SESSION_DURATION');
		
		$expire = (is_numeric($expire))?$expire:_GGN::varn('USERS_SESSION_DURATION');

		$__expire = $expire*1;
		
		$_expire = time()+$__expire;


		if($this->type==self::ONLINE&&$this->name!==false){
		
			$this->data['expire'] = $_expire;
		
			return GStorages::update($this->data, ['key'=>'0'], $this->name, $this->path);
		
		}
		
		else{
		
			if(isset($_SESSION[$this->name])){
		
				$_SESSION[$this->name]=$_SESSION[$this->name];
		
			}
		
			else{$this->destroy();}

		}

		return $this;
	}





	public function set($value, $conserve = false){
		
		global $_Gougnon, $GRegister;


		$args = func_get_args();
		
		$expire = (isset($args[1]))?$args[1]:_GGN::varn('USERS_SESSION_DURATION');
		
		$expire = (is_numeric($expire))?$expire:_GGN::varn('USERS_SESSION_DURATION');

		$__expire = $expire*60;
		
		$_expire = time()+$__expire;


		if($this->type==self::ONLINE && $this->name!==false && isset($args[0])){

			$exists = $this->load();


			/*
				Nouvelle valeur et génération de la session
			*/
			if($exists===false){

				/*
					Ajoute de la clé fixe de la session car chaque session 
					aura un fichier comportant toutes ces données
				*/
				$this->data['key'] = 0;

				/*
					Ajout de l'IP du client
				*/
				$this->data['ip'] = __IP__;

				/*
					Ajout du dossier
				*/
				$this->data['path'] = $this->path;

				/*
					Ajout du nom
				*/
				$this->data['name'] = $this->name;

				/*
					Ajout de la valeur
				*/
				$this->data['value'] = $value;

				/*
					Ajout du temps
				*/
				$this->data['time'] = time();

				/*
					Ajout de la date d'expiration
				*/
				$this->data['expire'] = $_expire;


				/*
					Création de la session
				*/
				$storage = GStorages::create($this->name, $this->path, $this->schemas);
				

				/*
					Insertion des donnée si '$storage' ne retourne pas false
				*/
				if($storage!=false){

					return $storage = GStorages::insert($this->data, $this->name, $this->path);

				}

				return $storage;
			}


			/*
				Mise à jour de la session avec un nouvelle 
				date d'expiration et une nouvelle valeur
			*/
			else{



				if($conserve == false){
						
					/*
						Nouvelle valeur de la session
					*/
					$this->data['value'] = $value;


					/*
						Ajout du temps
					*/
					$this->data['time'] = time();


					/*
						Nouvelle date d'expiration
					*/
					$this->data['expire'] = $_expire;

					
				}

				else{

					$this->data = $exists['data'][0];

					$this->data['value'] = $value;
					
				}



				// var_dump($exists['data'][0]['time'] == $this->data['time']);

				// var_dump($exists['data'][0]['expire'] == $this->data['expire']);

				// var_dump($value);

				// var_dump($this->data['value']);

				// exit;



				/*
					Remplacement de la session
				*/
				return GStorages::update($this->data, ['key'=>'0'], $this->name, $this->path);




			}

		}


		else{

			$_SESSION[$this->name]=$value;

			return true;

		}


		return false;
	}






}






}


?>