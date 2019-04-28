<?php

require_once __DIR__ . '/vendor/autoload.php';

$config = [
    'dbase'=> 'teste',
    'host'=>  'localhost',
    'user'=>  'root',
    'senha'=> 'admmysqlgeweb'
];

$grantdb = new GrantdbPHP\GrantdbPHP($config);

$user_grant = "teste";
$prefixo_tabela = "pilot";

$result = $grantdb->geragrant($user_grant, $prefixo_tabela);

print $result;