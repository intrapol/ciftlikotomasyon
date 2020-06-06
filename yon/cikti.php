<!DOCTYPE html>
<?php
include_once("fonk/yonfok.php");
$yonclass= new yonetim;
$yonclass->cookcon($vt,2);
 ?>

<html lang="tr">
  <head>
    <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
    <script src="../dosya/jqu.js"></script>
    <link rel="stylesheet" href="../dosya/boost.css">
    <meta charset="utf-8">
    <title></title>


  </head>
  <body onload="window.print()">
<div class="container-fluid bg-light">
  <div class="row row-fluid">

 
            <?php
              @$islem=$_GET["islem"];
              switch ($islem) {
                                
                  case 'ciktial':
                    
                    @$tarih1=$_GET["tar1"];
                    @$tarih2=$_GET["tar2"];

    //  echo ' <div class="alert alert-info text-center mx-auto mt-4">'.$tarih1.'-'.$tarih2.'</div>';
            
            
                           $veri=$yonclass->ciktiicinSorgu($vt,"SELECT * FROM rapor where DATE(tarih) BETWEEN '$tarih1' AND '$tarih2'");
                           $veri2=$yonclass->ciktiicinSorgu($vt,"SELECT * FROM rapor where DATE(tarih) BETWEEN '$tarih1' AND '$tarih2'");
                    
                           echo '  <table class="table text-center table-light table-bordered mt-2 mx-auto col-md-8">
                           <thead>
                            <tr>
                            <th colspan"14"> <div class="alert alert-info text-center mx-auto mt-4">
                            TARİH SEÇİMİ:'.$tarih1.' - '.$tarih2.' 
                            
                             
                            </div>
                            

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
                               $kilit=$yonclass->ciktiicinSorgu($vt,"SELECT * FROM gecicimasa");
                               if ($kilit->num_rows==0) {
               
                                 while ($gel=$veri->fetch_assoc()) {
                                   $id=$gel["masaid"];
                                   $masaveri=$yonclass->ciktiicinSorgu($vt,"SELECT * FROM masalar WHERE id=$id")->fetch_assoc();
                                   $masaad=$masaveri["ad"];
                                   $raporbak=$yonclass->ciktiicinSorgu($vt," SELECT * FROM gecicimasa WHERE masaid=$id");
               
                                   if ($raporbak->num_rows==0) {
                                     $has=$gel["adet"] * $gel["urunfiyat"];
                                     $adet=$gel["adet"];
               
                                   $yonclass->ciktiicinSorgu($vt,"INSERT INTO gecicimasa (masaid,masaad,hasilat,adet)  VALUES($id,'$masaad',$has,$adet)");
                                   }else{
                                     $raporson=$raporbak->fetch_assoc();
                                     $gelenadet=$raporson["adet"];
                                     $gelenhas=$raporson["hasilat"];
               
                                     $sonhasilat=$gelenhas +  ($gel["adet"] * $gel["urunfiyat"]);
               
                                     $sonadet=$gelenadet + $gel["adet"];
                                     $yonclass->ciktiicinSorgu($vt,"update gecicimasa set hasilat=$sonhasilat, adet=$sonadet where masaid=$id");
               
               
                                   }
               
               
               
                                 }
               
                               }
                               $son=$yonclass->ciktiicinSorgu($vt,"SELECT * from gecicimasa order by hasilat desc;"); 
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
                               $kilit=$yonclass->ciktiicinSorgu($vt,"SELECT * FROM geciciurun");
                               if ($kilit->num_rows==0) {
               
                                 while ($gel=$veri2->fetch_assoc()) {
               
                                   $id=$gel["urunid"];
                                   $urunad=$gel["urunad"];
               
                                   
                                   $raporbak=$yonclass->ciktiicinSorgu($vt," SELECT * FROM geciciurun WHERE urunid=$id");
               
                                   if ($raporbak->num_rows==0) {
                                     $has=$gel["adet"] * $gel["urunfiyat"];
                                     $adet=$gel["adet"];
               
                                   $yonclass->ciktiicinSorgu($vt,"INSERT INTO geciciurun (urunid,urunad,hasilat,adet)  VALUES($id,'$urunad',$has,$adet)");
                                   }else{
                                     $raporson=$raporbak->fetch_assoc();
                                     $gelenadet=$raporson["adet"];
                                     $gelenhas=$raporson["hasilat"];
               
                                     $sonhasilat=$gelenhas +  ($gel["adet"] * $gel["urunfiyat"]);
               
                                     $sonadet=$gelenadet + $gel["adet"];
                                     $yonclass->ciktiicinSorgu($vt,"update geciciurun set hasilat=$sonhasilat, adet=$sonadet where urunid=$id");
               
               
                                   }
               
               
               
                                 }
               
                               }
                               $son=$yonclass->ciktiicinSorgu($vt,"SELECT * from geciciurun order by hasilat desc;"); 
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



                    
                  break;
               
               
              }
             ?>
     


  </div>
  </div>
  </body>
</html>
