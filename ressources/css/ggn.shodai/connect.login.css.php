<?php

	
	/* PARAMETRES */
	require $Core::commonFile('.settings');


	/* Paramètre commun */
	include dirname(__FILE__) . '/common.php';



	/* GUI Sheet */
	$Core->selector('.gui.connect.login'
		, [
			'display'=>['-webkit-flex', 'flex']
			,'align-items'=>'center'
			,'justify-content'=>'center'
			,'width && height'=>'100%'
		]
	);



	/* GUI Box */
	$Core->selector('.gui.box'
		, [
			'margin'=>'auto'
		]
	);

	$Core->selector('.gui.box > .title'
		, [
			'font-size'=>'30px'
			,'padding'=>'5px 12px'
		]
	);

	$Core->selector('.gui.box > .content'
		, [
			'padding'=>'5px 12px'
			,'font-size'=>'14px'
		]
	);








	/* 
		GUI Form Box 
	*/
	$Core->selector('.gui.form.box'
		, [
			'margin'=>'auto'
		]
	);

	$Core->selector('.gui.form.box > .title'
		, [
			'font-size'=>'30px'
		]
	);

	$Core->selector('.gui.form.box > .container'
		, [
		]
	);

	$Core->selector('.gui.form.box > .container > .fields'
		, [
		]
	);

	$Core->selector('.gui.form.box > .container > .fields > .field'
		, [
			'font-size'=>'13px'
			,'display'=>'-webkit-flex'
			,'display'=>'flex'
			,'flex-wrap'=>'wrap'
		]
	);

	$Core->selector('.gui.form.box > .container > .fields > .field > label'
		, [
			// 'flex'=>'1'
		]
	);

	$Core->selector('.gui.form.box > .container > .fields > .field > label .grand'
		, [
			'font-size'=>'21px'
		]
	);

	$Core->selector('.gui.form.box > .container > .fields > .field > label .lowc'
		, [
			'opacity'=>'0.4'
		]
	);

	$Core->selector('.gui.form.box > .container > .fields > .field > label.pre'
		, [
			'font-size'=>'14px'
			,'padding'=>'6px 12px'
		]
	);

	$Core->selector('.gui.form.box > .container > .fields > .field > label.sub'
		, [
			'font-size'=>'13px'
			,'padding'=>'8px 3px'
		]
	);

	$Core->selector(
			'.gui.form.box > .container > .fields > .field > input'
		, [
			'width'=>'100%'
		]
	);

	$Core->selector(
			'.gui.form.box > .container > .fields > .field > input:focus'
		, [
			// 'color'=>$Core->styleProperty('dark-font-color') . ''
			// ,'background-color'=> '' . $Core->styleProperty('font-color') . ''
		]
	);

	$Core->selector(
			'.gui.form.box > .container > .fields > .field > input[type="submit"]'
			. ',.gui.form.box > .container > .fields > .field > input[type="button"]'
			. ',.gui.form.box > .container > .fields > .field > button'

			. ',.gui.form.box > .container > .fields > .field > input[type="checkbox"]'
			. ',.gui.form.box > .container > .fields > .field > input[type="radio"]'
			
		, [
			'width'=>'auto'
		]
	);


	$Core->selector(
			'.gui.form.box > .container > .fields > .field > input[type="submit"]'
			. ',.gui.form.box > .container > .fields > .field > input[type="button"]'
			. ',.gui.form.box > .container > .fields > .field > button'

		, [
			'margin-top && margin-bottom'=>'15px'
		]
	);










?>