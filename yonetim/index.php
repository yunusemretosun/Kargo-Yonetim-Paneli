<?php
		include_once("assets/fonksiyon.php"); $yonetim = new yonetim;
		$yonetim->cookiekontrol("ind");
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
  <meta charset="utf-8">
   
    <title>Korkmaz Nakliyat-Giriş Paneli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">    
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">   
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
	<div class="login-area text-center">
		
		
<?php
		
		
		if(!$_POST):
?>
			<div class="container">
			<div class="login-box pt--100">
				<form action="" method="post">
					<div class="login-form-head">
						<h4>YÖNETİM PANELİ</h4>
					</div>
					<div class="login-form-body">
						<div class="form-gp">
						<input type="text" name="kulad" id="kuladlab" placeholder="Kullanıcı adı"  />
						<i class="ti-user"></i>
						</div>
						
						<div class="form-gp">
						<input type="password" name="sifre" id="sifrelab" placeholder="Şifre" />
						<i class="ti-lock"></i>
						</div>
						
						<div class="submit-btn-area">
						<input type="submit" class="btn btn-dark" name="buton" value="Giriş Yap" />
						</div>
						
					</div>
				</form>		
			</div>
		
		</div>
	</div>
		
<?php
		else:
		
		$kulad=htmlspecialchars($_POST["kulad"]);
		$sifre=htmlspecialchars($_POST["sifre"]);
			
			if(empty($kulad) || empty($sifre) ):
	
		
		
				echo '
				<div class="container-fluid bg-white">
				<div class="alert alert-blcak border border-dark mt-5 mx-auto col-md-5 p-3 text-danger font-14 font-weight-bold">
				<img  src="assets/images/a" class="mr-3 " />Bilgiler Boş Olamaz</div>
				</div>';
				
				header("refresh:2,url=index.php");
		
			else:
			
			$yonetim->giriskontrol($kulad,$sifre,$db);
			endif;
		
		
		
		endif;
		
		
?>
		
		
		
		
		
		
		
	
	
	
	
   
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>
