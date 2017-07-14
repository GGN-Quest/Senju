<?php
/*
	Copyright GOBOU Y. Yannick
	
*/
	
namespace GGN\DPO;



new Using('DPO\Page');

new Using('DPO\Procedure');

new Using('DPO\Theme');






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
$tpl->head->title($PageTitle)


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
	->cssPackages([

		'ggn.connect.login'
		
		,'ggn.awake.confirm'
	
	])


	/* Packges du manifest */
	->cssPackages($tpl->manifest->package->css->list)


	/* Packges du manifest du thème */
	->cssPackages(isset($tpl->manifest->package->css->login->list) && is_object($tpl->manifest->package->css->login->list) ? $tpl->manifest->package->css->login->list: false)


	/* Style Générale du theme */
	->link($tpl->manifest->links->list)


	/* Style du login du theme */
	->link(isset($tpl->manifest->links->login->list) && is_object($tpl->manifest->links->login->list) ? $tpl->manifest->links->login->list: '')



	/* Style du theme */
	->css($tpl->manifest->css->list)



	/* Code du Style du login du theme */
	->css(isset($tpl->manifest->css->login->list) && is_object($tpl->manifest->css->login->list) ? $tpl->manifest->css->login->list: '')


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
	->jsPackages([
		
		'ggn.com.service'

		,'ggn.connect.login'

		,'ggn.awake.confirm'

	])


	/* Packges du manifest */
	->jsPackages($tpl->manifest->package->js->list)


	/* Packges du manifest du thème */
	->jsPackages(isset($tpl->manifest->package->js->login->list) && is_object($tpl->manifest->package->js->login->list) ? $tpl->manifest->package->js->login->list: '')
	

	/* 
		Fichier JS
	*/
	->script($PageJSFile)


	/* 
		Script Générale du theme 
	*/
	->script($tpl->manifest->scripts->list)


	/* 
		Script du login du theme
	*/
	->script(isset($tpl->manifest->scripts->login->list) && is_object($tpl->manifest->scripts->login->list) ? $tpl->manifest->scripts->login->list: '')


	/* 
		Code JS
	*/
	->js($PageJSCode)



	->js(Page\Secure::noIframeAccessScript())



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
		$tpl->body->sheet->node->layer->node->box = new Theme\Brick('Box.Normal', [

			'attributes'=>['size'=>['320px','auto']]

			,'arguments'=> $BlocForm


			,'error'=> function($code = false){
				
				return 'Impossible de charger cette brique';
			
			}

		]);





?>