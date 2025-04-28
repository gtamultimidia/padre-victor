<!--#include file="include_menu.asp" -->
<% 	Permissao "ADM","acesso.asp" %>
<%
	if (request.querystring = "") and (request.form = "") then response.redirect "usuario01.asp"
	'-----------------------------------------------------------------------
	'Adicionar
	'-----------------------------------------------------------------------
		if id <> "" then response.redirect "usuario01.asp"
	'-----------------------------------------------------------------------
	'Editar
	'-----------------------------------------------------------------------
	if request.querystring("atividade") = "editar" then
		ConectarBD Conn, "websitecafepadrevictor.mdb"
		CriarRecordset rs
		id = Corrige_Campo(request.querystring("codigo"))
		rs.open "select * from usuarios where usr_cod = " & id, Conn, 1, 1
		if (not rs.bof) and (not rs.eof) then
			id = rs("usr_cod")
			usr_cod = rs("usr_cod")
			usr_nome = rs("usr_nome")
			usr_usuario = rs("usr_usuario")
			usr_senha = rs("usr_senha")
			usr_email = rs("usr_email")
			usr_permissao = rs("usr_permissao")
		end if
		FecharRecordset rs
		FecharBD Conn
	end if
	'-----------------------------------------------------------------------
	'Excluir
	'-----------------------------------------------------------------------
	if request.querystring("atividade") = "excluir" then
		ConectarBD Conn, "websitecafepadrevictor.mdb"
		id = request.querystring("codigo")
			Conn.execute "delete from usuarios where usr_cod=" & id & " "
			session("msg") = "<img src=imagens/excluido.gif width=17 height=19 align=absmiddle>&nbsp;&nbsp; USUÁRIO EXCLUÍDO COM SUCESSO."			
		FecharBD Conn
		response.redirect "usuario01.asp"
	end if
	'-----------------------------------------------------------------------
	'Salvar
	'-----------------------------------------------------------------------
	if request.querystring("atividade") = "salvar" then
		ConectarBD Conn, "websitecafepadrevictor.mdb"
		id = Campo_Form("id")
		usr_cod = Campo_Form("usr_cod")
		usr_nome = Campo_Form("usr_nome")
		usr_usuario = Campo_Form("usr_usuario")
		usr_senha = Campo_Form("usr_senha")
		usr_email = Campo_Form("usr_email")
		usr_permissao = Campo_Form("usr_permissao")
		CriarRecordset rs
		rs.open "select * from usuarios where usr_usuario = '" & usr_usuario & "'", Conn, 1, 1
		if rs.recordcount > 0 then testa_existencia = "sim" else testa_existencia = "não"
			if id = "" then
				if testa_existencia = "sim" then
					session("msg") = "<img src=imagens/exclamacao_erro.gif width=16 height=16 align=absmiddle>&nbsp;&nbsp; USUÁRIO JÁ EXISTE."
				else
					Conn.execute "insert into USUARIOS (usr_nome, usr_usuario,usr_senha,usr_email,usr_permissao) values ('" & usr_nome & "','" & usr_usuario & "','" & usr_senha & "','" & usr_email & "','" & usr_permissao & "')"			
					session("msg") = "<img src=imagens/ok_concluido.gif width=18 height=19 align=absmiddle>&nbsp;&nbsp; USUÁRIO <b>" & ucase(usr_usuario) & "</b> CRIADO COM SUCESSO."
				end if
			else
				if rs.recordcount > 1 then
					session("msg") = "<img src=imagens/exclamacao_erro.gif width=16 height=16 align=absmiddle>&nbsp;&nbsp; USUÁRIO JÁ EXISTE."
				else
					Conn.execute "update USUARIOS set usr_nome='" & usr_nome & "',usr_usuario='" & usr_usuario & "',usr_senha='" & usr_senha & "',usr_email='" & usr_email & "',usr_permissao='" & usr_permissao & "' where usr_cod=" & id & " "			
					session("msg") = "<img src=imagens/ok_concluido.gif width=18 height=19 align=absmiddle>&nbsp;&nbsp; USUÁRIO <b>" & ucase(usr_usuario) & "</b> ATUALIZADO COM SUCESSO."
				end if
			end if
		FecharRecordset rs
		FecharBD Conn
		response.redirect "usuario01.asp"
	end if	
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Intranet: Caf&eacute; Padre Victor</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="estilos.css" type="text/css">
</head>
<body>
<div class="fundo">
  <table width="779" height="100%" border="0" align="center" bgcolor="#FFFFFF" class="table_fundo">
    <tr>
      <td valign="top"> 
        <div align="left"> 
          <!--#include file="include_topo.asp" -->
          <br>
          <table width="95%" align="center" border="0" cellspacing="0" cellpadding="10" class="table_color">
            <tr>
              <td><a href="acesso.asp">MENU</a> &#8250; <a href="usuario01.asp">GERENCIAR USU&Aacute;RIOS</a>                &#8250; CADASTRO DO USU&Aacute;RIO </td>
            </tr>
          </table>
          <br>
          <table width="95%" align="center" border="0" cellspacing="0" cellpadding="10" class="table_color">
            <tr>
              <td><img src="imagens/usuario_chave.gif" width="25" height="25" hspace="5" align="absmiddle">&nbsp;<b>GERENCIAR USU&Aacute;RIOS: CADASTRO DO USU&Aacute;RIO </b><br>
                <font color="#666666">Informe abaixo todos os campos solicitados:<br>
                <br>
                </font>
                <table border="0" cellspacing="0" cellpadding="0">
                  <form name="cadastro" method="post" action="usuario02.asp?atividade=salvar" onSubmit="return DFckForm(this, true)">
				  <tr>
                    <td height="30"><div align="right">* Nome:</div></td>
                    <td height="30">&nbsp;
                        <input name="usr_nome" type="text" id="usr_nome" value="<%= usr_nome %>" size="50" maxlength="50">
                    </td>
                  </tr>
                    <tr>
                      <td height="30"><div align="right">* Usu&aacute;rio:</div></td>
                      <td height="30">&nbsp;
                        <input name="usr_usuario" type="text" id="usr_usuario" value="<%= usr_usuario %>" size="50" maxlength="20">                      </td>
                    </tr>
                    <tr>
                      <td height="30"><div align="right">E-mail: </div></td>
                      <td height="30">&nbsp;
                        <input name="usr_email" type="text" id="usr_email" onKeyPress="return DFonlyThisChars(true,true,'@._-',event)" value="<%= usr_email %>" size="50" maxlength="50" xtype="email" obligatory="false"></td>
                    </tr>
                    <tr>
                      <td height="30"><div align="right">* Senha:</div></td>
                      <td height="30">&nbsp;
                        <input name="usr_senha" type="password" id="usr_senha" value="<%= usr_senha %>" size="10" maxlength="6" minlength="6" equal="password">
                        &nbsp;&nbsp;&nbsp; [ Confirmar Senha:&nbsp;
                        <input type="password" name="password" value="<%= usr_senha %>" maxlength="6" size="10">
                        &nbsp;] </td>
                    </tr>
                    <tr>
                      <td height="30"><div align="right">* Grupo do Perfil:&nbsp; </div></td>
                      <td height="30">&nbsp;
                        <select name="usr_permissao" id="usr_permissao">
                          <% if session("permissao") = "ADM" then %>
						  <option value=ADM <% if usr_permissao = "ADM" then response.write "selected" %>>Administrador</option>
                          <% end if %>
                        </select>                      </td>
                    </tr>
                    <tr>
                      <td height="30"><input type="hidden" name="id" value="<%= id %>">                      </td>
                      <td height="30"><br>
                        <input type="submit" name="Submit" value="Salvar">                      </td>
                    </tr>
                    <tr>
                      <td height="30">&nbsp;</td>
                      <td height="30" valign="bottom"><font color="#666666" size="1">Os campos marcados com (*) s&atilde;o de preenchimento obrigat&oacute;rio.</font></td>
                    </tr>
                  </form>
              </table></td>
            </tr>
          </table>
          <br>
      </div></td>
    </tr>
  </table>
</div>
</body>
</html>
