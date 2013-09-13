<?php include "koneksi.php"; $host=HOST;
if(isset($_SESSION["user"])) :

function rightWidget(){
?>
	<div class="art-BlockHeader">
    	<div class="l"></div>
        <div class="r"></div>
        <div class="art-header-tag-icon">
           	<div class="t">Welcome</div>
	    </div>
    </div>
    <div class="art-BlockContent">
    	<div class="art-BlockContent-body">
            <div>Welcome <?php echo $_SESSION["user"]?></div>
            <div><a href="<?php echo $host ?>/koperasi/logout.php">Sign Out</a></div>
            <div class="cleared"></div>
       	</div>
	</div>
<?php
}

function getNasabahOfTheMonth(){
	$r=mysql_query("select max(total_simpanan), nama_anggota, username from anggota");
	$f=mysql_fetch_row($r);
	$data['saldo']=$f[0];
	$data['nama']=$f[1];
	$data['username']=$f['2'];
	return $data;
}

function nasabahOfTheMonth(){
	?>
	<div class="art-BlockHeader">
    	<div class="l"></div>
        <div class="r"></div>
        <div class="art-header-tag-icon">
           	<div class="t">Nasabah of the Month</div>
	    </div>
    </div>
    <div class="art-BlockContent">
    	<div class="art-BlockContent-body">
            <div><?php 
				$r=getNasabahOfTheMonth();
				echo $r['nama'];
			?></div>
            <div class="cleared"></div>
       	</div>
	</div>
    <?php
}

function getMonthSaldo($id){
	$m=date('m');
	$y=date('Y');
	$a=mysql_query("
		select sum(nominal_simpanan)
		from simpanan
		where date_format(TANGGAL_SIMPANAN,'%Y')='$y' AND date_format(TANGGAL_SIMPANAN,'%m')='$m' AND id_anggota='$id'
		");
	$d=mysql_fetch_row($a);
	return $d[0];
}

endif;

function endYear(){
	$m=date('m');
	$d=date('d');
	
	if($m=='01' && $d=='01'){
		$f=mysql_query("select id_anggota,total_simpanan from anggota");
		while($d=mysql_fetch_row($f)){
			$a=$d[1]*0.1;
			$a=$d[1]+$a;
			mysql_query("update anggota set total_simpanan='$a' where id_anggota='$d[0]'");
		}
	}
}
?>