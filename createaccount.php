<?php
include("config/db_connect.php");
$Name=$Password=$last_id="";
$errors = array('Name' => '', 'password' => '', 'Date_of_Birth'=>'', 'Type'=>'');

if (isset($_POST["submit"])) {
    $Name = $_POST['Name'];
    $password = $_POST['password'];
    $Date_of_Birth=$_POST['Date_of_Birth'];
    $Type=$_POST['Type'];

    if (empty($Name)) {
        $errors['Name'] = 'Input your Name';
    } elseif  (!preg_match("/^[a-zA-Z\s]+$/", $Name)) {
        $errors['Name'] = 'Name must contain only letters';
    }

    if (empty($password)) {
        $errors['password'] = 'Enter a password';
    }
    if (empty($Date_of_Birth)) {
        $errors['Date_of_Birth'] = 'Select a Date';
    }
    if (empty($Type)) {
        $errors['Type'] = 'Enter Employee Type';
    }

    if (!array_filter($errors)) {
        
        // Check database connection
        if (!$conn) {
            echo "Database connection failed: " . mysqli_connect_error();
            exit();
        }
        
        $Name = mysqli_real_escape_string($conn, $Name);    
        $password = mysqli_real_escape_string($conn, $password);

        $sql = "INSERT INTO `employee` (`ID`, `Name`, `Password`, `Clearance`, `Origin`, `Date of Birth`, `Registration Date`, `Type`) VALUES (NULL, '$Name', '$password', '2', 'Clone', '$Date_of_Birth', current_timestamp(), '$Type')";

        
        if (mysqli_query($conn, $sql)) {

            $last_id = mysqli_insert_id($conn);

            // Add a 2-second delay to address potential latency issues
            sleep(2);

            // Convert Type to lowercase for table name matching database
            $table_name = strtolower($Type);

            // Check if the Type table exists
            $table_check = mysqli_query($conn, "SHOW TABLES LIKE '$table_name'");
            if (mysqli_num_rows($table_check) == 0) {
                echo "Error: Table '$table_name' does not exist.";
                exit();
            }

            $sql21="INSERT INTO `$table_name`(`ID`) VALUES('$last_id')";
            $result21 = mysqli_query($conn, $sql21);

            // Check if second query failed
            if (!$result21) {
                echo "Error inserting into $Type table: " . mysqli_error($conn);
                exit();
            }

            // Set success flag and store the ID for popup display
            $success = true;
            $employee_id = $last_id;
        } else {
            echo "Query error: " . mysqli_error($conn);
        }
    }
}


?>

<!DOCTYPE html>
<html>
<?php include("templates/header.php"); ?>

<section class="container">
    <h4 class='center'></h4>
    <form class="loginform regg" action="" method="POST">
        <h2 class="logininfocnter">User Registration</h2>
        <label class="logininfo">Your Name:</label>
        <input class="inp" type='text' Name="Name" value="<?php echo htmlspecialchars($Name); ?>">
        <div class="red-text inpp"><?php echo $errors['Name']; ?></div>
        
        <label class="logininfo">Password:</label>
        <input class="inp" type="password" Name="password" value="">
        <div class="red-text inpp"><?php echo $errors['password']; ?></div>
        
        
        <label class="logininfo">Type:</label>
        <select class="inp" name="Type">
            <option value="Analyst">Analyst</option>
            <option value="Clerk" >Clerk</option>
            <option value="Scientist" >Scientist</option>
            <option value="Judge">Judge</option>
            <option value="Minutemen">MinuteMen</option>
        </select>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var elems = document.querySelectorAll('select');
                    var instances = M.FormSelect.init(elems, {});
                });
        </script>
        

        <label class="logininfo">Date_of_Birth:</label>
        <input class="inp" type='date' Name="Date_of_Birth" value="<?php echo htmlspecialchars($Date_of_Birth); ?>">
        <div class="red-text inpp"><?php echo $errors['Date_of_Birth']; ?></div>
        
        <div class="center">
            <input type="submit" Name="submit" value="submit" class="btn brand z-depth-0"></div>  
    </form>
    
</section>

<!-- Success Modal -->
<div id="successModal" class="modal">
    <div class="modal-content center">
        <h4 class="green-text"> Congratulations! </h4>
        <h5>Your account has been created successfully!</h5>
        <div class="card-panel orange lighten-4">
            <h6><strong>Your Employee ID is: <span id="employeeId" class="orange-text text-darken-2"></span></strong></h6>
            <p><em>Please remember this ID for future logins.</em></p>
        </div>
    </div>
    <div class="modal-footer">
        <a href="log_in.php" class="modal-close waves-effect waves-green btn green">Go to Login Page</a>
        <a href="#!" class="modal-close waves-effect waves-light btn grey">Stay Here</a>
    </div>
</div>

<?php include("templates/footer.php"); ?>
<script>
        $(document).ready(function(){
            $('.modal').modal();
            
            <?php if (isset($success) && $success && isset($employee_id)): ?>
            // Show success modal with employee ID
            $('#employeeId').text('<?php echo $employee_id; ?>');
            $('#successModal').modal('open');
            <?php endif; ?>
        });</script>

