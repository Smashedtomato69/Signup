<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){

   $update_firstname = mysqli_real_escape_string($conn, $_POST['update_firstname']);
   $update_lastname = mysqli_real_escape_string($conn, $_POST['update_lastname']);
   $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);

   mysqli_query($conn, "UPDATE `user_form` SET firstname = '$update_firstname', email = '$update_email', lastname= '$update_lastname' WHERE id = '$user_id'") or die('query failed');

   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `user_form` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `user_form` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
         if($image_update_query){

            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated succssfully!';
      }
   }

}

?>	

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<table border="1" style="margin left: -10px; margin-top: -10px;">
	<tr>
	<td>
		<div style="border: solid 1px #888788; background-color: #53FF33; height: 100px; padding: 20px; width: 1860px">
			<table border="0" width="100%">
				<tr>
					<td width="20%">
						<font style="font-size: 25pt; vertical-align: middle;"> CS Face</font>
						&nbsp&nbsp&nbsp&nbsp&nbsp
						<input type="text" name="txtsearchname" placeholder="Search Name" size="22" style="border:0px solid; border-radius: 20px; font-size:20px; outline: none; padding: 10px; vertical-align: middle">
					</td>
					<td width="30%">
						&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						&nbsp&nbsp&nbsp&nbsp&nbsp
						<a href="CS Home page.php "><img src="image/refresh.png" style="height: 50px; width: 50px; border-radius: 5px;" type= "button"></a>
						&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						&nbsp&nbsp&nbsp&nbsp&nbsp
						<img src="image/message.png" style="height: 50px; width: 50px;">
						&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					</td>
					<td width="13%" style="text-align: c;">
						<a href="login.php"><img src="image/logout.png" style="height: 50px; width: 50px; border-radius: 5px;"></a>
					</td>
				</tr>
			</table>
		</div>
	</td>
</tr>
</table>
<table border="1" style="width: 100%;">
	<tr>
		<td>
		<div class="update-profile">

<?php
   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($select) > 0){
	  $fetch = mysqli_fetch_assoc($select);
   }
?>

<form action="" method="post" enctype="multipart/form-data">
   <?php
	  if($fetch['image'] == ''){
		 echo '<img src="images/default-avatar.png">';
	  }else{
		 echo '<img src="uploaded_img/'.$fetch['image'].'">';
	  }
	  if(isset($message)){
		 foreach($message as $message){
			echo '<div class="message">'.$message.'</div>';
		 }
	  }
   ?>
   <div class="flex">
	  <div class="inputBox">
		 <span>Firstname :</span>
		 <input type="text" name="update_firstname" value="<?php echo $fetch['firstname']; ?>" class="box">
		 <span>Lastname :</span>
		 <input type="text" name="update_lastname" value="<?php echo $fetch['lastname']; ?>" class="box">
		 <span>your email :</span>
		 <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
		 <span>update your pic :</span>
		 <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
	  </div>
	  <div class="inputBox">
		 <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
		 <span>old password :</span>
		 <input type="password" name="update_pass" placeholder="enter previous password" class="box">
		 <span>new password :</span>
		 <input type="password" name="new_pass" placeholder="enter new password" class="box">
		 <span>confirm password :</span>
		 <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
	  </div>
   </div>
   <input type="submit" value="Confirm" name="update_profile" class="btn">
   <a href="home_page.php" class="delete-btn">Back</a>
</form>

</div>



	</tr>
</table>
</body>	
</html>