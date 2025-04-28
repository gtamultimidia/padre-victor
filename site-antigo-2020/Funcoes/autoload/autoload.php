<?php
// funcao que carrega as classes automaticamente
function __autoload($Class) {
    $dominio = $_SERVER['HTTP_HOST'];
    $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
    if((strpos($url, 'painel') !== FALSE) || (strpos($url, 'pages') !== FALSE) || (strpos($url, 'adm') !== FALSE)){
        $dirName = ((strpos($url, 'pages') !== FALSE) ? '../../Funcoes' : '../Funcoes');
    }else{
        $dirName = 'Funcoes';
    }
    //verifica a existencia da classe
    if (file_exists("{$dirName}/{$Class}.php")):
        //busca dentro da pasta class a classe necessaria...
        require("{$dirName}/{$Class}.php");
    else:
        die("Erro ao incluir: {$dirName}/{$Class}.php");
    endif;
}

?>