
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>User Image</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Edit</th>
            <th>Delete</th>           
        </tr>
    </thead>
    <tbody>
 
    <?php
        if (isset($_GET['approve'])) {
            $userId = $_GET['approve'];
            $query = "UPDATE users SET user_status = 'approved' WHERE user_id = {$userId} ";
            $approveuserQuery = mysqli_query($connectionToDB, $query);
            confirmQUery($approveuserQuery);
            header("Location: users.php");
        }
    ?>

    <?php
        if (isset($_GET['unapprove'])) {
            $userId = $_GET['unapprove'];
            $query = "UPDATE users SET user_status = 'disabled' WHERE user_id = {$userId} ";
            $unapproveuserQuery = mysqli_query($connectionToDB, $query);
            confirmQUery($unapproveuserQuery);
            header("Location: users.php");
        }
    ?>

    <?php       
        if (isset($_GET['delete'])) {
            $userId = $_GET['delete'];
            $query = "DELETE FROM users WHERE user_id = {$userId} ";
            $deleteuserQuery = mysqli_query($connectionToDB, $query);
            confirmQUery($deleteuserQuery);
            header("Location: users.php");  
        }
    ?>
       
    <?php // rendering the table with users

    $query = "SELECT * FROM users ORDER BY user_id DESC";
    $selectAllUsers = mysqli_query($connectionToDB, $query);
    confirmQUery($selectAllUsers);

    while($row = mysqli_fetch_assoc($selectAllUsers)){
        $userId = $row['user_id'];
        $userName = $row['user_name'];
        $userFName = $row['user_first_name'];
        $userLName = $row['user_last_name'];
        $userEmail = $row['user_email'];
        $userImage = $row['user_image'];
        $userRole = $row['user_role'];
        $userDate = $row['user_created_at'];
        $query = "SELECT * FROM user_roles WHERE role_id = $userRole ";
        $selectUserRoleTitle = mysqli_query($connectionToDB, $query);
        confirmQUery($selectUserRoleTitle);
        while($row = mysqli_fetch_assoc($selectUserRoleTitle)){
            $userRoleId = $row['role_id'];
            $userRole = $row['role_title'];
        }
        
        $fileExists = file_exists ('../images/' . $userImage);
        
        if ($userImage == 'NULL' || $userImage == NULL || $fileExists != TRUE) {
            $userImage = "../images/placeholderImg.jpg";
        } else {
            $userImage = "../images/{$userImage}";
        }
        
    ?>             
        <tr>
            <td><?php echo $userId ?></td>
            <td><img height='50'  src='<?php echo $userImage ?>'></td>
            <td><?php echo $userName ?></td>
            <td><?php echo $userFName ?></td>
            <td><?php echo $userLName ?></td>
            <td><?php echo $userEmail ?></td>
            <td><?php echo $userRole ?></td>
            <td><?php echo $userDate ?></td>
            <td><a href='users.php?approve=<?php echo $userId ?>'>Approve</a></td>
            <td><a href='users.php?unapprove=<?php echo $userId ?>'>Unapprove</a></td>
            <td><a href='users.php?edit=<?php echo $userId ?>'>Edit</a></td>
            <td><a href='users.php?delete=<?php echo $userId ?>'>Delete</a></td>
        </tr>

    <?php
    } // end of while loop
    ?>
    
    </tbody>
</table>