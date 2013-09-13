<?php include "../koneksi.php"; $host=HOST; ?>
<?php if(isset($_SESSION["user"])) : ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <!--
    Created by Artisteer v2.3.0.23023
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>Bank Nusantara</title>

    <script type="text/javascript" src="../script.js"></script>

    <link rel="stylesheet" href="../style.css" type="text/css" media="screen" />
</head>
<body>
<div id="art-page-background-simple-gradient">
    </div>
    <div id="art-main">
        <div class="art-Sheet">
            <div class="art-Sheet-tl"></div>
            <div class="art-Sheet-tr"></div>
            <div class="art-Sheet-bl"></div>
            <div class="art-Sheet-br"></div>
            <div class="art-Sheet-tc"></div>
            <div class="art-Sheet-bc"></div>
            <div class="art-Sheet-cl"></div>
            <div class="art-Sheet-cr"></div>
            <div class="art-Sheet-cc"></div>
            <div class="art-Sheet-body">
              <div class="art-Header">
                <div class="art-Header-jpeg"></div>
                </div>
                <div class="art-nav">
               	  <div class="l"></div>
                	<div class="r"></div>
                	<ul class="art-menu">
                		<li>
               			  <a href="index.php" "><span class="l"></span><span class="r"></span><span class="t">Home</span></a>
               		  </li>
                		<li>
                			<a href="tampil_simpanan.php" "><span class="l"></span><span class="r"></span><span class="t">Lihat Data Transaksi</span></a>
                        </li>
                        		
                		<li>
                			<a href="tampil_kredit.php" " class=" active"><span class="l"></span><span class="r"></span><span class="t">Lihat Data Kredit</span></a>
                		</li>                		
               	  </ul>
                	 <!--header Atas-->                
           	  </div>
                <?php 
		include "../koneksi.php";
		$detail=$_GET['detail'];
		
		if(trim($detail)=="") :
		$a=mysql_query("
		select distinct s.id_catatan_detail, s.id_kredit, s.nominal_cicilan, s.tanggal_pembayaran_cicilan
		from catatan_pembayaran_kredit s, kredit k
		where s.id_kredit=k.id_kredit AND k.id_anggota='$_SESSION[user_id]'
		order by s.tanggal_pembayaran_cicilan desc
		");
		
		echo "<h2 align=center>Data Transaksi Pembayaran Kredit</h2>";
		echo "<table id=\"table\" align=center border=\"0\">";
		echo "<tr><td>ID</td>";
		echo "<td>ID kredit</td>";
		echo "<td>tanggal</td>";
		echo "<td>debet</td>";
		echo "<td>detail</td></tr>";
		
		while($f=mysql_fetch_row($a)){
			echo "<tr><td>$f[0]</td>";
			echo "<td>$f[1]</td>";
			echo "<td>$f[3]</td>";
			echo "<td>Rp $f[2]</td>";
			echo "<td><a href='?detail=$f[1]'>lihat</a></td></tr>";
		}
		$a=mysql_query("select sum(s.nominal_cicilan) from catatan_pembayaran_kredit s, kredit k where k.id_anggota='$_SESSION[user_id]'");
		$f=mysql_fetch_row($a);
		echo "<tr><td colspan='3'>total</td><td>Rp $f[0]</td><td></td></tr>";
		echo "</table>";
		
		echo "<a href=\"index.php\">Back</a>";
		else :
			echo "<h2 align=center>Detail Transaksi Pembayaran Kredit</h2>";
			$a=mysql_query("
			select k.id_kredit, b1.nama_barang, b2.nama_barang, b3.nama_barang, a.nama_anggota, k.lama_cicilan, k.mulai_cicilan, k.total_kredit, k.sisa_kredit, k.kredit_per_bulan, k.id_anggota
			from kredit k, barang b1, barang b2, barang b3, anggota a
			where k.id_kredit='$detail' AND k.id_barang1=b1.id_barang AND k.id_barang2=b2.id_barang AND k.id_barang3=b3.id_barang AND k.id_anggota='$_SESSION[user_id]'
			");
			
			$f=mysql_fetch_row($a);
			echo "<table id=\"table\" align=center border=\"0\">";
			echo "<tr><td>ID kredit</td> <td> : </td> <td>$f[0]</td></tr>";
			echo "<tr><td>Barang 1</td> <td> : </td> <td>$f[1]</td></tr>";
			echo "<tr><td>Barang 2</td> <td> : </td> <td>$f[2]</td></tr>";
			echo "<tr><td>Barang 3</td> <td> : </td> <td>$f[3]</td></tr>";
			echo "<tr><td>Anggota</td> <td> : </td> <td>#$f[10] $f[4]</td></tr>";
			echo "<tr><td>lama cicilan</td> <td> : </td> <td>$f[5] kali</td></tr>";
			echo "<tr><td>mulai cicilan</td> <td> : </td> <td>$f[6]</td></tr>";
			echo "<tr><td>total kredit</td> <td> : </td> <td>Rp $f[7]</td></tr>";
			echo "<tr><td>sisa kredit</td> <td> : </td> <td>Rp $f[8]</td></tr>";
			echo "<tr><td>kredit per bulan</td> <td> : </td> <td>Rp $f[9]</td></tr>";
			echo "</table>";
		echo "<a href='?'>Back</a>";
		endif;
?>                <div class="cleared"></div><div class="art-Footer">
                    <div class="art-Footer-inner">
                        <a href="#" class="art-rss-tag-icon" title="RSS"></a>
                        <div class="art-Footer-text">
                            <p><a href="#">Contact Us</a> | <a href="#">Terms of Use</a> | <a href="#">Trademarks</a>
                                | <a href="#">Privacy Statement</a><br />
                                Copyright &copy; 2010 ---. All Rights Reserved.</p>
                        </div>
                    </div>
                    <div class="art-Footer-background"></div>
                </div>
        		<div class="cleared"></div>
            </div>
        </div>
        <div class="cleared"></div>
        <p class="art-page-footer">created By Bank Nusantara Website Developer.</p>
    </div>
    
</body>
</html>
<?php endif; ?>