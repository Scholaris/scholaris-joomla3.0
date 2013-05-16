<?php
/* no direct access*/

defined( '_JEXEC' ) or die( 'Restricted access' );
if(!class_exists('ContentHelperRoute')) require_once (JPATH_SITE . '/components/com_content/helpers/route.php'); 

jimport('joomla.plugin.plugin');
jimport('joomla.html.parameter');

/**
 * plgContentSocialShare
 */  
class plgContentScholaris extends JPlugin {
  
   /**
    * Constructor
    * Loads the plugin settings and assigns them to class variables
    */
    public function __construct(&$subject)
    {
        parent::__construct($subject);
		
		$this->_plugin = JPluginHelper::getPlugin('content', 'scholaris');
        $this->_params = new JRegistry($this->_plugin->params);
    }
    
	/*
		[scholaris sl_token="565554dcb55b3531256ceb2bb98f42190b724b49" color="#000000" width="640"]
		<iframe src="http://creator.staging.scht.pl/preview/show/token/6488f461884fae03a84e27f4e8e3dba3666b5588" scrolling="no" frameborder="1" style="border:1px solid #d42ad4; overflow:hidden; width:500px; height:375px;" allowtransparency="true"></iframe>
	*/
	public function onContentPrepare($context, &$article, &$params, $limitstart)
	{
		$attrs = explode(' ',trim($article->text,'[]'));
		$width = 0;
		foreach ($attrs as $attrstr){
			$attr = explode('=', $attrstr);
			if($attr[0]=='width'){
				$width = trim($attr[1],'"');
			}
		}
		$height = floor( ( (int)$width * 3 ) / 4 );
		
		$settings = $this->getSettingsScholaris();
		
		if(isset($settings['login']))
		{
			$email = $settings['login'];
		}
		if(isset($settings['token']))
		{
			$token = $settings['token'];
		}
		
		$article->text = str_replace(array(
				'[zasoby_scholaris]'
		), array(
				'<fieldset style="border:0px; padding:1em; margin-top:2em">
				<div id="j-sidebar-container" class="span2" style="margin-bottom:1em; width:50%">
					<div id="sidebar">
						<div class="sidebar-nav">
							<ul id="submenu" class="nav nav-list">
								<li id="nav_search">
									<a id="id1" onclick="linkOneOnClick()" href="http://creator.staging.scht.pl/external/search/email/{emailcloak=off}'.$email.'" target="_blank">Wyszukiwarka zasobów portalu</a>
								</li>
								<li id="nav_user">
									<a id="id2" onclick="linkTwoOnClick()" href="http://creator.staging.scht.pl/external/publishlist/email/{emailcloak=off}'.$email.'" target="_blank">Moje e-zasoby</a>
								</li>
							</ul>
						</div>
					</div>
				</div>

			  	</fieldset></head>'
		), $article->text);
		
		$article->text = str_replace(array(
				'[scholaris ',
				'sl_token="',
				'po_token="',
				']'
		), array(
				'<iframe id="scholaris" ',
				'src="http://creator.staging.scht.pl/preview/show/token/',
				'src="http://portal.staging.scht.pl/resources/run/token/',
				' scrolling="no" frameborder="1" style="border:1px solid #d42ad4; overflow:hidden; height: '.$height.'px" allowtransparency="true"></iframe>'
		), $article->text);
		
	}
	 
	/**
	 * Before display content method
	 */
	public function onContentBeforeDisplay($context, &$article, &$params, $limitstart=0) 
	{
	} 
	  
	/**
	 * After display content method
	 */
	public function onContentAfterDisplay($context, &$article, &$params, $limitstart=0) 
	{
	} 
	
	/**
	 * Read Settings
	 */
	public function getSettingsScholaris()
	{
		$settings = array();
		$db = JFactory::getDBO();
		$sql = "SELECT * FROM scholaris";
		$db->setQuery($sql);
		$rows = $db->LoadAssocList();
	
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
  