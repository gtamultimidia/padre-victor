<?php

/* CLASSE DE LOGIN NO SISTEMA */

class Login extends Conexao {

    private $login;
    private $senha;
    private $idUsuario;
    
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setSenha($senha) {
        $this->senha = Ferramentas::protege_senha($senha);
    }

    public function getLogin() {
        return $this->login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function __construct() {
        if (!isset($_SESSION)) {
                session_start();
        }
        if (isset($_POST['acao']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['acao'] == 'login') {
                $this->setLogin($_POST['login']);
                $this->setSenha($_POST['senha']);
                $this->logar();
            }
        }
        if (isset($_POST['acao']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['acao'] == 'esqueci senha') {
                $this->setLogin($_POST['email']);
                $this->recuperar();
            }
        }
    }

    public function areaRestrita(){
        if(!isset($_SESSION['idUsuario'])){
            echo "<meta http-equiv='refresh' content='0;URL=index'>";
            exit();
        }
    }
    
    public function verificaLogado(){
        if(isset($_SESSION['idUsuario'])){
            echo "<meta http-equiv='refresh' content='0;URL=index'>";
            exit();
        }
    }
    
    public function retornaBase(){
        $base = "http://" . $_SERVER['SERVER_NAME']."/";
        return $base;
    }

    public function logar() {
        $url = Ferramentas::UrlAtual();
        $pdo = parent::getDB();
        $logar = $pdo->prepare("SELECT * FROM usuarios WHERE login = ? AND senha = ? AND ativo = ?");
        $logar->bindValue(1, $this->getLogin());
        $logar->bindValue(2, $this->getSenha());
        $logar->bindValue(3, 1);
        $logar->execute();
        if ($logar->rowCount() >= 1){
            $dados = $logar->fetch(PDO::FETCH_OBJ);
            $_SESSION['idUsuario'] = $dados->id;
            $_SESSION['nome'] = $dados->nome;
            $_SESSION['email'] = $dados->email;
            $_SESSION['login'] = $dados->login;
            $_SESSION['logado'] = true;
            echo "<meta http-equiv='refresh' content='0;URL=" . $url . "'>";
            return true;
        }else{
            $_SESSION['alerta'] = "Dados Não Conferem";
            return false;
        }
    }
    
    public function pegaDadosUsuario($id) {
        $pdo = parent::getDB();
        $this->setIdUsuario($id);
        $listar = $pdo->prepare("SELECT * FROM usuarios WHERE id = ? AND ativo = ?");
        $listar->bindValue(1, $this->getIdUsuario());
        $listar->bindValue(2, 1);
        $listar->execute();
        return $listar->fetch(PDO::FETCH_OBJ);
    }
    
    public function formLoginTopo(){
        $topo = '';
        if(isset($_SESSION['logado'])){
            $login = $this->pegaDadosUsuario($_SESSION['idUsuario'])->login;
            $topo = '<div class="coluna3 logado">
                        <p class="login">Olá <b>'.$login.'</b> </p>
                        <p class="sair"><a href="meus-dados">Meus Dados</a></p>
                        <p class="sair"><a href="logout">Sair</a></p>
                    </div>';
        }else{
            $topo = '<form class="formLoginMenu" action="" method="POST">
                    <div class="coluna1">
                        <label for="login">Login</label>
                        <input type="text" name="login" id="login" required/>
                    </div>

                    <div class="coluna2">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" required/>
                    </div>

                    <input type="hidden" name="acao" value="login"/>

                    <div class="coluna3">
                        <button type="submit" class="botaoLogar"><img src="img/sair.png" alt="Logar"/></button>
                    </div>

                    <div class="coluna1">
                        <p>Não é cadastrado? <a href="cadastre-se">Clique aqui</a>.</p>
                    </div>

                    <div class="coluna2">
                        <p><a href="esqueci-senha">Esqueceu a senha?</a>.</p>
                    </div>

                    <div class="coluna3">

                    </div>
                </form>';
        }
        return $topo;
    }

    public static function deslogar() {
        if (isset($_SESSION['logado'])){
            unset($_SESSION['logado']);
            unset($_SESSION['idUsuario']);
            unset($_SESSION['nome']);
            unset($_SESSION['login']);
            unset($_SESSION['email']);
            
            session_destroy();
            header("Location: index");
        }
        if (isset($_POST['acao']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_SESSION['last_request'])) {
                if ($_POST['acao'] == "login") {
                    $this->logar();
                }
            }
        }
    }

    
    public function enviaEmailAlterarSenha($email, $novasenha, $login) {
        $date_atual = date('d/m/Y');
        $hora_atual = date('H:i');

        $html = '<html>
                <body>
                    <div style="text-align: center;">
                        <img src="http://gtamultimidia.com.br/unissul/img/logo.png" alt="UNISSUL - União dos Supermercados do Sul de Minas"><br>
                        <p>Recebemos a sua solicitação de recuperação de senha em ' . $date_atual . ' as ' . $hora_atual . '.</p>
                        <br>
                        <p><b>Nova senha: </b>' . $novasenha . '</b><br><b>Login: </b>' . $login . '</b></p>
                        <br>
                        <p>Acesse o site para alterá-la. <a href="http://www.gtamultimidia.com.br/unissul/meus-dados">www.gtamultimidia.com.br/unissul/meus-dados/</a></p>
                    </div>
                </body>
            </html>';

        //Dados do e-mail
        $ass = utf8_encode("UNISSUL - Alteração de Senha");
        $funcoes = new Funcoes();
        
        $enviado = $funcoes->dadosEnvio($ass, $email, $html, "", "", "");

        return $enviado;
    }

