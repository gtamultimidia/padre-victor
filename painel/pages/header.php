<?php 
$login = new Login();
$login->protegeAdm();
?>
<div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">
    <!--
        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag
    -->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="index.php" class="simple-text">
                Painel Administrativo
            </a>
        </div>

        <ul class="nav">
            <li class="active">
                <a href="index.php">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                    <i class="pe-7s-coffee"></i>
                    <p>Receitas</p>
                </a>
                <ul class="dropdown-style dropdown-menu">
                    <li><a href="receita-adicionar.php">Adicionar</a></li>
                    <li><a href="receita-listar.php">Editar</a></li>
                </ul>
            </li>
            <li>
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                    <i class="pe-7s-news-paper"></i>
                    <p>Blog</p>
                </a>
                <ul class="dropdown-style dropdown-menu">
                    <li><a href="noticia-adicionar.php">Adicionar</a></li>
                    <li><a href="noticia-listar.php">Editar</a></li>
                </ul>
            </li>
            <li>
                <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                    <i class="pe-7s-map-2"></i>
                    <p>Produtos</p>
                </a>
                <ul class="dropdown-style dropdown-menu">
                    <li><a href="produto-adicionar.php">Adicionar</a></li>
                    <li><a href="produto-listar.php">Editar</a></li>
                </ul>
            </li>
            <li>
                <a href="usuario-editar.php">
                    <i class="pe-7s-id"></i>
                    <p>Perfil do Usuário</p>
                </a>
            </li>
            <li>
                <a href="http://www.padrevictorcafe.com.br/" target="_blank">
                    <i class="pe-7s-plane"></i>
                    <p>Visitar Site</p>
                </a>
            </li>
            <!--<li>
                <a href="table.php">
                    <i class="pe-7s-note2"></i>
                    <p>Table List</p>
                </a>
            </li>
            <li>
                <a href="typography.php">
                    <i class="pe-7s-news-paper"></i>
                    <p>Typography</p>
                </a>
            </li>
            <li>
                <a href="icons.php">
                    <i class="pe-7s-science"></i>
                    <p>Icons</p>
                </a>
            </li>
            <li>
                <a href="maps.php">
                    <i class="pe-7s-map-marker"></i>
                    <p>Maps</p>
                </a>
            </li>
            <li>
                <a href="notifications.php">
                    <i class="pe-7s-bell"></i>
                    <p>Notifications</p>
                </a>
            </li>--> 
        </ul>
    </div>
</div>