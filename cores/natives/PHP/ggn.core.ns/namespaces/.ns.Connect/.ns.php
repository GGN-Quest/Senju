<?php

	/**
	 * GGN Connect Invoke
	 *
	 * @version 0.1 
	 * @update 160224.1435
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\Connect;


	use GGN\CMD;


	const NS = "GGN\Connect";


	const LOGIN = \GGN\CMD\LOGIN;


	const LOGOUT = \GGN\CMD\LOGOUT;


	const RESETUPWD = \GGN\CMD\RESETUPWD;


	const RESETUPWDFAC = \GGN\CMD\RESETUPWDFAC;


	const SUBSCRIBE = \GGN\CMD\SUBSCRIBE;




	if(class_exists('\GGN\Invoke') && !class_exists('\GGN\Connect\Invoke')){



		/*
			Le gestionnaire de session 
		*/
		if(!class_exists('GGNSession')){

			\Gougnon::loadPlugins('PHP/ggn.session.0.1');

		}



		/*
			Invoke
		*/
		Class Invoke{


			/*
				Clé de la session de connexion
			*/
				const sess_name = 'index';


			/*
				Clé de la session de demande de reinitialisation de mot de passe
			*/
				const sess_rup = 'request.reset.password';


			/*
				Table des utilisateurs
			*/
				const tbl_users = 'NATIVE_USERS';


			/*
				table non-native Gougnon 
			*/
				const tbl_type = false;


			/*
				Champs jouant le role de 'access'
			*/
				const field_access = 'IDACCESS';



			/*
				Mode de connexion (email/Nom d'utilisateur)
			*/
			var $command = false;


			/*
				Mode de connexion (email/Nom d'utilisateur)
			*/
			var $mode = false;


			/*
				Clé de la session
			*/
			var $key;



			/*
				Donnée de l'utilisateur
			*/
			var $user;



			/*
				Schema de la table 'GStorage'
			*/
			var $shema = ['key', 'user', 'duration', 'access', 'browser'];



			/*
				Durée d'un session
			*/
			var $duration;



			/*
				Clé d'access memorielle
			*/
			var $access;





			/*
				Chemin d'hebergement des sessions
			*/
			var $path;





			/*
				Invoke de la session
			*/
			var $session;





			/*
				Variable de Response
			*/
			var $_response = [];




			/*
				Constructeur : Initialisation
			*/
			public function __construct($data = false){
				
				/*
					Arguments
				*/
				$this->args = func_get_args();


				/*
					Paramètres stocké ou argument (0)
				*/
				$this->data = $data;


				/*
					Extraction des variable vers '$this'
				*/
				if(is_array($this->data)){

					foreach ($this->data as $name => $value) {
					
						$this->{$name} = $value;
					
					}

				}


				/*
					Nom de session
				*/
				$this->mode = strtolower(\_GGN::varn('ACTIVESESSION_MODE'));


				/*
					Nom de session
				*/
				$this->name = self::sess_name;

				/*
					Chemin de la session
				*/
				$this->path = 'ggn.connect';

				/*
					Variable definissant la session concernant l'utilisateur
				*/
				$this->session = new \GGNSession($this->name, \GGNSession::ONLINE, $this->path);

				/*
					Session de l'applicaiton
				*/
				$this->appSession = false;


				/*
					Clé de l'application
				*/
				if(isset($this->{'app'})){

					$this->appSession = new \GGNSession($this->app, \GGNSession::ONLINE, $this->path);

				}

				

				/*
					Commande de la tache à executer
				*/
				if(isset($this->command) && is_string($this->command)){

					$this->command = strtolower($this->command);

				}


				/*
					Classe 'com.service'
				*/
				if(isset($this->{'com.service'})){

					$this->com = $this->{'com.service'};

				}


			}


			/*
				Session utilisateur
				& Application
			*/
			public function create($data = false, $conserve = false){

				global $GRegister;
				
				/*
					Arguments entrés
				*/
				// $args = func_get_args();

				/*
					Valeur à enregistrer dans le fichier de session
				*/
				$data = (is_array($data)) ? $data : $this->data;




				/*
					Session utilisateur d'application
				*/
				if(is_object($this->appSession)){

					$this->appSession->set($data, $conserve);

				}
				
				/*
					Session utilisateur
				*/	
				if(is_object($this->session)){

					// var_dump($data); exit;

					$GRegister->USER = isset($data['user']) ? $data['user'] : false;

					return $this->session->set($data, $conserve);

				}
					
				return false;
			}



			/*
				Session utilisateur
				& Application : Créator
			*/
			protected function __create($data, $idAccess = false, $conserve = false){

				return $this->create([
				
					'user'=> $data
				
					, 'access'=> (is_string($idAccess)) ? $idAccess : $data[self::field_access]
				
					, 'device'=> (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : 'GGN.UNKNOWN.BROWSER'
				
				], $conserve);

			}




			/*
				Mise à niveau Session utilisateur
				& Application
			*/
			public function upgrade($ukey = false, $idAccess = false){
				
				if(is_string($ukey)){


					$get = \GUSERS::get(" WHERE UKEY='$ukey' ", \_GGNDB::RESULTS_METHOD_LINE);

					if(isset($get->data) && isset($get->data[0])){


						/*
							Depuis la base donnée
						*/

						$data = $get->data[0];


						/*
							Création de la session de remplacement
						*/
							
						if($this->__create($data, $idAccess, TRUE)){

							return TRUE;

						}


					}


				}

				return FALSE;
			}


			/*
				Utilisateur connecté : Existence de la session
			*/
			public function isLogged(){

				$expired = $this->session->expired();


				if(is_array($expired)){
					
					return $expired;

				}

				else{

					return false;

				}

			}


			/*
				Utilisateur connecté : Prolongé la durée de la session et/ou de l'application 
			*/
			public function refresh(){

				$r0 = false;

				$r1 = false;

				if(isset($this->session) && is_object($this->session)){

					$r0 = $this->session->refresh();

				}

				if(isset($this->appSession) && is_object($this->appSession)){

					$r1 = $this->appSession->refresh();

				}

				return ($r0) ? true: false;

			}


			/*
				Utilisateur connecté : Existence de la session
			*/
			public function logout($act = false){

				$logged = $this->isLogged();

				switch($act){

					case 'app.session.destroy':
						
						if(is_object($this->appSession)){
						
							return $this->appSession->destroy();
						
						}
					
					break;

					default:
					
						return $this->session->destroyPATH();
					
					break;
				
				}

			}


			/*
				Utilisateur connecté : Existence de la session
			*/
			public function isLoggedApp(){

				$expired = $this->appSession->expired();

				if(is_array($expired)){

					return $expired;

				}

				else{

					return false;

				}

			}




			/* 
				Donnée de la table utilisateur 
			*/
			public function data(){

				global $database;

				$load = $this->session->expired();

				if(is_array($load)){

					$data = $load;

					if(isset($data['value'])){

						return $data['value'];

					}

					return false;
				}

				else{

					return false;

				}

			}


			/* 
				Chargement de la session de l'utilisateur 
			*/
			public function user(){

				global $database;

				/*
					Les données de la session
				*/
				$data = $this->data();


				if(is_array($data) && isset($data['user']) && is_array($data['user'])){

					return $data['user'];

				}

				else{

					return false;

				}

			}


			/* 
				Chargement de la session de l'utilisateur 
			*/
			public function getUser($id = false){

				global $database;

				/*
					ID utilisateur
				*/
				$ID = (is_string($id)) ? $id : (isset($this->userID) ? $this->userID : false);



				if(is_string($ID)){
						
					/* 
						Connexion Basede donnée Si elle n'est pas connecté 
					*/
					$database->Connect();

					/* 
						Requete
					*/
					$query = $database->SelectFromTable(self::tbl_users, " WHERE VERS='".$ID."' ", self::tbl_type);


					if(is_object($query)){

						$query->results(true);

						if(isset($query->data) && isset($query->row)){

							if($query->row > 0){

								return $query->data;

							}

						}

					}

					return false;
				}

				else{

					return false;

				}


			}




			/*
				Gestion des reponses
			*/
			/*
				Affichage de reponse
			*/
			public function responses($string = ''){

				if(isset($this->com) && is_object($this->com)){
					$this->com->Response($string);
				}
				else{
					echo '{"responses":"'.$string.'",'.(implode(',', $this->$_response)).'}';exit;
				}

			}

			/*
				Ajout de reponse
			*/
			public function addResponses(array $array){

				/*
					Si on utilise la 'com.service'
				*/
				if(isset($this->com) && is_object($this->com)){

					/*
						On parcours le '$array' pour créer un noeud de reponse
					*/
					foreach ($array as $name => $value) {

						/*
							Création du noeud de reponse
						*/
						$node = $this->com->Node($name);

						/*
							Attribution de '$value' au noeud de reponse
						*/
						$node->response = $value;

					}

				}

				/*
					Si on n'utilise pas la classe 'com.service'
				*/
				else{

					/*
						Ajout de reponse
					*/
					// foreach ($array as $name => $value) {

					// 	$this->_response[$name] = (isset($this->_response[$name])) ? $this->_response[$name] : [];

					// 	array_push($this->_response[$name], $value);

					// }

				}

			}




			/*
				Tentative de connexion : Chargement de clé de decryptage
			*/
			public function attempt(){

				switch ($this->command) {

					/* 
						Tache : Connexion des utlisateurs 
					*/
					case CMD\LOGIN:

						return $this->attemptUserLogin();

					break;
					

					/* 
						Tache : Reinitialisation du mot de passe des utilisateurs
					*/
					case CMD\RESETUPWD:

						return $this->attemptUserResetPassword();
						
					break;


					/* 
						Tache : Reinitialisation du mot de passe des utilisateurs
					*/
					case CMD\RESETUPWDFAC:

						return $this->attemptUserResetPasswordFactory();
						
					break;



					/* 
						Tache : Inscription des utilisateurs
					*/
					case CMD\SUBSCRIBE:

						return $this->attemptUsersSubscribe();
						
					break;


					default:

						return false;

					break;
				}


				return false;
			}




			/*
				Tentative de connexion des utilisateurs

			*/
			public function attemptUserLogin(){

				global $database;

				/* Connexion Basede donnée Si elle n'est pas connecté */
				$database->Connect();

				/*
					Existance : Nom d'utilisateur
				*/
				if(!isset($this->username)){$this->addResponses(['because'=>'attempt.username.undefined']); return false;}

				/*
					Existance : Mot de passe
				*/
				if(!isset($this->password)){$this->addResponses(['because'=>'attempt.password.undefined']); return false;}

				/*
					Existance : Mode
				*/
				if(!isset($this->mode)){$this->addResponses(['because'=>'attempt.mode.undefined']); return false;}


				/*
					Recherche de l'utilisateur : Declaration avec le mot de passe et le mode de connexion (email/Nom d'utilisateur)
				*/
				$this->instance = new \GUSERS($this->username, $this->password, $this->mode);

				/*
					Recherche de l'utilisateur : Existence
				*/
				$this->exists = $this->instance->exists(true);


				/*
					Utilisateur n'existe pas
				*/
				if($this->exists!==true){

					$this->addResponses(['because'=>(is_string($this->exists) ? $this->exists : 'data.unavailable')]);

				}

				/*
					Utilisateur existe
				*/
				if($this->exists===true){

					/* 
						Connexion
					*/
					if($this->login()){

						global $GRegister;

						// $GRegister->

						return true;

					}

					/* 
						Echec Connexion
					*/
					else{

						$this->addResponses(['because'=>'attempt.login.failed']); return true;

					}

				}

				return false;
			}



			/*
				Connexion de l'utilisateur
			*/
			protected function login(){

				/*
					Existance : Nom d'utilisateur
				*/
				if(!isset($this->instance)){$this->addResponses(['because'=>'login.instance.undefined']);}

				else if(!is_object($this->instance)){$this->addResponses(['because'=>'login.instance.failed']); }

				else if(!isset($this->exists)){$this->addResponses(['because'=>'login.exists.undefined']);}

				else if($this->exists!==true){$this->addResponses(['because'=>'login.exists.failed']); }

				else if($this->exists===true){

					if(!is_object($this->instance->getter)){$this->addResponses(['because'=>'login.data.failed']);}

					else if(!is_array($this->instance->getter->data)){$this->addResponses(['because'=>'login.data.failed']);}

					else if(!is_array($this->instance->getter->data)){$this->addResponses(['because'=>'login.data.failed']);}

					else if(!isset($this->instance->getter->data[0])){$this->addResponses(['because'=>'login.data.failed']);}

					else if(!isset($this->instance->getter->data[0][self::field_access])){$this->addResponses(['because'=>'login.idaccess.failed']);}

					else if(!is_string($this->instance->getter->data[0][self::field_access])){$this->addResponses(['because'=>'login.idaccess.failed']);}

					else{
						
						/* 
							Utilisateur
						*/
						$IDAccess = \GUSERS::NewIDAccess();

						$this->instance->update('IDACCESS', $IDAccess);

						$this->instance->getter->data[0]['IDACCESS'] = $IDAccess;

						$this->user = $this->instance->getter->data[0];

						// print_r($this->instance->getter->data);

						/* 
							Creation de la session
						*/
						if($this->__create($this->user)){

							return true;

						}

						else{

							$this->addResponses(['because'=>'login.session.failed']);

							return false;

						}

						
					}


					return false;
				}

				return false;

			}




			/*
				Tentative de reinitialisation de mot de passe : verification de la requete

			*/
			public function availableRequest(){

				/*
					Existance : parametre de l'Email
				*/
				if(!isset($this->email)){$this->addResponses(['because'=>'attempt.email.undefined']); return false;}

				/*
					Existance : parametre de la requete demandé
				*/
				if(!isset($this->codex)){$this->addResponses(['because'=>'attempt.codex.undefined']); return false;}



				$this->instance = \GUSERS::byEmail($this->email, true);


				/*
					Existance : Email dans la base de donnée
				*/
				if(!is_object($this->instance) || $this->instance->row <= 0){$this->addResponses(['because'=>'attempt.email.not.found']); return false;}


				$this->user = $this->instance->data[0];



				/*
					Préparation de la session de demande de reinitialisation de mot de passe
				*/
				$this->access = $this->user[self::field_access];

				$this->rupf = new Login\ResetPasswordFactory(['parent'=>$this]);
				
				$this->request = $this->rupf->LoadRequestSession();			


				/*
					Existance : Validité de la requete
				*/
				if(!is_array($this->request)){
					$this->addResponses(['because'=>'attempt.request.not.found']); return false;
				}


				/*
					Existance : Validité de la requete
				*/
				if(!isset($this->request['ip'])
					|| !isset($this->request['path'])
					|| !isset($this->request['name'])
					|| !isset($this->request['value'])
					|| !isset($this->request['time'])
					|| !isset($this->request['expire'])

				){
					$this->addResponses(['because'=>'attempt.data.missing']); return false;
				}



				if(!is_string($this->request['ip'])
					|| !is_string($this->request['path'])
					|| !is_string($this->request['name'])
					|| !is_array($this->request['value'])
					|| !is_numeric($this->request['time'])
					|| !is_numeric($this->request['expire'])

				){
					$this->addResponses(['because'=>'attempt.data.format.failed']); return false;
				}


				if($this->request['value']['access'] != $this->access){
					$this->addResponses(['because'=>'attempt.access.failed']); return false;
				}

				if($this->request['value']['email'] != $this->email){
					$this->addResponses(['because'=>'attempt.email.failed']); return false;
				}

				if($this->request['value']['codex'] != $this->codex){
					$this->addResponses(['because'=>'attempt.codex.failed']); return false;
				}


				if($this->request['ip'] != __IP__){
					$this->addResponses(['because'=>'attempt.ip.failed']); return false;
				}


				return true;

			}




			/*
				Tentative de reinitialisation de mot de passe : Usine de mot de passe

			*/
			protected function attemptUserResetPasswordFactory(){

				/*
					Existance : parametre de l'Email
				*/
				if(!isset($this->email)){$this->addResponses(['because'=>'attempt.email.undefined']); return false;}

				/*
					Existance : parametre de la requete demandé
				*/
				if(!isset($this->codex)){$this->addResponses(['because'=>'attempt.codex.undefined']); return false;}

				/*
					Existance : Nouveau Mot de passe 
				*/
				if(!isset($this->password)){$this->addResponses(['because'=>'attempt.password.undefined']); return false;}

				/*
					Existance : Confirmation Nouveau Mot de passe 
				*/
				if(!isset($this->passwordConfirm)){$this->addResponses(['because'=>'attempt.password.confirm.undefined']); return false;}


				/*
					Existance : Conformitée des mots de passe
				*/
				if($this->passwordConfirm!=$this->password){$this->addResponses(['because'=>'attempt.password.failed']); return false;}



				$this->instance = \GUSERS::byEmail($this->email, true);


				/*
					Existance : de la requete
				*/
				$this->available = $this->availableRequest();


				/*
					Validité de la requete
				*/
				if(!($this->available===TRUE)){$this->addResponses(['because'=>'attempt.request.unavailable']); return false;}
				


				/*
					Existance : Utilisateur
				*/
				if(!isset($this->user)){$this->addResponses(['because'=>'attempt.user.missing']); return false;}

				if(!is_array($this->user)){$this->addResponses(['because'=>'attempt.user.unavailable']); return false;}

				if(!is_string($this->user['UKEY'])){$this->addResponses(['because'=>'attempt.user.unavailable']); return false;}



				/*
					Changement de mot de passe
				*/
				$this->pwdUpdate = \GUSERS::iUpdatePassword($this->user['UKEY'], $this->password);

				if($this->pwdUpdate >= 2){

					return true;

				}


				$this->addResponses(['because'=>'attempt.failed']);
				return false;

			}




			/*
				Tentative de reinitialisation de mot de passe : demande

			*/
			protected function attemptUserResetPassword(){

				/*
					Existance : parametre de l'Email
				*/
				if(!isset($this->email)){$this->addResponses(['because'=>'attempt.email.undefined']); return false;}

				$this->instance = \GUSERS::byEmail($this->email, true);


				/*
					Existance : Email dans la base de donnée
				*/
				if(!is_object($this->instance) || $this->instance->row <= 0){$this->addResponses(['because'=>'attempt.email.not.found']); return false;}


				$this->user = $this->instance->data[0];



				/*
					Préparation de la session de demande de reinitialisation de mot de passe
				*/
				$this->access = $this->user[self::field_access];

				$this->rup = new Login\ResetPassword(['parent'=>$this]);
				
				$this->rupSession = $this->rup->InitRequestSession();			


				/*
					Verification de l'instance de la Session
				*/
				if(!is_object($this->rupSession)){$this->addResponses(['because'=>'attempt.rup.session.failed']); return false;}


				/*
					Création de la session de demande de reinitialisation de mot de passe
				*/
				if($this->rup->CreateRequestSession()){

					return true;

				}



				return false;

			}






			/*
				Tentative d'inscription des utilisateurs

			*/
			protected function attemptUsersSubscribe(){

				global $database;

				/* Connexion Basede donnée Si elle n'est pas connecté */
				$database->Connect();

				/*
					Existance : Nom d'utilisateur
				*/
				if(!isset($this->username)){$this->addResponses(['because'=>'attempt.username.undefined']); return false;}

				/*
					Existance : Mot de passe
				*/
				if(!isset($this->password)){$this->addResponses(['because'=>'attempt.password.undefined']); return false;}

				/*
					Existance : Email
				*/
				// if(!isset($this->email)){$this->addResponses(['because'=>'attempt.email.undefined']); return false;}

				/*
					Existance : Contact
				*/
				if(!isset($this->phone)){$this->addResponses(['because'=>'attempt.phone.undefined']); return false;}

				/*
					Existance : Mode
				*/
				if(!isset($this->mode)){$this->addResponses(['because'=>'attempt.mode.undefined']); return false;}


				/*
					Recherche de l'utilisateur : Declaration avec le mot de passe et le mode de connexion (email/Nom d'utilisateur)
				*/
				$this->instance = new \GUSERS($this->username, $this->password, $this->mode);




				/*
					Recherche de l'utilisateur : Si l'email a été indiqué
				*/
				// if(isset($this->email) && is_string($this->email) && !\Gougnon::isEmpty($this->email) ){

				// 	$this->instance->email = $this->email;

				// }



				/*
					Recherche de l'utilisateur : Existence
				*/
				$this->exists = $this->instance->userNameExists();



				/*
					Utilisateur n'existe pas donc peut etre inscrit
				*/
				if($this->exists===false){

					/* 
						Inscription
					*/
					if($this->subscribe()){

						

						return true;

					}

					/* 
						Echec Inscription
					*/
					else{

						$this->addResponses(['because'=>'attempt.subscribe.failed']);

					}


				}

				/*
					Utilisateur existe
				*/
				if(is_object($this->exists)){

					$this->addResponses(['because'=>'user.exists']);

				}


				/*
					Utilisateur dupliqué
				*/
				if($this->exists=='conflit.multiple'){

					$this->addResponses(['because'=>'conflit.user.multiple']);

				}


				return false;

			}


			/*
				Inscription des utilisateurs

			*/
			protected function subscribe(){

				if(!isset($this->instance)){$this->addResponses(['because'=>'subscribe.instance.undefined']);}

				else if(!is_object($this->instance)){$this->addResponses(['because'=>'subscribe.instance.failed']); }

				else if(!method_exists($this->instance, 'create')){$this->addResponses(['because'=>'subscribe.instance.create.failed']); }


				else{

					return $this->instance->create([

						'FIRSTNAME'=>$this->firstname

						,'LASTNAME'=>$this->lastname

						,'SEXE'=>$this->sexe

						,'BIRTH'=>$this->birth

						,'EMAIL'=>$this->email

						,'PHONE'=>$this->phone

					]);

				}


				return false;

			}








		}





	} // if class_exists




				








?>