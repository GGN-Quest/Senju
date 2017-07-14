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

	$title = Register::_POST('blog-title');

	$slug = Register::_POST('slug');

	$about = Register::_POST('about');

	$keywords = Register::_POST('keywords');

	$bType = Register::_POST('bType');
	
	$country = Register::_POST('country');
	
	$city = Register::_POST('city');









	/* 

		Petite Securité du type // DEBUT ------

	*/

		$MyAccountType = $STYLIVOIR->getUserAccountType($this->Register->USER['UKEY']);

		$AccountType = false;



		if($MyAccountType->row <= 0){
			
			$this->Response('account.type.failed');

			return false;

		}

		if($MyAccountType->row === 1){

			$AccountType = $MyAccountType->data[0]->_DATA;

			$blgtp = $STYLIVOIR->isChildOfAccountType($AccountType, $bType);




			if($blgtp===false){

				$this->Response('account.type.failed');

				return false;

			}


		}

			// print_r($blgtp);exit;


		$_AccountType = $STYLIVOIR->getAccountType($AccountType);



		if(!isset($_AccountType['child'][$blgtp])){
			
			$this->Response('blog.type.failed');

			return false;

		}


		$_BlogType = $_AccountType['child'][$blgtp];


		if(!isset($STYLIVOIR->BlogCriterions[$_BlogType['key']])){
			
			$this->Response('criterions.failed');

			return false;

		}

		$Criterions = $STYLIVOIR->BlogCriterions[$_BlogType['key']];



	/* 

		Petite Securité du type // FIN ------

	*/










/*

	Verifications // DEBUT -------------

*/

	if(!preg_match(\_GGN::PATTERN_USERNAME, $slug)){

		$this->Response('failed');

		return false;

	}


	if(\Gougnon::isEmpty($slug)){

		$this->Response('slug.empty');

		return false;

	}


	if(\Gougnon::isEmpty($title)){

		$this->Response('title.empty');

		return false;

	}

	

	// if(\Gougnon::isEmpty($about)){

	// 	$this->Response('about.empty');

	// 	return false;

	// }


	if(strlen($title) < 3){

		$this->Response('title.char.not.enough');

		return false;

	}


	if(strlen($slug) < 8){

		$this->Response('slug.char.not.enough');

		return false;

	}


	// if(strlen($about) < 100){

	// 	$this->Response('about.char.not.enough');

	// 	return false;

	// }


	if(strlen($title) > 32){

		$this->Response('title.char.too.much');

		return false;

	}


	if(strlen($slug) > 32){

		$this->Response('slug.char.too.much');

		return false;

	}


	if(\Register::isARC($slug)){

		$this->Response('system.register.arc');

		return false;

	}

/*

	Verifications // FIN -------------

*/




	/*

		Mots Clés
		
	*/
	


	$_keywords = [];


	foreach($Criterions as $crk => $Criterion) {

		$post = \Register::_POST($crk, false);

		// print_r("\n\n");
		// 	print_r($post);
		// 		print_r("\n");
		// print_r("\n\n");



		if(is_string($Criterion) && is_string($post)){


			// print_r("\n");
			// print_r('up //');
			// print_r("\n");
			// print_r($post);
			// print_r("\n");
			// print_r($crk);
			// print_r("\n");

			if(is_numeric($crk)){

				$nxn = explode('//', $Criterion)[0];

				$_keywords[$nxn] = ($post=='on') ? $nxn : $post;

			}

			if(is_string($crk)){

				$_keywords[$crk] = ($post=='on') ? $crk : $post;


			}

		}

		if(is_array($Criterion) && !is_bool($post)){



			if(is_array($post)){


				if(is_array($post)){

					foreach ($post as $pk => $pv) {
						
						$_keywords[$crk] = isset($_keywords[$crk]) ? $_keywords[$crk] : [];

						array_push($_keywords[$crk], $Criterion[$pv] );

					}

				}

			}

			else{

				array_push($_keywords[$crk], $Criterion[$post] );
				
			}



		}

	}




	if(count($_keywords) < 1){

		$this->Response('keywords.not.enough');

		return false;

	}






	$create = $STYLIVOIR->CreateUserBlog($UKEY, $title, $about, $slug, $bType, $country, $city);




	if($create===true){

		$this->Response('create.success');

		/* 
			Enregistrement des critères // DEBUT ----------
		*/

			$Blg = $STYLIVOIR->UserBlogBySlug($slug);

			if($Blg->row > 0){

				$BID = $Blg->data[0]->BID;

				foreach ($_keywords as $n => $d) {

					if(is_array($d)){

						foreach ($d as $hv) {
							
							$STYLIVOIR->addUserCriterions($BID, $n, $hv);

						}
						
						continue;

					}
						
					else{
						
						if(is_string($n)){
							
							$STYLIVOIR->addUserCriterions($BID, $n, $n);
							
						}
						
						continue;
						
					}
					


				}

			}

		/* 
			Enregistrement des critères // FIN ----------
		*/
			
		return false;

	}


	if($create!==true){

		if($create===null){

			$this->Response('exist');

			return false;

		}


	}


	$this->Response('failed');





	
}

	
