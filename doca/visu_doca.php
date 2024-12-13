<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Docas</title>
    <!-- Link do CSS do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <?php
    include('doca.php');
    ?>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-center">Listagem de Docas</h1>
            <!-- Botão de adicionar nova doca -->
            <a href="addDoca.php" class="btn btn-success">Adicionar Nova Doca</a>
        </div>

        <!-- Tabela estilizada -->
        <table class="table table-bordered table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Carga Presente</th>
                    <th>Carga Máxima</th>
                    <th>Local</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Listagem e Pesquisa
                foreach ($lista as $doca) {
                    if ($doca->getIdlogin()->getIdlogin() == $_SESSION['idlogin']) {
                        echo "<tr>
                            <td><a href='addDoca.php?id=" . $doca->getIddoca() . "'>" . $doca->getIddoca() . "</a></td>
                            <td>" . $doca->getNome() . "</td>
                            <td>" . $doca->getCpres() . "</td>
                            <td>" . $doca->getCmax() . "</td>
                            <td>" . $doca->getLocal() . "</td>
                            <td><a href='doca.php?acao=excluir&tipobusca=2&busca=" . $doca->getIddoca() . "&id=" . $doca->getIddoca() . "' class='btn btn-danger btn-sm'>Excluir</a></td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Link do JS do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
