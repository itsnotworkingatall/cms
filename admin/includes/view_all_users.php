<?php

if (isset($_POST['checkBoxArray'])) {

    foreach ($_POST['checkBoxArray'] as $checkBoxValue) {

        $bulk_options = $_POST['bulk_options'];

        if ($bulk_options == "Delete") {

            $query = "DELETE FROM users WHERE user_id = {$checkBoxValue} ";

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
                   <option value="Enabled">Enable</option>
                   <option value="Disabled">Disable</option>
                   <option value="Delete">Delete</option>
               </select>
            </div>

           <div class="col-xs-4 form-group">
               <input type="submit" name="submit" class="btn btn-success" value="Apply">
               <a href="users.php?source=add_user" class="btn btn-primary">Add new user</a>
           </div>
        </div>


        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>ID</th>
                <th>User Image</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Date</th>
                <th>Status</th>
                <th>Disable</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

        <?php // rendering the table with users

        $query = "SELECT * FROM users ORDER BY user_id DESC";
        $selectAllUsers = queryToDB($query);

        while ($row = mysqli_fetch_assoc($selectAllUsers)) {
            $userId     = $row['user_id'];
            $userName   = $row['user_name'];
            $userFName  = $row['user_first_name'];
            $userLName  = $row['user_last_name'];
            $userEmail  = $row['user_email'];
            $userImage  = $row['user_image'];
            $userRole   = $row['user_role'];
            $userDate   = $row['user_created_at'];
            $userStatus = $row['user_status'];
            $query = "SELECT * FROM user_roles WHERE role_id = $userRole ";
            $selectUserRoleTitle = queryToDB($query);
            while ($row = mysqli_fetch_assoc($selectUserRoleTitle)) {
                $userRoleId = $row['role_id'];
                $userRole = $row['role_title'];
            }

            $fileExists = file_exists('../images/' . $userImage);

            if ($userImage == 'NULL' || $userImage == null || $fileExists != true) { // if image not set or not found, creating a random avatar
                $userImage = create_image();
                $query = "UPDATE users SET user_image = '{$userImage}' WHERE user_id = {$userId} ";
                queryToDB($query);
            }
                $userImage = "../images/{$userImage}";

            if ($userStatus == 'Enabled') {
                $action = 'disable';
                $actionTitle = 'Disable';
                $actionStatus = 'Disabled';
            } else {
                $action = 'enable';
                $actionTitle = 'Enable';
                $actionStatus = 'Enabled';
            }
            ?>

            <?php
            if (isset($_GET[$action])) {
                $userId = $_GET[$action];
                $query = "UPDATE users SET user_status = '{$actionStatus}' WHERE user_id = {$userId} ";
                queryToDB($query);
                header("Location: users.php");
            }
            ?>

            <?php
            if (isset($_GET['delete'])) {
                $userId = $_GET['delete'];
                $query = "DELETE FROM users WHERE user_id = {$userId} ";
                queryToDB($query);
                header("Location: users.php");
            }
            ?>

            <tr>
                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value="<?php echo $userId ?>"></td>
                <td><?php echo $userId ?></td>
                <td><div class="thumbnail"><img src='<?php echo $userImage ?>'></div></td>
                <td><?php echo $userName ?></td>
                <td><?php echo $userFName ?></td>
                <td><?php echo $userLName ?></td>
                <td><?php echo $userEmail ?></td>
                <td><?php echo $userRole ?></td>
                <td><?php echo $userDate ?></td>
                <td><?php echo $userStatus ?></td>
                <td><a href='users.php?<?php echo $action ?>=<?php echo $userId ?>'><?php echo $actionTitle ?></a></td>
                <td><a href='users.php?source=edit_user&user_id=<?php echo $userId ?>'>Edit</a></td>
                <td><a href='users.php?delete=<?php echo $userId ?>'>Delete</a></td>
            </tr>

        <?php
        } // end of while loop
        ?>

        </tbody>
    </table>
</form>
