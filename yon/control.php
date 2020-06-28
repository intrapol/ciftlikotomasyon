<!DOCTYPE html><script src="../dosya/jqu.js"></script>
    <script src="../dosya/boostmodal.js"></script>
    <link rel="stylesheet" href="../dosya/boost.css">
<?php
include_once("fonk/yonfok.php");
$yonclass= new yonetim;
$yonclass->cookcon($vt,'2');
if(isset($_COOKIE["kulad"])){

}else{
  header("refresh:2,url=index.php");
  echo '<center><div class="alert alert-danger">LÜTFEN YÖNETİCİ GİRİŞ YAPINIZ</div></center>';
  die();
  
}
 ?>

<html lang="tr">
  <head>
    <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
    
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


<script language="javascript">
 function ortasayfa(url,winName,w,h,scroll){
  LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
  TopPosition = (screen.height) ? (screen.height-w)/2 : 0;
  settings='height='+h+', width='+w+' , top='+TopPosition+', left='+LeftPosition+', scrollbars='+scroll+',resizable'
  
  popupWindow=window.open(url,winName,settings)

 }
 // silme işlemlerinde modal box ile yapılan işlemlerin eminmisin sorusu sorulması kısmı yapım aşamasında 
 /*
 $(document).ready(function(){
$('a[data-confirm]').click(function(ev){
  var href=$(this).attr('href');
  if(!$('#dataConfirmModal').length){
    $('body').append('<div class="modal fade" id="dataConfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLongTitle">ONAY</h5></div><div class="modal-body"></div>   <div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">VAZGEÇ</button><a class="btn btn-primary" id="dataConfirmOK">SİL</a></div></div></div></div></div>')

    $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
    $('dataConfirmOk').attr('href',href);
    $('#dataConfimModal').modal({show:true});
    return false;

  }

})

 })*/
</script>


  <body>
<div class="container-fluid bg-light">
  <div class="row row-fluid">

  <div class="col-md-2 border-right bg-info">
        <div class="row">
          <div class="col-md-12 bg-info p-4 mx-auto text-center font-weight-bold text-white">
            <h3><?php echo $yonclass->kulad($vt); ?></h3>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12 bg-light p-2 pl-3 border-bottom text-white">
            <a href="control.php?islem=masayon" id="lk">Masa Yönetimi </a>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12 bg-light p-2 pl-3 border-bottom text-white">
            <a href="control.php?islem=urunyon" id="lk">Ürün Yönetimi</a>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12 bg-light p-2 pl-3 border-bottom text-white">
            <a href="control.php?islem=katyon" id="lk">Kategori Yönetimi</a>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12 bg-light p-2 pl-3 border-bottom text-white">
            <a href="control.php?islem=garsonyon" id="lk">Garson Yönetimi</a>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12 bg-light p-2 pl-3 border-bottom text-white">
            <a href="control.php?islem=garsonper" id="lk">Garson Performans Yönetimi: <a class="text-danger">YAPIM AŞAMASINDA</a></a>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12 bg-light p-2 pl-3 border-bottom text-white">
            <a href="control.php?islem=raporyon" id="lk">Rapor Yönetimi</a>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12 bg-light p-2 pl-3 border-bottom text-white">
            <a href="control.php?islem=gider" id="lk">Gider Ekle</a>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12 bg-light p-2 pl-3 border-bottom text-white">
            <a href="control.php?islem=sifredegis" id="lk">Ad ve Şifre Değiştir</a>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12 bg-danger p-2 pl-3 border-bottom text-white">
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
              @$islem=$_GET["islem"];
              switch ($islem) {
                case 'gider':
                  $yonclass->gider($vt);
                break;
                case 'giderguncel':                  
                  $yonclass->giderguncel($vt);
                break;
                case 'gidersil':                  
                  $yonclass->gidersil($vt);
                break;
                case 'cikis':
                $kullanıcıadi=$yonclass->kulad($vt);
                $yonclass->cikis($kullanıcıadi);
                break;
                  case 'masayon':
                  $yonclass->masayon($vt);
                  break;
                  case 'masaguncel':
                  $yonclass->masaguncel($vt);
                  break;
                  case 'masasil':
                  $yonclass->masasil($vt);
                  break;
                  case 'masaekle':
                  $yonclass->masaekle($vt);
                  break;
                  //--------------------------------------------
                  case 'urunyon':
                  $yonclass->urunyon($vt,0);
                  break;
                   case 'katgore':
                  $yonclass->urunyon($vt,2);
                  break;
                   case 'aramasonuc':
                  $yonclass->urunyon($vt,1);
                  break;
                  case 'urunsil':
                  $yonclass->urunsil($vt);
                  break;
                  case 'urunguncel':
                  $yonclass->urunguncel($vt);
                  break;
                  case 'urunekle':
                  $yonclass->urunekle($vt);
                  break;
                  //-----------------------------**katagori gölümü
                   case 'katyon':
                  $yonclass->katyon($vt);
                  break;
                  case 'katekle':
                  $yonclass->katekle($vt);
                  break;
                  case 'katguncel':
                  $yonclass->katguncel($vt);
                  break;
                  case 'katsil':
                  $yonclass->katsil($vt);
                  break;
                  ////////////////////////////////////////----------------**garson gölümü
                  case 'garsonyon':
                    $yonclass->garsonyon($vt);
                    break;
                    case 'garsonekle':
                    $yonclass->garsonekle($vt);
                    break;
                    case 'garsonguncel':
                    $yonclass->garsonguncel($vt);
                    break;
                    case 'garsonsil':
                    $yonclass->garsonsil($vt);
                    break;
                    case 'garsonper':
                      $yonclass->garsonper($vt);
                      break;
                  ////////////-------------------------------------------**şifre değiştirme
                  case 'sifredegis':
                  $yonclass->sifredegis($vt);
                  break;
                  //-----------------------------------------------------**rapor yönetim 
                  case 'raporyon':
                  $yonclass->rapor($vt);
                  break;


                    case 'bos':

                    echo'
                    <br><br><br><br>

                    <div class="alert alert-success"><-----------LÜTFEN BİR İŞLEM SEÇİNİZ</div>';

                    break;
                default:
                  echo'
                    <br><br><br><br>

                    <div class="alert alert-success"><-----------LÜTFEN BİR İŞLEM SEÇİNİZ</div>';
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
