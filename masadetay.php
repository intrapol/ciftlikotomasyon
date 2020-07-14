<?php include("fonksiyon/fonksiyon.php"); $masam = new sistem;
@$masaid=$_GET["masaid"];

?>
<head>
<meta charset="ISO-8859-1"> 
<script src="dosya/jqu.js"></script>
<link rel="stylesheet" href="dosya/boost.css">
<link rel="stylesheet" href="dosya/stil.css">
<title>MASA:<?php echo $masaid?></title>
<style>
	.button{
    width: 33.33%;
    height: 33.33%;
    font-size: 30px;
    margin: 3px;
    cursor: pointer;
    background: #698ea0;
    border: 1;
    color: white;
}
.text{
    width: 208px;
    margin: 5px;
    font-size: 25px;
    padding: 5px;
    border: 1;
    color: #698ea0;
}
.main{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%)translateY(-50%);
}
.bg{
    background: linear-gradient(to right,red,blue);
    height: 700px;
}
</style>
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

function insert(num) {
            document.formum.adet.value = document.formum.adet.value + num;
        }
		function back() {
            var exp = document.formum.adet.value;
            document.formum.adet.value = exp.substring(0,exp.length-1);
        }
</script>
</head>
<body class="" style="background-color:LightGray;">
<div class="container-fluid ">
	<?php
	if ($masaid!="") :
	$son=$masam->masagetir($db,$masaid);
	$dizi=$son->fetch_assoc();
	?>
		<div class="row border border-dark " id="div1">
			<div class="col-md-4" id="div2">
				<div class="row ">
					<div class="col-md-12 border-bottom border-success bg-info text-white mx-auto p-4 text-center" style="font-size:36px;" id="div3">
					<a href="index.php" class="btn btn-warning">ANA SAYFA</a><br>
					<?php echo $dizi["ad"]; ?></div>
					<!--- burada anlık ss -->
					<div  class="col-md-12 " id="veri"></div>
					<!--- burada anlık ss -->
					<div id="cevap"></div>
				</div>
		</div>
		<div class="col-md-6 "  style="background-color:#F9F9F9">
			<div class="row ">
				<form id="formum" name="formum">

				<div class="col-md-12" id="sonuc"  style="min-height:50%;">
				
				<img src="dosya/işarettik.png" style="width:50%;height:50%;" alt="">
				</div>
			</div>
			<div class="row ">
				<div class="col-md-12" class="div2">
					<div class="row" class="div2">

						<div class="col-md-6">
							<input type="hidden" name="masaid" value="<?php echo $dizi["id"]; ?>" />
							<input type="button" id="btn" value="EKLE" style="height:80px; width:100%;" class="btn btn-success btn-block mt-4" />

						</div>


						<div class="col-md-12">
							<?php
							//for ($i=1; $i<=25; $i++) :
							//echo '<label class="btn btn-info m-2"><input name="adet" type="radio" value="'.$i.'" />'.$i.'</label>';
							//endfor;
							?>
							<h2 class="alert alert-warning">Adet:<input class="text" name="adet" type="text"></h2>
				
							

							</form>
		<table>
            <tr>
                <td> <input class="button" type="button" value="1" onclick="insert(1)"> </td>
                <td> <input class="button" type="button" value="2" onclick="insert(2)"> </td>
                <td> <input class="button" type="button" value="3" onclick="insert(3)"></td>
            </tr>
            <tr>
                <td><input class="button" type="button" value="4" onclick="insert(4)"></td>
                <td><input class="button" type="button" value="5" onclick="insert(5)"></td>
                <td><input class="button" type="button" value="6" onclick="insert(6)"></td>
            </tr>
            <tr>
                <td><input class="button" type="button" value="7" onclick="insert(7)"></td>
                <td><input class="button" type="button" value="8" onclick="insert(8)"></td>
                <td><input class="button" type="button" value="9" onclick="insert(9)"></td>
            </tr>
            <tr>
				<td colspan="2"> <input class="button" style="width:80%" type="button" value="0" onclick="insert(0)"> </td>
				<td><input class="button" type="button" value="<" onclick="back()"></td>
            </tr>
        </table>
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

		<div class="col-md-2  border-left" id="urunler" style="height: 600px;overflow-y: auto;overflow-x: hidden;">
		
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
