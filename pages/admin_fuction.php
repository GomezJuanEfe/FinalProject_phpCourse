<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
      
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="employer_name" placeholder="employer full Name: "/><br/>
        <input type="email" name="employer_email" placeholder="Write employers email here: "/><br/>
        <input type="number" name="salary" placeholder="type the employer salary: "/><br/>
        <input type="text" name="work_position" placeholder="What is the employer position: "/><br/>
        <input type="text" name="employer_phone_number" placeholder="Employer`s Phone: ">
        <input type="text" name="employer_address" placeholder="employer`s Address: ">
        <button type="submit">Register Employer</button>
    </form>
    </form>
    <?php
        //first admin function register employer
        //need conection with data base
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $mysqli = new mysqli($hostname,$user,$password,$database);
            if($mysqli->connect_errno){
                echo "not coneccted: (" .$mysqli->connect_errno .")" .$mysqli->connect_error;
            }
            $employer_name = $_POST['employer_name'];
            $emp_email = $_POST['employer_email'];
            $salary = $_POST['salary'];
            $work_position= $_POST['work_position'];
            $employer_phone_number= $_POST['employer_phone_number'];
            $employer_address=$_POST['employer_address'];
            //need correct table to insert
            $insertQuery = "INSERT INTO employers_tb
            (employer_name,emp_email,salary,work_position,employer_phone_number,empoyer_address)
            VALUES('$employer_name','$emp_email','$salary','$work_position','$employer_phone_number','$employer_address')";//need correct data base
             if($mysqli->query($insertQuery)===true){
                echo "<h2>Your Employer was registered</h2>";
            }else{
                echo "not submited: (" .$mysqli->connect_errno .")" .$mysqli->connect_error;
            }
            $mysqli->close();
        }
    ?>
</body>
</html>