<!--#include file="include_menu.asp" -->
<% 	Permissao "ADM","acesso.asp" %>
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
    <td><a href="acesso.asp">MENU</a> &#8250; GERENCIAR USU&Aacute;RIOS </td>
  </tr>
</table>
<br>
          <table width="95%" border="0" align="center" cellpadding="10" cellspacing="0" class="table_color">
            <tr> 
              <td><img src="imagens/usuario_chave.gif" width="25" height="25" hspace="5" align="absmiddle">&nbsp;<b>GERENCIAR USU&Aacute;RIOS</b><br>
                <% if session("msg") <> "" then %>
                <br>
                <table border="0" cellspacing="0" cellpadding="10">
                  <tr> 
                    <td bgcolor="#F0F0F0"> <font color="#990000"><%= Exibe_Mensagem %></font>                    </td>
                  </tr>
                </table>
                <br>
                <% end if %>
                <table width="80%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><table width="100%" border="0" cellpadding="5" cellspacing="0">
                      <tr>
                        <td><div align="right">[&nbsp;<a href="usuario02.asp?atividade=adicionar"  class="link-branco">NOVO USU&Aacute;RIO </a> ]</div></td>
                      </tr>
                    </table>
                      <table width="100%" border="0" cellpadding="4" cellspacing="1">
                        <tr>
                          <td colspan="4" height="1" bgcolor="#D4D5C4"></td>
                        </tr>
                        <tr>
                          <td height="25" background="imagens/tit_azulclaro_degrade.gif"><strong>NOME</strong></td>
                          <td background="imagens/tit_azulclaro_degrade.gif"><div align="center"><strong>PERMISS&Atilde;O</strong></div></td>
                          <td height="25" background="imagens/tit_azulclaro_degrade.gif">&nbsp;</td>
                        </tr>
                        <%
							ConectarBD Conn, "websitecafepadrevictor.mdb"
							CriarRecordset rs
							rs.open "SELECT * from usuarios order by usr_permissao, usr_nome", Conn, 1, 1
							while (not rs.bof) and (not rs.eof)
								if cor_fundo = "#F8FAFC" then cor_fundo = "#FFFFFF" else cor_fundo = "#F8FAFC"
						%>
                        <tr>
                          <td colspan="4" height="1" bgcolor="#D4D5C4"></td>
                        </tr>
                        <tr>
                          <td width="100%" bgcolor="<%= cor_fundo %>"><%= ucase(rs("usr_nome")) %></td>
                          <td bgcolor="<%= cor_fundo %>"><div align="center"><% if ucase(rs("usr_permissao")) = "ADM" then response.write "<b>" & ucase(rs("usr_permissao")) & "</b>" else response.write ucase(rs("usr_permissao")) %></div></td>
                          <td bgcolor="<%= cor_fundo %>"><div align="right"><a href="usuario02.asp?codigo=<%= rs("usr_cod") %>&atividade=editar"><img src="imagens/bt_editar.gif" width="14" height="15" hspace="5" border="0" align="absmiddle" alt="EDITAR"></a><a href="usuario02.asp?codigo=<%= rs("usr_cod") %>&atividade=excluir" onClick="return Apaga();"><img src="imagens/bt_excluir.gif" width="11" height="11" border="0" hspace="5" align="absmiddle" alt="EXCLUIR"></a></div></td>
                        </tr>
                        <%
								rs.movenext
							wend
				  %>
                        <%
							FecharRecordset rs
							FecharBD Conn
				  %>
                        <tr>
                          <td colspan="4" height="1" bgcolor="#D4D5C4"></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
              </td>
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
