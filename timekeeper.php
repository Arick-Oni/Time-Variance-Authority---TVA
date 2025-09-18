<?php
    include("config/db_connect.php");
    session_start();
    $sql = "SELECT * FROM `requests` WHERE `Receiver_Type`='Timekeeper' AND STATUS='Pending' ORDER BY `ID` ASC" ;
    
	$result =mysqli_query($conn,$sql);

    
    if ($_SESSION['loggedin'] && $_SESSION['ID'] && $_SESSION['userType'] === 'Timekeeper') {
        
        $userID = $_SESSION['ID'];
        
    } else {
        
        header('Location: log_in.php');
        exit();}
    $userID=$_SESSION['ID'];
    

    if (isset($_GET['ID'])) {
        $ID = $_GET['ID'];
        $sql2="UPDATE `requests` SET `Status`= 'Completed' , `Action_ID`='$userID' WHERE `ID`='$ID'";
        $run=mysqli_query($conn,$sql2);
        header("location:timekeeper.php");

           
    }
    if (isset($_GET['ID2'])) {
        $ID = $_GET['ID2'];
        $sql2="UPDATE `requests` SET `Status`= 'Declined' , `Action_ID`='$userID' WHERE `ID`='$ID'";
        $run=mysqli_query($conn,$sql2);
        if ($run) {  
            header('location:timekeeper.php');
        }else{
            mysqli_errno($conn);
        }     
    }
    if (isset($_POST['locker'])) {
        $cap = $_POST['Capacity'];
        $loc = $_POST['Location'];
        mysqli_query($conn,"INSERT INTO `evidence_locker` VALUES(NULL,'$cap', 0, '$loc' )");
        header("Location: timekeeper.php");
    }
    if (isset($_POST['court'])) {
        $RN = $_POST['RN'];
        $BN = $_POST['BN'];
        mysqli_query($conn,"INSERT INTO `court` VALUES(NULL,'$RN', '$BN' )");
        header("Location: timekeeper.php");
    }
    if (isset($_POST["RA"])) {
        $Head= $_POST["Head"];
        $Active= $_POST["Active"];
        mysqli_query($conn,"INSERT INTO `repair_advancement` VALUES(NULL, '$Head', '$Active')");
    }
    if (isset($_POST["armory"])) {
        $cap= $_POST["cap"];
        $loc= $_POST["loc"];
        mysqli_query($conn,"INSERT INTO `armory` VALUES(NULL, '$cap', '$loc')");
    }
    if (isset($_GET["del"])) {
        $del= $_GET["del"];
        mysqli_query($conn,"DELETE FROM `evidence_locker` WHERE `Locker_Num`='$del'");
    }
    if (isset($_GET["del2"])) {
        $del2= $_GET["del2"];
        mysqli_query($conn,"DELETE FROM `repair_advancement` WHERE `branch_no`='$del2'");
    }
    if (isset($_GET["del3"])) {
        $del3= $_GET["del3"];
        mysqli_query($conn,"DELETE FROM `court` WHERE `CourtNumber`='$del3'");
    }
    if (isset($_GET["del4"])) {
        $del4= $_GET["del4"];
        mysqli_query($conn,"DELETE FROM `armory` WHERE `armory_id`='$del4'");
    }
    
    
   

    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timekeeper</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nova+Square&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="clerk_css.css">
    <style>
        .btn{
            height: 35px;
            width: 60px;
            margin-left: 10px;
        }
        .btnn{
            position:fixed;
            left:62%; 
            height:45px; 
            width:auto; 
            z-index:1;
            vertical-align: center;
        }
    </style>
