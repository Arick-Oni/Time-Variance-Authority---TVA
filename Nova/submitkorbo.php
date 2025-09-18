
<?php
include("config/db_connect.php");
session_start();
$CaseID = $_SESSION['CNUM'];
$Rnum= $_POST ['RNUM'];
$VER= $_POST['VERD'];
$Name=$_SESSION['name'];
echo $CaseID,$Rnum,$VER.$Name;
$sql=" INSERT INTO `trial` (`Trial_ID`, `Case_Number`, `Court_Number`, `Verdict`,`Judge_Name`) VALUES (NULL, '$CaseID', '$Rnum', '$VER','$Name')";




if (mysqli_query($mysqli, $sql)) {
   
    $sql2="UPDATE `cases` SET `Status` = 'Closed' WHERE `cases`.`Number` = $CaseID";
    mysqli_query($mysqli, $sql2);
    header('location:judge.php');
} else {
    echo "Error: " . mysqli_error($mysqli);
}




?>
