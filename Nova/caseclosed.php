
<?php
include("config/db_connect.php");
session_start();
$CaseID = $_GET['CaseNumber'];

$sql=" UPDATE `cases` SET `Status` = 'Cancelled' WHERE `cases`.`Number` = $CaseID";
mysqli_query($mysqli,$sql) ;

header('location:judge.php');

?>
