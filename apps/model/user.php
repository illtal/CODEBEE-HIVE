<?php
class USER_Model extends Model
{
	function __CONSTRUCT()
	{
		//
		;
	}
	
	function Login($userid, $passwd)
	{
		$row = $this->DB->select("uid, email, userid, nickname")->from("P_TB_USER_TAB")->where(array("userid"=>$userid, "passwd"=>$passwd))->fetchone();
		return $row;
	}
	
}
?>
