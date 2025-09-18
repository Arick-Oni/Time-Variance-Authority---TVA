<?php include 'DESIGNPAGE.html'; ?>
<?php include ("config\db_connect.php"); ?>


<!-- Insertion form-->

<div style="margin-top: 150px; width: 90%; height: 90px; text-align: center;margin-left: auto;
    margin-right: auto; position: auto; backdrop-filter: blur(5px); background-color: rgba(255, 255, 255, 0.3); border-radius: 10px;">
 <form style="top: 18px; width: 100%; position: relative;" action="" method="POST">
    Record ID<input type="number" name="Record_ID">
    <!-- Timeline ID<input type="number" name="Timeline_ID"> -->
    <select class="" name="timelineID" placeholder="Timeline ID">
                  <option value="">Timeline ID</option>
                  <?php
                    $select_query="SELECT * FROM `timeline`";
                    $result_query=mysqli_query($mysqli,$select_query);
                    while ($row=mysqli_fetch_assoc($result_query)) {
                      $type=$row['Type'];
                      $type_id=$row['Timeline_ID'];
                      echo "<option value='$type_id'>$type_id</option>";
                    }
                   ?>
                </select>
    Locker No<input type="text" name="Locker_Num">
    <!-- Employee ID<input type="number" name="Emplyee_ID"> -->
    <select class="" name="HunterID" placeholder="Employee ID">
                  <option value="">Employee ID</option>
                  <?php
                    $select_query="SELECT * FROM `employee`";
                    $result_query=mysqli_query($mysqli,$select_query);
                    while ($row=mysqli_fetch_assoc($result_query)) {
                      $rank=$row['Rank'];
                      $hunterid=$row['ID'];
                      echo "<option value='$hunterid'>$hunterid</option>";
                    }
                   ?>
                </select>
    <input type="submit" name="submit">
</form>
<?php

if (isset($_POST['submit']))
{
    $Record_ID=$_POST['Record_ID'];
    $Timeline_ID=$_POST['timelineID'];
    $Locker_Num=$_POST['Locker_Num'];
    $Emplyee_ID=$_POST['HunterID'];
    $conn= mysqli_connect("localhost", "root","","tva_final");
    $res=mysqli_query($conn,"INSERT into specimen values(NULL,'$Timeline_ID','$Locker_Num','$Emplyee_ID')");
    if($res)
    {
      echo "<script>alert('Successfully Updated')</script>";
    }
    else{
        echo "<br>"."Unsuccessful!";
    }
}
?>


<!-- data table -->

</div>
<div style="margin-top: 80px;margin-left: 100px; margin-right: 100px;" >
<table id="specimen" class="tablee caption-top" >
  <caption style="text-align: center; color: white;">Specimen Record</caption>
  <thead>
    <tr>
      <th scope="col">Record No</th>
      <th scope="col">Timeline ID</th>
      <th scope="col">Locker No</th>
      <th scope="col">Employee ID</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $conn= mysqli_connect("localhost", "root","","tva_final");
    if ($conn -> connect_error) {
      die("Connection failed:".$conn -> connect_error);
    }
    $sql = "SELECT Record_ID,Timeline_ID,Locker_Num,Emplyee_ID from specimen";
    $result= $conn-> query($sql);

    if ($result-> num_rows > 0 ) {
      while ($row = $result -> fetch_assoc()){
        echo "<tr><td>".$row["Record_ID"]. "</td><td>".$row["Timeline_ID"]."</td><td>".$row["Locker_Num"]."</td><td>".$row["Emplyee_ID"]."</td></tr>";
        }
        echo '</table>';
      }
      else {
        echo "0 result";
      }
    if (isset($_GET['search'])){
      $filtervalues= $_GET['search'];
      $query="SELECT * from specimen where Record_ID = '$filtervalues' OR Timeline_ID LIKE '%$filtervalues%' ";
      $query_run = mysqli_query($conn,$query);

      if ($query_run -> num_rows > 0) 
      {

        foreach($query_run as $items)
        {
          ?>
          <tr>
            <td><?=$items['Record_ID']; ?></td>
            <td><?=$items['Timeline_ID']; ?></td>
            <td><?=$items['Locker_Num']; ?></td>
            <td><?=$items['Emplyee_ID']; ?></td>
        </tr>
        <?php
        }
      }
      else{
        ?>
          <tr>
            <td colspan="4">No Record Found</td>

      </tr>
      <?php

      }

    }
    $conn-> close();
    ?>
  </tbody>
</table>
</div>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>  
    <script>	
    new DataTable('#specimen');
    </script>
</body>
</html>
<!-- <select id="Prune" name="stat" required onchange="this.form.submit()">
        <option value="1">Prune</option>
        <option value="2">Reset</option>
    </select> -->