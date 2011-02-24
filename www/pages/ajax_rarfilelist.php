<?php
require_once(WWW_DIR."/lib/releasefiles.php");

if (!$users->isLoggedIn())
	$page->show403();

if (!isset($_REQUEST["id"]))
	$page->show404();

$rf = new ReleaseFiles();
$files = $rf->getByGuid($_REQUEST["id"]);

if (count($files) == 0)
	print "No files";
else
{
	print "<ul>\n";
	foreach ($files as $f)
		print "<li>".htmlentities($f["name"], ENT_QUOTES)."</li>\n";
	print "</ul>";
}