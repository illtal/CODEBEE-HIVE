<?php
class Model extends UTIL
{
	var $DB;
	
	
	function DATABASE_LOAD()
	{
		//loader ("./conf/conf.php");
		
		if (!$this->isLoaded("./lib/".DATABASE))
			loader ("./lib/".DATABASE);
			
		$this->DB = new DATABASE(DBHOST, DBUSER, DBPASSWD, DBNAME);
	}
	
}
?>