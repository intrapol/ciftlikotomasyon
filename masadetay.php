<?php include("fonksiyon/fonksiyon.php"); $masam = new sistem;
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
var id="<?php echo $masaid; ?>";
$("#veri").load("islemler.php?islem=goster&id="+id);
$("#btn").click(function()  {
	$.ajax({
		type : "POST",
		url :'islemler.php?islem=ekle',
		data :$('#formum').serialize(),
		success : function(donen_veri)
		{
	 $("#veri").load("islemler.php?islem=goster&id="+id);
	 $('#formum').trigger("reset");
	 $("#cevap").html(donen_veri).slideUp(2000);
	},
})
})

$('#urunler a').click(function() {
var sectionId=$(this).attr('sectionId');
$("#sonuc").load("islemler.php?islem=urun&katid=" + sectionId).fadeIn();
})
});
</script>
</head>
<body>
<div class="container-fluid">
<?php
if ($masaid!="") :
$son=$masam->masagetir($db,$masaid);
$dizi=$son->fetch_assoc();
?>
<div class="row border border-dark" id="div1">
<div class="col-md-3" id="div2">
<div class="row">
<div class="col-md-12 border-bottom border-success bg-success text-white mx-auto p-4 text-center" style="font-size:36px;" id="div3">
<a href="index.php" class="btn btn-warning">ANA SAYFA</a><br>
<?php echo $dizi["ad"]; ?></div>
<!--- burada anlık ss -->
<div  class="col-md-12" id="veri"></div>
<!--- burada anlık ss -->
<div id="cevap"></div>
</div>
</div>
<div class="col-md-7"  style="background-color:#F9F9F9">
<div class="row">
<form id="formum">
<div class="col-md-12" id="sonuc"  style="min-height:600px;"></div>
</div>



<div class="row">



<div class="col-md-12" class="div2">



<div class="row" class="div2">

<div class="col-md-6">



<input type="hidden" name="masaid" value="<?php echo $dizi["id"]; ?>" />

<input type="button" id="btn" value="EKLE" class="btn btn-success btn-block mt-4" />



</div>







<div class="col-md-6">

<?php

for ($i=1; $i<=13; $i++) :

echo '<label class="btn btn-success m-2"><input name="adet" type="radio" value="'.$i.'" />'.$i.'</label>';

endfor;

?>

</form>

</div>







</div>





</div>



</div>







<!--

<form id="formum">

<input type="text" name="urunid" />

<input type="text" name="adet" />

<input type="hidden" name="masaid" value="</?php echo $masaid; ?>" />

<input type="button" id="btn" value="EKLE" />



</form>

--->



</div>



<!-- kat en sağ -->

<div class="col-md-2  border-left" id="urunler">



<?php $masam->urungrup($db); ?>





</div>







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
