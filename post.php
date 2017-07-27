<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>   

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php 
                    if (isset($_GET['p_id'])) {
                        $postId = $_GET['p_id'];
                        if (empty($postId)){
                            echo 'URL parameter "p_id" is not set - no post to display';
                        } else {
                            $query = "SELECT * FROM posts WHERE post_id = {$postId} ";
                            $select_all_posts_query = mysqli_query($connectionToDB, $query);
                        
                        while($row = mysqli_fetch_assoc($select_all_posts_query)){
                            $postTitle = $row['post_title'];
                            $postAuthor = $row['post_author'];
                            $postDate = $row['post_date'];
                            $postImage = $row['post_image'];
                            $postContent = $row['post_content'];

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
                

                <hr>
                    
                    
                <?php }}} //end of while loop ?>
                
                
<?php

if(isset($_POST['create_comment'])){
    echo $_POST['comment_author'];
    $postId = $_GET['p_id'];
    $commentAuthor = $_POST['comment_author'];
    $commentEmail = $_POST['comment_email'];
    $commentContent = $_POST['comment_content'];
    
    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)"
    $query .= "VALUES ($postId, '{$commentAuthor}', '{$commentEmail}', '{$commentContent}', 'unapproved', now())"
   
    
}

?>
                
                
<!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                           <label for="Author">Your name</label>
                            <input type="text" class="form-control" name="comment_author" placeholder = "Your name">
                        </div>
                        <div class="form-group">
                           <label for="email">Your email</label>
                            <input type="email" class="form-control" name="comment_email" placeholder = "Your email">
                        </div>
                        <div class="form-group">
                           <label for="comment">Your comment</label>
                            <textarea name="comment_content" class="form-control" rows="3" placeholder = "Your comment"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>                
                
                

            </div>
                    

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?> 

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php" ?>       