<?php
    include("config/db_connect.php");
    session_start();

    
    if ($_SESSION['loggedin'] && $_SESSION['ID'] && $_SESSION['userType'] === 'Clerk') {
        
        $userID = $_SESSION['ID'];
        
    } else {
        
        header('Location: log_in.php');
        exit();
    }
    if($_SESSION['ID']){
        $ID=mysqli_real_escape_string($conn, $_SESSION['ID']);
        $sql="SELECT * FROM employee WHERE ID='$ID'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        mysqli_free_result($result);
	    
       
    }
	$sql13="SELECT u.employee_id, d.device_id, d.name, d.branch_no	FROM `uses` AS u INNER JOIN `devices` AS d ON u.device_id = d.device_id AND u.employee_id='$userID'";
					$result13=mysqli_query($conn, $sql13);
					$row13=mysqli_fetch_all($result13, MYSQLI_ASSOC);
					
					
   if(isset($_GET["id"]) && isset($_GET["dev"])){
	$empID = $_GET["id"];
	$devID = $_GET["dev"];
	$sql16="DELETE FROM `uses` WHERE `device_id` = '$devID' AND `employee_id`='$empID' ";
	$result16=mysqli_query($conn, $sql16);
	if($result16){
		header("Location: clerk.php");
	}
   }
   
   if(isset($_GET["devid"])){
	
	$devID = $_GET["devid"];
	$sql16="INSERT INTO `uses` VALUES('$userID', '$devID') ";
	$result16=mysqli_query($conn, $sql16);
	if($result16){
		header("Location: clerk.php");
	}
   }
   if(isset($_GET["req"])){
	$devID = $_GET["req"];
	
	$sql16="DELETE FROM `uses` WHERE `device_id` = '$devID'";
	$result16=mysqli_query($conn, $sql16);
	$sql17="INSERT INTO `requests` VALUES(NULL, current_timestamp(),'DeviceRepair','Scientist', 'Pending', '$userID', NULL, NULL, '$devID')";
	$result17=mysqli_query($conn, $sql17);
	if($result17){
		header("Location: clerk.php");
	}
   }



