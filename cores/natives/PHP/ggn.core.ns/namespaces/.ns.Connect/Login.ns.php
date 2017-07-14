<?php

	/**
	 * GGN Connect Login Invoke
	 *
	 * @version 0.1 
	 * @update 150814.1321
	 * @Require Gougnon Framework
	*/




/* 
	Si le parent n'existe pas
 */

/*
	Nom de l'espace
*/
namespace GGN\Connect\Login;
	

	/*
		Connect\Invoke
	*/
	if(!class_exists('\GGN\Connect\Invoke')){

		$Connect = (new \GGN\Using('Connect'))->Call(null, 'Invoke');

	}



	if(!class_exists('\GGN\Connect\Login\Invoke')){
			
		Class Invoke extends \GGN\Connect\Invoke{

			const NAME = 'Gougnon Connect - Login';
			const VERSION = '0.1';
			const UPDATE = '150827.1307';

			static public function Main($data = []){
				
				if(!is_array($data)){$data = [];}

				$data['command'] = \GGN\Connect\LOGIN;

				return new \GGN\Connect\Invoke($data);

			}

		}

	}



	if(!class_exists('\GGN\Connect\Login\ResetPassword')){
			
		Class ResetPassword extends \GGN\Connect\Invoke{

			const NAME = 'Gougnon Connect - ResetPassword';
			
			const VERSION = '0.1';
			
			const UPDATE = '150827.1307';



			/*
				Codex
			*/
			protected $codex = false;


			/*
				Parametre de l'usine
			*/
			protected $FACTORY_URL_PARAM='?canal=reset:password:factory';



			/*
				Arguments
			*/
			var $args = [];





			/*
				Constructeur
			*/
			public function __construct($data = []){

				/*
					Extraction des variable vers '$this'
				*/
				$this->data = $data;

				if(is_array($this->data)){

					foreach ($this->data as $name => $value) {
					
						$this->{$name} = $value;
					
					}

				}

				$this->args = func_get_args();

			}




			/*
				Manivelle
			*/
			static public function Main($data = []){
				
				if(!is_array($data)){$data = [];}

				$data['command'] = \GGN\Connect\RESETUPWD;

				return new \GGN\Connect\Invoke($data);

			}




			/*
				Obtenir la session de requette de changement de mot de passe
			*/
			public function GetRequestSession(){

				if(isset($this->parent) && is_object($this->parent)){

					if(is_string($this->parent->path)){

						$parent = $this->parent;

						$this->requestSession = new \GGNSession($parent::sess_rup, \GGNSession::ONLINE, $this->parent->path);

						return $this->requestSession;

					}

				}

				return false;

			}
			



			/*
				Session de requette de changement de mot de passe
			*/
			public function InitRequestSession(){

				if(isset($this->parent) && is_object($this->parent)){

					if(is_string($this->parent->path)){

						$parent = $this->parent;

						$this->requestSession = new \GGNSession($parent::sess_rup, \GGNSession::ONLINE, $this->parent->path);

						return $this->requestSession;

					}

				}

				return false;

			}
			
			/*
				Création de la session de demande de reinitialisation de mot de passe
			*/
			public function CreateRequestSession(){

				
				if(is_object($this->requestSession) 

					&& is_object($this->parent) 

					&& isset($this->parent->email) 

					&& is_string($this->parent->email)

					&& isset($this->parent->access) 

					&& is_string($this->parent->access) 

				){

					$this->codex = self::RequestCodex();

					if($this->requestSession->set([
										
						// 'ip'=>\__IP__
						
						'email'=> $this->parent->email
						
						,'codex'=> $this->codex
						
						,'access'=> $this->parent->access

					]))
					{
						return $this->SendRequestMail();
					}

					else{

						$this->because('attempt.rup.request.session.create.failed');

					}

				}

				else{

					$this->because('attempt.rup.request.session.create.param.not.found');

				}

				return false;

			}
			


			/*
				Ajout de reponse
			*/
			protected function because($string = ''){

				if(is_object($this->parent) && method_exists($this->parent, 'addResponses') && is_string($string)){

					$this->parent->addResponses(['because'=> $string]);

				}

			}



			/*
				Session de requette de changement de mot de passe
			*/
			static protected function RequestCodex(){

				return \_GGNCrypt::RKCRandm(\_GGNCrypt::PALETTE_iALPHA . date('Ymd.his') . '::' . \_GGNCrypt::PALETTE_NUMERIC);

			}




			/*
				Envoie de mail de requette de changement de mot de passe
			*/
			protected function SendRequestMail(){

				if(
					isset($this->parent) && is_object($this->parent)

					&& isset($this->parent->email) && is_string($this->parent->email)

					&& isset($this->parent->user) && is_array($this->parent->user)

				){

					$to = $this->parent->email;

					$lnk = \_GGN::setvar(\_GGN::varn('LOGIN_PAGE')) . $this->FACTORY_URL_PARAM 
						
						. '&reference='.\_GGNCrypt::encoder(\date(\_GGN::DATETIMEM_NUM), 'BASE64')
						
						. '&app=-'.\_GGNCrypt::encoder(\date(\_GGN::TIME_NUM), 'BASE64')
						
						. '&tmp=' . $this->codex 
						
						. '&email=' . $to

						;

					
					$title = 'Réinitialisation de mot de passe';
					
					$about = 'Commencez maintenant';
					
					$message = ''.ucwords($this->user['USERNAME']).',<p>Vous avez demandez à reinitialiser votre mot de passe. Pour cela vous devez suivre les instructions à la suite de ce lien.';

						$message .= '<br><br><b>NB</b><span class="mac"> : Ce lien est valide quelque temps après la demande de réinitialisation de mot de passe.</span>.';
					
					$buttons = array(

						'active.now' => array(

							'title' => 'Réinitialisation du mot de passe'
							
							,'link' => $lnk
							
							,'focus' => true

						)

					);


					$c = \GUSERS::mailTemplate($title, $about, $message, $buttons);
					
					$s = \_GGN::varn('SITENAME') . ' - ' . $title;

					$h  = 'MIME-Version: 1.0' . "\r\n";

					$h .= 'Content-type: text/html; charset=utf-8' . "\r\n";

					$h .= 'From: ' . \_GGN::varn('SITENAME') . ' <no.reset.password@' . $_SERVER['HTTP_HOST'] . '>' . "\r\n";

					/* 
						Envoie 
					*/
					if(@mail($to, $s, $c, $h)){

						return true;

					}

					else{

						$this->because('attempt.rup.request.mail.send.failed');

					}

				}
				else{

					$this->because('attempt.rup.request.mail.param.not.found');
						
				}

				return false;

			}



		}

	}







	if(!class_exists('\GGN\Connect\Login\ResetPasswordFactory')){
			
		Class ResetPasswordFactory extends \GGN\Connect\Invoke{

			const NAME = 'Gougnon Connect - ResetPasswordFactory';
			
			const VERSION = '0.1';
			
			const UPDATE = '150831.1046';




			/*
				Arguments
			*/
			var $args = [];





			/*
				Constructeur
			*/
			public function __construct($data = []){

				/*
					Extraction des variable vers '$this'
				*/
				$this->data = $data;

				if(is_array($this->data)){

					foreach ($this->data as $name => $value) {
					
						$this->{$name} = $value;
					
					}

				}

				$this->args = func_get_args();

			}




			/*
				Manivelle
			*/
			static public function Main($data = []){
				
				if(!is_array($data)){$data = [];}

				$data['command'] = \GGN\Connect\RESETUPWDFAC;

				return new \GGN\Connect\Invoke($data);

			}




			/*
				Obtenir la session de requette de changement de mot de passe
			*/
			public function LoadRequestSession(){

				if(isset($this->parent) && is_object($this->parent)){

					if(is_string($this->parent->path)){

						$parent = $this->parent;

						$this->requestSession = new \GGNSession($parent::sess_rup, \GGNSession::ONLINE, $this->parent->path);

						if(is_object($this->requestSession)){

							$this->request = $this->requestSession->expired();

							return (is_array($this->request)) ? $this->request : false;

						}

						else{

							return false;

						}

					}

				}

				return false;

			}


			



		}

	}





?>