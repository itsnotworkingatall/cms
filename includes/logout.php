<?php session_start() ?>
<?php

    $_SESSION['username'] = null;
    $_SESSION['userfirstname'] = null;
    $_SESSION['userlastname'] = null;
    $_SESSION['userrole'] = null;
    $_SESSION['userstatus'] = null;

    header("Location: ../index.php");
?>
