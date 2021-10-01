<?php
// NOTE: Smarty has a capital 'S'
include 'db.php';
require('/usr/share/php/smarty/libs/Smarty.class.php');


if(!isset($_POST['Submit'])){
    header("Location: register.php");
} else{
    // Process signup submission
    $db = dbconnect($hostname, $db_name, $db_user, $db_passwd);

if( $_POST['first_name'] == '' &&
    $_POST['last_name'] == '' &&
    $_POST['email']  == '' &&
    $_POST['password'] == '' ) {
    header("Location: register.php?error=0");
    exit;
}

$query = "SELECT * FROM users WHERE email = '" .$_POST["email"] ."'";
$result = @ mysqli_query($db,$query);
$email = $_POST['email'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$name = $_POST['first_name']." ".$_POST['last_name'];
$password = $_POST['password'];

/*if(!$result)
    showerror($db);*/

if(mysqli_num_rows($result) > 0) {
    header("Location: register.php?error=1&email=$email&first_name=$first_name&last_name=$last_name");
    exit;
}


if(!strpos($_POST['email'], '@')){
    header("Location: register.php?error=2&email=$email&first_name=$first_name&last_name=$last_name");
    exit;
}


if($_POST['password'] == ''){
    header("Location: register.php?error=3&email=$email&first_name=$first_name&last_name=$last_name");
    exit;
}

if($_POST['password'] != $_POST['password_confirm']){
    header("Location: register.php?error=4&email=$email&first_name=$first_name&last_name=$last_name");
    exit;
}

if(strlen($name)==0){
    header("Location: register.php?error=5&email=$email");
    exit;
}

$password_digest = substr(md5($password), 0, 32);
$email = $_POST['email'];
$present_date = date("Y-m-d H:i:s");

$sql_insert = "INSERT INTO users(name, email, created_at, updated_at, password_digest)
                 VALUES('$name', '$email','$present_date','$present_date', '$password_digest')";

mysqli_query($db,$sql_insert);

/*if(!mysqli_query($db, $sql_insert))
    showerror($db);*/

mysqli_close($db);

header("Location: message.php?register_success=1");
}