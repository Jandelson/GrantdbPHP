<?php
require_once('grantdb.php');
require_once('config.php');
use GrantdbPHP\GrantdbPHP;
$grantdb = new GrantdbPHP;
$grantdb->Mysql($config);
/*POST FORM*/
$user = $_POST['user'];
$prefixo = $_POST['prefixo'];
$like = (empty($_POST['like']))?false:true;

$permiss = $grantdb->geragrant(
    $config['dbase'], /*Banco de dados*/
    $config['host'], /*Host*/
    $user,
    $prefixo,
    $like
);

if (isset($_POST['post'])) {
    print "<pre>";
    if (count($permiss)>0) {
        $result = implode("<br>",$permiss);
    } else {
        $result = "DADOS INVALIDOS!";
    }
}

header('Location: index.php?result='.$result.'');