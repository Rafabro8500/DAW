<?php

require('/usr/share/php/smarty/libs/Smarty.class.php');

session_start();
session_destroy();
setcookie('rememberMe', "", time() - 3600);
header('Location: message.php?logout=1');
