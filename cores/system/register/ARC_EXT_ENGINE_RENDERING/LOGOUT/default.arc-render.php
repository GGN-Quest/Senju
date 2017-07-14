<?php
/*
	Copyright GOBOU Y. Yannick
	
*/
	
namespace GGN\DPO;



new Using('DPO\Page');

new Using('DPO\Procedure');

new Using('DPO\Theme');









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






/*
	Utilisateur depuis le registre
*/
$User = $this->USER;





/* 
	Application a partir de la clé de l'application
*/
$App = new \GAPPS($this->_GET('app', ''));



/* 
	Existence de l'application 
*/
$_AppExists = is_object($App->Infos);






/* ARC-Class 'GLogin' */
$Login = new \GLogin(
	
	$this->_GET('next', false)
	
	,$this->_GET('previous', false)
	
	,$this->_GET('app', false)
	
	,false

	,$User
	
);




/* Application à deconnecter */
$responses = $Login->destroySession();



$redirRequest = implode('&', $Login->getBrowserRequest());











/* 
	Initialisation du Theme 
*/
$tpl = new Theme\Preset(\_GGN::varn('LOGIN_THEME'));




/* 
	Titre de la page
 */
$tpl->name = 'Gougnon Connect LogOut';

$tpl->version = '0.1';

$tpl->update = date('ymd.hi');
// $tpl->update = '150923.2200';

$tpl->host = __FILE__;

$tpl->style = \_GGN::varn('LOGIN_STYLE');









/* 
	Système de cache 
*/
// $cache = new Cache($tpl);




// 	/* 
// 		Si le cache existe 
// 	*/
// 	if($cache->exists === true){


// 		$cache->load();

// 	}


// 	/* 
// 		Si le cache n'existe pas :  création de la page  
// 	*/
// 	else{




		/* 
			Le Doctype de la page
		 */
		$tpl->doctype('html');



		/* 
			Paramètres de la page
		 */
		$tpl->settings = new Theme\Settings();
		
		$tpl->settings->add('context.menu', true)->add('responsive', true);



		/* 
			Création de l'entete de la page
		 */
		$tpl->head = new Theme\Head();



		/* 
			Titre de la page
		 */
		/* Debut de la sequence 'Head' */
		$tpl->head->title('Déconnexion')

			/* 
				Favicone 
			*/
			->shortcut(\HTTP_HOST . 'favicon.png')


			/* 
				Balise Meta dans le 'head'
			*/
			->meta('charset', 'utf-8')
			->meta('http-equiv', 'pragma', 'cache')
			->meta('name', 'mobile-web-app-capable', 'yes')
			->meta('name', 'viewport', 'width=device-width,initial-scale=1')


			/* 
				Framework CSS
			*/

			/* Packges de la page */
			->cssPackages([
				
				'ggn.connect.login'
				
				,'ggn.lockbox.initialize'

				,'ggn.lockbox.confirm'
			
			])


			/* Packges du manifest */
			->cssPackages($tpl->manifest->package->css->list)


			/* Packges du manifest du thème */
			->cssPackages(isset($tpl->manifest->package->css->login->list) && is_object($tpl->manifest->package->css->login->list) ? $tpl->manifest->package->css->login->list: '')


			/* Style Générale du theme */
			->link($tpl->manifest->links->list)


			/* Style du login du theme */
			->link(isset($tpl->manifest->links->login->list) && is_object($tpl->manifest->links->login->list) ? $tpl->manifest->links->login->list: '')


			/* 
				Code CSS
			*/
			->style(
				[
					'html,body,.gui.sheet'=>[
						'width'=>'100%'
						, 'height'=>'100%'
					]
				]
			)



			/* Code Général du Style du theme */
			->style($tpl->manifest->style->list)



			/* Code du Style du login du theme */
			->style(isset($tpl->manifest->style->login->list) && is_object($tpl->manifest->style->login->list) ? $tpl->manifest->style->login->list: '')






			/* 
				Framework JS
			*/
			// ->jsPackages([])


			/* Packges du manifest */
			->jsPackages($tpl->manifest->package->js->list)


			/* Packges du manifest du thème */
			->jsPackages(isset($tpl->manifest->package->js->login->list) && is_object($tpl->manifest->package->js->login->list) ? $tpl->manifest->package->js->login->list: '')
			


			/* 
				Script Générale du theme 
			*/
			->script($tpl->manifest->scripts->list)


			/* 
				Script du login du theme
			*/
			->script(isset($tpl->manifest->scripts->login->list) && is_object($tpl->manifest->scripts->login->list) ? $tpl->manifest->scripts->login->list: '')



			/* 
				Code JS Général du login du theme
			*/
			->js($tpl->manifest->js->list)



			/* 
				Code JS du login du theme
			*/
			->js(isset($tpl->manifest->js->login->list) && is_object($tpl->manifest->js->login->list) ? $tpl->manifest->js->login->list: '')





		/* Fermeture de la sequence 'Head' */
		;





		/*
			Feuille
		*/

		$tpl->body = new Theme\Body();

		$tpl->body->sheet = new Theme\Tag(['id'=>'ggn-sheet', 'class'=>'gui sheet' ]);


			/* Calque */
			$tpl->body->sheet->node->layer = new Theme\Tag(['class'=>'gui connect login' ]);


				/* Formulaire */
				$tpl->body->sheet->node->layer->node->box = new Theme\Brick('Box.Normal',[

					'attributes'=>['size'=>['320px','auto']]

					,'arguments'=> [

						new Theme\Content(
							($Login->logoutType == '-complete')
							? 'Déconnexion complète'
							: 'Déconnexion de ' . (($_AppExists) ? ' "' . $App->Infos->Name . '" ': 'l\'application courante')
						)

						,[

							new Theme\Content('Vous êtes maintenance déconnecté de '
								. (
									($Login->logoutType == '-complete')
									? 'toutes les applications pécédemment utilisées.'
									: 'cette application '
								)
							)

							, ('<br><br>')

							, new Theme\Content('<button class="active" onclick="location.href = (\''.HTTP_HOST.'\');">Aller à l\'accueil</button>')

							, new Theme\Content('<button onclick="location.href = (\''.HTTP_HOST.'login?'.$redirRequest.'\');">Se connecter</button>')
						
						]

					]


					,'error'=> function($code = false){
						
						return 'Impossible de charger cette brique';
					
					}

				]);






		/* 
			La page 
		 */
		$page = new Page\Init($tpl);


		/* Moteur de rendu */
		$page->engine()->schema( (new Page\RenderingScheme())->html5 )->start();
		// $page->engine()->schema( (new Page\RenderingScheme())->html5 )->start(true);





	// 	/* Création du cache */
	// 	$cache->create($page->code);




	// 	/* Chargement du cache */
	// 	$cache->load();


	// }







?>