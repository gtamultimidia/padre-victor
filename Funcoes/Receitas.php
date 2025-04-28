<?php

class Receitas extends Conexao{
   
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
    
    public function exibeReceita() {
        $receita = "";
        if(isset($_GET['url'])){
            $pdo = parent::getDB();
            
            $url = $_GET['url'];
            $listar = $pdo->prepare('SELECT * FROM `receitas` WHERE ativo = ? AND (data_postagem <= ? OR data_postagem IS NULL) AND url = ? LIMIT 1');
            $listar->bindValue(1, 1);
            $listar->bindValue(2, date('Y-m-d H:i:s'));
            $listar->bindValue(3, $url);
            $listar->execute();
            $total = $listar->rowCount();

            if($total > 0){
                while($reg = $listar->fetch(PDO::FETCH_OBJ)){
                    $receita = '<div class="textoReceita">
                                    <h1>' . $reg->titulo . '</h1>
                                    <p>' . $reg->receita . '</p>
                                </div>
                                <div class="imagemReceita">
                                    <img src="img/receitas/miniatura/' . $reg->imagem . '" alt="' . $reg->titulo . '"/>
                                </div>';
                }
            }else{
                $receita = "<p>Receita não encontrada.</p>";
            }
        }else{
            $receita = "<p>Receita não encontrada.</p>";
        }
        
        return $receita;
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
                            <link rel="canonical" href="https://www.grippseguros.com.br/blog/'.$reg->url.'">
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
                            <meta property="og:image" content="https://www.grippseguros.com.br/img/blog/'.$reg->img.'" />
                            <meta property="og:url" content="https://www.grippseguros.com.br/blog/'.$reg->url.'" />
                            <meta property="og:site_name" content="Gripp Seguros | Varginha - MG" />
                            <meta property="og:street-address" content="Av. Princesa do Sul, 890 - Jardim Andere"/>
                            <meta property="og:locality" content="Varginha"/>
                            <meta property="og:region" content="MG"/>
                            <meta property="og:country-name" content="Brasil"/>';
            }
        }else{
            $metas =   '<title>Blog | Gripp Seguros</title>
                        <link rel="canonical" href="https://www.grippseguros.com.br/blog">
                        <meta name="title" content="Blog | Gripp Seguros">
                        <meta name="description" content="A Gripp tem o seguro que você está procurando. Assegure você, sua família e sua empresa. Cotação online de Seguro Auto, Seguro Residencial, Seguro de Vida, Seguro Viagem.">
                        <meta name="abstract" content="A Gripp tem o seguro que você está procurando. Assegure você, sua família e sua empresa. Cotação online de Seguro Auto, Seguro Residencial, Seguro de Vida, Seguro Viagem.">
                        <meta name="comment" CONTENT="Gripp Seguros, seguro de carro, cotação online seguro auto, seguro residencial, seguro de vida, seguro viagem, previdência privada, seguro RC contador, seguro meio ambiente, consórcio, financiamento">
                        <meta name="keywords" content="Gripp Seguros, seguro de carro, cotação online seguro auto, seguro residencial, seguro de vida, seguro viagem, previdência privada, seguro RC contador, seguro meio ambiente, consórcio, financiamento">

                        <META name="REVISIT-AFTER" content="5 days">
                        <META name="LANGUAGE" content="PT-BR">
                        <META name="AUTHOR" content="GTA Multimidia">
                        <META name="ROBOTS" content="index, follow">
                        <META name="GOOGLEBOT" content="INDEX, FOLLOW">
                        <meta name="audience" content="all">

                        <meta property="og:locale" content="pt_BR" />
                        <meta property="og:type" content="website" />
                        <meta property="og:title" content="Blog | Gripp Seguros" />
                        <meta property="og:description" content="A Gripp tem o seguro que você está procurando. Assegure você, sua família e sua empresa. Cotação online de Seguro Auto, Seguro Residencial, Seguro de Vida, Seguro Viagem." />
                        <meta property="og:image" content="https://www.grippseguros.com.br/img/logo.png" />
                        <meta property="og:url" content="https://www.grippseguros.com.br/" />
                        <meta property="og:site_name" content="Gripp Seguros | Varginha - MG" />
                        <meta property="og:street-address" content="Av. Princesa do Sul, 890 - Jardim Andere"/>
                        <meta property="og:locality" content="Varginha"/>
                        <meta property="og:region" content="MG"/>
                        <meta property="og:country-name" content="Brasil"/>';
        }
        return $metas;
    }
    
    public function listarTodasReceitas() {
        $pdo = parent::getDB();
        $limite = 6;
        $pg = (isset($_GET['pg'])) ? (int) $_GET['pg'] : 1;
        $inicio = ($pg * $limite) - $limite;
        
        $listar = $pdo->prepare('SELECT * FROM `receitas` WHERE ativo= ? AND (data_postagem <= ? OR data_postagem IS NULL) ORDER BY id DESC LIMIT ' . $inicio . ", " . $limite);
	$listar->bindValue(1, 1);
        $listar->bindValue(2, date('Y-m-d H:i:s'));
        $listar->execute();
        $total = $listar->rowCount();
        
        $listarPaginacao = $pdo->prepare("SELECT * FROM `receitas` WHERE ativo= ? AND (data_postagem <= ? OR data_postagem IS NULL) ORDER BY id DESC");
	$listarPaginacao->bindValue(1, 1);
        $listarPaginacao->bindValue(2, date('Y-m-d H:i:s'));
        $listarPaginacao->execute();
        $totalPaginacao = $listarPaginacao->rowCount();

        $qtdPag = ceil($totalPaginacao / $limite);
        $prox = ($pg + 1);
        $ant = ($pg - 1);
        
        $receita = array();
        $receita['corpo'] = '';
        $receita['paginacao'] = '';
        
        if($total > 0){
            while($reg = $listar->fetch(PDO::FETCH_OBJ)){                                                   
                $receita['corpo'] .= '<div class="itemReceita">
                                <a href="receita/'.$reg->url.'">
                                <div class="corpoReceita">
                                    <div class="divImgReceita"><img src="img/receitas/miniatura/'.$reg->imagem.'" alt="'.$reg->titulo.'" class="imgReceita"/></div>
                                    <h3 class="tituloReceita">'.$reg->titulo.'</h3>
                                </div>
                                </a>
                            </div>';
                
            }
            $receita['paginacao'] .= $this->estruturaPaginacao($qtdPag, $pg, $prox, $ant);
        }else{
            $receita['corpo'] = "<p>Nenhuma receita foi encontrada</p>";
        }
        return $receita;
    }
    
    public function estruturaPaginacao($qtdPag, $pg, $prox, $ant){
        $paginacao = '';
        
        if ($qtdPag != 0) {
            $paginacao .= '<div class="divPaginacao">';
            $paginacao .= '<ul class="paginacao">';
            if ($pg > 1) {
                $paginacao .= '<li><a href="index.php?pg='.$ant.'">&#9664;</a></li>';
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
                            $paginacao .= "<li><a " . ( ($pg == $i) ? 'class="ativo"' : '' ) . " href='index.php?pg=$i'>" . $i . "</a></li>";
                        }
                    }
                }
            }

            if ($pg < $qtdPag) {
                $paginacao .= '<li><a href="index.php?pg='.$prox.'">&#9654;</a></li>';
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