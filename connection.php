<?php
    $con = mysqli_connect('localhost:3307', 'root', 'root');
    mysqli_select_db($con, 'elibrary');

    if(!$con){
        die("Database connection failed: ". mysqli_connect_error());
    }
?>