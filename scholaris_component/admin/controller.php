<?php

defined ('_JEXEC') or die ('Direct Access to this location is not allowed.');
jimport ('joomla.application.component.controller');

/**
 * Controller of SocialLogin component.
 */
class ScholarisController extends JControllerLegacy
{
	
	public function display ($cachable = false, $urlparams = false)
	{
		JRequest::setVar ('view', JRequest::getCmd('view', 'Scholaris'));
		parent::display ($cachable);
	}

	/**
	 * Save settings
	 */
	public function apply ()
	{
	    $mainframe = JFactory::getApplication();
		$model = $this->getModel ();
		$model->saveSettings ();
		$mainframe->enqueueMessage (JText::_ ('COM_SCHOLARIS_SETTING_SAVED'));
		$this->setRedirect (JRoute::_ ('index.php?option=com_scholaris&view=scholaris&layout=default', false));
	}
	
	/**
	 * Save and close settings
	 */
	public function save()
	{  
	    $mainframe = JFactory::getApplication();
		$model = &$this->getModel();
		$model->saveSettings ();
		$mainframe->enqueueMessage (JText::_ ('COM_SCHOLARIS_SETTING_SAVED'));	
        $this->setRedirect (JRoute::_ ('index.php', false));
	}
	
	/**
	 * cancel settings
	 */
	public function cancel ()
	{
		//$model = &$this->getModel();
		//$model->saveSettings ();
		$this->setRedirect (JRoute::_ ('index.php', false));
	}

}
