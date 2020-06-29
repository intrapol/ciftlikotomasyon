<script src="dosya/jqu.js"></script>
<script src="dosya/boostmodal.js"></script>
<link rel="stylesheet" href="dosya/boost.css">
<?php 
 include("fonksiyon/fonksiyon.php");

 $urunid=htmlspecialchars($_POST["urunid"]);
 $masaid=htmlspecialchars($_POST["masaid"]);
 $adet=htmlspecialchars($_POST["adet"]);
 if($urunid!="" && $masaid!=""&& $adet!="" && $adet!=1){
     $adet-=1;
 $ekle="UPDATE anliksiparis set adet='$adet' where urunid='$urunid' and masaid='$masaid'";
$ekleson=$db->prepare($ekle);
$ekleson->execute();
header("Location: masadetay.php?masaid=$masaid");

    
    }else{
echo '<div class="alert alert-danger text-center">HOOOP 1 tane kalmış neden eksiltmek yerine silmiyorsun???</div>';
header("refresh:2;url=masadetay.php?masaid=$masaid");
}


?>
