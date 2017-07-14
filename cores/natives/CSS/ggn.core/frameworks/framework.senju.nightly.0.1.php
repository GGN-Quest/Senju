<?php


	/* PARAMETRES */

	require self::commonFile('.settings');

	require self::commonFile('.functions');


	$Core->Code('/* Fichier : Gougnon.CSS.framework.cssg, Nom : Gougnon CSS Framework, version Senju 0.0.1 / 170103.1420, site: http://gougnon.com , Copyright 2017 GOBOU Y. Yannick */');





/* Non Conditionné //////////////////////////////////////////////////////////////////////////// / DEBUT */



/* Selector */
$__Selector = [

	'color'=>$Core->LDColor($Core->styleProperty('palette-light-color'), 30)

	,'background-color'=>$Core->LDColor($Core->styleProperty('palette-primary-color'), -35)

];


$Core->selector('::-moz-selection', $__Selector );

$Core->selector('::-webkit-selection', $__Selector );

$Core->selector('::selection', $__Selector );







/*

	ICONS // DEBUT ////////////////////

*/

	/* Dimension */

	$Core->selector('[class*="icon"].auto-size', ['font-size'=>'85%']);
	
	$Core->selector('[class*="icon"].half-size', ['font-size'=>'50%']);
	
	$Core->selector('[class*="icon"].min-size', ['font-size'=>'16px']);
	
	$Core->selector('[class*="icon"].n-size', ['font-size'=>'25px']);
	
	$Core->selector('[class*="icon"].max-size', ['font-size'=>'32px']);
	
	$Core->selector('[class*="icon"].max-size', ['font-size'=>'32px']);



	/* Couleur */

	$Core->selector('[class*="icon"].normal'.',[class*="icon"].static-normal'.',[class*="icon"].color:hover', ['fill && color'=> $Core->styleProperty('font-color') ] );

	$Core->selector('[class*="icon"].normal:hover'.',[class*="icon"].color'.',[class*="icon"].static-color', ['fill && color'=>$Core->styleProperty('palette-primary-color') ] );

	$Core->selector('[class*="icon"].dark'.',[class*="icon"].static-dark'.',[class*="icon"].light:hover', ['fill && color'=>$GUI['DARK_TONE'] ] );

	$Core->selector('[class*="icon"].light'.',[class*="icon"].static-light'. ',[class*="icon"].dark:hover', ['fill && color'=>$GUI['LIGHT_TONE'] ] );

	$Core->selector('[class*="icon"].pattern'.',[class*="icon"].static-pattern'. ',[class*="icon"].dark-pattern:hover', ['fill && color'=>$Core->styleProperty('background-color') ] );

	$Core->selector('[class*="icon"].dark-pattern'.',[class*="icon"].static-dark-pattern'. ',[class*="icon"].pattern:hover', ['fill && color'=>$Core->styleProperty('dark-background-color') ] );


/*

	ICONS // FIN ////////////////////

*/







/* DIMENSIONS LARGEUR-HAUTEUR PREFINIES */
// foreach ($GUI['size'] as $k => $size) 

$Core->selector('.x12-min,.x12-w-min', ['width'=>'12px']);

$Core->selector('.x12-min,.x12-h-min', ['height'=>'12px']);

$Core->selector('.x12,.x12-w', ['width'=>'12px']);

$Core->selector('.x12,.x12-h', ['height'=>'12px']);

$Core->selector('.gui[class~="-icon"].x12', ['font-size'=>'12px']);


for ($kx=16; $kx<=1024; $kx+=16) {

	$Core->selector('[class*="icon"].x' . $kx , ['font-size'=>$kx . 'px']);


	$Core->selector('.x' . $kx . ',.x' . $kx . '-w' , ['width'=>$kx . 'px']);
	
	$Core->selector('.x' . $kx . ',.x' . $kx . '-h' , ['height'=>$kx . 'px']);


	$Core->selector('.x' . $kx . '-min' . ',.x' . $kx . '-w-min' , ['min-width'=>$kx . 'px']);
	
	$Core->selector('.x' . $kx . '-min' . ',.x' . $kx . '-h-min' , ['min-height'=>$kx . 'px']);


	$Core->selector('.x' . $kx . '-max' . ',.x' . $kx . '-w-max' , ['max-width'=>$kx . 'px']);
	
	$Core->selector('.x' . $kx . '-max' . ',.x' . $kx . '-h-max' , ['max-height'=>$kx . 'px']);

}











/* ============= Initialisation des balises */
$Core->selector('html, body, div, span, object, iframe, q, dl, dt, dd, ol, ul, li, a, abbr, acronym, address, code, h1, h2, h3, h4, h5, h6, p, blockquote, pre, fieldset, form, label, legend, del, dfn, em, img, table, caption, tbody, tfoot, thead, tr, th, td'

	, [

		'padding && margin && border'=>'0px'

		, 'font-weight && font-style && font-family'=>'inherit'

	]

);

$Core->selector('table', ['border-collapse'=>'separate','border-spacing'=>'0']);

$Core->selector('caption, th, td', ['font-weight'=>'normal','text-align'=>'left']);

$Core->selector('table, td, th', ['vertical-align'=>'middle']);

$Core->selector('a img', ['border'=>'none', 'outline'=>'none']);

// $Core->selector('img', ['padding'=>'5px']);





/* ============= Dimension : Largeur */
$Core->selector('._11', ['width'=>'100%']);

$Core->selector('._34', ['width'=>'75%']);

$Core->selector('._23', ['width'=>'66.666%']);

$Core->selector('._12', ['width'=>'50%']);

$Core->selector('._14', ['width'=>'25%']);

$Core->selector('._13', ['width'=>'33.333%']);

$Core->selector('._15', ['width'=>'20%']);

$Core->selector('.w-inherit', ['width'=>'inherit']);

$Core->selector('.w-auto', ['width'=>'auto']);

$Core->selector('.h-inherit', ['height'=>'inherit']);

$Core->selector('.h-auto', ['height'=>'auto']);


for($x=0; $x<=10; $x++){

	$pXx = ($x/10)*100;

	$Core->selector('._w' . $x, ['width'=>''.($pXx).'%']);
	
	$Core->selector('._h' . $x, ['height'=>''.($pXx).'%']);
	
	$Core->selector('.vw' . $x, ['width'=>''.($pXx).'vw']);
	
	$Core->selector('.vh' . $x, ['height'=>''.($pXx).'vh']);
	
	$Core->selector('.wh' . $x, ['width'=>''.($pXx).'vw', 'height'=>''.($pXx).'vh']);
	

	
	$Core->selector('._w' . $x .'-min', ['min-width'=>''.($pXx).'%']);
	
	$Core->selector('._h' . $x .'-min', ['min-height'=>''.($pXx).'%']);
	
	$Core->selector('.vw' . $x .'-min', ['min-width'=>''.($pXx).'vw']);
	
	$Core->selector('.vh' . $x .'-min', ['min-height'=>''.($pXx).'vh']); 
	
	$Core->selector('.wh' . $x .'-min', ['min-width'=>''.($pXx).'vw', 'min-height'=>''.($pXx).'vh']);



	$Core->selector('.gui._w' . $x .'-max', ['max-width'=>''.($pXx).'%']); 

	$Core->selector('.gui._h' . $x .'-max', ['max-height'=>''.($pXx).'%']);

	$Core->selector('.gui.vw' . $x .'-max', ['max-width'=>''.($pXx).'vw']);

	$Core->selector('.gui.vh' . $x .'-max', ['max-height'=>''.($pXx).'vh']);

	$Core->selector('.gui.wh' . $x .'-max', ['max-width'=>''.($pXx).'vw', 'max-height'=>''.($pXx).'vh']);


}

















/* 
	Opacité // DEBUT -------------------
*/
	$Core->selector('.opacity-cancel', ['opacity'=> '1']);

for($opx=0; $opx<100; $opx+=10){

	$Core->selector('.opacity-x' . $opx, ['opacity'=> '0.' . $opx]);
	
}
/* 
	Opacité // FIN -------------------
*/

















/* 
	Affichages // DEBUT -------------------
*/


	$Core->selector('.disable', ['display'=>'none !important'] );

	$Core->selector('.enable', ['display'=>'block !important'] );


	$GUI['Property.Display.ForEach']('.enable-');
	

	// $Core->selector('[class*="-disable"]', ['display'=>'none'] );

	// $Core->selector('[class*="-enable"]', ['display'=>'block'] );



// enable-
/* 
	Affichages // FIN -------------------
*/











	
/* 
	Flex // DEBUT ======================================
*/

$Core->selector(
		'.gui.space'
		. ',.gui.flex'

	, [

		'display'=> ['-webkit-flex', 'flex']

	]

);

$Core->selector('.gui.space.center'. ',.gui.flex.center', ['align-items'=>'center','justify-content'=>'center'] );


$Core->selector('.gui.flex.row', ['flex-direction'=>'row']);

$Core->selector('.gui.flex.row-rev', ['flex-direction'=>'row-reverse']);

$Core->selector('.gui.flex.column', ['flex-direction'=>'column']);

$Core->selector('.gui.flex.column-rev', ['flex-direction'=>'column-reverse']);

$Core->selector(
	
		'.gui.space.full'
	
		. ',.gui.flex.full'

	, [

		'width && height'=>'100%'

	]

);

$Core->selector('.gui.flex > .align-center', ['margin'=>'auto']);
$Core->selector('.gui.flex > .align-bottom', ['margin-top'=>'auto']);
$Core->selector('.gui.flex > .align-top', ['margin-bottom'=>'auto']);
$Core->selector('.gui.flex > .align-left', ['margin-right'=>'auto']);
$Core->selector('.gui.flex > .align-right', ['margin-left'=>'auto']);

$Core->selector('.gui.flex > .align-vertical', ['margin-top && margin-bottom'=>'auto']);
$Core->selector('.gui.flex > .align-horizontal', ['margin-left && margin-right'=>'auto']);


$Core->selector('.gui.flex.start', ['justify-content'=>'flex-start']);
$Core->selector('.gui.flex.end', ['justify-content'=>'flex-end']);
$Core->selector('.gui.flex.center', ['justify-content'=>'center']);
$Core->selector('.gui.flex.space-between', ['justify-content'=>'space-between']);
$Core->selector('.gui.flex.space-around', ['justify-content'=>'space-around']);


