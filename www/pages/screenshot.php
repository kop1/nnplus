<?php
require_once(WWW_DIR."/lib/releases.php");

if (!$users->isLoggedIn())
	$page->show403();
	
if (isset($_GET["id"]))
{
	$releases = new Releases;
	$rel = $releases->getByGuid($_GET["id"]);

	if (!$rel)
		$page->show404();
		
	$page->smarty->assign('rel', $rel);		
	$page->title = "Screenshot for ".$rel['searchname'];
	$page->content = $page->smarty->fetch('viewscreenshot.tpl');

	echo $page->content;
}

?>
