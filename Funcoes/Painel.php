<?php

class Painel extends Conexao {

    private $email;
    private $id;
    private $endereco_img;
    private $nome;
    private $senha;
    private $nova_senha;
    private $url;
    private $descricao;
    private $tags_seo;
    private $alt;
    private $titulo;
    private $fonte;
    private $texto;
    
    function getSenha() {
        return $this->senha;
    }

    function getNova_senha() {
        return $this->nova_senha;
    }

    public function setSenha($senha) {
        $this->senha = Ferramentas::protege_senha($senha);
    }
    
    function setNova_senha($nova_senha) {
        $this->nova_senha = Ferramentas::protege_senha($nova_senha);
    }

    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function getAlt() {
        return $this->alt;
    }

    function setAlt($alt) {
        $this->alt = $alt;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getFonte() {
        return $this->fonte;
    }

    function getTexto() {
        return $this->texto;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setFonte($fonte) {
        $this->fonte = $fonte;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getEndereco_img() {
        return $this->endereco_img;
    }

    function getUrl() {
        return $this->url;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getTags_seo() {
        return $this->tags_seo;
    }
    
    function setEndereco_img($endereco_img) {
        $this->endereco_img = $endereco_img;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setTags_seo($tags_seo) {
        $this->tags_seo = $tags_seo;
    }
        
    /** RECEITAS */
    
    public function listarReceitas() {
        $pdo = parent::getDB();
        $listar = $pdo->prepare("SELECT * FROM receitas WHERE ativo = ? ORDER BY id DESC");
        $listar->bindValue(1, 1);
        $listar->execute();
        $linhas = '';
        if ($listar->rowCount() >= 1) {
            while ($reg = $listar->fetch(PDO::FETCH_OBJ)) {
                $linhas .= '<tr>
                                <td>' . $reg->id . '</td>
                                <td class="imagem_produto_listar"><img src="../../img/receitas/' . $reg->imagem . '" alt="' . $reg->titulo . '"></td>
                                <td>' . $reg->titulo . '</td>
                                <td>' . $reg->resumo . '</td>
                                <td class="operacoes"><a class="edita" title="Editar" onclick="confirma_editar(' . $reg->id . ')"><i class="pe-7s-note"></i></a> <a class="exclui" title="Excluir" onclick="confirma_excluir(' . $reg->id . ')"><i class="pe-7s-trash"></i></a></td>
                            </tr>';
            }
        } else {
            $linhas = 'Ainda não foi cadastrada nenhuma receita!';
        }
        echo $linhas;
    }
    
    public function listarReceitasBusca() {
        $pdo = parent::getDB();
        $listar = $pdo->prepare("SELECT * FROM receitas WHERE ativo = ? AND (id LIKE '%".$_POST['palavra_chave']."%' OR titulo LIKE '%".$_POST['palavra_chave']."%' OR resumo LIKE '%".$_POST['palavra_chave']."%') ORDER BY id DESC");
        $listar->bindValue(1, 1);
        $listar->execute();
        $linhas = '';
        if ($listar->rowCount() >= 1) {
            while ($reg = $listar->fetch(PDO::FETCH_OBJ)) {
                $linhas .= '<tr>
                                <td>' . $reg->id . '</td>
                                <td class="imagem_produto_listar"><img src="../../img/receitas/' . $reg->imagem . '" alt="' . $reg->titulo . '"></td>
                                <td>' . $reg->titulo . '</td>
                                <td>' . $reg->resumo . '</td>
                                <td class="operacoes"><a class="edita" title="Editar" onclick="confirma_editar(' . $reg->id . ')"><i class="pe-7s-note"></i></a> <a class="exclui" title="Excluir" onclick="confirma_excluir(' . $reg->id . ')"><i class="pe-7s-trash"></i></a></td>
                            </tr>';
            }
        } else {
            $linhas = '<tr><td>Nenhuma linha foi encontrada referente a sua busca!</td></tr>';
        }
        echo $linhas ;
    }
    
    public function qtdReceitas() {
        $pdo = parent::getDB();
        $listar = $pdo->prepare("SELECT * FROM receitas WHERE ativo = ?");
        $listar->bindValue(1, 1);
        $listar->execute();

        return $listar->rowCount();
    }
    
    public function excluirReceita($id) {
        $this->setId($id);
        $pdo = parent::getDB();
        $listar = $pdo->prepare("UPDATE receitas SET ativo = ? WHERE id = ?");
        $listar->bindValue(1, 0);
        $listar->bindValue(2, $this->getId());
        $executa = $listar->execute();
        if ($executa) {
            echo "<meta http-equiv='refresh' content='0;URL=receita-listar'>";
            echo "<script type='text/javascript'> alert('A receita foi excluída com sucesso!'); </script>";
        } else {
            echo "<meta http-equiv='refresh' content='0;URL=receita-listar'>";
            echo "<script type='text/javascript'> alert('Falha ao excluir receita!'); </script>";
        }
    }
    
    public function qtdDadosReceita($id) {
        $pdo = parent::getDB();
        $this->setId($id);
        $listar = $pdo->prepare("SELECT * FROM receitas WHERE ativo = ? AND id = ?");
        $listar->bindValue(1, 1);
        $listar->bindValue(2, $this->getId());
        $listar->execute();

        return $listar->rowCount();
    }
    
    public function dadosReceita($id) {
        $pdo = parent::getDB();
        $this->setId($id);
        $listar = $pdo->prepare("SELECT * FROM receitas WHERE ativo = ? AND id = ?");
        $listar->bindValue(1, 1);
        $listar->bindValue(2, $this->getId());
        $listar->execute();

        return $listar->fetch(PDO::FETCH_OBJ);
    }
    
    public function editarReceita() {
        if ($this->qtdDadosReceita($_GET['id']) >= 1) {
            $reg = $this->dadosReceita($_GET['id']);
            $dataPostagem = date('Y-m-d\TH:i', strtotime($reg->data_postagem));
            
            echo'   <div class="col-md-4 campoResponse">
                        <div class="card card-user">
                            <div class="image">

                            </div>
                            <div class="content">
                                <div class="form-group">
                                    <label>Imagem da Receita</label>
                                    <input type="file" class="form-control" name="arquivo" id="arquivo"  onchange="PreviewImage(this.value);">
                                </div>
                                <label style="text-align: center;width: 100%;">Preview</label><br>
                                <div class="preview_foto">
                                    <img id="uploadPreview" src="../../img/receitas/' . $reg->imagem . '"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 campoResponse">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Editar Receita</h4>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Receita*</label>
                                            <input type="text" class="form-control" placeholder="Título da Receita" name="titulo" value="' . $reg->titulo . '" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Resumo*</label>
                                            <input type="text" class="form-control" placeholder="Resumo" name="resumo" value="' . $reg->resumo . '" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Texto Receita*</label>
                                            <textarea rows="5" class="form-control" placeholder="Texto Receita" name="textoReceita" id="texto" required>' . $reg->receita . '</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Data Postagem (OPCIONAL)</label>
                                            <input type="datetime-local" class="form-control" placeholder="Data Postagem" name="dataPostagem" value="'.$dataPostagem.'">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-info btn-fill pull-right">Editar Receita</button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>';
        }
    }
    
    public function salvarEdicaoReceita(){
        if(isset($_POST['titulo'])){
            $pdo = parent::getDB();

            $diretorio = '../../img/receitas/';
            $diretorioMiniatura = '../../img/receitas/miniatura/';
            $dados_produto = $this->dadosReceita($_GET['id']);
            $imagem_banco = $dados_produto->imagem;
            $add_foto = "";
            if ($_FILES['arquivo']['name'] != '') {
                $nome_img = $this->nome_unico($diretorio, $_FILES['arquivo']['name'], $_FILES['arquivo']['type']);
                $add_foto = "sim";
            } else {
                $nome_img = $imagem_banco;
                $add_foto = "nao";
            }

            $titulo = $_POST['titulo'];
            $resumo = $_POST['resumo'];
            $textoReceita = $_POST['textoReceita'];
            $dataPostagem = $_POST['dataPostagem'];
            $id = $_GET['id'];

            $editar = $pdo->prepare("UPDATE receitas set titulo = ?, resumo = ?, receita = ?, imagem = ?, data_postagem = ? WHERE id=? ");
            $editar->bindValue(1, $titulo);
            $editar->bindValue(2, $resumo);
            $editar->bindValue(3, $textoReceita);
            $editar->bindValue(4, $nome_img);
            $editar->bindValue(5, $dataPostagem);
            $editar->bindValue(6, $id);

            if ($editar->execute()) {
                if($add_foto == "sim"){
                    $this->salvaFotoInteiraMiniatura($_FILES['arquivo']['tmp_name'], $diretorio, $nome_img, $diretorioMiniatura, 223);
                }
                echo "<meta http-equiv='refresh' content='0;URL=receita-listar'>";
                echo "<script type='text/javascript'> alert('Os dados foram atualizados com sucesso!'); </script>";
            } else {
                echo "<meta http-equiv='refresh' content='0;URL=receita-listar'>";
                echo "<script type='text/javascript'> alert('Falha ao atualizar dados!'); </script>";
            }
        }
    }
    
    public function insereReceita() {
        if (isset($_POST['titulo'])) {

            $diretorio = '../../img/receitas/';
            $diretorioMiniatura = '../../img/receitas/miniatura/';
            $add_foto = "";
            if ($_FILES['arquivo']['name'] != '') {
                $nome_img = $this->nome_unico($diretorio, $_FILES['arquivo']['name'], $_FILES['arquivo']['type']);
                $add_foto = "sim";
            } else {
                $nome_img = "sem-imagem.jpg";
                $add_foto = "nao";
            }

            $titulo = $_POST['titulo'];
            $resumo = $_POST['resumo'];
            $textoReceita = $_POST['textoReceita'];
            $dataPostagem = $_POST['dataPostagem'];
            $ativo = 1;
			$url = $this->remover_caracter($_POST['titulo']);
        
            $pdo = parent::getDB();
            $cadastrar = $pdo->prepare("INSERT INTO receitas VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
            $cadastrar->bindValue(1, $titulo);
            $cadastrar->bindValue(2, $resumo);
            $cadastrar->bindValue(3, $textoReceita);
            $cadastrar->bindValue(4, $nome_img);
            $cadastrar->bindValue(5, $url);
            $cadastrar->bindValue(6, $dataPostagem);
            $cadastrar->bindValue(7, $ativo);
            
            $executa = $cadastrar->execute();

            if ($executa) {
                if($add_foto == "sim"){
                    $this->salvaFotoInteiraMiniatura($_FILES['arquivo']['tmp_name'], $diretorio, $nome_img, $diretorioMiniatura, 295);
                }
                echo "<meta http-equiv='refresh' content='0;URL=receita-listar'>";
                echo "<script type='text/javascript'> alert('A receita foi adicionada com sucesso!'); </script>";
            } else {
                echo "<meta http-equiv='refresh' content='0;URL=receita-listar'>";
                echo "<script type='text/javascript'> alert('Falha ao adicionar receita!'); </script>";
            }
        }
    }
    
    public function jsonEncodeReceita($string){
        $quebra_conteudo = explode("\n", $string);
        $array = array();
        $json = "";
        foreach ($quebra_conteudo as $itens){
            if($itens != ''){
                $array[] = $itens;
            }
            $json = json_encode($array);
        }
        return $json;
    }
    
    public function jsonDecodeReceita($json){
        $array = json_decode($json, true);
        $conteudo = '';
        $posicoesArray = count($array) - 1;
        foreach ($array as $count => $itens){
            if($itens != ''){
                $pulaLinha = (($posicoesArray !== $count) ? "\n" : '');
                $conteudo .= $itens.$pulaLinha;
            }
        }
        return $conteudo;
    }
    
    /*PRODUTOS*/
    
    public function listarProdutos() {
        $pdo = parent::getDB();
        $listar = $pdo->prepare("SELECT * FROM produtos WHERE ativo = ? ORDER BY id DESC");
        $listar->bindValue(1, 1);
        $listar->execute();
        $linhas = '';
        if ($listar->rowCount() >= 1) {
            while ($reg = $listar->fetch(PDO::FETCH_OBJ)) {
                $linhas .= '<tr>
                                <td>' . $reg->id . '</td>
                                <td class="imagem_produto_listar"><img src="../../img/produtos/' . $reg->imagem . '" alt="' . $reg->titulo . '"></td>
                                <td>' . $reg->titulo . '</td>
                                <td class="operacoes"><a class="edita" title="Editar" onclick="confirma_editar(' . $reg->id . ')"><i class="pe-7s-note"></i></a> <a class="exclui" title="Excluir" onclick="confirma_excluir(' . $reg->id . ')"><i class="pe-7s-trash"></i></a></td>
                            </tr>';
            }
        } else {
            $linhas = 'Ainda não foi cadastrada nenhuma produto!';
        }
        echo $linhas;
    }
    
    public function listarProdutosBusca() {
        $pdo = parent::getDB();
        $listar = $pdo->prepare("SELECT * FROM produtos WHERE ativo = ? AND (id LIKE '%".$_POST['palavra_chave']."%' OR titulo LIKE '%".$_POST['palavra_chave']."%' OR resumo LIKE '%".$_POST['palavra_chave']."%') ORDER BY id DESC");
        $listar->bindValue(1, 1);
        $listar->execute();
        $linhas = '';
        if ($listar->rowCount() >= 1) {
            while ($reg = $listar->fetch(PDO::FETCH_OBJ)) {
                $linhas .= '<tr>
                                <td>' . $reg->id . '</td>
                                <td class="imagem_produto_listar"><img src="../../img/produtos/' . $reg->imagem . '" alt="' . $reg->titulo . '"></td>
                                <td>' . $reg->titulo . '</td>
                                <td class="operacoes"><a class="edita" title="Editar" onclick="confirma_editar(' . $reg->id . ')"><i class="pe-7s-note"></i></a> <a class="exclui" title="Excluir" onclick="confirma_excluir(' . $reg->id . ')"><i class="pe-7s-trash"></i></a></td>
                            </tr>';
            }
        } else {
            $linhas = '<tr><td>Nenhuma linha foi encontrada referente a sua busca!</td></tr>';
        }
        echo $linhas ;
    }
    
    public function qtdProdutos() {
        $pdo = parent::getDB();
        $listar = $pdo->prepare("SELECT * FROM produtos WHERE ativo = ?");
        $listar->bindValue(1, 1);
        $listar->execute();

        return $listar->rowCount();
    }
    
    public function excluirProduto($id) {
        $this->setId($id);
        $pdo = parent::getDB();
        $listar = $pdo->prepare("UPDATE produtos SET ativo = ? WHERE id = ?");
        $listar->bindValue(1, 0);
        $listar->bindValue(2, $this->getId());
        $executa = $listar->execute();
        if ($executa) {
            echo "<meta http-equiv='refresh' content='0;URL=produto-listar'>";
            echo "<script type='text/javascript'> alert('A produto foi excluída com sucesso!'); </script>";
        } else {
            echo "<meta http-equiv='refresh' content='0;URL=produto-listar'>";
            echo "<script type='text/javascript'> alert('Falha ao excluir produto!'); </script>";
        }
    }
    
    public function qtdDadosProduto($id) {
        $pdo = parent::getDB();
        $this->setId($id);
        $listar = $pdo->prepare("SELECT * FROM produtos WHERE ativo = ? AND id = ?");
        $listar->bindValue(1, 1);
        $listar->bindValue(2, $this->getId());
        $listar->execute();

        return $listar->rowCount();
    }
    
    public function dadosProduto($id) {
        $pdo = parent::getDB();
        $this->setId($id);
        $listar = $pdo->prepare("SELECT * FROM produtos WHERE ativo = ? AND id = ?");
        $listar->bindValue(1, 1);
        $listar->bindValue(2, $this->getId());
        $listar->execute();

        return $listar->fetch(PDO::FETCH_OBJ);
    }
    
    public function editarProduto() {
        if ($this->qtdDadosProduto($_GET['id']) >= 1) {
            $reg = $this->dadosProduto($_GET['id']);
            $dataPostagem = date('Y-m-d\TH:i', strtotime($reg->data_postagem));
            
            echo'   <div class="col-md-4 campoResponse">
                        <div class="card card-user">
                            <div class="image">

                            </div>
                            <div class="content">
                                <div class="form-group">
                                    <label>Imagem da Produto</label>
                                    <input type="file" class="form-control" name="arquivo" id="arquivo"  onchange="PreviewImage(this.value);">
                                </div>
                                <label style="text-align: center;width: 100%;">Preview</label><br>
                                <div class="preview_foto">
                                    <img id="uploadPreview" src="../../img/produtos/' . $reg->imagem . '"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 campoResponse">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Editar Produto</h4>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Produto*</label>
                                            <input type="text" class="form-control" placeholder="Título da Produto" name="titulo" value="' . $reg->titulo . '" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Texto Produto*</label>
                                            <textarea rows="5" class="form-control" placeholder="Texto Produto" name="textoProduto" required>' . $reg->texto . '</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Linha de Produtos*</label>
                                            <select name="linha" required>
                                                <option value="">Selecione</option>
                                                <option value="1" '.(($reg->linha == 1) ? 'selected' : '').'>Padre Victor</option>
                                                <option value="2" '.(($reg->linha == 2) ? 'selected' : '').'>Sorriso</option>
                                                <option value="3" '.(($reg->linha == 3) ? 'selected' : '').'>Mirand\'\ Ouro</option>
                                                <option value="4" '.(($reg->linha == 4) ? 'selected' : '').'>Marca Própria</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Data Postagem (OPCIONAL)</label>
                                            <input type="datetime-local" class="form-control" placeholder="Data Postagem" name="dataPostagem" value="'.$dataPostagem.'">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-info btn-fill pull-right">Editar Produto</button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>';
        }
    }
    
    public function salvarEdicaoProduto(){
        if(isset($_POST['titulo'])){
            $pdo = parent::getDB();

            $diretorio = '../../img/produtos/';
            $diretorioMiniatura = '../../img/produtos/miniatura/';
            $dados_produto = $this->dadosProduto($_GET['id']);
            $imagem_banco = $dados_produto->imagem;
            $add_foto = "";
            if ($_FILES['arquivo']['name'] != '') {
                $nome_img = $this->nome_unico($diretorio, $_FILES['arquivo']['name'], $_FILES['arquivo']['type']);
                $add_foto = "sim";
            } else {
                $nome_img = $imagem_banco;
                $add_foto = "nao";
            }

            $titulo = $_POST['titulo'];
            $linha = $_POST['linha'];
            $textoProduto = $_POST['textoProduto'];
            $dataPostagem = $_POST['dataPostagem'];
            $id = $_GET['id'];

            $editar = $pdo->prepare("UPDATE produtos set titulo = ?, linha = ?, texto = ?, imagem = ?, data_postagem = ? WHERE id=? ");
            $editar->bindValue(1, $titulo);
            $editar->bindValue(2, $linha);
            $editar->bindValue(3, $textoProduto);
            $editar->bindValue(4, $nome_img);
            $editar->bindValue(5, $dataPostagem);
            $editar->bindValue(6, $id);

            if ($editar->execute()) {
                if($add_foto == "sim"){
                    $this->salvaFotoInteiraMiniatura($_FILES['arquivo']['tmp_name'], $diretorio, $nome_img, $diretorioMiniatura, 223);
                }
                echo "<meta http-equiv='refresh' content='0;URL=produto-listar'>";
                echo "<script type='text/javascript'> alert('Os dados foram atualizados com sucesso!'); </script>";
            } else {
                echo "<meta http-equiv='refresh' content='0;URL=produto-listar'>";
                echo "<script type='text/javascript'> alert('Falha ao atualizar dados!'); </script>";
            }
        }
    }
    
    public function insereProduto() {
        if (isset($_POST['titulo'])) {

            $diretorio = '../../img/produtos/';
            $diretorioMiniatura = '../../img/produtos/miniatura/';
            $add_foto = "";
            if ($_FILES['arquivo']['name'] != '') {
                $nome_img = $this->nome_unico($diretorio, $_FILES['arquivo']['name'], $_FILES['arquivo']['type']);
                $add_foto = "sim";
            } else {
                $nome_img = "sem-imagem.jpg";
                $add_foto = "nao";
            }

            $titulo = $_POST['titulo'];
            $linha = $_POST['linha'];
            $textoProduto = $_POST['textoProduto'];
            $dataPostagem = $_POST['dataPostagem'];
            $ativo = 1;
            $url = $this->remover_caracter($_POST['titulo']);
        
            $pdo = parent::getDB();
            $cadastrar = $pdo->prepare("INSERT INTO produtos VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
            $cadastrar->bindValue(1, $titulo);
            $cadastrar->bindValue(2, $linha);
            $cadastrar->bindValue(3, $textoProduto);
            $cadastrar->bindValue(4, $nome_img);
            $cadastrar->bindValue(5, $url);
            $cadastrar->bindValue(6, $dataPostagem);
            $cadastrar->bindValue(7, $ativo);
            
            $executa = $cadastrar->execute();

            if ($executa) {
                if($add_foto == "sim"){
                    $this->salvaFotoInteiraMiniatura($_FILES['arquivo']['tmp_name'], $diretorio, $nome_img, $diretorioMiniatura, 295);
                }
                echo "<meta http-equiv='refresh' content='0;URL=produto-listar'>";
                echo "<script type='text/javascript'> alert('A produto foi adicionada com sucesso!'); </script>";
            } else {
                echo "<meta http-equiv='refresh' content='0;URL=produto-listar'>";
                echo "<script type='text/javascript'> alert('Falha ao adicionar produto!'); </script>";
            }
        }
    }
    
    //NOTÍCIAS
    
    public function qtd_noticias() {
        $pdo = parent::getDB();
        $listar = $pdo->prepare("SELECT * FROM blog WHERE ativo = ?");
        $listar->bindValue(1, 1);
        $listar->execute();

        return $listar->rowCount();
    }
    
    public function listar_noticias() {
        $pdo = parent::getDB();
        $listar = $pdo->prepare("SELECT * FROM blog WHERE ativo = ? ORDER BY data DESC");
        $listar->bindValue(1, 1);
        $listar->execute();
        $linhas = '';
        if ($listar->rowCount() >= 1) {
            $inoticia = new Blog();
            while ($reg = $listar->fetch(PDO::FETCH_OBJ)) {
                $id = $reg->id;
                $imagem = $reg->img;
                $descricao = $inoticia->descricaoBlog($reg->noticia);
                
                $linhas .= '<tr>
                                '.(($imagem != '') ? '<td class="imagem_produto_listar"><img src="../../img/blog/'. $imagem . '" alt="' . $reg->titulo . '"></td>' : '<td>Sem Imagem</td>').'
                                <td>' . $reg->titulo . '</td>
                                <td>' . $descricao . '</td>
                                <td>' . date('d/m/Y', strtotime($reg->data)) . '</td>
                                <td class="operacoes" width="130"><a class="edita" title="Editar" onclick="confirma_editar(' . $id . ')"><i class="pe-7s-note"></i></a> <a class="exclui" title="Excluir" onclick="confirma_excluir(' . $id . ')"><i class="pe-7s-trash"></i></a></td>
                            </tr>';
            }
        } else {
            $linhas = 'Ainda não foi cadastrado nenhum produto!';
        }
        echo $linhas;
    }
    
    public function descricaoNoticia($texto){
        $texto = strip_tags($texto);
        $texto = html_entity_decode($texto);
        $descricao = substr($texto,0,55);
        if(strlen($texto)>55){
            $descricao .= "..."; 
        }
        return trim($descricao);
    }

    public function listar_noticias_busca() {
        $pdo = parent::getDB();
        $listar = $pdo->prepare("SELECT * FROM blog WHERE ativo = ? AND (titulo LIKE '%".$_POST['palavra_chave']."%' OR noticia LIKE '%".$_POST['palavra_chave']."%') ORDER BY data DESC");
        $listar->bindValue(1, 1);
        $listar->execute();
        $linhas = '';
        if ($listar->rowCount() >= 1) {
            $inoticia = new Blog();
            while ($reg = $listar->fetch(PDO::FETCH_OBJ)) {
                $id = $reg->id;
                $imagem = $reg->img;
                $descricao = $inoticia->descricaoBlog($reg->noticia);
                
                $linhas .= '<tr>
                                '.(($imagem != '') ? '<td class="imagem_produto_listar"><img src="../../img/blog/'. $imagem . '" alt="' . $reg->titulo . '"></td>' : '<td>Sem Imagem</td>').'
                                <td>' . $reg->titulo . '</td>
                                <td>' . $descricao . '</td>
                                <td>' . date('d/m/Y', strtotime($reg->data)) . '</td>
                                <td class="operacoes"><a class="edita" title="Editar" onclick="confirma_editar(' . $id . ')"><i class="pe-7s-note"></i></a> <a class="exclui" title="Excluir" onclick="confirma_excluir(' . $id . ')"><i class="pe-7s-trash"></i></a></td>
                            </tr>';
            }
        } else {
            $linhas = '<tr><td>Nenhuma linha foi encontrada referente a sua busca!</td></tr>';
        }
        echo $linhas ;
    }
    
    public function excluir_noticia($id) {
        $this->setId($id);
        $pdo = parent::getDB();
        $listar = $pdo->prepare("UPDATE blog SET ativo = ? WHERE id = ?");
        $listar->bindValue(1, 'sim');
        $listar->bindValue(2, $this->getId());
        $executa = $listar->execute();
        if ($executa) {
            echo "<meta http-equiv='refresh' content='0;URL=noticia-listar'>";
            echo "<script type='text/javascript'> alert('A notícia foi excluída com sucesso!'); </script>";
        } else {
            echo "<meta http-equiv='refresh' content='0;URL=noticia-listar'>";
            echo "<script type='text/javascript'> alert('Falha ao excluir notícia!'); </script>";
        }
    }

    public function dados_noticia($id) {
        $pdo = parent::getDB();
        $this->setId($id);
        $listar = $pdo->prepare("SELECT * FROM blog WHERE ativo = ? AND id = ?");
        $listar->bindValue(1, 1);
        $listar->bindValue(2, $this->getId());
        $listar->execute();

        return $listar->fetch(PDO::FETCH_OBJ);
    }

    public function qtd_dados_noticia($id) {
        $pdo = parent::getDB();
        $this->setId($id);
        $listar = $pdo->prepare("SELECT * FROM blog WHERE ativo = ? AND id = ?");
        $listar->bindValue(1, 1);
        $listar->bindValue(2, $this->getId());
        $listar->execute();

        return $listar->rowCount();
    }

    public function tagsEmTexto($tags){
        $texto = '';
        if($tags != "" && $tags != NULL){
            $arrayTags = json_decode($tags, true);
            $total = count($arrayTags);
            $count = 1;
            foreach ($arrayTags as $tag){
                $texto .= $tag;
                $texto .= (($count < $total) ? ', ' : '');
                $count++;
            }
        }
        return $texto;
    }
    
    public function editar_noticia() {
        if ($this->qtd_dados_noticia($_GET['id']) >= 1) {
            $reg = $this->dados_noticia($_GET['id']);
            $imagem = $reg->img;
            
            echo'   <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">

                            </div>
                            <div class="content">
                                <div class="form-group">
                                    <label>Imagem da Notícia</label>
                                    <input type="file" class="form-control" name="arquivo" id="arquivo" onchange="PreviewImage(this.value);">
                                    <input type="hidden" value="'.$imagem.'" id="imgEnc"/>
                                </div>
                                <label style="text-align: center;width: 100%;">Preview</label><br>
                                <div class="preview_foto">
                                    <img id="uploadPreview" src="../../img/blog/' . $imagem . '"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Editar Notícia</h4>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input type="text" class="form-control" placeholder="Título" name="titulo" value="' . $reg->titulo . '" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Url (Opcional)</label>
                                            <input type="text" class="form-control" placeholder="Url" name="url" value="' . $reg->url . '">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Descrição (Opcional)</label>
                                            <textarea rows="5" class="form-control" placeholder="Descrição" name="descricao">' . $reg->descricao . '</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Texto</label>
                                            <textarea rows="5" class="form-control" placeholder="Texto" name="texto" id="texto">' . $reg->noticia  . '</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Fonte</label>
                                            <input type="text" class="form-control" placeholder="Fonte" name="fonte"  value="' . $reg->fonte . '" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tags para SEO (Opcional, porém importante)</label>
                                            <input type="text" class="form-control" placeholder="Tags para SEO" name="tags_seo"  value="' . $this->tagsEmTexto($reg->keywords_google) . '">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Exibir notícia:</label>
                                            <input type="checkbox" class="form-control" name="exibir_not" checked id="exibir_not" style="width:16px;height:16px" '.(($reg->exibir_not == 'S') ? 'checked' : '').'/>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Exibir imagem da capa abaixo do título da notícia:</label>
                                            <input type="checkbox" class="form-control" name="mostra_capa" checked id="mostra_capa" style="width:16px;height:16px" '.(($reg->mostra_capa == 'S') ? 'checked' : '').'/>
                                        </div>
                                    </div>
                                </div>
                                            
                                <button type="submit" class="btn btn-info btn-fill pull-right">Editar Notícia</button>
                                <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>';
        }
    }
    
    public function noticia($id) {
        $pdo = parent::getDB();
        $listar = $pdo->prepare("SELECT * FROM blog WHERE id = ? AND ativo = ?");
        $listar->bindValue(1, $id);
        $listar->bindValue(2, 1);
        $listar->execute();
        
        $noticia = $listar->fetch(PDO::FETCH_OBJ);
        return $noticia;
    }
    
    public function criaTags($tags){
        $explode = explode(",", $tags);
        $arrayTags = array();
        foreach ($explode as $tag){
            if($tag != ''){
                $tagEspaco = trim($tag);
                $arrayTags[Ferramentas::remover_caracter($tagEspaco)] = $tagEspaco;
            }
        }
        
        return json_encode($arrayTags);
    }
    
    public function salvar_edicao_noticia() {
        if (isset($_POST['titulo'])) {
            $this->setTitulo($_POST['titulo']);
            $url = (($_POST['url'] != '') ? $_POST['url'] : Ferramentas::remover_caracter($_POST['titulo']));
            $this->setUrl($url);
            $descricao = (($_POST['descricao'] != '') ? $_POST['descricao'] : $this->descricaoNoticia($_POST['texto']));
            $this->setDescricao($descricao);
            $this->setTexto($_POST['texto']);
            $this->setFonte($_POST['fonte']);
            $this->setTags_seo($this->criaTags($_POST['tags_seo']));
            
            $exibir_not = ((isset($_POST['exibir_not'])) ? 'S' : 'N');
            $mostra_capa = ((isset($_POST['mostra_capa'])) ? 'S' : 'N');

            $add_foto = "";
            $diretorio = '../../img/blog/';
            $diretorioMiniatura = '../../img/blog/miniatura/';
            
            $id = $_GET['id'];
            $dadosNoticia = $this->noticia($id);
            $imagem_banco = $dadosNoticia->img;
            if ($_FILES['arquivo']['name'] != '') {
                $nome_img = $this->nome_unico($diretorio, $_FILES['arquivo']['name'], $_FILES['arquivo']['type']);
                $add_foto = "sim";
            } else {
                $nome_img = $imagem_banco;
                $add_foto = "nao";
            }  
            
            $pdo = parent::getDB();
            $cadastrar = $pdo->prepare("UPDATE blog SET titulo = ?, url = ?, descricao = ?, noticia = ?, keywords_google = ?, fonte = ?, exibir_not = ?, mostra_capa = ?, img = ? WHERE id = ?");
            $cadastrar->bindValue(1, $this->getTitulo());
            $cadastrar->bindValue(2, $this->getUrl());
            $cadastrar->bindValue(3, $this->getDescricao());
            $cadastrar->bindValue(4, $this->getTexto());
            $cadastrar->bindValue(5, $this->getTags_seo());
            $cadastrar->bindValue(6, $this->getFonte());
            $cadastrar->bindValue(7, $exibir_not);
            $cadastrar->bindValue(8, $mostra_capa);
            $cadastrar->bindValue(9, $nome_img);
            $cadastrar->bindValue(10, $id);
            $executa = $cadastrar->execute();

            if ($executa) {
                if($add_foto == "sim"){
                    $this->salvaFotoInteiraMiniaturaAdaptada($_FILES["arquivo"]['tmp_name'], $diretorio, $nome_img, $nome_img, $diretorioMiniatura, 600, 600);
                }
                echo "<meta http-equiv='refresh' content='0;URL=noticia-listar'>";
                echo "<script type='text/javascript'> alert('A notícia foi editada com sucesso!'); </script>";
            } else {
                echo "<meta http-equiv='refresh' content='0;URL=noticia-listar'>";
                echo "<script type='text/javascript'> alert('Falha ao editar a notícia!'); </script>";
            }
        }
    }

    public function insere_noticia() {
        if (isset($_POST['titulo'])) {
            $inoticias = new Blog;
            $this->setTitulo($_POST['titulo']);
            $url = (($_POST['url'] != '') ? $_POST['url'] : Ferramentas::remover_caracter($_POST['titulo']));
            $this->setUrl($url);
            $descricao = (($_POST['descricao'] != '') ? $_POST['descricao'] : $inoticias->descricaoBlog($_POST['texto']));
            $this->setDescricao($descricao);
            $this->setTexto($_POST['texto']);
            $this->setFonte($_POST['fonte']);
            $this->setTags_seo($this->criaTags($_POST['tags_seo']));
            
            $ip = $_SERVER["REMOTE_ADDR"];
            $exibirNoticia = ((isset($_POST['exibir_not'])) ? 'S' : 'N');
            $exibirCapa = ((isset($_POST['mostra_capa'])) ? 'S' : 'N');
            $ativo = 1;
            
            $diretorio = '../../img/blog/';
            $diretorioMiniatura = '../../img/blog/miniatura/';
            $add_foto = "";
            if ($_FILES['arquivo']['name'] != '') {
                $nome_img = $this->nome_unico($diretorio, $_FILES['arquivo']['name'], $_FILES['arquivo']['type']);
                $add_foto = "sim";
            }else{
                $nome_img = "";
                $add_foto = "nao";
            }

            
            $pdo = parent::getDB();
            $cadastrar = $pdo->prepare("INSERT INTO blog VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $cadastrar->bindValue(1, $nome_img);
            $cadastrar->bindValue(2, $this->getTitulo());
            $cadastrar->bindValue(3, $this->getUrl());
            $cadastrar->bindValue(4, $this->getDescricao());
            $cadastrar->bindValue(5, $this->getTexto());
            $cadastrar->bindValue(6, $this->getTags_seo());
            $cadastrar->bindValue(7, $this->getFonte());
            $cadastrar->bindValue(8, $exibirCapa);
            $cadastrar->bindValue(9, date("Y-m-d H:i:s"));
            $cadastrar->bindValue(10, $ip);
            $cadastrar->bindValue(11, $exibirNoticia);
            $cadastrar->bindValue(12, $ativo);
            $executa = $cadastrar->execute();
            
            if ($executa) {
                if($add_foto == "sim"){
                    $this->salvaFotoInteiraMiniaturaAdaptada($_FILES["arquivo"]['tmp_name'], $diretorio, $nome_img, $nome_img, $diretorioMiniatura, 600, 600);
                }
                echo "<meta http-equiv='refresh' content='0;URL=noticia-listar'>";
                echo "<script type='text/javascript'> alert('A notícia foi adicionada com sucesso!'); </script>";
            } else {
                echo "<meta http-equiv='refresh' content='0;URL=noticia-listar'>";
                echo "<script type='text/javascript'> alert('Falha ao adicionar notícia!'); </script>";
            }
        }
    }
    
    public function salvaFotoInteiraMiniaturaAdaptada($imagem_temp, $diretorio, $nome_img, $nome_imgMenor, $diretorioMiniatura, $padraow, $padraoh=null){
        move_uploaded_file($imagem_temp, $diretorio . $nome_img);
        $cortarimg = $diretorio . $nome_img;
        $diretorioMiniatura .= $nome_imgMenor;
        require_once "../../lib/WideImage.php";
        $image = WideImage::load($cortarimg);
        $tamanho = getimagesize($cortarimg);
        
        if($padraoh == null){
            $padraoh = $padraow;
        }
        
        if($tamanho['0'] >= $tamanho['1']){
            if($tamanho['0'] == $tamanho['1']){
                $maior = $padraoh;
                if($padraow > $padraoh){
                    $maior = $padraow;
                }
                $height = $maior;
                $width  = $maior;
            }else{
                $height = $padraoh;
                $width  = (($tamanho['0'] * $padraoh) / $tamanho['1']);
            }
        }else{
            $height = (($tamanho['1'] * $padraow) / $tamanho['0']);
            $width  = $padraow;
        }

        $image = $image->resize($width, $height);		
        $image = $image->crop('center', 'center', $padraow, $padraoh);
        $image->saveToFile($diretorioMiniatura);
        //$permissaointerira = "/home/gtamultimidia/Web/images/portfolio/full/".$nomeimg2;
        //$permissaominiatura = "/home/gtamultimidia/Web/images/portfolio/recent/".$nomeimg2;
        //chmod($permissaointerira, 0750);
        //chmod($permissaominiatura, 0750);
    }
    
    function  pegaFormato($tipo){
        $extensao = explode('/', $tipo);
        return $extensao[1];
    }
    
    function nome_unico($diretorio, $buscar_nome, $tipo) {
        if (file_exists($diretorio . $buscar_nome)) {
            $array = explode(".", $buscar_nome);
            $tipo_final = $tipo;
            $result = count($array);
            $nomeimg = "";
            for ($i = 0; $i < $result - 1; $i++) {
                $nomeimg .= $array[$i];
            }
            $num = 0;
            $extensao = explode('/', $tipo_final);
            $nomeimg2 = $nomeimg . '_' . "$num" . '.' . $extensao[1];

            while (file_exists($diretorio . $nomeimg2)) {
                $num++;
                $nomeimg2 = $nomeimg . '_' . "$num" . '.' . $extensao[1];
            }
        } else {
            $tipo_final = $tipo;
            $nomeimg2 = $buscar_nome;
        }
        return $nomeimg2;
    }
    
    /*USUÁRIO*/
    
    /* Função para verificar se o e-mail já estão em uso */

    function verifica_email($email) {
        $this->setEmail($email);
        $pdo = parent::getDB();

        if ($this->getEmail() !== $_SESSION['emailAdm']) {
            $logar = $pdo->prepare("SELECT * FROM administradores WHERE email = ?");
            $logar->bindValue(1, $this->getEmail());

            $logar->execute();
            if ($logar->rowCount() >= 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        return FALSE;
    }
    
    public function salvar_edicao_usuario() {
        if (isset($_POST['email'])) {

            $this->setNome($_POST['nome']);
            $this->setEmail($_POST['email']);
            $this->setId($_SESSION['idUsuarioAdm']);

            $verifica_email = $this->verifica_email($this->getEmail());

            if ($verifica_email != TRUE) {
                $pdo = parent::getDB();
                $cadastrar = $pdo->prepare("UPDATE administradores SET nome = ?, email = ? WHERE id = ?");
                $cadastrar->bindValue(1, $this->getNome());
                $cadastrar->bindValue(2, $this->getEmail());
                $cadastrar->bindValue(3, $this->getId());

                $executa = $cadastrar->execute();
                if ($executa) {
                    echo "<meta http-equiv='refresh' content='0;URL=usuario-editar'>";
                    echo "<script type='text/javascript'> alert('Seus dados foram editados com sucesso!'); </script>";
                } else {
                    echo "<meta http-equiv='refresh' content='0;URL=usuario-editar'>";
                    echo "<script type='text/javascript'> alert('Falha ao editar dados!'); </script>";
                }
            } else {
                echo "<meta http-equiv='refresh' content='0;URL=usuario-editar'>";
                echo "<script type='text/javascript'> alert('Não foi possível atualizar seus dados, o E-mail já está em uso!'); </script>";
            }
        }
    }
    
    public function remover_caracter($string) {
        $string = trim($string);
        $string = preg_replace("/(á|à|â|ã|ä|Á|À|Â|Ã|Ä)/", "a", $string);
        $string = preg_replace("/(é|è|ê|É|È|Ê)/", "e", $string);
        $string = preg_replace("/(í|ì|Í|Ì)/", "i", $string);
        $string = preg_replace("/(ó|ò|ô|õ|ö|Ó|Ò|Ô|Õ|Ö)/", "o", $string);
        $string = preg_replace("/(ú|ù|ü|Ú|Ù|Ü)/", "u", $string);
        $string = preg_replace("/(ç|Ç)/", "c", $string);
        $string = preg_replace("(/)", "", $string);
        $string = preg_replace("/[][><}{)(:;,.!?*%~^`&#@]/", "", $string);
        $string = preg_replace("/( )/", "-", $string);
        $string = preg_replace("/(--)/", "-", $string);
        $string = preg_replace("(--)", "-", $string);
        $string = preg_replace("(  | |®)", "", $string);
        $string = strtolower($string);            
        return $string;
    }

    public function salvaFotoInteiraMiniatura($imagem_temp, $diretorio, $nome_img, $diretorioMiniatura, $width){
        move_uploaded_file($imagem_temp, $diretorio . $nome_img);
        $cortarimg = $diretorio . $nome_img;
        $diretorioMiniatura .= $nome_img;
        require_once "../../lib/WideImage.php";
        $image = WideImage::load($cortarimg);
        $tamanho = getimagesize($cortarimg);
        $height = (($tamanho['1'] * $width) / $tamanho['0']);
        $image = $image->resize($width, $height);		
        $image = $image->crop('center', 'center', 223, 223);
        $image->saveToFile($diretorioMiniatura);
        //$permissaointerira = "/home/gtamultimidia/Web/images/portfolio/full/".$nomeimg2;
        //$permissaominiatura = "/home/gtamultimidia/Web/images/portfolio/recent/".$nomeimg2;
        //chmod($permissaointerira, 0750);
        //chmod($permissaominiatura, 0750);
    }
    
    public function form_usuario() {
        $pdo = parent::getDB();
        $listar = $pdo->prepare("SELECT * FROM administradores WHERE ativo = ? AND id = ?");
        $listar->bindValue(1, 1);
        $listar->bindValue(2, $_SESSION['idUsuarioAdm']);
        $listar->execute();

        if ($listar->rowCount() >= 1) {
                $reg = $listar->fetch(PDO::FETCH_OBJ);
                echo '  <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" name="nome" placeholder="Nome" value="' . $reg->nome . '">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" class="form-control" name="email" placeholder="E-mail" value="' . $reg->email . '">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info btn-fill pull-right">Alterar Dados</button>
                        <div class="clearfix"></div>';
        }
    }

}

?>