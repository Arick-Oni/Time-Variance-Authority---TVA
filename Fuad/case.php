<?php
 include('connect.php');
 session_start();
 $idl=$_SESSION['ID'];

 if (isset($_POST['insert'])) {
   $variantid=$_POST['variantid'];
   $status=$_POST['status'];

   // If any field empty
   if ($variantid=='' or $status=='') {
     echo "<script> alert('Please fill up all the fields')</script>";
     exit();
   }
   else {
     // Insert Query
     $insert_product_querya="INSERT INTO `cases`(`variant_id`, `Status`, `Analyst_ID`) VALUES ('$variantid','Pending','$idl')";
     $result_querya=mysqli_query($con,$insert_product_querya);
     if ($result_querya) {
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
    <link rel="stylesheet" href="casestyle.css?ts=<?=time()?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Case</title>
</head>

<body>

    <div class="topbar">
    <a href="analyst.php">
      <img src="tvalogo.png">
    </a>
        <p>Case</p>
        <div></div>
    </div>

    <div class="formcard one">
        <h1>Initiate</h1>
        <form class="" action="" method="post" enctype="multipart/form-data">
            <label class="custom-field">
                <!-- <input type="number" name="variantid" placeholder="Variant ID" /> -->

              <select class="" name="variantid" placeholder="Variant ID">
                <option value="">Variant ID</option>
                <?php
                  $select_query="SELECT * FROM `variants`";
                  $result_query=mysqli_query($con,$select_query);
                  while ($row=mysqli_fetch_assoc($result_query)) {
                    $type=$row['Name'];
                    $type_id=$row['ID'];
                    echo "<option value='$type_id'>$type_id</option>";
                    }
                  ?>
              </select>
              <input type="text" name="status" placeholder="Status">
            </label>
            <input type="submit" name="insert" class="insertbutton" value="Open">
        </form>
    </div>

</body>

</html>
