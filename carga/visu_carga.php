<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Cargas</title>
    <!-- Link do CSS do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <?php
    include('carga.php');
    ?>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-center">Listagem de Cargas</h1>
            <!-- Botão de adicionar nova carga -->
            <a href="addCarga.php" class="btn btn-success">Adicionar Nova Carga</a>
        </div>

        <!-- Tabela estilizada -->
        <table class="table table-bordered table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Conteúdo</th>
                    <th>Peso</th>
                    <th>Doca</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Listagem e Pesquisa
                foreach ($lista as $carga) {
                    echo "<tr>
                        <td><a href='addCarga.php?id=" . $carga->getIdcarga() . "'>" . $carga->getIdcarga() . "</a></td>
                        <td>" . $carga->getNome() . "</td>
                        <td>" . $carga->getConteudo() . "</td>
                        <td>" . $carga->getPeso() . "</td>
                        <td>" . $carga->getIddoca()->getNome() . "</td>
                        <td><a href='carga.php?acao=excluir&tipobusca=2&busca=" . $carga->getIdcarga() . "&id=" . $carga->getIdcarga() . "' class='btn btn-danger btn-sm'>Excluir</a></td>
                    </tr>";
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
