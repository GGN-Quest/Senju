<?php


namespace GGN\DPO;

global $GLANG;





/* Chargement des post */

$Posts = \GGN\User\Blog\Post::Get($this->Blog->BID);








/* 
	Post-Master : Edition de post // DEBUT -------------------------- 
*/


if($this->isMyBlog){




	$this->body->js('GScript.load(" ' . $this->_url . 'user.post.blog.js?style=' . $this->style . '");');

	$this->body->js(' GScript.check("BlogPostActions",function(){BlogPostActions();});');



	$EditPost = (new Theme\Tag([

		'class'=>'blog-bloc blog-edition-post margin-tb-x16 gui flex column start'

	]));


		$EditPost->node->Title = (new Theme\Tag([
	
			'class'=>'title text-left text-x18 padding-lr-x16 padding-tb-x16'
	
		]))

			->text('<span class="gui icon pencil margin-r-x16"></span>Redigez une nouvelle Actualité')

		;


		$EditPost->node->Form = (new Theme\Tag([
	
			'tag'=>'form'

			,'class'=>'gui pos-relative'

			,'id'=>'blog-edit-post-form'
	
		]))

		;
		

		$EditPost->node->Form->node->Content = (new Theme\Tag([
	
			'id'=>'blog-edit-post-box'

			,'class'=>'blog-edit-post'
	
		]))

			->text('<textarea name="post-content" class="editor col-15 x128-h-min x480-h-max disable-scrollbar text-x16" id="blog-post-composer" ggn-handler-keyup="Gabarit.Form.TextArea.Flexible" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#blog-edit-post-box" placeholder="Commencer la rédaction..."></textarea>')

		;
		

		$EditPost->node->Form->node->Content->node->Buttons = (new Theme\Tag([
			
			'class'=>'gui flex center '
	
		]));


			$EditPost->node->Form->node->Content->node->Buttons->node->PostAttchm = (new Theme\Tag([
				
				'class'=>'gui flex start row wrap align-left padding-x16'

				,'id'=>'blog-post-assoc-actions'
		
			]))


				->text('<a href="javascript:void(0);" class="gui box-circle x32 margin-lr-x4 margin-t-x40 gui flex center button cursor-pointer padding-x0 " id="blog-post-attch-photo" handler-click="Ressources.Users.Images" rsrc-users="' . $this->Register->USER['UKEY'] . '" rsrc-awake-from="this" rsrc-callback-data="BlogUserPostAssocPhoto" rsrc-mid="' . $this->Blog->BID . '"><span handler-click="Ressources.Users.Images" rsrc-users="' . $this->Register->USER['UKEY'] . '" rsrc-awake-from="this.parent" rsrc-callback-data="BlogUserPostAssocPhoto" rsrc-mid="' . $this->Blog->BID . '" class="gui icon image x16"></span></a>')

				// ->text('<a href="javascript:void(0);" class="gui box-circle x32 margin-lr-x4 margin-t-x40 gui flex center button cursor-pointer padding-x0 " id="blog-post-attch-video"><span class="gui icon video-clapper x16"></span></a>')

			;


			$EditPost->node->Form->node->Content->node->Buttons->node->Actions = (new Theme\Tag([
				
				'class'=>'gui flex end row wrap align-right padding-x16'
		
			]))

				->text('<a href="#" onclick="return false;" class="gui box-circle x32 margin-lr-x4 margin-t-x24 gui flex center button error cursor-pointer padding-x0 " id="blog-post-cancel"><span class="gui icon close x16"></span></a>')

				->text('<a href="javascript:void(0);" onclick="return false;" class="gui box-circle x64 margin-x4 gui flex center button active cursor-pointer padding-x0" id="blog-post-submit" data-blog-id="' . $this->Blog->BID . '"><span class="gui icon check x32"></span></a>')


			;


		$EditPost->node->Form->node->Content->node->Assoc = (new Theme\Tag([
			
			'class'=>'blog-post-assoc-fields gui-transition disable-scrollbar' 
	
		]))

		;

		$EditPost->node->Form->node->Content->node->Assoc->node->Fields = (new Theme\Tag([
			
			'id'=>'blog-post-assoc-fields'

			,'class'=>'gui flex wrap disable margin-t-x16 bg-ncolor-d'

			,'post-username'=>$this->Register->USER['USERNAME']
	
		]))

		;




	$container->node->nCo->node->lPage->node->EditPost = $EditPost;


}

/* 
	Post-Master : Edition de post // FIN -------------------------- 
*/









/* 
	Post : Banniere Publicitaire // DEBUT -------------------------- 
*/

	// $Ads01 = (new Theme\Tag([

	// 	'class'=>'blog-bloc margin-tb-x24 x320-h gui flex center bg-primary-d'

	// ]))

	// 	->text('<div class="h2 color-light-l"> Sponsor </div>')

	// ;

	
	// $container->node->nCo->node->lPage->node->Ads01 = $Ads01;

/* 
	Post : Banniere Publicitaire // FIN -------------------------- 
*/









