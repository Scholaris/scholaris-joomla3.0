<?php
defined ('_JEXEC') or die ('Restricted access');
jimport ('joomla.application.component.view');

/**
 * Class generate view.
 */
class scholarisViewScholaris extends JViewLegacy
{
	public $settings;
	
	/**
	 * SocialLogin - Display administration area
	 */
	public function display ($tpl = null)
	{
		$document = JFactory::getDocument();
		$document->addScript ('components/com_scholaris/assets/jquery.js');
		$document->addScript ('http://code.jquery.com/ui/1.10.0/jquery-ui.js');
		
		$model = $this->getModel();
		$this->settings = $model->getSettings();
     	$this->form = $this->get('Form');
		$this->addToolbar();
        parent::display ($tpl);
	}

	
	/**
	 * SocialLogin - Add admin option on toolbar
	 */
	protected function addToolbar ()
	{
		JRequest::setVar ('hidemainmenu', false);
		JToolBarHelper::title (JText::_ ('Scholaris - konfiguracja'), 'configuration.gif');
		JToolBarHelper::apply ('apply');
		JToolBarHelper::save($task = 'save', $alt = 'JTOOLBAR_SAVE');
		JToolBarHelper::cancel ('cancel');
	}
}