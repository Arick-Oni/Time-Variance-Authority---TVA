<?php
 include('connect.php');
 if (isset($_POST['insert_add'])) {
   $name=$_POST['name'];
   $branch=$_POST['branch'];

   // If any field empty
   if ($name=='' or $branch=='') {
     echo "<script> alert('Please fill up all the fields')</script>";
     exit();
   }
   else {
     // Insert Query
     $insert_product_querya="INSERT INTO `devices`( `name`, `branch_no`) VALUES ('$name','$branch')";
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
    <link rel="stylesheet" href="devicesstyle.css?ts=<?=time()?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Devices</title>
</head>

<body>

    <div class="topbar">
    <a href="analyst.php">
      <img src="tvalogo.png">
    </a>
        <p>Devices</p>
        <div></div>
    </div>

    <div class="query">
        <h1>Enlist</h1>
        <form class="" action="" method="post" enctype="multipart/form-data">
            <label class="custom-field">
                <input type="text" name="name" placeholder="Name">
                <!-- <input type="number" name="branch" placeholder="RAD branch no." /> -->
                <select class="" name="branch" placeholder="RAD branch no.">
                  <option value="">RAD branch no.</option>
                  <?php
                    $select_query="SELECT * FROM `repair_advancement`";
                    $result_query=mysqli_query($con,$select_query);
                    while ($row=mysqli_fetch_assoc($result_query)) {
                      $type=$row['head_engineer'];
                      $type_id=$row['branch_no'];
                      echo "<option value='$type_id'>$type_id</option>";
                    }
                   ?>
                </select>
            </label>
            <input type="submit" name="insert_add" class="querydevice" value="Add">
        </form>
    </div>

    <br>

    <div class="query">
        <h1>Inquery</h1>
        <form class="" action="" method="post" enctype="multipart/form-data">
            <label class="custom-field">
                <input type="number" name="id" placeholder="ID" />
            </label>
            <br>
            <div id="infoBox">
              <!-- Show Query Data -->
            <?php
            if (isset($_POST['show_data'])){
              $id=$_POST['id'];

               $select_query="SELECT * FROM `devices` WHERE device_id='$id'";
               $result_query=mysqli_query($con,$select_query);
               if($result_query){
                 $check=mysqli_num_rows($result_query);
                 if($check>0){
                     while ($name=mysqli_fetch_assoc($result_query)){
                       $ida=$name['device_id'];
                       $namea=$name['name'];
                       $brancha=$name['branch_no'];
                       echo "<p>ID:$ida - $namea - Branch No:$brancha</p>";
                     }
                 }else{
                   echo '<script>alert("Invalid ID")</script>';
                 }
               }

            }
            ?>
                <!-- <p>ID - Name - RAD brance no.</p> -->
                <hr color="white">
            </div>
            <input type="submit" name="show_data" class="querydevice" value="Search">
        </form>
    </div>

</body>

</html>
