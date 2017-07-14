<?php

/*
	Copyright GOBOU Y. Yannick
	
*/
	
namespace GGN\DPO;




	/* Pour les valuers Numeriques */
	new \GGN\Using('Numeric');




	/* Chargement du Name Space User/Blog */
	new \GGN\Using('User\Blog');






	/* Ressources */
	\GSystem::requires('util.rsrc');








	if(!isset($this->Register->Blog) || !is_object($this->Register->Blog)){

		\_GGN::wCnsl('<h1 class="xh1">Blog introuvable</h1>');

	}







	/*
		Redirection vers la page par defaut // DEBUT --------------------
	*/

		if(\Gougnon::isEmpty($this->CurrentPage)){

			header('location:' . HTTP_HOST . $this->Blog->SLUG . '/post');

			exit;

		}

	/*
		Redirection vers la page par defaut // FIN --------------------
	*/
		

		


	/* 
		Class 'STYLIVOIR' // DEBUT ------------------
	*/

	\Gougnon::loadPlugins('PHP/stylIvoir.2.0');


		$STYLIVOIR = new \StylIvoir('User.Blog');


		$_Criterions = $STYLIVOIR->BlogCriterions;


		$this->Blog->TYPE = $STYLIVOIR->BlogTypeN($this->Blog->BLOGTYPE);

		$this->Blog->_TYPE = substr($this->Blog->TYPE, 0, -1);


	/* 
		Class 'STYLIVOIR' // FIN ------------------
	*/


	

	/* Ressource Utilisateur */
	$this->Blog->RsrcURL = HTTP_HOST . 'rsrc/' . $this->Register->BlogUser->USERNAME . '/image/';


	


	/* Logo du blog */
	$this->Blog->HasLOGO = (\Gougnon::isEmpty($this->Blog->LOGO)) ? false : true;

	$this->Blog->_LOGO = ($this->Blog->HasLOGO) ? $this->Blog->RsrcURL . \GGN_UTIL_RSRC::_URLMd($this->Blog->LOGO) : '';


	


	/* Logo du blog */
	$this->Blog->HasCOVER = (\Gougnon::isEmpty($this->Blog->COVER)) ? false : true;

	$this->Blog->_COVER = ($this->Blog->HasCOVER) ? $this->Blog->RsrcURL . \GGN_UTIL_RSRC::_URLMd($this->Blog->COVER) : '';





	/* Nombre de vues */

	// var_dump($this->Blog->UKEY);exit;

	\GGN\User\Blog\View::Add($this->Blog->BID, $this->Blog->UKEY);

	$this->Blog->View = \GGN\User\Blog\View::GetRow($this->Blog->BID, $this->Blog->UKEY);

	$this->Blog->OView = (new \GGN\Numeric\Unit($this->Blog->View, 1));







	/* Nombre de "like" */

	// \GGN\User\Blog\Like::Add($this->Blog->BID);

	$this->Blog->Like = \GGN\User\Blog\Like::GetRow($this->Blog->BID, $this->Blog->UKEY);

	$this->Blog->OLike = (new \GGN\Numeric\Unit($this->Blog->Like, 1));






	/*
		Chemin de la page en cours // DEBUT --------------------
	*/

		$PagePath = dirname(__FILE__) . '/blog.master.pages/' . $this->CurrentPage . '.php';

		$ErrorPagePath = dirname(__FILE__) . '/blog.master.pages/error.php';

		$PagePath = is_file($PagePath) ? $PagePath : $ErrorPagePath;
	
	/*
		Chemin de la page en cours // FIN --------------------
	*/
	









	/*
		Composant : "normal.header" // ENTETE
	*/

	$_HostPage = (isset($this->host) && is_string($this->host)) ? $this->host: ''; 

	$this->component('normal.header');
	
	
	/* Meta pour facebook // DEBUT /////////////// */
	
	if(!UsesAjax()){
		

		$this->head
		

			/* Meta de référencement */

			->meta('name', 'Description', !\Gougnon::isEmpty($this->Blog->ABOUT)? $this->Blog->ABOUT : ucfirst($this->Blog->_TYPE))
			

			/* Meta Facebook */

			->meta('property', 'og:title', $this->Blog->TITLE)

			->meta('property', 'og:image', $this->Blog->_LOGO)
			
			->meta('property', 'og:site_name', \_GGN::varn('SITENAME') )
			
			->meta('property', 'og:description', !\Gougnon::isEmpty($this->Blog->ABOUT)? $this->Blog->ABOUT : ucfirst($this->Blog->_TYPE) )
				



			/* Meta Google Plus */
			
			->meta('itemprop', 'name', $this->Blog->TITLE)
			
			->meta('itemprop', 'description', !\Gougnon::isEmpty($this->Blog->ABOUT)? $this->Blog->ABOUT : ucfirst($this->Blog->_TYPE) )
			
			->meta('itemprop', 'image', $this->Blog->_LOGO)
			


		;


		
	}
	
	/* Meta pour facebook // FIN /////////////// */
	




	/* 

		Packages CSS 

	*/

	// $this->head->cssPackages(

	// 	'ggn.photo'

	// 	,'ggn.photo.viewer'

	// );


	// $this->body->js('GStyle.package("ggn.photo.viewer");');




	/* 

		Packages JS 

	*/

	// $this->head->jsPackages(
	// 	[
		
	// 		'ggn.photo'
		
	// 		,'ggn.photo.viewer'

	// 	]

	// );

	$this->body->js('window.CurrentBlogBID = "' . $this->Blog->BID . '";');

	// $this->body->js('GScript.package("ggn.photo");');

	// $this->body->js('GScript.package("ggn.photo.viewer");');

	// $this->body->js('GScript.load("' . $this->_url . 'user.blog.master.js");');






	/*
		CSS
	*/

		// $this->body->js('(function(sc){');

			// $this->body->js('G.foreach(sc.split(" "), function(css){');

				// $this->body->js('var c="' . $this->_url . '";');

				// $this->body->js('c += css;');

				// $this->body->js('GStyle.load(c);');

			// $this->body->js('},false,false,".");');

		// $this->body->js('})("blog.normal.css?style=' . $this->style . '");');

	// $this->body->css($this->_url . 'blog.normal.css?style=' . $this->style ) ;




	/*
		Script
	*/

		// $this->body->js('(function(sc){');

		// 	$this->body->js('G.foreach(sc.split(" "), function(js){');

		// 		$this->body->js('var j="' . $this->_url . '";');

		// 		$this->body->js('j += js;');

		// 		$this->body->js('GScript.load(j);');

		// 	$this->body->js('},false,false,".");');

		// $this->body->js('})("normal.actions.js");');





	/*

		Cacher "Under Header"

	*/
		$this->body->js('(function(uh){');

			$this->body->js('if(isObj(uh)){');

				$this->body->js('uh.hide(false);');

			$this->body->js('}');

		$this->body->js('})(G("#under-header"));');







	/*
		Scroll automatique vers le haut
	*/
	if(UsesAjax()){

		$this->body->js('(function(gab){');

			$this->body->js('if(isObj(gab["Scroll"])){');

				$this->body->js('var el=G("#blog-page-master-top"),coor = GScreen(el).coordinate();');

				$this->body->js('G.UI.Scroll.Slide(coor.y-48, false);');

			$this->body->js('}');

		$this->body->js('})(GGabarit);');

	}




	/* Conteneur de la page : debut */

		/*
			Fusion avec le noeud principal
		*/

		if(!UsesAjax()){

			$container = $this->body->sheet->node->Content->node->Container->node->Container;
			
		}


		if(UsesAjax()){

			$container = $this->body->AjaxContainer;
				
		}




		
		


		/* 
			Espacement en Haut // Debut -------------------------- 
		*/

			$container->node->Spacer = new Theme\Tag(['class'=>'page-space-top-mini']);


		/* 
			Espacement en Haut // Fin -------------------------- 
		*/





			




		/* 
			Page // DEBUT -------------------------- 
		*/

			$container->node->nCo = (new Theme\Tag([

				'tag'=>'center'	

				,'class'=>'gui _w10'

			]));


			/* 
				Cover // DEBUT -------------------------- 
			*/
			
				$container->node->nCo->node->Cover = (new Theme\Tag([

					'class'=>'gui blog-cover vh5-min vh8 x768-h-max bg-primary gui flex center pos-relative background-abs-center'

					, 'id'=>'blog-cover-master'

					, 'style'=>[

						'background-image'=>'url(' . $this->Blog->_COVER . ')'

					]

				]))

					->text( (!$this->Blog->HasCOVER) ? '<div class="text-x7-vw text-thin color-primary-d">bienvenue :-)</div>' : '')
				;

				/* Modifier le photo de couverture */

				if($this->isMyBlog){


					$container->node->nCo->node->Cover->node->Mod = (new Theme\Tag([

						'class'=>'gui pos-absolute modifier bg-primary-d color-light-l padding-tb-x16 padding-lr-x32 text-x16 gui-transition cursor-pointer'

						, 'id'=>'blog-cover-master-change'

						, 'handler-click'=>'Ressources.Users.Images'

						, 'rsrc-users'=>$this->Register->USER['UKEY']

						, 'rsrc-awake-from'=>'this'

						, 'rsrc-multiple'=>'false'

						, 'rsrc-choose'=>'1'

						, 'rsrc-mid'=>'' . $this->Blog->BID . ''

						, 'rsrc-callback-data'=>'BlogUserProfilAssocCover'

					]))

						->text('Modifier la photo de couverture')

					;


				}

			/* 
				Cover // FIN -------------------------- 
			*/



			/* 
				Blog-Page // DEBUT -------------------------- 
			*/
			
				$container->node->nCo->node->lPage = (new Theme\Tag([
			
					'class'=>'blog-page gui box-shadow-dark col-12 mi-col-15 li-col-15 s-col-15 m-col-15  pos-relative'

					, 'id'=>'blog-page-master'
			
				]));


				/* 
					Infos // DEBUT -------------------------- 
				*/


					$InfosBlog = (new Theme\Tag([
				
						'id'=>'blog-page-master-top'

						,'class'=>'blog-bloc blog-info-self margin-tb-x0 gui flex row wrap start'
				
					]));


						$InfosBlog->node->Photo = (new Theme\Tag([
					
							'class'=>'x176 mi-col-16 li-col-16 pos-relative blog-logo-master'

						]));


							$InfosBlog->node->Photo->node->Thb = (new Theme\Tag([
						
								'class'=>'thumb-photo blog-logo x176  gui flex column end pos-relative background-abs-center'

								,'style'=>[

									'background-image'=>'url(' . $this->Blog->_LOGO . '&mode=-gd&width=480&height=480&resize=&rogner=0&resizeBy=-height)'

								]
						
							]))

								->text('<div class="textph _w10 _h10 xh5 gui flex center no-opacity">' . ((!$this->Blog->HasLOGO) ? ucwords(\Gougnon::getFirstLetters($this->Register->Blog->TITLE,2)) : '') . '</div>')
							
							;


						/* Modifier Le logo du Blog */
				
						if($this->isMyBlog){

							$InfosBlog->node->Photo

								->text('<div class="indexer-top-color margin-l-x16 pos-absolute"></div>')

								->text('<div class="info-bubble pos-absolute bg-primary x176-w gui flex row color-light cursor-pointer"><span class="gui icon camera margin-lr-x16 margin-tb-x16 text-x18"  handler-click="Ressources.Users.Images" rsrc-users="' . $this->Register->USER['UKEY'] . '" rsrc-awake-from="this" rsrc-multiple="false" rsrc-choose="1" rsrc-mid="' . $this->Blog->BID . '" rsrc-callback-data="BlogUserProfilAssocLogo"></span><div class="text-x12 text-left padding-tb-x16 " handler-click="Ressources.Users.Images" rsrc-users="' . $this->Register->USER['UKEY'] . '" rsrc-awake-from="this" rsrc-multiple="false" rsrc-choose="1" rsrc-mid="' . $this->Blog->BID . '" rsrc-callback-data="BlogUserProfilAssocLogo">Modifier la photo</div></div>')

							;

						}



						$InfosBlog->node->Details = (new Theme\Tag([
					
							'class'=>'details col-0 mi-col-16 li-col-16 text-left padding-lr-x16 padding-b-x16 padding-t-x0 '
					
						]))

							->text('<div class="xh6 gui flex row wrap mi-flex-center li-flex-center text-spacing-ml">'.ucwords($this->Register->Blog->TITLE).'</div>')

							->text('<div class="text-x14 gui flex row wrap mi-flex-center li-flex-center">de&nbsp;<a >'.ucwords($this->Register->BlogUser->USERNAME).'</a></div>')

							// ->text('<div class="text-x14 gui flex row wrap mi-flex-center li-flex-center">de&nbsp;<a href="flyleaf/' . $this->Register->BlogUser->USERNAME . '">'.ucwords($this->Register->BlogUser->USERNAME).'</a></div>')

						;


							$InfosBlogTools = (new Theme\Tag([
						
								'class'=>'tools col-16 gui flex row wrap start padding-lr-0'
						
							]));


								$InfosBlogTools->node->Numero = (new Theme\Tag([
							
									'class'=>'numeros gui flex row wrap row col-8 mi-col-16 margin-t-x16'
							
								]))

									->text((\Gougnon::isEmpty($this->Blog->CITY)) ? '' : '<div class="col-16 gui flex row wrap mi-flex-center "><span class="gui iconx static-color">location_city</span>&nbsp;&nbsp;'.utf8_encode($this->Blog->CITY).'</div>')

									->text((\Gougnon::isEmpty($this->Register->BlogUser->PHONE) || $this->Blog->_TYPE == 'casting') ? '' : '<div class="col-16 gui flex row wrap mi-flex-center "><span class="gui iconx static-color">local_phone</span>&nbsp;&nbsp;'.($this->Register->BlogUser->PHONE).'</div>')

									->text((\Gougnon::isEmpty($this->Register->BlogUser->EMAIL)) ? '' : '<div class="col-16 gui flex row wrap mi-flex-center "><span class="gui iconx static-color">email</span>&nbsp;&nbsp;'.ucfirst($this->Register->BlogUser->EMAIL).'</div>')

								;



								$InfosBlogTools->node->ToolApp = (new Theme\Tag([
							
									'class'=>'tde gui flex row-rev wrap mi-flex-center mi-col-16 col-8 '
							
								]))

								;

								if(!$this->isMyBlog){

									// $InfosBlogTools->node->ToolApp

									// 	->text('<div class="gui box-circle x64 margin-x4 gui flex center button active cursor-pointer padding-x0" handler-click="Messenger.Composer" composer-type=":float" composer-to="' . $this->Blog->BID . '" composer-recipient="' . addslashes($this->Blog->TITLE) . '"><span class="gui iconx x32" handler-click="Messenger.Composer" composer-type=":float" composer-to="' . $this->Blog->UKEY . '" composer-entity="' . $this->Blog->BID . '" composer-recipient="' . addslashes($this->Blog->TITLE) . '">send</span></div>')

									// ;

								}

								$InfosBlogTools->node->ToolApp

									->text('<div class="gui flex row" title="Soit ' . $this->Blog->Like . ' follower' . ($this->Blog->Like > 1 ? 's' : '') . '"><div class="gui margin-lr-x4 margin-t-x28 cursor-default text-x18 color-primary" data-bid="' . $this->Blog->BID . '" handler-click="Blog.Like" >' . $this->Blog->OLike->Label . '</div><div class="gui box-circle x32 margin-lr-x4 margin-t-x24 gui flex center button cursor-pointer padding-x0 "><span class="gui iconx x16" data-bid="' . $this->Blog->BID . '" handler-click="Blog.Like" >favorite_border</span></div></div>')

									->text('<div class="gui flex row" title="Soit ' . $this->Blog->View . ' vue' . ($this->Blog->View > 1 ? 's' : '') . '"><div class="gui margin-lr-x4 margin-t-x28 cursor-default text-x18 ">' . $this->Blog->OView->Label . '</div><div class="gui box-circle x32 margin-lr-x4 margin-t-x24 gui flex center cursor-default padding-x0 "><span class="gui icon eye x16"></span></div></div>')

								;


							$InfosBlog->node->Details->node->tools = $InfosBlogTools;






					$container->node->nCo->node->lPage->node->InfosBlog = $InfosBlog;

				/* 
					Infos // FIN -------------------------- 
				*/
				







				/* 
					Menu // DEBUT -------------------------- 
				*/

					$MenuBlog = (new Theme\Tag([
				
						'class'=>'blog-self-menu gui flex row center'
				
					]));


						$_MenuPage = new \GGN\Plugin\HTML\Model\Brick('Menu/Default'
							, [

								'uriBase'=> $this->Blog->SLUG . '/'

								,'host'=> $_HostPage

								,'attributes' => []

								,'class' => 'blog-menu'

								,'flex' => 'row'

								,'items'=>[

									'About'=>[
										'label'=>'<span class="gui icon info-alt" ggn-handler-click="Gabarit.Ajax" ajax-href="'.$this->Blog->SLUG.'/about" ></span><span class="margin-l-x16 enable mi-disable li-disable" ggn-handler-click="Gabarit.Ajax" ajax-href="'.$this->Blog->SLUG.'/about" >À propos</span>'
										, 'link'=>'about'
										, 'title'=>'Présentation'
										, 'target'=>'_self'
										, 'class'=>'gui flex row center mi-flex-center li-flex-center'
										, 'click'=>'return false;'

										, 'hattrib'=>[
											'ggn-handler-click'=>'Gabarit.Ajax'
											, 'ajax-href'=>''.$this->Blog->SLUG.'/about'
										]
										
										, 'attrib'=>[
											'ggn-handler-click'=>'Gabarit.Ajax'
											, 'ajax-href'=>''.$this->Blog->SLUG.'/about'
										]

									]

									,'Post'=>[
										'label'=>'<span class="gui icon layout-list-post" ggn-handler-click="Gabarit.Ajax" ajax-href="'.$this->Blog->SLUG.'/post" ></span><span class="margin-l-x16 enable mi-disable li-disable" ggn-handler-click="Gabarit.Ajax" ajax-href="'.$this->Blog->SLUG.'/post" >Actualités</span>'
										, 'link'=>'post'
										, 'title'=>'Actualités'
										, 'target'=>'_self'
										, 'class'=>'gui flex row center mi-flex-center li-flex-center'
										, 'click'=>'return false;'

										, 'hattrib'=>[
											'ggn-handler-click'=>'Gabarit.Ajax'
											, 'ajax-href'=>$this->Blog->SLUG . '/post'
										]
										
										, 'attrib'=>[
											'ggn-handler-click'=>'Gabarit.Ajax'
											, 'ajax-href'=>$this->Blog->SLUG . '/post'
										]

									]

									,'Gallery'=>[
										'label'=>'<span class="gui icon gallery" ggn-handler-click="Gabarit.Ajax" ajax-href="'.$this->Blog->SLUG.'/gallery" ></span><span class="margin-l-x16 enable mi-disable li-disable" ggn-handler-click="Gabarit.Ajax" ajax-href="'.$this->Blog->SLUG.'/gallery" >Photos</span>'
										, 'link'=>'gallery'
										, 'title'=>'Gallerie Photos'
										, 'target'=>'_self'
										, 'class'=>'gui flex row center mi-flex-center li-flex-center'
										, 'click'=>'return false;'

										, 'hattrib'=>[
											'ggn-handler-click'=>'Gabarit.Ajax'
											, 'ajax-href'=>''.$this->Blog->SLUG.'/gallery'
										]
										
										, 'attrib'=>[
											'ggn-handler-click'=>'Gabarit.Ajax'
											, 'ajax-href'=>''.$this->Blog->SLUG.'/gallery'
										]

									]

									// ,'Videos'=>[
									// 	'label'=>'<span class="gui icon video-clapper" ggn-handler-click="Gabarit.Ajax" ajax-href="'.$this->Blog->SLUG.'/videos" ></span><span class="margin-l-x16 enable mi-disable li-disable" ggn-handler-click="Gabarit.Ajax" ajax-href="'.$this->Blog->SLUG.'/videos" >Videos</span>'
									// 	, 'link'=>'videos'
									// 	, 'title'=>'Gallerie Vidéos'
									// 	, 'target'=>'_self'
									// 	, 'class'=>'gui flex row center mi-flex-center li-flex-center'
									// 	, 'click'=>'return false;'

									// 	, 'hattrib'=>[
									// 		'ggn-handler-click'=>'Gabarit.Ajax'
									// 		, 'ajax-href'=>''.$this->Blog->SLUG.'/videos'
									// 	]
										
									// 	, 'attrib'=>[
									// 		'ggn-handler-click'=>'Gabarit.Ajax'
									// 		, 'ajax-href'=>''.$this->Blog->SLUG.'/videos'
									// 	]

									// ]

									// ,'More'=>[
									// 	'label'=>'<span class="gui icon more-alt" ggn-handler-click="Gabarit.Ajax" ajax-href="'.$this->Blog->SLUG.'/modules" ></span><span class="margin-l-x16 enable mi-disable li-disable" ggn-handler-click="Gabarit.Ajax" ajax-href="'.$this->Blog->SLUG.'/modules" >Plus</span>'
									// 	, 'link'=>'modules'
									// 	, 'title'=>'Voir tout'
									// 	, 'target'=>'_self'
									// 	, 'class'=>'gui flex row center mi-flex-center li-flex-center'
									// 	, 'click'=>'return false;'

									// 	, 'hattrib'=>[
									// 		'ggn-handler-click'=>'Gabarit.Ajax'
									// 		, 'ajax-href'=>''.$this->Blog->SLUG.'/modules'
									// 	]
										
									// 	, 'attrib'=>[
									// 		'ggn-handler-click'=>'Gabarit.Ajax'
									// 		, 'ajax-href'=>''.$this->Blog->SLUG.'/modules'
									// 	]

									// ]

								]

							]
						);


						$MenuBlog->text('<div class="bg-primary">' . $_MenuPage->html . '</div>');
						

					$container->node->nCo->node->lPage->node->MenuBlog = $MenuBlog;

				/* 
					Menu // FIN -------------------------- 
				*/
				



				/* 
					Page en cours // DEBUT -------------------------- 
				*/

					include $PagePath;

				/* 
					Page en cours // FIN -------------------------- 
				*/
				







			/* 
				Blog-Page // FIN -------------------------- 
			*/



















		/* 
			Page // FIN -------------------------- 
		*/










		/* 
			Bloac // DEBUT -------------------------- 
		*/

			


		/* 
			Bloac // FIN -------------------------- 
		*/






			







	/*
		Composant : "normal.footer" // PIED DE PAGE
	*/
	$this->component('normal.footer');

