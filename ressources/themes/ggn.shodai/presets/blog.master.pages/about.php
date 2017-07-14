<?php


namespace GGN\DPO;




	/* Details sur les activités */
	$BlogDetails = \GGN\User\Blog\Criterions::Get($this->Blog->BID);


	$BlogAbout = !\Gougnon::isEmpty($this->Blog->ABOUT) ? ($this->Blog->ABOUT) : false;


	$BlogTitle = !\Gougnon::isEmpty($this->Blog->TITLE) ? ($this->Blog->TITLE) : false;

	$BlogCity = !\Gougnon::isEmpty($this->Blog->CITY) ? ($this->Blog->CITY) : false;








/* 
	Post : Banniere Publicitaire // DEBUT -------------------------- 
*/

	$HS = (new Theme\Tag([

		'class'=>'margin-tb-x24 _w10 gui flex row wrap'

	]));





	/* 
		Colonne : Informations // DEBUT ///////////////// 
	*/

		// $Infos = (new Theme\Tag([

		// 	'class'=>'padding-x32 col-3 mi-col-16 li-col-16 text-left'

		// ]));

		// $Infos->node->Title = (new Theme\Tag(['class'=>'text-x18 padding-tb-x16']))->text('Informations');


		// $Infos->node->Content = (new Theme\Tag(['class'=>'text-x14']));

		// 	$Infos->node->Content->node->ContactTel = (new Theme\Tag(['class'=>'gui flex start row padding-tb-x8']))

		// 		->text('<span class="gui iconx static-color">local_phone</span>&nbsp;&nbsp;(+255) 22 42 00 04')

		// 		->text(($this->isMyBlog) ? '<a href="" class="text-x12 margin-l-x12" onclick="return false;"><span class="gui icon pencil margin-lr-x8"></span></a>' : '')

		// 	;

		// 	$Infos->node->Content->node->Email = (new Theme\Tag(['class'=>'gui flex start row padding-tb-x8']))

		// 		->text('<span class="gui iconx static-color">email</span>&nbsp;&nbsp;infos@coquillagescom.net')

		// 		->text(($this->isMyBlog) ? '<a href="" class="text-x12 margin-l-x12" onclick="return false;"><span class="gui icon pencil margin-lr-x8"></span></a>' : '')
			
		// 	;

		// 	$Infos->node->Content->node->webSite = (new Theme\Tag(['class'=>'gui flex start row padding-tb-x8']))

		// 		->text('<span class="gui iconx static-color">http</span>&nbsp;&nbsp;www.coquillagescom.net')

		// 		->text(($this->isMyBlog) ? '<a href="" class="text-x12 margin-l-x12" onclick="return false;"><span class="gui icon pencil margin-lr-x8"></span></a>' : '')

		// 	;


		
		// $HS->node->Infos = $Infos;

	/* 
		Colonne : Informations // FIN ///////////////// 
	*/







	/* 
		Colonne : Contenu // DEBUT ///////////////// 
	*/

		$Container = new Theme\Tag([

			'class'=>'padding-tb-x0 col-0 mi-col-16 li-col-16'

		]);





		if($this->isMyBlog){


		


			/* 
				Section : Bouton Enregistrement de MOD // DEBUT ///////////////// 
			*/

				$SaveSubmit = (new Theme\Tag([

					'class'=>'padding-tb-x32'

				]))

					->text('<button class="gui button active text-x16" type="submit">Enregistrer les modifications</button>')

					->text('<button class="gui button text-x16" type="button" onclick="location.href=\'' . $this->Blog->SLUG . '/post\'">Ignorer</button>')

				;

				$Container->node->SaveSubmit = $SaveSubmit;

			/* 
				Section : Bouton Enregistrement de MOD // FIN ///////////////// 
			*/
		







			/* 
				Section : Titre du blog // DEBUT ///////////////// 
			*/

				$BlogTitle_ = new Theme\Tag([

					'class'=>'padding-tb-x0'

				]);



				$BlogTitle_->node->Title = (new Theme\Tag(['class'=>'text-x28 text-thin text-left gui flex row padding-lr-x12 mi-flex-center li-flex-center']))

					->text('Titre du blog')

					->text( ($this->isMyBlog) ? '<a href="#" class="text-x14 margin-l-x12 button gui flex " onclick="return false;" handler-click="Gabarit.Toggle" gabarit-toggle="#about-title-blog-bloc, #about-title-blog-edit" toggle-from="enable disable " toggle-to="disable enable " >Modifier</a>' : '')

				;



				$BlogTitle_->node->Content = (new Theme\Tag([

					'class'=>'text-x14 padding-tb-x16 padding-lr-x24 text-left bg-ncolor bg-ncolor margin-x16 box-shadow-light blog-edit-post'

				]))

					->text('<div class="" id="about-title-blog-bloc">')

						->text(is_string($BlogTitle) ? nl2br(($BlogTitle)) : '<span class="text-italic">Aucune Titre</span>')

					->text('</div>')

				;


				$BlogTitle_->node->Content->text('<input name="blog-title" class="editor disable col-15 text-x16" id="about-title-blog-edit" placeholder="Rédiger la description de votre blog" value="' . addslashes(is_string($BlogTitle) ? $BlogTitle : '') . '"  required pattern=".{3,32}" maxlength="32" onblur="G(\'#about-title-blog-bloc\').html(this.value);">');



				$Container->node->BlogTitle_ = $BlogTitle_;


			/* 
				Section : Titre du blog // FIN ///////////////// 
			*/
				


		}










		/* 
			Section : Présentation // DEBUT ///////////////// 
		*/
			// $BlogAbout = !\Gougnon::isEmpty($this->Blog->ABOUT) ? $this->Blog->ABOUT : false;


			$Presentation = new Theme\Tag([

				'class'=>'padding-tb-x0'

			]);



			$Presentation->node->Title = (new Theme\Tag(['class'=>'text-x28 text-thin text-left gui flex row padding-lr-x12 mi-flex-center li-flex-center']))

				->text('Description')

				->text( ($this->isMyBlog) ? '<a href="#" class="text-x14 margin-l-x12 button gui flex " onclick="return false;" handler-click="Gabarit.Toggle" gabarit-toggle="#about-desc-bloc, #about-desc-edit" toggle-from="enable disable " toggle-to="disable enable " >Modifier</a>' : '')

			;



			$Presentation->node->Content = (new Theme\Tag([

				'class'=>'text-x14 padding-tb-x16 padding-lr-x24 text-left bg-ncolor bg-ncolor margin-x16 box-shadow-light blog-edit-post'

			]))

				->text('<div class="" id="about-desc-bloc">')

					->text(is_string($BlogAbout) ? nl2br(utf8_encode($BlogAbout)) : '<span class="text-italic">Aucune description</span>')

				->text('</div>')

			;


			if($this->isMyBlog){

				$Presentation->node->Content->text('<textarea name="desc" class="editor disable col-15 x128-h-min x480-h-max disable-scrollbar text-x16" id="about-desc-edit"  ggn-handler-keyup="Gabarit.Form.TextArea.Flexible" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#blog-edit-post-box" placeholder="Rédiger la description de votre blog"  onblur="G(\'#about-desc-bloc\').html(this.value);">' . (is_string($BlogAbout) ? utf8_encode($BlogAbout) : '') . '</textarea>');


			}


			$Container->node->Presentation = $Presentation;

		/* 
			Section : Présentation // FIN ///////////////// 
		*/








		/* 
			Section : Ville // DEBUT ///////////////// 
		*/

			$BlogCity_ = new Theme\Tag([

				'class'=>'padding-tb-x0'

			]);



			$BlogCity_->node->Title = (new Theme\Tag(['class'=>'text-x28 text-thin text-left gui flex row padding-lr-x12 mi-flex-center li-flex-center']))

				->text('Ville')

				->text( ($this->isMyBlog) ? '<a href="#" class="text-x14 margin-l-x12 button gui flex " onclick="return false;" handler-click="Gabarit.Toggle" gabarit-toggle="#about-blog-city-bloc, #about-blog-city-edit" toggle-from="enable disable " toggle-to="disable enable " >Modifier</a>' : '')

			;



			$BlogCity_->node->Content = (new Theme\Tag([

				'class'=>'text-x14 padding-tb-x16 padding-lr-x24 text-left bg-ncolor bg-ncolor margin-x16 box-shadow-light blog-edit-post'

			]))

				->text('<div class="" id="about-blog-city-bloc">')

					->text(is_string($BlogCity) ? nl2br(utf8_encode($BlogCity)) : '<span class="text-italic">Aucune Titre</span>')

				->text('</div>')

			;


			$BlogCity_->node->Content->text('<input list="blog-type-city-explicit" name="city" class="editor disable col-15 text-x16" id="about-blog-city-edit" placeholder="Ville" value="' . addslashes(is_string($BlogCity) ? $BlogCity : '') . '" required   onblur="G(\'#about-blog-city-bloc\').html(this.value);">');



			$Container->node->BlogCity_ = $BlogCity_;


		/* 
			Section : Ville // FIN ///////////////// 
		*/




		/* 

			Villes // DEBUT ------

		*/

			new Using('GeoLocation/Country/CI');

			$Cities = (new \GGN\GeoLocation\Country\CI\Load())->Cities;



				$this->body->Select = (new Theme\Tag([

					'tag'=>'datalist'

					,'id'=>'blog-type-city-explicit'

				]));


			foreach($Cities as $ck => $City) { 
				
				$Op = (new Theme\Tag([

					'tag'=>'option'

					,'value'=>($ck)

				]))->text( ucwords($City) );

				$this->body->Select->node->{'Option-' . $ck} = $Op;

			}


		/* 

			Villes // FIN ------

		*/








		/* 
			Section : Activités // DEBUT ///////////////// 
		*/

			$BlogActivities = new Theme\Tag([

				'class'=>'padding-tb-x0'

			]);


			$BlogActivities->node->Title = (new Theme\Tag(['class'=>'text-x28 text-thin text-left gui flex row padding-lr-x12 mi-flex-center li-flex-center']))

				->text( ucfirst($this->Blog->_TYPE) )

				->text( ($this->isMyBlog) ? '<a href="" class="text-x14 margin-l-x12 button gui flex" onclick="return false;" handler-click="Gabarit.Toggle" gabarit-toggle="#criterion-desc-bloc, #criterion-desc-edit" toggle-from="enable disable " toggle-to="disable enable " >Modifier</a>' : '')

			;


			$BlogActivities->node->Content = (new Theme\Tag(['class'=>'text-x14 padding-tb-x16 padding-lr-x24 text-left bg-ncolor bg-ncolor margin-x16 box-shadow-light']));

			$BlogActivities->node->Content->node->Forms = (new Theme\Tag(['id'=>'criterion-desc-edit','class'=>'disable']));

			$BlogActivities->node->Content->node->Items = (new Theme\Tag(['id'=>'criterion-desc-bloc','class'=>'']));


			$STYLIVOIR->getCriterionsToDPO($BlogActivities->node->Content->node->Forms, $this->Blog->TYPE, true, true);



			if(in_array($this->Blog->TYPE, explode(' ', 'boutiques coutures esthetiques'))){

				$BlogActivities->node->Content->node->Forms

					->text('<input type="button" class="button col-16" ggn-handler-click="Gabarit.Form.CheckBox" checkbox-set-scope="Citerion" checkbox-on="Tout Délectionner" checkbox-off="Tout Sélectionner" value="Tout Sélectionner">')

				;

			}



			if($BlogDetails->row <= 0){

				$BlogActivities->node->Content->node->Items->text('<span class="text-italic">Aucune information</span>');

			}

			if($BlogDetails->row > 0){

				foreach ($BlogDetails->data as $detk => $detail) {

					$ditem = (new Theme\Tag(['class'=>'text-x16 padding-tb-x8 padding-lr-x12']))

						->text( ($detail->_DATA == $detail->CRITERION || $this->Blog->TYPE != 'castings') ? '' : '<span class="color-text-l opacity-x50">' .  ucfirst($detail->CRITERION) . ' : ' . '</span>'  )

						->text('<span class="color-text-d">' . ucfirst($detail->_DATA) . '</span>')

					;


					$BlogActivities->node->Content->node->Items->node->{'item_' . $detk} = $ditem;


					if($this->isMyBlog){


						$this->body->js('(function(id){var id = id.trim();');

							$this->body->js('var ge = G(id), gel = G(id.substr(0,id.length-2));');


							$this->body->js('if(isObj(ge) || isObj(gel)){');

								$this->body->js('ge = isObj(gel) ? gel : ge;');

								$this->body->js('if(ge.type=="checkbox" || ge.type=="radio"){ge.checked = true;}');

								$this->body->js('if(ge.type=="text" || ge.type=="number"){ ge.attrib("value", "' . (addslashes($detail->_DATA)) . '"); }');

							$this->body->js('}');


						$this->body->js('})("#blog-type-criterion-' . $this->Blog->TYPE . '-' 

							. 

								((in_array($this->Blog->TYPE, explode(' ', 'boutiques coutures castings'))) 

									? (( ($this->Blog->TYPE == 'castings') ? $detail->CRITERION . '-' : '' ) . $detk)

									: $detail->CRITERION

								) 

							. 

						'");');

					}




					
				}



				// $tpl->body->js('GScript.check("Followers", function(){');

					// $tpl->body->js('(function(id){Followers.Criterions.updateFormmail( G(id), "' . addslashes($Get->data[0]->_DATA) . '");})("#followers-criterions-form");');

				// $tpl->body->js('});');


			}


			$Container->node->BlogActivities = $BlogActivities;

		/* 
			Section : Activités // FIN ///////////////// 
		*/



		if($this->isMyBlog){

			$HS->text('<form action="#" methode="post" onsubmit="return Pik.BlogMaster.About.SaveChanges(this);" class="w-inherit h-inherit">');

				$HS->text('<input type="hidden" name="bid" value="' . $this->Blog->BID . '">');

				$HS->text('<input type="hidden" name="btype" value="' . $this->Blog->TYPE . '">');

		}

			$HS->node->Container = $Container;


		if($this->isMyBlog){

			$HS->text('</form>');

		}

	/* 
		Colonne : Contenu // FIN ///////////////// 
	*/




	
	$container->node->nCo->node->lPage->node->HS = $HS;

/* 
	Post : Banniere Publicitaire // FIN -------------------------- 
*/
