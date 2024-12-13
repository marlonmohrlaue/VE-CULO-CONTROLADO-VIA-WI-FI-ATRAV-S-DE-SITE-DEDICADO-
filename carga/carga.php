<?php
require_once("../classes/Carga.class.php");
require_once("../classes/Database.class.php");
require_once("../classes/Doca.class.php");
require_once("../classes/Log.class.php");
include("../outros/navbarnova.php");


// session_start();
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$msg = isset($_GET['MSG']) ? $_GET['MSG'] : "";

if ($id > 0)
    $cargalista = Carga::listar(2, $id)[0];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $nome = isset($_POST['nome']) ? $_POST['nome'] : 0;
    $conteudo = isset($_POST['conteudo']) ? $_POST['conteudo'] : "";
    $peso = isset($_POST['peso']) ? $_POST['peso'] : "";
    $acao = isset($_POST['acao']) ? $_POST['acao'] : 0;

    $iddoca = isset($_POST['iddoca']) ? $_POST['iddoca'] : "";
    $docas = Doca::listar(2, $iddoca)[0];


    $carga = new Carga($id, $nome, $conteudo, $peso, $docas);

    try {

        // $medida = Medida::listar(1, $email)[0];
        // $carga = new carga($id, $nome, $usuario, $medida);
        $resultado = "";
        if ($acao == 'salvar') {
            if ($id > 0) {
                $resultado = $carga->alterar();
               Log::registrar("Alteração", "Carga", "ID: $id, Nome: $nome, Conteúdo: $conteudo", $_SESSION['idlogin']);
            } else {
                $resultado = $carga->incluir();
                Log::registrar("Inclusão", "Carga", "ID: $id,Nome: $nome, Conteúdo: $conteudo", $_SESSION['idlogin']);
            }
            header('Location:visu_carga.php');
        } elseif ($acao == 'excluir') {
            $resultado = $carga->excluir();
            Log::registrar("Exclusão", "Carga", "ID: $id, Nome: $nome", $_SESSION['idlogin']);
            header('Location:visu_carga.php');
        }
    } catch (Exception $e) {
        header('Location:index.php?MSG=ERROR:' . $e->getMessage());
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //SEM USO ATUALMENTE
    $busca = isset($_GET['busca']) ? $_GET['busca'] : "";
    $tipobusca = isset($_GET['tipobusca']) ? $_GET['tipobusca'] : 0;
    $acao = isset($_GET['acao']) ? $_GET['acao'] : 0;
    $lista = Carga::listar($tipobusca, $busca);

    if ($acao == 'excluir') {
        Log::registrar("Exclusão", "Carga", "ID: $id, Nome: $nome", $_SESSION['idlogin']);
        $resultado = $lista[0]->excluir();
        header('Location:visu_carga.php');
    }
}
