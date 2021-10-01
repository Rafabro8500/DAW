<?php
// NOTE: Smarty has a capital 'S'
include 'db.php';
require('/usr/share/php/smarty/libs/Smarty.class.php');


$smarty = new Smarty();
$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';

$db = dbconnect($hostname, $db_name, $db_user, $db_passwd);


if ($db) {
    // criar query numa string para tirar todas as colunas dos microposts e o nome do utilizador de cada post associado
    $posts_query  = "SELECT microposts . * , users.name
    FROM microposts
    LEFT JOIN users ON microposts.user_id = users.id ORDER BY microposts.likes DESC LIMIT 10";

    $result = mysqli_query($db, $posts_query);
    $nrows  = mysqli_num_rows($result);
    for ($i = 0; $i < $nrows; $i++)
        $tuple[$i] = mysqli_fetch_assoc($result);

    $recent_posts_query  = "SELECT microposts . * , users.name
    FROM microposts
    LEFT JOIN users ON microposts.user_id = users.id ORDER BY microposts.created_at DESC LIMIT 10";

    $recent_posts = mysqli_query($db, $recent_posts_query);
    for($i = 0 ; $i < mysqli_num_rows($recent_posts); $i++)
        $recent_posts_tuple[$i] = mysqli_fetch_assoc($recent_posts);

    session_start();
    if (isset($_SESSION['user_id'])) { //atribui a o nome de utilizador à variavel smarty caso haja uma sessão iniciada 
        $smarty->assign('user_name', $_SESSION['user_name']);
    }
    // faz a atribuição das variáveis do template smarty
    $smarty->assign('posts', $tuple);
    $smarty->assign('recent_posts', $recent_posts_tuple);
    $smarty->display('templates/index_template.tpl');

    // fechar a ligação à base de dados
    mysqli_close($db);
}
