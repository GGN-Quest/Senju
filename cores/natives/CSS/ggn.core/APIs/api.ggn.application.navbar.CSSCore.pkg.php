 /* Fichier : Gougnon.CSS.framework.cssg, Nom : Gougnon CSS Framework, version 0.0.1.140103.1748, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');




/* NavBar */
$Core->selector('body > .nav-bar'
	, [
		'display'=>['-webkit-flex','flex']
		,'flex-wrap'=>'wrap'
		,'background-color'=> 'rgba('.$Core->styleProperty('font-color-rgb:hover').',.2)' 
		// ,'background-color'=> $Core->styleProperty('dark-background-color') 
		// ,'background-color'=> '' . $Core->styleProperty('background-color') 
		,'border-bottom'=> '5px solid ' . $Core->styleProperty('palette-primary-color') 
		,'cursor'=>'default'
	]
);



/* Smart Menu : Box */
$Core->selector('body > .nav-bar > .smartmenu'
	, [
		'position'=>'absolute'
		,'left && top'=>'0px'
		,'width'=>'320px'
		// ,'width'=>'100vw'
		// ,'min-width'=>'320px'
		// ,'max-width'=>'512px'
		,'height'=>'320px'
		// ,'height'=>'100vh'
		// ,'min-height'=>'280px'
		// ,'max-height'=>'480px'
		,'background-color'=>''.$Core->styleProperty('dark-background-color').''
		,'transition'=>'background-color 0.3s ease-out'
		,'overflow'=>'hidden'
	]
);

$Core->selector('body > .nav-bar > .smartmenu:hover'
	, [
		'overflow-y'=>'auto'
	]
);

$Core->selector('body > .nav-bar > .smartmenu.show'
	, [
		'animation'=>'ggnTranslateYIn 0.3s ease-out'
		,'transform'=>'translateY(0px)'
		,'opacity'=>'1'
	]
);

$Core->selector('body > .nav-bar > .smartmenu.hide'
	, [
		'animation'=>'ggnTranslateYOut 0.3s ease-out'
		,'transform'=>'translateY(-50%)'
		,'opacity'=>'0.0'
	]
);

/* Smart Menu : Items */
$Core->selector('body > .nav-bar > .smartmenu > .items'
	, [
		'flex-wrap'=>'wrap'
		,'height'=>'100%'
		// ,'padding'=>'5px'
	]
);

/* Smart Menu : Items */
$Core->selector('body > .nav-bar > .smartmenu > .items > .item'
	, [
		'width && height'=>'64px'
		,'background-color'=>'rgba(0,0,0,.1)'
		,'margin-top && margin-bottom'=>'2px'
		,'margin-left && margin-right'=>'3px'
		,'background-repeat'=>'no-repeat'
		,'background-position'=>'center'
		,'border-radius'=>'5px'
		,'cursor'=>'pointer'
	]
);

$Core->selector('body > .nav-bar > .smartmenu > .items > .item:hover'
	, [
		'background-color'=>'rgba(0,0,0,.5)'
	]
);



/* Wait Pad */
$Core->selector(
		'body > .nav-bar > .back-pad'
		. ',body > .nav-bar > .wait-pad'
	, [
		'width'=>'40px'
		,'height'=>'inherit'
		,'cursor'=>'pointer'
		,'background-repeat'=>'no-repeat'
		,'background-position'=>'center'
		,'transition'=>'background-color 0.3s ease-in-out'
		,'margin-right'=>'5px'
	]
);

$Core->selector(
		'body > .nav-bar > .back-pad:hover'
		. ',body > .nav-bar > .wait-pad:hover'
	, [
		'background-color'=>$Core->styleProperty('palette-primary-color')
	]
);



/* Wait Pad */
$Core->selector(
		'body > .nav-bar > .wait-pad'
		.',body > .nav-bar > .wait-pad.normal'
	, [
		'background-color'=>'transparent !important'
		,'background-image'=>'url(' . $GAppsPath . 'sync.png'. $GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=16&height=16)'
		,'cursor'=>'default'
	]
);

