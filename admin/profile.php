<?php include "includes/admin_header.php" ?>
<?php if(isset($_SESSION['username'])) {
    
    $userName = $_SESSION['username'];
    
    $query = "SELECT * FROM users WHERE user_name = '{$userName}' ";
    $selectCurrentUserInfo = queryToDB($query);
    
    while($row = mysqli_fetch_assoc($selectCurrentUserInfo)) {
        $userId     = $row['user_id'];
        $userName   = $row['user_name'];
        $userFName  = $row['user_first_name'];
        $userLName  = $row['user_last_name'];
        $userEmail  = $row['user_email'];
        $userImage  = $row['user_image'];
        $userPassword  = $row['user_password'];
        
        $fileExists = file_exists ('../images/' . $userImage);
        
        if ($userImage == 'NULL' || $userImage == NULL || $fileExists != TRUE) {
            $userImage = "../images/placeholderImg.jpg";
        } else {
            $userImage = "../images/{$userImage}";
        }
    }
    
    if (isset($_POST['update_user'])) {
        $userName      = $_POST['username'];
        $userFName     = $_POST['fname'];
        $userLName     = $_POST['lname'];
        $userEmail     = $_POST['email'];
        $userPassword  = $_POST['password'];
        $userImage     = $_FILES['image']['name'];
        $userImageTemp = $_FILES['image']['tmp_name'];
        //$userUpdatedAt  = date('d-m-y');

        if(empty($userImage)){
            $query = "SELECT * FROM users WHERE user_id={$userId} ";
            $selectImage = queryToDB($query);
            while($row = mysqli_fetch_array($selectImage)){
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
        $query .= "user_updated_at ='now()' ";
        $query .= "WHERE user_id   = {$userId} ";

        queryToDB($query);
        header("Location: users.php");
}
    
}
?>

<div id="wrapper">
<?php include "includes/admin_navigation.php" ?>
<div id="page-wrapper">
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Welcome to admin
                <small><?php echo $_SESSION['username'] ?></small>
            </h1>
            
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
                            <img src="../images/<?php echo $userImage ?>" height="50px" > <?php
                          } else { ?>
                            <img src="../images/placeholderImg.jpg" height="50px" >
                          <?php } ?>
                </div>

                <div class="form-group">
                   <input type="submit" class="btn btn-primary" name="update_user" value="Update Profile">
                   <input type="reset" class="btn btn-primary" name="reset" value="Undo">
                </div>
                  
                <div class="form-group">
                   
                </div>
                

                </form>
            
            
            
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>