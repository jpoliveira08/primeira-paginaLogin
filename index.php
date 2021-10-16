<?php

require_once 'config.php';
require_once 'src/Redirecionar.php';
require_once 'src/Controle.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $controle = new Controle($mysql);
    /*
    Verificando se o banco de dados possuem os dados cadastrados, caso a função retorne um array nulo, o banco não possui os dados informados
    */
    if(empty($controle->validandoLogin($_POST['email'], $_POST['senha']))){
        echo "Email ou senha incorretos!";
    }
    /*
    Caso retorne um array com dados, podemos iniciar a sessão do usuário no sistema
    */
    else{
        $_SESSION['UserLog'] = true;
    }
}
    /*
    Verificação para caso o usuário já esteja logado, encaminhar para o acesso restrito
    */
    if(isset($_SESSION['UserLog'])){
        Redirecionar::toURL('./acesso-restrito/index.php');
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>

    </head>
    <title>Login</title>
    <meta charset="utf-8">
    <!-- Divisão para o corpo da página -->
    <body>
        <!-- Caso não encontre o login, mostrar mensagem -->
        <form method="POST" action="index.php">
            <label>Email</label>
            <input type="email" name="email" required>
            <br><label>Senha</label>
            <input type="password" name="senha" required>
            <br><input type="submit" value="Login" name="enviar">
        </form>
    </body>
</html>