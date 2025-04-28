<%@LANGUAGE="VBSCRIPT" CODEPAGE="1252"%>
<!--#include file="adm/include_menu.asp" -->
<%
		if request.QueryString("atividade") = "enviar" then
						nome = request.Form("nome")
						email = request.Form("email")
						ddd = request.Form("ddd")
						telefone = request.Form("telefone")
						cidade = request.Form("cidade")
						uf = request.Form("uf")
						perfil = request.Form("perfil")
						assunto = request.Form("assunto")
						mensagem = request.Form("mensagem")
						enviar = request.Form("enviar")
						
						Set Mail = Server.CreateObject("Persits.MailSender") 
						Mail.Host = "mail.tpnet.psi.br" 
						Mail.From = email
						Mail.FromName = nome
						'Mail.AddAddress "patrick@maisvarginha.com.br"
						Mail.AddAddress "atendimento@padrevictorcafe.com.br"

						'-------------------------------------------------------------------------
						
						Boletim = "<html><style type=text/css>"
						Boletim = boletim & "body {"
						Boletim = boletim & "margin-left: 15px; margin-top: 15px; margin-right: 15px; margin-bottom: 15px;"
						Boletim = boletim & "}"
						Boletim = boletim & "body,td,th {"
						Boletim = boletim & "font-size: 13px; color: #000000; font-family: tahoma, verdana, arial"
						Boletim = boletim & "}"
						Boletim = boletim & "hr {"
						Boletim = boletim & "color: #eaeaea; height: 1px"
						Boletim = boletim & "}"	
						Boletim = boletim & "</style><body>"
						Boletim = boletim & "<strong>Uma novo e-mail foi postado através do Formulário de Contato do website do Café Padre Victor.<BR>Abaixo os dados informados.</strong><br><br>Enviado em: " & now
						Boletim = boletim & "<br><br><strong>Nome:</strong> " & nome
						Boletim = boletim & "<br><strong>E-mail:</strong> " & email
						Boletim = boletim & "<br><strong>Telefone:</strong> (" & ddd & ") " & telefone
						Boletim = boletim & "<br><strong>Cidade:</strong> " & cidade
						Boletim = boletim & "<br><strong>UF:</strong> " & uf
						Boletim = boletim & "<br><strong>Perfil:</strong> " & perfil
						Boletim = boletim & "<br><strong>Assunto:</strong> " & assunto
						Boletim = boletim & "<br><strong>Mensagem:</strong><br> " & Campo_Linha(mensagem)
						Boletim = boletim & "</body></html>"

						Mail.Body = boletim
						Mail.IsHTML = True
						Mail.Subject = "Fale Conosco: " & perfil
				
						On Error Resume Next 
						Mail.Send 
						If Err <> 0 Then 
							'session("msg") = "Erro no envio: " & Err.Description & "<BR><BR>"
							session("msg") =  "<img src=adm/imagens/exclamacao_erro.gif width=16 height=16 align=absmiddle>&nbsp;&nbsp;O envio não foi concluído. Por favor, preencha os dados novamente ou envie-nos um e-mail: atendimento@padrevictorcafe.com.br."
						else
							session("msg") = "<img src=adm/imagens/ok_concluido.gif width=18 height=19 align=absmiddle>&nbsp;&nbsp;Recebemos seus dados com sucesso. Teremos prazer em atendê-lo o mais prontamente possível."
						end if	
			end if
