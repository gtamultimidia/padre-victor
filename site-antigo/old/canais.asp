<%@LANGUAGE="VBSCRIPT" CODEPAGE="1252"%>
<!--#include file="adm/include_menu.asp" -->
<%
	CANAL = request.QueryString("CANAL")
	
	ConectarBD ConnCANAIS, "websitecafepadrevictor.mdb"
	CriarRecordset RSCANAIS
	RSCANAIS.pagesize = 6
	if (session("SQL") = "") or (request.QueryString() = "") or (request.QueryString("canal") <> "") then session("SQL") = "SELECT CONTEUDODINAMICO.id, CONTEUDODINAMICO.titulo, CONTEUDODINAMICO.thumbnail, CONTEUDODINAMICO.resumo, CONTEUDODINAMICO.materia, CONTEUDODINAMICO.datainsercao, CONTEUDODINAMICO.albumfotos, MENUDINAMICO.nome_menudinamico FROM MENUDINAMICO INNER JOIN CONTEUDODINAMICO ON MENUDINAMICO.ID_menudinamico = CONTEUDODINAMICO.nomenomenu WHERE ((CONTEUDODINAMICO.dataexclusao > date()) or (CONTEUDODINAMICO.dataexclusao = #01/01/1900#)) and (nome_menudinamico = '" & CANAL & "') order by datainsercao desc"
	SQL = session("SQL")
	RSCANAIS.open SQL, ConnCANAIS, 1, 1
	if not(RSCANAIS.eof) and not(RSCANAIS.bof) then NOME_MENUDINAMICO = RSCANAIS("NOME_MENUDINAMICO")
	
	' ---------------------------------------------------
	'	Rotina de Paginação
	' ---------------------------------------------------
		pagina = request.querystring("pagina")
		if(isnumeric(pagina) = false) or (pagina = "") Then
			pagina = 1
		end if
		if (cint(pagina) <= 0) or (cint(pagina) > RSCANAIS.pagecount) then
			pagina = 1
		end if
		if RSCANAIS.pagecount = 0 then pagina = 0
	' ---------------------------------------------------
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Caf&eacute; Padre Victor</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="fundo">
  <table width="800" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EECE9B">
    <tr>
      <td height="261" valign="top"><!--#include file="include_topo.asp" --></td>
    </tr>
    <tr>
      <td height="410" valign="top">
  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EECE9B">
    <tr>
      <td><img src="imagens/tit_<%= CANAL %>.jpg" width="479" height="39" vspace="15" />
        <table width="100%" border="0" cellspacing="0" cellpadding="0" background="imagens/fundomeio_institucional.jpg">
          <tr>
            <td height="130" valign="top" style="background-image:url(imagens/fundotopo_institucional.jpg); background-repeat:no-repeat;"><table width="640" border="0" align="center" cellpadding="30" cellspacing="0">
              <tr>
                <td width="100%" class="link-branco">
                  <% response.write "<span class=""letrao"">Café Padre Victor</span><BR>Total de " & CANAL & ": " & RSCANAIS.recordcount %>
                  </span><br />
                  <br />
                  <table width="100%" border="0" cellpadding="5" cellspacing="0">
                    <%
				 if RSCANAIS.eof then response.write "Nenhuma ocorr&ecirc;ncia encontrada."
				 if not RSCANAIS.eof then RSCANAIS.absolutepage = pagina
				 contador = 0
				 while (not RSCANAIS.eof) and (contador < RSCANAIS.pagesize)
					if (RSCANAIS("THUMBNAIL") <> "imagens/noimage.gif") and (RSCANAIS("THUMBNAIL") <> "") then
				%>
                    <tr>
                      <td valign="top"><a href="conteudo.asp?ID=<%= RSCANAIS("ID") %>#exibeconteudo">
                        <% if (RSCANAIS("THUMBNAIL") <> "imagens/noimage.gif") and (RSCANAIS("THUMBNAIL") <> "") then response.write "<img src=" & replace(replace(RSCANAIS("thumbnail"),"/conteudodinamico/","/conteudodinamico/thumb/"),"../","") & " width=""60"" height=""45"" border=""0""/>" %>
                        </a></td>
                    <td width="100%" valign="top"><a href="conteudo.asp?ID=<%= RSCANAIS("ID") %>#exibeconteudo"><span class="letrao"><%= RSCANAIS("TITULO") %></span><br />
                      <span class="letradata"><%= formatdatetime(RSCANAIS("DATAINSERCAO"),1) %></span><br />
                      <div align="justify"><%= RSCANAIS("RESUMO") %></div>
                    </a></td>
                  </tr>
                    <% else %>
                    <tr>
                      <td colspan="2" valign="top"><a href="conteudo.asp?ID=<%= RSCANAIS("ID") %>#exibeconteudo"><span class="letrao"><%= RSCANAIS("TITULO") %></span><br />
                        <span class="letradata"><%= formatdatetime(RSCANAIS("DATAINSERCAO"),1) %></span><br />
                        <div align="justify"> <%= RSCANAIS("RESUMO") %></div>
                    </a></td>
                  </tr>
                    <% end if %>
                    <tr>
                      <td colspan="2"><div align="center"><img src="imagens/linhagrande.jpg" width="470" height="1" vspace="8" /></div></td>
                  </tr>
                    <%
			  			contador = contador + 1
			  			RSCANAIS.movenext
					wend
			  %>
                    </table>
                <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
                  <tr>
                    <td><div align="center">
                      <%
					if cint(pagina) > 1 then response.write "<a href=""canais.asp?canal=" & CANAL & "&pagina=" & pagina - 1 & "#exibeconteudo"">&laquo;&laquo; Anterior</span></a>&nbsp;&nbsp;&nbsp;"
					for i = 1 to RSCANAIS.pagecount
						if RSCANAIS.pagecount <> 1 then
							if i = cint(pagina) then
							   response.write "<b>|" & i & "|</b>"
							else
							   response.write "<a href=""canais.asp?canal=" & CANAL & "&pagina=" & i & "#exibeconteudo"">|" & i & "|</a> "
							end if
					end if
					next
					if RSCANAIS.pagecount > cint(pagina) then response.write "&nbsp;&nbsp;&nbsp;<a href=""canais.asp?canal=" & CANAL & "&pagina=" & pagina + 1 & "#exibeconteudo"">Pr&oacute;xima &raquo;&raquo;</a>"
				  %>
                      </div></td>
                  </tr>
                  </table></td>
              </tr>
              </table></td>
          </tr>
          <tr>
            <td height="107" valign="top" style="background-image:url(imagens/fundobase_institucional.jpg); background-repeat:no-repeat;">&nbsp;</td>
          </tr>
          </table>
      </td></tr>
</table>
      <p>&nbsp;</p></td>
    </tr>
    <tr>
      <td height="52" valign="top" background="imagens/fundobasesite.jpg">&nbsp;</td>
    </tr>
  </table>
</div>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-5754997-1";
urchinTracker();
</script>
</body>
</html>
<%
	FecharRecordset RSCANAIS
	FecharBD ConnCANAIS
%>
