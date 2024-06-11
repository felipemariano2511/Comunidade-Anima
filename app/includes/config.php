<?php

    $con = mysqli_connect("localhost:3500", "root", "");
    $database = mysqli_select_db($con,"comunidade_anima");

    if (!$con || !$database) echo mysqli_error($con);

?>