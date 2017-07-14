<?php
	
global $_Gougnon;

if(isset($this->USER) && is_array($this->USER) && $this->USER['ACCOUNT_TYPE'] >= 4){

	 
	new \GGN\Using('Dir');


	require 'default.arc-class.php';





	$Do = Register::_GET('do', false);

	$Save = Register::_GET('save', false);

		$Save = (is_string($Save)) ? true : false;

	$Url = Register::_POST('url', false);

	$Path = Register::_GET('path', '');




	$UserDir = \GGN\Dir\Path::Name('user-downloads://' . $Path);

	$FileInfo = GGN_DOWNLOADER::GetFileInfo($Url);




	if(GGN_DOWNLOADER::IsAuthorized($Url)){


		if(is_string($Do)){


			if($Do == 'get:info'){

				echo json_encode($FileInfo);

				$this->close();
				
			}


			echo "{Response:'no.task'}";

			$this->close();

		}


		else{


			$Filename = basename($Url);


			$Res = [

				'Response'=>false

				, 'FileInfo'=>$FileInfo

			];




			header('Content-Description: File Transfer');

		    header('Content-Type: application/octet-stream');

		    header('Content-Transfer-Encoding: binary');

		    header('Expires: 0');

		    header('Cache-Control: must-revalidate');

		    header('Pragma: public');

		    header('Content-Length: ' . $FileInfo['size']);

		    header('Content-Disposition: attachment; filename="' . $FileInfo['filename'] . '"');




			$handle = fopen($Url, 'r');

			$Buffer = "";

			if($handle === false){

				echo '{"Response":"not.found"}';

				$this->close();
			}

			if($handle !== false){

				while(!feof($handle)){

					$Buff = fread($handle, $FileInfo['size']);

					echo $Buff;

					$Buffer .= $Buff;

				}

				fclose($handle);

				



				/* Sauvegarde sur le serveur / DEBUT */

					if($Save === true){


						if(!is_dir($UserDir)){\Gougnon::createFolders($UserDir);}

						$response = \Gougnon::createFile($UserDir . $FileInfo['filename'], $Buffer);

					}

				/* Sauvegarde sur le serveur / FIN */


			}



			
		}




	}

	else{

		echo "{Response:'url.not.auth'}";

	}



}



else{

	header(_GGN::HTTP_HEADER_404);

	$this->close();

}


	
	
?>