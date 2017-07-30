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

                <?php //search engine

                if (isset($_POST['search'])) {
                    $searchRequest = ($_POST['search']);
                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$searchRequest%' ";
                    $searchInDB = queryToDB($query);
                    $searchResultsCount = mysqli_num_rows($searchInDB);
                    echo $searchResultsCount . " results found";

                    while ($row = mysqli_fetch_assoc($searchInDB)) {
                        $postId = $row['post_id'];
                        $postTitle = $row['post_title'];
                        $postAuthor = $row['post_author'];
                        $postDate = $row['post_date'];
                        $postImage = $row['post_image'];
                        $postContent = $row['post_content'];

                ?>

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
                <p>
                    <?php
                        $truncationValue = 202;
                        $truncatedPost = substr($postContent, 0, $truncationValue);
                        echo nl2br($truncatedPost);

                    if (strlen($postContent) > strlen($truncatedPost)) {
                        echo "...";
                    }
                    ?>

                </p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $postId ?>">
                    Read More
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>

                <hr>

                <?php
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
