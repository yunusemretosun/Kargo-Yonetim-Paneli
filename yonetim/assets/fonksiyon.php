<?php
ob_start();

try {

  $db = new PDO( "mysql:host=localhost;dbname=kurumsal;charset=utf8", "root", "" );
  $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

} catch ( PDOException $e ) {
  die( $e->getMessage() );
}


class yonetim {

  private $veriler = array();
  function sifrele( $veri ) {
    return base64_encode( gzdeflate( gzcompress( serialize( $veri ) ) ) );
  } //sifrele
  function coz( $veri ) {
    return unserialize( gzuncompress( gzinflate( base64_decode( $veri ) ) ) );
  } //coz
  function sorgum( $vt, $sorgu, $tercih = 0 ) {

    $al = $vt->prepare( $sorgu );
    $al->execute();


    if ( $tercih == 1 ):
      return $al->fetch();
    elseif ( $tercih == 2 ):
      return $al;
    endif;

  } //genel sorgu

  function siteayar( $db ) {
    $sonuc = $this->sorgum( $db, "SELECT * FROM ayarlar", 1 );

    if ( $_POST ):
      $title = htmlspecialchars( $_POST[ "title" ] );
    $metatitle = htmlspecialchars( $_POST[ "metatitle" ] );
    $metadesc = htmlspecialchars( $_POST[ "metadesc" ] );
    $metakey = htmlspecialchars( $_POST[ "metakey" ] );
    $metaauthor = htmlspecialchars( $_POST[ "metaauthor" ] );
    $metaowner = htmlspecialchars( $_POST[ "metaowner" ] );
    $metacopy = htmlspecialchars( $_POST[ "metacopy" ] );
    $logoyazisi = htmlspecialchars( $_POST[ "logoyazisi" ] );
    $tweeter = htmlspecialchars( $_POST[ "tweeter" ] );
    $facebook = htmlspecialchars( $_POST[ "facebook" ] );
    $instagram = htmlspecialchars( $_POST[ "instagram" ] );
    $telno = htmlspecialchars( $_POST[ "telno" ] );
    $address = htmlspecialchars( $_POST[ "address" ] );
    $mailaddress = htmlspecialchars( $_POST[ "mailaddress" ] );
    $slogan = htmlspecialchars( $_POST[ "slogan" ] );
    $referansbaslik = htmlspecialchars( $_POST[ "referansbaslik" ] );
    $filobaslik = htmlspecialchars( $_POST[ "filobaslik" ] );
    $iletisimbaslik = htmlspecialchars( $_POST[ "iletisimbaslik" ] );
    $yorumbaslik = htmlspecialchars( $_POST[ "yorumbaslik" ] );
    $mesajtercih = htmlspecialchars( $_POST[ "mesajtercih" ] );
    $haritabilgi = htmlspecialchars( $_POST[ "haritabilgi" ] );

    $guncelleme = $db->prepare( 'UPDATE ayarlar SET title=?,metatitle=?,metadesc=?,metakey=?,
			metaauthor=?,metaowner=?,metacopy=?,logoyazisi=?,tweeter=?,facebook=?,instagram=?,
	telno=?,address=?,mailaddress=?,slogan=?,referansbaslik=?,filobaslik=?,iletisimbaslik=?,yorumbaslik=?,mesajtercih=?,haritabilgi=?' );

    $guncelleme->bindParam( 1, $title, PDO::PARAM_STR );
    $guncelleme->bindParam( 2, $metatitle, PDO::PARAM_STR );
    $guncelleme->bindParam( 3, $metadesc, PDO::PARAM_STR );
    $guncelleme->bindParam( 4, $metakey, PDO::PARAM_STR );
    $guncelleme->bindParam( 5, $metaauthor, PDO::PARAM_STR );
    $guncelleme->bindParam( 6, $metaowner, PDO::PARAM_STR );
    $guncelleme->bindParam( 7, $metacopy, PDO::PARAM_STR );
    $guncelleme->bindParam( 8, $logoyazisi, PDO::PARAM_STR );
    $guncelleme->bindParam( 9, $tweeter, PDO::PARAM_STR );
    $guncelleme->bindParam( 10, $facebook, PDO::PARAM_STR );
    $guncelleme->bindParam( 11, $instagram, PDO::PARAM_STR );
    $guncelleme->bindParam( 12, $telno, PDO::PARAM_STR );
    $guncelleme->bindParam( 13, $address, PDO::PARAM_STR );
    $guncelleme->bindParam( 14, $mailaddress, PDO::PARAM_STR );
    $guncelleme->bindParam( 15, $slogan, PDO::PARAM_STR );
    $guncelleme->bindParam( 16, $referansbaslik, PDO::PARAM_STR );
    $guncelleme->bindParam( 17, $filobaslik, PDO::PARAM_STR );
    $guncelleme->bindParam( 18, $iletisimbaslik, PDO::PARAM_STR );
    $guncelleme->bindParam( 19, $yorumbaslik, PDO::PARAM_STR );
    $guncelleme->bindParam( 20, $mesajtercih, PDO::PARAM_INT );
    $guncelleme->bindParam( 21, $haritabilgi, PDO::PARAM_STR );
    $guncelleme->execute();

    echo '<div class="alert alert-success" role="alert">
			<strong>Site Ayarları</strong> başarıyla güncellendi.
			</div>';

    @header( 'refresh:1,url=control.php?sayfa=siteayar' );

    else :
      ?>
<form action="control.php?sayfa=siteayar" method="post">
  <div class="row">
    <div class="col-lg-7 mx-auto mt-2">
      <h3 class="text-info">Site Ayarları</h3>
    </div>
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Title</span> </div>
        <div class="col-lg-9 p-1">
          <input type="text" name="title" class="form-control" value="<?php echo $sonuc["title"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto border-right pt-3 text-left"> <span>Meta Title</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="metatitle" class="form-control" value="<?php echo $sonuc["metatitle"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Sayfa Aciklama</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="metadesc" class="form-control" value="<?php echo $sonuc["metadesc"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Anahtar Kelimler</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="metakey" class="form-control"  value="<?php echo $sonuc["metakey"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Yapımcı</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="metaauthor" class="form-control"  value="<?php echo $sonuc["metaauthor"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Firma</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="metaowner" class="form-control"  value="<?php echo $sonuc["metaowner"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Copyright</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="metacopy" class="form-control"  value="<?php echo $sonuc["metacopy"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Logo Yazisi</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="logoyazisi" class="form-control" value="<?php echo $sonuc["logoyazisi"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Twitter</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="tweeter" class="form-control"  value="<?php echo $sonuc["tweeter"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Facebook</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="facebook" class="form-control"  value="<?php echo $sonuc["facebook"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Instagram</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="instagram" class="form-control" value="<?php echo $sonuc["instagram"]; ?>"/>
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Tel No</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="telno" class="form-control" value="<?php echo $sonuc["telno"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Adres</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="address" class="form-control" value="<?php echo $sonuc["address"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Mail Adres</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="mailaddress" class="form-control" value="<?php echo $sonuc["mailaddress"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Slogan</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="slogan" class="form-control" value="<?php echo $sonuc["slogan"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Referans Sayfa Baslik</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="referansbaslik" class="form-control" value="<?php echo $sonuc["referansbaslik"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Filo Sayfa Baslik</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="filobaslik" class="form-control" value="<?php echo $sonuc["filobaslik"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Iletisim Sayfa Baslik</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="iletisimbaslik" class="form-control" value="<?php echo $sonuc["iletisimbaslik"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Harita Bilgisi</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="haritabilgi" class="form-control" value="<?php echo $sonuc["haritabilgi"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-1 text-left"> <span>Mesaj Tercih</span> </div>
        <div class="col-lg-9 mx-auto   p-1">
			<div class="row">
			<div class="col-lg-4">
				Sadece Mail: 
		  		<input type="radio" name="mesajtercih" value="1" <?php echo($sonuc["mesajtercih"]==1) ? 
					 "checked='checked'":""; ?>/>	
			</div>
			<div class="col-lg-4">
				Sadece Mesaj: 
		  		<input type="radio" name="mesajtercih" value="2" <?php echo($sonuc["mesajtercih"]==2) ? 
					 "checked='checked'":""; ?>/>	
			</div>
			<div class="col-lg-4">
				Hem Mail Hem Mesaj: 
		  		<input type="radio" name="mesajtercih" value="3" <?php echo($sonuc["mesajtercih"]==3) ? 
					 "checked='checked'":""; ?>/>		
			</div>
			
			</div>
			
        </div>
      </div>
    </div>
    <!--***********************--> 
    <!--***********************-->
    <div class="col-lg-7 mx-auto  mt-2 border">
      <div class="row">
        <div class="col-lg-3 mx-auto  border-right pt-3 text-left"> <span>Yorum Sayfa Baslik</span> </div>
        <div class="col-lg-9 mx-auto   p-2">
          <input type="text" name="yorumbaslik" class="form-control" value="<?php echo $sonuc["yorumbaslik"]; ?>" />
        </div>
      </div>
    </div>
    <!--***********************-->
    <div class="col-lg-7 mx-auto mt-2 border-bottom">
      <input type="submit" name="buton" class="btn btn-info m-1" value="Güncelle" />
    </div>
  </div>
</form>
<?php
endif;

} //site ayar

function get_username( $vt ) {
  $cookid = $_COOKIE[ "kulbilgi" ];
  $cozulen = $this->coz( $cookid );
  $getir = $this->sorgum( $vt, "select * from yonetim where id=$cozulen", 1 );

  $username = $getir[ "kulad" ];

  return $username; //


} //kullanici adi al

function giriskontrol( $kulad, $sifre, $vt ) {

  $sifrelihal = md5( sha1( md5( $sifre ) ) );

  $sor = $vt->prepare( "select * from yonetim where kulad='$kulad' and sifre='$sifrelihal'" );
  $sor->execute();


  if ( $sor->rowCount() == 0 ):

    echo '
				<div class="container-fluid bg-white">
				<div class="alert alert-blcak border border-dark mt-5 mx-auto col-md-5 p-3 text-danger font-14 font-weight-bold">
				<img  src="assets/images/a" class="mr-3 " />Bilgiler Hatalı</div>
				</div>';
  header( "refresh:2,url=index.php" );

  else :
    $gelendeger = $sor->fetch();
  $sor = $vt->prepare( "update yonetim set aktif=1 where kulad='$kulad' and sifre='$sifrelihal'" );
  $sor->execute();

  echo '
				<div class="container-fluid bg-white">
				<div class="alert alert-blcak border border-dark mt-5 mx-auto col-md-5 p-3 text-success font-14 font-weight-bold">
				<img  src="assets/images/a" class="mr-3 " />Giriş Yapılıyor</div>
				</div>';

  header( "refresh:2,url=control.php" );

  $id = $this->sifrele( $gelendeger[ "id" ] );
  setcookie( "kulbilgi", $id, time() + 60 * 60 * 24 );


  endif;

} //giris kontrol

function cikis( $vt ) {

  $cookid = $_COOKIE[ "kulbilgi" ];
  $cozulen = $this->coz( $cookid );

  $this->sorgum( $vt, "update yonetim set aktif=0 where id=$cozulen", 0 );

  setcookie( "kulbilgi", $cookid, time() - 5 );

  echo '
				<div class="container-fluid bg-white">
				<div class="alert alert-blcak border border-dark mt-5 mx-auto col-md-5 p-3 text-danger font-14 font-weight-bold">
				<img  src="assets/images/a" class="mr-3 " />Çıkış Yapılıyor</div>
				</div>';
  header( "refresh:2,url=index.php" );

} //çıkış


function cookiekontrol( $sayfa ) {

  if ( isset( $_COOKIE[ "kulbilgi" ] ) ):

    if ( $sayfa == "ind" ): header( "Location:control.php" );
  endif; //eğer sayfa indexte ve cookie varsa sayfayı control phpye yönlendir

  else :

    if ( $sayfa == "cot" ): header( "Location:index.php" ); endif; //eğer sayfa controlde ve cookie yoksa sayfayı index phpye yönlendir

  endif;

}


//-------------------------INTRO START-------------------------
function introayar( $vt ) {
  echo '<div class="row text-center">
			<div class="col-lg-12 border-bottom "><h4 class="float-left mt-3 text-dark mb-2">
			<a href="control.php?sayfa=introresimekle" 
			class="ti-plus bg-dark p-1 text-white mr-2 mt-3 "></a>
			INTRO RESİMLERİ</h4></div>	
			';

  $introbilgiler = $this->sorgum( $vt, "select * from intro", 2 );
  while ( $son = $introbilgiler->fetch( PDO::FETCH_ASSOC ) ):

    echo '<div class="col-lg-4">
					
					<div class="row p-1 m-1">
						<div class="col-lg-12">
						<img src="../' . $son[ "resimyolu" ] . '">
						<kbd class="bg-white p-2" style="position:absolute; bottom:10px; right:10px;">
						
						<a href="control.php?sayfa=introresimguncelle&id=' . $son[ "id" ] . '" 
						class="ti-reload m-2 text-success" style="font-size:20px;"></a> 
						
						<a href="control.php?sayfa=introresimsil&id=' . $son[ "id" ] . '" 
						class="ti-trash m-2 text-danger" style="font-size:20px;"></a> 
						</kbd>
						
						</div>
					</div>	
				</div>
					';

  endwhile;
  echo '</div>';

} //intro ayar

function introresimekle( $vt ) {
  echo '<div class="row text-center">
			<div class="col-lg-12">
			';

  if ( $_POST ):
    //dosya bos mu ?
    if ( $_FILES[ "dosya" ][ "name" ] == " " ):
      echo '<div class="alert alert-danger mt-1">Dosya Seçilmedi</div>';
    else : //dosyanin boyutu ne kadar ?
      if ( $_FILES[ "dosya" ][ "size" ] > 5 * 1024 * 1024 ):
        echo '<div class="alert alert-danger mt-1">Yüksek dosya boyutu !</div>';
  header( "refresh:2,url=control.php?sayfa=introresimekle" );
  else : //dosyanin uzantisi ne ?
    $uzantilarim = array( "image/png", "image/jpeg" );
  if ( !in_array( $_FILES[ "dosya" ][ "type" ], $uzantilarim ) ):
    echo '<div class="alert alert-danger mt-1">Lütfen JPEG veya PNG uzantılı dosyaları tercih ediniz!</div>';
  header( "refresh:2,url=control.php?sayfa=introresimekle" );
  else :

    $yol = '../img/carousel/' . $_FILES[ "dosya" ][ "name" ];

  move_uploaded_file( $_FILES[ "dosya" ][ "tmp_name" ], $yol );
  echo '<div class="alert alert-success mt-1">Dosya kaydı başarılı.</div>';
  header( "refresh:2,url=control.php?sayfa=introayar" );
  //dosya veritabanina aktariliyor.
  $webyol = str_replace( '../', '', $yol );
  $kayit = $this->sorgum( $vt, "INSERT INTO intro (resimyolu) VALUES ('$webyol') ", 0 );
  endif;
  endif;
  endif;


  else :
    ?>
<div class="col-lg-4 mx-auto mt-2">
  <div class="card card-bordered">
    <div class="card-body">
      <h5 class="title border-bottom">Resim Yükleme Formu</h5>
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
} //intro resim ekleme

function introsil( $vt ) {
  $introid = $_GET[ "id" ];
  $verial = $this->sorgum( $vt, " SELECT * FROM intro where id=$introid", 1 );
  echo '<div class="row text-center">
			<div class="col-lg-12">
			';
  //dosyadan veriyi silme
  unlink( "../" . $verial[ "resimyolu" ] );
  //veritabanindan veriyi silme
  $this->sorgum( $vt, " DELETE FROM intro where id=$introid", 0 );


  echo '<div class="alert alert-warning mt-1">Resmi sildiniz!</div>';
  echo '</div></div>';

  header( "refresh:2,url=control.php?sayfa=introayar" );
} //emin misin modelbox eklenecek

function introresimguncelle( $vt ) {
  $gelenintroid = $_GET[ "id" ];

  echo '<div class="row text-center">
			<div class="col-lg-12">
			';

  if ( $_POST ):
    //dosya bos mu ?


    $formdangelenid = $_POST[ "introid" ];

  if ( $_FILES[ "dosya" ][ "name" ] == " " ):
    echo '<div class="alert alert-danger mt-1">Dosya Seçilmedi</div>';
  else : //dosyanin boyutu ne kadar ?
    if ( $_FILES[ "dosya" ][ "size" ] > 5 * 1024 * 1024 ):
      echo '<div class="alert alert-danger mt-1">Yüksek dosya boyutu !</div>';
  header( "refresh:2,url=control.php?sayfa=introayar" );
  else : //dosyanin uzantisi ne ?
    $uzantilarim = array( "image/png", "image/jpeg" );
  if ( !in_array( $_FILES[ "dosya" ][ "type" ], $uzantilarim ) ):
    echo '<div class="alert alert-danger mt-1">Lütfen JPEG veya PNG uzantılı dosyaları tercih ediniz!</div>';
  header( "refresh:2,url=control.php?sayfa=introayar" );
  else :

    //mevcut dosya yolunu silip yerine yeni dosya yolunu ekleyecegiz.	

    $resimyolunabak = $this->sorgum( $vt, "select * from intro where id='$gelenintroid'", 1 );

  //mevcut veri çekildi ve silindi.
  $dbgelenyolabak = "../" . $resimyolunabak[ "resimyolu" ];
  unlink( $dbgelenyolabak );


  $yeniyol = '../img/carousel/' . $_FILES[ "dosya" ][ "name" ];

  move_uploaded_file( $_FILES[ "dosya" ][ "tmp_name" ], $yeniyol );

  $yeniyol2 = str_replace( '../', '', $yeniyol );
  $kayit = $this->sorgum( $vt, "update intro set resimyolu='$yeniyol2' where id='$gelenintroid'", 0 );

  echo '<div class="alert alert-success mt-1">Dosya kaydı başarılı.</div>';
  header( "refresh:2,url=control.php?sayfa=introayar" );
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
          <input type="hidden" name="introid" value="<?php echo $gelenintroid; ?>"/>
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
} //güncelleme islemleri

//-------------------------ARAÇ FİLO START-------------------------
function filoayar( $vt ) {
  echo '<div class="row text-center">
			<div class="col-lg-12 border-bottom"><h4 class="float-left m-3 text-dark">
			<a href="control.php?sayfa=filoresimekle" 
			class="p-1 ti-plus bg-dark text-white mr-2 mt-3 "></a>FILO AYAR</h4></div>
			';

  $filobilgiler = $this->sorgum( $vt, "select * from filomuz", 2 );
  while ( $son = $filobilgiler->fetch( PDO::FETCH_ASSOC ) ):

    echo '<div class="col-lg-4">
					
					<div class="row border border-light col-lg-12 p-1 m-1">
						<div class="col-lg-12">
						<img src="../' . $son[ "rimg" ] . '">
						<kbd class="bg-white p-2" style="position:absolute; bottom:10px; right:10px;">
						<a href="control.php?sayfa=filoresimguncelle&id=' . $son[ "id" ] . '" 
						class="ti-reload m-2 text-success" style="font-size:20px;"></a> 
						
						<a href="control.php?sayfa=filoresimsil&id=' . $son[ "id" ] . '" 
						class="ti-trash m-2 text-danger" style="font-size:20px;"></a> 
						
						</kbd>
					
						
						</div>
					</div>	
				</div>
					';

  endwhile;
  echo '</div>';

} //filo ayar

function filoresimekle( $vt ) {
  echo '<div class="row text-center">
			<div class="col-lg-12">
			';

  if ( $_POST ):
    //dosya bos mu ?
    if ( $_FILES[ "dosya" ][ "name" ] == " " ):
      echo '<div class="alert alert-danger mt-1">Dosya Seçilmedi</div>';
    else : //dosyanin boyutu ne kadar ?
      if ( $_FILES[ "dosya" ][ "size" ] > 5 * 1024 * 1024 ):
        echo '<div class="alert alert-danger mt-1">Yüksek dosya boyutu !</div>';
  header( "refresh:2,url=control.php?sayfa=filoresimekle" );
  else : //dosyanin uzantisi ne ?
    $uzantilarim = array( "image/png", "image/jpeg" );
  if ( !in_array( $_FILES[ "dosya" ][ "type" ], $uzantilarim ) ):
    echo '<div class="alert alert-danger mt-1">Lütfen JPEG veya PNG uzantılı dosyaları tercih ediniz!</div>';
  header( "refresh:2,url=control.php?sayfa=filoresimekle" );
  else :

    $yol = '../img/filo/' . $_FILES[ "dosya" ][ "name" ];

  move_uploaded_file( $_FILES[ "dosya" ][ "tmp_name" ], $yol );
  echo '<div class="alert alert-success mt-1">Dosya kaydı başarılı.</div>';
  header( "refresh:2,url=control.php?sayfa=filoayar" );
  //dosya veritabanina aktariliyor.
  $webyol = str_replace( '../', '', $yol );
  $kayit = $this->sorgum( $vt, "INSERT INTO filomuz (rimg) VALUES ('$webyol') ", 0 );
  endif;
  endif;
  endif;


  else :
    ?>
<div class="col-lg-4 mx-auto mt-2">
  <div class="card card-bordered">
    <div class="card-body">
      <h5 class="title border-bottom">Resim Yükleme Formu</h5>
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
} //filo resim ekleme

function filosil( $vt ) {
  $filoid = $_GET[ "id" ];
  $verial = $this->sorgum( $vt, " SELECT * FROM filomuz where id=$filoid", 1 );
  echo '<div class="row text-center">
			<div class="col-lg-12">
			';
  //dosyadan veriyi silme
  unlink( "../" . $verial[ "rimg" ] );
  //veritabanindan veriyi silme
  $this->sorgum( $vt, " DELETE FROM filomuz where id=$filoid", 0 );


  echo '<div class="alert alert-warning mt-1">Resmi sildiniz!</div>';
  echo '</div></div>';

  header( "refresh:2,url=control.php?sayfa=filoayar" );
} //emin misin modelbox eklenecek

function filoresimguncelle( $vt ) {
  $gelenfiloid = $_GET[ "id" ];

  echo '<div class="row text-center">
			<div class="col-lg-12">
			';

  if ( $_POST ):
    //dosya bos mu ?


    $formdangelenid = $_POST[ "filoid" ];

  if ( $_FILES[ "dosya" ][ "name" ] == " " ):
    echo '<div class="alert alert-danger mt-1">Dosya Seçilmedi</div>';
  else : //dosyanin boyutu ne kadar ?
    if ( $_FILES[ "dosya" ][ "size" ] > 5 * 1024 * 1024 ):
      echo '<div class="alert alert-danger mt-1">Yüksek dosya boyutu !</div>';
  header( "refresh:2,url=control.php?sayfa=filoayar" );
  else : //dosyanin uzantisi ne ?
    $uzantilarim = array( "image/png", "image/jpeg" );
  if ( !in_array( $_FILES[ "dosya" ][ "type" ], $uzantilarim ) ):
    echo '<div class="alert alert-danger mt-1">Lütfen JPEG veya PNG uzantılı dosyaları tercih ediniz!</div>';
  header( "refresh:2,url=control.php?sayfa=filoid" );
  else :

    //mevcut dosya yolunu silip yerine yeni dosya yolunu ekleyecegiz.	

    $resimyolunabak = $this->sorgum( $vt, "select * from filomuz where id='$gelenfiloid'", 1 );

  //mevcut veri çekildi ve silindi.
  $dbgelenyolabak = "../" . $resimyolunabak[ "rimg" ];
  unlink( $dbgelenyolabak );


  $yeniyol = '../img/filo/' . $_FILES[ "dosya" ][ "name" ];

  move_uploaded_file( $_FILES[ "dosya" ][ "tmp_name" ], $yeniyol );

  $yeniyol2 = str_replace( '../', '', $yeniyol );
  $kayit = $this->sorgum( $vt, "update filomuz set rimg='$yeniyol2' where id='$gelenfiloid'", 0 );

  echo '<div class="alert alert-success mt-1">Dosya kaydı başarılı.</div>';
  header( "refresh:2,url=control.php?sayfa=filoayar" );
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
          <input type="hidden" name="filoid" value="<?php echo $gelenfiloid; ?>"/>
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
} //filo güncelleme islemleri

//-------------------------Mail START-------------------------

private function mailgetir( $vt, $veriler ) {
  $sor = $vt->prepare( "select * from $veriler[0] where durum = $veriler[1]" );
  $sor->execute();
  return $sor;
} // mail sorgusu
function gelenmesajlar( $vt ) {

  echo '<div class="row">
				<div class="col-lg-12 mt-2">
					<div class="card">
						<div class="card-body">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							
						<li class="nav-item">
		<a class="nav-link active" id="gelen-tab" data-toggle="tab" href="#gelen" 
			role="tab" aria-control="gelen" aria-selected="true"><kbd>' . $this->mailgetir( $vt, array( "gelenmail", 0 ) )->rowCount() . '</kbd>Gelen Mesajlar</a>
						</li>
						
						<li class="nav-item">
		<a class="nav-link" id="okunmus-tab" data-toggle="tab" href="#okunmus" 
			role="tab" aria-control="okunmus" aria-selected="false"><kbd>' . $this->mailgetir( $vt, array( "gelenmail", 1 ) )->rowCount() . '</kbd>Okunmuş Mesajlar</a>
						</li>
						
						<li class="nav-item">
		<a class="nav-link" id="arsiv-tab" data-toggle="tab" href="#arsiv" 
			role="tab" aria-control="arsiv" aria-selected="false"><kbd>' . $this->mailgetir( $vt, array( "gelenmail", 2 ) )->rowCount() . '</kbd>Arşivlenmiş Mesajlar</a>
						</li>
						
						</ul>	
					<div class="tab-content mt-3 id="benimTab">
						
						<div class="tab-pane fade show active" id="gelen" role="tabpanel" aria-labelledby="gelen-tab">';
  $sonuc = $this->mailgetir( $vt, array( "gelenmail", 0 ) );
  if ( $sonuc->rowCount() != 0 ):

    while ( $sonucson = $sonuc->fetch( PDO::FETCH_ASSOC ) ):
      echo '<div class="row">
						<div class="col-lg-12 bg-light mt-2 font-weight-bold" >
											<div class="row border-bottom">
											
												<div class="col-lg-1 p-1">Ad & Ünvan:</div>
												<div class="col-lg-2 p-1 text-primary">' . $sonucson[ "ad" ] . '</div>
												<div class="col-lg-1 p-1">Mail Adresi:</div>
												<div class="col-lg-2 p-1 text-primary">' . $sonucson[ "mailadres" ] . '</div>
												<div class="col-lg-1 p-1">Konu:</div>
												<div class="col-lg-1 p-1 text-primary">' . $sonucson[ "konu" ] . '</div>
												<div class="col-lg-1 p-1">Tarih:</div>
												<div class="col-lg-2 p-1 text-primary">' . $sonucson[ "zaman" ] . '</div>
												
							<a href="control.php?sayfa=mesajoku&id=' . $sonucson[ "id" ] . '"<i class="fa fa-folder-open border-right pr-2 text-dark" style="font-size:20px;"></i></a>
							<a href="control.php?sayfa=mesajarsivle&id=' . $sonucson[ "id" ] . '"<i class="fa fa-share-square border-right pr-2 text-dark" style="font-size:20px;"></i></a>
							<a href="control.php?sayfa=mesajsil&id=' . $sonucson[ "id" ] . '"<i class="fa fa-close pr-2 text-dark" style="font-size:20px;"></i></a>
													
												
												</div>		
												</div>		
												</div>		
									
									';
  endwhile;

  else :

    echo '<div class="alert alert-info">Gelen Mesaj Yok</div>';

  endif;

  echo '</div>';

  echo '<div class="tab-pane fade show " id="okunmus" role="tabpanel" aria-labelledby="okunmus-tab">';

  $sonuc = $this->mailgetir( $vt, array( "gelenmail", 1 ) );
  if ( $sonuc->rowCount() != 0 ):

    while ( $sonucson = $sonuc->fetch( PDO::FETCH_ASSOC ) ):
      echo '<div class="row">
						<div class="col-lg-12 bg-light mt-2 font-weight-bold" >
											<div class="row border-bottom">
											
												<div class="col-lg-1 p-1">Ad & Ünvan:</div>
												<div class="col-lg-2 p-1 text-primary">' . $sonucson[ "ad" ] . '</div>
												<div class="col-lg-1 p-1">Mail Adresi:</div>
												<div class="col-lg-2 p-1 text-primary">' . $sonucson[ "mailadres" ] . '</div>
												<div class="col-lg-1 p-1">Konu:</div>
												<div class="col-lg-1 p-1 text-primary">' . $sonucson[ "konu" ] . '</div>
												<div class="col-lg-1 p-1">Tarih:</div>
												<div class="col-lg-2 p-1 text-primary">' . $sonucson[ "zaman" ] . '</div>
												
							<a href="control.php?sayfa=mesajoku&id=' . $sonucson[ "id" ] . '"<i class="fa fa-folder-open border-right pr-2 text-dark" style="font-size:20px;"></i></a>
							<a href="control.php?sayfa=mesajarsivle&id=' . $sonucson[ "id" ] . '"<i class="fa fa-share-square border-right pr-2 text-dark" style="font-size:20px;"></i></a>
							<a href="control.php?sayfa=mesajsil&id=' . $sonucson[ "id" ] . '"<i class="fa fa-close pr-2 text-dark" style="font-size:20px;"></i></a>
													
												
												</div>		
												</div>		
												</div>		
									
									';
  endwhile;

  else :

    echo '<div class="alert alert-info">Okunmuş Mesaj Yok</div>';

  endif;

  echo '</div>';

  echo '<div class="tab-pane fade show " id="arsiv" role="tabpanel" aria-labelledby="arsiv-tab">';
  $sonuc = $this->mailgetir( $vt, array( "gelenmail", 2 ) );
  if ( $sonuc->rowCount() != 0 ):

    while ( $sonucson = $sonuc->fetch( PDO::FETCH_ASSOC ) ):
      echo '<div class="row">
						<div class="col-lg-12 bg-light mt-2 font-weight-bold" >
											<div class="row border-bottom">
											
												<div class="col-lg-1 p-1">Ad & Ünvan:</div>
												<div class="col-lg-2 p-1 text-primary">' . $sonucson[ "ad" ] . '</div>
												<div class="col-lg-1 p-1">Mail Adresi:</div>
												<div class="col-lg-2 p-1 text-primary">' . $sonucson[ "mailadres" ] . '</div>
												<div class="col-lg-1 p-1">Konu:</div>
												<div class="col-lg-1 p-1 text-primary">' . $sonucson[ "konu" ] . '</div>
												<div class="col-lg-1 p-1">Tarih:</div>
												<div class="col-lg-2 p-1 text-primary">' . $sonucson[ "zaman" ] . '</div>
												
							<a href="control.php?sayfa=mesajoku&id=' . $sonucson[ "id" ] . '"<i class="fa fa-folder-open border-right pr-2 text-dark" style="font-size:20px;"></i></a>
							<a href="control.php?sayfa=mesajarsivle&id=' . $sonucson[ "id" ] . '"<i class="fa fa-share-square border-right pr-2 text-dark" style="font-size:20px;"></i></a>
							<a href="control.php?sayfa=mesajsil&id=' . $sonucson[ "id" ] . '"<i class="fa fa-close pr-2 text-dark" style="font-size:20px;"></i></a>
													
												
												</div>		
												</div>		
												</div>		
									
									';
  endwhile;

  else :

    echo '<div class="alert alert-info">Arşivlenmiş Mesaj Yok</div>';

  endif;


  echo '</div>';


  echo '			</div></div></div></div></div>';
} //gelen mesajlar iskelet

function mesajdetay( $vt, $id ) {

  $mesajbilgi = $this->sorgum( $vt, "select * from gelenmail where id=$id", 1 );

  echo '<div class="row">
				<div class="col-lg-12 bg-light mt-2 font-weight-bold" >
									<div class="row border-bottom">
									
										<div class="col-lg-1 p-1">Ad & Ünvan:</div>
										<div class="col-lg-2 p-1 text-primary">' . $mesajbilgi[ "ad" ] . '</div>
										<div class="col-lg-1 p-1">Mail Adresi:</div>
										<div class="col-lg-2 p-1 text-primary">' . $mesajbilgi[ "mailadres" ] . '</div>
										<div class="col-lg-1 p-1">Konu:</div>
										<div class="col-lg-1 p-1 text-primary">' . $mesajbilgi[ "konu" ] . '</div>
										<div class="col-lg-1 p-1">Tarih:</div>
										<div class="col-lg-2 p-1 text-primary">' . $mesajbilgi[ "zaman" ] . '</div>
										
				
					<a href="control.php?sayfa=mesajarsivle&id=' . $mesajbilgi[ "id" ] . '"<i class="fa fa-share-square border-right pr-2 text-dark" style="font-size:20px;"></i></a>
					<a href="control.php?sayfa=mesajsil&id=' . $mesajbilgi[ "id" ] . '"<i class="fa fa-close pr-2 text-dark" style="font-size:20px;"></i></a>
											
										
										</div>		
												<div class="row">
												<div class="col-lg-2 p-1 text-primary">
												<strong class="text text-danger">Mail Içeriği : </strong>
												' . $mesajbilgi[ "mesaj" ] . '
												</div>
												
												</div>
										</div>		
										</div>
										</div>
							
							';


  $this->sorgum( $vt, "update gelenmail set durum = 1 where id=$id", 0 );


}

function mesajarsivle( $vt, $id ) {


  echo '	
										<div class="row m-2">
											<div class="col-lg-12 p-1 text-primary">	
											<div class="alert alert-info"> Mesaj Arşivlendi</div>
											</div>
										</div></div>';

  $this->sorgum( $vt, "update gelenmail set durum=2 where id=$id", 0 );

  header( "refresh:2,url=control.php?sayfa=gelenmesaj" );

}

function mesajsil( $vt, $id ) {


  echo '	
		<div class="row m-2">
			<div class="col-lg-12 p-1 text-primary">	
			<div class="alert alert-warning"> Mesaj Silindi</div>
			</div>
		</div></div>';

  $this->sorgum( $vt, "delete from gelenmail  where id=$id", 0 );

  header( "refresh:2,url=control.php?sayfa=gelenmesaj" );

}


};


?>
