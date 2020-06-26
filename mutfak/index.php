<?php $db = new mysqli ("localhost","serdar","123456","siparis") or die ("Bağlanamadı");

$db->set_charset ("utf8");
include("mutfakislem.php");
$mutfak = new mutfak;

?>  

<!DOCTYPE html>
<html lang="tr">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../dosya/jqu.js"></script>
<link rel="stylesheet" href="../dosya/boost.css">
<link rel="stylesheet" href="../dosya/stil.css">
    <title>Mutfak</title>
</head>
<body>

<div class="container-filued">
    <div class="row">
    <!--<div class="card border-success mb-3" style="max-width: 23rem;">
  <div class="card-header bg-transparent border-success">MASA ADI</div>
  <div class="card-body ">
    <table>
        <tr>
        <td>zaman</td>

            <td>ürünadı</td>
            <td>ürünadet </td>
            <td><form action="" method="post">
                
            <input type="button" value="HAZIR" class="btn btn-success"></form></td>


        </tr>
        
    </table>
  </div>
  <div class="card-footer bg-transparent border-success">SİPARİŞ ZAMANI</div>
</div>-->


<?php 
$mutfak->mutfaksparis($db);
?>
    </div>
</div>

</body>
</html>