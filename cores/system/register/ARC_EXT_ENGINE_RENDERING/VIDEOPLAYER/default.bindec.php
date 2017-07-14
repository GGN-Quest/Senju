<?php
	



if(is_array($this->USER)){


	if(isset($this) && isset($Player)){



		/* Class GBookDirectory */
		if(!class_exists('GBookDirectory')){
			Gougnon::loadPlugins('PHP/ggn.book.directory.0.1');
		}

		$BKD = new GBookDirectory();


		$Key = $Player->Param['k'];
		$Key = (is_numeric($Key))?$Key:false;



		$videoQuery = $BKD->GetData($BKD::_TBL_VIDEOS, "WHERE id='".$Key."'", true, true);

		if(is_object($videoQuery)){

			if($videoQuery->row > 0){

				$video = $videoQuery->data[0];
				$source = $video['source'];
				$exp = explode('.', $source);
				$gtyp = isset($exp[1]);
				$Player->Video['title'] = $video['title'] . ' - ' . _GGN::varn('SITENAME');

				if($gtyp){
					$Player->Type = false;
					$Player->Video['url'] = $BKD::HOST_VID . $video['source'];
				}

				else{
					$Player->Type = 'yt';
					$Player->Video['key'] = $video['source'];
				}


			}

		}


	}


}

else{

	_GGN::wCnsl('<h1>Accès reservé</h1> Vous devez etre connecté pour acceder à vidéo.');
	
}


?>