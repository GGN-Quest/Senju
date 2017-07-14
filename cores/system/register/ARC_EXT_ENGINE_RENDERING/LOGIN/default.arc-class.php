<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS IHTML
	PAGE cores/_GGNs/PHP/Register.core.g/ARC_ENGINE_RENDING/LOGIN/PHP.HTML.arc-render
======================================================
	
*/

/*
	CLASS 'IHTML'
*/

global $_Gougnon, $GRegister;



	/* Verification */
	if(!class_exists('_GGN')){exit('Classe Native introuvable');}

	if(!isset($_Gougnon)){
		_GGN::wCnsl('Erreur Données Manquantes: Variable Gougnon ');
	}

	$GLOGIN_NATIVE_VARS = 'LOGIN_PAGE SYSTEM_THEME LOGIN_THEME LOGIN_STYLE LOGIN_USERNAME_LENGTH_MIN LOGIN_USERNAME_LENGTH_MAX LOGIN_PASSWORD_LENGTH_MIN LOGIN_PASSWORD_LENGTH_MAX ACTIVESESSION_MODE USERS_SESSION_MANAGER_PLUGIN_NAME';
	$GLOGIN_NATIVE_VARS_NUM = 'LOGIN_USERNAME_LENGTH_MIN LOGIN_USERNAME_LENGTH_MAX LOGIN_PASSWORD_LENGTH_MIN LOGIN_PASSWORD_LENGTH_MAX';


	/* Variable exists */
	_GGN::keyExists(explode(' ',$GLOGIN_NATIVE_VARS));

	/* Variables de type numérique */
	$GLOGIN_NATIVE_VARS_NUM_EXPLODE = explode(' ',$GLOGIN_NATIVE_VARS_NUM);
	for($x=0;$x<count($GLOGIN_NATIVE_VARS_NUM_EXPLODE);$x++){
		if(!is_numeric(_GGN::varn($GLOGIN_NATIVE_VARS_NUM_EXPLODE[$x]))){
			_GGN::wCnsl('Erreur Données incorrectes: Gougnon Native "'.$GLOGIN_NATIVE_VARS_NUM_EXPLODE[$x].'" n\'est pas du type numérique ');
			break;
		}
	}








