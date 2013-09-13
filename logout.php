<?php
	include "koneksi.php";
	$host=HOST;
	unset($_SESSION["user"]);
	//session_destroy();
	header("location:$host");
?>