$Core->selector('.gui.flex.align-items-start', ['align-items'=>'flex-start']);
$Core->selector('.gui.flex.align-items-end', ['align-items'=>'flex-end']);
$Core->selector('.gui.flex.align-items-center', ['align-items'=>'flex-center']);
$Core->selector('.gui.flex.align-items-baseline', ['align-items'=>'flex-baseline']);
$Core->selector('.gui.flex.align-items-stretch', ['align-items'=>'flex-stretch']);


$Core->selector('.gui.flex.wrap', ['flex-wrap'=>'wrap']);
$Core->selector('.gui.flex.nowrap', ['flex-wrap'=>'nowrap']);
$Core->selector('.gui.flex.wrap-reverse', ['flex-wrap'=>'wrap-reverse']);


// $Core->selector('.flex-order-1', ['order'=>'1']);
// $Core->selector('.flex-order-2', ['order'=>'2']);
// $Core->selector('.flex-order-3', ['order'=>'3']);
// $Core->selector('.flex-order-4', ['order'=>'4']);
// $Core->selector('.flex-order-5', ['order'=>'5']);

for ($flx=0; $flx <= 16; $flx++) {

	$Core->selector('.flex-order-' . $flx, ['order'=>'' . $flx . '']);

}


/* 
	Flex // FIN ======================================
*/










/* ============= Positionnement */
foreach (explode(' ', 'static relative fixed absolute sticky inherit') as $pos) {

	$Core->selector('.gui.pos-'.$pos.'' . ',.gui.pos-'.substr($pos, 0, 3).'', ['position'=>$pos]);

	$Core->selector('.gui.pos-'.$pos.'-i' . ',.gui.pos-'.substr($pos, 0, 3).'-i', ['position'=>$pos . ' !important']);

}










/* ============= Background */
	$Core->selector('.background-abs-center,.bg-abs-center',[
	
	 		'background-repeat'=>'no-repeat'
	
			,'background-position'=>'center'
	
		]
	
	);

	$Core->selector('.bg-full-x-size',['background-size'=>'100% auto'] );

	$Core->selector('.bg-full-y-size',['background-size'=>'auto 100%'] );

	$Core->selector('.no-bg', ['background'=>'none'] );

	$Core->selector('.no-bg-color', ['background-color'=>'transparent'] );

	$Core->selector('.no-bg-repeat', ['background-repeat'=>'auto'] );
	
	$Core->selector('.no-bg-position', ['background-position'=>'none'] );

	$Core->selector('.no-bg-attachment', ['background-attachment'=>'none'] );
	











/* 
	Cursor // DEBUT ----------------------

*/

foreach (explode(' ', 'alias all-scroll auto cell context-menu col-resize copy crosshair default e-resize ew-resize grab grabbing help move n-resize ne-resize nesw-resize ns-resize nw-resize nwse-resize no-drop none not-allowed pointer progress row-resize s-resize se-resize sw-resize text vertical-text w-resize wait zoom-in zoom-out initial inherit') as $kxcur => $cursor) {

	$Core->selector('.cursor-' . $cursor, ['cursor'=>$cursor ] );
	
}

/* 
	Cursor // FIN ----------------------

*/










/* ============= Scrollbar */
$Core->selector('.auto-scrollbar',['overflow'=>'auto'] );

$Core->selector('.disable-scrollbar',['overflow'=>'hidden'] );

$Core->selector('.enable-scrollbar',['overflow'=>'scroll'] );

$Core->selector('.enable-y-auto-scrollbar',['overflow-y'=>'auto'] );

$Core->selector('.enable-x-auto-scrollbar',['overflow-x'=>'auto'] );

$Core->selector('.enable-y-scrollbar',['overflow-y'=>'scroll'] );

$Core->selector('.enable-x-scrollbar',['overflow-x'=>'scroll'] );

$Core->selector('.enable-only-y-scrollbar',['overflow'=>'hidden','overflow-y'=>'scroll'] );

$Core->selector('.enable-only-x-scrollbar',['overflow'=>'hidden','overflow-x'=>'scroll'] );

$Core->selector('.disable-y-scrollbar',['overflow-y'=>'hidden'] );

$Core->selector('.disable-x-scrollbar',['overflow-x'=>'hidden'] );

$Core->selector('.disable-only-y-scrollbar',['overflow'=>'scroll','overflow-y'=>'hidden'] );

$Core->selector('.disable-only-x-scrollbar',['overflow'=>'scroll','overflow-x'=>'hidden'] );



$Core->selector('.enable-y-scrollbar-hover',['overflow-y'=>'hidden'] );

$Core->selector('.enable-y-scrollbar-hover:hover',['overflow-y'=>'auto'] );

$Core->selector('.enable-x-scrollbar-hover',['overflow-x'=>'hidden'] );

$Core->selector('.enable-x-scrollbar-hover:hover',['overflow-x'=>'auto'] );


$Core->selector('.scroll-on-mobile', ['overflow'=>($GUI['is.mobile']===true) ? 'auto !important':'initial']);

$Core->selector('.y-scroll-on-mobile', ['overflow-y'=>($GUI['is.mobile']===true) ? 'auto !important':'initial']);

$Core->selector('.x-scroll-on-mobile', ['overflow-x'=>($GUI['is.mobile']===true) ? 'auto !important':'initial']);









/* ============= Text */
$Core->selector('.text-left',['text-align'=>'left'] );

$Core->selector('.text-center',['text-align'=>'center'] );

$Core->selector('.text-right',['text-align'=>'right'] );

$Core->selector('.text-justify',['text-align'=>'justify','text-justify'=>'initial'] );



$Core->selector('.text-thin',['font-family'=>$Core->styleProperty('font-family-thin')] );

$Core->selector('.text-light',['font-family'=>$Core->styleProperty('font-family-light')] );

$Core->selector('.text-regular',['font-family'=>$Core->styleProperty('font-family-regular')] );

$Core->selector('.text-bold',['font-family'=>$Core->styleProperty('font-family-bold')] );

$Core->selector('.text-black',['font-family'=>$Core->styleProperty('font-family-black')] );



$Core->selector('.text-clip',['white-space'=>'nowrap','overflow'=>'hidden','text-overflow'=>'clip'] );

$Core->selector('.text-ellipsis',['white-space'=>'nowrap','overflow'=>'hidden','text-overflow'=>'ellipsis'] );

	$Core->selector('.text-ellipsis-multiline,[class*="text-ellipsis-multiline-"]'
		, [
			'overflow'=>'hidden'
			, 'text-overflow'=>'ellipsis'
			, 'display'=>['-webkit-box', '-moz-box', 'box']
			, 'line-clamp'=>'3'
			, 'box-orient'=>'vertical'
		]
	);

	for ($temlx=0; $temlx < 10; $temlx++) {$Core->selector('.text-ellipsis-multiline-' . $temlx	, ['line-clamp'=>$temlx]); }

		



$Core->selector('.text-weight-normal',['font-weight'=>'normal'] );

$Core->selector('.text-bold',['font-weight'=>'bold'] );

$Core->selector('.text-uppercase,.text-upper',['text-transform'=>'uppercase'] );

$Core->selector('.text-lowercase,.text-lower',['text-transform'=>'lowercase'] );


$Core->selector('.text-upper-first:first-letter',['text-transform'=>'uppercase'] );

$Core->selector('.text-lower-first:first-letter',['text-transform'=>'lowercase'] );


$Core->selector('.text-spacing-ext',['letter-spacing'=>'2.0em'] );

$Core->selector('.text-spacing-plus',['letter-spacing'=>'0.1em'] );

$Core->selector('.text-spacing-minus',['letter-spacing'=>'-0.1em'] );

$Core->selector('.text-spacing-ml',['letter-spacing'=>'-0.04em'] );


$Core->selector('.text-normal',['font-style'=>'normal'] );

$Core->selector('.text-italic',['font-style'=>'italic'] );

$Core->selector('.text-oblique ',['font-style'=>'oblique'] );
















/* ============= Extra : Code */
$Core->selector('.gui.pre-code'
	,[
		// 'overflow-wrap && word-wrap'=>'break-word'
		'background-color'=> '#282828'
		,'width'=> 'inherit'
		,'overflow'=> 'hidden'
		,'overflow-x'=> 'auto'
		,'font-size'=> '14px'
		,'padding'=> '7px 15px'
	]
);

$Core->selector('.gui.pre-code.mini'
	,[
		'background-color'=> 'rgba(10,10,10,.62)'
		,'border-radius'=> '3px'
		,'padding'=> '2px 7px'
		,'box-shadow'=> '0px 0px 5px #000 inset'
	]
);


$Core->selector('.gui.pre-code ::-moz-selection', ['color'=>'#aaa' ,'background-color'=>'#555' ] );
$Core->selector('.gui.pre-code ::-webkit-selection', ['color'=>'#aaa' ,'background-color'=>'#555' ] );
$Core->selector('.gui.pre-code ::selection', ['color'=>'#aaa' ,'background-color'=>'#555' ] );

$Core->selector('.gui.pre-code > .tools',['right && top'=> '0px','padding'=>'5px 15px']);

	$Core->selector('.gui.pre-code > .tools .tool'
		,[
			'right && top'=> '0px'
			,'padding'=>'5px 10px'
			,'color'=>'#999'
			,'background-color'=>'rgba(0,0,0,.2)'
			,'transition'=>'color,background-color, 0.3s ease'
		]
	);

	$Core->selector('.gui.pre-code > .tools .tool:hover'
		,[
			'color'=>'#ffffff'
			,'background-color'=>'#ff4800'
		]
	);

$Core->selector('.gui.pre-code > .content',['r'=> '0px']);

$Core->selector('.gui.pre-code,.gui.pre-code .txt',['color'=> '#efefef']);
$Core->selector('.gui.pre-code .font-italic',['font-style'=>'italic']);
$Core->selector('.gui.pre-code .html-doctype',['color'=>'#999']);
$Core->selector('.gui.pre-code .html-comment',['color'=>'#777']);
$Core->selector('.gui.pre-code .html-tag',['color'=>'#ff3800']);
$Core->selector('.gui.pre-code .html-tag-attrs',['color'=>'#ff7900']);
$Core->selector('.gui.pre-code .html-tag-attr-name',['color'=>'#00c289']);
$Core->selector('.gui.pre-code .html-tag-attr-value',['color'=>'#d59c03']);