</head>
<body>
    <div class="video">
        <video autoplay loop muted playsinline>
            <source src="img\timekeeper.mp4" type="video/mp4">       
        </video>
    </div>
    <div class="navbar">
            <a href="timekeeper.php" class="TVAdiv"><img src="1701439279944.png" class="TVAdiv"></a>  
    </div>
    
    <a href="#" data-target="mobile-links" class="btn btnn sidenav-trigger brand z-depth-0"  style=" top:25%;   "><i class="material-icons" style="margin-left: 1px;">account_balance</i> Locker</a>
    <a href="#" data-target="mobile-links2" class="btn btnn sidenav-trigger  brand z-depth-0"  style=" top:35%; "><i class="material-icons" >device_hub</i> RA Dept</a>
    <a href="#" data-target="mobile-links3" class="btn btnn sidenav-trigger brand z-depth-0"  style=" top:45%; "><i class="material-icons" style="margin-left: 1px;">gavel</i> Court</a>
    <a href="#" data-target="mobile-links4" class="btn  btnn sidenav-trigger brand z-depth-0"  style="top:55%;"><i class="material-icons" style="margin-left: 1px;">business</i> Armory</a>
    <a href="index.php" class="btn  btnn brand z-depth-0"  style="top:65%;"> Log Out <i class="material-icons" style="margin-left: 1px;">exit_to_app</i></a>
    


    <div class="tablee" style="background-color: rgba(255, 103, 34, .75) ; position:relative; top:11%; width: 280px; height:60px;"><h5 class="center" style="color:bisque; ">Requests Panel</h5></div>
    <div class="tablee" style="background-color: rgba(255, 150, 100, .40); width:800px; max-height:550px;" >
    <table class="highlight" id="mytable">
    <div class="container" style="margin-left: 20px;">
        <input type="text" placeholder="Search by" id="searchvar" name="" style="width: 120px; height: 20px; margin-left: 20px; font-family:'Nova Square'; " onkeyup="search()">
        <div class="container" style="height:20px; width:80px; display:inline-block; color: bisque; ">
        <select class="inpp" id="inp" name="Type" onchange="search()">
            
            <option value="0" >ID</option>
            <option value="1" >Date</option>
            <option value="2" >Description</option>
            <option value="3" >Status</option>
            <option value="4">Requestee</option>
        </select>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var elems = document.querySelectorAll('select');
                    var instances = M.FormSelect.init(elems, {});
                });
        </script></div>
        <a href="#"> <i class="material-icons white-text" >search</i></a>
    </div>
        <thead>
          <tr>
              <th>ID</th>
              <th>Date</th>
              <th>Description</th>
              <th>Status</th>
              <th>Requestee</th>
              <th>Action</th>
          </tr>
        </thead>

        <?php
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['Date'] . "</td>";
                        echo "<td>" . $row['Description'] . "</td>";
                        echo "<td>" . $row['Status'] . "</td>";
                        $employeeID = $row['Requestee_ID'];
                        $nameQuery = mysqli_query($conn, "SELECT `Name` FROM `employee` WHERE `ID` = $employeeID");
                        $nameResult = mysqli_fetch_assoc($nameQuery);
                        $name = $nameResult ? $nameResult['Name'] : "No employee found";
                        echo "<td>" . $name . "</td>";
                        echo "<td><a href='timekeeper.php?ID=" . $row['ID'] ."'class='btn'><i class='material-icons'>done</i></a><a href='timekeeper.php?ID2=" . $row['ID'] . "' class='btn'><i class='material-icons'>delete</></a> </td>";
                        echo "</tr>";
                       
                    }
                ?>
          
        </tbody>

    </table>

    </div>
    <div class="sidenav" style="height: 600px; width: 400px; margin-top:105px; border-radius: 75px 0px 0px 75px; background-color: rgba(255, 171, 64, 1);overflow:hidden;" id="mobile-links">
			<ul class="center" style="color:bisque;font-size:22px;">Locker rooms</ul>	
				<div class="collection center" style="height: 225px; width: 350px; overflow:auto; margin-left: 50px; font-family: 'Nova Square';  border-radius: 100px 0px 0px 100px;">
					
					
					
					<?php
                        $sql18="SELECT * FROM `evidence_locker`";
                        $result18 = mysqli_query($conn, $sql18);
                        $row18=mysqli_fetch_all($result18, MYSQLI_ASSOC);
						foreach($row18 as $row1){
							
							?>
							
							<div class='collection-item'><?php echo $row1['Locker_Num'] ?> -<?php echo $row1['Location'] ?> :<?php echo $row1['Count_Items'] ?>/<?php echo $row1['Capacity'] ?><a href="timekeeper.php?del=<?php echo $row1['Locker_Num'] ; ?>" class="btn " style=' margin-left:20px;display: inline-block;'><i class="material-icons">delete</i></a></div> 
						<?php }?>
					
					
			</div>
            <div class='tablee center' style="width:200px;margin-left:100px;">
            <h6 style="color:bisque;">Add a locker</h6>
            <form method="post" action='' name='locker'>
                <label style="color:bisque">Capacity</label>
                <input type="number" name= 'Capacity' required>
                <label style="color:bisque">Location</label>

                <input type="text" name="Location" required>
                <input type="submit" name="locker"  value="submit" class="btn brand z-depth-0" style="margin-left: 0px;height:auto;width:auto;">
            </form>
            </div>
        </div>


        <div class="sidenav" style="height: 600px; width: 400px; margin-top:105px; border-radius: 75px 0px 0px 75px; background-color: rgba(255, 171, 64, 1);overflow:hidden;" id="mobile-links2">
			<ul class="center" style="color:bisque;font-size:22px;">RA Branches</ul>	
				<div class="collection center" style="height: 225px; width: 350px; overflow:auto; margin-left: 50px; font-family: 'Nova Square';  border-radius: 100px 0px 0px 100px;">
					
					
					
					<?php
                        $sql18="SELECT * FROM `repair_advancement`";
                        $result18 = mysqli_query($conn, $sql18);
                        $row18=mysqli_fetch_all($result18, MYSQLI_ASSOC);
						foreach($row18 as $row1){
							
							?>
							
							<div class='collection-item'><?php echo $row1['branch_no'] ?> -<?php echo $row1['head_engineer'] ?> :<?php echo $row1['active'] ?><a href="timekeeper.php?del2=<?php echo $row1['branch_no'] ; ?>" class="btn " style=' margin-left:20px;display: inline-block;'><i class="material-icons">delete</i></a></div> 
						<?php }?>
					
					
			</div>
            <div class='tablee center' style="width:200px;margin-left:100px;">
            <h6 style="color:bisque;">Add a RA dept</h6>
            <form method="post" action='' name='locker'>
                <label style="color:bisque">Head Engineer</label>
                <input type="text" name= 'Head' required>
                <label style="color:bisque">Active</label>

                <input type="text" name="Active" required>
                <input type="submit" name="RA"  value="submit" class="btn brand z-depth-0" style="margin-left: 0px;height:auto;width:auto;">
            </form>
            </div>
        </div>
        
        
        <div class="sidenav" style="height: 600px; width: 400px; margin-top:105px; border-radius: 75px 0px 0px 75px; background-color: rgba(255, 171, 64, 1);overflow:hidden;" id="mobile-links3">
			<ul class="center" style="color:bisque;font-size:22px;">Courts</ul>	
				<div class="collection center" style="height: 225px; width: 350px; overflow:auto; margin-left: 50px; font-family: 'Nova Square';  border-radius: 100px 0px 0px 100px;">
					
					
					
					<?php
                        $sql18="SELECT * FROM `court`";
                        $result18 = mysqli_query($conn, $sql18);
                        $row18=mysqli_fetch_all($result18, MYSQLI_ASSOC);
						foreach($row18 as $row1){
							
							?>
							
							<div class='collection-item'><?php echo $row1['CourtNumber'] ?> -<?php echo $row1['RoomNo'] ?><?php echo $row1['BuildingNo'] ?><a href="timekeeper.php?del3=<?php echo $row1['CourtNumber'] ; ?>" class="btn " style=' margin-left:20px;display: inline-block;'><i class="material-icons">delete</i></a></div> 
						<?php }?>
					
					
			</div>
            <div class='tablee center' style="width:200px;margin-left:100px;">
            <h6 style="color:bisque;">Add a Court</h6>
            <form method="post" action='' name='court'>
                <label style="color:bisque">Room No</label>
                <input type="text" name= 'RN' required>
                <label style="color:bisque">Building No</label>

                <input type="text" name="BN" required>
                <input type="submit" name="court"  value="submit" class="btn brand z-depth-0" style="margin-left: 0px;height:auto;width:auto;">
            </form>
            </div>
        </div>

        <div class="sidenav" style="height: 600px; width: 400px; margin-top:105px; border-radius: 75px 0px 0px 75px; background-color: rgba(255, 171, 64, 1);overflow:hidden;" id="mobile-links4">
			<ul class="center" style="color:bisque;font-size:22px;">Courts</ul>	
				<div class="collection center" style="height: 225px; width: 350px; overflow:auto; margin-left: 50px; font-family: 'Nova Square';  border-radius: 100px 0px 0px 100px;">
					
					
					
					<?php
                        $sql18="SELECT * FROM `armory`";
                        $result18 = mysqli_query($conn, $sql18);
                        $row18=mysqli_fetch_all($result18, MYSQLI_ASSOC);
						foreach($row18 as $row1){
							
							?>
							
							<div class='collection-item'><?php echo $row1['armory_id'] ?> -<?php echo $row1['capacity'] ?> -<?php echo $row1['location'] ?><a href="timekeeper.php?del4=<?php echo $row1['armory_id'] ; ?>" class="btn " style=' margin-left:20px;display: inline-block;'><i class="material-icons">delete</i></a></div> 
						<?php }?>
					
					
			</div>
            <div class='tablee center' style="width:200px;margin-left:100px;">
            <h6 style="color:bisque;">Add an Armory</h6>
            <form method="post" action='' name='armory'>
                <label style="color:bisque">Capacity</label>
                <input type="number" name= 'cap' required>
                <label style="color:bisque">Location</label>

                <input type="text" name="loc" required>
                <input type="submit" name="armory"  value="submit" class="btn brand z-depth-0" style="margin-left: 0px;height:auto;width:auto;">
            </form>
            </div>
        </div>



    <script>
        function search() {
            var input, input2, filter, table, tr, td, i, textValue;
            input = document.getElementById("searchvar").value.toLowerCase(); 
            input2 = document.getElementById("inp");
            table = document.getElementById("mytable");
            tr = table.getElementsByTagName("tr");
            
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[parseInt(input2.value)];
                if (td) {
                    textValue = td.textContent || td.innerText;
                    textValue = textValue.toLowerCase(); 
                    if (textValue.indexOf(input) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        $(document).ready(function(){
			$('.sidenav').sidenav({ edge: 'right' });
		})
       
        </script>
</body>
</html>