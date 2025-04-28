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
		bib_codigo = Corrige_Campo(request.querystring("bib_codigo"))
		rs.open "select * from BIBLIOTECA where bib_codigo = " & bib_codigo, Conn, 1, 1
		if (not rs.bof) and (not rs.eof) then
			bib_codigo = rs("bib_codigo")
			bib_descricao = rs("bib_descricao")
			bib_titulo = rs("bib_titulo")
			bib_data = rs("bib_data")
		end if
		FecharRecordset rs
		FecharBD Conn
	end if
	'-----------------------------------------------------------------------
	'Excluir
	'-----------------------------------------------------------------------
	if request.querystring("atividade") = "excluir" then
		bib_codigo = request.querystring("bib_codigo")
		ConectarBD Conn, "websitecafepadrevictor.mdb"
		Conn.execute "delete * from BIBLIOTECA where bib_codigo = " & bib_codigo & " "
		Conn.execute "delete * from ARQUIVOS where arq_biblioteca = " & bib_codigo & " "
		FecharBD Conn
		session("msg") = "<img src=imagens/excluido.gif width=17 height=19 align=absmiddle>&nbsp;&nbsp; ITEM EXCLUÍDO COM SUCESSO."
		Set ObjFso = Server.CreateObject("Scripting.FileSystemObject")
		if ObjFso.FolderExists(server.mappath("../upload/arquivos/" & bib_codigo)) then
			ObjFso.DeleteFolder(server.mappath("../upload/arquivos/" & bib_codigo))
		end if
		Set ObjFso = Nothing
		
		response.redirect "galeriaarquivos01.asp"
	end if
	
	'-----------------------------------------------------------------------
	'Excluir Foto
	'-----------------------------------------------------------------------
	if request.querystring("atividade") = "apagarfoto" then
		bib_codigo = Corrige_Campo(request.querystring("bib_codigo"))
		arq_codigo = Corrige_Campo(request.querystring("arq_codigo"))
		arq_caminho = "../" & Corrige_Campo(request.querystring("arq_caminho"))
		Set ObjFso = Server.CreateObject("Scripting.FileSystemObject")
		if ObjFso.FileExists(server.mappath(arq_caminho)) then
			ObjFso.DeleteFile(server.mappath(arq_caminho))
		end if
		Set ObjFso = Nothing

		ConectarBD Conn, "websitecafepadrevictor.mdb"
		Conn.execute "delete * from ARQUIVOS where arq_codigo = " & arq_codigo
		FecharBD Conn
		session("msg") = "<img src=imagens/ok_concluido.gif width=18 height=19 align=absmiddle>&nbsp;&nbsp; GALERIA EXCLUÍDA COM SUCESSO."
		response.redirect "galeriaarquivos02.asp?codigo=" & codigo & "&bib_codigo=" & bib_codigo & "&atividade=editar"
	end if

	'-----------------------------------------------------------------------
	'Salvar
	'-----------------------------------------------------------------------
	if request.querystring("atividade") = "salvar" then
		ConectarBD Conn, "websitecafepadrevictor.mdb"
			bib_codigo = Campo_Form("bib_codigo")
			bib_descricao = Campo_Form("bib_descricao")
			bib_titulo = Campo_Form("bib_titulo")
			bib_data = date
		CriarRecordset rs
		rs.open "select * from BIBLIOTECA where bib_codigo = " & bib_codigo & " ", Conn, 1, 1
		if rs.recordcount > 0 then testa_existencia = "sim" else testa_existencia = "não"
		if testa_existencia = "sim" then
			Conn.execute "update BIBLIOTECA set bib_descricao='" & bib_descricao & "', bib_titulo='" & bib_titulo & "' where bib_codigo=" & bib_codigo & " "			
			session("msg") = "<img src=imagens/ok_concluido.gif width=18 height=19 align=absmiddle>&nbsp;&nbsp;GALERIA ATUALIZADA COM SUCESSO."
		else
			Conn.execute "insert into BIBLIOTECA (bib_descricao, bib_titulo, bib_data) values ('" & bib_descricao & "','" & bib_titulo & "','" & bib_data & "')"			
			session("msg") = "<img src=imagens/ok_concluido.gif width=18 height=19 align=absmiddle>&nbsp;&nbsp;GALERIA CRIADA COM SUCESSO."
		end if
		FecharRecordset rs
		FecharBD Conn

		if Campo_Form("arquivo") = "sim" then
			ConectarBD Conn, "websitecafepadrevictor.mdb"
			set tb = Conn.execute("select top 1 bib_codigo from BIBLIOTECA order by bib_data desc")
			bib_codigo = tb("bib_codigo")
			set tb = nothing
			FecharBD Conn
			response.redirect "galeriaarquivos02.asp?bib_codigo=" & bib_codigo & "&atividade=editar"
		else
			response.redirect "galeriaarquivos01.asp"
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
              <td><a href="acesso.asp">MENU</a> &#8250; <a href="galeriaarquivos01.asp">PDF'S E IMAGENS (PROVAS E SIMULADOS) </a> &#8250; CADASTRO DA GALERIA </td>
            </tr>
          </table>
          <br>
          <table width="95%" align="center" border="0" cellspacing="0" cellpadding="10" class="table_color">
            <tr>
              <td><b><img src="imagens/logomarca_peq.gif" width="25" height="25" hspace="5" align="absmiddle"> PDF'S E IMAGENS (PROVAS E SIMULADOS): CADASTRO DA GALERIA </b><br>
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
                    <td height="25" colspan="2" background="imagens/tit_azulclaro_degrade.gif"><strong>ARQUIVOS ANEXADOS </strong>
                      <div align="right"></div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><div align="right"> [&nbsp;<a href="upgaleria.asp?pasta=<%=Server.URLEncode("upload/arquivos" & "/" & bib_codigo ) %>&arq_biblioteca=<%=bib_codigo %>" onClick="abre_janela(500, 400, 'alterar_imagem')" target="alterar_imagem" class="link-branco">ANEXAR ARQUIVO </a> ]</div></td>
                  </tr>
                  <tr>
                    <td colspan="2"><table width="100%" border="0" cellpadding="3" cellspacing="1">
                        <% 
						ConectarBD Conn, "websitecafepadrevictor.mdb"
						CriarRecordset rs
						rs.open "select * from ARQUIVOS where arq_biblioteca = " & bib_codigo & " order by arq_data desc", Conn, 1, 1
						if rs.eof then response.write "<span class=""link-verde style1"">Não Informado</span>"
						while (not rs.bof) and (not rs.eof)
						%>
                        <tr>
                          <td bgcolor="#F8FAFC"><img src="imagens/<% Tipo_Arquivo Lcase(Right(rs("arq_arquivo"),3)) %>"></td>
                          <td width="100%" bgcolor="#F8FAFC"><a href="download.asp?arquivo=<%= rs("arq_arquivo") %>&caminho=<%= rs("arq_caminho") %>"><%= ucase(rs("arq_arquivo")) %></a><br><%= lcase(rs("arq_descricao")) %></td>
                          <td bgcolor="#F8FAFC"><div align="right">&nbsp;&nbsp;&nbsp;<%= formatnumber(ucase(rs("arq_tamanho")/1000),0) %>kb&nbsp;&nbsp;&nbsp; </div></td>
                          <td width="150" bgcolor="#F8FAFC"><%= formata_data(rs("arq_data")) %></td>
                          <td width="150" bgcolor="#F8FAFC"><a href="galeriaarquivos02.asp?bib_codigo=<%= bib_codigo %>&arq_codigo=<%= rs("arq_codigo") %>&arq_caminho=<%= rs("arq_caminho") %>&atividade=apagarfoto" onClick="return Apaga();"><img src="imagens/bt_excluir.gif" width="11" height="11" hspace="3" border="0"></a></td>
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
                  <form name="cadastro" method="post" action="galeriaarquivos02.asp?atividade=salvar" onSubmit="return DFckForm(this, true)">
                    <tr>
                      <td height="40"><div align="right">* Nome da Galeria:</div></td>
                      <td height="40"><strong class="link-verde">&nbsp;
                        <input name="bib_titulo" type="text" id="bib_titulo" value="<%= bib_titulo %>" size="80">
                        &nbsp;
                        <input name="uni_codunimed" type="hidden" id="uni_codunimed" value="<%= uni_codunimed %>">
                        <input name="bib_codigo" type="hidden" id="bib_codigo" value="<% if bib_codigo = "" then response.write "0" else response.write bib_codigo %>">
                      </strong></td>
                    </tr>
                    <tr>
                      <td height="30" valign="top"><div align="right">* Resumo:</div></td>
                      <td height="30">&nbsp;
                        <textarea name="bib_descricao" cols="80" rows="5" id="bib_descricao"><%= bib_descricao %></textarea></td>
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
