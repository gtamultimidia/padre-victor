<!--#include file="include_menu.asp" -->
<% 
pasta_imagens = "../" & Request.QueryString("pasta")
pasta = Server.URLEncode(Request.QueryString("pasta"))
titulo = request.querystring("titulo")
arq_biblioteca = request.querystring("arq_biblioteca")
%>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>Intranet: Caf&eacute; Padre Victor</TITLE>
<link rel="stylesheet" href="estilos.css" type="text/css">
<style type="text/css">
<!--

.titulo_campos
{
font-family: Tahoma, Verdana, Arial;
font-size: 11px;
color: dimgray;
background-color: whitesmoke;
}

-->
</style>

<script language=javascript>

function submitform(titulo)
{
	document.forms['form'].action = "<%=Request.ServerVariables("SCRIPT_NAME")%>?pasta=<%= pasta %>&arq_biblioteca=<%= arq_biblioteca %>&enviar=sim&titulo= " + titulo;
	document.forms['form'].submit();
}

function envia_imagem(imagem) {
self.opener.location.reload();
}
</script>
</HEAD>
<BODY class="texto_pagina" onUnload="javascript: envia_imagem();">

<%
Sub BuildUploadRequest(RequestBin)
	PosBeg = 1
	PosEnd = InstrB(PosBeg,RequestBin,getByteString(chr(13)))
	boundary = MidB(RequestBin,PosBeg,PosEnd-PosBeg)
	boundaryPos = InstrB(1,RequestBin,boundary)
	Do until (boundaryPos=InstrB(RequestBin,boundary & getByteString("--")))
		Dim UploadControl
		Set UploadControl = CreateObject("Scripting.Dictionary")
		Pos = InstrB(BoundaryPos,RequestBin,getByteString("Content-Disposition"))
		Pos = InstrB(Pos,RequestBin,getByteString("name="))
		PosBeg = Pos+6
		PosEnd = InstrB(PosBeg,RequestBin,getByteString(chr(34)))
		Name = getString(MidB(RequestBin,PosBeg,PosEnd-PosBeg))
		PosFile = InstrB(BoundaryPos,RequestBin,getByteString("filename="))
		PosBound = InstrB(PosEnd,RequestBin,boundary)
		If  PosFile<>0 AND (PosFile<PosBound) Then
			PosBeg = PosFile + 10
			PosEnd =  InstrB(PosBeg,RequestBin,getByteString(chr(34)))
			FileName = getString(MidB(RequestBin,PosBeg,PosEnd-PosBeg))
			UploadControl.Add "FileName", FileName
			Pos = InstrB(PosEnd,RequestBin,getByteString("Content-Type:"))
			PosBeg = Pos+14
			PosEnd = InstrB(PosBeg,RequestBin,getByteString(chr(13)))
			ContentType = getString(MidB(RequestBin,PosBeg,PosEnd-PosBeg))
			UploadControl.Add "ContentType",ContentType
			PosBeg = PosEnd+4
			PosEnd = InstrB(PosBeg,RequestBin,boundary)-2
			Value = MidB(RequestBin,PosBeg,PosEnd-PosBeg)
		Else
			Pos = InstrB(Pos,RequestBin,getByteString(chr(13)))
			PosBeg = Pos+4
			PosEnd = InstrB(PosBeg,RequestBin,boundary)-2
			Value = getString(MidB(RequestBin,PosBeg,PosEnd-PosBeg))
		End If
	UploadControl.Add "Value" , Value	
	UploadRequest.Add name, UploadControl	
	BoundaryPos=InstrB(BoundaryPos+LenB(boundary),RequestBin,boundary)
	Loop

End Sub

Function getByteString(StringStr)
 For i = 1 to Len(StringStr)
 	char = Mid(StringStr,i,1)
	getByteString = getByteString & chrB(AscB(char))
 Next
End Function

Function getString(StringBin)
 getString =""
 For intCount = 1 to LenB(StringBin)
	getString = getString & chr(AscB(MidB(StringBin,intCount,1))) 
 Next
End Function

Set objFS = Server.CreateObject("Scripting.FileSystemObject")
If Not objFS.FolderExists(Server.MapPath(pasta_imagens)) Then
  objFS.CreateFolder(Server.MapPath(pasta_imagens))
End if

