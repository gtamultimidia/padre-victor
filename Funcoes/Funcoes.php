<?php

class Funcoes{

    public function __construct() {
        if (!isset($_SESSION)) {
            session_name('cafe_padre_victor');
            session_start();
        }
    }
    
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
    
    public function primeiroNome($str){
        $nome = explode(" ",trim($str));
        return $nome[0];
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
    
    public function criarAlert($titulo='', $texto='', $id=''){
        $_SESSION['alerta']['titulo'] = $titulo;
        $_SESSION['alerta']['texto'] = $texto;
        $_SESSION['alerta']['id'] = $id;
    }
    
    public function exibeAlerta(){
        $titulo = ((isset($_SESSION['alerta']['titulo'])) ? $_SESSION['alerta']['titulo'] : '');
        $texto = ((isset($_SESSION['alerta']['texto'])) ? $_SESSION['alerta']['texto'] : '');
        $id = ((isset($_SESSION['alerta']['id'])) ? $_SESSION['alerta']['id'] : '');
        
        $alert = '';
        
        if(!empty($titulo) && !empty($texto)){
            $alert =   '<div id="dialog-message'.$id.'" title="'.$titulo.'">
                            '.$texto.'
                        </div>

                    <script>
                        $( function() {
                            $( "#dialog-message'.$id.'" ).dialog({
                                //dialogClass: "ui-state-error",
                                closeOnEscape: true,
                                modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });
                          } );
                    </script>';
        }
        
        unset($_SESSION['alerta']);
        
        return $alert;
    }
	
	public function verifyReCAPTCHA($paginaRetorno="contato"){
        if(isset($_POST['token'])) {
            $url = "https://www.google.com/recaptcha/api/siteverify";
            $secret = "6Lfukl0aAAAAAPR6xG91lAsKToXPovhhl9tH0UBU";
            $token = $_POST['token'];
            $sufixoUrl = '?secret='.$secret.'&response='.$token;
            $response = file_get_contents($url.$sufixoUrl);
            
            $res = json_decode($response, true);
            if((!$res['success']) || ($res['score'] < 0.5) || ($res['action'] != 'homepage')) {
                echo "<meta http-equiv='refresh' content='0;URL=$paginaRetorno'>";
                echo "<script type='text/javascript'> alert('Não foi possível comprovar a sua identidade!'); </script>";
                exit();
            }
        }else{
            echo "<meta http-equiv='refresh' content='0;URL=$paginaRetorno'>";
            echo "<script type='text/javascript'> alert('Não foi possível comprovar a sua identidade!'); </script>";
            exit();
        }
    }
    
    function dadosEnvio($assunto, $from, $destinatario, $html, $copia="", $arquivo="", $nomeArquivo=""){
        require_once "lib/phpmailer/class.phpmailer.php";
        $mail = new PHPMailer();
        
        // Define os dados do servidor e usuário
        $host = 'email-smtp.us-west-2.amazonaws.com'; // o smtp
		$username = 'AKIA3HQF5HDXQTUVY3OL'; // o email do usuario
		$password = 'BBHgpFtTGlQQk1uCYtZD1c4WMO2xDbmZhCJ5Wg5TTSUB';  // a senha

        $mensagem = $html;

        //Parametros
		$mail->CharSet = "UTF-8";
		$mail->Host = $host;
		$mail->SMTPSecure = 'tls';
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
        $mail->From = "robot@padrevictorcafe.com.br";
        $mail->Sender = "robot@padrevictorcafe.com.br";
        $mail->FromName = '=?UTF-8?B?' . base64_encode($from) . '?=';

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
        $mail->Subject = '=?UTF-8?B?' . base64_encode($assunto) . '?=';
        $mail->addReplyTo('atendimento@padrevictorcafe.com.br');
        $mail->Body = $mensagem;

        $mail->AltBody = $mensagem;
        
        if($arquivo != ""){
            $mail->AddAttachment($arquivo, $nomeArquivo);
        }

        $enviado = $mail->Send();
        return $enviado;
    }
}

?>