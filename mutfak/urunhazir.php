<?php 
include("mutfakislem.php");
$id=$_POST["id"];
$del="DELETE FROM `mutfak`
WHERE id = $id";
$delson=$db->prepare($del);
$delson->execute();
header("Location:index.php");

?>