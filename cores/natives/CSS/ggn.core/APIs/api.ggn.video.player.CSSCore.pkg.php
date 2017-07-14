<?php

	
	
/* PARAMETRES */
require self::commonFile('.settings');


$VideoPath = './ggn.video.player/';




/* Lecteur */
$Core->selector('#ggn-video-player'
	, [
		'background-color'=>'#000'
	]
);




/* Positionnement */
$Core->selector('#ggn-video-player'
		. ',#controller-pad'
		. ',#menu-box'
		. ',#controller-box'
		. ',#logo-tv'
		. ',#slider-box'
		. ',#slider-cache'
		. ',#slider-loaded'
		. ',#slider-informer'
		. ',#slider-pointer'
		. ',#screen-pad'
		. ',#screen-hide'
		. ',#screen-box'
		. ',#video-status'
	, [
		'position'=>'absolute'
	]
);

/* Position X - Y */
$Core->selector('#ggn-video-player'
		. ',#menu-box'
		. ',#controller-pad'
		. ',#screen-pad'
		. ',#screen-hide'
		. ',#screen-box'
	, ['top && left'=>'0px']
);

$Core->selector('#controller-box'
	. ',#slider-box'
	, ['bottom && left'=>'0px']
);

$Core->selector('#logo-tv'
	, ['top && right'=>'0px']
);


/* Position Z */
$Core->selector('#logo-tv'
		. ',#screen-hide'
		. ',#slider-pointer'
	, ['z-index'=>'20']
);

$Core->selector('#ggn-video-player'
		. ',#controller-pad'
		. ',#menu-box'
		. ',#slider-box'
		. ',#slider-informer'
		. ',#slider-loaded'
	, ['z-index'=>'10']
);

$Core->selector('#screen-pad'
	. ',#screen-box'
	. ',#slider-cache'
	, ['z-index'=>'5']
);





/* Formes */
$Core->selector('#ggn-video-player'
		. ',#controller-pad'
		. ',#screen-pad'
		. ',#screen-hide'
		. ',#screen-box'
		. ',#screen-video'
	, ['width && height'=>'100%']
);

$Core->selector('#logo-tv'
	, ['width && height'=>'48px']
);

$Core->selector('#menu-box > .item'
	, ['width && height'=>'16px']
);



/* Statut de la video */
$Core->selector('#video-status'
	, [
		'width && height'=>'64px'
		,'background-color'=>'rgba(0,0,0,.40)'
		,'border-radius'=>'5px'
		,'opacity'=>'0'
		,'transition'=>'opacity 0.3 ease-out'
	]
);

$Core->selector('#video-status.no'
	, [
		'opacity'=>'0'
		,'animation'=>'ggnScaleOut 0.25s ease-out'
	]
);

$Core->selector('#video-status.waiting'
	, [
		'opacity'=>'1'
		,'animation'=>'ggnScaleIn 0.3s ease-out'
	]
);

$Core->selector('#video-status.playing'
	, [
		'opacity'=>'1'
		,'background-image'=>'url('.$VideoPath.'play.png'. $GUI['IMAGE_FILTER_LIGHT_TONE'].'&width=20&height=20)'
		,'animation'=>'ggnScalexIn 0.3s ease-out'
	]
);

$Core->selector('#video-status.pause'
	, [
		'opacity'=>'1'
		,'background-image'=>'url('.$VideoPath.'pause.png'. $GUI['IMAGE_FILTER_LIGHT_TONE'].'&width=25&height=25)'
		,'animation'=>'ggnScaleIn 0.3s ease-out'
	]
);

$Core->selector('#video-status.replay'
	, [
		'opacity'=>'1'
		,'background-image'=>'url('.$VideoPath.'re-play-g.png'. $GUI['IMAGE_FILTER_PRIMARY_TONE'].'&width=48&height=48)'
		,'animation'=>'ggnScaleIn 0.3s ease-out'
	]
);





/* Arrière plan, Couleurs et Style */


/* controller-pad */
	$Core->selector('#ggn-video-player > #controller-pad'
			. ',#ggn-video-player.fullscreen > #controller-pad'
			. ',#ggn-video-player.fullscreen:hover > #controller-pad'
		, [
			'opacity'=>'0.3'
			,'cursor'=>'pointer'
			,'transition'=>'opacity 0.3s ease-out'
		]
	);
	$Core->selector('#ggn-video-player:hover > #controller-pad', ['opacity'=>'1']);

	$Core->selector('#ggn-video-player.fullscreen > #controller-pad'
			. ',#ggn-video-player.fullscreen:hover > #controller-pad'
		, [
			'cursor'=>'url('.HTTP_HOST.'transparent.png), pointer'
		]
	);
