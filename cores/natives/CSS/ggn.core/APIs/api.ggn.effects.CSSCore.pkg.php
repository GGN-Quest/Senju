/* Fichier : Gougnon.CSS.effect.cssg, Nom : Gougnon CSS Framework, version 0.0.1.150012.1127, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php

/* PARAMETRES */
require self::commonFile('.settings');




/* Flou Gaussien */
$Core->keyframes('ggnBlurMotionIn'
	, 
		'{0%{'
			. $Core::browserKey('filter','blur(0px)') .
		'} 100%{' 
			. $Core::browserKey('filter','blur(5px)') .
		'} }'
	, true
);


$Core->keyframes('ggnBlurMotionOut'
	, 
		'{0%{'
			. $Core::browserKey('filter','blur(5px)') .
		'} 100%{' 
			. $Core::browserKey('filter','blur(0px)') .
		'} }'
	, true
);







/* Zoom Scale */
$Core->keyframes('ggnScaleIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','scale(0)') 
			. $Core::browserKey('opacity','0.0') . 
		'} 100%{' 
			. $Core::browserKey('transform','scale(1)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);

$Core->keyframes('ggnScaleOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','scale(1)') 
			. $Core::browserKey('opacity','1') . 
		'} 100%{' 
			. $Core::browserKey('transform','scale(0)') 
			. $Core::browserKey('opacity','0.0') . 
		'} }'
	, true
);


$Core->keyframes('ggnScalexIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','scale(0)') 
			. $Core::browserKey('opacity','0.0') . 
		'} 100%{' 
			. $Core::browserKey('transform','scale(2)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);

$Core->keyframes('ggnScalexOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','scale(2)') 
			. $Core::browserKey('opacity','1') . 
		'} 100%{' 
			. $Core::browserKey('transform','scale(0)') 
			. $Core::browserKey('opacity','0.0') . 
		'} }'
	, true
);

$Core->keyframes('ggnScaleixOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','scale(1)') 
			. $Core::browserKey('opacity','1') . 
		'} 100%{' 
			. $Core::browserKey('transform','scale(2)') 
			. $Core::browserKey('opacity','0.0') . 
		'} }'
	, true
);














