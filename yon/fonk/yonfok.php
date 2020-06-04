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
    $this->uyari("success","HATA OLUŞTU.","control.php?islem=masayon");

  }
}
function masayon($vt){
$so=$this->genelsorgu($vt,"SELECT * FROM masalar");
echo '<table class="table text-center table-striped table-bordered mx-auto col-md-7 mt-4">
  <thead>
    <tr>
      <th scope="col">Masa Adı</th>
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
            $this->uyari("success","Bilgiler Doğru","control.php?islem=bos");

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
