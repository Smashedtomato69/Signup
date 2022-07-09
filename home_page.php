<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

?>


<!DOCTYPE html>
<html>
<head>
<meta charset= "UTF-8">
	<meta name= "viewport" content= "width-device-width, initial-scale-1.0">
	<title>Homepage</title>
	<link rel= "stylesheet" href="style1.css">
	<link rel= "stylesheet" href="css/style.css">
	<script src= "code.js"></script>
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

		<div class="container">

<div class="profile">
   <?php
	  $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
	  if(mysqli_num_rows($select) > 0){
		 $fetch = mysqli_fetch_assoc($select);
	  }
	  if($fetch['image'] == ''){
		 echo '<img src="images/default-avatar.png">';
	  }else{
		 echo '<img src="uploaded_img/'.$fetch['image'].'">';
	  }
   ?>
   <h3><?php echo $fetch['firstname']; ?> <?php echo $fetch['lastname']; ?></h3>
   <a href="updateprofile.php" class="btn">update profile</a>
   <a href="login.php?logout=<?php echo $user_id; ?>" class="delete-btn">logout</a>
   <p>new <a href="login.php">login</a> or <a href="Signup.php">register</a></p>
</div>

</div>







		</td>
		<td width="60%" valign="top" style="padding-top: 10px; padding-left: 20px; padding-right: 20px;">
			<input type="text" name="txtpost" placeholder="What's on your mind?" size="70" style="border:1px solid; border-radius: 20px; font-size: 20px; outline: none; padding: 10px; vertical-align: middle;">
		</td>
		<td width="20%" valign="top" style="border-left:solid 0px; padding-top: 10px; padding-left: 20px; text-align: center;">
			<font style="font-family: Tahoma;">LINKS</font>
			<br><br><br>
			<img src="image/facebook.png" style="height: 100px; width: 100px;">
			<br><br>
			<img src="image/youtube.png" style="height: 100px; width: 100px;"> 
			<br><br>
			<img src="image/gmail.jpg" style="height: 100px; width: 100px;">
		</td>
	</tr>
</table>
</body>
</html>