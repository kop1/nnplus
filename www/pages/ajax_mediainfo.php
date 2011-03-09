<?php
require_once(WWW_DIR."/lib/releaseextra.php");

if (!$users->isLoggedIn())
	$page->show403();

if (!isset($_REQUEST["id"]))
	$page->show404();

$re = new ReleaseExtra();
$redata = $re->getByGuid($_REQUEST["id"]);

if (!$redata)
	print "No media info";
else
{
	//print "<h3 class=\"tooltiphead\">extended media info...</h3>\n";
	print "<table>\n";
	if ($redata["containerformat"] != "")
		print "<tr><th>Container Format:</th><td>".htmlentities($redata["containerformat"], ENT_QUOTES)."</td></tr>\n";
	if ($redata["overallbitrate"] != "")
		print "<tr><th>Bitrate:</th><td>".htmlentities($redata["overallbitrate"], ENT_QUOTES)."</td></tr>\n";
	if ($redata["videoduration"] != "")
		print "<tr><th>Duration:</th><td>".htmlentities($redata["videoduration"], ENT_QUOTES)."</td></tr>\n";
	if ($redata["videoformat"] != "")
		print "<tr><th>Format:</th><td>".htmlentities($redata["videoformat"], ENT_QUOTES)."</td></tr>\n";
	if ($redata["videocodec"] != "")
		print "<tr><th>Codec:</th><td>".htmlentities($redata["videocodec"], ENT_QUOTES)."</td></tr>\n";
	if ($redata["videowidth"] != "")
		print "<tr><th>Dimension:</th><td>".htmlentities($redata["videowidth"], ENT_QUOTES)."x".htmlentities($redata["videoheight"], ENT_QUOTES)."</td></tr>\n";
	if ($redata["videoaspect"] != "")
		print "<tr><th>Aspect:</th><td>".htmlentities($redata["videoaspect"], ENT_QUOTES)."</td></tr>\n";
	if ($redata["videoframerate"] != "")
		print "<tr><th>Framerate:</th><td>".htmlentities($redata["videoframerate"], ENT_QUOTES)."</td></tr>\n";
	if ($redata["audioformat"] != "")
		print "<tr><th>Audio Format:</th><td>".htmlentities($redata["audioformat"], ENT_QUOTES)."</td></tr>\n";
	if ($redata["audiomode"] != "")
		print "<tr><th>Mode:</th><td>".htmlentities($redata["audiomode"], ENT_QUOTES)."</td></tr>\n";
	if ($redata["audiobitratemode"] != "")
		print "<tr><th>Bitrate Mode:</th><td>".htmlentities($redata["audiobitratemode"], ENT_QUOTES)."</td></tr>\n";
	if ($redata["audiobitrate"] != "")
		print "<tr><th>Bitrate:</th><td>".htmlentities($redata["audiobitrate"], ENT_QUOTES)."</td></tr>\n";
	if ($redata["audiochannels"] != "")
		print "<tr><th>Channels:</th><td>".htmlentities($redata["audiochannels"], ENT_QUOTES)."</td></tr>\n";
	if ($redata["audiosamplerate"] != "")
		print "<tr><th>Sample Rate:</th><td>".htmlentities($redata["audiosamplerate"], ENT_QUOTES)."</td></tr>\n";
	print "</table>";
}	
