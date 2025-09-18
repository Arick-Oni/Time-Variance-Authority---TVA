<?php
    include("config/db_connect.php");
    session_start();
    $userID=$_SESSION['ID'];
    $sql = "SELECT * FROM `specimen`";
	$result =mysqli_query($conn,$sql);
    if (isset($_GET['id']) && isset($_GET['locker'])) {
        $recordID = $_GET['id'];
        $lockerNum = isset($_GET['locker']) ? (int)$_GET['locker'] : 0;
 
        $query = "DELETE FROM `specimen` WHERE `Record_ID` = '$recordID'";
        $query2="UPDATE `evidence_locker` SET `Count_Items` = `Count_Items` - 1 WHERE `Locker_Num` = '$lockerNum'";  
        $run = mysqli_query($conn,$query);  
        $run2 = mysqli_query($conn,$query2);  
        if ($run) {  
            header('location:clerk_specimen.php');  
        }else{  
            echo "Error: ".mysqli_error($conn);  
        }  
    }  
    $sql2 = "SELECT * FROM `timeline` ORDER BY `Timeline_ID` DESC";

    $result2 =mysqli_query($conn,$sql2);
    $data = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    foreach ($data as $row) {
        $timelines[] = $row['Timeline_ID'];}
    $timelines_json = json_encode($timelines);
    // print_r($timelines);

    $sql3= 'SELECT * FROM `evidence_locker` WHERE `Capacity` - `Count_Items` > 0 ORDER BY `Capacity` - `Count_Items` DESC';
    $result3 =mysqli_query($conn,$sql3);
    $data3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);

    

    if (isset($_POST["submit"])) {
        $selectedtimeline = $_POST["selectedtimeline"];
        // echo "$selectedtimeline";
    }

    if (isset($_POST["submit"])) {
        $Description = $_POST["Description"];
        $selectedtimeline_id = $_POST["selectedtimeline"];
        $Locker = $_POST["Locker"];
        $userID=$_SESSION['ID'] ;
        $sql4="INSERT INTO `specimen` (`Record_ID`, `Description`, `Timeline_ID`, `Locker_Num`, `Emplyee_ID`) VALUES (NULL, '$Description', '$selectedtimeline' , '$Locker', '$userID')";
        $sql5= "UPDATE `evidence_locker` SET `Count_Items` = `Count_Items` + 1 WHERE `Locker_Num` = '$Locker'";
        if (mysqli_query($conn, $sql4)) {
            mysqli_query($conn, $sql5);
            header("Location: clerk_specimen.php?updated=true");
            exit();
        } else {
            echo "Query error: " . mysqli_error($conn);
        }

    }
    if (isset($_GET['updated']) && $_GET['updated'] == 'true') {
        echo '<script>alert("Data updated successfully!");</script>';
    }
    if (isset($_GET['ext']) ){
        $sql17="INSERT INTO `requests` VALUES(NULL, current_timestamp(), 'ExtraSPC', 'Timekeeper', 'Pending', '$userID', NULL, NULL, NULL)";
        $run17=mysqli_query($conn, $sql17);
        echo '<script>alert("Extra Locker Room requested!");</script>';
        header('Location: clerk_specimen.php');
    }
    
?>

<html lang="en">
<head>
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
    <title>Specimen Management</title>
