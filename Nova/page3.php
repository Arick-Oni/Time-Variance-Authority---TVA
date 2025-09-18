<?php include 'DESIGNPAGE.html'; ?>
<?php include("config/db_connect.php"); ?>
<div class="UngaBunga" style="margin-top: 200px;">
  <div style="margin-top: 80px; margin-left: 100px; margin-right: 100px;">
    <table id="variant" class="table table-bordered table-striped caption-top">
      <caption style="text-align: center; color: white;">Variant Record</caption>
      <thead>
        <tr>
          <th scope="col">Variant ID</th>
          <th scope="col">Variant Name</th>
          <th scope="col">Timeline ID</th>
          <th scope="col">Case Status</th>
          <th scope="col">Judgement</th>
          <th scope="col">Hunter ID</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT variants.Name as VName, variants.ID AS VID, variants.Timeline_ID AS TID, cases.Status AS Cstat, variants.PruneOrReset AS settlement, variants.Hunter_ID AS HID FROM cases INNER JOIN variants ON cases.variant_id = variants.ID";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
           echo  "<tr><td>" . $row["VID"] . "</td><td>" . $row["VName"] . "</td><td>" . $row["TID"] . "</td><td>" . $row["Cstat"] . "</td><td><form action='update_variant.php' method='post'><input type='hidden' name='idd' value='".$row["VID"]."'><select id='Prune' name='VID' required><option value='1'>Prune</option><option value='2'>Reset</option></select><input type='submit' name='submitt' value=''></form></td><td>" . $row["HID"] . "</td></tr>";
          }
        } else {
          echo "<tr><td colspan='6'>0 results</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<style>
  table {
    width: 100%;
    text-align: center;
  }

  th, td {
    padding: 10px;
  }
</style>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function() {
    $('#variant').DataTable();
  });
</script>
</body>
</html>

<!----------->
<!-- <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
  </ul>
   //<?php
  //if ($row['status']==1){
    //echo "Prune";
   // }if ($row['status']==2){
   //   echo "Reset";
   // }
  ?> 
  <select id="Prune" name="stat" required>
    <option value="1">Prune</option>
    <option value="2">Reset</option>

  </select>
  <form action="update_variant.php" method="post"><label for="Prune">Select</label><select id="Prune" name="stat" required><option value="1">Prune</option><option value="2">Reset</option></select><input type="submit" value="Update"></form> -->