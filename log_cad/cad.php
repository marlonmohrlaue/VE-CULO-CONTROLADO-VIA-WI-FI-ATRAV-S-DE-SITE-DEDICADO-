<?php
require_once("../classes/Usuario.class.php");
require_once("../classes/Database.class.php");

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$msg = isset($_GET['MSG']) ? $_GET['MSG'] : "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $numvei = isset($_POST['numvei']) ? $_POST['numvei'] : "";
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
    $acao = isset($_POST['acao']) ? $_POST['acao'] : 0;

    $lista = Usuario::listar(2, $usuario);
    if (count($lista) > 0) {
        // O $numvei já existe, não permitir cadastro
        header('Location:cadastro.php?erro=1');
        exit;
    }
    /*while ($numvei != $lista) {
        echo "diferente";
    } */
    echo "morreu";
    $usu = new Usuario($id, $numvei, $usuario, $email, $senha);

    try {
        $resultado = "";
        if ($acao == 'cadastrar') {
            if ($id > 0) {
                $resultado = $usu->alterar();
                //header('Location:index.php');
                header('Location:../log_login/index.php');
            } else {
                $resultado = $usu->incluir();
                //header('Location:index.php');
                header('Location:../log_login/index.php');
            }
            $_SESSION['MSG'] = "Dados inseridos/Alterados com sucesso!";
        } elseif ($acao == 'excluir') {
            $resultado = $usu->excluir();
        }
    } catch (Exception $e) {
        header('Location:index.php?MSG=ERROR:' . $e->getMessage());
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //SEM USO ATUALMENTE
    $busca = isset($_GET['busca']) ? $_GET['busca'] : "";
    $tipobusca = isset($_GET['tipobusca']) ? $_GET['tipobusca'] : 0;
    $acao = isset($_GET['acao']) ? $_GET['acao'] : 0;
    $lista = Usuario::listar($tipobusca, $busca);

    if ($acao == 'excluir') {
        $resultado = $lista[0]->excluir();
        header('Location:../log_login/index.php');
    }
    if ($acao == 'logoff') {
        session_unset();
        session_destroy();
        header('Location:../log_login/index.php');
    }
}
