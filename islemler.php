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
function ortasayfa(url,winName,w,h,scroll){
  LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
  TopPosition = (screen.height) ? (screen.height-w)/2 : 0;
  settings='height='+h+', width='+w+' , top='+TopPosition+', left='+LeftPosition+', scrollbars='+scroll+',resizable'
  
  popupWindow=window.open(url,winName,settings)

 }
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
	function uyari($mesaj,$renk){
		echo '<div class="alert alert-'.$renk.' mt-4 text-center">'.$mesaj.'</div>';

	}
@$islem=$_GET["islem"];
switch ($islem) :
case "hesap":
if (!$_POST):
echo "posttan gelmiyorsun";
else:
$masaid=$_POST["hesapalid"];
$sorgu="SELECT * FROM anliksiparis WHERE masaid=$masaid";
$verilecek=benimsorum2($db,$sorgu,1);
while($son=$verilecek->fetch_assoc())
{
$a=$son["masaid"];
$b=$son["urunid"];
$c=$son["urunad"];
$d=$son["urunfiyat"];
$e=$son["adet"];
$bugun = date("Y-m-d");


	$raporekle="INSERT INTO `rapor` (`masaid`, `urunid`, `urunad`, `urunfiyat`, `adet`, `tarih`)
VALUES ('$a', '$b', '$c', '$d', '$e', '$bugun')";
	$raporekle=$db->prepare($raporekle);
	$raporekle->execute();
}




$hesapalid=htmlspecialchars($_POST["hesapalid"]);

$sorgu="DELETE FROM anliksiparis
WHERE masaid=$hesapalid";
$silme=$db->prepare($sorgu);
$silme->execute();

endif;

break;

case "sil":
if (!$_POST):
echo "post ile  gelmiyorsun";
else:
$gelenid=htmlspecialchars($_POST["urunid"]);
$sorgu="DELETE FROM anliksiparis WHERE urunid=$gelenid";
$silme=$db->prepare($sorgu);
$silme->execute();
endif;
break;
case "goster":
$id=htmlspecialchars($_GET["id"]);
		$a="SELECT * FROM anliksiparis WHERE masaid=$id";
	$d=benimsorum2($db,$a,1);
	if ($d->num_rows==0) :
	uyari("Henüz Sparis yok","danger");
	else:
	echo '<table class="table">
	<thead>
	<tr>
	<th scope="col" class="text-warning bg-dark">Ürün Adı</th>
	<th scope="col"  class="text-warning bg-dark">Adet</th>
	<th scope="col"  class="text-warning bg-dark">Tutar</th>
	<th scope="col"  class="text-warning bg-dark">İşlem</th>
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
									<td>'.number_format($tutar,2,'.',',').'</td>
									<td id="yakala"><a class="btn btn-danger mt-2 text-white" sectionId="'.$gelenson["urunid"].'">SİL</a></td>
									</tr>';
			endwhile;
	echo '<tr class="bg-dark text-center text-warning">
	 <td> TOPLAM</b></td>
		<td>'.$adet.'</b></td>
			 <td colspan="3"><b>'.number_format($sontutar,2,'.',',').'₺</b></td>
		</tr>
		</tbody></table>
		<div class="row">
		<div class="col-md-12">
	 <form id="hesapform">


	 <input type="hidden" name="hesapalid" value="'.$id.'" />
	 <input type="button" id="btnn" value="HESABI AL" class="btn btn-danger btn-block mt-4" />




	 </form>

	 <p><a href="fisbastir.php?masaid='.$id.'" onclick="ortasayfa(this.href,\'mywindow\',\'350\',\'400\',\'yes\');return false" class="btn btn-warning btn-block mt-4">Fiş Bastır</a></p>
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
uyari("Boş alan bırakma","danger");
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
uyari("Adet Güncellendi","success");
else:
 $a="select * from urunler where id=$urunid";
 $d=benimsorum2($db,$a,1);
 $son=$d->fetch_assoc();
 $urunad=$son["ad"];
 $urunfiyat=$son["fiyat"];
$ekle="insert into anliksiparis (masaid,urunid,urunad,urunfiyat,adet) VALUES ($masaid,$urunid,'$urunad','$urunfiyat',$adet)";
$ekleson=$db->prepare($ekle);
$ekleson->execute();
uyari("Eklendi","success");

endif;
endif;
else:
	uyari("HATA VAR","danger");
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
