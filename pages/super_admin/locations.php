<h2>Locations</h2>
<h3>Feature # 1: list all the locations</h3>
<h3>Feature # 2: Edit the locations, change manager, delete spaces</h3>

<h3>Feature # 3: Add new locations</h3>
<form method="POST">
    <input type="text" name="company_name" placeholder="type the company name: ">
    <br>
    <input type="text" name="company_address" placeholder="type the company address: ">
    <br>
    <h3>Choose the responsible manager for this location</h3>
    <select name="select_manager">
    <?php
             $dbcon = new mysqli($DBserver,$username,$password,$dbName);
             if($dbcon->connect_error){
                 die("DB error");
             }else{
                 $selectQuery = "SELECT * FROM users_tb WHERE user_roll='manager'";
                 $ManagerList = $dbcon->query($selectQuery);
                 if($ManagerList->num_rows>0){
                    while($manager = $ManagerList->fetch_assoc()){
                        echo "<option value='". $manager['user_id']. "'>".$manager['user_roll']." "."  ".$manager['first_name']."  ".$manager['last_name']." ID: ".$manager['user_id']."</option>";
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