/* Rebondissement */
/* Entrant */
$Core->keyframes('ggnBouncedIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','scale(0)') 
			. $Core::browserKey('opacity','0.1' ) . 
		'} ' . 
		' 50%{'. $Core::browserKey('transform','scale(1.2)') .'}'.
		' 75%{'. $Core::browserKey('transform','scale(0.85)') .'}'.
		' 85%{'. $Core::browserKey('transform','scale(1.1)') . $Core::browserKey('opacity','0.3' ) .'}'.
		' 95%{'. $Core::browserKey('transform','scale(0.9)') .'}'.
		' 98%{'. $Core::browserKey('transform','scale(1.05)') .'}'.
		'' . 
		'100%{' 
			. $Core::browserKey('transform','scale(1)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);


/* Sortant */
$Core->keyframes('ggnBouncedOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','scale(2)') 
			. $Core::browserKey('opacity','0.1' ) . 
		'} ' . 
		' 50%{'. $Core::browserKey('transform','scale(0.2)') .'}'.
		' 75%{'. $Core::browserKey('transform','scale(1.2)') .'}'.
		' 85%{'. $Core::browserKey('transform','scale(0.85)')  .'}'.
		' 95%{'. $Core::browserKey('transform','scale(1.1)') .'}'.
		' 98%{'. $Core::browserKey('transform','scale(0.9)') .'}'.
		'' . 
		'100%{' 
			. $Core::browserKey('transform','scale(1)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);







/* Translation */
/* Axe : Y */
$Core->keyframes('ggnTranslateYIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','translateY(50%)') 
			. $Core::browserKey('opacity','0.0') . 
		'} 100%{' 
			. $Core::browserKey('transform','translateY(0px)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);

$Core->keyframes('ggnTranslate-YIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','translateY(-50%)') 
			. $Core::browserKey('opacity','0.0') . 
		'} 100%{' 
			. $Core::browserKey('transform','translateY(0px)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);

$Core->keyframes('ggnTranslateYOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','translateY(0px)') 
			. $Core::browserKey('opacity','1') . 
		'} 100%{' 
			. $Core::browserKey('transform','translateY(50%)') 
			. $Core::browserKey('opacity','0') . 
		'} }'
	, true
);

$Core->keyframes('ggnTranslate-YOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','translateY(0px)') 
			. $Core::browserKey('opacity','1') . 
		'} 100%{' 
			. $Core::browserKey('transform','translateY(-50%)') 
			. $Core::browserKey('opacity','0') . 
		'} }'
	, true
);


/* Axe : X */
$Core->keyframes('ggnTranslateXIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','translateX(50%)') 
			. $Core::browserKey('opacity','0.0') . 
		'} 100%{' 
			. $Core::browserKey('transform','translateX(0px)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);

$Core->keyframes('ggnTranslate-XIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','translateX(-50%)') 
			. $Core::browserKey('opacity','0.0') . 
		'} 100%{' 
			. $Core::browserKey('transform','translateX(0px)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);

$Core->keyframes('ggnTranslateXOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','translateX(0px)') 
			. $Core::browserKey('opacity','1') . 
		'} 100%{' 
			. $Core::browserKey('transform','translateX(50%)') 
			. $Core::browserKey('opacity','0.0') . 
		'} }'
	, true
);

$Core->keyframes('ggnTranslate-XOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','translateX(0px)') 
			. $Core::browserKey('opacity','1') . 
		'} 100%{' 
			. $Core::browserKey('transform','translateX(-50%)') 
			. $Core::browserKey('opacity','0.0') . 
		'} }'
	, true
);












/* Rotation */
/* Axe : Y */
$Core->keyframes('ggnRotateYIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','rotateY(89deg)') 
			. $Core::browserKey('opacity','0.0') . 
		'} 100%{' 
			. $Core::browserKey('transform','rotateY(0deg)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);

$Core->keyframes('ggnRotate-YIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','rotateY(-89deg)') 
			. $Core::browserKey('opacity','0.0') . 
		'} 100%{' 
			. $Core::browserKey('transform','rotateY(0deg)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);

$Core->keyframes('ggnRotateYOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','rotateY(0deg)') 
			. $Core::browserKey('opacity','1') . 
		'} 100%{' 
			. $Core::browserKey('transform','rotateY(89deg)') 
			. $Core::browserKey('opacity','0') . 
		'} }'
	, true
);

$Core->keyframes('ggnRotate-YOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','rotateY(0deg)') 
			. $Core::browserKey('opacity','1') . 
		'} 100%{' 
			. $Core::browserKey('transform','rotateY(-89deg)') 
			. $Core::browserKey('opacity','0') . 
		'} }'
	, true
);



/* Axe : Z */
$Core->keyframes('ggnRotateZIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','rotateZ(89deg)') 
			. $Core::browserKey('opacity','0.0') . 
		'} 100%{' 
			. $Core::browserKey('transform','rotateZ(0deg)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);

$Core->keyframes('ggnRotate-ZIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','rotateZ(-89deg)') 
			. $Core::browserKey('opacity','0.0') . 
		'} 100%{' 
			. $Core::browserKey('transform','rotateZ(0deg)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);

$Core->keyframes('ggnRotateZOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','rotateZ(0deg)') 
			. $Core::browserKey('opacity','1') . 
		'} 100%{' 
			. $Core::browserKey('transform','rotateZ(89deg)') 
			. $Core::browserKey('opacity','0') . 
		'} }'
	, true
);

$Core->keyframes('ggnRotate-ZOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','rotateZ(0deg)') 
			. $Core::browserKey('opacity','1') . 
		'} 100%{' 
			. $Core::browserKey('transform','rotateZ(-89deg)') 
			. $Core::browserKey('opacity','0') . 
		'} }'
	, true
);



/* Axe : X */
$Core->keyframes('ggnRotateXIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','rotateX(89deg)') 
			. $Core::browserKey('opacity','0.0') . 
		'} 100%{' 
			. $Core::browserKey('transform','rotateX(0deg)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);

$Core->keyframes('ggnRotate-XIn'
	, 
		'{0%{'
			. $Core::browserKey('transform','rotateX(-89deg)') 
			. $Core::browserKey('opacity','0.0') . 
		'} 100%{' 
			. $Core::browserKey('transform','rotateX(0deg)') 
			. $Core::browserKey('opacity','1') . 
		'} }'
	, true
);

$Core->keyframes('ggnRotateXOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','rotateX(0deg)') 
			. $Core::browserKey('opacity','1') . 
		'} 100%{' 
			. $Core::browserKey('transform','rotateX(89deg)') 
			. $Core::browserKey('opacity','0.0') . 
		'} }'
	, true
);

$Core->keyframes('ggnRotate-XOut'
	, 
		'{0%{'
			. $Core::browserKey('transform','rotateX(0deg)') 
			. $Core::browserKey('opacity','1') . 
		'} 100%{' 
			. $Core::browserKey('transform','rotateX(-89deg)') 
			. $Core::browserKey('opacity','0.0') . 
		'} }'
	, true
);


?>