<!DOCTYPE html>
<?php
include_once("fonk/yonfok.php");
$yonclass= new yonetim;
$yonclass->cookcon($vt);
 ?>

<html lang="tr">
  <head>
    <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
    <script src="../dosya/jqu.js"></script>
    <link rel="stylesheet" href="../dosya/boost.css">
    <meta charset="utf-8">
    <title></title>
  </head>
<style>
  body {
    height:100%;
    width:100%;
    position:absolute;
  }
  .container-fluid,
  .row-fluid{
    height:inherit;
  }
#lk:link, #lk:visited{
  color:#888;
  text-decoration:none;
}
#lk:hover{
  color:#000;
}
#div1{
  background-color:#fff;
  border:1px solid #F1F1F1;
  border-radius:5px;
}
#div2{
  min-height:100%;
  background-color:#EEE;

}


</style>

  <body>
<div class="container-fluid bg-light">
  <div class="row row-fluid">

  <div class="col-md-2 border-right bg-info">
        <div class="row">
          <div class="col-md-12 bg-light p-4 mx-auto text-center font-weight-bold">
            <h3><?php echo $yonclass->kulad($vt); ?></h3>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12 bg-light p-2 pl-3 border-bottom text-white">
            <a href="#" id="lk">Masa Yönetimi </a>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12 bg-light p-2 pl-3 border-bottom text-white">
            <a href="#" id="lk">Ürün Yönetimi</a>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12 bg-light p-2 pl-3 border-bottom text-white">
            <a href="#" id="lk">Rapor Yönetimi</a>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12 bg-light p-2 pl-3 border-bottom text-white">
            <a href="#" id="lk">Şifre Değiştir</a>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12 bg-light p-2 pl-3 border-bottom text-white">
            <a href="control.php?islem=cikis" id="lk">Çıkış</a>

          </div>
        </div>
        <table class="table text-center table-light table-bordered mt-2 table-striped">
            <thead>
              <tr class="table-warning">
                <th scope="col" colspan="4">ANLIK DURUM</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="col" colspan="3">Toplaam Sipariş</th>
                <th scope="col" colspan="1" class="text-danger"><?php $yonclass->toplamUrunAdet($vt); ?></th>
              </tr>
              <tr>
                <th scope="col" colspan="3">Doluluk Oranı</th>
                <th scope="col" colspan="1" class="text-danger"><?php $yonclass->doluluk($vt); ?></th>
              </tr>
              <tr>
                <th scope="col" colspan="3">Toplam Masa</th>
                <th scope="col" colspan="1" class="text-danger"><?php $yonclass->toplam_masa($vt); ?></th>
              </tr>
              <tr>
                <th scope="col" colspan="3">Toplam Katagori</th>
                <th scope="col" colspan="1" class="text-danger"><?php $yonclass->toplam_katagori($vt); ?></th>
              </tr>
              <tr>
                <th scope="col" colspan="3">Toplaam Ürün</th>
                <th scope="col" colspan="1" class="text-danger"><?php $yonclass->toplam_urun($vt); ?></th>
              </tr>
            </tbody>
        </table>

  </div>


    <div class="col-md-10">
        <div class="row bg-light" id="div2">
          <div class="col-md-12 mt-4" id="div1">
            <?php
              $islem=$_GET["islem"];
              switch ($islem) {
                case 'cikis':
                  $yonclass->kulad($yonclass->kulad($vt));
                  break;

                default:
                  // code...
                  break;
              }
             ?>
          </div>
        </div>



    </div>



  </div>
  </div>
  </body>
</html>
