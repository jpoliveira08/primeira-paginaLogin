<?php


class Controle
{

    private $mysql;
    
    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }
    
    /*
    Cadastrando usuário para ter acesso ao sistema
    */
    public function cadastrar(string $nome, string $email, string $senha) : bool
    {
        $email = $this->mysql->real_escape_string($email);
        $emailExist = $this->mysql->query("SELECT * FROM users WHERE email='$email'");
        $numLinha = $emailExist->num_rows;
        //Caso não seja encontrada nenhuma linha, iniciar o processo de cadastro do usuário
        if($numLinha == 0){
            $cadastrarUsuario = $this->mysql->prepare("INSERT INTO users(nome, email, senha) VALUES (?, ?, ?);");
            $cadastrarUsuario->bind_param("sss", $nome, $email, $senha);
            $cadastrarUsuario->execute();
            return true;
        }
        return false;

    }
    
    /*
    Metódo para validar se o campo de senha e Confirme a senha estão iguais
    */
    public function validarSenha(string $senha, string $senhaConfirmada) : bool
    {
        if($senha === $senhaConfirmada){
            return true;
        }
        return false;
    }
    
    /*
    Método criado para permitir o acesso do usuário ao sistema.
    Verificando se já existe uma linha no banco com os dados especificados.
    */
    public function validandoLogin(string $email, string $senha) : array
    {   
        $email = $this->mysql->real_escape_string($email);
        $senha = $this->mysql->real_escape_string($senha);
        
        //Selecione todos os campos do usuario, onde email=email e senha=senha
        $selecionandoUsuario = $this->mysql->query("SELECT * FROM users WHERE email='$email' AND senha='$senha'") or die("Falaha na execução do código  SQL." . $this->mysql->error);
        
        //Verificando se foi encontrado alguma linha na tabela com as informações anteriores
        $quantidade = $selecionandoUsuario->num_rows;
        

        if($quantidade==1)
        {
            return $selecionandoUsuario->fetch_assoc(); //Passando um array associativo com as informações do banco
        }
        return [];
    }
}