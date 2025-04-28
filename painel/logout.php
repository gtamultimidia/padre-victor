<?php
session_start();
require '../Funcoes/autoload/autoload.php';
$login = new Login();
$login->logoutAdm();
?>