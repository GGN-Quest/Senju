<?php
/*
	Copyright GOBOU Y. Yannick
	
*/
	
namespace GGN\DPO;





/*
	Paramètres, vérification et Classes
*/


/* Existence des variables Native  */
$GLOGIN_NATIVE_VARS = 'USERS_SESSION_LOCATION ACTIVESESSION_MODE USERS_SESSION_MANAGER_PLUGIN_NAME';

\_GGN::keyExists(explode(' ',$GLOGIN_NATIVE_VARS));



/* Noyau des utilisateurs  */
if(!class_exists('\GUSERS')){
	
	\_GGN::PHPCore('ggn.core.users');

}



/* Noyau des applications  */
if(!class_exists('\GAPPS')){

	\_GGN::PHPCore('ggn.core.applications');

}




/* Chargement de l'ARC-Classe de rendu  */
if(!class_exists('GLogin')){

	$this->requireARCRenderClass('LOGIN/default');

}




/* Existance d'utilisateur connecté */


/*
	Utilisateur depuis le registre
*/
$User = $this->USER;



/*
	Désactiver la fonction de application
*/
$NoApp = $this->_GET('no-app', 0);$NoApp*=1;

	$NoApp = ($NoApp===1)?true:false;


/*
	Clé de l'application
*/
$AppKey =  $this->_GET('app', \_GGN::varn('APP_KEY_DEFAULT'));


/*
	Message à retourner
*/
$Message = $this->_GET('message', false);


/*
	Basculer vers
*/
$Toggle = $this->_GET('toggle', false);







/* 
	Application a partir de la clé de l'application
*/
$App = \GGN\Apps\Get::Manifest($AppKey);



/* 
	Existence de l'application 
*/
$_AppExists = is_array($App);





/* 
	Si un message n'est pas detecté 
	Redirection du client vers l'application si aucun message n'est détecté.
*/
if(!is_string($Message)){


	/* Redirection vers l'interface utilisateur */
	if(is_array($User) && $AppKey===false){
		

		/* Application indexé */
		if($_AppExists==TRUE){
		
			header('location:'. \_GGN::setvar($App['URL']) . '');exit;
		
		}
		

		/* Application par defaut */
		else{
		
			$App = \GGN\Apps\Get::Manifest(\_GGN::varn('APP_KEY_DEFAULT'));
		
			$_AppExists = is_array($App);
		

		
			if($_AppExists==TRUE){
		
				header('location:'. \_GGN::setvar($App['URL']) . '');exit;
		
			}
		
			else{
		
				\_GGN::wCnsl('<h1>Erreur Application d\'Emulation</h1>L\'application par defaut est introuvable');
		
			}

		}
		
	}




	/* Session de l'application */
	if(is_string($AppKey)){

		// $__SESSIONLOCATION=strtolower(\_GGN::varn('USERS_SESSION_LOCATION'));
		
		$AppUser = \GSystem::requires('users.login.app/secures',$AppKey);

	}



}






/* ARC-Class 'GLogin' */
$Login = new \GLogin(
	
	(isset($_GET['next']))?$_GET['next']:false
	
	,(isset($_GET['previous']))?$_GET['previous']:false
	
	,($_AppExists==true) ? $AppKey : \_GGN::varn('APP_KEY_DEFAULT')
	
	,\_GGN::varn('ACTIVESESSION_MODE')

	,$User
	
	);


$Login->noApp = $NoApp;







/* 
	Label champ input : fonction du mode 
*/
$Login->labels();









