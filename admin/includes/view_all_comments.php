
   <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>In Response To</th>
            <th>Date</th>
            <th>Status</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Edit</th>
            <th>Delete</th>           
        </tr>
    </thead>
    <tbody>
       
       <?php
        
        if (isset($_GET['delete'])) {
            $postID = $_GET['delete'];
            $query = "DELETE FROM comments WHERE comment_id = {$commentId} ";
            $deleteCommentQuery = mysqli_query($connectionToDB, $query);
            confirmQUery($deleteCommentQuery);
        }
        
        ?>
       
        <?php // rendering the table with comments

        $query = "SELECT * FROM comments";
        $selectAllPosts = mysqli_query($connectionToDB, $query);

        while($row = mysqli_fetch_assoc($selectAllPosts)){
            $commentId = $row['comment_id'];
            $commentPostID = $row['comment_post_id'];
            $commentAuthor = $row['comment_author'];
            $commentEmail = $row['comment_email'];
            $commentContent = $row['comment_content'];
            $commentStatus = $row['comment_status'];
            $commentDate = $row['comment_date'];  
                     
            echo "<tr>";
                echo "<td>{$commentId}</td>";
                echo "<td>{$commentAuthor}</td>";
                echo "<td>{$commentContent}</td>";
                echo "<td>{$commentEmail}</td>";

                
                $query = "SELECT * FROM posts WHERE post_id = $commentPostID ";
                $selectPostsID = mysqli_query($connectionToDB, $query);

                while($row = mysqli_fetch_assoc($selectPostsID)){
                    $postId = $row['post_id'];
                    $postTitle = $row['post_title']; 
                }
            
            echo "<td>{$postTitle}</td>";
            echo "<td>{$commentDate}</td>";
            echo "<td>{$commentStatus}</td>";
            echo "<td><a href='comments.php?approve={$commentId}'>Approve</td>"; 
            echo "<td><a href='comments.php?unapprove={$commentId}'>Unapprove</td>"; 
            echo "<td><a href='comments.php?edit={$commentId}'>Edit</td>"; 
            echo "<td><a href='comments.php?delete={$commentId}'>Delete</td>"; 
        echo "</tr>";
        }


        ?>
        

    </tbody>
</table>