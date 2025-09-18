<?php
session_start();
$username=$_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="analyststyle.css?ts=<?=time()?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <title>Analyst</title>
</head>

<body>

  <div class="navbar">
    <a href="analyst.php">
      <img src="tvalogo.png">
    </a>
    <p>For All Time. Always</p>
    <div></div>
  </div>

  <?php
  echo "<div class='heading'>
  <h1>Welcome,$username</h1>
</div>"
  ?>

  <div class="container">

    <div class="card">
      <a href="variant.php">
        <div class="box box1">
          <div class="sub">
            <h3>Tracking variants to prevent nexus event</h3>
          </div>
        </div>
      </a>
      <h2>Track</h2>
    </div>

    <div class="card">
      <a href="timeline.php">
        <div class="box box2">
          <div class="sub">
            <h3>Monitoring timeline to prevent multiversal war</h3>
          </div>
        </div>
      </a>
      <h2>Monitor</h2>
    </div>

    <div class="card">
      <a href="case.php">
        <div class="box box3">
          <div class="sub">
            <h3>Opening cases to put variants on trial</h3>
          </div>
        </div>
      </a>
      <h2>Case</h2>
    </div>

  </div>

  <div class="slidebar">
    <ul>

      <li>
        <a href="#">
          <span class="icon"><i class="fa-solid fa-house"></i></span>
          <span class="title">Home</span>
        </a>
      </li>

      <li>
        <a href="devices.php">
          <span class="icon"><i class="fa-solid fa-microchip"></i></span>
          <span class="title">Devices</span>
        </a>
      </li>

      <li>
        <a href="../clerk_specimen.php">
          <span class="icon"><i class="fa-solid fa-cube"></i></span>
          <span class="title">Specimen</span>
        </a>
      </li>

      <li>
        <a href="#">
          <span class="icon"><i class="fa-solid fa-circle-info"></i></span>
          <span class="title">About Us</span>
        </a>
      </li>

      <li>
        <a href="../index.php">
          <span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span>
          <span class="title">SignOut</span>
        </a>
      </li>

    </ul>
  </div>

</body>

</html>