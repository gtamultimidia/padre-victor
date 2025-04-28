<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

        <?php
			$id = $_GET['linha'];
			echo $id;
			$SQL = "SELECT * FROM produtos WHERE linha = '".$id."'";
			$consulta = mysql_query($SQL)  or die(mysql_error());
			$rows = mysql_num_rows($consulta) or die(mysql_error());
			
			echo "<table>";
			
			for ($i = 1; $i <= $rows; $i++){
				$SQL1 = "SELECT * FROM `produtos` WHERE ordem = ".$i;
				$j = $i + 1;
				$SQL2 = "SELECT * FROM `produtos` WHERE ordem = ".$j;
				$k = $j + 1;
				$SQL3 = "SELECT * FROM `produtos` WHERE ordem = ".$k;
				
				$consulta1 = mysql_query($SQL1)  or die(mysql_error());
				$consulta2 = mysql_query($SQL2)  or die(mysql_error());
				$consulta3 = mysql_query($SQL3)  or die(mysql_error());
				
				$resultado1 = mysql_fetch_array($consulta1)  or die(mysql_error());
				$resultado2 = mysql_fetch_array($consulta2)  or die(mysql_error());
				$resultado3 = mysql_fetch_array($consulta3)  or die(mysql_error());
				
				echo '
				<tr>';
					if ($i <= $rows){
						echo '
                    <td>
                        <center><a href="produtos_interno.php?linha='.$i.'"><img src="produtos/'.$resultado1['linha'].'/'.$resultado1['img'].'" border="0" style="width: 100px; height: 100px;"/></a></center>
                    </td>';
					}
					if ($j <= $rows){
						echo '
					<td>
                        <center><a href="produtos_interno.php?linha='.$j.'"><img src="produtos/'.$resultado2['linha'].'/'.$resultado2['img'].'" border="0" style="width: 100px; height: 100px;"/></a></center>
                    </td>';
					}
					if ($k <= $rows){
						echo '
					<td>
                        <center><a href="produtos_interno.php?linha='.$k.'"><img src="produtos/'.$resultado3['linha'].'/'.$resultado3['img'].'" border="0" style="width: 100px; height: 100px;"/></a></center>
                    </td>';
					}
				echo '
				</tr>
                <tr>';
					if ($i <= $rows){
						echo '
                    <td>
                        <a href="produtos_interno.php?linha='.$i.'"><p align="center">'.$resultado1['nome'].'</p></a>
                    </td>';
					}
					if ($j <= $rows){
						echo '
					<td>
                        <a href="produtos_interno.php?linha='.$j.'"><p align="center">'.$resultado2['nome'].'</p></a>
                    </td>';
					}
					if ($k <= $rows){
						echo '
					<td>
                        <a href="produtos_interno.php?linha='.$k.'"><p align="center">'.$resultado3['nome'].'</p></a>
                    </td>';
					}
				echo '
                </tr>
                <tr>
                	<td>
                    	<p></p>
                    </td>
                </tr>
				';
				$i = $j + 1;
			}
			
			echo "</table>";
		?>