<?php include "includes/admin_header.php" ?>
<div id="wrapper">
<?php include "includes/admin_navigation.php" ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to admin, <?php echo $_SESSION['username'] ?>!

                    <small><?php //echo $_SESSION['userrole'] ?></small>
                </h1>
                <?php //include "includes/breadcrumbs.php" ?>

        </div>

        <!-- /.row -->

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'>
                                <?php
                                    $count = 'posts WHERE post_status = "published"';
                                    $postsQty = counter($count);
                                    echo $postsQty;
                                ?>
                                </div>
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="posts.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'>
                                <?php
                                    $count = 'comments WHERE comment_status = "approved"';
                                    $commentsQty = counter($count);
                                    echo $commentsQty;
                                ?>
                                </div>
                              <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="comments.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'>
                                <?php
                                    $count = 'users WHERE user_role = "1"';
                                    $usersQty = counter($count);
                                    echo $usersQty;
                                ?>
                                </div>
                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="users.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'>
                                <?php
                                    $count = 'categories WHERE cat_status = "Enabled"';
                                    $categoriesQty = counter($count);
                                    echo $categoriesQty;
                                ?>
                                </div>
                                <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="categories.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- /.row -->

        <?php

            $count = 'posts WHERE post_status = "draft"';
            $draftPostsQty = counter($count);

            $count = 'comments WHERE comment_status = "disabled"';
            $disabledCommentsQty = counter($count);

            $count = 'users WHERE user_role = "2"';
            $writersQty = counter($count);

            $count = 'categories WHERE cat_status = "Disabled"';
            $disabledCategoriesQty = counter($count);

        ?>

        <div class="row">

            <script type="text/javascript">
              google.charts.load('current', {'packages':['bar']});
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['', 'Published or enabled', 'Draft or disabled'],

                <?php

                $elementText = ['Posts', 'Comments', 'Users', 'Categories'];
                $elementCountOpen = [$postsQty, $commentsQty, $usersQty, $categoriesQty];
                $elementCountClosed = [$draftPostsQty, $disabledCommentsQty, $writersQty, $disabledCategoriesQty];

                for ($i = 0; $i < 4; $i++) {
                ?>
                    ['<?php echo $elementText[$i] ?>', <?php echo $elementCountOpen[$i] ?>, <?php echo $elementCountClosed[$i] ?>],
                <?php
                }
                ?>

                ]);

                var options = {
                  chart: {
                    title: 'Performance',
                    subtitle: 'Posts',
                  }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
              }
            </script>

        </div>
        <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
    </div>
    <!-- /.container-fluid -->
</div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>
