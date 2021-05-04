<?php
    require 'connection.php';
    include 'scripts.php';

    if(isset($_GET['edit'])){

        $row = $_GET['edit'];

        $existingRow = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM books WHERE id = $row"));

        if(isset($_POST['submit'])){

            $bookName = $_POST['bookName'];
            $authorName = $_POST['authorName'];
            $bookPdf = $_FILES['bookPdf'];
            $image = $_FILES['imagefile'];
            $bookDesc = $_POST['bookDesc'];

            /*-----------getting details of image and pdf---------------- */

            $imageName = $image['name'];
            $imageTmp = $image['tmp_name'];
            $imageType = $image['type'];
        
            $pdfName = $bookPdf['name'];
            $pdfTmp = $bookPdf['tmp_name'];
            $pdfType = $bookPdf['type'];

            /*------------------validating book details--------------------------- */

            $bookNameCheck = "SELECT * FROM books WHERE name = '$bookName'";
            $bookNameCount = mysqli_num_rows(mysqli_query($con, $bookNameCheck));
        
            if(empty($_POST['bookName'])){
        
                $bookNameError['bookName'] = "Please enter the book name";
        
            }
        
            if($bookNameCount > 1){
        
                $bookNameError['bookName'] = "Book already exist";
        
            }
        
            if(empty($_POST['authorName'])){
        
                $authorNameError['authorName'] = "Please enter the author(s) name ";
        
            }
             
            /*print_r($image);
            echo "<br/>";*/
        
            /*print_r($bookName);
            echo "<br/>";
            print_r($authorName);*/
        
            //print_r($bookPdf);
        
            /*print_r($imageType);
            print_r($pdfType);*/

            if(!is_uploaded_file($imageTmp)){

                $imageName = $existingRow['cover'];

            }
        
           if(is_uploaded_file($imageTmp) && (!$imageType == 'image/jpeg' || !$imageType == 'image/jpg' || !$imageType == 'image/png')){

                $imageUploadError['imagefile'] = "Please upload image of .jpeg, .jpg or .png extensions only";
               
            }

           if(!is_uploaded_file($pdfTmp)){

                $pdfName = $existingRow['content'];

           }
            
           if(is_uploaded_file($pdfTmp) && !$pdfType == 'application/pdf'){
        
                $pdfUploadError['bookPdf'] = "Please upload a valid PDF file";   
        
            }
        
            if(!empty($_POST['bookName']) && !empty($_POST['authorName']) && ($bookNameCount == 0 || $bookNameCount == 1)){
        
                //edit query
                $editQuery = "UPDATE books SET name = '$bookName', author = '$authorName', cover = '$imageName', description = '$bookDesc', content = '$pdfName' WHERE id = '$row'";
                
                $res = mysqli_query($con,$editQuery);
    
                if($res){
    
                    $destinationFile = 'uploads/' .$imageName;
                    move_uploaded_file($imageTmp, $destinationFile);
    
                    $destinationFile = 'uploads/' .$pdfName;
                    move_uploaded_file($pdfTmp, $destinationFile);
    
                    header("Location: index.php?edited=10");
                    exit;
                }
            }
        
        }

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
        <form id = "initialize" method = "POST" enctype="multipart/form-data" runat ="server">
        <div class="header">
            <div class = "navbar">
                <a href = "index.php">
                    <div class = "logo">
                        E-Library
                    </div>
                </a>    
                <nav>
                <button type = "submit" name = "submit" class = "add" style="box-shadow:0 0 10px;">SAVE</button>
                <a href = "bookinfo.php?id=<?php echo $row;?>" onClick="javascript:document.location.reload(true)">
                    <button type = "button" name = "cancel" class = "add" style="box-shadow: 0 0 10px;">CANCEL</button>
                </a>
                </nav>
            </div>
        </div>
    
    <hr>
    
    <div class="initialize">

           <div class="image">
               <!-----------------------------cover image of book----------------------------------->

                <img src="uploads/<?php echo $existingRow['cover']; ?>" class="Image1"  alt = "Add cover image"  /> 
            <div class = "upload-area">

             <!---------changing the regular choose file button to custom button and adding image name beside it--------------->

            <input type = "file" name = "imagefile" id = "real-image-file" hidden = "hidden" accept = "image/*"/>
            <button type = "button" id = "custom-img-button" class = "add">UPLOAD NEW IMAGE</button>&nbsp;&nbsp;
            <strong>Chosen file: </strong>
            <span id = "custom-img-text"><?php echo $existingRow['cover']. " "; ?></span>

            <script>
                imgUploadButton();
            </script>
            <br/>
            <span><?php if(isset($imageUploadError['imagefile'])) echo "<div class = 'error'>". $imageUploadError['imagefile']. "</div>" ?></span>

             <!---------changing the regular choose file button to custom button and adding image name beside it--------------->


            <input type = "file" name = "bookPdf" id = "real-pdf-file" hidden = "hidden" accept="application/pdf"/>
            <button type = "button" id = "custom-pdf-button" class = "add">UPLOAD BOOK PDF</button>&nbsp;&nbsp;
            <strong>Chosen file: </strong>
            <span id = "custom-pdf-text"><?php echo $existingRow['content']. " "; ?></span>

            <script>
                pdfUploadButton();
            </script>
            <br/>
            <span><?php if(isset($pdfUploadError['bookPdf'])) echo "<div class = 'error'>". $pdfUploadError['bookPdf']. "</div>" ?></span>

            </div>
          
           </div>
        
           
          <div class="formm">
              <!--------------------------------------book form--------------------------------------------------------------------->

            <h2 style="color: #171717;">&nbsp;Edit Details: </h2><br/><br/>
            <input type="text" id = "bookName" name = "bookName" placeholder="Edit Book Name" value = "<?php 
                echo htmlspecialchars($existingRow['name']);
            ?>"><br/>
            <span><?php if(isset($bookNameError['bookName'])) echo "<div class = 'error'>". $bookNameError['bookName']. "</div>"; ?></span>

            <input type="text" id = "authorName" name = "authorName"placeholder="Edit Author Name" value = "<?php
                echo htmlspecialchars($existingRow['author']);
            ?>"><br/>
            <span><?php if(isset($authorNameError['authorName'])) echo "<div class = 'error'>". $authorNameError['authorName']. "</div>" ?></span><br/>

            <textarea rows="5" cols="60" form = "initialize" id = "bookDesc" name = "bookDesc" placeholder="Edit Description">
            <?php  echo htmlspecialchars($existingRow['description']); ?></textarea>
          </div>
    </div>
    </form>
    </div>
    
</body>
</html> 