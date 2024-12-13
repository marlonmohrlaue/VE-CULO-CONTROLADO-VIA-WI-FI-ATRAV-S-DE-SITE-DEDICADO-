<?php
require_once("../classes/Database.class.php");
require_once("../classes/Doca.class.php");

// -------------------------------------------------------------------
// CERTO
class Carga
{
    private $idcarga;
    private $nome;
    private $conteudo;
    private $peso;
    private $iddoca;

    public function __construct($idcarga = 0, $nome = "", $conteudo = "", $peso = 0, Doca $iddoca = null)
    {
        $this->setIdcarga($idcarga);
        $this->setNome($nome);
        $this->setConteudo($conteudo);
        $this->setPeso($peso);
        $this->setIddoca($iddoca);
    }

    // -------------------------------------------------------------------
    // VERIFICAR LOGIN

    public function setIddoca(Doca $iddoca)
    {
        $this->iddoca = $iddoca;
    }
    public function setIdcarga($novoIdcarga)
    {
        if ($novoIdcarga < 0)
            throw new Exception("Erro: idcarga inválidcargao!"); //dispara uma exceção
        else
            $this->idcarga = $novoIdcarga;
    }
    public function setNome($novoNome)
    {
        if ($novoNome < 0)
            throw new Exception("Erro: nome inválido!"); //dispara uma exceção
        else
            $this->nome = $novoNome;
    }
    public function setConteudo($novoConteudo)
    {
        if ($novoConteudo < 0)
            throw new Exception("Erro: conteudo inválido!"); //dispara uma exceção
        else
            $this->conteudo = $novoConteudo;
    }
    public function setPeso($novoPeso)
    {
        if ($novoPeso < 0)
            throw new Exception("Erro: Peso inválido!"); //dispara uma exceção
        else
            $this->peso = $novoPeso;
    }

    // -------------------------------------------------------------------
    // VERIFICAR LOGIN

    public function getIddoca()
    {
        return $this->iddoca;
    }
    public function getIdcarga()
    {
        return $this->idcarga;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getConteudo()
    {
        return $this->conteudo;
    }
    public function getPeso()
    {
        return $this->peso;
    }

    // -------------------------------------------------------------------
    //CERTO

    public function incluir()
    {
        $sql = 'INSERT INTO carga (nome, conteudo, peso, iddoca)   
                     VALUES (:nome, :conteudo, :peso, :iddoca)';
        $parametros = array(
            ':nome' => $this->nome,
            ':conteudo' => $this->conteudo,
            ':peso' => $this->peso,
            ':iddoca' => $this->getIddoca()->getIddoca()
        );

        Database::executar($sql, $parametros);

        // ALTERAR -- EXIBIR CARGA
        /*
        $this->carga->setIddoca(Database::$lastId);
        $this->carga->incluir();
        */
    }

    // ------------------------------------------------------------------
    // CERTO
    public function excluir()
    {
        $sql = 'DELETE 
                  FROM carga
                 WHERE idcarga = :idcarga';
        $parametros = array(':idcarga' => $this->idcarga);
        return Database::executar($sql, $parametros);
    }


    // ------------------------------------------------------------------
    // CERTO
    public function alterar()
    {

        $sql = 'UPDATE carga 
                   SET nome = :nome, conteudo = :conteudo, peso = :peso, iddoca = :iddoca
                 WHERE idcarga = :idcarga';
        $parametros = array(':idcarga'=>$this->getIdcarga(),
                        ':nome'=>$this->getNome(),
                        ':conteudo'=>$this->getConteudo(),
                        ':peso'=>$this->getPeso(),
                        ':iddoca'=>$this->getIddoca()->getIddoca());
        Database::executar($sql, $parametros);
        return true;


        /*$conexao = Database::getInstance();
        $sql = 'UPDATE carga 
                   SET nome = :nome, conteudo = :conteudo, peso = :peso, iddoca = :iddoca;
                 WHERE idcarga = :idcarga';
        $comando = $conexao->prepare($sql);
        $comando->bindValue(':idcarga', $this->idcarga);
        $comando->bindValue(':nome', $this->nome);
        $comando->bindValue(':conteudo', $this->conteudo);
        $comando->bindValue(':peso', $this->peso);
        $comando->bindValue(':iddoca', $this->iddoca->getIddoca());*/

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
    public static function listar($tipo = 0, $busca = "")
    {
        $conexao = Database::getInstance();
        $sql = "SELECT * FROM carga";
        if ($tipo > 0)
            switch ($tipo) {
                case 1:
                    $sql .= " WHERE iddoca = :busca";
                    break;
                case 2:
                    $sql .= " WHERE idcarga = :busca";
                    break;
            }

        // ------------------------------------------------------------------
        // CERTO
        $comando = $conexao->prepare($sql);
        if ($tipo > 0)
            $comando->bindValue(':busca', $busca);
        $comando->execute();
        $cargas = array();
        while ($registro = $comando->fetch()) {
            $doca = Doca::listar(2, $registro['iddoca'])[0];
            $carga = new Carga($registro['idcarga'], $registro['nome'], $registro['conteudo'], $registro['peso'], $doca);
            array_push($cargas, $carga);
        }
        return $cargas;
    }
}
