 <?php
/*
	Copyright GOBOU Y. Yannick
	
*/


	global $database;


if(isset($this->Register->USER) && is_array($this->Register->USER)){


	$this->Response(true);



	$treat = $this->node('treat');



	$treat->insert = false;



	/* Entité */
	$Entity = Register::_POST('entity', false);



	/* Utilisateur */
	$comment = Register::_POST('comment', false);



	/* Utilisateur */
	$UKey = Register::_POST('ukey', __IP__);



	/* MID */
	$mid = Register::_POST('mid', '');





	/* Entité existe */

	if(is_string($Entity)){


		$_from = $this->Register->USER['UKEY'];

		$_to = $UKey;

		$_name = 'Photo.Comment';

		$UDat = false;



		if(

			is_string($_from)

			&& is_string($_to)

			&& is_string($_name)

			&& is_string($Entity)

			&& is_string($comment)

		){


			$insert = $database->InsertIntoTable('NATIVE_INTERACTION_ENTITIES', " VALUES(NULL, '$_from', '$_to', '$_name', '$mid', '$Entity', '$comment', '" . time() . "', '1'); ");

			$treat->insert = is_object($insert) ? true : false;

			// $treat->exists = false;

			$this->Response(true);


		}

		

	}


	// $treat->_POST = $_POST;



}


/* Besoin de connexion */
else{

	$this->Response('require.login');

}


