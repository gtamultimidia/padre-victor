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
		alb_codigo = Corrige_Campo(request.querystring("alb_codigo"))
		rs.open "select * from ALBUM where alb_codigo = " & alb_codigo, Conn, 1, 1
		if (not rs.bof) and (not rs.eof) then
			alb_codigo = rs("alb_codigo")
			alb_descricao = rs("alb_descricao")
			alb_titulo = rs("alb_titulo")
			alb_data = rs("alb_data")
			thumbnail = rs("alb_thumbnail")
		end if
		FecharRecordset rs
		FecharBD Conn
	end if
	'-----------------------------------------------------------------------
	'Excluir
	'-----------------------------------------------------------------------
	if request.querystring("atividade") = "excluir" then
		alb_codigo = request.querystring("alb_codigo")
		ConectarBD Conn, "websitecafepadrevictor.mdb"
		Conn.execute "delete * from ALBUM where alb_codigo = " & alb_codigo & " "
		Conn.execute "delete * from FOTOS where foto_album = " & alb_codigo & " "
		FecharBD Conn
		session("msg") = "<img src=imagens/excluido.gif width=17 height=19 align=absmiddle>&nbsp;&nbsp; ITEM EXCLUÍDO COM SUCESSO."
		Set ObjFso = Server.CreateObject("Scripting.FileSystemObject")
		if ObjFso.FolderExists(server.mappath("../upload/albuns/" & alb_codigo)) then
			ObjFso.DeleteFolder(server.mappath("../upload/albuns/" & alb_codigo))
		end if
		Set ObjFso = Nothing
		
		response.redirect "galeriafotos01.asp"
	end if
	
	'-----------------------------------------------------------------------
	'Excluir Foto
	'-----------------------------------------------------------------------
	if request.querystring("atividade") = "apagarfoto" then
		alb_codigo = Corrige_Campo(request.querystring("alb_codigo"))
		foto_codigo = Corrige_Campo(request.querystring("foto_codigo"))
		foto_caminho = "../" & Corrige_Campo(request.querystring("foto_caminho"))
		Set ObjFso = Server.CreateObject("Scripting.FileSystemObject")
		if ObjFso.FileExists(server.mappath(foto_caminho)) then
			ObjFso.DeleteFile(server.mappath(foto_caminho))
		end if
		Set ObjFso = Nothing

		ConectarBD Conn, "websitecafepadrevictor.mdb"
		Conn.execute "delete * from FOTOS where foto_codigo = " & foto_codigo
		FecharBD Conn
		session("msg") = "<img src=imagens/ok_concluido.gif width=18 height=19 align=absmiddle>&nbsp;&nbsp; IMAGEM EXCLUÍDA COM SUCESSO."
		response.redirect "galeriafotos02.asp?codigo=" & codigo & "&alb_codigo=" & alb_codigo & "&atividade=editar"
	end if

	'-----------------------------------------------------------------------
	'Salvar
	'-----------------------------------------------------------------------
	if request.querystring("atividade") = "salvar" then
		ConectarBD Conn, "websitecafepadrevictor.mdb"
			alb_codigo = Campo_Form("alb_codigo")
			alb_descricao = Campo_Form("alb_descricao")
			alb_titulo = Campo_Form("alb_titulo")
			alb_data = date
			thumbnail = Campo_Form("thumbnail")
		CriarRecordset rs
		rs.open "select * from ALBUM where alb_codigo = " & alb_codigo & " ", Conn, 1, 1
		if rs.recordcount > 0 then testa_existencia = "sim" else testa_existencia = "não"
		if testa_existencia = "sim" then
			Conn.execute "update ALBUM set alb_descricao='" & alb_descricao & "', alb_titulo='" & alb_titulo & "', alb_thumbnail='" & thumbnail & "' where alb_codigo=" & alb_codigo & " "			
			session("msg") = "<img src=imagens/ok_concluido.gif width=18 height=19 align=absmiddle>&nbsp;&nbsp;ÁLBUM ATUALIZADO COM SUCESSO."
		else
			Conn.execute "insert into ALBUM (alb_descricao, alb_titulo, alb_data, alb_thumbnail) values ('" & alb_descricao & "','" & alb_titulo & "','" & alb_data & "','" & thumbnail & "')"			
			session("msg") = "<img src=imagens/ok_concluido.gif width=18 height=19 align=absmiddle>&nbsp;&nbsp;ÁLBUM CRIADO COM SUCESSO."
		end if
		FecharRecordset rs
		FecharBD Conn

		if Campo_Form("arquivo") = "sim" then
			ConectarBD Conn, "websitecafepadrevictor.mdb"
			set tb = Conn.execute("select top 1 alb_codigo from ALBUM order by alb_data desc")
			alb_codigo = tb("alb_codigo")
			set tb = nothing
			FecharBD Conn
			response.redirect "galeriafotos02.asp?alb_codigo=" & alb_codigo & "&atividade=editar"
		else
			response.redirect "galeriafotos01.asp"
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
var foto = 'img_' + campo
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
              <td><a href="acesso.asp">MENU</a> &#8250; <a href="galeriafotos01.asp">FOTOS</a> &#8250; CADASTRO DO &Aacute;LBUM </td>
            </tr>
          </table>
          <br>
          <table width="95%" align="center" border="0" cellspacing="0" cellpadding="10" class="table_color">
            <tr>
              <td><b><img src="imagens/logomarca_peq.gif" width="25" height="25" hspace="5" align="absmiddle"> FOTOS: CADASTRO DO &Aacute;LBUM </b><br>
                <font color="#666666">Informe abaixo todos os campos solicitados:<br>
                <br>
                </font>
                <% if session("msg") <> "" then %>
                <table border="0" cellspacing="0" cellpadding="10">
                  <tr>
                    <td bgcolor="#F0F0F0"><font color="#990000"><%= Exibe_Mensagem %></font> </td>
                  </tr>
                </table>
                <% end if %>
                <% if request.querystring("atividade") = "editar" then %>
                <br>
                <table width="70%" border="0" cellpadding="3" cellspacing="1" class="table_borda2">
                  <tr>
                    <td height="25" colspan="2" background="imagens/tit_azulclaro_degrade.gif"><strong>IMAGENS ANEXADAS </strong>
                      <div align="right"></div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><div align="right"> [&nbsp;<a href="upalbum.asp?largura=500&altura=375&pasta=<%=Server.URLEncode("upload/albuns" & "/" & alb_codigo ) %>&foto_album=<%=alb_codigo %>" onClick="abre_janela(500, 400, 'alterar_imagem')" target="alterar_imagem" class="link-branco">ANEXAR IMAGEM </a> ]</div></td>
                  </tr>
                  <tr>
                    <td colspan="2"><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <% 
						ConectarBD Conn, "websitecafepadrevictor.mdb"
						CriarRecordset rs
						rs.open "select * from FOTOS where foto_album = " & alb_codigo & " order by foto_data desc", Conn, 1, 1
						if rs.eof then response.write "<span class=""link-verde style1"">Não Informado</span>"
						while (not rs.bof) and (not rs.eof)
						%>
                        <tr>
                          <td bgcolor="#F8FAFC"><img src="imagens/<% Tipo_Arquivo Lcase(Right(rs("foto_arquivo"),3)) %>"></td>
                          <td width="100%" bgcolor="#F8FAFC">&nbsp;<a href="download.asp?arquivo=<%= rs("foto_arquivo") %>&caminho=<%= rs("foto_caminho") %>"><%= ucase(rs("foto_arquivo")) %><br>
                          </a></td>
                          <td width="150" bgcolor="#F8FAFC"><%= formata_data(rs("foto_data")) %></td>
                          <td width="150" bgcolor="#F8FAFC"><a href="galeriafotos02.asp?alb_codigo=<%= alb_codigo %>&foto_codigo=<%= rs("foto_codigo") %>&foto_caminho=<%= rs("foto_caminho") %>&atividade=apagarfoto" onClick="return Apaga();"><img src="imagens/bt_excluir.gif" width="11" height="11" hspace="3" border="0"></a></td>
                        </tr>
                        <%
						rs.movenext
						wend
						FecharRecordset rs
						FecharBD Conn
			 		%>
                      </table></td>
                  </tr>
                </table>
                <br>
                <% end if %>
                <table border="0" cellspacing="0" cellpadding="0">
                  <form name="cadastro" method="post" action="galeriafotos02.asp?atividade=salvar" onSubmit="return DFckForm(this, true)">
                    <tr>
                      <td height="40"><div align="right">* Nome do &Aacute;lbum:</div></td>
                      <td height="40"><strong class="link-verde">&nbsp;
                        <input name="alb_titulo" type="text" id="alb_titulo" value="<%= alb_titulo %>" size="80">
                        &nbsp;
                        <input name="uni_codunimed" type="hidden" id="uni_codunimed" value="<%= uni_codunimed %>">
                        <input name="alb_codigo" type="hidden" id="alb_codigo" value="<% if alb_codigo = "" then response.write "0" else response.write alb_codigo %>">
                      </strong></td>
                    </tr>
                    <tr>
                      <td height="30" valign="top"><div align="right">* Resumo:</div></td>
                      <td height="30">&nbsp;
                        <textarea name="alb_descricao" cols="80" rows="5" id="alb_descricao"><%= alb_descricao %></textarea></td>
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
                            <td><strong>Enviar imagens:</strong><br>
                              &#8250;&nbsp;<a href="upthumb.asp?largura=191&altura=255&largurapeq=100&alturapeq=134&campo=<%=Server.URLEncode("thumbnail")%>&pasta=<%=Server.URLEncode("upload/fotologos")%>" onClick="abre_janela(500, 350, 'alterar_imagem')" target="alterar_imagem" class="texto_pagina">Imagens: tamanho m&aacute;ximo 5mb (Foto Vertical) </a></td>
                          </tr>
                      </table></td>
                    </tr>
                    <% if request.querystring("atividade") = "adicionar" then %>
                    <tr>
                      <td height="30">&nbsp;</td>
                      <td height="40">&nbsp;
                        <input name="arquivo" type="checkbox" class="checkbox" id="arquivo" value="sim" obligatory="false">
                        DESEJO ANEXAR ARQUIVO(S) AO FORMUL&Aacute;RIO.</td>
                    </tr>
                    <% end if %>
                    <tr>
                      <td height="30"><input type="hidden" name="id" value="<%= id %>">                      </td>
                      <td height="30"><br>
                        &nbsp;
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
