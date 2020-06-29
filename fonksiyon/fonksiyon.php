<?php

$db = new mysqli ("localhost","serdar","123456","siparis") or die ("Bağlanamadı");

$db->set_charset ("utf8");
class sistem {
	private function benimsorum($vt,$sorgu,$tercih) {
	$a =$sorgu;
	$b=$vt->prepare($a);
	$b->execute();
	if ($tercih==1):
	return $c=$b->get_result();
	endif;
	}
	function benimsorum2($vt,$sorgu,$tercih) {
		$a =$sorgu;
		$b=$vt->prepare($a);
		$b->execute();
		if ($tercih==1):
		return $c=$b->get_result();
		endif;
		}
		function garsonbak($db){
			@$gelen=$this->benimsorum($db,"SELECT * FROM  garson where durum=1",1)->fetch_assoc();
			if(@$gelen["ad"]!=""){
				echo @$gelen["ad"];
echo '<a href="islemler.php?islem=garsoncikis"><kbd class="bg-danger m-3">ÇIKIŞ</kbd></a>';
 

			}else{
				echo "NULL";
			}
		}
	function masacek($dv) {
	$masalar = "select * from masalar";
    $sonuc=$this->benimsorum($dv,$masalar,1);
		$bos=0;
		$dolu=0;
	while ($masason=$sonuc->fetch_assoc()) {
		if($masason["id"]==0 || $masason["id"]==-1 ){}else{
	/// her sorguda maasaanlik siparis gider ve bu id varmı diye bakar
	$siparisler = 'select * from anliksiparis where masaid='.$masason["id"].'';


	$this->benimsorum($dv,$siparisler,1)->num_rows==0 ? $renk="danger" : $renk="success" ;
	$this->benimsorum($dv,$siparisler,1)->num_rows==0 ? $bos++ : $dolu++ ;
//renk burada
	echo '<div id="mas" class="col-md-2 col-sm-6 mr-2 mx-auto p-2 text-center text-white">
	<a href="masadetay.php?masaid='.$masason["id"].'">
	<div class="bg-'.$renk.'" id="masa">'.$masason["ad"].'</div></div></a>';
}}
		$dol="UPDATE doluluk set bos=$bos, dolu=$dolu WHERE id=1";
		$dolson=$dv->prepare($dol);
		$dolson->execute();

	}
// MNASALARIN DOLULUK ORANLARINI GÖSTERİR
	function doluluk($dv){
				$son=$this->benimsorum($dv,"SELECT * FROM doluluk",1);
				$veriler=$son->fetch_assoc();
				$toplam= $veriler["bos"] + $veriler["dolu"];
				$oran = ($veriler["dolu"] / $toplam)*100;
				echo $oran=substr($oran,0,5). " %";


	}
	//masa detay fonksiyon
	function masagetir ($vt,$id) {
	$get="select * from masalar where id=$id";
	return$this->benimsorum($vt,$get,1);
	}
	function urungrup($db) {
		$se="select * from kategori";
		$gelen=$this->benimsorum($db,$se,1);
		while ($son=$gelen->fetch_assoc()) :
		echo '<br><a type="button" class="btn btn-info"  style="height:50px; width:100%;" sectionId="'.$son["id"].'">'.$son["ad"].'</a><br>';
		endwhile;
	}
		function masatoplam($dv) {
		$masalar = "select * from masalar";
	$sonuc=$this->benimsorum($dv,$masalar,1);
	echo $sonuc->num_rows;
	}
    function siparistoplam($dv) {
		$masalar = "select * from anliksiparis";
	$sonuc=$this->benimsorum($dv,$masalar,1);
	echo $sonuc->num_rows;
	}
}

?>