<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE username = '$username' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:home_page.php');
   }else{
      $message[] = 'incorrect username or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   <link rel="stylesheet" href="css/style.css">
   <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
   <script src="js/script1.js"></script>

</head>
<body>
   <center>
<div class="form-container">

   <form action="" method="post" name = "form" enctype="multipart/form-data">
      <h3>login now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="text" name="username" placeholder="Enter Username" class="box" >
      <input type="password" name="password" placeholder="Enter password" class="box">
      <input type="submit" name="submit" value="login now" class="btn">
      <p>don't have an account? <a href="Signup.php">regiser now</a></p>
   </form>

</div>
   </center>
</body>
</html>