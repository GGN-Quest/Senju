/* Fichier : Gougnon.CSS.framework.cssg, Nom : Gougnon CSS Framework, version 0.0.1.150303.1434, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');





/* GUI System Interface Immersion */
$Core->selector('body'
	, [
		'overflow && overflow-y && overflow-x'=> 'hidden !important'
	]
);

$Core->selector('body.ims-start-menu-opened'
	, [
		'overflow && overflow-x'=> 'hidden !important'
		,'overflow-y'=> 'auto !important'
	]
);



/* Immersion Util */
$Core->selector('.ims-button'
	, [
		'font-size'=> '15px'
		,'color'=> '' . $Core->styleProperty('font-color') . ''
		,'text-align'=> 'center'
		,'padding'=> '7px 15px'
		,'margin'=> '3px 3px'
		,'border-radius'=> '50px'
		,'background-color'=> 'rgba(' . $Core->styleProperty('font-color-rgb') . ',.03)'
	]
);

$Core->selector('.ims-button.active'
	, [
		'color'=> '' . $Core->styleProperty('font-color') . ''
		,'background-color'=> '' . $Core->styleProperty('palette-primary-color') . ''
	]
);

$Core->selector('.ims-button:hover'
	, [
		'color'=> '' . $Core->styleProperty('font-color') . ''
		,'background-color'=> 'rgba(' . $Core->styleProperty('font-color-rgb:hover') . ',.5)'
	]
);

$Core->selector('.ims-button.active:hover'
	, [
		'text-shadow'=> '0px 0px 2px rgba(255,255,255,0.5)'
	]
);



/* Notice */
$Core->selector('.ims-notice'
	, [
		'font-size'=> '18px'
		,'text-align'=> 'center'
		,'max-width'=> '480px'
		,'width'=> '100vw'
		,'padding'=> '20px 15px'
		,'color'=> $Core->styleProperty('dark-font-color')
		,'background-color'=> $Core->styleProperty('dark-background-color')
		,'border-radius'=> '100px'
	]
);









/* Immersion Tâches */
$Core->selector('.ims-task.icon, body > .nav-bar > .tray > .item.icn.ims-task'
	, [
		'background-color'=> 'transparent !important'
	]
);

$Core->selector('.ims-task.icon:hover, body > .nav-bar > .tray > .item.icn.ims-task:hover'
	, [
		'background-color'=> 'transparent !important'
	]
);

$Core->selector('.ims-task.icon.rotate > img'
	, [
		'animation'=> 'ggnCircleLoading 1s linear infinite'
	]
);



/* GUI System Interface Immersion */
$Core->selector('.gui.system.interface.immersion'
	, [
		'left && top'=> '0px'
	]
);

	/* Menu */
	$Core->selector('.gui.system.interface.immersion.menu'
		, [
			'position'=> 'fixed'
			,'z-index'=> '10'
			,'width'=> '100vw'
			,'height'=> '100vh'
		]
	);

	/* Page */
	$Core->selector('.gui.system.interface.immersion.page'
		, [
			'position'=> 'static'
			,'z-index'=> '5'
			// ,'overflow'=> 'auto'
			// ,'width && height'=> '100%'
		]
	);
	
	$Core->selector('.gui.system.interface.immersion.page > .title'
		, [
			'font-size'=>'25px'
			,'font-family'=>$Core->styleProperty('headling-fontLight-family')
			,'padding'=>'10px 12px'
		]
	);

	$Core->selector('.gui.system.interface.immersion.page > .container'
		, [
			// 'width && height'=> 'inherit'
			// 'background-color'=> '#555'
			// ,'overflow'=> 'hidden'
			// ,'overflow-y'=> 'auto'
		]
	);







