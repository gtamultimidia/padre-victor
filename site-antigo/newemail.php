<?

	$email = $_POST['email'];

	
	$msg = "<html>
	<head></head>
	<body>
		<font face='Verdana, Geneva, sans-serif'>
			<table border='0'>
				<tr>
					<td align='center' width='800'>
						<img src='http://www.padrevictorcafe.com.br/imagens/pv.gif' width='806' height='152' />
					</td>
				</tr>
			</table>
			<br>

			<table border='0'>
				<tr>
					<td width='400' align='left'>
						<b>Email: </b>".$email."
					</td>
				</tr>
			</table>

			<table border='0'>
				<tr>
					<td width='800'>
					</td>
				</tr>
			</table>
			<table border='0'>
				<tr>
					<td width='800'>
					</td>
				</tr>
			</table>
			<table border='0'>
				<tr>
					<td width='800'>
					</td>
				</tr>
			</table>
			<table border='0'>
				<tr>
					<td width='800'>
					</td>
				</tr>
			</table>
			<br>
			<table border='0'>
				<tr>
					<td align='center' width='800'>
						<img src='http://www.padrevictorcafe.com.br/imagens/pv_barra.gif' width='800' height='15' />
					</td>
				</tr>
			</table>
		</font>
	</body>
	</html>";
	
	$destino = "atendimento@padrevictorcafe.com.br";
	//$destino = 'italo@gtamultimidia.com.br';
	$assunto = "Contato via-site | Padre Victor";
	$from = "Site - Café Padre Victor";
	$from = '=?UTF-8?B?'.base64_encode($from).'?=';
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: $from <suporte@padrevictorcafe.com.br>\r\n";
	$headers .= "Return-Path: suporte@padrevictorcafe.com.br\r\n";
	//$headers .= "Bcc: italo@gtamultimidia.com.br\r\n";
	$headers .= "Reply-To: $email\r\n";
	
	mail($destino,$assunto,$msg,$headers,"-r"."suporte@padrevictorcafe.com.br");
	
	echo "<script type='text/javascript'> alert('Mensagem enviada com sucesso!'); </script>"; 
	echo "<meta http-equiv='refresh' content='0;URL=contato.php'>";
?>