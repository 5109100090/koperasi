<?php include "../koneksi.php"; include "../function.php"; $host=HOST; ?>
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
               			  <a href="index.php" class=" active"><span class="l"></span><span class="r"></span><span class="t">Home</span></a>
               		  </li>
                		<li>
                		  <a href="tampil_simpanan.php"><span class="l"></span><span class="r"></span><span class="t">Lihat Data Transaksi</span></a>
                        </li>
                                        		<li>
                		  <a href="tampil_kredit.php"><span class="l"></span><span class="r"></span><span class="t">Lihat Data Kredit</span></a>
                        </li>
               	  </ul>
                	 <!--header Atas-->                
           	  </div>
                <div class="art-contentLayout">
                  <div class="art-content">
                        <div class="art-Post">
                            <div class="art-Post-body">
                        <div class="art-Post-inner">
                                        <h2 class="art-PostHeader">
                                            Selamat Datang <?php echo $_SESSION['user'] ?>
                                        </h2>
                                        <div class="art-PostContent">
                                            <?php
											$r=getNasabahOfTheMonth();
                                            if($r['username']==$_SESSION['username'])
												echo "<div id='messageOk'>Selamat!<br>anda terpilih sebagai nasabah of the month periode kali ini</div>";
											if(getMonthSaldo($_SESSION['user_id']) < 50000)
												echo "<div id='messageError'>saldo anda bulan ini kurang dari 50000!<br>segera lakukan transaksi penyimpanan</div>";
											?>
                                            <ul>
                                            <li>tingkatkan saldo anda dan jadilah Nasabah of The Month kami untuk memperebutkan jutaan rupiah.</li>
                                            <li>dapatkan bagi hasil sebesar 1% dari jumlah saldo anda di setiap akhir tahun.</li>
                                            </ul>
                                            <p>
                                        </div>
                                        <div class="cleared"></div>
                        </div>
                        
                        		<div class="cleared"></div>
                            </div>
                        </div>
                    </div>
                    <div class="art-sidebar1">
                        <div class="art-Block">
                            <div class="art-Block-tl"></div>
                            <div class="art-Block-tr"></div>
                            <div class="art-Block-bl"></div>
                            <div class="art-Block-br"></div>
                            <div class="art-Block-tc"></div>
                            <div class="art-Block-bc"></div>
                            <div class="art-Block-cl"></div>
                            <div class="art-Block-cr"></div>
                            <div class="art-Block-cc"></div>
                            <div class="art-Block-body">
                                        <?php rightWidget(); ?>
                        		<div class="cleared"></div>
                            </div>
                        </div>
                  </div>
                <div class="cleared"></div><div class="art-Footer">
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
        <p class="art-page-footer">created By Bank Wewe Website Developer.</p>
    </div>
    
</body>
</html>
<?php endif; ?>