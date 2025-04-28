<%@LANGUAGE="VBSCRIPT" CODEPAGE="1252"%>
<!--#include file="adm/include_menu.asp" -->
<%
	canal = request.QueryString("ID")

	ConectarBD Conn, "websitecafepadrevictor.mdb"
	set TB = Conn.execute ("SELECT * FROM PRODUTOS WHERE (ID = " & canal & ")")
	if (not tb.bof) and (not tb.eof) then
		ID = TB("ID")
		TITULO = TB("TITULO")
		THUMBNAIL = TB("THUMBNAIL")
		RESUMO = TB("RESUMO")
		MATERIA = TB("MATERIA")
		SELODEPUREZA = TB("SELODEPUREZA")
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
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
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
            <td><img src="imagens/tit_produtos.jpg" width="479" height="39" vspace="15" /></td>
            <td valign="bottom"><div align="right"><a href="javascript:window.history.go(-1)"><img src="imagens/bt_voltar.gif" hspace="10" vspace="10" border="0" /></a></div></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" background="imagens/fundomeio_institucional.jpg">
        <tr>
          <td height="130" valign="top" style="background-image:url(imagens/fundotopo_produtos.jpg); background-repeat:no-repeat;"><table width="640" border="0" align="center" cellpadding="30" cellspacing="0">
            <tr>
              <td width="100%" class="link-branco"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><span class="letrao"><%= TITULO %></span></td>
                  <td><div align="right"><a href="javascript:window.history.go(-1)">
                    <select name="HD_login" id="select" title="LOGIN DO SITE" style="width:200px" onchange="MM_jumpMenu('parent',this,0)">
                      <option value="listaprodutos.asp#exibeconteudo">&raquo; PRODUTOS</option>
                      <%
							ConectarBD Conn, "websitecafepadrevictor.mdb"
							CriarRecordset rs
							rs.open "select id, titulo from produtos order by ordem", Conn, 1, 1
							while (not rs.bof) and (not rs.eof)
					  %>
                      <option value="produtos.asp?ID=<%= rs("id") %>#exibeconteudo" <% if cint(canal) = rs("id") then response.write "selected" %>><%= rs("titulo") %></option>
                      <%
							rs.movenext
							wend
							FecharRecordset rs
							FecharBD Conn
					  %>
                    </select>
                  </a></div></td>
                </tr>
              </table>                
                <br>
                <br>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top" class="link-branco"><div align="justify">
                      <table border="0" align="right" cellpadding="5" cellspacing="0">
                        <tr>
                          <td><% if (THUMBNAIL <> "imagens/noimage.gif") and (THUMBNAIL <> "") then response.write "<img src=" & replace(THUMBNAIL,"../","") & " border=""0""/>" %></td>
                        </tr>
                      </table>
                      <%= MATERIA %></div></td>
                    </tr>
                </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="107" valign="top" style="background-image:url(imagens/fundobase_institucional.jpg); background-repeat:no-repeat;"><% IF SELODEPUREZA = "S" THEN %><div align="center"><a href="especif_produtos.asp?canal=3#exibeconteudo"><img src="imagens/selodepureza.jpg" alt="Selo de Pureza ABIC" width="56" height="48" vspace="28" border="0" /></a></div><% END IF %></td>
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
      </table>      <p>&nbsp;</p></td>
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
