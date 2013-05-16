<?php
defined ('_JEXEC') or die ('Direct Access to this location is not allowed.');
JHtml::_('behavior.tooltip');
jimport ('joomla.plugin.helper');
jimport( 'joomla.html.html.tabs');

$login = "";
if (array_key_exists('login', $this->settings)) 
{
	$login = $this->settings["login"];
}

$token = "";
if (array_key_exists('token', $this->settings)) 
{
	$token = $this->settings["token"];
}

?>
<style>
iframe
{
	border:0;
}
</style>

<script type="text/javascript">

</script>
<form action="<?php echo JRoute::_('index.php?option=com_scholaris&view=scholaris&layout=default'); ?>" method="post" name="adminForm" id="adminForm" class="form-horizontal">
	<fieldset>
		<legend>Konfiguracja Scholaris</legend>
		
		<div class="control-group">
			<div class="control-label">
				<label class="control-label">Login</label>
			</div>
			
			<div class="controls">
				<input type="text" class="inputbox" size="20" id="login" name="login" value="<?php echo $login; ?>">
			</div>
		</div>
		
		<div class="control-group">
			<div class="control-label">
				<label class="control-label">Token</label>
			</div>
			<div class="controls">
				<input type="password" class="inputbox" size="20" id="token" name="token" value="<?php echo $token; ?>">
			</div>
		</div>
		
		<input type="hidden" name="task" value="" />
	 </fieldset>
</form>

<fieldset>
	<legend>Zasoby Scholaris</legend>
	
	<div id="j-sidebar-container" class="span2">
		<div id="sidebar">
			<div class="sidebar-nav">
				<ul id="submenu" class="nav nav-list">
					<li id="nav_search">
						<a onclick="$('#nav_user').removeClass('active');$('#nav_search').addClass('active');" href="http://creator.staging.scht.pl/external/search/email/<?php echo $login; ?>" target="scholaristarget">Wyszukiwarka zasobów portalu</a>
					</li> 
					<li id="nav_user">
						<a onclick="$('#nav_search').removeClass('active');$('#nav_user').addClass('active');" href="http://creator.staging.scht.pl/external/publishlist/email/<?php echo $login; ?>" target="scholaristarget">Moje e-zasoby</a>
					</li>
				</ul>
				<hr>
			</div>
		</div>
	</div>

	<div>
		<iframe name="scholaristarget" width="900px;" height="800px;"></iframe>
	</div>
</fieldset>