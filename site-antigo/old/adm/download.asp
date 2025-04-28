<% 
caminho = "../" & request.querystring("caminho")
arquivo = request.querystring("arquivo")
response.AddHeader "Content-Type","application/x-msdownload" 
response.AddHeader "Content-Disposition","attachment; filename=" & arquivo 

Response.Buffer = True 
Const adTypeBinary = 1 

Set binario = Server.CreateObject("ADODB.Stream") 
binario.Open 
binario.Type = adTypeBinary 
binario.LoadFromFile Server.MapPath(caminho) 
Response.BinaryWrite binario.Read 
binario.Close 

Set binario = Nothing 
Response.Flush 
%> 