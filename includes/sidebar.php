<div class="col-md-4">

   <?php //search engine   
    if(isset($_POST['search'])){
        $searchRequest = ($_POST['search']);
        $searchQuery = "SELECT * FROM posts WHERE post_tags LIKE '%$searchRequest%' ";
        $searchInDB = mysqli_query($connectionToDB, $searchQuery);
        
        if(!$searchInDB) {
            die('Query Failed ' . mysqli_error($connectionToDB));
        } 
        else {
            $searchResultsCount = mysqli_num_rows($searchInDB);
            echo $searchResultsCount . " results found";
        }       
    }    
?>
   
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
            <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form> 
        <!-- /.input-group -->
    </div>
    
   
    

    <!-- Blog Categories Well -->
    <div class="well">       
        
        <?php 
            $query = "SELECT * FROM categories";
            $selectAllCategories = mysqli_query($connectionToDB, $query);
        ?>
              
        <h4>Blog Categories</h4>
        <div class="row">       
            <div class="col-lg-12">
                    <ul class="list-unstyled">
                    
                    <?php
                        while($row = mysqli_fetch_assoc($selectAllCategories)){
                            $categoryId = $row['cat_id'];
                            $categoryTitle = $row['cat_title'];
                            echo "<li><a href='category.php?c_id={$categoryId}'>{$categoryTitle}</a></li>"; 
                        }
                    ?>

                    </ul>
            </div>           
            <!-- /.col-lg-6 -->
            
            
            
            
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    
<?php include "widget.php" ?>


</div>