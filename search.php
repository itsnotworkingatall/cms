<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>   

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php //search engine  

    if(isset($_POST['search'])){
        $searchRequest = ($_POST['search']);
        $searchQuery = "SELECT * FROM posts WHERE post_tags LIKE '%$searchRequest%' ";
        $searchInDB = mysqli_query($connectionToDB, $searchQuery);
        
        if(!$searchInDB) {
            die('Query Failed ' . mysqli_error($connectionToDB));
        } else {
            $searchResultsCount = mysqli_num_rows($searchInDB);
            echo $searchResultsCount . " results found";
            
//            $query = "SELECT * FROM posts";
//                    $select_all_posts_query = mysqli_query($connectionToDB, $query);
                    
                    while($row = mysqli_fetch_assoc($searchInDB)){
                        $postTitle = $row['post_title'];
                        $postAuthor = $row['post_author'];
                        $postDate = $row['post_date'];
                        $postImage = $row['post_image'];
                        $postContent = $row['post_content'];
                        
                        //echo "<li><a href='#'>{$postTitle}</a></li>";
                        ?>
                
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $postTitle ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $postAuthor ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $postImage ?>" alt="">
                <hr>
                <p><?php echo nl2br($postContent) ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                    
                    
                <?php    }
               
                
            
        }       
    }   

   ?>             
                    

            </div>
                    

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?> 

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php" ?>       