<?php include "db.php" ?>
<?php include "../admin/includes/functions.php" ?>
<?php session_start() ?>

<?php

if (isset($_POST['login'])) {
    $userName     = $_POST['username'];
    $userPassword = $_POST['password'];
}

$userName = mysqli_real_escape_string($connectionToDB, $userName);
$userPassword = mysqli_real_escape_string($connectionToDB, $userPassword);

$query = "SELECT * FROM users WHERE user_name = '{$userName}' ";
$selectUser = queryToDB($query);

while ($row = mysqli_fetch_assoc($selectUser)) {
    $dbId       = $row['user_id'];
    $dbUName    = $row['user_name'];
    $dbFName    = $row['user_first_name'];
    $dbLName    = $row['user_last_name'];
    $dbPassword = $row['user_password'];
    $dbRole     = $row['user_role'];
    $dbStatus   = $row['user_status'];
}

if ($userName === $dbUName && $userPassword === $dbPassword) {

    $_SESSION['username'] = $dbUName;
    $_SESSION['userfirstname'] = $dbFName;
    $_SESSION['userlastname'] = $dbLName;
    $_SESSION['userrole'] = $dbRole;
    $_SESSION['userstatus'] = $dbStatus;
    $_SESSION['userid'] = $dbId;

    header("Location: ../admin");

} else {

    header("Location: ../index.php");

}
