<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require('src/Exception.php');
require('src/PHPMailer.php');
require('src/SMTP.php');


$db = new PDO( "mysql:host=localhost;dbname=kurumsal;charset=utf8", "root", "" );
$ayarlar = $db->prepare("select * from gelenmailayar");
$ayarlar->execute();
$sonuc = $ayarlar->fetch();
//<!---------------------------------->
$ayarlar2 = $db->prepare("select mesajtercih from ayarlar");
$ayarlar2->execute();	
$tercihgeldi = $ayarlar2->fetch();



$mail = new PHPMailer(true);
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->CharSet = 'UTF-8';
$mail->Host = $sonuc["host"] ;
$mail->SMTPAuth = true;
$mail->Username = $sonuc["mailadres"];
$mail->Password = $sonuc["sifre"];
$mail->SMTPSecure = "tls";
$mail->Port = $sonuc["port"];
$mail->isHTML(true);
$mail->addAddress($sonuc["alicimail"]);

if($_POST):
	$isim = htmlspecialchars(strip_tags($_POST["isim"]));
	$mailadres = htmlspecialchars(strip_tags($_POST["mail"]));
	$konu = htmlspecialchars(strip_tags($_POST["konu"]));
	$mesaj = htmlspecialchars(strip_tags($_POST["mesaj"]));
	
switch($tercihgeldi["mesajtercih"]):
case 1://Sadece Mail ama nolur nolmaz diye veritabanina kayit.
	$mail->setFrom($mailadres,$isim);
	$mail->addReplyTo($mailadres,"Yanit");
	$mail->Subject=$konu;
	$mail->Body=$mesaj;
	if($mail->send()):
	echo '<div class="alert alert-success text-center mx-auto">Mailiniz başarıyla tarafımıza ulaştırılmıştır.<br><strong>TEŞEKKÜR EDERIZ</strong></div>';
	else:
	//bu kisim bir hata olursa maili veritabanina kayit etmeye yarar 
	//. Hatalar host , anlik kesinti gibi seyler olabilr.
	

	$zaman = date('d.m.Y')."/".date("H:i");
	$kaydet = $db->prepare("insert into gelenmail (ad,mailadres,konu,mesaj,zaman) values(?,?,?,?,?)");
	$kaydet->bindParam(1,$isim,PDO::PARAM_STR);
	$kaydet->bindParam(2,$mailadres,PDO::PARAM_STR);
	$kaydet->bindParam(3,$konu,PDO::PARAM_STR);
	$kaydet->bindParam(4,$mesaj,PDO::PARAM_STR);
	$kaydet->bindParam(5,$zaman,PDO::PARAM_STR);
	$kaydet->execute();

	echo '<div class="alert alert-success text-center mx-auto">Mailiniz başarıyla tarafımıza ulaştırılmıştır.<br><strong>TEŞEKKÜR EDERIZ</strong></div>';
	endif;
	
break;

case 3://Hem Mesaj Hem Veritabanina kayit
	$mail->setFrom($mailadres,$isim);
	$mail->addReplyTo($mailadres,"Yanit");
	$mail->Subject=$konu;
	$mail->Body=$mesaj;
	$mail->send();
	
	$zaman = date('d.m.Y')."/".date("H:i");
	$kaydet = $db->prepare("insert into gelenmail (ad,mailadres,konu,mesaj,zaman) values(?,?,?,?,?)");
	$kaydet->bindParam(1,$isim,PDO::PARAM_STR);
	$kaydet->bindParam(2,$mailadres,PDO::PARAM_STR);
	$kaydet->bindParam(3,$konu,PDO::PARAM_STR);
	$kaydet->bindParam(4,$mesaj,PDO::PARAM_STR);
	$kaydet->bindParam(5,$zaman,PDO::PARAM_STR);
	$kaydet->execute();

	echo '<div class="alert alert-success text-center mx-auto">Mailiniz başarıyla tarafımıza ulaştırılmıştır.<br><strong>TEŞEKKÜR EDERIZ</strong></div>';
break;

case 2:	//Sadece Veri Tabanina kayit.
	$zaman = date('d.m.Y')."/".date("H:i");
	$kaydet = $db->prepare("insert into gelenmail (ad,mailadres,konu,mesaj,zaman) values(?,?,?,?,?)");
	$kaydet->bindParam(1,$isim,PDO::PARAM_STR);
	$kaydet->bindParam(2,$mailadres,PDO::PARAM_STR);
	$kaydet->bindParam(3,$konu,PDO::PARAM_STR);
	$kaydet->bindParam(4,$mesaj,PDO::PARAM_STR);
	$kaydet->bindParam(5,$zaman,PDO::PARAM_STR);
	$kaydet->execute();

	echo '<div class="alert alert-success text-center mx-auto">Mailiniz başarıyla tarafımıza ulaştırılmıştır.<br><strong>TEŞEKKÜR EDERIZ</strong></div>';
break;

endswitch;




endif;

?>