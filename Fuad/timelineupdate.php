<?php
include("connect.php");
if (isset($_POST['update_data'])){
$id=$_POST['id'];
$name=$_POST['name'];
$prunedstat=$_POST['prunedstat'];

// If any field empty
if ($name=='' or $prunedstat=='') {
  echo "<script> alert('Please fill up all the fields')</script>";
  exit();
}
else {
  // Insert Query
  $insert_product_query="UPDATE `timeline` SET `Type`='$name',`Pruned_Status`='$prunedstat' WHERE `Timeline_ID`=$id";
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
    <link rel="stylesheet" href="timelineupdatestyle.css">
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
        <h1>Update</h1>
        <form class="" action="" method="post" enctype="multipart/form-data">
            <label class="custom-field">
              <?php
              if (isset($_POST['search'])){
                $idsearch=$_POST['idsearch'];
                $select_query="SELECT * FROM `timeline` WHERE Timeline_ID=$idsearch";
                $result_query=mysqli_query($con,$select_query);
                if($result_query){
                      while ($name=mysqli_fetch_assoc($result_query)){
                        $ida=$name['Timeline_ID'];
                        $type=$name['Type'];
                        $PrunedStatus=$name['Pruned_Status'];
                        echo "<input type='text' name='id' placeholder='Timeline ID' value='$ida'>
                          <input type='text' name='name' placeholder='Type' value='$type'>
                          <input type='text' name='prunedstat' placeholder='Pruned Status' value='$PrunedStatus'>";
                      }
                  }
              }else{
                echo "<input type='text' name='id' placeholder='Timeline ID'>
                  <input type='text' name='name' placeholder='Type'>
                  <input type='text' name='prunedstat' placeholder='Pruned Status'>";
              }
               ?>
            </label>
            <input type="submit" name="update_data" class="insertbutton" value="Submit">
        </form>
    </div>



    <div class="formcard two">
        <h1>Track</h1>
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
              if (isset($_POST['search'])){
                $idsearch=$_POST['idsearch'];
                $select_query="SELECT * FROM `timeline` WHERE Timeline_ID=$idsearch";
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
              }else{
                $select_query="SELECT * FROM `timeline` LIMIT 5";
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
              }

              ?>
            </tbody>
        </table>
        <form class="" action="" method="post">
          <label class="custom-field">
            <input type="number" name="idsearch" value="">
          </label>
          <input type="submit" name="search"  class="insertbutton" value="Search">
        </form>
    </div>

</body>

</html>
