<?php

function adminLogin(){
	?>
                                        <div class="art-BlockHeader">
                                            <div class="l"></div>
                                            <div class="r"></div>
                                            <div class="art-header-tag-icon">
                                                <div class="t">Login</div>
                                            </div>
                                        </div><div class="art-BlockContent">
                                            <div class="art-BlockContent-body">
                                                <div><form method="post" id="login" action="http://localhost/koperasi/admin/login.php">
                                                Username <input type="text" value="" name="user" id="s" style="width: 95%;" />
                                                Password 
                                                <input type="password" value="" name="pass" id="s2" style="width: 95%;" />
<span class="art-button-wrapper">
                       	  <span class="l"> </span>
                   	    <span class="r"> </span></span>
                                               
                                        <input class="art-button" type="submit" name="search" value="Masuk" />
                                                </form></div>
                                        		<div class="cleared"></div>
                                            </div>
                                        </div>
    <?php
}

function monthName($m){
	if($m=='01')		$r="Januari";
	elseif($m=='02')	$r="Februari";
	elseif($m=='03')	$r="Maret";
	elseif($m=='04')	$r="April";
	elseif($m=='05')	$r="Mei";
	elseif($m=='06')	$r="Juni";
	elseif($m=='07')	$r="Juli";
	elseif($m=='08')	$r="Agustus";
	elseif($m=='09')	$r="September";
	elseif($m=='10')	$r="Oktober";
	elseif($m=='11')	$r="November";
	else 				$r="Desember";
	return $r;
}

function getsaldo($id){
	$t=mysql_query("select total_simpanan from anggota where id_anggota='$id'");
	$g=mysql_fetch_array($t);
	return $g[0];
}

function getHarga($id){
	$f=mysql_query("select harga_barang from barang where id_barang='$id'");
	$t=mysql_fetch_row($f);
	return $t[0];
}

function getStok($id){
	$d=mysql_query("select stok_barang from barang where id_barang='$id'");
	$l=mysql_fetch_row($d);
	return $l[0];
}

