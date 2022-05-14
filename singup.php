    <?php
                    $dbhost = "localhost";
                    $dbuser = "root";
                    $dbpass= "";
                    $db = "client";


                    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $db);

                    if($mysqli->connect_errno)
                    {
                        echo"Not Connected";
                    }
                    else
                    {
                        echo"Connected";
                    }

                    if(isset($_POST['SignUp']))
                    {
                        $result = $mysqli->query("SELECT * from user order by user_id desc");

                        if (!empty($result) && $result->num_rows > 0)
                        {
                            $row = $result->fetch_assoc();
                            $user_id = $row["user_id"] + 1;
                        }
                        else
                        {
                            $user_id = 1;
                        }

                        if(!empty($_POST['txtfirstname']))
                        {
                            $firstname = $_POST['txtfirstname'];
                        }
                        else
                        {
                            $firstname = "firstname";
                        }

                        if(!empty($_POST['txtlastname']))
                        {
                            $lastname = $_POST['txtlastname'];
                        }
                        else
                        {
                            $lastname = "lastname";
                        }

                        if(!empty($_POST['txtusername']))
                        {
                            $username = $_POST['txtusername'];
                        }
                        else
                        {
                            $username = "username";
                        }
                        if(!empty($_POST['txtpassword']))
                        {
                            $password = $_POST['txtpassword'];
                        }
                        else
                        {
                            $password = "password";
                        }

                        if(!empty($_POST['txtbirthday']))
                        {
                            $birthday = $_POST['txtbirthday'];
                        }
                        else
                        {
                            $birthday = "birthday";
                        }

                        if(!empty($_POST['txtgender']))
                        {
                            $gender = $_POST['txtgender'];
                        }
                        else
                        {
                            $gender = "gender";
                        }

                        if(!empty($_POST['txtemail']))
                        {
                            $email = $_POST['txtemail'];
                        }
                        else
                        {
                            $email = "email";

                        }

                        $mysqli->query("INSERT INTO user (user_id, firstname, lastname, username, password, birthday, gender, email) VALUES ('$user_id', '$firstname', '$lastname', '$username', '$password', '$birthday', '$gender','$email') ");
                    }
                ?>


<!DOCTYPE html>
<html>
<head>
    <title>CS Face - Signup</title>
    <link rel="stylesheet" type="text/css" href="css/Csface signup.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <scsript src= "progs/signup.js"></scsript>
    
</head>
    <body>
<form method="POST" name= "registration">
<table border="0" height="600px" width="100%">
<div>


    
    <div class="container">


        </div>
        <td align="center">

        <div id="index-style1-content">
            <form>
                 <div class="signupform">
               
                          <h1 id="index-style2-content">Sign Up</h1>
                            <large>It's quick and easy.</large>
                           <br></br>
                       </div>
                    <hr>
                    <div class="details">  
                    <br></br> 
        
                    <input id="index-style3-content" type="text" name="txtfirstname" placeholder="First name" required="">
                
             
                    <input id="index-style4-content" type="text" name="txtlastname" placeholder="Last name" required="">

                    <br><br><input id="index-style5-content" type="text" name="txtusername" placeholder="Username" required="">
                 
                    <br><br>

                    <input id="index-style6-content" type="Password" name="txtpassword" placeholder="Password" required="">
                 

                    <br><br> 
                    
                    <label>Birthday:</label>
                    
                    <input id="index-style7-content" type="text" name="txtbirthday" placeholder="mm-dd-yyyy" required="">
                    
                    <br></br>
                     <label>Gender:</label><input id="index-style8-content" type="text" name="txtgender" placeholder="Male/Female/Custom" required="">

                    <br><br>

                    <label>Email:</label><input id="index-style9-content" type="text" name="txtemail" placeholder="" required="">
                    <br><br>
                    <input id="index-style10-content" type="submit" name="SignUp" value="Sign up">


                    <a href="Csface.php"><input id="index-style11-content" type="button" value="Back"></a>
                     <br>
      </div>
      </form>
  </div>
</td>
</div>
</table>
</form>
</body>
</html>

