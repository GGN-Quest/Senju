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
	$UKey = Register::_POST('ukey', false);



	/* Type */
	$Type = Register::_POST('type', '');



	/* MID */
	$mid = Register::_POST('mid', '');



	/* Entité existe */
	if(is_string($Entity)){


		$_from = $this->Register->USER['UKEY'];

		$_to = '';

		$_name = 'Photo.Like';

		$_data = __IP__;

		$_entity = false;

		$UDat = false;




		/* Recherche le nom de l'utilisateur possedant la photo */
		if(is_string($UKey)){

			$QU = \GUSERS::get(" WHERE UKEY='" . addslashes($UKey) . "' ", true);

			if(is_object($QU)){

				if($QU->row > 0){

					/* Destinataire de la mention */
					$UDat = $QU->data[0];

					$_to = $UDat['UKEY'];



				}

			}


		}



		/* Recherche l'entité */

		if(is_string($Type)){

			// $_entity = $Type . '//:'; 

			switch ($Type) {

				// case 'rsrc':

				// 	$Entx = explode('/', $Entity);

				// 	$_usr = (isset($Entx[1])) ? $Entx[1] : false;

				// 	$_entity .= $UKey . '/' . implode('/', \Gougnon::arrayValues($Entx, 2));
					
				// break;

				default:

					$_entity = $Entity;

				break;
				
			}




		}




		if(

			is_string($_from)

			&& is_string($_to)

			&& is_string($_name)

			&& is_string($_entity)

			&& is_string($_data)

		){


			$exists = false;

			$get = $database->SelectFromTable('NATIVE_INTERACTION_ENTITIES', " WHERE _ENTITY='$_entity' AND _NAME='$_name' AND _FROM='$_from' AND _TO='$_to'  ");



			if(is_object($get)){

				$get->results($database::RESULTS_METHOD_LINE_OBJECT);

				if($get->row > 0){

					$exists = true;

				}

			}



			if($exists == true){


				$treat->exists = true;

			}



			if($exists == false){

				$insert = $database->InsertIntoTable('NATIVE_INTERACTION_ENTITIES', " VALUES(NULL, '$_from', '$_to', '$_name', '$mid', '$_entity', '$_data', '" . time() . "', '1'); ");

				$treat->insert = is_object($insert) ? true : false;

				$treat->exists = false;

			}


			$this->Response(true);


		}

		

	}


	// $treat->_POST = $_POST;



}


/* Besoin de connexion */
else{

	$this->Response('require.login');

}


