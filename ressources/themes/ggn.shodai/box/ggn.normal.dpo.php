<?php
	
	namespace GGN\DPO;
	

	$return = [

		
		'template' => function($title = 'undefined', $content = 'undefined'){

			$brick = new Theme\Tag(['class'=>'gui box']);

			$brick->node->title = new Theme\Tag(['class'=>'title']);
			
			$brick->node->title->text($title);

			$brick->node->container = new Theme\Tag(['class'=>'content']);
			
			$brick->node->container->content($content);

			return $brick;

		}


	];



?>