<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Logs</title>
    <?php
    require_once("../classes/Log.class.php");
    include("../outros/navbarnova.php");
    ?>
    <!-- Link do CSS do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-center">Listagem de Logs</h1>
        </div>

        <!-- Tabela estilizada -->
        <table class="table table-bordered table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Ação</th>
                    <th>Entidade</th>
                    <th>Dados</th>
                    <th>Usuário</th>
                    <th>Data/Hora</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Listagem de logs
                $dados = Log::listar();  // Obtém os logs registrados

                if (empty($dados)) {
                    echo "<tr><td colspan='6' class='text-center'>Nenhum registro encontrado.</td></tr>";
                } else {
                    foreach ($dados as $dado) {
                        echo "<tr>
                                <td>" . $dado->getId() . "</td>
                                <td>" . $dado->getAcao() . "</td>
                                <td>" . $dado->getEntidade() . "</td>
                                <td>" . $dado->getDados() . "</td>
                                <td>" . $dado->getUsuario() . "</td>
                                <td>" . $dado->getDataHora() . "</td>
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
