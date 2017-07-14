<?php
/*
	Copyright GOBOU Y. Yannick
	
*/

global $database;



	
	/* Ressources */
	\GSystem::requires('util.rsrc');




	/* 
		Class 'STYLIVOIR' // DEBUT ------------------
	*/

	\Gougnon::loadPlugins('PHP/stylIvoir.2.0');


		$STYLIVOIR = new \StylIvoir('Blogs.Now');


	/* 
		Class 'STYLIVOIR' // FIN ------------------
	*/






$Queries = [];

$mLx = Register::_POST('mLx', 0);
	
	$mLx = is_numeric($mLx) ? $mLx*1 : 0;

$origin = Register::_POST('origin');
	
	$hasOrign = $origin != 'all' && is_string($origin) ;

$countries = Register::_POST('country');

$cities = Register::_POST('city');

$keywords = Register::_POST('query');

$Results = new \_GGNCustomObject();

$Row = 0;

$LIMIT = 10;

$LIM = ($mLx * 1) + $LIMIT;


$Criteres = [];

$RKey = [];




/*

	Requete : Mots clés // DEBUT ////////////////////////////////

*/



	/*
		Pour Castings
	*/


	if(strtolower($origin)=='castings'){

		$castings = $STYLIVOIR->BlogCriterions['castings'];

		$cst = [];

		foreach ($castings as $kc => $cast) {

			$crpst = Register::_POST($kc, false);

			if(is_array($cast) && !is_array($crpst)){

				continue;
			}

			else{

				if(!is_array($crpst)){

					if(!\Gougnon::isEmpty($crpst)){

						if(!isset($_POST[$kc . '-nbr-from'])){

							// array_push($cst, $kc . ':' . $crpst);

							array_push($Criteres, "( CRITERION LIKE '%" . utf8_encode(addslashes($kc)) . "%' AND _DATA LIKE '%" . utf8_encode(addslashes($crpst)) . "%' )");
							
						}

						else{

							$from = $_POST[$kc . '-nbr-from'];

							if(!\Gougnon::isEmpty($from)){

								array_push($Criteres, "(CRITERION='" . addslashes($kc) . "' AND (_DATA>=" . addslashes($from) . " AND _DATA<=" . $crpst . ") ) ");

							}

						}


					}

				}

				if(is_array($crpst)){

					foreach ($crpst as $key => $crv) {

						array_push($Criteres, "( CRITERION LIKE '%" . utf8_encode(addslashes($kc)) . "%' AND _DATA LIKE '%" . utf8_encode(addslashes($cast[$crv])) . "%' )");
						
					}

				}

			}
			
		}


	}






/*
	Parcourir la table des critères des blogs
*/

if(!empty($Criteres)){

	foreach ($Criteres as $key => $value) {

		$BiDq = $database->SelectFromTable('NATIVE_USERS_BLOGS_CRITERIONS', "WHERE " . implode(" OR ", $Criteres) . " ");

		if(is_object($BiDq)){

			$BiDq->results();

			if($BiDq->row > 0){

				foreach ($BiDq->data['BID'] as $key => $bid) {

					array_push($RKey, $bid);

				}

			}


		}

	}

}





/*

	Requete : Country // DEBUT ////////////////////////////////

*/

if(is_array($countries)){

	$QCountry = [];

	foreach ($countries as $country) {

		if(strtolower($country)=="all"){continue;}

		array_push($QCountry, " ( COUNTRY LIKE '%" . utf8_encode(addslashes($country)) . "%' " . ( ($hasOrign) ? " AND BLOGTYPE LIKE '%" . $origin . "%' " : "") . " ) ");
		
	}


	$Queries['countries'] = implode(' OR ', $QCountry);

}

/*

	Requete : Country // FIN ////////////////////////////////

*/







/*

	Requete : Ville // DEBUT ////////////////////////////////

*/

if(is_array($cities)){

	$QCity = [];

	foreach ($cities as $city) {

		// if(strtolower($city)=="all"){continue;}

		$OriginWhere = (!$hasOrign) ? "" : " AND BLOGTYPE LIKE '%" . $origin . "%' ";

		array_push($QCity, " ( CITY LIKE '%" . utf8_encode(addslashes($city)) . "%' " . $OriginWhere . " ) ");
		
	}

	$Queries['cities'] = implode(' OR ', $QCity);

}

/*

	Requete : Ville // FIN ////////////////////////////////

*/







