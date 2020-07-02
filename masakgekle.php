<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="dosya/jqu.js"></script>
    <script src="dosya/boostmodal.js"></script>
    <link rel="stylesheet" href="dosya/boost.css">
    <title>Masa Kg Ekle</title>
</head>
<body>
    


<?php 
$db = new mysqli ("localhost","serdar","123456","siparis") or die ("Bağlanamadı");

$db->set_charset ("utf8");

function genelsorgu($dv,$sorgu){ // yapılacak birden fazla veritabanaı sorgusunu burada kısaca çalıştırmak

    $sorgum=$dv->prepare($sorgu);
    $sorgum->execute();
    return  $sorguson=$sorgum->get_result();
}
?>
<div class="container-fluid">
    <div class="row">
    <div class="col-md-6 mx-auto">
<form action="masakgekle.php" method="post">
<h3 class="alert alert-success">Masa Kg  Balık Ekle </h3>
<a class="">Masa Kg  Balık Ekle </a><br>

<input type="text" name="adet"> 
<br>
    <select name="urunid" class="">
        <?php 
        $sorgu="SELECT * FROM urunler where katid=-1";
        $sonuc=genelsorgu($db,$sorgu);
        while($son=$sonuc->fetch_assoc()){
        echo '  
	    <option value="'.$son["id"].'">'.$son["ad"].'</option>
        
        ';
        }
        ?>
	

    </select>
    <select name="masaid" class="">
        <?php 
        $sorgu="SELECT * FROM masalar";
        $sonuc=genelsorgu($db,$sorgu);
        while($son=$sonuc->fetch_assoc()){
            if($son["id"]!=-1 && $son["id"]!=0){
        echo '  
	    <option value="'.$son["id"].'">'.$son["ad"].'</option>
        
        ';
            }
        }
        ?>
	

    </select>
    <br>
    <input class="btn btn-success" type="submit" name="buton" value="EKLE">
</form>
    </div>
    <div class="col-md-6 mx-auto">
        <!-- KG BALIĞI FİYAT OLARAK GİRMEK İÇİN OLUŞTURULAN FORM  -->
<form action="masakgekle.php" method="post">
<h3 class="alert alert-success">Masa Fiyat Balık Ekle </h3>
<a class="">Masa Fiyat Balık Ekle </a><br>
<!-- DEĞİŞTİRMEDEN YAPIYORUZ ÇÜNKÜ BUNU İF İÇİNDE KG YE DONDURUP  GİRİŞİNİ YAPACAĞIZ  -->
<input type="text" name="adet"> 
<br>
        
    <select name="urunid" class="">
        <?php 
        $sorgu="SELECT * FROM urunler where katid=-1";
        $sonuc=genelsorgu($db,$sorgu);
        while($son=$sonuc->fetch_assoc()){
        echo '  
	    <option value="'.$son["id"].'">'.$son["ad"].'</option>
        
        ';
        }
        ?>
	

    </select>
    <select name="masaid" class="">
        <?php 
        $sorgu="SELECT * FROM masalar";
        $sonuc=genelsorgu($db,$sorgu);
        while($son=$sonuc->fetch_assoc()){
            if($son["id"]!=-1 && $son["id"]!=0){
        echo '  
	    <option value="'.$son["id"].'">'.$son["ad"].'</option>
        
        ';
            }
        }
        ?>
	

    </select>
    <br>
    <input class="btn btn-success" type="submit" name="butonn" value="EKLE">
</form>
    </div>
</div>
</div>
<?php
@$masaid=htmlspecialchars($_POST["masaid"]);
@$urunid=htmlspecialchars($_POST["urunid"]);
@$adet=htmlspecialchars($_POST["adet"]);
if(!isset($_POST["butonn"])){
    
}else{

    if($urunid=="" && $masaid=="" && $adet=="" ){
         echo 'hata var';
        }else{
            $select="SELECT * from urunler where id='$urunid'";
            $sonuc=genelsorgu($db,$select)->fetch_assoc();
            $urunfiyat=$sonuc["fiyat"];
            $adet=$adet/$urunfiyat;
            $urunad=$sonuc["ad"];
            $select="SELECT * FROM garson where durum=1";
            $sonuc=genelsorgu($db,$select)->fetch_assoc();
            $garsonid=$sonuc["id"];
            $ekle="INSERT INTO `anliksiparis` (`masaid`, `garsonid`, `urunid`, `urunad`, `urunfiyat`, `adet`)
            VALUES ('$masaid', '$garsonid', '$urunid', '$urunad', '$urunfiyat', '$adet')";
            $ekleson=$db->prepare($ekle);
            $ekleson->execute(); 
            echo "İŞLEM BAŞARILI YÖNLENDİRİLİYORSUNUZ";
    header("refresh:2,url=masadetay.php?masaid=$masaid");


        }
    
}
if(!isset($_POST["buton"])){
    
}else{
    if($urunid=="" && $masaid=="" && $adet=="" ){
         echo 'hata var';
        }else{
            $select="SELECT * from urunler where id='$urunid'";
            $sonuc=genelsorgu($db,$select)->fetch_assoc();
            $urunfiyat=$sonuc["fiyat"];
            $urunad=$sonuc["ad"];
            $select="SELECT * FROM garson where durum=1";
            $sonuc=genelsorgu($db,$select)->fetch_assoc();
            $garsonid=$sonuc["id"];
            $ekle="INSERT INTO `anliksiparis` (`masaid`, `garsonid`, `urunid`, `urunad`, `urunfiyat`, `adet`)
            VALUES ('$masaid', '$garsonid', '$urunid', '$urunad', '$urunfiyat', '$adet')";
            $ekleson=$db->prepare($ekle);
            $ekleson->execute(); 
            echo "İŞLEM BAŞARILI YÖNLENDİRİLİYORSUNUZ";
    header("refresh:2,url=masadetay.php?masaid=$masaid");


        }
    
}



//insert into anliksiparis (masaid,garsonid,urunid,urunad,urunfiyat,adet) VALUES ($masaid,$garsonid,$urunid,'$urunad','$urunfiyat',$adet)
?>


</body>
</html>