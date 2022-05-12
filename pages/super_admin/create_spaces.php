<h2>Create spaces</h2>
<h3>Featrue # 1: Create spaces</h3>
<form method="POST">
    <input type="text" name="name_space" placeholder="type the space name: ">
    <br>
    <select name="spaces_types" required>
        <option value="desk">Desk</option>
        <option value="office">Office</option>
        <option value="meeting_room">Meeting Room</option>
    </select>
    <h3>Select the location: </h3>
    <select name="Select_location" required>
     <?php
         $dbcon = new mysqli($DBserver,$username,$password,$dbName);
         if($dbcon->connect_error){
             die("DB error");
         }else{
             $selectQuery = "SELECT * FROM locations_tb";
             $LocationsList = $dbcon->query($selectQuery);
             if($LocationsList->num_rows>0){
                 while($Loc = $LocationsList->fetch_assoc()){
                    echo "<option value='". $Loc['location_id']. "'>".$Loc['name']." ".$Loc['address']." ".$Loc['location_id']."</option>";
                 }
                 $dbcon->close();
             }else{
                 echo "no Locations founded";
             }
         }
     ?>
    </select>
    <br>
    <button type="submit">Register Space</button>
</form>
 <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $dbcon = new mysqli($DBserver, $username, $password, $dbName);
            if ($dbcon->connect_error) {
              die("Connection error: " . $dbcon->connect_error);
            }
            $name_space=$_POST['name_space'];
            $spaces_types=$_POST['spaces_types'];
            $select_location=$_POST['Select_location'];
            $insertQuery="INSERT INTO spaces_tb(name,type,location_id) VALUES('$name_space','$spaces_types','$select_location')";
            if($dbcon->query($insertQuery)===true){
                echo "Space was registered";
            }
            else{
                echo "Not submitted";
            }
            $dbcon->close();
        }
 ?>