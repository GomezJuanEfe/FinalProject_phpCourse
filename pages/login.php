<?php
  include("./DBconfig.php");
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sing in</title>
</head>

<body>
  <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
    <input type="email" name="userEmail" placeholder="Your email address"></br>
    <input type="password" name="userPassword" placeholder="Your password"></br>
    <input type="checkbox" name="rem_user">Remember me</br>
    <button type="submit">Login</button>
  </form>
  <?php
// FUNCTIONS
// Input Check
    function Input_check($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
// 

// Conection to the data base and _SESSION variables
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $dbcon = new mysqli($DBserver, $username, $password, $dbName);
      if ($dbcon->connect_error) {
        die("Connection error: " . $dbcon->connect_error);
      }
      $email = Input_check($_POST['userEmail']);
      $selectQuery = "SELECT * FROM users_tb WHERE user_email='$email'";
      $result = $dbcon->query($selectQuery);
      
      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Checking the salting
        $pass = Input_check($_POST['userPassword']);
        $salt = $row['salt'];
        $hashedPass = $row['user_password'];
        if (password_verify($pass.$salt, $hashedPass)) {
          $_SESSION['userName'] = $row['first_name'];
          $_SESSION['userRoll'] = $row['user_roll'];
          $_SESSION['userID'] = $row['user_id'];
          switch ($row['user_roll']) {
            case 'super_admin':
              header('Location: super_admin.php');
              exit;
              break;
            case 'manager':
              header('Location: manager.php');
              exit;
              break;
            case 'customer':
              header('Location: customer.php');
              exit;
              break;
          }
        } else {
          echo "Wrong username/password salt";
        }
      } else {
        echo "Wrong username/password";
      }
      $dbcon->close();
    }
  ?>
</body>

</html>