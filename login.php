<?php
include "koneksi.php";
if(trim($_POST['user'])!="")
	$user=$_POST['user'];
if(trim($_POST['pass'])!="")
	$pass=md5($_POST['pass']);
	
$host=HOST;

$q=mysql_query("select username,password,id_anggota,nama_anggota from anggota where username='$user' and password='$pass'");
$r=mysql_fetch_array($q, MYSQL_BOTH);
	if(mysql_num_rows($q)==1){
		$_SESSION["user"]=$r[3];
		$_SESSION["user_id"]=$r[2];
		$_SESSION["username"]=$r[0];
		header("location:$host/user");
	}else{
		unset($_SESSION["user"]);
		unset($_SESSION["user_id"]);
		unset($_SESSION["username"]);
		header("location:$host");
	}
	
?>