<?php

class Funcoes{

    public function ativo($ativa){
        $dominio = $_SERVER['HTTP_HOST'];
        $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
        if(strpos($url, $ativa)){
            echo 'class="ativo"';
        }
        if($ativa == "index.php"){
            if(strpos($url, ".php") == FALSE){
                echo 'class="ativo"';
            }
        }
    }
    
    public function retornaBase(){
        $base = "http://" . $_SERVER['SERVER_NAME']."/";
        if(strpos($base, 'localhost')){
            $base = 'http://localhost/site%20cafe%20padre%20victor/';
        }
        return $base;
    }

    public function urlAtual(){
        $dominio = $_SERVER['HTTP_HOST'];
        $url = "http://" . $dominio . $_SERVER['REQUEST_URI'];
        return $url;
    }
    
    function validar_email($email) {
        $email_final = trim($email);
        if(filter_var($email_final, FILTER_VALIDATE_EMAIL) === FALSE) {
            return FALSE;
        }else{
            return TRUE;
        }
    }
    
    function dadosEnvio($ass, $destinatario, $html, $copia, $arquivo, $nomeArquivo){
        //$volta = ((strpos($this->urlAtual(), "card")) ? "../" : "");
        //require_once $volta."lib/phpmailer/class.phpmailer.php";
        require_once "lib/phpmailer/class.phpmailer.php";
        $mail = new PHPMailer();
        
        // Define os dados do servidor e usuário
        $host = 'smtp.gtamultimidia.com.br'; // o smtp
        $username = 'william@gtamultimidia.com.br'; // o email do usuario
        $password = 'Wgt@2504';  // a senha
        
        $assunto = $ass;
        $mensagem = $html;

        //Parametros
        $mail->CharSet = "UTF-8"; 
        $mail->Host = $host;
        $mail->Port = '587';
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPKeepAlive = true;
        $mail->Mailer = "smtp";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->CharSet = 'utf-8';
        $mail->SMTPDebug = 0;

         // Define o remetente
        $mail->From = $username;
        $mail->Sender = $username;
        $mail->FromName = $ass;

        // Define os destinatrio(s)
        if(is_array($destinatario)){
            foreach($destinatario as $emailDestinatario){
                $mail->AddAddress($emailDestinatario); 
            }
        }else{
           $mail->AddAddress($destinatario); 
        }
        if($copia != ""){
            foreach($copia as $email){
                $mail->AddBCC($email, 'GTA Multimidia');
            }            
        }
        $mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
        $mail->IsHTML(true);
        
        // Texto e Assunto
        $mail->Subject  = $assunto; // Assunto da mensagem
        $mail->Body = $mensagem;

        $mail->AltBody = $mensagem;
        
        if($arquivo != ""){
            $nome_arquivo = $this->remover_caracter($nomeArquivo);
            $mail->AddAttachment($arquivo, $nome_arquivo);
        }

        $enviado = $mail->Send();
        return $enviado;
    }
    
}

?>