// if($Posts->row <= 0){



// }

// if($Posts->row > 0){


// 	foreach ($Posts->data as $PKey => $Post) {



// 		/* Date et Heure de publication */

// 		$PDate = \GGN\User\Blog\Post::DateFormatted($Post->DATETIMES);








// /* 
// 	Post : Galerie Photo // DEBUT -------------------------- 
// */

// 	$Gallery01 = (new Theme\Tag([

// 		'class'=>'blog-bloc post-gallery margin-tb-x24 pos-relative _w10 gui flex column start ' 
// 	]));


// 		$Gallery01->node->Screen = (new Theme\Tag(['class'=>'_w10 _h10 screen pos-relative gui flex column center disable-scrollbar col-0 background-abs-center']));


		
// 		if(!\Gougnon::isEmpty($Post->_CONTENT)){


// 			if($Post->_TYPE == 'false'){

// 				$Gallery01->node->UP = (new Theme\Tag(['class'=>'content-text-up']));

// 			}




// 			$Gallery01->node->Article = (new Theme\Tag([
		
// 				'class'=>'article padding-x16 text-left wrap'
		
// 			]))

// 				// ->text('<div class="h2">Titre de l\'article</div>')

// 			;


// 			$idCont = 'post-text-content-' . $PKey;

// 			$Post_Content = utf8_encode($Post->_CONTENT);

// 			$Post_CNum = strlen($Post_Content);

// 			$Post_Cont = ($Post_CNum > 160) ? substr(htmlentities($Post_Content), 0, 160) . '... <span class="text-x18 color-primary-l text-italic padding-t-x32 cursor-pointer" handler-click="Gabarit.Toggle" gabarit-toggle="#' . $idCont . '" toggle-from="disable" toggle-to="enable" onclick="this.parentNode.hide();">Lire la suite</span>' : $Post_Content;


// 			$Gallery01->node->Article->text('<div class="text-x16 text-upper-first padding-x16 ">' . ($Post_Cont) . '</div>');

// 			$Gallery01->node->Article->text('<div class="text-x16 disable padding-x16" id="' . $idCont . '">' . nl2br(htmlentities($Post_Content)) . '</div>');


// 		}




// 		/* Si une image est associé */

// 		if(is_string($Post->_TYPE)){



// 			if($Post->_TYPE == 'image'){
				

// 				$Assoc = explode(',', $Post->_ASSOC);

// 				$ReAssoc = array_reverse($Assoc);

// 				$AssocLen = count($Assoc);

// 				$RsrcURL = HTTP_HOST . 'rsrc/' . $this->Register->BlogUser->USERNAME . '/image/';

// 				$AssocIMG = [];




// 				$Gallery01->addClass('vh8-min');

// 				$Gallery01->node->Screen->node->Thumbs = (new Theme\Tag([
			
// 					'class'=>'thumbs _w10 _h10 gui flex center row no-wrap pos-absolute disable-scrollbar'
			
// 				]));


// 					/* Liste des photo */


// 					for ($bgpx=0; $bgpx < $AssocLen; $bgpx++) {

// 						$im = $ReAssoc[$bgpx];

// 						$_im = \GGN_UTIL_RSRC::_URLMd($im);


// 						if($bgpx <= 2){


// 							$img = $RsrcURL . $_im;



// 							$item = (new Theme\Tag([
						
// 								'class'=>'item _13 h-inherit box-skew disable-scrollbar mi-col-16 li-col-16 s-col-8 ' . ($bgpx>=1 ? ' mi-disable li-disable ': '') . ($bgpx>=2 ? ' li-disable s-disable ' : '')
						
// 							]));


// 							if($AssocLen > 1){

// 								$item->text('<div style="background-image:url(' . $img . '&mode=-gd&width=960&height=768&resize=&resizeby=1&rogner=1&quality=-high);" class="image col-16 _h10 box-no-skew"></div>');
								
// 							}

// 							if($AssocLen <= 1){

// 								$Gallery01->node->Screen->attrib('style', 'background-image:url(' . $img . '&mode=-gd&width=960&height=768&resize=&resizeby=1&rogner=1&quality=-high);');

// 							}

// 							$Gallery01->node->Screen->node->Thumbs->node->{'item_' . $bgpx} = $item;

// 						}


// 						array_push($AssocIMG, $_im);

// 					}



// 				$Gallery01->node->Screen->node->Over = (new Theme\Tag([
			
// 					'class'=>'over gui flex column center disable-scrollbar pos-relative'
			
// 				]))

// 					->text('<a href="" onclick="return false;" class="color-light gui icon eye xh2 no-ff" handler-click="Photo.Viewer" photo-viewer-src="' . $RsrcURL . \GGN_UTIL_RSRC::_URLMd($ReAssoc[0]) . '" photo-viewer-ukey="' . $this->Register->BlogUser->UKEY . '" photo-viewer-type="rsrc" photo-viewer-gallery="' . implode(';', $AssocIMG) . '" photo-viewer-url-base="' . $RsrcURL . '" ></a>')

