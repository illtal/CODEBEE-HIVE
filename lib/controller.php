<?
class Controller extends UTIL
{	
	var $_CONTROLLER;
	var $_CONTROLLER_NAME;
	var $DB;
	var $SECURITY;

	function Controller($controller)
	{
		//echo ("Loaded");
	}

	function view($DATA=null)
	{
		if ($DATA)
		{
			foreach ($DATA as $key=>$val)
				$$key = $val;
		}
		loader ("./apps/view/".$this->_CONTROLLER_NAME.".html");
		return;
	}

	function _SET_CONTROLLER_NAME($NAME)
	{
		$this->_CONTROLLER_NAME = str_replace("_Controller", "",$NAME);
	}
	
	
	function DATABASE_LOAD()
	{
		@require ("./conf/conf.php");
		@include ("./lib/".DATABASE);
		
		$this->DB = new DATABASE($_DBHOST, $_DBUSER, $_DBPASSWD, $_DBNAME);
	}
	
	function SECURITY_LOAD()
	{
		@include ("./lib/".SECURITY);
		$this->SECURITY = new SECURITY();
	}
	
	function LoadModel($NAME, $bDBConnect=true)
	{
		loader("./apps/model/".$NAME.".php");
		$reflector = new ReflectionClass($NAME."_Model");
		$this->$NAME = $reflector->newInstance($bDBConnect);
		
		if($bDBConnect)
			$this->$NAME->DATABASE_LOAD();
			
		
		return; 
	}
	
	function LoadHelper($NAME)
	{
		loader("./helper/".$NAME.".php");
		
		$reflector = new ReflectionClass($NAME."_Helper");
		$this->$NAME = $reflector->newInstance();
		
		return;
	}
	
	function LoadLib($NAME)
	{
		loader("./conf/conf.php");
		loader("./lib/".DATABASE);
		
		$this->DB = new DATABASE($_DBHOST, $_DBUSER, $_DBPASSWD, $_DBNAME);
		//$this->DB = new DATABASE();
	}
}
?>