if(!class_exists('GLogin')){
	


	/* Class GLogin */
	class GLogin{

		const NAME = 'GLogin';
		const VERSION = '0.1.141028.1009';




		
		
		public function __construct($next = false, $previous = false, $app = false, $mode = false, $user = false){

			global $GLANG;

			$this->syslang = $GLANG;

			$this->arguments = func_get_args();
			$this->referer = __HTTP_REFERER__;

			$this->next = $next;
			$this->previous = $previous;
			$this->app = $app;
			$this->mode = (is_string($mode)) ? $mode: _GGN::varn('ACTIVESESSION_MODE');
			$this->user = $user;

			$this->page = _GGN::varn('LOGIN_PAGE');
			// $this->theme = _GGN::varn('SYSTEM_THEME');
			$this->redirName = _GGN::varn('LOGIN_REDIR_NAME');
			$this->redirURL = _GGN::varn('LOGIN_REDIR_URL');
			
			// $this->_theme = (new dpo())->load(_GGN::varn('LOGIN_THEME'));
			// $this->_theme->packageStyle = _GGN::varn('LOGIN_STYLE');


			$this->noApp = false;
			$this->label = [];
			$this->_label();

			$this->appTitle = _GGN::varn('LOGIN_REDIR_NAME');
			$this->appURL = _GGN::varn('LOGIN_REDIR_URL');

		}
		
		

		public function labels(){

			$this->label = new _GGNCustomObject();


			if($this->mode=='-email'){

				$this->label->iUsername = 'E-mail';

				$this->label->username = (is_array($this->user))?$this->user['EMAIL']:false;

			}


			if($this->mode=='-username'){

				$this->label->iUsername = 'Nom d\'utilisateur';

				$this->label->username = (is_array($this->user))?$this->user['USERNAME']:false;

			}


			else{

				$this->label->iUsername = 'Nom d\'utilisateur ou E-mail';

				$this->label->username = (is_array($this->user))?$this->user['USERNAME']:false;

			}



		}
		
		
		public function engine(){
			global $database;
			
			$this->_theme->generate();
		}



		/* FORM */
		public function formData(){
			$form='';
			// $form.='<form action="#loginnow" method="POST" onSubmit="return (function(f){return false;})(this);" id="Gougnon-login-form">';
			$form.=($this->app!==false)?'<input type="hidden" name="app" value="'.$this->app.'">':'';
			$form.=($this->next!==false)?'<input type="hidden" name="next" value="'.$this->next.'">':'';
			$form.=($this->previous!==false)?'<input type="hidden" name="previous" value="'.$this->previous.'">':'';
			$form.=($this->redirName!==false)?'<input type="hidden" name="redirectName" value="'.$this->redirName.'">':'';
			$form.=($this->redirURL!==false)?'<input type="hidden" name="redirectURL" value="'.$this->redirURL.'">':'';
			return $form;
		}

		public function resetPasswordFormHeader(){
			$form='';
			// $form.='<form action="#resetpassword" method="POST" onSubmit="return (function(f){return false;})(this);" id="Gougnon-reset-password-form">';
			return $form;
		}

		public function resetPasswordFactoryFormHeader(){
			$form='';
			// $form.='<form action="#resetpassword:factory" method="POST" onSubmit="return (function(f){return false;})(this);" id="Gougnon-reset-password-factory-form">';
			return $form;
		}


		public function formFooter(){
			// return '</form>';
		}


		public function resetPasswordFormFooter(){
			// return '</form>';
		}


		public function resetPasswordFactoryFormFooter(){
			// return '</form>';
		}




		public function _label(){
			
			$this->iLabel['username']='Nom d\'utilisateur';
			$this->iLabel['password']='Mot de passe';

			if($this->mode=='-username'){
				$this->iLabel['username']='Nom d\'utilisateur';
			}

			if($this->mode=='-email'){
				$this->iLabel['username']='E-mail';
			}

			if($this->mode=='-all'){
				$this->iLabel['username']='Nom d\'utilisateur ou Email';
			}

		}




		public function JSInit(){
			global $_Gougnon;

			$js = '';

			$js .= ('(function(w,fid){');
				$js .= ('if(typeof GLogin=="function"){');
					$js .= ('w.Login=G.Login(fid).setup({version:"0.1"');

						if($this->noApp===false){
							$js .= (',redirect:{');
								$js .= ('name:"'.addslashes(_GGN::setvar($this->appTitle)).'"');
								$js .= (',url:"'.addslashes(_GGN::setvar($this->appURL)).'"');
							$js .= ('}');
						}

						$js .= (',user:{');
							$js .= ('min:'._GGN::varn('LOGIN_USERNAME_LENGTH_MIN').'');
							$js .= (',max:'._GGN::varn('LOGIN_USERNAME_LENGTH_MAX').'');
							$js .= (',label:"'.addslashes($this->iLabel['username']).'" ');
						$js .= ('}');
						$js .= (',pass:{');
							$js .= ('min:'._GGN::varn('LOGIN_PASSWORD_LENGTH_MIN').'');
							$js .= (',max:'._GGN::varn('LOGIN_PASSWORD_LENGTH_MAX').'');
							$js .= (',label:"'.addslashes($this->iLabel['password']).'" ');
						$js .= ('}');
					$js .= ('});');

						$js .= ('if(typeof Login=="object"){');

							$js .= ('Login.onError=function(){');
								$js .= ('GToast(arguments[0]||"no-args.0").bubble({delay:10*1000});');
							$js .= ('};');

						$js .= ('}');

				$js .= ('}');
			$js .= ('})(window,"#ggn-connect-login-form");');


			return $js;
			
		}



		public function resetPasswordJSInit(){
			global $_Gougnon;

			$js = '';

			$js .= ('(function(w,fid){');
				$js .= ('if(typeof GLogin=="function"){');
					$js .= ('w.LoginResetPassword=G.Login(fid).resetPassword();');

						$js .= ('if(typeof LoginResetPassword=="object"){');
							$js .= ('LoginResetPassword.onError=function(){');
								$js .= ('GToast(arguments[0]||"no-args.0").bubble({delay:10*1000});');
							$js .= ('};');
						$js .= ('}');

				$js .= ('}');
			$js .= ('})(window,"#ggn-connect-reset-password-form");');
			

			return $js;
		}



		public function resetPasswordFactoryJSInit(){
			global $_Gougnon;

			$js = '';
			
			$js .= ('(function(w,fid){');
				$js .= ('if(typeof GLogin=="function"){');
					$js .= ('w.LoginResetPasswordFactory=G.Login(fid).resetPasswordFactory({');
							$js .= ('min:'._GGN::varn('LOGIN_PASSWORD_LENGTH_MIN').'');
							$js .= (',max:'._GGN::varn('LOGIN_PASSWORD_LENGTH_MAX').'');
							$js .= (',label:"'.addslashes($this->iLabel['password']).'" ');
					$js .= ('});');

						$js .= ('if(typeof LoginResetPasswordFactory=="object"){');
							$js .= ('LoginResetPasswordFactory.onError=function(){');
								$js .= ('GToast(arguments[0]||"no-args.0").bubble({delay:10*1000});');
							$js .= ('};');
						$js .= ('}');

				$js .= ('}');
			$js .= ('})(window,"#ggn-connect-reset-password-factory-form");');

			
			return $js;
		}




	public function destroySession(){
		global $_Gougnon;

		$lLogin = new \GGN\Using('Connect/Login');

		// $_handlerApp = _GGN::varn('USERS_SESSION_MANAGER_PLUGIN_NAME');
		// $sessionAPP=new $_handlerApp;
		// $sessionAPP->path=ActiveUserSession::sessionPATH;
		// $sessionAPP->type=strtolower(_GGN::varn('USERS_SESSION_LOCATION'));

		// $this->logoutType=false;
		$this->logoutAPP=$this->app;
		$connect = \GGN\Connect\Login\Invoke::Main(['app'=>$this->app]);


		if($this->app==false){
			$this->logoutType='-complete';
			$this->logoutAPP='-system';
			// $sessionAPP->name=ActiveUserSession::sessionName;
			// $sessionAPP->destroyPATH();


			/* Mise à jour du log de l'utilisateur / DEBUT */

				new \GGN\Using('User');

				$log = new \GGN\User\Log('login', 'Déconnexion Acceptée!');

			/* Mise à jour du log de l'utilisateur / FIN */


			return $connect->logout();
		}
		if(is_string($this->app)){
			$this->logoutType='-app';
			// $sessionAPP->name=ActiveUserSession::appSessionName($this->app);
			// $sessionAPP->destroy();

			return $connect->logout('app.session.destroy');
		}

		// if(method_exists($sessionAPP, 'destroy') && $sessionAPP!==false){
		// 	return $sessionAPP;
		// }

		return false;

	}




	public function getBrowserRequest(){
		global $_Gougnon;

		$redirRequest = [];
		if(isset($this->app) && !Gougnon::isEmpty($this->app) ){$redirRequest[] = 'app='.urlencode($this->app).'';}
		if(isset($this->next) && !Gougnon::isEmpty($this->next)){$redirRequest[] = 'next='.urlencode($this->next); }
		if(isset($this->previous) && !Gougnon::isEmpty($this->previous)){$redirRequest[] = 'previous='.urlencode($this->previous);}

		return $redirRequest;

	}



	}
	
}
	
	
?>