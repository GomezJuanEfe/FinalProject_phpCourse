<h2>Create spaces</h2>
<h3>Featrue # 1: Create spaces</h3>
<form method="POST">
    <input type="text" name="name_space" placeholder="type the space name: ">
    <br>
    <select name="spaces_types">
        <option value="type">Meeting Room</option>
        <option value="type">Reunion Room</option>
        <option value="type">Office Room</option>
        <option value="type">Workshop Room</option>
    </select>
    <h3>Select the location: </h3>
    <select name="Select_location">
     <?php
         $dbcon = new mysqli($DBserver,$username,$password,$dbName);
         if($dbcon->connect_error){
             die("DB error");
         }else{
             $selectQuery = "SELECT * FROM locations_tb";
             $LocationsList = $dbcon->query($selectQuery);
             if($LocationsList->num_rows>0){
                 while($Loc = $LocationsList->fetch_assoc()){
                     echo "<option>"."ID: ".$Loc['location_id']."  "."Name: ".$Loc['name']." Addrees: ".$Loc['address']." ManagerID: "
                     .$Loc['manager_id']."</option>";
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
            $insertQuery="INSERT INTO spaces_tb(name,type) VALUES($name_space,$spaces_types)";
            if($dbcon->query($insertQuery)===true){
                echo "Space was registered";
            }
            else{
                echo "Not submitted";
            }
            $dbcon->close();
        }
 ?>