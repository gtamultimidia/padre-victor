<% 
	if request.querystring("atividade") = "logoff" then
	session.abandon
	session("permissao") = ""
   end if
%>
<% if session("permissao") <> "" then response.redirect "acesso.asp" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Intranet: Caf&eacute; Padre Victor</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	color: #993300;
	font-weight: bold;
}
-->
</style></head>
<body>
<div class="fundo">
<table width="779" height="100%" border="0" align="center" bgcolor="#FFFFFF" class="table_fundo">
  <tr>
    <td valign="top"><!--#include file="include_topo.asp" -->
        <br>
        <table width="80%" border="0" align="center" cellpadding="10" cellspacing="0" class="table_borda">
          <tr>
            <td><img src="imagens/login_chave.gif" width="26" height="30" align="absmiddle" vspace="2">&nbsp;&nbsp;&nbsp;<span class="style1">ENTRAR NO SISTEMA </span><br>
                <font color="#666666">Informe abaixo seu Usu&aacute;rio e Senha para ter acesso ao sistema:</font><br>
                <br>
                <table border="0" cellspacing="0" cellpadding="10">
                  <form name="form1" method="post" action="acesso.asp" onSubmit="return DFckForm(this, true)">
                    <tr>
                      <td><b>Usu&aacute;rio:</b><br>
                          <input type="text" name="usuario" title="Usu&aacute;rio" size="30">
                          <br>
                          <b>Senha:</b> <br>
                          <input type="password" name="senha" title="Senha" size="30">
                          <br>
                          <br>
                          <input type="submit" name="enviar" value="Continuar">                      </td>
                    </tr>
                  </form>
            </table></td>
          </tr>
        </table>
      <br>
        <table width="80%" border="0" align="center" cellpadding="10" cellspacing="0" class="table_color">
          <tr>
            <td bgcolor="#f5f5f5"><img src="imagens/login_cadeado.gif" width="14" height="18" align="absmiddle" vspace="2">&nbsp;&nbsp;&nbsp;<b>Sistema totalmente seguro:</b> Protegido por usu&aacute;rio, senha e endere&ccedil;o de IP da m&aacute;quina. Mesmo quando logado ao sistema, somente seu computador ter&aacute; acesso &agrave;s p&aacute;ginas protegidas.<br>
                <br>
            Seu IP: <%= Request.ServerVariables("Remote_addr") %></td>
          </tr>
        </table>
      <br>
        <br></td>
  </tr>
</table>
</div>
</body>
</html>
<script>
    document.form1.usuario.focus();
</script>