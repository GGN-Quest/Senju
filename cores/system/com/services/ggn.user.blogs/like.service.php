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
	$bid = Register::_POST('bid', false);




	/* Entité existe */
	if(is_string($bid)){


		$_from = $this->Register->USER['UKEY'];

		$_name = 'Blog.Like';

		$_data = __IP__;

		$_entity = $bid;



		

		$getu = $database->SelectFromTable('NATIVE_USERS_BLOGS', " WHERE BID='$bid' ");


		if(is_object($getu)){

			$getu->results(true);

			if($getu->row > 0){


				$_to = $getu->data[0]['UKEY'];


				if(is_string($_from)){


					$exists = false;

					$get = $database->SelectFromTable('NATIVE_INTERACTION_ENTITIES', " WHERE _ENTITY='$bid' AND _NAME='$_name' AND _FROM='$_from' AND _TO='$_to'  ");



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

						$insert = $database->InsertIntoTable('NATIVE_INTERACTION_ENTITIES', " VALUES(NULL, '$_from', '$_to', '$_name', '$_entity', '$bid', '$_data', '" . time() . "', '1'); ");

						$treat->insert = is_object($insert) ? true : false;

						$treat->exists = false;

					}


					$this->Response(true);


				}

			else{
				
				$treat->insert = 'user.not.found';

			}



			}

			else{
				
				$treat->insert = 'blog.not.found';

			}

		}

		

	}


	// $treat->_POST = $_POST;



}


/* Besoin de connexion */
else{

	$this->Response('require.login');

}