/* Si un message est detecté */
if(is_string($Message)){
	
	$msg = strtolower(trim($Message));
	
	$msgex = explode(':', $msg);
	
	$msgtyp = (isset($msgex[0]))?$msgex[0]:false;
	
	$msgcod = (isset($msgex[1]))?$msgex[1]:false;
	


	$Login->MessageType = $msgtyp;
	
	$Login->MessageCode = $msgcod;



	$Login->MessageTitle = 'Erreur';

	$Login->Message = 'Erreur d\'origine inconnu observée lors de l\'ouverture de la page ';


	/* type d'erreur */
	if($msgtyp=='error' || $msgtyp=='warning' || $msgtyp=='failed'){

		if($msgcod=='right.require'){
		
			$Login->Message = 'Vous n\'avez pas les droits requires pour utiliser cette application';
		
		}
		
		if($msgcod=='session.failed'){
		
			$Login->Message = 'Vous devez êtres connecté pour acceder à cette application';
		
		}
		
		if($msgcod=='session.app.failed'){
		
			$Login->Message = 'La session de l\'application a expirée';
		
		}
		
		if($msgcod=='right.require' || $msgcod=='right.enough'){
		
			$Login->Message = 'Vous n\'avez pas le niveau d\'accès pour utiliser cette applicaion ';
		
		}

	}

	if($msgtyp=='warning'){
	
		$Login->MessageType = 'warning';

		$Login->MessageTitle = 'Attention';
	
	}
	
	if($msgtyp=='failed'){

		$Login->MessageTitle = 'Échec';
	
	}
	

}





/* Mode du message : Vérification si oui ou non un message a été détecté */
$Login->MessageMode = ($Message===false)?false:true;


/* Destruction de la session si le mo du message est 'TRUE' */
if($Login->MessageMode===TRUE){$Login->destroySession();}




if(is_string($Message)){
	
	/* Injection de l'application dans l'ARC-Class 'GLogin' */	
	$Login->APP = $App;


	/* Si une application a été détecté */
	if(is_array($App)){
	
		$Login->appTitle = $App['Name'];

		$Login->appURL = $App['URL'];

	}


	/* injection des variables dans le theme  */
	// $Login->_theme->NoApp=$Login->noApp;

	// $Login->_theme->App=$App;

	// $Login->_theme->AppUser=$AppUser;

	// $Login->_theme->_USER_APP_SESSION=(isset($_USER_APP_SESSION)) ? $_USER_APP_SESSION: false;


}





/* Détection du toggle d'usage */
$Login->Toggle = false;

if($Toggle!==false){

	if($Toggle=='reset:password'||$Toggle=='reset:password:factory'){
	
		$Login->Toggle = $Toggle;
	
	}

	if($Toggle=='user:interface'){
	
		$Login->Toggle = false;
	
	}

}



if(is_array($App)){

	$Login->appTitle = $App['Name'];
	$Login->appURL = $App['URL'];

}




if(\_GGN::varn('LOGIN_USE_REDIR') === true || !is_array($App)){

	$Login->appTitle = \_GGN::varn('LOGIN_REDIR_NAME');

	$Login->appURL = \_GGN::setvar(\_GGN::varn('LOGIN_REDIR_URL'));


}









