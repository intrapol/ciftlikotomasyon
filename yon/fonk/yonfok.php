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
  $sorgu="select * from yonetim";
  $gelensonuc=$this->genelsorgu($db,$sorgu);
  $b=$gelensonuc->fetch_assoc();
  return $b["kulad"];
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
function urunyon($vt){
  $so=$this->genelsorgu($vt,"SELECT * FROM urunler");
  echo '<table class="table text-center table-striped table-bordered mx-auto col-md-7 mt-4">
    <thead>
      <tr>
        <th scope="col"><a href="control.php?islem=urunekle" class="btn btn-success">EKLE+</a> Urun Adı</th>
        <th scope="col">Güncelle</th>
        <th scope="col">Sil</th>
      </tr>
      <tbody>';
  while ($sonuc=$so->fetch_assoc()) {
    echo '
          <tr>
            <td>'.$sonuc["ad"].'</td>
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
    $this->genelsorgu($vt,"DELETE FROM urunler WHERE id=$urunid");
    $this->uyari("success","ÜRÜN BAŞARIYLA SİLİNDİ.","control.php?islem=urunyon");
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
          <input type="text" name="urunad" value="'.$aktar["ad"].'" class="form-control">
        </div>
        <div class="col-md-12 table-light">
          <input type="text" name="fiyat" value="'.$aktar["fiyat"].'" class="form-control">
          <input type="hidden" name="urunid" value="'.$aktar["id"].'" class="form-control">



        </div>';
          $katid=$aktar["katid"];
          $katcek=$this->genelsorgu($vt,"SELECT * FROM  kategori");
          echo '<select name="katid">';
          while ($katson=$katcek->fetch_assoc()) {
            //if ($katson["id"]==$katid) {
              //echo '<option value="'.$katid.'" selected=selected>'.$katson["ad"].'</option>';
            //}
            echo '<option value="'.$katid.'">'.$katson["ad"].'</option>';

          }
            echo ' </select>';


  echo    '<div class="col-md-12 table-light">
          <input type="submit" name="buton"  value="Gönder" class="btn btn-success mt-3 mb-3">
        </div>
        <input type="hidden" name="masaid" value="'.$aktar["id"].'"   />
      </form>
  ';
  }
  echo '</div>';
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
      //header("Location:index.php"); çıkış işlemi  tekrardan kontrol edildiği için cookie kaybolduğu iin gerek yok
        }
      }
  }
}

}
}


 ?>
