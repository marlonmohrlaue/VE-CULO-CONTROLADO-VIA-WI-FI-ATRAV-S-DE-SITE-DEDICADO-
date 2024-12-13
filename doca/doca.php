<?php
require_once("../classes/Usuario.class.php");
require_once("../classes/Database.class.php");
require_once("../classes/Doca.class.php");
require_once("../classes/Carga.class.php");
require_once("../classes/Log.class.php");
include("../outros/navbarnova.php");


// session_start();
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$msg = isset($_GET['MSG']) ? $_GET['MSG'] : "";

if ($id > 0)
    $docalista = Doca::listar(2, $id)[0];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $nome = isset($_POST['nome']) ? $_POST['nome'] : 0;
    $cpres = isset($_POST['cpres']) ? $_POST['cpres'] : "";
    $cmax = isset($_POST['cmax']) ? $_POST['cmax'] : "";
    $local = isset($_POST['local']) ? $_POST['local'] : "";
    $acao = isset($_POST['acao']) ? $_POST['acao'] : 0;

    $usu = Usuario::listar(1, $_SESSION['idlogin'])[0];
    $doca = new Doca($id, $nome, $cpres, $cmax, $local, $usu);

    try {

        // $medida = Medida::listar(1, $email)[0];
        // $doca = new doca($id, $nome, $usuario, $medida);
        $resultado = "";
        if ($acao == 'salvar') {
            if ($id > 0) {
                $resultado = $doca->alterar();
                Log::registrar("Alteração", "Doca", "ID: $id, Nome: $nome, Local: $local", $_SESSION['idlogin']);
            } else {
                $resultado = $doca->incluir();
                Log::registrar("Inclusão", "Doca", "ID: $id,Nome: $nome, Local: $local", $_SESSION['idlogin']);
            }
            header('Location: visu_doca.php');
        } elseif ($acao == 'excluir') {
            Log::registrar("Exclusão", "Doca", "ID: $id, Nome: $nome", $_SESSION['idlogin']);
            $resultado = $doca->excluir();

            header('Location: visu_doca.php');
        }
    } catch (Exception $e) {
        header('Location:index.php?MSG=ERROR:' . $e->getMessage());
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //SEM USO ATUALMENTE
    $busca = isset($_GET['busca']) ? $_GET['busca'] : "";
    $tipobusca = isset($_GET['tipobusca']) ? $_GET['tipobusca'] : 0;
    $acao = isset($_GET['acao']) ? $_GET['acao'] : 0;
    $lista = Doca::listar($tipobusca, $busca);

    if ($acao == 'excluir') {
        Log::registrar("Exclusão", "Doca", "ID: $id, Nome: $nome", $_SESSION['idlogin']);
        $resultado = $lista[0]->excluir();
        header('Location:visu_doca.php');
    }
}
