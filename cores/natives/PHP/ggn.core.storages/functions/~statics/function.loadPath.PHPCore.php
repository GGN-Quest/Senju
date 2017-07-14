<?php
	
	$return = false;


	if(isset($args)){

		/* Variables */
		$path = (isset($args[0]))?$args[0]:false;

		$type = (isset($args[1]))?$args[1]:false;

		$nonly = (isset($args[2]))?$args[2]:false;
		


		/* Si "path" est du type STRING */
		if(is_string($path)){

			/* Fichier */
			$p = self::getDataPath($path);

			if(is_dir($p)){

				$data = ($type==false) ? Gougnon::scanFolder($p) : Gougnon::iScanFolder($p);

				$out = [];

				foreach ($data as $key => $value) {

					$drl = ($type == false) ? '' : substr(dirname($value), strlen($p)) ;

					$drl .= (\Gougnon::isEmpty($drl)) ? '' : '/';

					$dir =  ($type == false) ? $path : ($path . $drl);

					$f = basename($value);


					// $file = self::EXTC . basename($value) . self::EXTS;
					$pfx = substr($f, 0, strlen(self::EXTC));

					$sfx = substr($f, -1*strlen(self::EXTS));

					if($pfx==self::EXTC && $sfx==self::EXTS){

						$fl = str_replace($pfx, '', $f);

						$fl = str_replace($sfx, '', $fl);

						$out[ $drl . $fl ] = ($nonly === true) ? $fl : self::load($fl, $dir);

					}

				}


				$return = $out;

			}


		}



	}



?>