<h2>Locations</h2>
<h3>Feature # 1: list all the locations</h3>
<h3>Feature # 2: Edit the locations, change manager, delete spaces</h3>

<h3>Feature # 3: Add new locations</h3>
<?php
  include ("../DBconfig.php");
?>
<form method="POST">
    <input type="text" name="company_name" placeholder="type the company name: ">
    <br>
    <input type="text" name="company_address" placeholder="type the company address: ">
    <br>
    <button type="submit">Register Location</button>
    <br>
         <?php
             $dbcon = new mysqli($DBServer,$username,$password,$dbName);
             if($dbcon->connect_error){
                 die("DB error");
             }else{
                 $selectQuery = "SELECT * FROM users_tb WHERE user_roll=manager";
                 $ManagerList = $dbcon->query($selectQuery);
                 if($ManagerList->num_rows>0){
                     echo "<table><tr><th>Roll</th><tr><th>FirstName</th><th>LastName</th></tr>";
                     while($manager = $ManagerList->fetch_assoc()){
                         echo "<tr><td>".$manager['user_roll']."</td><td>"."<tr><td>".$manager['first_name']."</td><td>".$manager['last_name']."</td>
                         <td><a href='".$_SERVER['PHP_SELF']."?id=".$manager['user_id']."'>Select</a></td></tr>";
                     }
                     echo "</table>";
                     $dbcon->close();
                 }else{
                     echo "no managers founded";
                 }
             }
         ?>
    <br>
</form>
<?php
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $dbcon = new mysqli($DBserver, $username, $password, $dbName);
        if ($dbcon->connect_error) {
          die("Connection error: " . $dbcon->connect_error);
        }
        $name=$_POST['company_name'];
        $address=$_POST['company_address'];
        $insertQuery="INSERT INTO users_tb(name,address) VALUES
         ('$name,$address)";
         if($dbcon->query($insertQuery)===true){
            echo "User was registered";
        }
        else{
            echo "Not submitted";
        }
        $dbcon->close();
     }
?>