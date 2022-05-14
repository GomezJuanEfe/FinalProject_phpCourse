<h2>Locations</h2>
<h3>Feature # 1: list all the locations</h3>
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
                    "."<td>".$Loc['address']."</td>".$Loc['manager_id']."</td></tr>";
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
<!-- TABLE -->
<?php
$dbcon = new mysqli($DBserver, $username, $password, $dbName);
if ($dbcon->connect_error) {
    die("DB error");
} else {
    $selectQuery = "SELECT `location_id`,`name`,`address`,`first_name`,`last_name` FROM locations_tb INNER JOIN users_tb on users_tb.user_id=locations_tb.manager_id";
    $LocationsList = $dbcon->query($selectQuery);
    if ($LocationsList->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Name</th><th>Address</th><th>Manager</th></tr>";
        while ($Loc = $LocationsList->fetch_assoc()) {
            echo "<tr><td>" . $Loc['location_id'] . "</td><td>" . $Loc['name'] . "</td>
                    <td>" . $Loc['address'] . "</td><td>" . $Loc['first_name'] . " " . $Loc['last_name'] . "</td>" . "</td><td><a href='index.php?LE=" . $Loc['location_id'] . "'>Edit</a></td><td><a href='index.php?DLL=" . $Loc['location_id'] . "'>Delete</a></tr>";
        }
        echo "</table>";
        $dbcon->close();
    } else {
        echo "no locations founded";
    }
}
?>

<h2><a class="button" href="index.php?SA=6">New Location</a></h2>