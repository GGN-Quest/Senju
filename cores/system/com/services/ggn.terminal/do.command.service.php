<?php
/*
	Copyright GOBOU Y. Yannick 2016
	
*/

namespace GGN\System\xCMD;


if(isset($this->Register->USER) && is_array($this->Register->USER) && $this->Register->USER['ACCOUNT_TYPE'] > 4){


	/* Commands */

	new \GGN\Using('System/xCMD');







	/* Recupération / DEBUT */
	
		$Ukey = $this->Register->USER['UKEY'];


		$ModK = \Register::_POST('module', '');

			$ModK = ( !\Gougnon::isEmpty($ModK) ) ? $ModK : false ;


		$Cmd = \Register::_POST('cmd', false);

			// $Cmd = (is_string($ModK) && substr_count($Cmd, $ModK) && \Gougnon::isEmpty($Cmd) ) ? $ModK . ' ' . $Cmd : $Cmd;

	/* Recupération / FIN */


	// print_r($_POST);exit;




	/* Journaux / DEBUT */
	
		$Console = $this->node('console');

			$Console->Line = [];

		$Executes = $this->node('executes');

		$Instance = $this->node('instance');

	/* Journaux / FIN */

	 


	// $Console->Cmd = $Cmd;

	// $Console->ModK = $ModK;






	/* Traitement / DEBUT */

	if(is_string($Cmd)){


		// $_CMD = explode(' ', $Cmd);

		$_CMD = Utility::Concatenate($Cmd);

		$ModK = (is_string($ModK)) ? $ModK : $_CMD[0];




		/* Module embarqué : Inexistant / DEBUT */

			$Mod = $this->node('mod');

			$Mod->Key = (is_string($ModK)) ? $ModK : false;

			$Mod->Name = false;

			$Mod->Version = false;

			$Mod->Applied = false;



			/* Recherche du module / DEBUT */

				$_MODULE = Get::Module($Mod->Key);


				if(is_object($_MODULE)){

					$CmdArgs = (is_string($ModK) && !substr_count($Cmd, $ModK)) ? $_CMD : \Gougnon::arrayValues($_CMD, 1);

					$Mod->Version = $_MODULE::VERSION;

					$Mod->Name = $_MODULE::NAME . ' / ' . $Mod->Version;

					// $Mod->CmdArgs = $CmdArgs;

					$CmdArgsLength = count($CmdArgs);

					$Mod->Applied = $_MODULE->Apply( ( $CmdArgsLength == 0 ) ? null : implode(' ', $CmdArgs ) );



					if(isset($Mod->Applied) && is_string($Mod->Applied)){

						$Console->Line[] = $Mod->Applied;

					}


					if(isset($Mod->Applied) && is_array($Mod->Applied)){

						$Console->Line = \Gougnon::mergeArray($Console->Line, $Mod->Applied);

					}


					if(isset($_MODULE->Executes) && is_array($_MODULE->Executes)){

						foreach (explode(' ', 'Script Process Cmd Sequence') as $key) {

							$Executes->{$key}  = (isset($_MODULE->Executes[$key]) && is_array($_MODULE->Executes[$key])) ? $_MODULE->Executes[$key] : false;
							
						}

					}


					if(isset($_MODULE->Instance) && is_array($_MODULE->Instance)){

						$Instance->{'0'}  = $_MODULE->Instance;

					}


					$this->Response('true');


				}

				if(!is_object($_MODULE)){

					$Console->Line[] = 'Module introuvable';

				}

			/* Recherche du module / FIN */



		/* Module embarqué : Inexistant / FIN */



		$this->Response('false');

	}

	else{

		$this->Response('no.cmd');

	}

	/* Traitement / FIN */







}

else{

	$this->Response('require.login');

}
