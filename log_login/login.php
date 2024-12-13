<?php

/** Controle de Pessoa */

require_once("../classes/Usuario.class.php");
require_once("../classes/Doca.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario =  isset($_POST['usuario']) ? $_POST['usuario'] : 0;
    $senha =  isset($_POST['senha']) ? $_POST['senha'] : 0;

    try {
        // criar o objeto Pessoa que irá persistir os dados 
        $usu = Usuario::efetuarLogin($usuario, $senha);
        if ($usu) {
            session_start();
            var_dump($usu);
            $_SESSION['idlogin'] = $usu->getIdlogin();
            $_SESSION['usuario'] = $usu->getUsuario();
            header('location: ../menu/index.php');
            echo $_SESSION['iddoca'];
        } else {
            header('location: index.php?erro=1');
            echo "Erro ao Efetuar login";
        }
    } catch (Exception $e) { // caso ocorra algum erro na validação das regras de negócio dispara uma exceção
        header('location: index.php?MSG=Erro: ' . $e->getMessage()); // direciona para o incio com a mensagem de erro
    }
}
