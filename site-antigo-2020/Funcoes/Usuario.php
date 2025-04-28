<?php

/**
 * CLASSE DE CADASTROS NO SISTEMA
 */
class Usuario extends Conexao {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $nova_senha;
    private $login;
    private $idUsuario;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function getLogin() {
        return $this->login;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($senha) {
        $this->senha = Ferramentas::protege_senha($senha);
    }

    function setLogin($login) {
        $this->login = $login;
    }
    
    function getNova_senha() {
        return $this->nova_senha;
    }

    function setNova_senha($nova_senha) {
        $this->nova_senha = Ferramentas::protege_senha($nova_senha);
    }
    
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

            
    public function __construct() {
       
    }

    public function protege() {
        if (!isset($_SESSION['logado'])) {
            echo "<meta http-equiv='refresh' content='0;URL=../index.php'>";
            exit();
        }
    }

    /* Função para alterar a senha do cliente */

    public function alterar_senha() {
        if (isset($_POST['nova_senha'])) {
            $pdo = parent::getDB();
            $this->setSenha($_POST['senha_atual']);
            $this->setNova_senha($_POST['nova_senha']);
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
            if(isset($_SESSION['idUsuario'])){
                $id = $_SESSION['idUsuario'];
            }
            /* Verifica se a senha atual corresponde a atual digitada pelo cliente */
            $listar = $pdo->prepare("SELECT * FROM usuarios WHERE id = ? AND senha = ? AND ativo = ?");
            $listar->bindValue(1, $id);
            $listar->bindValue(2, $this->getSenha());
            $listar->bindValue(3, 1);
            $listar->execute();

            /* Se sim, altera a senha */
            if ($listar->rowCount() >= 1) {
                $editar = $pdo->prepare("UPDATE usuarios set senha = ? WHERE id=? ");
                $editar->bindValue(1, $this->getNova_senha());
                $editar->bindValue(2, $id);
                $link = ((isset($_POST['usu'])) ? "meus-dados.php" : "cliente-listar.php");
                if ($editar->execute()) {
                    echo "<meta http-equiv='refresh' content='0;URL=$link'>";
                    echo "<script type='text/javascript'> alert('A senha foi alterada com sucesso!'); </script>";
                } else {
                    echo "<meta http-equiv='refresh' content='0;URL=$link'>";
                    echo "<script type='text/javascript'> alert('Falha ao alterar senha!'); </script>";
                }
            }
            /* Se não, não altera a senha */ else {
                $link = ((isset($_POST['usu'])) ? "alterar-senha" : "cliente-editar.php?id=$id");
                echo "<meta http-equiv='refresh' content='0;URL=$link'>";
                echo "<script type='text/javascript'> alert('A senha atual está incorreta!'); </script>";
            }
        }
    }

    /* Função para pegar dados do cliente através do Id */

    public function pega_dados_cliente($id) {
        $pdo = parent::getDB();
        $this->setIdUsuario($id);
        $listar = $pdo->prepare("SELECT * FROM usuarios WHERE id = ? AND ativo = ?");
        $listar->bindValue(1, $this->getIdUsuario());
        $listar->bindValue(2, 1);
        $listar->execute();
        return $listar->fetch(PDO::FETCH_OBJ);
    }
    
    /* Função para pegar dados do cliente através do Id */

    public function formContato() {
        $nome = '';
        $email = '';
        $telefone = '';
        $cidade = '';
        $estado = '';;
        
        if(isset($_SESSION['idUsuario'])){
            $dadosUsuario = $this->pega_dados_cliente($_SESSION['idUsuario']);
            $nome = 'value="'.$dadosUsuario->nome.'"';
            $email = 'value="'.$dadosUsuario->email.'"';
            $telefone = 'value="'.$dadosUsuario->telefone.'"';
            $cidade = 'value="'.$dadosUsuario->cidade.'"';
            $estado = $dadosUsuario->estado;
        }
        
        $form = '   <input type="text" name="nome" placeholder="Nome completo" required '.$nome.'/>
                    <input type="email" name="email" placeholder="E-mail" required '.$email.'/>
                    <input type="tel" name="telefone" placeholder="Telefone" required '.$telefone.'/>
                    <input type="text" name="cidade" placeholder="Cidade" required '.$cidade.'/>
                    <input type="text" name="assunto" placeholder="Assunto" required />
                    <select name="estado" id="estado" required>
                        <option value="">Selecione um estado</option>
                        <option value="MG" '.(($estado != '' && $estado == "MG") ? "selected" : "").'>MG</option>
                        <option value="SP" '.(($estado != '' && $estado == "SP") ? "selected" : "").'>SP</option>
                        <option value="AL" '.(($estado != '' && $estado == "AL") ? "selected" : "").'>AL</option>
                        <option value="AP" '.(($estado != '' && $estado == "AP") ? "selected" : "").'>AP</option>
                        <option value="AM" '.(($estado != '' && $estado == "AM") ? "selected" : "").'>AM</option>
                        <option value="BA" '.(($estado != '' && $estado == "BA") ? "selected" : "").'>BA</option>
                        <option value="CE" '.(($estado != '' && $estado == "CE") ? "selected" : "").'>CE</option>
                        <option value="DF" '.(($estado != '' && $estado == "DF") ? "selected" : "").'>DF</option>
                        <option value="ES" '.(($estado != '' && $estado == "ES") ? "selected" : "").'>ES</option>
                        <option value="GO" '.(($estado != '' && $estado == "GO") ? "selected" : "").'>GO</option>
                        <option value="MA" '.(($estado != '' && $estado == "MA") ? "selected" : "").'>MA</option>
                        <option value="MT" '.(($estado != '' && $estado == "MT") ? "selected" : "").'>MT</option>
                        <option value="MS" '.(($estado != '' && $estado == "MS") ? "selected" : "").'>MS</option>
                        <option value="PA" '.(($estado != '' && $estado == "PA") ? "selected" : "").'>PA</option>
                        <option value="PB" '.(($estado != '' && $estado == "PB") ? "selected" : "").'>PB</option>
                        <option value="PR" '.(($estado != '' && $estado == "PR") ? "selected" : "").'>PR</option>
                        <option value="PE" '.(($estado != '' && $estado == "PE") ? "selected" : "").'>PE</option>
                        <option value="PI" '.(($estado != '' && $estado == "PI") ? "selected" : "").'>PI</option>
                        <option value="RJ" '.(($estado != '' && $estado == "RJ") ? "selected" : "").'>RJ</option>
                        <option value="RN" '.(($estado != '' && $estado == "RN") ? "selected" : "").'>RN</option>
                        <option value="RS" '.(($estado != '' && $estado == "RS") ? "selected" : "").'>RS</option>
                        <option value="RO" '.(($estado != '' && $estado == "RO") ? "selected" : "").'>RO</option>
                        <option value="RR" '.(($estado != '' && $estado == "RR") ? "selected" : "").'>RR</option>
                        <option value="SC" '.(($estado != '' && $estado == "SC") ? "selected" : "").'>SC</option>
                        <option value="SE" '.(($estado != '' && $estado == "SE") ? "selected" : "").'>SE</option>
                        <option value="TO" '.(($estado != '' && $estado == "TO") ? "selected" : "").'>TO</option>
                    </select>
                    <textarea name="mensagem" placeholder="Mensagem" required></textarea>';
        
        return $form;
    }
    
    public function formTrabalheConosco() {
        $nome = '';
        $email = '';
        $telefone = '';
        $cidade = '';
        $estado = '';;
        
        if(isset($_SESSION['idUsuario'])){
            $dadosUsuario = $this->pega_dados_cliente($_SESSION['idUsuario']);
            $nome = 'value="'.$dadosUsuario->nome.'"';
            $email = 'value="'.$dadosUsuario->email.'"';
            $telefone = 'value="'.$dadosUsuario->telefone.'"';
            $cidade = 'value="'.$dadosUsuario->cidade.'"';
            $estado = $dadosUsuario->estado;
        }
        
        $form = '   <input type="text" name="nome" placeholder="Nome completo" required '.$nome.'/>
                    <input type="email" name="email" placeholder="E-mail" required '.$email.'/>
                    <input type="tel" name="telefone" placeholder="Telefone" required '.$telefone.'/>
                    <input type="text" name="cidade" placeholder="Cidade" required '.$cidade.'/>
                    <div class="arquivoTrabalhe">
                        <input type="file" name="arquivo" required class="arquivoReal" id="arquivo" onchange="nomeArquivo()"/>
                        <a class="arquivoFake" id="arquivoFake">Anexar currículo <p>Buscar arquivo</p></a>
                    </div>
                    <select name="estado" id="estado" required>
                        <option value="">Selecione um estado</option>
                        <option value="MG" '.(($estado != '' && $estado == "MG") ? "selected" : "").'>MG</option>
                        <option value="SP" '.(($estado != '' && $estado == "SP") ? "selected" : "").'>SP</option>
                        <option value="AL" '.(($estado != '' && $estado == "AL") ? "selected" : "").'>AL</option>
                        <option value="AP" '.(($estado != '' && $estado == "AP") ? "selected" : "").'>AP</option>
                        <option value="AM" '.(($estado != '' && $estado == "AM") ? "selected" : "").'>AM</option>
                        <option value="BA" '.(($estado != '' && $estado == "BA") ? "selected" : "").'>BA</option>
                        <option value="CE" '.(($estado != '' && $estado == "CE") ? "selected" : "").'>CE</option>
                        <option value="DF" '.(($estado != '' && $estado == "DF") ? "selected" : "").'>DF</option>
                        <option value="ES" '.(($estado != '' && $estado == "ES") ? "selected" : "").'>ES</option>
                        <option value="GO" '.(($estado != '' && $estado == "GO") ? "selected" : "").'>GO</option>
                        <option value="MA" '.(($estado != '' && $estado == "MA") ? "selected" : "").'>MA</option>
                        <option value="MT" '.(($estado != '' && $estado == "MT") ? "selected" : "").'>MT</option>
                        <option value="MS" '.(($estado != '' && $estado == "MS") ? "selected" : "").'>MS</option>
                        <option value="PA" '.(($estado != '' && $estado == "PA") ? "selected" : "").'>PA</option>
                        <option value="PB" '.(($estado != '' && $estado == "PB") ? "selected" : "").'>PB</option>
                        <option value="PR" '.(($estado != '' && $estado == "PR") ? "selected" : "").'>PR</option>
                        <option value="PE" '.(($estado != '' && $estado == "PE") ? "selected" : "").'>PE</option>
                        <option value="PI" '.(($estado != '' && $estado == "PI") ? "selected" : "").'>PI</option>
                        <option value="RJ" '.(($estado != '' && $estado == "RJ") ? "selected" : "").'>RJ</option>
                        <option value="RN" '.(($estado != '' && $estado == "RN") ? "selected" : "").'>RN</option>
                        <option value="RS" '.(($estado != '' && $estado == "RS") ? "selected" : "").'>RS</option>
                        <option value="RO" '.(($estado != '' && $estado == "RO") ? "selected" : "").'>RO</option>
                        <option value="RR" '.(($estado != '' && $estado == "RR") ? "selected" : "").'>RR</option>
                        <option value="SC" '.(($estado != '' && $estado == "SC") ? "selected" : "").'>SC</option>
                        <option value="SE" '.(($estado != '' && $estado == "SE") ? "selected" : "").'>SE</option>
                        <option value="TO" '.(($estado != '' && $estado == "TO") ? "selected" : "").'>TO</option>
                    </select>
                    <textarea name="mensagem" placeholder="Mensagem" required></textarea>';
        
        return $form;
    }
    
    
    /* Função para alterar a senha do administrador */

    public function alterar_senhaAdm() {
        if (isset($_POST['nova_senha'])) {
            $pdo = parent::getDB();
            $this->setSenha($_POST['senha_atual']);
            $this->setNova_senha($_POST['nova_senha']);
            $this->setId($_SESSION['idUsuarioAdm']);
            /* Verifica se a senha atual corresponde a atual digitada pelo cliente */
            $listar = $pdo->prepare("SELECT * FROM administradores WHERE id = ? AND senha = ? AND ativo = ?");
            $listar->bindValue(1, $this->getId());
            $listar->bindValue(2, $this->getSenha());
            $listar->bindValue(3, 1);
            $listar->execute();

            /* Se sim, altera a senha */
            if ($listar->rowCount() >= 1) {
                $editar = $pdo->prepare("UPDATE administradores set senha = ? WHERE id=? ");
                $editar->bindValue(1, $this->getNova_senha());
                $editar->bindValue(2, $this->getId());
                if ($editar->execute()) {
                    echo "<meta http-equiv='refresh' content='0;URL=usuario-editar'>";
                    echo "<script type='text/javascript'> alert('A senha foi alterada com sucesso!'); </script>";
                } else {
                    echo "<meta http-equiv='refresh' content='0;URL=usuario-editar.php'>";
                    echo "<script type='text/javascript'> alert('Falha ao alteradar senha!'); </script>";
                }
            }
            /* Se não, não altera a senha */ else {
                echo "<meta http-equiv='refresh' content='0;URL=usuario-editar.php'>";
                echo "<script type='text/javascript'> alert('A senha atual está incorreta!'); </script>";
            }
        }
    }

}

?>