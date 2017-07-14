<?php

namespace GGN\DPO;





new Using('DPO\Page');

new Using('DPO\Procedure');

new Using('DPO\Theme');







	/* Taritement */
	$ecode = (isset($args[1]))?$args[1]:false;






	/* Activation */
	if(\_GGN::varn('ERRORPAGE_ACTIVE')!=='1'){

		self::wCnsl('<h1>Page non introuvée</h1>' . ((is_string($ecode))?'CODE : ' . $ecode : '') );
		
	}




	$Gerror_NATIVE_VARS = 'ERRORPAGE_THEME ERRORPAGE_STYLE ERRORPAGE_TITLE';
	\_GGN::keyExists(explode(' ',$Gerror_NATIVE_VARS));





	$message = \Register::getHTTPErrorMessages(HTTP_ERROR_403);
	
	$title = $message['title'];
	
	$code = $message['code'];
	
	$about =  $message['about'];



	/* Thème */
	@header('Content-Type:text/html;');





/* 
	Initialisation du Theme 
*/
$tpl = new Theme\Preset(\_GGN::varn('ERRORPAGE_THEME'));




/* 
	Titre de la page
 */
$tpl->name = 'Gougnon Connect Error';

$tpl->version = '0.1';

$tpl->update = date('ymd.hi');
// $tpl->update = '150923.2200';

$tpl->host = __FILE__;



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
$tpl->head->title($code . ' ' . $title)

	/* 
		Favicone 
	*/
	->shortcut( \_GGN::setvar(\_GGN::varn('FAVICON')) )


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
	// ->cssPackages([])


	/* Packges du manifest */
	->cssPackages($tpl->manifest->package->css->list)


	/* Packges du manifest du thème */
	->cssPackages(isset($tpl->manifest->package->css->error->list) && is_object($tpl->manifest->package->css->error->list) ? $tpl->manifest->package->css->error->list: false)


	/* Style Générale du theme */
	->link($tpl->manifest->links->list)


	/* Style du error du theme */
	->link(isset($tpl->manifest->links->error->list) && is_object($tpl->manifest->links->error->list) ? $tpl->manifest->links->error->list: '')



	/* Style du theme */
	->css($tpl->manifest->css->list)



	/* Code du Style du error du theme */
	->css(isset($tpl->manifest->css->error->list) && is_object($tpl->manifest->css->error->list) ? $tpl->manifest->css->error->list: '')


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



	/* Code du Style du error du theme */
	->style(isset($tpl->manifest->style->error->list) && is_object($tpl->manifest->style->error->list) ? $tpl->manifest->style->error->list: '')






	/* 
		Framework JS
	*/
	// ->jsPackages([])


	/* Packges du manifest */
	->jsPackages($tpl->manifest->package->js->list)


	/* Packges du manifest du thème */
	->jsPackages(isset($tpl->manifest->package->js->error->list) && is_object($tpl->manifest->package->js->error->list) ? $tpl->manifest->package->js->error->list: '')


	/* 
		Fichier JS
	*/
	// ->script()


	/* 
		Script Générale du theme 
	*/
	->script($tpl->manifest->scripts->list)


	/* 
		Script du error du theme
	*/
	->script(isset($tpl->manifest->scripts->error->list) && is_object($tpl->manifest->scripts->error->list) ? $tpl->manifest->scripts->error->list: '')


	/* 
		Code JS
	*/
	// ->js()



	/* 
		Code JS Général du error du theme
	*/
	->js($tpl->manifest->js->list)



	/* 
		Code JS du error du theme
	*/
	->js(isset($tpl->manifest->js->error->list) && is_object($tpl->manifest->js->error->list) ? $tpl->manifest->js->error->list: '')



/* Fermeture de la sequence 'Head' */
;







/*
	Feuille
*/

$tpl->body = new Theme\Body();

$tpl->body->sheet = new Theme\Tag(['id'=>'ggn-sheet', 'class'=>'gui sheet' ]);


	/* Calque */
	$tpl->body->sheet->node->layer = new Theme\Tag(['class'=>'gui flex full center error-section' ]);


		/* Formulaire */
		$tpl->body->sheet->node->layer->node->box = new Theme\Brick('Section.Error',[

			'attributes'=>['size'=>['480px','auto']]

			,'arguments'=> [
				
				new Theme\Content($code)
				
				, new Theme\Content($title)

				, new Theme\Content($about)

				, new Theme\Content($ecode)


			]


			,'error'=> function($ecode = false){
				
				return 'Impossible de charger cette brique';
			
			}

		]);






/* 
	La page 
 */
$page = new Page\Init($tpl);


/* Moteur de rendu */
$page->engine()->schema( (new Page\RenderingScheme())->html5 )->start();






?>