<?php

/*
	Copyright GOBOU Y. Yannick
	
*/
	
namespace GGN\DPO;



$title = isset($title) ? $title : false;

$about = isset($about) ? $about : false;

$message = isset($message) ? $message : false;

$buttons = isset($buttons) ? $buttons : false;




	$this->component('tag.head');





	/* Corps de la page */
	$this->body = new Theme\Body([

		'class'=>'disable-x-scrollbar'

	]);





		$this->body->sheet = new Theme\Tag([
			'class'=>'gui sheet'
		]);




			/* Entete : debut */
			$header = new Theme\Tag([
				'class'=>'gui bg-primary flex row wrap x48-h'
				,'style'=>[
					'padding'=>'7px 15px'
				]
			]);


				/* Logo */
				$header->node->logo = new Theme\Tag(['class'=>'gui flex center _w10' ]);

					$header->node->logo->text('<a href="'.HTTP_HOST.'" class="align-center" title="Stylivoir.com"><img class="logo" src="' . $this->_url . 'logo-stylivoir-xxl.png?mode=-gd&width=172&height=25&resize=&resizeby=-height&rogner=0"></a>');




			$this->body->sheet->node->header = $header;








			/* Corps : debut */
			$Container = new Theme\Tag([
				'class'=>'gui vw10'

				,'style'=>[
				
					'padding'=>'7px 25px'
				
				]

			]);


				$Container->node->Title = (new Theme\Tag([

					'class'=>'gui h1 color-dark'


				]))

					->text($title)

				;


				$Container->node->About = (new Theme\Tag([
					'class'=>'gui color-dark h3'
				]))

					->text($about)

				;



				$Container->node->Message = (new Theme\Tag([

					'class'=>'gui text-x18 color-dark '

					,'style'=>[
					
						'padding'=>'25px 0px'
					
					]

				]))

					->text($message)

				;


				if(is_array($buttons)){

					$Container->node->Buttons = (new Theme\Tag([
						
						'class'=>'color-dark'

						,'style'=>[
						
							'padding'=>'10px 0px'
						
						]

					]))

						

					;
					
					foreach ($buttons as $key => $value) {

						$Container->node->Buttons->text('<a class="text-x14 button' . ((isset($value['focus']) && $value['focus']===true) ? ' active ' : '') . '" href="' . (isset($value['link']) ? $value['link'] : HTTP_HOST) . '">' . (isset($value['label']) ? $value['label'] : '') . '</a>&nbsp;&nbsp;&nbsp;');

					}

				}


			$this->body->sheet->node->Container = $Container;



	$this->component('normal.footer', ['NoRendering'=>true]);