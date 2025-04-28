<?php
session_start();
require '../../Funcoes/autoload/autoload.php';
$painel = new Painel();
$linhas = $painel->listar_noticias_busca();
?>