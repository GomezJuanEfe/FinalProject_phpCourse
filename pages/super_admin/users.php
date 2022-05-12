<h2>Users</h2>
<h3>Feature # 1: List all de users in a table with edit and delete buttons</h3>

<div class="usersList">
    <?php
        $dbCon = new mysqli($DBserver, $username, $password, $dbName);
      
        if ($dbCon->connect_error) {
            die("DB error: " . $dbCon->connect_error);
        } else {
            /* 
                // Message after the editing
                if (isset($_POST['productName']) && isset($_POST['productPrice'])) {
                    $newProctName = $_POST['productName'];
                    $newProductPrice = $_POST['productPrice'];
                    $productID = $_POST['productID'];
                    $updateQuery = "UPDATE product_tb SET productName='$newProctName', productPrice='$newProductPrice' WHERE productID=$productID";
                    if ($dbCon->query($updateQuery) === true) {
                        echo "<h2>Record updated</h2>";
                    } else {
                        echo "<h2>Record not updated" . $dbCon->error . "</h2>";
                    }
                }
                // After user deletion
                
            */
            $selectQuery = "SELECT * FROM users_tb";
            // If you want to order the output in decending use DESC keyword at the end.
            $users_list = $dbCon->query($selectQuery);
            if ($users_list->num_rows > 0) {
                echo "<table><tr><th>ID</th><th>First name</th><th>Last name</th><th>Roll</th><th>Email</th><th>Edit</th><th>Delete</th>";
                while ($user = $users_list->fetch_assoc()) {
                    echo "<tr><td>" . $user['user_id'] . "</td><td>" . $user['first_name'] . "</td><td>" . $user['last_name'] . "</td><td>" . $user['user_roll'] . "</td><td>" . $user['user_email'] . "</td><td><a href='index.php?UE=" . $user['user_id'] . "'>Edit</a></td><td><a href='index.php?DL=" . $user['user_id'] . "'>Delete</a></td></tr>";
                }
                echo "</table>";
            }
            $dbCon->close();
        }
    ?>
</div>


<div class=newUsersForm>
    <h3>New user (different page)</h3>
    <form method="POST">
        <input type="email" name="user_email" placeholder="Type the user email: " require>
        <br>
        <input type="password" name="user_password" placeholder="Password" required>
        <br>
        <select name="user_roll">
            <option value="manager">Manager</option>
            <option value="customer">Client</option>
            <option value="super_admin">Admin</option>
        </select>
        <br>
        <input type="text" name="user_firstName" placeholder="Type user first name: " required>
        <br>
        <input type="text" name="user_lastName" placeholder="Type user last name: " required>
        <br>
        <input type="text" name="user_address" placeholder="Type user address: ">
        <br>
        <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="User_phone" placeholder="Type user phone number: ">
        <br>
        <button type="submit"> Register User</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $dbcon = new mysqli($DBserver, $username, $password, $dbName);
        if ($dbcon->connect_error) {
            die("Connection error: " . $dbcon->connect_error);
        }
        $email = $_POST['user_email'];
        $userPass = $_POST['user_password'];
        $salt = time();
        $hashedPass = password_hash($userPass . $salt, PASSWORD_DEFAULT);
        $roll = $_POST['user_roll'];
        $fname = $_POST['user_firstName'];
        $lname = $_POST['user_lastName'];
        $address = $_POST['user_address'];
        $phone = $_POST['User_phone'];
        $insertQuery = "INSERT INTO users_tb(user_email,user_password,user_roll,first_name,last_name,salt,user_address,user_phone) VALUES
            ('$email','$hashedPass','$roll','$fname','$lname','$salt','$address','$phone')";
        if ($dbcon->query($insertQuery) === true) {
            echo "User was registered";
        } else {
            echo "Not submitted";
        }
        $dbcon->close();
    }
    ?>
</div>