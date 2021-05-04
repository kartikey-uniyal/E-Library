<?php
    include 'connection.php';

        $query = mysqli_query($con, "SELECT * FROM books ORDER BY id DESC");

        //calculating total pages and results per page
        $resultsPerPage = 9;
            $numberOfResults = mysqli_num_rows($query);
            $numberOfPages = ceil($numberOfResults/$resultsPerPage);
    
            if(!isset($_GET['page'])){
                $page = 1;
            }
            else{
                $page = $_GET['page'];
            }

            $thisPageFirstResult = ($page - 1) * $resultsPerPage;
            $sql = 'SELECT * FROM books ORDER BY id DESC LIMIT ' . $thisPageFirstResult . ',' .  $resultsPerPage;
            $result = mysqli_query($con, $sql);

       if (ceil($numberOfPages / $resultsPerPage) > 0): ?>
        <ul class="pagination">
            <?php if ($page > 1): ?>
            <li class="prev"><a href="index.php?page=<?php echo $page-1 ?>">&laquo;Prev&nbsp;</a></li>
            <?php endif; ?>

            <!--if user goes beyond page 3 then dots will be shown instead of links except for page 1-->
            <?php if ($page > 3): ?>
            <li class="page"><a href="index.php?page=1">1</a></li>
            <li class="dots">...</li>
            <?php endif; ?>

            <?php if ($page-2 > 0): ?><li class="page"><a href="index.php?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
            <?php if ($page-1 > 0): ?><li class="page"><a href="index.php?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php endif; ?>

            <li class="currentpage"><a href="index.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>

            <?php if ($page+1 < ceil($numberOfPages / $resultsPerPage)+1): ?><li class="page"><a href="index.php?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
            <?php if ($page+2 < ceil($numberOfPages / $resultsPerPage)+1): ?><li class="page"><a href="index.php?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php endif; ?>

            <?php if ($page < ceil($numberOfPages / $resultsPerPage)-2): ?>
            <li class="dots">...</li>
            <li class="page"><a href="index.php?page=<?php echo ceil($numberOfPages / $resultsPerPage) ?>"><?php echo ceil($numberOfPages / $resultsPerPage) ?></a></li>
            <?php endif; ?>

            <?php if ($page < $numberOfPages): ?>
            <li class="next"><a href="index.php?page=<?php echo $page+1 ?>">&nbsp;Next&raquo;</a></li>
            <?php endif; ?>
        </ul>
        <?php endif;
    ?>