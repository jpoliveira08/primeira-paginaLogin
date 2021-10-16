<?php

/*
Criando um método estático para realizar os direcionamentos no decorrer do código
*/
class Redirecionar
{
    public static function toURL(string $url) : void
    {
        header("Location: {$url}");
        exit();
    }
}

?>