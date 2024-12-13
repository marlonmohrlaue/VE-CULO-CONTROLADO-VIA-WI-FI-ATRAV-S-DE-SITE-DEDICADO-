<!DOCTYPE html>
<html lang="en">
<?php
include_once('doca.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Tg7P9hTu8Z9VxZ1Wxh+xKu6Mq8/EH5UEGg1ETH3w20C5ewOC5ddKVo94QmjxLt6r" crossorigin="anonymous">
    <title>Cadastro de Doca</title>
</head>

<body>

    <main class="container mt-5">
        <form action="doca.php" method="post">
            <fieldset>
                <legend class="mb-4">Cadastro de Doca</legend>

                <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" class="form-control" name="id" id="id" value="<?= $id ?>" readonly>
                </div>


                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" value="<?= $id ? $docalista->getNome() : "" ?>" required>
                </div>


                <div class="mb-3">
                    <label for="cmax" class="form-label">Capacidade Máxima</label>
                    <input type="text" class="form-control" name="cmax" id="cmax" value="<?= $id ? $docalista->getCmax() : 0 ?>" required>
                </div>

                <div class="mb-3">
                    <label for="local" class="form-label">Localização:</label>
                    <select class="form-select" id="local" name="local">
                        <option selected disabled>Escolha um local</option>
                        <option value="AC" <?php if ($id) if ($docalista->getLocal() == "AC") echo "selected"; ?>>Acre</option>
                        <option value="AL" <?php if ($id) if ($docalista->getLocal() == "AL") echo "selected"; ?>>Alagoas</option>
                        <option value="AP" <?php if ($id) if ($docalista->getLocal() == "AP") echo "selected"; ?>>Amapá</option>
                        <option value="AM" <?php if ($id) if ($docalista->getLocal() == "AM") echo "selected"; ?>>Amazonas</option>
                        <option value="BA" <?php if ($id) if ($docalista->getLocal() == "BA") echo "selected"; ?>>Bahia</option>
                        <option value="CE" <?php if ($id) if ($docalista->getLocal() == "CE") echo "selected"; ?>>Ceará</option>
                        <option value="DF" <?php if ($id) if ($docalista->getLocal() == "DF") echo "selected"; ?>>Distrito Federal</option>
                        <option value="ES" <?php if ($id) if ($docalista->getLocal() == "ES") echo "selected"; ?>>Espírito Santo</option>
                        <option value="GO" <?php if ($id) if ($docalista->getLocal() == "GO") echo "selected"; ?>>Goiás</option>
                        <option value="MA" <?php if ($id) if ($docalista->getLocal() == "MA") echo "selected"; ?>>Maranhão</option>
                        <option value="MT" <?php if ($id) if ($docalista->getLocal() == "MT") echo "selected"; ?>>Mato Grosso</option>
                        <option value="MS" <?php if ($id) if ($docalista->getLocal() == "MS") echo "selected"; ?>>Mato Grosso do Sul</option>
                        <option value="MG" <?php if ($id) if ($docalista->getLocal() == "MG") echo "selected"; ?>>Minas Gerais</option>
                        <option value="PA" <?php if ($id) if ($docalista->getLocal() == "PA") echo "selected"; ?>>Pará</option>
                        <option value="PB" <?php if ($id) if ($docalista->getLocal() == "PB") echo "selected"; ?>>Paraíba</option>
                        <option value="PR" <?php if ($id) if ($docalista->getLocal() == "PR") echo "selected"; ?>>Paraná</option>
                        <option value="PE" <?php if ($id) if ($docalista->getLocal() == "PE") echo "selected"; ?>>Pernambuco</option>
                        <option value="PI" <?php if ($id) if ($docalista->getLocal() == "PI") echo "selected"; ?>>Piauí</option>
                        <option value="RJ" <?php if ($id) if ($docalista->getLocal() == "RJ") echo "selected"; ?>>Rio de Janeiro</option>
                        <option value="RN" <?php if ($id) if ($docalista->getLocal() == "RN") echo "selected"; ?>>Rio Grande do Norte</option>
                        <option value="RS" <?php if ($id) if ($docalista->getLocal() == "RS") echo "selected"; ?>>Rio Grande do Sul</option>
                        <option value="RO" <?php if ($id) if ($docalista->getLocal() == "RO") echo "selected"; ?>>Rondônia</option>
                        <option value="RR" <?php if ($id) if ($docalista->getLocal() == "RR") echo "selected"; ?>>Roraima</option>
                        <option value="SC" <?php if ($id) if ($docalista->getLocal() == "SC") echo "selected"; ?>>Santa Catarina</option>
                        <option value="SP" <?php if ($id) if ($docalista->getLocal() == "SP") echo "selected"; ?>>São Paulo</option>
                        <option value="SE" <?php if ($id) if ($docalista->getLocal() == "SE") echo "selected"; ?>>Sergipe</option>
                        <option value="TO" <?php if ($id) if ($docalista->getLocal() == "TO") echo "selected"; ?>>Tocantins</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" name="acao" id="acao" value="salvar">Salvar</button>
                <button type="reset" class="btn btn-secondary">Cancelar</button>
                <a href="visu_doca.php">Visualizar</a>
            </fieldset>


        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-e50C1O6A45Zjtl6uI5zdBMIJQfsqWdWsQFjGgOg15pP2szktz7Rq4CLlu7YBXDe" crossorigin="anonymous"></script>
</body>

</html>