<?php
require_once("../classes/Database.class.php");
require_once("../classes/Usuario.class.php");

// -------------------------------------------------------------------
// CERTO
class Doca
{
    private $iddoca;
    private $nome;
    private $cpres;
    private $cmax;
    private $local;
    private $idlogin;

    public function __construct($iddoca = 0, $nome = "", $cpres = "", $cmax = 0, $local = "", Usuario $idlogin = null)
    {
        $this->setIddoca($iddoca);
        $this->setNome($nome);
        $this->setCpres($cpres);
        $this->setCmax($cmax);
        $this->setLocal($local);
        $this->setIdlogin($idlogin);
    }

    // -------------------------------------------------------------------
    // VERIFICAR LOGIN

    public function setIdlogin(Usuario $idlogin)
    {
        $this->idlogin = $idlogin;
    }
    public function setIddoca($novoId)
    {
        if ($novoId < 0)
            throw new Exception("Erro: id inválido!"); //dispara uma exceção
        else
            $this->iddoca = $novoId;
    }
    public function setNome($novoNome)
    {
        if ($novoNome == "")
            throw new Exception("Erro: nome inválido!"); //dispara uma exceção
        else
            $this->nome = $novoNome;
    }
    public function setCpres($novoCpres)
    {
        $this->cpres = $novoCpres;
    }
    public function setCmax($novoCmax)
    {
        if ($novoCmax < 0)
            throw new Exception("Erro: cmax inválido!"); //dispara uma exceção
        else
            $this->cmax = $novoCmax;
    }
    public function setLocal($novoLocal)
    {
        if ($novoLocal < 0)
            throw new Exception("Erro: local inválido!"); //dispara uma exceção
        else
            $this->local = $novoLocal;
    }

    // -------------------------------------------------------------------
    // VERIFICAR LOGIN

    public function getIdlogin()
    {
        return $this->idlogin;
    }
    public function getIddoca()
    {
        return $this->iddoca;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getCpres()
    {
        return $this->cpres;
    }
    public function getCmax()
    {
        return $this->cmax;
    }
    public function getLocal()
    {
        return $this->local;
    }

    // -------------------------------------------------------------------
    //CERTO

    public function incluir()
    {
        $sql = 'INSERT INTO doca (nome, cpres, cmax, local, idlogin)   
                     VALUES (:nome, :cpres, :cmax, :local, :idlogin)';
        $parametros = array(
            ':nome' => $this->nome,
            ':cpres' => $this->cpres, //PEGAR TODAS AS CARGAS DENTRO
            ':cmax' => $this->cmax,
            ':local' => $this->local,
            ':idlogin' => $this->getIdlogin()->getIdlogin()
        );

        Database::executar($sql, $parametros);

        // ALTERAR -- EXIBIR CARGA
        /*
        $this->usuario->setIddoca(Database::$lastId);
        $this->usuario->incluir();
        */
    }

    // ------------------------------------------------------------------
    // CERTO
    public function excluir()
    {
        $sql = 'DELETE 
                  FROM doca
                 WHERE iddoca = :iddoca';
        $parametros = array(':iddoca' => $this->iddoca);
        return Database::executar($sql, $parametros);
    }


    // ------------------------------------------------------------------
    // CERTO
    public function alterar()
    {

        $sql = 'UPDATE doca 
                   SET nome = :nome, cpres = :cpres, cmax = :cmax, local = :local, idlogin = :idlogin
                 WHERE iddoca = :iddoca';
        $parametros = array(
            ':iddoca' => $this->getIddoca(),
            ':nome' => $this->getNome(),
            ':cpres' => $this->getCpres(),
            ':cmax' => $this->getCmax(),
            ':local' => $this->getLocal(),
            ':idlogin' => $this->getIdlogin()->getIdlogin()
        );
        Database::executar($sql, $parametros);
        return true;

        /*$conexao = Database::getInstance();
        $sql = 'UPDATE usuario 
                   SET nome = :nome, cpres = :cpres, cmax = :cmax, local = :local, idlogin = :idlogin;
                 WHERE iddoca = :iddoca';
        $comando = $conexao->prepare($sql);
        $comando->bindValue(':iddoca', $this->iddoca);
        $comando->bindValue(':nome', $this->nome);
        $comando->bindValue(':cpres', $this->cpres);
        $comando->bindValue(':cmax', $this->cmax);
        $comando->bindValue(':local', $this->local);
        $comando->bindValue(':idlogin', $this->idlogin->getIdlogin());*/

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
        $sql = "SELECT * FROM doca";

        // Verifica o tipo de busca e adiciona a condição correta
        if ($tipo > 0) {
            switch ($tipo) {
                case 1:
                    $sql .= " WHERE idlogin = :busca";  // Corrigido de idlogin para idlogin
                    break;
                case 2:
                    $sql .= " WHERE iddoca = :busca";
                    break;
            }
        }

        // Prepara o comando SQL
        $comando = $conexao->prepare($sql);

        // Vincula o valor de busca, se houver
        if ($tipo > 0) {
            $comando->bindValue(':busca', $busca);
        }

        // Executa a consulta
        $comando->execute();

        // Cria um array para armazenar os resultados
        $docas = array();

        // Itera pelos registros encontrados
        while ($registro = $comando->fetch()) {
            // Chama a função listar de Usuario usando a coluna correta 'idlogin'
            $pessoa = Usuario::listar(1, $registro['idlogin'])[0];

            // Cria uma instância da classe Doca com os dados retornados
            $doca = new Doca($registro['iddoca'], $registro['nome'], $registro['cpres'], $registro['cmax'], $registro['local'], $pessoa);

            // Adiciona ao array de resultados
            array_push($docas, $doca);
        }

        // Retorna o array com os resultados
        return $docas;
    }
}