/* ============= Entete */
$Core->selector(
		'h1,.h1:not(.no-ff)'
		.',h2,.h2:not(.no-ff)'
		.',h3,.h3:not(.no-ff)'
		.',h4,.h4:not(.no-ff)'
		.',h5,.h5:not(.no-ff)'
		.',h6,.h6:not(.no-ff)'
		.',.xh1:not(.no-ff)'
		.',.xh2:not(.no-ff)'
		.',.xh3:not(.no-ff)'
		.',.xh4:not(.no-ff)'
		.',.xh5:not(.no-ff)'
		.',.xh6:not(.no-ff)'
		.',.xxh1:not(.no-ff)'
		.',.xxh2:not(.no-ff)'
		.',.xxh3:not(.no-ff)'
		.',.xxh4:not(.no-ff)'
		.',.xxh5:not(.no-ff)'
		.',.xxh6:not(.no-ff)'

	,['font-family'=>$Core->styleProperty('headling-fontLight-family')]
);

$Core->selector('h1,.h1',['font-size'=>'40px'] );

$Core->selector('h2,.h2',['font-size'=>'36px'] );

$Core->selector('h3,.h3',['font-size'=>'32px'] );

$Core->selector('h4,.h4',['font-size'=>'28px'] );

$Core->selector('h5,.h5',['font-size'=>'24px'] );

$Core->selector('h6,.h6',['font-size'=>'20px'] );

	$Core->selector(
			'h1 ~ h2'
			.',h1 ~ h3'
			.',h1 ~ h4'
			.',h1 ~ h5'
			.',h1 ~ h6'
		,[
			'padding-left && padding-right'=>'1px'
		]
	);


/* Plus Grand */
$Core->selector('.xh1',['font-size'=>'128px'] );

$Core->selector('.xh2',['font-size'=>'112px'] );

$Core->selector('.xh3',['font-size'=>'96px'] );

$Core->selector('.xh4',['font-size'=>'80px'] );

$Core->selector('.xh5',['font-size'=>'64px'] );

$Core->selector('.xh6',['font-size'=>'48px'] );


/* Très Grand */
$Core->selector('.xxh1',['font-size'=>'270px'] );

$Core->selector('.xxh2',['font-size'=>'238px'] );

$Core->selector('.xxh3',['font-size'=>'206px'] );

$Core->selector('.xxh4',['font-size'=>'174px'] );

$Core->selector('.xxh5',['font-size'=>'142px'] );

$Core->selector('.xxh6',['font-size'=>'144px'] );







/* ============= Paragraphe */
$Core->selector('p',['font-size'=>'inherit'] );








/* ============= Liste */
$Core->selector('ul',['margin'=>'5px 12px'] );

$Core->selector('ul > li',[

	'margin-left'=>'12px'

	, 'font-size'=>'inherit'

] );









/* ============= Box */
$Core->selector('.gui.box'
	, [
		'margin'=>'0.5%'
	]
);

$Core->selector('.gui.box.txt'
	, [
		'padding'=>'10px 15px'
	]
);

$Core->selector('.gui.box > .title,.gui.box .box.more'
	, [
		'padding'=>'7px 12px'
	]
);

$Core->selector('.gui.box > .about'
	, [
		'padding'=>'5px 12px'
	]
);

$Core->selector('.gui.box > .content'
	, [
		'padding'=>'10px 12px'
	]
);


$Core->selector('.gui.box.info'
	, [
		'background'=>$Core->styleProperty('notice-background-color')
		,'color'=>$Core->styleProperty('notice-font-color')
	]
);


$Core->selector('.gui.box.wait'
	, [
		'background-color'=>$Core->styleProperty('notice-wait-background-color')
		,'color'=>$Core->styleProperty('notice-wait-color')
		,'font-style'=>'italic'
	]
);


$Core->selector('.gui.box.warning'
	, [
		'background'=>$Core->styleProperty('notice-warning-background-color')
		,'color'=>$Core->styleProperty('notice-warning-color')
	]
);


$Core->selector('.gui.box.error'
	, [
		'background'=>$Core->styleProperty('notice-error-background-color')
		,'color'=>$Core->styleProperty('notice-error-color')
	]
);


$Core->selector('.gui.box.success'
	, [
		'background'=>$Core->styleProperty('notice-success-background-color')
		,'color'=>$Core->styleProperty('notice-success-color')
	]
);






/* 

	Utils : Bordures : Style // DEBUT

*/

foreach (explode(' ', 'dotted dashed solid double groove ridge inset outset none hidden') as $t) {

	$Core->selector('.border-style-' . $t, ['border-style' => $t]);

}

/* 

	Utils : Bordures : Style // FIN

*/







/* 

	Utils : Bordures : Color // DEBUT

*/


	/* Couleurs des Palettes // DEBUT */

	foreach (explode(' ', 'primary secondary tertiary quartenary light dark') as $t) {

		$Core->selector('.border-color-' . $t . '-l', ['border-color' => $Core->LDColor( $Core->styleProperty('palette-' . $t . '-color'), $GUI['STANDARD-COLOR-VARIANT'] ) ]);

		$Core->selector('.border-color-' . $t, ['border-color' => $Core->styleProperty('palette-' . $t . '-color') ]);

		$Core->selector('.border-color-' . $t . '-d', ['border-color' => $Core->LDColor( $Core->styleProperty('palette-' . $t . '-color'), -1 * $GUI['STANDARD-COLOR-VARIANT'] ) ]);

	}

	/* Couleurs des Palettes // FIN */


	/* Couleurs des Notices // DEBUT */

	foreach (explode(' ', 'error wait success warning') as $t) {

		$Core->selector('.border-color-' . $t . '-l', ['border-color' => $Core->LDColor( $Core->styleProperty('notice-' . $t . '-color'), $GUI['STANDARD-COLOR-VARIANT'] ) ]);

		$Core->selector('.border-color-' . $t, ['border-color' => $Core->styleProperty('notice-' . $t . '-color') ]);

		$Core->selector('.border-color-' . $t . '-d', ['border-color' => $Core->LDColor( $Core->styleProperty('notice-' . $t . '-color'), -1 * $GUI['STANDARD-COLOR-VARIANT'] ) ]);

	}

	/* Couleurs des Notices // FIN */


/* 

	Utils : Bordures : Color // FIN

*/







/* 

	Indexer

*/
// $Core->selector('[class*=" indexer-"],[class^="indexer-"]'

// 	, [

// 		'width'=>'16px'

// 		,'height'=>'12px'

// 	]

// );


// foreach (explode(' ', 'top bottom') as $t) {
	
// 	$Core->selector('.indexer-'.$t.'-light', ['background-image'=>'url(' . HTTP_HOST . 'indexer-'.$t.'.png' . $GUI['IMAGE_FILTER_LIGHT_TONE'] . ')']);
	
// 	$Core->selector('.indexer-'.$t.'-gray', ['background-image'=>'url(' . HTTP_HOST . 'indexer-'.$t.'.png' . $GUI['IMAGE_FILTER_GRAY_TONE'] . ')']);
	
// 	$Core->selector('.indexer-'.$t.'-dark', ['background-image'=>'url(' . HTTP_HOST . 'indexer-'.$t.'.png' . $GUI['IMAGE_FILTER_DARK_TONE'] . ')']);
	
// 	$Core->selector('.indexer-'.$t.'-text-color', ['background-image'=>'url(' . HTTP_HOST . 'indexer-'.$t.'.png' . $GUI['IMAGE_FILTER_TEXT_COLOR_TONE'] . ')']);
	
// 	$Core->selector('.indexer-'.$t.'-color', ['background-image'=>'url(' . HTTP_HOST . 'indexer-'.$t.'.png' . $GUI['IMAGE_FILTER_TEXT_HOVER_TONE'] . ')']);
	
// 	$Core->selector('.indexer-'.$t.'-normal', ['background-image'=>'url(' . HTTP_HOST . 'indexer-'.$t.'.png' . $GUI['IMAGE_FILTER_NORMAL_PATTERN_TONE'] . ')']);
	
// 	$Core->selector('.indexer-'.$t.'-darkp', ['background-image'=>'url(' . HTTP_HOST . 'indexer-'.$t.'.png' . $GUI['IMAGE_FILTER_DARK_PATTERN_TONE'] . ')']);

// }











/* ============= LIEN "a" */
$Core->selector('a:link', ['text-decoration'=>'none', 'color'=>$Core->styleProperty('palette-primary-color') ]);

$Core->selector('a:visited', ['text-decoration'=>'none', 'color'=>$Core->styleProperty('palette-secondary-color') ]);

$Core->selector('a:hover' . ',a.underline', ['text-decoration'=>'underline', 'color'=>$Core->styleProperty('palette-secondary-color') ]);

$Core->selector('a.no-underline', ['text-decoration'=>'none']);




/* ============= CORPS "body" */
$Core->selector('body'

	, [

		'background-color'=>$Core->styleProperty('background-color')

		,'color'=>$Core->styleProperty('font-color')

		,'font-family'=>$Core->styleProperty('font-family')

		,'font-size'=>$Core->styleProperty('font-size')

	]

);




/* ============= CHAMPS D'EDITION "input" */
$Core->selector('textarea,input ,select'

	, [

		'color'=>''.$Core->styleProperty('textfield-font-color').''

		,'padding'=>'10px 12px 9px'

		,'margin'=>'3px 0px 0px'

		,'background-color'=>''.$Core->styleProperty('textfield-background-color').''

		,'font-family'=>''.$Core->styleProperty('font-family').''

		// ,'font-size'=>''.$Core->styleProperty('font-size').''

		,'border'=>'1px solid '.$Core->styleProperty('textfield-border-color').' '

		,'border-radius'=>$Core->styleProperty('textfield-border-radius')

		,'transition'=>'background-color 0.25s ease'

	]

);

$Core->selector(

		'textarea:hover,input:hover'

		.',textarea:focus,input:focus,select:hover,select:focus'

	, [

		'color'=>''.$Core->styleProperty('textfield-font-color:hover').''

		,'border-color'=>''.$Core->styleProperty('textfield-border-color:hover').''

		,'background-color'=>''.$Core->styleProperty('textfield-background-color:hover').''

		,'outline'=>'0px dashed transparent'

	]

);

