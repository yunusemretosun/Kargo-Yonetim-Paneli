<?php  

	

class kurumsal{
	
	public $id,$title,$metatitle,$metakey,$metaauthor,$metaowner,$metacopy,$logoyazisi
		,$tweeter,$facebook,$instagram,$telno,$address,$mailaddress,$metadesc,$slogan,$referansbaslik,$filobaslik
		,$yorumbaslik,$iletisimbaslik,$hizmetbaslik,$haritabilgi;
	
	
	function __construct(){
		
		try{

				$db=new PDO("mysql:host=localhost;dbname=kurumsal;charset=utf8","root","");
				$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			}catch(PDOException $e){
				die($e->getMessage());
			}
		
			$sync=$db->prepare("SELECT * FROM ayarlar");
			$sync->execute();
			$sonuc=$sync->fetch();

			$this->id=$sonuc["id"];
			$this->title=$sonuc["title"];
			$this->metatitle=$sonuc["metatitle"];
			$this->metakey=$sonuc["metakey"];
			$this->metaauthor=$sonuc["metaauthor"];
			$this->metaowner=$sonuc["metaowner"];
			$this->metacopy=$sonuc["metacopy"];
			$this->logoyazisi=$sonuc["logoyazisi"];
			$this->tweeter=$sonuc["tweeter"];
			$this->facebook=$sonuc["facebook"];
			$this->instagram=$sonuc["instagram"];
			$this->telno=$sonuc["telno"];
			$this->slogan=$sonuc["slogan"];
			$this->address=$sonuc["address"];
			$this->mailaddress=$sonuc["mailaddress"];
			$this->metadesc=$sonuc["metadesc"];
			$this->referansbaslik=$sonuc["referansbaslik"];
			$this->filobaslik=$sonuc["filobaslik"];
			$this->yorumbaslik=$sonuc["yorumbaslik"];
			$this->iletisimbaslik=$sonuc["iletisimbaslik"];
			$this->hizmetbaslik=$sonuc["hizmetbaslik"];
			$this->haritabilgi=$sonuc["haritabilgi"];
		
			
	}
	
	
	function intro($db){
		
		$introal=$db->prepare("SELECT * FROM `intro");
			$introal->execute();
		
		while ($sonucum=$introal->fetch(PDO::FETCH_ASSOC)) :
		
			echo '<div class="item" style="background-image:url('.$sonucum["resimyolu"].');"></div>';
			
		
		endwhile;	
	
		
	}
	
	function hakkimizda($db){
		
		$data=$db->prepare("SELECT * FROM hakkimizda");
		$data->execute();
		
		$son=$data->fetch();
		
		
		echo '<div class="row">

			<div class="col-lg-6 hakkimizda-img">
			<img src="'.$son["resim"].'"  alt="'.$son["resim"].'"/>

			</div>



			<div class="col-lg-6 content">
			<h2>'.$son["baslik"].'</h2>
			<h3>'.$son["icerik"].'</h3>



			</div>

	 </div>';
		
		
		
		
	}
	
	function hizmet($db){
		
		$data=$db->prepare("SELECT * FROM hizmetler");
		$data->execute();
		
		
		
		
		echo'<div class="section-header">  
			 <p>';echo $this->hizmetbaslik; echo'</p>
   		 </div>
    
    <div class="row">';
    	$i=0;
		while($sonuc=$data->fetch(PDO::FETCH_ASSOC)):
			
			if($i%2==0):
			echo'<div class="col-lg-6">
            		<div class="box wow fadeInLeft">
                		
                    	<h4 class="title text-center" >'.$sonuc["baslik"].'</h4>
						<p class="text-center">'.$sonuc["icerik"].'</p>
                    	
						 <div class="col-lg-4 col-md-4 " >         
         							<div class="filo-item wow fadeInUp">
										<a href="'.$sonuc["hizresim"].'" class="filo-popup">
											<img style="width:100%; " src="'.$sonuc["hizresim"].'" alt="filo-'.$sonuc["hizresim"].'" />
											<div class="filo-overlay">
          							  
          							  		</div>
										</a>
											</div>
									  </div>
									  
						</div> 
				   	
                  </div>';
			else:
			echo'<div class="col-lg-6">
            		<div class="box wow fadeInRight">
                		
                    	<h4 class="title text-center" >'.$sonuc["baslik"].'</h4>
						<p class="text-center">'.$sonuc["icerik"].'</p>
                    	
						 <div class="col-lg-4 col-md-4 " >         
         							<div class="filo-item wow fadeInUp">
										<a href="'.$sonuc["hizresim"].'" class="filo-popup">
											<img style="width:100%;" src="'.$sonuc["hizresim"].'" alt="filo-'.$sonuc["hizresim"].'" />
											<div class="filo-overlay">
          							  
          							  		</div>
										</a>
											</div>
									  </div>
									  
						</div> 
				   	
                  </div>';
			
			endif;
		$i++;
		 endwhile;
    
   echo'</div>';
		
		
	}
	
	function referans($db){
		$yol=$db->prepare("SELECT * FROM ref");
		$yol->execute();
	
		echo '
		
		<p>'.$this->referansbaslik.'</p>';
		
		echo '<div class="owl-carousel clients-carousel">';
		while($son=$yol->fetch(PDO::FETCH_ASSOC)):
		
			echo '<img src="'.$son["rimg"].'" alt="Referans-'.$son["rimg"].'"/>';
		
		endwhile;
		
		echo "</div>";
		
		
		
		
		
		
	}
	
	function filomuz($db){
           
		$a=$db->prepare("SELECT * FROM filomuz");
		$a->execute();
		echo'
		<div class="section-header">
        <h2>Araçlarımız</h2>
        <p>'.$this->filobaslik.'</p>
   		 </div>
         </div>
         
         <div class="container-fluid">
         <div class="row no-gutters"> ';    
		
		   while($son=$a->fetch(PDO::FETCH_ASSOC)):
		  echo' <div class="col-lg-3 col-md-4">         
         	<div class="filo-item wow fadeInUp">
			<a href="'.$son["rimg"].'" class="filo-popup">
            <img src="'.$son["rimg"].'" alt="filo-'.$son["rimg"].'" />
            <div class="filo-overlay">
            
            </div>
            </a>
            </div>
            </div>';
            
		endwhile;
       

		echo'</div></div>';

	}
	
	function yorumlar($db){
		$y=$db->prepare("SELECT * FROM yorumlar");
		$y->execute();
		
		echo'
				<div class="section-header">
        <h2>Müşteri Yorumları</h2>
        <p>'.$this->yorumbaslik.'</p>
   		 </div>
         
         <div class="owl-carousel testimonials-carousel">';
         
         while($son=$y->fetch(PDO::FETCH_ASSOC)):
			 echo'<div class="testimonial-item">

				<p>
				<img src="img/sol.png" class="quote-sign-left" />
				'.$son["icerik"].'
				<img src="img/sag.png" class="quote-sign-right" />
				</p>
				<img src="img/yorum.jpg" class="testimonial-img" alt="" />
				<h3>'.$son["isim"].'</h3>
				</div>';

        endwhile;
		

		echo '</div>';
		
	}
	
	
		
}









?>
  