<?php
class UTIL
{
	function _GET($key, $def = null)
	{
		$val = "";
		if (!empty($_GET[$key]))
			$val = $_GET[$key];
		else
			$val = $def == null ? "" : $def;
			
		$val = htmlspecialchars($val);
		return $val;
	}
	
	function _POST($key, $def = null)
	{
		$val = "";
		if (!empty($_POST[$key]))
			$val =  $_POST[$key];
		else
			$val =  $def == null ? "" : $def;
			
		$val = htmlspecialchars($val);
		return $val;
	}
	
	function Parse($body, $vals)
	{
		if (is_array($vals))
		{
			for($i=0; $i<count($vals); $i++)
				$body = str_replace("{".$i."}", $vals[$i],$body);
		}
		else
		{
			$body = str_replace("{0}", $vals,$body);
		}
		
		return $body;
		
	}
	
	function IsContains($body, $vals)
	{
		if (is_array($vals))
		{
			for($i=0; $i<count($vals); $i++)
			{
				if(strpos($body, $vals[$i]))
					return true;
			}	
			
			return false;
		}
		else
		{
			if(strpos($body, $vals))
				return true;
				
			return false;
		}
	}
	
	function Redirect($url, $timeout=0)
	{
		//Direct Redirection
		$bOutLink = false;

		if ($this->IsContains($url, array("http://", "www")))
			$bOutLink = true;
		
		
		if (!$bOutLink)
			$url = "/planet/".$url;
		
		if ($timeout == 0)
		{
			header("location:".$url);
			exit;
		}
		else
		{
			header($this->Parse("REFRESH:{0};URL={1}", array($timeout, $url)));
			exit;
		}
	}
	
	function isLoaded($module)
	{
		
		foreach (get_included_files() as $file)
		{

			$pos = strpos($file, $module);
			if ($pos)
				return true;
				
		}
		
		return false;
	}
	
}
