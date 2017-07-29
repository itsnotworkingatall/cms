<?php

if (isset($_POST['create_user'])) {
    
    $userName = $_POST['username'];
    $userFName = $_POST['fname'];
    $userLName = $_POST['lname'];
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];
    $userImage = $_FILES['image']['name'];
    $userImageTemp = $_FILES['image']['tmp_name'];     
    $userRole = $_POST['role'];
    //$userDate = date('d-m-y');
    
    move_uploaded_file($userImageTemp, "../images/$userImage");
    
    $query = "INSERT INTO users (";
    $query .= "user_name, ";
    $query .= "user_password, ";
    $query .= "user_first_name, ";
    $query .= "user_last_name, ";
    $query .= "user_email, ";
    $query .= "user_image, ";
    $query .= "user_role, ";
    $query .= "user_created_at";
    $query .= ") ";
    
    $query .= "VALUES (";
    $query .= "'{$userName}', ";
    $query .= "'{$userPassword}', ";
    $query .= "'{$userFName}', ";
    $query .= "'{$userLName}', ";
    $query .= "'{$userEmail}', ";
    $query .= "'{$userImage}', ";
    $query .= "'{$userRole}', ";
    $query .= "now()";
    $query .= ") ";

    
    $createNewUser = mysqli_query($connectionToDB, $query);
    confirmQuery($createNewUser);
    header("Location: users.php");
}

?>

<form action="" method="post" enctype="multipart/form-data">

   <div class="form-group">
       <label for="username">Username</label>
       <input type="text" class="form-control" name="username">
   </div>
   
   <div class="form-group">
       <label for="fname">First Name</label>
       <input type="text" class="form-control" name="fname">
   </div>
   
   <div class="form-group">
       <label for="lname">Last Name</label>
       <input type="text" class="form-control" name="lname">
   </div>
   
   <div class="form-group">
       <label for="email">Email</label>
       <input type="email" class="form-control" name="email">
   </div>
   
   <div class="form-group">
       <label for="password">Password</label>
       <input type="password" class="form-control" name="password">
   </div>
   
   <div class="form-group">
       <label for="image">User Image</label>
       <input type="file" name="image">
   </div>
   
   <div class="form-group">
       <label for="role">User Role</label><br>
        <select name="role">
            
        <?php 

            $query = "SELECT * FROM user_roles";
            $selectRoles = mysqli_query($connectionToDB, $query);
            confirmQuery($selectRoles);

            while($row = mysqli_fetch_assoc($selectRoles)){
                $roleId = $row['role_id'];
                $roleTitle = $row['role_title'];
            ?>
                <option value='<?php echo $roleId ?>'><?php echo $roleTitle ?></option>";
            <?php
            } //end of while loop

        ?>
            
        </select>
   </div>
   
   <div class="form-group">
       <input type="submit" class="btn btn-primary" name="create_user" value="Create User">
   </div>
      
</form>