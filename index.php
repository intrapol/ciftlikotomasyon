<?php include("fonksiyon/fonksiyon.php"); $sistem = new sistem; ?>
<head>
<meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
<script src="dosya/jqu.js"></script>
<link rel="stylesheet" href="dosya/boost.css">
<title>TEST</title>
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
</head>
<body>
<div class="container-fluid">
<div class="row table-dark" id="rows">
<div class="col-md-3 border right">Toplam Sipariş : <a class="text-warning"><?php $sistem->siparistoplam($db);?></a></div>
<div class="col-md-3 border right">Doluluk Oranı : <a class="text-warning"><?php $sistem->doluluk($db) ?></a></div>
<div class="col-md-3 border right">Toplam Masa : <a class="text-warning"><?php $sistem->masatoplam($db);?> </a></div>
<div class="col-md-3 border right">Tarih : <a class="text-warning">10</a></div>
</div>
<div class="row">
<?php $sistem->masacek($db); ?>
</div>
</div>
</body>
</head>
