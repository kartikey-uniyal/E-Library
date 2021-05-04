<?php

    include 'connection.php';

    $numberOfSearches = 0;

    if(isset($_POST['search'])){

        $str = mysqli_real_escape_string($con, $_POST['str']);
      

        if(empty($str)){
            //echo "nothing to show here";
        }
        else{

            $searchQuery = mysqli_query($con, "SELECT * FROM books WHERE name LIKE '%$str%' OR author LIKE '%$str%' ORDER BY id DESC LIMIT ". $thisPageFirstResult. ','. $resultsPerPage );

            if(mysqli_num_rows($searchQuery) > 0){
                $numberOfSearches = mysqli_num_rows($searchQuery);
            }
        }
    }
    

?>