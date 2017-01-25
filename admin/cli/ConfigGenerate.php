<?php
/**
 * @version     0.3.0
 * @package     com_homectrl
 * @filesource	url_generator.php
 * @copyright   Copyright (C) 2012 Kjeholt Engineering. All rights reserved.
 * @license     Den Kjeholtska licensmodellen
 * @author      Björn Kjeholt
 * @mail        dev@kjeholt.se
 */
 
function generate($url,$msg) {
	$total = $url.'?msg='.urlencode($msg);

	return $total;
}

function writeOrder($url,$msg) {
	$total = generate($url,$msg);
	
	$fp = fopen ($total, "r");
	
	if ($fp) {
		echo "<div><p>url_generator: Output from fopen</p>";
		while (($buffer = fgets($fp, 4096)) !== false) {
			echo $buffer;
		}
		if (!feof($fp)) {
			echo "Error: unexpected fgets() fail\n";
		}
		echo "<p>url_generator: End of output from fopen</p></div>";
	}
	fclose($fp);
	
	return true;
}

// ----------------------------------------------------------------------------------------------

$urlDest = 'http://dev.kjeholt.se/cli/com_homeinfo_cli.php';
$urlConfig = 'http://ssa174.dyndns.org/dev/cli/com_homeinfo_cli.php';

$msgDeviceData = 
	'<msgs key="080625100526">' .
		'<devdata uts="' . time() . '">' .
			'<data did="17">09.15</data>' .
			'<data did="35" sd="A">12345</data>' .
			'<data did="35" sd="B">54321</data>' .
			'<data did="43">23.6</data>' .
			'<data did="45">-1.2</data>' .
			'</devdata>' .
	'</msgs>';


$msgConfig = '
<msgs key="080625100526">
	<config clear="yes"> 
			<rootpath>/mnt/1wire</rootpath>
			<destination 
				name="kjeholt.se" 
				url="http://dev.kjeholt.se/cli/com_homeinfo_cli.php" 
				key="7112299347"/>
		</config>
	</msgs>
';
/*
	'<msgs key="080625100526">' .
		'<config clear="yes">' . 
			'<rootpath>/mnt/1wire</rootpath>' .
			'<destination name="kjeholt.se" url="' . $urlDest . '" key="7112299347"/>' .
		'</config>' .
	'</msgs>';
*/
echo "<h1>Home Information support tool: ConfigGenerator.php</h1>";
echo "<p>url = " . htmlspecialchars($urlConfig) . "</p>";
echo "<h2>Generate device info string</h2>";
echo "<p>Device_info = " . htmlspecialchars($msgConfig) . "</p>";

writeOrder($urlConfig, $msgConfig);

?>

