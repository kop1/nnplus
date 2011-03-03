<?php
require_once(WWW_DIR."/lib/framework/db.php");

class UserSeries
{	
	public function getByUser($userid)
	{			
		$db = new DB();
		return $db->query(sprintf("select * from userseries where userid = %d", $userid));		
	}	

	public function add($userid, $rageid)
	{			
		$db = new DB();
		return $db->query(sprintf("insert into userseries (userID, rageID, createddate) values (%d, %d, now())", $userid, $rageid));		
	}	

	public function del($id)
	{			
		$db = new DB();
		$db->query(sprintf("delete from userseries where ID = %d", $id));		
	}	

	public function delByUser($userid)
	{			
		$db = new DB();
		$db->query(sprintf("delete from userseries where userID = %d", $userid));		
	}	

}
?>
