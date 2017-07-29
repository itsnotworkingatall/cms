<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
<?php include "admin/includes/functions.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>   

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
               <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                
                <?php 
                
                    $query = "SELECT * FROM posts WHERE post_status = 'published'";
                    $select_all_posts_query = queryToDB($query);
                    $count = "posts WHERE post_status = 'published'";
                    $counter = counter($count);
                    if ($counter == 0) {
                            echo "No posts here yet";                           
                    } else {
                    
                    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $postId = $row['post_id'];
                        $postTitle = $row['post_title'];
                        $postAuthor = $row['post_author'];
                        $postDate = $row['post_date'];
                        $postImage = $row['post_image'];
                        $postContent = $row['post_content'];
                        $postStatus = $row['post_status'];

                ?>
                
                

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $postId ?>"><?php echo $postTitle ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $postAuthor ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $postImage ?>" alt="">
                <hr>
                <p>
                <?php 
                    $truncationValue = 202;
                    $truncatedPost = substr($postContent,0,$truncationValue);
                    echo nl2br($truncatedPost);
                    
                    if (strlen($postContent) > strlen($truncatedPost)) {
                        echo "...";
                    }
                ?>
                </p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $postId ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span>
                </a>

                <hr>
                    
                    
                <?php }} //end of while loop ?>

            </div>
                    

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?> 

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php" ?>       