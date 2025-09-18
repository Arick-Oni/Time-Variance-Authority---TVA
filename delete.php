<?php
include("config/db_connect.php");
if (isset($_GET['id'])) {  
        $Record_ID = $_GET['id'];  
        $query = "DELETE FROM `specimen` WHERE `Record_ID` = '$Record_ID'";  
        $run = mysqli_query($conn,$query);  
        if ($run) {  
            header('location:clerk_specimen.php');  
        }else{  
            echo "Error: ".mysqli_error($conn);  
        }  
    }  
?>