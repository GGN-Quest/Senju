<?php
	
	namespace GGN\DPO;

	global $GRegister;


	// $UsesAjax = \GGN\Apps\Get::UsesAjax();





	/* Chargement des plugins du template / DEBUT */

		$this->TemplatesPlugins();

	/* Chargement des plugins du template / FIN */
	






	/* Entete / DEBUT */


		/* Menu / DEBUT */

			$AppMenuItems = [];


			/* Déclaration / Debut */

				$AppMenuItems = [

					[

						"label" => "<span class=\"gui iconx text-x24 \" ui-icon=\"keyboard_arrow_right\"></span><span class=\"text-label\">Console</span>"

						, "link" => "index"

						, "title" => "Console de commande"

						, "class" => "gui flex center"

					]

					, [

						"label" => "<span class=\"gui iconx text-x24 \" ui-icon=\"play_for_work\"></span><span class=\"text-label\">Automats</span>"

						, "link" => "automats"

						, "title" => "La liste des Automats"

						, "class" => "gui flex center"

					]

				];

			/* Déclaration / Fin */



			$AppMenu = $this->SetMenu([

				'items' => $AppMenuItems

			]);

		/* Menu / FIN */




		$this->NavBar('false', $AppMenu->html);


	/* Entete / FIN */
	




	/* Module : Moteur de recherche / DEBUT */

		if(isset($this->Tpl->Body->Sheet->node->OnlyBar->node->Modules->node->Content)){

			$this->Tpl->Body->Sheet->node->OnlyBar->node->Modules->node->Content

				->text('<div class="text-x26 text-upper text-spacing-normal cursor-default gui-fx">' . $this->Manifest['Name'] . '</div>')

			;

		}

	/* Module : Moteur de recherche / FIN */





	/* Outils / DEBUT */

		if(isset($this->Tpl->Body->Sheet->node->OnlyBar->node->Tools)){
			
			$this->Tpl->Body->Sheet->node->OnlyBar->node->Tools->attrib('id', 'ui-header-tools');

				
				// $this->Tpl->Body->Sheet->node->OnlyBar->node->Tools

				// 	->text('<div class="gui x32 cursor-pointer margin-x4 bg-primary-l-hover gui-fx padding-x8 box-rounded" ui-icon="add" title="Ajouter" ggn-handler-click="Terminal.Add"></div>')

				// ;


				$this->Tpl->Body->Sheet->node->OnlyBar->node->Tools

					->text('<div class="gui x32 cursor-pointer margin-x4 bg-primary-l-hover gui-fx padding-x8 box-rounded" ui-icon="more_vert" title="Paramètres" ggn-handler-click="Terminal.Settings.Show"></div>')

				;


		}

	/* Outils / FIN */






	/* SpalshScreen / DEBUT */

		if(!UsesAjax()){

			$Splash = new \GGN\Plugin\HTML\Model\Brick(

				'SplashScreen/Default'

				, [

					'triggerOut' => true

					, 'style' => 'bg-primary-d color-light-l'

					, 'label' => '<div class="x256-w-min gui flex center column"><img src="' 

						. \_GGN::setvar($this->Manifest['Icon'])

						. '?mode=-gd&width=256&height=116&resize=true&resizeby=0&quality=-high&filter=colorize:'

						. ($this->Tpl->Cores->CSS->Colorize['palette-light-color']) 

						. '" alt="" class="x128-w w-auto"><div style="height:3px;" class="ui-wait-bar x128-w margin-tb-x12"><div class="ui-wait-unit"></div><div class="ui-wait-unit"></div><div class="ui-wait-unit"></div></div><div class="padding-tb-x4 text-upper text-x12 text-center _w10"></div></div>'

					, 'version' => '<div class="text-center text-x16 padding-lr-x32 ">' . $this->Manifest['Version'] . '</div> <div class="text-center text-x12 padding-b-x28 opacity-x60 padding-lr-x32 ">Mise à jour ' . $this->Manifest['UpdateVersion'] . '</div>'

					// ,'CSSCore' => $tpl->Cores->CSS

				]

			);


			$this->Tpl->Head->style($Splash->css);

			$this->Tpl->Body->write($Splash->html);

			$this->Tpl->Body->js($Splash->js);


		}

	/* SpalshScreen / FIN */







	$this->Tpl->Body->addClass('disable-x-scrollbar');



	