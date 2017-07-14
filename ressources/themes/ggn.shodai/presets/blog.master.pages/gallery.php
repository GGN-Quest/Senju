<?php


namespace GGN\DPO;





/* 
	Post : Banniere Publicitaire // DEBUT -------------------------- 
*/

	$HS = (new Theme\Tag([

		'class'=>'margin-tb-x24 x112-h gui flex column center '

	]))

		// ->text('<div class="text-thin text-x8-vw">En counstruction</div>')

	;

	
	$container->node->nCo->node->lPage->node->HS = $HS;

/* 
	Post : Banniere Publicitaire // FIN -------------------------- 
*/






/* 
	Post : Charger les posts suivants // DEBUT -------------------------- 
*/

	$More = (new Theme\Tag([

		'class'=>'margin-tb-x24 padding-x32 gui flex center column wrap text-x4-vh color-light-d text-spacing-ml cursor-pointer '

		,'id'=>'blog-page-more'

		,'handler-click'=>'Get.More'

		,'get-more-bid'=> $this->Blog->BID

		,'get-more-part'=> 'gallery'

		,'get-more-current'=> '0'

		,'get-more-label'=> 'Plus de photos'

		,'get-more-per'=> '' . (\_GGN::varn('BLOGGING_POST_PER_PAGE') * 2) . ''

	]))

		->text('Afficher plus de photo ')

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