$Core->selector('body > .nav-bar > .wait-pad.warning', ['background-image'=>'url(' . $GAppsPath . 'sync-warning.png'. $GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=16&height=16)']);

$Core->selector('body > .nav-bar > .wait-pad.error', ['background-image'=>'url(' . $GAppsPath . 'sync-error.png'. $GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=16&height=16)']);


/* Wait Pad : Animate */
$Core->selector('body > .nav-bar > .wait-pad.animate'
	, [
		'animation'=> 'ggnCircleLoading 1s linear infinite'
	]
);



/* Back Pad */
$Core->selector('body > .nav-bar > .back-pad'
	, [
		'background-image'=>'url(' . $GAppsPath . 'back.png'. $GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=25&height=25)'
		,'background-color'=>'rgba(' . $Core->styleProperty('font-color-rgb:hover') . ',.2)'
	]
);

$Core->selector('body > .nav-bar > .back-pad:hover'
	, [
		'background-image'=>'url('.$GAppsPath.'back.png'.$GUI['IMAGE_FILTER_TEXT_COLOR_TONE'].'&width=25&height=25)'
	]
);



/* Menu Pad */
$Core->selector('body > .nav-bar > .menu-pad'
	, [
		'width'=>'40px'
		,'height'=>'inherit'
		,'cursor'=>'pointer'
		,'background-color'=>'transparent'
		,'background-repeat'=>'no-repeat'
		,'background-position'=>'center'
		,'background-image'=>'url(' . $GAppsPath . 'menu-pad.png'. $GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=25&height=25)'
		,'transition'=>'background-color 0.3s ease-in-out'
	]
);

$Core->selector('body > .nav-bar > .menu-pad:hover'
	, [
		'background-color'=>$Core->styleProperty('palette-primary-color')
		,'background-image'=>'url('.$GAppsPath.'menu-pad.png'.$GUI['IMAGE_FILTER_TEXT_COLOR_TONE'].'&width=25&height=25)'
	]
);



/* Logo */
$Core->selector('body > .nav-bar > .icon'
	, [
		'padding'=>'0px 12px 0px 10px'
		// ,'height'=>'inherit'
		,'display'=>'flex'
		,'align-items'=>'left'
		// ,'flex-direction'=>'row'
		// ,'border'=>'0px solid transparent'
		,'transition'=>'background-color 0.25s ease-in-out'
	]
);

$Core->selector('body > .nav-bar > .icon:hover'
	, [
		// 'background-color'=> 'rgba(' . $Core->styleProperty('font-color-rgb:hover') . ',.75)'
		// ,'border-color'=>$Core->styleProperty('palette-primary-color')
	]
);

/* Logo icone */
$Core->selector('body > .nav-bar > .icon > .logo'
	, [
		'padding'=>'0px 0px'
	]
);

$Core->selector('body > .nav-bar > .icon > .logo > img'
	, []
);

/* Logo label */
$Core->selector('body > .nav-bar > .icon > .label'
	, [
		'text-align'=>'left'
		,'padding'=>'9px 0px 9px 5px'
		,'flex'=>'1'
		,'font-size'=>'17px'
		,'color'=>$Core->styleProperty('font-color')
		// ,'font-family'=>$Core->styleProperty('headling-font-family')
	]
);



/* Menu */
$Core->selector('body > .nav-bar > .menu'
	, [
		'display'=>'flex'
		,'flex'=>'1'
		,'padding'=>'0px'
	]
);


/* Menu > Item */
$Core->selector('body > .nav-bar > .menu > a.atem'. ',body > .nav-bar > .menu > a.atem:hover', ['text-decoration'=>'none','border'=>'0px solid'] );


/* Menu > Item */
$Core->selector(
		'body > .nav-bar > .menu > .item'
		. ',body > .nav-bar > .menu > * > .item'
	, [
		'padding'=>'14px 12px'
		,'font-size'=>'13px'
		,'text-decoration'=>'none'
		// ,'font-weight'=>'bold'
		,'color'=>'rgba(' . $Core->styleProperty('font-color-rgb') . ',.99)'
		// ,'font-family'=>$Core->styleProperty('headling-font-family')
		,'transition'=>'background-color 0.3s ease-out'
		,'border-bottom && border-top'=> '0px solid transparent'
	]
);

