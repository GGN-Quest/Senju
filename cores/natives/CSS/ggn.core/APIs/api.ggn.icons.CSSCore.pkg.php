/* Material Icons Regular */
<?php

/* PARAMETRES */
require self::commonFile('.settings');


/* Font Icons : MaterialIcons */

$FontDir = 'Icons/';

$Core->Code('@font-face {');

	$Core->Code('font-family: "Material Icons";');

    $Core->Code("font-style: normal;");

    $Core->Code("font-weight: 400;");

	$Core->Code("src: url('".$FontDir."index.eot.font');"); /* For IE6-8 */

	$Core->Code("src: local('Material Icons'),");

		$Core->Code(" local('MaterialIcons-Regular'),");

		$Core->Code(" url(".$FontDir."index.woff2.font) format('woff2'),");

		$Core->Code(" url(".$FontDir."index.woff.font) format('woff'),");

		$Core->Code(" url(".$FontDir."index.ttf.font) format('truetype');");

$Core->Code('}');


/* Style */
$Core->Code('.iconx,.x-icon{font-family: \'Material Icons\'; font-weight: normal; font-style: normal; display: inline-block; width: 1em; height: 1em; line-height: 1; text-transform: none; letter-spacing: normal; word-wrap: normal; white-space: nowrap; direction: ltr; -webkit-font-smoothing: antialiased; text-rendering: optimizeLegibility; -moz-osx-font-smoothing: grayscale; font-feature-settings: \'liga\'; }');