/*
	Immersion Ascending ----------------
	: Debut
	: Ascendant = liste de donnée
*/
	$Core->selector('.ims-ascending'
		, [
			'width && height'=> 'inherit'
			,'flex-direction'=> 'column'
			// ,'border'=> '1px solid red'
		]
	);

	/* Entete */
	$Core->selector('.ims-ascending > .container'
		, [
			'width'=> 'inherit'
			// ,'border'=> '1px solid red'
			,'transform'=> 'scale(1)'
			,'transition'=> 'transform 0.3s ease-out'
		]
	);
	
	$Core->selector('.ims-ascending > .container:hover'
		, [
			// 'transform'=> 'scale(0.8)'
		]
	);

	$Core->selector('.ims-ascending > .container:hover > *:not(:hover)'
		, [
			// 'transform'=> 'scale(0.7)'
			'opacity'=> '0.1'
			,'filter'=> 'blur(5px)'
			,'animation'=> 'ims-fx-ascending-set-not-hover 0.3s ease-out'
		]
	);

	$Core->selector('.ims-ascending > .container:hover > *:hover'
		, [
			// 'transform'=> 'scale(1)'
			'opacity'=> '1'
			,'filter'=> 'blur(0px)'
			,'animation'=> 'ims-fx-ascending-unset-not-hover 0.3s ease-out'
		]
	);


	/* Entete */
	$Core->selector('.ims-ascending > .container > .head'
		, [
			'width'=> 'inherit'
			// ,'flex'=> '1'
			// ,'border'=> '1px solid red'
			// ,'padding-bottom'=> '20px'
			// ,'transform'=> 'scale(0.9)'
			// ,'background-color'=> '#444'
			,'transition'=> 'opacity 0.3s ease-out'
		]
	);
	
	$Core->selector('.ims-ascending > .container > .head:hover'
		, [
			// 'transform'=> 'scale(1.1)'
		]
	);


		$Core->selector('.ims-ascending > .container > .head > .categories'
			, [
				'width'=> 'inherit'
			]
		);

		$Core->selector('.ims-ascending > .container > .head > .categories > .title'
			, [
				'font-size'=>'18px'
				,'padding'=>'7px 12px'
				,'font-family'=>$Core->styleProperty('headling-fontLight-family')
				,'display'=>'none'
			]
		);

		$Core->selector('.ims-ascending > .container > .head > .categories > .items'
			, [
				'flex-direction'=>'row'
				// ,'border-bottom'=> '1px solid rgba('.$Core->styleProperty('font-color-rgb:hover').',.2)'
			]
		);

		$Core->selector('.ims-ascending > .container > .head > .categories > .items > .item.ims-button'
			, [
				'color'=>$Core->styleProperty('font-color:hover')
				,'padding'=>'5px 15px'
				,'margin-right'=>'5px'
				,'background-color'=>'transparent'
				,'transition'=>'background-color 0.3s ease-out'
			]
		);

		$Core->selector('.ims-ascending > .container > .head > .categories > .items > .item.ims-button:hover'
			, [
				'background-color'=>''.$Core->styleProperty('palette-primary-color').''
				,'color'=>$Core->styleProperty('font-color')
			]
		);

		$Core->selector('.ims-ascending > .container > .head > .categories > .items > .item:last-child'
			, [
				// 'margin-right'=>'0px'
			]
		);

		$Core->selector('.ims-ascending > .container > .head > .categories > .items > .item.active'
			, [
				'background-color'=>''.$Core->styleProperty('palette-primary-color').''
				,'box-shadow'=>'0px 0px 5px rgba(0,0,0,.3)'
				,'color'=>$Core->styleProperty('font-color')
			]
		);


	/* Corps */
	$Core->selector('.ims-ascending > .container > .body'
		, [
			'position'=> 'relative'
			,'width'=> 'inherit'
			,'flex'=> '1'
			// ,'transform'=> 'scale(0.9)'
			// ,'background-color'=> '#333'
			,'transition'=> 'opacity 0.3s ease-out'
		]
	);

	$Core->selector('.ims-ascending > .container > .body:hover'
		, [
			// 'transform'=> 'scale(1)'
		]
	);



		/* Parcourir */
		$Core->selector('.ims-ascending > .container > .body > .browse'
			, [
				'width'=> '48px'
				,'position'=> 'absolute'
				,'top'=> '0px'
				,'z-index'=> '10'
				,'height'=> '100%'
				,'background-color'=> 'transparent'
				,'background-repeat'=> 'no-repeat'
				,'background-position'=> 'center'
				,'opacity'=> '0.0'
				,'transition'=> 'background-color 0.3s ease-out'
			]
		);

		$Core->selector('.ims-ascending > .container > .body:hover > .browse'
			, [
				'opacity'=> '1'
			]
		);

		$Core->selector('.ims-ascending > .container > .body > .browse:hover'
			, [
				'background-color'=> 'rgba('.$Core->styleProperty('font-color-rgb').',.25)'
			]
		);

		$Core->selector('.ims-ascending > .container > .body > .browse.previous'
			, [
				'left'=> '0px'
				,'background-image'=> 'url('.$GAppsPath.'back.png'.$GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=25&height=25)'
			]
		);

		$Core->selector('.ims-ascending > .container > .body > .browse.previous:hover'
			, [
				'background-image'=> 'url('.$GAppsPath.'back.png'.$GUI['IMAGE_FILTER_TEXT_COLOR_TONE'].'&width=25&height=25)'
			]
		);

		$Core->selector('.ims-ascending > .container > .body > .browse.next'
			, [
				'right'=> '0px'
				,'background-image'=> 'url('.$GAppsPath.'forward.png'.$GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=25&height=25)'
			]
		);

		$Core->selector('.ims-ascending > .container > .body > .browse.next:hover'
			, [
				'background-image'=> 'url('.$GAppsPath.'forward.png'.$GUI['IMAGE_FILTER_TEXT_COLOR_TONE'].'&width=25&height=25)'
			]
		);


		/* Contenu */
		$Core->selector('.ims-ascending > .container > .body > .content'
			, [
				'width'=> '150vw'
				,'overflow'=> 'hidden'
				,'overflow-x'=> 'none'
				,'transition'=> 'width 0.3s ease-out'
			]
		);

		$Core->selector('.ims-ascending > .container > .body:hover > .content'
			, [
				'width'=> '100vw'
				,'overflow'=> 'hidden'
			]
		);


		$Core->selector('.ims-ascending > .container > .body > .content > .list'
			, [
				'display'=> ['-webkit-flex', 'flex']
				,'position'=> 'relative'
				,'top && left'=> '0px'
				,'padding'=> '20px'
				,'align-items'=> 'left'
				,'justify-content'=> 'left'
				,'height'=> 'inherit'
			]
		);

		$Core->selector('.ims-ascending > .container > .body > .content > .list:hover > .element:not(:hover)'
			, [
				'opacity'=> '0.3'
			]
		);


		$Core->selector('.ims-ascending > .container > .body > .content > .list > .element'
			, [
				'width'=> '320px'
				,'height'=> '450px'
				,'color'=> $Core->styleProperty('dark-font-color')
				,'background-color'=> 'rgba('.$Core->styleProperty('dark-background-color-rgb').',2)'
				,'box-shadow'=> '0px 0px 5px rgba(0,0,0,.5)'
				,'margin-right'=> '0px'
				,'transform'=> 'scale(0.8)'
				,'transition'=> 'transform 0.3s ease-out'
				,'overflow'=> 'hidden'
			]
		);

		$Core->selector('.ims-ascending > .container > .body > .content > .list > .element.open'
			, [
				'width'=> '650px'
				,'animation'=> 'ims-fx-ascending-open-element 0.3s ease-out'
			]
		);

		$Core->selector('.ims-ascending > .container > .body > .content > .list > .element.close'
			, [
				'width'=> '320px'
				,'animation'=> 'ims-fx-ascending-close-element 0.3s ease-out'
			]
		);

		$Core->selector('.ims-ascending > .container > .body > .content > .list > .element:hover'
			, [
				'transform'=> 'scale(1)'
			]
		);

		$Core->selector('.ims-ascending > .container > .body > .content > .list > .element:first-child'
			, [
				'margin-left'=> '48px'
			]
		);

		$Core->selector('.ims-ascending > .container > .body > .content > .list > .element:last-child'
			, [
				'margin-right'=> '50px'
			]
		);

		$Core->selector(
			'.ims-ascending > .container > .body > .content > .list > .element > .thumb'
			. ',.ims-ascending > .container > .body > .content > .list > .element.open > .thumb'
			, [
				'width'=> '320px'
				,'height'=> '100%'
				// ,'z-index'=> '1'
			]
		);


		$Core->selector('.ims-ascending > .container > .body > .content > .list > .element > .infos'
			, [
				
				'animation'=> 'imsTranslateYOut 0.3s ease-out'
				,'opacity'=> '0.0'
				,'transform'=> 'translateY(100%)'
				,'width'=>'0px'
				,'flex-direction'=>'column'
				,'flex'=>'1 auto'
				,'overflow'=>'hidden'
			]
		);

		$Core->selector('.ims-ascending > .container > .body > .content > .list > .element.open > .infos'
			, [
				
				'animation'=> 'iImsTranslateYIn 0.3s ease-out'
				,'opacity'=> '1'
				,'transform'=> 'translateY(0px)'
				// ,'width'=>'270px'
				,'padding-left && padding-right'=>'10px'
			]
		);

			$Core->selector('.ims-ascending > .container > .body > .content > .list > .element.open > .infos > .title'
				, [
					
					'font-size'=> '30px'
					,'font-family'=> $Core->styleProperty('headling-fontLight-family')
					,'padding'=> '10px 7px'
					,'color'=> $Core->styleProperty('font-color')
				]
			);

			$Core->selector('.ims-ascending > .container > .body > .content > .list > .element.open > .infos > .description'
				, [
					'flex'=> '1 auto'
					,'overflow'=> 'hidden'
					,'font-size'=> '13px'
					,'padding'=> '5px 7px'
					,'color'=> 'rgba(' . $Core->styleProperty('font-color-rgb') . ',.5)'
				]
			);

			$Core->selector('.ims-ascending > .container > .body > .content > .list > .element.open > .infos > .description:hover'
				, [
					'overflow-y'=> 'auto'
				]
			);


			$Core->selector('.ims-ascending > .container > .body > .content > .list > .element.open > .infos > .buttons'
				, [
					'flex-direction'=> 'row'
					,'padding'=> '10px 7px'
				]
			);
			
			$Core->selector('.ims-ascending > .container > .body > .content > .list > .element.open > .infos > .buttons > .btn'
				, [
					'font-size'=> '15px'
					// ,'padding-left && padding-right'=> '15px'
					,'border-radius'=> '3px'
				]
			);
			
			$Core->selector('.ims-ascending > .container > .body > .content > .list > .element.open > .infos > .buttons > .btn.icon'
				, [
					'width && height'=> '25px'
				]
			);
			


