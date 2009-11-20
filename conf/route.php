<?php
/*
 * Created on 2009/05/11
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

	$routes = array("foo"=>"bar");
	$routes["Default"] = "hello";
	$routes["/h"] = "hello/th";
	$routes["id"] = "data";
	$routes["login"] = "login";
	$routes["login/send"] = "login/send";
	
	$routes["id/:*"] = "data/user";
	$routes["id/:*/test"] = "data/user2";

	$routes[":*"] = "data/user";
?>
