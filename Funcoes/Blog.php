<?php

class Blog extends Conexao{
   
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
    
    public function blogHome() {
        $ultimas = '';
        
        $pdo = parent::getDB();
        $listar = $pdo->prepare("SELECT * FROM blog WHERE exibir_not = ? AND ativo = ? ORDER BY data DESC LIMIT 4");
        $listar->bindValue(1, 'S');
        $listar->bindValue(2, 1);
        $listar->execute();
        $total = $listar->rowCount();
        
        if($total > 0){
            while($reg = $listar->fetch(PDO::FETCH_OBJ)){
                $ultimas .=   '<div class="col-md-6">
                                    <div class="item_blog_home">
                                        <a href="blog/'.$reg->url.'">
                                            <div class="corpoBlog">
                                                <div class="miniaturaBlog">
                                                    <img src="img/blog/'.$reg->img.'" alt="'.$reg->titulo.'">
                                                </div>
                                                <div class="conteudoBlog">
                                                    <div class="flutuanteTexto">
                                                        <h3>'.$reg->titulo.'</h3>
                                                        <p>'.$reg->descricao.'</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>';
            }
        }
        
        return $ultimas;
    }

    
    public function tituloBlog() {
        $titulo = "";
        if(isset($_GET['url'])){
            $pdo = parent::getDB();
            
            $url = $_GET['url'];
            $listar = $pdo->prepare("SELECT titulo FROM blog WHERE excluida = ? AND url = ?");
            $listar->bindValue(1, 'nao');
            $listar->bindValue(2, $url);
            $listar->execute();
            $total = $listar->rowCount();
            if($total > 0){
                $titulo = $listar->fetch(PDO::FETCH_OBJ)->titulo;
            }else{
                $titulo = "Notícia não encontrada.";
            }
        }else{
            $titulo = "Notícia não encontrada.";
        }
        
        return $titulo;
    }
      
    public function procuraImagemId($id, $diretorio){
        $imagemOriginal = "";
        $extensoes = array(".jpg", ".png", ".jpeg");
        foreach ($extensoes as $extensao){
            $procurapor = $id.$extensao;
            if(file_exists($diretorio.$procurapor)){
                $imagemOriginal = $procurapor;
            }
        }
        return $imagemOriginal;
    }
    
    public function tags($tags) {
        $arrayTags = json_decode($tags, true);
        $conteudo = '<div class="tags">';
        foreach ($arrayTags as $key => $tag){
            $conteudo .= '<a href="blog/tag/'.$key.'">'.$tag.'</a>';
        }
        $conteudo .= '</div>';
        
        return $conteudo;
    }
    
    public function exibeBlog() {
        $blog = "";
        if(isset($_GET['url'])){
            $pdo = parent::getDB();
            
            $url = $_GET['url'];
            $listar = $pdo->prepare("SELECT * FROM blog WHERE ativo = ? AND url = ?");
            $listar->bindValue(1, 1);
            $listar->bindValue(2, $url);
            $listar->execute();
            $total = $listar->rowCount();

            if($total > 0){
                while($reg = $listar->fetch(PDO::FETCH_OBJ)){
                    $imagem = $reg->img;
                    
                    if($reg->mostra_capa == 'N'){
                        $img = '';
                    }else{
                        $img = '<img src="img/blog/'.$imagem.'" alt="'.$reg->titulo.'" class="imagemCapa"/>';
                    }
                    
                    $blog =    '<div class="intro_noticias_home topo_paginas">
                                    <div class="max_pg">
                                        <h1>'.$reg->titulo.'</h1>
                                    </div>
                                </div>
                                <div class="pg_depoimentos blog">
                                    <div class="max_pg">
                                        <div class="row" style="padding-top: 30px;">
                                            <p class="dataBlog">'.date('d/m/Y', strtotime($reg->data)).'</p>
                                            '.$img.'
                                            <br>
                                            <p class="textoBlogPg">'.$reg->noticia.'</p>
                                            <br>
                                            '.$this->tags($reg->keywords_google).'
                                            <br>
                                            <p style="text-align:justify;"><b style="font-size:18px !Important;">Ficou alguma dúvida ou tem alguma sugestão? Participe do nosso Blog deixando sua mensagem.</b></p>

                                            <div class="fb-comments" data-href="http://www.padrevictorcafe.com.br/blog/' . $reg->url . '" data-width="500" data-order-by="reverse_time" data-numposts="8"></div>

                                            <p class="txtCompartilhe">Compartilhe</p>

                                            <div class="grupoCompartilhe">
                                                <a class="compWhats" target="_blank" href="https://api.whatsapp.com/send?text=http://www.padrevictorcafe.com.br/blog/'.$reg->url.'"><i class="fa fa-whatsapp"></i></a>
                                                <a class="compLink"  target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=http://www.padrevictorcafe.com.br/blog/'.$reg->url.'"><i class="fa fa-linkedin"></i></a>
                                                <a class="compFace"  target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://www.padrevictorcafe.com.br/blog/'.$reg->url.'"><i class="fa fa-facebook"></i></a>
                                                <a href="javascript:void(0)" onclick="share()" class="compGeral"><i class="fa fa-share-alt"></i></a>
                                            </div>
                                            
                                            <a href="blog" class="botaoSaibaMais botao1">&#9666; VOLTAR</a>
                                            <br><br>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>';
                }
            }else{
                //$blog = "<p>Notícia não encontrada.</p>";
            }
        }else{
            //$blog = "<p>Notícia não encontrada.</p>";
        }
        
        return $blog;
    }
    