// 					->text('<a href="" onclick="return false;" class="color-light h2" handler-click="Photo.Viewer" photo-viewer-src="' . $RsrcURL . \GGN_UTIL_RSRC::_URLMd($ReAssoc[0]) . '" photo-viewer-ukey="' . $this->Register->BlogUser->UKEY . '" photo-viewer-type="rsrc" photo-viewer-gallery="' . implode(';', $AssocIMG) . '" photo-viewer-url-base="' . $RsrcURL . '" >' . (($AssocLen >= 2) ? 'Visionner<br>l\'album photo' : 'Visionner<br>la photo') . '</a>')

// 				;


// 				$Gallery01->node->Screen->node->Infos = (new Theme\Tag([
			
// 					'class'=>'infos gui flex wrap row pos-absolute _w10 padding-t-x32'
			
// 				]));


// 					$Gallery01->node->Screen->node->Infos->node->Title = (new Theme\Tag([
				
// 						'class'=>'gui flex col-8 mi-flex-center li-flex-center mi-col-16 li-col-16 padding-tb-x12 padding-lr-x24' // 
				
// 					]))

// 						->text('<div class="gui icon gallery text-x24 "></div>')

// 						->text('<div class="text-left padding-l-x16">')

// 							->text('<div class="text-x24 text-ellipsis">' .  ((!\Gougnon::isEmpty($Post->_TITLE)) ? $Post->_TITLE: (($AssocLen >= 2) ? 'Album Photo' : 'Photo')) . '</div>')

// 							->text('<div class="text-x12 text-ellipsis">Publier '. ucfirst($PDate->Day) . ' '. ucfirst( $PDate->Month) . ' ' .$PDate->Year . ' à '. $PDate->Time . '</div>')

// 						->text('</div>')

// 					;





// 					$Gallery01->node->Screen->node->Infos->node->Stat = (new Theme\Tag([
				
// 						'class'=>'gui flex row end mi-flex-center li-flex-center col-0 mi-col-16 li-col-16 padding-tb-x24 padding-lr-x24'
				
// 					]))

// 						// ->text('<div class="padding-lr-x16 text-x20"> 300<span class="opacity-x50">k</span> <div class="gui icon comments x16 "></div></div>')

// 						// ->text('<div class="padding-lr-x16 text-x20"> 15<span class="opacity-x50">k</span> <div class="gui icon eye x16 "></div></div>')

// 						// ->text('<div class="padding-lr-x16 text-x20"> 14<span class="opacity-x50">k</span> <div class="gui icon heart x16 "></div></div>')

// 						// ->text('<div class="gui icon more-alt x32 "></div>')


// 					;

// 			}



// 			else{

// 				$Gallery01->node->Article->node->Stat = (new Theme\Tag([
			
// 					'class'=>'gui flex row start mi-flex-center li-flex-center col-0 mi-col-16 li-col-16 padding-tb-x16 padding-lr-x0 color-primary'
			
// 				]))

// 					// ->text('<div class="padding-lr-x16 text-x20"> 300<span class="opacity-x50">k</span> <div class="gui icon comments x16 "></div></div>')

// 					// ->text('<div class="padding-lr-x16 text-x20"> 15<span class="opacity-x50">k</span> <div class="gui icon eye x16"></div></div>')

// 					// ->text('<div class="padding-lr-x16 text-x20"> 14<span class="opacity-x50">k</span> <div class="gui icon heart x16 "></div></div>')

// 					// ->text('<div class="gui icon more-alt x32 "></div>')

// 				;


// 			}



// 		}






// 	$container->node->nCo->node->lPage->node->{'Gallery-' . $PKey} = $Gallery01;

// /* 
// 	Post : Galerie Photo // FIN -------------------------- 
// */






// 	}


// }














/* 
	Post : Charger les posts suivants // DEBUT -------------------------- 
*/

	$More = (new Theme\Tag([

		'class'=>'margin-tb-x24 padding-x32 gui flex center column wrap text-x4-vh color-light-d text-spacing-ml cursor-pointer '

		,'id'=>'blog-page-more'

		,'handler-click'=>'Get.More'

		,'get-more-bid'=> $this->Blog->BID

		,'get-more-part'=> 'post'

		,'get-more-current'=> '0'
		// ,'get-more-current'=> '' . $Posts->row . ''

		,'get-more-per'=> '' . \_GGN::varn('BLOGGING_POST_PER_PAGE') . ''

	]))

		->text('Afficher plus d\'actualités ') 

	;



	$this->body->js('(function(){');

		$this->body->js('GScript.check("GetMorePostTrigger", function(){');

			$this->body->js('G(function(){');

				$this->body->js('var ge = G("#blog-page-more");');

				$this->body->js('GetMorePostTrigger(ge, false);');

			$this->body->js('}).timeout(500);');

		$this->body->js('});');

	$this->body->js('})();');

	
	$container->node->nCo->node->lPage->node->More = $More;



/* 
	Post : Charger les posts suivants // FIN -------------------------- 
*/



