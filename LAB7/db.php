<?php
function showerror($db)
{
    die("Error " . mysqli_errno($db) . " :" . mysqli_error($db));
}
$hostname = "10.10.23.183";
$db_name = "db_a62156";
$db_user = "a62156";
$db_passwd = "15bd07";
function dbconnect($hostname, $db_name, $db_user, $db_passwd)
{
    $db = @mysqli_connect($hostname, $db_user, $db_passwd, $db_name);
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $db;
}
