<?php

	
	/* PARAMETRES */
	require $Core::commonFile('.settings');


	/* Paramètre commun */
	include 'common.php';





$Core->selector('body'

	, [

		'letter-spacing'=>'-0.03em'

		,'background-color'=>$Core->styleProperty('palette-dark-color')

	]

);



$Core->selector('a:hover, a:focus'

	, [

		'text-decoration'=>'none'

	]

);




$Core->selector('[terminal-cmd]'

	, [

		'cursor'=>'pointer'

		, 'transition'=>'all 150ms ease'

		, 'color'=> $Core->styleProperty('palette-primary-color')

	]

);

$Core->selector('div[terminal-cmd]'

	, [

		'padding'=>'7px 12px'

	]

);

$Core->selector('div[terminal-cmd]:hover'

	, [

		'background-color'=>'rgba(' . $Core->styleProperty('dark-background-color-rgb') . ',.48)'

	]

);






/* Espace Processuce : general / DEBUT */

	$Core->selector('.process-tag'

		, [

			'background-color'=>'rgba(' . $Core->styleProperty('dark-background-color-rgb') . ',.48)'	

			, 'top && left'=>'0px'

			, 'overflow-x'=>'hidden'

			, 'overflow-y'=>'auto'

			// , 'padding-bottom && padding-top'=>'16px'

			, 'height'=>'100%'

			, 'z-index'=>'10'

			, 'tranform'=>'translateY(0%)'
			
		]

	);

	$Core->selector('.process-tag.prc-close'

		, [

			'height'=>'0px'

			, 'overflow-y'=>'hidden'

			// , 'padding-bottom && padding-top'=>'0px'

			// 'top'=>'-100%'

			, 'tranform'=>'translateY(-100%)'
			
		]

	);



	/* Entete / DEBUT */

		$Core->selector('.process-tag > .prc-title'

			, [

				'background-color'=> 'rgba(' . $Core->styleProperty('palette-dark-color-rgb') . ',.64)'	
			]

		);

	/* Entete / FIN */



	/* Contenu / DEBUT */

		$Core->selector('.process-tag.prc-close > * > .prc-content'

			, [
					
				'overflow-y && overflow-x'=>'hidden'
				
			]

		);

		$Core->selector('.process-tag > * > .prc-content'

			, [
					
				'overflow-x'=>'hidden'

				, 'overflow-y'=>'auto'
				
			]

		);

	/* Contenu / FIN */





	/* Item / DEBUT  */

		$Core->selector('.process-tag > * > .prc-content > .proc-item'

			, [

				'border-top'=>'1px solid ' . $Core->styleProperty('dark-border-color')
				
			]

		);

		$Core->selector('.process-tag > * > .prc-content > .proc-item:first-child'

			, [

				'border-top'=>'0px solid '
				
			]

		);

		$Core->selector('.process-tag > * > .prc-content .proc-item > .label'

			, [

				'font-size'=>'20px'
				
			]

		);

		$Core->selector('.process-tag > * > .prc-content .proc-item > input'

			, [

				'background-color && border-color'=>'transparent'

				,'width'=>'96%'

				// ,'border-bottom'=>'3px solid ' . $Core->styleProperty('border-color')
				
			]

		);

	/* Item / FIN  */

/* Espace Processuce : general / DEBUT */






/* Face : general / DEBUT */

	$Core->selector('.ter-face'

		, [

			'z-index'=>'1'
			
		]

	);

/* Face : general / DEBUT */





