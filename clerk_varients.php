<?php

    include("config/db_connect.php");
    $sql = "SELECT * FROM `variants` WHERE `Temporal_Aura` IS NULL OR `Temporal_Aura` = ''";
	$result =mysqli_query($conn,$sql);

	$sql3 = "SELECT * FROM `variants`";
    $result3 =mysqli_query($conn,$sql3);
    $data = mysqli_fetch_all($result3, MYSQLI_ASSOC);

    
    $ID=$Temporal_Aura=$Soul_Status=$TicketNo=$Statements="";
    $errors = array('ID' => '', 'Temporal_Aura' => '', 'Soul_Status'=>'', 'TicketNo'=>'','Statements'=>'');

    if (isset($_POST["submit"])) {
        $ID = $_POST['ID'];
        $Temporal_Aura = $_POST['Temporal_Aura'];
        $Soul_Status=$_POST['Soul_Status'];
        $TicketNo=$_POST['TicketNo'];
        $Statements=$_POST['Statements'];

        if (empty($ID)) {
            $errors['ID'] = 'Input your ID';
            
        } elseif(!in_array($ID, array_column($data, 'ID'))){
            $errors['ID'] = "ID doesn't exist";
        }
        if (empty($Temporal_Aura)) {
            $errors['Temporal_Aura'] = 'Enter Temporal Aura';
        }
        if (empty($Soul_Status)) {
            $errors['Soul_Status'] = 'Enter Soul Status';
        }
        if (empty($TicketNo)) {
            $errors['TicketNo'] = 'Enter Ticket Number';
        }
        if (empty($Statements)) {
            $errors['Statements'] = 'Enter Varients Statements';
        }
        if (!array_filter($errors)) {
            
            
            $sql2 = "UPDATE `variants` SET `Temporal_Aura` = '$Temporal_Aura', `Soul_Status` = '$Soul_Status', `TicketNo` = '$TicketNo', `Statements` = '$Statements' WHERE `ID` = '$ID'";
            
            if (mysqli_query($conn, $sql2)) {
                
                header("Location: clerk_varients.php?updated=true");
                exit();
            } else {
                echo "Query error: " . mysqli_error($conn);
            }

        }
        
 
        
    }
 
    if (isset($_GET['updated']) && $_GET['updated'] == 'true') {
        echo '<script>alert("Data updated successfully!");</script>';
    }
    

    mysqli_free_result($result3);


    mysqli_close($conn);

