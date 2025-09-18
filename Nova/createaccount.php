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
        
        $Name = mysqli_real_escape_string($conn, $Name);    
        $password = mysqli_real_escape_string($conn, $password);

        $sql = "INSERT INTO `employee` (`ID`, `Name`, `Password`, `Clearance`, `Origin`, `Date of Birth`, `Registration Date`, `Type`) VALUES (NULL, '$Name', '$password', '2', 'Clone', '$Date_of_Birth', current_timestamp(), '$Type')";

        
        if (mysqli_query($conn, $sql)) {
            
            $last_id = mysqli_insert_id($conn);
            ?>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Successful</title>
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Nova+Square&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
                <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            </head>
            <body>
                <div class="card center">
                    <div class="card-content orange">
                        Congratulations!! Your ID is <?php echo $last_id; ?>
                    </div>
                </div>
            </body>
            </html>
            <?php
            header("refresh:5; url=index.php");
            exit();
                } else {
                    echo "Query error: " . mysqli_error($conn);
                }
        } else {
            
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
            <!-- <option value="">Choose your option</option> -->
            <option value="Analyst">Analyst</option>
            <option value="Clerk" >Clerk</option>
            <option value="Scientist" >Scientist</option>
            <option value="Judge">Judge</option>
            <option value="MinuteMan">MinuteMan</option>
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
    
    <!-- <a href="createaccount.php" class="btn mybtn3 brand z-depth-0">New User? Create an account!</a> -->
</section>

<?php include("templates/footer.php"); ?>
<script>
        $(document).ready(function(){
            $('.modal').modal();
        });</script>

