<!--#include file="include_menu.asp" -->
<% 	Permissao "ADM,SPR","acesso.asp" %>
<%
	if (request.querystring = "") and (request.form = "") then response.redirect "acesso.asp"
	
	'-----------------------------------------------------------------------
	'Editar
	'-----------------------------------------------------------------------
	if request.querystring("atividade") = "editar" then
		ConectarBD Conn, "websitecafepadrevictor.mdb"
		CriarRecordset rs
		ID = Corrige_Campo(request.querystring("ID"))
		rs.open "select * FROM PRODUTOS where ID = " & ID, Conn, 1, 1
		if (not rs.bof) and (not rs.eof) then
			ID = rs("ID")
			titulo = rs("titulo")
			materia = rs("materia")
			thumbnail = rs("thumbnail")
			resumo = rs("resumo")
			selodepureza = rs("selodepureza")
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
		Conn.execute "delete FROM PRODUTOS where ID = " & ID & " "
		FecharBD Conn
		session("msg") = "<img src=imagens/excluido.gif width=17 height=19 align=absmiddle>&nbsp;&nbsp; ITEM EXCLUÍDO COM SUCESSO."
		
		response.redirect "produtos01.asp"
	end if
	
	'-----------------------------------------------------------------------
	'Salvar
	'-----------------------------------------------------------------------
	if request.querystring("atividade") = "salvar" then
		ConectarBD Conn, "websitecafepadrevictor.mdb"
			ID = Campo_Form("ID")
			if ID = "" then ID = "0"

			titulo = Campo_Form("titulo")
			resumo = Campo_Form("resumo")
			materia = campo_form("FCKeditor1")			
			thumbnail = campo_form("thumbnail")
			selodepureza = Campo_Form("selodepureza")
			if selodepureza = "" then selodepureza = "N"
			
		CriarRecordset rs
		rs.open "select * FROM PRODUTOS where ID = " & ID & " ", Conn, 1, 1
		if rs.recordcount > 0 then testa_existencia = "sim" else testa_existencia = "não"
		if testa_existencia = "sim" then
			Conn.execute "UPDATE PRODUTOS set titulo='" & titulo & "', materia='" & materia & "', thumbnail='" & thumbnail & "', resumo='" & resumo & "', selodepureza='" & selodepureza & "' where ID=" & ID & " "			
			session("msg") = "<img src=imagens/ok_concluido.gif width=18 height=19 align=absmiddle>&nbsp;&nbsp;PRODUTO <b>""" & ucase(titulo) & """</b> ATUALIZADO(a) COM SUCESSO."
		else
			Conn.execute "insert INTO PRODUTOS (titulo, materia, thumbnail, resumo, selodepureza) values ('" & titulo & "','" & materia & "','" & thumbnail & "','" & resumo & "','" & selodepureza & "')"			
			session("msg") = "<img src=imagens/ok_concluido.gif width=18 height=19 align=absmiddle>&nbsp;&nbsp;PRODUTO <b>""" & ucase(titulo) & """</b> CRIADO(a) COM SUCESSO."
		end if
		FecharRecordset rs
		FecharBD Conn

		if Campo_Form("arquivo") = "sim" then
			ConectarBD Conn, "websitecafepadrevictor.mdb"
			if ID = "0" then 
				set tb = Conn.execute("select top 1 ID FROM PRODUTOS order by ID desc")
			else
				set tb = Conn.execute("select top 1 ID FROM PRODUTOS where ID = " & ID)
			end if
			ID = tb("ID")
			set tb = nothing
			FecharBD Conn
			response.redirect "produtos01.asp"
		else
			response.redirect "produtos01.asp"
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
      <td valign="top"><div align="left">
          <!--#include file="include_topo.asp" -->
          <br>
          <table width="95%" border="0" align="center" cellpadding="10" cellspacing="0" class="table_color">
            <tr>
              <td><p><a href="acesso.asp">MENU</a> &#8250; <a href="produtos01.asp"> PRODUTOS </a> &#8250; CADASTRO </p></td>
            </tr>
          </table>
          <br>
          <table width="95%" border="0" align="center" cellpadding="10" cellspacing="0" class="table_color">
            <tr>
              <td><b><img src="imagens/logomarca_peq.gif" width="25" height="25" hspace="5" align="absmiddle"> PRODUTOS </b><br>
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
                  <form name="cadastro" method="post" action="produtos02.asp?atividade=salvar" onSubmit="return DFckForm(this, true)">
                    <tr>
                      <td height="30"><div align="right">* Produto:</div></td>
                      <td height="30">&nbsp;
                        <input name="titulo" type="text" id="titulo" value="<%= titulo %>" size="100" maxlength="150">                      </td>
                    </tr>
                    <tr>
                      <td height="30" valign="top"><div align="right">Resumo: </div></td>
                      <td height="30">&nbsp;
                          <textarea name="resumo" cols="100" rows="4" id="resumo" obligatory="false" onkeypress="if(this.value.length &gt;= 255){return false;}" maxlength="255"><%= resumo %></textarea></td>
                    </tr>
                    <tr>
                      <td height="30" valign="top"><div align="right"><br>
                        Foto:<br>
                        <INPUT type="hidden" name="thumbnail" value="<% if thumbnail = "" then response.write "imagens/noimage.gif" else response.write thumbnail %>" df_verificar="sim">
                      </div></td>
                      <td height="30"><table border="0" cellspacing="0" cellpadding="6">
                          <tr>
                            <td><DIV id="Layer1" style="width: 100%; height:100%; visibility: visible; border:0px solid black"><img src="<% if thumbnail = "" then response.write "imagens/noimage.gif" else response.write thumbnail %>" name="img_thumbnail" border="0"><br>
                            </DIV></td>
                            <td valign="top"><strong>Enviar imagens:</strong><br>
                              &#8250;&nbsp;<a href="upthumb.asp?largura=250&amp;altura=400&amp;largurapeq=125&amp;alturapeq=200&amp;campo=<%=Server.URLEncode("thumbnail")%>&amp;pasta=<%=Server.URLEncode("upload/produtos")%>" onClick="abre_janela(500, 350, 'alterar_imagem')" target="alterar_imagem" class="texto_pagina">Imagens: tamanho m&aacute;ximo 5mb (Foto Vertical) </a></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="30" valign="top"><div align="right">* Descri&ccedil;&atilde;o:</div></td>
                      <td height="30"><input type="hidden" id="FCKeditor1" name="FCKeditor1" value="<%= server.htmlencode(materia) %>">
                        &nbsp;
                        <iframe id="FCKeditor1___Frame" src= "FCKeditor/editor/fckeditor.html?InstanceName=FCKeditor1&Toolbar=Basic" width="550" height="250" frameborder="no" scrolling="no"></iframe></td>
                    </tr>
                    <tr>
                      <td height="30">&nbsp;</td>
                      <td height="30">&nbsp;
                          <input name="selodepureza" type="checkbox" class="checkbox" id="selodepureza" value="S" <% if selodepureza = "S" then response.write "checked" %> obligatory="false" />
                          <strong>INSERIR SELO DE PUREZA ABIQ? </strong></td>
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
