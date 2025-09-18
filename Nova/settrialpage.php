
<?php
include("config/db_connect.php");
    session_start();
    $_SESSION['CNUM'] = $_GET['CaseNumber']; 

    if ($_SESSION['loggedin'] && $_SESSION['ID'] && $_SESSION['userType'] === 'Judge') {
        
        $userID = $_SESSION['ID'];
        
    } else {
        
        header('Location: log_in.php');
        exit();
    }
    if($_SESSION['ID']){
        $ID=mysqli_real_escape_string($mysqli, $_SESSION['ID']);
        $sql="SELECT * FROM employee WHERE ID='$ID'";
        $result=mysqli_query($mysqli,$sql);
        $row=mysqli_fetch_assoc($result);
        mysqli_free_result($result);
       
    }
   if(isset($_GET["varr"])){
    $sql17="INSERT INTO `requests` VALUES(NULL, current_timestamp(), 'ExtraCRT', 'Timekeeper', 'Pending', '$userID', NULL, NULL, NULL)";
    $run17=mysqli_query($mysqli, $sql17);
    echo '<script>alert("Extra Court Room requested!");</script>';
    header('Location: settrialpage.php');
   }

?>
<?php include 'DESIGNPAGE.html'; ?>


<!-------------Form------------- --> 

<div class="wrap">
<form class="formm" action="submitkorbo.php" method="POST">
  <div class="inputfield">
      <label>Room Number</label>
      <div class="custom_select" >
      <?php
    $sql2 = "SELECT * FROM `court` WHERE `In-Use` = 0";
    $result2 = mysqli_query($mysqli, $sql2);
?>

<select id="user_type" name="RNUM" required >          
    <option value="">Select</option>

    <?php
        while ($row2 = mysqli_fetch_assoc($result2)) {
          
          $RoomNo = $row2['CourtNumber'];
          $Use = $row2['In-Use'];
          $useDisplay = ($Use == 0) ? 'Open' : 'Occupied';
          echo '<option value="' . $RoomNo . '">' . $RoomNo . ' - ' . $useDisplay . '</option>';
          
        }
    ?>
</select>
      </div>
  </div>
  <a href="settrialpage.php?varr='1'"class="submitbuttonnn" type="submit">Request for Court Room</a>


  <div class="inputfield" id="verdictline">
      <label>Verdict</label>
      <input  class="inputbox" type="text" name="VERD" id="verdictbox" required> 
  </div>
    <input class="submitbuttonn" type="submit" name="Make Verdict">
    <a href="sethearing.php"class="submitbuttonnn" type="submit">More Trial</a>
</form>

  </div>

</body>
</html>