?>
<!DOCTYPE html>
<html>
    <head> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nova+Square&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <style>
			*{
				font-family: "Nova Square";
			}
            body{
                background-image: url("clerk.jpg");
                background-size:cover;
                background-repeat: no-repeat;
            }
            .navbar {
			background-color: rgba(255, 171, 64, .65);

			
			background-image: linear-gradient(to right, rgba(200, 200, 200, 0.7), rgba(255, 255,255, 0));
			margin-right: 1340px;
			margin-left: 50px;
			margin-top: 0px;
			border: 1px;
			border-radius: 0 0 50px 50px;
			height: 80px;
			align-content: center;
			/* backdrop-filter: blur(10px); */
			/* padding-right:  100px; */
			transition: 1s;
			display: flex;
			align-items: center;
		}
		.navbar:hover {
			background-color: rgba(255, 171, 64, .9);
            /* margin-right: 50px; */
			
		}
		.TVAdiv {
			height: 80px;
			width: 80px;
			margin-left: 10px;
			padding-left: 10px;
			transition: height, width .35s;
			border: 10px;
			border-color: red;
			display: inline-block;
		}
		.TVAdiv:hover {
			height: 84px;
			width: 84px;
			border: 5px;
			border-color: #F26722;
		}
		.TVA {
			background-size: cover;
			height: 150px;
			margin-left: 0px;
		}
		.about {
			font-family: 'Nova Square', sans-serif;
			color: #F26722;
			font-weight: 600;
			

			font-size: 22px;
			margin-left: 30px;
			margin-top: 10px;
			transition: font-size .35s, color .8s;
		
		}
		.wiki {
			font-family: 'Nova Square', sans-serif;
			color: #F26722;
			/* font-weight: bold; */
			font-size: 22px;
			font-weight: 600;
			margin-left: 15px;
			margin-top: 10px;
			transition: font-size .35s, color .8s;
		
		}
		.about:hover{
			font-size: 23px;
			color: #F26722;
			color: hsl(26, 90%, 50%);
		}
		.wiki:hover{
			font-size: 23px;
			color: #F26722;
			color: hsl(26, 90%, 50%);
		}
		
		
		.aboutusbtn{
			margin-left: 40px;
			background-color: transparent;

		}
		.btn{
			background-color: #F26722;
			font-family: "Nova Square";
			border-radius: 10px;
			transition: .7s;
		}
		
		.btn:hover{
			color: #F26722;
			background-color: white;
		}
		.mybtn{
			background-color: #F26722;
			position: absolute;
			left: 60.5%;
			top: 35%; 
			
			font-family: "Nova Square";
			border-radius: 10px;
			transition: .7s;
            width: 150px;
            height: 50px;
            display: flex; 
            justify-content: center; 
            align-items: center;
		}
        .mybtn2{
			background-color: #F26722;
			position: absolute;
			left: 60.5%;
			top: 45%; 
			
			font-family: "Nova Square";
			border-radius: 10px;
			transition: .7s;
            width: 150px;
            height: 50px;
            display: flex; 
            justify-content: center; 
            align-items: center;
            
		}
        .mybtn3{
			background-color: #F26722;
			position: absolute;
			left: 60.5%;
			top: 55%; 
			
			font-family: "Nova Square";
			border-radius: 10px;
			transition: .7s;
            width: 150px;
            height: 50px;
            display: flex; 
            justify-content: center; 
            align-items: center;
            
		}
        .mybtn4{
			background-color: #FF3300;
			position: absolute;
			left: 60.5%;
			top: 65%; 
			
			font-family: "Nova Square";
			border-radius: 10px;
			transition: .7s;
            width: 150px;
            height: 50px;
            display: flex; 
            justify-content: center; 
            align-items: center;
            
		}
		
		.mybtn:hover{
			color: #F26722;
			background-color: white;
		}
        .two{
            background-color: rgba(255, 171, 64, .45);
			/* background-image: linear-gradient(to right, rgba(200, 200, 200, 0.7), rgba(255, 255,255, 0)); */
            margin-right: 700px;
			margin-left: 240px;
			margin-top: 60px;
            height: 500px;
            border-radius: 50px 50px 50px 50px;
            backdrop-filter: blur(30px);
        }
        .imagee{
			display: inline;
			height: 200px;
			width: 200px;
			border-radius: 100px;
			margin-left: 20px;
			margin-top: 0px;
			
		}
        .orangee{
            font-family: "Nova Square";
            color: #FF3300;
        }
        .head{
            font-size: 21px;
            font-weight: 500;
        }
        
        body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        overflow: hidden;
    }
    .video {
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        z-index: -1;
    }
    video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
	::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #F26722;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #FF3300;
        }
        </style>
    </head>

    <body>
        
        <div class="video">
            <video autoplay loop muted playsinline>
                <source src="img\optimized\clerk_animation_optimized.mp4" type="video/mp4">
            
            </video>
        </div>
            <div class="navbar">
                <a href="clerk.php" class="TVAdiv"><img src="1701439279944.png" class="TVAdiv"></a>
                
                
            </div>
			
            <ul id="nav-mobile" class='right '>
                        <li><a href="clerk_varients.php" class="btn mybtn  brand z-depth-0" >Varient Info<i class="material-icons" style="margin-left: 1px;">info</i></a> </li>
            </ul>
            <ul id="nav-mobile" class='right '>
                    <li><a href="#" class="btn mybtn2 sidenav-trigger brand z-depth-0" data-target="mobile-links">Devices<i class="material-icons" style="margin-left: 5px;">devices</i></a> </li>
            </ul>
            <ul id="nav-mobile" class='right '>
                    <li><a href="clerk_specimen.php" class="btn mybtn3 brand z-depth-0">Specimen<i class="material-icons" style="margin-left: 5px;">category</i></a> </li>
            </ul>
            <ul id="nav-mobile" class='right '>
                    <li><a href="index.php" class="btn mybtn4 brand z-depth-0">Log Out<i class="material-icons" style="margin-left: 5px;">exit_to_app</i></a> </li>
            </ul>
			<div class="sidenav" style="height: 600px; width: 400px; margin-top:105px; border-radius: 75px 0px 0px 75px; background-color: rgba(255, 171, 64, 1);overflow:hidden;" id="mobile-links">
			<ul class="center" style="color:bisque;"><?php echo $row['Name'] ?>'s Device List</ul>	
				<div class="collection center" style="height: 225px; width: 350px; overflow:auto; margin-left: 50px; font-family: 'Nova Square';  border-radius: 100px 0px 0px 100px;">
					
					
					
					<?php
						foreach($row13 as $row1){
							
							?>
							
							<div class='collection-item'><?php echo $row1['name'] ?> - <?php echo $row1['device_id'] ?><a href="clerk.php?id=<?php echo $row1['employee_id'] ; ?>&dev=<?php echo $row1['device_id'] ?>" class="btn " style=' margin-left:20px;display: inline-block;'><i class="material-icons">delete</i></a><a href="clerk.php?req=<?php echo $row1['device_id'] ?>" class="btn" style='display:inline-block; margin-left:5px;'><i class="material-icons">settings</i></a></div> 
						<?php }?>
					
					
			</div>
			<ul class="center" style="color:bisque;">Add a Device</ul>	
			<div class="collection center" style="height: 225px; width: 350px; overflow:auto; margin-left: 50px; font-family: 'Nova Square';  border-radius: 100px 0px 0px 100px;">
				<?php
				$sql14="SELECT d.device_id, d.name, d.branch_no FROM devices AS d LEFT JOIN uses AS u ON d.device_id = u.device_id AND u.employee_id = '$userID' WHERE u.employee_id IS NULL";
				$result14=mysqli_query($conn, $sql14);
				$row14=mysqli_fetch_all($result14, MYSQLI_ASSOC);

				foreach($row14 as $row14){
							
							?>
							
							<div class='collection-item'><?php echo $row14['name'] ?> - <?php echo $row14['device_id'] ?><a href="clerk.php?devid=<?php echo $row14['device_id'] ?>" class="btn " style=' margin-left:20px;display: inline-block;'><i class="material-icons">add</i></a></div> 
						<?php }?>

			</div>
			</div>

			<div class="navbar two" style="height: 500px; width: 600px; backdrop-filter: blur(20px); opacity: 0.9;">
                <div class="imagee">
                    <img class="imagee" src="img\tumblr_c585ed9b343456e488c182a56c3aae73_e2209600_540.webp">
                </div>     
                
                <div class="container  center">
                    <h2 class="orangee"><?php echo $row['Name'] ?></h2>
                    <?php foreach($row as $key => $value){ 
						if (!($key==='Name' or $key=== 'Password')) {?>
							<h6 class="orangee head"><?php echo "$key: $value" ?></h6>
                    	<?php  } 
					}?>
                </div>

			
            </div>
	<script>
		$(document).ready(function(){
			$('.sidenav').sidenav({ edge: 'right' });
		})
    </script>   
    </body>

</html>