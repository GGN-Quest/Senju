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

	$cover = Register::_POST('cover', false);




	/* BID conforme */

	if(is_string($bid) && is_string($cover)){


		/* Pour les valuers Numeriques */
		new \GGN\Using('Numeric');



		/* Ressources */
		\GSystem::requires('util.rsrc');



		/* Chargement du Name Space User/Blog */

		new \GGN\Using('User\Blog');
		




		/* Mise à jour */
		$update = \GGN\User\Blog\Cover::Update($bid, $cover);

		$treat->update = (is_object($update) ? true : false);
		


	}



