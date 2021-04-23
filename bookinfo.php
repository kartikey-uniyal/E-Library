
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
    <style>
        input[type=file]{
            color: transparent;
        }
        
    </style>
    <script>
        function readURL(input)
        {
            if(input.files && input.files[0])
            {
                var reader = new FileReader();
                reader.onload = function(e)
                {
                    $('#Image1')
                    .attr('src', e.target.result)
                    .width(400)
                    .height(350);
                };
            reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</head>
<body>

    <!------------------------------page content starts here----------------------------------------------->
    <div class="createbook">
        <form id = "initialize" method = "POST" enctype="multipart/form-data" runat ="server">
        <div class="header">
            <div class = "navbar">
                <div class = "logo">
                    E-Library
                </div>
                <nav>
                <button type="button" value="READ" name = "read" class = "add">READ</button>
                <button type="button" value="EDIT" name = "edit" class = "add">EDIT</button>
                <button type="button" value="DELETE" name = "delete" class = "add">DELETE</button>
                </nav>
            </div>
        </div>
    
    <hr>
    
    <div class="initialize">
        
           <div class="image">
               <!-----------------------------cover image of book----------------------------------->
            <?php 
                $imgUrl = "blank.jpg"; 
                ?> 
                <img src="<?php $imgUrl; ?>" id="Image1"  alt = "Add cover image" height="350px"  /> 

           </div>
           
          <div class="formm">
              <!--------------------------------------book form--------------------------------------------------------------------->
            <input type="text" id = "bookname" name = "bookname" placeholder="Add Book Name"><br/>
            <input type="text" id = "authorname" name = "authorname"placeholder="Add Author Name"><br/>
            <input type="url" id = "bookpdf" name = "bookpdf" placeholder="Add Book PDF URL"><br/><br/>
            <textarea rows="5" cols="60" form = "initialize" id = "bookdesc" name = "bookdesc" placeholder="Add Description"></textarea>
          </div>
    </div>
    </form>
    </div>
    <!-------------------------PHP code starts here----------------------------------------->
   <?php

    require 'connection.php';

    $query = mysqli_query($con, "SELECT * FROM books ORDER BY id DESC");


    ?>
</body>
</html>