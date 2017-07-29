<?php include "includes/admin_header.php" ?>
<div id="wrapper">
<?php include "includes/admin_navigation.php" ?>     
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to admin <?php //echo $_SESSION['userrole'] ?>
                    
                    <small><?php echo $_SESSION['username'] ?></small>
                </h1>
              <?php //include "includes/breadcrumbs.php" ?>  
              <div>
                <a href="posts.php">Posts</a>
                <br>
                <a href="posts.php?source=add_post">Add new post</a>
                <br>
                <a href="categories.php">Categories</a>
                <br>
                <a href="comments.php">Comments</a>
                <br>
              </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>