/* Ascending Detail */
$Core->selector(
		'.ims-ascending-detail-locker'
		. ',.ims-ascending-detail'
	, [
		
		'position'=> 'fixed'
		,'width'=> '100vw'
		,'display'=> 'none'
	]
);

$Core->selector('.ims-ascending-detail-locker'
	, [
		'z-index'=> '999994'
		,'left && top'=> '0px'
		,'height'=> '100vh'
		,'background-color'=> 'rgba(0,0,0,.1)'
	]
);

$Core->selector('.ims-ascending-detail'
	, [
		'z-index'=> '999995'
		,'left && bottom'=> '0px'
		,'height'=> '90vh'
		,'flex-direction'=> 'column'
	]
);

$Core->selector('.ims-ascending-detail.static'
	, [
		'position'=> 'static'
		,'z-index'=> '0'
		,'display'=> 'flex'
	]
);

$Core->selector('.ims-ascending-detail.open'
	, [
		'animation'=> 'ggnTranslateYIn 0.3s ease-out'
		,'display'=> 'flex'
		,'color'=> $Core->styleProperty('dark-font-color')
		,'background-color'=> 'rgba(' . $Core->styleProperty('dark-background-color-rgb') . ',.64)'
		// ,'background-color'=> 'rgba(' . $Core->styleProperty('dark-background-color-rgb') . ',.80)'
	]
);

