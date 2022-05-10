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
        <input type="text" name="Address_line" placeholder="Company Address: "/><br/>
        <input type="email" name="Company_name" placeholder="Write employers email here: "/><br/>
        <input type="time" name="time_available" placeholder="availability of the company: "/><br/>
        <input type="date" name="date_Available" placeholder="availability dates:  "/><br/>
        <input type="number" name="Company_phone_number" placeholder="Company`s Phone: ">
        <input type="email" name="Company_Email" placeholder="Type company email: ">
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
            $Address_line = $_POST['Address_line'];
            $Company_name = $_POST['Company_name'];
            $time_available = $_POST['time_available'];
            $date_Available= $_POST['date_Available'];
            $Company_phone_number= $_POST['Company_phone_number'];
            $Company_Email=$_POST['Company_Email'];
            //need correct table to insert
            $insertQuery = "INSERT INTO Company_tb
            (Address_line,Company_name,time_available,date_Available,Company_phone_number,Company_Email)
            VALUES('$Address_line','$Company_name','$time_available','$date_Available','$Company_phone_number','$Company_Email')";//need correct data base
             if($mysqli->query($insertQuery)===true){
                echo "<h2>Your Company was registered</h2>";
            }else{
                echo "not submited: (" .$mysqli->connect_errno .")" .$mysqli->connect_error;
            }
            $mysqli->close();
        }
    ?>
</body>
</html>zzzzz