<?php

include 'config.php';

if(isset($_POST['submit'])){

   $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
   $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $gender = mysqli_real_escape_string($conn, $_POST['gender']);
   $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE username = '$username' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `user_form`(firstname, lastname, email, username, password, gender, birthday, image) VALUES('$firstname', '$lastname', '$email', '$username','$pass','$gender','$birthday', '$image')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('location:login.php');
         }else{
            $message[] = 'registeration failed!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   <link rel="stylesheet" href="css/style.css">
   <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
   <script src="js/script.js"></script>
</head>
<body>
<center>
<div class="form-container">

   <form action="" method="post" name= "form" enctype="multipart/form-data">
      <h3>Sign Up</h3>
      <large>It's quick and easy.</large>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="text" name="firstname" placeholder="enter Firstname" class="box" >
      <input type="text" name="lastname" placeholder="enter Lastname" class="box" >
      <input type="text" name="username" placeholder="enter username" class="box">
      <input type="email" name="email" placeholder="enter email" class="box" >
      <input type="text" name="gender" placeholder="enter Gender" class="box">
      <input type="birthday" name="birthday" placeholder="enter Birthday" class="box" >
      <input type="password" name="password" placeholder="enter password" class="box" >
      <input type="password" name="cpassword" placeholder="confirm password" class="box" >
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" name="submit" value="register now" class="btn">
      <a href="login.php"></p><input type="button" name="submit" value="Back" class="btn"> </a>
   </form>

</div>
   </center>
</body>
</html>