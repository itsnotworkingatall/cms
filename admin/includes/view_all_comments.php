
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

            if (isset($_GET['approve'])) {
                $commentId = $_GET['approve'];
                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$commentId} ";
                $approveCommentQuery = mysqli_query($connectionToDB, $query);
                confirmQUery($approveCommentQuery);
                header("Location: comments.php");
            }

        ?>

        <?php

            if (isset($_GET['unapprove'])) {
                $commentId = $_GET['unapprove'];
                $query = "UPDATE comments SET comment_status = 'disabled' WHERE comment_id = {$commentId} ";
                $unapproveCommentQuery = mysqli_query($connectionToDB, $query);
                confirmQUery($unapproveCommentQuery);
                header("Location: comments.php");
            }

        ?>

        <?php

            if (isset($_GET['delete'])) {
                $commentId = $_GET['delete'];
                $query = "DELETE FROM comments WHERE comment_id = {$commentId} ";
                $deleteCommentQuery = mysqli_query($connectionToDB, $query);
                confirmQUery($deleteCommentQuery);
                header("Location: comments.php");  
            }

        ?>      
        <?php // rendering the table with comments

        $query = "SELECT * FROM comments ORDER BY comment_id DESC";
        $selectAllPosts = mysqli_query($connectionToDB, $query);

        while($row = mysqli_fetch_assoc($selectAllPosts)){
            $commentId = $row['comment_id'];
            $commentPostID = $row['comment_post_id'];
            $commentAuthor = $row['comment_author'];
            $commentEmail = $row['comment_email'];
            $commentContent = $row['comment_content'];
            $commentStatus = $row['comment_status'];
            $commentDate = $row['comment_date'];  
            
            $query = "SELECT * FROM posts WHERE post_id = $commentPostID ";
            $selectPostsID = mysqli_query($connectionToDB, $query);

            while($row = mysqli_fetch_assoc($selectPostsID)){
                $postId = $row['post_id'];
                $postTitle = $row['post_title']; 
            }
            
        ?>             
        <tr>
            <td><?php echo $commentId ?></td>
            <td><?php echo $commentAuthor ?></td>
            <td><?php echo $commentContent ?></td>
            <td><?php echo $commentEmail ?></td>
            <td><a href='../post.php?p_id=<?php echo $postId ?>'><?php echo $postTitle ?></a></td>
            <td><?php echo $commentDate ?></td>
            <td><?php echo $commentStatus ?></td>
            <td><a href='comments.php?approve=<?php echo $commentId ?>'>Approve</a></td>
            <td><a href='comments.php?unapprove=<?php echo $commentId ?>'>Unapprove</a></td>
            <td><a href='comments.php?edit=<?php echo $commentId ?>'>Edit</a></td>
            <td><a href='comments.php?delete=<?php echo $commentId ?>'>Delete</a></td>
        </tr>
        <?php
        } //end of while loop
        ?>
        

        

    </tbody>
</table>