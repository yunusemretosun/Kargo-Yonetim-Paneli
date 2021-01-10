<?php
include_once( "assets/fonksiyon.php" );
include_once( "assets/fonksiyon2.php" );
$yonetim = new yonetim;
$yonetim2 = new yonetim2;
$yonetim->cookiekontrol( "cot" );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>Korkmaz Nakliyat-Yönetim Paneli</title>
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

<!-- page container area start -->
<div class="page-container"> 
  <!-- sidebar menu area start -->
  <div class="sidebar-menu">
    <div class="sidebar-header">
      <div class="logo"> <a href="control.php"><img src="assets/images/logo/ak.png" alt="logo"></a> </div>
    </div>
    <div class="main-menu">
      <div class="menu-inner">
        <nav>
          <ul class="metismenu" id="menu">
            
            <li><a href="control.php?sayfa=introayar"><i class="ti-image"></i> <span>İntro Ayarları</span></a></li>
            <li><a href="control.php?sayfa=hakkimiz"><i class="ti-flag"></i> <span>Hakkımızda Ayarları</span></a></li>
            <li><a href="control.php?sayfa=hizayar"><i class="ti-medall"></i> <span>Hizmetlerimiz Ayarları</span></a></li>
            <li><a href="control.php?sayfa=refayar"><i class="ti-eye"></i> <span>Referanslar Ayarları</span></a></li>
            <li><a href="control.php?sayfa=filoayar"><i class="ti-car"></i> <span>Araç Filosu</span></a></li>
            <li><a href="control.php?sayfa=yorumayar"><i class="ti-comment-alt"></i> <span>Müşteri Yorumları</span></a></li>
            <li><a href="control.php?sayfa=gelenmesaj"><i class="fa fa-envelope"></i> <span>Gelen Mesajlar</span></a></li>
           
			  
            <li><a href="javascript:void(0)" aria-expended="true">
				<i class="fa fa-cog"></i> <span>Ayarlar</span></a>
			  		<ul class="collapse">
						<li><a href="control.php?sayfa=siteayar"><i class="ti-pencil"></i> <span>Site Ayarları</span></a></li>
						 <li><a href="control.php?sayfa=mailayar"><i class="fa fa-envelope"></i> <span>Mail Aayarları</span></a></li>
					</ul>
			  </li>
			  
          </ul>
        </nav>
      </div>
    </div>
  </div>
  <!-- sidebar menu area end --> 
  <!-- main content area start -->
  <div class="main-content"> 
    <!-- header area start -->
    <div class="header-area">
      <div class="row align-items-center" style="max-height:40px;"> 
        <!-- nav and search button -->
        <div class="col-md-6 col-sm-8 clearfix">
          <div class="nav-btn pull-left"> <span></span> <span></span> <span></span> </div>
        </div>
        <!-- profile info & task notification -->
        <div class="col-sm-6 clearfix">
          <div class="user-profile pull-right col-sm-2.1 m-2 " style="max-height:40px;padding: 1%" >
            <h4 class="user-name dropdown-toggle"  data-toggle="dropdown" ><i class="fa fa-user mb-1 mr-2"></i><?php echo $yonetim->get_username($db); ?><i class="fa fa-angle-down"></i></h4>
            <div class="dropdown-menu"> <a class="dropdown-item" onClick="color:blue;" href="control.php?sayfa=ayar">Ayarlar</a> <a class="dropdown-item" onClick="color:blue;" href="control.php?sayfa=kulayar">Kullanıcı Ayarları</a> <a class="dropdown-item" onClick="color:blue;" href="control.php?sayfa=cikis">Çıkış</a> </div>
          </div>
        </div>
      </div>
    </div>
    <!-- header area end --> 
    <!-- page title area start --> 
    
    <!-- page title area end -->
    <div class="main-content-inner"> 
      <!-- sales report area start -->
      <div class="row">
        <div class="col-lg-12 mt-2 bg-white text-center" style="min-height:500px;">
          <?php

          @$sayfa = $_GET[ "sayfa" ];

          switch ( $sayfa ):
          case "siteayar":
            $yonetim->siteayar( $db );
            break;
          case "cikis":
            $yonetim->cikis( $db );
            break;
          case "introayar":
            $yonetim->introayar( $db );
            break;
          case "introresimguncelle":
            $yonetim->introresimguncelle( $db );
            break;
          case "introresimsil":
            $yonetim->introsil( $db );
            break;
          case "introresimekle":
            @$yonetim->introresimekle( $db );
            break;
          case "filoayar":
            $yonetim->filoayar( $db );
            break;
          case "filoresimguncelle":
            $yonetim->filoresimguncelle( $db );
            break;
          case "filoresimsil":
            $yonetim->filosil( $db );
            break;
          case "filoresimekle":
            $yonetim->filoresimekle( $db );
            break;
          case "hakkimiz":
            $yonetim2->hakayar( $db );
            break;
          case "filoayar":
            $yonetim->filoayar( $db );
            break;
          case "hizayar":
            $yonetim2->hizmetayar( $db );
            break;
          case "hizmetekle":
            $yonetim2->hizmetekle( $db );
            break;
          case "hizmetguncelle":
            $yonetim2->hizmetguncelle( $db );
            break;
          case "hizmetsil":
            $yonetim2->hizmetsil( $db );
            break;
          case "refayar":
            $yonetim2->refayar( $db );
            break;
          case "refekle":
            $yonetim2->refekle( $db );
            break;
          case "refguncelle":
            $yonetim2->refguncelle( $db );
            break;
          case "refsil":
            $yonetim2->refsil( $db );
            break;
          case "yorumayar":
            $yonetim2->yorumayar( $db );
            break;
          case "yorumekle":
            $yonetim2->yorumekle( $db );
            break;
          case "yorumguncelle":
            $yonetim2->yorumguncelle( $db );
            break;
          case "yorumsil":
            $yonetim2->yorumsil( $db );
            break;
          case "gelenmesaj":
            $yonetim->gelenmesajlar( $db );
            break;
          case "mesajoku":
            $yonetim->mesajdetay( $db, $_GET[ "id" ] );
            break;
          case "mesajarsivle":
            $yonetim->mesajarsivle( $db, $_GET[ "id" ] );
            break;
          case "mesajsil":
            $yonetim->mesajsil( $db, $_GET[ "id" ] );
            break;
          case "mailayar":
            $yonetim2->mailayar( $db );
            break;
		  case "ayar":
			$yonetim2->kullaniciayar( $db );
			break;
		  case "kulayar":
		    $yonetim2->yoneticiler( $db );
			break;
		 case "yonsil":
			$yonetim2->yonsil( $db ,$_GET[ "id" ]);
			break;
		 case "yonekle":
			$yonetim2->yonekle( $db );
			break;
	
			default:
			$yonetim->filoayar( $db );
		
            endswitch;

            ?>
        </div>
      </div>
    </div>
  </div>
  <!-- main content area end --> 
</div>
<!-- page container area end --> 

<!-- jquery latest version --> 
<script src="assets/js/vendor/jquery-2.2.4.min.js"></script> 
<!-- bootstrap 4 js --> 
<script src="assets/js/popper.min.js"></script> 
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script> 
<script src="assets/js/metisMenu.min.js"></script> 
<script src="assets/js/jquery.slimscroll.min.js"></script> 
<script src="assets/js/jquery.slicknav.min.js"></script> 

<!-- others plugins --> 
<script src="assets/js/plugins.js"></script> 
<script src="assets/js/scripts.js"></script>
</body>
</html>