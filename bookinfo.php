<?php
    require 'connection.php';
    include 'scripts.php';

    //check GET request id parameter
    if(isset($_GET['id'])){

        $id = mysqli_real_escape_string($con, $_GET['id']);

        $sql = "SELECT * FROM books WHERE id = $id";

        $result = mysqli_query($con, $sql);

        $row = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
       
    }
    if(isset($_REQUEST['delete-btn'])){
        
        $deleteQuery = mysqli_query($con, "DELETE FROM books WHERE id = $id");

    }
?>

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

    <!------------------------------page content starts here----------------------------------------------->
    <div class="createbook">
        <div class="header">
            <div class = "navbar">
                <a href = "index.php">
                    <div class = "logo">
                        E-Library
                    </div>
                </a>    
                <nav>
                <a href = "bookedit.php?edit=<?php echo $row['id'] ?>">
                    <button type="button" value="EDIT" name = "edit" class = "add">EDIT</button>
                </a>
                    <a href = "index.php?delete=<?php echo $row['id'] ?>" onclick = "return checkDelete(); window['index.php'].reload()">
                        <button type="submit" name = "delete-btn" class = "add" id = "delete-btn">DELETE</button>
                    </a>
                </nav>
            </div>
        </div>
    
    <hr>
    
    <div class="initialize">

    <?php if($row): ?>
        
           <div class="image">
               <!-----------------------------cover image of book----------------------------------->
               <?php
                if(empty($row['cover'])){
                    ?>
                        <img src = "uploads/blank.jpg" alt = "Image not available" class = "Image1">
                    <?php 
                }
                else{
                    ?>
                         <img src = "uploads/<?php echo $row['cover']; ?>" alt = "image not available" class = "Image1">
                    <?php 
                }
                ?>

                <a href = "read.php?read=<?php echo $row['id'] ?>">
                    <button class="add" name = "read" id = "readbtn">READ THIS BOOK</button>
                </a>
           </div>
           
          <div class="formm">
              <!--------------------------------------book details--------------------------------------------------------------------->
            <h2 id = "bookname" name = "bookname" style = "border:none;"><?php echo htmlspecialchars($row['name']); ?></h2><br/>
            <i><h4 id = "authorname" name = "authorname" style = "border:none;"><?php echo htmlspecialchars($row['author']); ?></h4></i><br/>
            <span>Description: </span><br/><br/>
            <textarea rows="5" cols="60" form = "initialize" id = "bookdesc" name = "bookdesc" style = "text-align:left;font-weight:450;" readonly>
                <?php echo htmlspecialchars($row['description']); ?>
            </textarea>
          </div>
          <?php else: ?>

                <h5>No such book exist</h5>

          <?php endif; ?>
    </div>
    </div>

</body>
</html>