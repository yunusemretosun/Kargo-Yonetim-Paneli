<?php  include_once("lib/fonksiyon.php");
try{

					$db=new PDO("mysql:host=localhost;dbname=kurumsal;charset=utf8","root","");
					$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

				}catch(PDOException $e){
					die($e->getMessage());
				}
$object= new kurumsal();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <title><?php echo $object->title; ?></title>
  <meta name"title" content="<?php echo $object->title; ?>"/> 
  <meta name"description" content="<?php echo $object->metatitle; ?>"/> 
  <meta name"keywords" content="<?php echo $object->metakey; ?>"/> 
  <meta name"author" content="<?php echo $object->metaauthor; ?>"/> 
  <meta name"owner" content="<?php echo $object->metaowner; ?>"/> 
  <meta name"copyright" content="<?php echo $object->metacopy; ?>"/> 
	
	
	

  <!-- Fontlar -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap stil dosyası --> 
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- işimize yarayacak diğer kütüphane css dosyalarımız -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
 <!-- Kütüphaneler -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/magnific-popup/magnific-popup.min.js"></script>
  <script src="lib/sticky/sticky.js"></script>
  <script src="js/main.js"></script>
  <!-- bizim stil dosyamız -->
  <link href="css/style.css" rel="stylesheet">
  <script>
	$(document).ready(function(e){
		$("#gonderbtn").click(function(e){
			$.ajax({
				type:"POST",
				url:'lib/mail/gonder.php',
				data:$('#mailform').serialize(),
				success:function(donen){
				$('#mailform').trigger("reset");
				$('#formtutucu').fadeOut(500);
				$('#mesajsonuc').html(donen);
				
					
				},
			});
		});
	});
		
</script>

</head>

<body id="body">

<!-- ÜST BAR -->

<section id="topbar" class="d-none d-lg-block">
<div class="container clearfix">

	<div class="contact-info float-left">
    <i class="fa fa-envelope-o"></i><a href="mailto:<?php echo $object->mailaddress;?>"><?php echo $object->mailaddress; ?></a>
    <i class="fa fa-phone"></i><?php echo $object->telno; ?>    
    
    </div>    
    <div class="social-links float-right">    
    <a href="<?php echo $object->tweeter;?>" class="twitter"><i class="fa fa-twitter"></i></a>
     <a href="<?php echo $object->facebook;?>" class="facebook"><i class="fa fa-facebook"></i></a>
      <a href="<?php echo $object->instagram;?>" class="instagram"><i class="fa fa-instagram"></i></a> 
      </div>
</div>

</section> 


<!-- header -->

<header id="header">

	<div class="container">
    
    	<div id="logo" class="pull-left">
        <h1><a style="color: #087100;" href="#body" class="scrollto"><?php echo $object->metatitle; ?></a></h1>
        
        
        </div>
        
        
        <nav id="nav-menu-container">
        <ul class="nav-menu">        
        <li class="menu-active"><a href="#body">Anasayfa</a></li>
        <li><a href="#hakkimizda">Hakkımızda</a></li>
        <li><a href="#hizmetler">Hizmetlerimiz</a></li>
        <li><a href="#filo">Araç Filomuz</a></li>
        <li><a href="#iletisim">İletişim</a></li> 
        </ul>
        </nav>
    
    </div>




</header>


<!-- İNTRO -->

<section id="intro">


<div class="intro-content">
<h2><?php echo $object->slogan;?></h2>


</div>


<div id="intro-carousel" class="owl-carousel">


<?php  $object->intro($db); ?>
	

</div>




</section>

<!-- ana main -->
<main id="main">

<section id="hakkimizda" class="wow fadeInUp">

	<div class="container">

	<?php 
		
		$object->hakkimizda($db);
		?>

	</div>




</section>

<!-- ana main -->

<section id="hizmetler">
	<div class="container">
    	<div class="section-header">
        <h2>HİZMETLERİMİZ</h2>
       <?php
		
			$object->hizmet($db);
			
			?>
    
    
    
    </div>




</section>


<!-- referanslar -->


<section id="referanslar" class="wow fadeInUp">

	<div class="container">
    <h2>REFERANSLAR</h2>
		<?php
		$object->referans($db);
	
		?>
		
    </div>



</section>

<!-- Filomuz -->


<section id="filo" class="wow fadeInUp">
<div class="container">
<?php
	
	$object->filomuz($db);
	
	?>
	</div>		
</section>

<!-- müşteri Yorumlar -->


<section id="yorumlar" class="wow fadeInUp">

<div class="container">
<?php
	$object->yorumlar($db);
	?>

</div>




</section>



<!-- iletişim -->

<section id="iletisim" class="wow fadeInUp">

<div class="container">


			<div class="section-header">
        <h2>İLETİŞİM</h2>
        <p><?php echo $object->iletisimbaslik; ?> </p>
   		 </div>
         
         <div class="row contact-info">
         
         <div class="col-md-4">
         <div class="contact-address">
         <i class="ion-ios-location-outline"></i>
         <h3>Adresimiz</h3>
         <address><?php echo $object->address;?></address>
         </div>
         </div>
         
          <div class="col-md-4">
         <div class="contact-phone">
         <i class="ion-ios-telephone-outline"></i>
         <h3>Telefon Numaramız</h3>
         <p><a href="tel:+<?php echo $object->telno;?>"><?php echo $object->telno;?></a></p>
         </div>
         </div>
         
          <div class="col-md-4">
         <div class="contact-email">
         <i class="ion-ios-email-outline"></i>
         <h3>Mail</h3>
         <p><a href="mailto:<?php echo $object->mailaddress;?>"><?php echo $object->mailaddress;?></a></p>
         </div>
         </div>
         
         
         
</div>

</div>

<div class="container mb-4">
<iframe src="<?php echo $object->haritabilgi;?>" width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>

</div>


<div class="container">
<div class="form">

<div id="mesajsonuc"></div>
	
<div id="formtutucu">
<form id="mailform">

<div class="form-row">

<div class="form-group col-md-6">
<input type="text" name="isim" class="form-control" placeholder="Adınız" required="required" />

</div>

<div class="form-group col-md-6">
<input type="text" name="mail" class="form-control" placeholder="Mail Adresiniz" required="required" />

</div>
</div>



<div class="form-group">
<input type="text" name="konu" class="form-control" placeholder="Mesaj Konusu" required="required" />
</div>

<div class="form-group">
<textarea class="form-control" name="mesaj" rows="5"></textarea>
</div>



<div class="text-center"><input type="button"  value="Gönder" id="gonderbtn" class="btn btn-info"/></div>

</form>
</div>

</div>
</div>
</section>


</main>

<!-- footer -->

<footer id="footer">

<div class="container">
<div class="copyright">
2019 &copy; <?php echo $object->metacopy;?>	 <strong><?php echo $object->metaowner;?></strong>
</div>
<div class="credits">
<?php echo $object->metaauthor;?>
</div>
</div>
</footer>
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>


 

</body>
</html>
