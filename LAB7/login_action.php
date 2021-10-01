<?php

require('db.php');
$db = dbConnect($hostname, $db_name, $db_user, $db_passwd);

$email = $_POST['email'];
$password = $_POST['password'];
$password_digest = substr(md5($password), 0, 32);

$result = @mysqli_query($db, "SELECT id, name, password_digest FROM users WHERE email = '$email' AND password_digest = '$password_digest'");
if (mysqli_num_rows($result) == 0) {
    loginFailed($email);
} else {
    $user = mysqli_fetch_assoc($result);
    session_start();
    if($_POST['rememberMe']) {
        $remember_digest = substr(md5(time()),0,32);
        setcookie('rememberMe', $remember_digest, time() + (3600 * 24 * 30));
        mysqli_query($db,"UPDATE users SET remember_digest = '$remember_digest' WHERE id = '".$user['id']."'");
    }
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_email'] = $user['email'];
    setcookie("error", "", time() - 3600); //delete cookie "error"
    header("Location: message.php?login=1");
}

mysqli_close($db);

function loginFailed($email)
{
    setcookie('error', true);
    header("Location:login.php?email=$email");
}
