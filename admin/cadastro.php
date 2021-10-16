<?php

require_once '../config.php';
require_once '../src/Controle.php';
require_once '../src/Redirecionar.php';

/*
Caso haja requisição POST
*/
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $cadastro = new Controle($mysql);
    //Obs.: Os dados são capturados com o método POST, porém só é possível receber os dados a partir de um requisição
    if($cadastro->validarSenha($_POST['senha'], $_POST['senhaConfirmada'])){
        /* 
        Primeiramente validamos se os campos de senha e Confirme as senhas são iguais com um metodo da classe Controle
        */
        if($cadastro->cadastrar($_POST['nome'], $_POST['email'], $_POST['senha'])){
            //É feito um redirecionamento para não cadastrar novamente no banco, caso a paǵina seja atualizada
            Redirecionar::toURL('./cadastro.php');
        }
        /*
        Caso a consulta no banco retorne uma linha existente, validamos que o email já foi cadastrado no banco
        */
        else {
            echo "Email já cadastrado";
        }
    }
    else{
        echo "Os campos Senha e Confirme a Senha não conferem!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>

    </head>
    <title>Cadastro</title>
    <meta charset="utf-8">
    <!-- Divisão para o corpo da página -->
    <body>
        <form method="POST" action="cadastro.php">
            <label>Nome</label>
            <input type="text" name="nome" required>
            <br><label>Email</label>
            <input type="email" name="email" required>
            <br><label>Senha</label>
            <input type="password" name="senha" required>
            <br><label>Confirme a senha</label>
            <input type="password" name="senhaConfirmada" required>
            <br><input type="submit" value="Cadastrar">
        </form>
    </body>
</html>