function dataTransaksi(){
	$op=$_POST['op'];
	$detail=$_GET['detail'];
	
	$month=$_POST['b'];
	$year=$_POST['t'];
	
	if(trim($month)=='')
		$month=date('m');
	if(trim($year)=='')
		$year=date('Y');
	?>
	<form method="post" name="form1" id="form1">
    <select name="op">
        <option value="simpanan" <?php if($op=="simpanan") echo "selected"; ?>>Simpanan</option>
        <option value="penarikan"<?php if($op=="penarikan") echo "selected"; ?>>Penarikan</option>
        <option value="kredit"<?php if($op=="kredit") echo "selected"; ?>>Kredit</option>
    </select>
    <select name="b">
	    <option value="01" <?php if($month=='01') echo 'selected'; ?>>01</option><option value="02" <?php if($month=='02') echo 'selected'; ?>>02</option>
        <option value="03" <?php if($month=='03') echo 'selected'; ?>>03</option><option value="04" <?php if($month=='04') echo 'selected'; ?>>04</option>
        <option value="05" <?php if($month=='05') echo 'selected'; ?>>05</option><option value="06" <?php if($month=='06') echo 'selected'; ?>>06</option>
        <option value="07" <?php if($month=='07') echo 'selected'; ?>>07</option><option value="08" <?php if($month=='08') echo 'selected'; ?>>08</option>
        <option value="09" <?php if($month=='09') echo 'selected'; ?>>09</option><option value="10" <?php if($month=='10') echo 'selected'; ?>>10</option>
        <option value="11" <?php if($month=='11') echo 'selected'; ?>>11</option><option value="12" <?php if($month=='12') echo 'selected'; ?>>12</option>
    </select>
    <select name="t">
    <?php
		for($i=2010; $i<=$year; $i++){
			if($i==$year) $s="selected";
    		echo "<option value='$i' $s>$i</option>";
		}
	?>
    </select>
    <input type="submit" name="submit" id="submit" value="Submit">
    </form>
    <?php
	$bulan=monthName($month);
	
	if($op=="kredit"){
		$a=mysql_query("
		select distinct s.id_catatan_detail, s.id_kredit, a.nama_anggota, s.nominal_cicilan, s.tanggal_pembayaran_cicilan, a.id_anggota
		from catatan_pembayaran_kredit s, anggota a, kredit k
		where s.id_kredit=k.id_kredit AND k.id_anggota=a.id_anggota AND date_format(s.tanggal_pembayaran_cicilan,'%m')='$month' AND date_format(tanggal_pembayaran_cicilan,'%Y')='$year'
		order by tanggal_pembayaran_cicilan desc
		");
		
		echo "<h2 align=center>Data Transaksi Pembayaran Kredit $bulan $year</h2>";
		echo "<table id=\"table\" align=center border=\"0\">";
		echo "<tr><td>ID</td>";
		echo "<td>ID kredit</td>";
		echo "<td>anggota</td>";
		echo "<td>tanggal</td>";
		echo "<td>debet</td>";
		echo "<td>detail</td></tr>";
		
		while($f=mysql_fetch_row($a)){
			echo "<tr><td>$f[0]</td>";
			echo "<td>$f[1]</td>";
			echo "<td>#$f[5] $f[2]</td>";
			echo "<td>$f[4]</td>";
			echo "<td>$f[3]</td>";
			echo "<td><a href='?page=datatransaksi&detail=$f[1]'>lihat</a></td>";
		}
		$a=mysql_query("select sum(nominal_cicilan) from catatan_pembayaran_kredit where date_format(tanggal_pembayaran_cicilan,'%m')='$month' AND date_format(tanggal_pembayaran_cicilan,'%Y')='$year'");
		$f=mysql_fetch_row($a);
		echo "<tr><td colspan='4'>total</td><td>Rp $f[0]</td><td></td></tr>";
		echo "</table>";

	}elseif($op=="penarikan"){
		$a=mysql_query("
		select s.id_penarikan, p.nama_pegawai, a.nama_anggota, s.nominal_penarikan, s.tanggal_penarikan, s.id_pegawai, s.id_anggota
		from penarikan s, anggota a, pegawai p
		where s.id_anggota=a.id_anggota AND s.id_pegawai=p.id_pegawai AND date_format(tanggal_penarikan,'%m')='$month' AND date_format(tanggal_penarikan,'%Y')='$year'
		order by tanggal_penarikan desc
		");
		
		echo "<h2 align=center>Data Transaksi Penarikan $bulan $year</h2>";
		echo "<table id=\"table\" align=center border=\"0\">";
		echo "<tr><td>ID penarikan</td>";
		echo "<td>Pegawai</td>";
		echo "<td>Anggota</td>";
		echo "<td>tanggal</td>";
		echo "<td>debet</td></tr>";
		
		while($f=mysql_fetch_row($a)){
			echo "<tr><td>$f[0]</td>";
			echo "<td>#$f[5] $f[1]</td>";
			echo "<td>#$f[6] $f[2]</td>";
			echo "<td>$f[4]</td>";
			echo "<td>Rp $f[3]</td>";
		}
		$a=mysql_query("select sum(nominal_penarikan) from penarikan where date_format(tanggal_penarikan,'%m')='$month' AND date_format(tanggal_penarikan,'%Y')='$year'");
		$f=mysql_fetch_row($a);
		echo "<tr><td colspan='4'>total</td><td>Rp $f[0]</td></tr>";
		echo "</table>";
	}elseif(isset($detail)){
		$a=mysql_query("
		select k.id_kredit, b1.nama_barang, b2.nama_barang, b3.nama_barang, a.nama_anggota, p.nama_pegawai, k.lama_cicilan, k.mulai_cicilan, k.total_kredit, k.sisa_kredit, k.kredit_per_bulan, k.id_anggota, k.id_anggota
		from kredit k, barang b1, barang b2, barang b3, anggota a, pegawai p
		where k.id_kredit='$detail' AND k.id_barang1=b1.id_barang AND k.id_barang2=b2.id_barang AND k.id_barang3=b3.id_barang AND k.id_anggota=a.id_anggota AND k.id_pegawai=p.id_pegawai"
		);
		$f=mysql_fetch_row($a);
		echo "<table id=\"table\" align=center border=\"0\">";
		echo "<tr><td>ID kredit</td> <td> : </td> <td>$f[0]</td></tr>";
		echo "<tr><td>Barang 1</td> <td> : </td> <td>$f[1]</td></tr>";
		echo "<tr><td>Barang 2</td> <td> : </td> <td>$f[2]</td></tr>";
		echo "<tr><td>Barang 3</td> <td> : </td> <td>$f[3]</td></tr>";
		echo "<tr><td>Anggota</td> <td> : </td> <td>#$f[11] $f[4]</td></tr>";
		echo "<tr><td>Pegawai</td> <td> : </td> <td>#$f[12] $f[5]</td></tr>";
		echo "<tr><td>lama cicilan</td> <td> : </td> <td>$f[6] kali</td></tr>";
		echo "<tr><td>mulai cicilan</td> <td> : </td> <td>$f[7]</td></tr>";
		echo "<tr><td>total kredit</td> <td> : </td> <td>Rp $f[8]</td></tr>";
		echo "<tr><td>sisa kredit</td> <td> : </td> <td>Rp $f[9]</td></tr>";
		echo "<tr><td>kredit per bulan</td> <td> : </td> <td>Rp $f[10]</td></tr>";
		echo "</table>";
	}else{
		$a=mysql_query("
		select s.id_simpanan, a.nama_anggota, p.nama_pegawai, s.nominal_simpanan, s.tanggal_simpanan, s.id_anggota, s.id_pegawai
		from simpanan s, anggota a, pegawai p
		where s.id_anggota=a.id_anggota AND s.id_pegawai=p.id_pegawai AND date_format(tanggal_simpanan,'%m')='$month' AND date_format(tanggal_simpanan,'%Y')='$year'
		order by tanggal_simpanan desc
		");
		
		echo "<h2 align=center>Data Transaksi Simpanan $bulan $year</h2>";
		echo "<table id=\"table\" align=center border=\"0\">";
		echo "<tr><td>ID simpanan</td>";
		echo "<td>Anggota</td>";
		echo "<td>Pegawai</td>";
		echo "<td>tanggal</td>";
		echo "<td>debet</td>";
		
		while($f=mysql_fetch_row($a)){
			echo "<tr><td>$f[0]</td>";
			echo "<td>#$f[5] $f[1]</td>";
			echo "<td>#$f[6] $f[2]</td>";
			echo "<td>$f[4]</td>";
			echo "<td>Rp $f[3]</td></tr>";
		}
		$a=mysql_query("select sum(nominal_simpanan) from simpanan where date_format(tanggal_simpanan,'%m')='$month' AND date_format(tanggal_simpanan,'%Y')='$year'");
		$f=mysql_fetch_row($a);
		echo "<tr><td colspan='4'>total</td><td>Rp $f[0]</td></tr>";
		echo "</table>";
	}
}

function tambahPembayaranKredit(){
	$show=0;
    if(isset($_POST['submit'])){
		$id_anggota=$_POST['idanggota'];
		$show=1;
	}
	
	if(isset($_POST['submit2'])){
		$id_anggota=$_POST['idanggota'];
		$id_kredit=$_POST['id_kredit'];
		$nominal=$_POST['saldo'];
		
		$t=mysql_query("select kredit_per_bulan,sisa_kredit from kredit where id_kredit='$id_kredit'");
		$g=mysql_fetch_row($t);
		$per_bulan=$g[0];
		$sisa_kredit=$g[1];
		
		if($nominal < $per_bulan){
			echo "<div id='messageError'>cicilan kurang dari cicilan per bulan anda sebesar $per_bulan!</div>";
		}else{
			$b=$sisa_kredit-$per_bulan;
			$saldobaru=getsaldo($id_anggota)+($nominal-$per_bulan);
			if( $b < 0 ){
				$b=0;
				mysql_query("update angogta set STATUS_LIST_CICILAN_ANGGOTA='0' where id_anggota='$id_anggota'");
				echo "<div id='messageOke'>selamat!<br>kredit dengan id $id_kredit sudah lunas</div>";
			}
			$c=mysql_query("update kredit set sisa_kredit='$b' where id_kredit='$id_kredit'");
			$v=mysql_query("update anggota set total_simpanan='$saldobaru' where id_anggota='$id_anggota'");
			$g=mysql_query("insert into catatan_pembayaran_kredit values ('','$id_kredit','$nominal',now())");
			if($c && $v && $g)
				echo "<div id='messageOke'>transaksi berhasil di proses</div>";
		}
	}
	
	if($show==0){
	?>
	<form name="daftar" method="post">
		<table id=\"table\" border="0" cellpadding="2" >
        	<tr>
            <td style="width: 117px">Nama Nasabah</td>
            <td width="337"><select id="idanggota" name="idanggota">
            <?php
            $q=mysql_query("select id_anggota,nama_anggota from anggota where STATUS_LIST_CICILAN_ANGGOTA='1'");
			while($f=mysql_fetch_array($q)){
				echo "<option value='$f[0]'>#$f[0] $f[1]</option>";
			}
			?>
            </select></td>
            </tr>
		</table>
        <left><input type="submit" name="submit" id="submit" value="Show Credit"></left>                      	
	</form>
<?php
	}else{
		?>
	<form name="daftar" method="post">
    	<table id=\"table\" border="0" cellpadding="2" >
            <tr>
            <td style="width: 117px">Kredit</td>
            <td width="337"><select id="id_kredit" name="id_kredit">
            <?php
            $q=mysql_query("
            select k.id_kredit, b1.nama_barang, b2.nama_barang, b3.nama_barang
            from kredit k, barang b1, barang b2, barang b3
            where id_anggota='$id_anggota' AND k.id_barang1=b1.id_barang AND k.id_barang2=b2.id_barang AND k.id_barang3=b3.id_barang AND k.sisa_kredit > 0");
            while($f=mysql_fetch_array($q)){
                echo "<option value='$f[0]'>$f[0] [$f[1] - $f[2] - $f[3]]</option>";
            }
            ?>
            </select></td>
            </tr>
            <tr>
            <td>nominal cicilan</td>
            <td><input type="text" name="saldo" width="100"></td>
            </tr>
        </table>
        <left>
        <input type="hidden" name="idanggota" value="<?php echo $id_anggota; ?>" />
        <input type="submit" name="submit2" id="submit2" value="Submit"></left>                      	
	</form>
    <?php
	}
}

function tambahKredit(){
		$id_anggota=$_POST['idanggota'];
		$brg1=$_POST['brg1'];
		$brg2=$_POST['brg2'];
		$brg3=$_POST['brg3'];
		$jml_brg1=$_POST['jml_brg1'];
		$jml_brg2=$_POST['jml_brg2'];
		$jml_brg3=$_POST['jml_brg3'];
		$lama_cicilan=$_POST['lama_cicilan'];
		
		if(isset($_POST["submit"])){
			$saldo=getSaldo($id_anggota);
		
		if(trim($brg1)=="")
			$brg1=0;
		if(trim($brg2)=="")
			$brg2=0;
		if(trim($brg3)=="")
			$brg3=0;
			
		$ttl1=0; $ttl2=0; $ttl3=0;
		if(trim($brg1)!="" && trim($jml_brg1)!="")
			$ttl1=getHarga($brg1)*$jml_brg1;
		if(trim($brg2)!="" && trim($jml_brg2)!="")
			$ttl2=getHarga($brg2)*$jml_brg2;
		if(trim($brg3)!="" && trim($jml_brg3)!="")
			$ttl3=getHarga($brg3)*$jml_brg3;
		
		$total=$ttl1+$ttl2+$ttl3;
		
		$z=mysql_query("select STATUS_LIST_CICILAN_ANGGOTA from anggota where id_anggota='$id_anggota'");
		$l=mysql_fetch_row($z);
		$STATUS_LIST_CICILAN_ANGGOTA=$l[0];
		
		if($STATUS_LIST_CICILAN_ANGGOTA == 0) :
			$stokbaru1=getStok($brg1)-$jml_brg1;
			$stokbaru2=getStok($brg2)-$jml_brg2;
			$stokbaru3=getStok($brg3)-$jml_brg3;
			
			if($lama_cicilan==0){
				//tunai
				if($total>$saldo){
					echo "<div id='messageError'>saldo anda tidak mencukupi untuk melakukan proses kredit!</div>";
				}else{
					$r=mysql_query("insert into kredit values ('', '$brg1', '$brg2', '$brg3', '$id_anggota', '$_SESSION[user_id]','$lama_cicilan', now(),'$total','0','0')");
					$saldobaru=$saldo-$total;
					$g=mysql_query("update anggota set total_simpanan='$saldobaru' where id_anggota='$id_anggota'");
					if($r && $g)
						echo "<div id='messageOk'>transaksi tunai berhasil di proses</div>";
				}
			}else{	
			$v=$total*0.4;
				if($saldo >= $v){
					$ttl_kredit=($total*1.1)-$v;
					$per_bulan=$ttl_kredit/$lama_cicilan;
					$r=mysql_query("insert into kredit values ('', '$brg1', '$brg2', '$brg3', '$id_anggota', '$_SESSION[user_id]','$lama_cicilan', now(),'$ttl_kredit','$ttl_kredit','$per_bulan')");
					$saldobaru=$saldo-$v;
					$g=mysql_query("update anggota set total_simpanan='$saldobaru' where id_anggota='$id_anggota'");
					$c=mysql_query("update anggota set STATUS_LIST_CICILAN_ANGGOTA='1' where id_anggota='$id_anggota'");
					if($r && $g && $c)
						echo "<div id='messageOk'>transaksi kredit berhasil di proses</div><p>
						<div id='messageOk'>#$id_anggota<br>total kredit : Rp $ttl_kredit<br>kredit per bulan : $per_bulan</div>
						";
				}else{
					echo "<div id='messageError'>saldo anda tidak mencukupi untuk melakukan proses kredit!</div>";
				}
			}
			$a1=mysql_query("update barang set stok_barang='$stokbaru1' where id_barang='$brg1'");
			$a2=mysql_query("update barang set stok_barang='$stokbaru2' where id_barang='$brg2'");
			$a3=mysql_query("update barang set stok_barang='$stokbaru3' where id_barang='$brg3'");
			else :
				echo "<div id='messageError'>anda tidak dapat melakukan transaksi kredit!<br>silahkan melunasi kredit anda terlebih dahulu</div>";
		endif;
		}
			
	?>
<form name="daftar" method="post">
                                               
                                     <table id=\"table\" border="0" cellpadding="2" >
                                    
                                     <tr>
                                     <td style="width: 117px">Nama Nasabah</td>
                                     <td width="337"><select id="idanggota" name="idanggota">
                                         <?php
                                         $q=mysql_query("select id_anggota,nama_anggota from anggota");
										 while($f=mysql_fetch_array($q)){
											 echo "<option value='$f[0]'>$f[0]-$f[1]</option>";
										 }
										 ?>
                                         </select></td>
                                     </tr>
                                     <tr>
                                     <td style="width: 117px">Barang</td>
                                     <td width="337"><select id="brg1" name="brg1">
	                                     <option value="">-pilih barang-</option>
                                         <?php
                                         $q=mysql_query("select id_barang,nama_barang,stok_barang from barang");
										 while($f=mysql_fetch_array($q)){
											 echo "<option value='$f[0]'>$f[0]-$f[1] ($f[2])</option>";
										 }
										 ?>
                                         </select>
                                         <input type="text" name="jml_brg1" size="3">
                                         </td>
                                     </tr>
                                     
                                     
                                     <tr>
                                     <td style="width: 117px">Barang</td>
                                     <td width="337"><select id="brg2" name="brg2">
                                     <option value="">-pilih barang-</option>
                                         <?php
                                         $q=mysql_query("select id_barang,nama_barang,stok_barang from barang");
										 while($f=mysql_fetch_array($q)){
											 echo "<option value='$f[0]'>$f[0]-$f[1] ($f[2])</option>";
										 }
										 ?>
                                         </select>
                                         <input type="text" name="jml_brg2" size="3">
                                         </td>
                                     </tr>
                                     
                                     <tr>
                                     <td style="width: 117px">Barang</td>
                                     <td width="337"><select id="brg3" name="brg3">
                                     <option value="">-pilih barang-</option>
                                         <?php
                                         $q=mysql_query("select id_barang,nama_barang,stok_barang from barang");
										 while($f=mysql_fetch_array($q)){
											 echo "<option value='$f[0]'>$f[0]-$f[1] ($f[2])</option>";
										 }
										 ?>
                                         </select>
                                         <input type="text" name="jml_brg3" size="3">
                                         </td>
                                     </tr>
                                     
                                     <tr>
                                     <td>Lama cicilan</td>
                                     <td><select id="lama_cicilan" name="lama_cicilan">
                                     <?php
                                     for($i=0; $i<=10; $i++){
										 if($i==0)
										 echo "<option value='0'>tunai</option>";
										 else
										 echo "<option value='$i'>$i kali</option>";
									 }
									 ?>
                                     </td>
                                     </tr>
                                     </table>
                                     <br>  
                                     <left><input type="submit" name="submit" id="submit" value="Submit"></left>                     	
</form>
<?php
}

function tambahBarang(){
	$barang=$_POST['nama_barang'];
	$harga=$_POST['harga'];
	$stock=$_POST['stock'];
	$id_barang=$_POST['list_barang'];
	$stok_baru=$_POST['stok_baru'];
	$harga_baru=$_POST['harga_baru'];
	
    if(isset($_POST['submit'])){
		$q=mysql_query("insert into barang values ('', '$barang','$harga','$stock')");
	}elseif(isset($_POST['update'])){
		$q=mysql_query("update barang set stok_barang='$stok_baru' where id_barang='$id_barang'");
	}elseif(isset($_POST['delete'])){
		$q=mysql_query("delete from barang where id_barang='$id_barang'");
	}
	
	if($q) echo "<div id='messageOk'>data barang berhasil di proses</div>";
	?>
                                            <form name="daftar" method="post">
                                     <fieldset><legend>Tambah Barang</legend>
                                     <table id=\"table\" border="0" cellpadding="2" >
                                    
                                     <tr>
                                     <td style="width: 117px">Nama Barang</td>
                                     <td width="337"><input type="text" name="nama_barang" width="300"></td>
                                     </tr>
                                     
                                     <tr>
                                     <td style="width: 117px">Harga</td>
                                     <td><input type="text" name="harga" id="harga" size="3"></td>
                                     </tr>
                                    
                                    <tr>
                                     <td style="width: 117px">Stock</td>
                                     <td><input type="text" name="stock" id="stock" size="3"></td>
                                     </tr>
                                     </table>              <br>  
                                     <left><input type="submit" name="submit" id="submit" value="Submit"></left>                      	
                                     </fieldset>
                                     <p>
                                     <fieldset><legend>Manajemen Barang</legend>
                                     Current Item : 
                                     <select name="list_barang">
                                     <?php
									 $a=mysql_query("select id_barang,nama_barang,stok_barang,harga_barang from barang");
									 while($c=mysql_fetch_row($a))
	                                     echo "<option value='$c[0]'>$c[1] ($c[2]) (Rp $c[3])</option>";
									 ?>
                                     </select>
                                     stok : <input name="stok_baru" type="text" size="3">
                                     Rp <input name="harga_baru" type="text" size="3">
                                     <p>
                                     <input type="submit" name="update" value="Update Barang"> <input type="submit" name="delete" value="Hapus Barang">
</form>
	<?php
}


function tambahNasabah(){
	$nama=$_POST['nama_lengkap'];
	$alamat=$_POST['alamat'];
	$telepon=$_POST['telepon'];
	$saldo=$_POST['saldo'];
	$username=$_POST['username'];
	$pass=$_POST['password'];
	$pass=md5($pass);
	if(isset($_POST['daftar'])){
		if(mysql_query("insert into anggota values ('','$nama','$alamat','$telepon','0','$saldo','$username','$pass')"))
			echo "<div id='messageOk'>nasabah berhasil ditambahkan</div>";
	}
	?>
                                            <form name="daftar" method="post">
                                               
                                     <table id=\"table\" border="0" cellpadding="2" >
                                    
                                     <tr>
                                     <td style="width: 117px">Nama Lengkap</td>
                                     <td width="337"><input type="text" name="nama_lengkap" width="300"></td>
                                     </tr>
                                     
                                     <tr>
                                     <td style="width: 117px">Alamat</td>
                                     <td><input type="text" name="alamat" id="alamat"></td>
                                     </tr>
                                    
                                    <tr>
                                     <td style="width: 117px">Telepon</td>
                                     <td><input type="text" name="telepon" id="telepon"></td>
                                     </tr>
                                      
                                      <tr>
                                     <td style="width: 117px">Saldo</td>
                                     <td><input type="text" name="saldo"></td>
                                     </tr>
                                      <tr>
                                     <td style="width: 117px">username</td>
                                     <td><input type="text" name="username"></td>
                                     </tr>
                                      <tr>
                                     <td style="width: 117px">password</td>
                                     <td><input type="text" name="password"></td>
                                     </tr>
  
                                     </table>              <br>  
                                     
                                     <left><input type="submit" name="daftar" id="daftar" value="Daftar"></left>                      	
                                              
                                            	</form>
	<?php
}

function tambahSimpanan(){
		$saldo=$_POST["saldo"];
		$id_anggota=$_POST['idanggota'];
		$jenis_transaksi=$_POST['jenis_transaksi'];
		
		if(isset($_POST["submit"])){
			$saldolama=getSaldo($id_anggota);
			if($jenis_transaksi=="tambah"){
				$newsaldo=$saldo+$saldolama;
				$w=mysql_query("update anggota set total_simpanan='$newsaldo' where id_anggota='$id_anggota'");
				$e=mysql_query("insert into simpanan values ('','$id_anggota', '$_SESSION[user_id]', '$saldo', now())");

			}else{
				$saldolama=getSaldo($id_anggota);
				if($saldolama>=$saldo){
					$newsaldo=$saldolama-$saldo;
					$w=mysql_query("update anggota set total_simpanan='$newsaldo' where id_anggota='$id_anggota'");
					$e=mysql_query("insert into penarikan values ('', '$_SESSION[user_id]', '$id_anggota', '$saldo', now())");
				}else{
					echo "<div id='messageError'>saldo anda tidak mencukupi untuk melakukan penarikan!</div>";
				}
			}
			if($w && $e && $saldo>0) echo "<div id='messageOk'>data transaksi berhasil di proses</div>";
			else echo "<div id='messageError'>transaksi gagal!<br>cek inputan anda kembali</div>";
	}
	?>
<form name="daftar" method="post">
                                               
                                     <table id=\"table\" border="0" cellpadding="2" >
                                    
                                     <tr>
                                     <td style="width: 117px">Nama Nasabah</td>
                                     <td width="337"><select id="idanggota" name="idanggota">
                                         <?php
                                         $q=mysql_query("select id_anggota,nama_anggota,total_simpanan from anggota");
										 while($f=mysql_fetch_array($q)){
											 echo "<option value='$f[0]'>$f[0]-$f[1] (Rp $f[2])</option>";
										 }
										 ?>
                                         </select></td>
                                     </tr>
                                     <tr>
                                     <td>Jenis transaksi</td>
                                     <td><select id="jenis_transaksi" name="jenis_transaksi">
                                     <option value="tambah">Simpanan</option>
                                     <option value="ambil">Penarikan</option>
                                     </td>
                                     </tr>
                                     <tr>
                                     <td style="width: 117px">Saldo</td>
                                     <td><input type="text" name="saldo" id="saldo"></td>
                                     </tr>
                                     </table>
                                     <br>  
                                     <left><input type="submit" name="submit" id="submit" value="Submit"></left>                     	
</form>
<?php
}


?>