?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Varient Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Square&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" type="text/css" href="clerk_css.css">
</head>
<body>
    <div class="video">
        <video autoplay loop muted playsinline>
            <source src="img\clerk_varients_animation.mp4" type="video/mp4">
        
        </video>
    </div>
    </div>
        <div class="navbar">
            <a href="clerk.php" class="TVAdiv"><img src="1701439279944.png" class="TVAdiv"></a>  
        </div>
    <div class="tablee" style="background-color: rgba(255, 103, 34, .75) ; position:relative; top:11%; width: 280px; height:60px;"><h5 class="center" style="color:bisque; ">Varients to Scan</h5></div>
    
    <div class="tablee" >
    <table class="highlight" id="mytable">
    <div >
        <input type="text" placeholder="Search by ID" id="searchvar" name="" style="width: 120px; height: 20px; margin-left: 20px; font-family:'Nova Square'; " onkeyup="search()">
        <a href="#"> <i class="material-icons" >search</i></a>
    </div>
        <thead>
          <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Earth No</th>
              <th>Temporal Aura</th>
              <th class="descrip">Nexas event cause</th>
              <th>Soul Status</th>
              <th>Ticket No.</th>
              <th>Statements</th>
              <th>Prune/Reset</th>
              <th>Timeline_ID</th>
              <th>Hunter_ID</th>
              
          </tr>
        </thead>

        <?php
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['Name'] . "</td>";
                        echo "<td>" . $row['Earth_No'] . "</td>";
                        echo "<td>" . $row['Temporal_Aura'] . "</td>";
                        if (!($row['Nexus_Event_Cause'] == '' || $row['Nexus_Event_Cause']  === NULL)) {
                            $shortenedText = substr($row['Nexus_Event_Cause'], 0, 20);
                            echo "<td class='truncate-text'>". $shortenedText."<a class='morebtn modal-trigger' href='#modal_".$row['ID']."'> <i class='tiny material-icons'>open_in_new</i> </a></td>";
                        } else{
                            echo "<td>". $row["Nexus_Event_Cause"] . "</td>";
                        }
                        echo "<td>" . $row['Soul_Status'] . "</td>";
                        echo "<td>" . $row['TicketNo'] . "</td>";
                        if (!($row['Statements'] == '' || $row['Statements']  === NULL)){
                            $shortenedText2 = substr($row['Statements'], 0, 20);
                            echo "<td class='truncate-text'>". $shortenedText2."<a class='morebtn modal-trigger' href='#modal2_".$row['ID']."'> <i class='tiny material-icons'>open_in_new</i> </a></td>";
                        }else{
                            echo "<td>" . $row['Statements'] . "</td>";
                        }
                        echo "<td>" . $row['PruneOrReset'] . "</td>";
                        echo "<td>" . $row['Timeline_ID'] . "</td>";
                        echo "<td>" . $row['Hunter_ID'] . "</td>";
                   
                        echo "</tr>";
                        echo "<div id='modal_" . $row['ID'] . "' class='modal'  '>";
                        echo "<div class='modal-content'>";
                        echo "<h4>Full Description</h4>";
                        echo "<p>" . $row['Nexus_Event_Cause'] . "</p>";
                        echo "</div>";
                        echo "<div class='modal-footer'>";
                        echo "<a href='#!' class='modal-close waves-effect waves-green btn-flat'>Close</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div id='modal2_" . $row['ID'] . "' class='modal'>";
                        echo "<div class='modal-content'>";
                        echo "<h4>Full Description</h4>";
                        echo "<p>" . $row['Statements'] . "</p>";
                        echo "</div>";
                        echo "<div class='modal-footer'>";
                        echo "<a href='#!' class='modal-close waves-effect waves-green btn-flat'>Close</a>";
                        echo "</div>";
                        echo "</div>";
                    }
                ?>
          
        </tbody>
    </table>
    </div>
    <div class='tablee' style="position:relative; height:190px; top: 15%; border-radius:10px ;"> 
    <h5 class="center" style="color:bisque;">Add Varient Information</h5>
    <form method="POST" action="" class="input-grid" style="font-family:'Nova Square'">
        <div class="container">
        <input type="number" name="ID" id="searchvar2" placeholder="Enter ID" onkeyup="search2()" value="<?php echo htmlspecialchars($ID); ?>">
        <div class="white-text"><?php echo $errors['ID']; ?></div>
        </div>
        <div class="container">
        <div id="resultDiv" class="center" style="color:bisque;"></div>
        </div>
        <div class="container">
        <input type="text" name="Temporal_Aura" placeholder="Temporal Aura" value="<?php echo htmlspecialchars($Temporal_Aura); ?>">
        <div class="white-text"><?php echo $errors['Temporal_Aura']; ?></div>
        </div>
        <div class="container">
        <input type="text" name="Soul_Status" placeholder="Soul Status" value="<?php echo htmlspecialchars($Soul_Status); ?>">
        <div class="white-text"><?php echo $errors['Soul_Status']; ?></div>
        </div>
        <div class="container">
        <input type="number" name="TicketNo" placeholder="Ticket No" value="<?php echo htmlspecialchars($TicketNo); ?>">
        <div class="white-text"><?php echo $errors['TicketNo']; ?></div>
        </div>
        <div class="container">
        <input type="text" name="Statements" placeholder="Statements" value="<?php echo htmlspecialchars($Statements); ?>">
        <div class="white-text"><?php echo $errors['Statements']; ?></div>
        </div>
        
        <input type="submit" name="submit" class="btn z-depth-2" style="position:relative; left:290%;" value="Update">
    </form>

    
    </div>
    <script>
        $(document).ready(function(){
            $('.modal').modal();
        });
        function search(){
            var input, filter, table, tr, td, i, textValue;
            input=document.getElementById("searchvar");
            table=document.getElementById("mytable");
            tr=table.getElementsByTagName("tr");
            for(i=0;i< tr.length; i++){
                td=tr[i].getElementsByTagName("td")[0];
                if(td){
                    textValue=td.textContent || td.innerText;
                    if(textValue.indexOf(input.value)>-1){
                        tr[i].style.display="";
                    }
                    else{
                        tr[i].style.display="none";
                    }
                }
            }
        }
        function search2() {
                var input, table, tr, td, i, textValue;
                input = document.getElementById("searchvar2");
                table = document.getElementById("mytable");
                tr = table.getElementsByTagName("tr");
                var resultDiv = document.getElementById("resultDiv");
                
                var matchedAssocArray = null;
                
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];

                    if (td) {
                        textValue = td.textContent || td.innerText;

                        if (textValue.trim() === input.value.trim()) {
                            var assocArray = {};
                            var columns = tr[i].getElementsByTagName("td");
                            var headers = table.getElementsByTagName("th");

                            for (var j = 0; j < columns.length; j++) {
                                var headerText = headers[j].textContent || headers[j].innerText;
                                assocArray[headerText.trim()] = columns[j].textContent || columns[j].innerText;
                            }

                            matchedAssocArray = assocArray;
                            break;
                        }
                    }
                }

                if (matchedAssocArray) {
                    displayContent(matchedAssocArray, resultDiv);
                } else {
                    resultDiv.innerHTML = "No matching ID found.";
                }
            }

            function displayContent(assocArray, resultDiv) {
                resultDiv.innerHTML = "";

                var list = document.createElement("ul");

                for (var key in assocArray) {
                    if (key==="Name" || key==="Timeline_ID"){
                        var listItem = document.createElement("li");
                        listItem.textContent = key + ": " + assocArray[key];
                        list.appendChild(listItem);
                    }
                }

                resultDiv.appendChild(list);
            }
    </script>
    </body>
</html>