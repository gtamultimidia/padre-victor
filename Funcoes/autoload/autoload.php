<?php
// função que carrega as classes automaticamente
spl_autoload_register(function ($Class) {
    $dominio = $_SERVER['HTTP_HOST'];
    $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];

    if ((strpos($url, 'painel') !== false) || (strpos($url, 'pages') !== false) || (strpos($url, 'adm') !== false)) {
        $dirName = ((strpos($url, 'pages') !== false) ? '../../Funcoes' : '../Funcoes');
    } else {
        $dirName = 'Funcoes';
    }

    // verifica a existência da classe
    if (file_exists("{$dirName}/{$Class}.php")) {
        require("{$dirName}/{$Class}.php");
    } else {
        die("Erro ao incluir: {$dirName}/{$Class}.php");
    }
});
?>
