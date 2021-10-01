<?php
// NOTE: Smarty has a capital 'S'
include 'db.php';
require('/usr/share/php/smarty/libs/Smarty.class.php');


$db = dbconnect($hostname, $db_name, $db_user, $db_passwd);

session_start();
if (isset($_SESSION['user_id'])) { 
    $blog = $_POST['blog'];
    $user_id = $_SESSION['user_id'];
    $present_date = date("Y-m-d H:i:s");
    $sql_insert = "INSERT INTO microposts (content, user_id, created_at, updated_at)
                 VALUES('$blog', '$user_id','$present_date','$present_date')";
    if (mysqli_query($db, $sql_insert)) {
        header("Location: message.php?blog_success=1");
    } else {
        header("Location: message.php?blog_fail=1");
    }
} else {
    header("Location: message.php?blog_fail=1");
    exit;
}

mysqli_close($db);
