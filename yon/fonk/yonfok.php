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
  setcookie("kulad",$deger ,time() - 10);
  $this->uyarı("success","Çıkış Yapılıyor..","index.php");
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
            $this->uyari("success","Bilgiler Doğru","control.php");

            $kulson=md5(sha1(md5($k)));
            setcookie("kulad",$kulson ,time() + 60*60);


        }

}
public function cookcon($db,$durum=false){
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
      if ($durum==true) {
        header("Location:control.php");
      }
      else{
        if ($durum==false) {
        //  header("Location:index.php");
        }
      }
  }
}

}
}


 ?>
