<?php

if (isset($_POST['checkBoxArray'])) {

    foreach ($_POST['checkBoxArray'] as $checkBoxValue) {

        $bulk_options = $_POST['bulk_options'];

        if ($bulk_options == "delete") {

            $query = "DELETE FROM posts WHERE post_id = {$checkBoxValue} ";

        } elseif ($bulk_options == "") {

            $query = null;

        } else {

            $query = "UPDATE users SET user_status = '{$bulk_options}' WHERE user_id = {$checkBoxValue} ";

        }

        if ($query != null) {

            queryToDB($query);

        }

    }

}

?>

<form action="" method="post">
    <table class="table table-bordered table-hover">
       <div class="row">
           <div class="col-xs-4 form-group" id="bulkOptionsContainer">
               <select class="form-control" name="bulk_options" id="">
                   <option value="">Select Options</option>
                   <option value="published">Publish</option>
                   <option value="draft">Draft</option>
                   <option value="delete">Delete</option>
               </select>
            </div>

           <div class="col-xs-4 form-group">
               <input type="submit" name="submit" class="btn btn-success" value="Apply">
               <a href="posts.php?source=add_post" class="btn btn-primary">Add new post</a>
           </div>
       </div>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>ID</th>
                <th>Ava</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

        <?php

        if (isset($_GET['delete'])) {
            $postID = $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id = {$postID} ";
            queryToDB($query);
            header("Location: posts.php");
        }

        ?>

        <?php // rendering the table with posts

        $query = "SELECT * FROM posts";
        $selectAllPosts = queryToDB($query);

        while ($row = mysqli_fetch_assoc($selectAllPosts)) {
            $postId         = $row['post_id'];
            $postAuthorId   = $row['post_author_id'];
            $postTitle      = $row['post_title'];
            $postCategoryId = $row['post_category_id'];
            $postImage      = $row['post_image'];
            $postTags       = $row['post_tags'];
            $postDate       = $row['post_date'];
            $postStatus     = $row['post_status'];
            $postAuthor     = getUserNameById($postAuthorId);

            $fileExists = file_exists('../images/' . $postImage);

            if ($postAuthorId == 0) {

                $userImage = "placeholderImg.jpg";

            } else {

                $query = "SELECT * FROM users WHERE user_id = {$postAuthorId} ";
                $getUserImage = queryToDB($query);

                while ($row = mysqli_fetch_assoc($getUserImage)) {
                    $userImage = $row['user_image'];
                }
            }


        ?>
            <tr>
                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value="<?php echo $postId ?>"></td>
                <td><?php echo $postId ?></td>
                <td>
                    <div class="thumbnail">
                        <img src='../images/<?php echo $userImage?>'>
                    </div>
                </td>
                <td><?php echo $postAuthor ?></td>
                <td><?php echo $postTitle ?></td>
            <?php
                $query = "SELECT * FROM categories WHERE cat_id = $postCategoryId ";
                $selectCategoriesID = queryToDB($query);

            while ($row = mysqli_fetch_assoc($selectCategoriesID)) {
                $categoryId = $row['cat_id'];
                $categoryTitle = $row['cat_title'];
            }
            ?>
                <td><?php echo $categoryTitle ?></td>
                <td><div class="thumbnail">
                    <?php
                        if ($postImage == 'NULL' || $postImage == null) {
                            echo "No image";
                        } elseif ($fileExists != true) {
                            echo "Not found";
                        } else {
                            echo "<img src='../images/{$postImage}'>";
                        }
                    ?></div>
                </td>

                <td><?php echo $postTags ?></td>
            <?php
                $query = "SELECT * FROM comments WHERE comment_post_id = $postId ";
                $query .= "AND comment_status = 'approved' ";
                $getComments = queryToDB($query);
                $postComments = mysqli_num_rows($getComments);
            ?>
                <td><?php echo $postComments ?></td>
                <td><?php echo $postDate ?></td>
                <td><?php echo $postStatus ?></td>
                <td><a href='posts.php?source=edit_post&post_id=<?php echo $postId ?>'>Edit</a></td>
                <td><a href='posts.php?delete=<?php echo $postId ?>'>Delete</a></td>
            </tr>
    <?php
        }
    ?>


        </tbody>
    </table>
</form>
