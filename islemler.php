<?php include("fonksiyon/fonksiyon.php");
@$masaid=$_GET["masaid"];

?>
<head>
<meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
<script src="dosya/jqu.js"></script>
<link rel="stylesheet" href="dosya/boost.css">
<link rel="stylesheet" href="dosya/stil.css">
<title>TEST</title>
<script>
$(document).ready(function() {
	$('#btnn').click(function() {
		$.ajax ({
			type : "POST",
			url :'islemler.php?islem=hesap',
			data : $('#hesapform').serialize(),
			success: function(donen_veri)	{
				$('#hesapform').trigger("reset");
				window.location.reload();
			},
		})
	})
$('#yakala a').click(function() {
	var sectionId =$(this).attr('sectionId');
	$.post("islemler.php?islem=sil",{"urunid":sectionId},function(post_veri){
	$(".sonuc2").html(post_veri);
	window.location.reload();
	})
})
});
</script>
</head>
<body>
<?php session_start();
function benimsorum2($vt,$sorgu,$tercih) {
	$a =$sorgu;
	$b=$vt->prepare($a);
	$b->execute();
	if ($tercih==1):
	return $c=$b->get_result();
	endif;
	}
@$islem=$_GET["islem"];
switch ($islem) :
case "hesap":
	if (!$_POST):
	echo "porsstam gelmiyorsun";
	else:
	$hesapalid=htmlspecialchars($_POST["masaid"]);
	$sorgu="DELETE FROM anliksparis
	WHERE masaid=$masaid";
	$silme=$db->prepare($sorgu);
	$silme->execute();
	endif;

break;

case "sil":
if (!$_POST):
echo "porsstam gelmiyorsun";
else:
$gelenid=htmlspecialchars($_POST["urunid"]);
$sorgu="delete from anliksiparis where urunid=$gelenid";
$silme=$db->prepare($sorgu);
$silme->execute();
endif;
break;
 case "goster":
$id=htmlspecialchars($_GET["id"]);
    $a="select * from anliksiparis where masaid=$id";
	$d=benimsorum2($db,$a,1);
	if ($d->num_rows==0) :
	echo '<div class="alert alert-danger mt-4 text-center">Henüz sipariş yok.</div>';
	else:
	echo '<table class="table">
	<thead>
	<tr>
	<th scope="col">Ürün Adı</th>
	<th scope="col">Adet</th>
	<th scope="col">Tutar</th>
	<th scope="col">İşlem</th>
	</tr>
	</thead>
	<tbody>
	<div class="sonuc2"></div>
	';
	$adet=0;
	$sontutar=0;
$masaid=0;
	  while ($gelenson=$d->fetch_assoc()) :
	$tutar = $gelenson["adet"] * $gelenson["urunfiyat"];
	$adet +=$gelenson["adet"];
  $sontutar +=$tutar;
	$masaid=$gelenson["masaid"];
	  echo '<tr>
	  <td>'.$gelenson["urunad"].'</td>
	  <td>'.$gelenson["adet"].'</td>
	  <td>'.$tutar.'</td>
	  <td id="yakala"><a class="btn btn-danger mt-2 text-white" sectionId="'.$gelenson["urunid"].'">SİL</a></td>
	  </tr>';
	endwhile;
	echo '<tr class="table-danger">
	 <td><b> TOPLAM</b></td>
	  <td><b>'.$adet.'</b></td>
       <td colspan="2"><b>'.$sontutar.'</b></td>
	  </tr>
	  </tbody></table>
	  <div class="row">
	  <div class="col-md-12">
	 <form id="hesapform">


	 <input type="hidden" name="hesapalid" value="'.$masaid.'" />
	 <input type="button" id="btnn" value="HESABI AL" class="btn btn-danger btn-block mt-4" />
	 </form>
	  </div>
	  </div>
	  ';
	endif;
break;
case "ekle":
if ($_POST) :
@$masaid=htmlspecialchars($_POST["masaid"]);
@$urunid=htmlspecialchars($_POST["urunid"]);
@$adet=htmlspecialchars($_POST["adet"]);
if ($masaid==""  || $urunid==""  || $adet=="" ) :
echo '<div class="alert alert-danger mt-4 text-center">Boş alan bırakma</div>';
else:
$varmi="select * from anliksiparis where urunid=$urunid and masaid=$masaid";
$var=benimsorum2($db,$varmi,1);
if ($var->num_rows!=0) :
$urundizi=$var->fetch_assoc();
$sonadet= $adet + $urundizi["adet"];
$islemid=$urundizi["id"];
$guncel="UPDATE anliksiparis set adet=$sonadet where id=$islemid";
$guncelson=$db->prepare($guncel);
$guncelson->execute();
echo '<div class="alert alert-success mt-4 text-align">Adet Güncellendi</div>';
else:
 $a="select * from urunler where id=$urunid";
 $d=benimsorum2($db,$a,1);
 $son=$d->fetch_assoc();
 $urunad=$son["ad"];
 $urunfiyat=$son["fiyat"];
$ekle="insert into anliksiparis (masaid,urunid,urunad,urunfiyat,adet) VALUES ($masaid,$urunid,'$urunad','$urunfiyat',$adet)";
$ekleson=$db->prepare($ekle);
$ekleson->execute();
echo '<div class="alert alert-success mt-4 text-align">Eklendi</div>';
endif;
endif;
else:
echo '<div class="alert alert-danger mt-4 text-align">HATA VAR</div>';
endif;
break;
case "urun" :
  $katid=htmlspecialchars($_GET["katid"]);
  $a="select * from urunler where katid=$katid";
	$d=benimsorum2($db,$a,1);
	while ($sonuc=$d->fetch_assoc()):
	echo '<label class="btn btn-dark m-2"><input name="urunid" type="radio" value="'.$sonuc["id"].'" />
	'.$sonuc["ad"].'</label>';
	endwhile;
break;
endswitch;
?>
</body>
</html>
