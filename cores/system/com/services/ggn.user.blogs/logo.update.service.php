 <?php
/*
	Copyright GOBOU Y. Yannick
	
*/


	global $database;



	$this->Response(true);

	$treat = $this->node('treat');

	$treat->update = false;



	/* Entité */

	$bid = Register::_POST('bid', false);

	$logo = Register::_POST('logo', false);




	/* BID conforme */

	if(is_string($bid) && is_string($logo)){


		/* Pour les valuers Numeriques */
		new \GGN\Using('Numeric');



		/* Ressources */
		\GSystem::requires('util.rsrc');



		/* Chargement du Name Space User/Blog */

		new \GGN\Using('User\Blog');
		




		/* Mise à jour */
		$update = \GGN\User\Blog\Logo::Update($bid, $logo);

		$treat->update = (is_object($update) ? true : false);
		


	}



