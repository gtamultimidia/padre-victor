<!--#include file="include_menu.asp" -->
<% 	Permissao "ADM,SPR","acesso.asp" %>
<%
	if (request.querystring = "") and (request.form = "") then response.redirect "acesso.asp"
	'-----------------------------------------------------------------------
	'Adicionar
	'-----------------------------------------------------------------------
	if id <> "" then response.redirect "acesso.asp"
	
	'-----------------------------------------------------------------------
	'Editar
	'-----------------------------------------------------------------------
	if request.querystring("atividade") = "editar" then
		ConectarBD Conn, "websitecafepadrevictor.mdb"
		CriarRecordset rs
		ID = Corrige_Campo(request.querystring("ID"))
		rs.open "select * FROM MENUDINAMICO where ID_menudinamico  = " & ID, Conn, 1, 1
		if (not rs.bof) and (not rs.eof) then
			ID = rs("ID_menudinamico")
			nome_menudinamico = rs("nome_menudinamico")
		end if
		FecharRecordset rs
		FecharBD Conn
	end if
	'-----------------------------------------------------------------------
	'Excluir
	'-----------------------------------------------------------------------
	if request.querystring("atividade") = "excluir" then
		ID = request.querystring("ID")
		ConectarBD Conn, "websitecafepadrevictor.mdb"
		Conn.execute "delete FROM MENUDINAMICO where ID_menudinamico = " & ID & " "
		FecharBD Conn
		session("msg") = "<img src=imagens/excluido.gif width=17 height=19 align=absmiddle>&nbsp;&nbsp; ITEM EXCLUÍDO COM SUCESSO."
		
		response.redirect "menudinamico01.asp"
	end if
	
	'-----------------------------------------------------------------------
	'Salvar
	'-----------------------------------------------------------------------
	if request.querystring("atividade") = "salvar" then
		ConectarBD Conn, "websitecafepadrevictor.mdb"
			ID = Campo_Form("ID")
			if ID = "" then ID = "0"
			nome_menudinamico = Campo_Form("nome_menudinamico")
			
		CriarRecordset rs
		rs.open "select * FROM MENUDINAMICO where ID_menudinamico = " & ID & " ", Conn, 1, 1
		if rs.recordcount > 0 then testa_existencia = "sim" else testa_existencia = "não"
		if testa_existencia = "sim" then
			Conn.execute "UPDATE MENUDINAMICO set nome_menudinamico='" & nome_menudinamico & "' where ID_menudinamico=" & ID & " "			
			session("msg") = "<img src=imagens/ok_concluido.gif width=18 height=19 align=absmiddle>&nbsp;&nbsp;MENU <b>""" & ucase(nome_menudinamico) & """</b> ATUALIZADO(a) COM SUCESSO."
		else
			Conn.execute "insert INTO MENUDINAMICO (nome_menudinamico) values ('" & nome_menudinamico & "')"			
			session("msg") = "<img src=imagens/ok_concluido.gif width=18 height=19 align=absmiddle>&nbsp;&nbsp;MENU <b>""" & ucase(nome_menudinamico) & """</b> CRIADO(a) COM SUCESSO."
		end if
		FecharRecordset rs
		FecharBD Conn

		if Campo_Form("arquivo") = "sim" then
			ConectarBD Conn, "websitecafepadrevictor.mdb"
			if ID = "0" then 
				set tb = Conn.execute("select top 1 ID_menudinamico FROM MENUDINAMICO order by ID_menudinamico desc")
			else
				set tb = Conn.execute("select top 1 ID_menudinamico FROM MENUDINAMICO where ID_menudinamico = " & ID)
			end if
			ID = tb("ID")
			set tb = nothing
			FecharBD Conn
			'response.redirect "menudinamico02.asp?ID=" & ID & "&atividade=editar"
			response.redirect "menudinamico01.asp"
		else
			response.redirect "menudinamico01.asp"
		end if
	end if	
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Intranet: Caf&eacute; Padre Victor</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="estilos.css" type="text/css">
<script language="JavaScript" type="text/javascript">
<!--

function abre_janela(width, height, nome) {
var top; var left;
top = ( (screen.height/2) - (height/2) )
left = ( (screen.width/2) - (width/2) )
window.open('',nome,'width='+width+',height='+height+',scrollbars=yes,toolbar=no,location=no,status=no,menubar=no,resizable=no,left='+left+',top='+top);
}
function recebe_imagem(campo, imagem){
var foto = 'img_' + campo;
document.cadastro[campo].value = imagem;
document.cadastro[foto].src = imagem;
}
//-->
</script>
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
              <td><p><a href="acesso.asp">MENU</a> &#8250; <a href="menudinamico01.asp">CONTE&Uacute;DO DIN&Acirc;MICO </a> &#8250; CADASTRO </p></td>
            </tr>
          </table>
          <br>
          <table width="95%" align="center" border="0" cellspacing="0" cellpadding="10" class="table_color">
            <tr>
              <td><b><img src="imagens/logomarca_peq.gif" width="25" height="25" hspace="5" align="absmiddle"> CONTE&Uacute;DO DIN&Acirc;MICO: CADASTRO </b><br>
                <font color="#666666">Informe abaixo todos os campos solicitados:<br>
                <br>
                </font>
                <% if session("msg") <> "" then %>
                <table border="0" cellspacing="0" cellpadding="10">
                  <tr>
                    <td bgcolor="#F0F0F0"><font color="#990000"><%= Exibe_Mensagem %></font> </td>
                  </tr>
                </table>
                <br>
                <% end if %>
                <table border="0" cellpadding="0" cellspacing="0">
                  <form name="cadastro" method="post" action="menudinamico02.asp?atividade=salvar" onSubmit="return DFckForm(this, true)">
                    <tr>
                      <td height="30"><div align="right">* Nome no Menu:</div></td>
                      <td height="30">&nbsp;
                        <input name="nome_menudinamico" type="text" id="nome_menudinamico" value="<%= nome_menudinamico %>" size="100" maxlength="150">                      </td>
                    </tr>
                    <tr>
                      <td height="30"><input type="hidden" name="id" value="<%= id %>"></td>
                      <td height="30"><br>
                        <input type="submit" name="Submit" value="Salvar">                      </td>
                    </tr>
                    <tr>
                      <td height="30">&nbsp;</td>
                      <td height="30" valign="bottom"><font color="#666666" size="1">Os campos marcados com (*) s&atilde;o de preenchimento obrigat&oacute;rio.</font></td>
                    </tr>
                    <tr>
                      <td height="30">&nbsp;</td>
                      <td height="30" valign="bottom">&nbsp;</td>
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
