
   <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
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

        while($row = mysqli_fetch_assoc($selectAllPosts)){
            $postId = $row['post_id'];
            $postAuthor = $row['post_author'];
            $postTitle = $row['post_title'];
            $postCategoryId = $row['post_category_id'];
            $postImage = $row['post_image'];
            $postTags = $row['post_tags'];
            //$postComments = $row['post_comment_count'];
            $postDate = $row['post_date'];
            $postStatus = $row['post_status'];
                     
            $fileExists = file_exists ('../images/' . $postImage);
                     
            echo "<tr>";
                echo "<td>{$postId}</td>";
                echo "<td>{$postAuthor}</td>";
                echo "<td>{$postTitle}</td>";
            
            
                $query = "SELECT * FROM categories WHERE cat_id = $postCategoryId ";
                $selectCategoriesID = queryToDB($query);

                while($row = mysqli_fetch_assoc($selectCategoriesID)){
                    $categoryId = $row['cat_id'];
                    $categoryTitle = $row['cat_title']; 
                }
            
                echo "<td>{$categoryTitle}</td>";
            
                if ($postImage == 'NULL' || $postImage == NULL) {            
                    echo "<td>No image</td>";                   
                } elseif ($fileExists != TRUE) {
                    echo "<td>Not found</td>";
                } else {
                    echo "<td><img width='100'  src='../images/{$postImage}'></td>";
                }
            
                echo "<td>{$postTags}</td>";
            
                $query = "SELECT * FROM comments WHERE comment_post_id = $postId ";
                $query .= "AND comment_status = 'approved' ";
                $getComments = queryToDB($query);
                $postComments = mysqli_num_rows($getComments);
                
                echo "<td>{$postComments}</td>";            
                echo "<td>{$postDate}</td>";
                echo "<td>{$postStatus}</td>";
                echo "<td><a href='posts.php?source=edit_post&post_id={$postId}'>Edit</td>"; 
                echo "<td><a href='posts.php?delete={$postId}'>Delete</td>"; 
            echo "</tr>";
        }


        ?>
        

    </tbody>
</table>