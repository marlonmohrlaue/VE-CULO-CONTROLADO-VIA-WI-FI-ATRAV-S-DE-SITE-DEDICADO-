<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php
    include_once('cad.php');

    if (!isset($_GET['id'])) {
        $id = 0;
    }
    ?>
    <style>
        body {
            background-color: #565656;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 17vh;
        }

        .login-form {
            width: 400px;
            margin: 0 auto;
        }

        .login-form form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
        }

        .login-form h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .login-form .form-group {
            margin-bottom: 20px;
        }

        .login-form .form-control {
            background-color: #f0f0f0;
            border: none;
            outline: none;
            border-bottom: 1px solid #ccc;
            padding: 5px;
        }

        .login-form .form-control:focus {
            border-color: #6e8095;
        }

        .login-form .btn {
            background-color: #6e8095;
            color: #fff;
            border: none;
            outline: none;
            cursor: pointer;
        }

        .login-form .btn:hover {
            background-color: #8d9ca7;
        }

        .login-form .link-btn {
            background-color: transparent;
            border: none;
            outline: none;
            cursor: pointer;
            color: #6e8095;
        }

        .login-form .link-btn:hover {
            color: #8d9ca7;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="login-form">
            <form action="cad.php" method="post">
                <h2>Cadastro</h2>
                <input type="text" class="form-control" name="id" id="id" value="<?= $id ?>" readonly hidden>
                <div class="form-group">
                    <label for="numvei">Número do veículo</label>
                    <input type="text" class="form-control" name="numvei" id="numvei" value="<?= $id ? $cargalista->getNumvei() : "" ?>" required>
                </div>
                <div class="form-group">
                    <label for="nome">Usuário</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" value="<?= $id ? $cargalista->getUsuario() : "" ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= $id ? $cargalista->getEmail() : "" ?>" required>
                </div>

                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" name="senha" id="senha" value="<?= $id ? $cargalista->getSenha() : "" ?>" required>
                </div>

                <button type="submit" class="btn btn-primary" name="acao" id="acao" value="cadastrar">Cadastrar</button>
                <button type="reset" class="btn btn-secondary">Cancelar</button>

                <a href="../log_login/index.php" class="link">Já tenho uma conta.</a>
            </form>
        </div>
    </div>
    <?php
    if (isset($_GET['erro']) && $_GET['erro'] == 1) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'Este usuário já possui um cadastro!',
            footer: 'Por favor insira um usuário diferente.'
        });
    </script>";
    }
    ?>
</body>

</html>