<?php
/*
 * Created on 2009/05/12
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class HELLO_Controller extends Controller
 {
 	function HELLO_Controller()
 	{
		;
 	}

 	function index()
 	{
 		$data = array();
 		$data["lblStr"] = "LABEL Variable";
 		
 		$data["arrVal"] = array("apple", "oragne", "banana");
 		$this->view($data);
 	}
 }
?>