$Core->selector('.ims-ascending-detail.close'
	, [
		'animation'=> 'ggnTranslateYOut 0.3s ease-out'
	]
);

$Core->selector('.ims-ascending-detail > .head'
	, [
		'flex-direction'=> 'row'
		,'width'=> '100vw'
	]
);


$Core->selector('.ims-ascending-detail > .head > .btn'
	, [
		'width && height'=>'48px'
		,'background-repeat'=>'no-repeat'
		,'background-position'=>'center'
		,'transition'=>'background-color 0.3s ease-out'
		,'margin'=>'12px 10px'
		,'border-radius'=>'180px'
		,'background-color'=>'rgba('.$Core->styleProperty('font-color-rgb:hover').',.1)'
	]
);

$Core->selector('.ims-ascending-detail > .head > .btn.close'
	, [
		'background-image'=>'url('.$GAppsPath.'cross.png'.$GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=25&height=25)'
	]
);

$Core->selector('.ims-ascending-detail > .head > .btn.back'
	, [
		'background-image'=>'url('.$GAppsPath.'back.png'.$GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=25&height=25)'
	]
);

$Core->selector('.ims-ascending-detail > .head > .btn:hover'
	, [
		'background-color'=>'rgba('.$Core->styleProperty('font-color-rgb:hover').',.5)'
	]
);



$Core->selector('.ims-ascending-detail > .head > .title'
	, [
		'flex'=>'1'
		,'color'=>$Core->styleProperty('font-color')
		,'font-size'=>'40px'
		,'padding'=>'8px 20px 8px 10px'
		,'font-family'=> $Core->styleProperty('headling-fontLight-family')
	]
);

$Core->selector('.ims-ascending-detail > .body'
	, [
		'flex'=>'1 100%'
		,'height'=>'100%'
		,'overflow'=>'hidden'
		// ,'overflow-y'=>'auto'
	]
);

$Core->selector('.ims-ascending-detail > .body:hover'
	, [
		'overflow-y'=>'auto'
	]
);

$Core->selector('.ims-ascending-detail > .body > .content'
	, [
		'flex-direction'=>'column'
		,'width && min-height'=>'100%'
		,'height'=>'auto'
	]
);

$Core->selector('.ims-ascending-detail > .body > .content > .banner'
	, [
		'width'=>'100vw'
		,'height'=>'280px'
		,'background-color'=>'rgba(0,0,0,.1)'
		// ,'background-attachment'=>'fixed'
		,'position'=>'relative'
	]
);
	

	$Core->selector('.ims-ascending-detail > .body > .content > .banner > .open'
		, [
			'font-size'=>'32px'
			,'font-family'=>$Core->styleProperty('headling-fontLight-family')
			,'background-color'=>'rgba('.$Core->styleProperty('dark-background-color-rgb').',.90)'
			,'background-clip'=>'content-box'
			,'color'=>'' . $Core->styleProperty('font-color:hover')
			,'text-align'=>'center'
			,'width && height'=>'128px'
			,'position'=>'absolute'
			,'left'=>'32px'
			,'bottom'=>'32px'
			,'border-radius'=>'180px'
			,'border'=>'20px solid rgba(0,0,0,.2)'
			// ,'border-top-color'=>$Core->styleProperty('dark-background-color')
			,'transition'=>'background-color 0.3s ease-out'
		]
	);

	$Core->selector('.ims-ascending-detail > .body > .content > .banner > .open:hover'
		, [
			'background-color'=>''.$Core->styleProperty('palette-primary-color').''
			,'color'=>'' . $Core->styleProperty('font-color')
			// ,'border-top-color'=>'rgba('.$Core->styleProperty('font-color-rgb:hover').',.5)'
		]
	);


