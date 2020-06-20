<?php include("fonksiyon/fonksiyon.php"); $sistem = new sistem;
$veri=$sistem->benimsorum2($db,"SELECT * from garson where durum=1",1)->num_rows;
//header("refresh:2;");  // sayfanın otomatik yenilenmesini sağlıyrouz ..... anlık spariş sayfasında gözükecektir


?>
<head>
<meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
<script src="dosya/jqu.js"></script>
<script src="dosya/boostmodal.js"></script>
<link rel="stylesheet" href="dosya/boost.css">
<title>OTOMASYON SİSTEMİ</title>
<style>
#rows {
height:32px;
}
#masa {
height:80px;
margin:12px;
font-size:35px;
border-radius:15px;
}
#mas a:link, #mas a:visited {
	color:white;
	text-decoration:none;
}
</style>
<script>
	$(document).ready(function(){
			var deger =<?php echo $veri; ?>;
			if(deger==0){
				$('#girismodal').modal({
			backdrop: 'static', // dışardan gelen tıklamaları static  aldığımız içni işlemez hale geliyor
			keyboard: false  // esc ye basınca çıkmasını engeller

	});
			}else {
				$('#girismodal').modal('hide');
			}
		 
		
		$('body').on('hidden.bs.modal','.modal', function(){
			$(this).removeData('bs.modal'); 		// modalboxu kapattığımızda ön belleğe verilerin geçmesini engelleyerek  karışıklık olmasını engellemiş oluyoruz
		});
		$('#girisbak').click(function() {
		$.ajax ({
			type : "POST",
			url :'islemler.php?islem=kontrol',
			data : $('#garsonform').serialize(),
			success: function(donen_veri)	{
				$('#garsonform').trigger("reset");
				
				$('.modalcevap').html(donen_veri);
			},
		})
	})
	})
</script>
</head>
<body>
<div class="container-fluid">
<div class="row table-dark" id="rows">
<div class="col-md-2 border right">Toplam Sipariş : <a class="text-warning"><?php $sistem->siparistoplam($db);?></a></div>
<div class="col-md-2 border right"><a class="text-success" href="">+ </a></div>
<div class="col-md-2 border right">Toplam Masa : <a class="text-warning"><?php $sistem->masatoplam($db);?> </a></div>
<div class="col-md-3 border right">Aktif Garson : <a class="text-warning"><?php $sistem->garsonbak($db);?></div>
<div class="col-md-3 border right">Tarih :<a class="text-warning"> <?php echo date('d.m.Y H:i:s'); ?></a></div>
</div>
<div class="row">
<?php $sistem->masacek($db); ?>
</div>
<!-- The Modal -->
<div class="modal fade" id="girismodal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header text-center">
          <h4 class="modal-title">Garson Girişi</h4>
          
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        
        
         <form id="garsonform">
         
         <div class="row mx-auto text-center">
         
         
         
         		<div class="col-md-12">Garson Ad</div>
        		 <div class="col-md-12"><select name="id" class="form-control mt-2">
					 <?php 

					 $b=$sistem->benimsorum2($db,"select * from garson",1);
					 while($sonuc=$b->fetch_assoc()){
						 echo'<option value="'.$sonuc["id"].'">'.$sonuc["ad"].'</option>';
						 
					 }
					 

					 ?>
              
				</select>
				 </div>
         
        		
         
        		 <div class="col-md-12">Şifre </div>         
                <div class="col-md-12">
				
                <input name="sifre" type="password" class="form-control  mt-2" />                
                </div>  
                 
                
                <div class="col-md-12">
               <input type="button" id="girisbak" value="GİR" class="btn btn-info mt-4"/>                
                </div>
         
         </div>
         
         
         </form>
        </div>
        
        
         <div class="modalcevap">
          
        </div>
     
        
      </div>
    </div>
  </div>

</div>
</body>
</head>
