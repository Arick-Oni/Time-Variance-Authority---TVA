<?php

//connectoin to database
	$conn= mysqli_connect("localhost","root","","final");
	if(!$conn){
		echo"Connection error". mysqli_connect_error();
	}
?>