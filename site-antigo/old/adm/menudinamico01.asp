<!--#include file="include_menu.asp" -->
<% 	Permissao "ADM","acesso.asp" %>
<%


	'-----------------------------------------------------------------------
	'	CONSTRUTOR DE SQL
	'-----------------------------------------------------------------------		
		if (request.form <> "") then
			palavra_chave = Campo_Form("palavra_chave")
			
			session("SQL") = "SELECT * FROM MENUDINAMICO where (1=1)"				
			if palavra_chave = " » BUSCA POR" then palavra_chave = ""
			if palavra_chave <> "" then session("SQL") = session("SQL") & " and ((nome_menudinamico like '%" & busca_inteligente(palavra_chave) & "%'))"
			session("SQL") = session("SQL") & " order by nome_menudinamico"
		end if
		
		SQL = session("SQL")

		ConectarBD Conn, "websitecafepadrevictor.mdb"
		CriarRecordset rs
		rs.pagesize = 20
		if (sql = "") or ((request.querystring = "") and (request.form = "")) then
			SQL = "SELECT * FROM MENUDINAMICO order by nome_menudinamico"
			session("SQL") = ""
		end if
		
		rs.open SQL, Conn, 1, 1
					
		pagina = request.querystring("pagina")
		if(isnumeric(pagina) = false) or (pagina = "") Then
			pagina = 1
		end if
		if (cint(pagina) <= 0) or (cint(pagina) > rs.pagecount) then
			pagina = 1
		end if
		if rs.pagecount = 0 then pagina = 0
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
    <td><a href="acesso.asp">MENU</a> &#8250; CONTE&Uacute;DO DIN&Acirc;MICO </td>
  </tr>
</table>
<br>
          <table width="95%" border="0" align="center" cellpadding="10" cellspacing="0" class="table_color">
            <tr> 
              <td><img src="imagens/logomarca_peq.gif" width="25" height="25" hspace="5" align="absmiddle">&nbsp;<b>CONTE&Uacute;DO DIN&Acirc;MICO </b><br>
                <% if session("msg") <> "" then %>
                <br>
                <table border="0" cellspacing="0" cellpadding="10">
                  <tr> 
                    <td bgcolor="#F0F0F0"> <font color="#990000"><%= Exibe_Mensagem %></font>                    </td>
                  </tr>
                </table>
                <br>
                <% end if %>
                <br>
                <table width="95%" border="0" cellpadding="8" cellspacing="0" class="table_borda">
                  <form name="form1" method="post" action="menudinamico01.asp">
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td colspan="4"><img src="imagens/lupa_busca.gif" width="16" height="16" align="right">
                        &nbsp;<% if palavra_chave = "" then palavra_chave = " » BUSCA POR" %>
                          <input name="palavra_chave" type="text" id="palavra_chave" value="<%= palavra_chave %>" size="40" onClick="this.value=''">
  &nbsp;&nbsp;
                          <input type="submit" name="Submit" value="Buscar">
                          <p>[ <strong><%= rs.recordcount %></strong> <font size="1">resultado(s) encontrados ] </font></p></td>
                    </tr>
                  </form>
                </table>
                <br>
                <table width="60%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><table width="100%" border="0" cellpadding="4" cellspacing="1">
                        <tr>
                          <td colspan="3" height="1" bgcolor="#D4D5C4"></td>
                        </tr>
                        <tr>
                          <td width="100%" height="25" background="imagens/tit_azulclaro_degrade.gif"><strong>NOME NO MENU </strong></td>
                          <td height="25" background="imagens/tit_azulclaro_degrade.gif">&nbsp;</td>
                        </tr>
                        <%
							if not rs.eof then rs.absolutepage = pagina
							contador = 0
							while (not rs.eof) and (contador < rs.pagesize)
								if cor_fundo = "#F8FAFC" then cor_fundo = "#FFFFFF" else cor_fundo = "#F8FAFC"
						%>
                        <tr>
                          <td colspan="3" height="1" bgcolor="#D4D5C4"></td>
                        </tr>
                        <tr>
                          <td bgcolor="<%= cor_fundo %>"><%= ucase(rs("nome_menudinamico")) %></td>
                          <td bgcolor="<%= cor_fundo %>"><div align="right"><a href="menudinamico02.asp?ID=<%= rs("ID_menudinamico") %>&atividade=editar"><img src="imagens/bt_editar.gif" width="14" height="15" hspace="5" border="0" align="absmiddle" alt="EDITAR"></a><a href="menudinamico02.asp?ID=<%= rs("ID_menudinamico") %>&atividade=excluir" onClick="return Apaga();"><img src="imagens/bt_excluir.gif" width="11" height="11" border="0" hspace="5" align="absmiddle" alt="EXCLUIR"></a></div></td>
                        </tr>
				  <%
						contador = contador + 1
						rs.movenext
						wend
				  %>
                        <tr>
                          <td colspan="3" height="1" bgcolor="#D4D5C4"></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>              
                <% if rs.pagecount > 1 then %>
                <table width="95%" border="0" cellpadding="10" cellspacing="0">
                  <tr>
                    <td><div align="justify">
                        <%
					if cint(pagina) > 1 then response.write "<a href='" & request.servervariables("script_name") & "?pagina=" & pagina - 1 & "'>&laquo;&laquo; Anterior</a>&nbsp;&nbsp;&nbsp;"
					for i = 1 to rs.pagecount
						if rs.pagecount <> 1 then
							if i = cint(pagina) then
							   response.write "<b>|" & i & "|</b> "
							else
							   response.write "<a href='" & request.servervariables("script_name") & "?pagina=" & i & "'>|" & i & "|</a> "
							end if
						end if
					next
					if rs.pagecount > cint(pagina) then response.write "&nbsp;&nbsp;&nbsp;<a href='" & request.servervariables("script_name") & "?pagina=" & pagina + 1 & "'>Pr&oacute;xima &raquo;&raquo;</a>"
				FecharRecordset rs
				FecharBD Conn
				  %>
                      </div>
                        <div align="right"></div></td>
                  </tr>
                </table>
              <% end if %></td>
            </tr>
          </table>
          <br>
        </div>
      </td>
    </tr>
  </table>
</div>
</body>
</html>