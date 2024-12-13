<?php
require_once("../classes/Database.class.php");
class Log
{
    private $id;
    private $acao;
    private $entidade;
    private $dados;
    private $usuario;
    private $dataHora;

    // Construtor
    public function __construct($id, $acao, $entidade, $dados, $usuario, $dataHora)
    {
        $this->id = $id;
        $this->acao = $acao;
        $this->entidade = $entidade;
        $this->dados = $dados;
        $this->usuario = $usuario;
        $this->dataHora = $dataHora;
    }

    // Métodos getters (se necessário)

    public function getId()
    {
        return $this->id;
    }

    public function getAcao()
    {
        return $this->acao;
    }

    public function getEntidade()
    {
        return $this->entidade;
    }

    public function getDados()
    {
        return $this->dados;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getDataHora()
    {
        return $this->dataHora;
    }

    // Método estático para registrar um log no banco de dados
    public static function registrar($acao, $entidade, $dados, $usuario)
    {
        // Atribuindo a data e hora no momento do registro, se não fornecido
        date_default_timezone_set('America/Sao_Paulo');
        $dataHora = date('Y-m-d H:i:s');  // Data e hora atual

        // SQL de inserção
        $sql = 'INSERT INTO logs (acao, entidade, dados, usuario, data_hora)   
            VALUES (:acao, :entidade, :dados, :usuario, :data_hora)';

        // Definindo os parâmetros
        $parametros = array(
            ':acao' => $acao,
            ':entidade' => $entidade,
            ':dados' => $dados,
            ':usuario' => $usuario,
            ':data_hora' => $dataHora
        );

        // Chama a função para executar o SQL
        Database::executar($sql, $parametros);
    }

    // Método estático para recuperar os logs do banco de dados
    public static function listar($tipo = 0, $busca = "")
    {
        // Obtém a conexão com o banco de dados
        $conexao = Database::getInstance();

        // SQL inicial para buscar todos os logs
        $sql = "SELECT * FROM logs";

        // Verifica o tipo de busca e adiciona a condição correta
        if ($tipo > 0) {
            switch ($tipo) {
                case 1:
                    // Busca por ação
                    $sql .= " WHERE acao LIKE :busca";
                    break;
                case 2:
                    // Busca por entidade
                    $sql .= " WHERE entidade LIKE :busca";
                    break;
                case 3:
                    // Busca por usuário
                    $sql .= " WHERE usuario = :busca";
                    break;
                case 4:
                    // Busca por dados (parcial)
                    $sql .= " WHERE dados LIKE :busca";
                    break;
                default:
                    break;
            }
        }

        // Prepara o comando SQL
        $comando = $conexao->prepare($sql);
        if ($tipo > 0)
            $comando->bindValue(':busca', $busca);
        $comando->execute();
        $logs = array();

        // Itera pelos registros encontrados
        while ($registro = $comando->fetch()) {
            $log = new Log(
                $registro['id'],
                $registro['acao'],
                $registro['entidade'],
                $registro['dados'],
                $registro['usuario'],
                $registro['data_hora']  // Agora a dataHora é recuperada do banco
            );
            array_push($logs, $log);
        }

        return $logs;
    }
}
