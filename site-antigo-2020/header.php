<header>
    <div class="maxPg">
        <div class="menuDesktop">
            <ul class="clickMenu">
                <li <?php Ferramentas::ativo("quem-somos")?>><a href="#quem-somos" rel="quem-somos">Quem Somos</a></li><li class="divisoria">|</li>
		<li <?php Ferramentas::ativo("produtos")?>><a href="#produtos" rel="produtos">Produtos</a></li><li class="divisoria">|</li>
                <li <?php Ferramentas::ativo("receitas")?>><a href="#receitas" rel="receitas">Receitas</a></li><li class="divisoria">|</li>
                <li <?php Ferramentas::ativo("blog")?>><a href="#blog" rel="blog">Blog</a></li><li class="divisoria">|</li>
                <li <?php Ferramentas::ativo("fale-conosco")?>><a href="#contato" rel="contato">Fale Conosco</a></li>
                <div class="clearfix"></div>
            </ul>
        </div>
        
        <a href="index"><img src="img/logo.png" alt="Café Padre Victor" class="logo"/></a>
    </div>
    
    <menu class="menuRetratil clickMenu" id="menuRetratil">
        <input type="checkbox" id="control-nav" style="display: none;"/>
        <label for="control-nav" class="control-nav"></label>
        <label for="control-nav" class="control-nav-close"></label>

        <nav class="menu" id="menunav">
            <ul id="menu">
                <li <?php Ferramentas::ativo("quem-somos")?>><a href="#quem-somos" rel="quem-somos">Quem Somos</a></li>
		<li <?php Ferramentas::ativo("produtos")?>><a href="#produtos" rel="produtos">Produtos</a></li>
                <li <?php Ferramentas::ativo("receitas")?>><a href="#receitas" rel="receitas">Receitas</a></li>
                <li <?php Ferramentas::ativo("blog")?>><a href="#blog" rel="blog">Blog</a></li>
                <li <?php Ferramentas::ativo("fale-conosco")?>><a href="#contato" rel="contato">Fale Conosco</a></li>
                <div class="clearfix"></div>
            </ul>
        </nav>
    </menu>
</header>