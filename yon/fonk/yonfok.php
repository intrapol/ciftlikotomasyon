<?php
$vt = new mysqli("localhost","serdar","123456","siparis") or die("BAŞARAMADIK ABİ .... NEYİ BAŞARAMADIN HAAM");
$vt->set_charset("utf-8");

class yonetim{
private function genelsorgu($dv,$sorgu){ // yapılacak birden fazla veritabanaı sorgusunu burada kısaca çalıştırmak

  $sorgum=$dv->prepare($sorgu);
  $sorgum->execute();
  return  $sorguson=$sorgum->get_result();
}
function kulad($db){  //  yöneticinin ismini getirir
    $gelensonuc=$this->genelsorgu($db,"select * from yonetim")->fetch_assoc();
    return $gelensonuc["kulad"];
}
private function uyari($tip,$metin,$sayfa){ // kullanıcı girişinde girişin başarılı olup olmadığının uyarısını veriir
  echo '<div class="alert alert-'.$tip.'">'.$metin.'</div>';
  header("refresh:2,url=".$sayfa);

}
function masasil($vt){
  $masaid=$_GET["masaid"];
  if ($masaid!="" && is_numeric($masaid)) {
    $this->genelsorgu($vt,"DELETE FROM masalar WHERE id=$masaid");
    $this->uyari("success","MASA BASARIYLA SİLİNDİ.","control.php?islem=masayon");
  }else {
    $this->uyari("danger","HATA OLUŞTU.","control.php?islem=masayon");

  }
}
function katagorigetir($vt,$katid){
  $sonuc=$this->genelsorgu($vt,"SELECT * FROM  kategori WHERE id=$katid");
  $son=$sonuc->fetch_assoc();
  return $son["ad"];
}


function masaguncel($vt){
echo ' <div class="col-md-3 text-center mx-auto mt-5 table-bordered">';

if(isset($_POST["buton"])){
    @$masaad=htmlspecialchars($_POST["masaad"]);
    @$masaid=htmlspecialchars($_POST["masaid"]);
    if ($masaad=="" && $masaid=="") {
      $this->uyari("danger","HATA YAPTINIZ TEKRARDAN DENEYİNİZ...","control.php?islem=masayon");
    }
    else {
        $this->genelsorgu($vt,"UPDATE masalar SET ad='$masaad' WHERE id=$masaid");
        $this->uyari("success","GÜNCELLEME BAŞARILI","control.php?islem=masayon");
    }
}
else{
  @$masaid=$_GET["masaid"];
$aktar=$this->genelsorgu($vt,"SELECT * FROM  masalar WHERE id=$masaid")->fetch_assoc();

echo '

    <form class="" action="" method="post">
      <div class="col-md-12 table-light"><h4>Masa Güncelle</h4></div>
      <div class="col-md-12 table-light">
        <input type="text" name="masaad" value="'.$aktar["ad"].'" class="form-control">
      </div>
      <div class="col-md-12 table-light">
        <input type="submit" name="buton"  value="Gönder" class="btn btn-success mt-3 mb-3">
      </div>
      <input type="hidden" name="masaid" value="'.$aktar["id"].'"   />
    </form>
';
}
echo '</div>';
}
function masaekle($vt){

  echo ' <div class="col-md-3 text-center mx-auto mt-5 table-bordered">';

  if(isset($_POST["buton"])){
      @$masaad=htmlspecialchars($_POST["masaad"]);
            if ($masaad=="") {
        $this->uyari("danger","HATA YAPTINIZ TEKRARDAN DENEYİNİZ...","control.php?islem=masayon");
      }
      else {
          $this->genelsorgu($vt,"INSERT INTO masalar (ad) VALUES ('$masaad')");
          $this->uyari("success","EKLEME YAPILDI...","control.php?islem=masayon");
      }
  }
  else{
  echo '

      <form class="" action="" method="post">
        <div class="col-md-12 table-light"><h4>Masa Ekle</h4></div>
        <div class="col-md-12 table-light">
          <input type="text" name="masaad"  class="form-control mt-3">
        </div>
        <div class="col-md-12 table-light">
          <input type="submit" name="buton"  value="Gönder" class="btn btn-success mt-3 mb-3">
        </div>
              </form>
  ';
  }
  echo '</div>';

}


function masayon($vt){
$so=$this->genelsorgu($vt,"SELECT * FROM masalar");
echo '<table class="table text-center table-striped table-bordered mx-auto col-md-7 mt-4">
  <thead>
    <tr>
      <th scope="col"><a href="control.php?islem=masaekle" class="btn btn-success">EKLE+</a>  Masa Adı</th>
      <th scope="col">Güncelle</th>
      <th scope="col">Sil</th>
    </tr>
    <tbody>';
while ($sonuc=$so->fetch_assoc()) {
  echo '
        <tr>
          <td>'.$sonuc["ad"].'</td>
          <td><a href="control.php?islem=masaguncel&masaid='.$sonuc["id"].'" class="btn btn-warning">Güncelle</td>
          <td><a href="control.php?islem=masasil&masaid='.$sonuc["id"].'" class="btn btn-danger">Sil</td>



        </tr>


  ';
}
echo '
</tbody>
</thead>

</table>';
}
function urunyon($vt,$tercih){
if ($tercih==1) {

    @$arama=$_POST["arama"];
    @$urunad=$_POST["urun"];
  if ($arama) {
  $so=$this->genelsorgu($vt,"SELECT * FROM urunler WHERE ad LIKE '%$urunad%'");
    
 
 }


  //urun adına göre arama 
  
}else{
  if ($tercih==2) {

    @$arama=$_POST["arama"];
    @$katid=$_POST["katid"];
  if ($arama) {
  $so=$this->genelsorgu($vt,"SELECT * FROM urunler WHERE katid=$katid");
    
 
 }

    // katagoriye göre arama


  }else{
    if ($tercih==0) {
  $so=$this->genelsorgu($vt,"SELECT * FROM urunler");
      
    }
  }
}

  echo '
  <table class="table text-center table-striped table-bordered mx-auto col-md-6 mt-4 table-dark">
            <thead>
              <tr>
                <th>
              <form action="control.php?islem=aramasonuc" method="post">  
                <input type="search" name="urun" class="form-contorol" placeholder="Ürün adı"></th>
                <th>
                <input type="submit" name="arama" value="ARA" class="btn btn-danger">
              </form>
                </th>
                <th>
                <form action="control.php?islem=katgore" method="post">
                <select  name="katid" class="form-contorol">';
                $sonuc=$this->genelsorgu($vt,"SELECT * FROM kategori");
                while ($katsonuc=$sonuc->fetch_assoc()) {
                  echo '<option value="'.$katsonuc["id"].'">'.$katsonuc["ad"].'</option>';
                }
                  

               echo '</select></th>
                <th><input type="submit" name="arama" value="GETİR" class="btn btn-danger"></form></th>

              </tr>
            </thead>
          </table>



  <table class="table text-center table-striped table-bordered mx-auto col-md-7 mt-4">
    <thead>
      <tr>
        <th scope="col"><a href="control.php?islem=urunekle" class="btn btn-success">EKLE+</a> Urun Adı</th>
        <th scope="col">Fiyat</th>
        <th scope="col">Katagori</th>
        <th scope="col">Güncelle</th>
        <th scope="col">Sil</th>
      </tr>
      <tbody>';
  while ($sonuc=$so->fetch_assoc()) {
    $katad=$this->katagorigetir($vt,$sonuc["katid"]);
    echo '
          <tr>
            <td>'.$sonuc["ad"].'</td>
            <td>'.$sonuc["fiyat"].'</td>
            <td>'.$katad.'</td>
            <td><a href="control.php?islem=urunguncel&urunid='.$sonuc["id"].'" class="btn btn-warning">Güncelle</td>
            <td><a href="control.php?islem=urunsil&urunid='.$sonuc["id"].'" class="btn btn-danger">Sil</td>



          </tr>


    ';
  }
  echo '
  </tbody>
  </thead>

  </table>';
}
function urunsil($vt){
  $urunid=$_GET["urunid"];
  if ($urunid!="" && is_numeric($urunid)) {

      
    if ($this->genelsorgu($vt,"SELECT * FROM anliksiparis WHERE urunid=$urunid")->num_rows!=0) {
    $this->uyari("danger","BU ÜRÜN BİR MASADA EKLİDİR SİLİNEMEZ. GÜN SONUNDA TEKRARDAN DENEYİNİZ.","control.php?islem=urunyon");
        
    }
    else{

    $this->genelsorgu($vt,"DELETE FROM urunler WHERE id=$urunid");
    $this->uyari("success","ÜRÜN BAŞARIYLA SİLİNDİ.","control.php?islem=urunyon");
  }
  }else {
    $this->uyari("danger","HATA OLUŞTU.","control.php?islem=masayon");

  }
}
function urunguncel($vt){
  echo ' <div class="col-md-3 text-center mx-auto mt-5 table-bordered">';

  if(isset($_POST["buton"])){
      @$urunad=htmlspecialchars($_POST["urunad"]);
      @$urunid=htmlspecialchars($_POST["urunid"]);
      @$fiyat=htmlspecialchars($_POST["fiyat"]);
      @$katid=htmlspecialchars($_POST["katid"]);

      if ($urunad=="" && $urunid=="" && $katid=="" && $fiyat="") {
        $this->uyari("danger","HATA YAPTINIZ TEKRARDAN DENEYİNİZ...","control.php?islem=urunyon");
      }
      else {
          $this->genelsorgu($vt,"UPDATE urunler SET ad='$urunad', fiyat='$fiyat', katid=$katid where id=$urunid");
          $this->uyari("success","ÜRÜN GÜNCELLEME BAŞARILI","control.php?islem=urunyon");
      }
  }
  else{
    @$urunid=$_GET["urunid"];
  $aktar=$this->genelsorgu($vt,"SELECT * FROM  urunler WHERE id=$urunid")->fetch_assoc();

  ?>

<form class="<?php $_SERVER['PHP_SELF']; ?>" action="" method="post">
  <?php


      echo '  <div class="col-md-12 table-light"><h4>Ürün Güncelle</h4></div>
        <div class="col-md-12 table-light">
        Ürün Ad
          <input type="text" name="urunad" value="'.$aktar["ad"].'" class="form-control">
        </div>
        <div class="col-md-12 table-light">
        Ürün Fiyat
          <input type="text" name="fiyat" value="'.$aktar["fiyat"].'" class="form-control">
          <input type="hidden" name="urunid" value="'.$aktar["id"].'" class="form-control">



        </div>';
          $katid=$aktar["katid"];
          $katcek=$this->genelsorgu($vt,"SELECT * FROM  kategori");

          echo 'Ürün Katagori
          <select name="katid">';
          while ($katson=$katcek->fetch_assoc()) {

            echo '<option value="'.$katson["id"].'">'.$katson["ad"].'</option>';

          }
            echo ' </select>';


  echo    '<div class="col-md-12 table-light">
          <input type="submit" name="buton"  value="Gönder" class="btn btn-success mt-3 mb-3">
        </div>

      </form>
  ';
  }
  echo '</div>';
}
function urunekle($vt){
  echo ' <div class="col-md-3 text-center mx-auto mt-5 table-bordered">';

  if(isset($_POST["buton"])){
      @$urunad=htmlspecialchars($_POST["urunad"]);
      @$fiyat=htmlspecialchars($_POST["fiyat"]);
      @$katid=htmlspecialchars($_POST["katid"]);

      if ($urunad=="" && $katid=="" && $fiyat="") {
        $this->uyari("danger","HATA YAPTINIZ TEKRARDAN DENEYİNİZ...","control.php?islem=urunyon");
      }
      else {
          $this->genelsorgu($vt,"INSERT INTO urunler (katid,ad,fiyat) VALUES($katid,'$urunad',$fiyat)");
          $this->uyari("success","ÜRÜN EKLEME BAŞARILI","control.php?islem=urunyon");
      }
  }
  else{
    // BU KODLAR ÜRÜN GÜNCELLE KODLARIYLA AYNI OLDUĞU İÇİN BURDAKİ KODLAR GEREKMEMEKTEDİR 
   // @$urunid=$_GET["urunid"];
 // $aktar=$this->genelsorgu($vt,"SELECT * FROM  urunler WHERE id=$urunid")->fetch_assoc();

  ?>

<form class="<?php $_SERVER['PHP_SELF']; ?>" action="" method="post">
  <?php


      echo '  <div class="col-md-12 table-light"><h4>Ürün EKLEME</h4></div>
        <div class="col-md-12 table-light">
        Ürün Ad
          <input type="text" name="urunad" class="form-control">
        </div>
        <div class="col-md-12 table-light">
        Ürün Fiyat
          <input type="text" name="fiyat"  class="form-control">
         



        </div>';
          $katcek=$this->genelsorgu($vt,"SELECT * FROM  kategori");
          echo 'Ürün Katagori
          <select name="katid">';
          while ($katson=$katcek->fetch_assoc()) {

            echo '<option value="'.$katson["id"].'">'.$katson["ad"].'</option>';

          }
            echo ' </select>';


  echo    '<div class="col-md-12 table-light">
          <input type="submit" name="buton"  value="EKLE" class="btn btn-success mt-3 mb-3">
        </div>

      </form>
  ';
  }
  echo '</div>';
}
function katyon($vt){
$so=$this->genelsorgu($vt,"SELECT * FROM kategori");
echo '<table class="table text-center table-striped table-bordered mx-auto col-md-7 mt-4">
  <thead>
    <tr>
      <th scope="col"><a href="control.php?islem=katekle" class="btn btn-success">EKLE+</a>  Katagori Adı</th>
      <th scope="col">Güncelle</th>
      <th scope="col">Sil</th>
    </tr>
    <tbody>';
while ($sonuc=$so->fetch_assoc()) {
  echo '
        <tr>
          <td>'.$sonuc["ad"].'</td>
          <td><a href="control.php?islem=katguncel&katid='.$sonuc["id"].'" class="btn btn-warning">Güncelle</td>
          <td><a href="control.php?islem=katsil&katid='.$sonuc["id"].'" class="btn btn-danger">Sil</td>



        </tr>


  ';
}
echo '
</tbody>
</thead>

</table>';
}
function katekle($vt){

  echo ' <div class="col-md-3 text-center mx-auto mt-5 table-bordered">';

  if(isset($_POST["buton"])){
      @$katad=htmlspecialchars($_POST["katad"]);
            if ($katad=="") {
        $this->uyari("danger","HATA YAPTINIZ TEKRARDAN DENEYİNİZ...","control.php?islem=katyon");
      }
      else {
          $this->genelsorgu($vt,"INSERT INTO kategori (ad) VALUES ('$katad')");
          $this->uyari("success","EKLEME YAPILDI...","control.php?islem=katyon");
      }
  }
  else{
  echo '

      <form class="" action="" method="post">
      <div class="col-md-12 table-light"><h4>Katagori Ekle</h4></div>
        <div class="col-md-12 table-light">
          <input type="text" name="katad"  class="form-control mt-3">
        </div>
        <div class="col-md-12 table-light">
          <input type="submit" name="buton"  value="Gönder" class="btn btn-success mt-3 mb-3">
        </div>
              </form>
  ';
  }
  echo '</div>';

}


function katguncel($vt){
echo ' <div class="col-md-3 text-center mx-auto mt-5 table-bordered">';

if(isset($_POST["buton"])){
    @$katid=htmlspecialchars($_POST["katid"]);
    @$katad=htmlspecialchars($_POST["katad"]);
    if ($katad=="" && $katid=="") {
      $this->uyari("danger","HATA YAPTINIZ TEKRARDAN DENEYİNİZ...","control.php?islem=katyon");
    }
    else {
        $this->genelsorgu($vt,"UPDATE kategori SET ad='$katad' WHERE id=$katid");
        $this->uyari("success","GÜNCELLEME BAŞARILI","control.php?islem=katyon");
    }
}
else{
  @$katid=$_GET["katid"];
$aktar=$this->genelsorgu($vt,"SELECT * FROM  kategori WHERE id=$katid")->fetch_assoc();

echo '

    <form class="" action="" method="post">
      <div class="col-md-12 table-light"><h4>Masa Güncelle</h4></div>
      <div class="col-md-12 table-light">
        <input type="text" name="katad" value="'.$aktar["ad"].'" class="form-control">
      </div>
      <div class="col-md-12 table-light">
        <input type="submit" name="buton"  value="Gönder" class="btn btn-success mt-3 mb-3">
      </div>
      <input type="hidden" name="katid" value="'.$aktar["id"].'"   />
    </form>
';
}
echo '</div>';
}
function katsil($vt){
  $katid=$_GET["katid"];
  if ($katid!="" && is_numeric($katid)) {
    $this->genelsorgu($vt,"DELETE FROM kategori WHERE id=$katid");
    $this->uyari("success","KATEGORİ BASARIYLA SİLİNDİ.","control.php?islem=katyon");
  }else {
    $this->uyari("danger","HATA OLUŞTU.","control.php?islem=katyon");

  }
}
function sifredegis($vt){

  echo ' <div class="col-md-3 text-center mx-auto mt-5 table-bordered">';

  if(isset($_POST["buton"])){
      @$sifre=htmlspecialchars($_POST["sifre"]);
      @$sifre1=htmlspecialchars($_POST["sifre1"]);
      @$sifre2=htmlspecialchars($_POST["sifre2"]);

            if ($sifre=="" && $sifre1=="" && $sifre2=="") {
        $this->uyari("danger","HATA YAPTINIZ TEKRARDAN DENEYİNİZ...","control.php?islem=sifredegis");
      }
      else {
        $sifre=md5(sha1(md5($sifre)));
        if ($this->genelsorgu($vt,"SELECT * FROM yonetim WHERE sifre='$sifre'")->num_rows==0) {
          $this->uyari("danger","GİRİLEN ŞİFRE YANLIŞ TEKRARDAN DENEYİN","control.php?islem=sifredegis");
                 
        }else{
          if ($sifre1==$sifre2) {
        $sifre1=md5(sha1(md5($sifre1)));

            $this->genelsorgu($vt,"UPDATE yonetim SET sifre='$sifre1' WHERE sifre='$sifre'");
          $this->uyari("success","SİFRE DEĞİŞTİRİLDİ...","control.php?islem=bos");
            
          }
          

        }
        
          
  }
}
  else{
  echo '

      <form class="" action="" method="post">
      <div class="col-md-12 table-light"><h4>ŞİFRE DEĞİŞTİR </h4></div>
        <div class="col-md-12 table-light">
        ESKİ ŞİFRENİZ
          <input type="text" name="sifre"  class="form-control mt-3">
        </div>
        <div class="col-md-12 table-light">
        YENİ ŞİFRE GİRİNİZ 
          <input type="text" name="sifre1"  class="form-control mt-3">
        </div>
        <div class="col-md-12 table-light">
        TEKRAR GİRİNİZ
          <input type="text" name="sifre2"  class="form-control mt-3">
        </div>


        <div class="col-md-12 table-light">
          <input type="submit" name="buton"  value="Gönder" class="btn btn-success mt-3 mb-3">
        </div>
              </form>
  ';
  }
  echo '</div>';


}

function rapor($vt){



    @$tercih=$_GET["tar"];
    switch ($tercih) {
      case 'bugun':
      $veri=$this->genelsorgu($vt,"Truncate gecicimasa");$veri=$this->genelsorgu($vt,"Truncate geciciurun");
             $veri=$this->genelsorgu($vt,"SELECT * FROM rapor WHERE tarih = CURDATE()");
             $veri2=$this->genelsorgu($vt,"SELECT * FROM rapor WHERE tarih = CURDATE()");

        
        break;
        case 'dun':
        $veri=$this->genelsorgu($vt,"Truncate gecicimasa");$veri=$this->genelsorgu($vt,"Truncate geciciurun");
             $veri=$this->genelsorgu($vt,"SELECT * FROM rapor WHERE tarih = DATE_SUB(CURDATE(), İNTERVAL 1 DAY)");
             $veri2=$this->genelsorgu($vt,"SELECT * FROM rapor WHERE tarih = DATE_SUB(CURDATE(), İNTERVAL 1 DAY)");

        
        break;case 'hafta':
        $veri=$this->genelsorgu($vt,"Truncate gecicimasa");$veri=$this->genelsorgu($vt,"Truncate geciciurun");
              $veri=$this->genelsorgu($vt,"SELECT * FROM rapor WHERE YEARWEEK(tarih) = YEARWEEK(CURRENT_DATE)");
              $veri2=$this->genelsorgu($vt,"SELECT * FROM rapor WHERE YEARWEEK(tarih) = YEARWEEK(CURRENT_DATE)");
              
        break;case 'ay':
        $veri=$this->genelsorgu($vt,"Truncate gecicimasa");$veri=$this->genelsorgu($vt,"Truncate geciciurun");
               $veri=$this->genelsorgu($vt,"SELECT * FROM rapor WHERE tarih >= DATE_SUB(CURDATE(), İNTERVAL 1 MONTH)");
               $veri2=$this->genelsorgu($vt,"SELECT * FROM rapor WHERE tarih >= DATE_SUB(CURDATE(), İNTERVAL 1 MONTH)");
        
        break;case 'tum':
        $veri=$this->genelsorgu($vt,"Truncate gecicimasa");$veri=$this->genelsorgu($vt,"Truncate geciciurun");
               $veri=$this->genelsorgu($vt,"SELECT * FROM rapor");
               $veri2=$this->genelsorgu($vt,"SELECT * FROM rapor");

        
        break;
      
      default:
      $veri=$this->genelsorgu($vt,"Truncate gecicimasa");$veri=$this->genelsorgu($vt,"Truncate geciciurun");
               $veri=$this->genelsorgu($vt,"SELECT * FROM rapor");
               $veri2=$this->genelsorgu($vt,"SELECT * FROM rapor");

           
        break;
    }




  echo '  <table class="table text-center table-light table-bordered mt-2 mx-auto col-md-8">
            <thead>
              <tr class="">
                <th><a href="control.php?islem=raporyon&tar=bugun">Bugün</a></th>
                <th><a href="control.php?islem=raporyon&tar=dun">Dün</a></th>
                <th><a href="control.php?islem=raporyon&tar=hafta">Bu Hafta</a></th>
                <th><a href="control.php?islem=raporyon&tar=ay">Bu Ay</a></th>
                <th><a href="control.php?islem=raporyon&tar=tum">Tüm zamanlar</a></th>
                <th colspan="2">input gelecek</th>
                <th>button gelecek </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th colspan="4">
                  <table class="text-center table table-bordered col-md-12 table-striped">
                  <thead>
                    <tr>
                      <th colspan="4" class="table-dark">Masa Adet ve Hasılat</th>
                    </tr>
                  </thead>
                  <thead>
                    <tr class="table-danger">
                      <th colspan="2">Ad</th>
                      <th colspan="1">Adet</th>
                      <th colspan="1">Hasılat</th>
                    </tr>
                  </thead><tbody>';
                $kilit=$this->genelsorgu($vt,"SELECT * FROM gecicimasa");
                if ($kilit->num_rows==0) {

                  while ($gel=$veri->fetch_assoc()) {
                    $id=$gel["masaid"];
                    $masaveri=$this->genelsorgu($vt,"SELECT * FROM masalar WHERE id=$id")->fetch_assoc();
                    $masaad=$masaveri["ad"];
                    $raporbak=$this->genelsorgu($vt," SELECT * FROM gecicimasa WHERE masaid=$id");

                    if ($raporbak->num_rows==0) {
                      $has=$gel["adet"] * $gel["urunfiyat"];
                      $adet=$gel["adet"];

                    $this->genelsorgu($vt,"INSERT INTO gecicimasa (masaid,masaad,hasilat,adet)  VALUES($id,'$masaad',$has,$adet)");
                    }else{
                      $raporson=$raporbak->fetch_assoc();
                      $gelenadet=$reporson["adet"];
                      $gelenhas=$raporson["hasilat"];

                      $sonhasilat=$gelenhas +  ($gel["adet"] * $gel["urunfiyat"]);

                      $sonadet=$gelenadet + $gel["adet"];
                      $this->genelsorgu($vt,"update gecicimasa set hasilat=$sonhasilat, adet=$sonadet where masaid=$id");


                    }



                  }

                }
                $son=$this->genelsorgu($vt,"SELECT * from gecicimasa order by hasilat desc;"); 
                $toplamadet=0;
                $toplamhasilat=0;


                while ($listele=$son->fetch_assoc()) {
                  echo '
                      <tr>
                      <td colspan="2">'.$listele["masaad"].'</td>
                      <td colspan="1">'.$listele["adet"].'</td>
                      <td colspan="1">'.substr($listele["hasilat"],0,5).'</td>
                      </tr>';
                      $toplamadet+= $listele["adet"];
                      $toplamhasilat+=$listele["hasilat"];
                }

                echo '
                      <tr class="table-success">
                      <td colspan="2">TOPLAM</td>
                      <td colspan="1">'.$toplamadet.'</td>
                      <td colspan="1">'.$toplamhasilat.'</td>
                      </tr>';
///////////////////////////////////////////////////////////////////////////////////////////////////ÜRÜN RAPOR KISMI

                echo '</tbody>
                </table>
              </th>
             <th colspan="4">
                  <table class="text-center table table-bordered col-md-12 table-striped">
                  <thead>
                    <tr>
                      <th colspan="4" class="table-dark">Ürün Adet ve Hasılat</th>
                    </tr>
                  </thead>
                  <thead>
                    <tr class="table-danger">
                      <th colspan="2">Ad</th>
                      <th colspan="1">Adet</th>
                      <th colspan="1">Hasılat</th>
                    </tr>
                  </thead><tbody>';
                $kilit=$this->genelsorgu($vt,"SELECT * FROM geciciurun");
                if ($kilit->num_rows==0) {

                  while ($gel=$veri2->fetch_assoc()) {

                    $id=$gel["urunid"];
                    $urunad=$gel["urunad"];

                    
                    $raporbak=$this->genelsorgu($vt," SELECT * FROM geciciurun WHERE urunid=$id");

                    if ($raporbak->num_rows==0) {
                      $has=$gel["adet"] * $gel["urunfiyat"];
                      $adet=$gel["adet"];

                    $this->genelsorgu($vt,"INSERT INTO geciciurun (urunid,urunad,hasilat,adet)  VALUES($id,'$urunad',$has,$adet)");
                    }else{
                      $raporson=$raporbak->fetch_assoc();
                      $gelenadet=$reporson["adet"];
                      $gelenhas=$raporson["hasilat"];

                      $sonhasilat=$gelenhas +  ($gel["adet"] * $gel["urunfiyat"]);

                      $sonadet=$gelenadet + $gel["adet"];
                      $this->genelsorgu($vt,"update geciciurun set hasilat=$sonhasilat, adet=$sonadet where urunid=$id");


                    }



                  }

                }
                $son=$this->genelsorgu($vt,"SELECT * from geciciurun order by hasilat desc;"); 
                $toplamadet=0;
                $toplamhasilat=0;


                while ($listele=$son->fetch_assoc()) {
                  echo '
                      <tr>
                      <td colspan="2">'.$listele["urunad"].'</td>
                      <td colspan="1">'.$listele["adet"].'</td>
                      <td colspan="1">'.substr($listele["hasilat"],0,5).'</td>
                      </tr>';
                      $toplamadet+= $listele["adet"];
                      $toplamhasilat+=$listele["hasilat"];
                }

                echo '
                      <tr class="table-success">
                      <td colspan="2">TOPLAM</td>
                      <td colspan="1">'.$toplamadet.'</td>
                      <td colspan="1">'.$toplamhasilat.'</td>
                      </tr>';


                echo '</tbody>
                </table>

              </th>
                
              </tr>

            </tbody>
  </table>';
}

function toplamUrunAdet($vt){
   $gelensonuc=$this->genelsorgu($vt,"SELECT SUM(adet) FROM anliksiparis")->fetch_assoc();

   echo $gelensonuc["SUM(adet)"];
}
function toplam_masa($vt){
   $son=$this->genelsorgu($vt,"SELECT * FROM masalar")->num_rows;
   echo $son;


}
function toplam_katagori($vt){
   $son=$this->genelsorgu($vt,"SELECT * FROM kategori")->num_rows;
   echo $son;


}
function toplam_urun($vt){
   $son=$this->genelsorgu($vt,"SELECT * FROM urunler")->num_rows;
   echo $son;


}
function doluluk($vt){
  $veriler=$this->genelsorgu($vt,"SELECT * FROM doluluk")->fetch_assoc();

  $toplam= $veriler["bos"] + $veriler["dolu"];
  $oran = ($veriler["dolu"] / $toplam)*100;
  echo $oran=substr($oran,0,5). " %";

}
function cikis($deger){
  $deger=md5(sha1(md5($deger)));
  setcookie("kulad",$deger,time() - 10);
  $this->uyari("success","Çıkış Yapılıyor..","index.php");

}
public function giriskont($r,$k,$s){

            $sonhal=md5(sha1(md5($s)));
          $sorgu="SELECT * FROM yonetim WHERE kulad='$k' AND sifre='$sonhal'";
          $sor=$r->prepare($sorgu);
          $sor->execute();
          $sonbilgi=$sor->get_result();
  if ($sonbilgi->num_rows==0) {
          $this->uyari("danger","Bilgiler hatalı","index.php");
  }
          else{
            $this->uyari("success","Bilgiler doğru. Giriş yapılıyor","control.php?islem=bos");

            $kulson=md5(sha1(md5($k)));
            setcookie("kulad",$kulson ,time() + 60*60);


        }

}



public function cookcon($db,$durum){
  if (isset($_COOKIE["kulad"])) {
    $deger=$_COOKIE["kulad"];
    $sorgu="SELECT * FROM yonetim";
    $sor=$db->prepare($sorgu);
    $sor->execute();
    $sonbilgi=$sor->get_result();
    $veri=$sonbilgi->fetch_assoc();
    $sonhal=md5(sha1(md5($veri["kulad"])));
if ($sonhal!=$_COOKIE["kulad"]) {
  setcookie("kulad",$deger, time() - 10);
  header("Location:index.php");
}
    else{
      if ($durum==1) {
        header("Location:control.php");
      }
      else{
        if ($durum==2) {
      //header("Location:index.php"); //çıkış işlemi  tekrardan kontrol edildiği için cookie kaybolduğu iin gerek yok
        }
      }
  }
}else{
        

}

}



}


 ?>
