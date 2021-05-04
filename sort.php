<?php

    include 'connection.php';

    $sortingRequest = 0;
    if(isset($_POST['book-asc'])){

        $sortQuery = mysqli_query($con, "SELECT * FROM books ORDER BY name ASC");
        $sortingRequest = 1;

        }
        if(isset($_POST['book-desc'])){

        $sortQuery = mysqli_query($con, "SELECT * FROM books ORDER BY name DESC");
        $sortingRequest = 1;

        }
        if(isset($_POST['author-asc'])){

        $sortQuery = mysqli_query($con, "SELECT * FROM books ORDER BY author ASC");
        $sortingRequest = 1;

        }
        if(isset($_POST['author-desc'])){

        $sortQuery = mysqli_query($con, "SELECT * FROM books ORDER BY author DESC");
        $sortingRequest = 1;

    }
?>