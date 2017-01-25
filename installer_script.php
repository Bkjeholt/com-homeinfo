<?php
/************************************************************************
 Product    : Home information
 Date       : 2012-12-21
 Copyright  : Copyright (C) 2012 Kjeholt Engineering. All rights reserved.
 Contact    : dev@kjeholt.se
 Url        : http://dev.kjeholt.se
 Licence    : Den Kjeholtska licensmodellen
 ---------------------------------------------------------
 File       : installer_script.php
 Version    : 0.5.1
 Author     : Bjorn Kjeholt
 *************************************************************************/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
/**
 * Script file of HomeInfo component
 */

define( 'JPATH_ADMINISTRATOR_COMPONENT_PATH', 
		JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_homeinfo' );

define( 'JPATH_ADMINISTRATOR_INCLUDES_PATH', 
		JPATH_ADMINISTRATOR_COMPONENT_PATH . DS . 'includes' );

define( 'JPATH_ADMINISTRATOR_HELPER_PATH', 
		JPATH_ADMINISTRATOR_COMPONENT_PATH . DS . 'helpers' );

define( 'JPATH_ADMINISTRATOR_CONSTANT_PATH', 
		JPATH_ADMINISTRATOR_COMPONENT_PATH . DS . 'includes' );

// require_once ( JPATH_ADMINISTRATOR_INCLUDES_PATH .DS. 'cli_include.php');

//include_once ( JPATH_ADMINISTRATOR_HELPER_PATH .DS.'task_execute.php');

class com_HomeInfoInstallerScript
{
	function __construct() {
		//Import filesystem libraries. Perhaps not necessary, but does not hurt


		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');
		
	}
	/**
	 * method to install the component
	 *
	 * @return void
	 */
	function install($parent) 
	{
		// $parent is the class calling this method
		echo '<p>' . JText::_('COM_HOMEINFO_INSTALL_TEXT') . '</p>';
//		$parent->getParent()->setRedirectURL('index.php?option=com_homeinfo');
	}
 
	/**
	 * method to uninstall the component
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
		// $parent is the class calling this method
		echo '<p>' . JText::_('COM_HOMEINFO_UNINSTALL_TEXT') . '</p>';
	}
 
	/**
	 * method to update the component
	 *
	 * @return void
	 */
	function update($parent) 
	{
		// $parent is the class calling this method
		echo '<p>' . JText::_('COM_HOMEINFO_UPDATE_TEXT') . '</p>';
	}
 
	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @return void
	 */
	function preflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
		echo '<p>' . JText::_('COM_HOMEINFO_PREFLIGHT_' . $type . '_TEXT') . '</p>';
		
		/*
		 * Activate a mechanism to prohibit updates of database tables during the component update
		 * TODO Create an update semaphore
		 */
		
	}
 
	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	function postflight($type, $parent) {
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
		echo '<p>' . JText::_('COM_HOMEINFO_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
		
		/*
		 * Setup paths, both towards source and destination
		 */
		
		
//		define( 'JPATH_BASE', realpath(dirname(__FILE__).DS.'..' ));
		define( 'COMP_NAME', 'com_homeinfo');

		define( 'JPATH_DST_CLI', JPATH_ROOT . DS . 'cli' . DS . COMP_NAME);
		define( 'JPATH_SRC_CLI', JPATH_ADMINISTRATOR . DS . 'components' .DS. COMP_NAME .DS. 'cli');

		echo '<p>JPATH_DST_CLI = '.JPATH_DST_CLI.'<br>';
		echo 'JPATH_SRC_CLI = '.JPATH_SRC_CLI.'</p>';

		/*
		 * Check to see if the com_homeinfo directory exist under cli and create it if it's required
		*/
		
		JFolder::create(JPATH_DST_CLI);
		
		
		if (!JPath::setPermissions($path = JPATH_DST_CLI)) {
//			echo '<p>Permissions failed</p>';
		}

		/*
		 * Copy the entry files
		*/
		
		$srcFiles = JFolder::files(JPATH_SRC_CLI,'.',false,false);
		
		echo '<h4>' . JText::_('Copy files') . '</h4>';
		
		foreach ($srcFiles as $srcFileName) {
			$src = JPATH_SRC_CLI . DS . $srcFileName;
			$dst = JPATH_DST_CLI . DS . $srcFileName;
			
			echo '<p>'. JText::_('From = ' . $src . '') . '<br>'. JText::_('To = ' . $dst . '') . '</p>';
			JFile::copy(	$src, $dst);
		}

		echo '<h4>Populate the #__hi_xml table in case it is empty</h4>';

		require_once ( JPATH_ADMINISTRATOR_INCLUDES_PATH .DS. 'cli_include.php');
		
//		$xmlInternalInfo = HomeInfoHelperDatabase::getInfoTree();
		
//		echo '<p>XML internal information<br>' . htmlspecialchars($xmlInternalInfo->asXML()) . '</p>';
		
		
		// Prepare tasks for scanning of data and info

//		$taskObj = JApplicationCli::getInstance('homeInfoHelperTask');
//		$taskObj->createBasicTasks($debug=true);
		
//		$taskExecuteObj = new homeCtrlHelperTask();
//		$taskExecuteObj->createBasicTasks($debug = false);

		/*
		 * Deactivate a mechanism to prohibit updates of database tables during the component update
		* TODO Create an update semaphore
		*/
		
		
	}
}