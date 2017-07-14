 <?php
/*
	Copyright GOBOU Y. Yannick
	
*/


	global $database;


if(isset($this->Register->USER) && is_array($this->Register->USER) && isset($this->Register->USER['UKEY']) && is_string($this->Register->USER['UKEY']) ){





	/* Blogs */
	new \GGN\Using('User\Blog');






	/* Interractions */
	new \GGN\Using('User\Interactions');






	/* Ressources */
	\GSystem::requires('util.rsrc');








	/* Paramètres */
	$current = Register::_REQUEST('current', '0');

	$row = Register::_REQUEST('row', '10');

	$type = Register::_REQUEST('type', false);







	/* Variables */
	$USER = $this->Register->USER;

	$UKEY = $USER['UKEY'];

	$this->Response(true);

	$treat = $this->node('treat');

	$treat->results = new \_GGNCustomObject();

	$treat->results->row = 0;

	$treat->results->data = [];









	/* Activités : Follows */

	if($type == 'follow'){



		/* Interactions */
		$Interactions = \GGN\User\Interactions\Get::Sent($UKEY, " (_NAME='Blog.Like' || _NAME='Photo.Like') ", $row, $current);
		

		if($Interactions->row > 0){

			$InteractionAlready = [];


			foreach ($Interactions->data as $inkey => $Interaction) {


				if(in_array($Interaction->_MID, $InteractionAlready)){continue;}

				array_push($InteractionAlready, $Interaction->_MID);


				$Rec = new \_GGNCustomObject();


				$DT = \GGN\User\Blog\Post::DateFormatted($Interaction->DATETIMES);

				$Intr = \GGN\User\Interactions\Get::Type($Interaction->_NAME);

				$Intrx = explode('.', $Interaction->_NAME);



				/* Blog */
				$gblog = \GGN\User\Blog\Data::Get($Interaction->_MID);

				if($gblog->row <= 0){continue; }

				$blog = $gblog->data[0];

					/* Enregistrement du Blog */
					$Rec->blog = new \_GGNCustomObject();

						$Rec->blog->slug = $blog->SLUG;

						$Rec->blog->title = $blog->TITLE;

						$Rec->blog->bid = $blog->BID;

						$Rec->blog->ukey = $blog->UKEY;


				/* Utilisateur */
				$User = \GUSERS::get(" WHERE UKEY='" . $blog->UKEY . "' ", true);



				/* Posts du blog */
				$Post = \GGN\User\Blog\Post::Get($blog->BID, false, false, false, true);

				if(!is_object($Post)){continue;}

					/* Enregistrement du Blog */
					$Rec->post = new \_GGNCustomObject();

						$Rec->post->row = $Post->row;

						$Rec->post->data = [];


				if($Post->row > 0){

					foreach ($Post->data as $pkey => $post) {

						if($post->_TYPE == 'image' && $pkey < 3){

							$posted = new \_GGNCustomObject();


							$assoc = array_reverse(explode(',', $post->_ASSOC));

							$assocIMG = [];

							$imgSrc = HTTP_HOST . 'rsrc/' . $User->data[0]['USERNAME'] . '/image/' . \GGN_UTIL_RSRC::_URLMd($assoc[0]);


							foreach ($assoc as $asskey => $asso) {

								array_push($assocIMG, \GGN_UTIL_RSRC::_URLMd($asso));
								
							}

							$posted->thumb = $imgSrc;

							$posted->gallery = $assocIMG;

							$posted->urlbase = dirname($imgSrc);


							array_push($Rec->post->data, $posted);

						}

					}

				}


				array_push($treat->results->data, $Rec);

			}


			$treat->results->row = count($treat->results->data);

			$treat->results->marow = $Interactions->row;

		}


	}










	/* Activités : Interactions */

	else{


		/* Identifiant Utilisateur */
		$treat->results->ukey = $UKEY;



		/* Interactions */
		$Interactions = \GGN\User\Interactions\Get::Received($UKEY, $row, $current);

		

		if(is_object($Interactions)){


			/* Nombre de lign retourné */
			$treat->results->row = $Interactions->row;


			if($Interactions->row > 0){

				foreach ($Interactions->data as $inkey => $Interaction) {


					$Rec = new \_GGNCustomObject();

						$Rec->username = false;

						$Rec->interaction = new \_GGNCustomObject();

						$Rec->interaction->name = $Interaction->_NAME;


					

					$DT = \GGN\User\Blog\Post::DateFormatted($Interaction->DATETIMES);

						$Rec->DT = $DT;

					$Intr = \GGN\User\Interactions\Get::Type($Interaction->_NAME);

					$Intrx = explode('.', $Interaction->_NAME);

						$Rec->interaction->type = $Intrx[0];

					


					/* Blog */
					$gblog = \GGN\User\Blog\Data::Get($Interaction->_MID);

					if($gblog->row <= 0){continue;}

						$blog = $gblog->data[0];


					/* Enregistrement du Blog */
					$Rec->blog = new \_GGNCustomObject();

						$Rec->blog->slug = $blog->SLUG;

						$Rec->blog->title = $blog->TITLE;

						$Rec->blog->bid = $blog->BID;






					/* Utilisateur */
					$User = \GUSERS::get(" WHERE UKEY='" . $Interaction->_FROM . "' ", true);


					if(is_object($User) && is_array($Intr)){

						$Rec->username = $User->data[0]['USERNAME'];

						$Rec->expression = $Intr['expression'];

					}




					if($Intrx[0]=='Photo'){

						$Rec->blog->photo = HTTP_HOST . 'rsrc/' . $this->Register->USER['USERNAME'] . '/' . \GGN_UTIL_RSRC::_URLPh($Interaction->_ENTITY);

					}

					

					/* Insertion */
					array_push($treat->results->data, $Rec);


				}


			}


		}





	}




}


else{

	$this->Response('please.require.login');

}
