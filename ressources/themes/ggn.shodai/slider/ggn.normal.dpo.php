<?php
	
	namespace GGN\DPO;
	

	$return = [

		 'template' => function($data = 'undefined'){

			$brick = new Theme\Tag(['class'=>'slider', 'style'=>['background-color'=>'#ccc']]);

			$brick->text(\Gougnon::fullSpace('<center><h1>' . $data . '</h1></center>'));

			return $brick;

		}

	];



?>