<?php
// NOTE: Smarty has a capital 'S'
include 'db.php';
require('/usr/share/php/smarty/libs/Smarty.class.php');

$smarty = new Smarty();
$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';

$db = dbconnect($hostname, $db_name, $db_user, $db_passwd);

if (isset($_GET['email']))
    $smarty->assign('email', $_GET['email']);

if (isset($_COOKIE['error']) && $_COOKIE['error']) {
    $smarty->assign('Message', "Wrong email or password!");
    setcookie("error", "", time() - 3600); //delete cookie
}

try {
    $smarty->display('templates/login_template.tpl');
} catch (Exception $e) {
    print($e->getTraceAsString());
}

mysqli_close($db);
