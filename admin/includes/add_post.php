<?php

if (isset($_POST['create_post'])) {

    $postTitle = $_POST['title'];
    $postAuthor = $_POST['author'];
    $postDate = date('d-m-y');

    $postImage = $_FILES['image']['name'];
    $postImageTemp = $_FILES['image']['tmp_name'];

    $postContent = $_POST['content'];
    $postContent = mysqli_real_escape_string($connectionToDB, $postContent);
    $postCategory = $_POST['category'];
    $postTags = $_POST['tags'];
    $postStatus = $_POST['status'];

    move_uploaded_file($postImageTemp, "../images/$postImage");

    $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES ({$postCategory}, '{$postTitle}', '{$postAuthor}', now(), '{$postImage}', '{$postContent}', '{$postTags}', '{$postStatus}') ";

    queryToDB($query);
    header("Location: posts.php");
}

?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <select name="status">
            <option value="draft">Disabled</option>
            <option value="published">Enabled</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <select name="category">

        <?php

            $query = "SELECT * FROM categories";
            $selectCategories = queryToDB($query);

        while ($row = mysqli_fetch_assoc($selectCategories)) {
            $categoryId = $row['cat_id'];
            $categoryTitle = $row['cat_title'];
            echo "<option value='$categoryId'>$categoryTitle</option>";
        }

        ?>

        </select>

    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags">
    </div>

    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Save Post">
    </div>

</form>
