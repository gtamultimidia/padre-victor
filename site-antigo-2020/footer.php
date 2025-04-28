<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1857.7392929021246!2d-45.5133199284392!3d-21.3710525037194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ca83e9a1fdabe9%3A0x63a205a6a5f08e9e!2sCaf%C3%A9+Padre+Victor!5e0!3m2!1spt-BR!2sbr!4v1556303749921!5m2!1spt-BR!2sbr" width="1920" height="200" frameborder="0" style="border:0" allowfullscreen class="mapa"></iframe>
<footer id="fale-conosco">
    <a class="voltar" onclick="voltar();">&#9650;</a>
    <div class="maxPg">
        <div class="newsletter">
            <h2>Newsletter</h2>
            <p>Receba nossas campanhas e notícias</p>
            <form action="enviar-news.php" method="post">
                <input type="email" name="email" placeholder="Coloque aqui seu e-mail." required />
                <button type="submit">Cadastrar</button>
            </form>
        </div>
        
        <img src="img/logo-footer.png" alt="Café Padre Victor" class="logoFooter"/>
    </div>
    
    <div class="linhaCafe">
        <img src="img/linha-cafe.png" alt="Linha Café"/>
    </div>
    
    <br>
    
    <div class="maxPg">
        <div class="menuFooter">
            <ul class="clickMenu">
                <li <?php Ferramentas::ativo("quem-somos")?>><a href="#quem-somos" rel="quem-somos">Quem Somos</a></li><li class="divisoria">|</li>
		<li <?php Ferramentas::ativo("produtos")?>><a href="#produtos" rel="produtos">Produtos</a></li><li class="divisoria">|</li>
                <li <?php Ferramentas::ativo("receitas")?>><a href="#receitas" rel="receitas">Receitas</a></li><li class="divisoria">|</li>
                <li <?php Ferramentas::ativo("blog")?>><a href="#blog" rel="blog">Blog</a></li><li class="divisoria">|</li>
                <li <?php Ferramentas::ativo("contato")?>><a href="#contato" rel="contato">Fale Conosco</a></li>
                <div class="clearfix"></div>
            </ul>
        </div>
        
        <div class="redesSociais">
            <p>CONHEÇA NOSSAS REDES SOCIAIS</p>
            <a href="https://www.instagram.com/padrevictorcafe/" target="_BLANK"><img src="img/instagram.png" alt="Instagram - Café Padre Victor"/></a>
            <a href="https://www.facebook.com/PadreVictorCafe/" target="_BLANK"><img src="img/facebook.png" alt="Facebook - Café Padre Victor"/></a>
        </div>
        
        <p class="infoContato"><b>Telefone: </b>(35) 3265-7333</p>
        <p class="infoContato"><b>Endereço: </b>Rua Ismael de Souza, 69 - Centro, Três Pontas - MG, 37190-000</p>
        <p class="infoContato"><b>CNPJ: </b>71.427.124/0001-04</p>
        <p class="desenvolvido">Desenvolvido Por: <a href="http://gtamultimidia.com.br/" target="_BLANK"><img src="img/gtamultimidia.png" alt="Gta Multimídia - Agência de Publicidade"/></a></p>
    </div>
</footer>