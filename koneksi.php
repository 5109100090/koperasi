<?php
	define ("HOST","http://localhost/koperasi");
	
	$host="localhost";
	$username="root";
	$password="";
	$db="koperasi";
	
	mysql_connect($host,$username,$password) or die();
	mysql_select_db($db) or die();
	
	session_start();
?>