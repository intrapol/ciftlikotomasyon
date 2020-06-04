<?php
include_once("fonk/yonfok.php");
$clas= new yonetim;
$clas->cookcon($vt,1);

?>

<!DOCTYPE">

<head>
<meta http-equiv="Content-Type" content="=text/html; charset=utf-8"/>
<script src="../dosya/jqu.js"></script>
<link rel="stylesheet" href="../dosya/boost.css">
<title>YÖNETİCİ GİRİŞ</title>
    <style>
        #log{

            margin-top: 20%; min-height: 250px;
            background-color: #FEFEFE;
            border-radius: 10px;
            border: 1px solid #B7B7B7;
        }
    </style>
</head>
<body>
<body style="background-color: #EEE;">
<div class="container text-center">
<div class="row mx-auto">
    <div class="col col-md-4"></div>
    <div class="col col-md-4 mx-auto text-center"id="log">

    <?php
        @$buton=$_POST["buton"];

        if(!$buton){

        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="col col-md-12 border-bottom p-2"><h3>Yönetici Giriş</h3></div>
        <div class="col col-md-12"><input type="text" name="kulad" class="form-control mt-2"required="required" placeholder="Yönetici Adınız" autofocus="autofocus"/></div>
        <div class="col col-md-12"><input type="password" name="sifre" class="form-control mt-2"required="required" placeholder="Şifreniz"/></div>
        <div class="col col-md-12"><input type="submit" name="buton" class="btn btn-success mt-2" value="GİRİŞ"/></div>
        </form>
        <?php
      //  echo md5 (sha1(md5 ("1234")));
      }

        else{
            @$sifre=htmlspecialchars($_POST["sifre"]);
            @$kulad=htmlspecialchars($_POST["kulad"]);
            if($sifre=="" || $kulad==""){
                echo "Bilgiler Boş Olamaz";
                header("refresh:2,url=index.php");
            }
            else{
                $clas->giriskont($vt,$kulad,$sifre);

            }
          }



        ?>
    </div>
    <div class="col col-md-4"></div>
</div>
</div>


</body>
</html>