%>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Caf&eacute; Padre Victor</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="fundo">
  <table width="800" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EECE9B">
    <tr>
      <td height="261" valign="top"><!--#include file="include_topo.asp" --></td>
    </tr>
    <tr>
      <td valign="top">
  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#EECE9B">
    <tr>
      <td><img src="imagens/tit_faleconosco.jpg" width="479" height="39" vspace="15" />
        <% if session("msg") <> "" then %>
                <table width="640" border="0" align="center" cellpadding="10" cellspacing="0">
                  <tr>
                    <td bgcolor="#F0F0F0"><font color="#990000"><%= Exibe_Mensagem %></font> </td>
                  </tr>
              </table>
                <br />
                <% end if %>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" background="imagens/fundomeio_institucional.jpg">
        <tr>
          <td height="130" valign="top" style="background-image:url(imagens/fundotopo_institucional.jpg); background-repeat:no-repeat;"><table width="640" border="0" align="center" cellpadding="30" cellspacing="0">
            <tr>
              <td class="link-branco"><div align="justify"><span class="letrao">Atendimento</span><br />
                <br />
                Para obter mais informa&ccedil;&otilde;es sobre nossos produtos ou entrar em contato com algum   de nossos profissionais, basta nos enviar uma mensagem. Teremos prazer em   atend&ecirc;-lo o mais prontamente poss&iacute;vel. <br />  
                    <br />
              </div>
                <table border="0" cellpadding="2" cellspacing="0">
                  <form id="form_atendimento" name="form_atendimento" method="post" action="faleconosco.asp?atividade=enviar#exibeconteudo" onSubmit="return DFckForm(this, true);">
				  <tr>
                    <td height="25"><div align="right">* Nome:</div></td>
                    <td height="25">&nbsp;
                      <input name="nome" type="text" id="nome" title="Nome" size="50" maxlength="150" /></td>
				  </tr>
                  <tr>
                    <td height="25"><div align="right">* E-Mail:</div></td>
                    <td height="25">&nbsp;
                      <input name="email" type="text" id="email" title="E-mail" size="50" maxlength="150" xtype="email" /></td>
                  </tr>
                  <tr>
                    <td><div align="right">* Telefone:</div></td>
                    <td> (
                      <input name="ddd" type="text" id="ddd" title="Telefone" onkeypress="return DFonlyThisChars(true,false,'',event)" onKeyUp="DFchangeField(this,event,1)" size="3" maxlength="2"/>
                      )
                      &nbsp;
                          <input name="telefone" type="text" id="telefone" title="Telefone" onkeypress="return DFonlyThisChars(true,false,'-',event)" size="10" maxlength="9" /></td>
                  </tr>
                  <tr>
                    <td height="25"><div align="right">* Cidade:</div></td>
                    <td height="25">&nbsp;
                      <input name="cidade" type="text" id="cidade" title="Cidade" size="36" maxlength="100"/> 
                      &nbsp;&nbsp;* UF: 
                      <input name="uf" type="text" id="uf" size="4" maxlength="2" title="UF"/></td>
                  </tr>
                  <tr>
                    <td height="25"><div align="right">Perfil:</div></td>
                    <td height="25">&nbsp;
                        <select name="perfil" id="perfil" title="Perfil" style="width:270px">
                          <option value="Visitante">Visitante</option>
                          <option value="Cliente">Cliente</option>
                          <option value="Distribuidor">Distribuidor</option>
                            </select>					</td>
                  </tr>
                  <tr>
                    <td height="25"><div align="right">Assunto:</div></td>
                    <td height="25">&nbsp;
                        <select name="assunto" id="assunto" title="Assunto" style="width:270px">
                          <option value="Compra">Compra</option>
                          <option value="Dúvida">D&uacute;vida</option>
                          <option value="Elogio">Elogio</option>
                          <option value="Reclamação">Reclama&ccedil;&atilde;o</option>
                          <option value="Solicitação">Solicita&ccedil;&atilde;o</option>
                          <option value="Trabalhe Conosco">Trabalhe Conosco</option>
                       </select></td>
                  </tr>
                  <tr>
                    <td height="25" valign="top"><div align="right">*  Mensagem:</div></td>
                    <td height="25">&nbsp;
                        <textarea name="mensagem" cols="50" rows="8" id="mensagem" title="Mensagem"></textarea></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;</td>
                    <td height="35"><input type="submit" name="Submit" value="Enviar" /></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;</td>
                    <td height="25"><font color="#666666" size="1">Os campos marcados com (*) s&atilde;o de preenchimento obrigat&oacute;rio.</font></td>
                  </tr>
				  </form>
                </table></td></tr>
          </table></td>
        </tr>
        <tr>
          <td height="107" valign="top" style="background-image:url(imagens/fundobase_institucional.jpg); background-repeat:no-repeat;">&nbsp;</td>
        </tr>
      </table>
      </td>
    </tr>
</table>
      <p>&nbsp;</p></td>
    </tr>
    <tr>
      <td height="52" valign="top" background="imagens/fundobasesite.jpg">&nbsp;</td>
    </tr>
  </table>
</div>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-5754997-1";
urchinTracker();
</script>
</body>
</html>
