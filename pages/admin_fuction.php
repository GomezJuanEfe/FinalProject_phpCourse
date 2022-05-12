<?php
    include("./DBconfig.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
      <form  method="POST">
          <input type="email" name="user_email" placeholder="Type the user email: " require>
          <br>
          <input type="password" name="user_password" placeholder="Password" required>
          <br>
          <input type="text" name="user_roll" placeholder="Type user roll: " required>
          <br>
          <input type="text" name="user_firstName" placeholder="Type user first name: " required>
          <br>
          <input type="text" name="user_lastName" placeholder="Type user last name: " required>
          <br>
          <input type="text" name="user_address" placeholder="Type user address: ">
          <br>
          <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="User_phone" placeholder="Type user phone number: ">
          <br>
          <button type="submit"> Register User</button>
      </form>
      <?php
            
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $dbcon = new mysqli($DBserver, $username, $password, $dbName);
                if ($dbcon->connect_error) {
                  die("Connection Error: " . $dbcon->connect_error);
                }
                $email=$_POST['user_email'];
                $userPass = $_POST['user_password'];
                $salt = time();
                $hashedPass = password_hash($userPass.$salt,PASSWORD_DEFAULT);
                $roll=$_POST['user_roll'];
                $fname=$_POST['user_firstName'];
                $lname=$_POST['user_lastName'];
                $address=$_POST['user_address'];
                $phone=$_POST['User_phone'];
                $insertQuery="INSERT INTO users_tb(user_email,user_password,user_roll,first_name,last_name,salt,user_address,user_phone) VALUES
                ('$email','$hashedPass','$roll','$fname','$lname','$salt','$address','$phone')";
                if($dbcon->query($insertQuery)===true){
                    echo "User was registered";
                }
                else{
                    echo "Not submitted";
                }
                $dbcon->close();
            }
      ?>
</body>
</html>