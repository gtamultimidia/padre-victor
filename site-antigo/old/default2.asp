<%@LANGUAGE="VBSCRIPT" CODEPAGE="1252"%>
<!--#include file="adm/include_menu.asp" -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Caf&eacute; Padre Victor</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
</head>
<script language="JavaScript" type="text/javascript" src="ajaxform.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
function exibeproduto(item){
	ajaxGo({ url:"produtos_inicial.asp?ID=" + item , elem_return: document.getElementById("produtos_inicial") });
}
//-->
</script>
<body>
<div class="fundo">
  <table width="800" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EECE9B">
    <tr>
      <td height="261" valign="top"><!--#include file="include_topo.asp" --></td>
    </tr>
    <tr>
      <td valign="top">
  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EECE9B">
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><br />
              <div id="produtos_inicial"><!--#include file="produtos_inicial.asp" --></div></td>
            <td width="540"><br />
              <br />
              <table width="530" border="0" align="center" cellpadding="0" cellspacing="0" background="imagens/fundomeio_noticias.jpg">
              <tr>
                <td valign="top" style="background-image:url(imagens/fundotopo_noticias.jpg); background-repeat:no-repeat;"><br />
                  <table width="380" border="0" align="center" cellpadding="5" cellspacing="0">
                    <%
				ConectarBD ConnCANAIS, "websitecafepadrevictor.mdb"
				CriarRecordset RSCANAIS
				RSCANAIS.open "SELECT top 3 CONTEUDODINAMICO.id, CONTEUDODINAMICO.titulo, CONTEUDODINAMICO.thumbnail, CONTEUDODINAMICO.resumo, CONTEUDODINAMICO.materia, CONTEUDODINAMICO.datainsercao, CONTEUDODINAMICO.albumfotos, MENUDINAMICO.nome_menudinamico FROM MENUDINAMICO INNER JOIN CONTEUDODINAMICO ON MENUDINAMICO.ID_menudinamico = CONTEUDODINAMICO.nomenomenu WHERE ((CONTEUDODINAMICO.dataexclusao > date()) or (CONTEUDODINAMICO.dataexclusao = #01/01/1900#)) and (nome_menudinamico = 'Notícias') order by datainsercao desc", ConnCANAIS, 1, 1
				 if RSCANAIS.eof then response.write "Nenhuma ocorr&ecirc;ncia encontrada."
				 while (not RSCANAIS.eof) and (contador < RSCANAIS.pagesize)
				%>
                    <tr>
                      <td valign="top"><a href="conteudo.asp?ID=<%= RSCANAIS("ID") %>#exibeconteudo">
                        <% if (RSCANAIS("THUMBNAIL") <> "imagens/noimage.gif") and (RSCANAIS("THUMBNAIL") <> "") then response.write "<img src=" & replace(replace(RSCANAIS("thumbnail"),"/conteudodinamico/","/conteudodinamico/thumb/"),"../","") & " width=""60"" height=""45"" hspace=""5"" vspace=""5"" border=""0"" align=""left""/>" %>
                        </a><a href="conteudo.asp?ID=<%= RSCANAIS("ID") %>#exibeconteudo"><span class="letratituloprincipal"><%= RSCANAIS("TITULO") %></span><br />
                          <div align="justify"><span class="letradata"><%= RSCANAIS("RESUMO") %></span></div>
                      </a></td>
                    </tr>
                    
                    <%
			  			RSCANAIS.movenext
						if not RSCANAIS.eof then response.write "<tr><td><img src=""imagens/linhapeq.jpg"" vspace=""3"" width=""370"" height=""1"" /></td></tr>"
					wend
					FecharRecordset RSCANAIS
					FecharBD ConnCANAIS
			  %>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="20" style="background-image:url(imagens/fundobase_noticias.jpg); background-repeat:no-repeat;">&nbsp;</td>
              </tr>
              </table>
              <br />
              <table width="530" border="0" align="center" cellpadding="0" cellspacing="0" background="imagens/fundomeio_noticias.jpg">
                <tr>
                  <td height="20" valign="top" style="background-image:url(imagens/fundotopo_receitas.jpg); background-repeat:no-repeat;">&nbsp;</td>
                </tr>
                <tr>
                  <td height="120" valign="top" style="background-image:url(imagens/fundobase_receitas.jpg); background-position:bottom; background-repeat:no-repeat;"><table width="380" border="0" align="center" cellpadding="5" cellspacing="0">
                    <%
				ConectarBD ConnCANAIS, "websitecafepadrevictor.mdb"
				CriarRecordset RSCANAIS
				RSCANAIS.open "SELECT top 1 CONTEUDODINAMICO.id, CONTEUDODINAMICO.titulo, CONTEUDODINAMICO.thumbnail, CONTEUDODINAMICO.resumo, CONTEUDODINAMICO.materia, CONTEUDODINAMICO.datainsercao, CONTEUDODINAMICO.albumfotos, MENUDINAMICO.nome_menudinamico FROM MENUDINAMICO INNER JOIN CONTEUDODINAMICO ON MENUDINAMICO.ID_menudinamico = CONTEUDODINAMICO.nomenomenu WHERE ((CONTEUDODINAMICO.dataexclusao > date()) or (CONTEUDODINAMICO.dataexclusao = #01/01/1900#)) and (nome_menudinamico = 'Receitas') ORDER BY RND(INT(NOW*CONTEUDODINAMICO.id)-NOW*CONTEUDODINAMICO.id)", ConnCANAIS, 1, 1
				 if RSCANAIS.eof then response.write "Nenhuma ocorr&ecirc;ncia encontrada."
				 while (not RSCANAIS.eof) and (contador < RSCANAIS.pagesize)
				%>
                    <tr>
                      <td valign="top"><a href="conteudo.asp?ID=<%= RSCANAIS("ID") %>#exibeconteudo">
                        <% if (RSCANAIS("THUMBNAIL") <> "imagens/noimage.gif") and (RSCANAIS("THUMBNAIL") <> "") then response.write "<img src=" & replace(replace(RSCANAIS("thumbnail"),"/conteudodinamico/","/conteudodinamico/"),"../","") & " hspace=""5"" vspace=""5"" border=""0"" align=""right""/>" %>
                        </a><a href="conteudo.asp?ID=<%= RSCANAIS("ID") %>#exibeconteudo"><span class="letratituloprincipal"><%= RSCANAIS("TITULO") %></span><br />
                          <div align="left"><span class="letradata"><%= RSCANAIS("RESUMO") %></span></div>
                            </a></td>
                    </tr>
                    <%
			  			RSCANAIS.movenext
						if not RSCANAIS.eof then response.write "<tr><td><hr /></td></tr>"
					wend
					FecharRecordset RSCANAIS
					FecharBD ConnCANAIS
			  %>
                    </table>
                  <br /></td>
                </tr>
              </table></td></tr>
        </table>
      </td>
    </tr>
</table>
      <p>&nbsp;</p></td>
    </tr>
    <tr>
      <td height="52" valign="top" background="imagens/fundobasesite.jpg">&nbsp;</td>
    </tr>
  </table>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-5754997-1");
pageTracker._trackPageview();
</script>
</body>
</html>