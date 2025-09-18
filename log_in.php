<?php
    include("config/db_connect.php");
    $ID=$password="";
    $errors=array('ID'=>'','password'=>'');
    

	if(isset($_POST["submit"])){
        $ID=$_POST['ID'];
        $password=$_POST['password'];	
        if (empty($_POST['ID'])){
            $errors['ID']= 'An ID is required <br/>';
        } else {
            
            if (!preg_match('/^\d+$/', $ID)) {

                $errors['ID'] = 'Input must contain only integers';
            }
            
        }
        if (empty($_POST['password'])){
            
            $errors['password']= 'Enter a password';
        }
	
        if(array_filter($errors)){
            // echo 'abc';
        } else {
            $ID= mysqli_real_escape_string($conn, $ID);
            $password= mysqli_real_escape_string($conn, $password);
            
            $sql="SELECT * FROM `employee` WHERE `ID`='$ID' AND `Password`='$password'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        if ($result) {
            
            if (mysqli_num_rows($result) == 1) {                
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['ID'] = $ID;
                $_SESSION['username'] = $row['Name'];
                $userType= $row["Type"];
                $_SESSION['userType'] = $userType;                
                $_SESSION['name'] = $Name;                
                switch ($userType) {
                    case 'Analyst':
                        header('Location: Fuad/analyst.php');
                        exit();
                        
                    case 'Clerk':
                        header('Location: clerk.php');
                        exit();
                    case 'Judge':
                        header('Location: Nova/judge.php');
                        exit();    
                    case 'Scientist':
                        header('Location: scientist.php');
                        exit(); 
                    case 'MinuteMan':
                        header('Location: Ibraheem/minuteman.php');
                        exit(); 
                    case 'Timekeeper':
                        header('Location: timekeeper.php');
                        exit(); 
                    
                    default:
                        header('Location: log_in.php');
                        exit();                       
                }
                
            } else {
                $errors['ID']= "ID doesn't match";
                $errors['password']= "Password doesn't match";
            }
        } else {
            echo "query error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <?php include ("templates/header.php");?>

    <section class="container">
        <h4 class='center'></h4>
        <form class="loginform" action="log_in.php" method="POST" >
            <h2 class="logininfocnter">Welcome to TVA</h2>
            <label class="logininfo">User ID:</label>
            <input class="inp" type='text' name="ID" value="<?php echo $ID ?>">
            <div class="red-text inpp"><?php echo $errors['ID']; ?></div>
			<label class="logininfo">Password:</label>
			<input class="inp" type="password" name="password" value="<?php echo $password ?>">
            <div class="red-text inpp"><?php echo $errors['password']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>
            
        </form>
        <a href="createaccount.php" class="btn mybtn3 brand z-depth-0">New User? Create an account!</a>
    </section>
    

    <?php include ("templates/footer.php");?>
    

</html>