<?php
class SECURITY
{
	function __construct()
	{
		session_start();
	}
	
	function encrypt($str)
	{
		@require ("./conf/conf.php");
		
		$key = "";
		$encType = "MD5";
		
		/*
		switch ($encType)
		{
			"MD5":
				$key = md5($str.$_CRYPTKEY);
				break;
			default:
				$key = md5($str.$_CRYPTKEY);
		}
		*/
		$key = md5($str.$_CRYPTKEY);
		return $key;
	}
	
	function SESSION($key, $val=null)
	{
		if ($val === null)
		{
			//echo $_SESSION[$key] == null ? "false" : $_SESSION[$key];
			return $_SESSION[$key] == null ? false : $_SESSION[$key]; 
		}
	
		$sVal = is_array($val) ? serialize($val) : $val;
		$_SESSION[$key] = $sVal;
	}
}

?>