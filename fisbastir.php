<?php include("fonksiyon/fonksiyon.php"); $masam = new sistem;
@$masaid=$_GET["masaid"];
?>
<head>
<meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
<script src="dosya/jqu.js"></script>
<link rel="stylesheet" href="dosya/boost.css">

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

	

});
</script>
<title>FİŞ BASTIR</title>
<style>
body{
	overflow-x: hidden !important;
}</style>

</head>
<body onload="window.print()">


<?php
if ($masaid!="") :
$son=$masam->masagetir($db,$masaid);
$dizi=$son->fetch_assoc();
$dizi["ad"];


$id=htmlspecialchars($_GET["masaid"]);
		$a="SELECT * FROM anliksiparis WHERE masaid=$id";
	$d=$masam->benimsorum2($db,$a,1);
	if ($d->num_rows==0) :
	uyari("Henüz Sparis yok","danger");
	else:
	echo '<table>
	<tr>
	<td colspan="3" class="text-center"><h3>MASA: '.$dizi["ad"].'</h3></strong>
</td>
</tr>
<tr>
<td colspan="3" class="text-center">TARİH: '.date("d.m.Y").'</strong>
</td>
</tr>
<tr>
<td colspan="3" class="border-top-0 text-center">SAAT: '.date("h:i:s").'</strong>
</td>
</tr>
<tr>
									<td>Ürün Ad</td>
									<td>Adet</td>
									<td>Tutar</td>
									</tr>
	';
		$adet=0;
		$sontutar=0;
		$masaid=0;
			while ($gelenson=$d->fetch_assoc()) :
								$tutar = $gelenson["adet"] * $gelenson["urunfiyat"];
								$adet +=$gelenson["adet"];
								$sontutar +=$tutar;
								
								
									echo '<tr>
									<td>'.$gelenson["urunad"].'</td>
									<td>'.$gelenson["adet"].'</td>
									<td>'.number_format($tutar,2,'.',',').'</td>
									</tr>';
			endwhile;
	echo '
	<tr>
<td colspan="2">GENEL TOPLAM:</strong></td>
<td colspan="2"><h4>'.number_format($sontutar,2,'.',',').'₺</h4></strong></td>

</tr>
	
			</tbody></table>
				
		';
	endif;
?>
<?php
else:
echo "hata var";
endif;
?>
</body>
</head>