$Core->selector(
		'body > .nav-bar > .menu > .item.icon'
		. ',body > .nav-bar > .menu > * > .item.icon'
	, [
		'padding-left'=> '35px'
		,'background-repeat'=> 'no-repeat'
		,'background-position'=> '10px center'
	]
);

/* Menu > Item:hover */
$Core->selector(
		'body > .nav-bar > .menu > .item:hover'
		. ',body > .nav-bar > .menu > * > .item:hover'
		. ', body > .nav-bar > .menu > .item.active'
		. ', body > .nav-bar > .menu > * > .item.active'
	, [
		'color'=>$Core->styleProperty('dark-font-color:hover')
		// ,'background-color'=> 'rgba(' . $Core->styleProperty('dark-background-color-rgb:hover') . ',.75)'
		,'background-color'=> 'rgba(' . $Core->styleProperty('font-color-rgb:hover') . ',.75)'
		,'border-top-color'=> $Core->styleProperty('palette-primary-color') 
	]
);

/* Menu > Item.Active */
$Core->selector(
		'body > .nav-bar > .menu > .item.active'
		. ',body > .nav-bar > .menu > * > .item.active'
	, [
		// 'border-bottom && border-top'=> '3px solid transparent'
	]
);



/* barre des notifications */
$Core->selector('body > .nav-bar > .tray'
	, [
		'display'=>'flex'
		,'padding'=>'0px'
		// ,'background-color'=>'yellow'
		,'margin-left'=>'auto'
		,'margin-right'=>'0px'
	]
);

$Core->selector('body > .nav-bar > .tray > .menu-pad-mini'
	, [
		'display'=>'none'
		,'width'=>'35px'
		,'height'=>'inherit'
		,'margin-right'=>'15px'
		// ,'height'=>'100%'
		,'background-color'=>'transparent'
		,'background-image'=>'url('.$GAppsPath.'menu-pad.png'.$GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=25&height=25)'
		,'background-repeat'=>'no-repeat'
		,'background-position'=>'center'
		,'cursor'=>'pointer'
		,'transition'=>'background-color 0.3s ease-in-out'
	]
);

$Core->selector('body > .nav-bar > .tray > .menu-pad-mini:hover'
	, [
		'background-color'=>$Core->styleProperty('palette-primary-color')
		,'background-image'=>'url('.$GAppsPath.'menu-pad.png'.$GUI['IMAGE_FILTER_TEXT_COLOR_TONE'].'&width=25&height=25)'
	]
);


/* barre des notifications > Item */
$Core->selector('body > .nav-bar > .tray > .item'
	, [
		'padding'=>'9px 15px'
		,'font-size'=>'13px'
		,'text-decoration'=>'none'
		// ,'color'=>$Core->styleProperty('dark-font-color')
		,'transition'=>'color 0.3s ease-out'
		,'border-bottom && border-top'=> '3px solid transparent'
	]
);


/* barre des notifications > Item > html */
$Core->selector('body > .nav-bar > .tray > .item.html'
	, [
		'padding'=>'0px'
		,'color'=>'rgba(' . $Core->styleProperty('font-color-rgb') . ',.50)'
		,'min-width'=>'100px'
	]
);

$Core->selector('body > .nav-bar > .tray > .item:last-child', ['margin-right'=>'20px']);

/* barre des notifications > Item */
$Core->selector('body > .nav-bar > .tray > .item.icn'
	, [
		'width && height && max-width && max-height'=>'30px'
		,'padding'=>'10px 5px 0px'
		,'text-align'=>'center'
		,'background-color'=>'transparent'
		,'background-position'=>'center'
		,'background-repeat'=>'no-repeat'
		,'transition'=>'background-color 0.25s ease-in-out'
	]
);

$Core->selector('body > .nav-bar > .tray > .item.icn:hover'
	, [
		'background-color'=>'rgba(' . $Core->styleProperty('font-color-rgb:hover') . ',.50)'
	]
);

