<?php
/*
 * Created on 2009/05/15
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class DISPLAY
{
	var $_CONTROLLER;
	var $_CONTROLLER_NAME;

	function DISPLAY($controller)
	{
		require("./apps/controller/".$controller.".php");

		$class = $controller . "_Controller";
		$this->_CONTROLLER = new $class();
		$this->_CONTROLLER_NAME = $controller;
	}

	function view($TEMPLATE_NAME = null)
	{
		$file = $TEMPLATE_NAME == null ? $this->_CONTROLLER_NAME : $TEMPLATE_NAME;
		
		//템플릿 파일 체크 
		
		@include ("./apps/view/".$file.".html");
		return;
	}
}
?>