    public function descricaoBlog($texto){
        $texto = strip_tags($texto);
        $texto = html_entity_decode($texto);
        $descricao = substr($texto,0,55);
        if(strlen($texto)>55){
            $descricao .= "..."; 
        }
        return $descricao;
    }
    
    public function tagsToticiaDetalhe() {
        $pdo = parent::getDB();
        $url = (isset($_GET['url']) ? $_GET['url'] : '');
        $listar = $pdo->prepare("SELECT * FROM blog WHER WHERE ativo = ? AND url = ?");
        $listar->bindValue(1, 1);
        $listar->bindValue(2, $url);
        $listar->execute();
        $total = $listar->rowCount();
        
        $metas = "";
        if($total > 0){
            while($reg = $listar->fetch(PDO::FETCH_OBJ)){
                $imagem = $reg->img;

                if($imagem != ""){
                    $size = getimagesize ('img/blog/'.$imagem.'');
                    $larguraImg =  $size[0];
                    $alturaImg =  $size[1];
                    $tipoImg =  $size['mime'];
                }
	
                $metas .=  '<title>'.$reg->titulo.'</title>
                            <link rel="canonical" href="http://www.padrevictorcafe.com.br/blog/'.$reg->url.'">
                            <meta name="title" content="'.$reg->titulo.'">
                            <meta name="description" content="'.$reg->descricao.'">
                            <meta name="abstract" content="'.$reg->descricao.'">
                            <meta name="comment" CONTENT="'.$reg->keywords_google.'">
                            <meta name="keywords" content="'.$reg->keywords_google.'">

                            <META name="REVISIT-AFTER" content="5 days">
                            <META name="LANGUAGE" content="PT-BR">
                            <META name="AUTHOR" content="GTA Multimidia">
                            <META name="ROBOTS" content="index, follow">
                            <META name="GOOGLEBOT" content="INDEX, FOLLOW">
                            <meta name="audience" content="all">

                            <meta property="og:locale" content="pt_BR" />
                            <meta property="og:type" content="website" />
                            <meta property="og:title" content="'.$reg->titulo.'" />
                            <meta property="og:description" content="'.$reg->descricao.'" />
                            <meta property="og:image" content="http://www.padrevictorcafe.com.br/blog/'.$reg->img.'" />
                            <meta property="og:url" content="http://www.padrevictorcafe.com.br/blog/'.$reg->url.'" />
                            <meta property="og:site_name" content="Café Padre Victor - Sua dose diária de energia" />
                            <meta property="og:street-address" content="Rua Ismael de Souza, 69 - Centro"/>
                            <meta property="og:locality" content="Três Pontas"/>
                            <meta property="og:region" content="MG"/>
                            <meta property="og:country-name" content="Brasil"/>';
            }
        }else{
            $metas =   '<title>Blog | Café Padre Victor - Sua dose diária de energia</title>
                        <link rel="canonical" href="http://www.padrevictorcafe.com.br/blog">
                        <meta name="title" content="Blog | Café Padre Victor - Sua dose diária de energia">
                        <meta name="description" content="DESCRICAO AQUI">
                        <meta name="abstract" content="DESCRICAO AQUI">
                        <meta name="comment" CONTENT="PALAVRAS CHAVES AQUI">
                        <meta name="keywords" content="PALAVRAS CHAVES AQUI">

                        <META name="REVISIT-AFTER" content="5 days">
                        <META name="LANGUAGE" content="PT-BR">
                        <META name="AUTHOR" content="GTA Multimidia">
                        <META name="ROBOTS" content="index, follow">
                        <META name="GOOGLEBOT" content="INDEX, FOLLOW">
                        <meta name="audience" content="all">

                        <meta property="og:locale" content="pt_BR" />
                        <meta property="og:type" content="website" />
                        <meta property="og:title" content="Blog | Café Padre Victor - Sua dose diária de energia" />
                        <meta property="og:description" content="DESCRICAO AQUI" />
                        <meta property="og:image" content="http://www.padrevictorcafe.com.br/img/logo.png" />
                        <meta property="og:url" content="http://www.padrevictorcafe.com.br/" />
                        <meta property="og:site_name" content="Café Padre Victor - Sua dose diária de energia" />
                        <meta property="og:street-address" content="Rua Ismael de Souza, 69 - Centro"/>
                        <meta property="og:locality" content="Três Pontas"/>
                        <meta property="og:region" content="MG"/>
                        <meta property="og:country-name" content="Brasil"/>';
        }
        return $metas;
    }
    
