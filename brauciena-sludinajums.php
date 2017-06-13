          <?php
                require 'db.php';
                session_start();

                $page_name = $_GET['page_id'];

                $result2 = $mysqli->query("SELECT * FROM users JOIN brauciens ON users.id=brauciens.users_id WHERE brauciens.id=$page_name") or die($mysqli->error());

                    while($row = mysqli_fetch_assoc($result2)){
                      echo '<div class="sludinajuma-infoo">';
                      //Lietotāja info
                        echo '<div class="profile-info">';
                          if($row['image'] == ""){
                            echo "<img width='100' height='100' src='img/profile/default.png' alt='Default Profile Pic'>";
                          } else {
                            echo "<img width='100' height='100' src='img/profile/".$row['image']."' alt='Profile Pic'>";
                          }
                        echo '</div>';
                        //Brauciena info
                        echo '<div class="brauciena-info">';

                        echo '<div class="name">';
                          $name = $row['first_name'];
                          $surname = $row['last_name'];
                          echo "<h2> $name $surname </h2>"; 
                        echo '</div>';

                        echo '<div class="numurs-info">';
                          $numurs = $row['p_number'];
                          echo "<h3>$numurs</h3>";
                        echo '</div>';

                          echo '<div class="marsruts-info">';
                            $sakums = $row['sakums'];
                            $beigas = $row['beigas'];
                            echo "<p>$sakums - $beigas</p>";
                          echo '</div>';

                          echo '<div class="datums-info">';
                            $datums = $row['datums'];
                            $laiks = $row['laiks'];
                            echo "<p>$datums | $laiks</p>";
                          echo '</div>';

                          echo '<div class="cena-info">';
                            $cena = $row['cena'];
                            echo "<p>$cena €</p>";
                          echo '</div>';

                          echo '<div class="skaits-info">';
                            $skaits = $row['skaits'];
                            echo "<p>$skaits</p>";
                          echo '</div>';

                          echo '<div class="description-info">';
                            $description = $row['description'];
                            echo "<p>$description</p>";
                          echo '</div>';

                          echo '<div class="veids-ico">';
                            echo '<img src="img/car_ico.png" width="50" height="50" alt="Search icon" />';
                          echo '</div>';

                        echo '</div>';
                        echo '<button class="button button-block" onclick="history.back(-1)" name="atpakal"/>Atpakaļ</button></a>';
                      echo '</div>';
                  }
              ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Sludinajums</title>
  <?php include 'css/css.html'; ?>
  <meta name="viewport" content="width=device-width, initial-scale = 0.6, maximum-scale=0.6, user-scalable=no"> 
</head>

<body>
<!--Lapas galvene-->
<div class="header">

  <!--Logo-->
  <div class="logo">
    <a href="main.php">
      <img src="img/BrumLogo.png" alt="BrumBrum Logo" />
    </a>
  </div>

  <!--Pogas-->
  <div class="pogas-sludinajums">
      <ul class="tab-group">
          <li class="tab active"><a href="#slud">Sludinājums</a></li>
      </ul>
  </div>

<div class="profile-wrapper">
    <!--Profile-->
    <div class="profile">
    <?php
      if ($_SESSION['logged_in'] == true) {
      echo '<a href="profile.php">';
          $con = mysqli_connect("localhost","root","","accounts");
          //$q = mysqli_query($con,"SELECT * FROM profils JOIN users WHERE users.email = '".$_SESSION['email']."'");
          $q = mysqli_query($con,"SELECT * FROM users WHERE email = '".$_SESSION['email']."'");
            while($row = mysqli_fetch_assoc($q)){
              if($row['image'] == ""){
                echo "<img width='50' height='50' src='img/profile/default.png' alt='Default Profile Pic'>";
                } else {
                echo "<img width='50' height='50' src='img/profile/".$row['image']."' alt='Profile Pic'>";
                }
                echo "<br>";
                }
              }else {
                echo "<style>display:none</style>";
              }
      echo '</a>';
      ?>
    </div>
    <!--Log Out-->
    <div class="log_out">
    <?php
      if ($_SESSION['logged_in'] == true) {
      echo '<a href="index.php">';
        echo '<img src="img/log_out.png" alt="BrumBrum Log Out" />';
      echo '</a>';
      }else {
          echo "<style>display:none</style>";
      }
      ?>
    </div>
  </div>
</div>


<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="//netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script>
<script src="js/index.js"></script>

</body>
</html>
