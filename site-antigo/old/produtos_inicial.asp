<!--#include file="adm/include_menu.asp" -->
<% Response.Charset="ISO-8859-1" %>
<table width="260" border="0" cellpadding="0" cellspacing="0" background="imagens/fundomeio_iniprodutos.jpg">
  <tr>
    <td height="200" valign="top" style="background-image:url(imagens/fundotopo_iniprodutos.jpg); background-repeat:no-repeat;"><div align="center"><br />
            <%
						CANAL = request.QueryString("ID")
						ConectarBD Conn, "websitecafepadrevictor.mdb"
						IF CANAL = "" THEN
							set TB = Conn.execute ("SELECT ID, TITULO, RESUMO, THUMBNAIL FROM PRODUTOS ORDER BY RND(INT(NOW*PRODUTOS.id)-NOW*PRODUTOS.id)")
						ELSE
							set TB = Conn.execute ("SELECT ID, TITULO, RESUMO, THUMBNAIL FROM PRODUTOS WHERE ID = " & CANAL )						
						END IF
						if (not tb.bof) and (not tb.eof) then
							if (TB("THUMBNAIL") <> "imagens/noimage.gif") and (TB("THUMBNAIL") <> "") then response.write "<a href=""produtos.asp?ID=" & TB("ID") & "#exibeconteudo"" title=""" & TB("TITULO") & chr(13) & TB("RESUMO") & """><img src=" & replace(replace(TB("thumbnail"),"/produtos/","/produtos/inicial/"),"../","") & " border=""0""/></a>"
							set TBanterior = Conn.execute ("SELECT max(ID) as ANTERIOR FROM PRODUTOS where ID < " & TB("ID") & "")
							if vartype(TBanterior("ANTERIOR")) = 1 then
								SET TBanterior = nothing
								set TBanterior = Conn.execute ("SELECT max(ID) as ANTERIOR FROM PRODUTOS")						
							end if
							set TBproximo = Conn.execute ("SELECT min(ID) as PROXIMO FROM PRODUTOS where ID > " & TB("ID") & "")
							if vartype(TBproximo("PROXIMO")) = 1 then
								SET TBproximo = nothing
								set TBproximo = Conn.execute ("SELECT min(ID) as PROXIMO FROM PRODUTOS")						
							end if
							anterior = TBanterior("ANTERIOR")
							proximo = TBproximo("PROXIMO")
						end if
						SET TBanterior = nothing
						SET TBanterior = nothing
						SET TB = nothing
						FecharBD Conn
					%>
    </div></td>
  </tr>
</table>
<table width="260" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="82" valign="top" background="imagens/fundobase_iniprodutos.jpg"><table width="260" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" valign="top"><div align="center"><a href="javascript:exibeproduto(<%= anterior %>);"><img src="imagens/anterior.jpg" alt="Anterior" width="22" height="23" hspace="15" border="0" /></a><a href="javascript:exibeproduto(<%= proximo %>);"><img src="imagens/proxima.jpg" alt="Pr&oacute;ximo" width="22" height="23" hspace="15" border="0" /></a></div></td>
      </tr>
    </table></td>
  </tr>
</table>












