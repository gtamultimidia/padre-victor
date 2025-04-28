<!--#include file="include_menu.asp" -->
<% 	Permissao "ADM,SPR","acesso.asp" %>
<%
	IDcategoria = request.QueryString("IDcategoria")
	if (isnumeric(IDcategoria) = false) or (IDcategoria = "0") then response.redirect "acesso.asp"
	
	ConectarBD Conn, "websitecafepadrevictor.mdb"
	CriarRecordset TB
	TB.open "SELECT * FROM MENUDINAMICO where ID_menudinamico = " & IDcategoria , Conn, 1, 1
	if (not TB.bof) and (not TB.eof) then
		nome_menudinamico = TB("nome_menudinamico")
		ID_menudinamico = TB("ID_menudinamico")
	end if
	FecharRecordset TB
	FecharBD Conn
%>
<%
	if (request.querystring = "") and (request.form = "") then response.redirect "acesso.asp"
	'-----------------------------------------------------------------------
	'Adicionar
	'-----------------------------------------------------------------------
	if id <> "" then response.redirect "acesso.asp"
	
	if request.querystring("atividade") = "adicionar" then
		datainsercao = date
		nomenomenu = ID_menudinamico
	end if

	'-----------------------------------------------------------------------
	'Editar
	'-----------------------------------------------------------------------
	if request.querystring("atividade") = "editar" then
		ConectarBD Conn, "websitecafepadrevictor.mdb"
		CriarRecordset rs
		ID = Corrige_Campo(request.querystring("ID"))
		rs.open "select * FROM CONTEUDODINAMICO where ID = " & ID, Conn, 1, 1
		if (not rs.bof) and (not rs.eof) then
			ID = rs("ID")
			titulo = rs("titulo")
			resumo = rs("resumo")
			materia = rs("materia")
			datainsercao = rs("datainsercao")
			dataexclusao = rs("dataexclusao")
			if formata_data(dataexclusao) = "01/01/1900" then dataexclusao = ""

			thumbnail = rs("thumbnail")
			nomenomenu = rs("nomenomenu")
			albumfotos = rs("albumfotos")
			materiadecapa = rs("materiadecapa")
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
		Conn.execute "delete FROM CONTEUDODINAMICO where ID = " & ID & " "
		FecharBD Conn
		session("msg") = "<img src=imagens/excluido.gif width=17 height=19 align=absmiddle>&nbsp;&nbsp; ITEM EXCLUÍDO COM SUCESSO."
		
		response.redirect "conteudodinamico01.asp?IDcategoria=" & ID_menudinamico
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
			datainsercao = campo_form("datainsercao_dia") & "/" & campo_form("datainsercao_mes") & "/" & campo_form("datainsercao_ano")
			
			dataexclusao = campo_form("dataexclusao_dia") & "/" & campo_form("dataexclusao_mes") & "/" & campo_form("dataexclusao_ano")
			if dataexclusao = "//" then dataexclusao = "01/01/1900"
			
			thumbnail = campo_form("thumbnail")
			nomenomenu = Campo_Form("nomenomenu")

			albumfotos = Campo_Form("albumfotos")
			materiadecapa = Campo_Form("materiadecapa")
			
			if albumfotos = "" then albumfotos = "0"
			if materiadecapa = "" then materiadecapa = "N"
						
		CriarRecordset rs
		rs.open "select * FROM CONTEUDODINAMICO where ID = " & ID & " ", Conn, 1, 1
		if rs.recordcount > 0 then testa_existencia = "sim" else testa_existencia = "não"
		if testa_existencia = "sim" then
			Conn.execute "UPDATE CONTEUDODINAMICO set titulo='" & titulo & "', resumo='" & resumo & "', materia='" & materia & "', datainsercao='" & datainsercao & "', dataexclusao='" & dataexclusao & "', thumbnail='" & thumbnail & "', nomenomenu='" & nomenomenu & "', albumfotos = " & albumfotos & ", materiadecapa = '" & materiadecapa & "' where ID=" & ID & " "			
			session("msg") = "<img src=imagens/ok_concluido.gif width=18 height=19 align=absmiddle>&nbsp;&nbsp;MENU " & UCASE(nome_menudinamico) & " - <b>""" & ucase(titulo) & """</b> ATUALIZADO(a) COM SUCESSO."
		else
			Conn.execute "insert INTO CONTEUDODINAMICO (titulo, resumo, materia, datainsercao, dataexclusao, thumbnail, nomenomenu, albumfotos, materiadecapa) values ('" & titulo & "','" & resumo & "','" & materia & "','" & datainsercao & "','" & dataexclusao & "','" & thumbnail & "','" & nomenomenu & "'," & albumfotos & ",'" & materiadecapa & "')"			
			session("msg") = "<img src=imagens/ok_concluido.gif width=18 height=19 align=absmiddle>&nbsp;&nbsp;MENU " & UCASE(nome_menudinamico) & " - <b>""" & ucase(titulo) & """</b> CRIADO(a) COM SUCESSO."
		end if
		FecharRecordset rs
		FecharBD Conn

		if Campo_Form("arquivo") = "sim" then
			ConectarBD Conn, "websitecafepadrevictor.mdb"
			if ID = "0" then 
				set tb = Conn.execute("select top 1 ID FROM CONTEUDODINAMICO order by ID desc")
			else
				set tb = Conn.execute("select top 1 ID FROM CONTEUDODINAMICO where ID = " & ID)
			end if
			ID = tb("ID")
			set tb = nothing
			FecharBD Conn
			response.redirect "conteudodinamico01.asp?IDcategoria=" & ID_menudinamico
		else
			response.redirect "conteudodinamico01.asp?IDcategoria=" & ID_menudinamico
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
              <td><p><a href="acesso.asp">MENU</a> &#8250; <a href="conteudodinamico01.asp?IDcategoria=<%= ID_menudinamico %>"><%= ucase(nome_menudinamico) %></a> &#8250; CADASTRO </p></td>
            </tr>
          </table>
          <br>
          <table width="95%" align="center" border="0" cellspacing="0" cellpadding="10" class="table_color">
            <tr>
              <td><b><img src="imagens/logomarca_peq.gif" width="25" height="25" hspace="5" align="absmiddle"> <%= ucase(nome_menudinamico) %> </b><br>
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
                  <form name="cadastro" method="post" action="conteudodinamico02.asp?IDcategoria=<%= ID_menudinamico %>&atividade=salvar" onSubmit="return DFckForm(this, true)">
                    <tr>
                      <td height="30" valign="top"><div align="right">* Mat&eacute;ria:</div></td>
                      <td height="30"><input type="hidden" id="FCKeditor1" name="FCKeditor1" value="<%= server.htmlencode(materia) %>">
                        &nbsp;
                        <iframe id="FCKeditor1___Frame" src= "FCKeditor/editor/fckeditor.html?InstanceName=FCKeditor1&Toolbar=Basic" width="550" height="250" frameborder="no" scrolling="no"></iframe></td>
                    </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="30"><div align="right">* T&iacute;tulo:</div></td>
                      <td height="30">&nbsp;
                        <input name="titulo" type="text" id="titulo" value="<%= titulo %>" size="100" maxlength="150">                      </td>
                    </tr>
                    <tr>
                      <td height="30" valign="top"><div align="right">Resumo Mat&eacute;ria: </div></td>
                      <td height="30">&nbsp;
                        <textarea name="resumo" cols="100" rows="4" id="resumo" obligatory="false" onKeyPress="if(this.value.length >= 255){return false;}" maxlength="255"><%= resumo %></textarea></td>
                    </tr>
                    <tr>
                      <td height="30" valign="top"><div align="right"><br>
                        Foto de Capa:<br>
                        <INPUT type="hidden" name="thumbnail" value="<% if thumbnail = "" then response.write "imagens/noimage.gif" else response.write thumbnail %>" df_verificar="sim">
                      </div></td>
                      <td height="30"><table border="0" cellspacing="0" cellpadding="6">
                          <tr>
                            <td><DIV id="Layer1" style="width: 100%; height:100%; visibility: visible; border:0px solid black"><img src="<% if thumbnail = "" then response.write "imagens/noimage.gif" else response.write thumbnail %>" name="img_thumbnail" border="0"><br>
                            </DIV></td>
                            <td><strong>Enviar imagens:</strong><br>
                              &#8250;&nbsp;<a href="upthumb.asp?largura=198&altura=119&largurapeq=60&alturapeq=45&campo=<%=Server.URLEncode("thumbnail")%>&pasta=<%=Server.URLEncode("upload/conteudodinamico")%>" onClick="abre_janela(500, 350, 'alterar_imagem')" target="alterar_imagem" class="texto_pagina">Imagens: tamanho m&aacute;ximo 5mb (Foto Horizontal) </a></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="30">&nbsp;</td>
                      <td height="30">&nbsp;
                      <input name="materiadecapa" type="checkbox" class="checkbox" id="materiadecapa" value="S" <% if materiadecapa = "S" then response.write "checked" %> obligatory="false">                      
                      <strong>INSERIR COMO DESTAQUE?</strong></td>
                    </tr>
                    <tr>
                      <td height="30"><div align="right">Anexar Fotos: </div></td>
                      <td height="30">&nbsp;
                        <select name="albumfotos" id="albumfotos" obligatory="false" STYLE="width:400px;">
                          <option value="">&raquo; SELECIONE</option>
                          <%
							ConectarBD Conn, "websitecafepadrevictor.mdb"
							CriarRecordset rs
							rs.open "select * FROM ALBUM order by alb_data desc, alb_titulo", Conn, 1, 1
							while (not rs.bof) and (not rs.eof)
					 %>
                          <option value="<%= rs("alb_codigo") %>" <% if albumfotos = rs("alb_codigo") then response.write "selected" %>><%= mid(formata_data(rs("alb_data")),4,10) %> - <%= rs("alb_titulo") %></option>
                          <%
							rs.movenext
							wend
							FecharRecordset rs
							FecharBD Conn
					  %>
                        </select></td>
                    </tr>
                    <tr>
                      <td height="30"><div align="right">* Data Inser&ccedil;&atilde;o:</div></td>
                      <td height="30"><table border=0 cellspacing=0 cellpadding=0>
                          <tr>
                            <td>&nbsp;
                              <input name="datainsercao_dia" type="text" id="datainsercao_dia" onKeyPress="return DFonlyThisChars(true,null,null,event)" onKeyUp="DFchangeField(this,event,1)" value="<% if datainsercao <> "" then response.write mid(formata_data(datainsercao),1,2) %>" size="2" maxlength=2 xtype="date">
                              /
                              <input name="datainsercao_mes" type=text id="datainsercao_mes" onKeyPress="return DFonlyThisChars(true,null,null,event)" onKeyUp="DFchangeField(this,event,2)" value="<% if datainsercao <> "" then response.write mid(formata_data(datainsercao),4,2) %>" size="2" maxlength=2>
                              /
                              <input name="datainsercao_ano" type=text id="datainsercao_ano" onKeyPress="return DFonlyThisChars(true,null,null,event)" onKeyUp="DFchangeField(this,event,3)" value="<% if datainsercao <> "" then response.write mid(formata_data(datainsercao),7,4) %>" size="3" maxlength=4>                            </td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td height="30"><div align="right">Data Exclus&atilde;o:</div></td>
                      <td height="30"><table border=0 cellspacing=0 cellpadding=0>
                          <tr>
                            <td>&nbsp;
                                <input name="dataexclusao_dia" type="text" id="dataexclusao_dia" onKeyPress="return DFonlyThisChars(true,null,null,event)" onKeyUp="DFchangeField(this,event,1)" value="<% if dataexclusao <> "" then response.write mid(formata_data(dataexclusao),1,2) %>" size="2" maxlength=2 xtype="date" obligatory="false">
                              /
                              <input name="dataexclusao_mes" type=text id="dataexclusao_mes" onKeyPress="return DFonlyThisChars(true,null,null,event)" onKeyUp="DFchangeField(this,event,2)" value="<% if dataexclusao <> "" then response.write mid(formata_data(dataexclusao),4,2) %>" size="2" maxlength=2 obligatory="false">
                              /
                              <input name="dataexclusao_ano" type=text id="dataexclusao_ano" onKeyPress="return DFonlyThisChars(true,null,null,event)" onKeyUp="DFchangeField(this,event,3)" value="<% if dataexclusao <> "" then response.write mid(formata_data(dataexclusao),7,4) %>" size="3" maxlength=4 obligatory="false">                            </td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="30"><input type="hidden" name="id" value="<%= id %>">
                      <input name="nomenomenu" type="hidden" id="nomenomenu" value="<%= nomenomenu %>" /></td>
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
