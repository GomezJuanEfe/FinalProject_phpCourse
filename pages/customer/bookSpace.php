<h2>Book a space - customer</h2>
<h3>Featurea # 1: Book a Space</h3>

<?php
  
?>

<form method="POST">
  <label for="from">Client:</label>
  <br>
  <input type="text" name="userName" value="<?php echo $_SESSION['userName'] ?>" readonly>
  <br>
  <label for="location">Select a location:</label>
  <br>
  <select name="location">
    <?php
    $dbcon = new mysqli($DBserver, $username, $password, $dbName);
    if ($dbcon->connect_error) {
      die("DB error");
    } else {
      $selectQuery = "SELECT * FROM locations_tb";
      $LocationsList = $dbcon->query($selectQuery);
      if ($LocationsList->num_rows > 0) {
        while ($location = $LocationsList->fetch_assoc()) {
          echo "<option value='" . $location['location_id'] . "'>" . $location['name'] . " / " . $location['address'] . "</option>";
        }
        $dbcon->close();
      } else {
        echo "The space is not available at this time, try another one or a different space.";
      }
    }
    ?>
  </select>
  <br>
  <label for="spaceType">Select a space type:</label>
  <br>
  <select name="spaceType">
    <option value="desk">Desk</option>
    <option value="office">Office</option>
    <option value="meeting_room">Meeting Room</option>
  </select>
  <br>
  <label for="from">Select the day:</label>
  <br>
  <input type="date" name="day" placeholder="type the day: ">
  <br>
  <label for="from">Select the time:</label>
  <br>
  <select name="from" id="from">
    <option value="7">7:00</option>
    <option value="8">8:00</option>
    <option value="9">9:00</option>
    <option value="10">10:00</option>
    <option value="11">11:00</option>
    <option value="12">12:00</option>
    <option value="13">13:00</option>
    <option value="14">14:00</option>
    <option value="15">15:00</option>
    <option value="16">16:00</option>
    <option value="17">17:00</option>
    <option value="18">18:00</option>
    <option value="19">19:00</option>
    <option value="20">20:00</option>
    <option value="21">21:00</option>
    <option value="22">22:00</option>
  </select>
  <br>
  <button type="submit">Book Space</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $dbcon = new mysqli($DBserver, $username, $password, $dbName);
  if ($dbcon->connect_error) {
    die("Connection error: " . $dbcon->connect_error);
  }
  $name = $_POST['company_name'];
  $address = $_POST['company_address'];
  $managerId = $_POST['select_manager'];
  $insertQuery = "INSERT INTO locations_tb(name,address,manager_id) VALUES('$name','$address','$managerId')";
  if ($dbcon->query($insertQuery) === true) {
    echo "Location was registered";
  } else {
    echo "Not submitted";
  }
  $dbcon->close();
}
?>