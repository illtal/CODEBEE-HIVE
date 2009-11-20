<?php
/*
 * Created on 2009/05/12
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class ROUTE
{
	var $_BASEURL;
	var $_ROUTE;

	function ROUTE($baseurl)
	{
		$this->_BASEURL = $baseurl;
	}

	//get the Parmeter from PHP_SELF String
	//EX: /planet/foo => "foo"
	// /planet/ => "Default"
	function getParam($str)
	{
		$pos =strpos($str, $this->_BASEURL);

		if ($pos < 0)
			return null;

		$temp = explode($this->_BASEURL."index.php", $str);

		if (count($temp) == 2)
		{
			$p = $temp[1];

			//file check
			if (strpos(strtolower($p), ".") > -1)
				return null;

			if (strlen($p) == 0)
				return "Default";

			$p = substr($p, -1,1) == "/" ? substr($p, 0, -1):$p;
			
			return substr($p, 0, 1) == "/" ? substr($p, 1):$p;
		}

	}

	function getControllerInfo($param)
	{
		$info = null;
		if ($this->_ROUTE[$param])
		{
			$p = explode("/", $this->_ROUTE[$param]);

			$info["rawData"] = $this->_ROUTE[$param];
			$info["ControllerName"] = $p[0];
			$info["ControllerClassName"] = $p[0]."_Controller";

			if (count($p) == 2)
				$info["Controller_Func"] = $p[1];
			else
				$info["Controller_Func"] = "index";

			return $info;
		}
		
		foreach ($this->_ROUTE as $key=>$val)
		{
			//동적 루팅 값만 걸러내기
			if (strpos($key, ":") < 0)
				continue;
				
			$reg = str_replace("/", "\/+", $key);
			$reg = str_replace(":*", "([^\/]+)", $reg);
			
			
			$r = preg_match("/".$reg."/i", $param, $out);
			if ($r)
			{
				if ($param != $out[0])
					continue;

					
				$p = explode("/", $val);
				array_shift($out);
				
				$info["rawData"] = $val;
				$info["ControllerName"] = $p[0];
				$info["ControllerClassName"] = $p[0]."_Controller";
				$info["args"] = $out;
				
				if (count($p) == 2)
					$info["Controller_Func"] = $p[1];
				else
					$info["Controller_Func"] = "index";
				
				return $info;
			}
		}
		
		return null;
	}
	
}
?>
