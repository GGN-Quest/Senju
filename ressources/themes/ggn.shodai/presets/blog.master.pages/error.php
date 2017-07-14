<?php


namespace GGN\DPO;





/* 
	Post : Banniere Publicitaire // DEBUT -------------------------- 
*/

	$ErrorPage = (new Theme\Tag([

		'class'=>'margin-tb-x24 x112-h gui flex column center x480-h'

	]))

		->text('<div class="text-thin text-x8-vw">Page non-trouvée</div>')

	;

	
	$container->node->nCo->node->lPage->node->ErrorPage = $ErrorPage;

/* 
	Post : Banniere Publicitaire // FIN -------------------------- 
*/
