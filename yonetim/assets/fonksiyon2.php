<?php
require_once( "fonksiyon.php" );

class yonetim2 extends yonetim {

  //-------------------------Referans START-------------------------	
  function refayar( $vt ) {
    echo '<div class="row text-center">
			<div class="col-lg-12 border-bottom"><h4 class="float-left m-3 text-dark">
			<a href="control.php?sayfa=refekle" 
			class="ti-plus bg-dark p-1 text-white mr-2 mt-3 "></a>
			REFERANSLAR</h4></div>
			';


    $introbilgiler = $this->sorgum( $vt, "select * from ref ", 2 );
    while ( $son = $introbilgiler->fetch( PDO::FETCH_ASSOC ) ):

      echo '<div class="col-lg-4">
					
					<div class="row border border-dark col-lg-12 p-2 m-1">
						<div class="col-lg-12">
						<img src="../' . $son[ "rimg" ] . '">
						<kbd class="bg-white" style="position:absolute; right:0px; bottom:0px;">
							<a href="control.php?sayfa=refguncelle&id=' . $son[ "id" ] . '" 
							class="ti-reload m-2 text-success" style="font-size:20px;"></a> 
							<a href="control.php?sayfa=refsil&id=' . $son[ "id" ] . '" 
							class="ti-trash m-2 text-danger" style="font-size:20px;"></a> 
						</kbd>
						
						</div>
					</div>	
				</div>
					';

    endwhile;
    echo '</div>';

  } //intro ayar

