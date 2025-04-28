<%
		vChave1 = "localhost"
		vChave2 = "www.padrevictorcafe.com.br"
		vIP = Request.Servervariables("SERVER_NAME")
	
		if (vChave1 <> vIP) and (vChave2 <> vIP) then
			Response.Redirect "default.asp"
		end if

	'-----------------------------------------------------------------------
	'Fun��o que detecta e corrige as vari�veis (m�todo POST nos formul�rios)
	'-----------------------------------------------------------------------
	function Campo_Form(variavel)
		Campo_Form = replace(request.form(variavel),"'","''")
	end function

	'-----------------------------------------------------------------------
	'Fun��o que verifica campo
	'-----------------------------------------------------------------------
	function verificampo(variavel)
		if variavel = "" then verificampo = "<span class=""link-verde style1"">N�o Informado</span>" else verificampo = variavel
	end function
	
	function verificampoconcorrente(variavel)
		if variavel = "" then verificampoconcorrente = "<span class=""link-azul style1"">N�o Informado</span>" else verificampoconcorrente = variavel
	end function
	
	'-----------------------------------------------------------------------
	'Fun��o que remove tags html de um texto
	'-----------------------------------------------------------------------
	Function RemoveHTMLTags(ByVal strHTML)
    Dim objER
    Dim strTexto

    'Configurando o objeto de Express�o Regular
    Set objER            = New RegExp 
    objER.IgnoreCase    = True
    objER.Global        = True
    objER.Pattern        = "<[^>]*>"
    
    'Substituindo as tags encontradas pela express�o
    strTexto            = strHTML
    strTexto            = objER.Replace(strTexto, "")
    
    Set objER            = Nothing

    'Retornando a fun��o
    RemoveHTMLTags = strTexto
	End Function

	'-----------------------------------------------------------------------
	'Fun��o que detecta e corrige as vari�veis (m�todo POST nos formul�rios)
	'-----------------------------------------------------------------------
	function Campo_Noticias(variavel)
		Campo_Noticias = replace(request.form(variavel),"'","''")
		Campo_Noticias = replace(Campo_Noticias,chr(13),"<BR>")
	end function

	'-----------------------------------------------------------------------
	'Fun��o que exibe cpf
	'-----------------------------------------------------------------------
	function cpf(variavel)
		while len(variavel) < 11
			variavel = "0" & variavel
		wend
		cpf = variavel
	end function

	'-----------------------------------------------------------------------
	'Fun��o que detecta e corrige as vari�veis
	'-----------------------------------------------------------------------
	function Corrige_Campo(variavel)
		Corrige_Campo = replace(variavel,"'","''")
		Corrige_Campo = ucase(Corrige_Campo)
	end function

	'--------------------------------------------------------------------
	'Fun��o que transforma o c�digo "<BR>", em linhas nos campos TEXTAREA
	'--------------------------------------------------------------------
	function Campo_Linha(variavel)
		if variavel <> "" then Campo_Linha = replace(variavel,chr(13),"<BR>")
	end function

	'--------------------------------------------------------------------
	'Fun��o que transforma o c�digo "<BR>", em linhas nos campos TEXTAREA
	'--------------------------------------------------------------------
	function Exibe_Mensagem()
		Exibe_Mensagem = session("msg")
		session("msg") = ""
	End function

	'----------------------------------------------
	'Fun��o que formata a data no padr�o dd/mm/aaaa
	'----------------------------------------------
	function Formata_Data(dt)
		var_dia = day(dt)
		var_mes = month(dt)
		if len(var_dia) = 1 then var_dia = "0" & var_dia
		if len(var_mes) = 1 then var_mes = "0" & var_mes
		Formata_Data = var_dia & "/" & var_mes & "/" & year(dt)
		if Formata_Data = "//" then Formata_Data = "indefinida"
		if Formata_Data = "30/12/1899" then Formata_Data = "<span class=""link-verde style1"">N�o Informado</span>"
	end function
	
	function Formata_DataConcorrente(dt)
		var_dia = day(dt)
		var_mes = month(dt)
		if len(var_dia) = 1 then var_dia = "0" & var_dia
		if len(var_mes) = 1 then var_mes = "0" & var_mes
		Formata_DataConcorrente = var_dia & "/" & var_mes & "/" & year(dt)
		if Formata_DataConcorrente = "//" then Formata_DataConcorrente = "indefinida"
		if Formata_DataConcorrente = "30/12/1899" then Formata_DataConcorrente = "<span class=""link-azul style1"">N�o Informado</span>"
	end function

	'----------------------------------------------
	'Fun��o que formata a data no padr�o mm/dd/aaaa
	'----------------------------------------------
	function Formata_DataContrario(dt)
		if dt <> "//" then
			var_dia = day(dt)
			var_mes = month(dt)
			if len(var_dia) = 1 then var_dia = "0" & var_dia
			if len(var_mes) = 1 then var_mes = "0" & var_mes
			Formata_DataContrario = var_mes & "/" & var_dia & "/" & year(dt)
		else
			Formata_DataContrario = ""
		end if 
	end function

	'----------------------------------------------------------------
	'Fun��o que verifica o acesso ao usu�rio a uma determinada p�gina
	'----------------------------------------------------------------
	Sub Permissao(usr, pagina)
		if instr(USR,session("permissao")) = 0 then response.redirect pagina
		Response.CacheControl = "no-cache"
		Response.AddHeader "Pragma", "no-cache"
		Response.Expires = -1
	End Sub
	
	'----------------------------------------------------------------
	'Fun��o que verifica o tipo de arquivo
	'----------------------------------------------------------------
	Sub Tipo_Arquivo(tipo)
		if (tipo = "jpg") or (tipo = "gif") then response.write "arq_imagem.gif"
		if (tipo = "mp3") or (tipo = "wma") or (tipo = "avi") or (tipo = "swf") then response.write "arq_audiovideo.gif"
		if (tipo = "doc") or (tipo = "pdf") then response.write "arq_documento.gif"
		if (tipo = "xls") then response.write "arq_planilha.gif"
		if (tipo = "ppt") then response.write "arq_slide.gif"
	End Sub
	
	'-----------------------------------------------
	'Subrotina que abre conex�o com o banco de dados
	'-----------------------------------------------
	Sub ConectarBD (ObjConexao, ArquivoMdb)
	
		ConnString="Provider=Microsoft.Jet.OLEDB.4.0;Data Source=D:\homepages\CafePadreVictor\adm\dados\" & ArquivoMdb & ";Jet OLEDB:Database Password=Patrick"
		'ConnString="Provider=Microsoft.Jet.OLEDB.4.0;Data Source=C:\Inetpub\wwwroot\cafepadrevictor\adm\dados\" & ArquivoMdb & ";Jet OLEDB:Database Password=Patrick"
		Set ObjConexao = Server.CreateObject("ADODB.Connection")
		ObjConexao.Open ConnString
	End Sub

	'-------------------------------
	'Subrotina que cria um Recordset
	'-------------------------------
	Sub CriarRecordset (ObjRecordset)
		Set ObjRecordset = Server.CreateObject("ADODB.Recordset")
	End Sub

	'-------------------------------
	'Subrotina que fecha um Recordset
	'-------------------------------
	Sub FecharRecordset (ObjRecordset)
		ObjRecordset.close
		Set ObjRecordset = nothing
	End Sub

	'--------------------------------------------------
	'Subrotina que fecha a conex�o com o banco de dados
	'--------------------------------------------------
	Sub FecharBD (ObjConexao)
		ObjConexao.close
		set ObjConexao = nothing
	End Sub

	'-----------------------------------------------------------
	'Func�o que faz busca num banco de dados desprezando acentos
	'-----------------------------------------------------------
	Function busca_inteligente(variavel)
		v = lcase(variavel)
		v = Replace(v,"%","")
		v = Replace(v,"'","")
		v = Replace(v,"""","")
		v = replace(v, "�" , "o")
		v = replace(v, "�" , "o")
		v = replace(v, "�" , "o")
		v = replace(v, "�" , "o")
		v = replace(v, "�" , "o")
		v = replace(v, "�" , "a")
		v = replace(v, "�" , "a")
		v = replace(v, "�" , "a")
		v = replace(v, "�" , "a")
		v = replace(v, "�" , "a")
		v = replace(v, "�" , "e")
		v = replace(v, "�" , "e")
		v = replace(v, "�" , "e")
		v = replace(v, "�" , "u")
		v = replace(v, "�" , "u")
		v = replace(v, "�" , "u")
		v = replace(v, "�" , "u")
		v = replace(v, "�" , "i")
		v = replace(v, "�" , "i")
		v = replace(v, "�" , "c")
		v = replace(v,"a","[a,�,�,�,�,�]")
		v = replace(v,"e","[e,�,�,�]")
		v = replace(v,"i","[i,�,�]")
		v = replace(v,"o","[o,�,�,�,�,�]")
		v = replace(v,"u","[u,�,�,�,�]")
		v = replace(v,"c","[c,�]")
		v = replace(v,"'","['']")
		busca_inteligente = v
	End Function
	

	'-----------------------------------------------------------
	'Func�o que codifica ou decodifica padr�o UTF8 para ajax (Banco de Dados e Envio de E-Mail)
	'-----------------------------------------------------------
	function DecodeUTF8(s)
	  dim i
	  dim c
	  dim n
	
	  i = 1
	  do while i <= len(s)
		c = asc(mid(s,i,1))
		if c and &H80 then
		  n = 1
		  do while i + n < len(s)
			if (asc(mid(s,i+n,1)) and &HC0) <> &H80 then
			  exit do
			end if
			n = n + 1
		  loop
		  if n = 2 and ((c and &HE0) = &HC0) then
			c = asc(mid(s,i+1,1)) + &H40 * (c and &H01)
		  else
			c = 191 
		  end if
		  s = left(s,i-1) + chr(c) + mid(s,i+n)
		end if
		i = i + 1
	  loop
	  DecodeUTF8 = s 
	end function
	
	
	function EncodeUTF8(s)
	  dim i
	  dim c
	
	  i = 1
	  do while i <= len(s)
		c = asc(mid(s,i,1))
		if c >= &H80 then
		  s = left(s,i-1) + chr(&HC2 + ((c and &H40) / &H40)) + chr(c and &HBF) + mid(s,i+1)
		  i = i + 1
		end if
		i = i + 1
	  loop
	  EncodeUTF8 = s 
	end function

%>