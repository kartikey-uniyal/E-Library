<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
            <div class = "navbar">
                <div class = "logo">
                    E-Library
                </div>
                <nav>
                    <a href ="addbook.php" class = "add">ADD NEW BOOK</a>
                </nav>
            </div>
    </div>

    <hr>

    <!---------------------list-------------------------------->
    <div class="list">
        <div class="book">
            <img src = "/image/blank.jpg" width="400px" height="300px" class = "book__image">
            </br><p>Bookname</p>
            <p>Authorname</p>
        </div>
        <div class="book">
            <img src = "/image/blank.jpg" width="400px" height="300px" class = "book__image">
            </br><p>Bookname</p>
            <p>Authorname</p>
        </div>
    
    </div>
    <?php

       $con = mysqli_connect('localhost', 'root', 'root');
        mysqli_select_db($con, 'elibrary');

        if(!$con){
            die("Database connection failed: ". mysqli_connect_error());
        }
        else{
            echo "connection is set i guess";
        }

        if(isset($_POST['submit'])){

            echo "submit button is pressed i guess";

            $bookname = $_POST['bookname'];
            $authorname = $_POST['authorname'];
            $bookpdf = $_POST['bookpdf'];
            $image = $_FILES['image'];
            $bookdesc = $_POST['bookdesc'];

            print_r($bookname);
            echo "<br/>";
            print_r($authorname);

            $imagename = $files['name'];
            $imagetmp = $files['tmp_name'];

            $destinationfile = 'uploads/' .$imagename;
            move_uploaded_file($imagetmp, $destinationfile);

            $q = "INSERT INTO `elibrary`.`books`(`name`, `author`, `cover`, `description`, `content`) 
            VALUES ('$bookname','$authorname','$imagename','$bookdesc','$bookpdf')";

            $q = mysqli_query($con, $q);
        }

    ?>
</body>
</html>