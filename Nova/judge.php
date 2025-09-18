<?php
include("config/db_connect.php");
    session_start();

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
	    mysqli_close($mysqli);
       
    }
   

?>
<?php include 'DESIGNPAGE.html'; ?>

<div style="overflow: auto; margin-top: 150px;">

<!------------------- LEFT TABLE -------------->
    <div  class="containeroflefttable" style="float: left; width: 50%; margin-top: 20px;">
        <table id="example" class="tablee caption-top">
            <caption style="text-align: center; color: white;">Pending Cases</caption>
            <thead>
                <tr>
                    <th scope="col">Case No</th>
                    <th scope="col">Analyst ID</th>
                    <th scope="col">Variant ID</th>
                    <th scope="col">Nexus Event</th>
                    <th scope="col">Total Trials</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT cases.Number as CNumber,cases.Analyst_ID AS A_ID,cases.variant_id AS V_ID,cases.Num_of_Trials AS NTr, variants.Nexus_Event_Cause AS NEX  FROM cases INNER JOIN variants ON cases.variant_id = variants.ID  WHERE cases.Status= 'Pending'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["CNumber"] . "</td><td>" . $row["A_ID"] . "</td><td>" . $row["V_ID"] . "</td><td>" . $row["NEX"] . "</td><td>" . $row["NTr"] . "</td><td><form action='' method='GET'><input type='hidden' name='Case_Detail' value='". $row["CNumber"] . "'><input type='submit' class='btn btn-outline-dark' name='View_Details' value='View Details'></form></td></tr>";
                    }
                    echo '</tbody></table>';
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
                
    </div>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>  
    <script>	
    new DataTable('#example');
    </script>

    <!-- -----------RIGHT TABLE AND FORM ---------->


    <div style="float: left; width: 50%;">

          <h6 style="text-align: center;width: 90%; height: 30px;margin-left: auto; margin-right: auto; backdrop-filter: blur(10px); color:white;">Case Profile</h6>
          <div style="width: 90%; margin-left:auto; margin-right: auto;padding-left: 20px;padding-top: 7px; padding-bottom: 1px; backdrop-filter: blur(5px); background-color: rgba(255, 255, 255, 0.3); border-radius: 10px; line-height: 1;">
          
          
            <?php
            if (isset($_GET['Case_Detail'])) {
              $filter_value = $_GET['Case_Detail'];

              $sql_profile = "SELECT cases.Number as CNumber,variants.Name AS VName,cases.Analyst_ID AS A_ID,cases.variant_id AS V_ID, variants.Nexus_Event_Cause AS NEX, variants.Timeline_ID AS TID, variants.Statements AS Vstat, detained.timeCell_ID AS Tcell  FROM cases INNER JOIN variants ON cases.variant_id = variants.ID INNER JOIN detained ON detained.Variant_ID=variants.ID WHERE cases.Number = $filter_value ";
              $result_profile = $conn->query($sql_profile);

              if ($result_profile->num_rows > 0) {
                  $row_profile = $result_profile->fetch_assoc();
                  $cnum=$row_profile['CNumber'];
                  echo "<p>Case No: {$row_profile['CNumber']}</p>";
                  echo "<p>Filed By: {$row_profile['A_ID']}</p>";
                  echo "<p>Variant Name: {$row_profile['VName']}</p>";
                  echo "<p>Variant ID: {$row_profile['V_ID']}</p>";
                  echo "<p>Timeline ID: {$row_profile['TID']}</p>";
                  echo "<p>Nexus Event Cause: {$row_profile['NEX']}</p>";
                  echo "<p>Statements: {$row_profile['Vstat']}</p>";
                  echo "<p>Time Cell: {$row_profile['Tcell']}</p>";
                  echo '<div class="d-grid gap-2 col-6 mx-auto" style="padding-bottom:5px;">
          <a href="settrialpage.php?CaseNumber='.$cnum.'" class="btn btn-dark" type="button">Set Trial</button>
          <a href="caseclosed.php?CaseNumber='.$cnum.'" class="btn btn-dark">Close Case</a>
      </div>';

              } else {
                  echo "0 results";
              }
          }

          $conn->close();
          ?>
           
      </div>
  </div>
</div>

<!------------------------ CARDS---------------------->

<div class="card-container" style="display: flex; margin-top: 200px; justify-content: center; gap: 100px;">
  <div class="card" style="width: 18rem; background-color: rgba(255, 255, 255, 0.3); border-radius: 50px;">
    <img src="./images/TVA.png" class="card-img-top" alt="">
    <div class="card-body" style="margin-left: auto; margin-right: auto; margin-top: 20px;">
      <h5 class="card-title">Case Status</h5>
      <p class="card-text">Ensuring that every decision Judges make is in the best interest of the multiverse.</p>
      <a href="cases.php" class="btn btn-dark">Click Here</a>
    </div>
  </div>

  <div class="card" style="width: 18rem; background-color: rgba(255, 255, 255, 0.3); border-radius: 50px;">
    <img src="./images/TVA.png" class="card-img-top" alt="">
    <div class="card-body"  style="margin-left: auto; margin-right: 50; margin-top: 20px;">
      <h5 class="card-title">Variant Status</h5>
      <p class="card-text">Judges aim to help variants become better people and contribute positively to the multiverse.</p>
      <a href="page3.php" class="btn btn-dark">Click Here</a>
    </div>
  </div>

  <div class="card" style="width: 18rem; background-color: rgba(255, 255, 255, 0.3); border-radius: 50px;">
    <img src="./images/TVA.png" class="card-img-top" alt="">
    <div class="card-body" style="margin-left: auto; margin-right: auto; margin-top: 20px;">
      <h5 class="card-title">Specimen Status</h5>
      <p class="card-text">Proper specimen collection is ensured for crucial for accurate case resolution.</p>
      <a href="specimen.php" class="btn btn-dark">Click Here</a>
    </div>
  </div>
</div>
</body>
</html>