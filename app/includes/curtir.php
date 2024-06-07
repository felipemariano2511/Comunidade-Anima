<?php

    $query = "SELECT curtidas FROM $table WHERE id = '$id'";
    $result = mysqli_query($con, $query);

    $row = mysqli_fetch_assoc($result);

    if($like == TRUE){
        $curtidas = $row['curtidas'] + 1;

        $query = "UPDATE $table SET curtidas = '$curtidas' WHERE id = '$id'";
        $result = mysqli_query($con, $query);

    } else{
        $curtidas = $row['curtidas'] - 1;

        $query = "UPDATE $table SET curtidas = '$curtidas' WHERE id = '$id'";
        $result = mysqli_query($con, $query);

    }
    header('Lodation: ..');
?>