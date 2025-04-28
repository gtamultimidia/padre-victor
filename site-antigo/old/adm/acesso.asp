<!--#include file="include_menu.asp" -->
<%
	if session("permissao") = "" then
		ConectarBD Conn, "websitecafepadrevictor.mdb"
		CriarRecordset rs
		usr_usuario = Campo_Form("usuario")
		usr_senha = Campo_Form("senha")
		rs.open "select * from usuarios where usr_usuario = '" & usr_usuario & "' and usr_senha = '" & usr_senha & "'", Conn, 1, 1
		if rs.recordcount > 0 then testa_existencia = "sim" else testa_existencia = "não"
		while (not rs.bof) and (not rs.eof)
			session("nome") = rs("usr_nome")
			session("permissao") = rs("usr_permissao")
			rs.movenext
		wend
		FecharRecordset rs
		FecharBD Conn
	else
		testa_existencia = "sim"
	end if
	session("SQL") = ""
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Intranet: Caf&eacute; Padre Victor</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="fundo">
<table width="779" height="100%" border="0" align="center" bgcolor="#FFFFFF" class="table_fundo">
  <tr>
    <td valign="top"><!--#include file="include_topo.asp" -->
        <br>
        <% if testa_existencia = "não" then %>
        <table width="80%" border="0" align="center" cellpadding="10" cellspacing="0" class="table_color">
          <tr>
            <td><img src="imagens/exclamacao_erro.gif" width="16" height="16" align="absmiddle" vspace="2">&nbsp;&nbsp;&nbsp;<b><font color="#993300">ACESSO NEGADO </font></b><br>
              O login ou a senha informados n&atilde;o correspondem.<br>
              <br>
            &raquo; <a href="default.asp"><b class="link-cinza">Clique aqui</b></a> para tentar novamente.</td>
          </tr>
        </table>
      <br>
        <table width="80%" border="0" align="center" cellpadding="10" cellspacing="0" class="table_color">
          <tr>
            <td><img src="imagens/login_cadeado.gif" width="14" height="18" align="absmiddle" vspace="2">&nbsp;&nbsp;&nbsp;<b>Sistema totalmente seguro:</b> Protegido por usu&aacute;rio, senha e endere&ccedil;o de IP da m&aacute;quina. Mesmo quando logado ao sistema, somente seu computador ter&aacute; acesso &agrave;s p&aacute;ginas protegidas.<br>
                <br>
              Seu IP: <%= Request.ServerVariables("Remote_addr") %></td>
          </tr>
        </table>
      <br>
        <br>
        <% end if %>
        <% if testa_existencia = "sim" then %>
        <table width="80%" border="0" align="center" cellpadding="10" cellspacing="0" class="table_borda">
          <tr>
            <td><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><img src="imagens/icousuario.gif" width="6" height="11" hspace="5" align="absmiddle"></td>
                  <td>Ol&aacute; <b><%= ucase(session("nome"))%></b>,</td>
                </tr>
              </table>
                <br>
                <% if session("permissao") = "ADM" then %>
                <br>
                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="25">
                        <tr>
                          <td><img src="imagens/logomarca_peq.gif" width="25" height="25" hspace="5"></td>
                            <td bgcolor="#E1E1E1" width="100%">&nbsp;&nbsp;<strong><a href="conteudoinstitucional01.asp">CONTE&Uacute;DO INSTITUCIONAL</a></strong></td>
                            <td bgcolor="#E1E1E1"><div align="right"><img src="imagens/bdireita_acessorestrito.gif" width="14" height="25"></div></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="3"></td>
                        </tr>
                          <%
							ConectarBD Conn, "websitecafepadrevictor.mdb"
							CriarRecordset rs
							rs.open "select id, titulo FROM CONTEUDOINSTITUCIONAL order by titulo", Conn, 1, 1
							while (not rs.bof) and (not rs.eof)
					 %>
                        <tr>
                          <td>&nbsp;</td>
                            <td><img src="imagens/botao_tecido.gif" width="8" height="9" hspace="5" vspace="5" align="absmiddle"><a href="conteudoinstitucional02.asp?ID=<%= rs("ID") %>&atividade=editar"><%= rs("titulo") %></a></td>
                            <td>&nbsp;</td>					
                        </tr>
                          <%
							rs.movenext
							wend
							FecharRecordset rs
							FecharBD Conn
					  %>
                      </table>
                        <br>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" height="25">
                        <tr>
                          <td><img src="imagens/logomarca_peq.gif" width="25" height="25" hspace="5"></td>
                          <td bgcolor="#E1E1E1" width="100%">&nbsp;&nbsp;<strong><a href="menudinamico01.asp">CONTE&Uacute;DO DIN&Acirc;MICO</a></strong></td>
                          <td bgcolor="#E1E1E1"><div align="right"><img src="imagens/bdireita_acessorestrito.gif" width="14" height="25"></div></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="3"></td>
                        </tr>
                          <%
							ConectarBD Conn, "websitecafepadrevictor.mdb"
							CriarRecordset rs
							rs.open "select id_menudinamico, nome_menudinamico FROM MENUDINAMICO order by nome_menudinamico", Conn, 1, 1
							while (not rs.bof) and (not rs.eof)
					 %>
                        <tr>
                          <td>&nbsp;</td>
                            <td><img src="imagens/botao_tecido.gif" width="8" height="9" hspace="5" vspace="5" align="absmiddle"><a href="conteudodinamico01.asp?IDcategoria=<%= rs("id_menudinamico") %>"><%= rs("nome_menudinamico") %></a></td>
                            <td>&nbsp;</td>					
                        </tr>
                          <%
							rs.movenext
							wend
							FecharRecordset rs
							FecharBD Conn
					  %>
                      </table>                    
                      <br />
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" height="25">
                        <tr>
                          <td><img src="imagens/logomarca_peq.gif" width="25" height="25" hspace="5" /></td>
                          <td bgcolor="#E1E1E1" width="100%">&nbsp;&nbsp;<strong>CAT&Aacute;LOGO</strong></td>
                          <td bgcolor="#E1E1E1"><div align="right"><img src="imagens/bdireita_acessorestrito.gif" width="14" height="25" /></div></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="3"></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td><img src="imagens/botao_tecido.gif" width="8" height="9" hspace="5" vspace="5" align="absmiddle" /><a href="produtos01.asp">Produtos</a></td>
                          <td>&nbsp;</td>
                        </tr>
                      </table></td>
                    <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" height="25">
                        <tr>
                          <td><img src="imagens/logomarca_peq.gif" width="25" height="25" hspace="5"></td>
                            <td bgcolor="#E1E1E1" width="100%">&nbsp;&nbsp;<strong>BIBLIOTECA DE ARQUIVOS</strong></td>
                            <td bgcolor="#E1E1E1"><div align="right"><img src="imagens/bdireita_acessorestrito.gif" width="14" height="25"></div></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="3"></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                            <td><img src="imagens/botao_tecido.gif" width="8" height="9" hspace="5" vspace="5" align="absmiddle"><a href="galeriafotos01.asp">Fotos</a></td>
                            <td>&nbsp;</td>
                        </tr>
                      </table>
                        <br>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" height="25">
                        <tr>
                          <td><img src="imagens/usuario_chave.gif" width="25" height="25" hspace="5"></td>
                          <td bgcolor="#E1E1E1" width="100%">&nbsp;&nbsp;<strong>USU&Aacute;RIOS</strong></td>
                          <td bgcolor="#E1E1E1"><div align="right"><img src="imagens/bdireita_acessorestrito.gif" width="14" height="25"></div></td>
                        </tr>
                        <tr>
                          <td height="5" colspan="3"></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td><img src="imagens/botao_tecido.gif" width="8" height="9" hspace="5" vspace="5" align="absmiddle"><a href="usuario01.asp">Gerenciar Usu&aacute;rios </a></td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                      <br>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" height="25">
                        <tr>
                          <td><img src="imagens/sair.gif" width="25" height="25" hspace="5" /></td>
                          <td bgcolor="#E1E1E1" width="100%">&nbsp;&nbsp;<a href="default.asp?atividade=logoff">Sair</a></td>
                          <td bgcolor="#E1E1E1"><div align="right"><img src="imagens/bdireita_acessorestrito.gif" width="14" height="25" /></div></td>
                        </tr>
                      </table>                    </td>
                  </tr>
                </table>
                <% end if %>
                <br>
                <br>
            <img src="imagens/login_cadeado.gif" width="14" height="18" align="absmiddle" vspace="2">&nbsp;&nbsp; Seu IP: <%= Request.ServerVariables("Remote_addr") %> &nbsp;&#8226; <%= formatdatetime(date,1) & "&nbsp;&nbsp;" & formatdatetime(time,3) %></td></tr>
      </table>
      <br>
        <br>
        <% end if %></td>
  </tr>
</table>
</div>
</body>
</html>