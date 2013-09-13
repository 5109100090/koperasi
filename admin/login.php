<?php
include "../koneksi.php";
if(trim($_POST['user'])!="")
	$user=$_POST['user'];
if(trim($_POST['pass'])!="")
	$pass=md5($_POST['pass']);
	
$host=HOST;

$q=mysql_query("select username,password,status_pegawai,id_pegawai from pegawai where username='$user' and password='$pass'");
$r=mysql_fetch_array($q, MYSQL_BOTH);
	if(mysql_num_rows($q)==1){
		$_SESSION["user"]=$user;
		$_SESSION["user_id"]=$r[3];
		if($r[2]=="2"){
			header("location:$host/admin");
		}else{
			header("location:$host/user");
		}
	}else{
		unset($_SESSION["user"]);
		header("location:$host");
	}
	
?>