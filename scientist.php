<?php
    include("config/db_connect.php");
    session_start();
    $sql = "SELECT * FROM `requests` WHERE `Receiver_Type`='Scientist' AND STATUS='Pending' ORDER BY `ID` ASC" ;
    
	$result =mysqli_query($conn,$sql);

    
    if ($_SESSION['loggedin'] && $_SESSION['ID'] && $_SESSION['userType'] === 'Scientist') {
        
        $userID = $_SESSION['ID'];
        
    } else {
        
        header('Location: log_in.php');
        exit();}
    $scientist=$_SESSION['ID'];
    $sql6 = "SELECT `Dept_ID` FROM `scientists` WHERE `ID`= '$scientist'  ";
    $run6=mysqli_query($conn,$sql6);
    $deptID = mysqli_fetch_assoc($run6)['Dept_ID'];

    if (isset($_GET['ID'])) {
        $ID = $_GET['ID'];
        $var= $_GET['var'];
        $sw= $_GET['sw'];
        $emp= $_GET['emp'];
        $sql2="UPDATE `requests` SET `Status`= 'Accepted' , `Action_ID`='$scientist' WHERE `ID`='$ID'";
        if ($sw==0) {
        $sql5="UPDATE `weapons` SET `employee_id`= NULL , `dept_id`='$deptID' WHERE `serial_no`='$var'";
        }
        else{
            $sql5= "DELETE FROM `uses` WHERE `device_id`='$var'";
        }
        $run5=mysqli_query($conn,$sql5);
        $run=mysqli_query($conn,$sql2);
        if ($run) {  
            header('location:scientist.php');
        }else{
            mysqli_errno($conn);
        }     
    }
    if (isset($_GET['ID2'])) {
        $ID = $_GET['ID2'];
        $sql2="UPDATE `requests` SET `Status`= 'Declined' , `Action_ID`='$scientist' WHERE `ID`='$ID'";
        $run=mysqli_query($conn,$sql2);
        if ($run) {  
            header('location:scientist.php');
        }else{
            mysqli_errno($conn);
        }     
    }
    
   

    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scientist</title>
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
            <source src="img\Scientist.mp4" type="video/mp4">       
        </video>
    </div>
    <div class="navbar">
            <a href="scientist.php" class="TVAdiv"><img src="1701439279944.png" class="TVAdiv"></a>  
    </div>
    
    <a href="repair.php" class="btn btnn  brand z-depth-0"  style=" top:25%;   "><i class="material-icons" style="margin-left: 1px;">settings</i> Repair Devices </a>
    <a href="add_device.php" class="btn btnn  brand z-depth-0"  style=" top:35%; "><i class="material-icons" >add_to_photos</i> Add a Device</a>
    <a href="add_weapon.php" class="btn btnn  brand z-depth-0"  style=" top:45%; "><i class="material-icons" style="margin-left: 1px;">gavel</i> Add a Weapon</a>
    <a href="clerk_varients.php" class="btn  btnn brand z-depth-0"  style="top:55%;"><i class="material-icons" style="margin-left: 1px;">devices</i> Devices</a>
    <a href="index.php" class="btn  btnn brand z-depth-0"  style="top:55%;"> Log Out <i class="material-icons" style="margin-left: 1px;">exit_to_app</i></a>
    


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
                        if ($row['Weapon_ID'] != NULL) {
                            $var=$row['Weapon_ID'] ;
                            $sw=0;
                        }
                        else{
                            $var=$row['Device_ID'];
                            $sw=1; 
                        }
                        echo "<td>" . $name ."-". $employeeID. "</td>";
                        echo "<td><a href='scientist.php?ID=" . $row['ID'] ."&var=" . $var."&sw=" . $sw ."&emp=" . $row['Requestee_ID'] ."'class='btn'><i class='material-icons'>done</i></a><a href='scientist.php?ID2=" . $row['ID'] . "' class='btn'><i class='material-icons'>delete</></a> </td>";
                        echo "</tr>";
                       
                    }
                ?>
          
        </tbody>

    </table>

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

         
        </script>
</body>
</html>