$Core->selector(

		'input:invalid'

		. ',textarea:invalid'

	, [

		'border-color'=>$Core->styleProperty('notice-error-background-color')

		,'background-color'=>'rgba(' . $Core->styleProperty('notice-error-background-color-rgb') .',.75)'

		,'color'=>$Core->styleProperty('notice-error-color')

		,'box-shadow'=>'0px 0px 0px transparent'

	]

);



/*
	Champ 'INPUT'// DEBUT --------------------------
*/

	$Core->selector('.field-input'

		,[

			'flex'=>['flex','webkit-flex']

			,'flex-direction'=>'row'

			,'flex-wrap'=>'no-wrap'

			,'overflow'=>'hidden'

		]

	);



	$Core->selector(

			'.field-input > .icon'

			// .',.field-input > .list-item'

			.',.field-input > .label'

		,[

			'padding-right && padding-left'=>'15px'

		]

	);



	$Core->selector('.field-input > .label'

		,[

			// 'padding-right && padding-left'=>'15px'

		]

	);



	$Core->selector('.field-input > .list-item'

		,[

			'font-size'=>'14px'

			,'padding'=>'10px 20px'

			,'border-top'=>'1px dashed rgba(' . $Core->styleProperty('font-color-rgb') . ',.2)'

			,'transition'=>'background-color 0.3s ease'

		]

	);



	$Core->selector('.field-input > .list-item:first-child'
		,[

			'margin-top'=>'0px'

			,'border-top'=>'0px solid'

		]
	);



	$Core->selector('.field-input > .list-item:hover'
		,[

			'background-color'=>$Core->styleProperty('background-color:hover')

		]
	);



	$Core->selector(

			'.field-input > input'

			.',.field-input > textarea'

			.',.field-input > select'

		,[
			'flex'=>'1'

			,'background-color && border-color'=>'transparent'

		]

	);



	$Core->selector(

			'.field-input > input'

			.',.field-input > textarea'

			.',.field-input > select'

		,[
			// 'padding-left && padding-right'=>'0px'
		]
	);




	$Core->selector('.field-input > button'
		,[
			// 'background-color'=>'transparent'
		]
	);



	/* styled */
	$Core->selector('.field-input.styled'
		,[

			'background-color'=>$Core->styleProperty('background-color')

			,'margin'=>'5px'

			,'transition'=>'border-color 0.3s ease'

			,'border-width'=> '1px'

			,'border-style'=> 'solid'

			,'border-color'=> 'transparent'

		]
	);

	$Core->selector('.field-input.styled.focus'
		,[

			'color'=>$Core->styleProperty('palette-primary-color')

			,'border-color'=> '' . $Core->styleProperty('palette-primary-color') . ''

		]
	);


	$Core->selector('.field-input.styled > .icon'

		,[

			'border-right'=>'1px solid ' . $Core->styleProperty('border-color:hover')

		]

	);


	$Core->selector('.field-input.styled > .icon:last-child'

		,[

			'border-right'=>'0px solid '

		]

	);



	$Core->selector('.field-input.styled.focus > .icon'
		,[

			'border-color'=> $Core->styleProperty('palette-primary-color')

		]
	);

	$Core->selector(

			'.field-input.styled.focus > input'

			.',.field-input.styled.focus > textarea'

			.',.field-input.styled.focus > select'

		,[

			'color'=> $Core->styleProperty('palette-primary-color')

		]
	);



	/* XL */
	// $Core->selector('.field-input.xl'

	// 	,[

	// 		'padding'=>'0px'

	// 	]

	// );

	$Core->selector(

			'.field-input.xl'

			. ',.field-input.xl > input'

			.',.field-input.xl > textarea'

			.',.field-input.xl > select'

		,[

			'font-size'=>'18px'

		]

	);

	$Core->selector(

			'.field-input.xl > .icon'

			// . ',.field-input.xl > input'

			// .',.field-input.xl > textarea'

			. ',.field-input.xl > button'

		,[

			'padding'=>'10px 12px'

		]

	);


/*
	Champ 'INPUT' // FIN --------------------------
*/





/* BOUTON "button - input" // DEBUT -------------------------------------------------- */

	$Core->selector('.button,button,input[type="reset"] ,input[type="submit"] ,input[type="button"]'

		, [
			
			'color'=>$Core->styleProperty('button-font-color')

			,'border-width'=>'1px'

			,'border-style'=>'solid'

			,'background-color'=>''.$Core->styleProperty('button-background-color').' ' 

			,'padding'=>'10px 12px'

			,'font-family'=>''.$Core->styleProperty('font-family').''

			// ,'font-size'=>''.$Core->styleProperty('font-size').''

			,'border-color'=>' '.$Core->styleProperty('button-border-color').''

			,'border-radius'=>' '.$Core->styleProperty('button-border-radius').'' 

			// ,'margin'=>'0px'

			,'transition'=>'background-color,border-color,color, 0.25s ease'

		]

	);



	$Core->selector(

			'.button:hover,button:hover,input[type="reset"]:hover,input[type="submit"]:hover,input[type="button"]:hover'

			.',button.active,input[type="reset"].active,input[type="submit"],input[type="button"].active'

		, [

			'color'=>''.$Core->styleProperty('button-font-color:hover').''

			,'background-color'=>''.$Core->styleProperty('button-background-color:hover').''

			,'border-color'=>''.$Core->styleProperty('button-border-color:hover')

		]

	);

	$Core->selector('.button.active,button.active,input[type="reset"].active,input[type="submit"].active,input[type="button"].active'

		, [

			'background-color'=>''. $Core->styleProperty('palette-primary-color') .' '

			,'border-color'=>''.$Core->styleProperty('palette-secondary-color')

			,'color'=>''.$Core->styleProperty('button-font-color:active')

		]

	);

	$Core->selector(

		'button.active:hover,input[type="reset"].active:hover,input[type="submit"].active:hover,input[type="button"].active:hover'

		, [

			'border-width'=>'1px'

			, 'background-color'=>''.$Core->styleProperty('palette-secondary-color').''

			,'border-color'=>''.$Core->styleProperty('palette-secondary-color')

		]

	);



	$Core->selector('.button:active,button:active,input[type="reset"]:active ,input[type="submit"]:active ,input[type="button"]:active'

		, [

			'background-color'=>''.$Core->styleProperty('palette-secondary-color').' '

			,'color'=>''.$Core->styleProperty('button-font-color:active')

			,'border-color'=>''.$Core->styleProperty('palette-secondary-color')

			// , 'animation'=>'ggnScaleixOut 0.1s ease'

		]

	);




	/* 
		Associé à la balise span
	*/

	$Core->selector('span.button'

		, [

			'padding'=>'11px 12px'

			,'cursor'=>'default'
		]

	);




	/* 
		Bouton : information
	*/

	$Core->selector('.button.info'

		, [

			'background-color && border-color'=>''.$Core->styleProperty('notice-background-color').''

			,'color'=>''.$Core->styleProperty('notice-font-color').''
		]

	);





	/* 
		Bouton : Attention
	*/

	$Core->selector('.button.warning'

		, [

			'background-color && border-color'=>''.$Core->styleProperty('notice-warning-background-color').''

			,'color'=>''.$Core->styleProperty('notice-warning-color').''
		]

	);





	/* 
		Bouton : Erreur
	*/

	$Core->selector('.button.error'

		, [

			'background-color && border-color'=>''.$Core->styleProperty('notice-error-background-color').''

			,'color'=>''.$Core->styleProperty('notice-error-color').''
		]

	);





	/* 
		Bouton : Succès
	*/

	$Core->selector('.button.success'

		, [

			'background-color && border-color'=>''.$Core->styleProperty('notice-success-background-color').''

			,'color'=>''.$Core->styleProperty('notice-success-color').''
		]

	);





	/* 
		Bouton : Patientez
	*/

	$Core->selector('.button.wait'

		, [

			'background-color && border-color'=>''.$Core->styleProperty('notice-wait-background-color').''

			,'color'=>''.$Core->styleProperty('notice-wait-color').''

			,'font-style'=>'italic'
		]

	);





	/* 
		Bouton : Lien
	*/

	$Core->selector('.button.link'

		, [

			'background-color && border-color'=>'transparent'

			,'color'=>''.$Core->styleProperty('palette-primary-color').''

			,'font-style'=>'bold'
		]

	);

	$Core->selector('.button.link:hover'

		, [

			'color'=>''.$Core->styleProperty('palette-secondary-color').''

		]

	);





	// /* 
	// 	Bouton : Lien
	// */

	// $Core->selector('.button.link'

	// 	, [

	// 		'background-color && border-color'=>'transparent'

	// 		,'color'=>''.$Core->styleProperty('palette-primary-color').''

	// 		,'font-style'=>'bold'
	// 	]

	// );



/* BOUTON "button - input" // FIN -------------------------------------------------- */







/* ============= Feuille "Sheet" */
$Core->selector('.gui.sheet, .gui.underSheet, .gui.preloader'

	, [

		'position'=>'absolute'

		,'top'=>'0px'

		,'left'=>'0px'

		,'z-index'=>'auto'

		// ,'width'=>'100vw'

		,'padding'=>'0px !important'

		,'margin'=>'0px !important'

		// ,'animation'=> 'ggnBlurMotionOut 0.4s ease'

	]

);

$Core->selector('.gui.sheet.fx, .gui.underSheet.fx, .gui.preloader.fx'

	, [
		
		'animation'=> 'ggnBlurMotionOut 0.4s ease'

	]

);


$Core->selector('.gui.underSheet'

	, [

		'z-index'=>'5 !important'

	]

);


$Core->selector('.gui.sheet-loader'

	, [

		'position'=>'fixed !important'

		, 'width'=>'100vw !important'

		, 'top && left'=>'0px'

		, 'height'=>'5px'

		, 'background-color'=> $Core::LDColor($Core->styleProperty('palette-primary-color'), 70)

		,'z-index'=>'1000 !important'

	]

);


