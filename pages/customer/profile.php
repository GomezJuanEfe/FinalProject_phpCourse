<h2>Profile - customer</h2>
<h3>Featurea # 1: Profile</h3>
<form  method="POST">
          <input type="email" name="user_email" placeholder="Type the user email: ">
          <?php
           if(isset($_GET['id'])){
            $dbcon = new mysqli($DBserver,$username,$password,$dbName);
            if($dbcon->connect_error){
                echo "DB ERROR";
            }else{
                $id = $_GET['id'];
                $email=$_POST['user_email'];
              $updateQuery="UPDATE users_tb SET user_email='$email' where user__id='$id'";
                $result = $dbcon->query($updateQuery);
                if($result->num_rows>0){
                    echo "update made with sucess";
                }
                $dbcon->close();
            }
          }
          ?>
          <br>
          <input type="password" name="user_password" placeholder="Password">
          <?php
                if(isset($_GET['id'])){
                    $dbcon = new mysqli($DBserver,$username,$password,$dbName);
                    if($dbcon->connect_error){
                        echo "DB ERROR";
                    }else{
                        $id = $_GET['id'];
                        $userPass = $_POST['user_password'];
                        $hashedPass = password_hash($userPass.$salt,PASSWORD_DEFAULT);
                        $updateQuery="UPDATE users_tb SET user_password='$hashedPass' where user__id='$id'";
                        $result = $dbcon->query($updateQuery);
                        if($result->num_rows>0){
                            echo "update made with sucess";
                        }
                        $dbcon->close();
                    }
                  }
          ?>
          <br>
          <select name="user_roll">
              <option value="costumer">Client</option>
          </select>
          <?php
             if(isset($_GET['id'])){
                $dbcon = new mysqli($DBserver,$username,$password,$dbName);
                if($dbcon->connect_error){
                    echo "DB ERROR";
                }else{
                    $id = $_GET['id'];
                    $roll=$_POST['user_roll'];
                    $updateQuery="UPDATE users_tb SET user_roll='$roll' where user__id='$id'";
                    $result = $dbcon->query($updateQuery);
                    if($result->num_rows>0){
                        echo "update made with sucess";
                    }
                    $dbcon->close();
                }
              }
          ?>
          <br>
          <input type="text" name="user_firstName" placeholder="Type user first name: ">
          <br>
          <?php
             if(isset($_GET['id'])){
                $dbcon = new mysqli($DBserver,$username,$password,$dbName);
                if($dbcon->connect_error){
                    echo "DB ERROR";
                }else{
                    $id = $_GET['id'];
                    $fname=$_POST['user_firstName'];
                    $updateQuery="UPDATE users_tb SET first_name='$fname' where user__id='$id'";
                    $result = $dbcon->query($updateQuery);
                    if($result->num_rows>0){
                        echo "update made with sucess";
                    }
                    $dbcon->close();
                }
              }
          ?>
          <input type="text" name="user_lastName" placeholder="Type user last name: ">
          <?php
                 if(isset($_GET['id'])){
                    $dbcon = new mysqli($DBserver,$username,$password,$dbName);
                    if($dbcon->connect_error){
                        echo "DB ERROR";
                    }else{
                        $id = $_GET['id'];
                        $lname=$_POST['user_lastName'];
                        $updateQuery="UPDATE users_tb SET last_name='$lname' where user__id='$id'";
                        $result = $dbcon->query($updateQuery);
                        if($result->num_rows>0){
                            echo "update made with sucess";
                        }
                        $dbcon->close();
                    }
                  }
          ?>
          <br>
          <input type="text" name="user_address" placeholder="Type user address: ">
          <?php
            if(isset($_GET['id'])){
                $dbcon = new mysqli($DBserver,$username,$password,$dbName);
                if($dbcon->connect_error){
                    echo "DB ERROR";
                }else{
                    $id = $_GET['id'];
                    $address=$_POST['user_address'];
                    $updateQuery="UPDATE users_tb SET user_Address='$address' where user__id='$id'";
                    $result = $dbcon->query($updateQuery);
                    if($result->num_rows>0){
                        echo "update made with sucess";
                    }
                    $dbcon->close();
                }
              }
          ?>
          <br>
          <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="User_phone" placeholder="Type user phone number: ">
          <?php
            if(isset($_GET['id'])){
                $dbcon = new mysqli($DBserver,$username,$password,$dbName);
                if($dbcon->connect_error){
                    echo "DB ERROR";
                }else{
                    $id = $_GET['id'];
                    $phone=$_POST['User_phone'];
                    $updateQuery="UPDATE users_tb SET user_phone='$phone' where user__id='$id'";
                    $result = $dbcon->query($updateQuery);
                    if($result->num_rows>0){
                        echo "update made with sucess";
                    }
                    $dbcon->close();
                }
              }
          ?>
          <br>
          <button type="submit"> Edit User</button>
      </form>