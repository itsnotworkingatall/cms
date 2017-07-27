<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>

        <?php 
        if(isset($_GET['edit'])){
            $updateCategoryId = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE cat_id = $updateCategoryId ";
            $selectCategoriesID = mysqli_query($connectionToDB, $query);

            while($row = mysqli_fetch_assoc($selectCategoriesID)){
                $categoryId = $row['cat_id'];
                $categoryTitle = $row['cat_title']; 
            }
        ?>
     
        <input value="<?php if(isset($categoryTitle)){echo $categoryTitle;} ?>" type="text" class="form-control" placeholder="Enter category name" name="category_title">
                                                 
        <?php } ?>
        <?php //update category query
        if(isset($_POST['update_category'])){
            $updateCategoryTitle = $_POST['category_title'];
            if($updateCategoryTitle == " " || empty($updateCategoryTitle)) {
                echo "Category name must not be empty";
            } else {
                echo $updateCategoryTitle;
                $updateCategoryQuery = "UPDATE categories SET cat_title = '{$updateCategoryTitle}' WHERE cat_id = {$updateCategoryId} ";
                $updateCategoryAction = mysqli_query($connectionToDB, $updateCategoryQuery);
                if(!$updateCategoryAction) {
                   die('Could not update the category ' . mysqli_error($connectionToDB));
                }
            header("location: categories.php");
            }
        }
        ?>        
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>
</form>