<?php 
    include 'connection.php';
    include 'scripts.php';
    include 'pagination.php';
    include 'sort.php';
    include 'search.php';
 
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

</head>
<body>
    <div class="header">
            <div class = "navbar">
                <div class = "logo" onclick = "window.location.reload();" onmouseover = "">
                    E-Library
                </div>
                <nav>
                <div class = "dropdown">
                    <button type = "button" class = "add">SORT&#x25BC;</button>
                    <form method = "POST">
                        <div class = "dropdown-content">
                            <button type = "submit" id = "sort-select-1" name = "book-asc">Book A-Z</button>
                            <button type = "submit" id = "sort-select-2" name = "book-desc">Book Z-A</button>
                            <button type = "submit" id = "sort-select-3" name = "author-asc">Author A-Z</button>
                            <button type = "submit" id = "sort-select-4" name = "author-desc">Author Z-A</button>
                        </div>
                    </form>
                </div>
                    <a href="addbook.php">
                        <button type="submit" class = "add">ADD NEW BOOK</button>
                    </a>
                    <div class = "searchbox">
                        <form method = "POST">
                            <input type = "search" name = "str" placeholder = "Search" class = "searchbar"value = "<?php if(isset($_POST['search']))
                            {
                                echo $_POST['str'];
                            } ?>">
                            <button type = "submit" name = "search" class = "search-btn"><i class = "fa fa-search"></i></button>
                        </form>
                    </div>
                </nav>
            </div>
    </div>

    <hr>

    <!---------------------list-------------------------------->

    <div class="list">
               
        <?php
            /*sorted list */
            if($sortingRequest == 1){
                ?>
                <?php

                while($sortRow = mysqli_fetch_array($sortQuery)){
                    ?>
                            <div class="book">
                                <a href = "bookinfo.php?id=<?php echo $sortRow['id']?>">
                                <?php if($sortRow['cover'] == null):  ?>
                                    <img src = "uploads/blank.jpg" alt = "image not uploaded" class = "book__image">
                                <?php else:
                                    ?><img src = "uploads/<?php echo $sortRow['cover']; ?>" alt = "image not available" class = "book__image">     
                                <?php 
                                ?>
                                <?php endif; ?>
                                </a>
                       
                            </br><br/>
                                <p><strong>&nbsp;&nbsp;<?php echo $sortRow['name']; ?></strong></p>
                                <p><i><strong>&nbsp;&nbsp;<?php echo $sortRow['author']; ?></strong></i></p>
                            </div>
                            <?php
    
                }

            }
            /*list after searching */
            if($numberOfSearches > 0){

                while($searchRow = mysqli_fetch_array($searchQuery)){
                    ?>
                            <div class="book">
                                <a href = "bookinfo.php?id=<?php echo $searchRow['id']?>">
                                <?php if($searchRow['cover'] == null):  ?>
                                    <img src = "uploads/blank.jpg" alt = "image not uploaded" class = "book__image">
                                <?php else:
                                    ?><img src = "uploads/<?php echo $searchRow['cover']; ?>" alt = "image not available" class = "book__image">     
                                <?php 
                                ?>
                                <?php endif; ?>
                                </a>
                       
                            </br><br/>
                                <p><strong>&nbsp;&nbsp;<?php echo $searchRow['name']; ?></strong></p>
                                <p><i><strong>&nbsp;&nbsp;<?php echo $searchRow['author']; ?></strong></i></p>
                            </div>
                            <?php
    
                }

            }

            else{
                /*list without search and sort query */
                if($numberOfResults > 0 && $sortingRequest == 0){ 

                    while($row = mysqli_fetch_array($result)){
            
                        ?>
                        <div class="book">
                            <a href = "bookinfo.php?id=<?php echo $row['id']?>">
                            <?php if($row['cover'] == null):  ?>
                                <img src = "uploads/blank.jpg" alt = "image not uploaded" class = "book__image">
                            <?php else:
                                ?><img src = "uploads/<?php echo $row['cover']; ?>" alt = "image not available" class = "book__image">     
                            <?php 
                            ?>
                            <?php endif; ?>
                            </a>
                   
                        </br><br/>
                            <p><strong><?php echo $row['name']; ?></strong></p>
                            <p><i><strong><?php echo $row['author']; ?></strong></i></p>
                        </div>
                        <?php
                }

            }
        }
        if(isset($_GET['delete'])){

            $row = $_GET['delete'];
            $sql = "DELETE FROM books WHERE id = $row";
            $result = mysqli_query($con, $sql);  
    
            //book deleted popup
            
            ?>
            <div class="alert hide">
                <span class="fas fa-exclamation-circle"></span>
                <span class="msg">Book successfully deleted</span>
                <div class="close-btn">
                    <span class="fas fa-times"></span>
                </div>
            </div>
            <script>
                showAlert();
            </script>
            <?php 
    
            if(!$result){
                echo "Record not deleted";
            }
        //}
    }
    if(isset($_GET['added'])){
            
        if($_GET['added'] == 10){

        //book added popup
            
            ?>
            <div class="alert hide">
                <span class="fas fa-exclamation-circle"></span>
                <span class="msg">Book successfully added</span>
                <div class="close-btn">
                    <span class="fas fa-times"></span>
                </div>
            </div>
            <script>
                showAlert();
            </script>
            <?php 

            if(!$result){
                echo "Record not added";
            }
        //}

        }

    }
    if(isset($_GET['edited'])){

        if($_GET['edited'] == 10){

             //book edited popup
            
            ?>
            <div class="alert hide">
                <span class="fas fa-exclamation-circle"></span>
                <span class="msg">Book successfully edited</span>
                <div class="close-btn">
                    <span class="fas fa-times"></span>
                </div>
            </div>
            <script>
                showAlert();
            </script>
            <?php 
            if(!$result){
                echo "Record not edited";
            }
        }

        
        }

    
        ?>
    </div>
   
</body>
</html>