<?php

//This script allows you to delete properly all releases which match some criteria
//The nzb, covers and all linked records will be deleted properly.

define('FS_ROOT', realpath(dirname(__FILE__)));
require_once(FS_ROOT."/../../www/config.php");
require_once(FS_ROOT."/../../www/lib/framework/db.php");
require_once(FS_ROOT."/../../www/lib/releases.php");

$releases = new Releases();
$db = new Db;

$rel = $db->query("select * from releases where totalpart = 1 and groupID in (select ID from groups where name = 'alt.binaries.cd.image') ");

echo "about to delete ".count($rel)." release(s)";

foreach ($rel as $r) 
{
	$releases->delete($r['ID']);
}

?>