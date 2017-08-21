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

            <?php
            if (isset($_GET['p_id'])) {
                $postId = $_GET['p_id'];
                if (empty($postId)) {
                    echo 'URL parameter "p_id" is not set - no post to display';
                } else {
                    $query = "SELECT * FROM posts WHERE post_id = {$postId} ";
                    $select_all_posts_query = queryToDB($query);

                    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $postTitle = $row['post_title'];

                        $postAuthorId = $row['post_author_id'];
                        $postDate = $row['post_date'];
                        $postImage = $row['post_image'];
                        $postContent = $row['post_content'];

                        $postAuthor = getUserNameById($postAuthorId)
//                        $getAuthor = "SELECT * FROM users WHERE user_id = {$postAuthorId} ";
//                        $getPostAuthor = queryToDB($getAuthor);
//
//                        while ($row = mysqli_fetch_assoc($getPostAuthor)) {
//                            $authorFName = $row['user_first_name'];
//                            $authorLName = $row['user_last_name'];
//                        }
//
//                        $postAuthor = $authorFName . " " . $authorLName;

            ?>

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <h2><?php echo $postTitle ?></h2>
            <p class="lead">
                by <a href="author.php?a_id=<?php echo $postAuthorId ?>"><?php echo $postAuthor ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $postImage ?>" alt="">
            <hr>
            <p><?php echo nl2br(htmlspecialchars_decode($postContent)) ?></p>

            <hr>


            <?php
                    }
                }
            } //end of while loop
            ?>
<!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group.required">
                       <label for="Author">Your name</label>
                        <input type="text" class="form-control" name="comment_author" placeholder = "Your name" required>
                    </div>
                    <div class="form-group.required">
                       <label for="email">Your email</label>
                        <input type="email" class="form-control" name="comment_email" placeholder = "Your email" required>
                    </div>
                    <div class="form-group.required">
                       <label for="comment">Your comment</label>
                        <textarea name="comment_content" class="form-control" rows="3" placeholder = "Your comment" required></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <?php

            if (isset($_POST['create_comment'])) {
                //echo $_POST['comment_author'];
                $postId = $_GET['p_id'];
                if (empty($postId)) {
                    echo 'URL parameter "p_id" is not set - nothing to display';
                } else {

                    $commentAuthor = $_POST['comment_author'];
                    $commentEmail = $_POST['comment_email'];
                    $commentContent = $_POST['comment_content'];

                    if (!empty($commentAuthor) && !empty($commentEmail) && !empty($commentContent)) {

                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                        $query .= "VALUES ($postId, '{$commentAuthor}', '{$commentEmail}', '{$commentContent}', 'unapproved', now())";

                        $addComment = queryToDB($query);

                    } else {
                        ?>
                        <script>alert('fields can not be empty')</script>
                        <?php
                    }

                }

                $postId = $_GET['p_id']; //showing already posted comments

                $query = "SELECT * FROM comments WHERE comment_post_id = {$postId} ";
                $query .= "AND comment_status = 'approved' ";
                $query .= "ORDER BY comment_id DESC ";

                $getComments = queryToDB($query);

                $commentsQty = mysqli_num_rows($getComments);

                if ($commentsQty == 0) {
                    echo "No comments here yet";
                } else {

                    $commentAuthor = null;

                    while ($row = mysqli_fetch_assoc($getComments)) {
                        $commentAuthor = $row['comment_author'];
                        $commentEmail = $row['comment_email'];
                        $commentContent = $row['comment_content'];
                        $commentDate = $row['comment_date'];

                        ?>
                        <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $commentAuthor; ?>
                                    <small><?php echo $commentDate; ?></small>
                                </h4>
                                <?php echo nl2br($commentContent); ?>
                            </div>
                        </div>

                <?php
                    }   // end of 'while' cycle
                }       // end of 'else' - rendering the comments
            }
            ?>


        </div>


        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include "includes/footer.php" ?>
