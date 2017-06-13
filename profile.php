<?php
/* Attēlojam lietotāja profila informāciju */
require 'db.php';
session_start();

// Pārbaudam vai lietotājs ir ielogojies, izmantojam sessijas mainīgos
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "Lai apskatītu profila informāciju vispirms ir jāpierakstās!";
  header("location: error.php");    
}
else {
    // Padaram datus vieglāk nolasāmus
    $id = $_SESSION['id'];
    //$first_name = $_SESSION['first_name'];
    //$last_name = $_SESSION['last_name'];
    //$p_number = $_SESSION['p_number'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>

<?php
//Nospiežot submit pogu informācija tiek saglabāta datubāzē
  if(isset($_POST['submit'])){
    move_uploaded_file($_FILES['file']['tmp_name'],"img/profile/".$_FILES['file']['name']);
    $con = mysqli_connect("localhost","root","","accounts");
      //$q = mysqli_query($con,"UPDATE profils JOIN users SET profils.image = '".$_FILES['file']['name']."'WHERE users.email = '".$_SESSION['email']."'");
      $q = mysqli_query($con,"UPDATE users SET image = '".$_FILES['file']['name']."'WHERE email = '".$_SESSION['email']."'");
  }
?>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['profile'])) { //profila informācija
        require 'profile.php'; 
    }
    elseif (isset($_POST['mani-sludinajumi'])) { //lietotaja sludinajumi
        require 'mani-sludinajumi.php';
    }
}
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Profils</title>
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
  <div class="pogas-profile">
      <ul class="tab-group">
          <li class="tab active"><a href="#profile">Profils</a></li>
          <li class="tab"><a href="#mani-sludinajumi">Mani Sludinājumi</a></li>
      </ul>
  </div>


<div class="profile-wrapper">
    <!--Profile-->
    <div class="profile">
      <a href="profile.php">
      <?php
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
              ?>
      </a>
    </div>
    <!--Log Out-->
    <div class="log_out">
      <a href="logout.php">
        <img src="img/log_out.png" alt="BrumBrum Log Out" />
      </a>
    </div>
  </div>
</div>

<div class="profila-form">
  <div class="tab-content">

<!--Profila info-->
  <div id="profile" class="profile-form">
          <h1>Jūsu Profils</h1>

          <p>
          <?php 
          // Parādam ziņojumu par reģistrācijas apstiprināšanu tikai vienreiz
          if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];
              // Neatkartojam paziņojumu, lai netraucētu lietotājam
              unset( $_SESSION['message'] );
          }
          ?>
          </p>
          <?php
          // Atgādinam, ka reģistrācija ir jāapstiprina, līdz lietotājs neapstiprina
          if ( !$active ){
              echo
              '<div class="info">
              Reģistrācija nav apstiprināta, lūdzu apstipriniet to, nospiežot saņemto linku e-pastā!
              </div>';
          }
          ?>
          
          <div class="profile-picture">
            <form id="formaa" action="" method="post" enctype="multipart/form-data">
                <input id="filee" type="file" name="file">
                <input id="submitt" type="submit" name="submit">
            </form>

            <div class="profile-cover">
            <?php
              $con = mysqli_connect("localhost","root","","accounts");
                //$q = mysqli_query($con,"SELECT * FROM profils JOIN users WHERE users.email = '".$_SESSION['email']."'");
                $q = mysqli_query($con,"SELECT * FROM users WHERE email = '".$_SESSION['email']."'");
              while($row = mysqli_fetch_assoc($q)){

                    $first_name = $row ['first_name'];
                    $last_name = $row ['last_name'];
                    $p_number = $row ['p_number'];

                //echo $row['email'];
                if($row['image'] == ""){
                  echo "<img width='100' height='100' src='img/profile/default.png' alt='Default Profile Pic'>";
                } else {
                  echo "<img width='100' height='100' src='img/profile/".$row['image']."' alt='Profile Pic'>";
                }
                echo "<br>";
              }
            ?>
            </div>
          </div>

          <h2><?php echo $first_name.' '.$last_name; ?></h2>
          <h3><?= $p_number ?></h3>
          <p><?= $email ?></p>

            <form action="" method="post" autocomplete="off">
              <div class="top-row">
                <div class="field-wrap">
                  <label>
                    Vārds<span class="req">*</span>
                  </label>
                  <input type="text" required autocomplete="off" name="firstname"/>
                </div>



                <div class="field-wrap">
                  <label>
                    Uzvārds<span class="req">*</span>
                  </label>
                  <input type="text" required autocomplete="off" name="lastname"/>
                </div>
              </div>


              <div class="field-wrap">
                <label>
                  Telefona Numurs<span class="req">*</span>
                </label>
                <input type="text" onkeypress='validate(event)' required autocomplete="off" name="pnumber"/>
              </div>
              <a href="profile.php"><button class="button button-block" id="submitt" name="submitt"/>Apstiprināt</button></a>
          </form>

          <?php
            if (isset($_POST['submitt'])) {

                //$id = $_SESSION['id'];
                //$first_name = $_SESSION['first_name'];
                //$last_name = $_SESSION['last_name'];
                //$email = $_SESSION['email'];

                $_SESSION['first_name'] = $_POST['firstname'];
                $_SESSION['last_name'] = $_POST['lastname'];
                $_SESSION['p_number'] = $_POST['pnumber'];

                // Escape all $_POST variables to protect against SQL injections
                $first_name = $mysqli->escape_string($_POST['firstname']);
                $last_name = $mysqli->escape_string($_POST['lastname']);
                $p_number = $mysqli->escape_string($_POST['pnumber']);

                $result = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', p_number = '$p_number' WHERE id = '$id'";
                $mysqli->query($result);

                if ($result) {
                    //echo "<p>Record Updated<p>";
                    //include 'profile.php';
                  header("location: profile.php");
                }
                else
                {
                    $_SESSION['message'] = "Atvainojiet, radās problēmas ar datu saglabāšanu!";
                    header("location: error.php");
                }
            }
          ?>
           
          <a href="main.php"><button class="button button-block" name="atpakal"/>Atpakaļ</button></a>

    </div>

    <div id="mani-sludinajumi" class="content">
        <h1>Jūsu Sludinājumi!</h1>
        <form action="profile.php" method="post" autocomplete="off">
          <div id="mani-sludinajumi-cover" class="mani-sludinajumi-cover"></div>
        </form>
    </div>
    
  </div>
</div>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
<script src="//netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script>

</body>
</html>
