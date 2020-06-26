<?php
$db = new mysqli ("localhost","serdar","123456","siparis") or die ("Bağlanamadı");

$db->set_charset ("utf8");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="dosya/jqu.js"></script>
<script src="dosya/boostmodal.js"></script>
<link rel="stylesheet" href="dosya/boost.css">
    <title>KG BALIK SAT</title>
</head>
<body style="background-color: #EEE;">
<div class="container text-center">
<div class="row mx-auto">
    <div class="col col-md-4"></div>
    <div class="col col-md-4 mx-auto text-center">

    <?php
        @$buton=$_POST["buton"];

        if(!$buton){

        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="col col-md-12 border-bottom p-2"><h3>KG BALIK EKLE</h3></div>
        <div class="col col-md-12"><input type="text" name="fiyat" class="form-control mt-2"required="required" placeholder="Satılan Balık Fiyatı"/></div>
        <div class="col col-md-12"><input type="submit" name="buton" class="btn btn-success mt-2" value="GİRİŞ"/></div>
        </form>
        <?php
        
      }

        else{
            @$fiyat=htmlspecialchars($_POST["fiyat"]);
            if($fiyat==""){
                echo "Bilgiler Boş Olamaz";
                header("refresh:2,url=index.php");
            }
            else{
                $bugun = date("Y-m-d");

                $raporekle="INSERT INTO `rapor` (`masaid`, `garsonid`, `urunid`, `urunad`, `urunfiyat`, `adet`, `tarih`)
                VALUES ('0', '0', '0', 'KG Balık', '$fiyat', '1', '$bugun');";
	$raporekle=$db->prepare($raporekle);
    $raporekle->execute();
    echo '<div class="alert alert-success">KG BALIK FİYATI EKLENDİ</div>';
  header("refresh:2,url=index.php");

            }
          }



        ?>
    </div>
    <div class="col col-md-4"></div>
</div>
</div>


</body>
</html>
<!--
$bugun = date("Y-m-d");


	$raporekle="INSERT INTO `rapor` (`masaid`,`garsonid`, `urunid`, `urunad`, `urunfiyat`, `adet`, `tarih`)
VALUES ('$a','$garsonid', '$b', '$c', '$d', '$e', '$bugun')";
	$raporekle=$db->prepare($raporekle);
	$raporekle->execute();