/* controller-pad Fin */





/* Arriere plan Image */
	$Core->selector('#menu-box > .item'
			. ',#logo-tv'
			. ',#play-pause'
			. ',#shuffle'
			. ',#loop'
			. ',#fullscreen'
			. ',#volume > .vol-icon'
			. ',#video-status'
		, [
			'background-repeat'=>'no-repeat'
			,'background-position'=>'center'
		]
	);
/* Arriere plan FIN */




/* Menu Box */
	$Core->selector('#menu-box'
		, [
			'padding'=>'0px 5px'
		]
	);
	$Core->selector('#menu-box > .item'
		, [
			'padding'=>'5px 7px'
			,'opacity'=>'0.50'
			,'cursor'=>'pointer'
			,'transition'=>'opacity 0.3s ease-out'
			// ,'background-color'=>'red'
		]
	);
	$Core->selector('#menu-box > .item:first-child', ['padding-top'=>'20px']);
	$Core->selector('#menu-box > .item:hover'
		, [
			'opacity'=>'1'
		]
	);

	$Core->selector('#menu-box > .item#menu-pad', ['background-image'=>'url(' . $VideoPath . 'menu-pad.png'. $GUI['IMAGE_FILTER_GRAY_TONE'].'&width=16&height=12)']);
	$Core->selector('#menu-box > .item#menu-pad:hover', ['background-image'=>'url(' . $VideoPath . 'menu-pad.png'. $GUI['IMAGE_FILTER_PRIMARY_TONE'].'&width=16&height=12)']);
	$Core->selector('#menu-box > .item#menu-share', ['background-image'=>'url(' . $VideoPath . 'share.png'. $GUI['IMAGE_FILTER_GRAY_TONE'].'&width=16&height=16)']);
	$Core->selector('#menu-box > .item#menu-share:hover', ['background-image'=>'url(' . $VideoPath . 'share.png'. $GUI['IMAGE_FILTER_PRIMARY_TONE'].'&width=16&height=16)']);

/* Menu Box Fin */




