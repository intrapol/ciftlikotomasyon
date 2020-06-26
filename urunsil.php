<?php include("fonksiyon/fonksiyon.php");
if (!$_POST):
    echo "post ile  gelmiyorsun";
    else:
        
    $urunid=htmlspecialchars($_POST["urunid"]);
    $masaid=htmlspecialchars($_POST["masaid"]);
    $adet=htmlspecialchars($_POST["adet"]);
    
    
    $sorgu="DELETE FROM anliksiparis WHERE urunid=$urunid AND masaid=$masaid";
    $silme=$db->prepare($sorgu);
    $silme->execute();

    $sorgu="UPDATE `mutfak` SET `durum` = '0'
    WHERE masaid=$masaid and urunid=$urunid and adet=$adet";
    $silme=$db->prepare($sorgu);
    $silme->execute();

    
    endif;
header("Location: masadetay.php?masaid=$masaid");
?>