If Request("enviar") <> "" Then
  Set objFS = Nothing
  byteCount = Request.TotalBytes
  RequestBin = Request.BinaryRead(byteCount)
  Dim UploadRequest
  Set UploadRequest = CreateObject("Scripting.Dictionary")
  BuildUploadRequest  RequestBin
  contentType = UploadRequest.Item("blob").Item("ContentType")
  filepathname = UploadRequest.Item("blob").Item("FileName")
  filename = Right(filepathname,Len(filepathname)-InstrRev(filepathname,"\"))
  value = UploadRequest.Item("blob").Item("Value")
  If (Lcase(Right(filename,3)) = "jpg") Or (Lcase(Right(filename,3)) = "pdf") Or (Lcase(Right(filename,3)) = "doc") then
    Set objFS = Server.CreateObject("Scripting.FileSystemObject")
	If objFS.FileExists( Server.mappath(pasta_imagens & "\" & filename )) = true then existearquivo = "sim" else existearquivo = "não"
	If objFS.FileExists( Server.mappath(pasta_imagens & "\" & filename )) Then
%>

<script language=javascript>
alert("Erro ao enviar imagem, o arquivo '<%=filename%>' já existe nesta pasta do seu site")
enviar.disabled = false;
</script>

<%

	Else
	  If LenB(value) > 5120000 then

%>

<script language=javascript>
alert("Erro ao enviar, o tamanho do arquivo deve ser menor que 5mb")
enviar.disabled = false;
</script>

<%
      Else
%>
<strong>Aguarde o envio do arquivo...</strong><br>

<input name="progress" value="0% enviado" style="border:none">
<table width="100" border="0" cellspacing="0" cellpadding="0" style="border: 1px inset">
  <tr>
    <td><input name="barra" style="border:none; background-color: orangered; height: 10; width:1" readonly=""></td>
    <td></td>
  </tr>
</table>

<%
      Set ScriptObject = Server.CreateObject("Scripting.FileSystemObject")
      Set MyFile = ScriptObject.CreateTextFile( Server.mappath(pasta_imagens & "\" & filename))
	  progress = 0
	  n = 0
      For i = 1 to LenB(value)
        MyFile.Write chr(AscB(MidB(value,i,1)))
		progress = Fix((i * 100) / LenB(value))
		If n <> progress then
		  n = progress
%>

<script language=javascript>progress.value = "<%=n%>% enviado"</script>
<script language=javascript>barra.style.width = "<%=n%>"</script>

<%
        End if
      Next
      MyFile.Close
	 
	  ConectarBD Conn, "websitecafepadrevictor.mdb"
	  arq_descricao = Corrige_Campo(trim(request.querystring("titulo")))
	  arq_data = Cstr(date)
	  arq_arquivo = filename
	  arq_caminho = lcase(Corrige_Campo(request.querystring("pasta")) & "/" & filename)
	  arq_tamanho = LenB(value)
	  arq_biblioteca = Corrige_Campo(request.querystring("arq_biblioteca"))
	  Conn.execute "insert into ARQUIVOS (arq_descricao, arq_data, arq_arquivo, arq_caminho, arq_tamanho, arq_biblioteca) values ('" & arq_descricao & "','" & arq_data & "','" & arq_arquivo & "','" & arq_caminho & "','" & arq_tamanho & "'," & arq_biblioteca & ")"
	  session("msg") = "<img src=imagens/ok_concluido.gif width=18 height=19 align=absmiddle>&nbsp;&nbsp;IMAGEM ANEXADA COM SUCESSO."
	  FecharBD Conn

%>
<script language=javascript>
envia_imagem('<%= pasta_imagens & "/" & filename%>');
</script>

<%

	End If
	Set objFS = Nothing
  End if

Else
%>

<script language=javascript>
alert("Erro ao enviar o arquivo, lembre-se que ele deve possuir extensão JPG ou DOC e PDF");
enviar.disabled = false;
</script>

<%
 End If
End If
%>
<FORM ACTION="" METHOD="post" ENCTYPE="multipart/form-data" name="form" id="form" onSubmit="enviar.disabled=true;enviar.value='Enviando...';submitform(document.form.titulo.value);">
  <table width="100%" border="0" cellpadding="10" cellspacing="0" class="table_borda2">
    <tr>
      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td><div align="right">Arquivo JPG ou PDF:</div></td>
          <td>&nbsp;
            <INPUT type="file" name="blob" style="width: 350px"></td>
        </tr>
        <tr>
          <td><div align="right">Descri&ccedil;&atilde;o: </div></td>
          <td>&nbsp;
              <input name="titulo" type="text" style="width: 350px" maxlength="255"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;
            <INPUT type="submit" name="enviar" value="Enviar" class="botao_enviar"></td>
        </tr>
      </table>
      </td>
    </tr>
  </table>
</FORM>
<strong> &nbsp;&nbsp;&#8250; Lista de Arquivos Anexados:</strong><BR>
<DIV class="table_color" style="width:100%; height:175px; visibility: visible; overflow: auto; border:1px solid">
<%
lista_imagens pasta_imagens, "jpg,pdf,doc"
Function lista_imagens( strFolder, tipo )
  If Trim( Request.QueryString("folder") ) <> "" Then
    strFolder = Request.ServerVariables("APPL_PHYSICAL_PATH") & Request.QueryString("folder")
    'strFolder = "\\terraempresas.com.br\Cluster21\julianag\wwwroot" & Request.QueryString("folder")
  End If

  Dim Folder, File
  Dim ObjFS, objRootFolder
  Set ObjFS = Server.CreateObject("Scripting.FileSystemObject")
  Set objFolder = ObjFS.GetFolder(Server.MapPath(strFolder))
  For Each File in objFolder.files
    tipo = Replace(tipo, ",", "")
    For i = 1 to len(tipo) step 3
      If Right(lcase(File), 3) = Mid(lcase(tipo), i, 3) Then
        Response.Write "&nbsp;&nbsp;" & lcase(File.Name) & "<BR>" & vbcrlf
      End If
    Next
  Next
  
  Response.Write "</td></tr></table>" & vbcrlf 
  Set objFolder = Nothing
  Set Folder = Nothing
End Function
%>
</DIV>
</BODY>
</HTML>
