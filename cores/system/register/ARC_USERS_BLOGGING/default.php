<?php


/*
	Copyright GOBOU Y. Yannick
	
*/
	
namespace GGN\DPO;
	


	/* Activation */
	if(\_GGN::varn('BLOGGINGPAGE_ACTIVE')!=='1'){

		$this->eventOn('ERROR.BLOGGING.NOT.ACTIVE');
		
	}


	else{

		
		$this->eventOn('SUCCESS.REQUEST.OK', self::MODE_USERS_BLOGGING, 'content-type:text/html');

		$GLOGIN_NATIVE_VARS = 'BLOGGINGPAGE_THEME BLOGGINGPAGE_STYLE BLOGGINGPAGE_TITLE';

		\_GGN::keyExists(explode(' ',$GLOGIN_NATIVE_VARS));



		/* DPO */

		new Using('DPO\Page');

		new Using('DPO\Procedure');

		new Using('DPO\Theme');

		// new Using('GeoLocation/Country/CI');





		/* 
			Noyau CSS // DEBUT ------------------
		*/

			$CSSCore = \_GGN::CSSCore('ggn.core');


		/* 
			Noyau CSS // FIN ------------------
		*/







		/*
			Blog // DEBUT ------
		*/

			$PageHost = (isset($this->concatenate[1])) ? $this->concatenate[1] : '';

			$isMyBlog = is_array($this->USER) && $this->USER['UKEY'] == $this->Blog->UKEY;

			$CurrentPage = implode('', \Gougnon::arrayValues($this->concatenate,1));

			
		/*
			Blog // FIN ------
		*/
		







		/* 
			Class 'STYLIVOIR' // DEBUT ------------------
		*/

		\Gougnon::loadPlugins('PHP/stylIvoir.2.0');


			$STYLIVOIR = new \StylIvoir('Blog.Now');


		/* 
			Class 'STYLIVOIR' // FIN ------------------
		*/












		/* 
			Initialisation du Theme 
		*/

		$tpl = new Theme\Preset(\_GGN::varn('BLOGGINGPAGE_THEME'));




		$tpl->Register = $this;

		$tpl->CSSCore = $CSSCore;

		$tpl->Blog = $this->Blog;

		$tpl->isMyBlog = $isMyBlog;

		$tpl->CurrentPage = $CurrentPage;




		$tpl->title = $this->Blog->TITLE . ' - ' . \_GGN::varn('SITENAME');

		// $tpl->title = \_GGN::varn('BLOGGINGPAGE_TITLE');



		/* 
			Style de la page
		*/

		$tpl->style = \_GGN::varn('BLOGGINGPAGE_STYLE');

			$tpl->CSSCore->Style($tpl->style);


		/* 
			Noyau CSS
		*/



		/* 
			Fichier Hote 
		*/

		$tpl->host = $PageHost;



		/*
			Composant : "BLOG.MASTER"
		*/
		$tpl->component('blog.master');











	}


?>