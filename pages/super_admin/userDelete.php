<h2>User deleted</h2>
<?php
  $dbCon = new mysqli($DBserver, $username, $password, $dbName);
  if (isset($_GET['DL'])) {
    $deleteQuery = "DELETE FROM users_tb WHERE user_id=" . $_GET['DL'];
    if ($dbCon->query($deleteQuery) === true) {
      echo "<h3>The user ID ". $_GET['DL']. " has been deleted</h3>";
    } else {
      echo "<h3>Recor has not been deleted due to: " . $dbCon->error . "</h3>";
    }
  }
?>