<?php include "includes/admin_header.php" ?>
<div id="wrapper">
<?php if(!$connectionToDB) echo "<h1>Connection to DB failed</h1>"; ?>
<?php include "includes/admin_navigation.php" ?>     
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to admin
                    <small>Author</small>
                </h1>
              <?php //include "includes/breadcrumbs.php" ?>  
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>