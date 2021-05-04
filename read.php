<?php 
    include 'connection.php';

    if(isset($_GET['read'])){

        $row = $_GET['read'];
        $sql = "SELECT content FROM books WHERE id = $row";
        $result = mysqli_query($con, $sql);

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-library</title>

    <link rel = "stylesheet" type = "text/css" href = "style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>

    <div class="header">
                <div class = "navbar">
                    <div class = "logo" onmouseover = "">
                    <a href = "index.php" style="text-decoration: none; color: inherit;">
                        E-Library
                    </a>
                    </div>
                    <nav>
                        <a href = "bookinfo.php?id=<?php echo $row; ?>">
                            <button type = "button" name = "back" class = "add">BACK TO BOOK INFO</button>
                        </a>
                    </nav>
                </div>
        </div>

        <hr>
    
    <div class="iframe-container">
    
        <?php 

            while($info = mysqli_fetch_array($result)){
                ?>

                <iframe src="uploads/<?php echo $info['content']; ?>" type="application/pdf" class = "iframe-show"></iframe>  

                <?php

            }
        
        ?>
    
    </div>


</body>
</html>