</head>
<body>
    <div class="video">
        <video autoplay loop muted playsinline>
            <source src="img\optimized\Specimen_optimized.mp4" type="video/mp4">       
        </video>
    </div>
    </div>
        <div class="navbar">
            <a href="clerk.php" class="TVAdiv"><img src="1701439279944.png" class="TVAdiv"></a>  
        </div>
        <div class="tablee" style="background-color: rgba(255, 103, 34, .75) ; position:relative; top:11%; width: 280px; height:60px;"><h5 class="center" style="color:bisque; ">Specimen Inventory</h5></div>
    
    <div class="tablee" style="background-color: rgba(255, 150, 100, .40);" >
    <table class="highlight" id="mytable">
    <div class="container" style="margin-left: 20px;">
        <input type="text" placeholder="Search by" id="searchvar" name="" style="width: 120px; height: 20px; margin-left: 20px; font-family:'Nova Square'; " onkeyup="search()">
        <div class="container" style="height:20px; width:80px; display:inline-block; color: bisque; ">
        <select class="inpp" id="inp" name="Type" onchange="search()">
            
            <option value="0" >ID</option>
            <option value="1" >Description</option>
            <option value="2" >Timeline</option>
            <option value="3" >Locker</option>
            <option value="4">Emplyee</option>
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
              <th>Description</th>
              <th>Timeline ID</th>
              <th>Locker Number</th>
              <th>Logged By</th>
              <th>Action</th>
          </tr>
        </thead>

        <?php
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['Record_ID'] . "</td>";
                        echo "<td>" . $row['Description'] . "</td>";
                        echo "<td>" . $row['Timeline_ID'] . "</td>";
                        echo "<td>" . $row['Locker_Num'] . "</td>";
                        $employeeID = $row['Emplyee_ID'];
                        $nameQuery = mysqli_query($conn, "SELECT `Name` FROM `employee` WHERE `ID` = $employeeID");
                        $nameResult = mysqli_fetch_assoc($nameQuery);
                        $name = $nameResult ? $nameResult['Name'] : "No employee found";
                        echo "<td>" . $name . "</td>";
                        echo "<td><a href='clerk_specimen.php?id=" . $row['Record_ID'] . "&locker=" . $row['Locker_Num'] . "' class='btn'>Delete</a> </td>";
                        echo "</tr>";
                       
                    }
                ?>
          
        </tbody>

    </table>

    </div>


    <div class='tablee' style="position:relative; width:1400px; height:190px; top: 15%; border-radius:10px ;"> 
    <h5 class="center" style="color:bisque;">Add Specimen</h5>
    <form method="POST" action="" class="input-grid" style="font-family:'Nova Square' ; grid-template-columns: repeat(4, 1fr); margin-left:70px;">
        <div class="container">
        <input type="text" name="Description" id="Description" placeholder="Enter Specimen Desciption"  value="" maxlength="50" required>
       
        </div>
        <label style="font-size: 20px; color:bisque; margin-top:15px; margin-left:0px; width:100px;"> Timeline</label>
        <div class="wrapper" style=" margin-left:-75px;">
        <div class="select-btn" required>

            <span>Select Timeline</span>
            <i class="material-icons orange-text">arrow_drop_down</i>
        </div>
        <div class="content">
            <div class="search">
            <i class="uil uil-search"></i>
            <input spellcheck="false" type="text" placeholder="Search">
            </div>
            <ul class="options"></ul>
        
        </div>

        
        <input type="hidden" id="selectedtimeline" name="selectedtimeline" value="">
    </div>
        <label style="font-size: 20px; color:bisque; margin-top:15px; margin-left:0px; width:100px;">Locker</label>
        <div class="btn" style="width:150px; height:46.5px; z-index:1; border:5px; margin-top: 10px; margin-left: -260px; ">
        <select class="inp" name="Locker" style="color: orange;" required>
        <?php
            
            foreach ($result3 as $row) {
                
                $value = $row['Locker_Num'];
                $capacity = $row['Capacity'];
                $countItems = $row['Count_Items'];
                
                
                echo '<option  value="' . $value . '">' . $value . ' - (' . $countItems . '/' . $capacity . ')</option>';
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
        <input type="submit" name="submit" class="btn" style="position:fixed; left:75%;top:28%; height:50px; width:120px; margin-top:10px;" value="Update">
        </div >
    </form>
    </div>
    <a href="clerk_specimen.php?ext=<?php echo 1?>" class="btn brand" style="height: auto; width:auto;  position:fixed; left:80%;top:90%;"><i class="material-icons">add</i>Request for Extra Locker</a>
    
    

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
        <script> 
            const wrapper = document.querySelector(".wrapper"),
            selectBtn = wrapper.querySelector(".select-btn"),
            searchInp = wrapper.querySelector("input"),
            options = wrapper.querySelector(".options");

            let timelines = <?php echo $timelines_json; ?>;

            function addtimeline(selectedtimeline) {
                options.innerHTML = "";
                timelines.forEach(timeline => {
                    let isSelected = timeline == selectedtimeline ? "selected" : "";
                    let li = `<li onclick="updateName(this)" class="${isSelected}">${timeline}</li>`;
                    options.insertAdjacentHTML("beforeend", li);
                });
            }
            addtimeline();

            function updateName(selectedLi) {
                searchInp.value = "";
                addtimeline(selectedLi.innerText);
                wrapper.classList.remove("active");
                document.getElementById('selectedtimeline').value = selectedLi.innerText;
                selectBtn.firstElementChild.innerText = selectedLi.innerText;
            }

            searchInp.addEventListener("keyup", () => {
                let arr = [];
                let searchWord = searchInp.value.toLowerCase();
                arr = timelines.filter(data => {
                    return data.toLowerCase().startsWith(searchWord);
                }).map(data => {
                    let isSelected = data == selectBtn.firstElementChild.innerText ? "selected" : "";
                    return `<li onclick="updateName(this)" class="${isSelected}">${data}</li>`;
                }).join("");
                options.innerHTML = arr ? arr : `<p style="margin-top: 10px;">Oops! timeline not found</p>`;
            });

            selectBtn.addEventListener("click", () => wrapper.classList.toggle("active"));

        </script>
</body>
</html>