    public function recuperar() {
        $pdo = parent::getDB();
        $email = $this->getLogin();
        $recuperar = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $recuperar->bindValue(1, $email);
        $recuperar->execute();
        if ($recuperar->rowCount() == 1) {
            $reg = $recuperar->fetch(PDO::FETCH_OBJ);
            $login = $reg->login;
            $novasenha = substr(md5(time()), 0, 6);
            $this->setSenha($novasenha);
            $nscriptografada = $this->getSenha();
            $enviado = $this->enviaEmailAlterarSenha($email, $novasenha, $login);
            if ($enviado == '1') {
                $atualizar = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
                $atualizar->bindValue(1, $nscriptografada);
                $atualizar->bindValue(2, $email);
                $atualizar->execute();
                echo "<meta http-equiv='refresh' content='0;URL=index'>";
                echo "<script type='text/javascript'> alert('Sua senha foi enviada para o seu e-email!'); </script>";
            } else {
                echo "<meta http-equiv='refresh' content='0;URL=index'>";
                echo "<script type='text/javascript'> alert('Falha ao recuperar senha!'); </script>";
            }
        }else{
            echo "<meta http-equiv='refresh' content='0;URL=index'>";
            echo "<script type='text/javascript'> alert('O E-mail não foi encontrado em nosso sistema!'); </script>";
        }
    }
    
    
    /*ADM*/
    
    public function logarAdm() {
        if (isset($_POST['email']) && isset($_POST['senha'])) {
            $pdo = parent::getDB();
            
            $this->setLogin($_POST['email']);
            $this->setSenha($_POST['senha']);
            
            $logar = $pdo->prepare("SELECT * FROM administradores WHERE email = ? AND senha = ? AND ativo = ?");
            $logar->bindValue(1, $this->getLogin());
            $logar->bindValue(2, $this->getSenha());
            $logar->bindValue(3, 1);
            $logar->execute();
            if ($logar->rowCount() == 1){
                $dados = $logar->fetch(PDO::FETCH_OBJ);
                $_SESSION['idUsuarioAdm'] = $dados->id;
                $_SESSION['nomeAdm'] = $dados->nome;
                $_SESSION['emailAdm'] = $dados->email;
                $_SESSION['loginAdm'] = $dados->login;
                $_SESSION['logadoAdm'] = true;
                echo "<meta http-equiv='refresh' content='0;URL=pages/index'>";
                return true;
            }else{
                echo '  <script type="text/javascript" async>
                            $(document).ready(function(){
                                    demo.initChartist();

                                    $.notify({
                                    icon: "pe-7s-attention",
                                    message: "Opsss!</b> - Os dados não conferem."

                                },{
                                    type: "danger",
                                    timer: 4000
                                });

                            });
                        </script>';
                return false;
            }
        }
    }
    
    public function protegeAdm() {
        if (!isset($_SESSION['idUsuarioAdm']) || !isset($_SESSION['nomeAdm']) || !isset($_SESSION['emailAdm']) || !isset($_SESSION['loginAdm']) ||!isset($_SESSION['logadoAdm'])) {
            echo "<meta http-equiv='refresh' content='0;URL=../index'>";
            exit();
        }
    }

    public function logoutAdm() {
        unset($_SESSION['idUsuarioAdm']);
        unset($_SESSION['nomeAdm']);
        unset($_SESSION['emailAdm']);
        unset($_SESSION['loginAdm']);
        unset($_SESSION['logadoAdm']);
        echo "<meta http-equiv='refresh' content='0;URL=../painel/index'>";
    }

}

?>