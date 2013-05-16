<?php
defined ('_JEXEC') or die ('Direct Access to this location is not allowed.');
jimport ('joomla.application.component.modellist');

/**
 * SocialLoginAndSocialShare Model.
 */
 
class ScholarisModelScholaris extends JModelList
{
	/**
	 * Save Settings.
	 */
	public function saveSettings ()
	{
		//Get database handle
		$db = $this->getDbo ();
		$api_settings = array();
        $mainframe = JFactory::getApplication();
		
		//Read Settings
		$settings = array();
		$login = JRequest::getVar('login');
		$token = JRequest::getVar('token');
		$settings['login'] = trim($login);
		$settings['token'] = trim($token);

		//if (! $this->isValidApiSettings($apikey)) {
		if(false)
		{
			JError::raiseWarning ('', JText::_ ('COM_SOCIALLOGIN_APIKEY_ERROR'));
			$mainframe->redirect (JRoute::_ ('index.php?option=com_scholaris&view=scholaris&layout=default', false));
		}
		else {
		  $sql = "DELETE FROM scholaris";
		  $db->setQuery ($sql);
		  $db->execute();
		  
          //Insert new settings
		  foreach ($settings as $k => $v)
		  {
			$sql = "INSERT INTO scholaris (setting, value )" . " VALUES (" . $db->Quote ($k) . ", " . $db->Quote ($v) . ")";
			$db->setQuery ($sql);
			$db->execute();
		  }
		}
	}

	/**
	 * Read Settings
	 */
	public function getSettings ()
	{
		$settings = array ();
        $db = $this->getDbo ();
        $sql = "SELECT * FROM scholaris";
		$db->setQuery ($sql);
		$rows = $db->LoadAssocList ();

		if (is_array ($rows))
		{
			foreach ($rows AS $key => $data)
			{
				$settings [$data['setting']] = $data ['value'];
			}
		}

		return $settings;
	}
}