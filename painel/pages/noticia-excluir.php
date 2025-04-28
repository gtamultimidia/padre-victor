<?php
session_start();
require '../../Funcoes/autoload/autoload.php';
$painel = new Painel();
$painel->excluir_noticia($_GET['id']);
?>