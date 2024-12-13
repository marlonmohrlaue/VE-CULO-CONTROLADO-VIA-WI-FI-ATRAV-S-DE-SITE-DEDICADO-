<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>
    <style>
        body {
            background-color: #565656;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
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
            <form action="login.php" method="post">
                <h2>Login</h2>
                <div class="form-group">
                    <label for="Usuário">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario">
                </div>
                <div class="form-group">
                    <label for="Senha">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha">
                </div>

                <button type="submit" class="btn">Enviar</button>
                <a href="../log_cad/cadastro.php" class="link">Não tenho uma conta.</a>
            </form>
        </div>

    </div>
    <?php
    if (isset($_GET['erro']) && $_GET['erro'] == 1) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: 'Login inválido!',
            footer: 'Usuário/senha inválidos.'
        });
    </script>";
    }
    ?>
</body>

</html>