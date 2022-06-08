<?php
    include('../DBconfig.php');
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $dbcon = new mysqli($DBserver, $username, $password, $dbName);
        if ($dbcon->connect_error) {
            die("Connection error: " . $dbcon->connect_error);
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
            echo "<p>User was registered</p>";
        }
        else{
            echo "<p>Not submitted</p>";
        }
        $dbcon->close();
    }
      ?>