/* Controller Box */

	$Core->selector('#controller-box'
			.',#ggn-video-player.fullscreen:hover > #controller-pad > #controller-box'
		, [
			'display'=>'-webkit-flex'
			,'display'=>'flex'
			,'width'=>'100%'
			// ,'background-color'=>'rgba(0,0,0,.10)'
			,'transition'=>'background-image 0.3s ease-out'
		]
	);
	$Core->selector('#ggn-video-player:hover > #controller-pad > #controller-box'
		, [
			'background-image'=>'url(' . $VideoPath . 'bg-ctrl.png)'
			,'background-repeat'=>'repeat-x'
			,'background-position'=>'bottom'
		]
	);


	/* Control */
		$Core->selector('#controller-box > #control'
			.',#ggn-video-player.fullscreen:hover > #controller-pad > #controller-box > #control'
			, [
				'display'=>'-webkit-flex'
				,'display'=>'flex'
				// ,'height'=>'inherit'
				,'transform'=>'scale(0.0)'
				,'transition'=>'transform 0.3s ease-out'
			]
		);

		$Core->selector('#ggn-video-player:hover > #controller-pad > #controller-box > #control'
			, [
				'transform'=>'scale(1)'
			]
		);

		$Core->selector('#controller-box > #control > .item'
			, [
				'width'=>'40px'
				,'height'=>'inherit'
				// ,'margin-left'=>'1px'
				// ,'background-color'=>'red'
			]
		);

		$Core->selector('#controller-box > #control > .item#play-pause'
			, [
				'width'=>'52px'
				,'cursor'=>'pointer'
			]
		);
		
		$Core->selector('#controller-box > #control > .item.play#play-pause', ['background-image'=>'url('.$VideoPath.'play.png'. $GUI['IMAGE_FILTER_LIGHT_TONE'].'&width=20&height=20)']);
		$Core->selector('#controller-box > #control > .item.play#play-pause:hover', ['background-image'=>'url('.$VideoPath.'play.png'. $GUI['IMAGE_FILTER_PRIMARY_TONE'].'&width=20&height=20)']);
		// $Core->selector('#controller-box > #control > .item.play-over#play-pause', ['background-image'=>'url('.$VideoPath.'play-over.png)']);

		$Core->selector('#controller-box > #control > .item.pause#play-pause', ['background-image'=>'url('.$VideoPath.'pause.png'. $GUI['IMAGE_FILTER_LIGHT_TONE'].'&width=20&height=20)']);
		$Core->selector('#controller-box > #control > .item.pause#play-pause:hover', ['background-image'=>'url('.$VideoPath.'pause.png'. $GUI['IMAGE_FILTER_PRIMARY_TONE'].'&width=20&height=20)']);

		$Core->selector('#controller-box > #control > .item.re-play#play-pause', ['background-image'=>'url('.$VideoPath.'re-play.png'. $GUI['IMAGE_FILTER_LIGHT_TONE'].'&width=20&height=20)']);
		$Core->selector('#controller-box > #control > .item.re-play#play-pause:hover', ['background-image'=>'url('.$VideoPath.'re-play.png'. $GUI['IMAGE_FILTER_PRIMARY_TONE'].'&width=20&height=20)']);

	/* Control FIN */




	/* Durée */
		$Core->selector('#controller-box > #duration'
				. ',#controller-box > #shuffle'
				. ',#controller-box > #volume'
				. ',#controller-box > #loop'
				. ',#controller-box > #fullscreen'
			, [
				'margin-left'=>'auto'
				,'margin-right'=>'1px'
				,'font-size'=>'14px'
				,'text-align'=>'right'
				,'padding'=>'10px 12px'
				,'cursor'=>'pointer'
			]
		);

		$Core->selector('#controller-box > #duration'
			, [
				'flex'=>'1'
				,'cursor'=>'default'
			]
		);

		$Core->selector('#controller-box > #duration > #duration-current'
			, [
				'color'=>$Core->styleProperty('font-color')
				,'font-family'=>'RobotoCondensedBold,arial,verdana'
				,'font-weight'=>'bold'
			]
		);
		$Core->selector('#controller-box > #duration > #duration-total'
			, [
				'color'=>'rgba(' . $Core->styleProperty('font-color-rgb') .',.5)'
				,'transition'=>'color 0.3s ease-out'
			] 
		);

		/* Hover */
		$Core->selector('#controller-box:hover > #duration > #duration-total', ['color'=>$Core->styleProperty('palette-primary-color')]);

	/* Durée FIN */






	/* Shuffle & Volume & loop & fullscreen */
		$Core->selector('#controller-box > #shuffle'
				. ',#controller-box > #loop'
				. ',#controller-box > #fullscreen'

				. ',#ggn-video-player.fullscreen:hover > #controller-pad > #controller-box > #shuffle'
				. ',#ggn-video-player.fullscreen:hover > #controller-pad > #controller-box > #loop'
				. ',#ggn-video-player.fullscreen:hover > #controller-pad > #controller-box > #fullscreen'
			, [
				'width && height'=>'15px'
				,'margin'=>'12px 5px'
				,'padding'=>'0px'
				,'background-size'=>'100%'
				,'transition'=>'width 0.3s ease-out'
			]
		);

		$Core->selector('#ggn-video-player:hover > #controller-pad > #controller-box > #shuffle'
				. ',#ggn-video-player:hover > #controller-pad > #controller-box > #loop'
				. ',#ggn-video-player:hover > #controller-pad > #controller-box > #fullscreen'
			, [
				'width && height'=>'18px'
				,'margin-top && margin-bottom'=>'10px'
			]
		);


		$Core->selector('#controller-box > #shuffle'.',#controller-box > .disable#shuffle'
			, [
				'background-image'=>'url('.$VideoPath.'shuffle.png'. $GUI['IMAGE_FILTER_LIGHT_TONE'].'&width=20&height=20)'
			]
		);
		$Core->selector('#controller-box > .enable#shuffle'
				. ',#controller-box > #shuffle:hover'
			, [
				'background-image'=>'url('.$VideoPath.'shuffle.png'. $GUI['IMAGE_FILTER_PRIMARY_TONE'].'&width=20&height=20)'
			]
		);


		/* Loop */
		$Core->selector('#controller-box > #loop'
				. ',#controller-box > .disable#loop'
			, [
				'background-image'=>'url('.$VideoPath.'loop.png'. $GUI['IMAGE_FILTER_LIGHT_TONE'].'&width=20&height=20)'
			]
		);
		$Core->selector('#controller-box > .enable#loop'
				. ',#controller-box > #loop:hover'
			, [
				'background-image'=>'url('.$VideoPath.'loop.png'. $GUI['IMAGE_FILTER_PRIMARY_TONE'].'&width=20&height=20)'
			]
		);


		/* fullscreen */
		$Core->selector('#controller-box > #fullscreen'
			, [
				'background-image'=>'url('.$VideoPath.'fullscreen.png'. $GUI['IMAGE_FILTER_LIGHT_TONE'].'&width=20&height=20)'
			]
		);
		$Core->selector('#controller-box > #fullscreen:hover'
			, [
				'background-image'=>'url('.$VideoPath.'fullscreen.png'. $GUI['IMAGE_FILTER_PRIMARY_TONE'].'&width=20&height=20)'
			]
		);

		$Core->selector('#controller-box > #fullscreen.exit'
			, [
				'background-image'=>'url('.$VideoPath.'exit-fullscreen.png'. $GUI['IMAGE_FILTER_LIGHT_TONE'].'&width=20&height=20)'
			]
		);
		$Core->selector('#controller-box > #fullscreen.exit:hover'
			, [
				'background-image'=>'url('.$VideoPath.'exit-fullscreen.png'. $GUI['IMAGE_FILTER_PRIMARY_TONE'].'&width=20&height=20)'
			]
		);




		/* Volume */
		$Core->selector('#controller-box > #volume'
				.',#ggn-video-player.fullscreen:hover > #controller-pad > #controller-box > #volume'
			, [
				'display'=>'-webkit-flex'
				,'display'=>'flex'
				,'padding-top'=>'17px'
				,'padding-left'=>'0px'
				,'margin-left'=>'5px'
			]
		);


		$Core->selector('#controller-box > #volume > .vol-unit'
				. ',#ggn-video-player.fullscreen:hover > #controller-pad > #controller-box > #volume > .vol-unit'
			, [
				'width'=>'5px'
				,'height'=>'5px'
				,'cursor'=>'pointer'
				,'margin-left'=>'2px'
				,'background-color'=>$Core->styleProperty('palette-primary-color')
				,'border-top-left-radius && border-bottom-right-radius'=>'5px'
			]
		);

		$Core->selector('#controller-box > #volume > .vol-icon'
				.',#ggn-video-player.fullscreen:hover > #controller-pad > #controller-box > #volume > .vol-icon'
			, [
				'width && height'=>'16px'
				,'margin-top'=>'-5px'
				,'background-size'=>'100%'
			]
		);

		$Core->selector('#controller-box > #volume > .vol-icon.on'
				.',#ggn-video-player.fullscreen:hover > #controller-pad > #controller-box > #volume > .vol-icon.on'
			, ['background-image'=>'url('.$VideoPath.'audio-on.png'. $GUI['IMAGE_FILTER_LIGHT_TONE'].'&width=20&height=20)'] 
		);
		$Core->selector('#controller-box > #volume > .vol-icon.on:hover'
			, ['background-image'=>'url('.$VideoPath.'audio-on.png'. $GUI['IMAGE_FILTER_PRIMARY_TONE'].'&width=20&height=20)'] 
		);

		$Core->selector('#controller-box > #volume > .vol-icon.off'
			. ',#ggn-video-player.fullscreen:hover > #controller-pad > #controller-box > #volume > .vol-icon.off'
			, ['background-image'=>'url('.$VideoPath.'audio-off.png'. $GUI['IMAGE_FILTER_LIGHT_TONE'].'&width=20&height=20)'] 
		);
		$Core->selector('#controller-box > #volume > .vol-icon.off:hover', ['background-image'=>'url('.$VideoPath.'audio-off.png'. $GUI['IMAGE_FILTER_PRIMARY_TONE'].'&width=20&height=20)'] );


		$Core->selector('#ggn-video-player:hover > #controller-pad > #controller-box > #volume', ['padding-top'=>'15px'] );
		$Core->selector('#ggn-video-player:hover > #controller-pad > #controller-box > #volume > .vol-icon'
			, [
				'width && height'=>'17px'
				,'padding-top'=>'2px'
			] 
		);

		$Core->selector('#ggn-video-player:hover > #controller-pad > #controller-box > #volume > .vol-unit'
			, [
				'height'=>'10px'
			]
		);

		$Core->selector('#controller-box > #volume > .vol-unit.level~.vol-unit'
				.',#ggn-video-player.fullscreen:hover > #controller-pad > #controller-box > #volume > .vol-unit.level~.vol-unit'
			, [
				'background-color'=>$GUI['LIGHT_GRAY']
			]
		);

		$Core->selector('#controller-box > #volume > .vol-unit.null'
				.',#ggn-video-player.fullscreen:hover > #controller-pad > #controller-box > #volume > .vol-unit.null'
			, [
				'background-color'=>'transparent'
			]
		);


	/* Shuffle & Volume & loop & fullscreen FIN */




