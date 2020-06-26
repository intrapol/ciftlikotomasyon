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
	$('#degistirform').hide();
	$('#birlestirform').hide();

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
	// MASALARIN İÇİNDEKİ SPARİŞLERDE HATA OLDUĞUNDA SPARİŞİ SİL YAPTIĞIMIZDA BÜTÜN SİSTEMDEKİ AYNI İD YE SAHİP 
	//SPARİŞLERİ SİLİYORDU MASA İD SİNİ A TAGLARINDAN BECEREMEDİK FORMDAN FARKLI SAYFAYA ACTİON YAPILDI .....//
/*$('#yakala a').click(function() {
	var sectionId =$(this).attr('sectionId');
	$.post("islemler.php?islem=sil",{"urunid":sectionId},function(post_veri){
	$(".sonuc2").html(post_veri);
	window.location.reload();
	})
})*/
// değiştir function 
$('#degistir a').click(function(){
	$('#birlestirform').slideUp();
	$('#degistirform').slideDown();

});
//birleştir function 
$('#birlestir a').click(function(){
	$('#degistirform').slideUp();
	$('#birlestirform').slideDown();

});
$('#degistirbtn').click(function() {
		$.ajax ({
			type : "POST",
			url :'islemler.php?islem=masaislem',
			data : $('#degistirformveri').serialize(),
			success: function(donen_veri)	{
				$('#degistirformveri').trigger("reset");
				window.location.reload();
			},
		})
	})
	$('#birlestirbtn').click(function() {
		$.ajax ({
			type : "POST",
			url :'islemler.php?islem=masaislem',
			data : $('#birlestirformveri').serialize(),
			success: function(donen_veri)	{
				$('#birlestirformveri').trigger("reset");
				window.location.reload();
			},
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
	
function degistirgetir($masaid,$db){
	echo '<div class="card border-success m-3" style="max-width:10rem;"><div class="card-header">Masa Değiştir</div><div class="card-body text-success">
	<form id="degistirformveri">


	<input type="hidden" name="mevcutmasaid" value="'.$masaid.'" />
	<select name="hedefmasa" class="form-control">';
	$d=benimsorum2($db,"SELECT * from masalar where durum = '0' ",1);
	while($son= $d->fetch_assoc()){
			echo '<option value="'.$son["id"].'">'.$son["ad"].'</option>';
	}

	echo '</select><input type="button" id="degistirbtn" value="DEĞİŞTİR" class="btn btn-success btn-block mt-4" />




	</form>
	</div>
	</div>
	';
}
function birlestirgetir($masaid,$db){
	echo '<div class="card border-success m-3" style="max-width:10rem;"><div class="card-header">Masa Birleştir</div><div class="card-body text-success">
	<form id="birlestirformveri">


	<input type="hidden" name="mevcutmasaid" value="'.$masaid.'" />
	<select name="hedefmasa" class="form-control">';
	$d=benimsorum2($db,"SELECT * from masalar where durum = '1' ",1);
	while($son= $d->fetch_assoc()){
		if($masaid!=$son["id"]){
			echo '<option value="'.$son["id"].'">'.$son["ad"].'</option>';
		}
	}

	echo '</select><input type="button" id="birlestirbtn" value="BİRLEŞTİR" class="btn btn-success btn-block mt-4" />




	</form>
	</div>
	</div>
	';
}
@$islem=$_GET["islem"];
switch ($islem) :
	case "masaislem":
		$mevcutmasaid=$_POST["mevcutmasaid"];
		$hedefmasa=$_POST["hedefmasa"];

		benimsorum2($db,"UPDATE anliksiparis set masaid=$hedefmasa where masaid=$mevcutmasaid",1);
		$masadurum="UPDATE `masalar` SET durum='0' WHERE id = $mevcutmasaid ";
		$masadurumson=$db->prepare($masadurum);
		$masadurumson->execute();
		$masadurum="UPDATE `masalar` SET durum='1' WHERE id = $hedefmasa ";
		$masadurumson=$db->prepare($masadurum);
		$masadurumson->execute();
	break;
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
$garsonid=$son["garsonid"];
$bugun = date("Y-m-d");


	$raporekle="INSERT INTO `rapor` (`masaid`,`garsonid`, `urunid`, `urunad`, `urunfiyat`, `adet`, `tarih`)
VALUES ('$a','$garsonid', '$b', '$c', '$d', '$e', '$bugun')";
	$raporekle=$db->prepare($raporekle);
	$raporekle->execute();
}




$hesapalid=htmlspecialchars($_POST["hesapalid"]);

$sorgu="DELETE FROM anliksiparis
WHERE masaid=$hesapalid";
$silme=$db->prepare($sorgu);
$silme->execute();
$masadurum="UPDATE `masalar` SET durum='0'WHERE id = $masaid ";
$masadurumson=$db->prepare($masadurum);
$masadurumson->execute();
endif;

break;
case "goster":
$id=htmlspecialchars($_GET["id"]);
		$a="SELECT * FROM anliksiparis WHERE masaid=$id";
	$d=benimsorum2($db,$a,1);
	if ($d->num_rows==0) :
		$masadurum="UPDATE `masalar` SET durum='0'WHERE id = $id ";
		$masadurumson=$db->prepare($masadurum);
		$masadurumson->execute();
	uyari("Henüz Sparis yok","danger");
	
	else:
	echo '<table class="table">
	<thead>
	<tr>
	<th scope="col" id="hop1" class="text-warning bg-dark">Ürün Adı</th>
	<th scope="col" id="hop2" class="text-warning bg-dark">Adet</th>
	<th scope="col" id="hop3" class="text-warning bg-dark">Tutar</th>
	<th scope="col" id="hop4" class="text-warning bg-dark">İşlem</th>
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
									<td id="yakala">
									<form action="urunsil.php" method="post">
									<input type="hidden" name="urunid" value="'.$gelenson["urunid"].'">
									<input type="hidden" name="masaid" value="'.$id.'">
									<input type="hidden" name="adet" value="'.$gelenson["adet"].'">
									<input class="btn btn-danger "type="submit" value="SİL">
									

									</form>
									</td>
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
		<div class="row">
		<div class="col-md-6" id="degistir">	
		<a class="btn btn-warning btn-block mt-1" style="height:40px;">Masa Değiştir</a>
		</div>

		<div class="col-md-6" id="birlestir">	
		<a class="btn btn-warning btn-block mt-1" style="height:40px;">Masa Birleştir</a>
		
		</div>

		</div>
		<div class="row">
		
		<div class="col-md-12" id="degistirform">'; degistirgetir($masaid,$db);	echo'</div>
		<div class="col-md-12" id="birlestirform">'; birlestirgetir($masaid,$db); echo'</div>


		</div>
			</div>
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
			// urun adı çekme işlemi
			$a="select * from urunler where id=$urunid";
				$d=benimsorum2($db,$a,1);
				$son=$d->fetch_assoc();
				$urunad=$son["ad"];
			// urun adı çekme işlemi

			//mutfak eklemesi...
					$saat=date("H");
					$dakika=date("i");
					$mutfakekle="INSERT INTO `mutfak` (`masaid`, `urunid`, `urunad`, `adet`, `saat`, `dakika`,`durum`)
					VALUES ($masaid,$urunid,'$urunad',$adet,$saat,$dakika,'1')";
					$mutfakekleson=$db->prepare($mutfakekle);
					$mutfakekleson->execute();
			//mutfak eklemesi...

			uyari("Adet Güncellendi","success");
				else:
				$a="select * from urunler where id=$urunid";
				$d=benimsorum2($db,$a,1);
				$son=$d->fetch_assoc();
				$urunad=$son["ad"];
				$urunfiyat=$son["fiyat"];
				$gelengarsonid=benimsorum2($db,"SELECT * FROM  garson where durum=1",1)->fetch_assoc();
				$garsonid=$gelengarsonid["id"];
$masadurum="UPDATE `masalar` SET durum='1'WHERE id = $masaid ";
$masadurumson=$db->prepare($masadurum);
$masadurumson->execute();

$ekle="insert into anliksiparis (masaid,garsonid,urunid,urunad,urunfiyat,adet) VALUES ($masaid,$garsonid,$urunid,'$urunad','$urunfiyat',$adet)";
$ekleson=$db->prepare($ekle);
$ekleson->execute();
//mutfak eklemesi...
$saat=date("H");
$dakika=date("i");
$mutfakekle="INSERT INTO `mutfak` (`masaid`, `urunid`, `urunad`, `adet`, `saat`, `dakika`, `durum`)
VALUES ($masaid,$urunid,'$urunad',$adet,$saat,$dakika,'1')";
$mutfakekleson=$db->prepare($mutfakekle);
$mutfakekleson->execute();
uyari("Eklendi","success");


endif;
endif;
else:
	uyari("HATA VAR","danger");
endif;
break;
		case "kontrol":
				$id=htmlspecialchars($_POST["id"]);
				$sifre=htmlspecialchars($_POST["sifre"]);				
				if(@$id!="" && @$sifre!=""){
					$var=benimsorum2($db,"SELECT * from garson where id='$id' and sifre=$sifre",1);
					if($var->num_rows==0){
						uyari("Bilgiler hatalı..","danger");
					}else{
						$garson=$var->fetch_assoc();	
						$garsonid=$garson["id"];
						benimsorum2($db,"UPDATE garson set durum=1 where id=$garsonid",1);
						?>
						<script> 
						window.location.reload();
						</script>
						<?php
					}	


				}else{
					uyari("Boş Alan Bırakmayınız. ","danger");
				}
		break;
	case "garsoncikis":
		benimsorum2($db,"UPDATE garson set durum=0",1);
		header("Location:index.php");
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