/*

	Requete : Localisation // DEBUT ////////////////////////////////

*/

	$Q = " WHERE (" . implode(') AND (', $Queries) . ") ";

	$RLo = [];

	$Search = $database->SelectFromTable('NATIVE_USERS_BLOGS', $Q);


	if(is_object($Search)){

		$Search->results();

		if($Search->row > 0){

			foreach ($Search->data['BID'] as $key => $bid) {

				array_push($RLo, $bid);

			}


		}

	}


	/* 
		Ajouter aux ID des blog retrouvés // DEBUT //////////////////
	*/


		if(isset($RKey)){

			/* 
				mLxiner des les doubons 
			*/
			$RKey = \Gougnon::arrayPurges($RKey);


			/* Fusion */
			foreach($RKey as $key => $BID){
				
				$Results->{'x' . $Row} = $BID;

				$Row++;

			}

		}


		if(isset($RLo)){

			/* 
				mLxiner des les doubons 
			*/
			$RLo = \Gougnon::arrayPurges($RLo);

			/* Fusion */
			foreach($RLo as $key => $BID){
				
				$Results->{'x' . $Row} = $BID;

				$Row++;

			}

		}



	/* 
		Ajouter aux ID des blog retrouvés // FIN //////////////////
	*/


/*

	Requete : Localisation // FIN ////////////////////////////////

*/









/* 
	Requete Ultime // DEBUT //////////////////
*/
	$adv = [];

	$ORiG = "";

	$Quer = [];



	foreach ($Results as $BiD) {

		array_push($adv, " ( BID='" . $BiD . "' ) " );

	}



	if(isset($adv) || isset($Queries) || isset($origin) ){



		if( $hasOrign ){

			array_push($Quer, " (BLOGTYPE LIKE '%" . $origin . "%') ");

		}

		if( !empty($Queries['adv']) ){

			array_push($Quer, " (" . implode(" OR ", $adv) . ") ");

		}

		if( !empty($Queries['countries']) && empty($adv) ){

			array_push($Quer, " (" . $Queries['countries'] . ") ");

		}

		if( !empty($Queries['cities']) && empty($adv)){

			array_push($Quer, " " . $Queries['cities'] . " ");

		}

		if( !empty($adv) ){

			array_push($Quer, " " . implode(" OR ", $adv) . " ");

		}

	}



	$Qf =  (count($Quer) == 0 ? "" : "WHERE") . "" . implode(" AND ", $Quer) . " ORDER BY DATETIMES DESC LIMIT " . $mLx . "," . $LIMIT . "";

	// print_r($Qf);
	// print_r($Queries);
	// exit;

	$advance = $database->SelectFromTable('NATIVE_USERS_BLOGS', $Qf);

	$GetFull = $database->SelectFromTable('NATIVE_USERS_BLOGS', "WHERE AVAILABLE='1' " . (($hasOrign) ? " AND BLOGTYPE LIKE '%" . $origin . "%' " : "" ) . "");



	/*
		Si requete valide
	*/

	if(is_object($advance)){

		$advance->results($database::RESULTS_METHOD_LINE_OBJECT);

		$GetFull->results($database::RESULTS_METHOD_LINE_OBJECT);

		if($advance->row <= 0){

			$this->Response("not.found");

		}

		if($advance->row > 0){

			$this->Response("found");

			$res = $this->Node("results");

			$res->limit = $LIMIT;

			$res->frow = $GetFull->row;


			$rw = 0;

			$res->data = [];

			foreach ($advance->data as $r => $blog) {

				$user = $STYLIVOIR->GetUser(" WHERE UKEY='" . $blog->UKEY . "' AND ACCEPT");

					$rw++;
					
	 				$res->data[$r] = new \_GGNCustomObject([

	 					'title' => $blog->TITLE

	 					,'about' => $blog->ABOUT

	 					,'logo' => (!\Gougnon::isEmpty($blog->LOGO)) ? HTTP_HOST . 'rsrc/' . $user->data[0]->USERNAME . '/image/' . \GGN_UTIL_RSRC::_URLMd($blog->LOGO) : false

	 					// ,'cover' => (!\Gougnon::isEmpty($blog->COVER)) ? HTTP_HOST . 'rsrc/' . $user->data[0]->USERNAME . '/image/' . \GGN_UTIL_RSRC::_URLMd($blog->COVER) : false

	 					,'slug' => $blog->SLUG

	 					,'username' => $user->data[0]->USERNAME

	 					,'country' => $blog->COUNTRY

	 					,'bType' => substr( rtrim( ltrim( $STYLIVOIR->BlogTypeN($blog->BLOGTYPE) ) ), 0, -1 )

	 					,'city' => $blog->CITY

	 				]);



			}

			$res->row = $rw;

		}


	}


	/*
		Si requete valide : Sinon
	*/
	else{


		$this->Response("request.failed");


	}


/* 
	Requete Ultime // FIN //////////////////
*/





	
