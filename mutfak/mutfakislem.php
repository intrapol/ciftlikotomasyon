<?php 
$db = new mysqli ("localhost","serdar","123456","siparis") or die ("Bağlanamadı");

$db->set_charset ("utf8");

class mutfak{    
  function saatkontrol($saat,$dakika){
    if($saat<date("H")){
      if($saat+1<date("H")){
        if($saat+2<date("H")){
          if($saat+3<date("H")){
            if($saat+4<date("H")){
             return $son=((60*4) + date("i"))- $dakika;

            }else{
             return $son=((60*4) + date("i"))- $dakika;
          }
          }else{
            return $son=((60*3) + date("i"))- $dakika;
        }
        }else{
          return $son=((60*2) + date("i"))- $dakika;
      }    
      }else{
        return $son=(60 + date("i"))- $dakika;
      }
    }else{
      return $son=date("i") - $dakika;
    }
  }

function teksordu($vt,$sorgu) {
          $a =$sorgu;
          $b=$vt->prepare($a);
          $b->execute();
                  
          }




      function sqlsorgu($vt,$sorgu) {      
        $b=$vt->prepare($sorgu);
        $b->execute();
        return $c=$b->get_result();
       
        }
        
      function mutfaksparis($db){
        $sorgumasalar="SELECT distinct masaid from mutfak order by masaid asc";
        $sonucmasalar=$this->sqlsorgu($db,$sorgumasalar);
        while($sonucmasalarson=$sonucmasalar->fetch_assoc()){
          //masanın numarasını bulmak için kullanılan alan 
          $masaid=$sonucmasalarson["masaid"];
          $select="SELECT * FROM masalar where id=$masaid";
          $sonuc=$this->sqlsorgu($db,$select)->fetch_assoc();
          $masaad=$sonuc["ad"];




         // zaman sorucağın zaman kullanacaksın $zaman=saatkontrol($saat,$dakika);
                 //üst kısım
            echo '<div class="card border-success  mb-3" style="max-width: 23rem;">
            <div class="card-header bg-info border-success text-lg-center "><h3 class="alert-info">'.$masaad.'</h3></div>
            <div class="card-body ">
              <table border="1">
              <thead>
              <tr class="table-info">
                <th >Zaman</th>
                <th >Ürün </th>
                <th >Adet</th>
                <th >Durum</th>
             
              </tr>
            </thead>
            <tbody >
                  <tr>';
                  //üst kısı
          $masaidd=$sonucmasalarson["masaid"];

          $select="SELECT * FROM mutfak where masaid=$masaidd";
          $sonuc=$this->sqlsorgu($db,$select);
          while($urunler=$sonuc->fetch_assoc()){
            $saat=$urunler["saat"];
            $dakika=$urunler["dakika"];
            $urunad=$urunler["urunad"];
            // urunlerin sıralamasından oluşan sorunun a-balık sıralama sorunun çözümü  balık olarak yazdırma komutları 
			$string=$urunad;
			$string{0}=" ";
			$string{1}=" ";
			$urunad=ltrim($string);
            $urunadet=$urunler["adet"];
            $durum=$urunler["durum"];
            $hazır="HAZIR";
            $renk="success";

            $zaman=$this->saatkontrol($saat,$dakika);
            $dk="dk.";
            
            if($zaman<=1){
              $zaman="Yeni";
              $dk="Sipariş";
              ?>  
                <script>
                      var ses = new Audio('bildirim.mp3');
                      ses.play();

                </script>

              <?php
              
            }


            if($durum==0){
              $zaman="İPTAL";
              $dk="";
              $hazır="SİL";
              $renk="danger";
            }
                      
                      echo '
                      <td class="text-center bg-warning"><a class="text-danger ">'.$zaman.' '.$dk.'</a></td>
                      <td class="text-center">'.$urunad.'</td>
                      <td class="text-center">'.$urunadet.'</td>
                      <td class="bg-success">
                      <form action="urunhazir.php" method="post">
                      <input type="hidden" name="id" value="'.$urunler["id"].'" >
								    	<input class="btn btn-'.$renk.' "type="submit" value="'.$hazır.'">

                      </form></td>
                      </tr> ';
          
          }



                      //alt kısım 
                  echo '
                  </tbody>
              </table>
            </div>
           
          </div>';
          //alt kısım 
          
          
        }
        

    }

}


header("refresh:60;url=index.php");


?>