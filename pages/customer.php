<?php
session_start();
if (!isset($_SESSION['first_name']) && !isset($_SESSION['userRoll'])) {
  session_destroy();
  header('Location: Login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer</title>
</head>

<body>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <button type="submit" name="logoutbtn" value="logout">LOGOUT</button>
  </form>
  <?php
  echo "Welcome " . $_SESSION['userName'] . "</br>";
  echo "Roll: " . $_SESSION['userRoll'] . "</br>";
  echo "ID: " . $_SESSION['userID'] . "</br>";
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['logoutbtn'] == "logout") {
      session_unset();
      session_destroy();
      header('Location: Login.php');
      exit;
    }
  }
  ?>
</body>

</html>