$Core->selector(

		'.gui.sheet[ggn-effect="blur-motion"]'

		.',.gui.sheet[ggn-effect="blur-motion-in"]'

	,[

		'animation'=> 'ggnBlurMotionIn 0.4s ease'

		,'filter'=> 'blur(5px)'

	]

);

$Core->selector('.gui.sheet[ggn-effect="blur-motion-out"]'

	,[

		'animation'=> 'ggnBlurMotionOut 0.4s ease'

		,'filter'=> 'blur(0px)'

	]

);




/* ============= Preloader "Sheet" */
$Core->selector('.gui.preloader'

	, [

		'position'=>'fixed'

		,'width'=>'100vw'

		,'height'=>'100vh'

		,'z-index'=>'20 !important'

		,'color'=>''.$Core->styleProperty('font-color').''

		,'background-color'=>''.$Core->styleProperty('background-color').''

	]

);

$Core->selector('.gui.preloader .title', ['padding'=>'0px']);

$Core->selector('.gui.preloader .about', ['margin-top'=>'-10px']);



/* Non Conditionné //////////////////////////////////////////////////////////////////////////// / FIN */














/* Conditionné //////////////////////////////////////////////////////////////////////////// / DEBUT */





	/* Parent ///////////////////////////////// / DEBUT */
	
		$Core->selector('.gui.cols', [
		
			'flex-direction'=>'row'
		
			,'flex-wrap'=>'wrap'
		
		]);

	/* Parent ///////////////////////////////// / FIN */


	/* Reste ///////////////////////////////// / DEBUT */

		$Core->selector('.col-null' , ['width'=> '0px'] );

		$Core->selector('.col-0' , ['flex'=> '1'] );

	/* Reste ///////////////////////////////// / FIN */



	/* Par defaut : CROSS-Screen, Universel ///////////////////////////////// / DEBUT */

	for ($clz=1; $clz <= 16; $clz++) { 

		$lyclSz = (($clz/16)*100);

		$Core->selector('.col-' . $clz, ['width'=> $lyclSz . '%'] );
		
		$Core->selector('.col-' . $clz . '-min', ['min-width'=> $lyclSz . '%'] );
		
		$Core->selector('.col-' . $clz . '-max', ['max-width'=> $lyclSz . '%'] );

	}


	/* Par defaut : CROSS-Screen, Universel ///////////////////////////////// / FIN  */



	/* Selecteurs par taille d'ecran ///////////////////////////////// / DEBUT */

		$GUI['Screen.By.Size'](function($key, $min, $max) use ($Core, $GUI) {



			

			/* ============= Positionnement */
			foreach (explode(' ', 'static relative fixed absolute sticky inherit') as $pos) {

				$Core->selector('.gui.' . $key . '-pos-'.$pos.'' . ',.gui.' . $key . '-pos-'.substr($pos, 0, 3).'', ['position'=>$pos]);

				$Core->selector('.gui.' . $key . '-pos-'.$pos.'-i' . ',.gui.' . $key . '-pos-'.substr($pos, 0, 3).'-i', ['position'=>$pos . ' !important']);

			}




			
			$Core->selector('.gui.flex.' . $key . '-row', ['flex-direction'=>'row']);

			$Core->selector('.gui.flex.' . $key . '-row-rev', ['flex-direction'=>'row-reverse']);

			$Core->selector('.gui.flex.' . $key . '-column', ['flex-direction'=>'column']);

			$Core->selector('.gui.flex.' . $key . '-column-rev', ['flex-direction'=>'column-reverse']);


			$Core->selector('.gui.flex.' . $key . '-wrap', ['flex-wrap'=>'wrap']);
			
			$Core->selector('.gui.flex.' . $key . '-nowrap', ['flex-wrap'=>'nowrap']);
			
			$Core->selector('.gui.flex.' . $key . '-wrap-reverse', ['flex-wrap'=>'wrap-reverse']);





			$Core->selector('.' . $key . '-bg-full-x-size',['background-size'=>'100% auto'] );

			$Core->selector('.' . $key . '-bg-full-y-size',['background-size'=>'auto 100%'] );





			$Core->selector('.gui.flex > .' . $key . '-align-center', ['margin'=>'auto']);
			
			$Core->selector('.gui.flex > .' . $key . '-align-bottom', ['margin-top'=>'auto']);
			
			$Core->selector('.gui.flex > .' . $key . '-align-top', ['margin-bottom'=>'auto']);
			
			$Core->selector('.gui.flex > .' . $key . '-align-left', ['margin-right'=>'auto']);
			
			$Core->selector('.gui.flex > .' . $key . '-align-right', ['margin-left'=>'auto']);

			$Core->selector('.gui.flex > .' . $key . '-align-vertical', ['margin-top && margin-bottom'=>'auto']);
			
			$Core->selector('.gui.flex > .' . $key . '-align-horizontal', ['margin-left && margin-right'=>'auto']);




			$Core->selector('.' . $key . '-text-left',['text-align'=>'left'] );

			$Core->selector('.' . $key . '-text-center',['text-align'=>'center'] );

			$Core->selector('.' . $key . '-text-right',['text-align'=>'right'] );



			$Core->selector('.' . $key . '-disable', ['display'=> 'none !important'] );

			$Core->selector('.' . $key . '-enable', ['display'=> 'block !important'] );

			$GUI['Property.Display.ForEach']('.' . $key . '-enable-', '', true);


			/* Ordre des flex / DEBUT */

				for ($flx=0; $flx <= 16; $flx++) {

					$Core->selector('.' . $key . '-flex-order-' . $flx, ['order'=>'' . $flx . '']);

				}

			/* Ordre des flex / FIN */


			/* Reste */

			$Core->selector('.' . $key . '-col-0' , ['flex'=> '1'] );

			$Core->selector('.' . $key . '-col-null' , ['width'=> '0px'] );

			$Core->selector('.' . $key . '-flex-start', ['justify-content'=>'flex-start !important']);
			
			$Core->selector('.' . $key . '-flex-end', ['justify-content'=>'flex-end !importantù']);
			
			$Core->selector('.' . $key . '-flex-center', ['justify-content'=>'center !importantù']);


			for ($clz=1; $clz <= 16; $clz++) { 

				$clSz = (($clz/16)*100);

				$Core->selector('.' . $key . '-col-' . $clz , ['width'=> $clSz . '%'] );
				
				$Core->selector('.' . $key . '-col-' . $clz . '-min' , ['min-width'=> $clSz . '%'] );
				
				$Core->selector('.' . $key . '-col-' . $clz . '-max' , ['max-width'=> $clSz . '%'] );

			}


		}, false);

	/* Selecteurs par taille d'ecran ///////////////////////////////// / FIN */




/* Conditionné //////////////////////////////////////////////////////////////////////////// / FIN */













/* Non Conditionné //////////////////////////////////////////////////////////////////////////// / DEBU */



/* Loading Plusar / DEBUT  /////////////////////////// */

$Core->selector('.gui.loading.pulsar'

	, [

		'display'=>['-webkit-flex', 'flex']

		,'flex'=>'1'

		,'border-radius'=>'360px'

		, 'align-items'=>'center'

		, 'justify-content'=>'center'

		, 'transition'=>'all 500ms ease'

	]
);

$Core->selector('.gui.loading.pulsar > div.bullet'

	, [

		'border-radius'=>'360px'

		, 'transition'=>'all 500ms ease'

		, 'width && height'=>'100%'

		, 'animation'=>'ggnPulsarLoading 1500ms linear infinite'

	]
);

$Core->selector('.gui.loading.pulsar.fast > div.bullet', ['animation'=>'ggnPulsarLoading 750ms linear infinite']);

$Core->selector('.gui.loading.pulsar.slow > div.bullet', ['animation'=>'ggnPulsarLoading 4000ms linear infinite']); 

$Core->keyframes('ggnPulsarLoading'
	, 
		'{'.

			'0%{'

				. $Core::browserKey('transform','scale(0.1)')

				. 'background-color:' . $Core->styleProperty('palette-primary-color') . ';' .
				
			'} 25%{' 

				. $Core::browserKey('transform','scale(1)') .
				
			'} 45%{' 

				. $Core::browserKey('transform','scale(0.1)') 

				. 'background-color:' . $Core->styleProperty('palette-primary-color') . ';' .
				
			'} 50%{' 

				. $Core::browserKey('transform','scale(0.0)') .


			'} 55%{' 

				. $Core::browserKey('transform','scale(0.1)') 
				
				. 'background-color:' . $Core->styleProperty('palette-tertiary-color') . ';' .
				
			'} 75%{' 

				. $Core::browserKey('transform','scale(1)') .

				
			'} 100%{' 

				. $Core::browserKey('transform','scale(0.1)') 

				. 'background-color:' . $Core->styleProperty('palette-tertiary-color') . ';' .


			'} '.

		'}'

	, true
);

/* Loading Plusar / FIN  /////////////////////////// */



/* Loading Cercle / DEBUT  /////////////////////////// */

$Core->selector('.gui.loading'

	, [

		'background-color'=>'transparent'

		,'background-repeat'=>'no-repeat'

		,'background-position'=>'center'

	]
);


