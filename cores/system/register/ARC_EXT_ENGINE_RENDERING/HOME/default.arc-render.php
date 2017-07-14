<?php

namespace GGN\DPO;


/* Jonction du ARC / DEBUT */

$_ARC_PAGE = $this->ARCPage("HOME");


if(is_file($_ARC_PAGE)){


	/* DPO */

	global $_DPO_DEVICE;

	new Using("DPO\Page");

	new Using("DPO\Procedure");

	new Using("DPO\Theme");

	$_UsesAjax = UsesAjax();





	/* Initialisation de l'ARC / DEBUT */

		$_ARC = new \RegisterARC("HOME");

	/* Initialisation de l'ARC / FIN */








	/* Initialisation du Template */

	$tpl = new Theme\Preset(\_GGN::varn("HOMEPAGE_THEME"));

	$tpl->Register = $this;



	/* Inclusion de la jonction du ARC */

	include $_ARC_PAGE;



	/* Moteur de rendu */

		if(!$_UsesAjax){

			$page = new Page\Init($tpl);

			$page->engine()->schema( (new Page\RenderingScheme())->html5 )->start();

		}

		if($_UsesAjax){

			$page = new Page\Init($tpl);

			$page->engine()->start(false, "body");

		}


}

else{

	$this->eventOn("ERROR.ARC", "HOME");

}

/* Jonction du ARC / FIN */


?>
