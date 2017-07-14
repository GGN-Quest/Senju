<?php
	
	namespace GGN\DPO;
	

	$return = [

		
		'template' => function($code = 'undefined', $title='undefined', $about = 'undefined', $ecode = ''){

			$brick = new Theme\Tag(['class'=>'gui flex column center wrap error-section-box']);



				$up = new Theme\Tag(['class'=>'up gui flex row center wrap x256']);

					$up->node->code = new Theme\Tag(['class'=>'outer gui flex  wrap center x192 color-light ']);

					$up->node->code->node->Content = new Theme\Tag(['id'=>'inner', 'class'=>'inner x128 gui flex center']);
					
						$up->node->code->node->Content->text('<div class="gui iconx x128">warning</div>');

						// $up->node->code->node->Content->text('<img src="' . $this->_url . 'warning.png?mode=-gd&width=37&height=128&resize=&resizeby=-height&rogner=0&filter=colorize:255|255|255">');

						$up->node->code->node->Content->node->Title = new Theme\Tag(['class'=>'title h6']);

							// $up->node->code->node->Content->node->Title->node->Content = new Theme\Content($title);

						
				$down = new Theme\Tag(['class'=>'down gui flex center column']);


					$down->node->Code = new Theme\Tag(['class'=>'xh1']);

					$down->node->Code->text($code);


					$down->node->Title = new Theme\Tag(['class'=>'title']);

					$down->node->Title->node->Content = new Theme\Content($title);


					$down->node->About = new Theme\Tag(['class'=>'about']);

					$down->node->About->node->Content = new Theme\Content($about);


					$down->node->Buttons = (new Theme\Tag(['class'=>'buttons']))

					->text('<button class="active" onclick="history.go(-1);"> <span class="gui icon arrow-left"></span>&nbsp;&nbsp;&nbsp;Retour </button>')

					->text('<button onclick="location.href=\'' . HTTP_HOST . '\';"> <span class="gui icon home"></span>&nbsp;&nbsp;&nbsp;Allez à l\'accueil </button>')

					;


					$down->node->Copy = (new Theme\Tag(['class'=>'copyright gui flex center column']))

						// ->text('<div >Copyright 2016</div>')

					;


				$brick->node->UP = $up;

				$brick->node->DOWN = $down;

			return $brick;

		}


	];



?>