/* barre des notifications > Item > icon */
$Core->selector('body > .nav-bar > .tray > .item.icn > img.icon'
	, [
		'max-width && max-height'=>'auto'
	]
);

/* barre des notifications > Item > text */
$Core->selector('body > .nav-bar > .tray > .item.text'
	, [
		// 'color'=> $Core->styleProperty('dark-font-color')
		'color'=>'rgba(' . $Core->styleProperty('font-color-rgb') . ',.50)'
	]
);

$Core->selector('body > .nav-bar > .tray > .item.text.icon'
	, [
		'padding-left'=>'32px'
		,'background-repeat'=>'no-repeat'
		,'background-position'=>'10px center'
	]
);

$Core->selector('body > .nav-bar > .tray > .item.text:hover'
	, [
		'color'=> $Core->styleProperty('dark-font-color')
		,'background-color'=>'rgba(' . $Core->styleProperty('font-color-rgb:hover') . ',.50)'
	]
);

$Core->selector('body > .nav-bar > .tray > .item.text:hover'
	, [
		'color'=>$Core->styleProperty('dark-font-color:hover')
	]
);






/* Tray : menu latteral */
// $Core->selector('.ggn-app-side-tray-menu'
// 	, [
// 		'display'=>'block'
// 		,'position'=>'fixed'
// 		,'top && right'=>'0px'
// 		,'width'=>'225px'
// 		,'height'=>'100%'
// 		,'z-index'=>'999992'
// 		,'background-color'=>$Core->styleProperty('dark-background-color')
// 	]
// );

// $Core->selector('.ggn-app-side-tray-menu.open', ['animation'=>'ggnAppNavBarTrayMenuIn 0.3s ease-out']);
// $Core->selector('.ggn-app-side-tray-menu.close', ['transform'=>'translateX(200%)','animation'=>'ggnAppNavBarTrayMenuOut 0.3s ease-in']);


// /* Fermer */
// $Core->selector('.ggn-app-side-tray-menu > .closer'
// 	, [
// 		'position'=>'absolute'
// 		,'top'=>'0px'
// 		,'left'=>'-85px'
// 		,'padding'=>'10px'
// 		,'font-size'=>'14px'
// 		,'padding-left'=>'30px'
// 		,'background-image'=>'url('.$GAppsPath.'cross.png'. $GUI['IMAGE_FILTER_TEXT_COLOR_TONE'].'&width=10&height=10)'
// 		,'background-color'=>'#be1c1c'
// 		// ,'background-color'=>$Core->styleProperty('dark-background-color')
// 		,'background-repeat'=>'no-repeat'
// 		,'background-position'=>'10px center'
// 		,'cursor'=>'pointer'
// 	]
// );

// $Core->selector('.ggn-app-side-tray-menu > .closer:hover'
// 	, [
// 		'color'=>$Core->styleProperty('font-color')
// 		,'background-color'=>'#f90000'
// 	]
// );


// /* Items */
// $Core->selector('.ggn-app-side-tray-menu > .items'
// 	, [
// 		'padding-top && padding-bottom'=>'10px'
// 		,'height'=>'inherit'
// 		,'overflow'=>'auto'
// 		,'border-top'=>'3px solid ' . $Core->styleProperty('palette-primary-color')
// 	]
// );

// $Core->selector('.ggn-app-side-tray-menu > .items .item'
// 	, [
// 		'padding'=>'10px 15px'
// 		,'margin-left && margin-right'=>'10px'
// 		,'margin-top && margin-bottom'=>'7px'
// 		,'font-size'=>'14px'
// 		,'border-left'=>'5px solid ' . $Core->styleProperty('palette-primary-color')
// 		,'transition'=>'background-color 0.3s ease-out'
// 	]
// );

// $Core->selector('.ggn-app-side-tray-menu > .items .item.icon'
// 	, [
// 		'padding-left'=>'35px'
// 		,'background-repeat'=>'no-repeat'
// 		,'background-position'=>'10px center'
// 	]
// );

