<?php
 include("config/db_connect.php");
 session_start();

 $sql = "SELECT * FROM `devices`";
 $result =mysqli_query($conn,$sql);
 if (isset($_GET['id']) ) {
     $device_id = $_GET['id'];
     $query = "DELETE FROM `devices` WHERE `device_id` = '$device_id'";
     $run = mysqli_query($conn,$query);  
       
     if ($run) {  
         header('location:add_device.php');  
     }else{  
         echo "Error: ".mysqli_error($conn);  
     }  
 }  
 



 if (isset($_POST["submit"])) {
     $Name = $_POST["Name"];
    
     $userID=$_SESSION['ID'] ;
    $sql5="SELECT `Dept_ID` FROM `scientists` WHERE `ID`='$userID'";
    $run5 = mysqli_query($conn,$sql5);
    $temp = mysqli_fetch_assoc($run5);
     $deptID=$temp['Dept_ID'];
     $sql4="INSERT INTO `devices` (`device_id`, `name`,`branch_no`) VALUES (NULL, '$Name', '$deptID')";
     
     
     if (mysqli_query($conn, $sql4)) {
         mysqli_query($conn, $sql5);
         header("Location: add_device.php?updated=true");
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
    <title>Device management</title>
</head>
<body>
<div class="video">
        <video autoplay loop muted playsinline>
            <source src="img\add_device.mp4" type="video/mp4">       
        </video>
    </div>
    </div>
        <div class="navbar">
            <a href="scientist.php" class="TVAdiv"><img src="1701439279944.png" class="TVAdiv"></a>  
        </div>
        <div class="tablee" style="background-color: rgba(255, 103, 34, .75) ; position:relative; top:11%; width: 280px; height:60px;"><h5 class="center" style="color:bisque; ">Device Inventory</h5></div>
    
    <div class="tablee" style="background-color: rgba(255, 150, 100, .40);" >
    <table class="highlight" id="mytable">
    <div class="container" style="margin-left: 20px;">
        <input type="text" placeholder="Search by" id="searchvar" name="" style="width: 120px; height: 20px; margin-left: 20px; font-family:'Nova Square'; " onkeyup="search()">
        <div class="container" style="height:20px; width:80px; display:inline-block; color: bisque; ">
        <select class="inpp" id="inp" name="Type" onchange="search()">
            
            <option value="0" >ID</option>
            <option value="1" >name</option>
            <option value="2" >Branch</option>
            
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
              <th>Name</th>
              <th>Creation RA Branch</th>
              
              
              <th>Action</th>
          </tr>
        </thead>

        <?php
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['device_id'] . "</td>";
                        $dev=$row['device_id']; 
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['branch_no'] . "</td>";
                        echo "<td><a href='add_device.php?id=" . $row['device_id']  . "' class='btn'>Delete</a> </td>";
                        echo "</tr>";
                       
                    }
                ?>
          
        </tbody>

    </table>

    </div>
    <div class='tablee' style="position:relative; width:700px; height:190px; top: 15%; border-radius:10px;margin-left:350px ;"> 
    <h5 class="center" style="color:bisque;">Add Specimen</h5>
    <form method="POST" action="" class="input-grid" style="font-family:'Nova Square' ; grid-template-columns: repeat(2, 1fr); margin-left:70px;">
        <div class="container">
        <input type="text" name="Name" id="Name" placeholder="Enter Device Name"  value="" maxlength="50" required>
        
        </div>
        

        </div>       
        <div>
        <input type="submit" name="submit" class="btn" style="position:fixed; left:60%;top:78%; height:50px; width:120px; margin-top:10px;" value="ADD">
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