foreach ($GUI['loading.size'] as $key => $value) {

	$ldgimg = HTTP_HOST . 'loading/ggn-loading-circle.png';

	$resizer = '&width=' . $value . '&height=' . $value . '&resize=';

	// $ldgimg = HTTP_HOST . 'loading/ggn-loading-x'.$value.'.png';

	$ldglimg = $ldgimg . $GUI['IMAGE_FILTER_LIGHT_TONE'] . $resizer;

	$ldgdimg = $ldgimg . $GUI['IMAGE_FILTER_DARK_TONE'] . $resizer;

	$ldgtimg = $ldgimg . $GUI['IMAGE_FILTER_TEXT_COLOR_TONE'] . $resizer;

	$ldgthimg = $ldgimg . $GUI['IMAGE_FILTER_TEXT_HOVER_TONE'] . $resizer;

	$ldgpnimg = $ldgimg . $GUI['IMAGE_FILTER_NORMAL_PATTERN_TONE'] . $resizer;

	$ldgpdimg = $ldgimg . $GUI['IMAGE_FILTER_DARK_PATTERN_TONE'] . $resizer;


	/* div.loading.circle */
	$Core->selector('.gui.loading.circle.x'.$value.''

		, [

			'background-image'=>'url('.$ldglimg.')'

			,'width && height'=> $value.'px'

		]

	);

	/* Clair */
	$Core->selector('div.loading.circle.x'.$value.'.light', ['background-image'=>'url('.$ldglimg.')'] );

	/* Sombre */
	$Core->selector('div.loading.circle.x'.$value.'.dark', ['background-image'=>'url('.$ldgdimg.')'] );

	/* Couleur text */
	$Core->selector('div.loading.circle.x'.$value.'.text-color', ['background-image'=>'url('.$ldgtimg.')'] );

	/* Couleur text survolé */
	$Core->selector('div.loading.circle.x'.$value.'.text-color-hover', ['background-image'=>'url('.$ldgthimg.')'] );

	/* Couleur pattern normal */
	$Core->selector('div.loading.circle.x'.$value.'.normal-color', ['background-image'=>'url('.$ldgpnimg.')'] );

	/* Couleur pattern sombre */
	$Core->selector('div.loading.circle.x'.$value.'.dark-color', ['background-image'=>'url('.$ldgpdimg.')'] );


}


	/* div.loading.circle.in */
	$Core->selector('div.loading.circle.in'

		, ['animation'=>'ggnCircleLoading 1.2s ease-in infinite']

	);

	/* div.loading.circle.out */
	$Core->selector('div.loading.circle.out'

		, ['animation'=>'ggnCircleLoading 1.2s ease-out infinite']

	);

	/* div.loading.circle.in-out */
	$Core->selector('div.loading.circle.in-out'

		, ['animation'=>'ggnCircleLoading 1.2s ease infinite']

	);


$Core->selector('.loading.circle', ['animation'=>'ggnCircleLoading 1.2s linear infinite'] );

$Core->selector('.loading.circle.slow', ['animation'=>'ggnCircleLoading 1.9s linear infinite'] );

$Core->selector('.loading.circle.fast', ['animation'=>'ggnCircleLoading 0.25s linear infinite'] );


$Core::keyframes('ggnCircleLoading', $Core::fx('rotate','0','-360'), true);


/* Loading Cercle / FIN  /////////////////////////// */








/*
	GGN TOAST API // DEBUT --------------------------
*/

$Core->selector('[id*="ggn-toast-api-master"]'
	, [

		'width' => '100%'

		,'left && bottom' => '0px'

		,'z-index'=>'999999999999'

	]
);


$Core->selector('.gui.toast-api-item:not([data-toast-item-status="false"])', ['border-top' => '1px dashed rgba(128,128,128,.3)'] );

$Core->selector('.gui.toast-api-item:last-child:not([data-toast-item-status="false"])', ['border-top' => '0px dashed transparent'] );


$Core->selector('.gui.toast-api-item'
	, [

		'background-color' => $Core->styleProperty('palette-primary-color')

		,'color' => $Core->styleProperty('palette-light-color')

		,'width' => '96%'

		// ,'left' => '0px'

		,'transition' => 'bottom, 0.3s ease'

		,'z-index'=>'1' 

		,'box-shadow'=>'0px 0px 5px rgba(0,0,0,.50)'

	]
);

$Core->selector('.gui.toast-api-item a'
	, [
		
		'text-decoration' => 'none'

	]
);

$Core->selector('.gui.toast-api-item *'
	, [

		'color' => 'inherit'

	]
);

$Core->selector('.gui.toast-api-item .image'
	, [

		'background-color' => 'rgba(0,0,0,.99)'

		,'height' => 'inherit'

		,'background-size' => '100%'

	]
);

$Core->selector('.gui.toast-api-item > .content'
	, [

		'height' => '100%'

		,'padding' => '12px 20px'

	]
);

$Core->selector('.gui.toast-api-item > .content > .title'
	, [

		// 'height' => '32px'

	]
);

$Core->selector('.gui.toast-api-item > .content > .text'
	, [

		// 'flex' => '1'

	]
);

$Core->selector('.gui.toast-api-item > .content.only'
	, [

		// 'padding' => '12px'

	]
);

$Core->selector('.gui.toast-api-item.color-wait > .content > .text ', ['font-style' => 'italic'] );

/*
	GGN TOAST API // FIN --------------------------
*/










/* ============= Flou Gaussien & animation */
$Core->selector('[ggn-effect="blur-motion"]'

		.',[ggn-effect="blur-motion-in"]'

	,[

		'animation'=> 'ggnBlurMotionIn 0.4s ease'

		,'filter'=> 'blur(7px)'

	]

);

$Core->selector('[ggn-effect="blur-motion-out"]'

	,[

		'animation'=> 'ggnBlurMotionOut 0.4s ease'

		,'filter'=> 'blur(0px)'

	]

);








/* ============= Gougnon UI LockBox API */
$Core->selector('[gui-api="g.lockbox"]', []);

$Core->selector('[gui-api="g.lockbox"] > [gui-api-lockbox="ultra.light"]', ['background-color'=>'rgba(0,0,0,.75)'] );

$Core->selector('[gui-api="g.lockbox"] > [gui-api-lockbox="ultra.box"]', ['background-color'=>'#fff']);







/* ============= Alert */
$Core->selector('.alert, .alert-mini'

	, [

		'text-align'=>'center'

		,'font-family'=>''.$Core->styleProperty('headling-fontLight-family').''

		,'font-size'=>'40px'

		,'color'=>''.$Core->styleProperty('palette-light-color').''

	]

);

$Core->selector('.alert-mini'

	, [

		'font-family'=>''.$Core->styleProperty('headling-font-family').''

		,'font-size'=>'21px'

	]

);









/* ============= Gougnon UI Progress API */
$Core->selector('[gui-api="g.progress"]'

	, [

		'position'=>'relative'

		,'overflow'=>'hidden'

	]

);

$Core->selector('[gui-api="g.progress"][gui-api-progress="g.progress.bar"]'

	, [

		'background-color'=>'#DDD'

		,'min-height'=>'1px'

	]

);

$Core->selector(

		'[gui-api-progress="g.progress.bar"] > [gui-api-progress="purcent.bar"]'

		. ',[gui-api-progress="g.progress.bar"] > [gui-api-progress="cache.bar"]'

		. ',[gui-api-progress="g.progress.bar"] > [gui-api-progress="text.bar"]'

	, [

		'position'=>'absolute'

		,'width'=>'0px'

		,'min-height'=>'1px'

		,'height'=>'100%'

		,'overflow'=>'hidden'

	]

);

$Core->selector(

		'[gui-api-progress="g.progress.bar"] > [gui-api-progress="purcent.bar"] > [gui-api-progress="label.bar"]'

		. ',[gui-api-progress="g.progress.bar"] > [gui-api-progress="cache.bar"] > [gui-api-progress="label.bar"]'

		. ',[gui-api-progress="g.progress.bar"] > [gui-api-progress="text.bar"] > [gui-api-progress="label.bar"]'

	, [

		'text-overflow'=>'hidden'

		,'whiteSpace'=>'nowrap'

		,'font-size'=>'11px'

		,'overflow'=>'hidden'

	]

);


$Core->selector('[gui-api-progress="g.progress.bar"] > [gui-api-progress="purcent.bar"]', ['background-color'=>''.$Core->styleProperty('palette-primary-color').''] );

$Core->selector('[gui-api-progress="g.progress.bar"] > [gui-api-progress="purcent.bar"] > [gui-api-progress="label.bar"]', ['color'=>'#fff'] );

$Core->selector('[gui-api-progress="g.progress.bar"] > [gui-api-progress="cache.bar"]', ['background-color'=>'#CFCFCF'] );

$Core->selector('[gui-api-progress="g.progress.bar"] > [gui-api-progress="cache.bar"] > [gui-api-progress="label.bar"]', ['color'=>'#222'] );

$Core->selector('[gui-api-progress="g.progress.bar"] > [gui-api-progress="text.bar"]'

	, [

		'background-color'=>'transparent !important'

		,'width'=>'100%'

		,'height'=>'100%'

	]

);

$Core->selector('[gui-api-progress="g.progress.bar"] > [gui-api-progress="text.bar"] > [gui-api-progress="label.bar"]'

	, [

		'color'=>'#222'

	]

);









/*
	Awake // DEBUT -------------------
*/

$Core->selector('*[ggn-awake-promise]'

	, [

		'opacity'=>'0.1'

		,'display'=>'none'

	]

);


$Core->selector('.gui.awake-api-encompass'

	, [

		'left && top'=>'0px'

		,'width && height'=>'0px'

		// ,'width && height'=>'100%'

	]

);

// $Core->selector('.gui.awake-api-encompass.awk-a > .container', ['position'=>'absolute'] );

// $Core->selector('.gui.awake-api-encompass.awk-f > .container', ['position'=>'fixed'] );


$Core->selector('.gui.awake-api-encompass.locked > .container > .content'

	, [

		'animation'=>'ggnBouncedIn 0.3s ease'

		,'transform'=>'scale(0.5)'

		,'opacity'=>'1'

	]

);

$Core->selector('.gui.awake-api-encompass > .light'

	, [

		// 'background-color'=>'' . $Core->LDColor($Core->styleProperty('palette-primary-color'), -32) . ''
		'background-color'=>'' . $Core->styleProperty('palette-dark-color') . ''

		// ,'opacity'=>'0.75'

		,'left && top'=>'0px'

		,'width && height'=>'100%'

		,'z-index'=>'auto'

		,'transition'=>'all 0.3s ease'

	]

);

$Core->selector('.gui.awake-api-encompass > .container'

	, [

		'z-index'=>'1'

		,'top && left '=>'0px'

		,'width && height'=>'100%'

		,'min-width && min-height'=>'288px'

		,'max-width'=>'100vw'

		,'max-height'=>'100vh'

		// ,'background-color'=>'red'

		,'transition'=>'all 0.3s ease'

	]

);

$Core->selector('.gui.awake-api-encompass > .container > .content.fx'

	, [

		'transition'=>'all 0.5s ease'

	]

);

$Core->selector('.gui.awake-api-encompass > .container > .content'

	, [

		'background-color'=>'' . $Core->styleProperty('background-color') . ''

	]

);

$Core->selector('.gui.awake-api-encompass > .container > .content.auto-content'

	, [

		'padding'=>'10px 15px'

	]

);