$Core->selector('.ims-ascending-detail > .body > .content > .details'
	, [
		'flex'=>'1 auto'
		,'flex-direction'=>'column'
		,'flex-wrap'=>'nowrap'
		// ,'width'=>'100%'
		,'margin-top'=>'30px'
		,'padding'=>'10px'
	]
);

	$Core->selector('.ims-ascending-detail > .body > .content > .details > .title'
		, [
			'font-size'=>'25px'
			,'text-align'=>'left'
			,'padding'=>'10px 20px'
			,'font-family'=>$Core->styleProperty('headling-fontLight-family')
		]
	);

	$Core->selector('.ims-ascending-detail > .body > .content > .details > .content'
		, [
			'width'=>'100vw'
		]
	);

	$Core->selector('.ims-ascending-detail > .body > .content > .details > .content > .col'
		, [
			'width'=>'48.5%'
			,'margin-right && margin-left'=>'0.5%'
			// ,'background-color'=>'rgba(0,0,0,.2)'
		]
	);

	$Core->selector('.ims-ascending-detail > .body > .content > .details > .content > .col > .item'
		, [
			'width'=>'100%'
			// ,'height'=>'256px'
			,'max-height'=>'512px'
			// ,'background-color'=>'rgba(0,0,0,.5)'
			,'border-bottom'=>'1px solid ' . $Core->styleProperty('dark-background-color')
			,'margin'=>'5px'
			,'margin-bottom'=>'30px'
		]
	);

	$Core->selector('.ims-ascending-detail > .body > .content > .details > .content > .col > .item > .title'
		, [
			'font-size'=>'20px'
			,'text-align'=>'left'
			,'padding'=>'7px 15px'
			,'font-family'=>$Core->styleProperty('headling-fontLight-family')
			,'border-left'=>'10px solid ' . $Core->styleProperty('palette-primary-color')
		]
	);

	$Core->selector('.ims-ascending-detail > .body > .content > .details > .content > .col > .item > .content'
		, [
			'font-size'=>'12px'
			,'text-align'=>'left'
			,'padding'=>'10px 15px 20px'
			,'overflow'=>'hidden'
			,'flex'=>'1 auto'
		]
	);

	$Core->selector('.ims-ascending-detail > .body > .content > .details > .content > .col > .item > .content:hover'
		, [
			'overflow-y'=>'auto'
		]
	);








/* Liste detail */
$Core->selector('.detail-list'
	, [
		'padding'=>'0px'
		,'flex-wrap'=>'wrap'
	]
);

$Core->selector('.detail-list > .item.i4'
	, [
		'width && height'=>'128px'
		,'margin'=>'5px'
	]
);

$Core->selector('.detail-list > .item.i2'
	, [
		'width'=>'48%'
		// ,'height'=>'128px'
		,'margin'=>'1%'
	]
);

$Core->selector('.detail-list > .item.i1'
	, [
		'width'=>'99%'
		// ,'height'=>'128px'
		,'margin'=>'5px'
	]
);

$Core->selector('.detail-list > .item'
	, [
		'position'=>'relative'
		,'font-size'=>'13px'
		,'overflow'=>'hidden'
		,'border-radius'=>'5px'
		,'color'=>'' . $Core->styleProperty('font-color:hover')
		,'background-color'=>'rgba(' . $Core->styleProperty('dark-background-color-rgb') . ',.75)'
		,'transition'=>'background-color 0.3s ease-out'
	]
);

$Core->selector('.detail-list > .item.active-hover:hover'
	, [
		'color'=> $Core->styleProperty('font-color')
		,'background-color'=>'' . $Core->styleProperty('palette-primary-color')
		// ,'border-left-width'=>'10px'
		// ,'border-left-color'=>'' . $Core->styleProperty('background-color')
	]
);

$Core->selector('.detail-list > .item > .thumb'
	, [
		'width'=> '150px'
		,'height'=> '128px'
		,'background-color'=> 'rgba(0,0,0,.2)'
		,'font-size'=> '11px'
	]
);

$Core->selector('.detail-list > .item > .progress-bar'
	, [
		'width'=> '100%'
		,'height'=> '5px'
	]
);

$Core->selector('.detail-list > .item > .txt'
	, [
		'flex'=> '1'
		,'padding'=> '10px 15px'
	]
);

$Core->selector('.detail-list > .item > .txt > .title'
	, [
		'font-size'=> '13px'
	]
);

$Core->selector('.detail-list > .item > .txt > .big-title'
	, [
		'font-size'=> '15px'
		,'color'=> $Core->styleProperty('dark-font-color')
	]
);

$Core->selector('.detail-list > .item > .txt > .about'
	, [
		'font-size'=> '12px'
		,'color'=> $Core->styleProperty('dark-font-color')
	]
);

$Core->selector('.detail-list > .item > .txt > .about b'
	, [
		'font-size'=> '12px'
		,'color'=> $Core->styleProperty('font-color:hover')
	]
);

$Core->selector(
		'.detail-list > .item > .txt > .note'
		. ',.detail-list > .item > .txt > .size'
	, [
		'color'=> $Core->styleProperty('dark-font-color')
	]
);

$Core->selector('.detail-list > .item > .txt > .note'
	, [
		'flex'=> '1'
		,'font-size'=> '35px'
		,'font-family'=> $Core->styleProperty('headling-fontLight-family')
	]
);

$Core->selector('.detail-list > .item > .txt > .size'
	, [
		'font-size'=> '15px'
	]
);



$Core->selector('.detail-list > .item > .lnk'
	, [
		'width'=> '48px'
		// ,'height'=> '32px'
		// ,'background-color'=> 'red'
		,'background-image'=> 'url(' . $GAppsPath . 'forward.png' . $GUI['IMAGE_FILTER_TEXT_HOVER_TONE'] . '&width=16&height=16)'
	]
);


