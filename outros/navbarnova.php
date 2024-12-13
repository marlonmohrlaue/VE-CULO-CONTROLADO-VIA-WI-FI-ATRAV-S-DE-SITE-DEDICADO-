<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../log_login/login.php");
}

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <img src="../img/images.jpeg" width="60" height="60" class="d-inline-block align-top" alt="Logo">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../doca/visu_doca.php">Docas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../carga/visu_carga.php">Cargas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../menu/controle.php">Controle</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../menu/index.php">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../menu/log.php">Log de ações</a>
            </li>

        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <a class="nav-link" href='../log_cad/cad.php?acao=excluir&tipobusca=1&busca=<?php echo $_SESSION['idlogin'] . "&id=" . $_SESSION['idlogin']; ?>'>Excluir cadastro</a></td></tr>
            </li>
            <li class="nav-item">
            <a class="nav-link" href='../log_cad/cad.php?acao=logoff&tipobusca=1&busca=<?php echo $_SESSION['idlogin'] . "&id=" . $_SESSION['idlogin']; ?>'>Logoff</a></td></tr>
            </li>
        </ul>
    </div>
</nav>