<?php
/* The password reset form, the link to this page is included
   from the forgot.php email message
*/
require 'db.php';
session_start();

// Make sure email and hash variables aren't empty
if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) )
{
    $email = $mysqli->escape_string($_GET['email']); 
    $hash = $mysqli->escape_string($_GET['hash']); 

    // Make sure user email with matching hash exist
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email' AND hash='$hash'");

    if ( $result->num_rows == 0 )
    { 
        $_SESSION['message'] = "Jūs esiet sasniedzis neīsto URL adresi paroles nomaiņai!";
        header("location: error.php");
    }
}
else {
    $_SESSION['message'] = "Atvainojiet, apstiprinājums neizdevies, mēģiniet vēlreiz!";
    header("location: error.php");  
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Atjaunojiet Paroli</title>
  <?php include 'css/css.html'; ?>
  <meta name="viewport" content="width=device-width, initial-scale = 0.6, maximum-scale=0.6, user-scalable=no"> 
</head>

<body>
    <div class="form">

          <h1>Ievadiet Jauno Paroli</h1>
          
          <form action="reset_password.php" method="post">
              
          <div class="field-wrap">
            <label>
              Jaunā Parole<span class="req">*</span>
            </label>
            <input type="password"required name="newpassword" autocomplete="off"/>
          </div>
              
          <div class="field-wrap">
            <label>
              Apstipriniet Jauno Paroli<span class="req">*</span>
            </label>
            <input type="password"required name="confirmpassword" autocomplete="off"/>
          </div>
          
          <!-- This input field is needed, to get the email of the user -->
          <input type="hidden" name="email" value="<?= $email ?>">    
          <input type="hidden" name="hash" value="<?= $hash ?>">    
              
          <button class="button button-block"/>Iesniegt</button>
          
          </form>

    </div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
