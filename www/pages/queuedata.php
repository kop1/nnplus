<?php
require_once(WWW_DIR."/lib/sabnzbd.php");

if (!$users->isLoggedIn())
	$page->show403();

$sab = new SABnzbd($page);

if (empty($sab->url))
	$page->show404();

if (empty($sab->apikey))
	$page->show404();
	
$output = "";

$json = $sab->getQueue();
if ($json !== false)
{
	$obj = json_decode($json);
	$queue = $obj->{'jobs'};
	$count = 1;
	
	if (count($queue) > 0)
	{
		$output.="<table class=\"data\">";
		$output.="<tr>
		<th></th>
		<th>Name</th>
		<th style='width:80px;text-align:right;'>size (mb)</th>
		<th style='width:80px;text-align:right;'>left (mb)</th>
		<th style='width:50px;text-align:right;'>%</th>
		<th style='text-align:right;'>time left</th>
		<th></th>
		</tr>";
		foreach ($queue as $item)
		{
			if (strpos($item->{'filename'}, "fetch NZB") > 0)
			{
			}
			else
			{
				$output.="<tr>";
				$output.="<td style='text-align:right;padding-right:10px;'>".$count.")</td>";
				$output.="<td>".$item->{'filename'}."</td>";
				$output.="<td style='text-align:right;'>".number_format(round($item->{'mb'}))."</td>";
				if ($count ==1)
				{
					$output.="<td class='right'>".number_format(round($item->{'mbleft'}))."</td>";
					$output.="<td class='right'>".($item->{'mb'}==0?0:round($item->{'mbleft'}/$item->{'mb'}*100))."%</td>";
				}
				else
				{
					$output.="<td></td><td></td>";
				}
				$output.="<td style='text-align:right;'>".$item->{'timeleft'}."</td>";
				$output.="<td style='text-align:right;'><a href='?del=".$item->{'id'}."'>delete</a></td>";
				$output.="</tr>";
				$count++;
			}
		}
		$output.="</table>";
	}
	else
	{
		$output.="<p>The queue is currently empty.</p>";
	}
}
else
{
	$output.="<p>Error retreiving queue.</p>";
}

print $output;
?>