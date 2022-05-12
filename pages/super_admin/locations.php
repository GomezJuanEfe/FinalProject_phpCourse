<h2>Locations</h2>
<h3>Feature # 1: list all the locations</h3>

    <!-- TABLE -->
    <?php
        $dbcon = new mysqli($DBserver,$username,$password,$dbName);
        if($dbcon->connect_error){
            die("DB error");
        }else{
            $selectQuery = "SELECT * FROM locations_tb";
             $LocationsList = $dbcon->query($selectQuery);
            if($LocationsList->num_rows>0){
                echo "<table><tr><th>ID</th><th>Name</th><th>Address</th><th>ManagerID</th></tr>";
                while($Loc = $LocationsList->fetch_assoc()){
                    echo "<tr><td>".$Loc['location_id']."</td><td>".$Loc['name']."</td>
                    <td>".$Loc['manager_id']."</td></tr>";
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
                     echo "no managers founded";
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