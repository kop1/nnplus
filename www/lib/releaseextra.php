<?php
require_once(WWW_DIR."/lib/framework/db.php");

class ReleaseExtra
{	
	public function get($id)
	{
		$db = new DB();
		return $db->queryOneRow(sprintf("select * from releaseextra where releaseID = %d", $id));	
	}
	
	public function getByGuid($guid)
	{
		$db = new DB();
		return $db->queryOneRow(sprintf("select releaseextra.* from releaseextra inner join releases r on r.ID = releasefiles.releaseID where r.guid = %s ", $db->escapeString($guid)));	
	}	
	
	public function delete($id)
	{
		$db = new DB();
		return $db->query(sprintf("delete from releaseextra where releaseID = %d", $id));	
	}

	public function addFromXml($releaseID, $xml)
	{
		$xmlObj = @simplexml_load_string($xml);
		$arrXml = objectsIntoArray($xmlObj);
		$containerformat = ""; $overallbitrate = "";
		$videoduration = ""; $videoformat = ""; $videocodec = ""; $videowidth = ""; $videoheight = ""; $videoaspect = ""; $videoframerate = ""; $videolibrary =	"";	 		$gendata = "";  $viddata = "";  $audiodata = "";
		$audioformat = ""; $audiomode =  ""; $audiobitratemode =  ""; $audiobitrate =  ""; $audiochannels =  ""; $audiosamplerate =  ""; $audiolibrary =  "";

		if (isset($arrXml["File"]) && isset($arrXml["File"]["track"]))
		{
			foreach ($arrXml["File"]["track"] as $track)
			{
				if (isset($track["@attributes"]) && isset($track["@attributes"]["type"]))
				{
					if ($track["@attributes"]["type"] == "General")
					{
						$gendata = $track;
					}
					elseif ($track["@attributes"]["type"] == "Video")
					{
						$viddata = $track;
					}
					elseif ($track["@attributes"]["type"] == "Audio")
					{
						$audiodata = $track;
					}
				}
			}
		}
		
		if ($gendata != "")
		{
			if (isset($gendata["Format"]))
				$containerformat = $gendata["Format"];
			if (isset($gendata["Overall_bit_rate"]))
				$overallbitrate = $gendata["Overall_bit_rate"];
		}

		if ($viddata != "")
		{
			if (isset($viddata["Duration"]))
				$videoduration = $viddata["Duration"];
			if (isset($viddata["Format"]))
				$videoformat = $viddata["Format"];
			if (isset($viddata["Codec_ID"]))
				$videocodec = $viddata["Codec_ID"];
			if (isset($viddata["Width"]))
				$videowidth = preg_replace("/[^0-9]/", '', $viddata["Width"]);
			if (isset($viddata["Height"]))
				$videoheight = preg_replace("/[^0-9]/", '', $viddata["Height"]);
			if (isset($viddata["Display_aspect_ratio"]))
				$videoaspect = $viddata["Display_aspect_ratio"];
			if (isset($viddata["Frame_rate"]))
				$videoframerate = str_replace(" fps", "", $viddata["Frame_rate"]);
			if (isset($viddata["Writing_library"]))
				$videolibrary = $viddata["Writing_library"];
		}

		if ($audiodata != "")
		{
			if (isset($audiodata["Format"]))
				$audioformat = $audiodata["Format"];
			if (isset($audiodata["Mode"]))
				$audiomode = $audiodata["Mode"];
			if (isset($audiodata["Bit_rate_mode"]))
				$audiobitratemode = $audiodata["Bit_rate_mode"];
			if (isset($audiodata["Bit_rate"]))
				$audiobitrate = $audiodata["Bit_rate"];
			if (isset($audiodata["Channel_s_"]))
				$audiochannels = $audiodata["Channel_s_"];
			if (isset($audiodata["Sampling_rate"]))
				$audiosamplerate = $audiodata["Sampling_rate"];
			if (isset($audiodata["Writing_library"]))
				$audiolibrary = $audiodata["Writing_library"];
		}

		if ($gendata != "")
		{
			$this->add($releaseID, $containerformat, $overallbitrate, $videoduration,
							$videoformat, $videocodec, $videowidth,	$videoheight,
							$videoaspect, $videoframerate, 	$videolibrary, $audioformat,
							$audiomode, $audiobitratemode, 	$audiobitrate, $audiochannels,
							$audiosamplerate, $audiolibrary);
		}				
	}
	
	public function add($releaseID, $containerformat, $overallbitrate, $videoduration,
						$videoformat, $videocodec, $videowidth,	$videoheight,
						$videoaspect, $videoframerate, 	$videolibrary, $audioformat,
						$audiomode, $audiobitratemode, 	$audiobitrate, $audiochannels,
						$audiosamplerate, $audiolibrary)
	{
		$db = new DB();
		$sql = sprintf("insert into releaseextra
						(releaseID,		containerformat, overallbitrate,		videoduration,
						videoformat,		videocodec, videowidth,		videoheight,
						videoaspect,		videoframerate, 	videolibrary,		audioformat,
						audiomode,		audiobitratemode, 	audiobitrate,		audiochannels,
						audiosamplerate,		audiolibrary)
						values
						( %d, %s, %s, %s, %s, %s, %d, %d, %s, %d, %s, %s, %s, %s, %s, %s, %s, %s )", 
							$releaseID, $db->escapeString($containerformat), $db->escapeString($overallbitrate),	$db->escapeString($videoduration),
							$db->escapeString($videoformat), $db->escapeString($videocodec), $videowidth,	$videoheight,
							$db->escapeString($videoaspect), $videoframerate, 	$db->escapeString($videolibrary), $db->escapeString($audioformat),
							$db->escapeString($audiomode), $db->escapeString($audiobitratemode), 	$db->escapeString($audiobitrate), $db->escapeString($audiochannels),
							$db->escapeString($audiosamplerate), $db->escapeString($audiolibrary));	
		return $db->queryInsert($sql);	
	}
	
	public function getFull($id)
	{
		$db = new DB();
		return $db->queryOneRow(sprintf("select * from releaseextrafull where releaseID = %d", $id));	
	}
	
	public function deleteFull($id)
	{
		$db = new DB();
		return $db->query(sprintf("delete from releaseextrafull where releaseID = %d", $id));	
	}
	
	public function addFull($id, $xml)
	{
		$db = new DB();
		return $db->queryInsert(sprintf("insert into releaseextrafull (releaseID, mediainfo) values (%d, %s)", $id, $db->escapeString($xml)));	
	}
}
?>