/* Jonction du ARC / DEBUT */

	$_ARC_PAGE = $this->ARCPage('LOGIN');


	if(is_file($_ARC_PAGE)){


		new Using('DPO\Page');

		new Using('DPO\Procedure');

		new Using('DPO\Theme');


		/* 
			Initialisation du Theme 
		*/
		$tpl = new Theme\Preset(\_GGN::varn('LOGIN_THEME'));




		/* 
			Titre de la page
		 */
		$tpl->name = 'Gougnon Connect LogIn';

		$tpl->version = '0.1';

		// $tpl->update = date('ymd.hi');
		// $tpl->update = '150923.2200';

		$tpl->host = __FILE__;

		$tpl->style = \_GGN::varn('LOGIN_STYLE');








		/*
			Switch : Gestionnaire du contenu - DEBUT
		*/


		$BlocForm = '';

		$PageJSFile = false;

		$PageJSCode = false;

		$redirRequest = implode('&', $Login->getBrowserRequest());




		switch (strtolower($Login->Toggle)) {



			/* Bascule : Demande de changement de mot de passe */
			case 'reset:password:factory':

				$PageTitle = 'Reinitialisation du mot de passe';

					$ref = $this->_GET('reference', false);
					$app = $this->_GET('app', false);
					$tmp = $this->_GET('tmp', false);
					$email = $this->_GET('email', false);


				/* 
					Verification des paramètres invalides
				*/
				if(
					$ref===false || \Gougnon::isEmpty($ref)
					||$app===false || \Gougnon::isEmpty($app)
					||$tmp===false || \Gougnon::isEmpty($tmp)
					||$email===false || \Gougnon::isEmpty($email)
				){

					$BlocForm = [

						'Echec reinitialisation du mot de passe'

						, [
						
							new Theme\Content('Paramètres incomplets')
						
							, ('<br><br>')

							, new Theme\Content('<button class="active" onclick="location.href = (\''.HTTP_HOST.'login?new\');">Se connecter</button>')

							, new Theme\Content('<button onclick="location.href = (\''.HTTP_HOST.'login?toggle=reset:password\');">Nouvelle demande</button>')

						]

					];

				}

				/* 
					Verification des paramètres valides
				*/
				else{



					/*
						GGN Connect : Reinitialisation du mot de passe de l'utilisateur
					*/
					$connect = \GGN\Connect\Login\ResetPasswordFactory::Main([

						/* email de l'utilisateur */
						'email'=> $email

						/* Valeur de la requete */
						, 'codex'=>$tmp

					]);




					/* Validation de requete */
					$available = $connect->availableRequest();




					/* Verification de la validation de la requete */

					if($available!==true){

						if(isset($connect->_response) && is_array($connect->_response) && isset($connect->_response['because'])){

							$html = '';

							foreach ($connect->_response['because'] as $ck => $code) {

								switch(strtolower($code)){

									case 'attempt.email.undefined':
										$html .= 'Votre adresse IP ne correspond pas à celle de la requete.';
									break;
									
									case 'attempt.codex.undefined':
										$html .= 'Requete introuvable.';
									break;
									
									case 'attempt.email.not.found':
										$html .= 'Email introuvable.';
									break;

									case 'attempt.data.missing':
										$html .= 'Paramètre manquant dans la session.';
									break;

									case 'attempt.data.format.failed':
										$html .= 'Le format des données dans la session n\'est pas valide.';
									break;

									case 'attempt.access.failed':
										$html .= 'La clé d\'accès proposé n\'est pas valide.';
									break;

									case 'attempt.request.not.found':
										$html .= 'Requete introuvable, verifiez vous etes l\'auteur de la demande de reinitialisation de mot de passe.';
									break;

									case 'attempt.email.failed':
										$html .= 'Email invalide.';
									break;

									case 'attempt.codex.failed':
										$html .= 'Clé invalide.';
									break;

									// case 'try.over':
									// 	$html .= 'Le nombre de tentative est atteint. Un temps d\'inactivité vous a été imposé par mésure de sécurité.';
									// break;

									case 'attempt.ip.failed':
										$html .= 'Vous n\etes pas l\'auteur de cette demande de reinitialisation de mon passe.';
									break;

								}

							}


						}

						else{
							$html .= '<div class="field text"><a href="?canal=reset:password&'.$redirRequest.'" >Erreur subvenue lors du traitement des données</a></div>';
						}


						$BlocForm = [

							'Echec lors de la reinitialisation du mot de passe'

							, [
							
								new Theme\Content($html)
							
								, ('<br><br>')

								, new Theme\Content('<button class="active" onclick="location.href = (\''.HTTP_HOST.'login?new\');">Se connecter</button>')

								, new Theme\Content('<button onclick="location.href = (\''.HTTP_HOST.'login?toggle=reset:password\');">Nouvelle demande</button>')

							]

						];


					}


					else{


						$BlocForm = [

							'Reinitialisation du mot de passe'

							, [
								new Theme\Brick('Form.Box', [
								
									'arguments' => [
										
										[
											'action'=>'#'
											
											,'method'=>'POST'
											
											,'onsubmit'=>"return (function(f){return false;})(this);"

											,'id'=>'ggn-connect-reset-password-factory-form'

											,'name'=>'ggnConnectResetPasswordFactoryForm'
										]
										
										, false
										
										, [

											/* Infos */
											['label'=>'Veuillez indiquer votre adresse e-mail pour recevoir votre nouveau mot de passe']
											

											/* Mot de passe */
											,['input'=>['type'=>'password', 'name'=>'reset_password', 'class'=>'password', 'placeholder'=>'Mot de passe' ]]


											/* Confirmer Mot de passe */
											,['input'=>['type'=>'password', 'name'=>'reset_password_confirm', 'class'=>'password', 'placeholder'=>'Confirmer Mot de passe' ]]


											/* Bouton de traitement */
											,['input'=>['id'=>'login-reset-password-submit-box', 'type'=>'submit', 'class'=>'active', 'value'=>'Reinitialiser']]

											/* Chargement */
											,['label'=>'<div style="display:none;" id="login-reset-password-wait-box"><div class="gui loading circle x16 text-color-hover"></div></div>']

											/* Mot de passe oublié */
											,['label'=>'<a href="?toggle=user:interface&'.$redirRequest.'">Retournez à la page de connexion</a>']
											

											/* Clé Application */
											,['free.content'=>
												'<input type="hidden" name="email" value="'.$email.'" />'
												. '<input type="hidden" name="ref" value="'.$ref.'" />'
												. '<input type="hidden" name="tmp" value="'.$tmp.'" />'
												. '<input type="hidden" name="app" value="'.$AppKey.'"/>'
											]

											
										]
									]

								])
							]


						];


					

						$PageJSFile = $tpl->_url . 'connect.reset.password.factory.js';


						$PageJSCode = 

							$Login->resetPasswordFactoryJSInit()

							. 'GLoginResetPasswordFactorySuite(window["LoginResetPasswordFactory"]||false);'

						;

					}



				}

			break;
			







			/* Bascule : Demande de changement de mot de passe */
			case 'reset:password':

				$PageTitle = 'Changement de mot de passe';

				$BlocForm = [

					'Demande de changement de mot de passe'

					, [
						new Theme\Brick('Form.Box', [
						
							'arguments' => [
								
								[
									'action'=>'#'
									
									,'method'=>'POST'
									
									,'onsubmit'=>"return (function(f){return false;})(this);"

									,'id'=>'ggn-connect-reset-password-form'

									,'name'=>'ggnConnectResetPasswordForm'
								]
								
								, false
								
								, [

									/* Infos */
									['label'=>'Veuillez indiquer votre adresse e-mail pour recevoir votre nouveau mot de passe']
									

									/* Email */
									,['input'=>['type'=>'text', 'name'=>'email', 'class'=>'email', 'placeholder'=>'email@exemple.com', 'autocomplete'=>'off' ]]


									/* Bouton de traitement */
									,['input'=>['id'=>'login-reset-password-submit-box', 'type'=>'submit', 'class'=>'active', 'value'=>'Envoyer la demande']]

									/* Chargement */
									,['label'=>'<div style="display:none;" id="login-reset-password-wait-box"><div class="gui loading circle x16 text-color-hover"></div></div>']

									/* Mot de passe oublié */
									,['label'=>'<a href="?toggle=user:interface&'.$redirRequest.'">Retournez à la page de connexion</a>']
									

									/* Clé Application */
									// ,['input'=>['type'=>'hidden', 'name'=>'app', 'value'=>$AppKey ]]

									
								]
							]

						])
					]


				];



				$PageJSFile = $tpl->_url . 'connect.reset.password.js';


				$PageJSCode = 

					$Login->resetPasswordJSInit()

					. 'GLoginResetPasswordSuite(window["LoginResetPassword"]||false);'

				;


			break;
			




			/* Aucune Bascule definie */
			default:
				
				/* Mode de message */
				if($Login->MessageMode==true){

					$PageTitle = $Login->MessageTitle . ' - Connexion';

					$BlocForm = [
						
						$Login->MessageTitle
						
						,[
						
							new Theme\Content($Login->Message)

							, ('<br><br>')

							, new Theme\Content('<button onclick="location.href = (\''.HTTP_HOST.'login?new\');">Se connecter</button>')
						
						]

					];


				}

				else{

					$PageTitle = \_GGN::varn('LOGIN_TITLE');

					$BlocForm = [

						'Se connecter'

						, [
							new Theme\Brick('Form.Box', [
							
								'arguments' => [
									
									[
										'action'=>'#'
										
										,'method'=>'POST'
										
										,'onsubmit'=>"return (function(f){return false;})(this);"

										,'id'=>'ggn-connect-login-form'

										,'name'=>'ggnConnectLoginForm'
									]
									
									, false
									
									, [

										/* contenu libre */
										['free.content'=>'<div id="login-warning-box"></div>']

										/* Nom d'utilisateur */
										, (is_array($User))

										? ['label'=>'<span class="lowc">//</span> <span class="grand">' . ucfirst($User['USERNAME']) . '</span>'
											, 'input'=>['type'=>'hidden', 'name'=>'username', 'value'=> $User['USERNAME']]
										]

										: ['input'=>['type'=>'text', 'name'=>'username', 'class'=>'username', 'placeholder'=> $Login->label->iUsername]]
										

										/* Mot de passe */
										,['input'=>['type'=>'password', 'name'=>'password', 'class'=>'password', 'placeholder'=>'Mot de passe']]


										/* Se souvenir */
										,['input'=>['type'=>'checkbox', 'name'=>'remember', 'class'=>'remember', 'label'=>'Se souvenir de moi']]


										/* Bouton de traitement */
										,[
											'input'=>['id'=>'login-submit-box', 'type'=>'submit', 'class'=>'active', 'value'=>'Se connecter']
											
											,'free.content'=>'<input id="login-go-home" type="button" value="Accueil" onclick="location.href=\''.HTTP_HOST.'home\'">&nbsp;<input id="login-subscribe" type="button" value="S\'inscrire" class="" onclick="location.href=\''.HTTP_HOST.'subscribe\'">&nbsp;<div style="display:none;" id="login-wait-box"><div class="gui  loading circle x16 text-color-hover margin-t-x32 padding-lr-x4"></div></div>&nbsp;'
										]

										/* Bouton de traitement */
										// ,[
										// ]

										/* Chargement */
										,['label'=>'']

										/* Se connecter avec un autre compte */
										,['label'=>(is_array($User))? '<a href="'.HTTP_HOST.'logout">Se connecter avec un autre compte</a>': false]



										/* Mot de passe oublié */
										,['label'=>'<a href="?toggle=reset:password&'.$redirRequest.'">Mot de passe oublié ?</a>']



										/* contenu libre */
										,['free.content'=>$Login->formData()]

										
									]
								]

							])
						]

					];



					$PageJSFile = $tpl->_url . 'connect.login.js';


					$PageJSCode = 

						$Login->JSInit()

						. 'GLoginSuite(window["Login"]||false);'

					;

				}

			break;
		}





		/*
			Switch : Gestionnaire du contenu - FIN
		*/


		/* Inclusion Jonction du ARC / FIN */
		
		include $_ARC_PAGE;


		/* 
			La page 
		 */
		/* Moteur de rendu */

		$page = new Page\Init($tpl);

		$page->engine()->schema( (new Page\RenderingScheme())->html5 )->start();


	}

	else{

		$this->eventOn('ERROR.ARC', 'LOGIN');

	}

/* Jonction du ARC / FIN */






?>