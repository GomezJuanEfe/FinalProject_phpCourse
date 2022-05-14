<h2>Locations</h2>
<h3>Feature # 1: list all the locations</h3>

    <!-- TABLE -->
    <?php
        $dbcon = new mysqli($DBserver,$username,$password,$dbName);
        if($dbcon->connect_error){
            die("DB error");
        }else{
            $selectQuery = "SELECT `location_id`,`name`,`address`,`first_name`,`last_name` FROM locations_tb INNER JOIN users_tb on users_tb.user_id=locations_tb.manager_id";
             $LocationsList = $dbcon->query($selectQuery);
            if($LocationsList->num_rows>0){
                echo "<table><tr><th>ID</th><th>Name</th><th>Address</th><th>Manager</th></tr>";
                while($Loc = $LocationsList->fetch_assoc()){
                    echo "<tr><td>".$Loc['location_id']."</td><td>".$Loc['name']."</td>
                    <td>".$Loc['address']. "</td><td>" . $Loc['first_name']. " ".$Loc['last_name'] . "</td>" . "</td><td><a href='index.php?LE=" . $Loc['location_id'] . "'>Edit</a></td><td><a href='index.php?DLL=" . $Loc['location_id'] . "'>Delete</a></tr>";
                }
                echo "</table>";
                $dbcon->close();
            }else{
                echo "no locations founded";
            }
        }
    ?>
<h3>Feature # 2: Edit the locations, change manager, delete spaces</h3>

<h3>Feature # 3: Add new locations</h3>
<form method="POST">
    <input type="text" name="company_name" placeholder="Location Name: ">
    <br>
    <input type="text" name="company_address" placeholder="Location Address: " required>
    <br>
    <h3>Choose the responsible manager for this location</h3>
    <select name="select_manager" required>
    <?php
             $dbcon = new mysqli($DBserver,$username,$password,$dbName);
             if($dbcon->connect_error){
                 die("DB error");
             }else{
                 $selectQuery = "SELECT * FROM users_tb WHERE user_roll='manager'";
                 $ManagerList = $dbcon->query($selectQuery);
                 if($ManagerList->num_rows>0){
                    while($manager = $ManagerList->fetch_assoc()){
                        echo "<option value='". $manager['user_id']. "'>" ."  ".$manager['first_name']."  ".$manager['last_name']." ID: ".$manager['user_id']."</option>";
                    }
                     $dbcon->close();
                 }else{
                     echo "No managers founded";
                 }
             }
         ?>
    </select>
    <br>
    <button type="submit">Register Location</button>
</form>
<?php
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dbcon = new mysqli($DBserver, $username, $password, $dbName);
        if ($dbcon->connect_error) {
          die("Connection error: " . $dbcon->connect_error);
        }
        $name=$_POST['company_name'];
        $address=$_POST['company_address'];
        $managerId=$_POST['select_manager'];
        $insertQuery="INSERT INTO locations_tb(name,address,manager_id) VALUES('$name','$address','$managerId')";
         if($dbcon->query($insertQuery)===true){
            echo "Location was registered";
        }
        else{
            echo "Not submitted";
        }
        $dbcon->close();
     }
?>