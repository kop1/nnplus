<?php
require_once('../config.php');
require_once('../lib/installpage.php');
require_once('../lib/install.php');

$page = new Installpage();

if (!isset($_REQUEST["success"]))
	$page->title = "NZB File Path";

$cfg = new Install();

if (!$cfg->isInitialized()) {
	header("Location: index.php");
	die();
}

$cfg = $cfg->getSession();

if  ($page->isPostBack()) {
	$cfg->doCheck = true;
	
	$cfg->NZB_PATH = trim($_POST['nzbpath']);
	
	if ($cfg->NZB_PATH == '') {
		$cfg->error = true;
	} else 
	{
		$cfg->nzbPathCheck = is_writable($cfg->NZB_PATH);
		if($cfg->nzbPathCheck === false) 
		{
			$cfg->error = true;
		}
		
		$lastchar = substr($cfg->NZB_PATH, strlen($cfg->NZB_PATH) - 1);
		if ($lastchar != "/")
			$cfg->NZB_PATH = $cfg->NZB_PATH."/";
			
		if (!$cfg->error) 
		{
			mkdir($cfg->NZB_PATH."tmpunrar");
		
			require_once($cfg->WWW_DIR.'/lib/framework/db.php');
			$db = new DB();
			$sql = sprintf("UPDATE site SET nzbpath = %s, tmpunrarpath = %s WHERE id = 1", $db->escapeString($cfg->NZB_PATH), $db->escapeString($cfg->NZB_PATH."tmpunrar"));
			if ($db->query($sql) === false) 
			{
				$cfg->error = true;
			}
		}
	}
	
	if (!$cfg->error) {
		$cfg->setSession();
		header("Location: ?success");
		die();
	}
}

$page->smarty->assign('cfg', $cfg);

$page->smarty->assign('page', $page);

$page->content = $page->smarty->fetch('step6.tpl');
$page->render();

?>