<?php
 include('connect.php');
 if (isset($_POST['insert_add'])) {
   $name=$_POST['name'];
   $prunedstat=$_POST['prunedstat'];

   // If any field empty
   if ($name=='' or $prunedstat=='') {
     echo "<script> alert('Please fill up all the fields')</script>";
     exit();
   }
   else {
     // Insert Query
     $insert_product_query="INSERT INTO `timeline`(`Type`, `Pruned_Status`) VALUES ('$name','$prunedstat')";
     $result_query=mysqli_query($con,$insert_product_query);
     if ($result_query) {
       echo "<script>alert('Successfully Updated')</script>";
     }
   }
 }
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="timelinestyle.css?ts=<?=time()?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Timeline</title>
</head>

<body>

    <div class="topbar">
        <a href="analyst.php">
            <img src="tvalogo.png">
        </a>
        <p>Timeline</p>
        <div></div>
    </div>

    <div class="formcard one">
        <h1>Enlist</h1>
        <form class="" action="" method="post" enctype="multipart/form-data">
            <label class="custom-field">
                <input type="text" name="name" placeholder="Type">
                <input type="text" name="prunedstat" placeholder="Pruned Status">
            </label>
            <input type="submit" name="insert_add" class="insertbutton" value="Submit">
        </form>
    </div>

    <div class="formcard two">
        <h1>Monitor</h1>
        <table class="container">
            <thead>
                <tr>
                    <th>
                        <h1>Timeline ID</h1>
                    </th>
                    <th>
                        <h1>Type</h1>
                    </th>
                    <th>
                        <h1>Pruned Status</h1>
                    </th>
                </tr>
            </thead>
            <tbody>
              <?php
                 $select_query="SELECT * FROM `timeline`";
                 $result_query=mysqli_query($con,$select_query);
                 if($result_query){
                       while ($name=mysqli_fetch_assoc($result_query)){
                         $ida=$name['Timeline_ID'];
                         $type=$name['Type'];
                         $PrunedStatus=$name['Pruned_Status'];

                         echo "<tr>
                             <td>$ida</td>
                             <td>$type</td>
                             <td>$PrunedStatus</td>
                         </tr>";

                       }
                   }
              ?>
            </tbody>
        </table>
        <a href ="timelineupdate.php" class="insertbutton">
            Update
                </a>
    </div>

</body>

</html>
