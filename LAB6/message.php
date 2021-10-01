<?php

include 'db.php';
require('/usr/share/php/smarty/libs/Smarty.class.php');

$smarty = new Smarty();
$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';

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