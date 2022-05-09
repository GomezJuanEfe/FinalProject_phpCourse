<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
            $hostname="localhost";
            $database="user_tbl";
            $user="root";
            $password="";
            $mysqli = new mysqli($hostname,$user,$password,$database);
            if($mysqli->connect_errno){
                echo "not coneccted: (" .$mysqli->connect_errno .")" .$mysqli->connect_error;
            }
            else{
                echo "connected!";
            }
    ?>
</body>
</html>