<?php include "../koneksi.php"; include "../function.php"; include "function.php"; $host=HOST; ?>
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
               			  <a href="index.php" <?php if($_GET['page']=='') echo "class='active'" ?>><span class="l"></span><span class="r"></span><span class="t">Home</span></a>
               		  </li>
                      <?php if(isset($_SESSION['user'])): ?>
                		<li>
                			<a href="?page=tambahnasabah" <?php if($_GET['page']=='tambahnasabah') echo "class='active'" ?>><span class="l"></span><span class="r"></span><span class="t">Tambah Nasabah</span></a>
                        </li>
                        		
                		<li>
                			<a href="?page=tambahsimpanan" <?php if($_GET['page']=='tambahsimpanan') echo "class='active'" ?>><span class="l"></span><span class="r"></span><span class="t">Transaksi Simpanan</span></a>
                		</li>
                        <li>
                			<a href="?page=barang" <?php if($_GET['page']=='barang') echo "class='active'" ?>><span class="l"></span><span class="r"></span><span class="t">Barang</span></a>
                		</li>
                		
                		<li>
                			<a href="?page=tambahkredit" <?php if($_GET['page']=='tambahkredit') echo "class='active'" ?>><span class="l"></span><span class="r"></span><span class="t">Tambah Kredit</span></a>
                		</li>

                		<li>
                			<a href="?page=tambahpembayarankredit" <?php if($_GET['page']=='tambahpembayarankredit') echo "class='active'" ?>><span class="l"></span><span class="r"></span><span class="t">Pembayaran Kredit</span></a>
                		</li>

                		<li>
                			<a href="?page=datatransaksi" <?php if($_GET['page']=='datatransaksi') echo "class='active'" ?>><span class="l"></span><span class="r"></span><span class="t">Data Transaksi</span></a>
                		</li>
                        <?php endif; ?>
               	  </ul>
                	 <!--header Atas-->                
           	  </div>
                <div class="art-contentLayout">
                    <div class="art-content">
                        <div class="art-Post">
                            <div class="art-Post-body">
                           	<?php
								$page=$_GET['page'];
								if($page=="tambahnasabah") :
									tambahNasabah();
								elseif($page=="tambahsimpanan") :
									tambahSimpanan();
								elseif($page=="barang") :
									tambahBarang();
								elseif($page=="ambilsimpanan") :
									ambilSimpanan();
								elseif($page=="tambahkredit") :
									tambahKredit();
								elseif($page=="tambahpembayarankredit") :
									tambahPembayaranKredit();
								elseif($page=="datatransaksi") :
									dataTransaksi();
								else :
							?>
                        <div class="art-Post-inner">
                                        <h2 class="art-PostHeader">
                                        <?php echo "Selamat Datang ".$_SESSION["user"];?>
                                        </h2>
                                        <div class="art-PostContent">
                                              Halaman utama pegawai Koperasi Nusantara
                                        </div>
                                        <div class="cleared"></div>
                        </div>
                        <?php endif; ?>
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
                            <div class="art-Block-body">
                                        <?php
											if(isset($_SESSION["user"])){
                                            	rightWidget();
											}else
												adminLogin();
											?>
                                        		<div class="cleared"></div>
                                            </div>
                                        </div>
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
        <p class="art-page-footer">created By Bank Nusantara Website Developer.</p>
    </div>
    
</body>
</html>