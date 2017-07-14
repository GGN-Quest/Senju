<?php
	

global $_Gougnon;



/* Class GAPPS */
// if(!class_exists('GUSERS')){
// 	_GGN::PHPCore('ggn.core.users');
// }





// $GLOGIN_NATIVE_VARS = 'LOGIN_PAGE USERS_SESSION_LOCATION USERS_SESSION_MANAGER_PLUGIN_NAME USERS_SESSION_MANAGER_PLUGIN_PLG SYSTEM_THEME';
// _GGN::keyExists(explode(' ',$GLOGIN_NATIVE_VARS));







/* Application */
if(_GGN::varn('COMINGSOONPAGE_ACTIVE')!=='1'){
	_GGN::wCnsl('Cette page a été désactivé par le gestionnaire');
}

$theme = (new dpo('html'))->load(_GGN::varn('COMINGSOONPAGE_THEME'));
$theme->brique('comingsoon.page');
$theme->generate();


	
?>