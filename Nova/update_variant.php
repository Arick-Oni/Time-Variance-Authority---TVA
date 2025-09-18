

<?php
    include("config/db_connect.php");
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "final");
    $ID=$_POST['idd'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedOption = $_POST['VID']; 

        
        
        
        if ($selectedOption = 1) {
            $sql1 = 'Prune';
        } elseif ($selectedOption = 2) {
            $sql1 = 'Reset';
        }

        $sql = "UPDATE `variants` SET `PruneOrReset` = '$sql1' WHERE `ID`='$ID'";
        

  
        if (mysqli_query($conn, $sql)) {
            echo "Update successful";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        
        mysqli_close($conn);
    }
?>