$Core->selector('.detail-list > .item > .label'
	, [
		'padding'=> '5px 0px'
		,'position'=> 'absolute'
		,'left && bottom'=> '0px'
		,'margin-bottom'=> '-30px'
		,'width'=> '100%'
		,'color'=> $Core->styleProperty('dark-font-color')
		,'background-color'=>'rgba(' . $Core->styleProperty('dark-background-color-rgb') . ',.5)'
		,'transition'=> 'margin-bottom 0.3s ease-out'
	]
);

$Core->selector('.detail-list > .item:hover > .label'
	, [
		'margin-bottom'=> '0px'
	]
);

$Core->selector('.detail-list > .item > .label.copy'
	, [
		'margin'=> 'auto'
		,'margin-bottom'=> '0px'
		,'background-color'=>'transparent'
	]
);

$Core->selector('.detail-list > .item:hover > .label.copy'
	, [
		'margin-bottom'=> '-30px'
	]
);





/* Smart Menu : Recherche */
$Core->selector('.nav-bar > .smartmenu > .items > .item.search-bar'
	, [
		'background-image'=>'url('.$GAppsPath.'search.png'.$GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=25&height=25)'
	]
);






/* Menu Demarrer : Box */
$Core->selector('.ims-start-menu'
	, [
		'flex-direction'=> 'column'
		,'background-color'=> $Core->styleProperty('background-color')
	]
);

$Core->selector('[ims-effect="minimize"],.ims-start-menu.fx.minimize'
	, [
		'animation'=> 'imsTranslateYOut 0.3s ease-out'
		,'opacity'=> '0.0'
		,'transform'=> 'translateY(100%)'
	]
);

$Core->selector('[ims-effect="maximize"],.ims-start-menu.fx.maximize'
	, [
		'animation'=> 'iImsTranslateYIn 0.3s ease-out'
		,'opacity'=> '1'
		,'transform'=> 'translateY(0px)'
	]
);



/* Menu Demarrer : Pied de page */
$Core->selector('.ims-start-menu > .footer'
	, [
		'font-size'=> '12px'
		,'text-align'=> 'center'
		,'padding'=> '10px 12px'
		,'color'=> $Core->styleProperty('font-color:hover')
	]
);


/* Menu Demarrer : Fermer */
$Core->selector('.ims-start-menu > .close'
	, [
		'position'=> 'absolute'
		,'top && left'=> '0px'
		,'width && height'=> '40px'
		,'background-color'=> 'rgba('.$Core->styleProperty('font-color-rgb:hover').',.2)'
		,'background-image'=> 'url('.$GAppsPath.'cross.png'.$GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=16&height=16)'
		,'background-repeat'=> 'no-repeat'
		,'background-position'=> 'center'
	]
);

$Core->selector('.ims-start-menu > .close:hover'
	, [
		'background-color'=> ''.$Core->styleProperty('palette-primary-color').''
		,'background-image'=> 'url('.$GAppsPath.'cross.png'.$GUI['IMAGE_FILTER_TEXT_COLOR_TONE'].'&width=16&height=16)'
	]
);


/* Menu Demarrer : Titre */
$Core->selector(
		'.ims-start-menu > .title'
		. ',body > .nav-bar > .icon > .label'
	, [
		'font-size'=> '15px'
		,'text-align'=> 'center'
		,'padding'=> '10px 12px'
		,'color'=> $Core->styleProperty('font-color:hover') . ' !important'
		,'font-family'=> $Core->styleProperty('headling-fontLight-family')
	]
);

$Core->selector(
		'.ims-start-menu > .title b'
		. ',body > .nav-bar > .icon > .label b'
	, [
		'font-family'=> $Core->styleProperty('headling-fontBold-family')
		,'font-weight'=> 'bold'
	]
);


/* Menu Demarrer : Contenu */
$Core->selector('.ims-start-menu > .content'
	, [
		'flex'=> '1'
		,'width'=> '100%'
		,'height'=> '480px'
		// ,'border'=> '1px solid red'
		,'display'=>'-webkit-flex'
		,'display'=>'flex'
		,'flex-direction'=> 'column'
	]
);


/* Menu Demarrer : Logo */
$Core->selector('.ims-start-menu > .content > .logo'
	, [
		'width && height'=> '256px'
		,'background-color'=> 'transparent'
		,'background-image'=> 'url(' . $SysPath . 'app-logo.png' . $GUI['IMAGE_FILTER_TEXT_HOVER_TONE'] . ')'
		,'background-repeat'=> 'no-repeat'
		,'background-position'=> 'center'
		,'transform'=> 'scale(1)'
		,'opacity'=> '1'
	]
);

$Core->selector('.ims-start-menu > .content > .logo.before-play'
	, [
		'opacity'=> '0.0'
		,'transform'=> 'scale(0.1)'
	]
);

$Core->selector('.ims-start-menu > .content > .logo.play'
	, [
		'animation'=> 'ggnScaleIn 0.25s ease-out'
	]
);



