<?php

	global $GRegister;

	
	$uri = $args[0];

	$exp = explode('://', $uri);

	$in = (isset($exp[0])) ? $exp[0] : false;

	$dir = (isset($exp[1])) ? $exp[1] : '';

	$merge = (isset($exp[2])) ? $exp[2] : false;

	$out = false;

	

	if($in){

		switch (strtolower($in)) {

			
			case 'http': $out = HTTP_HOST; break;
			

			case 'doc-root': $out = $_SERVER['DOCUMENT_ROOT']; break;

			
			case 'root': case 'main': $out = __MAIN__; break;


			case 'cores': $out = __CORES__; break;

				case 'cores-php': $out = __CORES_NATIVE_PHP__; break;

				case 'cores-js': $out = __CORES_NATIVE_JS__; break;

				case 'cores-css': $out = __CORES_NATIVE_CSS__; break;

				// case 'cores-html': $out = __CORES_NATIVE_HTML__; break;


			
			case 'app': $out = __APPLICATIONS__; break;

			
			case 'ggn-system': $out = __CORES_SYSTEM_GGN__; break;

			
			case 'com': $out = __CORES_SYSTEM_COM__; break;
			
			
			case 'system': $out = __CORES_SYSTEM__; break;

			
			case 'native': $out = __CORES_NATIVES__; break;

			
			case 'plugin': $out = __PLUGINS__; break;

				case 'plugin-php': $out = __PLUGINS_PHP__; break;

				case 'plugin-html': $out = __PLUGINS_HTML__; break;

				case 'plugin-css': $out = __PLUGINS_CSS__; break;

				case 'plugin-js': $out = __PLUGINS_JS__; break;



			case 'html': $out = __HTML__; break;


			case 'users': $out = __USERS__; break;


			case 'ressource': case 'rsrc': $out = __RESSOURCES__; break;

				case 'font': $out = __FONTS__; break;

				case 'lang': $out = __LANGS__; break;

				case 'swf': $out = __SHOCKWAVES_X__; break;

				case 'image': $out = __IMAGES__; break;

				case 'captcha': $out = __CAPTCHA__; break;

				case 'video': $out = __VIDEOS__; break;

				case 'sample': $out = __SAMPLE_FILES__; break;

				case 'sound': $out = __SOUNDS_FILE__; break;

				case 'js': $out = __JAVASCRIPTS__; break;

				case 'css': $out = __CSS__; break;
				
				case 'theme': $out = __THEMES__; break;


			case 'cache': $out = __CACHES__; break;

				case 'cache-active': $out = __CACHES_ACTIVE__; break;

				case 'cache-passive': $out = __CACHES_PASSIVE__; break;


			
			case 'user': 


				if(isset($GRegister->USER) && is_array($GRegister->USER) && is_string($GRegister->USER['USERNAME']) ){

					$out = GUSERS::dataDir($GRegister->USER['USERNAME'], $merge);

				}

				else{$out = false;}

			break;
				
				case 'user-gpk-data': 

					if(isset($GRegister->USER) && is_array($GRegister->USER) && is_string($GRegister->USER['USERNAME']) ){

						$out = GUSERS::dataDir($GRegister->USER['USERNAME']) . '.gpk/';

					}

					else{$out = false;}

				break;
				
				case 'user-downloads': 

					if(isset($GRegister->USER) && is_array($GRegister->USER) && is_string($GRegister->USER['USERNAME']) ){

						$out = GUSERS::dataDir($GRegister->USER['USERNAME'], '%DOWNLOAD%');

					}

					else{$out = false;}

				break;


				
		}

	}

	return (is_string($out)) ? $out . $dir: false;
	
?>