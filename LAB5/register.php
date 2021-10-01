<?php
// NOTE: Smarty has a capital 'S'
include 'db.php';
require('/usr/share/php/smarty/libs/Smarty.class.php');

$smarty = new Smarty();
$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';

if(isset($_GET['first_name'])){
    $smarty->assign('first_name', $_GET['first_name']);
}
if(isset($_GET['last_name'])){
    $smarty->assign('last_name', $_GET['last_name']);
}
if(isset($_GET['email'])){
    $smarty->assign('email', $_GET['email']);
}

if ($_GET['error'] == "0") {
    $smarty->assign('Message', 'Every field should be filled');
} elseif ($_GET['error'] == "1") {
    $smarty->assign('Message', 'Email already exists');
} elseif ($_GET['error'] == "2") {
    $smarty->assign('Message', 'Email has incorrect format');
} elseif ($_GET['error'] == "3") {
    $smarty->assign('Message', 'Password is empty');
} elseif ($_GET['error'] == "4") {
    $smarty->assign('Message', "Passwords don't match");
}

$smarty->display('templates/register_template.tpl');
