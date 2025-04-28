<?php
	include 'conexao.php';
?>

<style>
/*
  Menus drop-down horizontal-vertical (hv) e vertical-vertical (vv) atÃ© 4 nÃ­veis
  by Micox - elmicox.blogspot.com - Ver. 2.0 - 20/02/08 - Creative Commons License
*/	
.menu-hv, .menu-vv { list-style:none; float:left; position:absolute; left:50%; margin-left:-20px; top:0px; font-family: "TW Cen MT"; font-weight:bold; width:400px; z-index: 10000;}
 .menu-hv * ,	.menu-vv * { margin: 0; padding: 0; list-style: none}
 .menu-hv li ,   .menu-vv li { position: relative; line-height: 1.2em; vertical-align: top }
 .menu-hv a ,	.menu-vv a { color:#585858; text-decoration:none; padding:5px 10px; display:block; }
 .menu-hv li ul, .menu-vv li ul { position: absolute; visibility: hidden  }
 .menu-hv li:hover ul,  .menu-vv li:hover ul,
 .menu-hv li.hover ul,  .menu-vv li.hover ul { visibility: visible;  color:#a7d034; z-index:9000; }
 .menu-hv li:hover ul ul,  .menu-vv li:hover ul ul,
 .menu-hv li.hover ul ul,  .menu-vv li.hover ul ul { visibility: hidden;}
 .menu-hv li li:hover ul,  .menu-vv li li:hover ul,
 .menu-hv li li.hover ul,  .menu-vv li li.hover ul { visibility: visible;  color:#a7d034; z-index:9000; }
 .menu-hv li li:hover ul ul,  .menu-vv li li:hover ul ul,
 .menu-hv li li.hover ul ul,  .menu-vv li li.hover ul ul { visibility: hidden;}
 .menu-hv li li li:hover ul,  .menu-vv li li li:hover ul,
 .menu-hv li li li.hover ul,  .menu-vv li li li.hover ul { visibility: visible;  color:#a7d034; z-index:9000; }
 /* caracterÃ­sticas horizontal-vertical */
 .menu-hv:after, .menu-hv.after { content: "."; line-height: 0px; clear: both; display: block; visibility: hidden}
 .menu-hv li { float: left; }  
 .menu-hv li ul li { float: none; }
 .menu-hv li ul li ul { position: absolute; left: 100%; top: 0; }
 /* caracterÃ­sticas vertical-vertical */
 .menu-vv { float: left; } 
 .menu-vv li ul { left: 100%; top: 0; }
 /* ****************************************
   ALTERE ABAIXO. defina a largura, cor, formataÃ§Ãµes, etc, dos itens do seu menu abaixo
   ou apague as linhas se for definir em outro lugar
 */
 .menu-hv li { position:relative; float:left; }
 .menu-vv li { position:relative; float:left;}
 .menu-hv li a:hover { color:#a7d034;}
 .menu-vv li a:hover { color:#a7d034; }*/

 
/* Micox Pseudo-class-css2 to IE (MXPC). Activate .hover and .first-child in IE 6
   http://elmicox.blogspot.com/2008/03/ativando-hover-e-first-child-no-ie-6-um.html */
* html * { color: expression( (function(who){ if(!who.MXPC){
 who.MXPC = '1';
 if(who.nodeName != 'A'){
  who.onmouseenter=function(){ who.className += ' hover'};
  who.onmouseleave=function(){ who.className = who.className.replace(' hover','')}; }
 (who==who.parentNode.firstChild) ? who.className += ' first-child' : '';
} } )(this) , 'auto') }

#txt_busca{
	width: 153px;
	height: 22px;
}
</style>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65161339-1', 'auto');
  ga('send', 'pageview');

</script>
<div id="background_topo">
	<div id="logo">
    	<a href="index.php"><img src="imagens/logo.png" border="0" /></a>
    </div>
    <div id="menu_esq">
    	<ul class="menu-hv">
        	<li style="margin-right: 63px;"><a href="quemSomos.php">Quem Somos</a></li>
            <li id="gambi">
            	<a href="#">Produtos</a>
                <ul>
                	<li style="border-left: 1px solid #d6c088;border-right: 1px solid #d6c088;position: absolute; text-align: center; background: #810303; width: 145px; height: 35px; top: 0px; left: -1px;"><a href="produtos.php?linha=padrevictor">Padre Victor</a></li>
                    <li style="border-left: 1px solid #d6c088;border-right: 1px solid #d6c088;position: absolute; text-align: center; background: #4f0202; width: 145px; height: 35px; top: 27px; left: -1px;"><a href="produtos.php?linha=sorriso">Sorriso</a></li>
                    <li style="border-left: 1px solid #d6c088;border-right: 1px solid #d6c088;  position: absolute; text-align: center; background: #810303; width: 145px; height: 35px;  top: 54px; left: -1px;"><a href="produtos.php?linha=mirandouro">Mirand'Ouro</a></li>
                    <li style="border-bottom: 1px solid #d6c088; border-right: 1px solid #d6c088 ;border-left: 1px solid #d6c088; position: absolute; text-align: center; background: #4f0202; width: 145px; height: 28px; top: 81px; left: -1px;"><a href="produtos.php?linha=marcapropria">Marca Pr&oacute;pria</a></li>
                    
                </ul>                
            </li>
        </ul>
    </div>
    <img src="imagens/barra_menuEsq.png" border="0" id="barra_esq" />
    <div id="menu_dir">
    	<ul>
        	<li><a href="receitas.php?rec=1">Receitas</a></li>
            <li><a href="contato.php">Fale Conosco</a></li>
        </ul>
    </div>
    <img src="imagens/barra_menuDir.png" border="0" id="barra_dir" />
</div>