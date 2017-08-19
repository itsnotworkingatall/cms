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
                if (isset($_GET['c_id'])) {
                    $postCategoryId = $_GET['c_id'];
                } else {
                    $postCategoryId = null;
                }
                if (empty($postCategoryId)) {
                    $query = "SELECT * FROM posts WHERE post_status = 'published' ";
                    $count = "posts WHERE post_status = 'published' ";
                } else {
                    $query = "SELECT * FROM posts WHERE post_category_id = {$postCategoryId} AND post_status = 'published' ";
                    $count = "posts WHERE post_category_id = {$postCategoryId} AND post_status = 'published' ";
                }
                    $select_all_posts_query = queryToDB($query);
                    $counter = counter($count);
                if ($counter == 0) {
                        echo "No posts here yet";
                } else {

                    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $postId = $row['post_id'];
                        $postTitle = $row['post_title'];
                        $postDate = $row['post_date'];
                        $postImage = $row['post_image'];
                        $postContent = $row['post_content'];
                        $postAuthorId = $row['post_author_id'];
                        $postAuthor = getUserNameById($postAuthorId);

                ?>



                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $postId ?>"><?php echo $postTitle ?></a>
                </h2>
                <p class="lead">
                    by <a href="author.php?a_id=<?php echo $postAuthorId ?>"><?php echo $postAuthor ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $postId ?>">
                <img class="img-responsive" src="images/<?php echo $postImage ?>" alt="">
                </a>
                <hr>
                <p>
                    <?php
                        $postContent = htmlspecialchars_decode($postContent);
                        $truncationValue = 202;
                        $truncatedPost = substr($postContent, 0, $truncationValue);
                        echo nl2br(htmlspecialchars_decode($truncatedPost));

                    if (strlen($postContent) > strlen($truncatedPost)) {
                        echo "...";
                    }
                    ?>

                </p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $postId ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>

                <?php
                    }
                } //end of while loop
                ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php" ?>
