<?php

    $con = mysqli_connect("localhost:3306", "root", "");
    $database = mysqli_select_db($con,"comunidade_anima");

    $con->set_charset("utf8mb4");
    
    if (!$con || !$database) echo mysqli_error($con);
        

?>
