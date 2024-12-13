<!DOCTYPE html>
<html lang="en">
<?php
include_once('carga.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Tg7P9hTu8Z9VxZ1Wxh+xKu6Mq8/EH5UEGg1ETH3w20C5ewOC5ddKVo94QmjxLt6r" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Cadastro de Carga</title>
</head>

<body>

    <main class="container mt-5">
        <form action="carga.php" method="post">
            <fieldset>
                <legend class="mb-4">Cadastro de Carga</legend>

                <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" class="form-control" name="id" id="id" value="<?= $id ?>" readonly>
                </div>


                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" value="<?= $id ? $cargalista->getNome() : "" ?>" required>
                </div>


                <div class="mb-3">
                    <label for="conteudo" class="form-label">Conteudo
                        <input type="text" class="form-control" name="conteudo" id="conteudo" value="<?= $id ? $cargalista->getConteudo() : "" ?>" required>
                </div>


                <div class="mb-3">
                    <label for="peso" class="form-label">Peso</label>
                    <input type="text" class="form-control" name="peso" id="peso" value="<?= $id ? $cargalista->getPeso() : 0 ?>" required>
                </div>


                <div class="mb-3">
                    <label for="iddoca" class="form-label">Doca relacionada<br>
                        <select name="iddoca" id="iddoca" class="form-select" required>
                            <option value="NULL" disabled>Selecione uma doca</option>
                            <?php
                            $docas = Doca::listar(1, $_SESSION['idlogin']);
                            foreach ($docas as $opcao) {
                                echo "<option value='" . $opcao->getIddoca() . "'>" . $opcao->getNome() . "</option>";
                            }
                            ?>
                        </select>
                </div>
                <button type="submit" class="btn btn-primary" name="acao" id="acao" value="salvar">Salvar</button>
                <button type="reset" class="btn btn-secondary">Cancelar</button>

                <a href="visu_carga.php">Visualizar</a>
            </fieldset>


        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-e50C1O6A45Zjtl6uI5zdBMIJQfsqWdWsQFjGgOg15pP2szktz7Rq4CLlu7YBXDe" crossorigin="anonymous"></script>
</body>

</html>