// $Core->selector('.ggn-app-side-tray-menu > .items .item:hover'
// 	, [
// 		'color'=>$Core->styleProperty('font-color')
// 		,'background-color'=>'rgba('.$Core->styleProperty('font-color-rgb:hover').',.8)'
// 	]
// );



// /* Animations Tray Menu */
// $Core->keyframes('ggnAppNavBarTrayMenuIn'
// 	, 
// 		'{0%{'
// 			. $Core::browserKey('transform','translateX(100%)') 
// 			. $Core::browserKey('opacity','0.0') . 
// 		'} 100%{' 
// 			. $Core::browserKey('transform','translateX(0px)') 
// 			. $Core::browserKey('opacity','1') . 
// 		'} }'
// 	, true
// );

// $Core->keyframes('ggnAppNavBarTrayMenuOut'
// 	, 
// 		'{0%{'
// 			. $Core::browserKey('transform','translateX(20%)') 
// 			. $Core::browserKey('opacity','1') . 
// 		'} 100%{' 
// 			. $Core::browserKey('transform','translateX(200%)') 
// 			. $Core::browserKey('opacity','0.0') . 
// 		'} }'
// 	, true
// );






/* Menu : menu latteral */
$Core->selector('.ggn-app-float-menu-normal'
	, [
		'display'=>'block'
		,'position'=>'fixed'
		,'top && right'=>'0px'
		,'width && height'=>'100%'
		,'z-index'=>'999993'
		,'background-color'=>'rgba(' . $Core->styleProperty('dark-background-color-rgb') . ',.75)'
	]
);

$Core->selector('.ggn-app-float-menu-normal.open', ['animation'=>'ggnAppNavBarMenuNormalIn 0.3s ease-out']);
$Core->selector('.ggn-app-float-menu-normal.close', ['transform'=>'translateX(100%)','animation'=>'ggnAppNavBarMenuNormalOut 0.25s ease-in']);


/* Fermer */
$Core->selector('.ggn-app-float-menu-normal > a'
	, [
		'position'=>'absolute'
		,'top && right'=>'0px'
	]
);

$Core->selector('.ggn-app-float-menu-normal > a > .closer'
	, [
		'padding'=>'10px'
		,'font-size'=>'14px'
		,'padding-left'=>'30px'
		,'background-image'=>'url('.$GAppsPath.'cross.png'. $GUI['IMAGE_FILTER_TEXT_COLOR_TONE'].'&width=10&height=10)'
		// ,'background-color'=>'#be1c1c'
		// ,'background-color'=>$Core->styleProperty('dark-background-color')
		,'background-repeat'=>'no-repeat'
		,'background-position'=>'10px center'
	]
);

$Core->selector('.ggn-app-float-menu-normal > a > .closer:hover'
	, [
		'color'=>$Core->styleProperty('font-color')
		,'background-color'=>'#f90000'
	]
);


/* Tray */
$Core->selector('.ggn-app-float-menu-normal > .content'
	, [
		'width && height'=>'100%'
		,'flex-direction'=>'column'
	]
);


/* Titre */
$Core->selector('.ggn-app-float-menu-normal > .content > .title'
	, [
		'padding'=>'10px 15px'
		,'font-size'=>'30px'
		,'font-family'=>$Core->styleProperty('headling-fontLight-family')
	]
);

$Core->selector('.ggn-app-float-menu-normal > .content > .title:after'
	, [
		'content'=>'"Menu"'
	]
);


/* Tray */
$Core->selector('.ggn-app-float-menu-normal > .content > .tools'
	, [
		'flex-direction'=>'row'
		,'overflow'=>'hidden'
		,'overflow-x'=> ($GUI['is.mobile']===true)?'auto':'hidden'
		,'border-top'=>'1px solid rgba(' . $Core->styleProperty('background-color-rgb') . ',.5)'
	]
);

$Core->selector('.ggn-app-float-menu-normal > .content > .tools:hover'
	, [
		'overflow-x'=>'auto'
	]
);

$Core->selector('.ggn-app-float-menu-normal > .content > .tools > .tray'
	, [
		'display'=>['-webkit-flex', 'flex']
		,'flex-direction'=>'row'
		// ,'width'=>'100%'
		,'padding'=>'10px 15px'
		,'margin-left'=>'auto'
	]
);