/* Depth // DEBUT ------------- */

	$Core->selector('[ggn-awake-depth~="gray"] > *:not([ggn-awake-item]):not([ggn-awake-no-depth])'

		, [

			'filter'=>'grayscale(1) !important'

		]

	);


if(!$_DPO_DEVICE->get('edge')){

	$Core->selector('[ggn-awake-depth~="blur"] > *:not([ggn-awake-item]):not([ggn-awake-no-depth])'

		, [

			'filter'=>'blur(5px) !important'

		]

	);

	$Core->selector('[ggn-awake-depth~="gray-blur"] > *:not([ggn-awake-item]):not([ggn-awake-no-depth])'

		, [

			'filter'=>'blur(5px) grayscale(1) !important'

		]

	);

}


	$Core->selector('[ggn-awake-depth-self~="transparent"].gui.awake-api-encompass > .light'

		, [

			'background-color'=>'transparent !important'

		]

	);

	$Core->selector('[ggn-awake-depth-self~="black-bg"].gui.awake-api-encompass > .light'

		, [

			'background-color'=>'#000 !important'

		]

	);


	$Core->selector('[ggn-awake-depth-self~="primary"].gui.awake-api-encompass > .light', ['background-color'=> $Core->styleProperty('palette-primary-color') . ' !important'] );

	$Core->selector('[ggn-awake-depth-self~="secondary"].gui.awake-api-encompass > .light', ['background-color'=> $Core->styleProperty('palette-secondary-color') . ' !important'] );

	$Core->selector('[ggn-awake-depth-self~="tertiary"].gui.awake-api-encompass > .light', ['background-color'=> $Core->styleProperty('palette-tertiary-color') . ' !important'] );

	$Core->selector('[ggn-awake-depth-self~="quartenary"].gui.awake-api-encompass > .light', ['background-color'=> $Core->styleProperty('palette-quartenary-color') . ' !important'] );

	$Core->selector('[ggn-awake-depth-self~="light"].gui.awake-api-encompass > .light', ['background-color'=> $Core->styleProperty('palette-light-color') . ' !important'] );

	$Core->selector('[ggn-awake-depth-self~="dark"].gui.awake-api-encompass > .light', ['background-color'=> $Core->styleProperty('palette-dark-color') . ' !important'] );


	$Core->selector('[ggn-awake-depth-self~="no-content"].gui.awake-api-encompass > .container > .content'

		, [

			'background-color'=>'transparent'

			,'box-shadow'=>'0px 0px 0px transparent !important'

		]

	);

/* Depth // FIN ------------- */







/*
	Awake // FIN -------------------
*/