/* Controller Box FIN */





/* Slider Box */
	$Core->selector('#slider-box'
			.',#ggn-video-player.fullscreen:hover > #controller-pad > #controller-box > #slider-box'
		, [
			'width'=>'100%'
			,'height'=>'3px'
			,'background-color'=>'rgba(7,7,7,.8)'
			,'transition'=>'height 0.3s ease-out'
		]
	);
	$Core->selector('#controller-box:hover > #slider-box'
		, [
			'height'=>'7px'
		]
	);


	$Core->selector('#slider-informer'
		, [
			'padding'=>'5px 7px'
			,'font-size'=>'12px'
			,'left'=>'0px'
			,'bottom'=>'10px'
			,'color'=>$Core->styleProperty('font-color')
			,'transition'=>'opacity 0.3s ease-out'
			,'background-color'=>$Core->styleProperty('palette-primary-color')
			// ,'border-radius'=>'7px'
		]
	);

	$Core->selector('#slider-box ~ #slider-informer.no'
		, [
			'animation'=>'ggnBlurMotionOut 0.3s ease-out'
			,'opacity'=>'0'
		]
	);

	$Core->selector('#slider-box ~ #slider-informer._left', ['border-radius'=>'7px', 'border-bottom-right-radius'=>'0px'] );
	$Core->selector('#slider-box ~ #slider-informer._right', ['border-radius'=>'7px', 'border-bottom-left-radius'=>'0px'] );

	$Core->selector('#slider-box:hover ~ #slider-informer.overview'
		, [
			'animation'=>'ggnBlurMotionIn 0.3s ease-out'
			,'opacity'=>'1'
		]
	);


	$Core->selector('div[gui-api="ggn.progress"]'
			. ',div[gui-api="ggn.progress"] *'
			// . ',div[gui-api-progress="ggn.progress.bar"]'
			// . ',div[gui-api-progress="purcent.bar"]'
			// . ',div[gui-api-progress="cache.bar"]'
			// . ',div[gui-api-progress="text.bar"]'
			// . ',div[gui-api-progress="work.bar"]'
		, [
			'overflow'=>'initial !important'
		]
	);

	$Core->selector('div[gui-api-progress="ggn.progress.bar"] > div[gui-api-progress="purcent.bar"]'
		, [
			'background-color'=>$Core->styleProperty('palette-primary-color')
			,'box-shadow'=>'0px 0px 10px ' . $Core->styleProperty('palette-primary-color') . ''
			,'border-radius'=>'180px'
		]
	);

	$Core->selector('div[gui-api-progress="ggn.progress.bar"] > div[gui-api-progress="cache.bar"]'
		, [
			'background-color'=>'#222'
			,'border-radius'=>'180px'
		]
	);

	
	// $Core->selector('#slider-box > #slider-cache'
	// 	, [
	// 		'width'=>'0%'
	// 		,'height'=>'100%'
	// 		,'background-color'=>'#222'
	// 		,'border-radius'=>'180px'
	// 	]
	// );

	// $Core->selector('#slider-box > #slider-loaded'
	// 	, [
	// 		'width'=>'0%'
	// 		,'height'=>'100%'
	// 		,'border-radius'=>'180px'
	// 		,'background-color'=>$Core->styleProperty('palette-primary-color')
	// 	]
	// );

	$Core->selector('#slider-pointer'
		. ',#ggn-video-player.fullscreen:hover > #controller-pad > #controller-box:hover #slider-pointer'
		, [
			'top'=>'-6px'
			,'right'=>'-7px'
			,'opacity'=>'0.0'
			,'transform'=>'scale(0.0)'
			,'width && height'=>'11px'
			,'border'=>'5px solid rgba(255,255,255,.85)'
			// ,'border'=>'10px solid rgba(' . $Core->styleProperty('font-color-rgb:hover') . ',.5)'
			,'background-color'=>$Core->styleProperty('palette-primary-color')
			,'border-radius'=>'180px'
			,'background-clip'=>'content-box'
		]
	);

	$Core->selector('#controller-box:hover #slider-pointer'
		, [
			'animation'=>'ggnScaleIn 0.3s ease-out'
			,'transform'=>'scale(1)'
			,'opacity'=>'1'
		]
	);

/* Slider Box Fin */






?>