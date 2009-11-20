<?php
/*
 * Created on 2009/05/11
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 	require ("./conf/route.php");
 	require ("./conf/conf.php");
 	require ("./lib/util.php");
 	require ("./lib/error.php");
 	require ("./lib/route.php");
 	require ("./lib/display.php");
 	require ("./lib/controller.php");
 	require ("./lib/model.php");
 	require ("./lib/loader.php");
 	
 	
 	define ("DATABASE", "database_mysql.php");
	define ("UTIL", "util.php");
	define ("SECURITY", "security.php");
 	

	$error = new ERROR(false);
	$route = new ROUTE($_BASEURL);
	$route->_ROUTE = $routes;

	//Not Found Route LIST 
	//설정된 라우팅 리스트가 존재하지 않을경우 
 	if (count($routes) == 0)
 		$error->display("ROUTE LIST not found!");

	$p = $route->getParam($_SERVER["PHP_SELF"]);

	//해당하는 컨트롤러가 존재하지 않을경우
	if (!$p)
		$error->display("Controller is Not Found!");

	$info = $route->getControllerInfo($p);
	
	//컨트롤러 클래스를 불러온다.
	@require("./apps/controller/".$info["ControllerName"].".php");
	
	$reflector = new ReflectionClass($info["ControllerClassName"]);
	$c = $reflector->newInstance();
	$c->_SET_CONTROLLER_NAME($info["ControllerName"]);

	//$c->$info["Controller_Func"]($info["args"]);

	call_user_func_array(array($c, $info["Controller_Func"]), $info["args"]);

	//$display = new DISPLAY($c);

	//$display->view();

?>
