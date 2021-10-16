<?php
require_once '../config.php';
require_once '../src/Redirecionar.php';

/*
Caso a seção não esteja iniciada, encaminhar o usuário para página de Login
*/
if(!isset($_SESSION['UserLog'])){
    Redirecionar::toURL('../index.php');
}
/*
Simples verificação para deslogar o usuário da sessão a partir de dados capturados na URL
*/
if(isset($_GET['deslogar'])){
    session_destroy();
    Redirecionar::toURL('../index.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Painel</title>
    </head>
    <body>
        <h1>Welcome</h1>
        <a href="?deslogar">Sair</a>
    </body>
</html>