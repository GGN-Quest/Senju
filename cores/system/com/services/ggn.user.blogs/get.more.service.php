 <?php
/*
	Copyright GOBOU Y. Yannick
	
*/


	global $database;



	$this->Response(true);

	$treat = $this->node('treat');

	$treat->result = false;



	/* Entité */

	$bid = Register::_POST('bid', false);

	$current = Register::_POST('current', false);

	$limit = Register::_POST('limit', false);

	$part = Register::_POST('part', false);




	/* BID conforme */

	if(is_string($bid)){



		$getb = $database->SelectFromTable('NATIVE_USERS_BLOGS', " WHERE BID='$bid' ");




		if(is_object($getb)){




			$getb->results(true);




			/* Blog Exist */

			if($getb->row > 0){


				/* Recherche Utilisateur */

				$getu = \GUSERS::get(" WHERE UKEY='" . $getb->data[0]['UKEY'] . "' ");




				/* Possesseur du blog trouvé */

				if($getu->row > 0){



					/* Pour les valuers Numeriques */
					new \GGN\Using('Numeric');



					/* Ressources */
					\GSystem::requires('util.rsrc');



					/* Chargement du Name Space User/Blog */

					new \GGN\Using('User\Blog');
					


					
					/* 
						Noeud de resultat 
					*/		
					$treat->result = new \_GGNCustomObject();





					/* GALERIE // DEBUT ///////////////////////////////////// */

						if($part == 'gallery'){

							/* Chargement des post */

							$Posts = \GGN\User\Blog\Post::Get($bid, $limit, $current, " AND _TYPE='image' ");


							$treat->result->row = $Posts->row;

							$treat->result->UKEY = $getb->data[0]['UKEY'];

							$treat->result->RsrcURL = HTTP_HOST . 'rsrc/' . $getu->data['USERNAME'][0] . '/image/';


							$D = [];

							foreach ($Posts->data as $PKey => $Post) {

								$da = new \_GGNCustomObject();

								$da->PKey = (($PKey * 1) + ($current * 1));

								$da->ASSOC = false;


								$da->TITLE = $Post->_TITLE;

								$da->DATE = \GGN\User\Blog\Post::DateFormatted($Post->DATETIMES);


								if($Post->_TYPE == 'image'){

									$Assoc = explode(',', $Post->_ASSOC);

									$ReAssoc = array_reverse($Assoc);

									$AssocLen = count($Assoc);

									$AssocIMG = [];


									/* Liste des images */

									for ($bgpx=0; $bgpx < $AssocLen; $bgpx++) {

										$im = $ReAssoc[$bgpx];

										$_im = \GGN_UTIL_RSRC::_URLMd($im);

										array_push($AssocIMG, $_im);

									}

									$da->ASSOC = $AssocIMG;




									$cover = (new \GGN_UTIL_RSRC([

										'Register' => $this->Register

									]))->_Dir($treat->result->UKEY, $Post->_TYPE) . $ReAssoc[0];

									$coverMeta = new \RegisterMeta($cover);

									if(isset($coverMeta->Loaded) && is_array($coverMeta->Loaded) && isset($coverMeta->Loaded['info'])){

										$cnfo = $coverMeta->Loaded['info'];

										$da->Cover = [

											'Width' => $cnfo[0]

											,'Height' => $cnfo[1]

										];

									}

								}


								$D[count($D)] = $da;

							}


							$treat->result->data = $D;



						}

					/* GALERIE // DEBUT ///////////////////////////////////// */













					/* POST // DEBUT ///////////////////////////////////// */

						if($part == 'post'){



							/* Chargement des post */

							$Posts = \GGN\User\Blog\Post::Get($bid, $limit, $current);

							$treat->result->row = $Posts->row;


							$treat->result->UKEY = $getb->data[0]['UKEY'];

							$treat->result->RsrcURL = HTTP_HOST . 'rsrc/' . $getu->data['USERNAME'][0] . '/image/';


							$D = [];


							foreach ($Posts->data as $PKey => $Post) {

								$da = new \_GGNCustomObject();

								$da->PKey = (($PKey * 1) + ($current * 1));


								$idCont = 'post-text-content-' . $da->PKey;

								$Post_Content = utf8_encode($Post->_CONTENT);

								$Post_CNum = strlen($Post_Content);

								$Post_Cont = ($Post_CNum > 160) ? substr(htmlentities($Post_Content), 0, 160) . '... <span class="text-x14 color-primary-l text-italic padding-t-x32 cursor-pointer" handler-click="Gabarit.Toggle" gabarit-toggle="#' . $idCont . '" toggle-from="disable" toggle-to="enable" onclick="this.parentNode.hide();">Lire la suite</span>' : $Post_Content;

								$da->CONTENT_ID = $idCont;

								$da->CONTENT_PREVIEW = $Post_Cont;

								$da->CONTENT = nl2br(htmlentities($Post_Content));

								

								$da->TITLE = $Post->_TITLE;

								$da->DATE = \GGN\User\Blog\Post::DateFormatted($Post->DATETIMES);



								$da->TYPE = $Post->_TYPE;

								$da->ASSOC = false;



								if($Post->_TYPE == 'image'){

									$Assoc = explode(',', $Post->_ASSOC);

									$ReAssoc = array_reverse($Assoc);

									$AssocLen = count($Assoc);

									$AssocIMG = [];

									/* Liste des images */

									for ($bgpx=0; $bgpx < $AssocLen; $bgpx++) {

										$im = $ReAssoc[$bgpx];

										$_im = \GGN_UTIL_RSRC::_URLMd($im);

										array_push($AssocIMG, $_im);

									}

									$da->ASSOC = $AssocIMG;


								}



								$D[count($D)] = $da;

							}


							$treat->result->data = $D;

						}
					
					/* POST // FIN ///////////////////////////////////// */

				}


			}

			else{

				$treat->result = 'blog.not.found';

			}


		}

		else{
			
			$treat->result = 'blog.query.failed';

		}



	}



