<?php 
/* Reset your password form, sends reset.php password link */
require 'db.php';
session_start();

// Check if form submitted with method="post"
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) 
{   
    $email = $mysqli->escape_string($_POST['email']);
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

    if ( $result->num_rows == 0 ) // User doesn't exist
    { 
        $_SESSION['message'] = "Lietotājs ar šādu e-pasta adresi neeksistē!";
        header("location: error.php");
    }
    else { // User exists (num_rows != 0)

        $user = $result->fetch_assoc(); // $user becomes array with user data
        
        $email = $user['email'];
        $hash = $user['hash'];
        $first_name = $user['first_name'];

        // Session message to display on success.php
        $_SESSION['message'] = "<p>Lūdzu pārbaudiet savu e-pastu <span>$email</span>"
        . ", tajā atradīsiet apstiprinājuma linku, lai pabeigtu paroles atjaunošanu!</p>";

        // Send registration confirmation link (reset.php)
        $to      = $email;
        $subject = 'Paroles atjaunošanas links ( braucarmums.lv )';
        $message_body = '
        Labdien '.$first_name.',

        Jūs esiet pieprasījis paroles atjaunošanu!

        Lūdzu nospiediet šo linku, lai mainītu paroli:

        http://localhost/test/reset.php?email='.$email.'&hash='.$hash;  

        mail($to, $subject, $message_body);

        header("location: success.php");
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Paroles Atjaunošana</title>
  <?php include 'css/css.html'; ?>
  <meta name="viewport" content="width=device-width, initial-scale = 0.6, maximum-scale=0.6, user-scalable=no"> 
</head>

<body>
    
  <div class="form">

    <h1>Atjaunojiet Savu Paroli</h1>

    <form action="forgot.php" method="post">
     <div class="field-wrap">
      <label>
        E-pasta Adrese<span class="req">*</span>
      </label>
      <input type="email"required autocomplete="off" name="email"/>
    </div>
    <button class="button button-block"/>Atjaunot</button>
    </form>
     <a href="index.php"><button class="button button-block"/>Galvenā</button></a>
  </div>
          
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="//netsh.pp.ua/upwork-demo/1/js/typeahead.js"></script>
<script src="js/index.js"></script>
</body>

</html>
