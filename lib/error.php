<?php
/*
 * Created on 2009/05/11
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class ERROR
 {
 	var $_DEBUG;

 	function ERROR($debug=false)
 	{
 		if ($debug)
 			$this->_DEBUG = true;
 		else
 			$this->_DEBUG = false;
 	}

	function display($message)
	{
		//echo "TEST";
		$time = date(r);
		include("./template/error.html");
		//echo $message;
		exit;
	}
 }
?>
