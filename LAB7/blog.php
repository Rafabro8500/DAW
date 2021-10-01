<?php
// NOTE: Smarty has a capital 'S'
include 'db.php';
require('/usr/share/php/smarty/libs/Smarty.class.php');

$smarty = new Smarty();
$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';

$db = dbconnect($hostname, $db_name, $db_user, $db_passwd);

session_start();
if (isset($_SESSION['user_id'])) { //atribui a o nome de utilizador à variavel smarty caso haja uma sessão iniciada 
    $smarty->assign('user_name', $_SESSION['user_name']);
} else{
    header("Location: message.php?blog_fail=1");
    exit;
}

if (isset($_GET['micropost_id'])) {
    $micropost_id = $_GET['micropost_id'];
    $query = @mysqli_query($db, "SELECT content FROM microposts WHERE id = $micropost_id");
    $blog = mysqli_fetch_assoc($query);
    $smarty->assign('blog', $blog['content']);
    $smarty->assign('action', "updateblog_action.php?micropost_id=$micropost_id");
} else {
    $smarty->assign('action', "newblog_action.php");
}
try {
    $smarty->display('templates/blog_template.tpl');
} catch (Exception $e) {
    print($e->getTraceAsString());
}

mysqli_close($db);
