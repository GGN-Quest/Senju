<?php

	/* Copyright GOBOU Y. Yannick */
	

	$Family = Register::_GET('family', false);



	if(is_string($Family)){
		
		$FontName = str_replace('.', '', $Family);

		$FontName = str_replace('-', '', $FontName);


		$Path = $Family . '/';


		$_Options = Register::_GET('options', '');

			$Options = explode(';', $_Options);


		define('DEFAULT_STYLE', self::_REQUEST('style'));





		/* Noyau CSS */
		$Core = _GGN::CSSCore('ggn.core');

		$Core->Style(DEFAULT_STYLE);





		// $OpCode = [];

		$Code = [

			'font-family' => '' . $FontName . ''

			, 'src' => [

				"url('" . $Path . "index.eot.font')"

				, "url('" . $Path . "index.eot.font?#iefix') format('embedded-opentype')"

					. ", url('" . $Path . "index.woff.font') format('woff')"

					. ", url('" . $Path . "index.ttf.font') format('truetype')"

					. ", url('" . $Path . "index.svg.font#robotobold') format('svg')"
			]

		];



		if(!\Gougnon::isEmpty($_Options)){

			foreach ($Options as $Option) {

				$Ex = explode(':', $Option);

				$Property = (isset($Ex[0])) ? $Ex[0] : false;

				if(is_string($Property)){

					$Value = (isset($Ex[1])) ? $Ex[1] : '';

					$OpCode[$Property] = $Value;

				}
				
			}

		}



		// $OpCode = \Gougnon::mergeArray($OpCode, $Code, true);



		$Core->selector('@font-face'

			, $Code

		);


		$Core->Build();


	}


	else{

		ECHO ('// GGN Font : Fichier introuvable!');

	}

?>