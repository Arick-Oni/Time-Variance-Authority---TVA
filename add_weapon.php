<?php
 include("config/db_connect.php");
 session_start();

 $sql = "SELECT * FROM `weapons`";
 $result =mysqli_query($conn,$sql);
 if (isset($_GET['id']) ) {
     $serial_no = $_GET['id'];
     

     $query = "DELETE FROM `weapons` WHERE `serial_no` = '$serial_no'";
     
     $run = mysqli_query($conn,$query);  
       
     if ($run) {  
         header('location:add_weapon.php');  
     }else{  
         echo "Error: ".mysqli_error($conn);  
     }  
 }


    
    $sql3 = "SELECT * FROM `armory` ORDER BY `armory_id` DESC";
    $result3 = mysqli_query($conn, $sql3);
    



 if (isset($_POST["submit"])) {
     $Armory = $_POST["Armory"];
     $Type = $_POST["Type"];
    
     $userID=$_SESSION['ID'] ;
    $sql5="SELECT `Dept_ID` FROM `scientists` WHERE `ID`='$userID'";
    $run5 = mysqli_query($conn,$sql5);
    $temp = mysqli_fetch_assoc($run5);
     $deptID=$temp['Dept_ID'];
     $sql4="INSERT INTO `weapons` (`serial_no`, `creation_date`,`weapon_health`,`armory_id`) VALUES (NULL, current_timestamp(), 100, '$Armory')";
     
     
     
     if (mysqli_query($conn, $sql4)) {
        $lastInsertedID = mysqli_insert_id($conn);
        if ($Type=="TimeStick") {
            $sql13= "INSERT INTO `time_stick` VALUES(0,'$lastInsertedID')";
            $run13 = mysqli_query($conn,$sql13);
         }
         else{
            $sql13= "INSERT INTO `temporal_reset_charge` VALUES(0,'$lastInsertedID')";
            $run13 = mysqli_query($conn,$sql13);
         }
        
         header("Location: add_weapon.php?updated=true");
         exit();
     } else {
         echo "Query error: " . mysqli_error($conn);
     }

 }
 if (isset($_GET['updated']) && $_GET['updated'] == 'true') {
     echo '<script>alert("Data updated successfully!");</script>';
 }
 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Square&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" type="text/css" href="clerk_css.css">
    <title>Weapon management</title>
</head>
<body>
<div class="video">
        <video autoplay loop muted playsinline>
            <source src="img\Specimen.mp4" type="video/mp4">       
        </video>
    </div>
    </div>
        <div class="navbar">
            <a href="scientist.php" class="TVAdiv"><img src="1701439279944.png" class="TVAdiv"></a>  
        </div>
        <div class="tablee" style="background-color: rgba(255, 103, 34, .75) ; position:relative; top:11%; width: 280px; height:60px;"><h5 class="center" style="color:bisque; ">Weapon Inventory</h5></div>
    
    <div class="tablee" style="background-color: rgba(255, 150, 100, .40);" >
    <table class="highlight" id="mytable">
    <div class="container" style="margin-left: 20px;">
        <input type="text" placeholder="Search by" id="searchvar" name="" style="width: 120px; height: 20px; margin-left: 20px; font-family:'Nova Square'; " onkeyup="search()">
        <div class="container" style="height:20px; width:80px; display:inline-block; color: bisque; ">
        <select class="inpp" id="inp" name="Type" onchange="search()">
            
            <option value="0" >Serial</option>
            <option value="1" >Type</option>
            <option value="2" >Health</option>
            
            
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
              <th>Serial</th>
              <th>Type</th>
              <th>Health</th>
              <th>Creation Date</th>
              <th>Currently at</th>
              <th>Action</th>
          </tr>
        </thead>

        <?php
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['serial_no'] . "</td>";
                        $sl=$row['serial_no'];
                        $sql8= "SELECT * FROM `time_stick` WHERE `serial_no`='$sl'";
                        $result8 = mysqli_query($conn, $sql8);
                        if ($result8 && mysqli_num_rows($result8) > 0) {
                            $arr = mysqli_fetch_all($result8, MYSQLI_ASSOC);
                       
                            echo "<td>TimeStick</br>Total Pruned:". $arr[0]['total_pruned']."  </td>";
                        } else{
                            $sql9= "SELECT * FROM `temporal_reset_charge` WHERE `serial_no`='$sl'";
                            $result9 = mysqli_query($conn, $sql9);
                            $arr=mysqli_fetch_all($result9, MYSQLI_ASSOC);
                            // print_r($arr);
                            echo "<td>Temporal RC</br>Times Used: ".$arr[0]['times_used']."</td>";
                        }
                        echo "<td>" . $row['weapon_health'] . "</td>";
                        echo "<td>" . $row['creation_date'] . "</td>";
                        if ($row['armory_id']!=NULL){
                            echo '<td>Armory-'. $row['armory_id'] . '</td>';
                        } elseif ($row['dept_id'] != NULL){
                            echo '<td>Dept-'. $row['dept_id'] . '</td>';
                        }else{
                            $emp=$row['employee_id'];
                            $sql10 = "SELECT * FROM `employee` WHERE `ID`='$emp'" ;
                            $result10 = mysqli_query($conn, $sql10);
                            $arr10=mysqli_fetch_all($result10, MYSQLI_ASSOC);
                            echo '<td>'. $arr10[0]['Name'].'-' . $emp.'</td>';
                        }
                        // echo "<td>" . $row['branch_no'] . "</td>";
                        echo "<td><a href='add_weapon.php?id=" . $row['serial_no']  . "' class='btn'>Delete</a> </td>";
                        echo "</tr>";
                       
                    }
                ?>
          
        </tbody>

    </table>

    </div>
    <div class='tablee' style="position:relative; width:900px; height:190px; top: 15%; border-radius:10px;margin-left:250px ;"> 
    <h5 class="center" style="color:bisque;">Add Weapon</h5>
    <form method="POST" action="" class="input-grid" style="font-family:'Nova Square' ; grid-template-columns: repeat(3, 1fr); margin-left:70px;">
        <div>
            <label style="font-size: 14px; color:bisque;">Type</label>
        <select class="inp" name="Type">
            
            <option value="TimeStick">TimeStick</option>
            <option value="TemporalRC" >TemporalRC</option>
            
        </select>
        </div>
        
        <div>
        <label style="font-size: 14px; color:bisque;">Armory</label>
        
        <select class="inp " name="Armory" style="color: orange;">
        <?php
            
            foreach ($result3 as $row) {
                
                $value = $row['armory_id'];
                $location = $row['location'];
                
                
                
                echo '<option  value="' . $value . '">' . $value . ' - ' . $location . '</option>';
            }
            ?>
        </select>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var elems = document.querySelectorAll('select');
                    var instances = M.FormSelect.init(elems, {});
                });
        </script>
        </div>
        <div>
        <input type="submit" name="submit" class="btn" style=" height:50px; width:120px; margin-top:10px;" value="ADD">
        </div >


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