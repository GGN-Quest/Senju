<?php
	global $_Gougnon;

	if(!isset($this->manifest)){exit('Accèss réfusé');}



	/* 
		Petite vérification
	*/
	$_NATIVES_VARS = 'SYSTEM_THEME_STYLE';
	
	_GGN::keyExists(explode(' ', $_NATIVES_VARS), $_Gougnon);


	
	

	/* 
		Auteur du theme
	*/
	$this->manifest->author['name'] = 'GOBOU Y. Yannick';
	
	$this->manifest->author['email'] = 'qaidyann@Gougnon.com';
	
	$this->manifest->author['about'] = 'gougnon.com';
	


	/* 
		Info du theme
	*/
	$this->manifest->theme['name'] = 'GGN.Senju.Shodai';
	
	$this->manifest->theme['description'] = 'Thème par defaut';

	$this->manifest->theme['version'] = '0.1';

	$this->manifest->theme['copyright'] = '&copy; 2015 GOBOU Y. Yannick';

	$this->manifest->theme['powered'] = 'Propulsé par ' . \_GGN::SYSTEM_NAME . ' ' . \_GGN::SYSTEM_VERSION . ', http://gougnon.com/core';


	
	
	/* 
		Thème pour ordinateur 
	*/

	$this->manifest->computer = [];
	
	$this->manifest->computer['prefixe'] = 'ggn.';


	/* 
		Brique
	*/

	$this->manifest->computer['Header'] = 'header/normal';

	$this->manifest->computer['Container.Full'] = 'container/full';

	$this->manifest->computer['Slider'] = 'slider/normal';

	$this->manifest->computer['Box.Normal'] = 'box/normal';

	$this->manifest->computer['Form.Box'] = 'form/box';

	$this->manifest->computer['Section.Error'] = 'section/error';









	/* 
		Initialisation
	*/


	/* 
		Chemin des données
		Par default il prendra le nom du dossier du thème
	*/
	// $this->_path = ''; 
	

	/* 
		URL des données
		Par default il prendra le nom du dossier du thème précédé de l'url de GGN
	*/
	// $this->_url = '';
	

	/* 
		Style du package du theme
	*/


	$this->style = (isset($this->style) && is_string($this->style)) ? $this->style : \_GGN::varn('SYSTEM_STYLE');

	// $this->palette = '';




	/* Chargement du style du Noyau */

	$this->Cores->CSS->Style($this->style);
		
	$this->Cores->CSS->ColorsToParam();






	/* 
		Donnée pour type de page
	*/

	/* 
		Page : Toutes
	*/

	$this->manifest->package->js
	
		->add('ggn.gabarit')
		
	;



	$this->manifest->package->css->add('ggn.effects')

		->add('ggn.layout')
		
		->add('ggn.gabarit')
		
		->add('ggn.effects')

		->add('ggn.icons')
		
		// ->add('ggn.sense.page.manager')

	;
	

	$this->manifest->links->add( $this->_url . 'normal.css?style=' . $this->style);

	$this->manifest->links->add( HTTP_HOST . 'font?family=roboto.thin&' . $this->style);

	$this->manifest->links->add( HTTP_HOST . 'font?family=roboto.bold&' . $this->style);

	$this->manifest->links->add( HTTP_HOST . 'font?family=roboto.condensed.regular&' . $this->style);







	/* 
		Page : Home
	*/

	/* Packages */

	/* CSS */
	$this->manifest->package->css->home = $this->manifest->node();

	$this->manifest->package->css->home->add('');


	/* Fichier JS */
	$this->manifest->scripts->home = $this->manifest->node();

	// $this->manifest->scripts->home->add($this->_url . 'normal.js?style=' . $this->style);




	/* Tag 'link' */
	$this->manifest->links->home = $this->manifest->node();

	// $this->manifest->links->home->add($this->_url . 'home.css');







	/* 
		Page : Account
	*/

	/* Packages */

	/* CSS */
	$this->manifest->package->css->account = $this->manifest->node();

	$this->manifest->package->css->account->add('');



	/* Tag 'link' */
	$this->manifest->links->account = $this->manifest->node();

	$this->manifest->links->account->add($this->_url . 'def.account.css?style=' . $this->style);







	/* 
		Page : Login
	*/

	/* Packages */

	/* CSS */
	$this->manifest->package->css->login = $this->manifest->node();

	$this->manifest->package->css->login->add('');


	/* Fichier JS */
	// $this->manifest->scripts->login = $this->manifest->node();

	// $this->manifest->scripts->login->add($this->_url . '');


	/* Tag 'link' */
	$this->manifest->links->login = $this->manifest->node();

	$this->manifest->links->login->add($this->_url . 'connect.login.css');







	/* 
		Page : Error
	*/

	/* Packages */

	/* CSS */
	$this->manifest->package->css->error = $this->manifest->node();

	$this->manifest->package->css->error->add('font.roboto.thin');


	/* Fichier JS */
	// $this->manifest->scripts->error = $this->manifest->node();

	// $this->manifest->scripts->error->add($this->_url . '');


	/* Tag 'link' */
	$this->manifest->links->error = $this->manifest->node();

	$this->manifest->links->error->add($this->_url . 'error.page.css?style=' . $this->style);




	
?>