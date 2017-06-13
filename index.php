<?php 
/* Galvenā lapa ar divām formām: pierakstīties un reģistrēties */
require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sākums</title>
  <?php include 'css/css.html'; ?>
  <meta name="viewport" content="width=device-width, initial-scale = 0.6, maximum-scale=0.6, user-scalable=no"> 
</head>

<?php 
$_SESSION['logged_in'] = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //lietotāja pierakstīšanās

        require 'login.php';
        require 'sludinajumi.php';
        
    }
    
    elseif (isset($_POST['register'])) { //lietotāja reģistrācija
        
        require 'register.php';
        
    }
}
?>

<body>
<!--Lapas galvene-->
<div class="header">

<!--Logo-->
<div class="logo">
  <a href="index.php">
    <img src="img/BrumLogo.png" alt="BrumBrum Logo" />
  </a>
</div>

<!--Pogas-->
  <div class="pogas">
      <ul class="tab-group">
          <li class="tab"><a href="#signup">Reģistrēties</a></li>
          <li class="tab active"><a href="#login, #sludinajumi">Pierakstīties</a></li>
      </ul>
  </div>
</div>

<!--Login forma-->
  <div class="login-form">
      <div class="tab-content">
         <div id="login">   
          <form action="index.php" method="post" autocomplete="off">

            <div class="credentials-wrapper">
              <div class="field-wrap">
                <div class="icon">
                  <img src="img/user_ico.png" width='40' height='40' alt="User icon" />
                </div>
                <label>
                  E-pasts<span class="req">*</span>
                </label>
                <input type="email" required autocomplete="off" name="email"/>
              </div>
              
              <div class="field-wrap">
                <div class="icon">
                  <img src="img/password_ico.png" width='40' height='40' alt="Password icon" />
                </div>
                <label>
                  Parole<span class="req">*</span>
                </label>
                <input type="password" required autocomplete="off" name="password"/>
              </div>
              
              <button class="button button-block" name="login" />Pierakstīties</button>

              <p class="forgot"><a href="forgot.php">Aizmirsāt Paroli?</a></p>

            </div>
          </form>
        </div>

  <!--Visi sludinajumi-->
  <div id="sludinajumi" class="content">
    <h1>Braucam Kopā!</h1>
              <div id="sludinajumi-cover" class="sludinajumi-cover">
             
              </div>
        </div>

          <!--Reģistrācija-->
        <div id="signup">   
          <h1>Rēģistrēties</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                Vārds<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='firstname' />
            </div>
        
            <div class="field-wrap">
              <label>
                Uzvārds<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='lastname' />
            </div>
          </div>

          <div class="field-wrap">
<!--             <div class="icon">
              <img src="img/user_ico.png" width='40' height='40' alt="User icon" />
            </div> -->
            <label>
              E-pasta Adreses<span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" name='email' />
          </div>
          
          <div class="field-wrap">
<!--             <div class="icon">
              <img src="img/password_ico.png" width='40' height='40' alt="Password icon" />
            </div> -->
            <label>
              Iestatiet Paroli<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name='password'/>
          </div>

          <button type="submit" class="button button-block" name="register" />Reģistrēties</button>
          
          </form>
        </div>  
      </div>
</div> 


  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="//netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script>
    <script src="js/index.js"></script>

</body>
</html>
