
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
                    <input type="submit" value="SAVE THIS BOOK" name = "submit" class = "add">
                </nav>
            </div>
        </div>
    
    <hr>
    
    <div class="initialize">
        <!---------------------------------for uploading cover image (image and upload button)----------------------------------------->
           <div class="image">
               <!-----------------------------cover image of book----------------------------------->
            <?php 
                $imgUrl = "C:\xampp\htdocs\elibrary\uploads\blank.jpg"; 
                ?> 
                <img src="<?= $imgUrl; ?>" id="Image1"  alt = "Add cover image" height="350px"  /> 

            <!---------------------------------upload button---------------------------------------->
            <button onclick="document.getElementById('upload').click(); return false;" class="add" id = "upbtn">UPLOAD NEW IMAGE</button>
            <!---------------------------------hiding the regular choose file button---------------->
            <input type="file" name = "imagefile" class = "add" id="upload" accept="image/*" onchange = "readURL(this);" style="visibility: hidden"></input><br/>
                <strong>Chosen file: </strong>
                 <span id = "file-name">None</span>
            <script>
                let inputFile = document.getElementById('upload');
                let fileNameField = document.getElementById('file-name');
                inputFile.addEventListener('change', function(event){
                    let uploadedFileName = event.target.files[0].name;
                    fileNameField.textContent = uploadedFileName;
                })
            </script>
           </div>
        <!---------------------------------for uploading pdf--------------------------------------------------------------
        <div class="pdf">
            <input type="file" id="Image1" src = "/image/blank.jpg" height="350px"  ><br/><br/>
            <button onclick="document.getElementById('upload').click(); return false;" class="add" id = "upbtn">UPLOAD NEW IMAGE</button>
            <input type="file" class = "add" id="upload" accept="image/*" onchange = "readURL(this);" style="visibility: hidden"></input>
                <strong>Chosen file: </strong>
                <span id = "file-name">None</span>
            </span>
            <script>
                let inputFile = document.getElementById('upload');
                let fileNameField = document.getElementById('file-name');
                inputFile.addEventListener('change', function(event){
                    let uploadedFileName = event.target.files[0].name;
                    fileNameField.textContent = uploadedFileName;
                })
            </script>
        </div>----->
           
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


    if(isset($_POST['submit'])){

        //echo "submit button is pressed";

        $bookname = $_POST['bookname'];
        $authorname = $_POST['authorname'];
        $bookpdf = $_POST['bookpdf'];
        $image = $_FILES['imagefile'];
        $bookdesc = $_POST['bookdesc'];

        print_r($image);
        echo "<br/>";

        /*print_r($bookname);
        echo "<br/>";
        print_r($authorname);*/

        $imagename = $image['name'];
        $imagetmp = $image['tmp_name'];

        /*print_r($imagename);
        echo "<br/>";
        print_r($imagetmp);
        echo "<br/>";*/

        $destinationfile = 'uploads/' .$imagename;
        move_uploaded_file($imagetmp, $destinationfile);

        $query = "INSERT INTO books (name, author, cover, description, content) 
        VALUES ('$bookname','$authorname','$imagename','$bookdesc','$bookpdf')";

    if(mysqli_query($con, $query)){

        echo "Records added successfully.";
   
    } else{
     
        echo "ERROR: Could not able to execute $query. " . mysqli_error($con);
    
    }
        
        mysqli_close($con);
    }

    ?>
</body>
</html>