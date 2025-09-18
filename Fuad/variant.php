<?php
  include('connect.php');
  session_start();
  if (isset($_POST['insert'])) {
    $name=$_POST['name'];
    // $temporal=$_POST['temporal'];
    $nexus=$_POST['nexus'];
    // $soul=$_POST['soul'];
    // $ticket=$_POST['ticket'];
    // $statment=$_POST['statment'];
    $timeline_id=$_POST['timelineID'];
    $hunter_id=$_POST['HunterID'];
    // If any field empty
    if ($name=='' or $timeline_id=='' or $hunter_id=='') {
      echo "<script> alert('Please fill up all the fields')</script>";
      exit();
    }
    else {
      // Insert Query
      $insert_product_query="INSERT INTO `variants`(`Name`,`Temporal_Aura`, `Nexus_Event_Cause`, `Soul_Status`, `TicketNo`, `Statements`, `Timeline_ID`, `Hunter_ID`) VALUES ('$name',NULL,'$nexus',NULL,NULL,NULL,'$timeline_id', '$hunter_id')";
      $result_query=mysqli_query($con,$insert_product_query);
      $last_id = mysqli_insert_id($con);
      $idl=$_SESSION['ID'];
      $insert_query="INSERT INTO `timecell`(`detained_by`, `variant_id`) VALUES ('$idl', '$last_id')";
      $result_quer=mysqli_query($con, $insert_query);
      $last_id2 = mysqli_insert_id($con);
      $insert_query2="INSERT INTO `detained`(`Detained_By`, `Variant_ID`,`TimeCell_ID` ) VALUES ('$idl', '$last_id', '$last_id2')";
      $result_quer2=mysqli_query($con, $insert_query2);
      if ($result_query) {
        echo "<script>alert('Successfully Updated')</script>";
     }
    }
    
    // ekhane variant id fetch hobe
   
 }
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="variantstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Variant</title>
</head>

<body>

    <div class="topbar">
      <a href="analyst.php">
        <img src="tvalogo.png">
      </a>
        <p>Variant</p>
        <div></div>
    </div>

    <div class="formcard one">
        <h1>Enlist</h1>
        <form class="" action="" method="post" enctype="multipart/form-data">
            <label class="custom-field">
                <input type="text" name="name" placeholder="Name">
               <input type="text" name="nexus" placeholder="Nexus Event Cause">
                
                <select class="" name="timelineID" placeholder="Timeline ID">
                  <option value="">Timeline ID</option>
                  <?php
                    $select_query="SELECT * FROM `timeline`";
                    $result_query=mysqli_query($con,$select_query);
                    while ($row=mysqli_fetch_assoc($result_query)) {
                      $type=$row['Type'];
                      $type_id=$row['Timeline_ID'];
                      echo "<option value='$type_id'>$type_id</option>";
                    }
                   ?>
                </select>
                <!-- <input type="number" placeholder="Hunter ID" /> -->
                <select class="" name="HunterID" placeholder="Hunter ID">
                  <option value="">Hunter ID</option>
                  <?php
                    $select_query="SELECT * FROM `minutemen`";
                    $result_query=mysqli_query($con,$select_query);
                    while ($row=mysqli_fetch_assoc($result_query)) {
                      $rank=$row['Rank'];
                      $hunterid=$row['ID'];
                      echo "<option value='$hunterid'>$hunterid</option>";
                    }
                   ?>
                </select>
            </label>
            <input type="submit" name="insert" class="insertbutton" value="Submit">
        </form>
    </div>

    <div class="formcard two">
        <h1>Track</h1>
        <form class="" action="" method="post" enctype="multipart/form-data">
            <label class="custom-field">
                <input type="number" name="id" placeholder="Variant ID" />
            </label>
            <div id="infoBox">
              <!-- Show Query Data -->
            <?php
            if (isset($_POST['show_data'])){
              $id=$_POST['id'];

               $select_query="SELECT * FROM `variants` WHERE ID='$id'";
               $result_query=mysqli_query($con,$select_query);
               if($result_query){
                 $check=mysqli_num_rows($result_query);
                 if($check>0){
                     while ($name=mysqli_fetch_assoc($result_query)){
                       $ida=$name['ID'];
                       $namea=$name['Name'];
                       $nexus=$name['Nexus_Event_Cause'];
                       $timeline=$name['Timeline_ID'];
                       $hunter=$name['Hunter_ID'];

                       echo "<p>ID: $ida - Name: $namea - Nexus Event Cause: $nexus - Timeline ID: $timeline - Hunter ID: $hunter</p>";
                     }
                 }else{
                   echo '<script>alert("Invalid ID")</script>';
                 }
               }

            }
            ?>
                <!-- <p>ID - Name - Nexus Event Cause - Timeline ID - Hunter ID</p> -->
                <hr color="white">
            </div>
            <input type="submit" name="show_data" class="insertbutton" value="Search">
        </form>
    </div>

</body>

</html>
