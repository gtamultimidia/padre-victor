<?php

/* CLASSE DE BUSCA NO SISTEMA */

class Busca extends Conexao {

    /* Função para filtrar os resultados de acordo com a busca realizada pelo usuário */

    public function retiraAcentuacao($string){
        return preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $string ) );
    }
    
    public function buscar() {
        $palavraBusca = trim($this->retiraAcentuacao(mb_strtolower($_GET["busca"])));
        
        $buscaProdutos = $this->buscaProdutos($palavraBusca);
        $conteudoProdutos = $buscaProdutos[0];
        $paginacaoProdutos = $buscaProdutos[1];
        $totalProdutos = $buscaProdutos[2];
        
        $buscaBlog = $this->buscaBlog($palavraBusca);
        $conteudoBlog = $buscaBlog[0];
        $paginacaoBlog = $buscaBlog[1];
        $totalBlog = $buscaBlog[2];

        $produtos = (($conteudoProdutos != "") ? "<div id='itensNoticias'><b class='tituloTexto'>Produtos</b><br><div class='produtosLinha'>".$conteudoProdutos."</div><br>".$paginacaoProdutos."<br></div>" : "");
        $noticias = (($conteudoBlog != "") ? "<div id='itensNoticias'><b class='tituloTexto'>Blog</b><br>".$conteudoBlog."<br>".$paginacaoBlog."<br></div>" : "");
        
        $textoEncontrados = "";
        
        $encontrados = $totalProdutos+$totalBlog;
        
        if($encontrados == 0){
            $textoEncontrados = "<b class='tituloTexto'>Ops!</b><br>Não encontramos resultados referentes a sua pesquisa :(<br><br>";
        }
        
        return  $produtos.
                $noticias.
				$textoEncontrados;
    }
    
    public function estruturaPaginacao($qtdPag, $pg, $prox, $ant, $palavraBusca){
        $paginacao = '';
        if ($qtdPag != 0) {
            $paginacao .= '<div class="divPaginacao"><ul class="paginacao centraliza" >';
            if ($pg > 1) {
                $paginacao .= '<li><a href="buscar?busca=' . $palavraBusca . '&pg=' . $ant . '"><i class="fa fa-long-arrow-left"></i>Pág. Anterior</a></li>';
            } else {
                //$paginacao .= '<a  class="block_botao anteriorapg">< Ant.</a>';
            }

            if ($qtdPag >= 1 && $pg <= $qtdPag) {
                for ($i = 1; $i <= $qtdPag; $i++) {
                    $divisor = (($i < $qtdPag) ? "<li class='divisorPg'>|</li>" : "");
                    
                    if ($i == $pg) {
                        $paginacao .= "<li><a href='buscar?busca='.$palavraBusca.'&pg=1' " . ( ($pg == $i) ? 'class="ativo"' : '' ) . ">" . $i . "</a></li>$divisor";
                    } else {
                        if ((($i == 3 ) && ($pg >= 6)) || ($i == $qtdPag - 2 ) && ($qtdPag - $pg > 4)) {
                            $paginacao .= "<li><a class='link-pag'>...</a></li>$divisor";
                        }
                        if (($i == 1 ) || ($i == 2 ) || ($i == $pg - 2 ) || ($i == $pg - 1) || ($i == $pg + 1 ) || ($i == $pg + 2) || ($i == $qtdPag - 1) || ($i == $qtdPag)) {
                            $paginacao .= "<li><a href='buscar?busca=" . $palavraBusca . "&pg=$i' " . ( ($pg == $i) ? 'class="ativo"' : '' ) . ">" . $i . "</a></li>$divisor";
                        }
                    }
                }
            }

            if ($pg < $qtdPag) {
                $proxima = '<li><a href="buscar?busca=' . $palavraBusca . '&pg=' . $prox . '">Próxima Pág.<i class="fa fa-long-arrow-right"></i></a></li>';
            } else {
                //$proxima = '<a  class="block_botao proximapg">Próx. ></a>';
                $proxima = "";
            }
            $paginacao .= ''.$proxima.'</ul></div>';
        }
        return $paginacao;
    }
    
    public function buscaBlog($palavraBusca){
        $pdo = parent::getDB();

        /* Select realizado para pegar o total de registros encontrados */
        $listar = $pdo->prepare("SELECT * FROM blog WHERE ativo = ? AND ((titulo LIKE '%$palavraBusca%') OR (descricao LIKE '%$palavraBusca%') OR (noticia LIKE '%$palavraBusca%') OR (fonte LIKE '%$palavraBusca%'))");
        $listar->bindValue(1, 1);
        $listar->execute();

        /* total de registros encontrados */
        $totalCampos = $listar->rowCount();

        /* ----Variáveis da paginação----- */
        $limite = 9;
        $pg = (isset($_GET['pg'])) ? (int) $_GET['pg'] : 1;
        $inicio = ($pg * $limite) - $limite;
        /* ----Variáveis da paginação----- */

        /* Select exibir os registros de acordo com a página e a busca. */
        $listar = $pdo->prepare("SELECT * FROM blog WHERE ativo = ? AND ((titulo LIKE '%$palavraBusca%') OR (descricao LIKE '%$palavraBusca%') OR (noticia LIKE '%$palavraBusca%') OR (fonte LIKE '%$palavraBusca%')) LIMIT " . $inicio . ", " . $limite);
        $listar->bindValue(1, 1);
        $listar->execute();

        $qtdPag = ceil($totalCampos / $limite);
        $ant = $pg - 1;
        $prox = $pg + 1;

        //$resultado = "<p><b>Registros encontrados: " . $totalCampos . "</b></p><br><div class='row'>";
        $conteudo = '';
        
        $encontrados = 0;
        
        if ($totalCampos > 0) {
            while ($reg = $listar->fetch(PDO::FETCH_OBJ)) {
                $conteudo .= "<a href='blog/$reg->url' class='link'>&bull; $reg->titulo</a><br>";
                $encontrados++;
            }
        }
        
        $paginacao = $this->estruturaPaginacao($qtdPag, $pg, $prox, $ant, $palavraBusca);
        
        return array($conteudo, $paginacao, $totalCampos);
    }
    
    public function buscaProdutos($palavraBusca){
        $pdo = parent::getDB();

        /* Select realizado para pegar o total de registros encontrados */
        $listar = $pdo->prepare("SELECT * FROM produtos WHERE ativo = ? AND ((titulo LIKE '%$palavraBusca%') OR (texto LIKE '%$palavraBusca%'))");
        $listar->bindValue(1, 1);
        $listar->execute();

        /* total de registros encontrados */
        $totalCampos = $listar->rowCount();

        /* ----Variáveis da paginação----- */
        $limite = 9;
        $pg = (isset($_GET['pg'])) ? (int) $_GET['pg'] : 1;
        $inicio = ($pg * $limite) - $limite;
        /* ----Variáveis da paginação----- */

        /* Select exibir os registros de acordo com a página e a busca. */
        $listar = $pdo->prepare("SELECT * FROM produtos WHERE ativo = ? AND ((titulo LIKE '%$palavraBusca%') OR (texto LIKE '%$palavraBusca%')) LIMIT " . $inicio . ", " . $limite);
        $listar->bindValue(1, 1);
        $listar->execute();

        $qtdPag = ceil($totalCampos / $limite);
        $ant = $pg - 1;
        $prox = $pg + 1;

        //$resultado = "<p><b>Registros encontrados: " . $totalCampos . "</b></p><br><div class='row'>";
        $conteudo = '';
        
        $encontrados = 0;
        
        if ($totalCampos > 0) {
            while ($reg = $listar->fetch(PDO::FETCH_OBJ)) {
                $conteudo .=   '<div class="itemProduto">
                                    <div class="corpoProduto">
                                        <div class="divImgProduto"><img src="img/produtos/'.$reg->imagem.'" alt="'.$reg->titulo.'" class="imgProduto"/></div>
                                        <div class="divConteudoProduto">
                                            <h3 class="tituloProduto">'.$reg->titulo.'</h3>
                                        </div>
                                    </div>
                                </div>';
                $encontrados++;
            }
        }
        
        $paginacao = $this->estruturaPaginacao($qtdPag, $pg, $prox, $ant, $palavraBusca);
        
        return array($conteudo, $paginacao, $totalCampos);
    }

}

?>