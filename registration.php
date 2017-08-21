<?php  include "includes/db.php"; ?>
<?php  include "admin/includes/functions.php"; ?>
<?php  include "includes/header.php"; ?>

<?php

if (isset($_POST['submit'])) {

    $userName     = $_POST['username'];
    $userEmail    = $_POST['email'];
    $userPassword = $_POST['password'];

    if (!empty($userName) && !empty($userEmail) && !empty($userPassword)) {

        $userName     = escapeString($userName);
        $userEmail    = escapeString($userEmail);
        $userPassword = escapeString($userPassword);
        $userRole     = 3;
        $userImage    = create_image();

        $userPassword = password_hash($userPassword, PASSWORD_BCRYPT, array('cost' => 10));

        $query = "INSERT INTO users (user_name, user_email, user_password, user_role, user_created_at, user_image) ";
        $query .= "VALUES ('{$userName}', '{$userEmail}', '{$userPassword}', {$userRole}, now(), '{$userImage}' )";
        queryToDB($query);
    }
}


?>

<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group required">
                            <label for="username" class="control-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                        </div>
                         <div class="form-group required">
                            <label for="email" class="control-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                        </div>
                         <div class="form-group required">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
