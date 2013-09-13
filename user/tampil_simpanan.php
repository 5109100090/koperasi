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
               			  <a href="index.php"><span class="l"></span><span class="r"></span><span class="t">Home</span></a>
               		  </li>
                		<li>
                			<a href="tampil_simpanan.php" class=" active"><span class="l"></span><span class="r"></span><span class="t">Lihat Data Transaksi</span></a>
                        </li>
                        		
                		<li>
                			<a href="tampil_kredit.php"><span class="l"></span><span class="r"></span><span class="t">Lihat Data Kredit</span></a>
                		</li>
                        <li>
                			<a href="<?php echo $host ?>/logout.php"><span class="l"></span><span class="r"></span><span class="t">Sign Out</span></a>
                		</li>
                		
               	  </ul>
                	 <!--header Atas-->  
                 </div>              
<p>
<form name="form" method="post">
<select id="opt" name="opt">
<option value="penyimpanan" <?php if($_POST['opt']=="penyimpanan") echo "selected"; ?>>Penyimpanan</option>
<option value="penarikan" <?php if($_POST['opt']=="penarikan") echo "selected"; ?>>Penarikan</option>
</select>
<input type="submit" name="submit" id="submit" value="Lihat Transaksi"></form>
                <?php 
				if($_POST['opt']=="penyimpanan") :
$query = "SELECT * FROM simpanan where id_anggota='$_SESSION[user_id]' order by tanggal_simpanan desc";
$execSQL=mysql_query($query);

echo "<h2 align=center>Data Transaksi Penyimpanan</h2>";
echo "<table id=\"table\" align=center border=\"0\">";
echo "<tr><td>ID transaksi</td>";
echo "<td>debet</td>";
echo "<td>tanggal</td>";

while($adapter=mysql_fetch_array($execSQL))
{
	echo "<tr><td>$adapter[0]</td>";
	echo "<td>$adapter[3]</td>";
	echo "<td>$adapter[4]</td>";
}
echo "</tr></table>";

					elseif($_POST['opt']=="penarikan") :
$query = "SELECT * FROM penarikan where id_anggota='$_SESSION[user_id]' order by tanggal_penarikan desc";
$execSQL=mysql_query($query);

echo "<h2 align=center>Data Transakasi Penarikan</h2>";
echo "<table id=\"table\" align=center border=\"0\">";
echo "<tr><td>ID transaksi</td>";
echo "<td>debet</td>";
echo "<td>tanggal</td>";

while($adapter=mysql_fetch_array($execSQL))
{
	echo "<tr><td>$adapter[0]</td>";
	echo "<td>$adapter[3]</td>";
	echo "<td>$adapter[4]</td>";
}
echo "</tr></table>";
					
					endif;
					
echo "<p><a href=\"index.php\">Back</a>";
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