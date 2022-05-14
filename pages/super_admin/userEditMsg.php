<?php
$dbCon = new mysqli($DBserver, $username, $password, $dbName);
if (isset($_GET['DL'])) {
  $deleteQuery = "DELETE FROM users_tb WHERE user_id=" . $_GET['DL'];
  if ($dbCon->query($deleteQuery) === true) {
    echo "<h3>The user ID " . $_GET['DL '] . " has been deleted</h3>";
  }
}
$dbCon->close();
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $dbcon = new mysqli($DBserver, $username, $password, $dbName);
  if ($dbcon->connect_error) {
    die("Connection error: " . $dbcon->connect_error);
  }
  $userId = $_POST['ID'];
  $email = $_POST['user_email'];
  $roll = $_POST['user_roll'];
  $fname = $_POST['user_firstName'];
  $lname = $_POST['user_lastName'];
  $address = $_POST['user_address'];
  $phone = $_POST['User_phone'];
  $insertQuery = "UPDATE users_tb SET user_email='$email', user_roll='$roll', first_name='$fname', last_name='$lname', user_address='$address', user_phone='$phone' WHERE user_id='$userId'";
  if ($dbcon->query($insertQuery) === true) {
    echo "<h3>User ID ".$userId." was modified</h3>";
  } else {
    echo "<h3>Error</h3>";
  }
  $dbcon->close();
}