    public function listarTodosBlog() {
        $pdo = parent::getDB();
        $limite = 6;
        $pg = (isset($_GET['pg'])) ? (int) $_GET['pg'] : 1;
        $inicio = ($pg * $limite) - $limite;
        
        $tag = ((isset($_GET['tag'])) ? "AND keywords_google LIKE '%".$_GET['tag']."%'" : "");
        //$pesquisandoPor = ((isset($_GET['tag'])) ? "<p>Resultados para a TAG: ".$_GET['tag']."</p>" : "");
        $pesquisandoPor = ((isset($_GET['tag'])) ? "<p>TAGS relacionadas:</p>" : "");
        
        $listar = $pdo->prepare("SELECT * FROM blog WHERE ativo = ? $tag ORDER BY data DESC LIMIT ". $inicio . ", " . $limite);
	$listar->bindValue(1, 1);
        $listar->execute();
        $total = $listar->rowCount();
        
        $listarPaginacao = $pdo->prepare("SELECT * FROM blog WHERE ativo = ? $tag ORDER BY data DESC");
	$listarPaginacao->bindValue(1, 1);
        $listarPaginacao->execute();
        $totalPaginacao = $listarPaginacao->rowCount();

        $qtdPag = ceil($totalPaginacao / $limite);
        $prox = ($pg + 1);
        $ant = ($pg - 1);
        
        $blog =    '<div class="intro_noticias_home topo_paginas">
                        <div class="max_pg">
                            <h1>Nosso Blog</h1>
                        </div>
                    </div>

                    <div class="pg_depoimentos blog_home">
                    <div class="max_pg">
                        <div class="row" style="padding-top: 30px;">
                        '.$pesquisandoPor;
        
        if($total > 0){
            while($reg = $listar->fetch(PDO::FETCH_OBJ)){                                                   
                $blog .= '<div class="col-md-6">
                                <div class="item_blog_home">
                                    <a href="blog/'.$reg->url.'">
                                        <div class="corpoBlog">
                                            <div class="miniaturaBlog">
                                                <img src="img/blog/'.$reg->img.'" alt="'.$reg->titulo.'">
                                            </div>
                                            <div class="conteudoBlog">
                                                <div class="flutuanteTexto">
                                                    <h3>'.$reg->titulo.'</h3>
                                                    <p>'.$reg->descricao.'</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>';
                
            }
            $blog .=   '</div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div style="clear:both"></div>'.$this->estruturaPaginacao($qtdPag, $pg, $prox, $ant, $tag);
        }else{
            $blog = "<p>Nenhuma notícia foi encontrada</p>";
        }
        return $blog;
    }
    
