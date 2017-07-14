<?php
	
	namespace GGN\DPO;

	global $GRegister;

	



	/* Briques Utilitaires / DEBUT */

		$this->Brick('plugins.call');

		$this->Brick('init.js.full.page');

	/* Briques Utilitaires / FIN */





	/* Exception dans la gestion des jetons de sécurité / DEBUT */
		
		$RegisterException = \RegisterSecure::TokenException('ggn.terminal.sense.service', 'com.services/ggn.terminal/do.exec');
		
		if(!$RegisterException){

			\_GGN::wCnsl('<h1>Erreur Jéton d\'autorisation</h1>Impossible de créer le jéton');

		}

	/* Exception dans la gestion des jetons de sécurité / FIN */










	$this->Header();

	

	/* Conteneur / DEBUT */


		$this->Tpl->Body->Sheet->node->Container

			->addClass('disable-scrollbar')

			->replaceClass('row', 'column')

		;



		$Area = (new Theme\Tag([

			'id' => 'terminal-area'

			, 'class' => 'col-0 gui flex column disable-x-scrollbar enable-y-auto-scrollbar'

		]));


			$Area->node->CMDs = (new Theme\Tag([

				'id' => 'terminal-area-cmds'

				, 'class' => 'text-x12 vw10 gui flex column wrap '

			]))


				->text('<div class="color-text-d padding-x12">')

					->text('<div class="text-x18">' . $this->Manifest['Name'] . '</div>')

					->text('<div class="text-x12">Version : ' . $this->Manifest['Version'] . ', Mise à jour : ' . $this->Manifest['UpdateVersion'] . '</div>')

				->text('</div>')
				
			;

				$Area->node->CMDs->node->Viewer = (new Theme\Tag([

					'id' => 'terminal-area-cmds-viewer'

					, 'class' => 'col-0 text-x14 terminal-viewer'

				]))

					->text('<div class="col-0 vh5 text-x12 gui flex center" id="terminal-preloader-tmp">Initialisation...</div>')

				;

				$Area->node->CMDs->node->Form = (new Theme\Tag([

					'id' => 'terminal-area-cmds-form'

					, 'tag' => 'form'

					, 'action' => '#'

					, 'method' => 'post'

					, 'onsubmit' => 'return false;'

					, 'handler-submit' => 'Terminal.Cmd.Input'

					, 'class' => 'col-0 gui flex row center disable padding-b-x32'

				]))

					->text('<div class="padding-tb-x8 padding-l-x4 "><div class="margin-t-x8 x32" ui-icon="keyboard_arrow_right"></div></div>')

					->text('<div class="padding-tb-x8 padding-r-x8 color-text-d "><div class="margin-t-x8 x16" ui-icon="content_paste"></div></div>')

					->text('<input type="text" name="cmd" class="col-0 terminal-cmd-input text-x16" placeholder="" id="terminal-cmd-input">')

					// ->text('<textarea name="cmd" class="col-0 terminal-cmd-input x48-h-min x480-h-max" placeholder="" handler-keyup="Gabarit.Form.TextArea.Flexible" handler-focus="Terminal.Cmd.Input" id="terminal-cmd-input"></textarea>')

					->text('<input type="hidden" name="ggn-registry-token-exception" value="' . $RegisterException[0] . '" > <input type="hidden" name="ggn-registry-token-exception-key" value="' . $RegisterException[1] . '" >')


					->text('<div class="disable"><input type="submit" class="" value="" ></div>')

				;


		
		$this->Tpl->Body->Sheet->node->Container->node->Area = $Area;


	/* Conteneur / FIN */






	/* Declancher l'initialisation de la console / DEBUT */

		if(UsesAjax()){

			$this->Tpl->Body->js('G(function(){ G.Terminal.TriggerInit(); }).timeout(1000);');

		}

	/* Declancher l'initialisation de la console / FIN */





	$this->Footer();


?>