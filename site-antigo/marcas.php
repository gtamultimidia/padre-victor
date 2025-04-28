<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

        <?php
			$id = $_GET['linha'];
			
			$SQL = "SELECT * FROM produtos WHERE linha = '".$id."' AND excluido=0";
			$consulta = mysql_query($SQL)  or die(mysql_error());
			$rows = mysql_num_rows($consulta) or die(mysql_error());
			$aux = 0;
			$teste = true;
			$sizeTop = 0;
			$sizeTop2 = 25;
			$i = 1;
			
			while ($aux < $rows){
				$SQL1 = "SELECT * FROM produtos WHERE ordem = ".$i." AND linha = '".$id."'";
				$consulta1 = mysql_query($SQL)  or die(mysql_error());
				$resultado1 = mysql_fetch_array($consulta)  or die(mysql_error());
				
				if ($teste == true){
					echo '
					<img src="produtos/'.$resultado1['linha'].'/'.$resultado1['img'].'" border="0" style="width: 200px; height: 200px;position: absolute;top: '.$sizeTop.'px;left: 0px;"/></a></center>
				
					<p style="position: absolute; font-weight: bold; color: #a38b54; top: '.$sizeTop.'px; left: 220px; width: 200px;"><strong>'.$resultado1['nome'].'</strong><br>
					</p>
					
					<div style="position: absolute; width:200px; height: 200px; left: 220px; top: '.$sizeTop2.'px; overflow: auto; font-family: Calibri;">
						'.$resultado1['descricao'].'
					</div>';
					$teste = false;
				} else {
					echo '
					<img src="produtos/'.$resultado1['linha'].'/'.$resultado1['img'].'" border="0" style="width: 200px; height: 200px;position: absolute;top: '.$sizeTop.'px;left: 450px;"/></a>
				
					<p style="position: absolute; font-weight: bold; color: #a38b54; top: '.$sizeTop.'px; left: 670px; width: 250px;"><strong>'.$resultado1['nome'].'</strong><br>
					</p>
					
					<div style="position: absolute; width:200px; height: 200px; left: 670px; top: '.$sizeTop2.'px; overflow: auto; font-family: Calibri;">
						'.$resultado1['descricao'].'
					</div>';
					$teste = true;
					$sizeTop += 250;
					$sizeTop2 += 250;
				}
				$i += 1;
				$aux += 1;
			}
		?>