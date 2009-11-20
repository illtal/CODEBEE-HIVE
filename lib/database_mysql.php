<?php
class DATABASE
{
	var $Conn;
	var $SQLCOMMAND;
	
	function __construct($_DBHOST, $_DBUSER, $_DBPASSWD, $_DBNAME)
	{
		$this->Conn = mysql_connect($_DBHOST, $_DBUSER,$_DBPASSWD);
		if (!$this->Conn)
		{
			return false;
		}
				
		$db_selected = mysql_select_db($_DBNAME, $this->Conn);

		if (!$db_selected)
			return false;

	
		return true;
	}
	
	function IsConneted()
	{
		return $this->Conn ? true : false;
	}
	
	function Close()
	{
		mysql_close($this->Conn);
	}
	
	function executeNonQuery($sQuery)
	{
		if (!$this->IsConneted())
			return false;
			
		$result = mysql_query($sQuery, $this->Conn);
		
		return $result ? true : false;
	}
	
	function executeReader($sQuery)
	{
		if (!$this->IsConneted())
			return false;
			
		$result = mysql_query($sQuery, $this->Conn);
		
		if (!$result)
			return false;

		$arr = array();
		
		while ($row = mysql_fetch_array($result))
			$arr[] = $row;
			
		mysql_free_result($result);
			
		return $arr;
	}
	
	function excuteReaderSet($sQuery)
	{
		;
	}
	
	function executeReaderOneRow($sQuery)
	{
		if (!$this->IsConneted())
			return null;

		$result = mysql_query($sQuery, $this->Conn);
		
		if (!$result)
			return null;
			
		$row = mysql_fetch_array($result);			
		mysql_free_result($result);
			
		return $row;
	}
	
	function select($str)
	{
		$this->SQLCOMMAND = "select ".$str;
		return $this;
	}
	
	function from($str)
	{
		$this->SQLCOMMAND .= " from ".$str;
		return $this;
	}
	
	function where($vals)
	{
		$this->SQLCOMMAND .=" where ";
		
		if (is_array($vals))
		{
			foreach ($vals as $key=>$val)
				$this->SQLCOMMAND .= sprintf(" %s='%s' and",$key, $val);
				
			$this->SQLCOMMAND = substr($this->SQLCOMMAND, 0, -3);
		}
		else
			$this->SQLCOMMAND .= $vals;
		return $this;
	}
	
	function limit($start, $end =null)
	{
		$this->SQLCOMMAND .=" limit ". $start;

		if ($end)
			$this->SQLCOMMAND .= ", ". $end;
			
			return $this;
	}
	
	function ToString()
	{
		return $this->SQLCOMMAND;
	}
	
	function fetchall($str)
	{
		return $this->executeReader($str);	
	}
	
	function fetchone($sQuery=null)
	{
		$str = $sQuery == null ? $this->SQLCOMMAND : $sQuery;
		
		return $this->executeReaderOneRow($str);
	}
	
}

class SqlCommand extends DATABASE
{
	var $selectQuery;
	var $args;
	
	function SqlCommand($sQuery = null)
	{
		$this->selectQuery = $sQuery;
	}	

	function add($key, $val)
	{
		if (!array_key_exists($key, $this->args))
			$this->args[$key] = $val;
		else
			return 0;
			
	}
	
	function remove($key)
	{
		if (!array_key_exists($key, $this->args))
			$this->args[$key] = null;
		else
			return 0;
	}
	
	function execute()
	{
		$this->_Parse();
		$this->executeNonQuery($this->selectQuery);
	}	
	
	private function _Parse()
	{
		foreach ($this->args as $key=>$val)
		{
			$this->selectQuery = str_replace($this->selectQuery, "@".$key, $val);
		
		}
	} 
}

?>