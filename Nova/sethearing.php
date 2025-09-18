
<?php
include("config/db_connect.php");
session_start();
$CaseID = $_SESSION['CNUM'];
$sql=" UPDATE `cases` SET `Num_of_Trials` = `Num_of_Trials` + 1 WHERE `Number` ='$CaseID'";
mysqli_query($mysqli,$sql) ;

header('location:judge.php');



?>
