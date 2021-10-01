<?php
// NOTE: Smarty has a capital 'S'
include 'db.php';
require('/usr/share/php/smarty/libs/Smarty.class.php');


$smarty = new Smarty();
$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';

$db = dbconnect($hostname, $db_name, $db_user, $db_passwd);

if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($db) {
    // criar query numa string para tirar todas as colunas dos microposts e o nome do utilizador de cada post associado
    $posts_query  = "SELECT microposts . * , users.name
    FROM microposts
    LEFT JOIN users ON microposts.user_id = users.id";

    $result = mysqli_query($db,$posts_query);
    $nrows  = mysqli_num_rows($result);
    for ($i = 0; $i < $nrows; $i++)
        $tuple[$i] = mysqli_fetch_assoc($result);

    // faz a atribuição das variáveis do template smarty
    $smarty->assign('posts', $tuple);

    $smarty->display('index_template.tpl');

    // fechar a ligação à base de dados
    mysqli_close($db);
}
