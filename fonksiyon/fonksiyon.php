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
	function masacek($dv) {  
	$masalar = "select * from masalar";
    $sonuc=$this->benimsorum($dv,$masalar,1);
	while ($masason=$sonuc->fetch_assoc()) :
	/// her sorguda maasaanlik siparis gider ve bu id varmı diye bakar
	$siparisler = 'select * from anliksiparis where masaid='.$masason["id"].'';
  $this->benimsorum($dv,$siparisler,1)->num_rows==0 ? $renk="danger" : $renk="success" ;
	//renk burada 
	echo '<div id="mas" class="col-md-2 col-sm-6 mr-2 mx-auto p-2 text-center text-white">
	<a href="masadetay.php?masaid='.$masason["id"].'">
	<div class="bg-'.$renk.'" id="masa">'.$masason["ad"].'</div></div></a>';
	endwhile; 
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
		echo '<br><a type="button" class="btn btn-success" sectionId="'.$son["id"].'">'.$son["ad"].'</a><br>';
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