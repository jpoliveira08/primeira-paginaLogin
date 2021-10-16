<?php

/*
Iniciando com o processo de login
Trabalhando com session
*/
session_start();

/*
Fazendo a comunicação com o banco de dados
*/
$mysql = new mysqli('', '', '', '');

/*
Caso de algum erro de comunicação com o banco, exibir a mensagem na tela
 */
if($mysql->connect_errno){
    echo "Erro na conexão com o bando";
}

