<?php

class Ebook extends Models {

    public function enviarEmailConfirmacao($uniqid, $email, $nome) {
        $funcoes = new Funcoes();
        
        $html = '<html>
                    <body>
                        <div style="text-align: center;">
                            <img src="http://www.padrevictorcafe.com.br/img/logo-email.png" alt="Café Padre Victor"><br>
                            <h2>Olá '.$funcoes->primeiroNome($nome).'</h2>
                            <p><a href="http://www.padrevictorcafe.com.br/enviar-ebook/'.$uniqid.'">Clique aqui</a> para confirmar seu e-mail.</p><br>
                            <p>Caso não consiga acessar o link acima, copie o link abaixo e cole em seu navegador:<br>http://www.padrevictorcafe.com.br/enviar-ebook/'.$uniqid.'</p>
                        </div>
                    </body>
                </html>';


        $ass = "Confirme seu E-mail";
        $from = "Café Padre Victor";
        $send = $funcoes->dadosEnvio($ass, $from, $email, $html);

        return $send;
    }
    
    public function enviarEmailBook($email, $nome) {
        $funcoes = new Funcoes();
        
        $html = '<html>
                    <body>
                        <div style="text-align: center;">
                            <img src="http://www.padrevictorcafe.com.br/img/logo-email.png" alt="Café Padre Victor"><br>
                            <h2>Parabéns '.$funcoes->primeiroNome($nome).'</h2>
                            <p>Você ganhou o seu E-book. Saboreie sem moderação!</p><br>
                        </div>
                    </body>
                </html>';


        $ass = "E-book Receitas de Café";
        $from = "Café Padre Victor";
        $send = $funcoes->dadosEnvio($ass, $from, $email, $html, '', 'file/2020/eb.pdf', 'e-book-receitas-de-cafe-padre-victor.pdf');

        return $send;
    }
    
    public function enviarEmailAdm($email, $emailCliente) {
        $funcoes = new Funcoes();
        
        $html = '<html>
                    <body>
                        <div style="text-align: center;">
                            <img src="http://www.padrevictorcafe.com.br/img/logo-email.png" alt="Café Padre Victor"><br>
                            <p><b>E-mail: </b>'.$emailCliente.'</p>
                        </div>
                    </body>
                </html>';

        $ass = "Cadastro do E-book Receitas de Café";
        $from = "Café Padre Victor";
        $copia = array();
        $copia[] = "william@gtamultimidia.com.br";
		
        $send = $funcoes->dadosEnvio($ass, $from, $email, $html, $copia);

        return $send;
    }
    
    public function confereUniqEnviaBook(){
        if(!empty($_GET['cod'])){
            $uniqid = $_GET['cod'];
            
            $dados = array(
                    "cod_verificacao" => $uniqid,
                    "enviado" => 0,
                    "ativo" => 0
                );
            $listar = $this->selectSeveral("ebook", $dados, false, ' LIMIT 1');
            
            $funcoes = new Funcoes();
            
            if($listar->rowCount() > 0){
                $reg = $listar->fetch(PDO::FETCH_OBJ);
                if($this->enviarEmailBook($reg->email, $reg->nome)){
                    $dados = array(
                        "enviado" => 1,
                        "ativo" => 1
                    );
                    $this->saveById("ebook", $dados, $reg->id);
                    
                    $funcoes->criarAlert('Sucesso!!!', "O E-book foi enviado para<br>o seu e-mail.", 1);
                    echo "<meta http-equiv='refresh' content='0;URL=../index'>";
                    exit();
                }else{
                    $funcoes->criarAlert('Erro', "Tente acessar o link de confirmação novamente, se persistir entre em contato com o Café Padre Victor.", 1);
                    echo "<meta http-equiv='refresh' content='0;URL=../index'>";
                    exit();
                }
            }else{
                echo "<meta http-equiv='refresh' content='0;URL=../index'>";
                exit();
            }
        }
    }
    
    public function vericaEnvio($email){
        $confere = $this->selectSeveral("ebook", array("email"=>$email), false, '');
        return $confere->rowCount();
    }
    
    public function enviaConfirmacao() {
        if(!empty($_POST['email'])){
			
            $funcoes = new Funcoes();
			$funcoes->verifyReCAPTCHA("index");
			
            //$nome = $_POST['nome'];
            $nome = '';
            $email = $_POST['email'];
            //$telefone = $_POST['telefone'];
            //$empresa = $_POST['empresa'];
            //$cargo = $_POST['cargo'];
            $uniqid = substr(md5(time().uniqid()), 0, 50);

            $total = $this->vericaEnvio($email);
            
            if($total > 0){
                $dados = array(
                        "cod_verificacao" => $uniqid,
                    );
                $execute = $this->saveByOptional("ebook", $dados, "email", $email);
            }else{
                $dados = array(
                    "email" => $email,
                    "cod_verificacao" => $uniqid,
                    "enviado" => 0,
                    "ativo" => 0
                );
                $execute = $this->insert("ebook", $dados, false);
            }
            
            if($execute){
                $emailAdm = 'atendimento@padrevictorcafe.com.br';
                $this->enviarEmailAdm($emailAdm, $email);
                if($this->enviarEmailConfirmacao($uniqid, $email, $nome)){
                    $funcoes->criarAlert('Confirme o seu e-mail', "Enviamos um e-mail de confirmação para você, caso não receba, verifique sua caixa de spam.", 1);
                    echo "<meta http-equiv='refresh' content='0;index'>";
                    exit();
                }else{
                    $funcoes->criarAlert('Erro ao enviar e-mail de confirmação', "Por favor tente novamente, se persistir entre em contato com o Café Padre Victor.", 1);
                    echo "<meta http-equiv='refresh' content='0;index'>";
                    exit();
                }
            }else{
                $funcoes->criarAlert('Algo deu errado', "Por favor tente novamente, se persistir entre em contato com o Café Padre Victor.", 1);
                echo "<meta http-equiv='refresh' content='0;index'>";
                exit();
            }
            
            $funcoes->criarAlert('Algo deu errado', "Por favor tente novamente, se persistir entre em contato com o Café Padre Victor.", 1);
            echo "<meta http-equiv='refresh' content='0;index'>";
            exit();
        }
    }
    
}

?>