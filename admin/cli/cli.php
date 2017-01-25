<?php
/************************************************************************
Product    : Home info
Date       : 2013-10-07
Copyright  : Copyright (C) 2013 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : admin/cli/cli.php
Version    : 0.6.4
Author     : Bjorn Kjeholt
*************************************************************************/
 
/*
 * init Joomla Framework
*/

define( '_JEXEC', 1 );
define( 'DS', DIRECTORY_SEPARATOR );
define( 'JPATH_BASE', realpath(dirname(__FILE__).DS.'..' ));

require_once ( JPATH_BASE.DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );

// Define the search path to the component declaration and class files

define( 'JPATH_ADMINISTRATOR_COMPONENT_PATH', JPATH_ADMINISTRATOR . DS .
												'components' . DS .
												'com_homeinfo' );

define( 'JPATH_ADMINISTRATOR_INCLUDES_PATH', JPATH_ADMINISTRATOR_COMPONENT_PATH . DS .
		'includes' );

define( 'JPATH_ADMINISTRATOR_HELPER_PATH', JPATH_ADMINISTRATOR_COMPONENT_PATH . DS .	
												'helpers' );

define( 'JPATH_ADMINISTRATOR_CLI_HELPER_PATH', JPATH_ADMINISTRATOR_HELPER_PATH . DS .	
												'cli' );

define( 'JPATH_ADMINISTRATOR_CONSTANT_PATH', JPATH_ADMINISTRATOR_COMPONENT_PATH . DS .
		'includes' );

require_once ( JPATH_ADMINISTRATOR_INCLUDES_PATH .DS. 'cli_include.php');

$mainframe = JFactory::getApplication('site');

/*
 * -------------------------------------------------------------------------------
 * Client                                                        Server
 *               <------------------------------------------
 *                    msg='xml stream'    
 *               ------------------------------------------>
 *                    msg='xml stream'    
 *                    
 */
/*
echo '<response time="' . time() . '">';
echo '<progress time="' . time() . '">';
echo '<title>com_homeinfo_cli</title>';
echo '<info param="msgParam">' . htmlspecialchars($msgParam) . '</info>';
echo '</progress>';
*/
// echo JPATH_BASE.'<br>';
// echo '<h2>com_homectrl?msg=...</h2>';
// echo '<p>_GET = <br>'.print_r($_GET).' </p>';
// echo '<p>msgParam = <br>'. htmlspecialchars($msgParam) .' </p>';

/*
 * check for clean input parameters and values
 */
$msgParam = $_GET['msg'];

// echo '<p>msgString = <br>'. htmlspecialchars($msgString) .' </p>';
/*
 * Call the main class for authorizing and analyse
 */

$mainClassObj = new HomeInfoHelperCli($debug=true);
$mainClassObj->execute($msgParam);

return 0;
?>