  function refekle( $vt ) {
    echo '<div class="row text-center">
			<div class="col-lg-12">
			';

    if ( $_POST ):
      //dosya bos mu ?
      if ( $_FILES[ "dosya" ][ "name" ] == " " ):
        echo '<div class="alert alert-danger mt-1">Dosya Seçilmedi</div>';
      else : //dosyanin boyutu ne kadar ?
        if ( $_FILES[ "dosya" ][ "size" ] > ( 5 * 1024 * 1024 ) ):
          echo '<div class="alert alert-danger mt-1">Yüksek dosya boyutu !</div>';
    header( "refresh:2,url=control.php?sayfa=refekle" );
    else : //dosyanin uzantisi ne ?
      $uzantilarim = array( "image/png", "image/jpeg" );
    if ( !in_array( $_FILES[ "dosya" ][ "type" ], $uzantilarim ) ):
      echo '<div class="alert alert-danger mt-1">Lütfen JPEG veya PNG uzantılı dosyaları tercih ediniz!</div>';
    header( "refresh:2,url=control.php?sayfa=refekle" );
    else :

      $yol = '../img/referans/' . $_FILES[ "dosya" ][ "name" ];

    move_uploaded_file( $_FILES[ "dosya" ][ "tmp_name" ], $yol );
    echo '<div class="alert alert-success mt-1">Dosya kaydı başarılı.</div>';
    header( "refresh:2,url=control.php?sayfa=refayar" );
    //dosya veritabanina aktariliyor.
    $webyol = str_replace( '../', '', $yol );
    $kayit = $this->sorgum( $vt, "INSERT INTO ref (rimg) VALUES ('$webyol') ", 0 );
    endif;
    endif;
    endif;


    else :
      ?>
<div class="col-lg-4 mx-auto mt-2">
  <div class="card card-bordered">
    <div class="card-body">
      <h5 class="title border-bottom">Referans Yükleme Formu</h5>
      <form action="" method="post" enctype="multipart/form-data">
        <p class="card-text">
          <input type="file" name="dosya"/>
        </p>
        <input type="submit" name="buton" value="Yükle" class="btn btn-primary mb-1" />
      </form>
      <p class="card-text text-left text-danger border-top"> *İzin verilen formatlar: jpg-png<br>
        *İzin verilen max boyut: 5 MB </p>
    </div>
  </div>
</div>
<?php

endif;
echo '</div></div></div>';
} //ref resim ekleme

function refguncelle( $vt ) {

  $gelenrefid = $_GET[ "id" ];

  echo '<div class="row text-center">
			<div class="col-lg-12">
			';

  if ( $_POST ):
    //dosya bos mu ?


    $formdangelenid = $_POST[ "refid" ];

  if ( $_FILES[ "dosya" ][ "name" ] == " " ):
    echo '<div class="alert alert-danger mt-1">Dosya Seçilmedi</div>';
  else : //dosyanin boyutu ne kadar ?
    if ( $_FILES[ "dosya" ][ "size" ] > 5 * 1024 * 1024 ):
      echo '<div class="alert alert-danger mt-1">Yüksek dosya boyutu !</div>';
  header( "refresh:2,url=control.php?sayfa=refayar" );
  else : //dosyanin uzantisi ne ?
    $uzantilarim = array( "image/png", "image/jpeg" );
  if ( !in_array( $_FILES[ "dosya" ][ "type" ], $uzantilarim ) ):
    echo '<div class="alert alert-danger mt-1">Lütfen JPEG veya PNG uzantılı dosyaları tercih ediniz!</div>';
  header( "refresh:2,url=control.php?sayfa=refayar" );
  else :

    //mevcut dosya yolunu silip yerine yeni dosya yolunu ekleyecegiz.	

    $resimyolunabak = $this->sorgum( $vt, "select * from ref where id='$gelenrefid'", 1 );

  //mevcut veri çekildi ve silindi.
  $dbgelenyolabak = "../" . $resimyolunabak[ "rimg" ];
  unlink( $dbgelenyolabak );


  $yeniyol = '../img/referans/' . $_FILES[ "dosya" ][ "name" ];

  move_uploaded_file( $_FILES[ "dosya" ][ "tmp_name" ], $yeniyol );

  $yeniyol2 = str_replace( '../', '', $yeniyol );
  $kayit = $this->sorgum( $vt, "update ref set rimg='$yeniyol2' where id='$gelenrefid'", 0 );

  echo '<div class="alert alert-success mt-1">Dosya kaydı başarılı.</div>';
  header( "refresh:2,url=control.php?sayfa=refayar" );
  //dosya veritabanina aktariliyor.

  endif;
  endif;
  endif;


  else :
    ?>
<div class="col-lg-4 mx-auto mt-2">
  <div class="card card-bordered">
    <div class="card-body">
      <h5 class="title border-bottom">Resim Güncelleme Formu</h5>
      <form action="" method="post" enctype="multipart/form-data">
        <p class="card-text">
          <input type="file" name="dosya"/>
        </p>
        <p class="card-text">
          <input type="hidden" name="refid" value="<?php echo $gelenrefid; ?>"/>
        </p>
        <input type="submit" name="buton" value="Yükle" class="btn btn-primary mb-1" />
      </form>
      <p class="card-text text-left text-danger border-top"> *İzin verilen formatlar: jpg-png<br>
        *İzin verilen max boyut: 5 MB </p>
    </div>
  </div>
</div>
<?php

endif;
echo '</div></div></div>';
}

function refsil( $vt ) { //emin misin modelbox eklenecek

  $silid = $_GET[ "id" ];

  //veritabanindan veriyi silme
  $this->sorgum( $vt, " DELETE FROM ref where id=$silid", 0 );


  echo '<div class="alert alert-warning mt-1">Hizmet silindi!</div>';
  echo '</div></div>';

  header( "refresh:2,url=control.php?sayfa=refayar" );
}


//-------------------------HIZMETLER START-------------------------
function yorumayar( $vt ) {} //hizmet ayar

function yorumekle( $vt ) {} //hizmet ekle

function yorumguncelle( $vt ) {} //hizmet güncelle

function yorumsil( $vt ) {} //yorumsil 

//-------------------------Mail Ayarlar-------------------------

function mailayar( $db ) {
  $sonuc = $this->sorgum( $db, "SELECT * FROM gelenmailayar", 1 );

  if ( $_POST ):

    $host = htmlspecialchars( $_POST[ "host" ] );
  $mailadres = htmlspecialchars( $_POST[ "mailadres" ] );
  $alicimail = htmlspecialchars( $_POST[ "alicimail" ] );
  $port = htmlspecialchars( $_POST[ "port" ] );
  $sifre = htmlspecialchars( $_POST[ "sifre" ] );


  $guncelleme = $db->prepare( 'UPDATE gelenmailayar SET host=?,mailadres=?,alicimail=?,port=?,sifre=?' );

  $guncelleme->bindParam( 1, $host, PDO::PARAM_STR );
  $guncelleme->bindParam( 2, $mailadres, PDO::PARAM_STR );
  $guncelleme->bindParam( 3, $alicimail, PDO::PARAM_STR );
  $guncelleme->bindParam( 4, $port, PDO::PARAM_STR );
  $guncelleme->bindParam( 5, $sifre, PDO::PARAM_STR );

  $guncelleme->execute();

  echo '<div class="alert alert-success">
			<strong>Mail Ayarları</strong> başarıyla güncellendi.
			</div>';

  @header( 'refresh:1,url=control.php?sayfa=mailayar' );

  else :
    ?>
<form action="control.php?sayfa=mailayar" method="post">
  <div class="row text-center">
    <div class="col-lg-4 mx-auto">
      <div class="col-lg-12 mx-auto mt-2">
        <h3 class="text-info">Mail Ayarları</h3>
      </div>
      <!--***********************-->
      <div class="col-lg-12 mx-auto  mt-2 border">
        <div class="row">
          <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Host</span> </div>
          <div class="col-lg-9 p-1">
            <input type="text" name="host" class="form-control" value="<?php echo $sonuc["host"]; ?>" />
          </div>
        </div>
      </div>
      <!--***********************--> 
      <!--***********************-->
      <div class="col-lg-12 mx-auto  mt-2 border">
        <div class="row">
          <div class="col-lg-3 mx-auto border-right pt-3 text-left"> <span>Mail Adres</span> </div>
          <div class="col-lg-9 mx-auto   p-2">
            <input type="text" name="mailadres" class="form-control" value="<?php echo $sonuc["mailadres"]; ?>" />
          </div>
        </div>
      </div>
      <!--***********************-->
      <div class="col-lg-12 mx-auto  mt-2 border">
        <div class="row">
          <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Port</span> </div>
          <div class="col-lg-9 mx-auto   p-2">
            <input type="text" name="port" class="form-control" value="<?php echo $sonuc["port"]; ?>" />
          </div>
        </div>
      </div>
      <!--***********************--> 
      <!--***********************--> 
      <!--***********************-->
      <div class="col-lg-12 mx-auto  mt-2 border">
        <div class="row">
          <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Alici Mail Adresi</span> </div>
          <div class="col-lg-9 mx-auto   p-2">
            <input type="text" name="alicimail" class="form-control" value="<?php echo $sonuc["alicimail"]; ?>" />
          </div>
        </div>
      </div>
      <!--***********************--> 
      <!--***********************-->
      <div class="col-lg-12 mx-auto  mt-2 border">
        <div class="row">
          <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Host Şifre</span> </div>
          <div class="col-lg-9 mx-auto   p-2">
            <input type="text" name="sifre" class="form-control"  value="<?php echo $sonuc["sifre"]; ?>" />
          </div>
        </div>
      </div>
      <!--***********************-->
      <div class="col-lg-12 mx-auto mt-2 border-bottom">
        <input type="submit" name="buton" class="btn btn-info m-1" value="Güncelle" />
      </div>
    </div>
  </div>
</form>
<?php
endif;

} //mail ayar

//-------------------------Kullanici Ayarlar-------------------------

function kullaniciayar( $db ) {
  $id = self::coz( $_COOKIE[ "kulbilgi" ] );
  $sonuc = self::sorgum( $db, "select * from yonetim where id=$id", 1 );
  if ( $_POST ):

    @$kulad = htmlspecialchars( $_POST[ "kulad" ] );
  @$eskisif = htmlspecialchars( $_POST[ "sifre" ] );
  @$yenisif = htmlspecialchars( $_POST[ "yenisif" ] );
  @$yenisif2 = htmlspecialchars( $_POST[ "yenisif2" ] );

  if ( empty( $kulad ) || empty( $eskisif ) || empty( $yenisif ) || empty( $yenisif2 ) ):

    echo '<div class="alert alert-danger">
				<strong>Bilgiler Boş Olamaz!</strong>
				</div>';

  @header( 'refresh:1,url=control.php?sayfa=ayar' );

  else :

    $sifrelihal = md5( sha1( md5( $eskisif ) ) );

  if ( $sonuc[ "sifre" ] != $sifrelihal ):
    echo '<div class="alert alert-danger">
				Eski Şifre Hatali Girildi !	
		</div>';
  // header( 'refresh:1,url=control.php?sayfa=ayar' );
  else :
    if ( $yenisif != $yenisif2 ):
      echo '<div class="alert alert-danger">
					Yeni Şireler Uyumsuz !	
				</div>';
  header( 'refresh:1,url=control.php?sayfa=ayar' );
  else :
    $sifre = md5( sha1( md5( $yenisif ) ) );
  $guncelleme = $db->prepare( "UPDATE yonetim SET kulad=?,sifre=? where id=$id" );

  $guncelleme->bindParam( 1, $kulad, PDO::PARAM_STR );
  $guncelleme->bindParam( 2, $sifre, PDO::PARAM_STR );
  $guncelleme->execute();

  echo '<div class="alert alert-success">
				<strong>Kullanıcı Ayarları</strong> başarıyla güncellendi.
				</div>';

  @header( 'refresh:1,url=control.php?sayfa=ayar' );

  endif;

  endif;

  endif;


  else :
    ?>
<form action="control.php?sayfa=ayar" method="post">
  <div class="row text-center">
    <div class="col-lg-4 mx-auto">
      <div class="col-lg-12 mx-auto mt-2">
        <h3 class="text-info">Kullanıcı Ayarları</h3>
      </div>
      <!--***********************-->
      <div class="col-lg-12 mx-auto  mt-2 border">
        <div class="row">
          <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span><strong>Kullanıcı Adı</strong></span> </div>
          <div class="col-lg-9 p-1">
            <input type="text" name="kulad" class="form-control" value="<?php echo $sonuc["kulad"]; ?>" />
          </div>
        </div>
      </div>
      <!--***********************--> 
      <!--***********************-->
      <div class="col-lg-12 mx-auto  mt-2 border">
        <div class="row">
          <div class="col-lg-3 mx-auto border-right pt-3 text-left"> <span><strong>Şifre</strong></span> </div>
          <div class="col-lg-9 mx-auto   p-2">
            <input type="password" name="sifre" class="form-control" />
          </div>
        </div>
      </div>
      <!--***********************--> 
      <!--***********************-->
      <div class="col-lg-12 mx-auto  mt-2 border">
        <div class="row">
          <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span><strong>Yeni Şifre</strong></span> </div>
          <div class="col-lg-9 mx-auto   p-2">
            <input type="password" name="yenisif" class="form-control" />
          </div>
        </div>
      </div>
      <!--***********************--> 
      <!--***********************-->
      <div class="col-lg-12 mx-auto  mt-2 border">
        <div class="row">
          <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span><strong>Yeni Şifre (Tekrar)</strong></span> </div>
          <div class="col-lg-9 mx-auto   p-2">
            <input type="password" name="yenisif2" class="form-control" />
          </div>
        </div>
      </div>
      <!--***********************-->
      <div class="col-lg-12 mx-auto mt-2 border-bottom">
        <input type="submit" name="buton" class="btn btn-info m-1" value="Güncelle" />
      </div>
    </div>
  </div>
</form>
<?php
endif;

} //KULLANICI AYAR.	

//-------------------------Kullanici Ekleme Ve Silme-------------------------

function yoneticiler( $db ) {

  $cek = $this->sorgum( $db, "select * from yonetim ", 2 ); //gelen verileri dognuye sokacagımız icin execute edilmis alıyoruz sadece.

  echo '<div class="row text-center" >
				<div class="col-lg-6 mt-5 mx-auto">
					<div class="card">
						<div class="card-body">	
							<h4 class="header-title text-dark">
							<a href="control.php?sayfa=yonekle"><i class="ti-plus bg-dark p-1 text-white mr-2 mt-3"></i></a>
							Kullanıcılar</h4>
								<div class="single-table">
									<div class="table-responsive">
										<table class="table text-center border">
											<thead>
											<tr>
											<th scope="col" class="border-right">Ad</th>
											<th scope="col">Işlem</th>
											</tr>
											</thead>
											<tbody>
												<tr>';
  while ( $al = $cek->fetch( PDO::FETCH_ASSOC ) ):
    echo '<th scope="row" class="border-right bg-light">' . $al[ "kulad" ] . '</th>
								<th scope="row"><a href="control.php?sayfa=yonsil&id=' . $al[ "id" ] . '"><i class="ti-trash text-danger " style="font-size:150%"></i></a></th></tr>
												';
  endwhile;


  '</tr>
											</tbody>
										</table>
								  </div>
							 </div>
						 </div>
					</div>
				</div>
			</div>
			';


}

function yonsil( $db, $gelenid ) {

  echo '	
		<div class="row m-2">
			<div class="col-lg-12 p-1 text-primary">	
			<div class="alert alert-warning"> Yönetici Silindi</div>
			</div>
		</div></div>';


  $this->sorgum( $db, "delete from yonetim where id = $gelenid", 0 );
  header( "refresh:2,url=control.php?sayfa=kulayar" );

}

function yonekle( $db ) {

  if ( $_POST ):

    @$kulad = htmlspecialchars( $_POST[ "kulad" ] );
  @$yenisif = htmlspecialchars( $_POST[ "yenisif" ] );
  @$yenisif2 = htmlspecialchars( $_POST[ "yenisif2" ] );

  if ( empty( $kulad ) || empty( $yenisif ) || empty( $yenisif2 ) ):

    echo '<div class="alert alert-danger">
				<strong>Bilgiler Boş Olamaz!</strong>
				</div>';

  @header( 'refresh:1,url=control.php?sayfa=yonekle' );

  else :
    if ( $yenisif != $yenisif2 ):
      echo '<div class="alert alert-danger">
	  				Şireler Uyumsuz !	
				</div>';
  header( 'refresh:1,url=control.php?sayfa=yonekle' );
  else :
    $sifre = md5( sha1( md5( $yenisif ) ) );
  $ekle = $db->prepare( "insert into yonetim (kulad,sifre) values(?,?)" ); //insertte set yok

  $ekle->bindParam( 1, $kulad, PDO::PARAM_STR );
  $ekle->bindParam( 2, $sifre, PDO::PARAM_STR );
  $ekle->execute();

  echo '<div class="alert alert-success">
				<strong>Yonetici</strong> başarıyla Eklendi.
				</div>';

  @header( 'refresh:1,url=control.php?sayfa=kulayar' );

  endif;

  endif;


  else :
    ?>
<form action="control.php?sayfa=yonekle" method="post">
  <div class="row text-center">
    <div class="col-lg-4 mx-auto">
      <div class="col-lg-12 mx-auto mt-2">
        <h3 class="text-info">Yonetici Ekle</h3>
      </div>
      <!--***********************-->
      <div class="col-lg-12 mx-auto  mt-2 border">
        <div class="row">
          <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span><strong>Yonetici Adı</strong></span> </div>
          <div class="col-lg-9 p-1">
            <input type="text" name="kulad" class="form-control" />
          </div>
        </div>
      </div>
      <!--***********************--> 
      <!--***********************-->
      
      <div class="col-lg-12 mx-auto  mt-2 border">
        <div class="row">
          <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span><strong>Şifre</strong></span> </div>
          <div class="col-lg-9 mx-auto   p-2">
            <input type="password" name="yenisif" class="form-control" />
          </div>
        </div>
      </div>
      <!--***********************--> 
      <!--***********************-->
      <div class="col-lg-12 mx-auto  mt-2 border">
        <div class="row">
          <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span><strong>Şifre (Tekrar)</strong></span> </div>
          <div class="col-lg-9 mx-auto   p-2">
            <input type="password" name="yenisif2" class="form-control" />
          </div>
        </div>
      </div>
      <!--***********************-->
      <div class="col-lg-12 mx-auto mt-2 border-bottom">
        <input type="submit" name="buton" class="btn btn-info m-1" value="Yonetici Ekle" />
      </div>
    </div>
  </div>
</form>
<?php
endif;

} //KULLANICI AYAR.	

//-------------------------HAKKIMIZDA START-------------------------
function hakayar( $vt ) {
  echo '<div class="row text-center">
			<div class="col-lg-12 border-bottom"><h3 class=" m-3 text-dark">HAKKIMIZDA AYARLARI</h3></div>
			';


  if ( !$_POST ):


    $sonbilgi = self::sorgum( $vt, "select * from hakkimizda", 1 );


  echo '<div class="col-lg-6 mx-auto">
					
					<div class="row  card-bordered p-1 m-1">
						<div style=" padding-top: 20%;font-size: 24px;" class="col-lg-3 border-bottom bg-light">
						Resim 
						</div>
						
						<div class="col-lg-9 border-bottom ">
						<img src="../' . $sonbilgi[ "resim" ] . '"><br>
						<form action="" method="post" enctype="multipart/form-data">
						<input type="file" name="dosya">							
						</div>
						
						<div class="col-lg-3 border-bottom bg-light" style="padding-top = 20% ;font-size: 24px;">
						Başlık	
						</div>
						
						<div class="col-lg-9 border-bottom">
						<input type="text" name="baslik" class="form-control m-2" value="' . $sonbilgi[ "baslik" ] . '"/>						
						</div>
						
						<div class="col-lg-3 bg-light" style=" padding-top: 20%;font-size: 24px;">
						İçerik	
						</div>
						
						<div class="col-lg-9">
						<textarea name="icerik" class="form-control" m-2 rows="8">' . $sonbilgi[ "icerik" ] . '</textarea>
						</div>
						
						<div class="col-lg-12 border-top">
						<input type="submit" name="guncel" class="btn btn-primary m-2">	
						</div>
						</form>
						</div></div>';


  else :


    $baslik = $_POST[ "baslik" ];
  $icerik = $_POST[ "icerik" ];


  if ( @$_FILES[ "dosya" ][ "name" ] != "" ):

    if ( $_FILES[ "dosya" ][ "size" ] < 5 * 1024 * 1024 ):


      $uzantilarim = array( "image/png", "image/jpeg" );
  if ( in_array( $_FILES[ "dosya" ][ "type" ], $uzantilarim ) ):

    $yol = '../img/' . $_FILES[ "dosya" ][ "name" ];

  move_uploaded_file( $_FILES[ "dosya" ][ "tmp_name" ], $yol );


  $resimyolcusu = str_replace( '../', '', $yol );


  endif;
  endif;
  endif;


  if ( @$_FILES[ "dosya" ][ "name" ] != "" ):

    self::sorgum( $vt, "update hakkimizda set baslik='$baslik',icerik='$icerik',resim='$resimyolcusu'", 0 );

  echo '<div class="col-lg-6 mx-auto">
							<div class="alert alert-success" role="alert">
							<strong>Hakkımızda Ayarları</strong> başarıyla güncellendi.
							</div></div>';

  @header( 'refresh:1,url=control.php?sayfa=hakkimiz' );
  else :

    self::sorgum( $vt, "update hakkimizda set baslik='$baslik',icerik='$icerik' ", 0 );

  echo '<div class="col-lg-6 mx-auto">
							<div class="alert alert-success" role="alert">
							<strong>Hakkımızda Ayarları</strong> başarıyla güncellendi.
							</div></div>';

  header( 'refresh:1,url=control.php?sayfa=hakkimiz' );
  endif;


  echo '</div>';

  endif;


} //hakkimizda ayar

//-------------------------HIZMETLER START-------------------------
function hizmetayar( $vt ) {
  echo '<div class="row text-center ">
			<div class="col-lg-12 border-bottom "><h4 class="float-left m-3 text-dark">
			<a href="control.php?sayfa=hizmetekle" 
			class="ti-plus bg-dark p-1 text-white mr-2 mt-3 "></a>
			HIZMET AYAR</h4></div>';


  $hizmetbilgiler = $this->sorgum( $vt, "select * from hizmetler", 2 );
  while ( $son = $hizmetbilgiler->fetch( PDO::FETCH_ASSOC ) ):

    echo '<div class="col-lg-6">
					
					<div class="row card-bordered p-1 m-1 bg-light">
						<div class="col-lg-11 pt-3">
						<h5>' . $son[ "baslik" ] . '</h5>
						
						</div>
						
						<div class="col-lg-12 border-top text-secondary text-left bg-white ">
						' . $son[ "icerik" ] . '
						
						<img src="../' . $son[ "hizresim" ] . '">
						
						<kbd class="bg-light p-2" style="position:auto; float:right">
						
						<a href="control.php?sayfa=hizmetguncelle&id=' . $son[ "id" ] . '" 
						class="ti-reload text-success" style="font-size:20px;"></a> 
						
						<a href="control.php?sayfa=hizmetsil&id=' . $son[ "id" ] . '" 
						class="ti-trash text-danger" style="font-size:20px;"></a>
						
						</kbd>
						</div>
					</div>	
				</div>
					';

  endwhile;
  echo '</div>';

} //hizmet ayar

function hizmetekle( $vt ) {
  echo '<div class="row text-center bg-light ">
			<div class="col-lg-9 border-bottom"><h3 class="float-left m-3 text-info">Hizmet Ayar</h3>
			</div>
			';

  if ( !$_POST ):

    ?>
<div class="col-lg-12 mx-auto mt-2">
  <div class="card card-bordered">
    <div class="card-body">
      <h5 class="title border-bottom">Hizmet Ekleme Formu</h5>
      <form action="" method="post" enctype="multipart/form-data">
        <p class="card-text">
          <input type="file" required="require" name="dosya" />
        </p>
        <input type="text" required="require"  name="baslik" placeholder="Başlık..." class="form-control">
        <textarea name="icerik" required="require"  placeholder="Içeriği giriniz..." rows="5" class="form-control"></textarea>
        <input type="submit" name="buton" value="Hizmet Ekle" class="btn btn-primary mb-1" />
      </form>
      <p class="card-text text-left text-danger border-top"> *İzin verilen formatlar: jpg-png<br>
        *İzin verilen max boyut: 5 MB </p>
    </div>
  </div>
</div>
<?php


else :

  $baslik = htmlspecialchars( $_POST[ "baslik" ] );
$icerik = htmlspecialchars( $_POST[ "icerik" ] );


if ( empty( $baslik ) && empty( $icerik ) ):


  echo '<div class="col-lg-6 mx-auto">
							<div class="alert alert-danger" role="alert">
							<strong>Hizmet Ayarları</strong> bilgiler boş olamaz .
							</div></div>';

//header( "refresh:2,url=control.php?sayfa=hizmetekle" );

else :
  if ( $_FILES[ "dosya" ][ "name" ] == " " ):
    echo '<div class="alert alert-danger mt-1">Dosya Seçilmedi</div>';
  else : //dosyanin boyutu ne kadar ?
    if ( $_FILES[ "dosya" ][ "size" ] > 5 * 1024 * 1024 ):
      echo '<div class="alert alert-danger mt-1">Yüksek dosya boyutu !</div>';
    // header( "refresh:2,url=control.php?sayfa=hizmetekle" );
    else : //dosyanin uzantisi ne ?
      $uzantilarim = array( "image/png", "image/jpeg" );
if ( !in_array( $_FILES[ "dosya" ][ "type" ], $uzantilarim ) ):
  echo '<div class="alert alert-danger mt-1">Lütfen JPEG veya PNG uzantılı dosyaları tercih ediniz!</div>';
// header( "refresh:2,url=control.php?sayfa=hizmetekle" );
else :

  $yol = '../img/hizmet/' . $_FILES[ "dosya" ][ "name" ];

move_uploaded_file( $_FILES[ "dosya" ][ "tmp_name" ], $yol );
// header( "refresh:2,url=control.php?sayfa=hizayar" );
//dosya veritabanina aktariliyor.
$webyol = str_replace( '../', '', $yol );
endif;
endif;
endif;

$this->sorgum( $vt, "insert into hizmetler (baslik,icerik,hizresim) VALUES ('$baslik','$icerik','$webyol')", 0 );
echo '<div class="col-lg-6 mx-auto">
							<div class="alert alert-success" role="alert">
							<strong>Hizmet Ayarlarına </strong> Hizmet Eklendi .
							</div></div>';
header( "refresh:2,url=control.php?sayfa=hizayar" );


endif;



endif;
} //hizmet ekle

function hizmetguncelle( $vt ) {
  echo '<div class="row text-center">
			<div class="col-lg-12 border-bottom"><h3 class="float-left m-3 text-info">Hizmet Ayar</h3>
			</div>
			';


  /*
  	ilk olarak gelen id alincak
  	id ile veritabanina cikilip veriler çekilecek
  	inputlara çekilen veriler yazilacak
  	hidden ile id post icine taşınacak ***
			
  */

  $kayitidsi = $_GET[ "id" ];
  $kayitbilgisi = $this->sorgum( $vt, "SELECT * FROM `hizmetler` WHERE id=$kayitidsi", 1 );

  if ( !$_POST ):

    echo '<div class="col-lg-6 mx-auto ">
					
					<div class="row border border-light p-1 m-2">
						<div class="col-lg-2 p-2 mt-2">
						Başlık
						</div>
						<div class="col-lg-10 p-2">
						<form action="" method="post">
						<input type="text" name="baslik" class="form-control" value="' . $kayitbilgisi[ "baslik" ] . '">
						</div>
						
						<div class="col-lg-12   p-2 ">
						 Içerik
						</div>
						<div class="col-lg-12   p-2 ">
						 <textarea name="icerik" wrap="hard" rows="5" class="form-control">' . $kayitbilgisi[ "icerik" ] . '</textarea>
						</div>
						
						<div class="col-lg-12   p-2 ">
						 <input type="hidden" name="kayitidsi" value="' . $kayitidsi . '">
						 <input type="submit" name="buton" class="btn btn-primary " value="Güncelle">						 
						</form>
						</div>
						
						</div>	
					</div>
				</div>';
  else :

    $baslik = htmlspecialchars( $_POST[ "baslik" ] );
  $icerik = htmlspecialchars( $_POST[ "icerik" ] );
  $kayitidsi = htmlspecialchars( $_POST[ "kayitidsi" ] );

  if ( empty( $baslik ) && empty( $icerik ) ):


    echo '<div class="col-lg-6 mx-auto">
										<div class="alert alert-danger" role="alert">
										<strong>Hizmet Ayarları</strong> bilgiler boş olamaz .
										</div></div>';

  header( "refresh:2,url=control.php?sayfa=hizmetekle" );

  else :

    $this->sorgum( $vt, "update  hizmetler set baslik='$baslik',icerik= '$icerik' where id='$kayitidsi' ", 0 );
  echo '<div class="col-lg-6 mx-auto">
									<div class="alert alert-success" role="alert">
									<strong>Hizmet Ayarları</strong> Hizmet Güncellendi .
									</div></div>';
  header( "refresh:2,url=control.php?sayfa=hizayar" );


  endif;


  endif;

  echo '</div></div></div>';
} //hizmet güncelle

function hizmetsil( $vt ) {

  $silid = $_GET[ "id" ];

  //veritabanindan veriyi silme
  $this->sorgum( $vt, " DELETE FROM hizmetler where id=$silid", 0 );


  echo '<div class="alert alert-warning mt-1">Hizmet silindi!</div>';
  echo '</div></div>';

  header( "refresh:2,url=control.php?sayfa=hizayar" );

} //hizmet sil


}


?>
