<?php
require_once("../classes/Database.class.php");


class Usuario
{
    private $idlogin;
    private $numvei;
    private $usuario;
    private $email;
    private $senha;
    //private $login;

    public function __construct($idlogin = 0, $numvei = "", $usuario = "", $email = "", $senha = "")// Login $login = null)
    {
        //$this->setLogin($login);
        $this->setIdlogin($idlogin);
        $this->setNumvei($numvei);
        $this->setUsuario($usuario);
        $this->setEmail($email);
        $this->setSenha($senha);
    }

    // -------------------------------------------------------------------
    // CERTO
    /*public function setLogin(Login $login)
    {
        $this->login = $login;
    }*/
    public function setIdlogin($novoIdlogin)
    {
        if ($novoIdlogin < 0)
            throw new Exception("Erro: id inválido!"); //dispara uma exceção
        else
            $this->idlogin = $novoIdlogin;
    }
    public function setNumvei($novoNumvei)
    {
        if ($novoNumvei < 0)
            throw new Exception("Erro: numvei inválido!"); //dispara uma exceção
        else
            $this->numvei = $novoNumvei;
    }
    public function setUsuario($novoUsuario)
    {
        if ($novoUsuario < 0)
            throw new Exception("Erro: usuario inválido!"); //dispara uma exceção
        else
            $this->usuario = $novoUsuario;
    }
    public function setEmail($novoEmail)
    {
        if ($novoEmail < 0)
            throw new Exception("Erro: email inválido!"); //dispara uma exceção
        else
            $this->email = $novoEmail;
    }
    public function setSenha($novoSenha)
    {
        if ($novoSenha < 0)
            throw new Exception("Erro: senha inválido!"); //dispara uma exceção
        else
            $this->senha = $novoSenha;
    }

    //--------------------------------------------------------------------------
    // CERTO
    /*public function getLogin()
    {
        return $this->login;
    }*/
    public function getIdlogin()
    {
        return $this->idlogin;
    }
    public function getNumvei()
    {
        return $this->numvei;
    }
    public function getUsuario()
    {
        return $this->usuario;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getSenha()
    {
        return $this->senha;
    }

    // ------------------------------------------------------------------
    // CERTO
    public function incluir()
    {
        $sql = 'INSERT INTO usuario (numvei, usuario, email, senha)   
                     VALUES (:numvei, :usuario, :email, :senha)';
        $parametros = array(
            ':numvei' => $this->numvei,
            ':usuario' => $this->usuario,
            ':email' => $this->email,
            ':senha' => $this->senha
        );

        Database::executar($sql, $parametros);
    }

    // ------------------------------------------------------------------
    // CERTO
    public function excluir()
    {
        $sql = 'DELETE 
                  FROM usuario
                 WHERE idlogin = :idlogin';
        $parametros = array(':idlogin' => $this->idlogin);
        return Database::executar($sql, $parametros);
    }

    // ------------------------------------------------------------------
    // CERTO
    public function alterar()
    {
        $conexao = Database::getInstance();
        $sql = 'UPDATE usuario 
                   SET numvei = :numvei, usuario = :usuario, email = :email, senha = :senha;
                 WHERE idlogin = :idlogin';
        $comando = $conexao->prepare($sql);
        $comando->bindValue(':idlogin', $this->idlogin);
        $comando->bindValue(':numvei', $this->numvei);
        $comando->bindValue(':usuario', $this->usuario);
        $comando->bindValue(':email', $this->email);
        $comando->bindValue(':senha', $this->senha);

        // ------------------------------------------------------------------
        // SEM UTILIDADE
        /*
        try{
            $comando->execute(); 
            $this->getEndereco()->alterar();
            return true;
        }catch(PDOException $e){
            throw new Exception ("Erro ao executar o comando no banco de dados: "
               .$e->getMessage()." - ".$comando->errorInfo()[2]);
        }
    */
    }

    // ------------------------------------------------------------------
    // ALTERAR

    public static function efetuarLogin($usuario, $senha){
        $conexao = Database::getInstance();
        $sql = 'SELECT * FROM usuario 
                 WHERE usuario = :usuario
                   AND senha = :senha';
        $comando = $conexao->prepare($sql); 
        $comando->bindValue(':usuario',$usuario);
        $comando->bindValue(':senha',$senha);
        if ($comando->execute()){
            while($registro = $comando->fetch()){ 
                $pessoa = new Usuario($registro['idlogin'], $registro['numvei'], $registro['usuario'], $registro['email'], $registro['senha']);
                return $pessoa;
            }
        }
        return false;
    }

    public static function listar($tipo = 0, $busca = "")
    {
        $conexao = Database::getInstance();
        $sql = "SELECT * FROM usuario";
        if ($tipo > 0)
            switch ($tipo) {
                case 1:
                    $sql .= " WHERE idlogin = :busca";
                    break;
                case 2:
                    $sql .= " WHERE usuario = :busca";
                    break;
                case 3:
                    $sql .= " WHERE numvei = :busca";
                    break;
            }

        // ------------------------------------------------------------------
        // CERTO
        $comando = $conexao->prepare($sql);
        if ($tipo > 0)
            $comando->bindValue(':busca', $busca);
        $comando->execute();
        $pessoas = array();
        while ($registro = $comando->fetch()) {
            $pessoa = new Usuario($registro['idlogin'], $registro['numvei'], $registro['email'], $registro['usuario'], $registro['senha']);
            array_push($pessoas, $pessoa);
        }
        return $pessoas;
    }
}
