<?php



$path = HTTP_HOST.'windoo/';
$bgOnly = 'background-repeat:no-repeat;background-position:center center;';
$textEllipsis = 'white-space:nowrap;overflow:hidden;text-overflow:ellipsis;';


$iconSize = 10;




/*  windoo-sheet */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"]{');
$Core->Code('position:absolute;');
$Core->Code('z-index:100;');
$Core->Code($Core::browserKey('perspective', '600px'));
$Core->Code('min-width:200px !important;');
$Core->Code('min-height:80px !important;');
$Core->Code('background-color:'.$Core->styleProperty('dark-background-color').';');
$Core->Code($Core::browserKey('box-shadow','0px 0px 10px rgba(0,0,0,.80)'));
$Core->Code('}');


/*  windoo-sheet > titlebar */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.titlebar{');
$Core->Code('min-width:100% !important;');
// $Core->Code('background-color:rgba('.$Core->styleProperty('dark-background-color-rgb:hover').',.30);');
$Core->Code('}');

/*  windoo-sheet > titlebar > icon */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.titlebar > div.icon{');
$Core->Code('float:left;');
$Core->Code('margin-top:5px;');
$Core->Code('margin-left:7px;');
$Core->Code('text-align:center;');
$Core->Code($Core::size('25px !important'));
// $Core->Code('background-color:#ff2400;');
$Core->Code('}');

/*  windoo-sheet > titlebar > icon > img */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.titlebar > div.icon > img{');
$Core->Code('margin-top:7px;');
$Core->Code($Core::size('12px !important'));
$Core->Code('}');

/*  windoo-sheet > titlebar > label */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.titlebar > div.label{');
$Core->Code('cursor:default !important;');
$Core->Code('background-color:transparent;');
$Core->Code('color:'.$Core->styleProperty('dark-font-color').';');
$Core->Code('font-size:14px;');
$Core->Code('padding:10px 12px;');
$Core->Code('overflow:hidden;');
$Core->Code($Core::browserKey('text-shadow', '0px 0px 2px rgba(0,0,0,.75)'));
$Core->Code($textEllipsis);
$Core->Code('}');

/*  windoo-sheet > titlebar > ctrl */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.titlebar > div.ctrl{');
$Core->Code('float:right;');
$Core->Code('margin-right:5px;');
// $Core->Code('width:100px !important;');
$Core->Code('height:100% !important;');
// $Core->Code('background-color:#ff2400;');
$Core->Code('}');

/*  windoo-sheet > titlebar > ctrl > item */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.titlebar > div.ctrl > div.item{');
$Core->Code('cursor:pointer;');
$Core->Code('float:right;');
$Core->Code('position:relative;');
$Core->Code('width:32px;');
$Core->Code('height:30px;');
// $Core->Code('background-color:rgba(225,225,225,.21);');
$Core->Code('margin-right:0px;');
$Core->Code($Core::browserKey('border-radius','0px'));
// $Core->Code($Core::browserKey('border-bottom-left-radius','20px'));
// $Core->Code($Core::browserKey('box-shadow','0px 0px 5px rgba(0,0,0,.75)'));
$Core->Code('background-repeat:no-repeat;');
$Core->Code('background-position:center center;');
$Core->Code('}');

/*  windoo-sheet > titlebar > ctrl > item:first-child */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.titlebar > div.ctrl > div.item:first-child{');
$Core->Code($Core::browserKey('border-bottom-right-radius','5px'));
$Core->Code('}');

/*  windoo-sheet > titlebar > ctrl > item:last-child */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.titlebar > div.ctrl > div.item:last-child{');
$Core->Code($Core::browserKey('border-bottom-left-radius','5px'));
$Core->Code('}');

/*  windoo-sheet > titlebar > ctrl > item:hover */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.titlebar > div.ctrl > div.item:hover{');
$Core->Code('background-color:rgba('.$Core->styleProperty('dark-background-color-rgb:hover').',.75);');
$Core->Code('}');

/*  windoo-sheet > titlebar > ctrl > item.close */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.titlebar > div.ctrl > div.item.close{');
$Core->Code('z-index:3;');
$Core->Code('background-image:url('.HTTP_HOST.'icons/close.png?mode=-gd&width='.$iconSize.'&height='.$iconSize.');');
$Core->Code('}');

/*  windoo-sheet > titlebar > ctrl > item.close:hover */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.titlebar > div.ctrl > div.item.close:hover{');
$Core->Code('background-color:#900000;');
$Core->Code('}');

/*  windoo-sheet > titlebar > ctrl > item.maximize */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.titlebar > div.ctrl > div.item.maximize{');
$Core->Code('z-index:2;');
$Core->Code('background-image:url('.HTTP_HOST.'icons/maximize.png?mode=-gd&width='.$iconSize.'&height='.$iconSize.');');
$Core->Code('}');

/*  windoo-sheet > titlebar > ctrl > item.minimize */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.titlebar > div.ctrl > div.item.minimize{');
$Core->Code('z-index:1;');
$Core->Code('background-image:url('.HTTP_HOST.'icons/minimize.png?mode=-gd&width='.$iconSize.'&height='.$iconSize.');');
$Core->Code('}');









/*  windoo-sheet > container */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container{');
$Core->Code('position:relative;');
$Core->Code('float:left;');
$Core->Code('width:100% !important;');
$Core->Code('overflow:auto;');
// $Core->Code('background-color:red;');
$Core->Code('}');

/*  windoo-sheet > container > content */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content{');
$Core->Code($Core::size('100%'));
$Core->Code('}');

/*  windoo-sheet wdoo-loading */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] div.wdoo-loading{');
$Core->Code('}');

/*  windoo-sheet wdoo-loading.wait */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] div.wdoo-loading.wait{');
$Core->Code('font-family:verdana,arial,tahoma;');
$Core->Code('font-size:45px;');
$Core->Code('text-align:center;');
$Core->Code('}');

/*  windoo-sheet wdoo-loading.wait:after */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] div.wdoo-loading.wait:after{');
$Core->Code('content:"...";');
$Core->Code('}');

/*  windoo-sheet wdoo-loading.text */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] div.wdoo-loading.text{');
$Core->Code('font-family:'.$Core->styleProperty('headling-font-family').';');
$Core->Code('color:'.$Core->styleProperty('dark-font-color').';');
$Core->Code('font-size:21px;');
$Core->Code('text-align:center;');
$Core->Code('}');







/*  windoo-sheet > container > content.fxBlur */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content.fxGaussianBlur{');

$Core->Code($Core::browserKey('filter', '3px'));
$Core->Code('-webkit-filter: blur(3px);');
$Core->Code('filter: blur(3px);');

$Core->Code('filter: progid:DXImageTransform.Microsoft.Blur(pixelRadius=3);');
$Core->Code('filter:url(data:image/svg+xml;utf8,<svg xmlns=\'w3.org/2000/svg\'><filter id=\'blur\' x=\'0\' y=\'0\'><feGaussianBlur stdDeviation=\'3\'/></filter></svg>#blur);');

$Core->Code('}');



?>