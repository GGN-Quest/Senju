<?php

/*
	Copyright GOBOU Y. Yannick
	
*/
namespace GGN\DPO;


	global $GLANG;





if(isset($this->USER) && is_array($this->USER)){





	$identity = \GUSERS::identity($this->USER['UKEY']);




	$lastname = '';

	$firstname = '';

	$nickname = '';

	$day = '';

	$month = '';

	$year = '';

	$sexe = false;



	if(is_object($identity) && $identity->row > 0){

		$lastname = utf8_encode($identity->data[0]['LASTNAME']);

		$firstname = utf8_encode($identity->data[0]['FIRSTNAME']);

		$nickname = utf8_encode($identity->data[0]['NICKNAME']);

		$birthb = $identity->data[0]['BIRTH'];

			$day = date('d', $birthb);

			$month = date('n', $birthb);

			$year = date('Y', $birthb);


		$sexe = $identity->data[0]['SEXE'];


	}





	$tpl->head->script($tpl->_url . 'account.identity.js?style=' . $tpl->style);



	$Form = (new Theme\Tag([

		'tag'=>'form'

		,'action'=>'#'

		,'method'=>'POST'

		,'name'=>'accountIdentityForm'

		,'onsubmit'=>"return false;"

	]));





	


	$BlocName = (new Theme\Tag([

		'class'=>'padding-x16 margin-t-x16'

	]))

		->text('<div class="h3 no-ff margin-tb-x12 text-thin">Nom et Prénoms</div>')



		->text('<div class="field-input xl styled gui box-rounded gui flex row center box-shadow-black" id="account-identity-lastname-field"><span class="gui icon" title="Minimum : 2  Maximun : 32"></span><input type="text" name="lastname" placeholder="Prénom" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#account-identity-lastname-field,#account-identity-lastname-info" focus-class="focus,enable" required pattern=".{2,32}" maxlength="32" value="' . $lastname . '"></div>')

		->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="account-identity-lastname-info">Minimum : 2, Maximun : 32 Caratères</div>')



		->text('<div class="field-input xl styled gui box-rounded gui flex row center box-shadow-black" id="account-identity-firstname-field"><span class="gui icon" title="Minimum : 3  Maximun : 32"></span><input type="text" name="firstname" placeholder="Nom" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#account-identity-firstname-field,#account-identity-firstname-info" focus-class="focus,enable" required pattern=".{3,32}" maxlength="32" value="' . $firstname . '"></div>')

		->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="account-identity-firstname-info">Minimum : 3, Maximun : 32 Caratères</div>')



		->text('<div class="field-input xl styled gui box-rounded gui flex row center box-shadow-black" id="account-identity-nickname-field"><span class="gui icon" title="Minimum : 3  Maximun : 32"></span><input type="text" name="nickname" placeholder="Surnom" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#account-identity-nickname-field,#account-identity-nickname-info" focus-class="focus,enable" pattern=".{3,32}" maxlength="32" value="' . $nickname . '"></div>')

		->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="account-identity-nickname-info">Minimum : 3, Maximun : 32 Caratères</div>')

	;



	$Form->node->BlocName = $BlocName;








	$_MonthOptions = '';

	$_MonthOptions .= '<option >Mois</option>';

	for($drm = 0; $drm < 12; $drm++){

		$_MonthOptions .= '<option value="' . $drm . '">' . ucfirst($GLANG['MONTH']['NAME'][$drm]) . '</option>';

	}



	$BlocBirth = (new Theme\Tag([

		'class'=>'padding-x16 margin-t-x16'

	]))

		->text('<div class="h3 no-ff margin-tb-x12 text-thin">Date de naissance</div>')



		->text('<div class="field-input xl styled gui box-rounded gui flex row center box-shadow-black" id="account-identity-birth-field"><span class="gui icon calendar" title="Minimum : 2  Maximun : 32"></span>')

		->text('<input type="number" name="birth_day" placeholder="Jour" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#account-identity-birth-field,#account-identity-birth-info" focus-class="focus,enable" required max="31" step="1" value="' . $day . '">')

		->text('<select name="birth_month" id="birth_month">' . $_MonthOptions . '</select>')

		->text('<input type="number" name="birth_year" placeholder="Année" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#account-identity-birth-field,#account-identity-birth-info" focus-class="focus,enable" required min="' . (date('Y') - 99) . '" max="' . (date('Y') - 16) . '" step="1" value="' . $year . '"></div>')

		->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="account-identity-birth-info">Age (min : 16 ans et max : 90 ans)</div>')



	;


	$tpl->body->js('(function(inp){');

		$tpl->body->js('inp.value = "' . ($month - 1) . '"; ');

	$tpl->body->js('})(G(\'[name="accountIdentityForm"]\').birth_month);');


	$Form->node->BlocBirth = $BlocBirth;















	$BlocSexe = (new Theme\Tag([

		'class'=>'padding-x16 margin-t-x16'

	]))

		->text('<div class="h3 no-ff margin-tb-x12 text-thin">Sexe</div>')



		->text('<div class="field-input xl styled gui box-rounded gui flex row center box-shadow-black" id="account-identity-sexe-field"><span class="gui icon sexe" title="Minimum : 2  Maximun : 32"></span>')

		->text('<select name="sexe" id="sexe"><option value="0">Femme</option><option value="1">Homme</option><option value="2">Autre</option></select>')

		->text('</div>')




	;


	$tpl->body->js('(function(inp){');

		$tpl->body->js('inp.value = "' . ($sexe) . '"; ');

	$tpl->body->js('})(G(\'[name="accountIdentityForm"]\').sexe);');




	$Form->node->BlocSexe = $BlocSexe;















	$BlocSubmit = (new Theme\Tag([

		'class'=>'padding-x16 margin-t-x16'

	]))

		->text('<div class="h3 no-ff margin-tb-x12 text-thin"></div>')

		// ->text('<button class="active button text-x16"><span class="gui icon save x16 margin-r-x8"></span> Enregistrer</button>')

		->text('<input type="submit" class="button active text-x16" value="Enregistrer">')


	;



	$Form->node->BlocSubmit = $BlocSubmit;











	$tpl->body->sheet->node->container->node->ModContainer->node->Form = $Form;


}
