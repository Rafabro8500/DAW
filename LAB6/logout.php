<?php

require('/usr/share/php/smarty/libs/Smarty.class.php');

    session_start();
    session_destroy();
    header('Location: message.php?logout=1');