/* Face : Etats / DEBUT */

	$Core->selector('.ter-face'

		, [

			// ''=>''
			
		]

	);



	/* Entete / DEBUT  */

		$Core->selector('.ter-face.fs > header'

			, [

				'padding'=>'32px 32px 0px 32px '
				
			]

		);

		$Core->selector('.ter-face.fu > header'

			, [

				'padding'=>'0px'
				
			]

		);


		
		$Core->selector('.ter-face > header > .title' . ',.ter-face > header > .mod'

			, [

				'white-space'=>'nowrap'

				,'overflow'=>'hidden'

				// ,'text-overflow'=>'ellipsis'
				
			]

		);



		
		$Core->selector('.ter-face.fs > header > .title'

			, [

				'font-size'=>'90px'
				
			]

		);

		$Core->selector('.ter-face.fu > header > .title'

			, [

				'font-size'=>'48px'

				,'padding'=>'12px 20px'
				
			]

		);


		$Core->selector('.ter-face > header > .title .mac'

			, [

				'color'=>$Core->styleProperty('dark-font-color')
				
			]

		);



		
		$Core->selector('.ter-face.fs > header > .mod'

			, [

				'font-size'=>'32px'

				,'margin-top'=>'-15px'

				,'font-family'=>$Core->styleProperty('font-family-thin')
				
			]

		);

		$Core->selector('.ter-face.fu > header > .mod'

			, [

				'font-size'=>'20px'

				,'margin-top'=>'0px'

				,'color'=>$Core->styleProperty('dark-font-color')

				,'background-color'=>$Core->styleProperty('dark-background-color')

				,'padding'=>'12px 20px'

				,'font-family'=>$Core->styleProperty('font-family-regular')
				
			]

		);

	/* Entete / FIN  */





	/* Corps */

		$Core->selector('.ter-face.fs > .corps'

			, [

				'height'=>'1px'

				,'background-color'=>'transparent'
				
			]

		);

		$Core->selector('.ter-face.fu > .corps'

			, [

				'flex'=>'1 auto'

				,'height'=>'auto'

				,'overflow-x'=>'hidden'

				,'background-color'=> 'rgba(' . $Core->styleProperty('dark-background-color-rgb') . ',.48)'
				
			]

		);



		$Core->selector('.ter-face.fu > .corps > .console'

			, [

				'width'=>'100%'

				,'height'=>'inherit'

				,'overflow-x'=>'hidden'

				,'overflow-y'=>'auto'
				
			]

		);

		$Core->selector('.ter-face.fu > .corps > .console > .place '

			, [

				'margin'=>'8px 32px 16px'
				
			]

		);

		$Core->selector('.ter-face.fu > .corps > .console .writing'

			, [

				'font-size'=>'14px'

				// ,'padding'=>'8px 20px'
				
			]

		);



		/* progress-bar / DEBUT */
		
			$Core->selector('.ter-face.fu > .corps > .console .progress-box'

				, [

					// 'width'=>'90%'

					// ,'max-width'=>'480px'

					'background-color'=>'rgba(' . $Core->styleProperty('dark-background-color-rgb') . ',.85)'

					,'padding'=>'16px 20px'

					,'border-radius'=>'7px'

					,'margin-top && margin-bottom'=>'12px'
					
				]

			);

			$Core->selector('.ter-face.fu > .corps > .console .progress-box > .progress-label'

				, [

					'width'=>'100%'

				]

			);

			$Core->selector('.ter-face.fu > .corps > .console .progress-box > .progress-bar'

				, [

					'width'=>'100%'

					,'margin-top && margin-bottom'=>'8px'

					,'height'=>'0px'

					,'background-color'=>$Core->styleProperty('background-color')
					
				]

			);



			$Core->selector('.ter-face.fu > .corps > .console .progress-box > .progress-bar > .track-bar'

				, [

					'width'=>'0%'

					,'height'=>'100%'

					,'background-color'=>$Core->styleProperty('palette-primary-color')

					// ,'border'=>'1px solid ' . $Core->styleProperty('palette-secondary-color')
					
				]

			);

			$Core->selector('.ter-face.fu > .corps > .console .progress-box > .progress-bar > .track-bar.error', ['background-color'=>$Core->styleProperty('notice-error-background-color')]);

			$Core->selector('.ter-face.fu > .corps > .console .progress-box > .progress-bar > .track-bar.warning', ['background-color'=>$Core->styleProperty('notice-warning-background-color')]);

			$Core->selector('.ter-face.fu > .corps > .console .progress-box > .progress-bar > .track-bar.success', ['background-color'=>$Core->styleProperty('notice-success-background-color')]);



			$Core->selector('.ter-face.fu > .corps > .console .progress-box > .progress-bar > .track-bar.m-reading'

				, [

					'color'=>$Core->styleProperty('font-color')

					, 'box-shadow'=>'0px 0px 7px ' . $Core->styleProperty('palette-primary-color') . ''
					
				]

			);

				$Core->selector('.ter-face.fu > .corps > .console .progress-box > .progress-bar > .track-bar > .track-label'

					, [

						'width && height'=>'1px'

						,'font-size'=>'11px'

						,'top'=>'0px'

						,'color'=>$Core->styleProperty('palette-dark-color')

						,'border-radius'=>'100%'

						,'background-color'=>$Core->styleProperty('palette-primary-color')

						,'transform'=>'scale(0.001)'

						// ,'border'=>'1px solid ' . $Core->styleProperty('palette-secondary-color')
						
					]

				);

				$Core->selector('.ter-face.fu > .corps > .console .progress-box > .progress-bar > .track-bar > .track-label.show'

					, [

						'transform'=>'scale(1)'

						,'top'=>'-14px'

						, 'width && height'=>'25px'

						, 'padding'=>'3px'

						, 'margin-right'=>'-3px'
						
					]

				);


			$Core->selector('.ter-face.fu > .corps > .console .progress-box > .progress-status'

				, [

					'width'=>'100%'
					
				]

			);

		/* progress-bar / FIN */



		$Core->selector('.ter-face.fu > .corps > .console .writing .cmd-line'

			, [

				'font-size'=>'16px'

				,'margin-top'=>'16px'

				// ,'padding'=>'8px 0px'

				,'color'=>$Core->styleProperty('palette-primary-color')
				
			]

		);

		$Core->selector('.ter-face.stand-by > .corps > .console'

			, [

				'filter'=>'blur(5px)'
				
			]

		);

	/* Corps */





	/* Entree CMD */

		$Core->selector('.ter-face.fs > .cmd-input'

			, [

				'padding'=>'10px 32px 32px'
				
			]

		);


		$Core->selector('.ter-face.fu > .cmd-input'

			, [

				'padding'=>'0px 32px 16px'
				
			]

		);


		$Core->selector('.ter-face > .cmd-input > .field'

			, [

				'border-top'=>'1px solid ' . $Core->styleProperty('palette-primary-color')
				
			]

		);


		$Core->selector('.ter-face > .cmd-input > .field > .icon'

			, [

				'font-size'=>'18px'

				,'padding'=>'18px 4px'
				
			]

		);


		$Core->selector('.ter-face > .cmd-input > .field > .username'

			, [

				'font-size'=>'20px'

				,'padding'=>'13px 5px 20px'

				,'color' => $Core->styleProperty('dark-font-color')
				
			]

		);


		$Core->selector('.ter-face > .cmd-input > .field .composer'

			, [

				'font-size'=>'18px'

				,'resize'=>'none'

				,'min-height && height'=>'24px'

				,'padding-left && padding-right'=>'4px'

				,'background && border-color'=>'transparent'
				
			]

		);

		$Core->selector('.ter-face > .cmd-input > .field .composer:hover'

			, [

				'background && border-color'=>'transparent'
				
			]

		);

	/* Entree CMD */



/* Face : Etats / FIN */


