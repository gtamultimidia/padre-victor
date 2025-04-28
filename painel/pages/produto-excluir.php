<?php
session_start();
require '../../Funcoes/autoload/autoload.php';
$painel = new Painel();
$painel->excluirProduto($_GET['id']);
?>