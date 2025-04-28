<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style>
/*
  Menus drop-down horizontal-vertical (hv) e vertical-vertical (vv) até 4 níveis
  by Micox - elmicox.blogspot.com - Ver. 2.0 - 20/02/08 - Creative Commons License
*/	
.menu-hvr, .menu-vv { list-style:none; float:left; position:absolute; left:50%; margin-left:-318px; top:-10px; font-family: "TW Cen MT"; font-weight:bold; width:650px; z-index: 10000;}
 .menu-hvr * ,	.menu-vv * { margin: 0; padding: 0; list-style: none}
 .menu-hvr li ,   .menu-vv li { position: relative; line-height: 1.2em; vertical-align: top;}
 .menu-hvr a ,	.menu-vv a { color:#585858; text-decoration:none; padding:0px 10px; display:block; }
 .menu-hvr li ul, .menu-vv li ul { position: absolute; visibility: hidden; top: -180px;  }
 .menu-hvr li:hover ul,  .menu-vv li:hover ul,
 .menu-hvr li.hover ul,  .menu-vv li.hover ul { visibility: visible; background: #e3ca8c; color:#a7d034; z-index:9000; top: -160px;
left: -20px; width: 127px;}
 .menu-hvr li:hover ul ul,  .menu-vv li:hover ul ul,
 .menu-hvr li.hover ul ul,  .menu-vv li.hover ul ul { visibility: hidden;}
 .menu-hvr li li:hover ul,  .menu-vv li li:hover ul,
 .menu-hvr li li.hover ul,  .menu-vv li li.hover ul { visibility: visible; background: #e3ca8c; color:#a7d034; z-index:9000; }
 .menu-hvr li li:hover ul ul,  .menu-vv li li:hover ul ul,
 .menu-hvr li li.hover ul ul,  .menu-vv li li.hover ul ul { visibility: hidden;}
 .menu-hvr li li li:hover ul,  .menu-vv li li li:hover ul,
 .menu-hvr li li li.hover ul,  .menu-vv li li li.hover ul { visibility: visible; background: #e3ca8c; color:#a7d034; z-index:9000; }
 /* características horizontal-vertical */
 .menu-hvr:after, .menu-hvr.after { content: "."; line-height: 0px; clear: both; display: block; visibility: hidden}
 .menu-hvr li { float: left; }  
 .menu-hvr li ul li { float: none; }
 .menu-hvr li ul li ul { position: absolute; left: 100%; top: 0; }
 /* características vertical-vertical */
 .menu-vv { float: left; } 
 .menu-vv li ul { left: 100%; top: 0; }
 /* ****************************************
   ALTERE ABAIXO. defina a largura, cor, formatações, etc, dos itens do seu menu abaixo
   ou apague as linhas se for definir em outro lugar
 */
 .menu-hvr li { position:relative; float:left; }
 .menu-vv li { position:relative; float:left;}
 .menu-hvr li a:hover { color:#a7d034;}
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

</style>

<div id="rodape">
    <img src="imagens/background_rodape.png" border="0" id="background_rodape" />
    <div id="enfeito_fundoEsq">
        <img src="imagens/enfeito_fundoEsq.png" border="0" />
    </div>
    <div id="enfeito_fundoDir">
        <img src="imagens/enfeito_fundoDir.png" border="0" />            
    </div>
    <div id="menuRodape">

        <ul  class="menu-hvr">
		<div style="margin-top:-78px; margin-left: 125px;">
			<!-- início do formulário -->
			<form action="http://app.emailmanager.com/form/" method="POST" name="formClient" accept-charset="ISO-8859-1">
			<table>
			<tr>
			<label style="color:#a38b54; font-size:16px; font-family:'FranklinGothicBookRegular'; display: inline-block; font-weight: bold;" for="email"> Newsletter - Receba nossas campanhas e not&iacute;cias </label> 
			<!--<td style="color:#a38b54; font-size:15px; font-family:'FranklinGothicBookRegular'; display: inline-block; font-weight: bold;" class="label">E-mail </td> -->
			<td>
			<input style="height:28px; width:329px; font-size: 14px; border-radius: 6px; border: 1px solid #ccc;" type="email" name="email" id="email" placeholder="Coloque aqui seu e-mail" value="" style="width: 330px;" maxlength="255"> </td>
			</tr>
			 <!--<tr>
			<td class="label">Nome </td>
			<td>
			<input type="text" name="name" id="name" value="" style="width: 200px;" maxlength="85"> </td>
			</tr> -->
			</table>
			<input type="hidden" name="_form_data" value="20048.6..2.0.fc5ec">
			<input type="hidden" name="_form_charset" value="ISO-8859-1"><input type="hidden" name="_form_urlOut" value="http://www.padrevictorcafe.com.br/index.php?alerta=1"><input type="hidden" name="_form_origin" value="9">
			<input style="padding: 8px 20px; border: none; font-size: 15px; line-height: 0.7; cursor:pointer; display: inline-block; border-radius: 4px; color: #fff; background: #a38b54; margin-left: 123px; margin-top: 6px;" type="submit" name="submit" value="Cadastrar"><br /><br>
			</form>
			<!-- fim do formulário -->
		</div>
		
            <li><a href="index.php">Principal</a></li>
            <li>|</li>
            <li><a href="quemSomos.php">Quem Somos</a></li>
            <li>|</li>
            <li>
            	<a href="#">Produtos</a>
            	<ul>
                    <li><a href="produtos.php?linha=padrevictor">Padre Victor</a></li>
                    <li><a href="produtos.php?linha=sorriso">Sorriso</a></li>
                    <li><a href="produtos.php?linha=mirandouro">Mirand'Ouro</a></li>
                    <li><a href="produtos.php?linha=marcapropria">Marca Pr�pria</a></li>
                </ul>
            </li>
            <li>|</li>
            <li><a href="receitas.php?rec=1">Receitas</a></li>
            <li>|</li>
            <li><a href="contato.php">Fale Conosco</a></li>
        </ul>
    </div>
    <div id="barraRodape"></div>
    <div id="facebook">
        <a target="_blank" href="https://www.facebook.com/PadreVictorCafe"><img src="imagens/facebook.png" border="0" /></a>
    </div>
	
	<div id="barraRodape"></div>
    <div id="instagram">
        <a target="_blank" href="https://instagram.com/padrevictorcafe"><img src="imagens/instagram.png" border="0" /></a>
    </div>
    
    <div id="txtRodape1">
        <p>Copyright&copy; 2013 - PADRE VICTOR.</p>
    </div>
    <div id="txtRodape2">
        <p>Desenvolvido por <a target="_blank" href="http://www.gtamultimidia.com.br">GTA Multim&iacute;dia.</a></p>
    </div>
</div> 