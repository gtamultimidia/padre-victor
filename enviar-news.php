<?php
require_once 'Funcoes/autoload/autoload.php';
$funcoes = new Funcoes();
$email = $_POST['email'];
if($funcoes->validar_email($email) == TRUE){

    $msg  = "<b>E-mail: </b>" . $email . "<br><br>";
    $msg .= "Newsletter - Café Padre Victor";
    //$msg = '=?UTF-8?B?'.base64_encode($msg).'?=';

    $html = $msg;


    // Define destinatario e subject
    $ass = "Newsletter - Café Padre Victor";
    $destinatario ='webmaster@gtamultimidia.com.br';
    $copia = array();
    $copia[] = 'william@gtamultimidia.com.br';
    $from = "Café Padre Victor";
    
    $enviado = $funcoes->dadosEnvio($ass, $from, $destinatario, $html, $copia);

    if ($enviado) {
        echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
        echo "<script type='text/javascript'> alert('E-mail cadastrado com sucesso!'); </script>";
    } else {
        echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
        echo "<script type='text/javascript'> alert('Falha ao cadastrar e-mail!'); </script>";
    }
}else{
    echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
    echo "<script type='text/javascript'> alert('Por favor, insira um e-mail válido!'); </script>";
}
?>