$Core->selector('.ggn-app-float-menu-normal > .content > .tools > .tray a ', ['text-decoration'=>'none']);

$Core->selector('.ggn-app-float-menu-normal > .content > .tools > .tray .item'
	, [
		'padding'=>'10px 15px 7px'
		,'margin-left && margin-right'=>'2px'
		,'border-radius'=>'3px'
		,'transition'=>'background-color 0.3s ease-out'
	]
);

$Core->selector('.ggn-app-float-menu-normal > .content > .tools > .tray .item:hover'
	, [
		'background-color'=>'rgba(' . $Core->styleProperty('font-color-rgb:hover') . ',.2)'
	]
);



/* Items */
$Core->selector('.ggn-app-float-menu-normal > .content > .items'
	, [
		'flex'=>'1 auto'
		,'overflow'=>'hidden'
		,'overflow-y'=> ($GUI['is.mobile']===true)?'auto':'hidden'
	]
);

$Core->selector('.ggn-app-float-menu-normal > .content > .items:hover'
	, [
		'overflow-y'=> 'auto'
	]
);

$Core->selector('.ggn-app-float-menu-normal > .content > .items > .menu'
	, [
		'display'=>['-webkit-flex', 'flex']
		,'flex-direction'=>'row'
		,'flex-wrap'=>'wrap'
		,'justify-content'=>'center'
		,'align-items'=>'center'
		,'width'=>'100%'
	]
);

$Core->selector('.ggn-app-float-menu-normal > .content > .items > .menu a'
	, [
		'text-decoration'=>'none'
	]
);

$Core->selector('.ggn-app-float-menu-normal > .content > .items > .menu .item'
	, [
		'padding'=>'35px 10px 10px'
		,'font-size'=>'14px'
		,'margin'=>'auto'
		,'background-position'=>'center 15px'
		,'transition'=>'background-color 0.3s ease-out'
		,'border-radius'=>'3px'
	]
);

$Core->selector('.ggn-app-float-menu-normal > .content > .items > .menu .item:hover'
	, [
		'background-color'=>'rgba('.$Core->styleProperty('font-color-rgb:hover').',.8)'
	]
);

// $Core->selector('.ggn-app-float-menu-normal > .items .item:hover'
// 	, [
// 		'color'=>$Core->styleProperty('font-color')
// 	]
// );

// $Core->selector('.ggn-app-float-menu-normal > .items .item.icon'
// 	, [
// 		'padding-left'=> '32px'
// 		,'background-repeat'=> 'no-repeat'
// 		,'background-position'=> '10px center'
// 	]
// );



/* Animations Menu Normal */
$Core->keyframes('ggnAppNavBarMenuNormalIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','translateX(100%)') 
			. $Core::browserKey('opacity','0.0') . 
		'} 100%{' 
			. $Core::browserKey('transform','translateX(0px)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);

$Core->keyframes('ggnAppNavBarMenuNormalOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','translateX(0px)') 
			. $Core::browserKey('opacity','1') . 
		'} 100%{' 
			. $Core::browserKey('transform','translateX(100%)') 
			. $Core::browserKey('opacity','0.0') . 
		'} }'
	, true
);










/* ================ OPTION ===== Responsivité ================================== */
if($GUI['option.responsive']===true){


	$Core->openMedia(' (max-width: 980px) ');

		$Core->selector('body > .nav-bar > .menu-pad', ['display'=>'block'] );
		$Core->selector('body > .nav-bar > .menu > .item'. ',body > .nav-bar > .menu > * > .item', ['display'=>'none'] );

		$Core->selector('body > .nav-bar > .tray > .menu-pad-mini', ['display'=>'block'] );

		$Core->selector('body > .nav-bar > .tray > .item', ['display'=>'none'] );

	$Core->closeMedia();
	
}







$Core->selector('body > .nav-bar > .menu-pad.disable' . ',body > .nav-bar > .tray > .menu-pad-mini.disable', ['display'=>'none'] );


?>