foreach (explode(' ', '# -hover:hover') as $key => $CPseudo) {

/*
	Couleur arrière plan et texte en fonction de la palette // DEBUT -------------------
*/

	/* Couleurs des Textes */


	$CPseudo = $CPseudo == '#' ? '' : $CPseudo;



	$Core->selector('.color-bg' . $CPseudo, ['color'=>$Core->styleProperty('background-color') . ' !important']);

		$Core->selector('.color-bg-l' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('background-color'),5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-bg-d' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('background-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);



	$Core->selector('.color-text' . $CPseudo, ['color'=>$Core->styleProperty('font-color') . ' !important']);

		$Core->selector('.color-text-l' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('font-color'),5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-text-d' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('font-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);



	$Core->selector('.color-dtext' . $CPseudo, ['color'=>$Core->styleProperty('dark-font-color') . ' !important']);

		$Core->selector('.color-dtext-l' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('dark-font-color'),5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-dtext-d' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('dark-font-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);



	$Core->selector('.color-text-hover' . $CPseudo, ['color'=>$Core->styleProperty('font-color:hover') . ' !important']);

		$Core->selector('.color-text-hover-l' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('font-color:hover'),5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-text-hover-d' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('font-color:hover'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);



	$Core->selector('.color-dark' . $CPseudo, ['color'=>$Core->styleProperty('palette-dark-color') . ' !important']);

		$Core->selector('.color-dark-l' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('palette-dark-color'),5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-dark-d' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('palette-dark-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);
	

	$Core->selector('.color-light' . $CPseudo, ['color'=>$Core->styleProperty('palette-light-color') . ' !important']);

		$Core->selector('.color-light-l' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('palette-light-color'),5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-light-d' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('palette-light-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);


	
	$Core->selector('.color-primary' . $CPseudo, ['color'=>$Core->styleProperty('palette-primary-color') . ' !important']);

		$Core->selector('.color-primary-l' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('palette-primary-color'),5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-primary-d' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('palette-primary-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

	
	$Core->selector('.color-secondary' . $CPseudo, ['color'=>$Core->styleProperty('palette-secondary-color') . ' !important']);

		$Core->selector('.color-secondary-l' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('palette-secondary-color'),5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-secondary-d' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('palette-secondary-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

	
	$Core->selector('.color-tertiary' . $CPseudo, ['color'=>$Core->styleProperty('palette-tertiary-color') . ' !important']);

		$Core->selector('.color-tertiary-l' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('palette-tertiary-color'),5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-tertiary-d' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('palette-tertiary-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

	
	$Core->selector('.color-quaternary' . $CPseudo, ['color'=>$Core->styleProperty('palette-quaternary-color') . ' !important']);

		$Core->selector('.color-quaternary-l' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('palette-quaternary-color'),5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-quaternary-d' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('palette-quaternary-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);



	$Core->selector('.color-notice' . $CPseudo, ['color'=>$Core->styleProperty('notice-color') . ' !important']);

		$Core->selector('.color-notice-l' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('notice-color'),5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-notice-d' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('notice-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);


	$Core->selector('.color-error' . $CPseudo, ['color'=>$Core->styleProperty('notice-error-color') . ' !important']);

		$Core->selector('.color-error-l' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('notice-error-color'),5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-error-d' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('notice-error-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-error-p' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('notice-error-background-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);


	$Core->selector('.color-warning' . $CPseudo, ['color'=>$Core->styleProperty('notice-warning-color') . ' !important']);

		$Core->selector('.color-warning-l' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('notice-warning-color'),5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-warning-d' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('notice-warning-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-warning-p' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('notice-warning-background-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);


	$Core->selector('.color-success' . $CPseudo, ['color'=>$Core->styleProperty('notice-success-color') . ' !important']);

		$Core->selector('.color-success-l' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('notice-success-color'),5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-success-d' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('notice-success-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-success-p' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('notice-success-background-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);


	$Core->selector('.color-wait' . $CPseudo, ['color'=>$Core->styleProperty('notice-wait-color') . ' !important']);

		$Core->selector('.color-wait-l' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('notice-wait-color'),5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-wait-d' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('notice-wait-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.color-wait-p' . $CPseudo, ['color'=>$Core->LDColor($Core->styleProperty('notice-wait-background-color'),-5 * $GUI['STANDARD-COLOR-VARIANT']) . ' !important']);



	/* Couleurs de l'arriere plan */

	$Core->selector('.bg-text-color' . $CPseudo, ['background-color'=>$Core->styleProperty('font-color') . ' !important']);

		$Core->selector('.bg-text-color-l' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('font-color'),$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.bg-text-color-d' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('font-color'),-$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);



	$Core->selector('.bg-text-color-hover' . $CPseudo, ['background-color'=>$Core->styleProperty('font-color:hover') . ' !important']);

		$Core->selector('.bg-text-color-hover-l' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('font-color:hover'),$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.bg-text-color-hover-d' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('font-color:hover'),-$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);



	$Core->selector('.bg-ncolor' . $CPseudo, ['background-color'=>$Core->styleProperty('background-color') . ' !important']);

		$Core->selector('.bg-ncolor-l' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('background-color'),$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.bg-ncolor-d' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('background-color'),-$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);


	$Core->selector('.bg-dcolor' . $CPseudo, ['background-color'=>$Core->styleProperty('dark-background-color') . ' !important']);

		$Core->selector('.bg-dcolor-l' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('dark-background-color'),$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.bg-dcolor-d' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('dark-background-color'),-$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

	

	$Core->selector('.bg-dark' . $CPseudo, ['background-color'=>$Core->styleProperty('palette-dark-color') . ' !important']);

		$Core->selector('.bg-dark-l' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('palette-dark-color'),$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.bg-dark-d' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('palette-dark-color'),-$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);


	$Core->selector('.bg-light' . $CPseudo, ['background-color'=>$Core->styleProperty('palette-light-color') . ' !important']);

		$Core->selector('.bg-light-l' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('palette-light-color'),$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.bg-light-d' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('palette-light-color'),-$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

	
	$Core->selector('.bg-primary' . $CPseudo, ['background-color'=>$Core->styleProperty('palette-primary-color') . ' !important']);

		$Core->selector('.bg-primary-l' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('palette-primary-color'),$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.bg-primary-d' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('palette-primary-color'),-$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

	
	$Core->selector('.bg-secondary' . $CPseudo, ['background-color'=>$Core->styleProperty('palette-secondary-color') . ' !important']);

		$Core->selector('.bg-secondary-l' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('palette-secondary-color'),$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.bg-secondary-d' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('palette-secondary-color'),-$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

	
	$Core->selector('.bg-tertiary' . $CPseudo, ['background-color'=>$Core->styleProperty('palette-tertiary-color') . ' !important']);

		$Core->selector('.bg-tertiary-l' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('palette-tertiary-color'),$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.bg-tertiary-d' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('palette-tertiary-color'),-$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

	
	$Core->selector('.bg-quaternary', ['background-color'=>$Core->styleProperty('palette-quaternary-color') . ' !important']);

		$Core->selector('.bg-quaternary-l', ['background-color'=>$Core->LDColor($Core->styleProperty('palette-quaternary-color'),$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.bg-quaternary-d', ['background-color'=>$Core->LDColor($Core->styleProperty('palette-quaternary-color'),-$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);



	$Core->selector('.bg-notice' . $CPseudo, ['background-color'=>$Core->styleProperty('notice-background-color') . ' !important']); 

		$Core->selector('.bg-notice-l' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('notice-background-color'),$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.bg-notice-d' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('notice-background-color'),-$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

 
	$Core->selector('.bg-error' . $CPseudo, ['background-color'=>$Core->styleProperty('notice-error-background-color') . ' !important']);

		$Core->selector('.bg-error-l' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('notice-error-background-color'),$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.bg-error-d' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('notice-error-background-color'),-$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);


	$Core->selector('.bg-warning' . $CPseudo, ['background-color'=>$Core->styleProperty('notice-warning-background-color') . ' !important']);

		$Core->selector('.bg-warning-l' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('notice-warning-background-color'),$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.bg-warning-d' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('notice-warning-background-color'),-$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);


	$Core->selector('.bg-success' . $CPseudo, ['background-color'=>$Core->styleProperty('notice-success-background-color') . ' !important']);

		$Core->selector('.bg-success-l' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('notice-success-background-color'),$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.bg-success-d' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('notice-success-background-color'),-$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);


	$Core->selector('.bg-wait' . $CPseudo, ['background-color'=>$Core->styleProperty('notice-wait-background-color') . ' !important']);

		$Core->selector('.bg-wait-l' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('notice-wait-background-color'),$GUI['STANDARD-COLOR-VARIANT']) . ' !important']);

		$Core->selector('.bg-wait-d' . $CPseudo, ['background-color'=>$Core->LDColor($Core->styleProperty('notice-wait-background-color'),-$GUI['STANDARD-COLOR-VARIANT']) . ' !important']); 

/*
	Couleur arrière plan et texte en fonction de la palette // FIN -------------------
*/

}







/*
	Taille des Text // DEBUT -------------------------
*/

	for ($tkxz=10; $tkxz <= 52; $tkxz+=2) {

		$Core->selector('*.text-x' . $tkxz , ['font-size'=>$tkxz . 'px']); 
	}

	for ($tkxz=0; $tkxz <= 100; $tkxz++) {

		$Core->selector('*.text-x' . $tkxz .'-vw' , ['font-size'=>$tkxz . 'vw']);

		$Core->selector('*.text-x' . $tkxz .'-vh' , ['font-size'=>$tkxz . 'vh']);

		$Core->selector('*.text-x' . $tkxz .'-em' , ['font-size'=>$tkxz . 'em']);

		$Core->selector('*.text-x' . $tkxz .'-p' , ['font-size'=>$tkxz . '%']);
	}

/*
	Taille des Text // FIN -------------------------
*/








/*
	Espacement Intérieur : Padding // DEBUT -------------------------
*/

	for ($pdnngx=0; $pdnngx <= 64; $pdnngx+=4) {

		$Core->selector('*.padding-x' . $pdnngx , ['padding'=>$pdnngx . 'px']); 

		$Core->selector('*.padding-tb-x' . $pdnngx , ['padding-top && padding-bottom'=>$pdnngx . 'px']); 

		$Core->selector('*.padding-lr-x' . $pdnngx , ['padding-left && padding-right'=>$pdnngx . 'px']); 

		$Core->selector('*.padding-t-x' . $pdnngx , ['padding-top'=>$pdnngx . 'px']); 

		$Core->selector('*.padding-b-x' . $pdnngx , ['padding-bottom'=>$pdnngx . 'px']); 

		$Core->selector('*.padding-l-x' . $pdnngx , ['padding-left'=>$pdnngx . 'px']); 

		$Core->selector('*.padding-r-x' . $pdnngx , ['padding-right'=>$pdnngx . 'px']); 

	}

/*
	Espacement Intérieur : Padding // FIN -------------------------
*/








/*
	Espacement Extérieur : Margin // DEBUT -------------------------
*/

	for ($mrgnx=0; $mrgnx <= 64; $mrgnx+=4) {

		$Core->selector('*.margin-x' . $mrgnx , ['margin'=>$mrgnx . 'px']); 

		$Core->selector('*.margin-tb-x' . $mrgnx , ['margin-top && margin-bottom'=>$mrgnx . 'px']); 

		$Core->selector('*.margin-lr-x' . $mrgnx , ['margin-left && margin-right'=>$mrgnx . 'px']); 

		$Core->selector('*.margin-t-x' . $mrgnx , ['margin-top'=>$mrgnx . 'px']); 

		$Core->selector('*.margin-b-x' . $mrgnx , ['margin-bottom'=>$mrgnx . 'px']); 

		$Core->selector('*.margin-l-x' . $mrgnx , ['margin-left'=>$mrgnx . 'px']); 

		$Core->selector('*.margin-r-x' . $mrgnx , ['margin-right'=>$mrgnx . 'px']); 

	}

/*
	Espacement Extérieur : Margin // FIN -------------------------
*/








/*
	Box : STYLE // DEBUT -------------------------
*/



$Core->selector('.gui-transition,.gui-fx', ['transition'=>'all 600ms ease']);

$Core->selector('.box-rounded,.box-rounded-min', ['border-radius'=>'3px']);

$Core->selector('.box-no-rounded', ['border-radius'=>'0px']);

$Core->selector('.box-rounded-smaller', ['border-radius'=>'5px']);

$Core->selector('.box-rounded-normal', ['border-radius'=>'7px']);

$Core->selector('.box-rounded-semi-biggest', ['border-radius'=>'10px']);

$Core->selector('.box-rounded-biggest', ['border-radius'=>'15px']);


$Core->selector('.box-circle', ['border-radius'=>'360px']);


$Core->selector('.box-shadow-light', ['box-shadow'=>'0px 5px 7px rgba(' . $Core->styleProperty('palette-light-color-rgb') . ',.64)']);

$Core->selector('.box-shadow-dark', ['box-shadow'=>'0px 5px 7px rgba(' . $Core->styleProperty('palette-dark-color-rgb') . ',.32)']);

$Core->selector('.box-shadow-white', ['box-shadow'=>'0px 5px 7px rgba(255,255,255,.50)']);

$Core->selector('.box-shadow-black', ['box-shadow'=>'0px 5px 7px rgba(0,0,0,.50)']);



/* 
	Rotation
*/
$Core->selector('.box-rotate-0', ['transform'=>'rotate(0deg)']);

$Core->selector('.box-rotate-90', ['transform'=>'rotate(90deg)']);

$Core->selector('.box-rotate-180', ['transform'=>'rotate(180deg)']);

$Core->selector('.box-rotate-270', ['transform'=>'rotate(270deg)']);

$Core->selector('.box-rotate-360', ['transform'=>'rotate(360deg)']);



/* 
	Box Thumb
*/
$Core->selector('.box-thumb'

	, [

		'position'=>'relative'

	]

);

$Core->selector('.box-thumb .thumb-img'

	, [

		'position'=>'relative'

	]

);

$Core->selector(

		'.box-thumb .thumb-title'

	, [

		'color'=>'#fff'

	]

);




$Core->selector(

		'.box-thumb .thumb-tools'

	, [

		'top && right'=>'0px'

		,'padding-right && padding-left'=>'12px'

	]

);

	$Core->selector(

			'.box-thumb .thumb-tools .tool'

		, [

			'padding'=>'12px'

		]

	);

	$Core->selector(

			'.box-thumb:hover .thumb-tools .tool'

		, [

			'background-color'=>$Core->styleProperty('palette-dark-color')

		]

	);

	$Core->selector(

			'.box-thumb .thumb-tools .tool:hover'

		, [

			'background-color'=>$Core->styleProperty('palette-primary-color')

		]

	);




$Core->selector(

		'.box-thumb .thumb-check'

	, [

		'top && left'=>'0px'

		,'padding'=>'8px'

	]

);




$Core->selector(

		'.box-thumb .thumb-check'

		. ',.box-thumb .thumb-tools'

	, [

		'margin-top && margin-left'=>'5px'

	]

);




$Core->selector('.box-thumb .thumb-title.bottom'

	, [

		'bottom'=>'-100px'

		,'background'=>$Core->backgroundGradientValue('transparent 10%, #000 ')

	]

);



$Core->selector(

		'.box-thumb:hover .thumb-title.bottom'

		.',.box-thumb .checked .thumb-title.bottom'

	, [

		'background'=>$Core->backgroundGradientValue('transparent 10%, ' . $Core->styleProperty('palette-primary-color') . ' ')

	]

);



$Core->selector('.box-thumb .thumb-title.bottom.hide'

	, [

		'bottom'=>'-100%'

	]

);

$Core->selector('.box-thumb:hover .thumb-title.bottom.hide'

	, [

		'bottom'=>'0px'

	]

);




$Core->selector('.box-thumb .thumb-title.top'

	, [

		'background'=>$Core->backgroundGradientValue('#000, transparent 10%')

		,'top'=>'0px'

	]

);

$Core->selector(

		'.box-thumb:hover .thumb-title.top'

		.',.box-thumb .checked .thumb-title.top'

	, [

		'background'=>$Core->backgroundGradientValue('' . $Core->styleProperty('palette-primary-color') . ', transparent 10%')

	]

);


/*
	Box : STYLE // FIN -------------------------
*/






/*
	Box : Check // DEBUT -------------------------
*/

$Core->selector('.box-check'

	, [

		'position'=>'relative'

	]

);



$Core->selector(

		'.box-check.checked'

	, [

		// 'background-color'=>$Core->styleProperty('palette-primary-color') . ' !important'

		'box-shadow'=> '0px 0px 100px ' . $Core->styleProperty('palette-dark-color') . ' inset !important'

	]

);


$Core->selector(

		'.box-check .check-status'

	, [

		'transform'=>'scale(3)'

		,'width && height'=>'100%'

		,'visibility'=>'hidden'

		,'opacity'=>'0.1'

		,'color'=> $Core->styleProperty('palette-light-color')

		,'background-color'=>'rgba(' . $Core->styleProperty('palette-primary-color-rgb') .',.75)'

	]

);


$Core->selector(

		'.box-check.checked .check-status'

	, [

		'transform'=>'scale(1)'

		,'visibility'=>'visible'

		,'opacity'=>'1'

		// ,'animation'=>'ggnBouncedIn 0.3s ease'

	]

);


$Core->selector(

		'.box-check .check-status:after'

	, [

		'content'=>'"check"'

	]

);

/*
	Box : Check // FIN -------------------------
*/


	

	$Core->selector('.col-0-no' , ['flex'=> 'none'] );

	$Core->selector('.col-0-no-i' , ['flex'=> 'none !important'] );


/* Non Conditionné //////////////////////////////////////////////////////////////////////////// / FIN */

?>