/* Menu Demarrer : Menu */
$Core->selector('.ims-start-menu > .content > .menu'
	, [
		'width'=> '256px'
		,'opacity'=> '1'
		// ,'height'=> '48px'
	]
);

$Core->selector('.ims-start-menu > .content > .menu.before-play'
	, [
		'opacity'=> '0.0'
	]
);

$Core->selector('.ims-start-menu > .content > .menu.play'
	, [
		'animation'=> 'imsTranslateYIn 0.25s ease-out'
	]
);



$Core->selector('.ims-start-menu > .content > .menu > .label'
	, [
		'text-align'=> 'center'
		,'font-size'=> '12vpx'
		,'padding'=> '7px 12px'
		,'color'=> $Core->styleProperty('font-color:hover')
	]
);


$Core->selector('.ims-start-menu > .content > .menu > .items'
	, [
		'flex-wrap'=> 'wrap'
		// ,'border'=> '1px solid red'
	]
);

$Core->selector('.ims-start-menu > .content > .menu > .items > .item'
	, [
		'width && height'=> '32px'
		,'cursor'=> 'pointer'
		,'background-repeat'=> 'no-repeat'
		,'background-position'=> 'center'
		,'background-size'=> '64%'
		,'margin-right && margin-left'=> '2px'
		// ,'border'=> '1px solid red'
		,'transition'=> 'background-size 0.25s ease-out'
	]
);

$Core->selector('.ims-start-menu > .content > .menu > .items > .item:hover'
	, [
		'background-size'=> '100%'
	]
);









/* LockerBox */

$Core->selector('.big.ims-locker[gui-api="g.lockbox"]'
	, []
);

$Core->selector('.light.ims-locker[gui-api-lockbox="ultra.light"]'
	, [
		'background-color'=> 'rgba('.$GUI['DARK_TONE_RGB'].',.64)'
	]
);

$Core->selector('.box.ims-locker[gui-api-lockbox="ultra.box"]'
	, [
		'background-color'=>'rgba('.$GUI['DARK_TONE_RGB'].',.1)'
		,'border-radius'=> '5px'
	]
);

$Core->selector('.box.ims-locker > .title'
	, [
		'font-size'=> '30px' 
		,'font-family'=> $Core->styleProperty('headling-fontLight-family') 
		,'padding'=> '10px 12px' 
		,'text-align'=> 'center' 
		// ,'border-bottom'=> '5px solid ' . $Core->styleProperty('font-color:hover')
	]
);

$Core->selector('.box.ims-locker > .content'
	, [
		// 'font-size'=> '18px' 
	]
);

$Core->selector('.box.ims-locker > .content > .nfo'
	, [
		'font-size'=>'14px'
		,'color'=>'rgba('.$GUI['LIGHT_TONE_RGB'].'.8)'
		,'padding'=>'10px 20px 15px'
		,'text-align'=>'center'
	]
);

$Core->selector('.box.ims-locker > .content > .btns'
	, [
	]
);

$Core->selector('.box.ims-locker > .content > .btns > .btn'
	, [
		'position'=> 'relative'
		,'width'=> '96px' 
		,'height'=> '128px' 
		,'background-repeat'=> 'no-repeat' 
		,'background-position'=> 'center' 
		,'background-color'=> 'rgba('.$GUI['DARK_TONE_RGB'].',.2)' 
		,'border-radius'=> '5px'
		,'margin-right'=> '5px'
		,'cursor'=> 'pointer'
	]
);

$Core->selector('.box.ims-locker > .content > .btns > .btn:last-child'
	, [
		'margin-right'=> '0px'
	]
);

$Core->selector('.box.ims-locker > .content > .btns > .btn:hover'
	, [
		'background-color'=> 'rgba('.$Core->styleProperty('font-color-rgb:hover').',.2)'
	]
);

$Core->selector('.box.ims-locker > .content > .btns > .btn:hover'
	, [
		'color'=> $Core->styleProperty('font-color')
	]
);

$Core->selector('.box.ims-locker > .content > .btns > .btn > .label'
	, [
		'position'=> 'absolute'
		,'font-family'=> $Core->styleProperty('headling-fontLight-family') 
		,'font-size'=> '15px'
		,'text-align'=> 'center'
		,'width'=> 'inherit'
		,'bottom'=> '10px'
	]
);

$Core->selector('.box.ims-locker > .content > .btns > .btn.locker'
	, [
		'background-image'=> 'url('.$GAppsPath.'lock.png'.$GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=32&height=32)' 
	]
);

$Core->selector('.box.ims-locker > .content > .btns > .btn.out'
	, [
		'background-image'=> 'url('.$GAppsPath.'forward.png'.$GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=32&height=32)' 
	]
);

$Core->selector('.box.ims-locker > .content > .btns > .btn.back'
	, [
		'background-image'=> 'url('.$GAppsPath.'back.png'.$GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=32&height=32)' 
	]
);

$Core->selector('.box.ims-locker > .content > .btns > .btn.cancel'
	, [
		'background-image'=> 'url('.$GAppsPath.'cross.png'.$GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=32&height=32)' 
	]
);









