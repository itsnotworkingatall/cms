<?php

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];
}

$query = "SELECT * FROM users WHERE user_id={$userId}";
$selectUser = queryToDB($query);

while ($row = mysqli_fetch_assoc($selectUser)) {
    $userId       = $row['user_id'];
    $userName     = $row['user_name'];
    $userPassword = $row['user_password'];
    $userFName    = $row['user_first_name'];
    $userLName    = $row['user_last_name'];
    $userEmail    = $row['user_email'];
    $userImage    = $row['user_image'];
    $userRole     = $row['user_role'];
}

if (isset($_POST['update_user'])) {
    $userName      = $_POST['username'];
    $userFName     = $_POST['fname'];
    $userLName     = $_POST['lname'];
    $userEmail     = $_POST['email'];
    $userPassword  = $_POST['password'];
    $userImage     = $_FILES['image']['name'];
    $userImageTemp = $_FILES['image']['tmp_name'];
    $userRole      = $_POST['role'];

    if (empty($userImage)) {
        $query = "SELECT * FROM users WHERE user_id={$userId} ";
        $selectImage = queryToDB($query);
        while ($row = mysqli_fetch_array($selectImage)) {
            $userImage = $row['user_image'];
        }
    } else {
        move_uploaded_file($userImageTemp, "../images/$userImage");
    }

    $query = "UPDATE users SET ";
    $query .= "user_name       ='{$userName}', ";
    $query .= "user_password   ='{$userPassword}', ";
    $query .= "user_first_name ='{$userFName}', ";
    $query .= "user_last_name  ='{$userLName}', ";
    $query .= "user_email      ='{$userEmail}', ";
    $query .= "user_image      ='{$userImage}', ";
    $query .= "user_role       ='{$userRole}', ";
    $query .= "user_updated_at ='now()' ";
    $query .= "WHERE user_id   = {$userId} ";

    queryToDB($query);
    header("Location: users.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" value="<?php echo $userName ?>" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="fname">First Name</label>
        <input type="text" value="<?php echo $userFName ?>" class="form-control" name="fname">
    </div>

    <div class="form-group">
        <label for="lname">Last Name</label>
        <input type="text" value="<?php echo $userLName ?>" class="form-control" name="lname">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" value="<?php echo $userEmail ?>" class="form-control" name="email">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" value="<?php echo $userPassword ?>" class="form-control" name="password">
    </div>

    <div class="form-group">
        <label for="image">User Image</label>
        <input type="file" name="image">
        <br>
        <p><strong>Current image: </strong></p>

            <?php if (!empty($userImage)) { ?>
                <img src="../images/<?php echo $userImage ?>" height="50px" >
            <?php } else { ?>
                <img src="../images/placeholderImg.jpg" height="50px" >
            <?php } ?>
    </div>

    <div class="form-group">
        <label for="role">User Role</label><br>
        <select name="role">

        <?php

            $query = "SELECT * FROM user_roles";
            $selectRoles = queryToDB($query);

        while ($row = mysqli_fetch_assoc($selectRoles)) {
            $roleId = $row['role_id'];
            $roleTitle = $row['role_title'];
        ?>
                <option value='<?php echo $roleId ?>' <?php if ($userRole == $roleId) {echo " selected";} ?> ><?php echo $roleTitle ?></option>";
        <?php
        } //end of while loop
        ?>

        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
        <input type="reset" class="btn btn-primary" name="reset" value="Undo">
    </div>

</form>
