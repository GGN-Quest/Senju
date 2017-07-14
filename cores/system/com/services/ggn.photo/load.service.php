 <?php
/*
	Copyright GOBOU Y. Yannick
	
*/


	global $database;


// if(isset($this->Register->USER) && is_array($this->Register->USER)){


	/*
		Classe utile pour les ressources 
		du système et des utilisateurs 
	*/

	GSystem::requires('util.rsrc');

	$_RSRC = new GGN_UTIL_RSRC($this->Register);





	$this->Response(true);



	$treat = $this->node('treat');

	



	/* Entité */
	$Entity = Register::_POST('entity', false);


  

	/* Utilisateur */
	$UKey = Register::_POST('ukey', __IP__);




	$treat->comments = false;

	$treat->like = 0;

	$treat->view = false;

	$treat->username = false;

	$treat->connected = (isset($this->Register->USER) && is_array($this->Register->USER)) ? true : false ;

	$treat->isMe = ($treat->connected === true) ? (($this->Register->USER['UKEY'] == $UKey) ? true : false ) : false;










	/* Entité existe */

	if(is_string($Entity) && is_string($UKey)){


		new \GGN\Using('Numeric');


		$comment = $database->SelectFromTable('NATIVE_INTERACTION_ENTITIES',"WHERE _TO='$UKey' AND _NAME ='Photo.Comment' AND _ENTITY ='$Entity' ORDER BY DATETIMES DESC LIMIT 0,20");


		$like = $database->SelectFromTable('NATIVE_INTERACTION_ENTITIES',"WHERE _TO='$UKey' AND _NAME ='Photo.Like' AND _ENTITY ='$Entity'");







		$User = GUSERS::get("WHERE UKEY = '" . $UKey . "' ", true);




		if(is_object($User)){

			if($User->row > 0){

				$treat->username = $User->data[0]['USERNAME'];

			}


		}




		if($treat->connected === true){

			$getView = $database->SelectFromTable('NATIVE_INTERACTION_ENTITIES',"WHERE _FROM='" . $this->Register->USER['UKEY'] . "' AND _NAME ='Photo.View' AND _ENTITY ='$Entity'");

			if(is_object($getView)){

				$getView->results(true);

				if($getView->row < 1){

					$view = $database->InsertIntoTable('NATIVE_INTERACTION_ENTITIES', " VALUES(NULL, '" . $this->Register->USER['UKEY'] . "', '$UKey', 'Photo.View', '$Entity', '" . __IP__ . "', '" . time() . "', '1'); ");

					$treat->view = is_object($view) ? true : false;

				}

			}

		}






		$file = $Entity;

		

		$xent = explode('://', $file);

		$type = strtolower($xent[0]);


		if($type=='rsrc' && isset($xent[1])){

			$xen = explode('/', $xent[1]);


			if(count($xen) >= 3){

				$file = $_RSRC->_Dir($UKey, $xen[1]);

				$file .= implode('/',\Gougnon::arrayValues($xen,2));

				$file = str_replace('?ext=', '.', $file);

			}

		}





		/* Nombre de like */

		if(is_object($like)){

			$like->results(true);
  			
  			$treat->like = $like->row;

			$treat->llike = (new \GGN\Numeric\Unit($treat->like, 1))->Label;

		}



		/* Meta */

		if(is_file($file)){

			$meta = new RegisterMeta($file);

			$treat->legend = (isset($meta->Loaded['legend'])) ? $meta->Loaded['legend'] : '';

			$treat->created = (isset($meta->Loaded['time.created'])) ? $meta->Loaded['time.created'] : '';

			$treat->updated = (isset($meta->Loaded['time.updated'])) ? $meta->Loaded['time.updated'] : '';
			
		}





		/* Commentaires */

		if(is_object($comment)){

			$comment->results(true);


			if($comment->row > 0){


				$treat->comments = [];

				$treat->row = $comment->row ;

				$treat->lrow = (new \GGN\Numeric\Unit($treat->row, 1))->Label;

				foreach ($comment->data as $key => $entry) {

					// $getUser = $database->SelectFromTable('NATIVE_USERS',"WHERE UKEY = '".$entry['_FROM']."'");

					$getUser =  GUSERS::get("WHERE UKEY = '".$entry['_FROM']."'", true);

					$dat = [];

					$dat['username'] = $entry['_FROM'];

					$dat['comment'] = $entry['_DATA'];

					$dat['thumb'] = false;


					if(is_object($getUser)){

						if($getUser->row > 0){

							$dat['username'] =$getUser->data[0]['USERNAME'];


						}

					}

					array_push($treat->comments, $dat);
					 
				}

			}

		} 


 
		

	}


	// $treat->_POST = $_POST;



// }


/* Besoin de connexion */
// else{

// 	$this->Response('require.login');

// }