    public function estruturaPaginacao($qtdPag, $pg, $prox, $ant, $tag){
        $paginacao = '';
        $tagUrl = (($tag != "") ? 'tag/'.$_GET['tag'].'/' : '');
        
        if ($qtdPag != 0) {
            $paginacao .= '<div class="divPaginacao">';
            $paginacao .= '<ul class="paginacao">';
            if ($pg > 1) {
                $paginacao .= '<li><a href="blog/'.$tagUrl.'pg/'.$ant.'">&#9664;</a></li>';
            } else {
                $paginacao .= '<li class="desativado"><a href="#">&#9664;</a></li>';
            }

            if ($qtdPag >= 1 && $pg <= $qtdPag) {
                for ($i = 1; $i <= $qtdPag; $i++) {
                    if ($i == $pg) {
                        $paginacao .= '<li ' . ( ($pg == $i) ? 'class="ativo"' : '' ) . '><a href="#">' . $i . '</a></li>';
                    } else {
                        if ((($i == 3 ) && ($pg >= 6)) || ($i == $qtdPag - 2 ) && ($qtdPag - $pg > 4)) {
                            $paginacao .= "<li><a href='#'>...</a></li>";
                        }
                        if (($i == 1 ) || ($i == 2 ) || ($i == $pg - 2 ) || ($i == $pg - 1) || ($i == $pg + 1 ) || ($i == $pg + 2) || ($i == $qtdPag - 1) || ($i == $qtdPag)) {
                            $paginacao .= "<li><a " . ( ($pg == $i) ? 'class="ativo"' : '' ) . " href='blog/'.$tagUrl.'pg/$i'>" . $i . "</a></li>";
                        }
                    }
                }
            }

            if ($pg < $qtdPag) {
                $paginacao .= '<li><a href="blog/'.$tagUrl.'pg/'.$prox.'">&#9654;</a></li>';
            } else {
                $paginacao .= '<li class="desativado"><a href="#">&#9654;</a></li>';
            }
            $paginacao .= '<div class="clearfix"></div></ul></div>';
        }
        return $paginacao;
    }
    
    function dataEmPortugues($timestamp, $hours = FALSE, $timeZone = "Europe/Lisbon") {

        $dia_num = date("w", $timestamp); // Dia da semana.

        if ($dia_num == 0) {
            $dia_nome = "Domingo";
        } elseif ($dia_num == 1) {
            $dia_nome = "Segunda";
        } elseif ($dia_num == 2) {
            $dia_nome = "Terça";
        } elseif ($dia_num == 3) {
            $dia_nome = "Quarta";
        } elseif ($dia_num == 4) {
            $dia_nome = "Quinta";
        } elseif ($dia_num == 5) {
            $dia_nome = "Sexta";
        } else {
            $dia_nome = "Sábado";
        }

       
        
        $dia_mes = date("d", $timestamp); // Dia do mês

        $mes_num = (int) date("m", $timestamp); // Nome do mês

        switch($mes_num){
            case 1:
                $mes_nome = "Janeiro";
                break;
            case 2:
                $mes_nome = "Fevereiro";
                break;
            case 3:
                $mes_nome = "Março";
                break;
            case 4:
                $mes_nome = "Abril";
                break;
            case 5:
                $mes_nome = "Maio";
                break;
            case 6:
                $mes_nome = "Junho";
                break;
            case 7:
                $mes_nome = "Julho";
                break;
            case 8:
                $mes_nome = "Agosto";
                break;
            case 9:
                $mes_nome = "Setembro";
                break;
            case 10:
                $mes_nome = "Outubro";
                break;
            case 11:
                $mes_nome = "Novembro";
                break;
            case 12:
                $mes_nome = "Dezembro";
                break;
        }
        
        $ano = date("Y", $timestamp); // Ano

        date_default_timezone_set($timeZone); // Set time-zone
        $hora = date("H:i", $timestamp);

        if ($hours) {
            //return $dia_nome . ", " . $dia_mes . " de " . $mes_nome . " de " . $ano . " - " . $hora;
            return $dia_mes . " de " . $mes_nome . ", " . $ano;
        } else {
            //return $dia_nome . ", " . $dia_mes . " de " . $mes_nome . " de " . $ano;
            return $dia_mes . " de " . $mes_nome . ", " . $ano;
        }
    }

}

?>