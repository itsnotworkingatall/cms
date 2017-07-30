<?php

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
}

$query = "SELECT * FROM posts WHERE post_id={$post_id}";
$selectAllPosts = queryToDB($query);

while ($row = mysqli_fetch_assoc($selectAllPosts)) {
    $postId       = $row['post_id'];
    $postAuthor   = $row['post_author'];
    $postTitle    = $row['post_title'];
    $postCategory = $row['post_category_id'];
    $postImage    = $row['post_image'];
    $postTags     = $row['post_tags'];
    $postComments = $row['post_comment_count'];
    $postDate     = $row['post_date'];
    $postStatus   = $row['post_status'];
    $postContent  = $row['post_content'];

}

if (isset($_POST['update_post'])) {
    $postTitle     = $_POST['title'];
    $postAuthor    = $_POST['author'];
    $postStatus    = $_POST['status'];
    $postImage     = $_FILES['image']['name'];
    $postImageTemp = $_FILES['image']['tmp_name'];
    $postTags      = $_POST['tags'];
    $postContent   = $_POST['content'];
    $postCategory  = $_POST['category'];

    $postContent = mysqli_real_escape_string($connectionToDB, $postContent);

    move_uploaded_file($postImageTemp, "../images/$postImage");

    if (empty($postImage)) {
        $query = "SELECT * FROM posts WHERE post_id={$post_id} ";
        $selectImage = queryToDB($query);
        while ($row = mysqli_fetch_array($selectImage)) {
            $postImage = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title   ='{$postTitle}', ";
    $query .= "post_author  ='{$postAuthor}', ";
    $query .= "post_status  ='{$postStatus}', ";
    $query .= "post_image   ='{$postImage}', ";
    $query .= "post_tags    ='{$postTags}', ";
    $query .= "post_tags    ='{$postTags}', ";
    $query .= "post_content ='{$postContent}', ";
    $query .= "post_category_id ='{$postCategory}' ";
    $query .= "WHERE post_id = {$post_id} ";

    queryToDB($query);
    header("Location: posts.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">

   <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" value="<?php echo $postTitle ?>" class="form-control" name="title">
   </div>

   <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" value="<?php echo $postAuthor ?>" class="form-control" name="author">
   </div>

   <div class="form-group">
        <label for="status">Post Status</label>
        <select name="status">

            <option value="draft"<?php if ($postStatus == 'draft') {echo ' selected';} ?>>Draft</option>
            <option value="published"<?php if ($postStatus == 'published') {echo ' selected';} ?>>Published</option>
            <option value="disabled"<?php if ($postStatus == 'disabled') {echo ' selected';} ?>>Disabled</option>
        </select>
   </div>

   <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image">
        <br>
        <p><strong>Current image: </strong></p>

        <?php
        if (!empty($postImage)) {
            echo "<img src='../images/" . $postImage . "'" . " height='100px' >";
        } else {
            echo "Not set";
        }
        ?>

   </div>

   <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" value="<?php echo $postTags ?>" class="form-control" name="tags">
   </div>

   <div class="form-group">
        <select name="category">

            <?php

                $query = "SELECT * FROM categories";
                $selectCategories = queryToDB($query);

            while ($row = mysqli_fetch_assoc($selectCategories)) {
                $categoryId = $row['cat_id'];
                $categoryTitle = $row['cat_title'];
                if ($postCategory != $categoryId) {
                    echo "<option value='$categoryId'>$categoryTitle</option>";
                } else {
                    echo "<option value='$categoryId' selected>$categoryTitle</option>";
                }
            }
            ?>

        </select>

   </div>

   <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="content" id="" cols="30" rows="10"><?php echo $postContent ?></textarea>
   </div>

   <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Save Post">
        <input type="reset" class="btn btn-primary" name="reset" value="Undo">
   </div>

</form>
