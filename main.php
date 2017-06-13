<?php
/* Attēlojam lietotāja profila informāciju */
require 'db.php';
session_start();

// Pārbaudam vai lietotājs ir ielogojies, izmantojam sessijas mainīgos
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "Lai apskatītu profila informāciju vispirms ir jāpierakstās!";
  header("location: index.php");
}
else {
    // Padaram datus vieglāk nolasāmus
    $id = $_SESSION['id'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
    //$image = $user['image'];
    //$p_number = $user['p_number']; //jābut post nevis session
}

?>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['sludinajumi'])) { //visi sludinājumi
        require 'sludinajumi.php'; 
    }
    elseif (isset($_POST['pasazieris'])) { //brauciena pievienošana
        require 'pasazieris.php';
    }
    elseif (isset($_POST['brauciens'])) { //brauciena pievienošana
        require 'brauciens.php'; 
    }
    elseif (isset($_POST['search'])) {
            $sakums = $_POST['sakums'];
            $beigas = $_POST['beigas'];

            // Escape all $_POST variables to protect against SQL injections
            $sakums = $mysqli->escape_string($_POST['sakums']);
            $beigas = $mysqli->escape_string($_POST['beigas']);

            $_SESSION['sakums'] = $_POST['sakums'];
            $_SESSION['beigas'] = $_POST['beigas'];
        //require 'mekletie-sludinajumi.php';
    }
}
?>

<!DOCTYPE html>
<html lang="lv">
<head>
  <meta charset="UTF-8">
  <title>Galvenā</title>
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
  <div class="pogas-logged">
      <ul class="tab-group">
          <li class="tab active"><a href="#meklet, #mekletie-sludinajumi, #sludinajumi">Sludinājumi</a></li>
          <li class="tab"><a href="#brauciens">+ Brauciens</a></li>
          <li class="tab"><a href="#pasazieris">+ Pasazieris</a></li>
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
              //echo $row['email'];
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

</div>


<div class="sludinajumu-form">
  <div class="tab-content">

  <!--Meklešanas forma-->
  <div id="meklet">   
    <form action="main.php" method="post" autocomplete="off">
    <div class="credentials-wrapper">
        <div class="search-ico">
          <img src="img/search.png" width='50' height='50' alt="Search icon" />
        </div>
          <div class="field-wrap">
            <label>
              No
            </label>
            <input type="text" autocomplete="off" class="city" name="sakums"/>
          </div>
                
          <div class="field-wrap">
            <label>
              Uz
            </label>
            <input type="text" autocomplete="off" class="city" name="beigas"/>
          </div>
                
          <button type="submit" class="button button-block" name="search" />Meklēt</button>
      </div>
    </form>
  </div>

    <!--Mekletie sludinajumi-->
  <div id="mekletie-sludinajumi" class="content">
    <h1>Meklētie Sludinajumi!</h1>
          <form action="main.php" method="post" autocomplete="off">
              <div id="mekletie-sludinajumi-cover" class="mekletie-sludinajumi-cover">
              <?php
                 if (isset($_POST['search'])) {
                   include 'mekletie-sludinajumi.php';
                 }
              ?>
              </div>
          </form>
        </div>

  <!--Visi sludinajumi-->
  <div id="sludinajumi" class="content">
    <h1>Braucam Kopā!</h1>
          <form action="main.php" method="post" autocomplete="off">
              <div id="sludinajumi-cover" class="sludinajumi-cover">
              </div>
          </form>
        </div>

          <!--Pievienot pasazieri-->
         <div id="pasazieris">
          <h1>Pievienot Pasažieri</h1>

          <form action="main.php" method="post" autocomplete="off">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                No<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='sakums' />
            </div>
        
            <div class="field-wrap">
              <label>
                Uz<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='beigas' />
            </div>
          </div>

          <div class="top-row">
            <div class="field-wrap">
              <label>
                Datums<span class="req">*</span>
              </label>
              <input type="text" placeholder='' onfocus="(this.type='date')" onfocusout="(this.type='text')" placeholder="false" required autocomplete="off" name='datums' />
            </div>
            
            <div class="field-wrap">
              <label>
                Laiks<span class="req">*</span>
              </label>
              <input type="text" placeholder='' onfocus="(this.type='time')" onfocusout="(this.type='text')" placeholder="false" required autocomplete="off" name='laiks'/>
            </div>
          </div>

          <div class="field-wrap">
              <label>
                Apraksts
              </label>
              <textarea id="description" type="textarea" rows="4" autocomplete="off" name='description'></textarea>
          </div>

          <button type="submit" class="button button-block" name="pasazieris" />Pievienot</button>
          
          </form>
        </div>

          <!--Pievienot Braucienu-->
        <div id="brauciens">
          <h1>Pievienot Braucienu</h1>
          
          <form action="main.php" method="post" autocomplete="off">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                No<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='sakums' />
            </div>
        
            <div class="field-wrap">
              <label>
                Uz<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='beigas' />
            </div>
          </div>

          <div class="top-row">
            <div class="field-wrap">
              <label>
                Datums<span class="req">*</span>
              </label>
              <input type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')" required autocomplete="off" name='datums' />
            </div>
            
            <div class="top-row">
            <div class="field-wrap">
              <label>
                Laiks<span class="req">*</span>
              </label>
              <input type="text" onfocus="(this.type='time')" onfocusout="(this.type='text')" required autocomplete="off" name='laiks'/>
            </div>

              <div class="field-wrap">
                <label>
                  Cena<span class="req">*</span>
                </label>
                <input type="text" onkeypress='validate_cena(event)' required autocomplete="off" name='cena' />
              </div>
            </div>
          </div>

            <div class="field-wrap">
                <label class="active">
                  Vietu skaits<span class="req">*</span>
                </label>
                <output name="output-skaits" id="outputId">1</output>
                <input id="inputId" type="range" required autocomplete="off" min="1" max="8" value="1" name="skaits" oninput="outputId.value = inputId.value"/>
            </div>

          <div class="field-wrap">
              <label>
                Apraksts
              </label>
              <textarea id="description" type="textarea" rows="4" autocomplete="off" name='description'></textarea>
          </div>

          <button type="submit" class="button button-block" name="brauciens" />Pievienot</button>
          
          </form>
        </div>  
      </div>
</div> 

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="//netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script>
    <script src="js/index.js"></script>



</body>
</html>
