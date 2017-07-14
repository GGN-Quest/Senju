<?php
	

global $_Gougnon;



/* Class GAPPS */
if(!class_exists('GUSERS')){
	_GGN::PHPCore('ggn.core.users');
}





$GLOGIN_NATIVE_VARS = 'LOGIN_PAGE USERS_SESSION_LOCATION USERS_SESSION_MANAGER_PLUGIN_NAME USERS_SESSION_MANAGER_PLUGIN_PLG SYSTEM_THEME';
_GGN::keyExists(explode(' ',$GLOGIN_NATIVE_VARS));







/* Application */
if(_GGN::varn('INSTALLERPAGE_ACTIVE')!=='1'){
	_GGN::wCnsl('Cette page a été désactivé par le gestionnaire');
}






/* ============================================================== */
/* Page en DPO */
$theme = new dpo('html');
$theme->packageStyle = 'ggn.dark';
$theme->_url = HTTP_HOST . 'ggn.insider/';
$theme->title = 'Gougnon Installer';







	/* ==================== ENTETE */
	$theme->doctype('html');
	$theme->html('lang', $theme->_lang);
	
	
	/* Ajout */
	$theme->shorcut(HTTP_HOST . 'favicon.png'); // Ajouter favicone
	$theme->meta('charset', 'utf-8');
	$theme->meta('http-equiv', 'pragma', 'cache');
	$theme->meta('name', 'mobile-web-app-capable', 'yes');
	$theme->meta('name', 'viewport', 'width=device-width,initial-scale=1');

	
	/* Ajout Pakacges JS GougnonJS Framework */
	/* Packages JS Gougnon */
	$theme->jsPackage('ggn.lockbox.confirm');
	$theme->jsPackage('ggn.insider');
	$theme->jsPackage('ggn.insider.store');
	
	
	/* Pakacges CSS GougnonCSS Framework */
	$theme->cssPackage('ggn.lockbox.confirm');
	$theme->cssPackage('font.roboto.thin');
	$theme->cssPackage('font.roboto.light');

	
	/* Fichier CSS qui ne font pas parti du framework */
	$theme->callCSS($theme->_url . 'init.css?style=' . $theme->packageStyle);
	


	/* Génération -------------------------- */
	$theme->_shorcut();
	$theme->_meta();
	$theme->_title();
	
	
	
	/* CSS */
	$theme->_cssPackages();
	$theme->_css('-call');
	$theme->_css('-code');
	








	/* ==================== CORPS */
		
	$theme->body('<div class="gui sheet" id="ggn-sheet">');


		$theme->body(Gougnon::fullSpace('<center><div class="ggn-insider-logo-center"></div></center>'));


	$theme->body('</div>');





	/* JavaScript */
	$theme->js('var sheet = G("#ggn-sheet"), lockInit=G.F();');
	$theme->js('(function(){');
		$theme->js('lockInit = GLockBox.Confirm(sheet).init({version:"0.1"');
			$theme->js(',width:450 ,height:250');
		$theme->js('});');

		$theme->js("lockInit.message('Gougnon Installer', '<input type=\"text\" name=\"username\" placeholder=\"Nom d\'utilisateur\" ><input type=\"password\" name=\"password\" placeholder=\"Mot de passe\" >',{");
			$theme->js('submit:{label:"Se connecter",click:function(evt,o){var f=o.form.element; GInsider.Store.Login(f.username.value||false, f.password.value||false); return false;}, focus:false}');
		$theme->js('});');

	$theme->js('})();');





	/* ==================== PIED */
	/* Pakacges JS Gougnon */
	$theme->_jsPackages();
	
	/* JavaScript */
	$theme->_javascript('-call'); // fichier JS
	$theme->_javascript('-code'); // code JS
	
	



$theme->generate();


	
?>