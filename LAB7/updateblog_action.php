<?php
// NOTE: Smarty has a capital 'S'
include 'db.php';
require('/usr/share/php/smarty/libs/Smarty.class.php');


$db = dbconnect($hostname, $db_name, $db_user, $db_passwd);

session_start();

$blog_id = $_GET['micropost_id'];
$select_result = mysqli_fetch_assoc(mysqli_query($db, "SELECT user_id FROM microposts WHERE id = '$blog_id'"));

if ($select_result['user_id'] !== $_SESSION['user_id']) { 
    header("Location: message.php?not_allowed=1");
    exit;
} else{
    $blog = $_POST['blog'];
    $present_date = date("Y-m-d H:i:s");
    $sql_update = "UPDATE microposts SET content = '$blog', updated_at = '$present_date' WHERE id = '$blog_id'";
    if (mysqli_query($db, $sql_update)) {
        header("Location: message.php?blog_success=1");
    } else {
        header("Location: message.php?blog_fail=1");
    }
}

mysqli_close($db);

