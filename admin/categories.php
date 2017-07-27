<?php include "includes/admin_header.php" ?>
<div id="wrapper">
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
            <div class="col-xs-6">
            
            <?php createCategory(); ?>
            
            <form action="" method="post">
                <div class="form-group">
                    <label for="cat-title">Add Category</label>
                    <input type="text" class="form-control" placeholder="Enter category name" name="category_title">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                </div>
            </form>

            <?php //here we are updating selected category name
            if (isset($_GET['edit'])) {
              $updateCategoryId = $_GET['edit'];
              include "includes/admin_update_categories.php";
            }
            ?>
            
            </div>

            <div class="class col-xs-6">
                <table class="table table-bordered table-hover">
                    <thread>
                        <tr>
                            <th>Id</th>
                            <th>Category Title</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thread>
                    <tbody>

                    <?php
                        findAllCAtegories();
                    ?>

                    <?php
                        deleteCategory();
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>