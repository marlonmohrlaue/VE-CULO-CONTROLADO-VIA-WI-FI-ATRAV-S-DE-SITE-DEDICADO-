
<?php

session_start();

if (!isset($_SESSION['idlogin'])) {
    
    header('location: ../log_login/index.php');
    exit;
}
