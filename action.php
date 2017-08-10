<?php
require_once('grantdb.php');
require_once('config.php');
use GrantdbPHP\GrantdbPHP;
$grantdb = new GrantdbPHP;
$grantdb->Mysql($config);
/*POST FORM*/
$user = $_POST['user'];
$prefixo = $_POST['prefixo'];
$db_prefixo = (empty($_POST['db_alt']))?false:$_POST['db_prefixo'];
$like = (empty($_POST['like']))?false:true;

$permiss = $grantdb->geragrant(
    $config['dbase'], /*Banco de dados*/
    $config['host'], /*Host*/
    $user,
    $prefixo,
    $like,
    $db_prefixo
);
if (isset($_POST['post'])) {
    try {
        if (is_array($permiss)) {
            $result = implode("<br>",$permiss);
        } else if (empty($permiss)){
            throw new Exception("Dados Invalidos!");
        } else {
            $result = $permiss;
        }
    } catch (Exception $e) {
        $result = $e->getMessage();
    }

    print "<pre>";
    print $result;
}

header('Location: index.php?result='.$result.'');