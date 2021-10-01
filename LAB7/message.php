<?php

include 'db.php';
require('/usr/share/php/smarty/libs/Smarty.class.php');

$smarty = new Smarty();
$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';

session_start();
if (isset($_SESSION['user_id'])) { //atribui a o nome de utilizador à variavel smarty caso haja uma sessão iniciada 
    $smarty->assign('user_name', $_SESSION['user_name']);
}

if(isset($_GET['register_success'])){
    $smarty->assign('message_head', "Register Successful!");
    $smarty->assign('message_body', "Thank you for becoming a member of Portal do Cientismo!");
    $smarty->display('templates/message_template.tpl');
}
if(isset($_GET['logout'])){
    $smarty->assign('message_head', "Logout Successful!");
    $smarty->assign('message_body', "Thank you for your time, be back soon!");
    $smarty->display('templates/message_template.tpl');
}
if(isset($_GET['login'])){
    $smarty->assign('message_head', "Login Successful!");
    $smarty->assign('message_body', "Welcome back to Portal do Cientismo! We hope you do a lot of fun science stuff.");
    $smarty->display('templates/message_template.tpl');
}
if(isset($_GET['blog_fail'])){
    $smarty->assign('message_head', "Failed to post blog");
    $smarty->assign('message_body', "Please make sure you are logged in.");
    $smarty->display('templates/message_template.tpl');
}
if(isset($_GET['blog_success'])){
    $smarty->assign('message_head', "Blog posted succesfully!");
    $smarty->assign('message_body', "Thank you for your contribution to the Scientism world!");
    $smarty->display('templates/message_template.tpl');
}
if(isset($_GET['not_allowed'])){
    $smarty->assign('message_head', "ERROR: Not Allowed!");
    $smarty->assign('message_body', "You don't have permissions to do this.");
    $smarty->display('templates/message_template.tpl');
}