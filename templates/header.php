<!DOCTYPE html>
<html>
<head>
	<title>Time Variance Authority</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nova+Square&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<style>
		
		
		
		.navbar {
			background-color: rgba(255, 171, 64, .50);
			margin-right: 50px;
			margin-left: 50px;
			margin-top: 0px;
			border: 1px;
			border-radius: 0 0 50px 50px;
			height: 80px;
			align-content: center;
			backdrop-filter: blur(40px);
			transition: 1s;
			display: flex;
			align-items: center;
		}
		.navbar:hover {
			background-color: rgba(255, 171, 64, .9);

			
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
			left: 86.5%;
			top: 25%; 
			
			font-family: "Nova Square";
			border-radius: 10px;
			transition: .7s;
		}
		.mybtn3{
			background-color: #F26722;
			position: absolute;
			left: 40.5%;
			top: 80%; 
			
			font-family: "Nova Square";
			border-radius: 10px;
			transition: .7s;
		}
		
		.mybtn:hover{
			color: #F26722;
			background-color: white;
		}
		
	
		.loginform{
			
			max-width: 460px;
			margin-bottom: 100px;
			margin-top: 125px;
			padding-top: 20px;
			padding-bottom: 50px;
			padding-left: 20px;
			padding-right: 20px;
			border-radius: 45px;
			backdrop-filter: blur(15px);
			background-color: rgba(242, 103, 34, .1);
			margin-left: auto;
    		margin-right: auto;	
			transition: 1s;
			
		}
		.loginform:hover {
			
			background-color: rgba(255, 123, 54, .1);
		}
		.logininfo{
			color: #F26722;
			color: hsl(26, 90%, 50%);
			font-family: "Nova Square";
			font-size: 18px;
			font-weight: 400;
			text-align: center;
		}
		
		.logininfocnter{
			color: #F26722;
			font-family: "Nova Square";
			font-size: 30px;
			font-weight: 600;
			text-align: center;
		}
		.inp{
			color: #F26722;
			font-family: "Nova Square";
		}
		.inpp{
			font-family: "Nova Square";
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
		.regg{
			margin-top: 10px;
			
		}
		.dropdown-content li span, .select-dropdown {
            font-family: 'Nova Square', sans-serif; 
			color: #F26722;
		}
		
	</style>
</head>
<body>
		<div class="video">
            <video autoplay loop muted playsinline>
                <source src="video.mp4" type="video/mp4">
            
            </video>
        </div>

		<div class="navbar">
			<a href="index.php" class="TVAdiv"><img src="1701439279944.png" class="TVAdiv"></a>
			<a href="#" class="about">About us</a>
			<a href="#"  class="wiki">Wiki news</a>
			<ul id="nav-mobile" class='right hide-on-small-and-down'>
					<li><a href="log_in.php" class="btn mybtn brand z-depth-0">Log In</a> </li>
			</ul>
		</div>
	
