<?php

require("config.php");
require_once(WWW_DIR."/lib/releases.php");
$tempdb =new DB();
$re = new ReleaseExtra();
$mediainfo = $tempdb->query("select releaseID,mediainfo from releaseextrafull");
foreach($mediainfo as $row)
{
//print $row['releaseID']."\n";
$re->addFromXml($row['releaseID'],$row['mediainfo']);
}

?>