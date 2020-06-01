<?php
$vt = new mysqli("localhost","serdar","123456","siparis") or die("BAŞARAMADIK ABİ .... NEYİ BAŞARAMADIN HAAM");
$vt->set_charset("utf-8");

class yonetim{

public static function giriskont($r,$k,$s){

            $sonhal=md5(sha1(md5($s)));
          $sorgu="SELECT * FROM yonetim WHERE kulad='$k' AND sifre='$s'";
          $sor=$r->prepare($sorgu);
          $sor->execute();
          $sonbilgi=$sor->get_result();
  if ($sonbilgi->num_rows==0) {
    echo '<div class="alert alert-danger">BÖYLE BİR KULLANICI YOK</div>';
    header("refresh:2,url=index.php");
  }
          else{
          echo '<div class="alert alert-success">BAŞARDIK ABEY</div>';
          header("refresh:2,url=control.php");

            setcookie("kulad",$sonhal time() + 60*60*24);


        }

}

public static function cookcon($db){
  if (isset($_COOKIE["kulad"])) {


    $deger=$_COOKIE["kulad"];



    $sorgu="SELECT * FROM yonetim WHERE sifre='$deger'";
    $sor=$db->prepare($sorgu);
    $sor->execute();
    $sonbilgi=$sor->get_result();
if ($sonbilgi->num_rows==0) {

header("Location:index.php");
}
    else{
    echo '<div class="alert alert-success">GİRİŞ YAPILIYOR</div>';
    header("refresh:2,url=control.php");

      setcookie("kulad",$sonhal time() + 60*60*24);


  }



}

}



 ?>
