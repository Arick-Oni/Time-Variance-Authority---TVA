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



<div  class="container" style="float: center; width: 100%; margin-top: 120px;">
  <table id="example" class="tablee caption-top">
    <caption style="text-align: center; color: white;">Case History</caption>
    <thead>
        <tr>
            <th scope="col">Case No</th>
            <th scope="col">Analyst ID</th>
            <th scope="col">Variant ID</th>
            <th scope="col">Total Trials</th>
            <th scope="col">Verdict</th>
            <th scope="col">Court Room</th>
            <th scope="col">Judge</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $Jname = $_SESSION['name'];
        $sql = "SELECT cases.Number as CNumber,cases.Analyst_ID AS A_ID,cases.variant_id AS V_ID,cases.Num_of_Trials AS NTr, trial.Verdict AS Verdict, trial.Court_Number AS CNo FROM cases INNER JOIN trial ON trial.Case_Number=cases.Number WHERE cases.Status= 'Closed'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["CNumber"] . "</td><td>" . $row["A_ID"] . "</td><td>" . $row["V_ID"] . "</td><td>" . $row["NTr"] . "</td><td>" . $row["Verdict"] . "</td><td>" . $row["CNo"] . "</td><td>" . $Jname . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No results found.</td></tr>";
        }

        echo '</tbody></table>';
        ?>
    </tbody>


                
</div>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>  
    <script>	
    new DataTable('#example');
    </script>
</body>
</html>