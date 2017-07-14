<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	JS Render
======================================================


	framework.nightly.0.1.php

*/

	
	
	$version = self::_REQUEST('version');
	
	$api = self::_REQUEST('api');

	$this->UseCompactMode = (self::_REQUEST('compact', '1') == '1') ? TRUE : FALSE;

	define('DEFAULT_STYLE', self::_REQUEST('style'));

	
	
	/* Chargement des Noyaux */
	$JSCore = _GGN::JSCore('ggn.core');

	$JSCore->Register = $this;

	$CSSCore = _GGN::CSSCore('ggn.core');

	$CSSCore->Style(DEFAULT_STYLE);



			
	_GGN::write('/* '.$JSCore::NAME.' ('.$JSCore::REEL_VERSION.') */');
	
	_GGN::write("\n");


	if(isset($CSSCore->styleProperties)&&DEFAULT_STYLE!=FALSE){
	
		$style = '';
	
			$style .= 'window.StyleName="' . DEFAULT_STYLE . '";';
	
			$style .= 'window.Style='.json_encode($CSSCore->styleProperties).';';

			$style .= 'window.StyleFilter=function(v){var r=[];';

				$style .= 'for(var n in v){';

					$style .= 'rs=[];';

					$style .= 'rs.push(n);';

					$style .= 'rs.push(":");';

					$style .= 'rs.push(v[n]);';

					$style .= 'r.push(rs.join(""));';

				$style .= '};';

			$style .= 'return ["filter=",r.join(",")].join("")';

			$style .= '};';

		echo($style);
		
	}


	
		$alert = '';
	
		$alert .= 'G_Alert=function(m){var A=Gougnon||G||false,str=[],a=arguments;';
	
		$alert .= 'for(var x in a){if(isStr(a[x])){str.push(a[x]);}}';
	
		$alert .= 'if(A!==false){GToast(str.join("")).bubble();}';
	
		$alert .= 'else{alert(str);}';
	
		$alert .= '};';
	
		_GGN::write($alert);
	
		_GGN::write("\n");
			





			

	/* Construction */
	if($version!==FALSE){if($JSCore->framework($version)===FALSE){header(_GGN::HTTP_HEADER_404);_GGN::write('alert("GGN.JS Framework : version introuvable");');exit;}}
	
	if($version===FALSE){$JSCore->loadDefaultFramework();}

		
	if($api!==FALSE){
	
		$allAPIs = explode(',', $api);

		for($x=0; $x<count($allAPIs); $x++){
	
			$pkgNotFound="API introuvable : [" . ($allAPIs[$x]) . "]";
	
			if($JSCore->loadPackages($allAPIs[$x])===false){ _GGN::write('G_Alert("'.$pkgNotFound.'");'); }
	
			_GGN::write("\n\n");
	
		}		
			
	}
		
	
	
?>