/* NavBar */
$Core->selector('body > .gapps > .body-main'
	, [
		// 'background-color'=> 'rgba(0,0,0,.90) !important' 
		// 'background-color'=> 'rgba('.$Core->styleProperty('dark-background-color-rgb').',.96) !important' 
	]
);










/* NavBar */
$Core->selector('body > .nav-bar'
	, [
		// 'background-color'=> 'rgba(0,0,0,.96) !important' 
		'background-color'=> 'rgba('.$Core->styleProperty('background-color-rgb').',.75) !important' 
		,'border-bottom'=> '0px solid transparent !important'
	]
);

/* Back Pad */
$Core->selector('body > .nav-bar > .back-pad'
	, [
		'background-image'=>'url(' . $SysPath . 'ggn-app-icon.png'. $GUI['IMAGE_FILTER_TEXT_HOVER_TONE'].'&width=25&height=25) !important'
	]
);

$Core->selector('body > .nav-bar > .back-pad:hover'
	, [
		'background-image'=>'url('.$SysPath.'ggn-app-icon.png'.$GUI['IMAGE_FILTER_TEXT_COLOR_TONE'].'&width=25&height=25) !important'
	]
);

/* Logo icone */
$Core->selector('body > .nav-bar > .icon > .label'
	, [
		'padding'=>'5px 0px'
		,'text-align'=>'left'
	]
);

/* Menu > Item */
$Core->selector(
		'body > .nav-bar > .menu > .item'
		. ',body > .nav-bar > .menu > * > .item'
		. ',body > .nav-bar > .tray > .item'
		. ',body > .nav-bar > .tray > * > .item'
	, [
		'color'=>'' . $Core->styleProperty('font-color:hover') . ' !important'
	]
);

/* Menu > Item:hover */
$Core->selector(
		'body > .nav-bar > .menu > .item:hover'
		. ',body > .nav-bar > .menu > * > .item:hover'
		. ',body > .nav-bar > .tray > .item:hover'
		. ',body > .nav-bar > .tray > * > .item:hover'
	, [
		'background-color'=>'rgba(' . $Core->styleProperty('font-color-rgb:hover') . ',.1) !important'
	]
);








/* Util */

$Core->selector('.ims-fx-scale'
	, [
		'transform'=>'scale(0.8)'
		,'transition'=>'transform 0.3s ease-out'
	]
);

$Core->selector('.ims-fx-scale:hover'
	, [
		'transform'=>'scale(1)'
	]
);





/* Effets */

/* FX */

/* Ascending Element */
$Core->keyframes('ims-fx-ascending-open-element'
	, 
		'{0%{width:320px;} '
		. '100%{width:650px;} }'
	, true
);

$Core->keyframes('ims-fx-ascending-close-element'
	, 
		'{0%{width:650px;} '
		. '100%{width:320px;} }'
	, true
);



/* Ascending Not Hover */
$Core->keyframes('ims-fx-ascending-set-not-hover'
	, 
		'{0%{'
			// . $Core::browserKey('transform','scale(1)') 
			. $Core::browserKey('filter','blur(0px)') 
			. $Core::browserKey('opacity','1') . 
		'}100%{' 
			// . $Core::browserKey('transform','scale(0.8)') 
			. $Core::browserKey('filter','blur(5px)') 
			. $Core::browserKey('opacity','0.1') . 
		'} }'
	, true
);

$Core->keyframes('ims-fx-ascending-unset-not-hover'
	, 
		'{0%{'
			. $Core::browserKey('transform','scale(0.8)') 
			. $Core::browserKey('filter','blur(5px)') 
			. $Core::browserKey('opacity','0.1') . 
		'}100%{' 
			. $Core::browserKey('transform','scale(1)') 
			. $Core::browserKey('filter','blur(0px)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);



/* Entrée */
$Core->keyframes('imsTranslateYIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','scale(1.5) translateY(100%)') 
			. $Core::browserKey('opacity','0.0') . 
		'} 100%{' 
			. $Core::browserKey('transform','scale(1) translateY(0px)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);

$Core->keyframes('iImsTranslateYIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','scale(0) translateY(100%)') 
			. $Core::browserKey('opacity','0.0') . 
		'} 100%{' 
			. $Core::browserKey('transform','scale(1) translateY(0px)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);

$Core->keyframes('imsTranslate-YIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','scale(1.5) translateY(-100%)') 
			. $Core::browserKey('opacity','0.0') . 
		'} 100%{' 
			. $Core::browserKey('transform','scale(1) translateY(0px)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);


/* Sortie */
$Core->keyframes('imsTranslateYOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','scale(1) translateY(0px)') 
			. $Core::browserKey('opacity','1') . 
		'} 100%{' 
			. $Core::browserKey('transform','scale(0) translateY(100%)') 
			. $Core::browserKey('opacity','0.0') . 
		'} }'
	, true
);

$Core->keyframes('imsTranslate-YOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','scale(1) translateY(0px)') 
			. $Core::browserKey('opacity','1') . 
		'} 100%{' 
			. $Core::browserKey('transform','scale(0) translateY(-100%)') 
			. $Core::browserKey('opacity','0.0') . 
		'} }'
	, true
);




?>