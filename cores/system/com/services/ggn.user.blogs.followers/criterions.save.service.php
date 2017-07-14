<?php
/*
	Copyright GOBOU Y. Yannick
	
*/


if(is_array($this->Register->USER)){



	/* 
		Class 'STYLIVOIR' // DEBUT ------------------
	*/

	\Gougnon::loadPlugins('PHP/stylIvoir.2.0');


		$STYLIVOIR = new \StylIvoir('Create.Blogs.Now');


	/* 
		Class 'STYLIVOIR' // FIN ------------------
	*/







	$UKEY = $this->Register->USER['UKEY'];

	$treat = $this->node('treat');

	$criteres = Register::_POST('criterions', '');



	$_CRITERES = explode('&', $criteres);



	/*

		Mots Clés
		
	*/
	


	$_keywords = [];

	$_Counter = 0;




	/* 
		Pour les boutiques // DEBUT ///////////////////// 
	*/

		$Shop = $STYLIVOIR->BlogCriterions['boutiques'];

		$_keywords['boutiques'] = [];

		foreach ($_CRITERES as $key => $post) {

			$ex = explode('=', $post);

			$xen = explode('boutiques_', $ex[0]);

			$ent = (isset($xen[1])) ? $xen[1] : false;

			$val = (isset($ex[1])) ? $ex[1] : false;

			if($ent===false || $val===false){continue;}


			foreach ($Shop as $kshp => $_cnt) {

				if(!in_array($val, $_keywords['boutiques'])){

					array_push($_keywords['boutiques'], $val);

				}

			}


			
		}

	/* 
		Pour les boutiques // FIN ///////////////////// 
	*/
		









	/* 
		Pour les coutures // DEBUT ///////////////////// 
	*/

		$Cout = $STYLIVOIR->BlogCriterions['coutures'];

		$_keywords['coutures'] = [];

		foreach ($_CRITERES as $key => $post) {

			$ex = explode('=', $post);

			$xen = explode('coutures_', $ex[0]);

			$ent = (isset($xen[1])) ? $xen[1] : false;

			$val = (isset($ex[1])) ? $ex[1] : false;

			if($ent===false || $val===false){continue;}


			foreach ($Cout as $kshp => $_cnt) {

				if(!in_array($val, $_keywords['coutures'])){

					array_push($_keywords['coutures'], $val);

				}

			}


			
		}

	/* 
		Pour les coutures // FIN ///////////////////// 
	*/
		









	/* 
		Pour les esthetiques // DEBUT ///////////////////// 
	*/

		$Esth = $STYLIVOIR->BlogCriterions['esthetiques'];

		$_keywords['esthetiques'] = [];

		foreach ($_CRITERES as $key => $post) {

			$ex = explode('=', $post);

			$xen = explode('esthetiques_', $ex[0]);

			$ent = (isset($xen[1])) ? $xen[1] : false;

			$val = (isset($ex[1])) ? $ex[1] : false;

			if($ent===false || $val===false){continue;}


			foreach ($Esth as $kshp => $_cnt) {

				if(!in_array($val, $_keywords['esthetiques'])){

					array_push($_keywords['esthetiques'], $val);

				}

			}


			
		}

	/* 
		Pour les esthetiques // FIN ///////////////////// 
	*/
	










	/* 
		Pour les castings // DEBUT ///////////////////// 
	*/

		$Esth = $STYLIVOIR->BlogCriterions['castings'];

		$_keywords['castings'] = [];

		foreach ($_CRITERES as $key => $post) {

			$ex = explode('=', $post);

			$xen = explode('castings_', $ex[0]);

			$ent = (isset($xen[1])) ? $xen[1] : false;

			$val = (isset($ex[1])) ? $ex[1] : false;

			if($ent===false || $val===false){continue;}

			$ent = str_replace('[]', '', $ent);



			foreach ($Esth as $kshp => $_cnt) {

				$_keywords['castings'][$kshp] = (isset($_keywords['castings'][$kshp])) ? $_keywords['castings'][$kshp] : [];

				if($kshp == $ent){


					if(is_array($_cnt)){


						$_val = $_cnt[$val * 1];

						if(!in_array($_val, $_keywords['castings'][$kshp])){

							array_push($_keywords['castings'][$kshp] , $_val);

						}

					}


					if(is_string($_cnt)){

						array_push($_keywords['castings'][$kshp] , $val);

					}

				}

				else{

					$from = $kshp . '-nbr-from';

					if($from == $ent){

						$_keywords['castings'][$from] = (isset($_keywords['castings'][$from])) ? $_keywords['castings'][$from] : [];

						array_push($_keywords['castings'][$from] , $val);

					}

				}


			}


			
		}

	/* 
		Pour les castings // FIN ///////////////////// 
	*/
		















	/* Librairie */
	new \GGN\Using('User\Blog');



	/* Formatage des mots clés */
	$__KEYWORDS = json_encode($_keywords, GStorages::JSON_OPT());

	$treat->_keywords = $__KEYWORDS;


	/* Mise à jour */
	$Update = \GGN\User\Blog\FollowersCriterions::Update($__KEYWORDS);


	/* Reponse de la mise à jour  */
	$treat->update = is_object($Update) ? true : false;



	/* Reponse générale */
	$this->Response(true);



	
}



else{


	$this->Response('require.login');

}
	
