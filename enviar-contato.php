<?php
require_once 'Funcoes/autoload/autoload.php';
$funcoes = new Funcoes();
$email = $_POST['email'];
if($funcoes->validar_email($email) == TRUE){

	$funcoes->verifyReCAPTCHA("index");

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];
    
    $msg  = "<b>Nome: </b>" . $nome . "<br>";
    $msg .= "<b>Telefone: </b>" . $telefone . "<br>";
    $msg .= "<b>E-mail: </b>" . $email . "<br>";
    $msg .= "<b>Assunto: </b>" . $assunto . "<br>";
    $msg .= "<b>Mensagem: </b>" . $mensagem . "<br><br>";
    $msg .= "Contato Site - Café Padre Victor";
    //$msg = '=?UTF-8?B?'.base64_encode($msg).'?=';

    $html = $msg;


    // Define destinatario e subject
    $ass = "Contato Site - Café Padre Victor";
    $destinatario = 'atendimento@padrevictorcafe.com.br'; 
    $copia = array();
    $copia[] = 'webmaster@gtamultimidia.com.br';
    $from = "Café Padre Victor";
    
    $enviado = $funcoes->dadosEnvio($ass, $from, $destinatario, $html, $copia);

    if ($enviado) {
        echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
        echo "<script type='text/javascript'> alert('Mensagem enviada, em breve entraremos em contato!'); </script>";
    } else {
        echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
        echo "<script type='text/javascript'> alert('Falha ao enviar mensagem!'); </script>";
    }
}else{
    echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
    echo "<script type='text/javascript'> alert('Por favor, insira um e-mail válido!'); </script>";
}
?>


