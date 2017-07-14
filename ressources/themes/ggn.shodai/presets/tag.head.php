<?php


/*
	Copyright GOBOU Y. Yannick
	
*/
	
namespace GGN\DPO;

	/* 
		Le Doctype de la page
	 */
	$this->doctype('html');




	/* 
		Pour les Meta de Google Plus
	 */

	$this->html('itemscope', '');

	$this->html('itemtype', 'http://schema.org/Other');




	/* 
		Paramètres de la page
	 */
	$this->settings = new Theme\Settings();
	
	$this->settings

		->add('context.menu', true)

		->add('responsive', true)

	;



	/* 
		Création de l'entete de la page
	 */
	$this->head = new Theme\Head($this->manifest);



	/* 
		Titre de la page
	 */
	/* Debut de la sequence 'Head' */
	$this->head


		
		->title(isset($this->title) ? $this->title : \_GGN::varn('HOMEPAGE_TITLE'))

		/* 
			Favicone 
		*/
		->shortcut(\_GGN::setvar(\_GGN::varn('FAVICON')))

		// ->shortcut(\HTTP_HOST . '' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '')


		/* 
			Balise Meta dans le 'head'
		*/
		->meta('charset', 'utf-8')
		
		->meta('http-equiv', 'pragma', 'cache')
		
		->meta('name', 'mobile-web-app-capable', 'yes')
		
		->meta('name', 'viewport', 'width=device-width,initial-scale=1, maximum-scale=1.0, user-scalable=no')


		->meta('name', 'theme-color', $this->Cores->CSS->styleProperty('palette-primary-color'))


		->meta('name', 'msapplication-navbutton-color', $this->Cores->CSS->styleProperty('palette-primary-color'))


		->meta('name', 'apple-mobile-web-app-capable', 'yes')

		->meta('name', 'apple-mobile-web-app-status-bar-style', 'black-translucent')
	



		/* Meta de référencement */
		
		// ->meta('name', 'Description', "")

		// ->meta('name', 'Robots', "all")

		// ->meta('name', 'Author', "")

		// ->meta('name', 'Copyright', "")


	
	
		/* Meta Facebook */
		
		->meta('property', 'og:title', \_GGN::varn('SITENAME'))
		
		->meta('property', 'og:image', '' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=310&height=310&resize=true&resizeby=0&quality=-high')
		
		->meta('property', 'og:site_name', \_GGN::varn('SITENAME') )
		
		// ->meta('property', 'og:description', "")
		
	
	
	
		/* Meta Google Plus */
		
		->meta('itemprop', 'name', \_GGN::varn('SITENAME'))
		
		// ->meta('itemprop', 'description', "")
		
		->meta('itemprop', 'image', '' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=310&height=310&resize=true&resizeby=0&quality=-high')
		
	
		



		/* Favicones */
		
		->meta('name', 'msapplication-square70x70logo', '' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=70&height=70&resize=true&resizeby=0&quality=-high')

		->meta('name', 'msapplication-square150x150logo', '' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=150&height=150&resize=true&resizeby=0&quality=-high')
		
		->meta('name', 'msapplication-square310x310logo', '' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=310&height=310&resize=true&resizeby=0&quality=-high')


		->link(['rel'=>'apple-touch-icon','sizes'=>'48x48','href'=>'' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=48&height=48&resize=true&resizeby=0&quality=-high'])

		->link(['rel'=>'apple-touch-icon','sizes'=>'64x64','href'=>'' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=64&height=64&resize=true&resizeby=0&quality=-high'])

		->link(['rel'=>'apple-touch-icon','sizes'=>'76x76','href'=>'' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=76&height=76&resize=true&resizeby=0&quality=-high'])

		->link(['rel'=>'apple-touch-icon','sizes'=>'120x120','href'=>'' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=120&height=120&resize=true&resizeby=0&quality=-high'])

		->link(['rel'=>'apple-touch-icon','sizes'=>'152x152','href'=>'' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=152&height=152&resize=true&resizeby=0&quality=-high'])

		->link(['rel'=>'apple-touch-icon','sizes'=>'192x192','href'=>'' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=192&height=192&resize=true&resizeby=0&quality=-high'])

		->link(['rel'=>'apple-touch-icon','sizes'=>'196x196','href'=>'' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=196&height=196&resize=true&resizeby=0&quality=-high'])






		/* 
			Framework CSS
		*/

		/* Packges de la page */
		// ->cssPackages()
		


		/* Packges du manifest */
		->cssPackages($this->manifest->package->css->list)



		/* Style Générale du theme */
		->link($this->manifest->links->list)



		/* Style du theme */
		->css($this->manifest->css->list)
		


		/* Code Général du Style du theme */
		->style($this->manifest->style->list)



		/* Framework JS */
		// ->jsPackages(['ggn.com.service'])


		/* Packges du manifest */
		->jsPackages($this->manifest->package->js->list)



		/* 
			Fichier JS
		*/
		// ->script($this->_url . '')
		
		// ->script($this->_url . '')


		/* 
			Script Générale du theme 
		*/
		->script($this->manifest->scripts->list)



		/* 
			Code JS
		*/
		->js($this->manifest->js->list)



		->write('<base href="'.HTTP_HOST.'" target="_self">')

	/* Fermeture de la sequence 'Head' */
	;


