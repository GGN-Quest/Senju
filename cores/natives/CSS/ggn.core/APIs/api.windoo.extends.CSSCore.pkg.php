<?php


$path = HTTP_HOST.'windoo/';
$bgOnly = 'background-repeat:no-repeat;background-position:center center;';
$textEllipsis = 'white-space:nowrap;overflow:hidden;text-overflow:ellipsis;';


$iconSize = 10;



/* Windoo Extends */
/*  windoo-sheet > container > content > sidebar */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content > div.sidebar{');
$Core->Code('float:left;');
$Core->Code('width:25%;');
$Core->Code('height:100%;');
$Core->Code('margin-right:2%;');
$Core->Code('overflow:hidden;');
$Core->Code('background-color:rgba('.$Core->styleProperty('background-color-rgb').',.10);');
$Core->Code('}');

/*  windoo-sheet > container > content > sidebar:hover */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content > div.sidebar:hover{');
$Core->Code('overflow:auto;');
$Core->Code('}');


/*  windoo-sheet > container > content > sidebar > items */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content > div.sidebar > div.items{');
$Core->Code('width:100%;');
$Core->Code('}');

/*  windoo-sheet > container > content > sidebar > items > item */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content > div.sidebar > div.items > div.item{');
$Core->Code($Core::cVertical('margin','1px'));
$Core->Code('border-bottom:1px solid rgba('.$Core->styleProperty('dark-background-color-rgb:hover').',.40);');
$Core->Code('padding:14px 20px;');
$Core->Code('font-size:12px;');
$Core->Code('cursor:pointer;');
// $Core->Code('background-color:'.$Core->styleProperty('background-color').';');
$Core->Code($Core::browserKey('transition','background-color 0.3s ease-in-out'));
$Core->Code($textEllipsis);
$Core->Code('}');

/*  windoo-sheet > container > content > sidebar > items > item:hover */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content > div.sidebar > div.items > div.item.active');
$Core->Code(',div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content > div.sidebar > div.items > div.item:hover{');
$Core->Code('background-color:rgba('.$Core->styleProperty('background-color-rgb').',.50);');
$Core->Code('}');

/*  windoo-sheet > container > content > sidebar > items > item.active */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content > div.sidebar > div.items > div.item.active{');
$Core->Code('background-image:url('.$path.'mrght.png);');
$Core->Code('background-repeat:no-repeat;');
$Core->Code('background-position:right center;');
$Core->Code('}');




/*  windoo-sheet > container > content > page */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content > div.page{');
$Core->Code('float:right;');
$Core->Code('width:73%;');
$Core->Code('}');

/*  windoo-sheet > container > content > page > title */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content > div.page > div.title{');
$Core->Code('text-align:left;');
$Core->Code('padding:15px 15px 0px 15px;');
$Core->Code('font-size:27px;');
$Core->Code('font-family:'.$Core->styleProperty('headling-font-family').';');
$Core->Code('}');

/*  windoo-sheet > container > content > page > about */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content > div.page > div.about{');
$Core->Code('text-align:left;');
$Core->Code('padding:0px 15px 10px 15px;');
$Core->Code('font-size:12px;');
$Core->Code('color:'.$Core->styleProperty('dark-font-color').';');
$Core->Code('}');






/*  windoo-sheet > container > content > lockBox > light */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container div.light[gui-api-lockbox="ultra.light"]{');
$Core->Code('background-color:rgba(0,0,0,.80); !important');
$Core->Code($Core::browserKey('animation','starterLightFade 0.5s ease-in-out'));
$Core->Code('}');

/*  windoo-sheet > container > content > lockBox > box */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container div.box[gui-api-lockbox="ultra.box"]{');
$Core->Code('background-color:'.$Core->styleProperty('dark-background-color').' !important;');
// $Core->Code($Core::browserKey('animation','starterBoxZoom 0.5s ease-out '));
$Core->Code($Core::browserKey('box-shadow','0px 0px 5px rgba(0,0,0,.80) '));
$Core->Code('}');









/*  windoo-sheet > container > content form */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content .form{');
$Core->Code('padding:0px 15px 0px 15px;');
$Core->Code('}');

/*  windoo-sheet > container > content form > headling */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content .form > div.headling{');
$Core->Code('float:left;');
$Core->Code('width:100%;');
$Core->Code('margin:10px 0px;');
$Core->Code('font-size:24px;');
$Core->Code('color:'.$Core->styleProperty('dark-font-color').';');
$Core->Code('font-family:'.$Core->styleProperty('headling-font-family').';');
$Core->Code('}');

/*  windoo-sheet > container > content form > entry */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content .form > div.entry{');
$Core->Code('float:left;');
$Core->Code('width:100%;');
$Core->Code($Core::cVertical('margin','3px'));
$Core->Code('}');

/*  windoo-sheet > container > content form > entry > label */
// $Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content .form > div.entry > div.label{');
// $Core->Code('float:left;');
// $Core->Code('width:30%;');
// $Core->Code('padding:5px 0px;');
// $Core->Code('margin-right:2%;');
// $Core->Code('font-size:14px;');
// $Core->Code('text-align:right;');
// $Core->Code('color:'.$Core->styleProperty('dark-font-color').';');
// $Core->Code($textEllipsis);
// $Core->Code('}');

/*  windoo-sheet > container > content form > entry > field */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content .form > div.entry > div.field{');
$Core->Code('float:left;');
$Core->Code('width:99%;');
// $Core->Code('width:65%;');
$Core->Code('');
$Core->Code('}');

/*  windoo-sheet > container > content form > entry > field > input */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content .form > div.entry > div.field > input[type="password"]');
$Core->Code(',div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content .form > div.entry > div.field > select');
$Core->Code(',div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content .form > div.entry > div.field > input[type="text"]{');
$Core->Code('width:90%;');
// $Core->Code('font-size:15px;');
// $Core->Code('color:'.$Core->styleProperty('font-color').';');
// $Core->Code('padding:10px 12px;');
// $Core->Code('border:1px solid rgba('.$Core->styleProperty('dark-background-color-rgb:hover').',.70);');
// $Core->Code('background-color:rgba('.$Core->styleProperty('dark-background-color-rgb:hover').',.10);');
$Core->Code('}');

/*  windoo-sheet > container > content form > entry > field > select */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content .form > div.entry > div.field > select{');
$Core->Code('width:40%;');
$Core->Code('margin-left:15px;');
$Core->Code('}');

/*  windoo-sheet > container > content form > entry > field > input */
$Core->Code('div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content .form > div.entry > div.field > input[type="submit"]');
$Core->Code(',div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content .form > div.entry > div.field > input[type="reset"]');
$Core->Code(',div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content .form > div.entry > div.field > button');
$Core->Code(',div.windoo-sheet[gui-api-windoo="sheet"] > div.container > div.content .form > div.entry > div.field > input[type="button"]{');
$Core->Code('font-size:15px;');
$Core->Code('padding:10px 20px;');
$Core->Code('color:'.$Core->styleProperty('font-color:hover').';');
$Core->Code('background-color:'.$Core->styleProperty('font-color:hover').';');
$Core->Code('}');


?>