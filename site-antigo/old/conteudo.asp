<%@LANGUAGE="VBSCRIPT" CODEPAGE="1252"%>
<!--#include file="adm/include_menu.asp" -->
<%
	canal = request.QueryString("ID")

	ConectarBD Conn, "websitecafepadrevictor.mdb"
	set TB = Conn.execute ("SELECT CONTEUDODINAMICO.id, CONTEUDODINAMICO.titulo, CONTEUDODINAMICO.thumbnail, CONTEUDODINAMICO.resumo, CONTEUDODINAMICO.materia, CONTEUDODINAMICO.datainsercao, CONTEUDODINAMICO.albumfotos, MENUDINAMICO.nome_menudinamico FROM CONTEUDODINAMICO INNER JOIN MENUDINAMICO ON MENUDINAMICO.ID_menudinamico = CONTEUDODINAMICO.nomenomenu WHERE ((CONTEUDODINAMICO.dataexclusao > date()) or (CONTEUDODINAMICO.dataexclusao = #01/01/1900#)) and (CONTEUDODINAMICO.ID = " & canal & ") order by datainsercao desc")
	if (not tb.bof) and (not tb.eof) then
		ID = TB("ID")
		TITULO = TB("TITULO")
		THUMBNAIL = TB("THUMBNAIL")
		RESUMO = TB("RESUMO")
		MATERIA = TB("MATERIA")
		DATAINSERCAO = TB("DATAINSERCAO")
		ALBUMFOTOS = TB("ALBUMFOTOS")
		NOMENOMENU = TB("NOME_MENUDINAMICO")
	else
		response.redirect "default.asp"
	end if
	SET TB = nothing
	FecharBD Conn
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
      <td valign="top">
	    <table width="800" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EECE9B">
    <tr>
      <td><table width="720" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><img src="imagens/tit_<%= NOMENOMENU %>.jpg" width="479" height="39" vspace="15" /></td>
            <td valign="bottom"><div align="right"><a href="javascript:window.history.go(-1)"><img src="imagens/bt_voltar.gif" hspace="10" vspace="10" border="0" /></a></div></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" background="imagens/fundomeio_institucional.jpg">
        <tr>
          <td height="130" valign="top" style="background-image:url(imagens/fundotopo_institucional.jpg); background-repeat:no-repeat;"><table width="640" border="0" align="center" cellpadding="30" cellspacing="0">
            <tr>
              <td class="link-branco"><span class="letrao"><%= TITULO %></span><br />
              <br />
			  <div align="justify">
			  <table width="208" border="0" align="left" cellpadding="0" cellspacing="0">
				<tr>
				  <td><% if (THUMBNAIL <> "imagens/noimage.gif") and (THUMBNAIL <> "") then response.write "<img src=" & replace(THUMBNAIL,"../","") & " border=""0"" vspace=""10""/>" %></td>
				</tr>
			  </table>
			  <%= MATERIA %></div></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="107" valign="top" style="background-image:url(imagens/fundobase_institucional.jpg); background-repeat:no-repeat;">&nbsp;</td>
        </tr>
      </table>
      </td>
    </tr>
</table>
        <table width="720" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>&nbsp;</td>
            <td valign="bottom"><div align="right"><a href="javascript:window.history.go(-1)"><img src="imagens/bt_voltar.gif" hspace="10" vspace="10" border="0" /></a></div></td>
          </tr>
        </table>        <p>&nbsp;</p></td>
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
