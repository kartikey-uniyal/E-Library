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
               
    <?php
    require 'connection.php';

    $query = mysqli_query($con, "SELECT * FROM books");

    if(mysqli_num_rows($query) > 0){

        while($row = mysqli_fetch_array($query)){    

            ?>
                <div class="book">
                <img src = "/image/blank.jpg" alt = "image not uploaded" width="400px" height="300px" class = "book__image">
                </br>
                <p><strong><?php echo $row['name']; ?></strong></p>
                <p><strong><?php echo $row['author']; ?></strong></p>
                </div>
                <?php
        }
    }
?>
    </div>
    </div>
</body>
</html>