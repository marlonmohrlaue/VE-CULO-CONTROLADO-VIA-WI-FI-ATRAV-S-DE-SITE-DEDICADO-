<!DOCTYPE html>
<html lang="pt-BR"> <!-- Ajustado para pt-BR, caso esteja em português -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Veículo Autônomo</title> <!-- Título mais descritivo -->
    <?php
    //session_start(); // Inicia a sessão, necessário se houver manipulação de sessões
    include("../outros/navbarnova.php"); // Inclui o navbar
    require_once("../classes/Doca.class.php"); // Inclui a classe Doca

    // Verifica se o idlogin está definido na sessão antes de prosseguir
    if (isset($_SESSION['idlogin'])) {
        $_SESSION['iddoca'] = Doca::listar(1, $_SESSION['idlogin']); // Atribui o resultado da função listar à sessão
    } else {
        echo "<p>Erro: Usuário não autenticado.</p>"; // Mensagem de erro se idlogin não estiver na sessão
        exit(); // Interrompe a execução para evitar falhas no código
    }
    ?>
</head>

<body>
    <div class="container mt-5">

        <h1>Projeto Veículo Autônomo</h1>
        <div class="container mt-3">
            <p>
                Este projeto foca no desenvolvimento de um veículo controlado remotamente via Wi-Fi, utilizando um site dedicado, desenvolvido em PHP, para enviar
                comandos de direção. Embora ainda em fase de planejamento, já contamos com os componentes necessários para a construção do protótipo.
                O controle do veículo será realizado através de um teclado, com a comunicação facilitada por C++ e a tecnologia Wi-Fi.
            </p>
            <p>
                Nosso objetivo é criar uma solução que, no futuro, possa ser aplicada em ambientes industriais para a realocação de itens de estoque.
                A proposta visa otimizar processos logísticos, reduzindo a necessidade de mão de obra, melhorando a segurança e aumentando a
                eficiência nas operações. A automação proporcionada pelo projeto não apenas facilitará o controle remoto do veículo, mas também
                contribuirá para a modernização dos processos industriais, promovendo maior acessibilidade e economia operacional.
            </p>
            <h5>Obrigado pela atenção!</h5>
        </div>
    </div>



</body>

</html>