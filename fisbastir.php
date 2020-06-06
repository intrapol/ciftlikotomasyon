<?php include("fonksiyon/fonksiyon.php"); $masam = new sistem;
@$masaid=$_GET["masaid"];
?>
<head>
<meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
<script src="dosya/jqu.js"></script>
<link rel="stylesheet" href="dosya/boost.css">
<link rel="stylesheet" href="dosya/stil.css">
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

</head>
<body onload="window.print()">
<div class="container-fluid">
<div class="row">
<div class="col-md-2 mx-auto">

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
	echo '<table class="table">
	<tr>
	<td colspan="3" class="border-top-0 text-center">MASA:'.$dizi["ad"].'</strong>
</td>
</tr>
<tr>
<td colspan="3" class="border-top-0 text-center">TARİH:'.date("d.m.Y").'</strong>
</td>
</tr>
<tr>
<td colspan="3" class="border-top-0 text-center">SAAT:'.date("h:i:s").'</strong>
</td>
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
									<td colspan="1" class="border-top-0 text-center">Ad:    '.$gelenson["urunad"].'</strong></td>
									<td colspan="1" class="border-top-0 text-center">Adet:  '.$gelenson["adet"].'</strong></td>
									<td colspan="1" class="border-top-0 text-center">Tutar:  '.number_format($tutar,2,'.',',').'</strong></td>
									</tr>';
			endwhile;
	echo '
	<tr>
<td colspan="2" class="border-top-0 text-center">GENEL TOPLAM:</strong></td>
<td colspan="2" class="border-top-0 text-center">'.number_format($sontutar,2,'.',',').'₺</strong></td>

</tr>
	
			</tbody></table>
	<!--
	 <form id="hesapform">


	 <input type="hidden" name="hesapalid" value="'.$id.'" />
	 <input type="button" id="btnn" value="HESABI KAPAT" class="btn btn-danger btn-block mt-4" />
	 </form>
		-->
		';
	endif;
?>




</div>
</div>


<?php

else:


echo "hata var";


endif;


?>

</div>

</body>

</head>
