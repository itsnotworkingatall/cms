<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
<?php include "admin/includes/functions.php" ?>
<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<?php
if (isset($_GET['a_id'])) {
    $authorId = $_GET['a_id'];



    if (empty($authorId) || $authorId == null) {
        echo 'URL parameter "a_id" is not set - no author to display';
    } else {
        $query = "SELECT * FROM users WHERE user_id = {$authorId} ";
        $authorData = queryToDB($query);

        while ($row = mysqli_fetch_assoc($authorData)) {
            $authorFName = $row['user_first_name'];
            $authorLName = $row['user_last_name'];
            $authorImage = $row['user_image'];
            $authorEmail = $row['user_email'];
            $authorSince = $row['user_created_at'];
            $authorBio   = $row['user_info'];
        }

        $query = "SELECT * FROM posts WHERE post_author_id = {$authorId} ORDER BY post_date DESC";
        $authorPosts = queryToDB($query);

    }
?>

<!-- Page Content -->
<div class="container">

  <div class="row">

    <div class="col-md-8">

      <h1 class="page-header">Meet the author</h1>
        <!-- First Blog Post -->
      <div class="col-md-6">

        <h2>
          <a href=""><?php echo $authorFName . ' ' . $authorLName ?></a>
        </h2>
        <p class="lead">
          joined: <?php echo $authorSince ?>
        </p>
        <p><?php echo $authorBio ?></p>
        <hr>
      </div>
      <div class="col-md-4">
        <img src="images/<?php echo $authorImage ?>" width=320px alt="">
      </div>

      <div class="col-md-8">
        <table class="table table-hover">
        <thead>
          <tr>
            <th><strong>Date</strong></th>
            <th><strong>Image</strong></th>
            <th><strong>Title</strong></th>
          </tr>
        </thead>
          <tbody>
          <?php // rendering the list of blog posts
          while ($row = mysqli_fetch_assoc($authorPosts)) {
              $postId = $row['post_id'];
              $postDate = $row['post_date'];
              $postImage = $row['post_image'];
              $postTitle = $row['post_title'];
          ?>
            <tr>
              <td><?php echo $postDate ?></td>
              <td><div class="thumbnail"><img src="images/<?php echo $postImage ?>" alt="<?php echo $authorFName . ' ' . $authorLName ?>"></div></td>
              <td><a href="post.php?p_id=<?php echo $postId ?>"><?php echo $postTitle ?></a></td>
            </tr>
          <?php
          }
          ?>
          </tbody>
        </table>

      </div>
    </div>

<?php
} else {

?>
      <div class="col-md-8">
            <div class="alert alert-danger">
                  <strong>URL parameter "a_id" is not set - no author to display</strong>
            </div>
      </div>

<?php

}

?>

      <!-- Blog Sidebar Widgets Column -->
      <?php include "includes/sidebar.php" ?>
  </div>
    <!-- /.row -->
    <hr>
<?php include "includes/footer.php" ?>
