<?php include('./config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
</head>

<body>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="email" name="userEmail" placeholder="Email address" /><br />
    <input type="password" name="userPassword" placeholder="Password" /><br />
    <select name="userRoll">
      <option value="super_admin">Super Admin</option>
      <option value="manager">Manager</option>
      <option value="customer">Customer</option>
    </select>
    <input type="text" name="userName" placeholder="Full name" /><br />
    <input type="text" name="userAddress" placeholder="Address" /><br />
    <input type="text" name="userPhone" placeholder="Phone number" /><br />
    <button type="submit">Register</button>
  </form>
  </form>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $dbCon = new mysqli($DBserver, $username, $password, $dbName);
    //create a connection to the DB
    if ($dbCon->connect_error) {
      die("Connection failed:" . $dbCon->connect_error);
    }
    $userEmail = $_POST['customerEmail'];
    $userPass = $_POST['customerPsw'];
    $salt = time(); //take the current time
    //$hashedPass = hash('sha512',$userPass.$salt);
    $hashedPass = password_hash($userPass . $salt, PASSWORD_DEFAULT);
    $name = $_POST['customerName'];
    $addr = $_POST['customerAddr'];
    $insertQuery = "INSERT INTO customer_tb 
            (customerName,email,password,customerAddress,salt)
            VALUES('$name','$userEmail','$hashedPass','$addr','$salt')";
    if ($dbCon->query($insertQuery) === true) {
      echo "<h2>Information registered successfully</h2>";
    } else {
      echo "Error:" . $dbCon->error;
    }
    $dbCon->close(); //close the database connection
  }
  ?>
</body>

</html>