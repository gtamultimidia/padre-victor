<%@LANGUAGE="VBSCRIPT" CODEPAGE="1252"%>
<!--#include file="adm/include_menu.asp" -->
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
      <td><img src="imagens/tit_produtos.jpg" width="479" height="39" vspace="15" />
        <table width="100%" border="0" cellspacing="0" cellpadding="0" background="imagens/fundomeio_listaprodutos.jpg">
          <tr>
            <td height="130" valign="top" style="background-image:url(imagens/fundotopo_listaprodutos.jpg); background-repeat:no-repeat;"><table width="640" border="0" align="center" cellpadding="30" cellspacing="0">
              <tr>
                <td width="100%" class="link-branco">
                  <div align="center">
                    <%
					contador = 0
					ConectarBD Conn, "websitecafepadrevictor.mdb"
					set TB = Conn.execute ("SELECT top 3 * FROM PRODUTOS ORDER BY ORDEM")
					while (not tb.bof) and (not tb.eof)
						ID = TB("ID")
						TITULO = TB("TITULO")
						THUMBNAIL = TB("THUMBNAIL")
						RESUMO = TB("RESUMO")
						MATERIA = TB("MATERIA")
						if (THUMBNAIL <> "imagens/noimage.gif") and (THUMBNAIL <> "") then response.write "<a href=""produtos.asp?ID=" & ID & "#exibeconteudo"" title=""" & TITULO & chr(13) & RESUMO & """><img src=" & replace(replace(TB("thumbnail"),"/produtos/","/produtos/thumb/"),"../","") & " border=""0"" hspace=""10"" vspace=""10""/></a>"
						contador = contador + 1
						if (contador mod 4) = 0 then response.write "<BR>"
						TB.movenext
					wend
					SET TB = nothing
					FecharBD Conn
				%>
                    </div>
  <div align="left">
    <%
					contador = 0
					ConectarBD Conn, "websitecafepadrevictor.mdb"
					set TB = Conn.execute ("SELECT * FROM PRODUTOS where ID not in (18, 19, 20) ORDER BY ORDEM")
					while (not tb.bof) and (not tb.eof)
						ID = TB("ID")
						TITULO = TB("TITULO")
						THUMBNAIL = TB("THUMBNAIL")
						RESUMO = TB("RESUMO")
						MATERIA = TB("MATERIA")
						if (THUMBNAIL <> "imagens/noimage.gif") and (THUMBNAIL <> "") then response.write "<a href=""produtos.asp?ID=" & ID & "#exibeconteudo"" title=""" & TITULO & chr(13) & RESUMO & """><img src=" & replace(replace(TB("thumbnail"),"/produtos/","/produtos/thumb/"),"../","") & " border=""0"" hspace=""10"" vspace=""10""/></a>"
						contador = contador + 1
						if (contador mod 4) = 0 then response.write "<BR>"
						TB.movenext
					wend
					SET TB = nothing
					FecharBD Conn
				%>
    </div>
			      </td>
              </tr>
              </table></td>
          </tr>
          <tr>
            <td height="107" valign="top" style="background-image:url(imagens/fundobase_listaprodutos.jpg); background-repeat:no-repeat;"><div align="center"><a href="especif_produtos.asp?canal=3#exibeconteudo"><img src="imagens/selodepureza.jpg" alt="Selo de Pureza ABIC" width="56" height="48" vspace="28" border="0" /></a></div></td>
          </tr>
          </table>
      </td></tr>
</table>
	  </td>
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
